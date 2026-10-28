<?php
/**
 * HD GAVI Portfolio — vCard Generator
 * Outputs a .vcf file for download via AJAX or direct URL
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

    $name     = hdgavi_opt( 'general_name', 'Holali David GAVI' );
    $email    = hdgavi_opt( 'general_email', '' );
    $location = hdgavi_opt( 'general_location', '' );
    $github   = hdgavi_opt( 'contact_github', '' );
    $linkedin = hdgavi_opt( 'contact_linkedin', '' );
    $badge_en = hdgavi_opt( 'about_badge_en', '' );
    $site_url = home_url( '/' );
    $phone    = hdgavi_opt( 'contact_phone', '' );

    // Split name
    $parts = explode( ' ', trim( $name ) );
    $last  = array_pop( $parts );
    $first = implode( ' ', $parts );

    header( 'Content-Type: text/vcard; charset=UTF-8' );
    header( 'Content-Disposition: attachment; filename="' . sanitize_file_name( $name ) . '.vcf"' );

    $vcf  = "BEGIN:VCARD\r\n";
    $vcf .= "VERSION:3.0\r\n";
    $vcf .= "N:" . hdgavi_vcard_escape( $last ) . ";" . hdgavi_vcard_escape( $first ) . ";;;\r\n";
    $vcf .= "FN:" . hdgavi_vcard_escape( $name ) . "\r\n";

    if ( $badge_en ) {
        $vcf .= "TITLE:" . hdgavi_vcard_escape( $badge_en ) . "\r\n";
    }
    if ( $email ) {
        $vcf .= "EMAIL;TYPE=INTERNET:" . hdgavi_vcard_escape( $email ) . "\r\n";
    }
    if ( $phone ) {
        $vcf .= "TEL;TYPE=CELL:" . hdgavi_vcard_escape( $phone ) . "\r\n";
    }
    if ( $location ) {
        $vcf .= "ADR;TYPE=HOME:;;" . hdgavi_vcard_escape( $location ) . ";;;;\r\n";
    }
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
add_action( 'template_redirect', 'hdgavi_vcard_render' );

/**
 * Escape vCard special characters
 */
function hdgavi_vcard_escape( $str ) {
    return str_replace( array( '\\', ';', ',', "\n" ), array( '\\\\', '\\;', '\\,', '\\n' ), $str );
}

/**
 * Render vCard download button (for contact page)
 */
function hdgavi_render_vcard_button() {
    if ( ! hdgavi_opt( 'show_vcard', true ) ) return;
    ?>
    <a href="<?php echo esc_url( home_url( '/contact.vcf' ) ); ?>" class="vcard-btn" download>
        <?php echo hdgavi_icon( 'user', 16 ); ?>
        <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_vcard_btn_en', 'Save contact' ) ); ?></span>
        <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_vcard_btn_fr', 'Enregistrer le contact' ) ); ?></span>
    </a>
    <?php
}
