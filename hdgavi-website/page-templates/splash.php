<?php
/**
 * Template Name: Home / Accueil (CV)
 * The home page reads like the printed CV: summary, experience, projects, skills, education, contact.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

get_template_part( 'template-parts/cv-intro', null, array( 'variant' => 'home' ) );
get_template_part( 'template-parts/cv-experience' );
get_template_part( 'template-parts/cv-projects', null, array( 'compact' => true ) );
get_template_part( 'template-parts/cv-skills' );
get_template_part( 'template-parts/cv-education' );
get_template_part( 'template-parts/cv-contact' );

get_footer();
