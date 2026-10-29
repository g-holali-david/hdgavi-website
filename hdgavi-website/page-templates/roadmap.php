<?php
/**
 * Template Name: Roadmap / Objectifs
 * Goals from the Customizer (roadmap_cat_N_*), shown as a plain checklist.
 * Item syntax: "[x] Goal" (done), "[ ] Goal" (planned) or "Goal | done|in-progress|planned".
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$status_labels = array(
    'done'        => array( 'en' => 'done', 'fr' => 'atteint', 'es' => 'logrado' ),
    'in-progress' => array( 'en' => 'in progress', 'fr' => 'en cours', 'es' => 'en curso' ),
);

$groups = array();
$total  = 0;
$done   = 0;
for ( $cat = 1; $cat <= 6; $cat++ ) {
    $cat_en = hdgavi_opt( "roadmap_cat_{$cat}_en", '' );
    $items  = hdgavi_opt( "roadmap_cat_{$cat}_items", '' );
    if ( empty( $cat_en ) || empty( $items ) ) continue;

    $goals = array();
    foreach ( array_filter( array_map( 'trim', explode( "\n", $items ) ) ) as $line ) {
        if ( preg_match( '/^\[([xX ])\]\s*(.+)$/', $line, $m ) ) {
            $goal   = trim( $m[2] );
            $status = strtolower( $m[1] ) === 'x' ? 'done' : 'planned';
        } else {
            $parts  = array_map( 'trim', explode( '|', $line ) );
            $goal   = $parts[0];
            $status = isset( $parts[1] ) ? strtolower( $parts[1] ) : 'planned';
        }
        $goals[] = array( 'goal' => $goal, 'status' => $status );
        $total++;
        if ( 'done' === $status ) $done++;
    }
    $groups[] = array(
        'label' => array(
            'en' => $cat_en,
            'fr' => hdgavi_opt( "roadmap_cat_{$cat}_fr", $cat_en ),
            'es' => hdgavi_opt( "roadmap_cat_{$cat}_es", $cat_en ),
        ),
        'goals' => $goals,
    );
}
?>
<section class="sec wrap sec--first" aria-labelledby="t-roadmap">
    <h1 class="sec-title" id="t-roadmap"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_roadmap_title', 'Goals', 'Objectifs', 'Objetivos' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_roadmap_desc', 'Degree, career and certification goals.', 'Objectifs de formation, de carrière et de certification.', 'Objetivos de formación, carrera y certificación.' ) ); ?></p>
        <?php endif; ?>

        <?php foreach ( $groups as $group ) : ?>
        <div class="entry roadmap-group">
            <h2 class="entry-label"><?php echo hdgavi_tri_arr( $group['label'] ); ?></h2>
            <ul class="dashes roadmap-items">
                <?php foreach ( $group['goals'] as $g ) : ?>
                <li class="roadmap-item roadmap-<?php echo esc_attr( sanitize_html_class( $g['status'] ) ); ?>"><?php echo esc_html( $g['goal'] ); ?><?php if ( isset( $status_labels[ $g['status'] ] ) ) : ?> <span class="roadmap-status"><?php echo hdgavi_tri_arr( $status_labels[ $g['status'] ] ); ?></span><?php endif; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>

        <?php if ( ! $groups ) : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri( 'No goal listed yet.', 'Aucun objectif pour le moment.', 'Ningún objetivo por el momento.' ); ?></p>
        <?php elseif ( $done > 0 ) : ?>
        <p class="sec-main note roadmap-summary"><?php
            echo hdgavi_tri(
                sprintf( '%1$d of %2$d goals reached', $done, $total ),
                sprintf( 1 === $done ? '%1$d objectif atteint sur %2$d' : '%1$d objectifs atteints sur %2$d', $done, $total ),
                sprintf( '%1$d de %2$d objetivos logrados', $done, $total )
            );
        ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
