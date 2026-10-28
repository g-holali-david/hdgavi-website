<?php
/**
 * HD GAVI Portfolio — functions.php v6.2.1
 * Complete refactor: multi-page, bilingual EN/FR, dark mode default
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
define( 'HDGAVI_VERSION', '6.3.0' );

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
 * Preconnect + preload critical fonts for performance
 */
function hdgavi_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    // Preload critical font files (DM Sans 400 + Outfit 700 — above-fold typography)
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/dmsans/v15/rP2tp2ywxg089UriI5-g4vlH9VoD8CmcqZG40F9JadbnoEwA.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
    echo '<link rel="preload" href="https://fonts.gstatic.com/s/outfit/v11/QGYyz_MVcBeNP4NjuGObqx1XmO1I4TC1C4G-EiAou6Y.woff2" as="font" type="font/woff2" crossorigin>' . "\n";
}
add_action( 'wp_head', 'hdgavi_preconnect', 1 );

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
    // Fonts — loaded async via preload/swap (non-blocking)
    wp_enqueue_style( 'hdgavi-google-fonts',
        'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600&family=Outfit:wght@500;600;700&family=JetBrains+Mono:wght@400;500&display=swap',
        array(), null
    );

    // Use minified stylesheet if available, fallback to unminified
    $min_style = get_template_directory() . '/style.min.css';
    $style_path = file_exists( $min_style ) ? $min_style : get_template_directory() . '/style.css';
    $style_uri  = file_exists( $min_style )
        ? get_template_directory_uri() . '/style.min.css'
        : get_stylesheet_uri();
    $style_ver = filemtime( $style_path );
    wp_enqueue_style( 'hdgavi-style', $style_uri, array( 'hdgavi-google-fonts' ), $style_ver );

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

    // Design controls — inject as CSS custom properties
    hdgavi_design_inline_css();
}
add_action( 'wp_enqueue_scripts', 'hdgavi_enqueue' );

/**
 * Inline critical CSS in <head> for fast first paint
 * Critical CSS = reset + variables + navbar + splash + layout + page-transition + animations
 */
function hdgavi_critical_css() {
    $critical_path = get_template_directory() . '/assets/css/critical.min.css';
    if ( ! file_exists( $critical_path ) ) return;
    echo '<style id="hdgavi-critical">' . "\n";
    // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- CSS from theme file, not user input
    echo file_get_contents( $critical_path );
    echo "\n</style>\n";
}
add_action( 'wp_head', 'hdgavi_critical_css', 2 );

/**
 * Add defer to main theme script and async to Google Fonts CSS
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
 * Add media="print" + onload swap for non-critical Google Fonts stylesheet
 * This makes the font CSS non-render-blocking
 */
function hdgavi_style_attributes( $tag, $handle ) {
    if ( 'hdgavi-google-fonts' === $handle ) {
        // Load fonts async: media=print swap to all on load
        $tag = str_replace(
            "media='all'",
            "media='print' onload=\"this.media='all'\"",
            $tag
        );
        // Add noscript fallback
        $noscript = str_replace( "media='print' onload=\"this.media='all'\"", "media='all'", $tag );
        $tag .= '<noscript>' . $noscript . '</noscript>';
    }
    return $tag;
}
add_filter( 'style_loader_tag', 'hdgavi_style_attributes', 10, 2 );

/**
 * Inject design controls (accent colors, border-radius, section padding) as CSS variables
 */
