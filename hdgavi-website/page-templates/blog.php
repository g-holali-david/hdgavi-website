<?php
/**
 * Template Name: Blog / Articles
 * Articles (all posts except the "veille" category) as a plain dated list.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

/**
 * Articles hold one <div data-lang="xx"> block per language: split them (lang => html).
 * Returns an empty array for content without language blocks.
 */
$lang_blocks = function ( $content ) {
    $parts  = preg_split( '#<div data-lang="(en|fr|es)">#', (string) $content, -1, PREG_SPLIT_DELIM_CAPTURE );
    $blocks = array();
    for ( $i = 1; $i + 1 < count( $parts ); $i += 2 ) {
        $blocks[ $parts[ $i ] ] = $parts[ $i + 1 ];
    }
    return $blocks;
};
/** First real paragraph (an all-italic byline is skipped), trimmed. */
$excerpt_from = function ( $html ) {
    if ( preg_match_all( '#<p[^>]*>(.*?)</p>#s', $html, $m ) ) {
        foreach ( $m[1] as $p ) {
            if ( preg_match( '#^\s*<(em|i)>.*</\1>\s*$#s', $p ) ) continue;
            $text = trim( wp_strip_all_tags( $p ) );
            if ( '' !== $text ) return wp_trim_words( $text, 32 );
        }
    }
    return wp_trim_words( wp_strip_all_tags( $html ), 32 );
};
/** Reading time in minutes (200 words a minute), counted on one language only. */
$minutes_of = function ( $html ) {
    $words = preg_split( '/\s+/u', trim( wp_strip_all_tags( (string) $html ) ), -1, PREG_SPLIT_NO_EMPTY );
    return max( 1, (int) ceil( count( $words ) / 200 ) );
};

$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
$blog_query = new WP_Query( array(
    'post_type'        => 'post',
    'posts_per_page'   => intval( hdgavi_opt( 'limit_blog', 12 ) ),
    'paged'            => $paged,
    'category__not_in' => array( get_cat_ID( 'veille' ) ),
) );
?>
<section class="sec wrap sec--first" aria-labelledby="t-blog">
    <h1 class="sec-title" id="t-blog"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_blog_title', 'Blog', 'Blog', 'Blog' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_blog_desc', 'Articles on cloud-native architecture, DevOps and security.', 'Articles sur l’architecture cloud-native, le DevOps et la sécurité.', 'Artículos sobre arquitectura cloud-native, DevOps y seguridad.' ) ); ?></p>
        <?php endif; ?>

        <?php if ( $blog_query->have_posts() ) : ?>
        <div class="entry-list">
            <?php while ( $blog_query->have_posts() ) : $blog_query->the_post();
                $raw       = get_the_content();
                $blocks    = $lang_blocks( $raw );
                $minutes   = $minutes_of( $blocks ? reset( $blocks ) : $raw );
                $post_tags = get_the_tags();
                if ( has_excerpt() || ! $blocks ) {
                    $excerpt_html = esc_html( wp_trim_words( get_the_excerpt(), 32 ) );
                } else {
                    $first = reset( $blocks );
                    $ex    = array();
                    foreach ( array( 'en', 'fr', 'es' ) as $l ) {
                        $ex[ $l ] = $excerpt_from( isset( $blocks[ $l ] ) ? $blocks[ $l ] : ( isset( $blocks['en'] ) ? $blocks['en'] : $first ) );
                    }
                    $excerpt_html = hdgavi_tri_arr( $ex );
                }
            ?>
            <article class="entry">
                <p class="when"><?php echo esc_html( get_the_date( 'Y-m-d' ) ); ?><span class="place"><?php echo hdgavi_tri( $minutes . ' min read', $minutes . ' min de lecture', $minutes . ' min de lectura' ); ?></span></p>
                <div class="what">
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <p class="desc"><?php echo $excerpt_html; // escaped above ?></p>
                    <?php if ( $post_tags ) : ?>
                    <ul class="stack stack--inline" aria-label="Tags">
                        <?php foreach ( array_slice( $post_tags, 0, 4 ) as $tag ) : ?>
                        <li><?php echo esc_html( $tag->name ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <?php endif; ?>
                </div>
            </article>
            <?php endwhile; ?>
        </div>

        <?php
        $pagination = paginate_links( array(
            'total'   => $blog_query->max_num_pages,
            'current' => $paged,
            'format'  => '?paged=%#%',
        ) );
        wp_reset_postdata();
        if ( $pagination ) : ?>
        <nav class="blog-pagination sec-main" aria-label="Pagination"><?php echo $pagination; // core markup ?></nav>
        <?php endif; ?>

        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_blog_empty', 'No article yet.', 'Aucun article pour le moment.', 'Todavía no hay artículos.' ) ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
