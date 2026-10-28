<?php
/**
 * HD GAVI Portfolio — Header
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
$default_lang = hdgavi_opt( 'default_lang', 'en' );
$github_url   = hdgavi_opt( 'contact_github', '' );
$linkedin_url = hdgavi_opt( 'contact_linkedin', '' );
$cv_url       = hdgavi_opt( 'cv_pdf_url', '' );
$show_rqth    = hdgavi_opt( 'show_rqth', false ); // Default false — enable via Customizer only if needed
$progress_bar = hdgavi_opt( 'fx_progress_bar', true );
$nav_labels   = hdgavi_nav_labels();
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="dark">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#0B0F1A">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<link rel="manifest" href="<?php echo esc_url( get_template_directory_uri() . '/manifest.json' ); ?>">
<script>document.documentElement.classList.add('js-enabled');</script>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link sr-only" href="#pageContent">
    <span data-lang="en">Skip to content</span>
    <span data-lang="fr">Aller au contenu</span>
    <span data-lang="es">Ir al contenido</span>
</a>

<?php if ( $progress_bar ) : ?>
<div class="reading-progress" id="readingProgress"></div>
<?php endif; ?>

<?php
$is_terminal = is_page_template( 'page-templates/terminal.php' );
$show_navbar = hdgavi_opt( 'show_navbar', true );
if ( ! $is_terminal && $show_navbar ) :
?>
<nav class="navbar" id="navbar">
    <div class="navbar-inner">
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="nav-logo" aria-label="<?php echo esc_attr( hdgavi_get_logo_text() ); ?>">
            <?php $nav_photo = hdgavi_opt( 'profile_photo', '' ); ?>
            <?php if ( ! empty( $nav_photo ) && hdgavi_opt( 'show_photo_navbar', true ) ) : ?>
            <img src="<?php echo esc_url( $nav_photo ); ?>" alt="" class="nav-avatar" decoding="async">
            <?php elseif ( hdgavi_opt( 'show_nav_monogram', true ) ) : ?>
            <span class="monogram"><?php echo esc_html( hdgavi_get_monogram() ); ?></span>
            <?php endif; ?>
            <?php if ( hdgavi_opt( 'show_nav_logo_text', true ) ) : ?>
            <span><?php echo esc_html( hdgavi_get_logo_text() ); ?></span>
            <?php endif; ?>
        </a>

        <div class="nav-links" id="navLinks">
            <button class="nav-mobile-close" id="navMobileClose" type="button" aria-label="Close menu">&times;</button>
            <?php foreach ( $nav_labels as $slug => $labels ) : ?>
            <a href="<?php echo esc_url( home_url( '/' . $slug . '/' ) ); ?>" class="nav-link" data-page="<?php echo esc_attr( $slug ); ?>">
                <span data-lang="en"><?php echo esc_html( $labels['en'] ); ?></span>
                <span data-lang="fr"><?php echo esc_html( $labels['fr'] ); ?></span>
                <span data-lang="es"><?php echo esc_html( $labels['es'] ?? $labels['en'] ); ?></span>
            </a>
            <?php endforeach; ?>
            <div class="nav-mobile-socials">
                <?php if ( ! empty( $github_url ) ) : ?>
                <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener" aria-label="GitHub"><?php echo hdgavi_icon( 'github', 20 ); ?></a>
                <?php endif; ?>
                <?php if ( ! empty( $linkedin_url ) ) : ?>
                <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><?php echo hdgavi_icon( 'linkedin', 20 ); ?></a>
                <?php endif; ?>
                <?php if ( ! empty( $cv_url ) ) : ?>
                <a href="<?php echo esc_url( home_url( '?hdgavi_cv=preview' ) ); ?>" target="_blank" rel="noopener" class="nav-mobile-cv">
                    <?php echo hdgavi_icon( 'eye', 16 ); ?>
                    <span data-lang="en">Preview CV</span>
                    <span data-lang="fr">Aperçu CV</span>
                    <span data-lang="es">Vista previa CV</span>
                </a>
                <button type="button" class="nav-mobile-cv hdgavi-cv-download-trigger">
                    <?php echo hdgavi_icon( 'download', 16 ); ?>
                    <span data-lang="en">Download CV</span>
                    <span data-lang="fr">Télécharger CV</span>
                    <span data-lang="es">Descargar CV</span>
                </button>
                <?php endif; ?>
            </div>
        </div>

        <div class="nav-actions">
            <?php if ( hdgavi_opt( 'show_recruiter_btn', true ) ) : ?>
            <a href="<?php echo esc_url( home_url( '/availability/' ) ); ?>" class="recruiter-btn">
                <span class="recruiter-dot"></span>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'recruiter_btn_en', 'Hire me' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'recruiter_btn_fr', 'Recrutez-moi' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'recruiter_btn_es', 'Contrátame' ) ); ?></span>
            </a>
            <?php endif; ?>

            <?php if ( $show_rqth ) : ?>
            <span class="rqth-badge">
                <?php hdgavi_bilingual_text( 'rqth_text', 'RQTH recognized', 'RQTH reconnue' ); ?>
            </span>
            <?php endif; ?>

            <?php if ( ! empty( $github_url ) && hdgavi_opt( 'show_nav_github', true ) ) : ?>
            <a href="<?php echo esc_url( $github_url ); ?>" class="icon-btn" target="_blank" rel="noopener" aria-label="GitHub">
                <?php echo hdgavi_icon( 'github', 18 ); ?>
            </a>
            <?php endif; ?>

            <?php if ( ! empty( $linkedin_url ) && hdgavi_opt( 'show_nav_linkedin', true ) ) : ?>
            <a href="<?php echo esc_url( $linkedin_url ); ?>" class="icon-btn" target="_blank" rel="noopener" aria-label="LinkedIn">
                <?php echo hdgavi_icon( 'linkedin', 18 ); ?>
            </a>
            <?php endif; ?>

            <?php if ( ! empty( $cv_url ) && hdgavi_opt( 'show_nav_cv', true ) ) : ?>
            <a href="<?php echo esc_url( home_url( '?hdgavi_cv=preview' ) ); ?>" class="icon-btn" target="_blank" rel="noopener" aria-label="Preview CV" title="Preview CV">
                <?php echo hdgavi_icon( 'eye', 18 ); ?>
            </a>
            <button type="button" class="btn-cv hdgavi-cv-download-trigger">
                <?php echo hdgavi_icon( 'download', 14 ); ?>
                <span data-lang="en">Download CV</span>
                <span data-lang="fr">Télécharger CV</span>
                <span data-lang="es">Descargar CV</span>
            </button>
            <?php endif; ?>

            <div class="lang-dropdown" id="langDropdown">
                <button class="lang-toggle" id="langToggle" type="button" aria-label="Change language">
                    <span id="langLabel"><?php echo esc_html( strtoupper( $default_lang ) ); ?></span>
                </button>
                <div class="lang-dropdown-menu" id="langMenu">
                    <button class="lang-option" data-set-lang="en" type="button">EN</button>
                    <button class="lang-option" data-set-lang="fr" type="button">FR</button>
                    <button class="lang-option" data-set-lang="es" type="button">ES</button>
                </div>
            </div>

            <button class="theme-toggle" id="themeToggle" type="button" aria-label="Toggle theme">
                <?php echo hdgavi_icon( 'sun', 18 ); ?>
            </button>

            <button class="nav-burger" id="navBurger" type="button" aria-label="Menu" aria-expanded="false">
                <span></span><span></span><span></span>
            </button>
        </div>
    </div>
    <div class="nav-overlay" id="navOverlay"></div>
</nav>
<?php endif; ?>

<?php
$is_splash = is_page_template( 'page-templates/splash.php' ) || is_front_page();
if ( ! $is_splash && ! $is_terminal ) : ?>
<div class="page-wrapper" style="<?php echo esc_attr( $show_navbar ? 'padding-top:var(--nav-height)' : '' ); ?>">
<main class="page-content page-transition-enter" id="pageContent">
<?php endif; ?>
