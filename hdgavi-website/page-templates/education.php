<?php
/**
 * Template Name: Education / Formation
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_edu_section_en', 'Academic Background' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_edu_section_fr', 'Parcours académique' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_edu_section_es', 'Formación académica' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_edu_title_en', 'Education' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_edu_title_fr', 'Formation' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_edu_title_es', 'Educación' ) ); ?></span>
            </h1>
        </div>

        <div class="education-list">
            <?php
            $educations = hdgavi_get_cpt_posts( 'hdgavi_education' );
            if ( $educations ) update_postmeta_cache( wp_list_pluck( $educations, 'ID' ) );
            foreach ( $educations as $edu ) :
                $id     = $edu->ID;
                $period = get_post_meta( $id, '_edu_period', true );
                $school = get_post_meta( $id, '_edu_school', true );
            ?>
            <div class="education-card fade-up">
                <div class="edu-period"><?php echo esc_html( $period ); ?></div>
                <div>
                    <div class="edu-degree">
                        <span data-lang="en"><?php echo esc_html( get_post_meta( $id, '_edu_degree_en', true ) ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( get_post_meta( $id, '_edu_degree_fr', true ) ); ?></span>
                        <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_edu_degree_es', true ) ?: get_post_meta( $id, '_edu_degree_en', true ) ); ?></span>
                    </div>
                    <?php if ( ! empty( $school ) ) : ?>
                    <div class="edu-school"><?php echo esc_html( $school ); ?></div>
                    <?php endif; ?>
                    <?php
                    $notes_en = get_post_meta( $id, '_edu_notes_en', true );
                    $notes_fr = get_post_meta( $id, '_edu_notes_fr', true );
                    if ( ! empty( $notes_en ) || ! empty( $notes_fr ) ) : ?>
                    <div class="edu-notes">
                        <span data-lang="en"><?php echo esc_html( $notes_en ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( $notes_fr ); ?></span>
                        <?php $notes_es = get_post_meta( $id, '_edu_notes_es', true ) ?: $notes_en; ?>
                        <span data-lang="es"><?php echo esc_html( $notes_es ); ?></span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Self-learning (stays in Customizer) -->
        <?php
        $courses = hdgavi_opt( 'selflearn_list', '' );
        if ( ! empty( $courses ) && hdgavi_opt( 'show_edu_selflearn', true ) ) :
            // Parse courses and group by platform
            $course_list = array_filter( array_map( 'trim', explode( "\n", $courses ) ) );
            $platforms = array();
            foreach ( $course_list as $course ) {
                if ( preg_match( '/\(([^)]+)\)\s*$/', $course, $m ) ) {
                    $platform = trim( $m[1] );
                    $name     = trim( preg_replace( '/\([^)]+\)\s*$/', '', $course ) );
                } else {
                    $platform = 'Other';
                    $name     = $course;
                }
                if ( ! isset( $platforms[ $platform ] ) ) {
                    $platforms[ $platform ] = array();
                }
                $platforms[ $platform ][] = $name;
            }
            // Platform icons & gradient colors
            $platform_styles = array(
                'Cisco'          => array( 'icon' => '🌐', 'gradient' => 'linear-gradient(135deg, #049fd9, #6abfef)' ),
                'LinkedIn'       => array( 'icon' => '💼', 'gradient' => 'linear-gradient(135deg, #0077B5, #00a0dc)' ),
                'OpenClassrooms' => array( 'icon' => '📚', 'gradient' => 'linear-gradient(135deg, #7451eb, #c084fc)' ),
                'Udemy'          => array( 'icon' => '🎓', 'gradient' => 'linear-gradient(135deg, #ec5252, #f0806c)' ),
                'Coursera'       => array( 'icon' => '🔬', 'gradient' => 'linear-gradient(135deg, #0056d2, #4ca3ff)' ),
                'YouTube'        => array( 'icon' => '▶️', 'gradient' => 'linear-gradient(135deg, #ff0000, #ff6b6b)' ),
                'Other'          => array( 'icon' => '💡', 'gradient' => 'linear-gradient(135deg, #10b981, #6ee7b7)' ),
            );
        ?>
        <div class="selflearn-section fade-up">
            <div class="section-header" style="text-align:center;max-width:600px;margin:0 auto 16px">
                <div class="section-label" style="justify-content:center">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'selflearn_title_en', 'Self-learning & online courses' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'selflearn_title_fr', 'Autoformation & cours en ligne' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'selflearn_title_es', 'Autoformación y cursos en línea' ) ); ?></span>
                </div>
                <p class="section-desc" style="text-align:center;margin-top:8px">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'selflearn_desc_en', 'Platforms and courses that shaped my technical journey.' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'selflearn_desc_fr', 'Plateformes et cours qui ont forgé mon parcours technique.' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'selflearn_desc_es', 'Plataformas y cursos que forjaron mi trayectoria técnica.' ) ); ?></span>
                </p>
            </div>
            <div class="selflearn-cards">
                <?php foreach ( $platforms as $platform => $names ) :
                    $style = $platform_styles[ $platform ] ?? $platform_styles['Other'];
                ?>
                <div class="selflearn-card fade-up">
                    <div class="selflearn-blob" style="background:<?php echo esc_attr( $style['gradient'] ); ?>">
                        <span class="selflearn-blob-icon"><?php echo esc_html( $style['icon'] ); ?></span>
                    </div>
                    <h3 class="selflearn-platform"><?php echo esc_html( $platform ); ?></h3>
                    <span class="selflearn-count">
                        <?php echo esc_html( count( $names ) ); ?>
                        <span data-lang="en">course<?php echo count( $names ) > 1 ? 's' : ''; ?></span>
                        <span data-lang="fr">cours</span>
                        <span data-lang="es">curso<?php echo count( $names ) > 1 ? 's' : ''; ?></span>
                    </span>
                    <ul class="selflearn-list">
                        <?php foreach ( $names as $name ) : ?>
                        <li><?php echo esc_html( $name ); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
