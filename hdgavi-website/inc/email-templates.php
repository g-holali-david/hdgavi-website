<?php
/**
 * HD GAVI Portfolio — E-mail templates
 * Visitor e-mails (confirmation, first contact, mini CV), admin notifications and the
 * booking / quote / maintenance form handlers. Works with WP Mail SMTP (by WPForms).
 *
 * Layout: tables and inline styles so that Gmail and Outlook render it. A white sheet on
 * the paper colour of the site, ink text, 1px neutral rules and one steel-blue accent (the
 * header colour of the printed CV) for links and buttons: 2px radius, no shadow.
 * Mail clients cannot load the theme fonts, hence the Helvetica / Arial, Georgia and
 * Consolas / Menlo fallbacks.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ---------------------------------------------------------------------------
   0. PALETTE (single source of truth)
   Same values as the light theme of the site. The legacy keys stay because
   inc/newsletter.php and inc/cv-download-gate.php use them ('header_bg' is also
   the text colour of the buttons they draw on 'accent').
   --------------------------------------------------------------------------- */
define( 'HDGAVI_EMAIL_COLORS', array(
    'paper'           => '#F8F7F3',
    'sheet'           => '#FFFFFF',
    'ink'             => '#1C1C1A',
    'ink_2'           => '#46453F',
    'ink_3'           => '#69675F',
    'rule'            => '#DAD7CF',
    'accent'          => '#2A5878',
    'accent_dark'     => '#1E4460',
    'on_accent'       => '#FFFFFF',
    // Legacy keys.
    'header_bg'       => '#FFFFFF',
    'header_text'     => '#1C1C1A',
    'header_subtitle' => '#46453F',
    'accent_gradient' => '#2A5878',
    'page_bg'         => '#F8F7F3',
    'card_bg'         => '#FFFFFF',
    'text_heading'    => '#1C1C1A',
    'text_body'       => '#1C1C1A',
    'text_secondary'  => '#46453F',
    'text_label'      => '#69675F',
    'text_muted'      => '#69675F',
    'surface'         => '#F8F7F3',
    'surface_alt'     => '#F8F7F3',
    'border'          => '#DAD7CF',
    'dark_bg'         => '#1C1C1A',
) );

function hdgavi_ec( $key ) {
    return HDGAVI_EMAIL_COLORS[ $key ] ?? '#000000';
}

/* ---------------------------------------------------------------------------
   1. BUILDING BLOCKS
   --------------------------------------------------------------------------- */

/** Font stacks: the theme fonts first, then fonts every mail client has. */
function hdgavi_email_font( $kind = 'sans' ) {
    if ( 'serif' === $kind ) {
        return "'IBM Plex Serif',Georgia,'Times New Roman',serif";
    }
    if ( 'mono' === $kind ) {
        return "'IBM Plex Mono',Consolas,Menlo,'Courier New',monospace";
    }
    return "'IBM Plex Sans',Helvetica,Arial,sans-serif";
}

/** Inline type declaration: family, size, line height and colour. */
function hdgavi_email_type( $size, $color = 'ink', $kind = 'sans', $line = '1.6' ) {
    return 'font-family:' . hdgavi_email_font( $kind ) . ';font-size:' . (int) $size . 'px;line-height:' . $line . ';color:' . hdgavi_ec( $color ) . ';';
}

/** Language of the e-mails: the default language of the site (en, fr or es). */
function hdgavi_email_lang() {
    $lang = (string) hdgavi_opt( 'default_lang', 'en' );
    return in_array( $lang, array( 'en', 'fr', 'es' ), true ) ? $lang : 'en';
}

/** One value of an array( 'en' => , 'fr' => , 'es' => ), English as fallback. */
function hdgavi_email_pick( $texts, $lang = '' ) {
    $lang = $lang ? $lang : hdgavi_email_lang();
    if ( isset( $texts[ $lang ] ) && '' !== (string) $texts[ $lang ] ) {
        return (string) $texts[ $lang ];
    }
    return isset( $texts['en'] ) ? (string) $texts['en'] : '';
}

/**
 * Plain text for titles and subjects: removes pictographs, dingbats, decorative arrows
 * and emoji modifiers, including in stored Customizer values and in the titles that
 * other templates pass to hdgavi_email_header().
 */
function hdgavi_email_plain( $text ) {
    $text  = (string) $text;
    $clean = preg_replace( '/[\x{2190}-\x{21FF}\x{2300}-\x{23FF}\x{2460}-\x{24FF}\x{25A0}-\x{27BF}\x{2900}-\x{297F}\x{2B00}-\x{2BFF}\x{FE00}-\x{FE0F}\x{200D}\x{20E3}\x{1F000}-\x{1FAFF}\x{E0020}-\x{E007F}]/u', '', $text );
    if ( null === $clean ) {
        return trim( $text );
    }
    return trim( preg_replace( '/ {2,}/', ' ', $clean ) );
}

/**
 * Customizer text used by the e-mails. A stored value that equals a default of an earlier
 * version (emoji, exclamation marks) falls back to the current default.
 */
function hdgavi_email_text( $key, $default ) {
    $legacy = array(
        'Message well received!', 'Message bien reçu !', "I'll get back to you as soon as possible.", 'Gracias por contactarme',
        'New message from your portfolio', 'Someone just reached out via the contact form.',
        'A bit more about me', 'Un peu plus sur moi', 'Un vistazo rápido a mi perfil',
        "Here's a quick overview of my profile and skills.", 'Voici un aperçu rapide de mon profil et de mes compétences.', 'Un resumen de mi trayectoria',
        'Welcome! Nice to meet you', 'Bienvenue ! Ravi de vous connaître', 'Bienvenido/a',
        'Thank you for reaching out for the first time.', "Merci de m'avoir contacté pour la première fois.", 'Gracias por contactarme por primera vez.',
        'Message received! — Holali David GAVI', 'Message bien reçu ! — Holali David GAVI',
        'Welcome! — Holali David GAVI', 'Bienvenue ! — Holali David GAVI',
        'A bit more about me — Holali David GAVI', 'Un peu plus sur moi — Holali David GAVI',
    );
    $value = hdgavi_email_plain( hdgavi_opt( $key, $default ) );
    if ( '' === $value || in_array( $value, $legacy, true ) ) {
        $value = hdgavi_email_plain( $default );
    }
    return $value;
}

