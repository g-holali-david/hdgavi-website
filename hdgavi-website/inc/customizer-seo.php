<?php
/**
 * HD GAVI Portfolio — Customizer: SEO
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_seo( $wp_customize ) {
    $panel = 'hdgavi_panel';

    $wp_customize->add_section( 'hdgavi_seo', array(
        'title'    => __( '9. SEO & Meta', 'hdgavi-portfolio' ),
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

    // JSON-LD Person
    $wp_customize->add_setting( 'seo_job_title', array( 'default' => 'Cloud & DevOps Engineer', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'seo_job_title', array( 'label' => __( 'Job Title (JSON-LD)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_seo' ) );
    $wp_customize->add_setting( 'seo_company', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'seo_company', array( 'label' => __( 'Company (JSON-LD) — optional', 'hdgavi-portfolio' ), 'section' => 'hdgavi_seo' ) );
    $wp_customize->add_setting( 'seo_knows_about', array( 'default' => 'Docker, Kubernetes, CI/CD, Terraform, Cloud Security, DevOps, Linux', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'seo_knows_about', array(
        'label'       => __( 'Skills / Keywords (JSON-LD knowsAbout)', 'hdgavi-portfolio' ),
        'description' => __( 'Comma-separated list of skills/technologies for search engines.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_seo',
    ) );

    // Social profiles (for JSON-LD sameAs + Twitter card)
    $wp_customize->add_setting( 'contact_twitter', array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
    $wp_customize->add_control( 'contact_twitter', array(
        'label'       => __( 'Twitter/X Profile URL', 'hdgavi-portfolio' ),
        'description' => __( 'Full URL (e.g. https://x.com/username). Used in JSON-LD and twitter:site meta.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_seo',
    ) );

    // GA
    $wp_customize->add_setting( 'ga_id', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'ga_id', array( 'label' => __( 'Google Analytics ID', 'hdgavi-portfolio' ), 'section' => 'hdgavi_seo' ) );
}
add_action( 'customize_register', 'hdgavi_customizer_seo' );
