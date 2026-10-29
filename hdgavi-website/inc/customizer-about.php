<?php
/**
 * HD GAVI Portfolio — Customizer: CV content
 *
 * "Contenu du CV" edits the cv_<key>_<lang> values read by hdgavi_cv() and cv_location read by
 * hdgavi_cv_location() (inc/cv-content.php). Defaults are the CV texts from hdgavi_cv_texts();
 * cv-content.php is loaded by functions.php before customize_register runs.
 *
 * 7.0.0: the personality text, quote and badge of the old About page, the stat tiles, the seven
 * trait cards and the splash subtitle were removed with their settings: the About text now comes
 * from cv_about_<lang>, and neither the e-mails nor the Presentation page read the old fields.
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_about( $wp_customize ) {
    $panel = 'hdgavi_panel';
    $langs = array( 'en' => 'EN', 'fr' => 'FR', 'es' => 'ES' );
    $texts = function_exists( 'hdgavi_cv_texts' ) ? hdgavi_cv_texts() : array();

    /* ═══════════════════════════════════════
       SECTION: Contenu du CV
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_cv', array(
        'title'       => __( 'Contenu du CV', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 11,
        'description' => __( 'Textes repris du CV : accueil, À propos, Disponibilité et Contact. Les valeurs par défaut sont celles du CV.', 'hdgavi-portfolio' ),
    ) );

    $wp_customize->add_setting( 'cv_location', array(
        'default'           => 'Aubervilliers (93300), Île-de-France',
        'sanitize_callback' => 'sanitize_text_field',
    ) );
    $wp_customize->add_control( 'cv_location', array(
        'label'   => __( 'Localisation', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_cv',
        'type'    => 'text',
    ) );

    // key => array( label, control type )
    $fields = array(
        'role'                 => array( __( 'Intitulé du poste', 'hdgavi-portfolio' ), 'text' ),
        'lead'                 => array( __( 'Introduction', 'hdgavi-portfolio' ), 'text' ),
        'goal'                 => array( __( 'Objectif', 'hdgavi-portfolio' ), 'text' ),
        'fact_search'          => array( __( 'Recherche', 'hdgavi-portfolio' ), 'text' ),
        'fact_role'            => array( __( 'Poste actuel', 'hdgavi-portfolio' ), 'text' ),
        'fact_education'       => array( __( 'Formation', 'hdgavi-portfolio' ), 'text' ),
        'fact_languages'       => array( __( 'Langues', 'hdgavi-portfolio' ), 'text' ),
        'fact_languages_short' => array( __( 'Langues (version courte)', 'hdgavi-portfolio' ), 'text' ),
        'fact_interests'       => array( __( 'Centres d’intérêt', 'hdgavi-portfolio' ), 'text' ),
        'about'                => array( __( 'Texte À propos (HTML simple : p, strong, em, a)', 'hdgavi-portfolio' ), 'textarea' ),
    );
    foreach ( $fields as $key => $meta ) {
        foreach ( $langs as $lang => $lang_label ) {
            $id = 'cv_' . $key . '_' . $lang;
            $wp_customize->add_setting( $id, array(
                'default'           => isset( $texts[ $key ][ $lang ] ) ? $texts[ $key ][ $lang ] : '',
                'sanitize_callback' => ( 'about' === $key ) ? 'wp_kses_post' : 'sanitize_text_field',
            ) );
            $wp_customize->add_control( $id, array(
                'label'   => $meta[0] . ' (' . $lang_label . ')',
                'section' => 'hdgavi_cv',
                'type'    => $meta[1],
            ) );
        }
    }
}
add_action( 'customize_register', 'hdgavi_customizer_about' );
