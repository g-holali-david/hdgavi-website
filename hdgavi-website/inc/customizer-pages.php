<?php
/**
 * HD GAVI Portfolio — Customizer: New Pages (Watch, Newsletter, Blog, Certifications)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_pages( $wp_customize ) {
    $panel = 'hdgavi_panel';

    /* ═══════════════════════════════════════
       Certifications Section
       ═══════════════════════════════════════ */
    $wp_customize->add_section( 'hdgavi_certs', array(
        'title'    => __( '22. Certifications', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 220,
    ) );

    // 12 certification slots
    for ( $i = 1; $i <= 12; $i++ ) {
        $wp_customize->add_setting( "cert_{$i}_name", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "cert_{$i}_name", array(
            'label'   => sprintf( __( 'Cert %d — Nom', 'hdgavi-portfolio' ), $i ),
            'section' => 'hdgavi_certs',
        ) );

        $wp_customize->add_setting( "cert_{$i}_org", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "cert_{$i}_org", array(
            'label'   => sprintf( __( 'Cert %d — Organisme', 'hdgavi-portfolio' ), $i ),
            'section' => 'hdgavi_certs',
        ) );

        $wp_customize->add_setting( "cert_{$i}_date", array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "cert_{$i}_date", array(
            'label'   => sprintf( __( 'Cert %d — Date', 'hdgavi-portfolio' ), $i ),
            'section' => 'hdgavi_certs',
        ) );

        $wp_customize->add_setting( "cert_{$i}_status", array( 'default' => 'planned', 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "cert_{$i}_status", array(
            'label'   => sprintf( __( 'Cert %d — Statut', 'hdgavi-portfolio' ), $i ),
            'section' => 'hdgavi_certs',
            'type'    => 'select',
            'choices' => array( 'obtained' => 'Obtained', 'in-progress' => 'In progress', 'planned' => 'Planned' ),
        ) );

        $wp_customize->add_setting( "cert_{$i}_url", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( "cert_{$i}_url", array(
            'label'   => sprintf( __( 'Cert %d — Lien vérification', 'hdgavi-portfolio' ), $i ),
            'section' => 'hdgavi_certs',
        ) );

        $wp_customize->add_setting( "cert_{$i}_badge", array( 'default' => '', 'sanitize_callback' => 'esc_url_raw' ) );
        $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, "cert_{$i}_badge", array(
            'label'   => sprintf( __( 'Cert %d — Badge image', 'hdgavi-portfolio' ), $i ),
            'section' => 'hdgavi_certs',
        ) ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_pages' );

/* Newsletter handler moved to inc/newsletter.php */
