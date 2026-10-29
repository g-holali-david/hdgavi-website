<?php
/**
 * HD GAVI Portfolio — CV Download Gate
 * Tracks CV downloads with lead capture modal + PDF proxy endpoint.
 * The v7 templates link the CV directly; the modal stays for compatibility (theme.js opens it).
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ═══════════════════════════════════════
   1. DATABASE TABLE
   ═══════════════════════════════════════ */

function hdgavi_cv_create_table() {
    global $wpdb;
    $table   = $wpdb->prefix . 'hdgavi_cv_downloads';
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
        name VARCHAR(255) NOT NULL DEFAULT '',
        email VARCHAR(255) NOT NULL DEFAULT '',
        role VARCHAR(255) NOT NULL DEFAULT '',
        reason VARCHAR(100) NOT NULL DEFAULT '',
        ip_address VARCHAR(45) NOT NULL DEFAULT '',
        user_agent VARCHAR(512) NOT NULL DEFAULT '',
        lang VARCHAR(2) NOT NULL DEFAULT 'en',
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY idx_email (email),
        KEY idx_created (created_at)
    ) $charset;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );
}

function hdgavi_cv_maybe_create_table() {
    $db_version = get_option( 'hdgavi_cv_db_version', 0 );
    if ( (int) $db_version < 1 ) {
        hdgavi_cv_create_table();
        update_option( 'hdgavi_cv_db_version', 1, false );
    }
}
add_action( 'admin_init', 'hdgavi_cv_maybe_create_table' );

/* ═══════════════════════════════════════
   2. AJAX HANDLER — CV DOWNLOAD REQUEST
   ═══════════════════════════════════════ */

function hdgavi_ajax_cv_download() {
    check_ajax_referer( 'hdgavi_cv_download_nonce', 'nonce' );
    hdgavi_rate_limit( 'cv_download', 5 );

    $name   = sanitize_text_field( wp_unslash( $_POST['name']   ?? '' ) );
    $email  = sanitize_email( wp_unslash( $_POST['email']  ?? '' ) );
    $role   = sanitize_text_field( wp_unslash( $_POST['role']   ?? '' ) );
    $reason = sanitize_text_field( wp_unslash( $_POST['reason'] ?? '' ) );
    $lang   = sanitize_text_field( wp_unslash( $_POST['lang']   ?? 'en' ) );
    if ( ! in_array( $lang, array( 'en', 'fr', 'es' ), true ) ) $lang = 'en';

    // Honeypot check
    if ( ! empty( $_POST['website'] ) ) {
        wp_send_json_success( array( 'message' => 'OK' ) );
    }

    // Validation
    if ( ! $name || ! is_email( $email ) || ! $role || ! $reason ) {
        wp_send_json_error( array( 'message' => 'Please fill in all fields correctly.' ) );
    }

    // Insert into database
    global $wpdb;
    $wpdb->insert(
        $wpdb->prefix . 'hdgavi_cv_downloads',
        array(
            'name'       => $name,
            'email'      => $email,
            'role'       => $role,
            'reason'     => $reason,
            'ip_address' => hdgavi_get_client_ip(),
            'user_agent' => sanitize_text_field( $_SERVER['HTTP_USER_AGENT'] ?? '' ),
            'lang'       => $lang,
        ),
        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
    );

    // Send notification email to site owner
    hdgavi_cv_send_notification( $name, $email, $role, $reason );

    // Send confirmation email to visitor
    hdgavi_cv_send_visitor_confirmation( $name, $email, $lang );

    wp_send_json_success( array( 'message' => 'OK' ) );
}
add_action( 'wp_ajax_hdgavi_cv_download', 'hdgavi_ajax_cv_download' );
add_action( 'wp_ajax_nopriv_hdgavi_cv_download', 'hdgavi_ajax_cv_download' );

/* ═══════════════════════════════════════
   3. E-MAILS (shared wrapper from inc/email-templates.php)
   ═══════════════════════════════════════ */

/**
 * Notification to the site owner.
 */