/** Host name of the site, e.g. gholalidavid.com. */
function hdgavi_email_site_label() {
    $host = (string) wp_parse_url( home_url( '/' ), PHP_URL_HOST );
    $host = preg_replace( '/^www\./i', '', $host );
    return '' !== $host ? $host : home_url( '/' );
}

/** Paragraph of body text. $html must already be escaped. */
function hdgavi_email_p( $html, $style = '' ) {
    return '<p style="margin:0 0 16px;' . hdgavi_email_type( 15 ) . $style . '">' . $html . '</p>';
}

/** Text link in the accent colour. */
function hdgavi_email_link( $url, $label ) {
    return '<a href="' . esc_url( $url ) . '" style="color:' . hdgavi_ec( 'accent' ) . ';text-decoration:underline;">' . esc_html( $label ) . '</a>';
}

/** Monospace value (IP address). */
function hdgavi_email_mono( $text ) {
    return '<span style="font-family:' . hdgavi_email_font( 'mono' ) . ';font-size:13px;color:' . hdgavi_ec( 'ink_2' ) . ';">' . esc_html( $text ) . '</span>';
}

/** Filled button (one per e-mail at most): steel blue, 2px radius, no shadow. */
function hdgavi_email_button( $url, $label ) {
    return '<table role="presentation" cellpadding="0" cellspacing="0" border="0" style="margin:4px 0 24px;"><tr>'
        . '<td bgcolor="' . hdgavi_ec( 'accent' ) . '" style="background-color:' . hdgavi_ec( 'accent' ) . ';border-radius:2px;padding:11px 20px;">'
        . '<a href="' . esc_url( $url ) . '" style="' . hdgavi_email_type( 14, 'on_accent', 'sans', '1.2' ) . 'font-weight:600;text-decoration:none;">' . esc_html( $label ) . '</a>'
        . '</td></tr></table>';
}

/** Vertical spacing around a block of content. */
function hdgavi_email_block( $html, $space = 16 ) {
    return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding:0 0 ' . (int) $space . 'px;">' . $html . '</td></tr></table>';
}

/** Section: 1px rule on top, sentence-case heading, content. */
function hdgavi_email_section( $heading, $html ) {
    return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0"><tr>'
        . '<td style="padding:20px 0 8px;border-top:1px solid ' . hdgavi_ec( 'rule' ) . ';">'
        . ( '' !== (string) $heading ? '<h2 style="margin:0 0 12px;' . hdgavi_email_type( 15, 'ink', 'sans', '1.4' ) . 'font-weight:600;">' . esc_html( $heading ) . '</h2>' : '' )
        . $html
        . '</td></tr></table>';
}

/** Title line and a grey meta line (organisation, place, dates). $meta_html is escaped. */
function hdgavi_email_entry( $title, $meta_html = '', $size = 15 ) {
    return '<p style="margin:0;' . hdgavi_email_type( $size, 'ink', 'sans', '1.45' ) . 'font-weight:600;">' . esc_html( $title ) . '</p>'
        . ( '' !== $meta_html ? '<p style="margin:2px 0 0;' . hdgavi_email_type( 13, 'ink_3', 'sans', '1.5' ) . '">' . $meta_html . '</p>' : '' );
}

/** Date or period in monospace, as on the site. */
function hdgavi_email_when( $text ) {
    return '<span style="font-family:' . hdgavi_email_font( 'mono' ) . ';font-size:12px;white-space:nowrap;">' . esc_html( $text ) . '</span>';
}

/** Dash list (French style). Each item is escaped HTML. */
function hdgavi_email_list( $items ) {
    $rows = '';
    foreach ( $items as $item ) {
        $rows .= '<tr>'
            . '<td width="16" valign="top" style="width:16px;padding:0 0 6px;' . hdgavi_email_type( 14, 'ink_3', 'sans', '1.55' ) . '">&ndash;</td>'
            . '<td valign="top" style="padding:0 0 6px;' . hdgavi_email_type( 14, 'ink', 'sans', '1.55' ) . '">' . $item . '</td>'
            . '</tr>';
    }
    return '' === $rows ? '' : '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:10px 0 0;">' . $rows . '</table>';
}

/** Label / value rows separated by 1px rules. Each row: array( label, escaped value HTML ). */
function hdgavi_email_rows( $rows ) {
    $out = '';
    foreach ( $rows as $row ) {
        $out .= '<tr>'
            . '<td width="104" valign="top" style="width:104px;padding:9px 12px 9px 0;border-top:1px solid ' . hdgavi_ec( 'rule' ) . ';' . hdgavi_email_type( 13, 'ink_3', 'sans', '1.5' ) . '">' . esc_html( $row[0] ) . '</td>'
            . '<td valign="top" style="padding:9px 0;border-top:1px solid ' . hdgavi_ec( 'rule' ) . ';' . hdgavi_email_type( 14, 'ink', 'sans', '1.5' ) . '">' . $row[1] . '</td>'
            . '</tr>';
    }
    return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="margin:0 0 20px;border-bottom:1px solid ' . hdgavi_ec( 'rule' ) . ';">' . $out . '</table>';
}

/** Message written by the visitor (plain text, line breaks kept). */
function hdgavi_email_message( $label, $text ) {
    return '<p style="margin:0 0 6px;' . hdgavi_email_type( 13, 'ink_3', 'sans', '1.5' ) . '">' . esc_html( $label ) . '</p>'
        . '<p style="margin:0 0 24px;' . hdgavi_email_type( 15 ) . '">' . nl2br( esc_html( $text ) ) . '</p>';
}

