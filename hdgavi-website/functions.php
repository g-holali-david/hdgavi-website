<?php
/**
 * HD GAVI Portfolio — functions.php v7.0.0
 * Multi-page CV portfolio, trilingual EN/FR/ES, light and dark modes
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
define( 'HDGAVI_VERSION', '7.0.0' );

/* ── Includes ── */
require_once get_template_directory() . '/inc/icons.php';
require_once get_template_directory() . '/inc/customizer.php';
require_once get_template_directory() . '/inc/customizer-about.php';
require_once get_template_directory() . '/inc/customizer-contact.php';
require_once get_template_directory() . '/inc/customizer-seo.php';
require_once get_template_directory() . '/inc/customizer-effects.php';
require_once get_template_directory() . '/inc/customizer-labels.php';
require_once get_template_directory() . '/inc/customizer-email.php';
require_once get_template_directory() . '/inc/customizer-toggles.php';
require_once get_template_directory() . '/inc/customizer-pages.php';
require_once get_template_directory() . '/inc/customizer-lot6.php';
require_once get_template_directory() . '/inc/security.php';
require_once get_template_directory() . '/inc/seo.php';
require_once get_template_directory() . '/inc/sitemap.php';
require_once get_template_directory() . '/inc/stats.php';
require_once get_template_directory() . '/inc/qr-code.php';
require_once get_template_directory() . '/inc/vcard.php';
require_once get_template_directory() . '/inc/chatbot.php';
require_once get_template_directory() . '/inc/bilingual.php';
require_once get_template_directory() . '/inc/cv-content.php';
require_once get_template_directory() . '/inc/customizer-cv-labels.php';
require_once get_template_directory() . '/inc/email-templates.php';
require_once get_template_directory() . '/inc/newsletter.php';
require_once get_template_directory() . '/inc/rss-importer.php';
require_once get_template_directory() . '/inc/demo-content.php';
require_once get_template_directory() . '/inc/cpt-register.php';
require_once get_template_directory() . '/inc/cv-download-gate.php';
if ( is_admin() ) {
    require_once get_template_directory() . '/inc/cv-download-admin.php';
    require_once get_template_directory() . '/inc/cpt-sortable.php';
    require_once get_template_directory() . '/inc/admin-seo.php';
}

/* ── Maintenance mode handler ── */
function hdgavi_maintenance_redirect() {
    if ( ! hdgavi_opt( 'maintenance_mode', false ) ) return;
    if ( is_user_logged_in() && current_user_can( 'edit_pages' ) ) return;
    if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) return;
    if ( defined( 'DOING_CRON' ) && DOING_CRON ) return;
    // Allow sitemap and vcard through
    if ( get_query_var( 'hdgavi_sitemap' ) || get_query_var( 'hdgavi_vcard' ) ) return;

    require_once get_template_directory() . '/inc/maintenance.php';
    exit;
}
add_action( 'template_redirect', 'hdgavi_maintenance_redirect', 1 );

/* ── Maintenance toggle in admin bar ── */
function hdgavi_admin_bar_maintenance( $wp_admin_bar ) {
    if ( ! current_user_can( 'manage_options' ) ) return;
    $is_on = (bool) get_theme_mod( 'maintenance_mode', false );
    $wp_admin_bar->add_node( array(
        'id'    => 'hdgavi-maintenance-toggle',
        'title' => '<span class="hdgavi-maint-dot ' . ( $is_on ? 'on' : 'off' ) . '"></span>'
                  . ( $is_on ? 'Maintenance ON' : 'Site Live' ),
        'href'  => '#',
        'meta'  => array( 'class' => 'hdgavi-maint-bar-node' ),
    ) );
}
add_action( 'admin_bar_menu', 'hdgavi_admin_bar_maintenance', 100 );

function hdgavi_ajax_toggle_maintenance() {
    check_ajax_referer( 'hdgavi_maint_toggle', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) wp_send_json_error();
    $new_val = ! (bool) get_theme_mod( 'maintenance_mode', false );
    set_theme_mod( 'maintenance_mode', $new_val );
    wp_send_json_success( array( 'maintenance_mode' => $new_val ) );
}
add_action( 'wp_ajax_hdgavi_toggle_maintenance', 'hdgavi_ajax_toggle_maintenance' );

