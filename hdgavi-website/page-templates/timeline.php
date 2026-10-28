<?php
/**
 * Template Name: Timeline / Parcours
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_timeline_section_en', 'My Journey' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_timeline_section_fr', 'Mon Parcours' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_timeline_section_es', 'Mi trayectoria' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_timeline_title_en', 'Career Timeline' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_timeline_title_fr', 'Frise Chronologique' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_timeline_title_es', 'Línea de tiempo' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_timeline_desc_en', 'A complete view of my career path, from first steps to today.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_timeline_desc_fr', 'Vue complète de mon parcours, des premiers pas à aujourd\'hui.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_timeline_desc_es', 'Vista completa de mi trayectoria, desde los primeros pasos hasta hoy.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <!-- Category filters -->
        <div class="watch-filters fade-up">
            <button class="watch-filter active" data-filter="all">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_all_en', 'All' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_all_fr', 'Tous' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_all_es', 'Todos' ) ); ?></span>
            </button>
            <button class="watch-filter" data-filter="work">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_work_en', 'Work' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_work_fr', 'Emploi' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_work_es', 'Empleo' ) ); ?></span>
            </button>
            <button class="watch-filter" data-filter="education">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_education_en', 'Education' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_education_fr', 'Formation' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_education_es', 'Educación' ) ); ?></span>
            </button>
            <button class="watch-filter" data-filter="certification">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_cert_en', 'Certifications' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_cert_fr', 'Certifications' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_cert_es', 'Certificaciones' ) ); ?></span>
            </button>
            <button class="watch-filter" data-filter="project">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_project_en', 'Projects' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_project_fr', 'Projets' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_tl_filter_project_es', 'Proyectos' ) ); ?></span>
            </button>
        </div>

        <div class="full-timeline" id="fullTimeline">
            <?php
            $events = hdgavi_get_cpt_posts( 'hdgavi_timeline' );
            if ( $events ) update_postmeta_cache( wp_list_pluck( $events, 'ID' ) );
            foreach ( $events as $event ) :
                $id       = $event->ID;
                $title_en = get_post_meta( $id, '_tl_title_en', true );
                $title_fr = get_post_meta( $id, '_tl_title_fr', true );
                $title_es = get_post_meta( $id, '_tl_title_es', true ) ?: $title_en;
                $period   = get_post_meta( $id, '_tl_period', true );
                $type     = get_post_meta( $id, '_tl_type', true ) ?: 'work';
                $desc_en  = get_post_meta( $id, '_tl_desc_en', true );
                $desc_fr  = get_post_meta( $id, '_tl_desc_fr', true );
                $desc_es  = get_post_meta( $id, '_tl_desc_es', true ) ?: $desc_en;
                $icon     = get_post_meta( $id, '_tl_icon', true );

                $type_icons  = array( 'work' => '💼', 'education' => '🎓', 'certification' => '📜', 'project' => '🚀' );
                $type_colors = array( 'work' => 'var(--accent)', 'education' => 'var(--accent2)', 'certification' => 'var(--success)', 'project' => 'var(--warning)' );
                $dot_color = $type_colors[ $type ] ?? 'var(--accent)';
                $dot_icon  = ! empty( $icon ) ? $icon : ( $type_icons[ $type ] ?? '●' );
            ?>
            <div class="ftl-item fade-up" data-tags="<?php echo esc_attr( $type ); ?>">
                <div class="ftl-dot" style="background:<?php echo esc_attr( $dot_color ); ?>">
                    <span class="ftl-dot-icon"><?php echo esc_html( $dot_icon ); ?></span>
                </div>
                <div class="ftl-content">
                    <div class="ftl-period"><?php echo esc_html( $period ); ?></div>
                    <h3 class="ftl-title">
                        <span data-lang="en"><?php echo esc_html( $title_en ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( $title_fr ); ?></span>
                        <span data-lang="es"><?php echo esc_html( $title_es ); ?></span>
                    </h3>
                    <?php if ( $desc_en || $desc_fr ) : ?>
                    <p class="ftl-desc">
                        <span data-lang="en"><?php echo esc_html( $desc_en ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( $desc_fr ); ?></span>
                        <span data-lang="es"><?php echo esc_html( $desc_es ); ?></span>
                    </p>
                    <?php endif; ?>
                    <span class="ftl-type-badge ftl-type-<?php echo esc_attr( $type ); ?>">
                        <?php
                        $type_labels = array(
                            'work'          => array(
                                hdgavi_opt( 'label_tl_type_work_en', 'Work' ),
                                hdgavi_opt( 'label_tl_type_work_fr', 'Emploi' ),
                                hdgavi_opt( 'label_tl_type_work_es', 'Empleo' ),
                            ),
                            'education'     => array(
                                hdgavi_opt( 'label_tl_type_education_en', 'Education' ),
                                hdgavi_opt( 'label_tl_type_education_fr', 'Formation' ),
                                hdgavi_opt( 'label_tl_type_education_es', 'Educación' ),
                            ),
                            'certification' => array(
                                hdgavi_opt( 'label_tl_type_cert_en', 'Certification' ),
                                hdgavi_opt( 'label_tl_type_cert_fr', 'Certification' ),
                                hdgavi_opt( 'label_tl_type_cert_es', 'Certificación' ),
                            ),
                            'project'       => array(
                                hdgavi_opt( 'label_tl_type_project_en', 'Project' ),
                                hdgavi_opt( 'label_tl_type_project_fr', 'Projet' ),
                                hdgavi_opt( 'label_tl_type_project_es', 'Proyecto' ),
                            ),
                        );
                        $tl = $type_labels[ $type ] ?? array( $type, $type, $type );
                        ?>
                        <span data-lang="en"><?php echo esc_html( $tl[0] ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( $tl[1] ); ?></span>
                        <span data-lang="es"><?php echo esc_html( $tl[2] ); ?></span>
                    </span>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
