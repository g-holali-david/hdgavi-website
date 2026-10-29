<?php
/**
 * CV intro: portrait, name, role, then either the summary (home) or the full presentation (about).
 * Args: variant = 'home' | 'about'
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$args     = wp_parse_args( isset( $args ) ? $args : array(), array( 'variant' => 'home' ) );
$is_about = ( 'about' === $args['variant'] );
$name     = hdgavi_opt( 'general_name', 'Holali David GAVI' );
$photo    = hdgavi_opt( 'profile_photo', '' );
$cv_url   = hdgavi_opt( 'cv_pdf_url', '' );
$email    = hdgavi_opt( 'general_email', '' );
$github   = hdgavi_opt( 'contact_github', '' );
$linkedin = hdgavi_opt( 'contact_linkedin', '' );

$classes = 'intro wrap';
if ( ! $photo ) $classes .= ' intro--noportrait';
if ( $is_about ) $classes .= ' intro--about';

if ( $is_about ) {
    $facts = array(
        'current'   => hdgavi_cv( 'fact_role' ),
        'location'  => array( 'en' => hdgavi_cv_location(), 'fr' => hdgavi_cv_location(), 'es' => hdgavi_cv_location() ),
        'languages' => hdgavi_cv( 'fact_languages' ),
        'interests' => hdgavi_cv( 'fact_interests' ),
    );
} else {
    $facts = array(
        'looking_for' => hdgavi_cv( 'fact_search' ),
        'location'    => array( 'en' => hdgavi_cv_location(), 'fr' => hdgavi_cv_location(), 'es' => hdgavi_cv_location() ),
        'training'    => hdgavi_cv( 'fact_education' ),
        'languages'   => hdgavi_cv( 'fact_languages_short' ),
    );
}
if ( $is_about && hdgavi_opt( 'show_rqth', false ) ) {
    $facts['rqth'] = hdgavi_cv_label( 'rqth' );
}
$fact_labels = array( 'rqth' => hdgavi_cv_label( 'status' ) );
?>
<section class="<?php echo esc_attr( $classes ); ?>" aria-labelledby="introName">
    <?php if ( $photo && hdgavi_opt( 'show_photo_splash', true ) ) : ?>
    <figure class="portrait">
        <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" fetchpriority="high" decoding="async">
    </figure>
    <?php endif; ?>

    <div class="intro-head">
        <h1 id="introName"><?php echo hdgavi_name_html( $name ); // escaped in helper ?></h1>
        <p class="role"><?php echo hdgavi_tri_arr( hdgavi_cv( 'role' ) ); ?></p>
    </div>

    <?php if ( $is_about ) : ?>
    <div class="lead prose"><?php echo hdgavi_tri_html( hdgavi_cv( 'about' ) ); ?></div>
    <?php else : ?>
    <div class="lead"><p><?php echo hdgavi_tri_arr( hdgavi_cv( 'lead' ) ); ?></p></div>
    <?php endif; ?>

    <dl class="facts">
        <?php foreach ( $facts as $key => $value ) : ?>
        <div>
            <dt><?php echo hdgavi_tri_arr( isset( $fact_labels[ $key ] ) ? $fact_labels[ $key ] : hdgavi_cv_label( $key ) ); ?></dt>
            <dd><?php echo hdgavi_tri_arr( $value ); ?></dd>
        </div>
        <?php endforeach; ?>
    </dl>

    <div class="actions">
        <?php if ( $cv_url ) : ?>
        <a class="btn" href="<?php echo esc_url( home_url( '/?hdgavi_cv=download' ) ); ?>" type="application/pdf"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'download_cv' ) ); ?></a>
        <?php endif; ?>
        <ul>
            <?php if ( $github ) : ?><li><a href="<?php echo esc_url( $github ); ?>" rel="me noopener">GitHub</a></li><?php endif; ?>
            <?php if ( $linkedin ) : ?><li><a href="<?php echo esc_url( $linkedin ); ?>" rel="me noopener">LinkedIn</a></li><?php endif; ?>
            <?php if ( $email ) : ?><li><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></li><?php endif; ?>
        </ul>
    </div>
</section>
