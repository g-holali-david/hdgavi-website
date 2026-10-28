<?php
/**
 * HD GAVI Portfolio — CV Download Gate
 * Tracks CV downloads with lead capture modal + PDF proxy endpoint
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
            'lang'       => in_array( $lang, array( 'en', 'fr' ), true ) ? $lang : 'en',
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
   3. NOTIFICATION EMAIL
   ═══════════════════════════════════════ */

function hdgavi_cv_send_notification( $name, $email, $role, $reason ) {
    $to = hdgavi_opt( 'general_email', get_option( 'admin_email' ) );
    if ( ! $to ) return;

    $reasons = array(
        'recruitment' => 'Recruitment / Recrutement',
        'academic'    => 'Academic / Académique',
        'collaboration' => 'Collaboration',
        'other'       => 'Other / Autre',
    );
    $reason_label = $reasons[ $reason ] ?? $reason;

    $subject = 'CV Downloaded by ' . $name;

    $header = hdgavi_email_header(
        '📄 CV Download',
        'Someone just downloaded your CV'
    );

    $body = '
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin-bottom:20px;">
      <tr>
        <td style="padding:10px 0;border-bottom:1px solid ' . hdgavi_ec('border') . ';">
          <strong style="color:' . hdgavi_ec('text_heading') . ';">Name</strong><br>
          <span style="color:' . hdgavi_ec('text_secondary') . ';">' . esc_html( $name ) . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding:10px 0;border-bottom:1px solid ' . hdgavi_ec('border') . ';">
          <strong style="color:' . hdgavi_ec('text_heading') . ';">Email</strong><br>
          <a href="mailto:' . esc_attr( $email ) . '" style="color:' . hdgavi_ec('accent') . ';">' . esc_html( $email ) . '</a>
        </td>
      </tr>
      <tr>
        <td style="padding:10px 0;border-bottom:1px solid ' . hdgavi_ec('border') . ';">
          <strong style="color:' . hdgavi_ec('text_heading') . ';">Role / Position</strong><br>
          <span style="color:' . hdgavi_ec('text_secondary') . ';">' . esc_html( $role ) . '</span>
        </td>
      </tr>
      <tr>
        <td style="padding:10px 0;">
          <strong style="color:' . hdgavi_ec('text_heading') . ';">Reason</strong><br>
          <span style="color:' . hdgavi_ec('text_secondary') . ';">' . esc_html( $reason_label ) . '</span>
        </td>
      </tr>
    </table>
    <p style="font-size:12px;color:' . hdgavi_ec('text_muted') . ';">IP: ' . esc_html( hdgavi_get_client_ip() ) . ' &middot; ' . esc_html( wp_date( 'Y-m-d H:i' ) ) . '</p>';

    $footer = hdgavi_email_footer();
    $html   = hdgavi_email_wrap( $header, $body, $footer );

    $result = wp_mail( $to, $subject, $html, array( 'Content-Type: text/html; charset=UTF-8' ) );
    hdgavi_log_mail( $to, $subject, $result );
}

/**
 * Send confirmation email to visitor after CV download
 */
