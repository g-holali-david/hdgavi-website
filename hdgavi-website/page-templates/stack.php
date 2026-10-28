<?php
/**
 * Template Name: Stack Technique / Tech Stack
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$level_pct = array( 'expert' => 95, 'advanced' => 75, 'intermediate' => 55, 'learning' => 30 );
$usage_labels = array(
    'daily'      => array( 'en' => 'Daily use', 'fr' => 'Quotidien', 'es' => 'Uso diario' ),
    'regular'    => array( 'en' => 'Regular', 'fr' => 'Régulier', 'es' => 'Regular' ),
    'occasional' => array( 'en' => 'Occasional', 'fr' => 'Occasionnel', 'es' => 'Ocasional' ),
    'learning'   => array( 'en' => 'Learning', 'fr' => 'En apprentissage', 'es' => 'Aprendiendo' ),
);
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_stack_section_en', 'Tech Stack' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_stack_section_fr', 'Stack Technique' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_stack_section_es', 'Stack Técnico' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_stack_title_en', 'My Tech Stack' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_stack_title_fr', 'Ma Stack Technique' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_stack_title_es', 'Mi Stack Técnico' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_stack_desc_en', 'Technologies I use daily, with proficiency levels.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_stack_desc_fr', 'Technologies que j\'utilise au quotidien, avec niveaux de maîtrise.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_stack_desc_es', 'Tecnologías que uso a diario, con niveles de competencia.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <!-- Level legend -->
        <div class="stack-legend fade-up">
            <span class="stack-legend-item"><span class="stack-dot stack-dot-expert"></span>
                <span data-lang="en">Expert</span><span data-lang="fr">Expert</span><span data-lang="es">Experto</span>
            </span>
            <span class="stack-legend-item"><span class="stack-dot stack-dot-advanced"></span>
                <span data-lang="en">Advanced</span><span data-lang="fr">Avancé</span><span data-lang="es">Avanzado</span>
            </span>
            <span class="stack-legend-item"><span class="stack-dot stack-dot-intermediate"></span>
                <span data-lang="en">Intermediate</span><span data-lang="fr">Intermédiaire</span><span data-lang="es">Intermedio</span>
            </span>
            <span class="stack-legend-item"><span class="stack-dot stack-dot-learning"></span>
                <span data-lang="en">Learning</span><span data-lang="fr">En apprentissage</span><span data-lang="es">Aprendiendo</span>
            </span>
        </div>

        <?php
        // Query all skills and group by category
        $skills = hdgavi_get_cpt_posts( 'hdgavi_skill' );
        if ( $skills ) update_postmeta_cache( wp_list_pluck( $skills, 'ID' ) );

        $categories = array();
        foreach ( $skills as $skill ) {
            $cat_en = get_post_meta( $skill->ID, '_skill_category_en', true ) ?: 'Other';
            if ( ! isset( $categories[ $cat_en ] ) ) {
                $categories[ $cat_en ] = array(
                    'fr' => get_post_meta( $skill->ID, '_skill_category_fr', true ) ?: $cat_en,
                    'es' => get_post_meta( $skill->ID, '_skill_category_es', true ) ?: $cat_en,
                    'items' => array(),
                );
            }
            $categories[ $cat_en ]['items'][] = $skill;
        }

        foreach ( $categories as $cat_en => $cat_data ) :
        ?>
        <div class="stack-category fade-up">
            <h2 class="stack-cat-title">
                <span data-lang="en"><?php echo esc_html( $cat_en ); ?></span>
                <span data-lang="fr"><?php echo esc_html( $cat_data['fr'] ); ?></span>
                <span data-lang="es"><?php echo esc_html( $cat_data['es'] ); ?></span>
            </h2>
            <div class="stack-grid">
                <?php foreach ( $cat_data['items'] as $skill ) :
                    $id        = $skill->ID;
                    $name      = get_post_meta( $id, '_skill_name', true );
                    $level     = get_post_meta( $id, '_skill_level', true ) ?: 'intermediate';
                    $usage     = get_post_meta( $id, '_skill_usage', true ) ?: '';
                    $years     = get_post_meta( $id, '_skill_years', true );
                    $icon      = get_post_meta( $id, '_skill_icon', true );
                    $pct       = $level_pct[ $level ] ?? 55;
                    $usage_lbl = $usage_labels[ $usage ] ?? null;
                ?>
                <div class="stack-item">
                    <div class="stack-item-header">
                        <span class="stack-item-name">
                            <?php if ( $icon ) : ?>
                            <img src="<?php echo esc_url( $icon ); ?>" alt="" class="stack-item-icon" loading="lazy" decoding="async">
                            <?php endif; ?>
                            <?php echo esc_html( $name ); ?>
                        </span>
                        <span class="stack-item-meta">
                            <?php if ( $years ) : ?>
                            <span class="stack-years"><?php echo esc_html( $years ); ?>y</span>
                            <?php endif; ?>
                            <span class="stack-dot stack-dot-<?php echo esc_attr( $level ); ?>"></span>
                        </span>
                    </div>
                    <div class="stack-bar">
                        <div class="stack-bar-fill stack-bar-<?php echo esc_attr( $level ); ?>" style="width:0%" data-level="<?php echo esc_attr( $pct ); ?>"></div>
                    </div>
                    <?php if ( $usage_lbl ) : ?>
                    <span class="stack-usage stack-usage-<?php echo esc_attr( $usage ); ?>">
                        <span data-lang="en"><?php echo esc_html( $usage_lbl['en'] ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( $usage_lbl['fr'] ); ?></span>
                        <span data-lang="es"><?php echo esc_html( $usage_lbl['es'] ); ?></span>
                    </span>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php get_footer(); ?>
