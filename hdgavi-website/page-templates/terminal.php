<?php
/**
 * Template Name: Terminal (Hidden)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<div class="terminal-page" id="terminalPage">
    <div class="term-welcome" id="termWelcome"></div>
    <div id="termHistory"></div>
    <div class="term-input-line">
        <span style="color:var(--accent)"><?php echo esc_html( hdgavi_opt( 'term_page_prompt', 'visitor@hdgavi:~$' ) ); ?></span>
        <input type="text" id="termInput" autofocus autocomplete="off" spellcheck="false">
    </div>
</div>

<?php get_footer(); ?>
