<?php
/**
 * HD GAVI Portfolio — Customizer: About page
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_about( $wp_customize ) {
    $panel = 'hdgavi_panel';

    $wp_customize->add_section( 'hdgavi_about', array(
        'title'    => __( '3. À propos', 'hdgavi-portfolio' ),
        'panel'    => $panel,
        'priority' => 20,
    ) );

    // Badge
    $wp_customize->add_setting( 'about_badge_en', array( 'default' => 'Cloud & DevOps Engineer', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_badge_en', array( 'label' => __( 'Badge (EN)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_about' ) );
    $wp_customize->add_setting( 'about_badge_fr', array( 'default' => 'Ingénieur Cloud & DevOps', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_badge_fr', array( 'label' => __( 'Badge (FR)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_about' ) );

    // Personality text (without blockquote — quote is separate field)
    $default_en = '<p>I\'m a curious person. When I discover a topic that interests me, I dig until I truly understand how it works. That\'s how I learned IT — on my own, in the evenings, before it even became my job.</p><p>What I love most about this job is that when I\'m working, everything else fades away. Coding gives me real satisfaction, a kind of flow where hours pass without me noticing. When I encounter a problem, my instinct is to think of a solution — and often, it turns into yet another personal project.</p><p>I\'m patient and persistent. Changing careers twice, starting studies from scratch, juggling two Master\'s degrees in evening classes while working — that takes discipline. But I don\'t see it as a sacrifice. I genuinely enjoy learning.</p><p>I always strive for quality in what I produce. For me, IT should automate as much as possible, simplify, and make things more reliable. At work, I ask questions when I don\'t know something, I document what I do, and I try to leave things clearer than I found them.</p><p>When I understand something, I need to structure it and document it — first for myself, then for others. I believe that well-commented code and clear documentation is a form of respect for those who come after. I\'m not the loudest in a team, but you can count on me.</p>';
    $default_fr = '<p>Je suis quelqu\'un de curieux. Quand je découvre un sujet qui m\'intéresse, je creuse jusqu\'à comprendre comment ça fonctionne vraiment. C\'est comme ça que j\'ai appris l\'informatique — seul, le soir, avant même d\'en faire mon métier.</p><p>Ce que j\'aime le plus dans ce métier, c\'est qu\'en travaillant j\'oublie tout le reste. Le code me procure une vraie satisfaction, une sorte de flow où les heures passent sans que je m\'en rende compte. Quand je rencontre un problème, mon réflexe c\'est de réfléchir à une solution — et souvent, ça se transforme en un projet personnel de plus.</p><p>Je suis patient et persévérant. Changer de carrière deux fois, reprendre les études à zéro, cumuler deux masters en cours du soir tout en travaillant — ça demande de la discipline. Mais je ne vois pas ça comme un sacrifice, j\'aime apprendre.</p><p>Je cherche toujours la qualité dans ce que je produis. Pour moi, l\'informatique doit servir à automatiser au maximum, à simplifier, à rendre les choses plus fiables. Au travail, je pose des questions quand je ne sais pas, je documente ce que je fais, et j\'essaie de laisser les choses plus claires que je ne les ai trouvées.</p><p>Quand je comprends quelque chose, j\'ai besoin de le structurer et de le documenter — d\'abord pour moi, puis pour les autres. Je crois que du code bien commenté et une documentation claire, c\'est une forme de respect envers ceux qui passeront après. Je ne suis pas le plus bruyant dans une équipe, mais on peut compter sur moi.</p>';

    // Quote (separate configurable field)
    $wp_customize->add_setting( 'about_quote_en', array( 'default' => 'I don\'t look for the easy way — I look to understand.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_quote_en', array( 'label' => __( 'Citation (EN)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_about' ) );
    $wp_customize->add_setting( 'about_quote_fr', array( 'default' => 'Je ne cherche pas la facilité, je cherche à comprendre.', 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'about_quote_fr', array( 'label' => __( 'Citation (FR)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_about' ) );

    $wp_customize->add_setting( 'about_text_en', array( 'default' => $default_en, 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'about_text_en', array( 'label' => __( 'Texte personnalité (EN)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_about', 'type' => 'textarea' ) );
    $wp_customize->add_setting( 'about_text_fr', array( 'default' => $default_fr, 'sanitize_callback' => 'wp_kses_post' ) );
    $wp_customize->add_control( 'about_text_fr', array( 'label' => __( 'Texte personnalité (FR)', 'hdgavi-portfolio' ), 'section' => 'hdgavi_about', 'type' => 'textarea' ) );

    // Stats (4 slots)
    for ( $i = 1; $i <= 4; $i++ ) {
        $defaults = array(
            1 => array( '1+', 'Year in DevOps & Cloud', 'An en DevOps & Cloud' ),
            2 => array( '8', 'Technical projects', 'Projets techniques' ),
            3 => array( '2', 'Parallel Master\'s degrees', 'Mastères en parallèle' ),
            4 => array( '3', 'Languages spoken', 'Langues parlées' ),
        );
        $d = $defaults[ $i ];
        $wp_customize->add_setting( "stat_{$i}_number", array( 'default' => $d[0], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "stat_{$i}_number", array( 'label' => sprintf( __( 'Stat %d — Chiffre', 'hdgavi-portfolio' ), $i ), 'section' => 'hdgavi_about' ) );
        $wp_customize->add_setting( "stat_{$i}_label_en", array( 'default' => $d[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "stat_{$i}_label_en", array( 'label' => sprintf( __( 'Stat %d — Label EN', 'hdgavi-portfolio' ), $i ), 'section' => 'hdgavi_about' ) );
        $wp_customize->add_setting( "stat_{$i}_label_fr", array( 'default' => $d[2], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "stat_{$i}_label_fr", array( 'label' => sprintf( __( 'Stat %d — Label FR', 'hdgavi-portfolio' ), $i ), 'section' => 'hdgavi_about' ) );
    }

    // Personality traits (7 slots)
    $trait_defaults = array(
        1 => array( 'Curious', 'Curieux', 'Self-taught since 2016 — I learn because I want to, not because I have to', 'Autodidacte depuis 2016, j\'apprends par envie, pas par obligation', '#06B6D4' ),
        2 => array( 'Passionate', 'Passionné', 'Coding makes everything else fade away — it\'s where I feel at home', 'Le code me fait oublier tout le reste — c\'est là que je me sens à ma place', '#005386' ),
        3 => array( 'Persistent', 'Persévérant', 'Two career changes, two parallel Master\'s degrees, still standing', 'Deux reconversions, deux masters en parallèle, toujours debout', '#22C55E' ),
        4 => array( 'Creative', 'Créatif', 'A problem = a solution to build. That\'s what fuels my side projects', 'Un problème = une solution à développer. C\'est ce qui alimente mes projets perso', '#F59E0B' ),
        5 => array( 'Rigorous', 'Rigoureux', 'I chase quality, I document everything, I aim for perfection', 'Je cherche la qualité, je documente, je vise la perfection', '#06B6D4' ),
        6 => array( 'Pragmatic', 'Pragmatique', 'IT should automate and simplify — not add complexity', 'L\'informatique doit automatiser et simplifier — pas compliquer', '#005386' ),
        7 => array( 'Reliable', 'Fiable', 'Not the loudest, but you can count on me', 'Pas le plus bruyant, mais on peut compter sur moi', '#22C55E' ),
    );
    for ( $i = 1; $i <= 7; $i++ ) {
        $d = $trait_defaults[ $i ];
        $wp_customize->add_setting( "trait_{$i}_en", array( 'default' => $d[0], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "trait_{$i}_en", array( 'label' => sprintf( __( 'Trait %d — Titre EN', 'hdgavi-portfolio' ), $i ), 'section' => 'hdgavi_about' ) );
        $wp_customize->add_setting( "trait_{$i}_fr", array( 'default' => $d[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "trait_{$i}_fr", array( 'label' => sprintf( __( 'Trait %d — Titre FR', 'hdgavi-portfolio' ), $i ), 'section' => 'hdgavi_about' ) );
        $wp_customize->add_setting( "trait_{$i}_desc_en", array( 'default' => $d[2], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "trait_{$i}_desc_en", array( 'label' => sprintf( __( 'Trait %d — Desc EN', 'hdgavi-portfolio' ), $i ), 'section' => 'hdgavi_about' ) );
        $wp_customize->add_setting( "trait_{$i}_desc_fr", array( 'default' => $d[3], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( "trait_{$i}_desc_fr", array( 'label' => sprintf( __( 'Trait %d — Desc FR', 'hdgavi-portfolio' ), $i ), 'section' => 'hdgavi_about' ) );
        $wp_customize->add_setting( "trait_{$i}_color", array( 'default' => $d[4], 'sanitize_callback' => 'sanitize_hex_color' ) );
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, "trait_{$i}_color", array(
            'label'   => sprintf( __( 'Trait %d — Couleur', 'hdgavi-portfolio' ), $i ),
            'section' => 'hdgavi_about',
        ) ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_about' );
