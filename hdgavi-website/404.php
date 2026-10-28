<?php
/**
 * 404 page
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section" style="min-height:60vh;display:flex;align-items:center">
    <div class="container" style="text-align:center">
        <h1 class="section-title" style="font-size:4rem;margin-bottom:16px;color:var(--accent)">404</h1>
        <p class="section-desc" style="max-width:400px;margin:0 auto 32px">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_404_text_en', 'Page not found. The page you\'re looking for doesn\'t exist.' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_404_text_fr', 'Page introuvable. La page que vous cherchez n\'existe pas.' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_404_text_es', 'Página no encontrada. La página que busca no existe.' ) ); ?></span>
        </p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_404_btn_en', 'Back to Home' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_404_btn_fr', 'Retour à l\'accueil' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_404_btn_es', 'Volver al inicio' ) ); ?></span>
        </a>
    </div>
</section>

<?php get_footer(); ?>
