<?php
/**
 * Single post: section name in the label column, title + mono meta line + text in a reading column,
 * related articles as a plain dated list.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

/** Title of a post, using the trilingual "veille" titles when they exist (escaped). */
$post_title_html = function ( $post_id ) {
    $t = array(
        'en' => (string) get_post_meta( $post_id, '_watch_title_en', true ),
        'fr' => (string) get_post_meta( $post_id, '_watch_title_fr', true ),
        'es' => (string) get_post_meta( $post_id, '_watch_title_es', true ),
    );
    $fallback = get_the_title( $post_id );
    if ( '' === $t['en'] && '' === $t['fr'] && '' === $t['es'] ) return esc_html( $fallback );
    return hdgavi_tri(
        '' !== $t['en'] ? $t['en'] : $fallback,
        '' !== $t['fr'] ? $t['fr'] : $fallback,
        '' !== $t['es'] ? $t['es'] : ( '' !== $t['en'] ? $t['en'] : $fallback )
    );
};

/** Reading time in minutes (200 words a minute), counted on the first language block of the article. */
$minutes_of = function ( $content ) {
    $parts = preg_split( '#<div data-lang="(?:en|fr|es)">#', (string) $content );
    $text  = ( count( $parts ) > 1 ) ? $parts[1] : (string) $content;
    $words = preg_split( '/\s+/u', trim( wp_strip_all_tags( $text ) ), -1, PREG_SPLIT_NO_EMPTY );
    return max( 1, (int) ceil( count( $words ) / 200 ) );
};

if ( have_posts() ) : while ( have_posts() ) : the_post();
    $pid       = get_the_ID();
    $is_watch  = has_category( 'veille' );
    $back_url  = hdgavi_page_url( $is_watch ? 'watch' : 'blog' );
    $back_lbl  = $is_watch ? array( 'en' => 'Tech watch', 'fr' => 'Veille', 'es' => 'Vigilancia' ) : array( 'en' => 'Blog', 'fr' => 'Blog', 'es' => 'Blog' );
    $minutes   = $minutes_of( get_the_content() );
    $post_tags = get_the_tags();
    $permalink = get_the_permalink();
?>
<article class="post wrap" aria-labelledby="t-post">
    <p class="post-section"><?php if ( $back_url ) : ?><a href="<?php echo esc_url( $back_url ); ?>"><?php echo hdgavi_tri_arr( $back_lbl ); ?></a><?php else : ?><?php echo hdgavi_tri_arr( $back_lbl ); ?><?php endif; ?></p>
    <header class="post-head">
        <h1 class="post-title" id="t-post"><?php echo $post_title_html( $pid ); // escaped in the closure ?></h1>
        <p class="post-meta">
            <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date( 'Y-m-d' ) ); ?></time>
            · <?php echo hdgavi_tri( $minutes . ' min read', $minutes . ' min de lecture', $minutes . ' min de lectura' ); ?>
            <?php if ( $post_tags ) : ?>· <?php echo esc_html( implode( ', ', wp_list_pluck( array_slice( $post_tags, 0, 5 ), 'name' ) ) ); ?><?php endif; ?>
        </p>
    </header>
    <div class="post-body prose entry-content">
        <?php the_content(); ?>
    </div>
    <footer class="post-foot">
        <p class="post-share">
            <span><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_share', 'Share:', 'Partager :', 'Compartir:' ) ); ?></span>
            <button type="button" class="share-btn" data-share="linkedin" data-url="<?php echo esc_url( $permalink ); ?>">LinkedIn</button>
            <button type="button" class="share-btn" data-share="twitter" data-url="<?php echo esc_url( $permalink ); ?>">X</button>
            <button type="button" class="share-btn" data-share="copy" data-url="<?php echo esc_url( $permalink ); ?>" data-label-en="Copy link" data-label-fr="Copier le lien" data-label-es="Copiar el enlace" data-done-en="Link copied" data-done-fr="Lien copié" data-done-es="Enlace copiado"></button>
        </p>
    </footer>
</article>
<?php
    // Related articles by shared tags
    $related_tag_ids = wp_get_post_tags( $pid, array( 'fields' => 'ids' ) );
    $related         = array();
    if ( ! empty( $related_tag_ids ) ) {
        $related = get_posts( array(
            'tag__in'        => $related_tag_ids,
            'post__not_in'   => array( $pid ),
            'posts_per_page' => 3,
            'orderby'        => 'date',
            'order'          => 'DESC',
        ) );
    }
    if ( ! empty( $related ) ) :
?>
<section class="sec wrap related-articles" aria-labelledby="t-related">
    <h2 class="sec-title" id="t-related"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_related', 'Related articles', 'Articles similaires', 'Artículos relacionados' ) ); ?></h2>
    <div class="sec-body">
        <?php foreach ( $related as $rel ) :
            $rel_minutes = $minutes_of( $rel->post_content );
        ?>
        <article class="entry">
            <p class="when"><?php echo esc_html( get_the_date( 'Y-m-d', $rel->ID ) ); ?><span class="place"><?php echo hdgavi_tri( $rel_minutes . ' min read', $rel_minutes . ' min de lecture', $rel_minutes . ' min de lectura' ); ?></span></p>
            <div class="what">
                <h3><a href="<?php echo esc_url( get_permalink( $rel->ID ) ); ?>"><?php echo $post_title_html( $rel->ID ); // escaped in the closure ?></a></h3>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>
<?php
    endif;
endwhile; endif;

get_footer();
