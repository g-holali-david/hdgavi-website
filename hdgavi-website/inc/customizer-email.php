<?php
/**
 * HD GAVI Portfolio — Customizer: Email Templates & SMTP
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_email( $wp_customize ) {
    $panel = 'hdgavi_panel';

    $wp_customize->add_section( 'hdgavi_email', array(
        'title'       => __( '18. Email Templates', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 180,
        'description' => __( 'Configure email templates sent from the contact form. Works with WP Mail SMTP.', 'hdgavi-portfolio' ),
    ) );

    /* ── SMTP From ── */
    $wp_customize->add_setting( 'smtp_from_email', array( 'default' => '', 'sanitize_callback' => 'sanitize_email' ) );
    $wp_customize->add_control( 'smtp_from_email', array(
        'label'       => __( 'From Email (SMTP)', 'hdgavi-portfolio' ),
        'description' => __( 'Leave empty to use WP Mail SMTP settings.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_email',
    ) );
    $wp_customize->add_setting( 'smtp_from_name', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'smtp_from_name', array(
        'label'       => __( 'From Name (SMTP)', 'hdgavi-portfolio' ),
        'description' => __( 'Leave empty to use your name from General settings.', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_email',
    ) );

    /* ── Template 1: Confirmation ── */
    $fields = array(
        'email_confirm_subject_en' => array( 'Confirmation — Subject EN', 'Message received — Holali David GAVI' ),
        'email_confirm_subject_fr' => array( 'Confirmation — Subject FR', 'Message reçu — Holali David GAVI' ),
        'email_confirm_title_en'   => array( 'Confirmation — Title EN', 'Message received' ),
        'email_confirm_title_fr'   => array( 'Confirmation — Title FR', 'Message reçu' ),
        'email_confirm_subtitle_en'=> array( 'Confirmation — Subtitle EN', 'I will reply as soon as possible.' ),
        'email_confirm_subtitle_fr'=> array( 'Confirmation — Subtitle FR', 'Je vous réponds dès que possible.' ),
    );
    foreach ( $fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_email' ) );
    }

    /* ── Template 2: Notification admin ── */
    $fields = array(
        'email_notif_title'    => array( 'Notification — Title', 'New message from the contact form' ),
        'email_notif_subtitle' => array( 'Notification — Subtitle', 'Sent through the contact form on the site.' ),
    );
    foreach ( $fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_email' ) );
    }

    /* ── Template 3: Mini CV ── */
    $wp_customize->add_setting( 'email_cv_enabled', array( 'default' => false, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'email_cv_enabled', array( 'label' => __( 'Enable Mini CV auto-response', 'hdgavi-portfolio' ), 'section' => 'hdgavi_email', 'type' => 'checkbox' ) );
    $fields = array(
        'email_cv_subject_en'  => array( 'Mini CV — Subject EN', 'Summary of my CV — Holali David GAVI' ),
        'email_cv_subject_fr'  => array( 'Mini CV — Subject FR', 'Résumé de mon CV — Holali David GAVI' ),
        'email_cv_title_en'    => array( 'Mini CV — Title EN', 'Summary of my CV' ),
        'email_cv_title_fr'    => array( 'Mini CV — Title FR', 'Résumé de mon CV' ),
        'email_cv_subtitle_en' => array( 'Mini CV — Subtitle EN', 'Experience, projects, skills and education' ),
        'email_cv_subtitle_fr' => array( 'Mini CV — Subtitle FR', 'Expérience, projets, compétences et formation' ),
    );
    foreach ( $fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_email' ) );
    }

    /* ── Template 4: Welcome ── */
    $wp_customize->add_setting( 'email_welcome_enabled', array( 'default' => false, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'email_welcome_enabled', array( 'label' => __( 'Enable Welcome email (1st contact only)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_email', 'type' => 'checkbox' ) );
    $fields = array(
        'email_welcome_subject_en'  => array( 'Welcome — Subject EN', 'Introduction — Holali David GAVI' ),
        'email_welcome_subject_fr'  => array( 'Welcome — Subject FR', 'Présentation — Holali David GAVI' ),
        'email_welcome_title_en'    => array( 'Welcome — Title EN', 'A short introduction' ),
        'email_welcome_title_fr'    => array( 'Welcome — Title FR', 'Quelques mots de présentation' ),
        'email_welcome_subtitle_en' => array( 'Welcome — Subtitle EN', '' ),
        'email_welcome_subtitle_fr' => array( 'Welcome — Subtitle FR', '' ),
    );
    foreach ( $fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_email' ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_email' );
