<?php
/**
 * HD GAVI Portfolio — Customizer: Uses, Roadmap, Legal notice
 *
 * 7.0.0: the "Disponibilité" section was removed. The Availability page now shows the CV
 * (search, current role, location, languages: see "Contenu du CV"), and the pulsing
 * "Hire me" navbar button, the salary range, the contract list and the location preferences
 * are no longer used anywhere.
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_lot6( $wp_customize ) {
    $panel = 'hdgavi_panel';

    /* ═══════════════════════════════════════
       Uses / Mon setup (8 categories)
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_uses', array(
        'title'       => __( 'Uses / Mon setup', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 260,
        'description' => __( 'Une ligne par outil : « Outil | Description | URL ».', 'hdgavi-portfolio' ),
    ) );

    for ( $c = 1; $c <= 8; $c++ ) {
        $wp_customize->add_setting( "uses_cat_{$c}_en", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "uses_cat_{$c}_en", array( 'label' => sprintf( __( 'Catégorie %d : nom (EN)', 'hdgavi-portfolio' ), $c ), 'section' => 'hdgavi_uses' ) );

        $wp_customize->add_setting( "uses_cat_{$c}_fr", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "uses_cat_{$c}_fr", array( 'label' => sprintf( __( 'Catégorie %d : nom (FR)', 'hdgavi-portfolio' ), $c ), 'section' => 'hdgavi_uses' ) );

        $wp_customize->add_setting( "uses_cat_{$c}_es", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "uses_cat_{$c}_es", array( 'label' => sprintf( __( 'Catégorie %d : nom (ES)', 'hdgavi-portfolio' ), $c ), 'section' => 'hdgavi_uses' ) );

        $wp_customize->add_setting( "uses_cat_{$c}_items", array( 'default' => '', 'sanitize_callback' => 'sanitize_textarea_field' ) );
        $wp_customize->add_control( "uses_cat_{$c}_items", array( 'label' => sprintf( __( 'Catégorie %d : outils', 'hdgavi-portfolio' ), $c ), 'section' => 'hdgavi_uses', 'type' => 'textarea' ) );
    }

    /* ═══════════════════════════════════════
       Roadmap / Objectifs (6 categories)
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_roadmap', array(
        'title'       => __( 'Roadmap / Objectifs', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 270,
        'description' => __( 'Une ligne par objectif : « Objectif | statut » (done, in-progress, planned), ou « [x] Objectif » / « [ ] Objectif ».', 'hdgavi-portfolio' ),
    ) );

    for ( $c = 1; $c <= 6; $c++ ) {
        $wp_customize->add_setting( "roadmap_cat_{$c}_en", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "roadmap_cat_{$c}_en", array( 'label' => sprintf( __( 'Catégorie %d : nom (EN)', 'hdgavi-portfolio' ), $c ), 'section' => 'hdgavi_roadmap' ) );

        $wp_customize->add_setting( "roadmap_cat_{$c}_fr", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "roadmap_cat_{$c}_fr", array( 'label' => sprintf( __( 'Catégorie %d : nom (FR)', 'hdgavi-portfolio' ), $c ), 'section' => 'hdgavi_roadmap' ) );

        $wp_customize->add_setting( "roadmap_cat_{$c}_es", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "roadmap_cat_{$c}_es", array( 'label' => sprintf( __( 'Catégorie %d : nom (ES)', 'hdgavi-portfolio' ), $c ), 'section' => 'hdgavi_roadmap' ) );

        $wp_customize->add_setting( "roadmap_cat_{$c}_items", array( 'default' => '', 'sanitize_callback' => 'sanitize_textarea_field' ) );
        $wp_customize->add_control( "roadmap_cat_{$c}_items", array( 'label' => sprintf( __( 'Catégorie %d : objectifs', 'hdgavi-portfolio' ), $c ), 'section' => 'hdgavi_roadmap', 'type' => 'textarea' ) );
    }

    /* ═══════════════════════════════════════
       Legal notice
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_legal', array(
        'title'    => __( 'Mentions légales', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 290,
    ) );

    $legal_fields = array(
        'legal_hosting_name'    => array( __( 'Hébergeur : nom', 'hdgavi-portfolio' ), '' ),
        'legal_hosting_address' => array( __( 'Hébergeur : adresse', 'hdgavi-portfolio' ), '' ),
        'legal_updated'         => array( __( 'Date de mise à jour', 'hdgavi-portfolio' ), '' ),
    );
    foreach ( $legal_fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $control = array( 'label' => $v[0], 'section' => 'hdgavi_legal' );
        if ( 'legal_updated' === $k ) {
            $control['description'] = __( 'Laisser vide pour la date prévue par la page, traduite dans les trois langues. Une date saisie ici est affichée telle quelle.', 'hdgavi-portfolio' );
        }
        $wp_customize->add_control( $k, $control );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_lot6' );
