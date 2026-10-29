<?php
/**
 * CV section: skills grouped by category (CPT hdgavi_skill), as on the printed CV.
 * Args: heading = 'h1' | 'h2', first = bool
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$args  = wp_parse_args( isset( $args ) ? $args : array(), array( 'heading' => 'h2', 'first' => false ) );
$items = hdgavi_get_cpt_posts( 'hdgavi_skill' );
if ( ! $items ) return;
update_postmeta_cache( wp_list_pluck( $items, 'ID' ) );

// Group by category, keeping the order of first appearance (menu_order).
$groups = array();
foreach ( $items as $item ) {
    $cat = hdgavi_meta_tri( $item->ID, '_skill_category' );
    $key = $cat['en'] ? $cat['en'] : '—';
    if ( ! isset( $groups[ $key ] ) ) {
        $groups[ $key ] = array( 'label' => $cat, 'names' => array() );
    }
    $name = get_post_meta( $item->ID, '_skill_name', true );
    $groups[ $key ]['names'][] = $name ? $name : get_the_title( $item );
}

$h = ( 'h1' === $args['heading'] ) ? 'h1' : 'h2';
?>
<section class="sec wrap<?php echo $args['first'] ? ' sec--first' : ''; ?>" id="skills" aria-labelledby="t-skills">
    <<?php echo $h; ?> class="sec-title" id="t-skills"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'skills' ) ); ?></<?php echo $h; ?>>
    <div class="sec-body">
        <dl class="skills">
            <?php foreach ( $groups as $group ) : ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( $group['label'] ); ?></dt>
                <dd><?php echo esc_html( implode( ', ', $group['names'] ) ); ?></dd>
            </div>
            <?php endforeach; ?>
        </dl>
    </div>
</section>
