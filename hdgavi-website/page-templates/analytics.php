<?php
/**
 * Template Name: Analytics Dashboard
 * Public, anonymous visit counts (inc/stats.php) and site content counts, as plain numbers.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$stats       = hdgavi_get_stats();
$gh_username = hdgavi_opt( 'contact_github_handle', '' );

// Last 30 days (only the days with visits are listed)
$raw_stats = get_option( 'hdgavi_stats', array() );
$days      = array();
for ( $d = 0; $d <= 29; $d++ ) {
    $date  = wp_date( 'Y-m-d', strtotime( "-{$d} days" ) );
    $views = isset( $raw_stats[ $date ]['views'] ) ? intval( $raw_stats[ $date ]['views'] ) : 0;
    if ( $views > 0 ) $days[ $date ] = $views;
}

// Content counts
$counts = array(
    array( hdgavi_cv_label( 'projects' ), wp_count_posts( 'hdgavi_project' )->publish ?? 0 ),
    array( hdgavi_cv_label( 'experience' ), wp_count_posts( 'hdgavi_experience' )->publish ?? 0 ),
    array( array( 'en' => 'Certifications', 'fr' => 'Certifications', 'es' => 'Certificaciones' ), wp_count_posts( 'hdgavi_certification' )->publish ?? 0 ),
    array( array( 'en' => 'Technologies', 'fr' => 'Technologies', 'es' => 'Tecnologías' ), wp_count_posts( 'hdgavi_skill' )->publish ?? 0 ),
    array( array( 'en' => 'Articles', 'fr' => 'Articles', 'es' => 'Artículos' ), wp_count_posts( 'post' )->publish ?? 0 ),
    array( array( 'en' => 'Days tracked', 'fr' => 'Jours suivis', 'es' => 'Días registrados' ), $stats['days_tracked'] ?? 0 ),
);
$visits = array(
    array( array( 'en' => 'Total views', 'fr' => 'Vues totales', 'es' => 'Vistas totales' ), $stats['total_views'] ?? 0 ),
    array( array( 'en' => 'Unique visitors', 'fr' => 'Visiteurs uniques', 'es' => 'Visitantes únicos' ), $stats['total_uniques'] ?? 0 ),
    array( array( 'en' => 'Today', 'fr' => 'Aujourd’hui', 'es' => 'Hoy' ), $stats['today_views'] ?? 0 ),
    array( array( 'en' => 'Last 7 days', 'fr' => '7 derniers jours', 'es' => 'Últimos 7 días' ), $stats['week_views'] ?? 0 ),
);
?>
<section class="sec wrap sec--first" aria-labelledby="t-analytics">
    <h1 class="sec-title" id="t-analytics"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_analytics_title', 'Public statistics', 'Statistiques publiques', 'Estadísticas públicas' ) ); ?></h1>
    <div class="sec-body">
        <p class="sec-lead"><?php echo hdgavi_tri( 'Anonymous page views counted by this site, without cookies.', 'Pages vues anonymes comptées par ce site, sans cookie.', 'Páginas vistas anónimas contadas por este sitio, sin cookies.' ); ?></p>
        <dl class="coords">
            <?php foreach ( $visits as $row ) : ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( $row[0] ); ?></dt>
                <dd class="analytics-num"><?php echo esc_html( number_format_i18n( (int) $row[1] ) ); ?></dd>
            </div>
            <?php endforeach; ?>
        </dl>
    </div>
</section>

<section class="sec wrap" aria-labelledby="t-analytics-30">
    <h2 class="sec-title" id="t-analytics-30"><?php echo hdgavi_tri( 'Last 30 days', '30 derniers jours', 'Últimos 30 días' ); ?></h2>
    <div class="sec-body">
        <?php if ( $days ) : ?>
        <table class="analytics-table sec-main">
            <thead>
                <tr><th scope="col"><?php echo hdgavi_tri( 'Day', 'Jour', 'Día' ); ?></th><th scope="col"><?php echo hdgavi_tri( 'Views', 'Vues', 'Vistas' ); ?></th></tr>
            </thead>
            <tbody>
                <?php foreach ( $days as $date => $views ) : ?>
                <tr><td><?php echo esc_html( $date ); ?></td><td><?php echo esc_html( number_format_i18n( $views ) ); ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri( 'No visit recorded in the last 30 days.', 'Aucune visite enregistrée ces 30 derniers jours.', 'Ninguna visita registrada en los últimos 30 días.' ); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="sec wrap" aria-labelledby="t-analytics-content">
    <h2 class="sec-title" id="t-analytics-content"><?php echo hdgavi_tri( 'Site content', 'Contenu du site', 'Contenido del sitio' ); ?></h2>
    <div class="sec-body">
        <dl class="coords">
            <?php foreach ( $counts as $row ) : ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( $row[0] ); ?></dt>
                <dd class="analytics-num"><?php echo esc_html( number_format_i18n( (int) $row[1] ) ); ?></dd>
            </div>
            <?php endforeach; ?>
        </dl>
    </div>
</section>

<?php if ( $gh_username ) : ?>
<section class="sec wrap analytics-github" id="analyticsGitHub" aria-labelledby="t-analytics-gh">
    <h2 class="sec-title" id="t-analytics-gh">GitHub</h2>
    <div class="sec-body">
        <p class="sec-lead"><a href="<?php echo esc_url( 'https://github.com/' . rawurlencode( $gh_username ) ); ?>" rel="me noopener"><?php echo esc_html( 'github.com/' . $gh_username ); ?></a></p>
        <div class="analytics-gh-cards sec-main" id="analyticsGhCards">
            <p class="note"><?php echo hdgavi_tri( 'Loading the GitHub figures…', 'Chargement des chiffres GitHub…', 'Cargando las cifras de GitHub…' ); ?></p>
        </div>
    </div>
</section>
<script>
/* theme.js (initAnalyticsGitHub) writes English labels, one with a glyph: rewrite them as EN/FR/ES spans. */
(function () {
    var box = document.getElementById('analyticsGhCards');
    if (!box || !window.MutationObserver) return;
    var labels = <?php echo wp_json_encode( array(
        'Public Repos' => array( 'Public repositories', 'Dépôts publics', 'Repositorios públicos' ),
        'Followers'    => array( 'Followers', 'Abonnés', 'Seguidores' ),
        'Following'    => array( 'Following', 'Abonnements', 'Siguiendo' ),
        'Total Stars'  => array( 'Stars', 'Étoiles', 'Estrellas' ),
        'error'        => array( 'The GitHub figures could not be loaded.', 'Les chiffres GitHub n’ont pas pu être chargés.', 'No se pudieron cargar las cifras de GitHub.' ),
    ) ); ?>;
    function spans(el, t) {
        el.textContent = '';
        ['en', 'fr', 'es'].forEach(function (lang, i) {
            var s = document.createElement('span');
            s.setAttribute('data-lang', lang);
            s.textContent = t[i];
            el.appendChild(s);
        });
    }
    function fix() {
        Array.prototype.forEach.call(box.querySelectorAll('.analytics-label:not([data-fixed])'), function (el) {
            var key = el.textContent.replace(/[^\x20-\x7E]/g, '').trim();
            el.setAttribute('data-fixed', '');
            if (labels[key]) spans(el, labels[key]); else el.textContent = key;
        });
        Array.prototype.forEach.call(box.querySelectorAll('p:not(.note)'), function (p) {
            p.removeAttribute('style');
            p.className = 'note';
            spans(p, labels.error);
        });
    }
    new MutationObserver(fix).observe(box, { childList: true });
})();
</script>
<?php endif; ?>
<?php get_footer(); ?>
