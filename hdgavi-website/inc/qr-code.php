<?php
/**
 * HD GAVI Portfolio — QR Code Generator (pure PHP SVG)
 * Uses goqr.me API (Google Charts API is deprecated/shutdown).
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Generate QR code image URL via goqr.me API
 */
function hdgavi_qr_code_url( $data = '', $size = 200 ) {
    if ( empty( $data ) ) {
        $data = home_url( '/' );
    }
    return 'https://api.qrserver.com/v1/create-qr-code/?size=' . intval( $size ) . 'x' . intval( $size ) . '&data=' . urlencode( $data ) . '&format=png&margin=8';
}

/**
 * Render QR code block (used on contact page)
 */
function hdgavi_render_qr_block() {
    if ( ! hdgavi_opt( 'show_qr_code', true ) ) return;
    $url  = hdgavi_opt( 'qr_code_url', home_url( '/' ) );
    $size = intval( hdgavi_opt( 'qr_code_size', 180 ) );
    $qr_src = hdgavi_qr_code_url( $url, $size );
    ?>
    <div class="qr-block fade-up">
        <div class="qr-image">
            <img src="<?php echo esc_url( $qr_src ); ?>" alt="QR Code — <?php echo esc_attr( $url ); ?>" width="<?php echo esc_attr( $size ); ?>" height="<?php echo esc_attr( $size ); ?>" loading="lazy">
        </div>
        <p class="qr-label">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_qr_text_en', 'Scan to visit my portfolio' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_qr_text_fr', 'Scannez pour visiter mon portfolio' ) ); ?></span>
        </p>
        <a href="<?php echo esc_url( $qr_src ); ?>" class="qr-download" download="hdgavi-qr-code.png" target="_blank">
            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_qr_download_en', 'Download QR' ) ); ?></span>
            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_qr_download_fr', 'Télécharger le QR' ) ); ?></span>
        </a>
    </div>
    <?php
}
