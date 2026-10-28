<?php
/**
 * HD GAVI Portfolio — Email Templates System
 * 4 templates: Confirmation, Notification, Mini CV, Welcome
 * Integrates with WP Mail SMTP (by WPForms)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ═══════════════════════════════════════
   0. EMAIL COLOR PALETTE (single source of truth)
   Change colors here — every template inherits them.
   ═══════════════════════════════════════ */
define( 'HDGAVI_EMAIL_COLORS', array(
    // Header (dark band)
    'header_bg'       => '#0B0F1A',
    'header_text'     => '#F1F5F9',
    'header_subtitle' => '#94A3B8',
    // Accent
    'accent'          => '#06B6D4',
    'accent_dark'     => '#0891B2',
    'accent_gradient' => '#005386',
    // Body (white card)
    'page_bg'         => '#E8ECF0',
    'card_bg'         => '#FFFFFF',
    'text_heading'    => '#0F172A',
    'text_body'       => '#334155',
    'text_secondary'  => '#475569',
    'text_label'      => '#64748B',
    'text_muted'      => '#94A3B8',
    // Surfaces & borders
    'surface'         => '#F8FAFC',
    'surface_alt'     => '#F1F5F9',
    'border'          => '#E2E8F0',
    // Dark block (newsletter standalone emails)
    'dark_bg'         => '#0F172A',
) );

function hdgavi_ec( $key ) {
    return HDGAVI_EMAIL_COLORS[ $key ] ?? '#000000';
}

/* ═══════════════════════════════════════
   1. EMAIL HEADER/FOOTER (shared)
   ═══════════════════════════════════════ */

/**
 * Build the shared email header (dark band + gradient bar)
 */
function hdgavi_email_header( $title, $subtitle = '' ) {
    $monogram   = esc_html( hdgavi_opt( 'logo_monogram', 'HD' ) );
    $logo_text  = esc_html( hdgavi_opt( 'logo_text', 'GAVI' ) );
    $title      = esc_html( $title );
    $subtitle   = esc_html( $subtitle );

    return '
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:' . hdgavi_ec('header_bg') . ';padding:32px 36px;">
      <tr><td>
        <table cellpadding="0" cellspacing="0" border="0" style="margin-bottom:16px;">
          <tr>
            <td style="width:32px;height:32px;background:rgba(6,182,212,0.15);border:1px solid rgba(6,182,212,0.3);border-radius:6px;text-align:center;vertical-align:middle;font-family:Outfit,Arial,sans-serif;font-size:12px;font-weight:700;color:' . hdgavi_ec('accent') . ';letter-spacing:0.5px;">' . $monogram . '</td>
            <td style="padding-left:10px;font-family:Outfit,Arial,sans-serif;font-weight:700;font-size:15px;color:' . hdgavi_ec('header_text') . ';">' . $logo_text . '</td>
          </tr>
        </table>
        <div style="font-family:Outfit,Arial,sans-serif;font-size:22px;font-weight:600;color:' . hdgavi_ec('header_text') . ';line-height:1.3;letter-spacing:-0.01em;">' . $title . '</div>
        ' . ( $subtitle ? '<div style="font-size:14px;color:' . hdgavi_ec('header_subtitle') . ';margin-top:6px;font-family:\'DM Sans\',Arial,sans-serif;">' . $subtitle . '</div>' : '' ) . '
      </td></tr>
    </table>
    <table width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr><td style="height:3px;background:linear-gradient(90deg,' . hdgavi_ec('accent') . ',' . hdgavi_ec('accent_gradient') . ');"></td></tr>
    </table>';
}

/**
 * Build the shared email footer
 */
function hdgavi_email_footer() {
    $name       = esc_html( hdgavi_opt( 'general_name', 'Holali David GAVI' ) );
    $badge_en   = esc_html( hdgavi_opt( 'about_badge_en', 'Cloud & DevOps Engineer' ) );
    $github     = esc_url( hdgavi_opt( 'contact_github', '' ) );
    $linkedin   = esc_url( hdgavi_opt( 'contact_linkedin', '' ) );
    $site_url   = esc_url( home_url( '/' ) );
    $year       = esc_html( hdgavi_opt( 'footer_year', '2026' ) );

    $social_links = '';
    if ( $github )   $social_links .= '<a href="' . $github . '" style="color:' . hdgavi_ec('accent') . ';text-decoration:none;font-weight:500;">GitHub</a>';
    if ( $github && $linkedin ) $social_links .= ' &middot; ';
    if ( $linkedin ) $social_links .= '<a href="' . $linkedin . '" style="color:' . hdgavi_ec('accent') . ';text-decoration:none;font-weight:500;">LinkedIn</a>';
    if ( $social_links ) $social_links .= ' &middot; ';
    $social_links .= '<a href="' . $site_url . '" style="color:' . hdgavi_ec('accent') . ';text-decoration:none;font-weight:500;">Portfolio</a>';

    return '
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid ' . hdgavi_ec('border') . ';padding:24px 36px;text-align:center;font-family:\'DM Sans\',Arial,sans-serif;font-size:12px;color:' . hdgavi_ec('text_muted') . ';line-height:1.8;">
      <tr><td>
        <div>' . $name . '</div>
        <div style="color:' . hdgavi_ec('accent') . ';font-weight:500;">' . $badge_en . '</div>
        <div style="margin:8px 0;">' . $social_links . '</div>
        <div>&copy; ' . $year . ' ' . $name . '</div>
      </td></tr>
    </table>';
}

/**
 * Wrap email content in the full HTML skeleton
 */
