<?php
/**
 * HD GAVI Portfolio — Maintenance Mode Page
 * Displayed to non-logged-in visitors when maintenance_mode is ON.
 * Logged-in admins see the normal site.
 * All content is customizable via Customizer → 🚧 Maintenance Page.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// ── Identity (with fallbacks to general settings) ──
$name       = esc_html( hdgavi_opt( 'general_name', 'Holali David GAVI' ) );
$email      = hdgavi_opt( 'general_email', '' );
$github     = esc_url( hdgavi_opt( 'contact_github', '' ) );
$linkedin   = esc_url( hdgavi_opt( 'contact_linkedin', '' ) );
$cv_url     = hdgavi_opt( 'cv_pdf_url', '' ) ? esc_url( home_url( '?hdgavi_cv=download' ) ) : '';
$phone      = esc_html( hdgavi_opt( 'contact_phone', '' ) );
$location   = esc_html( hdgavi_opt( 'general_location', '' ) );
$monogram   = esc_html( hdgavi_opt( 'logo_monogram', 'HD' ) );
$photo      = esc_url( hdgavi_opt( 'profile_photo', '' ) );
$lang       = hdgavi_opt( 'default_lang', 'en' );
$year       = esc_html( hdgavi_opt( 'footer_year', wp_date( 'Y' ) ) );

// ── Role & company (maintenance-specific or fallback) ──
$role_en  = esc_html( hdgavi_opt( 'maintenance_role_en', '' ) ?: hdgavi_opt( 'seo_job_title', 'DevOps Engineer' ) );
$role_fr  = esc_html( hdgavi_opt( 'maintenance_role_fr', '' ) ?: hdgavi_opt( 'seo_job_title', 'Ingénieur DevOps' ) );
$role_es  = esc_html( hdgavi_opt( 'maintenance_role_es', '' ) ?: $role_en );
$company  = esc_html( hdgavi_opt( 'maintenance_company', '' ) ?: hdgavi_opt( 'seo_company', 'Dassault Systèmes' ) );

// ── Banner texts (trilingue) ──
$icon      = esc_html( hdgavi_opt( 'maintenance_icon', '🚧' ) );
$title_en  = hdgavi_opt( 'maintenance_title_en', 'Site under maintenance' );
$title_fr  = hdgavi_opt( 'maintenance_title_fr', 'Site sous maintenance' );
$title_es  = hdgavi_opt( 'maintenance_title_es', 'Sitio en mantenimiento' );
$desc_en   = hdgavi_opt( 'maintenance_desc_en', 'Come back soon!' );
$desc_fr   = hdgavi_opt( 'maintenance_desc_fr', 'Revenez bientôt !' );
$desc_es   = hdgavi_opt( 'maintenance_desc_es', '¡Vuelve pronto!' );

// ── Show/hide toggles ──
$show_banner    = hdgavi_opt( 'maint_show_banner', true );
$show_photo     = hdgavi_opt( 'maint_show_photo', true );
$show_role      = hdgavi_opt( 'maint_show_role', true );
$show_info      = hdgavi_opt( 'maint_show_info', true );
$show_skills    = hdgavi_opt( 'maint_show_skills', true );
$show_github    = hdgavi_opt( 'maint_show_github', true );
$show_linkedin  = hdgavi_opt( 'maint_show_linkedin', true );
$show_email_link = hdgavi_opt( 'maint_show_email', true );
$show_cv        = hdgavi_opt( 'maint_show_cv', true );
$show_form      = hdgavi_opt( 'maint_show_form', true );
$show_particles = hdgavi_opt( 'maint_show_particles', true );
$show_lang      = hdgavi_opt( 'maint_show_lang', true );

// ── Skills from CPT ──
$skills_tags = '';
if ( $show_skills ) {
    $maint_skills = hdgavi_get_cpt_posts( 'hdgavi_skill' );
    foreach ( array_slice( $maint_skills, 0, 8 ) as $ms ) {
        $sn = get_post_meta( $ms->ID, '_skill_name', true );
        if ( $sn ) $skills_tags .= '<span class="m-tag">' . esc_html( $sn ) . '</span>';
    }
}

// Pick role for current lang
$roles = array( 'en' => $role_en, 'fr' => $role_fr, 'es' => $role_es );
$role_display = $roles[ $lang ] ?? $role_en;

status_header( 503 );
header( 'Retry-After: 86400' );
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="dark">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="theme-color" content="#0B0F1A">
<meta name="robots" content="noindex, nofollow">
<title><?php echo $name; ?> — <?php $titles = array( 'en' => $title_en, 'fr' => $title_fr, 'es' => $title_es ); echo esc_html( $titles[ $lang ] ?? $title_en ); ?></title>
<meta name="description" content="<?php $descs = array( 'en' => $desc_en, 'fr' => $desc_fr, 'es' => $desc_es ); echo esc_attr( $descs[ $lang ] ?? $desc_en ); ?>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Outfit:wght@500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<style>
*,*::before,*::after{margin:0;padding:0;box-sizing:border-box}
:root{--bg:#0B0F1A;--surface:#111827;--border:rgba(255,255,255,0.06);--text:#F1F5F9;--text-2:#94A3B8;--text-3:#64748B;--accent:#06B6D4;--accent-hover:#0891B2;--accent-bg:rgba(6,182,212,0.08);--accent2:#2d8ec9}
html{font-size:16px}
body{font-family:'DM Sans',sans-serif;background:var(--bg);color:var(--text);min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;overflow-x:hidden;-webkit-font-smoothing:antialiased}
#mc{position:fixed;inset:0;z-index:0;pointer-events:none}
.grain{position:fixed;inset:0;z-index:1;pointer-events:none;opacity:0.03;background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E")}
.page{position:relative;z-index:2;padding:40px 24px;width:100%;max-width:560px}
.m-banner{text-align:center;margin-bottom:32px;opacity:0;transform:translateY(16px);animation:up .6s ease forwards}
.m-banner-icon{font-size:2.4rem;margin-bottom:12px}
.m-banner h1{font-family:'Outfit',sans-serif;font-size:clamp(1.4rem,3vw,1.7rem);font-weight:800;letter-spacing:-0.02em;margin-bottom:8px}
.m-banner p{font-size:0.95rem;color:var(--text-2);line-height:1.6}
.m-term{background:var(--surface);border:0.5px solid var(--border);border-radius:16px;padding:20px 24px;margin-bottom:24px;font-family:'JetBrains Mono',monospace;font-size:0.78rem;line-height:1.8;color:var(--text-2);opacity:0;transform:translateY(16px);animation:up .6s ease .1s forwards;overflow:hidden}
.m-term-dots{display:flex;gap:6px;margin-bottom:14px}
.m-term-dots span{width:10px;height:10px;border-radius:50%}
.m-term-dots span:nth-child(1){background:#EF4444}
.m-term-dots span:nth-child(2){background:#F59E0B}
.m-term-dots span:nth-child(3){background:#22C55E}
.m-term .t-cmd{color:var(--accent)}
.m-term .t-out{color:var(--text-2)}
.m-card{background:var(--surface);border:0.5px solid var(--border);border-radius:24px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.4);opacity:0;transform:translateY(24px);animation:up .7s ease .15s forwards}
@keyframes up{to{opacity:1;transform:translateY(0)}}
.m-header{background:linear-gradient(135deg,#0B0F1A,#111827);padding:28px 32px 24px;border-bottom:3px solid;border-image:linear-gradient(90deg,var(--accent),var(--accent2)) 1;display:flex;align-items:center;gap:20px}
.m-avatar{width:64px;height:64px;border-radius:16px;overflow:hidden;flex-shrink:0;border:2px solid rgba(6,182,212,0.2)}
.m-avatar img{width:100%;height:100%;object-fit:cover}
.m-avatar-fallback{width:100%;height:100%;background:rgba(6,182,212,0.12);display:flex;align-items:center;justify-content:center;font-family:'Outfit',sans-serif;font-weight:700;font-size:18px;color:var(--accent);letter-spacing:0.5px}
.m-identity h2{font-family:'Outfit',sans-serif;font-size:1.25rem;font-weight:800;letter-spacing:-0.01em}
.m-identity .m-role{font-size:0.8rem;color:var(--accent);font-weight:500;margin-top:2px}
.m-identity .m-company{font-size:0.75rem;color:var(--text-3);margin-top:2px}
.m-body{padding:28px 32px}
.m-label{font-family:'Outfit',sans-serif;font-size:0.7rem;font-weight:700;text-transform:uppercase;letter-spacing:0.12em;color:var(--text-3);margin-bottom:12px;display:flex;align-items:center;gap:8px}
.m-label::before{content:'';width:14px;height:1px;background:var(--accent)}
.m-info{display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:24px}
.m-info-item{padding:12px 14px;background:rgba(255,255,255,0.02);border:0.5px solid var(--border);border-radius:10px;transition:all .25s}
.m-info-item:hover{border-color:rgba(6,182,212,0.2);background:var(--accent-bg)}
.m-info-k{font-size:0.6rem;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;color:var(--text-3);margin-bottom:3px}
.m-info-v{font-weight:600;font-size:0.8rem}
.m-info-item.full{grid-column:1/-1}
.m-tags{display:flex;flex-wrap:wrap;gap:6px;margin-bottom:24px}
.m-tag{padding:4px 10px;border-radius:20px;font-size:0.7rem;font-weight:500;background:var(--accent-bg);color:var(--accent);border:0.5px solid rgba(6,182,212,0.15)}
.m-socials{display:flex;gap:8px;margin-bottom:20px}
.m-soc{flex:1;display:flex;align-items:center;justify-content:center;gap:6px;padding:11px;border-radius:12px;border:0.5px solid var(--border);color:var(--text-2);font-size:0.78rem;font-weight:600;text-decoration:none;transition:all .25s;min-height:44px}
.m-soc:hover{color:var(--accent);border-color:rgba(6,182,212,0.3);background:var(--accent-bg);transform:translateY(-2px)}
.m-soc svg{width:15px;height:15px;flex-shrink:0}
.m-cv{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:13px;border-radius:50px;background:var(--accent);color:#0B0F1A;font-weight:700;font-size:0.85rem;text-decoration:none;transition:all .25s;border:none;cursor:pointer;box-shadow:0 4px 20px rgba(6,182,212,0.25);margin-bottom:24px}
.m-cv:hover{background:var(--accent-hover);transform:translateY(-2px);box-shadow:0 8px 30px rgba(6,182,212,0.35)}
.m-cv svg{width:16px;height:16px}
.m-form-group{margin-bottom:10px}
.m-form-group label{display:block;font-size:0.68rem;font-weight:600;color:var(--text-3);margin-bottom:5px;text-transform:uppercase;letter-spacing:0.04em}
.m-form-group input,.m-form-group textarea{width:100%;padding:11px 14px;background:rgba(255,255,255,0.03);border:0.5px solid var(--border);border-radius:10px;color:var(--text);font-family:'DM Sans',sans-serif;font-size:0.85rem;outline:none;transition:all .25s}
.m-form-group input:focus,.m-form-group textarea:focus{border-color:var(--accent);background:var(--accent-bg)}
.m-form-group textarea{resize:vertical;min-height:72px}
.m-send{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:11px;border-radius:50px;background:transparent;border:1px solid var(--border);color:var(--text-2);font-weight:600;font-size:0.82rem;font-family:'DM Sans',sans-serif;cursor:pointer;transition:all .25s}
.m-send:hover{color:var(--accent);border-color:var(--accent);background:var(--accent-bg)}
.m-send svg{width:14px;height:14px}
.m-fb{margin-top:8px;padding:9px 14px;border-radius:10px;font-size:0.78rem;font-weight:500;display:none;text-align:center}
.m-fb.ok{display:block;background:rgba(34,197,94,0.1);color:#22C55E;border:0.5px solid rgba(34,197,94,0.2)}
.m-fb.err{display:block;background:rgba(239,68,68,0.1);color:#EF4444;border:0.5px solid rgba(239,68,68,0.2)}
.m-footer{padding:16px 32px;border-top:0.5px solid var(--border);text-align:center;font-size:0.65rem;color:var(--text-3);font-family:'JetBrains Mono',monospace}
@media(max-width:520px){
  .m-header{flex-direction:column;text-align:center;padding:24px 20px}
  .m-body{padding:24px 20px}
  .m-footer{padding:14px 20px}
  .m-info{grid-template-columns:1fr}
  .m-socials{flex-direction:column}
  .m-banner h1{font-size:1.25rem}
}
@media(prefers-reduced-motion:reduce){*,*::before,*::after{animation-duration:0.01ms!important;transition-duration:0.01ms!important}#mc{display:none}}
@media print{.grain,#mc{display:none!important}body{background:#fff;color:#000}.m-card{box-shadow:none;border:1px solid #ddd}.m-header{background:#f9f9f9}}
</style>
</head>
<body>

<?php if ( $show_particles ) : ?>
<canvas id="mc"></canvas>
<?php endif; ?>
<div class="grain"></div>

<div class="page">

  <?php if ( $show_banner ) : ?>
  <!-- BANNER -->
  <div class="m-banner">
    <div class="m-banner-icon"><?php echo $icon; ?></div>
    <h1>
      <span data-lang="en"><?php echo esc_html( $title_en ); ?></span>
      <span data-lang="fr" style="display:none"><?php echo esc_html( $title_fr ); ?></span>
      <span data-lang="es" style="display:none"><?php echo esc_html( $title_es ); ?></span>
    </h1>
    <p>
      <span data-lang="en"><?php echo esc_html( $desc_en ); ?></span>
      <span data-lang="fr" style="display:none"><?php echo esc_html( $desc_fr ); ?></span>
      <span data-lang="es" style="display:none"><?php echo esc_html( $desc_es ); ?></span>
    </p>
  </div>
  <?php endif; ?>

  <!-- MINI TERMINAL -->
  <div class="m-term">
    <div class="m-term-dots"><span></span><span></span><span></span></div>
    <div id="mTermOutput"></div>
  </div>

  <!-- CARD -->
  <div class="m-card">

    <div class="m-header">
      <?php if ( $show_photo ) : ?>
      <div class="m-avatar">
        <?php if ( $photo ) : ?>
          <img src="<?php echo $photo; ?>" alt="<?php echo $name; ?>">
        <?php else : ?>
          <div class="m-avatar-fallback"><?php echo $monogram; ?></div>
        <?php endif; ?>
      </div>
      <?php endif; ?>
      <div class="m-identity">
        <h2><?php echo $name; ?></h2>
        <?php if ( $show_role ) : ?>
        <div class="m-role">
          <span data-lang="en"><?php echo esc_html( $role_en ); ?></span>
          <span data-lang="fr" style="display:none"><?php echo esc_html( $role_fr ); ?></span>
          <span data-lang="es" style="display:none"><?php echo esc_html( $role_es ); ?></span>
        </div>
        <div class="m-company">@ <?php echo $company; ?></div>
        <?php endif; ?>
      </div>
    </div>

    <div class="m-body">

      <?php if ( $show_info ) : ?>
      <!-- Info -->
      <div class="m-label">
        <span data-lang="en">About</span>
        <span data-lang="fr" style="display:none">Infos</span>
        <span data-lang="es" style="display:none">Información</span>
      </div>
      <div class="m-info">
        <div class="m-info-item">
          <div class="m-info-k">
            <span data-lang="en">Role</span>
            <span data-lang="fr" style="display:none">Poste</span>
            <span data-lang="es" style="display:none">Puesto</span>
          </div>
          <div class="m-info-v">
            <span data-lang="en"><?php echo esc_html( $role_en ); ?></span>
            <span data-lang="fr" style="display:none"><?php echo esc_html( $role_fr ); ?></span>
            <span data-lang="es" style="display:none"><?php echo esc_html( $role_es ); ?></span>
          </div>
        </div>
        <div class="m-info-item">
          <div class="m-info-k">
            <span data-lang="en">Company</span>
            <span data-lang="fr" style="display:none">Entreprise</span>
            <span data-lang="es" style="display:none">Empresa</span>
          </div>
          <div class="m-info-v"><?php echo $company; ?></div>
        </div>
        <?php if ( $location ) : ?>
        <div class="m-info-item">
          <div class="m-info-k">
            <span data-lang="en">Location</span>
            <span data-lang="fr" style="display:none">Localisation</span>
            <span data-lang="es" style="display:none">Ubicación</span>
          </div>
          <div class="m-info-v"><?php echo $location; ?></div>
        </div>
        <?php endif; ?>
        <?php if ( $phone ) : ?>
        <div class="m-info-item">
          <div class="m-info-k">
            <span data-lang="en">Phone</span>
            <span data-lang="fr" style="display:none">Téléphone</span>
            <span data-lang="es" style="display:none">Teléfono</span>
          </div>
          <div class="m-info-v"><a href="tel:<?php echo esc_attr( str_replace( ' ', '', $phone ) ); ?>" style="color:var(--text);text-decoration:none"><?php echo $phone; ?></a></div>
        </div>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php if ( $show_skills && $skills_tags ) : ?>
      <!-- Skills tags -->
      <div class="m-label">Stack</div>
      <div class="m-tags"><?php echo $skills_tags; ?></div>
      <?php endif; ?>

      <?php if ( ( $show_github && $github ) || ( $show_linkedin && $linkedin ) || ( $show_email_link && $email ) ) : ?>
      <!-- Socials -->
      <div class="m-label">
        <span data-lang="en">Links</span>
        <span data-lang="fr" style="display:none">Liens</span>
        <span data-lang="es" style="display:none">Enlaces</span>
      </div>
      <div class="m-socials">
        <?php if ( $show_github && $github ) : ?>
        <a href="<?php echo $github; ?>" target="_blank" rel="noopener" class="m-soc">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 22v-4a4.8 4.8 0 0 0-1-3.5c3 0 6-2 6-5.5.08-1.25-.27-2.48-1-3.5.28-1.15.28-2.35 0-3.5 0 0-1 0-3 1.5-2.64-.5-5.36-.5-8 0C6 2 5 2 5 2c-.3 1.15-.3 2.35 0 3.5A5.4 5.4 0 0 0 4 9c0 3.5 3 5.5 6 5.5-.39.49-.68 1.05-.85 1.65S8.93 17.38 9 18v4"/><path d="M9 18c-4.51 2-5-2-7-2"/></svg>
          GitHub
        </a>
        <?php endif; ?>
        <?php if ( $show_linkedin && $linkedin ) : ?>
        <a href="<?php echo $linkedin; ?>" target="_blank" rel="noopener" class="m-soc">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/></svg>
          LinkedIn
        </a>
        <?php endif; ?>
        <?php if ( $show_email_link && $email ) : ?>
        <a href="mailto:<?php echo esc_attr( $email ); ?>" class="m-soc">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
          Email
        </a>
        <?php endif; ?>
      </div>
      <?php endif; ?>

      <?php if ( $show_cv && $cv_url ) : ?>
      <!-- CV -->
      <a href="<?php echo $cv_url; ?>" target="_blank" rel="noopener" class="m-cv">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" x2="12" y1="15" y2="3"/></svg>
        <span data-lang="en">Download my CV</span>
        <span data-lang="fr" style="display:none">Télécharger mon CV</span>
        <span data-lang="es" style="display:none">Descargar mi CV</span>
      </a>
      <?php endif; ?>

      <?php if ( $show_form ) : ?>
      <!-- Contact form -->
      <div class="m-label">
        <span data-lang="en">Write to me</span>
        <span data-lang="fr" style="display:none">M'écrire</span>
        <span data-lang="es" style="display:none">Escríbeme</span>
      </div>
      <form id="mForm">
        <div style="display:none" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
        <div class="m-form-group">
          <label for="mf-name">
            <span data-lang="en">Name</span>
            <span data-lang="fr" style="display:none">Nom</span>
            <span data-lang="es" style="display:none">Nombre</span>
          </label>
          <input type="text" id="mf-name" required>
        </div>
        <div class="m-form-group">
          <label for="mf-email">Email</label>
          <input type="email" id="mf-email" required>
        </div>
        <div class="m-form-group">
          <label for="mf-msg">Message</label>
          <textarea id="mf-msg" required></textarea>
        </div>
        <button type="submit" class="m-send">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg>
          <span data-lang="en">Send</span>
          <span data-lang="fr" style="display:none">Envoyer</span>
          <span data-lang="es" style="display:none">Enviar</span>
        </button>
        <div class="m-fb" id="mFb"></div>
      </form>
      <?php endif; ?>

    </div>

    <div class="m-footer">&copy; <?php echo $year . ' ' . $name; ?></div>
  </div>

  <?php if ( $show_lang ) : ?>
  <!-- Language toggle -->
  <div style="text-align:center;margin-top:20px;opacity:0;animation:up .6s ease .3s forwards">
    <button id="mLang" style="background:var(--accent-bg);border:0.5px solid rgba(6,182,212,0.2);color:var(--accent);padding:6px 16px;border-radius:50px;font-size:0.75rem;font-weight:700;cursor:pointer;font-family:'DM Sans',sans-serif;transition:all .25s" onmouseover="this.style.background='rgba(6,182,212,0.15)'" onmouseout="this.style.background='var(--accent-bg)'"><?php echo strtoupper( $lang ); ?></button>
  </div>
  <?php endif; ?>

</div>

<script>
(function(){
'use strict';

<?php if ( $show_particles ) : ?>
/* Particles */
var c=document.getElementById('mc'),x=c.getContext('2d'),pts=[],aid;
function rez(){c.width=innerWidth;c.height=innerHeight;pts=[];var n=Math.floor(c.width*c.height/20000);for(var i=0;i<n;i++)pts.push({x:Math.random()*c.width,y:Math.random()*c.height,vx:(Math.random()-.5)*.35,vy:(Math.random()-.5)*.35,r:Math.random()*1.2+.4})}
function draw(){x.clearRect(0,0,c.width,c.height);for(var i=0;i<pts.length;i++){var p=pts[i];p.x+=p.vx;p.y+=p.vy;if(p.x<0)p.x=c.width;if(p.x>c.width)p.x=0;if(p.y<0)p.y=c.height;if(p.y>c.height)p.y=0;x.beginPath();x.arc(p.x,p.y,p.r,0,Math.PI*2);x.fillStyle='rgba(6,182,212,0.2)';x.fill();for(var j=i+1;j<pts.length;j++){var dx=p.x-pts[j].x,dy=p.y-pts[j].y,d=Math.sqrt(dx*dx+dy*dy);if(d<100){x.beginPath();x.moveTo(p.x,p.y);x.lineTo(pts[j].x,pts[j].y);x.strokeStyle='rgba(6,182,212,'+(0.06*(1-d/100)).toFixed(3)+')';x.stroke()}}}aid=requestAnimationFrame(draw)}
if(!window.matchMedia||!window.matchMedia('(prefers-reduced-motion:reduce)').matches){rez();addEventListener('resize',rez);draw()}
<?php endif; ?>

