<?php
/**
 * Template Name: About / Qui je suis
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$photo       = hdgavi_opt( 'profile_photo', '' );
$show_photo  = hdgavi_opt( 'show_photo_about', true );
$show_quote  = hdgavi_opt( 'show_about_quote', true );
$show_stats  = hdgavi_opt( 'show_about_stats', true );
$show_traits = hdgavi_opt( 'show_about_traits', true );
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_about_section_en', 'About me' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_about_section_fr', 'Qui je suis' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_about_section_es', 'Sobre mí' ) ); ?></span>
            </div>
            <h1 class="section-title"><?php echo esc_html( hdgavi_opt( 'general_name', 'Holali David GAVI' ) ); ?></h1>
        </div>

        <div class="about-grid"<?php echo ! $show_traits ? ' style="' . esc_attr( 'grid-template-columns:1fr' ) . '"' : ''; ?>>
            <div class="about-main">
                <?php if ( ! empty( $photo ) && $show_photo ) : ?>
                <img src="<?php echo esc_url( $photo ); ?>" alt="<?php echo esc_attr( hdgavi_opt( 'general_name', '' ) ); ?>" class="about-photo fade-up" loading="lazy" decoding="async">
                <?php endif; ?>

                <div class="about-badge fade-up">
                    <?php echo hdgavi_icon( 'briefcase', 14 ); ?>
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'about_badge_en', 'Cloud & DevOps Engineer' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'about_badge_fr', 'Ingénieur Cloud & DevOps' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'about_badge_es', 'Ingeniero Cloud & DevOps' ) ); ?></span>
                </div>

                <?php if ( hdgavi_opt( 'show_about_text', true ) ) : ?>
                <div class="about-text fade-up">
                    <?php hdgavi_bilingual_html( 'about_text', '', '' ); ?>
                </div>
                <?php endif; ?>

                <?php if ( $show_quote ) :
                    $quote_en = hdgavi_opt( 'about_quote_en', '' );
                    $quote_fr = hdgavi_opt( 'about_quote_fr', '' );
                    if ( ! empty( $quote_en ) || ! empty( $quote_fr ) ) : ?>
                <blockquote class="about-quote fade-up">
                    <span data-lang="en">&ldquo;<?php echo esc_html( $quote_en ); ?>&rdquo;</span>
                    <span data-lang="fr">&laquo; <?php echo esc_html( $quote_fr ); ?> &raquo;</span>
                    <span data-lang="es">&laquo; <?php echo esc_html( hdgavi_opt( 'about_quote_es', $quote_en ) ); ?> &raquo;</span>
                </blockquote>
                <?php endif; endif; ?>

                <?php if ( $show_stats ) : ?>
                <div class="stats-grid fade-up">
                    <?php for ( $i = 1; $i <= 4; $i++ ) :
                        $num = hdgavi_opt( "stat_{$i}_number", '' );
                        if ( empty( $num ) ) continue;
                    ?>
                    <div class="stat-card">
                        <div class="stat-number" data-count="<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $num ) ); ?>" data-suffix="<?php echo esc_attr( preg_replace( '/[0-9]/', '', $num ) ); ?>">
                            <?php echo esc_html( $num ); ?>
                        </div>
                        <div class="stat-label">
                            <span data-lang="en"><?php echo esc_html( hdgavi_opt( "stat_{$i}_label_en", '' ) ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( "stat_{$i}_label_fr", '' ) ); ?></span>
                            <span data-lang="es"><?php echo esc_html( hdgavi_opt( "stat_{$i}_label_es", '' ) ); ?></span>
                        </div>
                    </div>
                    <?php endfor; ?>
                </div>
                <?php endif; ?>
            </div>

            <?php if ( $show_traits ) : ?>
            <aside class="traits-sidebar">
                <?php
                $max_traits = intval( hdgavi_opt( 'limit_traits', 7 ) );
                for ( $i = 1; $i <= $max_traits; $i++ ) :
                    $title_en = hdgavi_opt( "trait_{$i}_en", '' );
                    if ( empty( $title_en ) ) continue;
                    $color = hdgavi_opt( "trait_{$i}_color", '#06B6D4' );
                ?>
                <div class="trait-card fade-up" style="border-left:2px solid <?php echo esc_attr( $color ); ?>">
                    <div class="trait-title" style="color:<?php echo esc_attr( $color ); ?>">
                        <span data-lang="en"><?php echo esc_html( $title_en ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( hdgavi_opt( "trait_{$i}_fr", '' ) ); ?></span>
                        <span data-lang="es"><?php echo esc_html( hdgavi_opt( "trait_{$i}_es", '' ) ); ?></span>
                    </div>
                    <div class="trait-desc">
                        <span data-lang="en"><?php echo esc_html( hdgavi_opt( "trait_{$i}_desc_en", '' ) ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( hdgavi_opt( "trait_{$i}_desc_fr", '' ) ); ?></span>
                        <span data-lang="es"><?php echo esc_html( hdgavi_opt( "trait_{$i}_desc_es", '' ) ); ?></span>
                    </div>
                </div>
                <?php endfor; ?>
            </aside>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
