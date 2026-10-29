<?php
/**
 * Template Name: Projects / Projets
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

get_template_part( 'template-parts/cv-projects', null, array( 'heading' => 'h1', 'first' => true ) );

get_footer();