function hdgavi_cv_send_visitor_confirmation( $name, $email, $lang = 'en' ) {
    $site_name = hdgavi_opt( 'general_name', 'Portfolio' );
    $html_headers = array( 'Content-Type: text/html; charset=UTF-8' );

    $titles = array(
        'en' => 'Thanks for downloading my CV!',
        'fr' => 'Merci d\'avoir téléchargé mon CV !',
        'es' => '¡Gracias por descargar mi CV!',
    );
    $subtitles = array(
        'en' => 'Here\'s how to reach me',
        'fr' => 'Voici comment me contacter',
        'es' => 'Así puede contactarme',
    );
    $messages = array(
        'en' => '<p>Hi <strong>%s</strong>,</p><p>Thank you for your interest in my profile. You can explore my portfolio for more details about my skills and projects.</p><p>Feel free to reach out if you\'d like to discuss any opportunity.</p>',
        'fr' => '<p>Bonjour <strong>%s</strong>,</p><p>Merci pour l\'intérêt que vous portez à mon profil. Vous pouvez explorer mon portfolio pour plus de détails sur mes compétences et projets.</p><p>N\'hésitez pas à me contacter si vous souhaitez échanger.</p>',
        'es' => '<p>Hola <strong>%s</strong>,</p><p>Gracias por su interés en mi perfil. Puede explorar mi portfolio para más detalles sobre mis habilidades y proyectos.</p><p>No dude en contactarme si desea conversar.</p>',
    );

    $title   = $titles[ $lang ] ?? $titles['en'];
    $sub     = $subtitles[ $lang ] ?? $subtitles['en'];
    $msg     = sprintf( $messages[ $lang ] ?? $messages['en'], esc_html( $name ) );

    $contact_url = esc_url( home_url( '/contact/' ) );
    $cta = '<p style="text-align:center;margin-top:24px"><a href="' . $contact_url . '" style="display:inline-block;padding:12px 28px;background:' . hdgavi_ec('accent') . ';color:' . hdgavi_ec('header_bg') . ';border-radius:50px;text-decoration:none;font-weight:700;font-size:14px">' . ( $lang === 'fr' ? 'Me contacter' : ( $lang === 'es' ? 'Contactarme' : 'Contact me' ) ) . '</a></p>';

    $cv_header = hdgavi_email_header( $title, $sub );
    $cv_body = '<div style="padding:24px 32px;color:' . hdgavi_ec('text_body') . ';font-size:14px;line-height:1.7">'
        . $msg . $cta
        . '<p style="color:' . hdgavi_ec('text_muted') . ';margin-top:20px">— ' . esc_html( $site_name ) . '</p>'
        . '</div>';
    $body = hdgavi_email_wrap( $cv_header, $cv_body, hdgavi_email_footer() );

    $subject = $title . ' — ' . $site_name;
    $result = wp_mail( $email, $subject, $body, $html_headers );
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
   ═══════════════════════════════════════ */

function hdgavi_cv_modal_html() {
    $cv_url = hdgavi_opt( 'cv_pdf_url', '' );
    if ( ! $cv_url ) return;
    ?>
    <div class="cv-modal-overlay" id="cvModalOverlay">
        <div class="cv-modal" role="dialog" aria-modal="true" aria-labelledby="cvModalTitle">
            <button class="cv-modal-close" id="cvModalClose" type="button" aria-label="Close">&times;</button>

            <div class="cv-modal-header">
                <div class="cv-modal-icon"><?php echo hdgavi_icon( 'download', 24 ); ?></div>
                <h3 id="cvModalTitle">
                    <span data-lang="en">Download CV</span>
                    <span data-lang="fr">Télécharger le CV</span>
                </h3>
                <p class="cv-modal-desc">
                    <span data-lang="en">Please provide your details to download.</span>
                    <span data-lang="fr">Merci de renseigner vos informations.</span>
                </p>
            </div>

            <form id="cvModalForm" autocomplete="off">
                <!-- Honeypot -->
                <input type="text" name="website" style="display:none" tabindex="-1" autocomplete="off">

                <div class="cv-modal-field">
                    <label for="cvName">
                        <span data-lang="en">Full Name</span>
                        <span data-lang="fr">Nom complet</span>
                    </label>
                    <input type="text" id="cvName" name="name" required
                        data-placeholder-en="John Doe"
                        data-placeholder-fr="Jean Dupont">
                </div>

                <div class="cv-modal-field">
                    <label for="cvEmail">
                        <span data-lang="en">Email</span>
                        <span data-lang="fr">Email</span>
                    </label>
                    <input type="email" id="cvEmail" name="email" required
                        data-placeholder-en="john@company.com"
                        data-placeholder-fr="jean@entreprise.fr">
                </div>

                <div class="cv-modal-field">
                    <label for="cvRole">
                        <span data-lang="en">Your Role / Position</span>
                        <span data-lang="fr">Votre poste / fonction</span>
                    </label>
                    <input type="text" id="cvRole" name="role" required
                        data-placeholder-en="HR Manager, CTO, Student..."
                        data-placeholder-fr="RH, CTO, Étudiant...">
                </div>

                <div class="cv-modal-field">
                    <label for="cvReason">
                        <span data-lang="en">Reason for downloading</span>
                        <span data-lang="fr">Raison du téléchargement</span>
                    </label>
                    <select id="cvReason" name="reason" required>
                        <option value="">
                            --
                        </option>
                        <option value="recruitment" data-lang-text-en="Recruitment" data-lang-text-fr="Recrutement">Recruitment</option>
                        <option value="academic" data-lang-text-en="Academic" data-lang-text-fr="Académique">Academic</option>
                        <option value="collaboration" data-lang-text-en="Collaboration" data-lang-text-fr="Collaboration">Collaboration</option>
                        <option value="other" data-lang-text-en="Other" data-lang-text-fr="Autre">Other</option>
                    </select>
                </div>

                <div class="cv-modal-actions">
                    <button type="submit" class="btn-primary cv-modal-submit" id="cvModalSubmit">
                        <?php echo hdgavi_icon( 'download', 16 ); ?>
                        <span data-lang="en">Download</span>
                        <span data-lang="fr">Télécharger</span>
                    </button>
                </div>

                <div class="cv-modal-feedback" id="cvModalFeedback"></div>
            </form>

            <!-- Success state -->
            <div class="cv-modal-success" id="cvModalSuccess" style="display:none">
                <div class="cv-modal-check"><?php echo hdgavi_icon( 'check', 32 ); ?></div>
                <p>
                    <span data-lang="en">Thank you! Your download will start shortly.</span>
                    <span data-lang="fr">Merci ! Le téléchargement va commencer.</span>
                </p>
            </div>
        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'hdgavi_cv_modal_html' );
