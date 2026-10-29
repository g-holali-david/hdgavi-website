<?php
/**
 * HD GAVI Portfolio — Footer
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$is_terminal = is_page_template( 'page-templates/terminal.php' );
$show_footer = hdgavi_opt( 'show_footer', true );
$footer_name = hdgavi_opt( 'footer_name', hdgavi_opt( 'general_name', 'Holali David GAVI' ) );

if ( ! $is_terminal ) : ?>
</main>

<?php if ( $show_footer ) : ?>
<footer class="site-footer wrap">
    <p>&copy; <?php echo esc_html( wp_date( 'Y' ) ); ?> <?php echo esc_html( $footer_name ); ?></p>
    <?php $footer_links = hdgavi_footer_nav(); ?>
    <?php if ( $footer_links ) : ?>
    <nav aria-label="Footer">
        <ul>
            <?php foreach ( $footer_links as $item ) : ?>
            <li><a href="<?php echo esc_url( $item['url'] ); ?>"><?php echo hdgavi_tri_arr( $item['labels'] ); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>
    <?php endif; ?>
</footer>
<?php endif; ?>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
