<?php
/**
 * Template Name: Newsletter
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up" style="text-align:center;max-width:600px;margin:0 auto 48px">
            <div class="section-label" style="justify-content:center">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_nl_section_en', 'Newsletter' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_nl_section_fr', 'Newsletter' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_nl_section_es', 'Boletín' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_nl_title_en', 'Stay in the loop' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_nl_title_fr', 'Restez informé' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_nl_title_es', 'Mantente informado' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc" style="margin:12px auto 0;text-align:center">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_nl_desc_en', 'Subscribe to receive my tech watch — curated articles on DevOps, Cloud and Kubernetes. No spam, unsubscribe anytime.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_nl_desc_fr', 'Abonnez-vous pour recevoir ma veille techno — articles sur le DevOps, Cloud et Kubernetes. Pas de spam, désinscription à tout moment.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_nl_desc_es', 'Suscríbete para recibir mi vigilancia tecnológica — artículos sobre DevOps, Cloud y Kubernetes. Sin spam, cancela cuando quieras.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <div class="newsletter-box fade-up">
            <form id="newsletterForm" class="newsletter-form">
                <?php wp_nonce_field( 'hdgavi_newsletter_nonce', 'nl_nonce' ); ?>
                <div style="display:none" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
                <div class="nl-input-group">
                    <input type="email" name="nl_email" id="nlEmail" required placeholder="<?php echo esc_attr( hdgavi_opt( 'label_nl_placeholder_en', 'your@email.com' ) ); ?>" data-placeholder-en="<?php echo esc_attr( hdgavi_opt( 'label_nl_placeholder_en', 'your@email.com' ) ); ?>" data-placeholder-fr="<?php echo esc_attr( hdgavi_opt( 'label_nl_placeholder_fr', 'votre@email.com' ) ); ?>" data-placeholder-es="<?php echo esc_attr( hdgavi_opt( 'label_nl_placeholder_es', 'tu@email.com' ) ); ?>" autocomplete="email">
                    <button type="submit" class="btn-primary nl-submit" id="nlSubmit">
                        <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_nl_btn_en', 'Subscribe' ) ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_nl_btn_fr', 'S\'abonner' ) ); ?></span>
                        <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_nl_btn_es', 'Suscribirse' ) ); ?></span>
                    </button>
                </div>
                <div class="form-feedback" id="nlFeedback" aria-live="polite" role="status"></div>
            </form>

            <div class="nl-stats">
                <?php
                $subs = get_option( 'hdgavi_newsletter_subs', array() );
                $count = count( $subs );
                if ( $count > 0 ) : ?>
                <p class="nl-count">
                    <span data-lang="en"><?php echo esc_html( $count ); ?> subscriber<?php echo $count > 1 ? 's' : ''; ?> already</span>
                    <span data-lang="fr"><?php echo esc_html( $count ); ?> abonné<?php echo $count > 1 ? 's' : ''; ?> déjà</span>
                    <span data-lang="es"><?php echo esc_html( $count ); ?> suscriptor<?php echo $count > 1 ? 'es' : ''; ?> ya</span>
                </p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent tech watch articles preview -->
        <div class="nl-preview fade-up">
            <h2 class="nl-preview-title" style="font-size:1.2rem;margin-bottom:24px">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_nl_preview_en', 'Latest from the tech watch' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_nl_preview_fr', 'Derniers articles de la veille' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_nl_preview_es', 'Lo último de la vigilancia tech' ) ); ?></span>
            </h2>
            <?php
            $preview_query = new WP_Query( array(
                'post_type'      => 'post',
                'category_name'  => 'veille',
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
            if ( $preview_query->have_posts() ) : ?>
            <div class="watch-grid watch-grid-small">
                <?php while ( $preview_query->have_posts() ) : $preview_query->the_post();
                    $ext_url = get_post_meta( get_the_ID(), 'watch_url', true );
                    $link = ! empty( $ext_url ) ? $ext_url : get_the_permalink();
                    $target = ! empty( $ext_url ) ? ' target="_blank" rel="noopener"' : '';
                ?>
                <a href="<?php echo esc_url( $link ); ?>"<?php echo $target; ?> class="watch-card watch-card-mini">
                    <h3 class="watch-card-title"><?php the_title(); ?></h3>
                    <span class="watch-date"><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
                </a>
                <?php endwhile; wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
