<?php
/**
 * Template Name: Resources / Boîte à outils
 * Downloadable resources (CPT hdgavi_resource) with a category / price filter (theme.js).
 * Not linked from the menu.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

// Get all resource categories
$categories = get_terms( array(
    'taxonomy'   => 'hdgavi_resource_cat',
    'hide_empty' => true,
    'orderby'    => 'name',
) );
if ( is_wp_error( $categories ) ) $categories = array();

// Get all resources and their category slugs (one lookup per resource)
$resources = hdgavi_get_cpt_posts( 'hdgavi_resource' );
if ( $resources ) update_postmeta_cache( wp_list_pluck( $resources, 'ID' ) );
$res_terms = array();
foreach ( $resources as $r ) {
    $terms = wp_get_post_terms( $r->ID, 'hdgavi_resource_cat', array( 'fields' => 'slugs' ) );
    $res_terms[ $r->ID ] = is_array( $terms ) ? $terms : array();
}
?>
<section class="sec wrap sec--first" aria-labelledby="t-resources">
    <h1 class="sec-title" id="t-resources"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_res_title', 'Resources', 'Ressources', 'Recursos' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_res_desc', 'Templates, cheat sheets and scripts to download.', 'Modèles, aide-mémoire et scripts à télécharger.', 'Plantillas, chuletas y scripts para descargar.' ) ); ?></p>
        <?php endif; ?>

        <?php if ( empty( $resources ) ) : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri( 'No resource yet.', 'Aucune ressource pour le moment.', 'Ningún recurso por el momento.' ); ?></p>
        <?php else : ?>
        <div class="res-layout">
            <div class="res-sidebar res-nav" role="group">
                <button type="button" class="res-nav-item active" data-res-filter="all"><?php echo hdgavi_tri( 'All', 'Tout', 'Todo' ); ?> <span class="res-nav-count"><?php echo esc_html( count( $resources ) ); ?></span></button>
                <?php foreach ( $categories as $cat ) :
                    $cat_count = 0;
                    foreach ( $res_terms as $slugs ) {
                        if ( in_array( $cat->slug, $slugs, true ) ) $cat_count++;
                    }
                ?>
                <button type="button" class="res-nav-item" data-res-filter="<?php echo esc_attr( $cat->slug ); ?>"><?php echo esc_html( $cat->name ); ?> <span class="res-nav-count"><?php echo esc_html( $cat_count ); ?></span></button>
                <?php endforeach; ?>
                <span class="res-nav-divider" aria-hidden="true"></span>
                <button type="button" class="res-nav-item" data-res-filter="free"><?php echo hdgavi_tri( 'Free', 'Gratuit', 'Gratis' ); ?></button>
                <button type="button" class="res-nav-item" data-res-filter="paid"><?php echo hdgavi_tri( 'Paid', 'Payant', 'De pago' ); ?></button>
            </div>

            <div class="res-content entry-list">
                <?php foreach ( $resources as $res ) :
                    $id      = $res->ID;
                    $type    = get_post_meta( $id, '_res_type', true );
                    $type    = $type ? $type : 'free';
                    $price   = get_post_meta( $id, '_res_price', true );
                    $buy_url = get_post_meta( $id, '_res_buy_url', true );
                    $dl_url  = get_post_meta( $id, '_res_download_url', true );
                    $gated   = get_post_meta( $id, '_res_gated', true );
                    $format  = get_post_meta( $id, '_res_file_format', true );
                ?>
                <article class="res-card" data-res-cats="<?php echo esc_attr( implode( ' ', $res_terms[ $id ] ) ); ?>" data-res-type="<?php echo esc_attr( $type ); ?>">
                    <p class="res-meta"><?php
                        if ( 'paid' === $type && $price ) {
                            echo esc_html( $price );
                        } else {
                            echo hdgavi_tri( 'Free', 'Gratuit', 'Gratis' );
                        }
                        if ( $format ) echo ' · ' . esc_html( $format );
                    ?></p>
                    <div class="what">
                        <h2><?php echo esc_html( get_the_title( $res ) ); ?></h2>
                        <p class="desc"><?php echo hdgavi_tri_arr( hdgavi_meta_tri( $id, '_res_desc' ) ); ?></p>
                        <?php if ( ( 'paid' === $type && $buy_url ) || $gated || $dl_url ) : ?>
                        <div class="res-card-actions">
                            <?php if ( 'paid' === $type && $buy_url ) : ?>
                            <a href="<?php echo esc_url( $buy_url ); ?>" class="res-btn" target="_blank" rel="noopener"><?php echo hdgavi_tri( 'Buy', 'Acheter', 'Comprar' ); ?></a>
                            <?php elseif ( $gated ) : ?>
                            <button type="button" class="res-btn hdgavi-res-gate-trigger" data-res-id="<?php echo esc_attr( $id ); ?>" data-res-url="<?php echo esc_attr( $dl_url ); ?>"><?php echo hdgavi_tri( 'Download', 'Télécharger', 'Descargar' ); ?></button>
                            <?php elseif ( $dl_url ) : ?>
                            <a href="<?php echo esc_url( $dl_url ); ?>" class="res-btn" download><?php echo hdgavi_tri( 'Download', 'Télécharger', 'Descargar' ); ?></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
