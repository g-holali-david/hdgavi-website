<?php
/**
 * Archive template
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <h1 class="section-title"><?php the_archive_title(); ?></h1>
            <?php the_archive_description( '<p class="section-desc">', '</p>' ); ?>
        </div>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="project-card fade-up" style="margin-bottom:16px">
            <h3 class="project-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="project-desc"><?php the_excerpt(); ?></p>
            <span class="edu-period"><?php echo get_the_date(); ?></span>
        </article>
        <?php endwhile; ?>
        <div style="margin-top:32px">
            <?php the_posts_pagination( array( 'mid_size' => 2 ) ); ?>
        </div>
        <?php else : ?>
        <p class="section-desc">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_archive_empty_en', 'No posts found.' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_archive_empty_fr', 'Aucun article trouvé.' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_archive_empty_es', 'No se encontraron artículos.' ) ); ?></span>
        </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