function hdgavi_cv_send_notification( $name, $email, $role, $reason ) {
    $to = hdgavi_opt( 'general_email', get_option( 'admin_email' ) );
    if ( ! $to ) return;

    $reasons = array(
        'recruitment'   => 'Recruitment / Recrutement',
        'academic'      => 'Academic / Académique',
        'collaboration' => 'Collaboration',
        'other'         => 'Other / Autre',
    );
    $reason_label = $reasons[ $reason ] ?? $reason;

    $subject = 'CV request: ' . $name;
    $header  = hdgavi_email_header( 'CV download', 'A visitor filled in the CV form on the site.' );

    $rows = array(
        'Name'            => esc_html( $name ),
        'E-mail'          => '<a href="mailto:' . esc_attr( $email ) . '">' . esc_html( $email ) . '</a>',
        'Role / position' => esc_html( $role ),
        'Reason'          => esc_html( $reason_label ),
    );
    $body = '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">';
    foreach ( $rows as $label => $value ) {
        $body .= '<tr><td style="padding:8px 0;"><strong>' . esc_html( $label ) . '</strong><br>' . $value . '</td></tr>';
    }
    $body .= '</table>'
        . '<p style="font-size:12px;">IP: ' . esc_html( hdgavi_get_client_ip() ) . ' &middot; ' . esc_html( wp_date( 'Y-m-d H:i' ) ) . '</p>';

    $html   = hdgavi_email_wrap( $header, $body, hdgavi_email_footer() );
    $result = wp_mail( $to, $subject, $html, array( 'Content-Type: text/html; charset=UTF-8' ) );
    hdgavi_log_mail( $to, $subject, $result );
}

/**
 * Confirmation to the visitor after a CV download.
 */
function hdgavi_cv_send_visitor_confirmation( $name, $email, $lang = 'en' ) {
    if ( ! in_array( $lang, array( 'en', 'fr', 'es' ), true ) ) $lang = 'en';
    $site_name    = hdgavi_opt( 'general_name', 'Holali David GAVI' );
    $owner_email  = hdgavi_opt( 'general_email', '' );
    $html_headers = array( 'Content-Type: text/html; charset=UTF-8' );

    $titles = array(
        'en' => 'Your CV request',
        'fr' => 'Votre demande de CV',
        'es' => 'Su solicitud de CV',
    );
    $intros = array(
        'en' => '<p>Hello %s,</p><p>Thank you for downloading my CV. The site also details my experience, my projects and my skills.</p>',
        'fr' => '<p>Bonjour %s,</p><p>Merci d’avoir téléchargé mon CV. Le site détaille aussi mon parcours, mes projets et mes compétences.</p>',
        'es' => '<p>Hola, %s:</p><p>Gracias por descargar mi CV. El sitio también detalla mi experiencia, mis proyectos y mis competencias.</p>',
    );
    $reach = array(
        'en' => '<p>You can reach me at %s or through the contact page.</p>',
        'fr' => '<p>Vous pouvez me joindre à l’adresse %s ou depuis la page de contact.</p>',
        'es' => '<p>Puede contactarme en %s o desde la página de contacto.</p>',
    );
    $reach_no_mail = array(
        'en' => '<p>You can reach me through the contact page.</p>',
        'fr' => '<p>Vous pouvez me joindre depuis la page de contact.</p>',
        'es' => '<p>Puede contactarme desde la página de contacto.</p>',
    );
    $link_labels = array(
        'en' => 'Contact page',
        'fr' => 'Page de contact',
        'es' => 'Página de contacto',
    );

    $title = $titles[ $lang ];
    $msg   = sprintf( $intros[ $lang ], esc_html( $name ) );
    if ( is_email( $owner_email ) ) {
        $msg .= sprintf( $reach[ $lang ], '<a href="mailto:' . esc_attr( $owner_email ) . '">' . esc_html( $owner_email ) . '</a>' );
    } else {
        $msg .= $reach_no_mail[ $lang ];
    }

    $contact_url = function_exists( 'hdgavi_page_url' ) ? hdgavi_page_url( 'contact' ) : home_url( '/contact/' );
    $msg        .= '<p><a href="' . esc_url( $contact_url ) . '">' . esc_html( $link_labels[ $lang ] ) . '</a></p>'
        . '<p>' . esc_html( $site_name ) . '</p>';

    $cv_header = hdgavi_email_header( $title, $site_name );
    $cv_body   = '<div style="padding:24px 32px;font-size:14px;line-height:1.7">' . $msg . '</div>';
    $body      = hdgavi_email_wrap( $cv_header, $cv_body, hdgavi_email_footer() );

    $subject = $title . ' — ' . $site_name;
    $result  = wp_mail( $email, $subject, $body, $html_headers );
    hdgavi_log_mail( $email, $subject, $result );
}

