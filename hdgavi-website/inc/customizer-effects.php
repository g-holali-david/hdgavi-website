<?php
/**
 * HD GAVI Portfolio — Customizer: Visual Effects & Features
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_effects( $wp_customize ) {
    $panel = 'hdgavi_panel';

    /* ── Visual Effects ── */
    $wp_customize->add_section( 'hdgavi_effects', array(
        'title'    => __( '11. Effets visuels', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 110,
    ) );

    // Particles
    $wp_customize->add_setting( 'fx_particles', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'fx_particles', array( 'label' => __( 'Particules splash', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'fx_particles_color', array( 'default' => 'rgba(6,182,212,0.3)', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'fx_particles_color', array( 'label' => __( 'Couleur particules', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects' ) );
    $wp_customize->add_setting( 'fx_particles_speed', array( 'default' => 1, 'sanitize_callback' => 'hdgavi_sanitize_number' ) );
    $wp_customize->add_control( 'fx_particles_speed', array( 'label' => __( 'Vitesse particules', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects', 'type' => 'number', 'input_attrs' => array( 'min' => 0.1, 'max' => 5, 'step' => 0.1 ) ) );
    $wp_customize->add_setting( 'fx_particles_density', array( 'default' => 50, 'sanitize_callback' => 'absint' ) );
    $wp_customize->add_control( 'fx_particles_density', array( 'label' => __( 'Densité particules', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects', 'type' => 'number', 'input_attrs' => array( 'min' => 10, 'max' => 150 ) ) );

    // Counter
    $wp_customize->add_setting( 'fx_counter', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'fx_counter', array( 'label' => __( 'Animation compteur stats', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects', 'type' => 'checkbox' ) );

    // Progress bar
    $wp_customize->add_setting( 'fx_progress_bar', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'fx_progress_bar', array( 'label' => __( 'Barre de progression', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'fx_progress_color', array( 'default' => '', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'fx_progress_color', array( 'label' => __( 'Couleur barre (vide = accent)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects' ) );

    // Lot 7 effects
    $wp_customize->add_setting( 'fx_custom_cursor', array( 'default' => false, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'fx_custom_cursor', array( 'label' => __( 'Curseur personnalisé (dot + ring)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'fx_parallax', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'fx_parallax', array( 'label' => __( 'Parallaxe splash (depth on scroll)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects', 'type' => 'checkbox' ) );

    $wp_customize->add_setting( 'fx_grain', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'fx_grain', array( 'label' => __( 'Grain film (dark mode overlay)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_effects', 'type' => 'checkbox' ) );

    /* ── Terminal splash ── */
    $wp_customize->add_section( 'hdgavi_terminal', array(
        'title'    => __( '12. Terminal interactif', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 120,
    ) );
    $wp_customize->add_setting( 'terminal_enabled', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'terminal_enabled', array( 'label' => __( 'Activer le terminal splash', 'hdgavi-portfolio' ), 'section' => 'hdgavi_terminal', 'type' => 'checkbox' ) );

    $default_en = json_encode( array(
        array( 'cmd' => '$ whoami', 'out' => 'Holali David GAVI — Cloud & DevOps Engineer' ),
        array( 'cmd' => '$ kubectl get skills', 'out' => 'Docker ✓  Kubernetes ✓  Helm ✓  Java ✓' ),
        array( 'cmd' => '$ cat motivation.txt', 'out' => 'Curious. Persistent. Passionate about code.' ),
    ) );
    $default_fr = json_encode( array(
        array( 'cmd' => '$ whoami', 'out' => 'Holali David GAVI — Ingénieur Cloud & DevOps' ),
        array( 'cmd' => '$ kubectl get skills', 'out' => 'Docker ✓  Kubernetes ✓  Helm ✓  Java ✓' ),
        array( 'cmd' => '$ cat motivation.txt', 'out' => 'Curieux. Persévérant. Passionné par le code.' ),
    ) );
    $wp_customize->add_setting( 'terminal_lines_en', array( 'default' => $default_en, 'sanitize_callback' => 'sanitize_textarea_field' ) );
    $wp_customize->add_control( 'terminal_lines_en', array( 'label' => __( 'Lignes terminal EN (JSON)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_terminal', 'type' => 'textarea', 'description' => __( 'Format JSON: [{"cmd":"$ whoami","out":"response"},...]', 'hdgavi-portfolio' ) ) );
    $wp_customize->add_setting( 'terminal_lines_fr', array( 'default' => $default_fr, 'sanitize_callback' => 'sanitize_textarea_field' ) );
    $wp_customize->add_control( 'terminal_lines_fr', array( 'label' => __( 'Lignes terminal FR (JSON)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_terminal', 'type' => 'textarea' ) );

    /* ── Hidden terminal page ── */
    $wp_customize->add_section( 'hdgavi_terminal_page', array(
        'title'    => __( '13. Page terminal cachée', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 130,
    ) );
    $wp_customize->add_setting( 'terminal_page_enabled', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'terminal_page_enabled', array( 'label' => __( 'Activer la page terminal', 'hdgavi-portfolio' ), 'section' => 'hdgavi_terminal_page', 'type' => 'checkbox' ) );

    // Terminal page texts
    $wp_customize->add_setting( 'term_page_prompt', array( 'default' => 'visitor@hdgavi:~$', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'term_page_prompt', array( 'label' => __( 'Prompt du terminal', 'hdgavi-portfolio' ), 'section' => 'hdgavi_terminal_page' ) );
    $term_page_fields = array(
        'term_page_welcome_en' => array( __( 'Welcome message EN', 'hdgavi-portfolio' ), 'Welcome to HD GAVI terminal. Type "help" to get started.' ),
        'term_page_welcome_fr' => array( __( 'Welcome message FR', 'hdgavi-portfolio' ), 'Bienvenue dans le terminal HD GAVI. Tapez "help" pour commencer.' ),
        'term_page_help_en'    => array( __( 'Help text EN', 'hdgavi-portfolio' ), 'Available commands: help, about, skills, experience, projects, education, contact, cv, clear, exit' ),
        'term_page_help_fr'    => array( __( 'Help text FR', 'hdgavi-portfolio' ), 'Commandes disponibles : help, about, skills, experience, projects, education, contact, cv, clear, exit' ),
        'term_page_unknown_en' => array( __( 'Unknown cmd EN ({cmd} = placeholder)', 'hdgavi-portfolio' ), 'Unknown command: {cmd}. Type "help".' ),
        'term_page_unknown_fr' => array( __( 'Unknown cmd FR ({cmd} = placeholder)', 'hdgavi-portfolio' ), 'Commande inconnue : {cmd}. Tapez "help".' ),
    );
    foreach ( $term_page_fields as $k => $v ) {
        $wp_customize->add_setting( $k, array( 'default' => $v[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $k, array( 'label' => $v[0], 'section' => 'hdgavi_terminal_page' ) );
    }

    /* ── Easter egg ── */
    $wp_customize->add_section( 'hdgavi_konami', array(
        'title'    => __( '14. Easter egg Konami', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 140,
    ) );
    $wp_customize->add_setting( 'konami_enabled', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'konami_enabled', array( 'label' => __( 'Activer Konami code', 'hdgavi-portfolio' ), 'section' => 'hdgavi_konami', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'konami_msg_en', array( 'default' => "🎮 You know the Konami code? We're going to get along.", 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'konami_msg_en', array( 'label' => __( 'Message EN', 'hdgavi-portfolio' ), 'section' => 'hdgavi_konami' ) );
    $wp_customize->add_setting( 'konami_msg_fr', array( 'default' => '🎮 Tu connais le Konami code ? On va bien s\'entendre.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'konami_msg_fr', array( 'label' => __( 'Message FR', 'hdgavi-portfolio' ), 'section' => 'hdgavi_konami' ) );

    /* ── GitHub Repos ── */
    $wp_customize->add_section( 'hdgavi_gh_repos', array(
        'title'    => __( '15. GitHub Repos Preview', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 150,
    ) );
    $wp_customize->add_setting( 'gh_repos_enabled', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'gh_repos_enabled', array( 'label' => __( 'Afficher les repos GitHub', 'hdgavi-portfolio' ), 'section' => 'hdgavi_gh_repos', 'type' => 'checkbox' ) );

    /* ── Copy email ── */
    $wp_customize->add_section( 'hdgavi_copy_email', array(
        'title'    => __( '16. Bouton copier email', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 160,
    ) );
    $wp_customize->add_setting( 'copy_email_enabled', array( 'default' => true, 'sanitize_callback' => 'hdgavi_sanitize_bool' ) );
    $wp_customize->add_control( 'copy_email_enabled', array( 'label' => __( 'Activer bouton copier', 'hdgavi-portfolio' ), 'section' => 'hdgavi_copy_email', 'type' => 'checkbox' ) );
    $wp_customize->add_setting( 'copy_feedback_en', array( 'default' => 'Copied!', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'copy_feedback_en', array( 'label' => __( 'Feedback EN', 'hdgavi-portfolio' ), 'section' => 'hdgavi_copy_email' ) );
    $wp_customize->add_setting( 'copy_feedback_fr', array( 'default' => 'Copié !', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'copy_feedback_fr', array( 'label' => __( 'Feedback FR', 'hdgavi-portfolio' ), 'section' => 'hdgavi_copy_email' ) );
}
add_action( 'customize_register', 'hdgavi_customizer_effects' );