/** Closing formula and name. */
function hdgavi_email_signoff( $lang = '' ) {
    $close = array( 'en' => 'Best regards,', 'fr' => 'Cordialement,', 'es' => 'Saludos cordiales,' );
    return hdgavi_email_p( esc_html( hdgavi_email_pick( $close, $lang ) ) . '<br>' . esc_html( hdgavi_opt( 'general_name', 'Holali David GAVI' ) ), 'margin:24px 0 0;' );
}

/** Small note under automatic messages. */
function hdgavi_email_auto_note( $lang = '' ) {
    $notes = array(
        'en' => 'This message was sent automatically.',
        'fr' => 'Ce message a été envoyé automatiquement.',
        'es' => 'Este mensaje se ha enviado automáticamente.',
    );
    return '<p style="margin:24px 0 0;' . hdgavi_email_type( 13, 'ink_3', 'sans', '1.5' ) . '">' . esc_html( hdgavi_email_pick( $notes, $lang ) ) . '</p>';
}

/** Value of a CV dataset item (inc/cv-content.php): base_<lang>, then base_en, then base. */
function hdgavi_email_cv_meta( $meta, $base, $lang ) {
    foreach ( array( $base . '_' . $lang, $base . '_en', $base ) as $key ) {
        if ( isset( $meta[ $key ] ) && '' !== trim( (string) $meta[ $key ] ) ) {
            return trim( (string) $meta[ $key ] );
        }
    }
    return '';
}

/* ---------------------------------------------------------------------------
   2. HEADER / FOOTER / SKELETON (shared with newsletter.php and cv-download-gate.php)
   --------------------------------------------------------------------------- */

/**
 * Shared header: name and role, a 1px rule, then the title of the e-mail.
 */
function hdgavi_email_header( $title, $subtitle = '' ) {
    $name     = hdgavi_opt( 'general_name', 'Holali David GAVI' );
    $role     = function_exists( 'hdgavi_cv' ) ? hdgavi_email_pick( hdgavi_cv( 'role' ) ) : '';
    $title    = hdgavi_email_plain( $title );
    $subtitle = hdgavi_email_plain( $subtitle );

    return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">'
        . '<tr><td class="hd-px" style="padding:24px 40px 18px;border-bottom:1px solid ' . hdgavi_ec( 'rule' ) . ';">'
        . '<p style="margin:0;' . hdgavi_email_type( 15, 'ink', 'sans', '1.4' ) . 'font-weight:600;">' . esc_html( $name ) . '</p>'
        . ( '' !== $role ? '<p style="margin:0;' . hdgavi_email_type( 13, 'ink_3', 'sans', '1.5' ) . '">' . esc_html( $role ) . '</p>' : '' )
        . '</td></tr>'
        . '<tr><td class="hd-px" style="padding:32px 40px 0;">'
        . '<h1 style="margin:0;' . hdgavi_email_type( 24, 'ink', 'serif', '1.25' ) . 'font-weight:500;">' . esc_html( $title ) . '</h1>'
        . ( '' !== $subtitle ? '<p style="margin:8px 0 0;' . hdgavi_email_type( 15, 'ink_2', 'sans', '1.5' ) . '">' . esc_html( $subtitle ) . '</p>' : '' )
        . '</td></tr>'
        . '</table>';
}

/**
 * Shared footer for visitor e-mails: contact address and links.
 */
function hdgavi_email_footer() {
    $email    = sanitize_email( (string) hdgavi_opt( 'general_email', '' ) );
    $github   = hdgavi_opt( 'contact_github', '' );
    $linkedin = hdgavi_opt( 'contact_linkedin', '' );

    $links = array();
    if ( $email ) {
        $links[] = hdgavi_email_link( 'mailto:' . $email, $email );
    }
    $links[] = hdgavi_email_link( home_url( '/' ), hdgavi_email_site_label() );
    if ( $github ) {
        $links[] = hdgavi_email_link( $github, 'GitHub' );
    }
    if ( $linkedin ) {
        $links[] = hdgavi_email_link( $linkedin, 'LinkedIn' );
    }

    return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">'
        . '<tr><td class="hd-px" style="padding:20px 40px 26px;border-top:1px solid ' . hdgavi_ec( 'rule' ) . ';' . hdgavi_email_type( 13, 'ink_3', 'sans', '1.7' ) . '">'
        . implode( ' &middot; ', $links )
        . '</td></tr></table>';
}

/**
 * Footer of the notifications sent to the site owner.
 */
function hdgavi_email_admin_footer( $source ) {
    $parts = array( esc_html( $source ), esc_html( hdgavi_email_site_label() ) );
    if ( defined( 'HDGAVI_VERSION' ) ) {
        $parts[] = esc_html( 'hdgavi-portfolio ' . HDGAVI_VERSION );
    }
    return '<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0">'
        . '<tr><td class="hd-px" style="padding:16px 40px 22px;border-top:1px solid ' . hdgavi_ec( 'rule' ) . ';' . hdgavi_email_type( 12, 'ink_3', 'sans', '1.6' ) . '">'
        . implode( ' &middot; ', $parts )
        . '</td></tr></table>';
}

/**
 * Wrap the content in the full HTML skeleton (600px column, light colour scheme).
 */
