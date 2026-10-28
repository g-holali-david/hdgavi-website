<?php
/**
 * Template Name: Témoignages / Testimonials
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up" style="text-align:center;max-width:600px;margin:0 auto 48px">
            <div class="section-label" style="justify-content:center">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_testi_section_en', 'Testimonials' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_testi_section_fr', 'Témoignages' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_testi_section_es', 'Testimonios' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_testi_title_en', 'What people say' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_testi_title_fr', 'Ce qu\'on dit de moi' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_testi_title_es', 'Lo que dicen de mí' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc" style="text-align:center;margin:12px auto 0">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_testi_desc_en', 'Feedback from colleagues and managers I\'ve had the pleasure of working with.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_testi_desc_fr', 'Retours de collègues et managers avec qui j\'ai eu le plaisir de travailler.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_testi_desc_es', 'Comentarios de colegas y gerentes con quienes he tenido el placer de trabajar.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <?php
        $testimonials = hdgavi_get_cpt_posts( 'hdgavi_testimonial' );
        if ( $testimonials ) update_postmeta_cache( wp_list_pluck( $testimonials, 'ID' ) );
        ?>

        <?php if ( ! empty( $testimonials ) ) : ?>
        <div class="testimonials-grid">
            <?php foreach ( $testimonials as $testi ) :
                $id       = $testi->ID;
                $quote_en = get_post_meta( $id, '_testi_quote_en', true );
                $quote_fr = get_post_meta( $id, '_testi_quote_fr', true ) ?: $quote_en;
                $quote_es = get_post_meta( $id, '_testi_quote_es', true ) ?: $quote_en;
                $name     = get_post_meta( $id, '_testi_name', true );
                $role_en  = get_post_meta( $id, '_testi_role_en', true );
                $role_fr  = get_post_meta( $id, '_testi_role_fr', true ) ?: $role_en;
                $role_es  = get_post_meta( $id, '_testi_role_es', true ) ?: $role_en;
                $company  = get_post_meta( $id, '_testi_company', true );
                $photo    = get_post_meta( $id, '_testi_photo', true );
                $relation = get_post_meta( $id, '_testi_relation', true );
            ?>
            <div class="testi-card fade-up">
                <div class="testi-quote-mark">&ldquo;</div>
                <blockquote class="testi-quote">
                    <span data-lang="en"><?php echo esc_html( $quote_en ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $quote_fr ); ?></span>
                    <span data-lang="es"><?php echo esc_html( $quote_es ); ?></span>
                </blockquote>
                <div class="testi-author">
                    <?php if ( ! empty( $photo ) ) : ?>
                    <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="testi-photo" loading="lazy" decoding="async">
                    <?php else : ?>
                    <div class="testi-photo-placeholder"><?php echo esc_html( mb_substr( $name, 0, 1 ) ); ?></div>
                    <?php endif; ?>
                    <div class="testi-author-info">
                        <div class="testi-name"><?php echo esc_html( $name ); ?></div>
                        <div class="testi-role">
                            <span data-lang="en"><?php echo esc_html( $role_en ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( $role_fr ); ?></span>
                            <span data-lang="es"><?php echo esc_html( $role_es ); ?></span>
                            <?php if ( $company ) : ?>
                            <span class="testi-company">— <?php echo esc_html( $company ); ?></span>
                            <?php endif; ?>
                        </div>
                        <?php if ( $relation ) : ?>
                        <div class="testi-relation"><?php echo esc_html( $relation ); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <p class="section-desc fade-up" style="text-align:center">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_testi_empty_en', 'Testimonials coming soon.' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_testi_empty_fr', 'Témoignages à venir.' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_testi_empty_es', 'Testimonios próximamente.' ) ); ?></span>
        </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
