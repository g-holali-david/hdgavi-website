<?php
/**
 * Fallback template: a single entry's content, or a plain dated list of posts.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

if ( is_singular() ) :
    while ( have_posts() ) : the_post(); ?>
<article class="sec wrap sec--first" aria-labelledby="t-index">
    <h1 class="sec-title" id="t-index"><?php the_title(); ?></h1>
    <div class="sec-body">
        <div class="prose entry-content"><?php the_content(); ?></div>
    </div>
</article>
<?php
    endwhile;
else : ?>
<section class="sec wrap sec--first" aria-labelledby="t-index">
    <h1 class="sec-title" id="t-index"><?php echo ( is_home() && ! is_front_page() ) ? esc_html( single_post_title( '', false ) ) : hdgavi_tri( 'Articles', 'Articles', 'Artículos' ); ?></h1>
    <div class="sec-body">
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
        <div class="sec-main"><?php the_posts_pagination(); ?></div>
        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri( 'Nothing to show.', 'Rien à afficher.', 'Nada que mostrar.' ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php endif;

get_footer();
