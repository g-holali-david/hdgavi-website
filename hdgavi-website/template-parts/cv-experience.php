<?php
/**
 * CV section: professional experience (CPT hdgavi_experience).
 * Args: heading = 'h1' | 'h2', first = bool
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$args  = wp_parse_args( isset( $args ) ? $args : array(), array( 'heading' => 'h2', 'first' => false ) );
$items = hdgavi_get_cpt_posts( 'hdgavi_experience' );
if ( ! $items ) return;
update_postmeta_cache( wp_list_pluck( $items, 'ID' ) );

$h  = ( 'h1' === $args['heading'] ) ? 'h1' : 'h2';
$hh = ( 'h1' === $h ) ? 'h2' : 'h3';
?>
<section class="sec wrap<?php echo $args['first'] ? ' sec--first' : ''; ?>" id="experience" aria-labelledby="t-experience">
    <<?php echo $h; ?> class="sec-title" id="t-experience"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'experience' ) ); ?></<?php echo $h; ?>>
    <div class="sec-body">
        <?php foreach ( $items as $item ) :
            $id       = $item->ID;
            $company  = hdgavi_meta_tri( $id, '_exp_company' );
            $location = get_post_meta( $id, '_exp_location', true );
            $desc     = hdgavi_meta_tri( $id, '_exp_desc' );
        ?>
        <article class="entry">
            <p class="when"><?php echo hdgavi_tri_arr( hdgavi_meta_tri( $id, '_exp_period' ) ); ?></p>
            <div class="what">
                <<?php echo $hh; ?>><?php echo hdgavi_tri_arr( hdgavi_meta_tri( $id, '_exp_title' ) ); ?></<?php echo $hh; ?>>
                <?php if ( $company['en'] || $location ) : ?>
                <p class="where">
                    <?php if ( $company['en'] ) : ?><span class="org"><?php echo hdgavi_tri_arr( $company ); ?></span><?php endif; ?><?php if ( $company['en'] && $location ) : ?>, <?php endif; ?><?php echo esc_html( $location ); ?>
                </p>
                <?php endif; ?>
                <?php if ( '' !== trim( $desc['en'] ) ) : ?>
                <p class="desc"><?php echo hdgavi_tri_arr( $desc ); ?></p>
                <?php endif; ?>
                <?php echo hdgavi_meta_list_tri( $id, '_exp_bullets' ); // escaped in helper ?>
                <?php echo hdgavi_stack_list( get_post_meta( $id, '_exp_techs', true ) ); // escaped in helper ?>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
