<?php
/**
 * HD GAVI Portfolio — CV Downloads Admin Dashboard
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Sanitize a CSV cell to prevent formula injection in Excel
 */
function hdgavi_csv_safe( $value ) {
    if ( isset( $value[0] ) && in_array( $value[0], array( '=', '+', '-', '@', "\t", "\r" ), true ) ) {
        return "'" . $value;
    }
    return $value;
}

function hdgavi_cv_admin_menu() {
    add_theme_page(
        'CV Downloads',
        'CV Downloads',
        'edit_pages',
        'hdgavi-cv-downloads',
        'hdgavi_cv_downloads_render'
    );
}
add_action( 'admin_menu', 'hdgavi_cv_admin_menu' );

function hdgavi_cv_downloads_render() {
    if ( ! current_user_can( 'edit_pages' ) ) return;
    global $wpdb;
    $table = $wpdb->prefix . 'hdgavi_cv_downloads';

    // Pagination
    $per_page = 20;
    $page     = max( 1, intval( $_GET['paged'] ?? 1 ) );
    $offset   = ( $page - 1 ) * $per_page;
    $total    = (int) $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}hdgavi_cv_downloads" );
    $pages    = ceil( $total / $per_page );

    // Stats
    $today = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table WHERE created_at >= %s",
        wp_date( 'Y-m-d 00:00:00' )
    ) );
    $week = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table WHERE created_at >= %s",
        wp_date( 'Y-m-d 00:00:00', strtotime( '-7 days' ) )
    ) );
    $month = $wpdb->get_var( $wpdb->prepare(
        "SELECT COUNT(*) FROM $table WHERE created_at >= %s",
        wp_date( 'Y-m-01 00:00:00' )
    ) );

    // Data
    $rows = $wpdb->get_results( $wpdb->prepare(
        "SELECT * FROM $table ORDER BY created_at DESC LIMIT %d OFFSET %d",
        $per_page, $offset
    ) );

    ?>
    <div class="wrap">
        <h1>📄 CV Downloads</h1>

        <div style="display:flex;gap:16px;margin:20px 0;flex-wrap:wrap">
            <div class="card" style="padding:16px 24px;min-width:120px">
                <h2 style="margin:0;font-size:2rem;color:#06B6D4"><?php echo esc_html( $total ); ?></h2>
                <p style="margin:4px 0 0;color:#666">Total</p>
            </div>
            <div class="card" style="padding:16px 24px;min-width:120px">
                <h2 style="margin:0;font-size:2rem;color:#22C55E"><?php echo esc_html( $today ); ?></h2>
                <p style="margin:4px 0 0;color:#666">Today</p>
            </div>
            <div class="card" style="padding:16px 24px;min-width:120px">
                <h2 style="margin:0;font-size:2rem;color:#F59E0B"><?php echo esc_html( $week ); ?></h2>
                <p style="margin:4px 0 0;color:#666">This week</p>
            </div>
            <div class="card" style="padding:16px 24px;min-width:120px">
                <h2 style="margin:0;font-size:2rem;color:#8B5CF6"><?php echo esc_html( $month ); ?></h2>
                <p style="margin:4px 0 0;color:#666">This month</p>
            </div>
            <div class="card" style="padding:16px 24px;display:flex;align-items:center">
                <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin-ajax.php?action=hdgavi_cv_export_csv' ), 'hdgavi_cv_export' ) ); ?>"
                   class="button button-secondary">⬇ Export CSV</a>
            </div>
        </div>

        <?php if ( $rows ) : ?>
        <table class="widefat striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Reason</th>
                    <th>Lang</th>
                    <th>IP</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ( $rows as $row ) : ?>
                <tr>
                    <td><?php echo esc_html( $row->name ); ?></td>
                    <td><a href="mailto:<?php echo esc_attr( $row->email ); ?>"><?php echo esc_html( $row->email ); ?></a></td>
                    <td><?php echo esc_html( $row->role ); ?></td>
                    <td><?php echo esc_html( ucfirst( $row->reason ) ); ?></td>
                    <td><?php echo esc_html( strtoupper( $row->lang ) ); ?></td>
                    <td><code><?php echo esc_html( $row->ip_address ); ?></code></td>
                    <td><?php echo esc_html( wp_date( 'M j, Y H:i', strtotime( $row->created_at ) ) ); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <?php if ( $pages > 1 ) : ?>
        <div class="tablenav bottom">
            <div class="tablenav-pages">
                <?php
                echo paginate_links( array(
                    'base'    => add_query_arg( 'paged', '%#%' ),
                    'format'  => '',
                    'current' => $page,
                    'total'   => $pages,
                ) );
                ?>
            </div>
        </div>
        <?php endif; ?>

        <?php else : ?>
        <p style="margin-top:20px;color:#666">No CV downloads yet.</p>
        <?php endif; ?>
    </div>
    <?php
}

/* ═══════════════════════════════════════
   CSV EXPORT
   ═══════════════════════════════════════ */

function hdgavi_cv_export_csv() {
    if ( ! current_user_can( 'edit_pages' ) ) wp_die( 'Unauthorized' );
    check_admin_referer( 'hdgavi_cv_export' );

    global $wpdb;
    $table = $wpdb->prefix . 'hdgavi_cv_downloads';
    // phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared -- $table is safe (prefix + hardcoded string)
    $rows  = $wpdb->get_results( $wpdb->prepare( "SELECT name, email, role, reason, lang, ip_address, created_at FROM {$wpdb->prefix}hdgavi_cv_downloads ORDER BY created_at DESC LIMIT %d", 10000 ) );

    header( 'Content-Type: text/csv; charset=UTF-8' );
    header( 'Content-Disposition: attachment; filename="cv-downloads-' . wp_date( 'Y-m-d' ) . '.csv"' );
    header( 'Pragma: no-cache' );

    $out = fopen( 'php://output', 'w' );
    fprintf( $out, chr( 0xEF ) . chr( 0xBB ) . chr( 0xBF ) ); // UTF-8 BOM for Excel
    fputcsv( $out, array( 'Name', 'Email', 'Role', 'Reason', 'Lang', 'IP', 'Date' ) );

    foreach ( $rows as $row ) {
        fputcsv( $out, array_map( 'hdgavi_csv_safe', array(
            $row->name,
            $row->email,
            $row->role,
            ucfirst( $row->reason ),
            strtoupper( $row->lang ),
            $row->ip_address,
            $row->created_at,
        ) ) );
    }

    fclose( $out );
    exit;
}
add_action( 'wp_ajax_hdgavi_cv_export_csv', 'hdgavi_cv_export_csv' );
