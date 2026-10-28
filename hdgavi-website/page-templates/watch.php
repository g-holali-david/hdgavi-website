<?php
/**
 * Template Name: Veille Tech / Tech Watch
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_watch_section_en', 'Tech Watch' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_watch_section_fr', 'Veille Tech' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_watch_section_es', 'Vigilancia Tech' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_watch_title_en', 'Tech Watch' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_watch_title_fr', 'Veille Technologique' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_watch_title_es', 'Vigilancia Tecnológica' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_watch_desc_en', 'Curated articles and resources on DevOps, Cloud, Kubernetes and infrastructure.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_watch_desc_fr', 'Articles et ressources sur le DevOps, le Cloud, Kubernetes et l\'infrastructure.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_watch_desc_es', 'Artículos y recursos sobre DevOps, Cloud, Kubernetes e infraestructura.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <!-- Category filters -->
        <!-- Search + RSS -->
        <div class="watch-toolbar fade-up">
            <div class="watch-search">
                <input type="text" id="watchSearch" placeholder="<?php echo esc_attr( hdgavi_opt( 'label_watch_search_en', 'Search articles...' ) ); ?>" data-placeholder-en="<?php echo esc_attr( hdgavi_opt( 'label_watch_search_en', 'Search articles...' ) ); ?>" data-placeholder-fr="<?php echo esc_attr( hdgavi_opt( 'label_watch_search_fr', 'Rechercher des articles...' ) ); ?>" data-placeholder-es="<?php echo esc_attr( hdgavi_opt( 'label_watch_search_es', 'Buscar artículos...' ) ); ?>" class="watch-search-input">
            </div>
            <a href="<?php echo esc_url( home_url( '/feed/?cat=' . get_cat_ID( 'veille' ) ) ); ?>" class="watch-rss-link" target="_blank" rel="noopener" title="RSS Feed">
                <?php echo hdgavi_icon( 'rss', 16 ); ?>
                RSS
            </a>
        </div>

        <!-- Dynamic tag filters -->
        <div class="watch-filters fade-up">
            <button class="watch-filter active" data-filter="all">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_watch_filter_all_en', 'All' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_watch_filter_all_fr', 'Tous' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_watch_filter_all_es', 'Todos' ) ); ?></span>
            </button>
            <?php
            // Get all tags used by posts in category "veille" (single query)
            $veille_cat_id = get_cat_ID( 'veille' );
            $veille_tags = array();
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
            foreach ( $veille_tags as $slug => $tag_name ) : ?>
            <button class="watch-filter" data-filter="<?php echo esc_attr( $slug ); ?>">
                <?php echo esc_html( $tag_name ); ?>
            </button>
            <?php endforeach; ?>
        </div>

        <!-- Articles grid -->
        <div class="watch-grid" id="watchGrid">
            <?php
            $watch_query = new WP_Query( array(
                'post_type'      => 'post',
                'category_name'  => 'veille',
                'posts_per_page' => intval( hdgavi_opt( 'limit_watch', 30 ) ),
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
            if ( $watch_query->have_posts() ) :
                while ( $watch_query->have_posts() ) : $watch_query->the_post();
                    $wid     = get_the_ID();
                    $tags    = wp_get_post_tags( $wid, array( 'fields' => 'slugs' ) );
                    $tag_list = implode( ' ', $tags );
                    $source  = get_post_meta( $wid, 'watch_source', true );
                    $ext_url = get_post_meta( $wid, 'watch_url', true );
                    $link    = ! empty( $ext_url ) ? $ext_url : get_the_permalink();
                    $target  = ! empty( $ext_url ) ? ' target="_blank" rel="noopener"' : '';
                    // Trilingual title & excerpt
                    $t_en = get_post_meta( $wid, '_watch_title_en', true );
                    $t_fr = get_post_meta( $wid, '_watch_title_fr', true );
                    $t_es = get_post_meta( $wid, '_watch_title_es', true );
                    $e_en = get_post_meta( $wid, '_watch_excerpt_en', true );
                    $e_fr = get_post_meta( $wid, '_watch_excerpt_fr', true );
                    $e_es = get_post_meta( $wid, '_watch_excerpt_es', true );
                    $has_tri_title   = $t_en || $t_fr || $t_es;
                    $has_tri_excerpt = $e_en || $e_fr || $e_es;
                    $fallback_title  = get_the_title();
                    $fallback_excerpt = esc_html( wp_trim_words( get_the_excerpt(), 20 ) );
            ?>
            <div class="watch-card fade-up" data-tags="<?php echo esc_attr( $tag_list ); ?>" data-title="<?php echo esc_attr( implode( ' ', array_filter( array( $fallback_title, $t_en, $t_fr, $t_es ) ) ) ); ?>">
                <div class="watch-card-top">
                    <?php foreach ( array_slice( $tags, 0, 2 ) as $tag ) : ?>
                    <span class="watch-tag"><?php echo esc_html( $tag ); ?></span>
                    <?php endforeach; ?>
                    <span class="watch-date"><?php echo esc_html( get_the_date( 'M j' ) ); ?></span>
                </div>
                <a href="<?php echo esc_url( $link ); ?>"<?php echo $target; ?> class="watch-card-link">
                    <h3 class="watch-card-title"><?php if ( $has_tri_title ) : ?>
                        <span data-lang="en"><?php echo esc_html( $t_en ?: $fallback_title ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( $t_fr ?: $fallback_title ); ?></span>
                        <span data-lang="es"><?php echo esc_html( $t_es ?: $t_en ?: $fallback_title ); ?></span>
                    <?php else : the_title(); endif; ?></h3>
                </a>
                <p class="watch-card-excerpt"><?php if ( $has_tri_excerpt ) : ?>
                    <span data-lang="en"><?php echo esc_html( $e_en ?: $fallback_excerpt ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $e_fr ?: $fallback_excerpt ); ?></span>
                    <span data-lang="es"><?php echo esc_html( $e_es ?: $e_en ?: $fallback_excerpt ); ?></span>
                <?php else : echo $fallback_excerpt; endif; ?></p>
                <?php if ( $source ) : ?>
                <div class="watch-card-source"><?php echo esc_html( $source ); ?></div>
                <?php endif; ?>
                <div class="watch-card-share">
                    <button class="share-btn" data-share="twitter" data-url="<?php echo esc_attr( $link ); ?>" title="Twitter">𝕏</button>
                    <button class="share-btn" data-share="linkedin" data-url="<?php echo esc_attr( $link ); ?>" title="LinkedIn">in</button>
                    <button class="share-btn" data-share="copy" data-url="<?php echo esc_attr( $link ); ?>" title="Copy link">🔗</button>
                    <button class="fav-btn" data-fav="<?php echo esc_attr( get_the_ID() ); ?>" title="Favorite">☆</button>
                </div>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
            <?php else : ?>
            <p class="section-desc" style="grid-column:1/-1">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_watch_empty_en', 'No articles yet. Stay tuned!' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_watch_empty_fr', 'Aucun article pour l\'instant. Restez connecté !' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_watch_empty_es', '¡Aún no hay artículos. ¡Estén atentos!' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
