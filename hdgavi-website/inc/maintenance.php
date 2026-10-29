<?php
/**
 * HD GAVI Portfolio — maintenance page.
 *
 * Shown to visitors who are not logged in while the "maintenance_mode" theme_mod is on
 * (hdgavi_maintenance_redirect() in functions.php includes this file, then exits).
 * Standalone document: no wp_head(), nothing loaded from another origin, no animation.
 * Texts and visible elements: Customizer > Maintenance page (maintenance_*, maint_show_*).
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$langs = array( 'en', 'fr', 'es' );
$lang  = (string) hdgavi_opt( 'default_lang', 'en' );
if ( ! in_array( $lang, $langs, true ) ) {
    $lang = 'en';
}

/* ── Identity and contact details (same theme_mods as the rest of the site) ── */
$name     = (string) hdgavi_opt( 'general_name', 'Holali David GAVI' );
$email    = (string) hdgavi_opt( 'general_email', '' );
$linkedin = (string) hdgavi_opt( 'contact_linkedin', '' );
$github   = (string) hdgavi_opt( 'contact_github', '' );
$cv_pdf   = (string) hdgavi_opt( 'cv_pdf_url', '' );
$year     = (string) hdgavi_opt( 'footer_year', wp_date( 'Y' ) );
$company  = trim( (string) hdgavi_opt( 'maintenance_company', '' ) );

/* ── Visible elements ── */
$show_banner   = (bool) hdgavi_opt( 'maint_show_banner', true );
$show_role     = (bool) hdgavi_opt( 'maint_show_role', true );
$show_email    = (bool) hdgavi_opt( 'maint_show_email', true ) && '' !== $email;
$show_linkedin = (bool) hdgavi_opt( 'maint_show_linkedin', true ) && '' !== $linkedin;
$show_github   = (bool) hdgavi_opt( 'maint_show_github', true ) && '' !== $github;
$show_cv       = (bool) hdgavi_opt( 'maint_show_cv', true ) && '' !== $cv_pdf;
$show_form     = (bool) hdgavi_opt( 'maint_show_form', true );
$show_lang     = (bool) hdgavi_opt( 'maint_show_lang', true );
$has_links     = $show_email || $show_linkedin || $show_github || $show_cv;

/* ── Texts ──
 * maintenance_title_{lang}, maintenance_desc_{lang} and maintenance_role_{lang} override the
 * defaults below. Up to v6 the dashboard pre-filled these fields with the old defaults, so a stored
 * value equal to an old default counts as "not customised" and gets the current default. */
$defaults = array(
    'title' => array(
        'en' => 'This site is being updated',
        'fr' => 'Ce site est en cours de mise à jour',
        'es' => 'Este sitio se está actualizando',
    ),
    'desc'  => array(
        'en' => 'The site will be back online shortly. In the meantime, you can contact me using the details below.',
        'fr' => 'Le site sera de nouveau accessible prochainement. En attendant, vous pouvez me contacter aux coordonnées ci-dessous.',
        'es' => 'El sitio volverá a estar disponible próximamente. Mientras tanto, puede contactarme a través de los datos indicados a continuación.',
    ),
);
$legacy = array(
    'title' => array( 'en' => 'Site under maintenance', 'fr' => 'Site sous maintenance', 'es' => 'Sitio en mantenimiento' ),
    'desc'  => array( 'en' => 'Come back soon!', 'fr' => 'Revenez bientôt !', 'es' => '¡Vuelve pronto!' ),
);
$cv_role = hdgavi_cv( 'role' );
$t       = array( 'title' => array(), 'desc' => array(), 'role' => array() );
foreach ( $langs as $l ) {
    foreach ( array( 'title', 'desc' ) as $k ) {
        $v             = trim( (string) hdgavi_opt( 'maintenance_' . $k . '_' . $l, '' ) );
        $t[ $k ][ $l ] = ( '' === $v || $v === $legacy[ $k ][ $l ] ) ? $defaults[ $k ][ $l ] : $v;
    }
    $role            = trim( (string) hdgavi_opt( 'maintenance_role_' . $l, '' ) );
    $t['role'][ $l ] = ( '' !== $role ) ? $role : $cv_role[ $l ];
}

