<?php
/**
 * Template Name: Blog / Articles
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$blog_query = new WP_Query( array(
    'post_type'      => 'post',
    'posts_per_page' => intval( hdgavi_opt( 'limit_blog', 12 ) ),
    'paged'          => $paged,
    'category__not_in' => array( get_cat_ID( 'veille' ) ),
) );
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_blog_section_en', 'Blog' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_blog_section_fr', 'Blog' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_blog_section_es', 'Blog' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_blog_title_en', 'Articles & Notes' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_blog_title_fr', 'Articles & Notes' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_blog_title_es', 'Artículos & Notas' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_blog_desc_en', 'Technical articles, tutorials and thoughts on DevOps, Cloud and development.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_blog_desc_fr', 'Articles techniques, tutoriels et réflexions sur le DevOps, Cloud et développement.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_blog_desc_es', 'Artículos técnicos, tutoriales y reflexiones sobre DevOps, Cloud y desarrollo.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <?php if ( $blog_query->have_posts() ) : ?>
        <div class="blog-grid">
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); ?>
            <article class="blog-card fade-up">
                <?php if ( has_post_thumbnail() ) : ?>
                <div class="blog-card-thumb">
                    <?php the_post_thumbnail( 'medium_large' ); ?>
                </div>
                <?php endif; ?>
                <div class="blog-card-body">
                    <div class="blog-card-meta">
                        <span><?php echo esc_html( get_the_date( 'M j, Y' ) ); ?></span>
                        <span><?php echo esc_html( ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) ); ?> min</span>
                    </div>
                    <h2 class="blog-card-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                    <p class="blog-card-excerpt"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 25 ) ); ?></p>
                    <div class="blog-card-tags">
                        <?php
                        $post_tags = get_the_tags();
                        if ( $post_tags ) :
                            foreach ( array_slice( $post_tags, 0, 3 ) as $tag ) : ?>
                        <span class="skill-tag"><?php echo esc_html( $tag->name ); ?></span>
                        <?php endforeach; endif; ?>
                    </div>
                </div>
            </article>
            <?php endwhile; ?>
        </div>

        <div class="blog-pagination fade-up">
            <?php
            echo paginate_links( array(
                'total'   => $blog_query->max_num_pages,
                'current' => $paged,
                'format'  => '?paged=%#%',
            ) );
            wp_reset_postdata();
            ?>
        </div>

        <?php else : ?>
        <p class="section-desc">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_blog_empty_en', 'No articles yet. Coming soon!' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_blog_empty_fr', 'Aucun article pour l\'instant. Bientôt !' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_blog_empty_es', '¡Aún no hay artículos. Próximamente!' ) ); ?></span>
        </p>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
