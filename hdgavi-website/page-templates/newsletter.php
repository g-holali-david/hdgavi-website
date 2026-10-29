<?php
/**
 * Template Name: Newsletter
 * Subscription form (AJAX, nonce + honeypot) and the latest tech watch articles.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$preview_query = new WP_Query( array(
    'post_type'      => 'post',
    'category_name'  => 'veille',
    'posts_per_page' => 3,
    'orderby'        => 'date',
    'order'          => 'DESC',
) );
?>
<section class="sec wrap sec--first" aria-labelledby="t-newsletter">
    <h1 class="sec-title" id="t-newsletter"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_nl_title', 'Newsletter', 'Newsletter', 'Boletín' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_nl_desc', 'New tech watch articles (cloud and cybersecurity) by e-mail.', 'Les nouveaux articles de veille (cloud et cybersécurité) par e-mail.', 'Los nuevos artículos de vigilancia (cloud y ciberseguridad) por correo.' ) ); ?></p>
        <?php endif; ?>

        <form id="newsletterForm" class="newsletter-form sec-main">
            <?php wp_nonce_field( 'hdgavi_newsletter_nonce', 'nl_nonce' ); ?>
            <div style="display:none" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
            <label class="vh" for="nlEmail"><?php echo hdgavi_tri( 'E-mail address', 'Adresse e-mail', 'Correo electrónico' ); ?></label>
            <div class="nl-input-group">
                <input type="email" name="nl_email" id="nlEmail" required placeholder="<?php echo esc_attr( hdgavi_opt( 'label_nl_placeholder_en', 'your@email.com' ) ); ?>" data-placeholder-en="<?php echo esc_attr( hdgavi_opt( 'label_nl_placeholder_en', 'your@email.com' ) ); ?>" data-placeholder-fr="<?php echo esc_attr( hdgavi_opt( 'label_nl_placeholder_fr', 'votre@email.com' ) ); ?>" data-placeholder-es="<?php echo esc_attr( hdgavi_opt( 'label_nl_placeholder_es', 'tu@email.com' ) ); ?>" autocomplete="email">
                <button type="submit" class="btn nl-submit" id="nlSubmit"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_nl_btn', 'Subscribe', 'S’abonner', 'Suscribirse' ) ); ?></button>
            </div>
            <div class="form-feedback" id="nlFeedback" aria-live="polite" role="status"></div>
        </form>
    </div>
</section>

<?php if ( $preview_query->have_posts() ) : ?>
<section class="sec wrap" aria-labelledby="t-nl-preview">
    <h2 class="sec-title" id="t-nl-preview"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_nl_preview', 'Latest from the tech watch', 'Derniers articles de la veille', 'Lo último de la vigilancia' ) ); ?></h2>
    <div class="sec-body">
        <?php while ( $preview_query->have_posts() ) : $preview_query->the_post();
            $pid     = get_the_ID();
            $ext_url = get_post_meta( $pid, 'watch_url', true );
            $link    = ! empty( $ext_url ) ? $ext_url : get_the_permalink();
            $target  = ! empty( $ext_url ) ? ' target="_blank" rel="noopener"' : '';
            $title   = hdgavi_meta_tri( $pid, '_watch_title' );
        ?>
        <article class="entry">
            <p class="when"><?php echo esc_html( get_the_date( 'Y-m-d' ) ); ?></p>
            <div class="what">
                <h3><a href="<?php echo esc_url( $link ); ?>"<?php echo $target; ?>><?php echo '' !== $title['en'] ? hdgavi_tri_arr( $title ) : esc_html( get_the_title() ); ?></a></h3>
            </div>
        </article>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>
