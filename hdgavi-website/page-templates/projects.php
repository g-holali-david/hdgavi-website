<?php
/**
 * Template Name: Projects / Projets
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$gh_repos_on = hdgavi_opt( 'gh_repos_enabled', true );
$gh_username = hdgavi_opt( 'contact_github_handle', '' );

$tag_labels = array(
    'pro'      => array( 'en' => 'Professional', 'fr' => 'Professionnel', 'es' => 'Profesional' ),
    'academic' => array( 'en' => 'Academic', 'fr' => 'Académique', 'es' => 'Académico' ),
    'personal' => array( 'en' => 'Personal', 'fr' => 'Personnel', 'es' => 'Personal' ),
);
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_proj_section_en', 'My Work' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_proj_section_fr', 'Mes réalisations' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_proj_section_es', 'Mis trabajos' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_proj_title_en', 'Projects' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_proj_title_fr', 'Projets' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_proj_title_es', 'Proyectos' ) ); ?></span>
            </h1>
        </div>

        <div class="projects-grid">
            <?php
            $projects = hdgavi_get_cpt_posts( 'hdgavi_project' );
            if ( $projects ) update_postmeta_cache( wp_list_pluck( $projects, 'ID' ) );
            foreach ( $projects as $proj ) :
                $id       = $proj->ID;
                $tag      = get_post_meta( $id, '_proj_tag', true );
                $title_en = get_post_meta( $id, '_proj_title_en', true );
                $title_fr = get_post_meta( $id, '_proj_title_fr', true ) ?: $title_en;
                $techs        = get_post_meta( $id, '_proj_techs', true );
                $link         = get_post_meta( $id, '_proj_link', true );
                $gallery      = get_post_meta( $id, '_proj_gallery', true );
                $is_case      = get_post_meta( $id, '_proj_is_case_study', true );
                $gallery_urls = $gallery ? array_filter( array_map( 'trim', explode( "\n", $gallery ) ) ) : array();
            ?>
            <div class="project-card fade-up">
                <?php if ( ! empty( $tag ) && isset( $tag_labels[ $tag ] ) ) : ?>
                <span class="project-tag <?php echo esc_attr( $tag ); ?>">
                    <span data-lang="en"><?php echo esc_html( $tag_labels[ $tag ]['en'] ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $tag_labels[ $tag ]['fr'] ); ?></span>
                    <span data-lang="es"><?php echo esc_html( $tag_labels[ $tag ]['es'] ?? $tag_labels[ $tag ]['en'] ); ?></span>
                </span>
                <?php endif; ?>

                <?php if ( ! empty( $gallery_urls ) ) : ?>
                <div class="proj-gallery-wrap">
                    <!-- Main carousel -->
                    <div class="proj-carousel" data-carousel>
                        <div class="proj-carousel-track">
                            <?php foreach ( $gallery_urls as $img_url ) : ?>
                            <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title_en ); ?>" loading="lazy" decoding="async" data-lightbox>
                            <?php endforeach; ?>
                        </div>
                        <?php if ( count( $gallery_urls ) > 1 ) : ?>
                        <button class="proj-carousel-btn prev" type="button" aria-label="Previous">‹</button>
                        <button class="proj-carousel-btn next" type="button" aria-label="Next">›</button>
                        <div class="proj-carousel-dots">
                            <?php for ( $d = 0; $d < count( $gallery_urls ); $d++ ) : ?>
                            <span<?php echo $d === 0 ? ' class="active"' : ''; ?>></span>
                            <?php endfor; ?>
                        </div>
                        <?php endif; ?>
                        <!-- Image counter overlay -->
                        <div class="proj-carousel-counter">
                            <?php echo hdgavi_icon( 'image', 12 ); ?>
                            <?php echo count( $gallery_urls ); ?>
                            <span data-lang="en">screenshot<?php echo count( $gallery_urls ) > 1 ? 's' : ''; ?></span>
                            <span data-lang="fr">capture<?php echo count( $gallery_urls ) > 1 ? 's' : ''; ?></span>
                            <span data-lang="es">captura<?php echo count( $gallery_urls ) > 1 ? 's' : ''; ?></span>
                        </div>
                    </div>
                    <!-- Thumbnail strip -->
                    <?php if ( count( $gallery_urls ) > 1 ) : ?>
                    <div class="proj-thumbs">
                        <?php foreach ( $gallery_urls as $ti => $thumb_url ) : ?>
                        <img src="<?php echo esc_url( $thumb_url ); ?>" alt="" class="proj-thumb<?php echo $ti === 0 ? ' active' : ''; ?>" loading="lazy" decoding="async" data-thumb-idx="<?php echo intval( $ti ); ?>">
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <h3 class="project-title">
                    <span data-lang="en"><?php echo esc_html( $title_en ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $title_fr ); ?></span>
                    <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_proj_title_es', true ) ?: $title_en ); ?></span>
                </h3>

                <p class="project-desc">
                    <span data-lang="en"><?php echo esc_html( get_post_meta( $id, '_proj_desc_en', true ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( get_post_meta( $id, '_proj_desc_fr', true ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_proj_desc_es', true ) ); ?></span>
                </p>

                <?php if ( ! empty( $techs ) ) : ?>
                <div class="project-techs">
                    <?php foreach ( array_map( 'trim', explode( ',', $techs ) ) as $tech ) : ?>
                    <span class="skill-tag"><?php echo esc_html( $tech ); ?></span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php
                // Case study section (problem → solution → result)
                if ( $is_case ) :
                    $problem_en = get_post_meta( $id, '_proj_problem_en', true );
                    $solution_en = get_post_meta( $id, '_proj_solution_en', true );
                    $result_en = get_post_meta( $id, '_proj_result_en', true );
                    $metrics = get_post_meta( $id, '_proj_metrics', true );
                    if ( $problem_en || $solution_en || $result_en ) :
                ?>
                <div class="proj-case-study">
                    <?php if ( $problem_en ) : ?>
                    <div class="proj-case-block">
                        <strong>
                            <span data-lang="en">Problem</span>
                            <span data-lang="fr">Problème</span>
                            <span data-lang="es">Problema</span>
                        </strong>
                        <p>
                            <span data-lang="en"><?php echo esc_html( $problem_en ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( get_post_meta( $id, '_proj_problem_fr', true ) ); ?></span>
                            <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_proj_problem_es', true ) ); ?></span>
                        </p>
                    </div>
                    <?php endif; ?>
                    <?php if ( $solution_en ) : ?>
                    <div class="proj-case-block">
                        <strong>
                            <span data-lang="en">Solution</span>
                            <span data-lang="fr">Solution</span>
                            <span data-lang="es">Solución</span>
                        </strong>
                        <p>
                            <span data-lang="en"><?php echo esc_html( $solution_en ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( get_post_meta( $id, '_proj_solution_fr', true ) ); ?></span>
                            <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_proj_solution_es', true ) ); ?></span>
                        </p>
                    </div>
                    <?php endif; ?>
                    <?php if ( $result_en ) : ?>
                    <div class="proj-case-block">
                        <strong>
                            <span data-lang="en">Result</span>
                            <span data-lang="fr">Résultat</span>
                            <span data-lang="es">Resultado</span>
                        </strong>
                        <p>
                            <span data-lang="en"><?php echo esc_html( $result_en ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( get_post_meta( $id, '_proj_result_fr', true ) ); ?></span>
                            <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_proj_result_es', true ) ); ?></span>
                        </p>
                    </div>
                    <?php endif; ?>
                    <?php if ( $metrics ) : ?>
                    <div class="proj-case-metrics">
                        <?php foreach ( array_filter( array_map( 'trim', explode( ',', $metrics ) ) ) as $metric ) :
                            $parts = array_map( 'trim', explode( ':', $metric ) );
                            if ( count( $parts ) === 2 ) : ?>
                        <span class="proj-metric"><strong><?php echo esc_html( $parts[0] ); ?></strong> <?php echo esc_html( $parts[1] ); ?></span>
                        <?php endif; endforeach; ?>
                    </div>
                    <?php endif; ?>
                </div>
                <span class="proj-case-badge">📊
                    <span data-lang="en">Case Study</span>
                    <span data-lang="fr">Étude de cas</span>
                    <span data-lang="es">Caso de estudio</span>
                </span>
                <?php endif; endif; ?>

                <div style="display:flex;gap:8px;align-items:center;flex-wrap:wrap;margin-top:8px">
                    <?php if ( ! empty( $link ) && hdgavi_opt( 'show_proj_view_link', true ) ) : ?>
                    <a href="<?php echo esc_url( $link ); ?>" class="project-link" target="_blank" rel="noopener">
                        <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_proj_view_en', 'View project' ) ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_proj_view_fr', 'Voir le projet' ) ); ?></span>
                        <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_proj_view_es', 'Ver proyecto' ) ); ?></span>
                        <?php echo hdgavi_icon( 'external', 14 ); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if ( $gh_repos_on && ! empty( $gh_username ) ) : ?>
        <div class="github-repos fade-up" id="githubRepos">
            <div class="section-header" style="margin-top:48px">
                <div class="section-label">
                    <?php echo hdgavi_icon( 'github', 14 ); ?>
                    <span><?php echo esc_html( hdgavi_opt( 'contact_github_handle', 'GitHub' ) ); ?></span>
                </div>
                <h2 class="section-title" style="font-size:1.5rem">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_proj_gh_title_en', 'Public Repositories' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_proj_gh_title_fr', 'Dépôts publics' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_proj_gh_title_es', 'Repositorios públicos' ) ); ?></span>
                </h2>
            </div>
            <div class="repo-grid" id="repoGrid"></div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
