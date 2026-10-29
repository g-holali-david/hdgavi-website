<?php
/**
 * Template Name: Terminal (Hidden)
 * Plain monospace command page (not linked). Commands are handled by theme.js (initTerminalPage).
 * header.php / footer.php print no site header, <main> or footer on this template.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<main id="pageContent">
<div class="terminal-page" id="terminalPage">
    <h1 class="vh"><?php echo esc_html( hdgavi_opt( 'general_name', 'Holali David GAVI' ) ); ?> — Terminal</h1>
    <div class="term-welcome" id="termWelcome"></div>
    <div id="termHistory" aria-live="polite"></div>
    <div class="term-input-line">
        <label class="term-prompt" for="termInput"><?php echo esc_html( hdgavi_opt( 'term_page_prompt', 'visitor@hdgavi:~$' ) ); ?></label>
        <input type="text" id="termInput" autofocus autocomplete="off" autocapitalize="off" spellcheck="false">
    </div>
</div>
</main>
<?php get_footer(); ?>