function hdgavi_design_inline_css() {
    $accent  = hdgavi_opt( 'design_accent_color', '#06B6D4' );
    $accent2 = hdgavi_opt( 'design_accent2_color', '#005386' );
    $radius  = intval( hdgavi_opt( 'design_border_radius', 12 ) );
    $padding = intval( hdgavi_opt( 'design_section_padding', 100 ) );

    // Validate hex colors to prevent CSS injection
    if ( ! preg_match( '/^#[0-9a-fA-F]{3,6}$/', $accent ) )  $accent  = '#06B6D4';
    if ( ! preg_match( '/^#[0-9a-fA-F]{3,6}$/', $accent2 ) ) $accent2 = '#005386';

    // Convert hex to rgba for background tints
    $accent_rgb  = hdgavi_hex_to_rgb( $accent );
    $accent2_rgb = hdgavi_hex_to_rgb( $accent2 );

    // Lighten accent for dark mode text readability
    $accent2_light = hdgavi_lighten_hex( $accent2, 40 );

    $css = ':root{';
    if ( $accent !== '#06B6D4' ) {
        $css .= '--accent:' . $accent . ';';
        $css .= '--accent-hover:' . hdgavi_darken_hex( $accent, 10 ) . ';';
        $css .= '--accent-bg:rgba(' . $accent_rgb . ',0.1);';
    }
    if ( $accent2 !== '#005386' ) {
        $css .= '--accent2:' . $accent2_light . ';';
        $css .= '--accent2-bg:rgba(' . $accent2_rgb . ',0.12);';
    }
    if ( $radius !== 12 ) {
        $css .= '--radius:' . $radius . 'px;';
    }
    if ( $padding !== 100 ) {
        $css .= '--section-padding:' . $padding . 'px;';
    }

    // Avatar size
    $avatar = intval( hdgavi_opt( 'design_avatar_size', 96 ) );
    if ( $avatar !== 96 ) {
        $css .= '--splash-avatar-size:' . $avatar . 'px;';
    }

    // Navbar height
    $nav_h = intval( hdgavi_opt( 'design_navbar_height', 72 ) );
    if ( $nav_h !== 72 ) {
        $css .= '--nav-height:' . $nav_h . 'px;';
    }

    $css .= '}';

    // Light mode accent2 override (pure color, no lighten needed)
    if ( $accent2 !== '#005386' ) {
        $css .= 'body.light-mode{--accent2:' . $accent2 . ';--accent2-bg:rgba(' . $accent2_rgb . ',0.08);}';
    }

    // Apply border-radius globally if changed
    if ( $radius !== 12 ) {
        $css .= '.skill-card,.project-card,.stat-card,.trait-card,.education-card,.contact-info-item,.repo-card,.selflearn-tag,.splash-terminal,.email-frame,.konami-toast,.form-group input,.form-group textarea,.btn-primary,.btn-ghost,.btn-submit,.btn-cv{border-radius:' . $radius . 'px}';
    }

    // Dynamic mobile breakpoint for menu
    $bp = intval( hdgavi_opt( 'design_mobile_breakpoint', 960 ) );
    if ( $bp !== 960 ) {
        // Override the default 960px breakpoint with user-configured value
        $css .= '@media(min-width:' . ( $bp + 1 ) . 'px){.nav-burger,.nav-mobile-close,.nav-mobile-socials,.nav-overlay{display:none !important}.nav-links{position:static;width:auto;height:auto;flex-direction:row;transform:none;padding:0;background:none;border:none;box-shadow:none;gap:4px}}';
        $css .= '@media(max-width:' . $bp . 'px){.nav-burger{display:flex}.nav-links{position:fixed;top:0;left:0;right:0;bottom:0;width:100%;height:100%;flex-direction:column;align-items:center;justify-content:center;gap:8px;background:var(--bg);padding:24px;transform:translateX(100%);transition:transform .4s cubic-bezier(0.4,0,0.2,1);overflow-y:auto;z-index:10001}.nav-links.open{transform:translateX(0)}.nav-mobile-close{display:flex}.nav-mobile-socials{display:flex}.nav-actions .icon-btn,.nav-actions .btn-cv,.rqth-badge{display:none !important}}';
    }

    if ( $css !== ':root{}' ) {
        wp_add_inline_style( 'hdgavi-style', $css );
    }
}

