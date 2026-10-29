<?php
/**
 * HD GAVI Portfolio — Customizer: display toggles, content limits, assistant / QR code / phone,
 * maintenance page
 *
 * 7.0.0: the "Design" section (accent colours, radius, section padding, avatar size, navbar
 * height, typing speed, mobile breakpoint) was removed: the design system lives in style.css.
 * Toggles and limits that nothing reads any more were removed as well (old About blocks, splash
 * socials, footer columns, traits, experience and project limits).
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_toggles( $wp_customize ) {
    $panel = 'hdgavi_panel';

    /* ═══════════════════════════════════════
       SECTION: Display toggles
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_toggles', array(
        'title'       => __( 'Affichage', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 190,
        'description' => __( 'Afficher ou masquer des éléments du site.', 'hdgavi-portfolio' ),
    ) );

    // id => array( label, default )
    $toggles = array(
        'show_navbar'            => array( __( 'Barre de navigation', 'hdgavi-portfolio' ), true ),
        'show_nav_cv'            => array( __( 'Navigation : lien vers le CV', 'hdgavi-portfolio' ), true ),
        'show_footer'            => array( __( 'Pied de page', 'hdgavi-portfolio' ), true ),
        'show_photo_splash'      => array( __( 'Photo sur l’accueil et la page À propos', 'hdgavi-portfolio' ), true ),
        'show_page_descriptions' => array( __( 'Pages secondaires : description sous le titre', 'hdgavi-portfolio' ), true ),
        'show_qr_code'           => array( __( 'Contact : QR code', 'hdgavi-portfolio' ), true ),
        'show_vcard'             => array( __( 'Contact : fiche vCard', 'hdgavi-portfolio' ), true ),
        'stats_enabled'          => array( __( 'Statistiques de visite anonymes', 'hdgavi-portfolio' ), true ),
        'stats_show_counter'     => array( __( 'Statistiques : compteur dans le pied de page', 'hdgavi-portfolio' ), false ),
        'chatbot_enabled'        => array( __( 'Assistant de questions sur le CV (clé API nécessaire)', 'hdgavi-portfolio' ), false ),
        'maintenance_mode'       => array( __( 'Mode maintenance (les visiteurs voient la page de maintenance)', 'hdgavi-portfolio' ), false ),
        'rss_enabled'            => array( __( 'Import RSS de la veille (toutes les 6 heures)', 'hdgavi-portfolio' ), false ),
    );
    foreach ( $toggles as $key => $t ) {
        $wp_customize->add_setting( $key, array( 'default' => $t[1], 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
        $wp_customize->add_control( $key, array(
            'label'   => $t[0],
            'section' => 'hdgavi_toggles',
            'type'    => 'checkbox',
        ) );
    }

    /* ═══════════════════════════════════════
       SECTION: Content limits
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_limits', array(
        'title'       => __( 'Limites de contenu', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 200,
        'description' => __( 'Nombre d’éléments affichés par page.', 'hdgavi-portfolio' ),
    ) );

    $limits = array(
        'limit_github_repos' => array( __( 'Dépôts GitHub affichés', 'hdgavi-portfolio' ), 6, 1, 12 ),
        'limit_watch'        => array( __( 'Articles de veille affichés', 'hdgavi-portfolio' ), 30, 6, 100 ),
        'limit_blog'         => array( __( 'Articles de blog affichés', 'hdgavi-portfolio' ), 12, 3, 50 ),
        'rss_max_per_feed'   => array( __( 'Articles importés par flux RSS (à chaque import)', 'hdgavi-portfolio' ), 5, 1, 20 ),
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
       SECTION: CV assistant, QR code, phone
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_contact_tools', array(
        'title'    => __( 'Assistant, QR code et téléphone', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 215,
    ) );

    $wp_customize->add_setting( 'chatbot_api_key', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'chatbot_api_key', array(
        'label'       => __( 'Assistant : clé API Anthropic', 'hdgavi-portfolio' ),
        'description' => __( 'L’assistant reste masqué tant que la clé est vide ou que l’option est décochée dans « Affichage ». Il ne répond qu’à partir du contenu du CV.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact_tools',
        'type'        => 'password',
    ) );

    // Same defaults as hdgavi_chatbot_texts() in inc/chatbot.php.
    $chatbot_fields = array(
        'chatbot_title_en'       => array( __( 'Assistant : titre (EN)', 'hdgavi-portfolio' ), 'Questions about the CV' ),
        'chatbot_title_fr'       => array( __( 'Assistant : titre (FR)', 'hdgavi-portfolio' ), 'Questions sur le CV' ),
        'chatbot_title_es'       => array( __( 'Assistant : titre (ES)', 'hdgavi-portfolio' ), 'Preguntas sobre el CV' ),
        'chatbot_welcome_en'     => array( __( 'Assistant : message d’accueil (EN)', 'hdgavi-portfolio' ), 'Ask a question about the experience, education, projects or skills of Holali David GAVI. The answers are generated automatically from his CV.' ),
        'chatbot_welcome_fr'     => array( __( 'Assistant : message d’accueil (FR)', 'hdgavi-portfolio' ), 'Posez une question sur l’expérience, la formation, les projets ou les compétences de Holali David GAVI. Les réponses sont générées automatiquement à partir de son CV.' ),
        'chatbot_welcome_es'     => array( __( 'Assistant : message d’accueil (ES)', 'hdgavi-portfolio' ), 'Haga una pregunta sobre la experiencia, la formación, los proyectos o las competencias de Holali David GAVI. Las respuestas se generan automáticamente a partir de su CV.' ),
        'chatbot_placeholder_en' => array( __( 'Assistant : texte du champ (EN)', 'hdgavi-portfolio' ), 'Your question' ),
        'chatbot_placeholder_fr' => array( __( 'Assistant : texte du champ (FR)', 'hdgavi-portfolio' ), 'Votre question' ),
        'chatbot_placeholder_es' => array( __( 'Assistant : texte du champ (ES)', 'hdgavi-portfolio' ), 'Su pregunta' ),
    );
    foreach ( $chatbot_fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_contact_tools' ) );
    }

    // QR code
    $wp_customize->add_setting( 'qr_code_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'qr_code_url', array(
        'label'   => __( 'QR code : adresse (vide = adresse du site)', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_contact_tools',
    ) );
    $wp_customize->add_setting( 'qr_code_size', array( 'default' => 180, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'qr_code_size', array(
        'label'       => __( 'QR code : taille (px)', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact_tools',
        'type'        => 'number',
        'input_attrs' => array( 'min' => 100, 'max' => 400, 'step' => 10 ),
    ) );

    // Phone (contact page, vCard, JSON-LD)
    $wp_customize->add_setting( 'contact_phone', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'contact_phone', array(
        'label'       => __( 'Téléphone (facultatif)', 'hdgavi-portfolio' ),
        'description' => __( 'Affiché sur la page Contact et ajouté à la fiche vCard s’il est renseigné.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact_tools',
    ) );

    /* ═══════════════════════════════════════
       SECTION: Maintenance page (inc/maintenance.php)
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_maintenance', array(
        'title'       => __( 'Page de maintenance', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 205,
        'description' => __( 'Contenu affiché aux visiteurs quand le mode maintenance est activé.', 'hdgavi-portfolio' ),
    ) );

    // Same defaults as inc/maintenance.php.
    $maint_texts = array(
        'maintenance_title_en' => array( __( 'Titre (EN)', 'hdgavi-portfolio' ), 'This site is being updated' ),
        'maintenance_title_fr' => array( __( 'Titre (FR)', 'hdgavi-portfolio' ), 'Ce site est en cours de mise à jour' ),
        'maintenance_title_es' => array( __( 'Titre (ES)', 'hdgavi-portfolio' ), 'Este sitio se está actualizando' ),
        'maintenance_desc_en'  => array( __( 'Message (EN)', 'hdgavi-portfolio' ), 'The site will be back online shortly. In the meantime, you can contact me using the details below.' ),
        'maintenance_desc_fr'  => array( __( 'Message (FR)', 'hdgavi-portfolio' ), 'Le site sera de nouveau accessible prochainement. En attendant, vous pouvez me contacter aux coordonnées ci-dessous.' ),
        'maintenance_desc_es'  => array( __( 'Message (ES)', 'hdgavi-portfolio' ), 'El sitio volverá a estar disponible próximamente. Mientras tanto, puede contactarme a través de los datos indicados a continuación.' ),
        'maintenance_role_en'  => array( __( 'Intitulé du poste (EN, vide = celui du CV)', 'hdgavi-portfolio' ), '' ),
        'maintenance_role_fr'  => array( __( 'Intitulé du poste (FR, vide = celui du CV)', 'hdgavi-portfolio' ), '' ),
        'maintenance_role_es'  => array( __( 'Intitulé du poste (ES, vide = celui du CV)', 'hdgavi-portfolio' ), '' ),
        'maintenance_company'  => array( __( 'Employeur (facultatif)', 'hdgavi-portfolio' ), '' ),
    );
    foreach ( $maint_texts as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_maintenance' ) );
    }

    $maint_toggles = array(
        'maint_show_banner'   => __( 'Afficher le titre et le message', 'hdgavi-portfolio' ),
        'maint_show_role'     => __( 'Afficher l’intitulé du poste', 'hdgavi-portfolio' ),
        'maint_show_email'    => __( 'Afficher l’adresse e-mail', 'hdgavi-portfolio' ),
        'maint_show_linkedin' => __( 'Afficher le lien LinkedIn', 'hdgavi-portfolio' ),
        'maint_show_github'   => __( 'Afficher le lien GitHub', 'hdgavi-portfolio' ),
        'maint_show_cv'       => __( 'Afficher le lien vers le CV', 'hdgavi-portfolio' ),
        'maint_show_form'     => __( 'Afficher le formulaire de contact', 'hdgavi-portfolio' ),
        'maint_show_lang'     => __( 'Afficher le choix de la langue', 'hdgavi-portfolio' ),
    );
    foreach ( $maint_toggles as $k => $label ) {
        $wp_customize->add_setting( $k, array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
        $wp_customize->add_control( $k, array( 'label' => $label, 'section' => 'hdgavi_maintenance', 'type' => 'checkbox' ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_toggles' );
