<?php
/**
 * HD GAVI Portfolio — QR code of the site (image from api.qrserver.com)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * QR code image URL (api.qrserver.com; the Google Charts API is shut down)
 */
function hdgavi_qr_code_url( $data = '', $size = 200 ) {
    if ( empty( $data ) ) {
        $data = home_url( '/' );
    }
    return 'https://api.qrserver.com/v1/create-qr-code/?size=' . intval( $size ) . 'x' . intval( $size ) . '&data=' . urlencode( $data ) . '&format=png&margin=8';
}

/**
 * Render the QR code block (contact page)
 */
function hdgavi_render_qr_block() {
    if ( ! hdgavi_opt( 'show_qr_code', true ) ) return;
    $url    = hdgavi_opt( 'qr_code_url', home_url( '/' ) );
    $size   = intval( hdgavi_opt( 'qr_code_size', 180 ) );
    $qr_src = hdgavi_qr_code_url( $url, $size );
    ?>
    <div class="qr-block">
        <div class="qr-image">
            <img src="<?php echo esc_url( $qr_src ); ?>" alt="QR code: <?php echo esc_attr( $url ); ?>" width="<?php echo esc_attr( $size ); ?>" height="<?php echo esc_attr( $size ); ?>" loading="lazy" decoding="async">
        </div>
        <p class="qr-label"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_qr_text', 'QR code of this site', 'QR code de ce site', 'Código QR de este sitio' ) ); ?></p>
        <a href="<?php echo esc_url( $qr_src ); ?>" class="qr-download" download="hdgavi-qr-code.png" target="_blank" rel="noopener"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_qr_download', 'Download the QR code', 'Télécharger le QR code', 'Descargar el código QR' ) ); ?></a>
    </div>
    <?php
}
