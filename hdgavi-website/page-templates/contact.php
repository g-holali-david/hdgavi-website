<?php
/**
 * Template Name: Contact
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

get_template_part( 'template-parts/cv-contact', null, array( 'heading' => 'h1', 'first' => true, 'form' => true ) );

get_footer();
