<?php
/**
 * Template Name: Experience / Expérience
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_exp_section_en', 'Career Path' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_exp_section_fr', 'Parcours professionnel' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_exp_section_es', 'Trayectoria profesional' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_exp_title_en', 'Experience' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_exp_title_fr', 'Expérience' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_exp_title_es', 'Experiencia' ) ); ?></span>
            </h1>
        </div>

        <div class="timeline">
            <?php
            $experiences = hdgavi_get_cpt_posts( 'hdgavi_experience' );
            if ( $experiences ) update_postmeta_cache( wp_list_pluck( $experiences, 'ID' ) );
            foreach ( $experiences as $exp ) :
                $id         = $exp->ID;
                $title_en   = get_post_meta( $id, '_exp_title_en', true );
                $title_fr   = get_post_meta( $id, '_exp_title_fr', true ) ?: $title_en;
                $title_es   = get_post_meta( $id, '_exp_title_es', true ) ?: $title_en;
                $company_en = get_post_meta( $id, '_exp_company_en', true );
                $company_fr = get_post_meta( $id, '_exp_company_fr', true ) ?: $company_en;
                $company_es = get_post_meta( $id, '_exp_company_es', true ) ?: $company_en;
                $featured   = get_post_meta( $id, '_exp_featured', true );
                $location   = get_post_meta( $id, '_exp_location', true );
                $techs      = get_post_meta( $id, '_exp_techs', true );
                $bullets_en = get_post_meta( $id, '_exp_bullets_en', true );
                $bullets_fr = get_post_meta( $id, '_exp_bullets_fr', true );
                $bullets_es = get_post_meta( $id, '_exp_bullets_es', true );
            ?>
            <div class="timeline-item<?php echo esc_attr( $featured ? ' featured' : '' ); ?> fade-up">
                <div class="timeline-dot"></div>

                <div class="timeline-header">
                    <div>
                        <h3 class="timeline-title">
                            <span data-lang="en"><?php echo esc_html( $title_en ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( $title_fr ); ?></span>
                            <span data-lang="es"><?php echo esc_html( $title_es ); ?></span>
                        </h3>
                        <?php if ( ! empty( $company_en ) || ! empty( $company_fr ) ) : ?>
                        <span class="timeline-company">
                            <span data-lang="en"><?php echo esc_html( $company_en ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( $company_fr ); ?></span>
                            <span data-lang="es"><?php echo esc_html( $company_es ); ?></span>
                        </span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="timeline-meta">
                    <?php echo hdgavi_icon( 'calendar', 13 ); ?>
                    <span>
                        <span data-lang="en"><?php echo esc_html( get_post_meta( $id, '_exp_period_en', true ) ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( get_post_meta( $id, '_exp_period_fr', true ) ); ?></span>
                        <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_exp_period_es', true ) ?: get_post_meta( $id, '_exp_period_en', true ) ); ?></span>
                    </span>
                    <?php if ( ! empty( $location ) ) : ?>
                    <?php echo hdgavi_icon( 'map-pin', 13 ); ?>
                    <span><?php echo esc_html( $location ); ?></span>
                    <?php endif; ?>
                </div>

                <p class="timeline-desc">
                    <span data-lang="en"><?php echo esc_html( get_post_meta( $id, '_exp_desc_en', true ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( get_post_meta( $id, '_exp_desc_fr', true ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_exp_desc_es', true ) ?: get_post_meta( $id, '_exp_desc_en', true ) ); ?></span>
                </p>

                <?php if ( ! empty( $bullets_en ) ) : ?>
                <ul class="timeline-bullets" data-lang="en">
                    <?php foreach ( array_filter( explode( "\n", $bullets_en ) ) as $bullet ) : ?>
                    <li><?php echo esc_html( trim( $bullet ) ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php if ( ! empty( $bullets_fr ) ) : ?>
                <ul class="timeline-bullets" data-lang="fr">
                    <?php foreach ( array_filter( explode( "\n", $bullets_fr ) ) as $bullet ) : ?>
                    <li><?php echo esc_html( trim( $bullet ) ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
                <?php if ( ! empty( $bullets_es ) ) : ?>
                <ul class="timeline-bullets" data-lang="es">
                    <?php foreach ( array_filter( explode( "\n", $bullets_es ) ) as $bullet ) : ?>
                    <li><?php echo esc_html( trim( $bullet ) ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>

                <?php if ( ! empty( $techs ) ) : ?>
                <div class="timeline-techs">
                    <?php foreach ( array_map( 'trim', explode( ',', $techs ) ) as $tech ) : ?>
                    <span class="skill-tag"><?php echo esc_html( $tech ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
