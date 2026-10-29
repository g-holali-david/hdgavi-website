<?php
/**
 * Generic page template
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<article class="sec wrap sec--first" aria-labelledby="t-page">
    <h1 class="sec-title" id="t-page"><?php the_title(); ?></h1>
    <div class="sec-body">
        <div class="prose entry-content">
            <?php the_content(); ?>
        </div>
    </div>
</article>
<?php endwhile; endif;

get_footer();
