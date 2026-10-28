<?php
/**
 * Search results template
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_search_title_en', 'Search results for:' ) ); ?> <?php the_search_query(); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_search_title_fr', 'Résultats pour :' ) ); ?> <?php the_search_query(); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_search_title_es', 'Resultados para:' ) ); ?> <?php the_search_query(); ?></span>
            </h1>
        </div>
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article class="project-card fade-up" style="margin-bottom:16px">
            <h3 class="project-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <p class="project-desc"><?php the_excerpt(); ?></p>
        </article>
        <?php endwhile; ?>
        <?php the_posts_pagination(); ?>
        <?php else : ?>
        <p class="section-desc">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_search_empty_en', 'No results found.' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_search_empty_fr', 'Aucun résultat trouvé.' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_search_empty_es', 'No se encontraron resultados.' ) ); ?></span>
        </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
