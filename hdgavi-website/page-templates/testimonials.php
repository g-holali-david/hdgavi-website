<?php
/**
 * Template Name: Témoignages / Testimonials
 * Testimonials (CPT hdgavi_testimonial): author in the label column, quote in the main column.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$testimonials = hdgavi_get_cpt_posts( 'hdgavi_testimonial' );
if ( $testimonials ) update_postmeta_cache( wp_list_pluck( $testimonials, 'ID' ) );
?>
<section class="sec wrap sec--first" aria-labelledby="t-testimonials">
    <h1 class="sec-title" id="t-testimonials"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_testi_title', 'Testimonials', 'Témoignages', 'Testimonios' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( ! empty( $testimonials ) ) : ?>
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_testi_desc', 'Feedback from people I have worked with.', 'Retours de personnes avec qui j’ai travaillé.', 'Comentarios de personas con las que he trabajado.' ) ); ?></p>
        <?php endif; ?>
        <div class="entry-list">
            <?php foreach ( $testimonials as $testi ) :
                $id       = $testi->ID;
                $quote    = hdgavi_meta_tri( $id, '_testi_quote' );
                $role     = hdgavi_meta_tri( $id, '_testi_role' );
                $name     = get_post_meta( $id, '_testi_name', true );
                $company  = get_post_meta( $id, '_testi_company', true );
                $photo    = get_post_meta( $id, '_testi_photo', true );
                $relation = get_post_meta( $id, '_testi_relation', true );
            ?>
            <figure class="entry">
                <figcaption class="testi-author">
                    <?php if ( ! empty( $photo ) ) : ?>
                    <img src="<?php echo esc_url( $photo ); ?>" alt="" class="testi-photo" width="48" height="48" loading="lazy" decoding="async">
                    <?php endif; ?>
                    <span class="testi-name"><?php echo esc_html( $name ); ?></span>
                    <?php if ( '' !== $role['en'] || $company ) : ?>
                    <span class="testi-role"><?php if ( '' !== $role['en'] ) echo hdgavi_tri_arr( $role ); ?><?php if ( '' !== $role['en'] && $company ) echo ', '; ?><?php echo esc_html( $company ); ?></span>
                    <?php endif; ?>
                    <?php if ( $relation ) : ?>
                    <span class="testi-relation"><?php echo esc_html( $relation ); ?></span>
                    <?php endif; ?>
                </figcaption>
                <blockquote class="what testi-quote"><p><?php echo hdgavi_tri_arr( $quote ); ?></p></blockquote>
            </figure>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_testi_empty', 'No testimonial published yet.', 'Aucun témoignage publié pour le moment.', 'Ningún testimonio publicado por el momento.' ) ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
