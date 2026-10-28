<?php
/**
 * Default template — redirects to splash or about
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <h1 class="section-title"><?php the_title(); ?></h1>
        <div class="about-text">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) : the_post();
                    the_content();
                endwhile;
            endif;
            ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