function hdgavi_email_wrap( $header_html, $body_html, $footer_html ) {
    return '<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Email</title>
<!--[if mso]><style>table{border-collapse:collapse;}td{font-family:Arial,sans-serif;}</style><![endif]-->
</head>
<body style="margin:0;padding:0;background:' . hdgavi_ec('page_bg') . ';font-family:\'DM Sans\',Arial,Helvetica,sans-serif;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="background:' . hdgavi_ec('page_bg') . ';padding:24px;">
  <tr><td align="center">
    <table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" style="max-width:600px;width:100%;background:' . hdgavi_ec('card_bg') . ';border-radius:12px;overflow:hidden;box-shadow:0 2px 12px rgba(0,0,0,0.08);">
      <tr><td>' . $header_html . '</td></tr>
      <tr><td style="padding:32px 36px;font-size:14px;color:' . hdgavi_ec('text_body') . ';line-height:1.7;font-family:\'DM Sans\',Arial,sans-serif;">' . $body_html . '</td></tr>
      <tr><td>' . $footer_html . '</td></tr>
    </table>
  </td></tr>
</table>
</body>
</html>';
}

/* ═══════════════════════════════════════
   2. TEMPLATE BUILDERS
   ═══════════════════════════════════════ */

/**
 * Template 1: Confirmation (sent to visitor)
 */
function hdgavi_email_confirmation( $visitor_name ) {
    $lang = hdgavi_opt( 'default_lang', 'en' );
    $site_url = esc_url( home_url( '/' ) );

    if ( $lang === 'fr' ) {
        $title    = hdgavi_opt( 'email_confirm_title_fr', 'Message bien reçu ! ✓' );
        $subtitle = hdgavi_opt( 'email_confirm_subtitle_fr', 'Je vous réponds dès que possible.' );
        $body = '<p style="font-size:15px;font-weight:600;color:' . hdgavi_ec('text_heading') . ';margin-bottom:16px;">Bonjour ' . esc_html( $visitor_name ) . ',</p>
        <p>Merci de m\'avoir contacté via mon portfolio. J\'ai bien reçu votre message et je vous répondrai dans les meilleurs délais — généralement sous 24 à 48 heures.</p>
        <p>En attendant, n\'hésitez pas à explorer mon parcours et mes réalisations :</p>
        <p style="margin:16px 0;"><a href="' . $site_url . '" style="display:inline-block;padding:12px 28px;background:' . hdgavi_ec('accent') . ';color:#FFFFFF;font-weight:600;font-size:14px;border-radius:8px;text-decoration:none;">Voir mon portfolio →</a></p>
        <p style="font-size:13px;color:' . hdgavi_ec('text_muted') . ';margin-top:12px;">Ceci est une confirmation automatique. Inutile de répondre à cet email.</p>';
    } elseif ( $lang === 'es' ) {
        $title    = hdgavi_opt( 'email_conf_title_es', 'Mensaje recibido ✓' );
        $subtitle = hdgavi_opt( 'email_conf_subtitle_es', 'Gracias por contactarme' );
        $body = '<p style="font-size:15px;font-weight:600;color:' . hdgavi_ec('text_heading') . ';margin-bottom:16px;">Hola ' . esc_html( $visitor_name ) . ',</p>
        <p>He recibido su mensaje y le responderé lo antes posible — generalmente en 24 a 48 horas.</p>
        <p>Mientras tanto, no dude en explorar mi trayectoria y mis proyectos:</p>
        <p style="margin:16px 0;"><a href="' . $site_url . '" style="display:inline-block;padding:12px 28px;background:' . hdgavi_ec('accent') . ';color:#FFFFFF;font-weight:600;font-size:14px;border-radius:8px;text-decoration:none;">Ver mi portfolio →</a></p>
        <p style="font-size:13px;color:' . hdgavi_ec('text_muted') . ';margin-top:12px;">Esta es una confirmación automática. No es necesario responder a este email.</p>';
    } else {
        $title    = hdgavi_opt( 'email_confirm_title_en', 'Message well received! ✓' );
        $subtitle = hdgavi_opt( 'email_confirm_subtitle_en', 'I\'ll get back to you as soon as possible.' );
        $body = '<p style="font-size:15px;font-weight:600;color:' . hdgavi_ec('text_heading') . ';margin-bottom:16px;">Hi ' . esc_html( $visitor_name ) . ',</p>
        <p>Thank you for reaching out through my portfolio. I\'ve received your message and I\'ll respond as soon as possible — usually within 24 to 48 hours.</p>
        <p>In the meantime, feel free to explore my work and background:</p>
        <p style="margin:16px 0;"><a href="' . $site_url . '" style="display:inline-block;padding:12px 28px;background:' . hdgavi_ec('accent') . ';color:#FFFFFF;font-weight:600;font-size:14px;border-radius:8px;text-decoration:none;">View my portfolio →</a></p>
        <p style="font-size:13px;color:' . hdgavi_ec('text_muted') . ';margin-top:12px;">This is an automated confirmation. No need to reply to this email.</p>';
    }

    $header = hdgavi_email_header( $title, $subtitle );
    $footer = hdgavi_email_footer();
    return hdgavi_email_wrap( $header, $body, $footer );
}

/**
 * Template 2: Notification (sent to admin/you)
 */
