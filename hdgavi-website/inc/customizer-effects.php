<?php
/**
 * HD GAVI Portfolio — Customizer: hidden terminal page, copy-e-mail button
 *
 * 7.0.0: the visual effects (particles, grain, custom cursor, parallax, animated counters,
 * reading progress bar), the animated splash terminal, the Konami easter egg and the GitHub
 * repositories preview were removed from the site, together with their settings.
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_effects( $wp_customize ) {
    $panel = 'hdgavi_panel';

    /* ── Hidden terminal page (template "Terminal (Hidden)", not linked from any menu) ── */
    $wp_customize->add_section( 'hdgavi_terminal_page', array(
        'title'       => __( 'Page terminal (cachée)', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 130,
        'description' => __( 'Textes de la page qui utilise le modèle « Terminal (Hidden) ».', 'hdgavi-portfolio' ),
    ) );

    $wp_customize->add_setting( 'term_page_prompt', array( 'default' => 'visitor@hdgavi:~$', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'term_page_prompt', array( 'label' => __( 'Invite de commande', 'hdgavi-portfolio' ), 'section' => 'hdgavi_terminal_page' ) );

    // Same defaults as hdgavi_get_js_config() in functions.php.
    $term_page_fields = array(
        'term_page_welcome_en' => array( __( 'Message d’accueil (EN)', 'hdgavi-portfolio' ), 'Welcome to HD GAVI terminal. Type "help" to get started.' ),
        'term_page_welcome_fr' => array( __( 'Message d’accueil (FR)', 'hdgavi-portfolio' ), 'Bienvenue dans le terminal HD GAVI. Tapez "help" pour commencer.' ),
        'term_page_welcome_es' => array( __( 'Message d’accueil (ES)', 'hdgavi-portfolio' ), 'Bienvenido al terminal HD GAVI. Escribe "help" para comenzar.' ),
        'term_page_help_en'    => array( __( 'Aide (EN)', 'hdgavi-portfolio' ), 'Available commands: help, about, skills, experience, projects, education, contact, cv, clear, exit' ),
        'term_page_help_fr'    => array( __( 'Aide (FR)', 'hdgavi-portfolio' ), 'Commandes disponibles : help, about, skills, experience, projects, education, contact, cv, clear, exit' ),
        'term_page_help_es'    => array( __( 'Aide (ES)', 'hdgavi-portfolio' ), 'Comandos disponibles: help, about, skills, experience, projects, education, contact, cv, clear, exit' ),
        'term_page_unknown_en' => array( __( 'Commande inconnue (EN, {cmd} = commande saisie)', 'hdgavi-portfolio' ), 'Unknown command: {cmd}. Type "help".' ),
        'term_page_unknown_fr' => array( __( 'Commande inconnue (FR, {cmd} = commande saisie)', 'hdgavi-portfolio' ), 'Commande inconnue : {cmd}. Tapez "help".' ),
        'term_page_unknown_es' => array( __( 'Commande inconnue (ES, {cmd} = commande saisie)', 'hdgavi-portfolio' ), 'Comando desconocido: {cmd}. Escribe "help".' ),
    );
    foreach ( $term_page_fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_terminal_page' ) );
    }

    /* ── Copy e-mail button ── */
    $wp_customize->add_section( 'hdgavi_copy_email', array(
        'title'    => __( 'Bouton « copier l’e-mail »', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 160,
    ) );
    $wp_customize->add_setting( 'copy_email_enabled', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'copy_email_enabled', array( 'label' => __( 'Afficher le bouton', 'hdgavi-portfolio' ), 'section' => 'hdgavi_copy_email', 'type' => 'checkbox' ) );
    $copy_fields = array(
        'copy_feedback_en' => array( __( 'Confirmation (EN)', 'hdgavi-portfolio' ), 'Copied' ),
        'copy_feedback_fr' => array( __( 'Confirmation (FR)', 'hdgavi-portfolio' ), 'Copié' ),
        'copy_feedback_es' => array( __( 'Confirmation (ES)', 'hdgavi-portfolio' ), 'Copiado' ),
    );
    foreach ( $copy_fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_copy_email' ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_effects' );