function hdgavi_email_wrap( $header_html, $body_html, $footer_html ) {
    $lang = hdgavi_email_lang();
    $name = hdgavi_opt( 'general_name', 'Holali David GAVI' );

    return '<!DOCTYPE html>
<html lang="' . esc_attr( $lang ) . '" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="color-scheme" content="light">
<meta name="supported-color-schemes" content="light">
<title>' . esc_html( $name ) . '</title>
<!--[if mso]><style>table{border-collapse:collapse;}td,p,a,h1,h2,span{font-family:Arial,sans-serif !important;}</style><![endif]-->
<style>
a[x-apple-data-detectors]{color:inherit !important;text-decoration:none !important;}
@media only screen and (max-width:520px){.hd-px{padding-left:20px !important;padding-right:20px !important;}.hd-outer{padding:0 !important;}}
</style>
</head>
<body style="margin:0;padding:0;background-color:' . hdgavi_ec( 'paper' ) . ';-webkit-text-size-adjust:100%;">
<table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="' . hdgavi_ec( 'paper' ) . '" style="background-color:' . hdgavi_ec( 'paper' ) . ';">
  <tr><td class="hd-outer" align="center" style="padding:32px 16px;">
    <!--[if mso]><table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0" align="center"><tr><td><![endif]-->
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="' . hdgavi_ec( 'sheet' ) . '" style="max-width:600px;background-color:' . hdgavi_ec( 'sheet' ) . ';border:1px solid ' . hdgavi_ec( 'rule' ) . ';">
      <tr><td>' . $header_html . '</td></tr>
      <tr><td class="hd-px" style="padding:24px 40px 32px;' . hdgavi_email_type( 15 ) . '">' . $body_html . '</td></tr>
      <tr><td>' . $footer_html . '</td></tr>
    </table>
    <!--[if mso]></td></tr></table><![endif]-->
  </td></tr>
</table>
</body>
</html>';
}

/* ---------------------------------------------------------------------------
   3. TEMPLATE BUILDERS
   --------------------------------------------------------------------------- */

/**
 * Template 1: Confirmation (sent to visitor)
 */
function hdgavi_email_confirmation( $visitor_name ) {
    $lang = hdgavi_opt( 'default_lang', 'en' );
    $name = esc_html( $visitor_name );
    $site = hdgavi_email_link( home_url( '/' ), hdgavi_email_site_label() );

    if ( $lang === 'fr' ) {
        $title    = hdgavi_email_text( 'email_confirm_title_fr', 'Message reçu' );
        $subtitle = hdgavi_email_text( 'email_confirm_subtitle_fr', 'Je vous réponds dès que possible.' );
        $body     = hdgavi_email_p( 'Bonjour ' . $name . ',' )
            . hdgavi_email_p( esc_html( 'Merci pour votre message, que j’ai bien reçu via le formulaire de contact de mon site.' ) )
            . hdgavi_email_p( esc_html( 'En attendant ma réponse, vous trouverez mon parcours, mes projets et mon CV sur ' ) . $site . '.' )
            . hdgavi_email_signoff( 'fr' )
            . hdgavi_email_auto_note( 'fr' );
    } elseif ( $lang === 'es' ) {
        $title    = hdgavi_email_text( 'email_conf_title_es', 'Mensaje recibido' );
        $subtitle = hdgavi_email_text( 'email_conf_subtitle_es', 'Le responderé lo antes posible.' );
        $body     = hdgavi_email_p( 'Hola ' . $name . ',' )
            . hdgavi_email_p( esc_html( 'Gracias por su mensaje, que he recibido a través del formulario de contacto de mi sitio.' ) )
            . hdgavi_email_p( esc_html( 'Mientras tanto, encontrará mi trayectoria, mis proyectos y mi CV en ' ) . $site . '.' )
            . hdgavi_email_signoff( 'es' )
            . hdgavi_email_auto_note( 'es' );
    } else {
        $title    = hdgavi_email_text( 'email_confirm_title_en', 'Message received' );
        $subtitle = hdgavi_email_text( 'email_confirm_subtitle_en', 'I will reply as soon as possible.' );
        $body     = hdgavi_email_p( 'Hello ' . $name . ',' )
            . hdgavi_email_p( esc_html( 'Thank you for your message, which I received through the contact form on my site.' ) )
            . hdgavi_email_p( esc_html( 'In the meantime, my background, projects and CV are on ' ) . $site . '.' )
            . hdgavi_email_signoff( 'en' )
            . hdgavi_email_auto_note( 'en' );
    }

    $header = hdgavi_email_header( $title, $subtitle );
    $footer = hdgavi_email_footer();
    return hdgavi_email_wrap( $header, $body, $footer );
}

/**
 * Template 2: Notification (sent to admin/you)
 */
function hdgavi_email_notification( $visitor_name, $visitor_email, $message, $ip = '' ) {
    $title    = hdgavi_email_text( 'email_notif_title', 'New message from the contact form' );
    $subtitle = hdgavi_email_text( 'email_notif_subtitle', 'Sent through the contact form on the site.' );
    $date     = current_time( 'F j, Y' );
    $time     = current_time( 'H:i' );

    $rows = array(
        array( 'From', '<strong>' . esc_html( $visitor_name ) . '</strong>' ),
        array( 'E-mail', hdgavi_email_link( 'mailto:' . $visitor_email, $visitor_email ) ),
        array( 'Date', esc_html( $date . ', ' . $time ) ),
    );
    if ( $ip ) {
        $rows[] = array( 'IP', hdgavi_email_mono( $ip ) );
    }

    $body = hdgavi_email_rows( $rows )
        . hdgavi_email_message( 'Message', $message )
        . hdgavi_email_button( 'mailto:' . $visitor_email, 'Reply to ' . $visitor_name );

    $header = hdgavi_email_header( $title, $subtitle );
    // Simplified footer for admin notification
    $footer = hdgavi_email_admin_footer( 'Contact form' );

    return hdgavi_email_wrap( $header, $body, $footer );
}

/**
 * Template 3: Auto-response with mini CV (sent to visitor)
 * Content comes from the CV datasets of inc/cv-content.php (the new CV, verbatim).
 */
