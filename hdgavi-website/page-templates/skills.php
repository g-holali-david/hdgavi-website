<?php
/**
 * Template Name: Skills / Compétences
 * Now powered by CPT hdgavi_skill (migrated from Customizer)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_skills_section_en', 'Technical Skills' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_skills_section_fr', 'Compétences techniques' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_skills_section_es', 'Habilidades técnicas' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_skills_title_en', 'Skills' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_skills_title_fr', 'Compétences' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_skills_title_es', 'Competencias' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_skills_desc_en', 'Technologies and tools I work with.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_skills_desc_fr', 'Technologies et outils avec lesquels je travaille.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_skills_desc_es', 'Tecnologías y herramientas con las que trabajo.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <?php
        // Query all skills from CPT and group by category
        $skills = hdgavi_get_cpt_posts( 'hdgavi_skill' );
        if ( $skills ) update_postmeta_cache( wp_list_pluck( $skills, 'ID' ) );

        $categories = array();
        foreach ( $skills as $skill ) {
            $cat_en = get_post_meta( $skill->ID, '_skill_category_en', true ) ?: 'Other';
            if ( ! isset( $categories[ $cat_en ] ) ) {
                $categories[ $cat_en ] = array(
                    'fr'    => get_post_meta( $skill->ID, '_skill_category_fr', true ) ?: $cat_en,
                    'es'    => get_post_meta( $skill->ID, '_skill_category_es', true ) ?: $cat_en,
                    'items' => array(),
                );
            }
            $categories[ $cat_en ]['items'][] = $skill;
        }

        if ( ! empty( $categories ) ) :
        ?>
        <div class="skills-grid">
            <?php foreach ( $categories as $cat_en => $cat_data ) : ?>
            <div class="skill-card fade-up">
                <h3 class="skill-card-title">
                    <span data-lang="en"><?php echo esc_html( $cat_en ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $cat_data['fr'] ); ?></span>
                    <span data-lang="es"><?php echo esc_html( $cat_data['es'] ); ?></span>
                </h3>
                <div class="skill-tags">
                    <?php foreach ( $cat_data['items'] as $skill ) :
                        $name = get_post_meta( $skill->ID, '_skill_name', true );
                        if ( empty( $name ) ) continue;
                    ?>
                    <span class="skill-tag"><?php echo esc_html( $name ); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if ( ! empty( $skills ) ) : ?>
        <div class="skills-cta fade-up" style="text-align:center;margin-top:40px">
            <a href="<?php echo esc_url( home_url( '/stack/' ) ); ?>" class="btn-ghost">
                <span data-lang="en">View detailed Tech Stack →</span>
                <span data-lang="fr">Voir la Stack détaillée →</span>
                <span data-lang="es">Ver Stack detallado →</span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
