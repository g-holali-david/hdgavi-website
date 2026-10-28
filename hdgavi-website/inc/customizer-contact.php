<?php
/**
 * HD GAVI Portfolio — Customizer: Contact
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_contact( $wp_customize ) {
    $panel = 'hdgavi_panel';

    $wp_customize->add_section( 'hdgavi_contact', array(
        'title'    => __( '8. Contact', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 70,
    ) );

    // Form labels
    $labels = array(
        'form_name_en'    => array( 'Your name', 'Label nom (EN)' ),
        'form_name_fr'    => array( 'Votre nom', 'Label nom (FR)' ),
        'form_email_en'   => array( 'Your email', 'Label email (EN)' ),
        'form_email_fr'   => array( 'Votre email', 'Label email (FR)' ),
        'form_message_en' => array( 'Your message', 'Label message (EN)' ),
        'form_message_fr' => array( 'Votre message', 'Label message (FR)' ),
        'form_btn_en'     => array( 'Send', 'Bouton (EN)' ),
        'form_btn_fr'     => array( 'Envoyer', 'Bouton (FR)' ),
    );
    foreach ( $labels as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[0], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[1], 'section' => 'hdgavi_contact' ) );
    }

    // Web3Forms key
    $wp_customize->add_setting( 'web3forms_key', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'web3forms_key', array(
        'label'       => __( 'Web3Forms Access Key', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact',
        'description' => __( 'Get your key at web3forms.com', 'hdgavi-portfolio' ),
    ) );
}
add_action( 'customize_register', 'hdgavi_customizer_contact' );
