<?php
/**
 * HD GAVI Portfolio — Customizer: SEO
 *
 * 7.0.0: job title and employer defaults follow the CV; the free "knowsAbout" keyword list was
 * removed (the JSON-LD Person only carries facts from the CV, see inc/seo.php).
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_seo( $wp_customize ) {
    $panel = 'hdgavi_panel';

    $wp_customize->add_section( 'hdgavi_seo', array(
        'title'    => __( 'SEO et métadonnées', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 80,
    ) );

    // Per-page SEO (simplified: global + per-page title/desc)
    $pages = array( 'home', 'about', 'skills', 'experience', 'projects', 'education', 'contact', 'watch', 'blog', 'certifications', 'timeline', 'stack', 'testimonials', 'presentation', 'newsletter', 'uses', 'roadmap', 'availability', 'legal', 'services', 'booking', 'resources', 'analytics' );
    foreach ( $pages as $page ) {
        $wp_customize->add_setting( "seo_{$page}_title_en", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "seo_{$page}_title_en", array( 'label' => sprintf( 'SEO Title EN — %s', ucfirst( $page ) ), 'section' => 'hdgavi_seo' ) );
        $wp_customize->add_setting( "seo_{$page}_title_fr", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "seo_{$page}_title_fr", array( 'label' => sprintf( 'SEO Title FR — %s', ucfirst( $page ) ), 'section' => 'hdgavi_seo' ) );
        $wp_customize->add_setting( "seo_{$page}_title_es", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "seo_{$page}_title_es", array( 'label' => sprintf( 'SEO Title ES — %s', ucfirst( $page ) ), 'section' => 'hdgavi_seo' ) );
        $wp_customize->add_setting( "seo_{$page}_desc_en", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "seo_{$page}_desc_en", array( 'label' => sprintf( 'Meta Desc EN — %s', ucfirst( $page ) ), 'section' => 'hdgavi_seo' ) );
        $wp_customize->add_setting( "seo_{$page}_desc_fr", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "seo_{$page}_desc_fr", array( 'label' => sprintf( 'Meta Desc FR — %s', ucfirst( $page ) ), 'section' => 'hdgavi_seo' ) );
        $wp_customize->add_setting( "seo_{$page}_desc_es", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "seo_{$page}_desc_es", array( 'label' => sprintf( 'Meta Desc ES — %s', ucfirst( $page ) ), 'section' => 'hdgavi_seo' ) );
    }

    // OG image
    $wp_customize->add_setting( 'seo_og_image', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'seo_og_image', array(
        'label'   => __( 'Image Open Graph', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_seo',
    ) ) );

    // OG type
    $wp_customize->add_setting( 'seo_og_type', array( 'default' => 'website', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'seo_og_type', array(
        'label'   => __( 'Open Graph Type', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_seo',
        'type'    => 'select',
        'choices' => array(
            'website' => 'website',
            'profile' => 'profile',
            'article' => 'article',
        ),
    ) );

    // Twitter card type
    $wp_customize->add_setting( 'seo_twitter_card', array( 'default' => 'summary_large_image', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'seo_twitter_card', array(
        'label'   => __( 'Twitter Card Type', 'hdgavi-portfolio' ),
        'section' => 'hdgavi_seo',
        'type'    => 'select',
        'choices' => array(
            'summary_large_image' => 'summary_large_image',
            'summary'             => 'summary',
        ),
    ) );

    // Indexation toggle
    $wp_customize->add_setting( 'seo_indexation', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'seo_indexation', array(
        'label'       => __( 'Allow search engine indexation', 'hdgavi-portfolio' ),
        'description' => __( 'Uncheck to add noindex/nofollow — blocks Google, Bing, etc. from indexing your site.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_seo',
        'type'        => 'checkbox',
        'priority'    => 1,
    ) );

    // JSON-LD Person (inc/seo.php)
    $wp_customize->add_setting( 'seo_job_title', array( 'default' => 'DevOps / Cloud Native Engineer', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'seo_job_title', array( 'label' => __( 'Intitulé du poste (JSON-LD jobTitle)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_seo' ) );
    $wp_customize->add_setting( 'seo_company', array( 'default' => 'Dassault Systèmes', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'seo_company', array(
        'label'       => __( 'Employeur (JSON-LD worksFor)', 'hdgavi-portfolio' ),
        'description' => __( 'Vider le champ pour retirer worksFor.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_seo',
    ) );

    // Twitter / X card
    $wp_customize->add_setting( 'contact_twitter', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'contact_twitter', array(
        'label'       => __( 'Profil Twitter / X (facultatif)', 'hdgavi-portfolio' ),
        'description' => __( 'Adresse complète, par exemple https://x.com/nom. Utilisée pour la balise twitter:site.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_seo',
    ) );

    // GA
    $wp_customize->add_setting( 'ga_id', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'ga_id', array( 'label' => __( 'Google Analytics ID', 'hdgavi-portfolio' ), 'section' => 'hdgavi_seo' ) );
}
add_action( 'customize_register', 'hdgavi_customizer_seo' );
