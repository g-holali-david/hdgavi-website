<?php
/**
 * HD GAVI Portfolio — Header
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$default_lang = hdgavi_opt( 'default_lang', 'en' );
$cv_url       = hdgavi_opt( 'cv_pdf_url', '' );
$is_terminal  = is_page_template( 'page-templates/terminal.php' );
$show_navbar  = hdgavi_opt( 'show_navbar', true );
$brand_name   = hdgavi_opt( 'general_name', 'Holali David GAVI' );

// "Holali David GAVI": an all-caps surname gets a little letter-spacing.
$brand_parts = explode( ' ', trim( $brand_name ) );
$brand_last  = array_pop( $brand_parts );
$brand_first = implode( ' ', $brand_parts );
$brand_caps  = ( $brand_last === strtoupper( $brand_last ) && strlen( $brand_last ) > 1 );

$theme_icon = '<svg width="20" height="20" viewBox="0 0 20 20" aria-hidden="true" focusable="false"><circle cx="10" cy="10" r="7.25" fill="none" stroke="currentColor" stroke-width="1.5"/><path d="M10 2.75a7.25 7.25 0 0 1 0 14.5z" fill="currentColor"/></svg>';
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
(function (h) {
    h.classList.add('js-enabled');
    try {
        var t = localStorage.getItem('hdgavi_theme_v2');
        if (t !== 'dark' && t !== 'light') {
            t = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
        }
        h.setAttribute('data-theme', t);
        var l = localStorage.getItem('hdgavi_lang');
        h.setAttribute('lang', (l === 'en' || l === 'fr' || l === 'es') ? l : '<?php echo esc_js( $default_lang ); ?>');
    } catch (e) {}
})(document.documentElement);
</script>
<meta name="theme-color" content="#F8F7F3" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#1F1E1B" media="(prefers-color-scheme: dark)">
<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/manifest.json' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#pageContent"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'skip' ) ); ?></a>

<?php if ( ! $is_terminal && $show_navbar ) : ?>
<header class="site-header wrap" id="siteHeader">
    <div class="bar">
        <a class="brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
            <?php if ( $brand_first ) : ?><?php echo esc_html( $brand_first ); ?> <?php endif; ?><span<?php echo $brand_caps ? ' class="caps"' : ''; ?>><?php echo esc_html( $brand_last ); ?></span>
        </a>

        <button class="icon-btn theme-btn theme-btn--bar" type="button" data-theme-toggle aria-pressed="false">
            <span class="vh"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'dark_mode' ) ); ?></span>
            <?php echo $theme_icon; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG ?>
        </button>
        <button class="menu-btn" id="navBurger" type="button" aria-expanded="false" aria-controls="siteMenu">
            <svg class="i-open" width="18" height="18" viewBox="0 0 18 18" aria-hidden="true" focusable="false"><path d="M2 6.5h14M2 11.5h14" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
            <svg class="i-close" width="18" height="18" viewBox="0 0 18 18" aria-hidden="true" focusable="false"><path d="M4 4l10 10M14 4L4 14" fill="none" stroke="currentColor" stroke-width="1.5"/></svg>
            <span><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'menu' ) ); ?></span>
        </button>

        <div class="nav-zone" id="siteMenu">
            <nav class="primary" aria-label="Navigation">
                <ul>
                    <?php foreach ( hdgavi_primary_nav() as $slug => $item ) : ?>
                    <li><a href="<?php echo esc_url( $item['url'] ); ?>"<?php echo is_page( $slug ) ? ' aria-current="page"' : ''; ?>><?php echo hdgavi_tri_arr( $item['labels'] ); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </nav>
            <div class="utils">
                <?php if ( ! empty( $cv_url ) && hdgavi_opt( 'show_nav_cv', true ) ) : ?>
                <a class="cv-link" href="<?php echo esc_url( home_url( '/?hdgavi_cv=preview' ) ); ?>" target="_blank" rel="noopener" type="application/pdf">CV <span class="fmt">(PDF)</span></a>
                <?php endif; ?>
                <div class="lang" role="group" aria-label="Language / Langue">
                    <button type="button" data-set-lang="fr" lang="fr" aria-pressed="<?php echo 'fr' === $default_lang ? 'true' : 'false'; ?>" title="Français">FR</button>
                    <button type="button" data-set-lang="en" lang="en" aria-pressed="<?php echo 'en' === $default_lang ? 'true' : 'false'; ?>" title="English">EN</button>
                    <button type="button" data-set-lang="es" lang="es" aria-pressed="<?php echo 'es' === $default_lang ? 'true' : 'false'; ?>" title="Español">ES</button>
                </div>
                <button class="icon-btn theme-btn theme-btn--zone" type="button" data-theme-toggle aria-pressed="false">
                    <span class="vh"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'dark_mode' ) ); ?></span>
                    <?php echo $theme_icon; // phpcs:ignore WordPress.Security.EscapeOutput -- static SVG ?>
                </button>
            </div>
        </div>
    </div>
</header>
<?php endif; ?>

<?php if ( ! $is_terminal ) : ?>
<main class="site-main" id="pageContent">
<?php endif; ?>