$ui = array(
    'skip'    => array( 'en' => 'Skip to content', 'fr' => 'Aller au contenu', 'es' => 'Ir al contenido' ),
    'langs'   => array( 'en' => 'Language', 'fr' => 'Langue', 'es' => 'Idioma' ),
    'email'   => hdgavi_cv_label( 'email' ),
    'cv'      => hdgavi_cv_label( 'cv' ),
    'write'   => hdgavi_cv_label( 'write_me' ),
    'name'    => array( 'en' => 'Name', 'fr' => 'Nom', 'es' => 'Nombre' ),
    'email_f' => array( 'en' => 'E-mail', 'fr' => 'E-mail', 'es' => 'Correo electrónico' ),
    'message' => array( 'en' => 'Message', 'fr' => 'Message', 'es' => 'Mensaje' ),
    'send'    => array( 'en' => 'Send', 'fr' => 'Envoyer', 'es' => 'Enviar' ),
);

/**
 * Escaped text in the three languages (one <span data-lang> each; CSS shows the one matching
 * html[lang]). Without the language switch only the default language is printed.
 */
$tri = function ( $texts ) use ( $langs, $lang, $show_lang ) {
    if ( ! $show_lang || 1 === count( array_unique( array_values( $texts ) ) ) ) {
        return esc_html( isset( $texts[ $lang ] ) ? $texts[ $lang ] : '' );
    }
    $out = '';
    foreach ( $langs as $l ) {
        $out .= '<span data-lang="' . $l . '">' . esc_html( isset( $texts[ $l ] ) ? $texts[ $l ] : '' ) . '</span>';
    }
    return $out;
};
$strip = function ( $url ) {
    return preg_replace( '#^https?://(www\.)?#', '', untrailingslashit( $url ) );
};

$cv_file = $show_cv ? wp_basename( (string) wp_parse_url( $cv_pdf, PHP_URL_PATH ) ) : '';
if ( $show_cv && '' === $cv_file ) {
    $cv_file = 'PDF';
}

$js_data = array(
    'lang'  => $lang,
    'ajax'  => admin_url( 'admin-ajax.php' ),
    'title' => array(),
    'msg'   => array(
        'sending' => array( 'en' => 'Sending…', 'fr' => 'Envoi en cours…', 'es' => 'Enviando…' ),
        'ok'      => array( 'en' => 'Your message has been sent.', 'fr' => 'Votre message a bien été envoyé.', 'es' => 'Su mensaje ha sido enviado.' ),
        'fields'  => array( 'en' => 'Please fill in all the fields.', 'fr' => 'Veuillez remplir tous les champs.', 'es' => 'Complete todos los campos, por favor.' ),
        'email'   => array( 'en' => 'This e-mail address is not valid.', 'fr' => 'Cette adresse e-mail n’est pas valide.', 'es' => 'Esta dirección de correo no es válida.' ),
        'error'   => array( 'en' => 'The message could not be sent. Please try again, or write to me by e-mail.', 'fr' => 'Le message n’a pas pu être envoyé. Réessayez ou écrivez-moi par e-mail.', 'es' => 'No se pudo enviar el mensaje. Inténtelo de nuevo o escríbame por correo.' ),
        'timeout' => array( 'en' => 'The server took too long to respond. Please try again.', 'fr' => 'Le serveur a mis trop de temps à répondre. Réessayez.', 'es' => 'El servidor tardó demasiado en responder. Inténtelo de nuevo.' ),
    ),
);
foreach ( $langs as $l ) {
    $js_data['title'][ $l ] = $name . ' — ' . $t['title'][ $l ];
}

$font_dir = get_template_directory_uri() . '/assets/fonts/';