function hdgavi_email_notification( $visitor_name, $visitor_email, $message, $ip = '' ) {
    $title    = hdgavi_opt( 'email_notif_title', '📩 New message from your portfolio' );
    $subtitle = hdgavi_opt( 'email_notif_subtitle', 'Someone just reached out via the contact form.' );
    $date     = current_time( 'F j, Y' );
    $time     = current_time( 'H:i' );

    $body = '
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:' . hdgavi_ec('surface') . ';border:1px solid ' . hdgavi_ec('border') . ';border-radius:8px;margin-bottom:16px;">
      <tr><td style="padding:20px;">
        <div style="font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:0.05em;color:' . hdgavi_ec('text_muted') . ';margin-bottom:4px;">From</div>
        <div style="font-size:14px;color:' . hdgavi_ec('text_heading') . ';font-weight:500;">' . esc_html( $visitor_name ) . ' — ' . esc_html( $visitor_email ) . '</div>
        <div style="margin-top:12px;padding-top:12px;border-top:1px solid ' . hdgavi_ec('border') . ';font-size:14px;color:' . hdgavi_ec('text_secondary') . ';line-height:1.7;">' . nl2br( esc_html( $message ) ) . '</div>
      </td></tr>
    </table>
    <p style="margin:16px 0;"><a href="mailto:' . esc_attr( $visitor_email ) . '" style="display:inline-block;padding:12px 28px;background:' . hdgavi_ec('accent') . ';color:#FFFFFF;font-weight:600;font-size:14px;border-radius:8px;text-decoration:none;">Reply directly →</a></p>
    <p style="font-size:12px;color:' . hdgavi_ec('text_muted') . ';">Sent on ' . esc_html( $date ) . ' at ' . esc_html( $time ) . ( $ip ? ' • IP: ' . esc_html( $ip ) : '' ) . '</p>';

    $header = hdgavi_email_header( $title, $subtitle );
    // Simplified footer for admin notification
    $footer = '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-top:1px solid ' . hdgavi_ec('border') . ';padding:16px 36px;text-align:center;font-size:11px;color:' . hdgavi_ec('text_muted') . ';font-family:\'DM Sans\',Arial,sans-serif;">
      <tr><td>Portfolio notification system — hdgavi-portfolio v' . HDGAVI_VERSION . '</td></tr>
    </table>';

    return hdgavi_email_wrap( $header, $body, $footer );
}

/**
 * Template 3: Auto-response with mini CV (sent to visitor)
 */
function hdgavi_email_minicv( $visitor_name ) {
    $lang     = hdgavi_opt( 'default_lang', 'en' );
    $name     = esc_html( hdgavi_opt( 'general_name', 'Holali David GAVI' ) );
    if ( $lang === 'fr' ) {
        $badge = hdgavi_opt( 'about_badge_fr', '' );
    } elseif ( $lang === 'es' ) {
        $badge = hdgavi_opt( 'about_badge_es', hdgavi_opt( 'about_badge_en', '' ) );
    } else {
        $badge = hdgavi_opt( 'about_badge_en', '' );
    }
    $site_url = esc_url( home_url( '/' ) );
    $github   = esc_url( hdgavi_opt( 'contact_github', '' ) );
    $linkedin = esc_url( hdgavi_opt( 'contact_linkedin', '' ) );
    $cv_url   = esc_url( hdgavi_opt( 'cv_pdf_url', '' ) );

    // Build skills pills from CPT
    $skills_html = '';
    $email_skills = hdgavi_get_cpt_posts( 'hdgavi_skill' );
    foreach ( array_slice( $email_skills, 0, 8 ) as $es ) {
        $esn = get_post_meta( $es->ID, '_skill_name', true );
        if ( $esn ) {
            $skills_html .= '<span style="display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:500;background:rgba(6,182,212,0.08);color:' . hdgavi_ec('accent_dark') . ';border:1px solid rgba(6,182,212,0.15);margin:2px 3px 2px 0;">' . esc_html( $esn ) . '</span>';
        }
    }

    // Stats
    $stats_html = '<table width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:16px 0;"><tr>';
    for ( $i = 1; $i <= 4; $i++ ) {
        $num   = esc_html( hdgavi_opt( "stat_{$i}_number", '' ) );
        if ( $lang === 'fr' ) {
            $label = hdgavi_opt( "stat_{$i}_label_fr", '' );
        } elseif ( $lang === 'es' ) {
            $label = hdgavi_opt( "stat_{$i}_label_es", hdgavi_opt( "stat_{$i}_label_en", '' ) );
        } else {
            $label = hdgavi_opt( "stat_{$i}_label_en", '' );
        }
        if ( $num ) {
            $stats_html .= '<td style="width:25%;text-align:center;padding:12px;background:' . hdgavi_ec('surface') . ';border:1px solid ' . hdgavi_ec('border') . ';border-radius:8px;">
              <div style="font-family:Outfit,Arial,sans-serif;font-size:20px;font-weight:700;color:' . hdgavi_ec('accent') . ';">' . $num . '</div>
              <div style="font-size:11px;color:' . hdgavi_ec('text_muted') . ';margin-top:2px;">' . esc_html( $label ) . '</div>
            </td>';
            if ( $i < 4 ) $stats_html .= '<td style="width:4%"></td>';
        }
    }
    $stats_html .= '</tr></table>';

    // Links row
    $links_html = '<table cellpadding="0" cellspacing="0" border="0" style="margin-top:12px;padding-top:12px;border-top:1px solid ' . hdgavi_ec('border') . ';"><tr>';
    $links_html .= '<td style="padding-right:16px;"><a href="' . $site_url . '" style="font-size:13px;color:' . hdgavi_ec('accent') . ';text-decoration:none;font-weight:500;">🌐 Portfolio</a></td>';
    if ( $github )   $links_html .= '<td style="padding-right:16px;"><a href="' . $github . '" style="font-size:13px;color:' . hdgavi_ec('accent') . ';text-decoration:none;font-weight:500;">💻 GitHub</a></td>';
    if ( $linkedin ) $links_html .= '<td style="padding-right:16px;"><a href="' . $linkedin . '" style="font-size:13px;color:' . hdgavi_ec('accent') . ';text-decoration:none;font-weight:500;">💼 LinkedIn</a></td>';
    if ( $lang === 'fr' ) {
        $cv_label = 'Télécharger CV';
    } elseif ( $lang === 'es' ) {
        $cv_label = 'Descargar CV';
    } else {
        $cv_label = 'Download CV';
    }
    if ( $cv_url )   $links_html .= '<td><a href="' . $cv_url . '" style="font-size:13px;color:' . hdgavi_ec('accent') . ';text-decoration:none;font-weight:500;">📄 ' . $cv_label . '</a></td>';
    $links_html .= '</tr></table>';

    if ( $lang === 'fr' ) {
        $title    = hdgavi_opt( 'email_cv_title_fr', 'Un peu plus sur moi' );
        $subtitle = hdgavi_opt( 'email_cv_subtitle_fr', 'Voici un aperçu rapide de mon profil et de mes compétences.' );
        $greeting = 'Bonjour ' . esc_html( $visitor_name ) . ',';
        $intro    = 'Merci pour votre intérêt. Voici un résumé de mon profil :';
        $outro    = 'N\'hésitez pas à répondre à cet email ou à planifier un échange. Je suis toujours ouvert aux discussions et opportunités.';
    } elseif ( $lang === 'es' ) {
        $title    = hdgavi_opt( 'email_cv_title_es', 'Un vistazo rápido a mi perfil' );
        $subtitle = hdgavi_opt( 'email_cv_subtitle_es', 'Un resumen de mi trayectoria' );
        $greeting = 'Hola ' . esc_html( $visitor_name ) . ',';
        $intro    = 'Gracias por su interés. Aquí tiene un resumen rápido de mi perfil:';
        $outro    = 'No dude en responder a este email o programar una llamada. Siempre estoy abierto a discutir oportunidades y colaboraciones.';
    } else {
        $title    = hdgavi_opt( 'email_cv_title_en', 'A bit more about me' );
        $subtitle = hdgavi_opt( 'email_cv_subtitle_en', 'Here\'s a quick overview of my profile and skills.' );
        $greeting = 'Hi ' . esc_html( $visitor_name ) . ',';
        $intro    = 'Thank you for your interest. Here\'s a quick snapshot of my profile:';
        $outro    = 'Feel free to reply to this email or schedule a call. I\'m always happy to discuss opportunities and collaborations.';
    }

    $body = '<p style="font-size:15px;font-weight:600;color:' . hdgavi_ec('text_heading') . ';margin-bottom:16px;">' . $greeting . '</p>
    <p>' . $intro . '</p>
    <table width="100%" cellpadding="0" cellspacing="0" border="0" style="background:' . hdgavi_ec('surface') . ';border:1px solid ' . hdgavi_ec('border') . ';border-radius:8px;margin:16px 0;">
      <tr><td style="padding:24px;">
        <div style="font-family:Outfit,Arial,sans-serif;font-size:17px;font-weight:700;color:' . hdgavi_ec('text_heading') . ';margin-bottom:4px;">' . $name . '</div>
        <div style="font-size:13px;color:' . hdgavi_ec('accent') . ';font-weight:500;margin-bottom:12px;">' . esc_html( $badge ) . '</div>
        <div>' . $skills_html . '</div>
        ' . $links_html . '
      </td></tr>
    </table>
    ' . $stats_html . '
    <p>' . $outro . '</p>';

    $header = hdgavi_email_header( $title, $subtitle );
    $footer = hdgavi_email_footer();
    return hdgavi_email_wrap( $header, $body, $footer );
}

