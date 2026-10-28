<?php
/**
 * Generic page template
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <div class="section-header fade-up">
            <h1 class="section-title"><?php the_title(); ?></h1>
        </div>
        <div class="about-text fade-up">
            <?php the_content(); ?>
        </div>
        <?php endwhile; endif; ?>
    </div>
</section>

<?php get_footer(); ?>
