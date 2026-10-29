<?php
/**
 * HD GAVI Portfolio — Security hardening (v6.2.0)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

// Remove WordPress version from head
remove_action( 'wp_head', 'wp_generator' );

// Remove WLW manifest
remove_action( 'wp_head', 'wlwmanifest_link' );

// Remove RSD link
remove_action( 'wp_head', 'rsd_link' );

// Disable XML-RPC
add_filter( 'xmlrpc_enabled', '__return_false' );

/**
 * Remove version from scripts/styles — but NOT theme assets (they use MD5 hash for cache-busting)
 */
function hdgavi_remove_version_strings( $src ) {
	if ( strpos( $src, 'hdgavi-portfolio' ) !== false ) {
		return $src;
	}
	if ( strpos( $src, 'ver=' ) ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'hdgavi_remove_version_strings', 999 );
add_filter( 'script_loader_src', 'hdgavi_remove_version_strings', 999 );

/**
 * Get client IP, respecting proxy/CDN headers (Cloudflare, nginx, etc.)
 */
function hdgavi_get_client_ip() {
	// Only trust proxy headers when behind a known reverse proxy (Cloudflare)
	$behind_cf = ! empty( $_SERVER['HTTP_CF_CONNECTING_IP'] );

	if ( $behind_cf ) {
		$headers = array( 'HTTP_CF_CONNECTING_IP', 'HTTP_X_REAL_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR' );
	} else {
		// Not behind Cloudflare — X-Forwarded-For is client-spoofable, ignore it
		$headers = array( 'REMOTE_ADDR' );
	}

	foreach ( $headers as $header ) {
		if ( ! empty( $_SERVER[ $header ] ) ) {
			$ip = $_SERVER[ $header ];
			if ( strpos( $ip, ',' ) !== false ) {
				$ip = trim( explode( ',', $ip )[0] );
			}
			$ip = sanitize_text_field( $ip );
			if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
				return $ip;
			}
		}
	}
	return '0.0.0.0';
}

/**
 * Rate limiting helper for AJAX endpoints
 */
function hdgavi_rate_limit( $action, $max_per_hour = 10 ) {
	$ip    = hdgavi_get_client_ip();
	$key   = 'hdgavi_rl_' . md5( $action . $ip );
	$count = (int) get_transient( $key );
	if ( $count >= $max_per_hour ) {
		wp_send_json_error( array( 'message' => 'Too many requests. Please try again later.' ) );
	}
	set_transient( $key, $count + 1, HOUR_IN_SECONDS );
}

/**
 * Log wp_mail result for audit trail
 */
function hdgavi_log_mail( $to, $subject, $result ) {
	if ( $result ) return;
	error_log( sprintf( 'HD GAVI: wp_mail FAILED — to: %s, subject: %s', $to, $subject ) );
}

/**
 * Security headers including CSP
 */
function hdgavi_security_headers() {
	if ( is_admin() ) return;
	header( 'X-Content-Type-Options: nosniff' );
	header( 'X-Frame-Options: SAMEORIGIN' );
	header( 'X-XSS-Protection: 1; mode=block' );
	header( 'Referrer-Policy: strict-origin-when-cross-origin' );
	header( 'Permissions-Policy: camera=(), microphone=(), geolocation=()' );
	header( "Content-Security-Policy: default-src 'self'; script-src 'self' 'unsafe-inline' https://www.googletagmanager.com; style-src 'self' 'unsafe-inline'; font-src 'self'; img-src 'self' data: https:; connect-src 'self' https://api.github.com https://api.web3forms.com https://www.google-analytics.com;" );
}
add_action( 'send_headers', 'hdgavi_security_headers' );
