<?php
/**
 * HD GAVI Portfolio — Customizer: General, Splash, Footer, Branding
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_general( $wp_customize ) {
    $panel = 'hdgavi_panel';
    $wp_customize->add_panel( $panel, array(
        'title'    => __( 'Portfolio HD GAVI', 'hdgavi-portfolio' ),
        'priority' => 25,
    ) );

    /* ═══════════════════════════════════════
       SECTION: General
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_general', array(
        'title'    => __( '1. Général', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 10,
    ) );

    $general_fields = array(
        'general_name'     => array( __( 'Nom complet', 'hdgavi-portfolio' ), 'Holali David GAVI', 'sanitize_text_field' ),
        'general_email'    => array( __( 'Email', 'hdgavi-portfolio' ), 'g.holalidavid@gmail.com', 'sanitize_email' ),
        'general_location' => array( __( 'Localisation', 'hdgavi-portfolio' ), 'Saint-Denis (93), Île-de-France', 'sanitize_text_field' ),
        'contact_github'   => array( __( 'GitHub URL', 'hdgavi-portfolio' ), 'https://github.com/g-holali-david', 'esc_url_raw' ),
        'contact_github_handle' => array( __( 'GitHub Username', 'hdgavi-portfolio' ), 'g-holali-david', 'sanitize_text_field' ),
        'contact_linkedin' => array( __( 'LinkedIn URL', 'hdgavi-portfolio' ), '', 'esc_url_raw' ),
    );
    foreach ( $general_fields as $k => $f ) {
        $wp_customize->add_setting( $k, array( 'default' => $f[1], 'sanitize_callback' => $f[2] ) );
        $wp_customize->add_control( $k, array( 'label' => $f[0], 'section' => 'hdgavi_general' ) );
    }

    // Language select
    $wp_customize->add_setting( 'default_lang', array( 'default' => 'en', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'default_lang', array(
        'label'   => __( 'Langue par défaut', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_general',
        'type'    => 'select',
        'choices' => array( 'en' => 'English', 'fr' => 'Français' ),
    ) );

    // Profile photo
    $wp_customize->add_setting( 'profile_photo', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'profile_photo', array(
        'label'   => __( 'Photo de profil', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_general',
    ) ) );

    // CV PDF
    $wp_customize->add_setting( 'cv_pdf_url', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Upload_Control( $wp_customize, 'cv_pdf_url', array(
        'label'   => __( 'CV PDF (upload)', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_general',
    ) ) );

    // RQTH
    $wp_customize->add_setting( 'show_rqth', array( 'default' => false, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'show_rqth', array(
        'label'   => __( 'Afficher mention RQTH', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_general',
        'type'    => 'checkbox',
    ) );
    $wp_customize->add_setting( 'rqth_text_en', array( 'default' => 'RQTH recognized', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'rqth_text_en', array( 'label' => __( 'RQTH text (EN)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_general' ) );
    $wp_customize->add_setting( 'rqth_text_fr', array( 'default' => 'RQTH reconnue', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'rqth_text_fr', array( 'label' => __( 'RQTH text (FR)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_general' ) );

    /* ═══════════════════════════════════════
       SECTION: Branding
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_branding', array(
        'title'    => __( 'Logo & Identité', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 12,
    ) );
    $wp_customize->add_setting( 'logo_monogram', array( 'default' => 'HD', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'logo_monogram', array( 'label' => __( 'Monogramme', 'hdgavi-portfolio' ), 'section' => 'hdgavi_branding' ) );
    $wp_customize->add_setting( 'logo_text', array( 'default' => 'GAVI', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'logo_text', array( 'label' => __( 'Texte du logo', 'hdgavi-portfolio' ), 'section' => 'hdgavi_branding' ) );

    /* ═══════════════════════════════════════
       SECTION: Splash Page
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_splash', array(
        'title'    => __( '2. Splash Page', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 15,
    ) );
    $splash_fields = array(
        'splash_title'        => array( __( 'Titre (nom)', 'hdgavi-portfolio' ), 'Holali David GAVI', 'sanitize_text_field' ),
        'splash_subtitle_en'  => array( __( 'Sous-titre (EN)', 'hdgavi-portfolio' ), 'Cloud & DevOps Engineer', 'sanitize_text_field' ),
        'splash_subtitle_fr'  => array( __( 'Sous-titre (FR)', 'hdgavi-portfolio' ), 'Ingénieur Cloud & DevOps', 'sanitize_text_field' ),
        'splash_btn_en'       => array( __( 'Bouton texte (EN)', 'hdgavi-portfolio' ), 'Explore', 'sanitize_text_field' ),
        'splash_btn_fr'       => array( __( 'Bouton texte (FR)', 'hdgavi-portfolio' ), 'Explorer', 'sanitize_text_field' ),
        'splash_cv_btn_en'    => array( __( 'Bouton CV (EN)', 'hdgavi-portfolio' ), 'Download CV', 'sanitize_text_field' ),
        'splash_cv_btn_fr'    => array( __( 'Bouton CV (FR)', 'hdgavi-portfolio' ), 'Télécharger CV', 'sanitize_text_field' ),
    );
    foreach ( $splash_fields as $k => $f ) {
        $wp_customize->add_setting( $k, array( 'default' => $f[1], 'sanitize_callback' => $f[2] ) );
        $wp_customize->add_control( $k, array( 'label' => $f[0], 'section' => 'hdgavi_splash' ) );
    }
    $wp_customize->add_setting( 'splash_animation', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'splash_animation', array(
        'label'   => __( 'Activer l\'animation', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_splash',
        'type'    => 'checkbox',
    ) );

    /* ═══════════════════════════════════════
       SECTION: Footer
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_footer', array(
        'title'    => __( '10. Footer', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 100,
    ) );
    $footer_fields = array(
        'footer_desc_en' => array( __( 'Description footer (EN)', 'hdgavi-portfolio' ), 'Cloud & DevOps Engineer — Containerization, Kubernetes, CI/CD automation and cloud security.', 'sanitize_text_field' ),
        'footer_desc_fr' => array( __( 'Description footer (FR)', 'hdgavi-portfolio' ), 'Ingénieur Cloud & DevOps — Conteneurisation, Kubernetes, automatisation CI/CD et sécurité cloud.', 'sanitize_text_field' ),
        'footer_year'    => array( __( 'Année copyright', 'hdgavi-portfolio' ), '2026', 'sanitize_text_field' ),
        'footer_name'    => array( __( 'Nom copyright', 'hdgavi-portfolio' ), 'Holali David GAVI', 'sanitize_text_field' ),
    );
    foreach ( $footer_fields as $k => $f ) {
        $wp_customize->add_setting( $k, array( 'default' => $f[1], 'sanitize_callback' => $f[2] ) );
        $wp_customize->add_control( $k, array( 'label' => $f[0], 'section' => 'hdgavi_footer' ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_general' );
