<?php
/**
 * Single post template
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container" style="max-width:720px">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <article>
            <div class="section-header fade-up">
                <div class="section-label">
                    <?php echo esc_html( get_the_date() ); ?>
                    <span style="margin-left:8px"><?php echo esc_html( ceil( str_word_count( wp_strip_all_tags( get_the_content() ) ) / 200 ) ); ?> min</span>
                </div>
                <h1 class="section-title"><?php
                if ( has_category( 'veille' ) ) :
                    $t_en = get_post_meta( get_the_ID(), '_watch_title_en', true );
                    $t_fr = get_post_meta( get_the_ID(), '_watch_title_fr', true );
                    $t_es = get_post_meta( get_the_ID(), '_watch_title_es', true );
                    if ( $t_en || $t_fr || $t_es ) : ?>
                        <span data-lang="en"><?php echo esc_html( $t_en ?: get_the_title() ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( $t_fr ?: get_the_title() ); ?></span>
                        <span data-lang="es"><?php echo esc_html( $t_es ?: $t_en ?: get_the_title() ); ?></span>
                    <?php else : the_title(); endif;
                else : the_title(); endif; ?></h1>
                <?php
                $post_tags = get_the_tags();
                if ( $post_tags ) : ?>
                <div class="blog-card-tags" style="margin-top:12px">
                    <?php foreach ( array_slice( $post_tags, 0, 5 ) as $tag ) : ?>
                    <span class="skill-tag"><?php echo esc_html( $tag->name ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
            <div class="about-text fade-up">
                <?php the_content(); ?>
            </div>
            <div class="watch-card-share fade-up" style="margin-top:32px;padding-top:20px;border-top:0.5px solid var(--border)">
                <span style="font-size:0.8125rem;color:var(--text-tertiary);margin-right:8px" data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_share_en', 'Share:' ) ); ?></span>
                <span style="font-size:0.8125rem;color:var(--text-tertiary);margin-right:8px" data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_share_fr', 'Partager :' ) ); ?></span>
                <span style="font-size:0.8125rem;color:var(--text-tertiary);margin-right:8px" data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_share_es', 'Compartir:' ) ); ?></span>
                <button class="share-btn" data-share="twitter" data-url="<?php echo esc_url( get_the_permalink() ); ?>" title="Twitter">𝕏</button>
                <button class="share-btn" data-share="linkedin" data-url="<?php echo esc_url( get_the_permalink() ); ?>" title="LinkedIn">in</button>
                <button class="share-btn" data-share="copy" data-url="<?php echo esc_url( get_the_permalink() ); ?>" title="Copy link">🔗</button>
            </div>
        </article>
        <?php
        // Related articles by shared tags
        $related_tag_ids = wp_get_post_tags( get_the_ID(), array( 'fields' => 'ids' ) );
        if ( ! empty( $related_tag_ids ) ) :
            $related = get_posts( array(
                'tag__in'        => $related_tag_ids,
                'post__not_in'   => array( get_the_ID() ),
                'posts_per_page' => 3,
                'orderby'        => 'date',
                'order'          => 'DESC',
            ) );
            if ( ! empty( $related ) ) :
        ?>
        <div class="related-articles fade-up" style="margin-top:48px;padding-top:32px;border-top:0.5px solid var(--border)">
            <h3 class="related-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_related_en', 'Related articles' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_related_fr', 'Articles similaires' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_related_es', 'Artículos relacionados' ) ); ?></span>
            </h3>
            <div class="related-grid">
                <?php foreach ( $related as $rel ) :
                    $rel_tags = get_the_tags( $rel->ID );
                    $rel_reading = ceil( str_word_count( wp_strip_all_tags( $rel->post_content ) ) / 200 );
                ?>
                <a href="<?php echo esc_url( get_permalink( $rel->ID ) ); ?>" class="related-card">
                    <span class="related-date"><?php echo esc_html( get_the_date( '', $rel->ID ) ); ?> · <?php echo esc_html( $rel_reading ); ?> min</span>
                    <span class="related-card-title"><?php
                        $rt_en = get_post_meta( $rel->ID, '_watch_title_en', true );
                        $rt_fr = get_post_meta( $rel->ID, '_watch_title_fr', true );
                        $rt_es = get_post_meta( $rel->ID, '_watch_title_es', true );
                        if ( $rt_en || $rt_fr || $rt_es ) : ?>
                            <span data-lang="en"><?php echo esc_html( $rt_en ?: $rel->post_title ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( $rt_fr ?: $rel->post_title ); ?></span>
                            <span data-lang="es"><?php echo esc_html( $rt_es ?: $rt_en ?: $rel->post_title ); ?></span>
                        <?php else : echo esc_html( $rel->post_title ); endif; ?></span>
                    <?php if ( $rel_tags ) : ?>
                    <span class="related-tags">
                        <?php foreach ( array_slice( $rel_tags, 0, 3 ) as $rtag ) : ?>
                        <span class="skill-tag"><?php echo esc_html( $rtag->name ); ?></span>
                        <?php endforeach; ?>
                    </span>
                    <?php endif; ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; endif; ?>

        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
