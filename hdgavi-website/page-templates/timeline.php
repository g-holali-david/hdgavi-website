<?php
/**
 * Template Name: Timeline / Parcours
 * Experience and education year by year (CPT hdgavi_timeline), with type filters.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$events = hdgavi_get_cpt_posts( 'hdgavi_timeline' );
if ( $events ) update_postmeta_cache( wp_list_pluck( $events, 'ID' ) );

$type_labels = array(
    'work'          => hdgavi_opt_tri( 'label_tl_type_work', 'Work', 'Emploi', 'Empleo' ),
    'education'     => hdgavi_opt_tri( 'label_tl_type_education', 'Education', 'Formation', 'Formación' ),
    'certification' => hdgavi_opt_tri( 'label_tl_type_cert', 'Certification', 'Certification', 'Certificación' ),
    'project'       => hdgavi_opt_tri( 'label_tl_type_project', 'Project', 'Projet', 'Proyecto' ),
);
$filter_labels = array(
    'work'          => hdgavi_opt_tri( 'label_tl_filter_work', 'Work', 'Emploi', 'Empleo' ),
    'education'     => hdgavi_opt_tri( 'label_tl_filter_education', 'Education', 'Formation', 'Formación' ),
    'certification' => hdgavi_opt_tri( 'label_tl_filter_cert', 'Certifications', 'Certifications', 'Certificaciones' ),
    'project'       => hdgavi_opt_tri( 'label_tl_filter_project', 'Projects', 'Projets', 'Proyectos' ),
);

// Filters are only useful for the types that are actually used.
$present = array();
foreach ( $events as $event ) {
    $t = get_post_meta( $event->ID, '_tl_type', true );
    $present[ $t ? $t : 'work' ] = true;
}
$filters = array_intersect_key( $filter_labels, $present );
?>
<section class="sec wrap sec--first" aria-labelledby="t-timeline">
    <h1 class="sec-title" id="t-timeline"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_timeline_title', 'Timeline', 'Parcours', 'Trayectoria' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_timeline_desc', 'Experience and education, year by year.', 'Expériences et formations, année par année.', 'Experiencia y formación, año por año.' ) ); ?></p>
        <?php endif; ?>

        <?php if ( count( $filters ) > 1 ) : ?>
        <div class="watch-filters sec-main">
            <button type="button" class="watch-filter active" data-filter="all"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_tl_filter_all', 'All', 'Tous', 'Todos' ) ); ?></button>
            <?php foreach ( $filters as $type => $label ) : ?>
            <button type="button" class="watch-filter" data-filter="<?php echo esc_attr( $type ); ?>"><?php echo hdgavi_tri_arr( $label ); ?></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ( $events ) : ?>
        <div class="entry-list" id="fullTimeline">
            <?php foreach ( $events as $event ) :
                $id    = $event->ID;
                $type  = get_post_meta( $id, '_tl_type', true );
                $type  = $type ? $type : 'work';
                $title = hdgavi_meta_tri( $id, '_tl_title' );
                $desc  = hdgavi_meta_tri( $id, '_tl_desc' );
                $label = isset( $type_labels[ $type ] ) ? $type_labels[ $type ] : array( 'en' => $type, 'fr' => $type, 'es' => $type );
            ?>
            <article class="entry" data-tags="<?php echo esc_attr( $type ); ?>">
                <p class="when"><?php echo esc_html( get_post_meta( $id, '_tl_period', true ) ); ?><span class="place"><?php echo hdgavi_tri_arr( $label ); ?></span></p>
                <div class="what">
                    <h2><?php echo hdgavi_tri_arr( '' !== $title['en'] ? $title : array( 'en' => get_the_title( $event ) ) ); ?></h2>
                    <?php if ( '' !== trim( $desc['en'] ) ) : ?>
                    <p class="where"><?php echo hdgavi_tri_arr( $desc ); ?></p>
                    <?php endif; ?>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri( 'Nothing listed yet.', 'Rien pour le moment.', 'Nada por el momento.' ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
