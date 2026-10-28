<?php
/**
 * Template Name: Analytics Dashboard
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$stats = hdgavi_get_stats();
$gh_username = hdgavi_opt( 'contact_github_handle', '' );

// Build chart data (last 30 days)
$raw_stats  = get_option( 'hdgavi_stats', array() );
$chart_data = array();
for ( $d = 29; $d >= 0; $d-- ) {
    $date = wp_date( 'Y-m-d', strtotime( "-{$d} days" ) );
    $label = wp_date( 'M j', strtotime( "-{$d} days" ) );
    $views = isset( $raw_stats[ $date ] ) ? intval( $raw_stats[ $date ]['views'] ) : 0;
    $chart_data[] = array( 'label' => $label, 'views' => $views );
}
$max_views = max( array_column( $chart_data, 'views' ) ) ?: 1;

// CPT counts
$exp_count  = wp_count_posts( 'hdgavi_experience' )->publish ?? 0;
$proj_count = wp_count_posts( 'hdgavi_project' )->publish ?? 0;
$cert_count = wp_count_posts( 'hdgavi_certification' )->publish ?? 0;
$skill_count = wp_count_posts( 'hdgavi_skill' )->publish ?? 0;
$post_count  = wp_count_posts( 'post' )->publish ?? 0;
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en">Dashboard</span>
                <span data-lang="fr">Tableau de bord</span>
                <span data-lang="es">Panel</span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_analytics_title_en', 'Public Analytics' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_analytics_title_fr', 'Statistiques publiques' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_analytics_title_es', 'Estadísticas públicas' ) ); ?></span>
            </h1>
        </div>

        <!-- Stats cards -->
        <div class="analytics-stats fade-up">
            <div class="analytics-card">
                <span class="analytics-number"><?php echo esc_html( number_format( $stats['total_views'] ) ); ?></span>
                <span class="analytics-label">
                    <span data-lang="en">Total Views</span><span data-lang="fr">Vues totales</span><span data-lang="es">Vistas totales</span>
                </span>
            </div>
            <div class="analytics-card">
                <span class="analytics-number"><?php echo esc_html( number_format( $stats['total_uniques'] ) ); ?></span>
                <span class="analytics-label">
                    <span data-lang="en">Unique Visitors</span><span data-lang="fr">Visiteurs uniques</span><span data-lang="es">Visitantes únicos</span>
                </span>
            </div>
            <div class="analytics-card">
                <span class="analytics-number"><?php echo esc_html( number_format( $stats['today_views'] ) ); ?></span>
                <span class="analytics-label">
                    <span data-lang="en">Today</span><span data-lang="fr">Aujourd'hui</span><span data-lang="es">Hoy</span>
                </span>
            </div>
            <div class="analytics-card">
                <span class="analytics-number"><?php echo esc_html( number_format( $stats['week_views'] ) ); ?></span>
                <span class="analytics-label">
                    <span data-lang="en">This Week</span><span data-lang="fr">Cette semaine</span><span data-lang="es">Esta semana</span>
                </span>
            </div>
        </div>

        <!-- 30-day chart -->
        <div class="analytics-chart-section fade-up">
            <h2 class="analytics-subtitle">
                <span data-lang="en">Last 30 Days</span><span data-lang="fr">30 derniers jours</span><span data-lang="es">Últimos 30 días</span>
            </h2>
            <div class="analytics-chart">
                <?php foreach ( $chart_data as $day ) :
                    $pct = round( ( $day['views'] / $max_views ) * 100 );
                ?>
                <div class="analytics-bar-wrap" title="<?php echo esc_attr( $day['label'] . ': ' . $day['views'] ); ?>">
                    <div class="analytics-bar" style="height:<?php echo esc_attr( max( 2, $pct ) ); ?>%"></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Portfolio badges -->
        <div class="analytics-badges fade-up">
            <h2 class="analytics-subtitle">
                <span data-lang="en">Portfolio Overview</span><span data-lang="fr">Aperçu du portfolio</span><span data-lang="es">Resumen del portafolio</span>
            </h2>
            <div class="analytics-badge-grid">
                <span class="analytics-badge">🚀 <?php echo esc_html( $proj_count ); ?> <span data-lang="en">Projects</span><span data-lang="fr">Projets</span><span data-lang="es">Proyectos</span></span>
                <span class="analytics-badge">💼 <?php echo esc_html( $exp_count ); ?> <span data-lang="en">Experiences</span><span data-lang="fr">Expériences</span><span data-lang="es">Experiencias</span></span>
                <span class="analytics-badge">📜 <?php echo esc_html( $cert_count ); ?> <span data-lang="en">Certifications</span><span data-lang="fr">Certifications</span><span data-lang="es">Certificaciones</span></span>
                <span class="analytics-badge">🛠 <?php echo esc_html( $skill_count ); ?> <span data-lang="en">Technologies</span><span data-lang="fr">Technologies</span><span data-lang="es">Tecnologías</span></span>
                <span class="analytics-badge">📝 <?php echo esc_html( $post_count ); ?> <span data-lang="en">Articles</span><span data-lang="fr">Articles</span><span data-lang="es">Artículos</span></span>
                <span class="analytics-badge">📅 <?php echo esc_html( $stats['days_tracked'] ); ?> <span data-lang="en">Days tracked</span><span data-lang="fr">Jours suivis</span><span data-lang="es">Días registrados</span></span>
            </div>
        </div>

        <?php if ( $gh_username ) : ?>
        <!-- GitHub stats -->
        <div class="analytics-github fade-up" id="analyticsGitHub">
            <h2 class="analytics-subtitle">
                <?php echo hdgavi_icon( 'github', 18 ); ?>
                GitHub — <?php echo esc_html( $gh_username ); ?>
            </h2>
            <div class="analytics-gh-cards" id="analyticsGhCards">
                <p style="color:var(--text-tertiary);font-size:0.85rem">
                    <span data-lang="en">Loading GitHub stats...</span>
                    <span data-lang="fr">Chargement des stats GitHub...</span>
                    <span data-lang="es">Cargando estadísticas de GitHub...</span>
                </p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
