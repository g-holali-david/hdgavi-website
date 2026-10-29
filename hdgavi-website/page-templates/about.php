<?php
/**
 * Template Name: About / À propos
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

get_template_part( 'template-parts/cv-intro', null, array( 'variant' => 'about' ) );

get_footer();