function hdgavi_email_minicv( $visitor_name ) {
    $lang   = hdgavi_opt( 'default_lang', 'en' );
    $l      = in_array( $lang, array( 'fr', 'es' ), true ) ? $lang : 'en';
    $name   = esc_html( $visitor_name );
    $cv_url = hdgavi_opt( 'cv_pdf_url', '' );
    $email  = sanitize_email( (string) hdgavi_opt( 'general_email', '' ) );
    $colon  = ( 'fr' === $l ) ? '&nbsp;: ' : ': ';

    if ( $lang === 'fr' ) {
        $title    = hdgavi_email_text( 'email_cv_title_fr', 'Résumé de mon CV' );
        $subtitle = hdgavi_email_text( 'email_cv_subtitle_fr', 'Expérience, projets, compétences et formation' );
        $greeting = 'Bonjour ' . $name . ',';
        $intro    = esc_html( 'Merci pour votre message. Voici un résumé de mon CV' ) . ( $cv_url ? '&nbsp;; ' . esc_html( 'la version complète est disponible en PDF.' ) : '.' );
        $outro    = $email ? esc_html( 'Pour toute question, vous pouvez m’écrire à ' ) . hdgavi_email_link( 'mailto:' . $email, $email ) . '.' : '';
    } elseif ( $lang === 'es' ) {
        $title    = hdgavi_email_text( 'email_cv_title_es', 'Resumen de mi CV' );
        $subtitle = hdgavi_email_text( 'email_cv_subtitle_es', 'Experiencia, proyectos, competencias y formación' );
        $greeting = 'Hola ' . $name . ',';
        $intro    = esc_html( 'Gracias por su mensaje. Este es un resumen de mi CV' ) . ( $cv_url ? esc_html( '; la versión completa está disponible en PDF.' ) : '.' );
        $outro    = $email ? esc_html( 'Si tiene alguna pregunta, puede escribirme a ' ) . hdgavi_email_link( 'mailto:' . $email, $email ) . '.' : '';
    } else {
        $title    = hdgavi_email_text( 'email_cv_title_en', 'Summary of my CV' );
        $subtitle = hdgavi_email_text( 'email_cv_subtitle_en', 'Experience, projects, skills and education' );
        $greeting = 'Hello ' . $name . ',';
        $intro    = esc_html( 'Thank you for your message. Here is a summary of my CV' ) . ( $cv_url ? esc_html( '; the full version is available as a PDF.' ) : '.' );
        $outro    = $email ? esc_html( 'If you have any questions, you can write to me at ' ) . hdgavi_email_link( 'mailto:' . $email, $email ) . '.' : '';
    }

    $labels = array(
        'profile'  => array( 'en' => 'Profile', 'fr' => 'Synthèse', 'es' => 'Perfil' ),
        'previous' => array( 'en' => 'Previous experience', 'fr' => 'Expériences précédentes', 'es' => 'Experiencia anterior' ),
        'projects' => array( 'en' => 'Technical projects', 'fr' => 'Projets techniques', 'es' => 'Proyectos técnicos' ),
    );

    // Profile: the synthesis of the CV.
    $profile = hdgavi_email_p( esc_html( hdgavi_email_pick( hdgavi_cv( 'lead' ), $l ) ), 'font-size:14px;' )
        . hdgavi_email_p( esc_html( hdgavi_email_pick( hdgavi_cv( 'goal' ), $l ) ), 'font-size:14px;margin:0 0 12px;' );

    // Experience: current role in full, previous roles on one line each.
    $exps     = function_exists( 'hdgavi_cv_experiences' ) ? hdgavi_cv_experiences() : array();
    $current  = null;
    $previous = array();
    foreach ( $exps as $exp ) {
        $meta = isset( $exp['meta'] ) ? (array) $exp['meta'] : array();
        if ( null === $current && ! empty( $meta['_exp_featured'] ) ) {
            $current = $meta;
        } else {
            $previous[] = $meta;
        }
    }
    if ( null === $current && $previous ) {
        $current = array_shift( $previous );
    }

    $role_html = '';
    if ( $current ) {
        $where   = implode( ', ', array_filter( array( hdgavi_email_cv_meta( $current, '_exp_company', $l ), hdgavi_email_cv_meta( $current, '_exp_location', $l ) ) ) );
        $period  = hdgavi_email_cv_meta( $current, '_exp_period', $l );
        $bullets = array_filter( array_map( 'trim', explode( "\n", hdgavi_email_cv_meta( $current, '_exp_bullets', $l ) ) ) );
        $role_html = hdgavi_email_entry( hdgavi_email_cv_meta( $current, '_exp_title', $l ), esc_html( $where ) . ( $period ? ' &middot; ' . hdgavi_email_when( $period ) : '' ) )
            . hdgavi_email_list( array_map( 'esc_html', $bullets ) );
        $role_html = hdgavi_email_block( $role_html, 8 );
    }

    $prev_html = '';
    foreach ( $previous as $meta ) {
        $where      = implode( ', ', array_filter( array( hdgavi_email_cv_meta( $meta, '_exp_company', $l ), hdgavi_email_cv_meta( $meta, '_exp_location', $l ) ) ) );
        $period     = hdgavi_email_cv_meta( $meta, '_exp_period', $l );
        $prev_html .= hdgavi_email_block( hdgavi_email_entry( hdgavi_email_cv_meta( $meta, '_exp_title', $l ), esc_html( $where ) . ( $period ? ' &middot; ' . hdgavi_email_when( $period ) : '' ), 14 ), 12 );
    }

    // Projects: title, stack, one-line description, repository.
    $projects  = function_exists( 'hdgavi_cv_projects' ) ? hdgavi_cv_projects() : array();
    $proj_html = '';
    foreach ( $projects as $project ) {
        $meta  = isset( $project['meta'] ) ? (array) $project['meta'] : array();
        $stack = array_filter( array_map( 'trim', explode( ',', hdgavi_email_cv_meta( $meta, '_proj_techs', $l ) ) ) );
        $desc  = hdgavi_email_cv_meta( $meta, '_proj_desc', $l );
        $link  = hdgavi_email_cv_meta( $meta, '_proj_link', $l );
        $html  = '<p style="margin:0;' . hdgavi_email_type( 15, 'ink', 'sans', '1.45' ) . 'font-weight:600;">' . esc_html( hdgavi_email_cv_meta( $meta, '_proj_title', $l ) ) . '</p>'
            . ( $stack ? '<p style="margin:2px 0 0;' . hdgavi_email_type( 12, 'ink_3', 'mono', '1.5' ) . '">' . implode( ' &middot; ', array_map( 'esc_html', $stack ) ) . '</p>' : '' )
            . ( $desc ? '<p style="margin:6px 0 0;' . hdgavi_email_type( 14, 'ink', 'sans', '1.55' ) . '">' . esc_html( $desc ) . '</p>' : '' )
            . ( $link ? '<p style="margin:4px 0 0;' . hdgavi_email_type( 13, 'ink_3', 'sans', '1.5' ) . '">' . hdgavi_email_link( $link, preg_replace( '#^https?://#', '', $link ) ) . '</p>' : '' );
        $proj_html .= hdgavi_email_block( $html, 18 );
    }

    // Skills: the categories of the CV.
    $groups      = function_exists( 'hdgavi_cv_skill_groups' ) ? hdgavi_cv_skill_groups() : array();
    $skills_html = '';
    foreach ( $groups as $group ) {
        $items = isset( $group['items'] ) ? (array) $group['items'] : array();
        if ( ! $items ) {
            continue;
        }
        $skills_html .= '<p style="margin:0 0 6px;' . hdgavi_email_type( 14, 'ink', 'sans', '1.55' ) . '">'
            . '<span style="font-weight:600;">' . esc_html( hdgavi_email_pick( $group, $l ) ) . '</span>' . $colon . esc_html( implode( ', ', $items ) )
            . '</p>';
    }
    if ( $skills_html ) {
        $skills_html = hdgavi_email_block( $skills_html, 8 );
    }

    // Education.
    $educations = function_exists( 'hdgavi_cv_educations' ) ? hdgavi_cv_educations() : array();
    $edu_html   = '';
    foreach ( $educations as $education ) {
        $meta      = isset( $education['meta'] ) ? (array) $education['meta'] : array();
        $period    = hdgavi_email_cv_meta( $meta, '_edu_period', $l );
        $edu_html .= hdgavi_email_block( hdgavi_email_entry( hdgavi_email_cv_meta( $meta, '_edu_degree', $l ), esc_html( hdgavi_email_cv_meta( $meta, '_edu_school', $l ) ) . ( $period ? ' &middot; ' . hdgavi_email_when( $period ) : '' ), 14 ), 12 );
    }

    $languages = hdgavi_email_p( esc_html( hdgavi_email_pick( hdgavi_cv( 'fact_languages' ), $l ) ) . '.', 'font-size:14px;margin:0 0 12px;' );

    $body = hdgavi_email_p( $greeting )
        . hdgavi_email_p( $intro )
        . ( $cv_url ? hdgavi_email_button( $cv_url, hdgavi_email_pick( hdgavi_cv_label( 'download_cv' ), $l ) ) : '' )
        . hdgavi_email_section( hdgavi_email_pick( $labels['profile'], $l ), $profile )
        . ( $role_html ? hdgavi_email_section( hdgavi_email_pick( hdgavi_cv_label( 'current' ), $l ), $role_html ) : '' )
        . ( $prev_html ? hdgavi_email_section( hdgavi_email_pick( $labels['previous'], $l ), $prev_html ) : '' )
        . ( $proj_html ? hdgavi_email_section( hdgavi_email_pick( $labels['projects'], $l ), $proj_html ) : '' )
        . ( $skills_html ? hdgavi_email_section( hdgavi_email_pick( hdgavi_cv_label( 'skills' ), $l ), $skills_html ) : '' )
        . ( $edu_html ? hdgavi_email_section( hdgavi_email_pick( hdgavi_cv_label( 'education' ), $l ), $edu_html ) : '' )
        . hdgavi_email_section( hdgavi_email_pick( hdgavi_cv_label( 'languages' ), $l ), $languages )
        . hdgavi_email_section( '', ( $outro ? hdgavi_email_p( $outro, 'margin:4px 0 0;' ) : '' ) . hdgavi_email_signoff( $l ) );

    $header = hdgavi_email_header( $title, $subtitle );
    $footer = hdgavi_email_footer();
    return hdgavi_email_wrap( $header, $body, $footer );
}