/**
 * Template 4: Welcome first contact (sent to visitor)
 */
function hdgavi_email_welcome( $visitor_name ) {
    $lang     = hdgavi_opt( 'default_lang', 'en' );
    $site_url = esc_url( home_url( '/' ) );
    $quote_en = hdgavi_opt( 'about_quote_en', 'I don\'t look for the easy way — I look to understand.' );
    $quote_fr = hdgavi_opt( 'about_quote_fr', 'Je ne cherche pas la facilité, je cherche à comprendre.' );

    if ( $lang === 'fr' ) {
        $title    = hdgavi_opt( 'email_welcome_title_fr', 'Bienvenue ! Ravi de vous connaître 👋' );
        $subtitle = hdgavi_opt( 'email_welcome_subtitle_fr', 'Merci de m\'avoir contacté pour la première fois.' );
        $body = '<p style="font-size:15px;font-weight:600;color:' . hdgavi_ec('text_heading') . ';margin-bottom:16px;">Bonjour ' . esc_html( $visitor_name ) . ',</p>
        <p>Je suis content que vous ayez trouvé mon portfolio ! C\'est le début de ce que j\'espère être un bel échange.</p>
        <p>Quelques mots sur moi : je suis quelqu\'un de curieux et persévérant. J\'ai appris l\'informatique en autodidacte avant d\'en faire mon métier, et aujourd\'hui je travaille comme <strong>' . esc_html( hdgavi_opt( 'seo_job_title', 'Cloud & DevOps Engineer' ) ) . '</strong>, spécialisé en conteneurisation et orchestration Kubernetes.</p>
        <p>Voici comment je peux aider :</p>
        <div style="margin:12px 0 16px;padding-left:16px;border-left:2px solid ' . hdgavi_ec('accent') . ';">
          <p style="margin:6px 0;font-size:14px;">⚙️ Architecture DevOps & Cloud</p>
          <p style="margin:6px 0;font-size:14px;">🐳 Conteneurisation & Kubernetes</p>
          <p style="margin:6px 0;font-size:14px;">🔐 Sécurité des infrastructures</p>
          <p style="margin:6px 0;font-size:14px;">💻 Développement full-stack</p>
        </div>
        <p style="margin:16px 0;"><a href="' . $site_url . '" style="display:inline-block;padding:12px 28px;background:' . hdgavi_ec('accent') . ';color:#FFFFFF;font-weight:600;font-size:14px;border-radius:8px;text-decoration:none;">Explorer mon portfolio →</a></p>
        <p>N\'hésitez pas à répondre — je lis chaque message personnellement.</p>
        <p style="margin-top:20px;font-style:italic;color:' . hdgavi_ec('text_label') . ';font-size:14px;">« ' . esc_html( $quote_fr ) . ' »</p>';
    } elseif ( $lang === 'es' ) {
        $title    = hdgavi_opt( 'email_welcome_title_es', 'Bienvenido/a 👋' );
        $subtitle = hdgavi_opt( 'email_welcome_subtitle_es', 'Gracias por contactarme por primera vez.' );
        $body = '<p style="font-size:15px;font-weight:600;color:' . hdgavi_ec('text_heading') . ';margin-bottom:16px;">Hola ' . esc_html( $visitor_name ) . ',</p>
        <p>Me alegra que haya encontrado mi portfolio. Es el comienzo de lo que espero sea un gran intercambio.</p>
        <p>Algunas cosas sobre mí: soy una persona curiosa y persistente. Aprendí informática de forma autodidacta antes de que se convirtiera en mi carrera, y hoy trabajo como <strong>' . esc_html( hdgavi_opt( 'seo_job_title', 'Cloud & DevOps Engineer' ) ) . '</strong>, especializado en contenedorización y orquestación Kubernetes.</p>
        <p>Cómo puedo ayudar:</p>
        <div style="margin:12px 0 16px;padding-left:16px;border-left:2px solid ' . hdgavi_ec('accent') . ';">
          <p style="margin:6px 0;font-size:14px;">⚙️ Arquitectura DevOps & Cloud</p>
          <p style="margin:6px 0;font-size:14px;">🐳 Contenedorización & Kubernetes</p>
          <p style="margin:6px 0;font-size:14px;">🔐 Seguridad de infraestructuras</p>
          <p style="margin:6px 0;font-size:14px;">💻 Desarrollo full-stack</p>
        </div>
        <p style="margin:16px 0;"><a href="' . $site_url . '" style="display:inline-block;padding:12px 28px;background:' . hdgavi_ec('accent') . ';color:#FFFFFF;font-weight:600;font-size:14px;border-radius:8px;text-decoration:none;">Explorar mi portfolio →</a></p>
        <p>No dude en responder — leo cada mensaje personalmente.</p>
        <p style="margin-top:20px;font-style:italic;color:' . hdgavi_ec('text_label') . ';font-size:14px;">« ' . esc_html( hdgavi_opt( 'about_quote_es', $quote_en ) ) . ' »</p>';
    } else {
        $title    = hdgavi_opt( 'email_welcome_title_en', 'Welcome! Nice to meet you 👋' );
        $subtitle = hdgavi_opt( 'email_welcome_subtitle_en', 'Thank you for reaching out for the first time.' );
        $body = '<p style="font-size:15px;font-weight:600;color:' . hdgavi_ec('text_heading') . ';margin-bottom:16px;">Hi ' . esc_html( $visitor_name ) . ',</p>
        <p>I\'m glad you found my portfolio! This is the beginning of what I hope will be a great exchange.</p>
        <p>A few things about me: I\'m a curious and persistent person. I taught myself IT before it became my career, and today I work as a <strong>' . esc_html( hdgavi_opt( 'seo_job_title', 'Cloud & DevOps Engineer' ) ) . '</strong>, specialized in containerization and Kubernetes orchestration.</p>
        <p>Here\'s what I can help with:</p>
        <div style="margin:12px 0 16px;padding-left:16px;border-left:2px solid ' . hdgavi_ec('accent') . ';">
          <p style="margin:6px 0;font-size:14px;">⚙️ DevOps & Cloud architecture</p>
          <p style="margin:6px 0;font-size:14px;">🐳 Containerization & Kubernetes</p>
          <p style="margin:6px 0;font-size:14px;">🔐 Infrastructure security</p>
          <p style="margin:6px 0;font-size:14px;">💻 Full-stack development</p>
        </div>
        <p style="margin:16px 0;"><a href="' . $site_url . '" style="display:inline-block;padding:12px 28px;background:' . hdgavi_ec('accent') . ';color:#FFFFFF;font-weight:600;font-size:14px;border-radius:8px;text-decoration:none;">Explore my portfolio →</a></p>
        <p>Don\'t hesitate to reply — I read every message personally.</p>
        <p style="margin-top:20px;font-style:italic;color:' . hdgavi_ec('text_label') . ';font-size:14px;">"' . esc_html( $quote_en ) . '"</p>';
    }

    $header = hdgavi_email_header( $title, $subtitle );
    $footer = hdgavi_email_footer();
    return hdgavi_email_wrap( $header, $body, $footer );
}

