<?php
/**
 * HD GAVI Portfolio — Customizer: Uses, Roadmap, Availability, Legal
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_lot6( $wp_customize ) {
    $panel = 'hdgavi_panel';

    /* ═══════════════════════════════════════
       Uses / Mon Setup (8 categories)
       Format: "Tool | Description | URL" per line
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_uses', array(
        'title'       => __( '26. Uses / Mon Setup', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 260,
        'description' => __( 'Format: "Tool | Description | URL" per line.', 'hdgavi-portfolio' ),
    ) );

    for ( $c = 1; $c <= 8; $c++ ) {
        $wp_customize->add_setting( "uses_cat_{$c}_en", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "uses_cat_{$c}_en", array( 'label' => "Category $c — Name EN", 'section' => 'hdgavi_uses' ) );

        $wp_customize->add_setting( "uses_cat_{$c}_fr", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "uses_cat_{$c}_fr", array( 'label' => "Category $c — Name FR", 'section' => 'hdgavi_uses' ) );

        $wp_customize->add_setting( "uses_cat_{$c}_icon", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "uses_cat_{$c}_icon", array( 'label' => "Category $c — Icon (emoji)", 'section' => 'hdgavi_uses' ) );

        $wp_customize->add_setting( "uses_cat_{$c}_items", array( 'default' => '', 'sanitize_callback' => 'sanitize_textarea_field' ) );
        $wp_customize->add_control( "uses_cat_{$c}_items", array( 'label' => "Category $c — Items", 'section' => 'hdgavi_uses', 'type' => 'textarea' ) );
    }

    /* ═══════════════════════════════════════
       Roadmap / Objectifs (6 categories)
       Format: "Goal | status" per line (done, in-progress, planned)
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_roadmap', array(
        'title'       => __( '27. Roadmap / Objectifs', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 270,
        'description' => __( 'Format: "Goal | status" per line. Status: done, in-progress, planned.', 'hdgavi-portfolio' ),
    ) );

    for ( $c = 1; $c <= 6; $c++ ) {
        $wp_customize->add_setting( "roadmap_cat_{$c}_en", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "roadmap_cat_{$c}_en", array( 'label' => "Category $c — Name EN", 'section' => 'hdgavi_roadmap' ) );

        $wp_customize->add_setting( "roadmap_cat_{$c}_fr", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "roadmap_cat_{$c}_fr", array( 'label' => "Category $c — Name FR", 'section' => 'hdgavi_roadmap' ) );

        $wp_customize->add_setting( "roadmap_cat_{$c}_icon", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "roadmap_cat_{$c}_icon", array( 'label' => "Category $c — Icon (emoji)", 'section' => 'hdgavi_roadmap' ) );

        $wp_customize->add_setting( "roadmap_cat_{$c}_items", array( 'default' => '', 'sanitize_callback' => 'sanitize_textarea_field' ) );
        $wp_customize->add_control( "roadmap_cat_{$c}_items", array( 'label' => "Category $c — Goals", 'section' => 'hdgavi_roadmap', 'type' => 'textarea' ) );
    }

    /* ═══════════════════════════════════════
       Availability / Disponibilité
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_availability', array(
        'title'    => __( '28. Disponibilité', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 280,
    ) );

    $wp_customize->add_setting( 'avail_status', array( 'default' => 'available', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'avail_status', array(
        'label'   => __( 'Statut actuel', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_availability',
        'type'    => 'select',
        'choices' => array( 'available' => 'Available / Disponible', 'busy' => 'On a mission / En mission', 'unavailable' => 'Not available / Indisponible' ),
    ) );

    $avail_fields = array(
        'avail_detail_en'    => array( 'Détails EN', '' ),
        'avail_detail_fr'    => array( 'Détails FR', '' ),
        'avail_next_date'    => array( 'Prochaine disponibilité (date)', '' ),
        'avail_looking_en'   => array( 'Ce que je recherche EN', '' ),
        'avail_looking_fr'   => array( 'Ce que je recherche FR', '' ),
        'avail_contracts'    => array( 'Types de contrats (séparés par virgules)', 'CDI, Freelance, Alternance' ),
        'avail_salary_range'       => array( 'Fourchette salariale (ex: 42-50K€)', '' ),
        'avail_preferred_stack'    => array( 'Stack préférée (séparées par virgules)', 'Docker, Kubernetes, Helm, Terraform, CI/CD' ),
        'avail_location_pref_en'   => array( 'Localisation préférée EN', 'Remote / Île-de-France / Hybrid' ),
        'avail_location_pref_fr'   => array( 'Localisation préférée FR', 'Télétravail / Île-de-France / Hybride' ),
        'avail_location_pref_es'   => array( 'Localisation préférée ES', 'Remoto / Île-de-France / Híbrido' ),
        'avail_experience_summary' => array( 'Résumé expérience (ex: 2+ years DevOps)', '' ),
    );
    foreach ( $avail_fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_availability' ) );
    }

    // Recruiter button toggles
    $wp_customize->add_setting( 'show_recruiter_btn', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'show_recruiter_btn', array( 'label' => 'Afficher le bouton Recruteur dans la navbar', 'section' => 'hdgavi_availability', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'avail_show_salary', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'avail_show_salary', array( 'label' => 'Afficher la fourchette salariale', 'section' => 'hdgavi_availability', 'type' => 'checkbox' ) );

    $recruiter_texts = array(
        'recruiter_btn_en' => array( 'Texte bouton recruteur EN', 'Hire me' ),
        'recruiter_btn_fr' => array( 'Texte bouton recruteur FR', 'Recrutez-moi' ),
        'recruiter_btn_es' => array( 'Texte bouton recruteur ES', 'Contrátame' ),
    );
    foreach ( $recruiter_texts as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_availability' ) );
    }

    /* ═══════════════════════════════════════
       Legal / Mentions légales
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_legal', array(
        'title'    => __( '29. Mentions Légales', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 290,
    ) );

    $legal_fields = array(
        'legal_hosting_name'    => array( 'Hébergeur — Nom', '' ),
        'legal_hosting_address' => array( 'Hébergeur — Adresse', '' ),
        'legal_updated'         => array( 'Date de mise à jour', wp_date( 'F Y' ) ),
    );
    foreach ( $legal_fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_legal' ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_lot6' );
