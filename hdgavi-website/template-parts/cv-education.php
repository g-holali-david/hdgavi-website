<?php
/**
 * CV section: education (CPT hdgavi_education).
 * Args: heading = 'h1' | 'h2', first = bool
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$args  = wp_parse_args( isset( $args ) ? $args : array(), array( 'heading' => 'h2', 'first' => false ) );
$items = hdgavi_get_cpt_posts( 'hdgavi_education' );
if ( ! $items ) return;
update_postmeta_cache( wp_list_pluck( $items, 'ID' ) );

$h  = ( 'h1' === $args['heading'] ) ? 'h1' : 'h2';
$hh = ( 'h1' === $h ) ? 'h2' : 'h3';
?>
<section class="sec wrap<?php echo $args['first'] ? ' sec--first' : ''; ?>" id="education" aria-labelledby="t-education">
    <<?php echo $h; ?> class="sec-title" id="t-education"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'education' ) ); ?></<?php echo $h; ?>>
    <div class="sec-body">
        <?php foreach ( $items as $item ) :
            $id    = $item->ID;
            $notes = hdgavi_meta_tri( $id, '_edu_notes' );
        ?>
        <article class="entry">
            <p class="when"><?php echo esc_html( get_post_meta( $id, '_edu_period', true ) ); ?></p>
            <div class="what">
                <<?php echo $hh; ?>><?php echo hdgavi_tri_arr( hdgavi_meta_tri( $id, '_edu_degree' ) ); ?></<?php echo $hh; ?>>
                <p class="where"><?php echo esc_html( get_post_meta( $id, '_edu_school', true ) ); ?></p>
                <?php if ( '' !== trim( $notes['en'] ) ) : ?>
                <p class="note"><?php echo hdgavi_tri_arr( $notes ); ?></p>
                <?php endif; ?>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