/**
 * Convert hex to "r,g,b" string for rgba()
 */
function hdgavi_hex_to_rgb( $hex ) {
    $hex = ltrim( $hex, '#' );
    if ( strlen( $hex ) === 3 ) {
        $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
    }
    return intval( substr( $hex, 0, 2 ), 16 ) . ',' . intval( substr( $hex, 2, 2 ), 16 ) . ',' . intval( substr( $hex, 4, 2 ), 16 );
}

/**
 * Darken a hex color by a percentage
 */
function hdgavi_darken_hex( $hex, $percent ) {
    $hex = ltrim( $hex, '#' );
    $r = max( 0, intval( substr( $hex, 0, 2 ), 16 ) - ( 255 * $percent / 100 ) );
    $g = max( 0, intval( substr( $hex, 2, 2 ), 16 ) - ( 255 * $percent / 100 ) );
    $b = max( 0, intval( substr( $hex, 4, 2 ), 16 ) - ( 255 * $percent / 100 ) );
    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}

/**
 * Lighten a hex color by a percentage
 */
function hdgavi_lighten_hex( $hex, $percent ) {
    $hex = ltrim( $hex, '#' );
    $r = min( 255, intval( substr( $hex, 0, 2 ), 16 ) + ( 255 * $percent / 100 ) );
    $g = min( 255, intval( substr( $hex, 2, 2 ), 16 ) + ( 255 * $percent / 100 ) );
    $b = min( 255, intval( substr( $hex, 4, 2 ), 16 ) + ( 255 * $percent / 100 ) );
    return sprintf( '#%02x%02x%02x', $r, $g, $b );
}

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
        // Effects toggles
        'particlesEnabled' => (bool) hdgavi_opt( 'fx_particles', true ),
        'particlesColor'   => hdgavi_opt( 'fx_particles_color', 'rgba(6,182,212,0.3)' ),
        'particlesSpeed'   => floatval( hdgavi_opt( 'fx_particles_speed', 1 ) ),
        'particlesDensity' => intval( hdgavi_opt( 'fx_particles_density', 50 ) ),
        'counterEnabled'   => (bool) hdgavi_opt( 'fx_counter', true ),
        'progressEnabled'  => (bool) hdgavi_opt( 'fx_progress_bar', true ),
        'progressColor'    => hdgavi_opt( 'fx_progress_color', '' ),
        // Terminal splash
        'terminalEnabled'  => (bool) hdgavi_opt( 'terminal_enabled', true ),
        'terminalSpeed'    => intval( hdgavi_opt( 'design_terminal_speed', 40 ) ),
        'terminalLines'    => hdgavi_get_terminal_lines(),
        // Easter egg
        'konamiEnabled'    => (bool) hdgavi_opt( 'konami_enabled', true ),
        'konamiMsgEn'      => hdgavi_opt( 'konami_msg_en', "🎮 You know the Konami code? We're going to get along." ),
        'konamiMsgFr'      => hdgavi_opt( 'konami_msg_fr', '🎮 Tu connais le Konami code ? On va bien s\'entendre.' ),
        'konamiMsgEs'      => hdgavi_opt( 'konami_msg_es', '🎮 ¿Conoces el código Konami? Nos vamos a llevar bien.' ),
        // Copy email
        'copyEnabled'      => (bool) hdgavi_opt( 'copy_email_enabled', true ),
        'copiedTextEn'     => hdgavi_opt( 'copy_feedback_en', 'Copied!' ),
        'copiedTextFr'     => hdgavi_opt( 'copy_feedback_fr', 'Copié !' ),
        'copiedTextEs'     => hdgavi_opt( 'copy_feedback_es', '¡Copiado!' ),
        // GitHub repos
        'ghReposEnabled'   => (bool) hdgavi_opt( 'gh_repos_enabled', true ),
        'ghUsername'        => hdgavi_opt( 'contact_github_handle', '' ),
        'ghReposLimit'     => intval( hdgavi_opt( 'limit_github_repos', 6 ) ),
        // Lot 7: Effects
        'customCursorEnabled' => (bool) hdgavi_opt( 'fx_custom_cursor', false ),
        'parallaxEnabled'     => (bool) hdgavi_opt( 'fx_parallax', true ),
        'grainEnabled'        => (bool) hdgavi_opt( 'fx_grain', true ),
        // CV — never expose the raw PDF URL to the frontend
        'cvUrl'            => hdgavi_opt( 'cv_pdf_url', '' ) ? home_url( '?hdgavi_cv=download' ) : '',
        'cvPreviewUrl'     => hdgavi_opt( 'cv_pdf_url', '' ) ? home_url( '?hdgavi_cv=preview' ) : '',
        'cvDownloadNonce'  => wp_create_nonce( 'hdgavi_cv_download_nonce' ),
        // Terminal prompt
        'termPrompt'       => hdgavi_opt( 'term_page_prompt', 'visitor@hdgavi:~$' ),
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

