<?php
/**
 * 404 page
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<section class="sec wrap sec--first" aria-labelledby="t-404">
    <h1 class="sec-title" id="t-404"><?php echo hdgavi_tri( 'Page not found', 'Page introuvable', 'Página no encontrada' ); ?></h1>
    <div class="sec-body">
        <div class="entry">
            <p class="when">404</p>
            <div class="what">
                <p><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_404_text', 'This page does not exist or has been moved.', 'Cette page n’existe pas ou a été déplacée.', 'Esta página no existe o ha sido movida.' ) ); ?></p>
                <p class="desc"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_404_btn', 'Back to the home page', 'Retour à l’accueil', 'Volver al inicio' ) ); ?></a></p>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
