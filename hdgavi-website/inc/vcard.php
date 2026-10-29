<?php
/**
 * HD GAVI Portfolio — vCard Generator
 * Outputs a .vcf file (vCard 3.0) at /contact.vcf (or ?hdgavi_vcard=1) with the CV contact data:
 * name, title, employer, address, e-mail, phone (if set), site, GitHub and LinkedIn.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Register rewrite for /contact.vcf
 */
function hdgavi_vcard_rewrite() {
    add_rewrite_rule( 'contact\.vcf$', 'index.php?hdgavi_vcard=1', 'top' );
}
add_action( 'init', 'hdgavi_vcard_rewrite' );

function hdgavi_vcard_query_var( $vars ) {
    $vars[] = 'hdgavi_vcard';
    return $vars;
}
add_filter( 'query_vars', 'hdgavi_vcard_query_var' );

/**
 * Output vCard file
 */
function hdgavi_vcard_render() {
    if ( ! get_query_var( 'hdgavi_vcard' ) ) return;
    if ( ! hdgavi_opt( 'show_vcard', true ) ) {
        status_header( 404 );
        exit;
    }

    $name     = trim( (string) hdgavi_opt( 'general_name', 'Holali David GAVI' ) );
    $email    = hdgavi_opt( 'general_email', '' );
    $phone    = hdgavi_opt( 'contact_phone', '' );
    $github   = hdgavi_opt( 'contact_github', '' );
    $linkedin = hdgavi_opt( 'contact_linkedin', '' );
    $company  = trim( (string) hdgavi_opt( 'seo_company', 'Dassault Systèmes' ) );
    $site_url = home_url( '/' );

    // Job title from the CV (Customizer "Contenu du CV" > Intitulé du poste, EN)
    $title = 'DevOps / Cloud Native Engineer';
    if ( function_exists( 'hdgavi_cv' ) ) {
        $role = hdgavi_cv( 'role' );
        if ( ! empty( $role['en'] ) ) $title = $role['en'];
    }

    // Postal address from the CV location (inc/seo.php)
    $addr = function_exists( 'hdgavi_postal_address' ) ? hdgavi_postal_address() : array(
        'locality'    => 'Aubervilliers',
        'postal_code' => '93300',
        'region'      => 'Île-de-France',
        'country'     => 'France',
    );

    // Split name: "Holali David GAVI" -> given "Holali David", family "GAVI"
    $parts = explode( ' ', $name );
    $last  = array_pop( $parts );
    $first = implode( ' ', $parts );

    header( 'Content-Type: text/vcard; charset=UTF-8' );
    header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $name ) . '.vcf"' );

    $vcf  = "BEGIN:VCARD\r\n";
    $vcf .= "VERSION:3.0\r\n";
    $vcf .= "N:" . hdgavi_vcard_escape( $last ) . ";" . hdgavi_vcard_escape( $first ) . ";;;\r\n";
    $vcf .= "FN:" . hdgavi_vcard_escape( $name ) . "\r\n";
    $vcf .= "TITLE:" . hdgavi_vcard_escape( $title ) . "\r\n";
    if ( '' !== $company ) {
        $vcf .= "ORG:" . hdgavi_vcard_escape( $company ) . "\r\n";
    }
    if ( $email ) {
        $vcf .= "EMAIL;TYPE=INTERNET:" . hdgavi_vcard_escape( $email ) . "\r\n";
    }
    if ( $phone ) {
        $vcf .= "TEL;TYPE=CELL:" . hdgavi_vcard_escape( $phone ) . "\r\n";
    }
    // ADR: PO box; extended; street; locality; region; postal code; country
    $vcf .= "ADR;TYPE=HOME:;;;" . hdgavi_vcard_escape( $addr['locality'] ) . ";" . hdgavi_vcard_escape( $addr['region'] )
        . ";" . hdgavi_vcard_escape( $addr['postal_code'] ) . ";" . hdgavi_vcard_escape( $addr['country'] ) . "\r\n";
    if ( $site_url ) {
        $vcf .= "URL:" . hdgavi_vcard_escape( $site_url ) . "\r\n";
    }
    if ( $github ) {
        $vcf .= "X-SOCIALPROFILE;TYPE=github:" . hdgavi_vcard_escape( $github ) . "\r\n";
    }
    if ( $linkedin ) {
        $vcf .= "X-SOCIALPROFILE;TYPE=linkedin:" . hdgavi_vcard_escape( $linkedin ) . "\r\n";
    }

    $vcf .= "REV:" . gmdate( 'Ymd\THis\Z' ) . "\r\n";
    $vcf .= "END:VCARD\r\n";

    echo $vcf;
    exit;
}
// Priority 5: after the maintenance check (1, which lets the vCard through) and before
// redirect_canonical (10), which would otherwise add a trailing slash to /contact.vcf.
add_action( 'template_redirect', 'hdgavi_vcard_render', 5 );

/**
 * Escape vCard special characters
 */
function hdgavi_vcard_escape( $str ) {
    return str_replace( array( '\\', ';', ',', "\r\n", "\n" ), array( '\\\\', '\\;', '\\,', '\\n', '\\n' ), (string) $str );
}

/**
 * Render vCard download button (for contact page)
 */
function hdgavi_render_vcard_button() {
    if ( ! hdgavi_opt( 'show_vcard', true ) ) return;
    ?>
    <a href="<?php echo esc_url( home_url( '/contact.vcf' ) ); ?>" class="vcard-btn" download>
        <?php echo hdgavi_icon( 'download', 16 ); ?>
        <?php echo hdgavi_tri(
            hdgavi_opt( 'label_vcard_btn_en', 'Save the contact card (vCard)' ),
            hdgavi_opt( 'label_vcard_btn_fr', 'Enregistrer la fiche contact (vCard)' ),
            hdgavi_opt( 'label_vcard_btn_es', 'Guardar la tarjeta de contacto (vCard)' )
        ); ?>
    </a>
    <?php
}
