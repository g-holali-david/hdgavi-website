<?php
/**
 * Template Name: Veille Tech / Tech Watch
 * Posts of the "veille" category: search, tag filters, share and bookmark buttons (theme.js).
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

// Tags used by the "veille" posts (single query)
$veille_cat_id = get_cat_ID( 'veille' );
$veille_tags   = array();
if ( $veille_cat_id ) {
    $veille_posts = get_posts( array( 'category' => $veille_cat_id, 'posts_per_page' => 100, 'fields' => 'ids' ) );
    if ( ! empty( $veille_posts ) ) {
        $all_tags = wp_get_object_terms( $veille_posts, 'post_tag', array( 'fields' => 'all' ) );
        if ( ! is_wp_error( $all_tags ) ) {
            foreach ( $all_tags as $t ) {
                if ( ! isset( $veille_tags[ $t->slug ] ) ) {
                    $veille_tags[ $t->slug ] = $t->name;
                }
            }
        }
    }
}
// Fallback if no tags yet
if ( empty( $veille_tags ) ) {
    $veille_tags = array( 'kubernetes' => 'Kubernetes', 'docker' => 'Docker', 'cicd' => 'CI/CD', 'cloud' => 'Cloud', 'security' => 'Security', 'devops' => 'DevOps' );
}

$watch_query = new WP_Query( array(
    'post_type'      => 'post',
    'category_name'  => 'veille',
    'posts_per_page' => intval( hdgavi_opt( 'limit_watch', 30 ) ),
    'orderby'        => 'date',
    'order'          => 'DESC',
) );

// Labels of the share / bookmark buttons (rendered by CSS from data-* attributes, see 20-pages.css)
$copy_attrs = ' data-label-en="Copy link" data-label-fr="Copier le lien" data-label-es="Copiar el enlace" data-done-en="Link copied" data-done-fr="Lien copié" data-done-es="Enlace copiado"';
$fav_attrs  = ' data-label-en="Bookmark" data-label-fr="Marquer" data-label-es="Marcar" data-done-en="Bookmarked" data-done-fr="Marqué" data-done-es="Marcado"';
?>
<section class="sec wrap sec--first" aria-labelledby="t-watch">
    <h1 class="sec-title" id="t-watch"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_watch_title', 'Tech watch', 'Veille technologique', 'Vigilancia tecnológica' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_watch_desc', 'Articles and notes on cloud and cybersecurity.', 'Articles et notes de veille sur le cloud et la cybersécurité.', 'Artículos y notas sobre cloud y ciberseguridad.' ) ); ?></p>
        <?php endif; ?>

        <div class="watch-toolbar sec-main">
            <div class="watch-search">
                <label class="vh" for="watchSearch"><?php echo hdgavi_tri( 'Search the articles', 'Rechercher dans les articles', 'Buscar en los artículos' ); ?></label>
                <input type="search" id="watchSearch" placeholder="<?php echo esc_attr( hdgavi_opt( 'label_watch_search_en', 'Search articles' ) ); ?>" data-placeholder-en="<?php echo esc_attr( hdgavi_opt( 'label_watch_search_en', 'Search articles' ) ); ?>" data-placeholder-fr="<?php echo esc_attr( hdgavi_opt( 'label_watch_search_fr', 'Rechercher un article' ) ); ?>" data-placeholder-es="<?php echo esc_attr( hdgavi_opt( 'label_watch_search_es', 'Buscar un artículo' ) ); ?>" class="watch-search-input" autocomplete="off">
            </div>
            <a href="<?php echo esc_url( home_url( '/feed/?cat=' . $veille_cat_id ) ); ?>" class="watch-rss-link" type="application/rss+xml"><?php echo hdgavi_tri( 'RSS feed', 'Flux RSS', 'Feed RSS' ); ?></a>
        </div>

        <?php if ( $watch_query->have_posts() ) : ?>
        <div class="watch-filters sec-main">
            <button type="button" class="watch-filter active" data-filter="all"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_watch_filter_all', 'All', 'Tous', 'Todos' ) ); ?></button>
            <?php foreach ( $veille_tags as $slug => $tag_name ) : ?>
            <button type="button" class="watch-filter" data-filter="<?php echo esc_attr( $slug ); ?>"><?php echo esc_html( $tag_name ); ?></button>
            <?php endforeach; ?>
        </div>

        <div class="entry-list" id="watchGrid">
            <?php while ( $watch_query->have_posts() ) : $watch_query->the_post();
                $wid      = get_the_ID();
                $tags     = wp_get_post_tags( $wid, array( 'fields' => 'slugs' ) );
                $tag_list = implode( ' ', $tags );
                $source   = get_post_meta( $wid, 'watch_source', true );
                $ext_url  = get_post_meta( $wid, 'watch_url', true );
                $link     = ! empty( $ext_url ) ? $ext_url : get_the_permalink();
                $target   = ! empty( $ext_url ) ? ' target="_blank" rel="noopener"' : '';
                // Trilingual title & excerpt
                $t_en = get_post_meta( $wid, '_watch_title_en', true );
                $t_fr = get_post_meta( $wid, '_watch_title_fr', true );
                $t_es = get_post_meta( $wid, '_watch_title_es', true );
                $e_en = get_post_meta( $wid, '_watch_excerpt_en', true );
                $e_fr = get_post_meta( $wid, '_watch_excerpt_fr', true );
                $e_es = get_post_meta( $wid, '_watch_excerpt_es', true );
                $fallback_title   = get_the_title();
                $fallback_excerpt = wp_trim_words( get_the_excerpt(), 28 );
            ?>
            <article class="entry watch-card" data-tags="<?php echo esc_attr( $tag_list ); ?>" data-title="<?php echo esc_attr( implode( ' ', array_filter( array( $fallback_title, $t_en, $t_fr, $t_es ) ) ) ); ?>">
                <p class="when"><?php echo esc_html( get_the_date( 'Y-m-d' ) ); ?><?php if ( $source ) : ?><span class="place watch-card-source"><?php echo esc_html( $source ); ?></span><?php endif; ?></p>
                <div class="what">
                    <h2 class="watch-card-title"><a href="<?php echo esc_url( $link ); ?>"<?php echo $target; ?>><?php
                        if ( $t_en || $t_fr || $t_es ) {
                            echo hdgavi_tri( $t_en ? $t_en : $fallback_title, $t_fr ? $t_fr : $fallback_title, $t_es ? $t_es : ( $t_en ? $t_en : $fallback_title ) );
                        } else {
                            echo esc_html( $fallback_title );
                        }
                    ?></a></h2>
                    <p class="desc watch-card-excerpt"><?php
                        if ( $e_en || $e_fr || $e_es ) {
                            echo hdgavi_tri( $e_en ? $e_en : $fallback_excerpt, $e_fr ? $e_fr : $fallback_excerpt, $e_es ? $e_es : ( $e_en ? $e_en : $fallback_excerpt ) );
                        } else {
                            echo esc_html( $fallback_excerpt );
                        }
                    ?></p>
                    <?php if ( $tags ) : ?>
                    <ul class="stack stack--inline" aria-label="Tags">
                        <?php foreach ( array_slice( $tags, 0, 3 ) as $tag ) : ?>
                        <li><?php echo esc_html( $tag ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                    <p class="watch-actions">
                        <button type="button" class="share-btn" data-share="linkedin" data-url="<?php echo esc_attr( $link ); ?>">LinkedIn</button>
                        <button type="button" class="share-btn" data-share="twitter" data-url="<?php echo esc_attr( $link ); ?>">X</button>
                        <button type="button" class="share-btn" data-share="copy" data-url="<?php echo esc_attr( $link ); ?>"<?php echo $copy_attrs; ?>></button>
                        <button type="button" class="fav-btn" data-fav="<?php echo esc_attr( $wid ); ?>"<?php echo $fav_attrs; ?>></button>
                    </p>
                </div>
            </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_watch_empty', 'No article yet.', 'Aucun article pour le moment.', 'Todavía no hay artículos.' ) ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
