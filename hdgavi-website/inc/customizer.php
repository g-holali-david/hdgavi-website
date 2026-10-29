<?php
/**
 * HD GAVI Portfolio — Customizer: panel, General, Logo, Footer
 *
 * 7.0.0: the splash-page section (title, buttons, animation), the footer description and the
 * RQTH texts were removed, nothing reads them any more. The CV texts are edited in the
 * "Contenu du CV" section (inc/customizer-about.php).
 *
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
        'title'    => __( 'Général', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 10,
    ) );

    // id => array( label, default, sanitize callback, description )
    $general_fields = array(
        'general_name'          => array( __( 'Nom complet', 'hdgavi-portfolio' ), 'Holali David GAVI', 'sanitize_text_field', '' ),
        'general_email'         => array( __( 'Adresse e-mail', 'hdgavi-portfolio' ), 'g.holalidavid@gmail.com', 'sanitize_email', '' ),
        'general_location'      => array(
            __( 'Localisation (page de maintenance)', 'hdgavi-portfolio' ),
            'Aubervilliers (93300), Île-de-France',
            'sanitize_text_field',
            __( 'La localisation affichée sur le site se règle dans « Contenu du CV ».', 'hdgavi-portfolio' ),
        ),
        'contact_github'        => array( __( 'URL GitHub', 'hdgavi-portfolio' ), 'https://github.com/g-holali-david', 'esc_url_raw', '' ),
        'contact_github_handle' => array( __( 'Identifiant GitHub', 'hdgavi-portfolio' ), 'g-holali-david', 'sanitize_text_field', '' ),
        'contact_linkedin'      => array( __( 'URL LinkedIn', 'hdgavi-portfolio' ), 'https://www.linkedin.com/in/holali-david-g-4a434631a/', 'esc_url_raw', '' ),
    );
    foreach ( $general_fields as $k => $f ) {
        $wp_customize->add_setting( $k, array( 'default' => $f[1], 'sanitize_callback' => $f[2] ) );
        $control = array( 'label' => $f[0], 'section' => 'hdgavi_general' );
        if ( '' !== $f[3] ) $control['description'] = $f[3];
        $wp_customize->add_control( $k, $control );
    }

    // Language select
    $wp_customize->add_setting( 'default_lang', array( 'default' => 'en', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'default_lang', array(
        'label'   => __( 'Langue par défaut', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_general',
        'type'    => 'select',
        'choices' => array( 'en' => 'English', 'fr' => 'Français', 'es' => 'Español' ),
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
        'label'   => __( 'CV au format PDF', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_general',
    ) ) );

    // RQTH — sensitive personal data, opt-in only
    $wp_customize->add_setting( 'show_rqth', array( 'default' => false, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'show_rqth', array(
        'label'       => __( 'Afficher la mention RQTH', 'hdgavi-portfolio' ),
        'description' => __( 'Donnée personnelle sensible, désactivée par défaut.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_general',
        'type'        => 'checkbox',
    ) );

    /* ═══════════════════════════════════════
       SECTION: Logo
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_branding', array(
        'title'    => __( 'Logo et identité', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 12,
    ) );
    $wp_customize->add_setting( 'logo_monogram', array( 'default' => 'HD', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'logo_monogram', array( 'label' => __( 'Monogramme', 'hdgavi-portfolio' ), 'section' => 'hdgavi_branding' ) );
    $wp_customize->add_setting( 'logo_text', array( 'default' => 'GAVI', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'logo_text', array( 'label' => __( 'Texte du logo', 'hdgavi-portfolio' ), 'section' => 'hdgavi_branding' ) );

    /* ═══════════════════════════════════════
       SECTION: Footer
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_footer', array(
        'title'    => __( 'Pied de page', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 100,
    ) );
    $footer_fields = array(
        'footer_name' => array( __( 'Nom affiché dans le pied de page', 'hdgavi-portfolio' ), 'Holali David GAVI' ),
        'footer_year' => array( __( 'Année du copyright (e-mails, page de maintenance)', 'hdgavi-portfolio' ), '2026' ),
    );
    foreach ( $footer_fields as $k => $f ) {
        $wp_customize->add_setting( $k, array( 'default' => $f[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $f[0], 'section' => 'hdgavi_footer' ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_general' );