/* ═══════════════════════════════════════
   4. PDF PROXY — PREVIEW & DOWNLOAD GATE
   ═══════════════════════════════════════ */

function hdgavi_cv_proxy() {
    $action = sanitize_text_field( wp_unslash( $_GET['hdgavi_cv'] ?? '' ) );
    if ( ! in_array( $action, array( 'preview', 'download' ), true ) ) return;

    $url = hdgavi_opt( 'cv_pdf_url', '' );
    if ( ! $url ) {
        wp_die( 'CV not configured.', 'Error', array( 'response' => 404 ) );
    }

    // Convert URL to local path
    $upload_dir = wp_get_upload_dir();
    $file_path  = str_replace( $upload_dir['baseurl'], $upload_dir['basedir'], $url );

    // Fallback: if it's a theme file
    if ( ! file_exists( $file_path ) ) {
        $file_path = str_replace(
            get_template_directory_uri(),
            get_template_directory(),
            $url
        );
    }

    if ( ! file_exists( $file_path ) ) {
        wp_die( 'CV file not found.', 'Error', array( 'response' => 404 ) );
    }

    // Security: prevent path traversal — file must be inside uploads or theme dir
    $file_path = realpath( $file_path );
    $allowed_dirs = array(
        realpath( $upload_dir['basedir'] ),
        realpath( get_template_directory() ),
    );
    $path_ok = false;
    foreach ( $allowed_dirs as $dir ) {
        if ( $dir && strpos( $file_path, $dir ) === 0 ) { $path_ok = true; break; }
    }
    if ( ! $path_ok || ! $file_path ) {
        wp_die( 'CV file not accessible.', 'Error', array( 'response' => 403 ) );
    }

    // Security: verify it's actually a PDF
    $finfo = finfo_open( FILEINFO_MIME_TYPE );
    $mime  = finfo_file( $finfo, $file_path );
    finfo_close( $finfo );
    if ( $mime !== 'application/pdf' ) {
        wp_die( 'Invalid file type.', 'Error', array( 'response' => 403 ) );
    }

    // Rate limit preview
    hdgavi_rate_limit( 'cv_preview', 20 );

    $filename = basename( $file_path );

    $disposition = ( $action === 'download' ) ? 'attachment' : 'inline';
    header( 'Content-Type: application/pdf' );
    header( 'Content-Disposition: ' . $disposition . '; filename="' . $filename . '"' );
    header( 'Content-Length: ' . filesize( $file_path ) );
    header( 'Cache-Control: no-store, no-cache, must-revalidate, max-age=0' );
    header( 'Pragma: no-cache' );
    header( 'X-Robots-Tag: noindex, nofollow' );

    readfile( $file_path );
    exit;
}
add_action( 'template_redirect', 'hdgavi_cv_proxy', 1 );

/* ═══════════════════════════════════════
   5. MODAL HTML (injected in wp_footer)
   Ids, field names and data-* attributes are used by assets/js/theme.js.
   ═══════════════════════════════════════ */

