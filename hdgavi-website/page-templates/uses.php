<?php
/**
 * Template Name: Uses / Mon Setup
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_uses_section_en', 'Uses' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_uses_section_fr', 'Mon Setup' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_uses_section_es', 'Mi Configuración' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_uses_title_en', 'What I use' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_uses_title_fr', 'Ce que j\'utilise' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_uses_title_es', 'Lo que uso' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_uses_desc_en', 'Hardware, software and tools I use daily for development and DevOps.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_uses_desc_fr', 'Matériel, logiciels et outils que j\'utilise au quotidien pour le développement et le DevOps.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_uses_desc_es', 'Hardware, software y herramientas que uso a diario para desarrollo y DevOps.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <?php for ( $cat = 1; $cat <= 8; $cat++ ) :
            $cat_en = hdgavi_opt( "uses_cat_{$cat}_en", '' );
            if ( empty( $cat_en ) ) continue;
            $cat_fr    = hdgavi_opt( "uses_cat_{$cat}_fr", $cat_en );
            $cat_es    = hdgavi_opt( "uses_cat_{$cat}_es", $cat_en );
            $cat_icon  = hdgavi_opt( "uses_cat_{$cat}_icon", '' );
            $items     = hdgavi_opt( "uses_cat_{$cat}_items", '' );
            if ( empty( $items ) ) continue;
        ?>
        <div class="uses-category fade-up">
            <h2 class="uses-cat-title">
                <?php if ( $cat_icon ) : ?><span class="uses-cat-icon"><?php echo esc_html( $cat_icon ); ?></span><?php endif; ?>
                <span data-lang="en"><?php echo esc_html( $cat_en ); ?></span>
                <span data-lang="fr"><?php echo esc_html( $cat_fr ); ?></span>
                <span data-lang="es"><?php echo esc_html( $cat_es ); ?></span>
            </h2>
            <div class="uses-grid">
                <?php
                // Format: "Tool Name | Description" per line
                foreach ( array_filter( array_map( 'trim', explode( "\n", $items ) ) ) as $line ) :
                    $parts = array_map( 'trim', explode( '|', $line ) );
                    $tool_name = $parts[0];
                    $tool_desc = isset( $parts[1] ) ? $parts[1] : '';
                    $tool_url  = isset( $parts[2] ) ? $parts[2] : '';
                ?>
                <div class="uses-item">
                    <div class="uses-item-name">
                        <?php if ( $tool_url ) : ?>
                        <a href="<?php echo esc_url( $tool_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $tool_name ); ?></a>
                        <?php else : ?>
                        <?php echo esc_html( $tool_name ); ?>
                        <?php endif; ?>
                    </div>
                    <?php if ( $tool_desc ) : ?>
                    <div class="uses-item-desc"><?php echo esc_html( $tool_desc ); ?></div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endfor; ?>
    </div>
</section>

<?php get_footer(); ?>
