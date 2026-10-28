<?php
/**
 * HD GAVI Portfolio — Customizer: Visibility Toggles, Limits & Design Controls
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_toggles( $wp_customize ) {
    $panel = 'hdgavi_panel';

    /* ═══════════════════════════════════════
       SECTION 19: Visibility Toggles (on/off)
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_toggles', array(
        'title'       => __( '19. Affichage (on/off)', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 190,
        'description' => __( 'Activer ou désactiver des éléments sur le site.', 'hdgavi-portfolio' ),
    ) );

    $toggles = array(
        // Photos
        'show_photo_navbar'      => __( 'Photo — Navbar', 'hdgavi-portfolio' ),
        'show_photo_splash'      => __( 'Photo — Splash page', 'hdgavi-portfolio' ),
        'show_photo_footer'      => __( 'Photo — Footer', 'hdgavi-portfolio' ),
        'show_photo_about'       => __( 'Photo — Page About', 'hdgavi-portfolio' ),

        // Navigation & Branding
        'show_nav_cv'            => __( 'Nav — Bouton CV', 'hdgavi-portfolio' ),
        'show_nav_github'        => __( 'Nav — Icône GitHub', 'hdgavi-portfolio' ),
        'show_nav_linkedin'      => __( 'Nav — Icône LinkedIn', 'hdgavi-portfolio' ),
        'show_nav_monogram'      => __( 'Nav — Monogramme HD (si photo off)', 'hdgavi-portfolio' ),
        'show_nav_logo_text'     => __( 'Nav — Texte logo "GAVI"', 'hdgavi-portfolio' ),
        'show_splash_socials'    => __( 'Splash — Socials', 'hdgavi-portfolio' ),
        'show_splash_cv'         => __( 'Splash — Bouton CV', 'hdgavi-portfolio' ),
        'show_proj_view_link'    => __( 'Projets — Lien "View project"', 'hdgavi-portfolio' ),

        // Content sections
        'show_about_text'        => __( 'About — Texte personnalité', 'hdgavi-portfolio' ),
        'show_about_quote'       => __( 'About — Citation', 'hdgavi-portfolio' ),
        'show_about_stats'       => __( 'About — Stats (chiffres)', 'hdgavi-portfolio' ),
        'show_about_traits'      => __( 'About — Traits sidebar', 'hdgavi-portfolio' ),
        'show_edu_selflearn'     => __( 'Education — Section autoformation', 'hdgavi-portfolio' ),
        'show_page_descriptions' => __( 'Toutes pages — Descriptions sous les titres', 'hdgavi-portfolio' ),

        // Full sections
        'show_navbar'            => __( 'Barre de navigation (off = mode landing)', 'hdgavi-portfolio' ),
        'show_footer'            => __( 'Footer complet (off = mode minimal)', 'hdgavi-portfolio' ),

        // Footer
        'show_footer_email'      => __( 'Footer — Email + copier', 'hdgavi-portfolio' ),
        'show_footer_socials'    => __( 'Footer — Liens sociaux', 'hdgavi-portfolio' ),

        // Stats & Technical
        'stats_enabled'          => __( 'Stats visiteurs (tracking anonyme)', 'hdgavi-portfolio' ),
        'stats_show_counter'     => __( 'Stats — Afficher compteur dans le footer', 'hdgavi-portfolio' ),
        'show_qr_code'           => __( 'Contact — QR Code', 'hdgavi-portfolio' ),
        'show_vcard'             => __( 'Contact — Bouton vCard', 'hdgavi-portfolio' ),
        'chatbot_enabled'        => __( 'Chatbot IA (nécessite clé API)', 'hdgavi-portfolio' ),

        // Maintenance
        'maintenance_mode'       => __( '🚧 Mode maintenance (redirige les visiteurs)', 'hdgavi-portfolio' ),

        // RSS
        'rss_enabled'            => __( '📡 Import RSS veille tech (toutes les 6h)', 'hdgavi-portfolio' ),
    );

    foreach ( $toggles as $key => $label ) {
        $default = in_array( $key, array( 'stats_show_counter', 'chatbot_enabled', 'maintenance_mode', 'rss_enabled' ), true ) ? false : true;
        $wp_customize->add_setting( $key, array( 'default' => $default, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
        $wp_customize->add_control( $key, array(
            'label'   => $label,
            'section' => 'hdgavi_toggles',
            'type'    => 'checkbox',
        ) );
    }

    /* ═══════════════════════════════════════
       SECTION 20: Content Limits (sliders)
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_limits', array(
        'title'       => __( '20. Limites de contenu', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 200,
        'description' => __( 'Combien d\'éléments afficher par section.', 'hdgavi-portfolio' ),
    ) );

    $limits = array(
        'limit_github_repos' => array( __( 'Repos GitHub affichés', 'hdgavi-portfolio' ), 6, 1, 12 ),
        'limit_projects'     => array( __( 'Projets max visibles', 'hdgavi-portfolio' ), 8, 1, 8 ),
        'limit_traits'       => array( __( 'Traits max visibles', 'hdgavi-portfolio' ), 7, 1, 7 ),
        'limit_experiences'  => array( __( 'Expériences visibles', 'hdgavi-portfolio' ), 5, 1, 5 ),
        'limit_watch'        => array( __( 'Articles Tech Watch affichés', 'hdgavi-portfolio' ), 30, 6, 100 ),
        'limit_blog'         => array( __( 'Articles Blog affichés', 'hdgavi-portfolio' ), 12, 3, 50 ),
        'rss_max_per_feed'   => array( __( 'Articles RSS par feed (par import)', 'hdgavi-portfolio' ), 5, 1, 20 ),
    );

    foreach ( $limits as $key => $meta ) {
        $wp_customize->add_setting( $key, array( 'default' => $meta[1], 'sanitize_callback' => 'absint' ) );
        $wp_customize->add_control( $key, array(
            'label'       => $meta[0],
            'section'     => 'hdgavi_limits',
            'type'        => 'number',
            'input_attrs' => array( 'min' => $meta[2], 'max' => $meta[3], 'step' => 1 ),
        ) );
    }

    // RSS feeds textarea
    $rss_default_feeds = implode( "\n", function_exists( 'hdgavi_rss_default_feeds' ) ? hdgavi_rss_default_feeds() : array() );
    $wp_customize->add_setting( 'rss_feeds', array(
        'default'           => $rss_default_feeds,
        'sanitize_callback' => 'sanitize_textarea_field',
    ) );
    $wp_customize->add_control( 'rss_feeds', array(
        'label'       => __( 'Flux RSS (une URL par ligne)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_limits',
        'type'        => 'textarea',
        'input_attrs' => array( 'rows' => 8 ),
    ) );

    /* ═══════════════════════════════════════
       SECTION 21: Design Controls
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_design', array(
        'title'       => __( '21. Design (couleurs, arrondis, espacement)', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 210,
        'description' => __( 'Personnaliser les couleurs d\'accent, les arrondis et l\'espacement.', 'hdgavi-portfolio' ),
    ) );

    // Color pickers
    $wp_customize->add_setting( 'design_accent_color', array( 'default' => '#06B6D4', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'design_accent_color', array(
        'label'   => __( 'Couleur accent principal', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_design',
    ) ) );

    $wp_customize->add_setting( 'design_accent2_color', array( 'default' => '#005386', 'sanitize_callback' => 'sanitize_hex_color' ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'design_accent2_color', array(
        'label'   => __( 'Couleur accent secondaire (Dassault Blue)', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_design',
    ) ) );

    // Border radius slider
    $wp_customize->add_setting( 'design_border_radius', array( 'default' => 12, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'design_border_radius', array(
        'label'       => __( 'Arrondi global (px)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_design',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 0, 'max' => 16, 'step' => 1 ),
    ) );

    // Section padding slider
    $wp_customize->add_setting( 'design_section_padding', array( 'default' => 100, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'design_section_padding', array(
        'label'       => __( 'Espacement sections (px)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_design',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 60, 'max' => 120, 'step' => 5 ),
    ) );

    // Splash avatar size
    $wp_customize->add_setting( 'design_avatar_size', array( 'default' => 96, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'design_avatar_size', array(
        'label'       => __( 'Taille avatar splash (px)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_design',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 48, 'max' => 160, 'step' => 4 ),
    ) );

    // Navbar height
    $wp_customize->add_setting( 'design_navbar_height', array( 'default' => 72, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'design_navbar_height', array(
        'label'       => __( 'Hauteur navbar (px)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_design',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 48, 'max' => 96, 'step' => 4 ),
    ) );

    // Terminal typing speed
    $wp_customize->add_setting( 'design_terminal_speed', array( 'default' => 40, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'design_terminal_speed', array(
        'label'       => __( 'Vitesse frappe terminal (ms)', 'hdgavi-portfolio' ),
        'description' => __( 'Plus bas = plus rapide. 20 = rapide, 40 = normal, 80 = lent.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_design',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 10, 'max' => 100, 'step' => 5 ),
    ) );

    // Mobile menu breakpoint
    $wp_customize->add_setting( 'design_mobile_breakpoint', array( 'default' => 960, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'design_mobile_breakpoint', array(
        'label'       => __( 'Breakpoint menu mobile (px)', 'hdgavi-portfolio' ),
        'description' => __( 'Largeur en dessous de laquelle le menu hamburger apparaît.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_design',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 640, 'max' => 1200, 'step' => 20 ),
    ) );

    /* ═══════════════════════════════════════
       SECTION 22: Chatbot & Contact Tools
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_contact_tools', array(
        'title'       => __( '22. Chatbot & Outils Contact', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 215,
    ) );

    // Chatbot API key
    $wp_customize->add_setting( 'chatbot_api_key', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'chatbot_api_key', array(
        'label'       => __( 'Chatbot — Clé API Anthropic', 'hdgavi-portfolio' ),
        'description' => __( 'Nécessaire pour le chatbot IA. Laissez vide pour désactiver.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact_tools',
        'type'        => 'password',
    ) );

    // Chatbot texts
    $chatbot_fields = array(
        'chatbot_title_en'       => array( 'Chatbot — Titre EN', 'Ask me anything' ),
        'chatbot_title_fr'       => array( 'Chatbot — Titre FR', 'Posez-moi une question' ),
        'chatbot_welcome_en'     => array( 'Chatbot — Bienvenue EN', 'Hi! I can answer questions about Holali\'s skills, experience and projects.' ),
        'chatbot_welcome_fr'     => array( 'Chatbot — Bienvenue FR', 'Salut ! Je peux répondre à vos questions sur les compétences et projets de Holali.' ),
        'chatbot_placeholder_en' => array( 'Chatbot — Placeholder EN', 'Type a question...' ),
    );
    foreach ( $chatbot_fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_contact_tools' ) );
    }

    // QR Code settings
    $wp_customize->add_setting( 'qr_code_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'qr_code_url', array(
        'label'       => __( 'QR Code — URL (vide = URL du site)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact_tools',
    ) );

    $wp_customize->add_setting( 'qr_code_size', array( 'default' => 180, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'qr_code_size', array(
        'label'       => __( 'QR Code — Taille (px)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact_tools',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 100, 'max' => 400, 'step' => 10 ),
    ) );

    // Phone number (for vCard)
    $wp_customize->add_setting( 'contact_phone', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'contact_phone', array(
        'label'       => __( 'Téléphone (optionnel, pour vCard)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact_tools',
    ) );

    /* ═══════════════════════════════════════
       MAINTENANCE PAGE — Dedicated section
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_maintenance', array(
        'title'       => __( '🚧 Maintenance Page', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 200,
        'description' => __( 'Customize all content shown on the maintenance page when maintenance mode is ON.', 'hdgavi-portfolio' ),
    ) );

    // ── Banner texts (trilingue) ──
    $maint_texts = array(
        'maintenance_title_en' => array( 'Banner Title (EN)', 'Site under maintenance' ),
        'maintenance_title_fr' => array( 'Banner Title (FR)', 'Site sous maintenance' ),
        'maintenance_title_es' => array( 'Banner Title (ES)', 'Sitio en mantenimiento' ),
        'maintenance_desc_en'  => array( 'Banner Message (EN)', 'Come back soon!' ),
        'maintenance_desc_fr'  => array( 'Banner Message (FR)', 'Revenez bientôt !' ),
        'maintenance_desc_es'  => array( 'Banner Message (ES)', '¡Vuelve pronto!' ),
        'maintenance_icon'     => array( 'Banner Icon (emoji)', '🚧' ),
    );
    foreach ( $maint_texts as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_maintenance' ) );
    }

    // ── Identity overrides (optional — falls back to general settings) ──
    $wp_customize->add_setting( 'maintenance_role_en', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'maintenance_role_en', array( 'label' => 'Role / Title (EN) — leave empty to use SEO Job Title', 'section' => 'hdgavi_maintenance' ) );
    $wp_customize->add_setting( 'maintenance_role_fr', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'maintenance_role_fr', array( 'label' => 'Role / Title (FR)', 'section' => 'hdgavi_maintenance' ) );
    $wp_customize->add_setting( 'maintenance_role_es', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'maintenance_role_es', array( 'label' => 'Role / Title (ES)', 'section' => 'hdgavi_maintenance' ) );

    $wp_customize->add_setting( 'maintenance_company', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'maintenance_company', array( 'label' => 'Company — leave empty to use SEO Company', 'section' => 'hdgavi_maintenance' ) );

    // ── Show/hide toggles for each section ──
    $maint_toggles = array(
        'maint_show_banner'  => array( 'Show banner (title + message)', true ),
        'maint_show_photo'   => array( 'Show profile photo', true ),
        'maint_show_role'    => array( 'Show role & company', true ),
        'maint_show_info'    => array( 'Show info grid (role, company, location, phone)', true ),
        'maint_show_skills'  => array( 'Show skills tags', true ),
        'maint_show_github'  => array( 'Show GitHub link', true ),
        'maint_show_linkedin' => array( 'Show LinkedIn link', true ),
        'maint_show_email'   => array( 'Show Email link', true ),
        'maint_show_cv'      => array( 'Show CV download button', true ),
        'maint_show_form'    => array( 'Show contact form', true ),
        'maint_show_particles' => array( 'Show particle animation', true ),
        'maint_show_lang'    => array( 'Show language toggle', true ),
    );
    foreach ( $maint_toggles as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_maintenance', 'type' => 'checkbox' ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_toggles' );