/* Mini terminal animation */
(function(){
  var out=document.getElementById('mTermOutput');
  if(!out)return;
  var lines=<?php echo wp_json_encode( hdgavi_get_terminal_lines()[ $lang ] ?? array() ); ?>;
  var speed=40;
  function type(text,el){return new Promise(function(r){var i=0;(function t(){if(i<text.length){el.textContent+=text[i];i++;setTimeout(t,speed+Math.random()*15)}else r()})()})}
  function run(idx){
    if(idx>=lines.length)return;
    var cmd=document.createElement('div');cmd.className='t-cmd';out.appendChild(cmd);
    type(lines[idx].cmd,cmd).then(function(){
      if(lines[idx].out){var o=document.createElement('div');o.className='t-out';o.textContent=lines[idx].out;out.appendChild(o)}
      setTimeout(function(){run(idx+1)},400);
    });
  }
  run(0);
})();

<?php if ( $show_lang ) : ?>
/* Language toggle — cycle EN → FR → ES → EN */
var langs=['en','fr','es'],langIdx=langs.indexOf('<?php echo esc_js( $lang ); ?>');
if(langIdx===-1)langIdx=0;
function setLang(l){document.querySelectorAll('[data-lang]').forEach(function(el){el.style.display=el.dataset.lang===l?'':'none'});document.getElementById('mLang').textContent=l.toUpperCase()}
document.getElementById('mLang').addEventListener('click',function(){langIdx=(langIdx+1)%langs.length;setLang(langs[langIdx])});
<?php endif; ?>

