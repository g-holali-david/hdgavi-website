<?php
/**
 * Template Name: Certifications
 * Certifications (CPT hdgavi_certification) with status filters.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$certs = hdgavi_get_cpt_posts( 'hdgavi_certification' );
if ( $certs ) update_postmeta_cache( wp_list_pluck( $certs, 'ID' ) );

$status_labels = array(
    'obtained'    => hdgavi_opt_tri( 'label_certs_status_obtained', 'Obtained', 'Obtenue', 'Obtenida' ),
    'in-progress' => hdgavi_opt_tri( 'label_certs_status_progress', 'In progress', 'En cours', 'En curso' ),
    'planned'     => hdgavi_opt_tri( 'label_certs_status_planned', 'Planned', 'Objectif', 'Objetivo' ),
);
$filter_labels = array(
    'obtained'    => hdgavi_opt_tri( 'label_certs_filter_obtained', 'Obtained', 'Obtenues', 'Obtenidas' ),
    'in-progress' => hdgavi_opt_tri( 'label_certs_filter_progress', 'In progress', 'En cours', 'En curso' ),
    'planned'     => hdgavi_opt_tri( 'label_certs_filter_planned', 'Planned', 'Objectifs', 'Objetivos' ),
);

$present = array();
foreach ( $certs as $cert ) {
    $s = get_post_meta( $cert->ID, '_cert_status', true );
    $present[ $s ? $s : 'obtained' ] = true;
}
$filters = array_intersect_key( $filter_labels, $present );
$verify  = hdgavi_opt_tri( 'label_certs_verify', 'Verify', 'Vérifier', 'Verificar' );
?>
<section class="sec wrap sec--first" aria-labelledby="t-certs">
    <h1 class="sec-title" id="t-certs"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_certs_title', 'Certifications', 'Certifications', 'Certificaciones' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( $certs ) : ?>
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_certs_desc', 'Certifications obtained, in progress or planned.', 'Certifications obtenues, en cours ou prévues.', 'Certificaciones obtenidas, en curso o previstas.' ) ); ?></p>
        <?php endif; ?>

        <?php if ( count( $filters ) > 1 ) : ?>
        <div class="watch-filters sec-main">
            <button type="button" class="watch-filter active" data-filter="all"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_certs_filter_all', 'All', 'Toutes', 'Todas' ) ); ?></button>
            <?php foreach ( $filters as $status => $label ) : ?>
            <button type="button" class="watch-filter" data-filter="<?php echo esc_attr( $status ); ?>"><?php echo hdgavi_tri_arr( $label ); ?></button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <div class="entry-list" id="certsGrid">
            <?php foreach ( $certs as $cert ) :
                $id     = $cert->ID;
                $name   = get_post_meta( $id, '_cert_name', true );
                $name   = $name ? $name : get_the_title( $cert );
                $org    = get_post_meta( $id, '_cert_org', true );
                $date   = get_post_meta( $id, '_cert_date', true );
                $status = get_post_meta( $id, '_cert_status', true );
                $status = $status ? $status : 'obtained';
                $url    = get_post_meta( $id, '_cert_url', true );
                $badge  = get_post_meta( $id, '_cert_badge', true );
                $s      = isset( $status_labels[ $status ] ) ? $status_labels[ $status ] : $status_labels['planned'];
            ?>
            <article class="entry" data-tags="<?php echo esc_attr( $status ); ?>">
                <p class="when"><?php echo esc_html( $date ); ?><span class="place"><?php echo hdgavi_tri_arr( $s ); ?></span></p>
                <div class="what">
                    <h2><?php echo esc_html( $name ); ?></h2>
                    <?php if ( $org ) : ?>
                    <p class="where"><?php echo esc_html( $org ); ?></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $url ) ) : ?>
                    <p class="desc"><a href="<?php echo esc_url( $url ); ?>" class="cert-verify" target="_blank" rel="noopener"><?php echo hdgavi_tri_arr( $verify ); ?></a></p>
                    <?php endif; ?>
                    <?php if ( ! empty( $badge ) ) : ?>
                    <img class="cert-badge" src="<?php echo esc_url( $badge ); ?>" alt="" width="64" height="64" loading="lazy" decoding="async">
                    <?php endif; ?>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_certs_empty', 'No certification listed yet.', 'Aucune certification pour le moment.', 'Ninguna certificación por el momento.' ) ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
