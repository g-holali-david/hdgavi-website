<?php
/**
 * CV section: technical projects (CPT hdgavi_project).
 * Args: heading = 'h1' | 'h2', first = bool, compact = bool (home: description only)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$args  = wp_parse_args( isset( $args ) ? $args : array(), array( 'heading' => 'h2', 'first' => false, 'compact' => false ) );
$items = hdgavi_get_cpt_posts( 'hdgavi_project' );
if ( ! $items ) return;
update_postmeta_cache( wp_list_pluck( $items, 'ID' ) );

$h      = ( 'h1' === $args['heading'] ) ? 'h1' : 'h2';
$hh     = ( 'h1' === $h ) ? 'h2' : 'h3';
$github = hdgavi_opt( 'contact_github', '' );
?>
<section class="sec wrap<?php echo $args['first'] ? ' sec--first' : ''; ?>" id="projects" aria-labelledby="t-projects">
    <<?php echo $h; ?> class="sec-title" id="t-projects"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'projects' ) ); ?></<?php echo $h; ?>>
    <div class="sec-body">
        <?php foreach ( $items as $item ) :
            $id      = $item->ID;
            $link    = get_post_meta( $id, '_proj_link', true );
            $gallery = get_post_meta( $id, '_proj_gallery', true );
            // Only real screenshots: placeholder services are never shown.
            $images  = array_values( array_filter( array_map( 'trim', explode( "\n", (string) $gallery ) ), function ( $url ) {
                return $url && false === strpos( $url, 'placehold' );
            } ) );
        ?>
        <article class="entry">
            <?php echo hdgavi_stack_list( get_post_meta( $id, '_proj_techs', true ), 'stack', 'Technologies' ); // escaped in helper ?>
            <div class="what">
                <<?php echo $hh; ?>><?php echo hdgavi_tri_arr( hdgavi_meta_tri( $id, '_proj_title' ) ); ?></<?php echo $hh; ?>>
                <p class="desc"><?php echo hdgavi_tri_arr( hdgavi_meta_tri( $id, '_proj_desc' ) ); ?></p>
                <?php if ( ! $args['compact'] ) : ?>
                <?php echo hdgavi_meta_list_tri( $id, '_proj_points' ); // escaped in helper ?>
                <?php if ( $images ) : ?>
                <div class="proj-gallery-wrap">
                    <div class="proj-carousel" data-carousel>
                        <div class="proj-carousel-track">
                            <?php foreach ( $images as $img ) : ?>
                            <img src="<?php echo esc_url( $img ); ?>" alt="" loading="lazy" decoding="async" data-lightbox>
                            <?php endforeach; ?>
                        </div>
                        <?php if ( count( $images ) > 1 ) : ?>
                        <button class="proj-carousel-btn prev" type="button" aria-label="Previous">&lsaquo;</button>
                        <button class="proj-carousel-btn next" type="button" aria-label="Next">&rsaquo;</button>
                        <div class="proj-carousel-dots">
                            <?php foreach ( $images as $i => $img ) : ?><span<?php echo 0 === $i ? ' class="active"' : ''; ?>></span><?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endif; ?>
                <?php endif; ?>
                <?php if ( $link ) : ?>
                <p class="repo"><a href="<?php echo esc_url( $link ); ?>" rel="noopener"><?php echo esc_html( preg_replace( '#^https?://(www\.)?#', '', untrailingslashit( $link ) ) ); ?></a></p>
                <?php endif; ?>
            </div>
        </article>
        <?php endforeach; ?>
        <?php if ( ! $args['compact'] && $github ) : ?>
        <p class="sec-more"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'all_repos' ) ); ?> <a href="<?php echo esc_url( $github ); ?>" rel="me noopener"><?php echo esc_html( preg_replace( '#^https?://(www\.)?#', '', untrailingslashit( $github ) ) ); ?></a></p>
        <?php endif; ?>
    </div>
</section>
