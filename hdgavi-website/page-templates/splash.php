<?php
/**
 * Template Name: Splash Page
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$name        = hdgavi_opt( 'splash_title', 'Holali David GAVI' );
$github_url  = hdgavi_opt( 'contact_github', '' );
$linkedin_url = hdgavi_opt( 'contact_linkedin', '' );
$cv_url      = hdgavi_opt( 'cv_pdf_url', '' );
$terminal_on = hdgavi_opt( 'terminal_enabled', true );
$particles_on = hdgavi_opt( 'fx_particles', true );

// Find the About page URL (first page with about template)
$about_url = home_url( '/about/' );
?>

<div class="splash-page" id="splashPage">
    <?php if ( $particles_on ) : ?>
    <canvas class="splash-canvas" id="particlesCanvas"></canvas>
    <?php endif; ?>

    <div class="splash-content">
        <?php if ( $terminal_on ) : ?>
        <div class="splash-terminal" id="splashTerminal">
            <div class="term-dots"><span></span><span></span><span></span></div>
            <div id="terminalOutput"></div>
            <div class="term-line"><span class="term-cursor" id="termCursor"></span></div>
        </div>
        <?php endif; ?>

        <?php $splash_photo = hdgavi_opt( 'profile_photo', '' ); ?>
        <?php if ( ! empty( $splash_photo ) && hdgavi_opt( 'show_photo_splash', true ) ) : ?>
        <img src="<?php echo esc_url( $splash_photo ); ?>" alt="<?php echo esc_attr( $name ); ?>" class="splash-avatar" fetchpriority="high" decoding="async">
        <?php endif; ?>

        <h1 class="splash-name"><?php echo esc_html( $name ); ?></h1>
        <p class="splash-subtitle">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'splash_subtitle_en', 'Cloud & DevOps Engineer' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'splash_subtitle_fr', 'Ingénieur Cloud & DevOps' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'splash_subtitle_es', 'Ingeniero Cloud & DevOps' ) ); ?></span>
        </p>

        <div class="splash-actions">
            <a href="<?php echo esc_url( $about_url ); ?>" class="btn-primary">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'splash_btn_en', 'Explore' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'splash_btn_fr', 'Explorer' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'splash_btn_es', 'Explorar' ) ); ?></span>
                <?php echo hdgavi_icon( 'arrow-right', 16 ); ?>
            </a>
            <?php if ( ! empty( $cv_url ) && hdgavi_opt( 'show_splash_cv', true ) ) : ?>
            <a href="<?php echo esc_url( home_url( '?hdgavi_cv=preview' ) ); ?>" class="btn-ghost" target="_blank" rel="noopener">
                <?php echo hdgavi_icon( 'eye', 16 ); ?>
                <span data-lang="en">Preview CV</span>
                <span data-lang="fr">Aperçu CV</span>
                <span data-lang="es">Vista previa CV</span>
            </a>
            <button type="button" class="btn-ghost hdgavi-cv-download-trigger">
                <?php echo hdgavi_icon( 'download', 16 ); ?>
                <span data-lang="en">Download CV</span>
                <span data-lang="fr">Télécharger CV</span>
                <span data-lang="es">Descargar CV</span>
            </button>
            <?php endif; ?>
        </div>

        <?php if ( hdgavi_opt( 'show_splash_socials', true ) ) : ?>
        <div class="splash-socials">
            <?php if ( ! empty( $github_url ) ) : ?>
            <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener" aria-label="GitHub">
                <?php echo hdgavi_icon( 'github', 18 ); ?>
            </a>
            <?php endif; ?>
            <?php if ( ! empty( $linkedin_url ) ) : ?>
            <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn">
                <?php echo hdgavi_icon( 'linkedin', 18 ); ?>
            </a>
            <?php endif; ?>

            <div class="lang-dropdown" id="splashLangDropdown">
                <button class="lang-toggle" id="splashLangToggle" type="button" aria-label="Change language">
                    <span id="splashLangLabel"><?php echo esc_html( strtoupper( hdgavi_opt( 'default_lang', 'en' ) ) ); ?></span>
                </button>
                <div class="lang-dropdown-menu" id="splashLangMenu">
                    <button class="lang-option" data-set-lang="en" type="button">EN</button>
                    <button class="lang-option" data-set-lang="fr" type="button">FR</button>
                    <button class="lang-option" data-set-lang="es" type="button">ES</button>
                </div>
            </div>
            <button class="theme-toggle" id="splashThemeToggle" type="button" aria-label="Toggle theme" style="border:0.5px solid var(--border);border-radius:10px">
                <?php echo hdgavi_icon( 'sun', 18 ); ?>
            </button>
        </div>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
