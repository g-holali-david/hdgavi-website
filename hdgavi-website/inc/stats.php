<?php
/**
 * HD GAVI Portfolio — Visitor Stats (v6.2.0)
 * Privacy-friendly: HMAC-SHA256 hashed IPs, batch writes, no cookies
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_track_visit() {
	if ( is_admin() || wp_doing_ajax() || defined( 'DOING_CRON' ) ) return;
	if ( ! hdgavi_opt( 'stats_enabled', true ) ) return;

	$ua = isset( $_SERVER['HTTP_USER_AGENT'] ) ? strtolower( $_SERVER['HTTP_USER_AGENT'] ) : '';
	if ( preg_match( '/bot|crawl|spider|slurp|curl|wget|python|java|fetch/i', $ua ) ) return;

	$today  = current_time( 'Y-m-d' );
	$ip     = hdgavi_get_client_ip();
	$secret = wp_salt( 'auth' );
	$hash   = hash_hmac( 'sha256', $ip . $today, $secret );

	// Batch buffer to avoid DB write on every request
	$buffer_key = 'hdgavi_stats_buffer';
	$buffer     = get_transient( $buffer_key );
	if ( ! is_array( $buffer ) ) {
		$buffer = array( 'count' => 0, 'entries' => array() );
	}

	$buffer['count']++;
	$buffer['entries'][] = array( 'date' => $today, 'hash' => $hash );

	// Flush to DB if buffer reaches 10 entries or on first visit
	if ( $buffer['count'] >= 10 ) {
		hdgavi_flush_stats_buffer( $buffer['entries'] );
		delete_transient( $buffer_key );
	} else {
		set_transient( $buffer_key, $buffer, 300 ); // flush every 5 min max
	}
}
add_action( 'wp', 'hdgavi_track_visit' );

/**
 * Flush buffered stats entries to the main option
 */
function hdgavi_flush_stats_buffer( $entries = null ) {
	if ( null === $entries ) {
		$buffer = get_transient( 'hdgavi_stats_buffer' );
		if ( ! is_array( $buffer ) || empty( $buffer['entries'] ) ) return;
		$entries = $buffer['entries'];
		delete_transient( 'hdgavi_stats_buffer' );
	}

	$stats  = get_option( 'hdgavi_stats', array() );
	$cutoff = wp_date( 'Y-m-d', strtotime( '-90 days' ) );

	foreach ( $entries as $entry ) {
		$date = $entry['date'];
		$hash = $entry['hash'];

		if ( ! isset( $stats[ $date ] ) ) {
			$stats[ $date ] = array( 'views' => 0, 'uniques' => array() );
		}
		$stats[ $date ]['views']++;
		if ( ! isset( $stats[ $date ]['uniques'][ $hash ] ) ) {
			$stats[ $date ]['uniques'][ $hash ] = 1;
		}
	}

	// Keep only last 90 days
	foreach ( array_keys( $stats ) as $date ) {
		if ( $date < $cutoff ) unset( $stats[ $date ] );
	}

	update_option( 'hdgavi_stats', $stats, false );
}

// Flush remaining buffer on shutdown via cron-like fallback
function hdgavi_flush_stats_on_shutdown() {
	if ( is_admin() || wp_doing_ajax() ) return;
	$buffer = get_transient( 'hdgavi_stats_buffer' );
	if ( is_array( $buffer ) && ! empty( $buffer['entries'] ) && $buffer['count'] >= 5 ) {
		hdgavi_flush_stats_buffer( $buffer['entries'] );
		delete_transient( 'hdgavi_stats_buffer' );
	}
}
add_action( 'shutdown', 'hdgavi_flush_stats_on_shutdown' );

/**
 * Get stats summary
 */
function hdgavi_get_stats() {
	$stats = get_option( 'hdgavi_stats', array() );
	$today = current_time( 'Y-m-d' );

	$total_views   = 0;
	$total_uniques = 0;
	$today_views   = 0;
	$today_uniques = 0;
	$week_views    = 0;
	$month_views   = 0;

	$week_ago  = wp_date( 'Y-m-d', strtotime( '-7 days' ) );
	$month_ago = wp_date( 'Y-m-d', strtotime( '-30 days' ) );

	foreach ( $stats as $date => $data ) {
		$views   = intval( $data['views'] );
		$uniques = is_array( $data['uniques'] ) ? count( $data['uniques'] ) : 0;
		$total_views   += $views;
		$total_uniques += $uniques;

		if ( $date === $today ) {
			$today_views   = $views;
			$today_uniques = $uniques;
		}
		if ( $date >= $week_ago )  $week_views  += $views;
		if ( $date >= $month_ago ) $month_views += $views;
	}

	return array(
		'total_views'   => $total_views,
		'total_uniques' => $total_uniques,
		'today_views'   => $today_views,
		'today_uniques' => $today_uniques,
		'week_views'    => $week_views,
		'month_views'   => $month_views,
		'days_tracked'  => count( $stats ),
	);
}

function hdgavi_footer_stats() {
	if ( ! hdgavi_opt( 'stats_show_counter', false ) ) return;
	$s = hdgavi_get_stats();
	echo '<div class="footer-stats" style="text-align:center;padding:8px 0;font-size:0.7rem;color:var(--text-tertiary);font-family:var(--font-mono)">';
	echo esc_html( number_format( $s['total_views'] ) ) . ' views · ';
	echo esc_html( number_format( $s['total_uniques'] ) ) . ' visitors';
	echo '</div>';
}
add_action( 'wp_footer', 'hdgavi_footer_stats' );
