<?php
/**
 * Front page — delegates to the Splash Page template.
 * Avoids code duplication with page-templates/splash.php
 * and ensures header.php correctly detects splash context via is_front_page().
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

locate_template( 'page-templates/splash.php', true, true );