function hdgavi_admin_bar_maintenance_assets() {
    if ( ! current_user_can( 'manage_options' ) || ! is_admin_bar_showing() ) return;
    $nonce = wp_create_nonce( 'hdgavi_maint_toggle' );
    $ajax  = admin_url( 'admin-ajax.php' );
    ?>
    <style>
    .hdgavi-maint-dot{display:inline-block;width:9px;height:9px;border-radius:50%;margin-right:6px;vertical-align:middle}
    .hdgavi-maint-dot.on{background:#EF4444;box-shadow:0 0 6px rgba(239,68,68,0.5)}
    .hdgavi-maint-dot.off{background:#22C55E;box-shadow:0 0 6px rgba(34,197,94,0.4)}
    #wp-admin-bar-hdgavi-maintenance-toggle > .ab-item{cursor:pointer !important}
    #wp-admin-bar-hdgavi-maintenance-toggle.loading > .ab-item{opacity:0.5;pointer-events:none}
    </style>
    <script>
    document.addEventListener('DOMContentLoaded',function(){
        var node=document.getElementById('wp-admin-bar-hdgavi-maintenance-toggle');
        if(!node)return;
        node.addEventListener('click',function(e){
            e.preventDefault();
            if(node.classList.contains('loading'))return;
            node.classList.add('loading');
            var fd=new FormData();
            fd.append('action','hdgavi_toggle_maintenance');
            fd.append('nonce','<?php echo esc_js( $nonce ); ?>');
            fetch('<?php echo esc_url( $ajax ); ?>',{method:'POST',body:fd,credentials:'same-origin'})
                .then(function(r){return r.json();})
                .then(function(resp){
                    node.classList.remove('loading');
                    if(!resp.success)return;
                    var on=resp.data.maintenance_mode;
                    var dot=node.querySelector('.hdgavi-maint-dot');
                    var link=node.querySelector('.ab-item');
                    dot.className='hdgavi-maint-dot '+(on?'on':'off');
                    link.innerHTML=dot.outerHTML+(on?'Maintenance ON':'Site Live');
                })
                .catch(function(){node.classList.remove('loading');});
        });
    });
    </script>
    <?php
}
add_action( 'wp_head', 'hdgavi_admin_bar_maintenance_assets' );
add_action( 'admin_head', 'hdgavi_admin_bar_maintenance_assets' );

/* ═══════════════════════════════════════
   1. THEME SETUP
   ═══════════════════════════════════════ */
function hdgavi_setup() {
    load_theme_textdomain( 'hdgavi-portfolio', get_template_directory() . '/languages' );

    add_theme_support( 'title-tag' );
    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ) );
    add_theme_support( 'custom-logo' );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'responsive-embeds' );
    add_theme_support( 'align-wide' );
    add_editor_style( 'assets/css/editor-style.css' );

    register_nav_menus( array(
        'primary' => __( 'Menu principal', 'hdgavi-portfolio' ),
        'footer'  => __( 'Menu footer', 'hdgavi-portfolio' ),
    ) );
}
add_action( 'after_setup_theme', 'hdgavi_setup' );

/* ═══════════════════════════════════════
   2. ENQUEUE ASSETS
   ═══════════════════════════════════════ */

/**
 * Preload the two self-hosted font files used above the fold (IBM Plex Sans 400, IBM Plex Serif 500).
 */