/**
 * Template 4: Welcome first contact (sent to visitor)
 */
function hdgavi_email_welcome( $visitor_name ) {
    $lang   = hdgavi_opt( 'default_lang', 'en' );
    $l      = in_array( $lang, array( 'fr', 'es' ), true ) ? $lang : 'en';
    $name   = esc_html( $visitor_name );
    $lead   = esc_html( hdgavi_email_pick( hdgavi_cv( 'lead' ), $l ) );
    $goal   = esc_html( hdgavi_email_pick( hdgavi_cv( 'goal' ), $l ) );
    $site   = hdgavi_email_link( home_url( '/' ), hdgavi_email_site_label() );
    $cv_url = hdgavi_opt( 'cv_pdf_url', '' );

    if ( $lang === 'fr' ) {
        $title    = hdgavi_email_text( 'email_welcome_title_fr', 'Quelques mots de présentation' );
        $subtitle = hdgavi_email_text( 'email_welcome_subtitle_fr', '' );
        $cv       = $cv_url ? esc_html( ', et mon CV est disponible ' ) . hdgavi_email_link( $cv_url, 'en PDF' ) : '';
        $body     = hdgavi_email_p( 'Bonjour ' . $name . ',' )
            . hdgavi_email_p( esc_html( 'Merci pour votre premier message. Voici en quelques lignes qui je suis.' ) )
            . hdgavi_email_p( $lead )
            . hdgavi_email_p( esc_html( 'En parallèle, je prépare le Mastère Cybersécurité & Cloud Computing de l’IPSSI (2024 – 2026). ' ) . $goal )
            . hdgavi_email_p( esc_html( 'Le détail de mon expérience et de mes projets se trouve sur ' ) . $site . $cv . '. ' . esc_html( 'Je réponds à votre message dès que possible.' ) )
            . hdgavi_email_signoff( 'fr' );
    } elseif ( $lang === 'es' ) {
        $title    = hdgavi_email_text( 'email_welcome_title_es', 'Una breve presentación' );
        $subtitle = hdgavi_email_text( 'email_welcome_subtitle_es', '' );
        $cv       = $cv_url ? esc_html( ', y mi CV está disponible ' ) . hdgavi_email_link( $cv_url, 'en PDF' ) : '';
        $body     = hdgavi_email_p( 'Hola ' . $name . ',' )
            . hdgavi_email_p( esc_html( 'Gracias por su primer mensaje. Le presento brevemente mi perfil.' ) )
            . hdgavi_email_p( $lead )
            . hdgavi_email_p( esc_html( 'Paralelamente, preparo el Mastère en Ciberseguridad y Cloud Computing de IPSSI (2024 – 2026). ' ) . $goal )
            . hdgavi_email_p( esc_html( 'El detalle de mi experiencia y de mis proyectos está en ' ) . $site . $cv . '. ' . esc_html( 'Responderé a su mensaje lo antes posible.' ) )
            . hdgavi_email_signoff( 'es' );
    } else {
        $title    = hdgavi_email_text( 'email_welcome_title_en', 'A short introduction' );
        $subtitle = hdgavi_email_text( 'email_welcome_subtitle_en', '' );
        $cv       = $cv_url ? esc_html( ', and my CV is available ' ) . hdgavi_email_link( $cv_url, 'as a PDF' ) : '';
        $body     = hdgavi_email_p( 'Hello ' . $name . ',' )
            . hdgavi_email_p( esc_html( 'Thank you for your first message. Here is a short introduction.' ) )
            . hdgavi_email_p( $lead )
            . hdgavi_email_p( esc_html( 'Alongside this work, I am preparing the Mastère in Cybersecurity & Cloud Computing at IPSSI (2024 – 2026). ' ) . $goal )
            . hdgavi_email_p( esc_html( 'My experience and projects are described on ' ) . $site . $cv . '. ' . esc_html( 'I will reply to your message as soon as possible.' ) )
            . hdgavi_email_signoff( 'en' );
    }

    $header = hdgavi_email_header( $title, $subtitle );
    $footer = hdgavi_email_footer();
    return hdgavi_email_wrap( $header, $body, $footer );
}

