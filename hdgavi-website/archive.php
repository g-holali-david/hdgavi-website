<?php
/**
 * Archive template: plain dated list of posts.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<section class="sec wrap sec--first" aria-labelledby="t-archive">
    <h1 class="sec-title" id="t-archive"><?php echo wp_kses_post( get_the_archive_title() ); ?></h1>
    <div class="sec-body">
        <?php the_archive_description( '<div class="sec-lead">', '</div>' ); ?>
        <?php if ( have_posts() ) : ?>
        <div class="entry-list">
            <?php while ( have_posts() ) : the_post(); ?>
            <article class="entry">
                <p class="when"><?php echo esc_html( get_the_date( 'Y-m-d' ) ); ?></p>
                <div class="what">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="desc"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 32 ) ); ?></p>
                </div>
            </article>
            <?php endwhile; ?>
        </div>
        <div class="sec-main"><?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?></div>
        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_archive_empty', 'No posts found.', 'Aucun article trouvé.', 'No se encontraron artículos.' ) ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