function hdgavi_preload_fonts() {
    $base = get_template_directory_uri() . '/assets/fonts/';
    echo '<link rel="preload" href="' . esc_url( $base . 'ibm-plex-sans-latin-400-normal.woff2' ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="' . esc_url( $base . 'ibm-plex-serif-latin-500-normal.woff2' ) . '" as="font" type="font/woff2" crossorigin>' . "\n";
}
add_action( 'wp_head', 'hdgavi_preload_fonts', 1 );

/**
 * Override locale on front-end to match theme default language
 */
function hdgavi_override_locale( $locale ) {
    static $cached = null;
    if ( $cached !== null ) return $cached;
    if ( is_admin() || wp_doing_ajax() ) return $locale;
    $lang = hdgavi_opt( 'default_lang', 'en' );
    $map = array( 'fr' => 'fr_FR', 'es' => 'es_ES', 'en' => 'en_US' );
    $cached = isset( $map[ $lang ] ) ? $map[ $lang ] : 'en_US';
    return $cached;
}
add_filter( 'locale', 'hdgavi_override_locale' );

function hdgavi_enqueue() {
    // Use minified stylesheet if available, fallback to unminified
    $min_style = get_template_directory() . '/style.min.css';
    $style_path = file_exists( $min_style ) ? $min_style : get_template_directory() . '/style.css';
    $style_uri  = file_exists( $min_style )
        ? get_template_directory_uri() . '/style.min.css'
        : get_stylesheet_uri();
    $style_ver = filemtime( $style_path );
    wp_enqueue_style( 'hdgavi-style', $style_uri, array(), $style_ver );

    // Use minified JS if available
    $min_js = get_template_directory() . '/assets/js/theme.min.js';
    $js_path = file_exists( $min_js ) ? $min_js : get_template_directory() . '/assets/js/theme.js';
    $js_uri  = file_exists( $min_js )
        ? get_template_directory_uri() . '/assets/js/theme.min.js'
        : get_template_directory_uri() . '/assets/js/theme.js';
    $js_ver = filemtime( $js_path );
    wp_enqueue_script( 'hdgavi-theme', $js_uri, array(), $js_ver, true );

    // Localize script with all configurable data
    wp_localize_script( 'hdgavi-theme', 'hdgaviConfig', hdgavi_get_js_config() );

}
add_action( 'wp_enqueue_scripts', 'hdgavi_enqueue' );

/**
 * Add defer to the main theme script
 */
function hdgavi_script_attributes( $tag, $handle ) {
    // Defer main theme JS (already in footer, defer ensures non-blocking)
    if ( 'hdgavi-theme' === $handle ) {
        return str_replace( ' src', ' defer src', $tag );
    }
    return $tag;
}
add_filter( 'script_loader_tag', 'hdgavi_script_attributes', 10, 2 );

/**
 * Build JS config array from Customizer settings
 */
function hdgavi_get_js_config() {
    return array(
        'ajaxUrl'          => admin_url( 'admin-ajax.php' ),
        'contactNonce'     => wp_create_nonce( 'hdgavi_contact_nonce' ),
        'bookingNonce'     => wp_create_nonce( 'hdgavi_booking_nonce' ),
        'quoteNonce'       => wp_create_nonce( 'hdgavi_quote_nonce' ),
        'chatbotNonce'     => wp_create_nonce( 'hdgavi_chatbot_nonce' ),
        'swUrl'            => get_template_directory_uri() . '/sw.js',
        'defaultLang'      => hdgavi_opt( 'default_lang', 'en' ),
        // Copy email
        'copyEnabled'      => (bool) hdgavi_opt( 'copy_email_enabled', true ),
        'copiedTextEn'     => hdgavi_opt( 'copy_feedback_en', 'Copied' ),
        'copiedTextFr'     => hdgavi_opt( 'copy_feedback_fr', 'Copié' ),
        'copiedTextEs'     => hdgavi_opt( 'copy_feedback_es', 'Copiado' ),
        // GitHub repos
        'ghReposEnabled'   => false,
        'ghUsername'        => hdgavi_opt( 'contact_github_handle', '' ),
        'ghReposLimit'     => intval( hdgavi_opt( 'limit_github_repos', 6 ) ),
        // CV — never expose the raw PDF URL to the frontend
        'cvUrl'            => hdgavi_opt( 'cv_pdf_url', '' ) ? home_url( '?hdgavi_cv=download' ) : '',
        'cvPreviewUrl'     => hdgavi_opt( 'cv_pdf_url', '' ) ? home_url( '?hdgavi_cv=preview' ) : '',
        'cvDownloadNonce'  => wp_create_nonce( 'hdgavi_cv_download_nonce' ),
        // Terminal prompt
        'termPrompt'       => hdgavi_opt( 'term_page_prompt', '$' ),
        // Terminal page texts (all from Customizer, no hardcoded strings)
        'terminalPageTexts' => array(
            'en' => array(
                'welcome'            => hdgavi_opt( 'term_page_welcome_en', 'Welcome to HD GAVI terminal. Type "help" to get started.' ),
                'help'               => hdgavi_opt( 'term_page_help_en', 'Available commands: help, about, skills, experience, projects, education, contact, cv, clear, exit' ),
                'unknown_cmd'        => hdgavi_opt( 'term_page_unknown_en', 'Unknown command: {cmd}. Type "help".' ),
                'redirect_about'     => 'Redirecting to About...',
                'redirect_skills'    => 'Redirecting to Skills...',
                'redirect_experience'=> 'Redirecting to Experience...',
                'redirect_projects'  => 'Redirecting to Projects...',
                'redirect_education' => 'Redirecting to Education...',
                'redirect_contact'   => 'Redirecting to Contact...',
                'opening_cv'         => 'Opening CV...',
            ),
            'fr' => array(
                'welcome'            => hdgavi_opt( 'term_page_welcome_fr', 'Bienvenue dans le terminal HD GAVI. Tapez "help" pour commencer.' ),
                'help'               => hdgavi_opt( 'term_page_help_fr', 'Commandes disponibles : help, about, skills, experience, projects, education, contact, cv, clear, exit' ),
                'unknown_cmd'        => hdgavi_opt( 'term_page_unknown_fr', 'Commande inconnue : {cmd}. Tapez "help".' ),
                'redirect_about'     => 'Redirection vers Qui je suis...',
                'redirect_skills'    => 'Redirection vers Compétences...',
                'redirect_experience'=> 'Redirection vers Expérience...',
                'redirect_projects'  => 'Redirection vers Projets...',
                'redirect_education' => 'Redirection vers Formation...',
                'redirect_contact'   => 'Redirection vers Contact...',
                'opening_cv'         => 'Ouverture du CV...',
            ),
            'es' => array(
                'welcome'            => hdgavi_opt( 'term_page_welcome_es', 'Bienvenido al terminal HD GAVI. Escribe "help" para comenzar.' ),
                'help'               => hdgavi_opt( 'term_page_help_es', 'Comandos disponibles: help, about, skills, experience, projects, education, contact, cv, clear, exit' ),
                'unknown_cmd'        => hdgavi_opt( 'term_page_unknown_es', 'Comando desconocido: {cmd}. Escribe "help".' ),
                'redirect_about'     => 'Redirigiendo a Sobre mí...',
                'redirect_skills'    => 'Redirigiendo a Habilidades...',
                'redirect_experience'=> 'Redirigiendo a Experiencia...',
                'redirect_projects'  => 'Redirigiendo a Proyectos...',
                'redirect_education' => 'Redirigiendo a Formación...',
                'redirect_contact'   => 'Redirigiendo a Contacto...',
                'opening_cv'         => 'Abriendo CV...',
            ),
        ),
        // i18n strings
        'i18n' => array(
            'en' => array(
                'sending'    => 'Sending...',
                'sent'       => 'Message sent!',
                'sendError'  => 'Error sending. Please try again.',
                'validation' => 'Please fill in all fields correctly.',
                'cvSending'  => 'Sending...',
                'cvError'    => 'Error. Please try again.',
            ),
            'fr' => array(
                'sending'    => 'Envoi...',
                'sent'       => 'Message envoyé !',
                'sendError'  => 'Erreur lors de l\'envoi. Réessayez.',
                'validation' => 'Veuillez remplir tous les champs correctement.',
                'cvSending'  => 'Envoi...',
                'cvError'    => 'Erreur. Veuillez réessayer.',
            ),
            'es' => array(
                'sending'    => 'Enviando...',
                'sent'       => '¡Mensaje enviado!',
                'sendError'  => 'Error al enviar. Inténtelo de nuevo.',
                'validation' => 'Por favor complete todos los campos correctamente.',
                'cvSending'  => 'Enviando...',
                'cvError'    => 'Error. Inténtelo de nuevo.',
            ),
        ),
    );
}

/* ═══════════════════════════════════════
   3. HELPER: get option (filterable)
   ═══════════════════════════════════════ */
function hdgavi_opt( $key, $default = '' ) {
    return apply_filters( 'hdgavi_opt_' . $key, get_theme_mod( $key, $default ) );
}

/* ═══════════════════════════════════════
   4. LOGO HELPERS
   ═══════════════════════════════════════ */
function hdgavi_get_monogram() {
    $custom = hdgavi_opt( 'logo_monogram', 'HD' );
    if ( ! empty( $custom ) ) return $custom;
    return 'HD';
}

function hdgavi_get_logo_text() {
    $custom = hdgavi_opt( 'logo_text' );
    if ( ! empty( $custom ) ) return $custom;
    return 'GAVI';
}

/* ═══════════════════════════════════════
   5. REGISTER CUSTOM PAGE TEMPLATES
   ═══════════════════════════════════════ */
function hdgavi_page_templates( $templates ) {
    $templates['page-templates/splash.php']     = __( 'Home / Accueil (CV)', 'hdgavi-portfolio' );
    $templates['page-templates/about.php']      = __( 'About / Qui je suis', 'hdgavi-portfolio' );
    $templates['page-templates/skills.php']     = __( 'Skills / Compétences', 'hdgavi-portfolio' );
    $templates['page-templates/experience.php'] = __( 'Experience / Expérience', 'hdgavi-portfolio' );
    $templates['page-templates/projects.php']   = __( 'Projects / Projets', 'hdgavi-portfolio' );
    $templates['page-templates/education.php']  = __( 'Education / Formation', 'hdgavi-portfolio' );
    $templates['page-templates/contact.php']    = __( 'Contact', 'hdgavi-portfolio' );
    $templates['page-templates/terminal.php']   = __( 'Terminal (Hidden)', 'hdgavi-portfolio' );
    $templates['page-templates/watch.php']      = __( 'Veille Tech / Tech Watch', 'hdgavi-portfolio' );
    $templates['page-templates/newsletter.php'] = __( 'Newsletter', 'hdgavi-portfolio' );
    $templates['page-templates/blog.php']       = __( 'Blog / Articles', 'hdgavi-portfolio' );
    $templates['page-templates/certifications.php'] = __( 'Certifications', 'hdgavi-portfolio' );
    $templates['page-templates/timeline.php']       = __( 'Timeline / Parcours', 'hdgavi-portfolio' );
    $templates['page-templates/stack.php']          = __( 'Stack Technique / Tech Stack', 'hdgavi-portfolio' );
    $templates['page-templates/testimonials.php']   = __( 'Témoignages / Testimonials', 'hdgavi-portfolio' );
    $templates['page-templates/presentation.php']   = __( 'Présentation / Slides', 'hdgavi-portfolio' );
    $templates['page-templates/uses.php']           = __( 'Uses / Mon Setup', 'hdgavi-portfolio' );
    $templates['page-templates/roadmap.php']        = __( 'Roadmap / Objectifs', 'hdgavi-portfolio' );
    $templates['page-templates/availability.php']   = __( 'Disponibilité / Availability', 'hdgavi-portfolio' );
    $templates['page-templates/legal.php']          = __( 'Mentions Légales / Legal', 'hdgavi-portfolio' );
    return $templates;
}
add_filter( 'theme_page_templates', 'hdgavi_page_templates' );

/* ═══════════════════════════════════════
   6. SANITIZATION HELPERS
   ═══════════════════════════════════════ */
function hdgavi_sanitize_bool( $val ) { return (bool) $val; }
function hdgavi_sanitize_number( $val ) { $n = floatval( $val ); return $n >= 0 ? $n : 0; }

/* ═══════════════════════════════════════
   7. PERFORMANCE: LAZY LOADING & IMAGE OPTIMIZATION
   ═══════════════════════════════════════ */

/**
 * Auto-add loading="lazy" and decoding="async" to content images
 * Skips images that already have loading or fetchpriority attributes
 */
function hdgavi_lazy_content_images( $content ) {
    if ( is_admin() || empty( $content ) ) return $content;
    return preg_replace_callback( '/<img\b([^>]*)>/i', 'hdgavi_lazy_img_callback', $content );
}
function hdgavi_lazy_img_callback( $matches ) {
    $attrs = $matches[1];
    // Skip if already has loading, fetchpriority, or data-no-lazy
    if ( preg_match( '/\b(loading|fetchpriority|data-no-lazy)\s*=/i', $attrs ) ) {
        return $matches[0];
    }
    return '<img' . $attrs . ' loading="lazy" decoding="async">';
}
add_filter( 'the_content', 'hdgavi_lazy_content_images', 99 );
add_filter( 'post_thumbnail_html', 'hdgavi_lazy_content_images', 99 );

/**
 * Remove WordPress default emoji scripts (perf gain ~15KB)
 */
function hdgavi_disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
}
add_action( 'init', 'hdgavi_disable_emojis' );

/* ═══════════════════════════════════════
   8. ADMIN: PAGE SETUP WIZARD
   ═══════════════════════════════════════ */
require_once get_template_directory() . '/inc/admin-page-setup.php';
