<?php
/**
 * Template Name: Présentation / Slides
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// No header/footer — fullscreen presentation mode
$name      = hdgavi_opt( 'general_name', 'Holali David GAVI' );
$badge_en  = hdgavi_opt( 'about_badge_en', 'Cloud & DevOps Engineer' );
$badge_fr  = hdgavi_opt( 'about_badge_fr', 'Ingénieur Cloud & DevOps' );
$photo     = hdgavi_opt( 'profile_photo', '' );
$default_lang = hdgavi_opt( 'default_lang', 'en' );
?>
<!DOCTYPE html>
<html lang="<?php echo esc_attr( $default_lang ); ?>" data-theme="dark">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo esc_html( $name ); ?> — Presentation</title>
<script>document.documentElement.classList.add('js-enabled');</script>
<?php wp_head(); ?>
<style>
    .pres-wrapper{width:100%;height:100vh;overflow:hidden;background:var(--bg);position:relative}
    .pres-slide{position:absolute;inset:0;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:48px;opacity:0;transform:translateX(40px);transition:opacity .5s ease,transform .5s ease;pointer-events:none;text-align:center}
    .pres-slide.active{opacity:1;transform:translateX(0);pointer-events:auto}
    .pres-slide.prev{transform:translateX(-40px)}
    .pres-slide h2{font-family:var(--font-heading);font-size:clamp(1.8rem,4vw,3rem);font-weight:700;color:var(--text-primary);margin-bottom:16px;letter-spacing:-0.02em}
    .pres-slide p{font-size:1.1rem;color:var(--text-secondary);max-width:640px;line-height:1.7}
    .pres-slide .pres-badge{font-size:1rem;color:var(--accent);margin-bottom:8px;font-weight:500}
    .pres-slide .pres-photo{width:120px;height:120px;border-radius:50%;object-fit:cover;border:2px solid var(--accent);margin-bottom:24px}
    .pres-slide .pres-stats{display:flex;gap:32px;margin-top:32px}
    .pres-slide .pres-stat{text-align:center}
    .pres-slide .pres-stat-num{font-family:var(--font-heading);font-size:2.4rem;font-weight:700;color:var(--accent)}
    .pres-slide .pres-stat-label{font-size:0.85rem;color:var(--text-tertiary)}
    .pres-slide .pres-list{text-align:left;max-width:500px;margin:24px auto 0}
    .pres-slide .pres-list li{padding:8px 0;font-size:1rem;color:var(--text-secondary);border-bottom:0.5px solid var(--border)}
    .pres-slide .pres-list li:last-child{border-bottom:none}
    .pres-nav{position:fixed;bottom:32px;left:50%;transform:translateX(-50%);display:flex;align-items:center;gap:16px;z-index:10}
    .pres-nav button{width:40px;height:40px;border-radius:50%;background:var(--surface);border:0.5px solid var(--border);color:var(--text-secondary);font-size:1.2rem;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:all .2s}
    .pres-nav button:hover{color:var(--accent);border-color:var(--accent)}
    .pres-counter{font-family:var(--font-mono);font-size:0.8rem;color:var(--text-tertiary)}
    .pres-exit{position:fixed;top:24px;right:24px;z-index:10;padding:8px 16px;border-radius:8px;background:var(--surface);border:0.5px solid var(--border);color:var(--text-secondary);font-size:0.8rem;cursor:pointer;transition:all .2s;font-family:var(--font-body)}
    .pres-exit:hover{color:var(--accent);border-color:var(--accent)}
    .pres-tags{display:flex;flex-wrap:wrap;gap:8px;justify-content:center;margin-top:20px}
    .pres-tags .skill-tag{font-size:0.85rem;padding:6px 14px}
    @media(max-width:640px){
        .pres-slide{padding:24px}
        .pres-slide .pres-stats{flex-wrap:wrap;gap:16px}
    }
</style>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<button class="pres-exit" onclick="window.history.back()">
    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_pres_exit_en', '✕ Exit' ) ); ?></span>
    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_pres_exit_fr', '✕ Quitter' ) ); ?></span>
    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_pres_exit_es', '✕ Salir' ) ); ?></span>
</button>

<div class="pres-wrapper" id="presWrapper">

    <!-- Slide 1: Intro -->
    <div class="pres-slide active">
        <?php if ( $photo ) : ?>
        <img src="<?php echo esc_url( $photo ); ?>" alt="" class="pres-photo" loading="lazy" decoding="async">
        <?php endif; ?>
        <h2><?php echo esc_html( $name ); ?></h2>
        <div class="pres-badge">
            <span data-lang="en"><?php echo esc_html( $badge_en ); ?></span>
            <span data-lang="fr"><?php echo esc_html( $badge_fr ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'about_badge_es', 'Ingeniero Cloud & DevOps' ) ); ?></span>
        </div>
        <p>
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'splash_subtitle_en', '' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'splash_subtitle_fr', '' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'splash_subtitle_es', '' ) ); ?></span>
        </p>
    </div>

    <!-- Slide 2: Stats -->
    <div class="pres-slide">
        <h2>
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_pres_keynums_en', 'Key Numbers' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_pres_keynums_fr', 'Chiffres Clés' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_pres_keynums_es', 'Cifras Clave' ) ); ?></span>
        </h2>
        <div class="pres-stats">
            <?php for ( $i = 1; $i <= 4; $i++ ) :
                $num = hdgavi_opt( "stat_{$i}_number", '' );
                if ( empty( $num ) ) continue;
            ?>
            <div class="pres-stat">
                <div class="pres-stat-num"><?php echo esc_html( $num ); ?></div>
                <div class="pres-stat-label">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( "stat_{$i}_label_en", '' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( "stat_{$i}_label_fr", '' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( "stat_{$i}_label_es", '' ) ); ?></span>
                </div>
            </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Slide 3: Skills -->
    <div class="pres-slide">
        <h2>
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_pres_skills_en', 'Skills' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_pres_skills_fr', 'Compétences' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_pres_skills_es', 'Competencias' ) ); ?></span>
        </h2>
        <div class="pres-tags">
            <?php
            $pres_skills = hdgavi_get_cpt_posts( 'hdgavi_skill' );
            foreach ( array_slice( $pres_skills, 0, 12 ) as $ps ) :
                $sname = get_post_meta( $ps->ID, '_skill_name', true );
                if ( $sname ) : ?>
            <span class="skill-tag"><?php echo esc_html( $sname ); ?></span>
            <?php endif; endforeach; ?>
        </div>
    </div>

    <!-- Slide 4: Experience highlight (first featured or first experience) -->
    <?php
    $pres_exps = hdgavi_get_cpt_posts( 'hdgavi_experience' );
    $pres_exp  = null;
    foreach ( $pres_exps as $pe ) {
        if ( get_post_meta( $pe->ID, '_exp_featured', true ) ) { $pres_exp = $pe; break; }
    }
    if ( ! $pres_exp && ! empty( $pres_exps ) ) $pres_exp = $pres_exps[0];
    if ( $pres_exp ) :
        $pe_id = $pres_exp->ID;
    ?>
    <div class="pres-slide">
        <h2>
            <span data-lang="en"><?php echo esc_html( get_post_meta( $pe_id, '_exp_title_en', true ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( get_post_meta( $pe_id, '_exp_title_fr', true ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( get_post_meta( $pe_id, '_exp_title_es', true ) ); ?></span>
        </h2>
        <div class="pres-badge">
            <span data-lang="en"><?php echo esc_html( get_post_meta( $pe_id, '_exp_company_en', true ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( get_post_meta( $pe_id, '_exp_company_fr', true ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( get_post_meta( $pe_id, '_exp_company_es', true ) ); ?></span>
        </div>
        <p>
            <span data-lang="en"><?php echo esc_html( get_post_meta( $pe_id, '_exp_desc_en', true ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( get_post_meta( $pe_id, '_exp_desc_fr', true ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( get_post_meta( $pe_id, '_exp_desc_es', true ) ); ?></span>
        </p>
    </div>
    <?php endif; ?>

    <!-- Slide 5: Contact -->
    <div class="pres-slide">
        <h2>
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_pres_connect_en', 'Let\'s Connect' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_pres_connect_fr', 'Restons en Contact' ) ); ?></span>
            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_pres_connect_es', 'Conectemos' ) ); ?></span>
        </h2>
        <p><?php echo esc_html( hdgavi_opt( 'general_email', '' ) ); ?></p>
        <div class="pres-tags" style="margin-top:24px">
            <?php if ( hdgavi_opt( 'contact_github', '' ) ) : ?>
            <a href="<?php echo esc_url( hdgavi_opt( 'contact_github', '' ) ); ?>" class="skill-tag" target="_blank" rel="noopener" style="color:var(--accent)">GitHub</a>
            <?php endif; ?>
            <?php if ( hdgavi_opt( 'contact_linkedin', '' ) ) : ?>
            <a href="<?php echo esc_url( hdgavi_opt( 'contact_linkedin', '' ) ); ?>" class="skill-tag" target="_blank" rel="noopener" style="color:var(--accent)">LinkedIn</a>
            <?php endif; ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="skill-tag" style="color:var(--accent)">Portfolio</a>
        </div>
    </div>

</div>

<div class="pres-nav">
    <button id="presPrev" aria-label="<?php echo esc_attr( hdgavi_opt( 'default_lang', 'en' ) === 'fr' ? 'Précédent' : 'Previous' ); ?>">←</button>
    <span class="pres-counter" id="presCounter">1 / 5</span>
    <button id="presNext" aria-label="<?php echo esc_attr( hdgavi_opt( 'default_lang', 'en' ) === 'fr' ? 'Suivant' : 'Next' ); ?>">→</button>
</div>

<script>
(function(){
    var slides = document.querySelectorAll('.pres-slide');
    var idx = 0;
    var total = slides.length;
    var counter = document.getElementById('presCounter');
    function show(n) {
        slides.forEach(function(s,i){ s.className = 'pres-slide' + (i===n?' active':i<n?' prev':''); });
        counter.textContent = (n+1)+' / '+total;
    }
    document.getElementById('presNext').addEventListener('click',function(){ if(idx<total-1){idx++;show(idx);} });
    document.getElementById('presPrev').addEventListener('click',function(){ if(idx>0){idx--;show(idx);} });
    document.addEventListener('keydown',function(e){
        var tag=document.activeElement&&document.activeElement.tagName;
        if(e.key==='ArrowRight'){e.preventDefault();if(idx<total-1){idx++;show(idx);}}
        if(e.key===' '&&tag!=='BUTTON'&&tag!=='INPUT'&&tag!=='TEXTAREA'&&tag!=='SELECT'){e.preventDefault();if(idx<total-1){idx++;show(idx);}}
        if(e.key==='ArrowLeft'){e.preventDefault();if(idx>0){idx--;show(idx);}}
        if(e.key==='Escape'){window.history.back();}
    });
    // Swipe support
    var startX=0;
    document.addEventListener('touchstart',function(e){startX=e.touches[0].clientX;});
    document.addEventListener('touchend',function(e){
        var dx=e.changedTouches[0].clientX-startX;
        if(Math.abs(dx)>50){if(dx<0&&idx<total-1){idx++;show(idx);}else if(dx>0&&idx>0){idx--;show(idx);}}
    });
})();
</script>

<?php wp_footer(); ?>
</body>
</html>