/**
 * Notification to the owner built from label / value rows (booking, quote, maintenance).
 */
function hdgavi_email_admin_message( $title, $subtitle, $rows, $message_label = '', $message = '', $source = '' ) {
    $body = hdgavi_email_rows( $rows ) . ( '' !== (string) $message ? hdgavi_email_message( $message_label, $message ) : '' );
    return hdgavi_email_wrap( hdgavi_email_header( $title, $subtitle ), $body, hdgavi_email_admin_footer( $source ) );
}

/**
 * Acknowledgement sent to the visitor after the booking form.
 * @return array( 'subject' => string, 'html' => string )
 */
function hdgavi_email_booking_ack( $visitor_name, $date, $time, $site_name ) {
    $l = hdgavi_email_lang();
    $t = array(
        'en' => array( 'title' => 'Meeting request received', 'sub' => 'I will confirm the time slot by e-mail.', 'hello' => 'Hello', 'text' => 'Your meeting request has been received', 'at' => ' at ', 'colon' => ': ' ),
        'fr' => array( 'title' => 'Demande de rendez-vous reçue', 'sub' => 'Je vous confirmerai le créneau par e-mail.', 'hello' => 'Bonjour', 'text' => 'Votre demande de rendez-vous a bien été reçue', 'at' => ' à ', 'colon' => '&nbsp;: ' ),
        'es' => array( 'title' => 'Solicitud de cita recibida', 'sub' => 'Le confirmaré la cita por correo electrónico.', 'hello' => 'Hola', 'text' => 'Su solicitud de cita se ha recibido', 'at' => ' a las ', 'colon' => ': ' ),
    );
    $t    = $t[ $l ];
    $slot = ( $date && $time ) ? $date . $t['at'] . $time : ( $date ? $date : $time );
    $body = hdgavi_email_p( esc_html( $t['hello'] . ' ' . $visitor_name ) . ',' )
        . hdgavi_email_p( esc_html( $t['text'] ) . ( '' !== (string) $slot ? $t['colon'] . '<strong>' . esc_html( $slot ) . '</strong>' : '' ) . '.' )
        . hdgavi_email_signoff( $l )
        . hdgavi_email_auto_note( $l );

    return array(
        'subject' => $t['title'] . ' — ' . $site_name,
        'html'    => hdgavi_email_wrap( hdgavi_email_header( $t['title'], $t['sub'] ), $body, hdgavi_email_footer() ),
    );
}

/**
 * Acknowledgement sent to the visitor after the quote form.
 * @return array( 'subject' => string, 'html' => string )
 */
function hdgavi_email_quote_ack( $visitor_name, $service_label, $site_name ) {
    $l = hdgavi_email_lang();
    $t = array(
        'en' => array( 'title' => 'Quote request received', 'sub' => 'I will reply by e-mail.', 'hello' => 'Hello', 'about' => 'Your request about %s has been received.', 'plain' => 'Your request has been received.' ),
        'fr' => array( 'title' => 'Demande de devis reçue', 'sub' => 'Je vous répondrai par e-mail.', 'hello' => 'Bonjour', 'about' => 'Votre demande concernant %s a bien été reçue.', 'plain' => 'Votre demande a bien été reçue.' ),
        'es' => array( 'title' => 'Solicitud de presupuesto recibida', 'sub' => 'Le responderé por correo electrónico.', 'hello' => 'Hola', 'about' => 'Su solicitud sobre %s se ha recibido.', 'plain' => 'Su solicitud se ha recibido.' ),
    );
    $t    = $t[ $l ];
    $line = '' !== (string) $service_label ? sprintf( esc_html( $t['about'] ), '<strong>' . esc_html( $service_label ) . '</strong>' ) : esc_html( $t['plain'] );
    $body = hdgavi_email_p( esc_html( $t['hello'] . ' ' . $visitor_name ) . ',' )
        . hdgavi_email_p( $line )
        . hdgavi_email_signoff( $l )
        . hdgavi_email_auto_note( $l );

    return array(
        'subject' => $t['title'] . ' — ' . $site_name,
        'html'    => hdgavi_email_wrap( hdgavi_email_header( $t['title'], $t['sub'] ), $body, hdgavi_email_footer() ),
    );
}

