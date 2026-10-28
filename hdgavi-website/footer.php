<?php
/**
 * HD GAVI Portfolio — Footer
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$is_splash   = is_page_template( 'page-templates/splash.php' ) || is_front_page();
$is_terminal = is_page_template( 'page-templates/terminal.php' );
$github_url  = hdgavi_opt( 'contact_github', '' );
$linkedin_url = hdgavi_opt( 'contact_linkedin', '' );
$email       = hdgavi_opt( 'general_email', '' );
$nav_labels  = hdgavi_nav_labels();
$copy_enabled  = hdgavi_opt( 'copy_email_enabled', true );
$show_footer   = hdgavi_opt( 'show_footer', true );

if ( ! $is_splash && ! $is_terminal ) :
?>
</main><!-- .page-content -->

<?php if ( $show_footer ) : ?>
<footer class="site-footer">
    <div class="footer-inner">
        <div class="footer-brand">
            <?php $footer_photo = hdgavi_opt( 'profile_photo', '' ); ?>
            <?php if ( ! empty( $footer_photo ) && hdgavi_opt( 'show_photo_footer', true ) ) : ?>
            <img src="<?php echo esc_url( $footer_photo ); ?>" alt="" class="footer-avatar" loading="lazy" decoding="async">
            <?php endif; ?>
            <div class="footer-name"><?php echo esc_html( hdgavi_opt( 'footer_name', 'Holali David GAVI' ) ); ?></div>
            <p>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'footer_desc_en', 'Cloud & DevOps Engineer — Containerization, Kubernetes, CI/CD automation and cloud security.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'footer_desc_fr', 'Ingénieur Cloud & DevOps — Conteneurisation, Kubernetes, automatisation CI/CD et sécurité cloud.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'footer_desc_es', 'Ingeniero Cloud & DevOps — Contenedorización, Kubernetes, automatización CI/CD y seguridad cloud.' ) ); ?></span>
            </p>
            <?php if ( ! empty( $email ) && hdgavi_opt( 'show_footer_email', true ) ) : ?>
            <p style="margin-top:12px">
                <a href="mailto:<?php echo esc_attr( $email ); ?>" style="color:var(--accent)"><?php echo esc_html( $email ); ?></a>
                <?php if ( $copy_enabled ) : ?>
                <button class="copy-email-btn" data-email="<?php echo esc_attr( $email ); ?>" type="button" aria-label="Copy email">
                    <?php echo hdgavi_icon( 'copy', 12 ); ?>
                </button>
                <?php endif; ?>
            </p>
            <?php endif; ?>
        </div>

        <div>
            <div class="footer-heading">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_links_en', 'Quick Links' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_links_fr', 'Liens rapides' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_links_es', 'Enlaces rápidos' ) ); ?></span>
            </div>
            <div class="footer-links">
                <?php foreach ( $nav_labels as $slug => $labels ) : ?>
                <a href="<?php echo esc_url( home_url( '/' . $slug . '/' ) ); ?>">
                    <span data-lang="en"><?php echo esc_html( $labels['en'] ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $labels['fr'] ); ?></span>
                    <span data-lang="es"><?php echo esc_html( isset( $labels['es'] ) ? $labels['es'] : $labels['en'] ); ?></span>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <div>
            <div class="footer-heading">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_connect_en', 'Connect' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_connect_fr', 'Réseaux' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_connect_es', 'Redes' ) ); ?></span>
            </div>
            <div class="footer-links">
                <?php if ( ! empty( $github_url ) ) : ?>
                <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener">GitHub</a>
                <?php endif; ?>
                <?php if ( ! empty( $linkedin_url ) ) : ?>
                <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener">LinkedIn</a>
                <?php endif; ?>
                <?php if ( ! empty( $email ) ) : ?>
                <a href="mailto:<?php echo esc_attr( $email ); ?>">Email</a>
                <?php endif; ?>
            </div>
        </div>

        <div>
            <div class="footer-heading">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_more_en', 'More' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_more_fr', 'Plus' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_more_es', 'Más' ) ); ?></span>
            </div>
            <div class="footer-links">
                <a href="<?php echo esc_url( home_url( '/newsletter/' ) ); ?>">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_newsletter_en', 'Newsletter' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_newsletter_fr', 'Newsletter' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_newsletter_es', 'Boletín' ) ); ?></span>
                </a>
                <a href="<?php echo esc_url( home_url( '/uses/' ) ); ?>">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_uses_en', 'Uses' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_uses_fr', 'Uses' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_uses_es', 'Herramientas' ) ); ?></span>
                </a>
                <a href="<?php echo esc_url( home_url( '/roadmap/' ) ); ?>">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_roadmap_en', 'Roadmap' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_roadmap_fr', 'Roadmap' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_roadmap_es', 'Hoja de ruta' ) ); ?></span>
                </a>
                <a href="<?php echo esc_url( home_url( '/availability/' ) ); ?>">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_avail_en', 'Availability' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_avail_fr', 'Disponibilité' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_avail_es', 'Disponibilidad' ) ); ?></span>
                </a>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <span>&copy; <?php echo esc_html( hdgavi_opt( 'footer_year', wp_date( 'Y' ) ) ); ?> <?php echo esc_html( hdgavi_opt( 'footer_name', 'Holali David GAVI' ) ); ?>. <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_rights_en', 'All rights reserved.' ) ); ?></span><span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_rights_fr', 'Tous droits réservés.' ) ); ?></span><span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_rights_es', 'Todos los derechos reservados.' ) ); ?></span></span>
        <?php if ( hdgavi_opt( 'show_footer_socials', true ) ) : ?>
        <div class="footer-socials">
            <?php if ( ! empty( $github_url ) ) : ?>
            <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener" aria-label="GitHub"><?php echo hdgavi_icon( 'github', 16 ); ?></a>
            <?php endif; ?>
            <?php if ( ! empty( $linkedin_url ) ) : ?>
            <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener" aria-label="LinkedIn"><?php echo hdgavi_icon( 'linkedin', 16 ); ?></a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
    <div style="text-align:center;padding:12px 24px 0;font-size:0.75rem">
        <a href="<?php echo esc_url( home_url( '/legal/' ) ); ?>" style="color:var(--text-tertiary);transition:color .2s">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_footer_legal_en', 'Legal Notice' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_footer_legal_fr', 'Mentions Légales' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_footer_legal_es', 'Aviso Legal' ) ); ?></span>
        </a>
    </div>
</footer>
<?php endif; /* show_footer */ ?>
</div><!-- .page-wrapper -->
<?php endif; /* ! splash && ! terminal */ ?>

<!-- Konami toast -->
<div class="konami-toast" id="konamiToast"></div>

<!-- Scroll to top -->
<button class="scroll-top" id="scrollTop" type="button" aria-label="Scroll to top">↑</button>

<!-- Film grain overlay (dark mode only) -->
<div class="grain-overlay" id="grainOverlay"></div>

<!-- Custom cursor -->
<div class="cursor-dot" id="cursorDot"></div>
<div class="cursor-ring" id="cursorRing"></div>

<?php wp_footer(); ?>
</body>
</html>