status_header( 503 );
header( 'Retry-After: 86400' );
?>
<!DOCTYPE html>
<html lang="<?php echo esc_attr( $lang ); ?>">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="noindex, nofollow">
<meta name="color-scheme" content="light dark">
<meta name="theme-color" content="#F8F7F3" media="(prefers-color-scheme: light)">
<meta name="theme-color" content="#1F1E1B" media="(prefers-color-scheme: dark)">
<title><?php echo esc_html( $js_data['title'][ $lang ] ); ?></title>
<meta name="description" content="<?php echo esc_attr( $t['desc'][ $lang ] ); ?>">
<?php if ( function_exists( 'wp_site_icon' ) ) wp_site_icon(); ?>
<script>
(function (h) {
    h.className = 'js';
<?php if ( $show_lang ) : ?>
    try {
        var l = localStorage.getItem('hdgavi_lang');
        if (l === 'en' || l === 'fr' || l === 'es') h.setAttribute('lang', l);
    } catch (e) {}
<?php endif; ?>
})(document.documentElement);
</script>
<link rel="preload" href="<?php echo esc_url( $font_dir . 'ibm-plex-sans-latin-400-normal.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?php echo esc_url( $font_dir . 'ibm-plex-serif-latin-500-normal.woff2' ); ?>" as="font" type="font/woff2" crossorigin>
<style>
@font-face{font-family:"IBM Plex Sans";font-style:normal;font-weight:400;font-display:swap;src:url("<?php echo esc_url( $font_dir . 'ibm-plex-sans-latin-400-normal.woff2' ); ?>") format("woff2")}
@font-face{font-family:"IBM Plex Sans";font-style:normal;font-weight:500;font-display:swap;src:url("<?php echo esc_url( $font_dir . 'ibm-plex-sans-latin-500-normal.woff2' ); ?>") format("woff2")}
@font-face{font-family:"IBM Plex Serif";font-style:normal;font-weight:500;font-display:swap;src:url("<?php echo esc_url( $font_dir . 'ibm-plex-serif-latin-500-normal.woff2' ); ?>") format("woff2")}
@font-face{font-family:"IBM Plex Mono";font-style:normal;font-weight:400;font-display:swap;src:url("<?php echo esc_url( $font_dir . 'ibm-plex-mono-latin-400-normal.woff2' ); ?>") format("woff2")}
:root{
  --paper:#F8F7F3;--ink:#1C1C1A;--ink-2:#46453F;--ink-3:#69675F;
  --rule:#DAD7CF;--rule-strong:#AEAAA0;
  --accent:#2A5878;--accent-hover:#1E4460;--accent-line:#A3B6C5;--on-accent:#FFFFFF;
  --field:#FFFFFF;--selection:#DFE6EB;--ok:#2F6B3A;--err:#9B2C2C;
  --serif:"IBM Plex Serif",Georgia,"Times New Roman",serif;
  --sans:"IBM Plex Sans","Helvetica Neue",Arial,sans-serif;
  --mono:"IBM Plex Mono",ui-monospace,Menlo,Consolas,monospace;
  color-scheme:light;
}
@media (prefers-color-scheme:dark){
  :root{
    --paper:#1F1E1B;--ink:#ECE6DA;--ink-2:#C8C1B3;--ink-3:#9D978B;
    --rule:#3A3833;--rule-strong:#5C5850;
    --accent:#93B6D2;--accent-hover:#B9D0E2;--accent-line:#536B7D;--on-accent:#16222B;
    --field:#262521;--selection:#3B4A55;--ok:#9CCBA5;--err:#E8A6A6;
    color-scheme:dark;
  }
}
*,*::before,*::after{box-sizing:border-box}
html{background:var(--paper);-webkit-text-size-adjust:100%;text-size-adjust:100%}
body{margin:0;background:var(--paper);color:var(--ink);font:400 1.0625rem/1.6 var(--sans);-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}
h1,h2,p,dl,dd{margin:0}
a{color:var(--accent);text-decoration:underline;text-decoration-thickness:1px;text-underline-offset:.22em;text-decoration-color:var(--accent-line)}
a:hover{color:var(--accent-hover);text-decoration-color:currentColor}
:focus-visible{outline:2px solid var(--accent);outline-offset:3px}
::selection{background:var(--selection);color:var(--ink)}
[data-lang]{display:none}
html[lang="en"] [data-lang="en"],html[lang="fr"] [data-lang="fr"],html[lang="es"] [data-lang="es"]{display:inline}
.vh{position:absolute !important;width:1px;height:1px;margin:-1px;padding:0;overflow:hidden;clip:rect(0 0 0 0);white-space:nowrap;border:0}
.skip{position:absolute;left:1rem;top:-4rem;padding:.5rem .75rem;background:var(--ink);color:var(--paper);text-decoration:none}
.skip:focus{top:1rem;color:var(--paper)}
.page{width:min(40rem,calc(100% - 2rem));margin:0 auto;padding:.75rem 0 2.5rem}
.m-lang{display:flex;justify-content:flex-end;gap:.25rem}
html:not(.js) .m-lang{visibility:hidden}
.m-lang button{min-width:2.25rem;min-height:2.75rem;padding:.5rem .35rem;border:0;background:none;color:var(--ink-2);font:400 .9375rem/1 var(--sans);cursor:pointer}
.m-lang button:hover{color:var(--accent-hover)}
.m-lang button[aria-pressed="true"]{color:var(--ink);text-decoration:underline;text-decoration-thickness:1px;text-underline-offset:.4em}
.m-head{margin-top:clamp(2rem,9vh,5.5rem)}
.m-name{font-family:var(--serif);font-weight:500;font-size:2.75rem;line-height:1.08;letter-spacing:-.015em;color:var(--ink)}
.caps{letter-spacing:.04em}
.m-role{margin-top:.6rem;font-size:1.1875rem;line-height:1.45;color:var(--ink-2)}
.m-org{margin-top:.15rem;color:var(--ink-3)}
.m-sec{margin-top:2.75rem;padding-top:2rem;border-top:1px solid var(--rule)}
.m-sec > :first-child{margin-top:0}
.m-title{font-family:var(--serif);font-weight:500;font-size:1.5rem;line-height:1.25;color:var(--ink)}
.m-text{margin-top:.75rem;max-width:36rem}
.m-coords{display:grid;row-gap:.7rem;margin-top:1.75rem}
.m-coords > div{display:grid;grid-template-columns:6.5rem minmax(0,1fr);column-gap:1.5rem;align-items:baseline}
.m-coords dt{font-size:.9375rem;color:var(--ink-3)}
.m-coords a{overflow-wrap:anywhere}
.m-label{font-family:var(--mono);font-weight:400;font-size:.875rem;line-height:1.5;color:var(--ink-2)}
.m-form{margin-top:1.25rem}
.m-hp{display:none}
.m-field{display:grid;gap:.35rem;margin-bottom:1.1rem}
.m-field label{font-size:.9375rem;color:var(--ink-2)}
.m-field input,.m-field textarea{width:100%;min-height:2.75rem;margin:0;padding:.55rem .75rem;border:1px solid var(--rule-strong);border-radius:2px;background:var(--field);color:var(--ink);font:400 1rem/1.4 var(--sans);-webkit-appearance:none;appearance:none}
.m-field textarea{min-height:8rem;resize:vertical}
.m-field input:focus,.m-field textarea:focus{outline:2px solid var(--accent);outline-offset:0;border-color:var(--accent)}
.m-btn{display:inline-flex;align-items:center;justify-content:center;min-height:2.75rem;padding:0 1.125rem;border:1px solid var(--accent);border-radius:2px;background:var(--accent);color:var(--on-accent);font:500 1rem/1.2 var(--sans);cursor:pointer}
.m-btn:hover{background:var(--accent-hover);border-color:var(--accent-hover)}
.m-btn[disabled]{opacity:.6;cursor:default}
.m-fb{margin-top:.75rem;font-size:.9375rem;color:var(--ink-2)}
.m-fb:empty{display:none}
.m-fb.ok{color:var(--ok)}
.m-fb.err{color:var(--err)}
.m-foot{margin-top:3rem;padding-top:1.25rem;border-top:1px solid var(--rule);font-size:.9375rem;color:var(--ink-3)}
@media (max-width:760px){
  body{font-size:1rem}
  .m-name{font-size:2rem}
  .m-role{font-size:1.0625rem}
  .m-sec{margin-top:2.25rem;padding-top:1.5rem}
  .m-title{font-size:1.3125rem}
  .m-coords{row-gap:1rem}
  .m-coords > div{display:block}
  .m-coords dd{margin-top:.1rem}
}
</style>
</head>
<body>
<a class="skip" href="#m-main"><?php echo $tri( $ui['skip'] ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in $tri ?></a>

<div class="page">

  <?php if ( $show_lang ) : ?>
  <nav class="m-lang" id="mLang" aria-labelledby="m-lang-label">
    <span class="vh" id="m-lang-label"><?php echo $tri( $ui['langs'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
    <button type="button" data-set-lang="fr" lang="fr" aria-label="Français" aria-pressed="<?php echo 'fr' === $lang ? 'true' : 'false'; ?>">FR</button>
    <button type="button" data-set-lang="en" lang="en" aria-label="English" aria-pressed="<?php echo 'en' === $lang ? 'true' : 'false'; ?>">EN</button>
    <button type="button" data-set-lang="es" lang="es" aria-label="Español" aria-pressed="<?php echo 'es' === $lang ? 'true' : 'false'; ?>">ES</button>
  </nav>
  <?php endif; ?>

  <header class="m-head">
    <h1 class="m-name"><?php echo hdgavi_name_html( $name ); // phpcs:ignore WordPress.Security.EscapeOutput -- escaped in the helper ?></h1>
    <?php if ( $show_role ) : ?>
    <p class="m-role"><?php echo $tri( $t['role'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
    <?php if ( '' !== $company ) : ?>
    <p class="m-org"><?php echo esc_html( $company ); ?></p>
    <?php endif; ?>
    <?php endif; ?>
  </header>

  <main id="m-main">
    <?php if ( $show_banner || $has_links ) : ?>
    <section class="m-sec"<?php echo $show_banner ? ' aria-labelledby="m-status"' : ''; ?>>
      <?php if ( $show_banner ) : ?>
      <h2 class="m-title" id="m-status"><?php echo $tri( $t['title'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
      <p class="m-text"><?php echo $tri( $t['desc'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></p>
      <?php endif; ?>

      <?php if ( $has_links ) : ?>
      <dl class="m-coords">
        <?php if ( $show_email ) : ?>
        <div>
          <dt><?php echo $tri( $ui['email'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></dt>
          <dd><a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a></dd>
        </div>
        <?php endif; ?>
        <?php if ( $show_linkedin ) : ?>
        <div>
          <dt>LinkedIn</dt>
          <dd><a href="<?php echo esc_url( $linkedin ); ?>" rel="me noopener"><?php echo esc_html( $strip( $linkedin ) ); ?></a></dd>
        </div>
        <?php endif; ?>
        <?php if ( $show_github ) : ?>
        <div>
          <dt>GitHub</dt>
          <dd><a href="<?php echo esc_url( $github ); ?>" rel="me noopener"><?php echo esc_html( $strip( $github ) ); ?></a></dd>
        </div>
        <?php endif; ?>
        <?php if ( $show_cv ) : ?>
        <div>
          <dt><?php echo $tri( $ui['cv'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></dt>
          <dd><a href="<?php echo esc_url( home_url( '/?hdgavi_cv=preview' ) ); ?>" target="_blank" rel="noopener" type="application/pdf"><?php echo esc_html( $cv_file ); ?></a></dd>
        </div>
        <?php endif; ?>
      </dl>
      <?php endif; ?>
    </section>
    <?php endif; ?>

    <?php if ( $show_form ) : ?>
    <section class="m-sec" aria-labelledby="m-write">
      <h2 class="m-label" id="m-write"><?php echo $tri( $ui['write'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></h2>
      <form class="m-form" id="mForm">
        <div class="m-hp" aria-hidden="true"><input type="text" name="website" tabindex="-1" autocomplete="off"></div>
        <div class="m-field">
          <label for="mf-name"><?php echo $tri( $ui['name'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
          <input type="text" id="mf-name" name="name" autocomplete="name" required>
        </div>
        <div class="m-field">
          <label for="mf-email"><?php echo $tri( $ui['email_f'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
          <input type="email" id="mf-email" name="email" autocomplete="email" required>
        </div>
        <div class="m-field">
          <label for="mf-msg"><?php echo $tri( $ui['message'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></label>
          <textarea id="mf-msg" name="message" required></textarea>
        </div>
        <button type="submit" class="m-btn"><?php echo $tri( $ui['send'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></button>
        <p class="m-fb" id="mFb" role="status" aria-live="polite"></p>
      </form>
    </section>
    <?php endif; ?>
  </main>

  <footer class="m-foot">
    <p>&copy; <?php echo esc_html( $year . ' ' . $name ); ?></p>
  </footer>

</div>

<script>
(function () {
  'use strict';
  var C = <?php echo wp_json_encode( $js_data, JSON_HEX_TAG | JSON_HEX_AMP ); ?>;
  var html = document.documentElement;

  function lang() {
    var l = html.getAttribute('lang');
    return (l === 'en' || l === 'fr' || l === 'es') ? l : C.lang;
  }
  function msg(key) {
    return C.msg[key][lang()] || C.msg[key].en;
  }
  function sync() {
    var l = lang(), btns = document.querySelectorAll('[data-set-lang]');
    if (C.title[l]) document.title = C.title[l];
    for (var i = 0; i < btns.length; i++) {
      btns[i].setAttribute('aria-pressed', btns[i].getAttribute('data-set-lang') === l ? 'true' : 'false');
    }
  }

  /* Language switch: same storage key as the rest of the site */
  var langBtns = document.querySelectorAll('[data-set-lang]');
  for (var i = 0; i < langBtns.length; i++) {
    langBtns[i].addEventListener('click', function () {
      var l = this.getAttribute('data-set-lang');
      html.setAttribute('lang', l);
      try { localStorage.setItem('hdgavi_lang', l); } catch (e) {}
      sync();
    });
  }
  sync();

  /* Contact form: admin-ajax action hdgavi_maint_contact (honeypot + server-side rate limit) */
  var form = document.getElementById('mForm');
  if (!form) return;
  form.addEventListener('submit', function (e) {
    e.preventDefault();
    var fb = document.getElementById('mFb'),
        btn = form.querySelector('button[type="submit"]'),
        hp = form.querySelector('input[name="website"]'),
        n = document.getElementById('mf-name').value.trim(),
        em = document.getElementById('mf-email').value.trim(),
        m = document.getElementById('mf-msg').value.trim();
    function say(cls, key) {
      fb.className = 'm-fb' + (cls ? ' ' + cls : '');
      fb.textContent = msg(key);
    }
    if (!n || !em || !m) { say('err', 'fields'); return; }
    if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(em)) { say('err', 'email'); return; }

    btn.disabled = true;
    say('', 'sending');
    var fd = new FormData();
    fd.append('action', 'hdgavi_maint_contact');
    fd.append('name', n);
    fd.append('email', em);
    fd.append('message', m);
    fd.append('website', hp ? hp.value : '');
    var ac = window.AbortController ? new AbortController() : null,
        tid = setTimeout(function () { if (ac) ac.abort(); }, 15000);
    fetch(C.ajax, { method: 'POST', body: fd, signal: ac ? ac.signal : undefined })
      .then(function (r) { return r.json(); })
      .then(function (d) {
        if (d && d.success) { say('ok', 'ok'); form.reset(); }
        else { say('err', 'error'); }
      })
      .catch(function (err) { say('err', err && err.name === 'AbortError' ? 'timeout' : 'error'); })
      .then(function () { clearTimeout(tid); btn.disabled = false; });
  });
})();
</script>
</body>
</html>