function hdgavi_cv_modal_html() {
    $cv_url = hdgavi_opt( 'cv_pdf_url', '' );
    if ( ! $cv_url ) return;
    $lang  = hdgavi_opt( 'default_lang', 'en' );
    $close = array( 'en' => 'Close', 'fr' => 'Fermer', 'es' => 'Cerrar' );
    ?>
    <div class="cv-modal-overlay" id="cvModalOverlay">
        <div class="cv-modal" role="dialog" aria-modal="true" aria-labelledby="cvModalTitle">
            <button class="cv-modal-close" id="cvModalClose" type="button" aria-label="<?php echo esc_attr( $close[ $lang ] ?? $close['en'] ); ?>">&times;</button>

            <div class="cv-modal-header">
                <h3 id="cvModalTitle"><?php echo hdgavi_tri( 'Download the CV', 'Télécharger le CV', 'Descargar el CV' ); ?></h3>
                <p class="cv-modal-desc"><?php echo hdgavi_tri(
                    'Please fill in these four fields; the download starts right after.',
                    'Merci de remplir ces quatre champs ; le téléchargement commence ensuite.',
                    'Rellene estos cuatro campos; la descarga empieza a continuación.'
                ); ?></p>
            </div>

            <form id="cvModalForm" autocomplete="off">
                <!-- Honeypot -->
                <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                <div class="cv-modal-field">
                    <label for="cvName"><?php echo hdgavi_tri( 'Full name', 'Nom complet', 'Nombre completo' ); ?></label>
                    <input type="text" id="cvName" name="name" required
                        data-placeholder-en="John Doe"
                        data-placeholder-fr="Jean Dupont"
                        data-placeholder-es="Juan Pérez">
                </div>

                <div class="cv-modal-field">
                    <label for="cvEmail"><?php echo hdgavi_tri( 'E-mail', 'E-mail', 'Correo electrónico' ); ?></label>
                    <input type="email" id="cvEmail" name="email" required
                        data-placeholder-en="john@company.com"
                        data-placeholder-fr="jean@entreprise.fr"
                        data-placeholder-es="juan@empresa.es">
                </div>

                <div class="cv-modal-field">
                    <label for="cvRole"><?php echo hdgavi_tri( 'Your role or position', 'Votre poste ou fonction', 'Su puesto o función' ); ?></label>
                    <input type="text" id="cvRole" name="role" required
                        data-placeholder-en="HR manager, CTO, student"
                        data-placeholder-fr="RH, CTO, étudiant"
                        data-placeholder-es="RR. HH., CTO, estudiante">
                </div>

                <div class="cv-modal-field">
                    <label for="cvReason"><?php echo hdgavi_tri( 'Reason for the download', 'Raison du téléchargement', 'Motivo de la descarga' ); ?></label>
                    <select id="cvReason" name="reason" required>
                        <option value="">--</option>
                        <option value="recruitment" data-lang-text-en="Recruitment" data-lang-text-fr="Recrutement" data-lang-text-es="Contratación">Recruitment</option>
                        <option value="academic" data-lang-text-en="Academic" data-lang-text-fr="Académique" data-lang-text-es="Académico">Academic</option>
                        <option value="collaboration" data-lang-text-en="Collaboration" data-lang-text-fr="Collaboration" data-lang-text-es="Colaboración">Collaboration</option>
                        <option value="other" data-lang-text-en="Other" data-lang-text-fr="Autre" data-lang-text-es="Otro">Other</option>
                    </select>
                </div>

                <div class="cv-modal-actions">
                    <button type="submit" class="btn-primary cv-modal-submit" id="cvModalSubmit">
                        <?php echo hdgavi_icon( 'download', 16 ); ?>
                        <?php echo hdgavi_tri( 'Download', 'Télécharger', 'Descargar' ); ?>
                    </button>
                </div>

                <div class="cv-modal-feedback" id="cvModalFeedback"></div>
            </form>

            <!-- Success state -->
            <div class="cv-modal-success" id="cvModalSuccess" style="display:none">
                <p><?php echo hdgavi_tri(
                    'Thank you. The download will start in a moment.',
                    'Merci. Le téléchargement va commencer.',
                    'Gracias. La descarga empezará en un momento.'
                ); ?></p>
            </div>
        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'hdgavi_cv_modal_html' );
