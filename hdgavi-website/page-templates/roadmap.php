<?php
/**
 * Template Name: Roadmap / Objectifs
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_roadmap_section_en', 'Roadmap' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_roadmap_section_fr', 'Objectifs' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_roadmap_section_es', 'Objetivos' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_roadmap_title_en', 'Roadmap 2026' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_roadmap_title_fr', 'Objectifs 2026' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_roadmap_title_es', 'Objetivos 2026' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_roadmap_desc_en', 'Where I\'m heading — certifications, technologies and goals for this year.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_roadmap_desc_fr', 'Vers où je me dirige — certifications, technologies et objectifs pour cette année.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_roadmap_desc_es', 'Hacia dónde voy — certificaciones, tecnologías y objetivos para este año.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <?php for ( $cat = 1; $cat <= 6; $cat++ ) :
            $cat_en = hdgavi_opt( "roadmap_cat_{$cat}_en", '' );
            if ( empty( $cat_en ) ) continue;
            $cat_fr   = hdgavi_opt( "roadmap_cat_{$cat}_fr", $cat_en );
            $cat_es   = hdgavi_opt( "roadmap_cat_{$cat}_es", $cat_en );
            $cat_icon = hdgavi_opt( "roadmap_cat_{$cat}_icon", '' );
            $items    = hdgavi_opt( "roadmap_cat_{$cat}_items", '' );
            if ( empty( $items ) ) continue;
        ?>
        <div class="roadmap-category fade-up">
            <h2 class="roadmap-cat-title">
                <?php if ( $cat_icon ) : ?><span class="roadmap-cat-icon"><?php echo esc_html( $cat_icon ); ?></span><?php endif; ?>
                <span data-lang="en"><?php echo esc_html( $cat_en ); ?></span>
                <span data-lang="fr"><?php echo esc_html( $cat_fr ); ?></span>
                <span data-lang="es"><?php echo esc_html( $cat_es ); ?></span>
            </h2>
            <div class="roadmap-items">
                <?php
                // Format: "Goal text | status" per line (status: done, in-progress, planned)
                // Also supports checkbox syntax: "[x] Goal" = done, "[ ] Goal" = planned
                foreach ( array_filter( array_map( 'trim', explode( "\n", $items ) ) ) as $line ) :
                    // Support checkbox syntax from demo content
                    if ( preg_match( '/^\[([xX ])\]\s*(.+)$/', $line, $m ) ) {
                        $goal   = trim( $m[2] );
                        $status = strtolower( $m[1] ) === 'x' ? 'done' : 'planned';
                    } else {
                        $parts  = array_map( 'trim', explode( '|', $line ) );
                        $goal   = $parts[0];
                        $status = isset( $parts[1] ) ? strtolower( $parts[1] ) : 'planned';
                    }
                    $status_icon = array( 'done' => '✓', 'in-progress' => '◔', 'planned' => '○' );
                    $status_cls  = array( 'done' => 'roadmap-done', 'in-progress' => 'roadmap-progress', 'planned' => 'roadmap-planned' );
                    $icon = $status_icon[ $status ] ?? '○';
                    $cls  = $status_cls[ $status ] ?? 'roadmap-planned';
                ?>
                <div class="roadmap-item <?php echo esc_attr( $cls ); ?>">
                    <span class="roadmap-check"><?php echo esc_html( $icon ); ?></span>
                    <span class="roadmap-goal"><?php echo esc_html( $goal ); ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endfor; ?>

        <!-- Progress summary -->
        <div class="roadmap-summary fade-up">
            <?php
            $total = 0; $done = 0;
            for ( $cat = 1; $cat <= 6; $cat++ ) {
                $items = hdgavi_opt( "roadmap_cat_{$cat}_items", '' );
                if ( empty( $items ) ) continue;
                foreach ( array_filter( array_map( 'trim', explode( "\n", $items ) ) ) as $line ) {
                    $total++;
                    if ( preg_match( '/^\[([xX ])\]/', $line, $m ) ) {
                        if ( strtolower( $m[1] ) === 'x' ) $done++;
                    } else {
                        $parts = explode( '|', $line );
                        if ( isset( $parts[1] ) && strtolower( trim( $parts[1] ) ) === 'done' ) $done++;
                    }
                }
            }
            $pct = $total > 0 ? round( ( $done / $total ) * 100 ) : 0;
            ?>
            <div class="roadmap-progress-bar">
                <div class="roadmap-progress-fill" style="width:<?php echo intval( $pct ); ?>%"></div>
            </div>
            <p class="roadmap-progress-text">
                <span data-lang="en"><?php echo esc_html( $done ); ?> / <?php echo esc_html( $total ); ?> goals completed (<?php echo intval( $pct ); ?>%)</span>
                <span data-lang="fr"><?php echo esc_html( $done ); ?> / <?php echo esc_html( $total ); ?> objectifs complétés (<?php echo intval( $pct ); ?>%)</span>
                <span data-lang="es"><?php echo esc_html( $done ); ?> / <?php echo esc_html( $total ); ?> objetivos completados (<?php echo intval( $pct ); ?>%)</span>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