/* ═══════════════════════════════════════
   3. CONTACT FORM HANDLER (replaces ajax-contact)
   ═══════════════════════════════════════ */

/**
 * Check if this email has contacted before (for welcome email).
 * Uses hashed emails for GDPR data minimization.
 */
function hdgavi_is_first_contact( $email ) {
    $contacts = get_option( 'hdgavi_contacts', array() );
    $hash     = hash( 'sha256', strtolower( $email ) );
    return ! in_array( $hash, $contacts, true );
}

/**
 * Record a contact email (stored as SHA-256 hash, not plaintext)
 */
function hdgavi_record_contact( $email ) {
    $contacts = get_option( 'hdgavi_contacts', array() );
    $hash     = hash( 'sha256', strtolower( $email ) );
    $contacts[] = $hash;
    $contacts = array_unique( $contacts );
    if ( count( $contacts ) > 5000 ) {
        $contacts = array_slice( $contacts, -5000 );
    }
    update_option( 'hdgavi_contacts', $contacts, false );
}

/**
 * Process contact form and send all emails
 */
function hdgavi_process_contact_form() {
    check_ajax_referer( 'hdgavi_contact_nonce', 'nonce' );
    hdgavi_rate_limit( 'contact', 5 );

    // Honeypot check
    if ( ! empty( $_POST['botcheck'] ) ) {
        wp_send_json_success( array( 'message' => 'OK' ) );
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( empty( $name ) || empty( $email ) || empty( $message ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid fields.' ) );
    }

    $admin_email = hdgavi_opt( 'general_email', get_option( 'admin_email' ) );
    $site_name   = hdgavi_opt( 'general_name', 'Portfolio' );
    $ip          = hdgavi_get_client_ip();
    $is_first    = hdgavi_is_first_contact( $email );

    $html_headers = array( 'Content-Type: text/html; charset=UTF-8' );

    $success = true;

    // 1. Notification to admin (synchronous — critical)
    $notif_subject = sprintf( '[Portfolio] New message from %s', $name );
    $notif_html    = hdgavi_email_notification( $name, $email, $message, $ip );
    $notif_headers = array_merge( $html_headers, array( 'Reply-To: ' . str_replace( array( "\r", "\n", "\0" ), '', $name ) . ' <' . $email . '>' ) );
    $mail_result = wp_mail( $admin_email, $notif_subject, $notif_html, $notif_headers );
    hdgavi_log_mail( $admin_email, $notif_subject, $mail_result );
    if ( ! $mail_result ) {
        $success = false;
    }

    // 2–4. Follow-up emails queued via WP-Cron (avoid AJAX timeout)
    $lang = hdgavi_opt( 'default_lang', 'en' );
    $queue = array(
        'visitor_name'  => $name,
        'visitor_email' => $email,
        'is_first'      => $is_first,
        'lang'          => $lang,
        'site_name'     => $site_name,
    );
    wp_schedule_single_event( time(), 'hdgavi_send_followup_emails', array( $queue ) );

    // Record contact
    hdgavi_record_contact( $email );

    if ( $success ) {
        wp_send_json_success( array( 'message' => 'OK' ) );
    } else {
        wp_send_json_error( array( 'message' => 'Send error.' ) );
    }
}

// Register contact form AJAX handlers
add_action( 'wp_ajax_hdgavi_contact', 'hdgavi_process_contact_form' );
add_action( 'wp_ajax_nopriv_hdgavi_contact', 'hdgavi_process_contact_form' );

/**
 * Process booking form
 */
function hdgavi_process_booking_form() {
    check_ajax_referer( 'hdgavi_booking_nonce', 'nonce' );
    hdgavi_rate_limit( 'booking', 5 );

    // Honeypot check
    if ( ! empty( $_POST['botcheck'] ) ) {
        wp_send_json_success( array( 'message' => 'OK' ) );
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $date    = sanitize_text_field( wp_unslash( $_POST['date'] ?? '' ) );
    $time    = sanitize_text_field( wp_unslash( $_POST['time'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( empty( $name ) || empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid fields.' ) );
    }

    $admin_email  = hdgavi_opt( 'general_email', get_option( 'admin_email' ) );
    $site_name    = hdgavi_opt( 'general_name', 'Portfolio' );
    $ip           = hdgavi_get_client_ip();
    $html_headers = array( 'Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . str_replace( array( "\r", "\n", "\0" ), '', $name ) . ' <' . $email . '>' );

    // Build email
    $header = hdgavi_email_header( 'Booking Request', 'New meeting request from your portfolio' );
    $body_content = '<div style="padding:24px 32px">'
        . '<table width="100%" cellpadding="8" cellspacing="0" border="0" style="font-size:14px;color:' . hdgavi_ec('text_body') . '">'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . ';width:100px">Name</td><td><strong>' . esc_html( $name ) . '</strong></td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">Email</td><td><a href="mailto:' . esc_attr( $email ) . '" style="color:' . hdgavi_ec('accent') . '">' . esc_html( $email ) . '</a></td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">Date</td><td><strong>' . esc_html( $date ) . '</strong></td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">Time</td><td><strong>' . esc_html( $time ) . '</strong></td></tr>'
        . ( $message ? '<tr><td style="color:' . hdgavi_ec('text_label') . '">Topic</td><td>' . nl2br( esc_html( $message ) ) . '</td></tr>' : '' )
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">IP</td><td style="font-size:11px;color:' . hdgavi_ec('text_muted') . '">' . esc_html( $ip ) . '</td></tr>'
        . '</table></div>';
    $body = hdgavi_email_wrap( $header, $body_content, hdgavi_email_footer() );

    $subject = '[Portfolio] Booking request from ' . $name;
    $success = wp_mail( $admin_email, $subject, $body, $html_headers );
    hdgavi_log_mail( $admin_email, $subject, $success );

    // Confirmation to visitor
    $confirm_header = hdgavi_email_header( '✅ Booking Request Received', 'I\'ll confirm your meeting within 24 hours' );
    $confirm_content = '<div style="padding:24px 32px;color:' . hdgavi_ec('text_body') . ';font-size:14px;line-height:1.7">'
        . '<p>Hi <strong>' . esc_html( $name ) . '</strong>,</p>'
        . '<p>Your booking request for <strong>' . esc_html( $date . ' at ' . $time ) . '</strong> has been received.</p>'
        . '<p>I\'ll review my availability and confirm within 24 hours.</p>'
        . '<p style="color:' . hdgavi_ec('text_label') . ';margin-top:20px">— ' . esc_html( $site_name ) . '</p>'
        . '</div>';
    $confirm_body = hdgavi_email_wrap( $confirm_header, $confirm_content, hdgavi_email_footer() );
    $confirm_result = wp_mail( $email, 'Booking request received — ' . $site_name, $confirm_body, array( 'Content-Type: text/html; charset=UTF-8' ) );
    hdgavi_log_mail( $email, 'Booking request received', $confirm_result );

    $success ? wp_send_json_success( array( 'message' => 'OK' ) ) : wp_send_json_error( array( 'message' => 'Send error.' ) );
}
add_action( 'wp_ajax_hdgavi_booking', 'hdgavi_process_booking_form' );
add_action( 'wp_ajax_nopriv_hdgavi_booking', 'hdgavi_process_booking_form' );

/**
 * Process quote/devis request form
 */
function hdgavi_process_quote_form() {
    check_ajax_referer( 'hdgavi_quote_nonce', 'nonce' );
    hdgavi_rate_limit( 'quote', 5 );

    // Honeypot check
    if ( ! empty( $_POST['botcheck'] ) ) {
        wp_send_json_success( array( 'message' => 'OK' ) );
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $company = sanitize_text_field( wp_unslash( $_POST['company'] ?? '' ) );
    $service = sanitize_text_field( wp_unslash( $_POST['service'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( empty( $name ) || empty( $email ) || empty( $message ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid fields.' ) );
    }

    $admin_email  = hdgavi_opt( 'general_email', get_option( 'admin_email' ) );
    $site_name    = hdgavi_opt( 'general_name', 'Portfolio' );
    $ip           = hdgavi_get_client_ip();
    $html_headers = array( 'Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . str_replace( array( "\r", "\n", "\0" ), '', $name ) . ' <' . $email . '>' );

    $service_labels = array( 'devops-consulting' => 'DevOps Consulting', 'security-audit' => 'Security Audit', 'training' => 'Training / Formation', 'other' => 'Other' );
    $service_label = $service_labels[ $service ] ?? $service;

    $q_header = hdgavi_email_header( 'Quote Request', 'New service inquiry from your portfolio' );
    $q_body = '<div style="padding:24px 32px">'
        . '<table width="100%" cellpadding="8" cellspacing="0" border="0" style="font-size:14px;color:' . hdgavi_ec('text_body') . '">'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . ';width:100px">Name</td><td><strong>' . esc_html( $name ) . '</strong></td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">Email</td><td><a href="mailto:' . esc_attr( $email ) . '" style="color:' . hdgavi_ec('accent') . '">' . esc_html( $email ) . '</a></td></tr>'
        . ( $company ? '<tr><td style="color:' . hdgavi_ec('text_label') . '">Company</td><td>' . esc_html( $company ) . '</td></tr>' : '' )
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">Service</td><td><strong>' . esc_html( $service_label ) . '</strong></td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '" colspan="2">Project description</td></tr>'
        . '<tr><td colspan="2" style="background:' . hdgavi_ec('surface_alt') . ';border-radius:8px;padding:12px">' . nl2br( esc_html( $message ) ) . '</td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">IP</td><td style="font-size:11px;color:' . hdgavi_ec('text_muted') . '">' . esc_html( $ip ) . '</td></tr>'
        . '</table></div>';
    $body = hdgavi_email_wrap( $q_header, $q_body, hdgavi_email_footer() );

    $subject = '[Portfolio] Quote request — ' . $service_label . ' — ' . $name;
    $success = wp_mail( $admin_email, $subject, $body, $html_headers );
    hdgavi_log_mail( $admin_email, $subject, $success );

    // Confirmation to visitor
    $qc_header = hdgavi_email_header( '✅ Quote Request Received', 'I\'ll get back to you within 48 hours' );
    $qc_body = '<div style="padding:24px 32px;color:' . hdgavi_ec('text_body') . ';font-size:14px;line-height:1.7">'
        . '<p>Hi <strong>' . esc_html( $name ) . '</strong>,</p>'
        . '<p>Your quote request for <strong>' . esc_html( $service_label ) . '</strong> has been received.</p>'
        . '<p>I\'ll review your project description and respond within 48 hours.</p>'
        . '<p style="color:' . hdgavi_ec('text_label') . ';margin-top:20px">— ' . esc_html( $site_name ) . '</p>'
        . '</div>';
    $confirm_body = hdgavi_email_wrap( $qc_header, $qc_body, hdgavi_email_footer() );
    $confirm_result = wp_mail( $email, 'Quote request received — ' . $site_name, $confirm_body, array( 'Content-Type: text/html; charset=UTF-8' ) );
    hdgavi_log_mail( $email, 'Quote request received', $confirm_result );

    $success ? wp_send_json_success( array( 'message' => 'OK' ) ) : wp_send_json_error( array( 'message' => 'Send error.' ) );
}
add_action( 'wp_ajax_hdgavi_quote', 'hdgavi_process_quote_form' );
add_action( 'wp_ajax_nopriv_hdgavi_quote', 'hdgavi_process_quote_form' );

/**
 * Process maintenance contact form (AJAX instead of mailto:)
 */
function hdgavi_process_maintenance_form() {
    // Skip nonce check — maintenance page may be served from cache (stale nonce).
    // Protection relies on honeypot + rate-limit instead.
    hdgavi_rate_limit( 'maint_contact', 5 );

    // Honeypot check
    if ( ! empty( $_POST['website'] ) ) {
        wp_send_json_success( array( 'message' => 'OK' ) );
    }

    $name    = sanitize_text_field( wp_unslash( $_POST['name'] ?? '' ) );
    $email   = sanitize_email( wp_unslash( $_POST['email'] ?? '' ) );
    $message = sanitize_textarea_field( wp_unslash( $_POST['message'] ?? '' ) );

    if ( empty( $name ) || empty( $email ) || empty( $message ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'Invalid fields.' ) );
    }

    $admin_email  = hdgavi_opt( 'general_email', get_option( 'admin_email' ) );
    $ip           = hdgavi_get_client_ip();
    $html_headers = array( 'Content-Type: text/html; charset=UTF-8', 'Reply-To: ' . str_replace( array( "\r", "\n", "\0" ), '', $name ) . ' <' . $email . '>' );

    $m_header = hdgavi_email_header( 'Maintenance Contact', 'Someone reached out while site is under construction' );
    $m_body = '<div style="padding:24px 32px">'
        . '<table width="100%" cellpadding="8" cellspacing="0" border="0" style="font-size:14px;color:' . hdgavi_ec('text_body') . '">'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . ';width:80px">Name</td><td><strong>' . esc_html( $name ) . '</strong></td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">Email</td><td><a href="mailto:' . esc_attr( $email ) . '" style="color:' . hdgavi_ec('accent') . '">' . esc_html( $email ) . '</a></td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '" colspan="2">Message</td></tr>'
        . '<tr><td colspan="2" style="background:' . hdgavi_ec('surface_alt') . ';border-radius:8px;padding:12px">' . nl2br( esc_html( $message ) ) . '</td></tr>'
        . '<tr><td style="color:' . hdgavi_ec('text_label') . '">IP</td><td style="font-size:11px;color:' . hdgavi_ec('text_muted') . '">' . esc_html( $ip ) . '</td></tr>'
        . '</table></div>';
    $body = hdgavi_email_wrap( $m_header, $m_body, hdgavi_email_footer() );

    $subject = '[Portfolio] Maintenance contact from ' . $name;
    $success = wp_mail( $admin_email, $subject, $body, $html_headers );
    hdgavi_log_mail( $admin_email, $subject, $success );

    $success ? wp_send_json_success( array( 'message' => 'OK' ) ) : wp_send_json_error( array( 'message' => 'Send error.' ) );
}
add_action( 'wp_ajax_hdgavi_maint_contact', 'hdgavi_process_maintenance_form' );
add_action( 'wp_ajax_nopriv_hdgavi_maint_contact', 'hdgavi_process_maintenance_form' );

/**
 * WP-Cron handler: send follow-up emails asynchronously
 */
function hdgavi_do_send_followup_emails( $data ) {
    $name      = $data['visitor_name'];
    $email     = $data['visitor_email'];
    $is_first  = $data['is_first'];
    $lang      = $data['lang'] ?? hdgavi_opt( 'default_lang', 'en' );
    $site_name = $data['site_name'];

    $html_headers = array( 'Content-Type: text/html; charset=UTF-8' );

    // Confirmation
    $confirm_subject = $lang === 'fr'
        ? hdgavi_opt( 'email_confirm_subject_fr', 'Message bien reçu ! — ' . $site_name )
        : hdgavi_opt( 'email_confirm_subject_en', 'Message received! — ' . $site_name );
    hdgavi_log_mail( $email, $confirm_subject, wp_mail( $email, $confirm_subject, hdgavi_email_confirmation( $name ), $html_headers ) );

    // Welcome (first contact only — disabled by default for GDPR compliance)
    if ( $is_first && hdgavi_opt( 'email_welcome_enabled', false ) ) {
        $welcome_subject = $lang === 'fr'
            ? hdgavi_opt( 'email_welcome_subject_fr', 'Bienvenue ! — ' . $site_name )
            : hdgavi_opt( 'email_welcome_subject_en', 'Welcome! — ' . $site_name );
        hdgavi_log_mail( $email, $welcome_subject, wp_mail( $email, $welcome_subject, hdgavi_email_welcome( $name ), $html_headers ) );
    }

    // Mini CV (disabled by default for GDPR compliance)
    if ( hdgavi_opt( 'email_cv_enabled', false ) ) {
        $cv_subject = $lang === 'fr'
            ? hdgavi_opt( 'email_cv_subject_fr', 'Un peu plus sur moi — ' . $site_name )
            : hdgavi_opt( 'email_cv_subject_en', 'A bit more about me — ' . $site_name );
        hdgavi_log_mail( $email, $cv_subject, wp_mail( $email, $cv_subject, hdgavi_email_minicv( $name ), $html_headers ) );
    }
}
add_action( 'hdgavi_send_followup_emails', 'hdgavi_do_send_followup_emails' );

/* ═══════════════════════════════════════
   4. WP MAIL SMTP CONFIGURATION HELPER
   ═══════════════════════════════════════ */

/**
 * Set From name and email for all outgoing emails
 */
function hdgavi_mail_from( $email ) {
    $custom = hdgavi_opt( 'smtp_from_email', '' );
    return ! empty( $custom ) ? $custom : $email;
}
add_filter( 'wp_mail_from', 'hdgavi_mail_from' );

function hdgavi_mail_from_name( $name ) {
    $custom = hdgavi_opt( 'smtp_from_name', '' );
    return ! empty( $custom ) ? $custom : hdgavi_opt( 'general_name', $name );
}
add_filter( 'wp_mail_from_name', 'hdgavi_mail_from_name' );
