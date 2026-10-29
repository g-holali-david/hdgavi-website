<?php
/**
 * Template Name: Availability / Disponibilité
 * Only what the CV says: current position, goal, location.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$cv_url  = hdgavi_opt( 'cv_pdf_url', '' );
$contact = hdgavi_page_url( 'contact' );
?>
<section class="sec wrap sec--first" aria-labelledby="t-availability">
    <h1 class="sec-title" id="t-availability"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'availability' ) ); ?></h1>
    <div class="sec-body">
        <dl class="coords">
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'current' ) ); ?></dt>
                <dd><?php echo hdgavi_tri_arr( hdgavi_cv( 'fact_role' ) ); ?></dd>
            </div>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'looking_for' ) ); ?></dt>
                <dd><?php echo hdgavi_tri_arr( hdgavi_cv( 'fact_search' ) ); ?></dd>
            </div>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'location' ) ); ?></dt>
                <dd><?php echo esc_html( hdgavi_cv_location() ); ?></dd>
            </div>
            <?php if ( hdgavi_opt( 'show_rqth', false ) ) : ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'status' ) ); ?></dt>
                <dd><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'rqth' ) ); ?></dd>
            </div>
            <?php endif; ?>
        </dl>
        <div class="entry">
            <p class="when"></p>
            <div class="actions">
                <?php if ( $cv_url ) : ?>
                <a class="btn" href="<?php echo esc_url( home_url( '/?hdgavi_cv=download' ) ); ?>" type="application/pdf"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'download_cv' ) ); ?></a>
                <?php endif; ?>
                <?php if ( $contact ) : ?>
                <ul><li><a href="<?php echo esc_url( $contact ); ?>"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'contact' ) ); ?></a></li></ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>
