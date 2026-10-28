<?php
/**
 * Template Name: Certifications
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_section_en', 'Certifications' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_section_fr', 'Certifications' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_section_es', 'Certificaciones' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_title_en', 'Certifications & Badges' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_title_fr', 'Certifications & Badges' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_title_es', 'Certificaciones & Insignias' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_desc_en', 'Professional certifications obtained, in progress or planned.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_desc_fr', 'Certifications professionnelles obtenues, en cours ou prévues.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_desc_es', 'Certificaciones profesionales obtenidas, en curso o previstas.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <!-- Status filters -->
        <div class="watch-filters fade-up">
            <button class="watch-filter active" data-filter="all">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_all_en', 'All' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_all_fr', 'Toutes' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_all_es', 'Todas' ) ); ?></span>
            </button>
            <button class="watch-filter" data-filter="obtained">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_obtained_en', 'Obtained' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_obtained_fr', 'Obtenues' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_obtained_es', 'Obtenidas' ) ); ?></span>
            </button>
            <button class="watch-filter" data-filter="in-progress">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_progress_en', 'In progress' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_progress_fr', 'En cours' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_progress_es', 'En curso' ) ); ?></span>
            </button>
            <button class="watch-filter" data-filter="planned">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_planned_en', 'Planned' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_planned_fr', 'Objectif' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_filter_planned_es', 'Objetivo' ) ); ?></span>
            </button>
        </div>

        <div class="certs-grid" id="certsGrid">
            <?php
            $certs = hdgavi_get_cpt_posts( 'hdgavi_certification' );
            if ( $certs ) update_postmeta_cache( wp_list_pluck( $certs, 'ID' ) );
            foreach ( $certs as $cert ) :
                $id     = $cert->ID;
                $name   = get_post_meta( $id, '_cert_name', true );
                $org    = get_post_meta( $id, '_cert_org', true );
                $date   = get_post_meta( $id, '_cert_date', true );
                $status = get_post_meta( $id, '_cert_status', true ) ?: 'obtained';
                $url    = get_post_meta( $id, '_cert_url', true );
                $badge  = get_post_meta( $id, '_cert_badge', true );
            ?>
            <div class="cert-card fade-up" data-tags="<?php echo esc_attr( $status ); ?>">
                <?php if ( ! empty( $badge ) ) : ?>
                <div class="cert-badge">
                    <img src="<?php echo esc_url( $badge ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy" decoding="async">
                </div>
                <?php else : ?>
                <div class="cert-badge cert-badge-placeholder">
                    <?php
                    $status_icons = array( 'obtained' => '✓', 'in-progress' => '◔', 'planned' => '○' );
                    echo esc_html( $status_icons[ $status ] ?? '○' );
                    ?>
                </div>
                <?php endif; ?>
                <div class="cert-info">
                    <div class="cert-status cert-status-<?php echo esc_attr( $status ); ?>">
                        <?php
                        $status_labels = array(
                            'obtained'    => array(
                                hdgavi_opt( 'label_certs_status_obtained_en', 'Obtained' ),
                                hdgavi_opt( 'label_certs_status_obtained_fr', 'Obtenue' ),
                                hdgavi_opt( 'label_certs_status_obtained_es', 'Obtenida' ),
                            ),
                            'in-progress' => array(
                                hdgavi_opt( 'label_certs_status_progress_en', 'In progress' ),
                                hdgavi_opt( 'label_certs_status_progress_fr', 'En cours' ),
                                hdgavi_opt( 'label_certs_status_progress_es', 'En curso' ),
                            ),
                            'planned'     => array(
                                hdgavi_opt( 'label_certs_status_planned_en', 'Planned' ),
                                hdgavi_opt( 'label_certs_status_planned_fr', 'Objectif' ),
                                hdgavi_opt( 'label_certs_status_planned_es', 'Objetivo' ),
                            ),
                        );
                        $s = $status_labels[ $status ] ?? $status_labels['planned'];
                        ?>
                        <span data-lang="en"><?php echo esc_html( $s[0] ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( $s[1] ); ?></span>
                        <span data-lang="es"><?php echo esc_html( $s[2] ); ?></span>
                    </div>
                    <h3 class="cert-name"><?php echo esc_html( $name ); ?></h3>
                    <?php if ( $org ) : ?>
                    <div class="cert-org"><?php echo esc_html( $org ); ?></div>
                    <?php endif; ?>
                    <?php if ( $date ) : ?>
                    <div class="cert-date"><?php echo esc_html( $date ); ?></div>
                    <?php endif; ?>
                    <?php if ( ! empty( $url ) ) : ?>
                    <a href="<?php echo esc_url( $url ); ?>" class="cert-verify" target="_blank" rel="noopener">
                        <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_verify_en', 'Verify' ) ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_verify_fr', 'Vérifier' ) ); ?></span>
                        <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_verify_es', 'Verificar' ) ); ?></span>
                        →
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if ( empty( $certs ) ) : ?>
        <p class="section-desc fade-up">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_certs_empty_en', 'Certifications coming soon.' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_certs_empty_fr', 'Certifications à venir.' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_certs_empty_es', 'Certificaciones próximamente.' ) ); ?></span>
        </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