<?php if ( $show_form ) : ?>
/* Contact form → AJAX wp_mail */
document.getElementById('mForm').addEventListener('submit',function(e){
  e.preventDefault();
  var n=document.getElementById('mf-name').value.trim(),em=document.getElementById('mf-email').value.trim(),m=document.getElementById('mf-msg').value.trim(),fb=document.getElementById('mFb'),btn=this.querySelector('.m-send');
  var cl=(typeof langs!=='undefined'&&typeof langIdx!=='undefined')?langs[langIdx]:'en';
  if(!n||!em||!m){fb.className='m-fb err';fb.textContent=cl==='fr'?'Veuillez remplir tous les champs.':(cl==='es'?'Por favor complete todos los campos.':'Please fill all fields.');return}
  if(!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em)){fb.className='m-fb err';fb.textContent=cl==='fr'?'Email invalide.':(cl==='es'?'Email inválido.':'Invalid email.');return}
  btn.disabled=true;btn.textContent=cl==='fr'?'Envoi...':(cl==='es'?'Enviando...':'Sending...');
  var fd=new FormData();fd.append('action','hdgavi_maint_contact');fd.append('name',n);fd.append('email',em);fd.append('message',m);
  var ac=new AbortController(),tid=setTimeout(function(){ac.abort()},15000);
  fetch('<?php echo esc_url( admin_url( "admin-ajax.php" ) ); ?>',{method:'POST',body:fd,signal:ac.signal})
    .then(function(r){return r.json()})
    .then(function(d){
      if(d.success){fb.className='m-fb ok';fb.textContent=cl==='fr'?'Message envoyé !':(cl==='es'?'¡Mensaje enviado!':'Message sent!');e.target.reset()}
      else{fb.className='m-fb err';fb.textContent=cl==='fr'?'Erreur. Réessayez.':(cl==='es'?'Error. Inténtelo de nuevo.':'Error. Try again.')}
    })
    .catch(function(err){fb.className='m-fb err';fb.textContent=err.name==='AbortError'?(cl==='fr'?'Délai dépassé.':'Timeout.'):('Error.')})
    .finally(function(){clearTimeout(tid);btn.disabled=false;btn.innerHTML='<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m22 2-7 20-4-9-9-4Z"/><path d="M22 2 11 13"/></svg> '+(cl==='fr'?'Envoyer':(cl==='es'?'Enviar':'Send'))});
});
<?php endif; ?>

})();
</script>
</body>
</html>