/* ---------------------------------------------------------------------------
   4. CONTACT FORM HANDLER (replaces ajax-contact)
   --------------------------------------------------------------------------- */

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
    $rows = array(
        array( 'Name', '<strong>' . esc_html( $name ) . '</strong>' ),
        array( 'E-mail', hdgavi_email_link( 'mailto:' . $email, $email ) ),
        array( 'Date', esc_html( $date ) ),
        array( 'Time', esc_html( $time ) ),
    );
    if ( $message ) {
        $rows[] = array( 'Topic', nl2br( esc_html( $message ) ) );
    }
    $rows[] = array( 'IP', hdgavi_email_mono( $ip ) );
    $body   = hdgavi_email_admin_message( 'Meeting request', 'Sent through the booking form on the site.', $rows, '', '', 'Booking form' );

    $subject = '[Portfolio] Booking request from ' . $name;
    $success = wp_mail( $admin_email, $subject, $body, $html_headers );
    hdgavi_log_mail( $admin_email, $subject, $success );

    // Confirmation to visitor
    $ack            = hdgavi_email_booking_ack( $name, $date, $time, $site_name );
    $confirm_result = wp_mail( $email, $ack['subject'], $ack['html'], array( 'Content-Type: text/html; charset=UTF-8' ) );
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

    $rows = array(
        array( 'Name', '<strong>' . esc_html( $name ) . '</strong>' ),
        array( 'E-mail', hdgavi_email_link( 'mailto:' . $email, $email ) ),
    );
    if ( $company ) {
        $rows[] = array( 'Company', esc_html( $company ) );
    }
    $rows[] = array( 'Service', '<strong>' . esc_html( $service_label ) . '</strong>' );
    $rows[] = array( 'IP', hdgavi_email_mono( $ip ) );
    $body   = hdgavi_email_admin_message( 'Quote request', 'Sent through the quote form on the site.', $rows, 'Project description', $message, 'Quote form' );

    $subject = '[Portfolio] Quote request — ' . $service_label . ' — ' . $name;
    $success = wp_mail( $admin_email, $subject, $body, $html_headers );
    hdgavi_log_mail( $admin_email, $subject, $success );

    // Confirmation to visitor
    $ack            = hdgavi_email_quote_ack( $name, $service_label, $site_name );
    $confirm_result = wp_mail( $email, $ack['subject'], $ack['html'], array( 'Content-Type: text/html; charset=UTF-8' ) );
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

    $rows = array(
        array( 'Name', '<strong>' . esc_html( $name ) . '</strong>' ),
        array( 'E-mail', hdgavi_email_link( 'mailto:' . $email, $email ) ),
        array( 'IP', hdgavi_email_mono( $ip ) ),
    );
    $body = hdgavi_email_admin_message( 'Message from the maintenance page', 'Sent while the site was in maintenance mode.', $rows, 'Message', $message, 'Maintenance page' );

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
    $l         = in_array( $lang, array( 'fr', 'es' ), true ) ? $lang : 'en';

    $html_headers = array( 'Content-Type: text/html; charset=UTF-8' );

    // Confirmation
    $confirm_subject = hdgavi_email_pick( array(
        'en' => hdgavi_email_text( 'email_confirm_subject_en', 'Message received — ' . $site_name ),
        'fr' => hdgavi_email_text( 'email_confirm_subject_fr', 'Message reçu — ' . $site_name ),
        'es' => hdgavi_email_text( 'email_confirm_subject_es', 'Mensaje recibido — ' . $site_name ),
    ), $l );
    hdgavi_log_mail( $email, $confirm_subject, wp_mail( $email, $confirm_subject, hdgavi_email_confirmation( $name ), $html_headers ) );

    // Welcome (first contact only — disabled by default for GDPR compliance)
    if ( $is_first && hdgavi_opt( 'email_welcome_enabled', false ) ) {
        $welcome_subject = hdgavi_email_pick( array(
            'en' => hdgavi_email_text( 'email_welcome_subject_en', 'Introduction — ' . $site_name ),
            'fr' => hdgavi_email_text( 'email_welcome_subject_fr', 'Présentation — ' . $site_name ),
            'es' => hdgavi_email_text( 'email_welcome_subject_es', 'Presentación — ' . $site_name ),
        ), $l );
        hdgavi_log_mail( $email, $welcome_subject, wp_mail( $email, $welcome_subject, hdgavi_email_welcome( $name ), $html_headers ) );
    }

    // Mini CV (disabled by default for GDPR compliance)
    if ( hdgavi_opt( 'email_cv_enabled', false ) ) {
        $cv_subject = hdgavi_email_pick( array(
            'en' => hdgavi_email_text( 'email_cv_subject_en', 'Summary of my CV — ' . $site_name ),
            'fr' => hdgavi_email_text( 'email_cv_subject_fr', 'Résumé de mon CV — ' . $site_name ),
            'es' => hdgavi_email_text( 'email_cv_subject_es', 'Resumen de mi CV — ' . $site_name ),
        ), $l );
        hdgavi_log_mail( $email, $cv_subject, wp_mail( $email, $cv_subject, hdgavi_email_minicv( $name ), $html_headers ) );
    }
}
add_action( 'hdgavi_send_followup_emails', 'hdgavi_do_send_followup_emails' );

/* ---------------------------------------------------------------------------
   5. WP MAIL SMTP CONFIGURATION HELPER
   --------------------------------------------------------------------------- */

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
