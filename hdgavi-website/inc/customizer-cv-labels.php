<?php
/**
 * HD GAVI Portfolio — Customizer: interface labels of the CV pages
 * Every title, field label and link text of the new templates can be changed here, in the three languages.
 * Defaults: hdgavi_cv_label_defaults() in inc/cv-content.php.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customize_cv_labels( $wp_customize ) {
    $wp_customize->add_section( 'hdgavi_cv_labels', array(
        'title'       => __( 'Libellés de l’interface', 'hdgavi-portfolio' ),
        'description' => __( 'Titres de sections, étiquettes et liens des pages CV, en anglais, français et espagnol. Laisser vide pour revenir à la valeur par défaut.', 'hdgavi-portfolio' ),
        'priority'    => 31,
    ) );

    $langs = array( 'en' => 'EN', 'fr' => 'FR', 'es' => 'ES' );
    foreach ( hdgavi_cv_label_defaults() as $key => $defaults ) {
        $i = 0;
        foreach ( $langs as $lang => $tag ) {
            $id = 'label_cv_' . $key . '_' . $lang;
            $wp_customize->add_setting( $id, array(
                'default'           => $defaults[ $i ],
                'sanitize_callback' => 'sanitize_text_field',
            ) );
            $wp_customize->add_control( $id, array(
                'label'   => $defaults[1] . ' (' . $tag . ')',
                'section' => 'hdgavi_cv_labels',
                'type'    => 'text',
            ) );
            $i++;
        }
    }
}
add_action( 'customize_register', 'hdgavi_customize_cv_labels' );
