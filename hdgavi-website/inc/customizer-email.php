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
        'email_confirm_subject_en' => array( 'Confirmation — Subject EN', 'Message received! — Holali David GAVI' ),
        'email_confirm_subject_fr' => array( 'Confirmation — Subject FR', 'Message bien reçu ! — Holali David GAVI' ),
        'email_confirm_title_en'   => array( 'Confirmation — Title EN', 'Message well received! ✓' ),
        'email_confirm_title_fr'   => array( 'Confirmation — Title FR', 'Message bien reçu ! ✓' ),
        'email_confirm_subtitle_en'=> array( 'Confirmation — Subtitle EN', 'I\'ll get back to you as soon as possible.' ),
        'email_confirm_subtitle_fr'=> array( 'Confirmation — Subtitle FR', 'Je vous réponds dès que possible.' ),
    );
    foreach ( $fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_email' ) );
    }

    /* ── Template 2: Notification admin ── */
    $fields = array(
        'email_notif_title'    => array( 'Notification — Title', '📩 New message from your portfolio' ),
        'email_notif_subtitle' => array( 'Notification — Subtitle', 'Someone just reached out via the contact form.' ),
    );
    foreach ( $fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_email' ) );
    }

    /* ── Template 3: Mini CV ── */
    $wp_customize->add_setting( 'email_cv_enabled', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'email_cv_enabled', array( 'label' => __( 'Enable Mini CV auto-response', 'hdgavi-portfolio' ), 'section' => 'hdgavi_email', 'type' => 'checkbox' ) );
    $fields = array(
        'email_cv_subject_en'  => array( 'Mini CV — Subject EN', 'A bit more about me — Holali David GAVI' ),
        'email_cv_subject_fr'  => array( 'Mini CV — Subject FR', 'Un peu plus sur moi — Holali David GAVI' ),
        'email_cv_title_en'    => array( 'Mini CV — Title EN', 'A bit more about me' ),
        'email_cv_title_fr'    => array( 'Mini CV — Title FR', 'Un peu plus sur moi' ),
        'email_cv_subtitle_en' => array( 'Mini CV — Subtitle EN', 'Here\'s a quick overview of my profile and skills.' ),
        'email_cv_subtitle_fr' => array( 'Mini CV — Subtitle FR', 'Voici un aperçu rapide de mon profil et de mes compétences.' ),
    );
    foreach ( $fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_email' ) );
    }

    /* ── Template 4: Welcome ── */
    $wp_customize->add_setting( 'email_welcome_enabled', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'email_welcome_enabled', array( 'label' => __( 'Enable Welcome email (1st contact only)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_email', 'type' => 'checkbox' ) );
    $fields = array(
        'email_welcome_subject_en'  => array( 'Welcome — Subject EN', 'Welcome! — Holali David GAVI' ),
        'email_welcome_subject_fr'  => array( 'Welcome — Subject FR', 'Bienvenue ! — Holali David GAVI' ),
        'email_welcome_title_en'    => array( 'Welcome — Title EN', 'Welcome! Nice to meet you 👋' ),
        'email_welcome_title_fr'    => array( 'Welcome — Title FR', 'Bienvenue ! Ravi de vous connaître 👋' ),
        'email_welcome_subtitle_en' => array( 'Welcome — Subtitle EN', 'Thank you for reaching out for the first time.' ),
        'email_welcome_subtitle_fr' => array( 'Welcome — Subtitle FR', 'Merci de m\'avoir contacté pour la première fois.' ),
    );
    foreach ( $fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_email' ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_email' );
