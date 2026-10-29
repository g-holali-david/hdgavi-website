<?php
/**
 * Search results: plain list, with the search form.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>
<section class="sec wrap sec--first" aria-labelledby="t-search">
    <h1 class="sec-title" id="t-search"><?php echo hdgavi_tri( 'Search', 'Recherche', 'Búsqueda' ); ?></h1>
    <div class="sec-body">
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_search_title', 'Search results for:', 'Résultats pour :', 'Resultados para:' ) ); ?> <strong><?php echo esc_html( get_search_query() ); ?></strong></p>
        <form role="search" method="get" class="search-form sec-main" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <label class="vh" for="search-q"><?php echo hdgavi_tri( 'Search', 'Rechercher', 'Buscar' ); ?></label>
            <input type="search" id="search-q" name="s" value="<?php echo esc_attr( get_search_query() ); ?>">
            <button type="submit" class="btn-ghost"><?php echo hdgavi_tri( 'Search', 'Rechercher', 'Buscar' ); ?></button>
        </form>
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
        <p class="sec-lead empty-note"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_search_empty', 'No results found.', 'Aucun résultat.', 'No se encontraron resultados.' ) ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
