<?php
/**
 * HD GAVI Portfolio — Customizer: contact form
 *
 * 7.0.0: the form label settings were removed, the contact template (template-parts/cv-contact.php)
 * carries its own trilingual labels.
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_contact( $wp_customize ) {
    $panel = 'hdgavi_panel';

    $wp_customize->add_section( 'hdgavi_contact', array(
        'title'    => __( 'Formulaire de contact', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 70,
    ) );

    // Web3Forms key
    $wp_customize->add_setting( 'web3forms_key', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'web3forms_key', array(
        'label'       => __( 'Clé d’accès Web3Forms', 'hdgavi-portfolio' ),
        'section'     => 'hdgavi_contact',
        'description' => __( 'Clé fournie par web3forms.com, utilisée par le formulaire de contact.', 'hdgavi-portfolio' ),
    ) );
}
add_action( 'customize_register', 'hdgavi_customizer_contact' );