/**
 * Get terminal animation lines from Customizer
 */
function hdgavi_get_terminal_lines() {
    $default_en = json_encode( array(
        array( 'cmd' => '$ whoami', 'out' => 'Holali David GAVI — Cloud & DevOps Engineer' ),
        array( 'cmd' => '$ kubectl get skills', 'out' => 'Docker ✓  Kubernetes ✓  Helm ✓  Java ✓' ),
        array( 'cmd' => '$ cat motivation.txt', 'out' => 'Curious. Persistent. Passionate about code.' ),
    ) );
    $default_fr = json_encode( array(
        array( 'cmd' => '$ whoami', 'out' => 'Holali David GAVI — Ingénieur Cloud & DevOps' ),
        array( 'cmd' => '$ kubectl get skills', 'out' => 'Docker ✓  Kubernetes ✓  Helm ✓  Java ✓' ),
        array( 'cmd' => '$ cat motivation.txt', 'out' => 'Curieux. Persévérant. Passionné par le code.' ),
    ) );
    $default_es = json_encode( array(
        array( 'cmd' => '$ whoami', 'out' => 'Holali David GAVI — Ingeniero Cloud & DevOps' ),
        array( 'cmd' => '$ kubectl get skills', 'out' => 'Docker ✓  Kubernetes ✓  Helm ✓  Java ✓' ),
        array( 'cmd' => '$ cat motivación.txt', 'out' => 'Curioso. Persistente. Apasionado por el código.' ),
    ) );
    $en = json_decode( hdgavi_opt( 'terminal_lines_en', $default_en ), true );
    $fr = json_decode( hdgavi_opt( 'terminal_lines_fr', $default_fr ), true );
    $es = json_decode( hdgavi_opt( 'terminal_lines_es', $default_es ), true );
    return array(
        'en' => ! empty( $en ) ? $en : json_decode( $default_en, true ),
        'fr' => ! empty( $fr ) ? $fr : json_decode( $default_fr, true ),
        'es' => ! empty( $es ) ? $es : json_decode( $default_es, true ),
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
    $templates['page-templates/splash.php']     = __( 'Splash Page', 'hdgavi-portfolio' );
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

/**
 * Add dns-prefetch for external resources
 */
function hdgavi_dns_prefetch( $urls, $relation_type ) {
    if ( 'dns-prefetch' === $relation_type ) {
        $urls[] = '//fonts.googleapis.com';
        $urls[] = '//fonts.gstatic.com';
        $urls[] = '//api.github.com';
    }
    return $urls;
}
add_filter( 'wp_resource_hints', 'hdgavi_dns_prefetch', 10, 2 );

/* ═══════════════════════════════════════
   8. ADMIN: PAGE SETUP WIZARD
   ═══════════════════════════════════════ */
require_once get_template_directory() . '/inc/admin-page-setup.php';
