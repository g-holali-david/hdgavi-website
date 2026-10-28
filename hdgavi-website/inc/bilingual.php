<?php
/**
 * HD GAVI Portfolio — Multilingual system (EN/FR/ES)
 * Outputs all language spans, CSS hides inactive ones, JS toggles
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Get supported languages
 */
function hdgavi_get_languages() {
    return array( 'en', 'fr', 'es' );
}

/**
 * Get a multilingual customizer value.
 */
function hdgavi_bilingual( $key_base, $default_en = '', $default_fr = '' ) {
    return array(
        'en' => hdgavi_opt( $key_base . '_en', $default_en ),
        'fr' => hdgavi_opt( $key_base . '_fr', $default_fr ),
        'es' => hdgavi_opt( $key_base . '_es', '' ),
    );
}

/**
 * Output multilingual span set.
 */
function hdgavi_bilingual_text( $key_base, $default_en = '', $default_fr = '' ) {
    $texts   = hdgavi_bilingual( $key_base, $default_en, $default_fr );
    $default = hdgavi_opt( 'default_lang', 'en' );
    foreach ( hdgavi_get_languages() as $lang ) {
        $content = ( $lang === 'es' && empty( $texts['es'] ) ) ? $texts['en'] : $texts[ $lang ];
        $hidden  = ( $lang !== $default ) ? ' aria-hidden="true"' : '';
        echo '<span class="lang-' . $lang . '" data-lang="' . $lang . '"' . $hidden . '>' . esc_html( $content ) . '</span>';
    }
}

/**
 * Output multilingual HTML content
 */
function hdgavi_bilingual_html( $key_base, $default_en = '', $default_fr = '' ) {
    $texts   = hdgavi_bilingual( $key_base, $default_en, $default_fr );
    $default = hdgavi_opt( 'default_lang', 'en' );
    foreach ( hdgavi_get_languages() as $lang ) {
        $content = ( $lang === 'es' && empty( $texts['es'] ) ) ? $texts['en'] : $texts[ $lang ];
        $hidden  = ( $lang !== $default ) ? ' aria-hidden="true"' : '';
        echo '<div class="lang-' . $lang . '" data-lang="' . $lang . '"' . $hidden . '>' . wp_kses_post( $content ) . '</div>';
    }
}

/**
 * Get multilingual navigation labels
 */
function hdgavi_nav_labels() {
    static $labels = null;
    if ( $labels !== null ) return $labels;
    $labels = array(
        'about'          => array( 'en' => hdgavi_opt( 'nav_about_en', 'About' ),          'fr' => hdgavi_opt( 'nav_about_fr', 'Qui je suis' ),   'es' => hdgavi_opt( 'nav_about_es', 'Sobre mí' ) ),
        'skills'         => array( 'en' => hdgavi_opt( 'nav_skills_en', 'Skills' ),         'fr' => hdgavi_opt( 'nav_skills_fr', 'Compétences' ),   'es' => hdgavi_opt( 'nav_skills_es', 'Habilidades' ) ),
        'experience'     => array( 'en' => hdgavi_opt( 'nav_experience_en', 'Experience' ),  'fr' => hdgavi_opt( 'nav_experience_fr', 'Expérience' ), 'es' => hdgavi_opt( 'nav_experience_es', 'Experiencia' ) ),
        'projects'       => array( 'en' => hdgavi_opt( 'nav_projects_en', 'Projects' ),     'fr' => hdgavi_opt( 'nav_projects_fr', 'Projets' ),     'es' => hdgavi_opt( 'nav_projects_es', 'Proyectos' ) ),
        'education'      => array( 'en' => hdgavi_opt( 'nav_education_en', 'Education' ),   'fr' => hdgavi_opt( 'nav_education_fr', 'Formation' ),  'es' => hdgavi_opt( 'nav_education_es', 'Formación' ) ),
        'contact'        => array( 'en' => hdgavi_opt( 'nav_contact_en', 'Contact' ),       'fr' => hdgavi_opt( 'nav_contact_fr', 'Contact' ),      'es' => hdgavi_opt( 'nav_contact_es', 'Contacto' ) ),
        'watch'          => array( 'en' => hdgavi_opt( 'nav_watch_en', 'Tech Watch' ),      'fr' => hdgavi_opt( 'nav_watch_fr', 'Veille' ),         'es' => hdgavi_opt( 'nav_watch_es', 'Vigilancia' ) ),
        'blog'           => array( 'en' => hdgavi_opt( 'nav_blog_en', 'Blog' ),             'fr' => hdgavi_opt( 'nav_blog_fr', 'Blog' ),            'es' => hdgavi_opt( 'nav_blog_es', 'Blog' ) ),
        'certifications' => array( 'en' => hdgavi_opt( 'nav_certs_en', 'Certs' ),           'fr' => hdgavi_opt( 'nav_certs_fr', 'Certifs' ),        'es' => hdgavi_opt( 'nav_certs_es', 'Certif.' ) ),
    );
    return $labels;
}

/**
 * Inline CSS to hide inactive language elements
 */
function hdgavi_bilingual_inline_css() {
    $langs = hdgavi_get_languages();
    $css = '';

    // Default: hide all non-default languages
    $default = hdgavi_opt( 'default_lang', 'en' );
    foreach ( $langs as $lang ) {
        if ( $lang === $default ) continue;
        $css .= "[data-lang=\"{$lang}\"] { display: none; }\n";
        $css .= "div[data-lang=\"{$lang}\"], ul[data-lang=\"{$lang}\"], ol[data-lang=\"{$lang}\"] { display: none; }\n";
    }

    // Rules for each active language
    foreach ( $langs as $active ) {
        foreach ( $langs as $lang ) {
            if ( $lang === $active ) {
                $css .= "html[lang=\"{$active}\"] [data-lang=\"{$lang}\"] { display: inline; }\n";
                $css .= "html[lang=\"{$active}\"] div[data-lang=\"{$lang}\"] { display: block; }\n";
                $css .= "html[lang=\"{$active}\"] ul[data-lang=\"{$lang}\"], html[lang=\"{$active}\"] ol[data-lang=\"{$lang}\"] { display: block; }\n";
            } else {
                $css .= "html[lang=\"{$active}\"] [data-lang=\"{$lang}\"] { display: none; }\n";
                $css .= "html[lang=\"{$active}\"] div[data-lang=\"{$lang}\"] { display: none; }\n";
                $css .= "html[lang=\"{$active}\"] ul[data-lang=\"{$lang}\"], html[lang=\"{$active}\"] ol[data-lang=\"{$lang}\"] { display: none; }\n";
            }
        }
    }

    wp_add_inline_style( 'hdgavi-style', $css );
}
add_action( 'wp_enqueue_scripts', 'hdgavi_bilingual_inline_css', 25 );
