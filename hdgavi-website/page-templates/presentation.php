<?php
/**
 * Template Name: Présentation / Slides
 * Full-screen slides built from the CV data (no site header/footer). Arrows, space, swipe; Esc to leave.
 * Styles: .pres-* in style.css.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$name         = hdgavi_opt( 'general_name', 'Holali David GAVI' );
$photo        = hdgavi_opt( 'profile_photo', '' );
$default_lang = hdgavi_opt( 'default_lang', 'en' );
$email        = hdgavi_opt( 'general_email', '' );
$phone        = hdgavi_opt( 'contact_phone', '' );
$github       = hdgavi_opt( 'contact_github', '' );
$linkedin     = hdgavi_opt( 'contact_linkedin', '' );

// Skills grouped by category (same grouping as the Skills page)
$pres_skills = hdgavi_get_cpt_posts( 'hdgavi_skill' );
if ( $pres_skills ) update_postmeta_cache( wp_list_pluck( $pres_skills, 'ID' ) );
$skill_groups = array();
foreach ( $pres_skills as $ps ) {
    $cat = hdgavi_meta_tri( $ps->ID, '_skill_category' );
    $key = '' !== $cat['en'] ? $cat['en'] : '—';
    if ( ! isset( $skill_groups[ $key ] ) ) $skill_groups[ $key ] = array( 'label' => $cat, 'names' => array() );
    $sname = get_post_meta( $ps->ID, '_skill_name', true );
    $skill_groups[ $key ]['names'][] = $sname ? $sname : get_the_title( $ps );
}

// Experience highlight: the featured one, or the first
$pres_exps = hdgavi_get_cpt_posts( 'hdgavi_experience' );
$pres_exp  = null;
foreach ( $pres_exps as $pe ) {
    if ( get_post_meta( $pe->ID, '_exp_featured', true ) ) { $pres_exp = $pe; break; }
}
if ( ! $pres_exp && ! empty( $pres_exps ) ) $pres_exp = $pres_exps[0];

$strip = function ( $url ) {
    return preg_replace( '#^https?://(www\.)?#', '', untrailingslashit( $url ) );
};
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script>
(function (h) {
    h.classList.add('js-enabled');
    try {
        var t = localStorage.getItem('hdgavi_theme_v2');
        if (t !== 'dark' && t !== 'light') {
            t = (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) ? 'dark' : 'light';
        }
        h.setAttribute('data-theme', t);
        var l = localStorage.getItem('hdgavi_lang');
        h.setAttribute('lang', (l === 'en' || l === 'fr' || l === 'es') ? l : '<?php echo esc_js( $default_lang ); ?>');
    } catch (e) {}
})(document.documentElement);
</script>
<title><?php echo esc_html( $name ); ?> — Presentation</title>
<?php wp_head(); ?>
</head>
<body <?php body_class( 'pres-page' ); ?>>
<?php wp_body_open(); ?>

<button type="button" class="pres-exit" onclick="window.history.back()"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_pres_exit', 'Exit', 'Quitter', 'Salir' ) ); ?></button>

<main class="pres-wrapper" id="presWrapper">

    <section class="pres-slide active" aria-labelledby="pres-1">
        <?php if ( $photo ) : ?>
        <figure class="pres-photo"><img src="<?php echo esc_url( $photo ); ?>" alt="" width="256" height="320" decoding="async"></figure>
        <?php endif; ?>
        <h1 id="pres-1"><?php echo hdgavi_name_html( $name ); ?></h1>
        <p class="pres-role"><?php echo hdgavi_tri_arr( hdgavi_cv( 'role' ) ); ?></p>
        <p class="pres-lead"><?php echo hdgavi_tri_arr( hdgavi_cv( 'lead' ) ); ?></p>
    </section>

    <section class="pres-slide" aria-labelledby="pres-2">
        <h2 id="pres-2"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_pres_keynums', 'In short', 'En bref', 'En resumen' ) ); ?></h2>
        <dl class="pres-facts">
            <div><dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'current' ) ); ?></dt><dd><?php echo hdgavi_tri_arr( hdgavi_cv( 'fact_role' ) ); ?></dd></div>
            <div><dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'looking_for' ) ); ?></dt><dd><?php echo hdgavi_tri_arr( hdgavi_cv( 'fact_search' ) ); ?></dd></div>
            <div><dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'training' ) ); ?></dt><dd><?php echo hdgavi_tri_arr( hdgavi_cv( 'fact_education' ) ); ?></dd></div>
            <div><dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'languages' ) ); ?></dt><dd><?php echo hdgavi_tri_arr( hdgavi_cv( 'fact_languages_short' ) ); ?></dd></div>
            <div><dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'location' ) ); ?></dt><dd><?php echo esc_html( hdgavi_cv_location() ); ?></dd></div>
        </dl>
    </section>

    <?php if ( $skill_groups ) : ?>
    <section class="pres-slide" aria-labelledby="pres-3">
        <h2 id="pres-3"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_pres_skills', 'Skills', 'Compétences', 'Competencias' ) ); ?></h2>
        <dl class="pres-facts">
            <?php foreach ( $skill_groups as $group ) : ?>
            <div><dt><?php echo hdgavi_tri_arr( $group['label'] ); ?></dt><dd><?php echo esc_html( implode( ', ', $group['names'] ) ); ?></dd></div>
            <?php endforeach; ?>
        </dl>
    </section>
    <?php endif; ?>

    <?php if ( $pres_exp ) :
        $pe_id    = $pres_exp->ID;
        $company  = hdgavi_meta_tri( $pe_id, '_exp_company' );
        $location = get_post_meta( $pe_id, '_exp_location', true );
        $desc     = hdgavi_meta_tri( $pe_id, '_exp_desc' );
    ?>
    <section class="pres-slide" aria-labelledby="pres-4">
        <h2 id="pres-4"><?php echo hdgavi_tri_arr( hdgavi_meta_tri( $pe_id, '_exp_title' ) ); ?></h2>
        <p class="pres-org"><?php echo hdgavi_tri_arr( $company ); ?><?php if ( $location ) : ?>, <?php echo esc_html( $location ); ?><?php endif; ?><br><span class="pres-period"><?php echo hdgavi_tri_arr( hdgavi_meta_tri( $pe_id, '_exp_period' ) ); ?></span></p>
        <?php if ( '' !== trim( $desc['en'] ) ) : ?>
        <p class="pres-lead"><?php echo hdgavi_tri_arr( $desc ); ?></p>
        <?php endif; ?>
        <?php echo hdgavi_meta_list_tri( $pe_id, '_exp_bullets' ); // escaped in helper ?>
    </section>
    <?php endif; ?>

    <section class="pres-slide" aria-labelledby="pres-5">
        <h2 id="pres-5"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_pres_connect', 'Contact', 'Contact', 'Contacto' ) ); ?></h2>
        <dl class="pres-facts">
            <?php if ( $email ) : ?>
            <div><dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'email' ) ); ?></dt><dd><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></dd></div>
            <?php endif; ?>
            <?php if ( $phone ) : ?>
            <div><dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'phone' ) ); ?></dt><dd><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></dd></div>
            <?php endif; ?>
            <?php if ( $linkedin ) : ?>
            <div><dt>LinkedIn</dt><dd><a href="<?php echo esc_url( $linkedin ); ?>" rel="me noopener"><?php echo esc_html( $strip( $linkedin ) ); ?></a></dd></div>
            <?php endif; ?>
            <?php if ( $github ) : ?>
            <div><dt>GitHub</dt><dd><a href="<?php echo esc_url( $github ); ?>" rel="me noopener"><?php echo esc_html( $strip( $github ) ); ?></a></dd></div>
            <?php endif; ?>
            <div><dt><?php echo hdgavi_tri( 'Website', 'Site', 'Sitio web' ); ?></dt><dd><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $strip( home_url( '/' ) ) ); ?></a></dd></div>
        </dl>
    </section>

</main>

<nav class="pres-nav" aria-label="Slides">
    <button type="button" id="presPrev"><?php echo hdgavi_tri( 'Previous', 'Précédent', 'Anterior' ); ?></button>
    <span class="pres-counter" id="presCounter" aria-live="polite">1 / 5</span>
    <button type="button" id="presNext"><?php echo hdgavi_tri( 'Next', 'Suivant', 'Siguiente' ); ?></button>
</nav>

<script>
(function(){
    var slides = document.querySelectorAll('.pres-slide');
    var idx = 0;
    var total = slides.length;
    var counter = document.getElementById('presCounter');
    var prev = document.getElementById('presPrev');
    var next = document.getElementById('presNext');
    function show(n) {
        slides.forEach(function(s,i){ s.className = 'pres-slide' + (i===n?' active':''); });
        counter.textContent = (n+1)+' / '+total;
        prev.disabled = (n === 0);
        next.disabled = (n === total-1);
    }
    next.addEventListener('click',function(){ if(idx<total-1){idx++;show(idx);} });
    prev.addEventListener('click',function(){ if(idx>0){idx--;show(idx);} });
    document.addEventListener('keydown',function(e){
        var tag=document.activeElement&&document.activeElement.tagName;
        if(e.key==='ArrowRight'){e.preventDefault();if(idx<total-1){idx++;show(idx);}}
        if(e.key===' '&&tag!=='BUTTON'&&tag!=='INPUT'&&tag!=='TEXTAREA'&&tag!=='SELECT'&&tag!=='A'){e.preventDefault();if(idx<total-1){idx++;show(idx);}}
        if(e.key==='ArrowLeft'){e.preventDefault();if(idx>0){idx--;show(idx);}}
        if(e.key==='Escape'){window.history.back();}
    });
    // Swipe support
    var startX=0;
    document.addEventListener('touchstart',function(e){startX=e.touches[0].clientX;},{passive:true});
    document.addEventListener('touchend',function(e){
        var dx=e.changedTouches[0].clientX-startX;
        if(Math.abs(dx)>50){if(dx<0&&idx<total-1){idx++;show(idx);}else if(dx>0&&idx>0){idx--;show(idx);}}
    });
    show(0);
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
