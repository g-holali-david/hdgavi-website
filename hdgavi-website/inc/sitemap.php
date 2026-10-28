<?php
/**
 * HD GAVI Portfolio — Sitemap XML Generator (v6.2.0)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_sitemap_rewrite() {
	add_rewrite_rule( 'sitemap\.xml$', 'index.php?hdgavi_sitemap=1', 'top' );
}
add_action( 'init', 'hdgavi_sitemap_rewrite' );

function hdgavi_sitemap_query_var( $vars ) {
	$vars[] = 'hdgavi_sitemap';
	return $vars;
}
add_filter( 'query_vars', 'hdgavi_sitemap_query_var' );

function hdgavi_sitemap_render() {
	if ( ! get_query_var( 'hdgavi_sitemap' ) ) return;

	header( 'Content-Type: application/xml; charset=UTF-8' );
	header( 'X-Robots-Tag: noindex' );

	echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
	echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

	// Homepage
	hdgavi_sitemap_url( home_url( '/' ), '1.0', 'weekly' );

	// All published pages with portfolio templates
	$pages = get_pages( array( 'post_status' => 'publish' ) );
	$front_page_id = (int) get_option( 'page_on_front' );
	foreach ( $pages as $page ) {
		if ( $page->ID === $front_page_id ) continue; // already listed as homepage
		$template = get_page_template_slug( $page->ID );
		if ( strpos( $template, 'terminal' ) !== false || strpos( $template, 'presentation' ) !== false ) continue;
		$priority = '0.8';
		if ( strpos( $template, 'splash' ) !== false ) $priority = '1.0';
		if ( strpos( $template, 'about' ) !== false ) $priority = '0.9';
		$lastmod = get_the_modified_date( 'c', $page->ID );
		hdgavi_sitemap_url( get_permalink( $page->ID ), $priority, 'monthly', $lastmod );
	}

	// Blog posts
	$posts = get_posts( array( 'post_type' => 'post', 'posts_per_page' => 50, 'post_status' => 'publish' ) );
	foreach ( $posts as $post ) {
		$lastmod = get_the_modified_date( 'c', $post->ID );
		hdgavi_sitemap_url( get_permalink( $post->ID ), '0.6', 'weekly', $lastmod );
	}

	echo '</urlset>' . "\n";
	exit;
}
add_action( 'template_redirect', 'hdgavi_sitemap_render' );

function hdgavi_sitemap_url( $loc, $priority = '0.5', $changefreq = 'monthly', $lastmod = '' ) {
	echo '  <url>' . "\n";
	echo '    <loc>' . esc_url( $loc ) . '</loc>' . "\n";
	if ( ! empty( $lastmod ) ) {
		echo '    <lastmod>' . esc_attr( $lastmod ) . '</lastmod>' . "\n";
	}
	echo '    <changefreq>' . esc_attr( $changefreq ) . '</changefreq>' . "\n";
	echo '    <priority>' . esc_attr( $priority ) . '</priority>' . "\n";
	echo '  </url>' . "\n";
}

function hdgavi_robots_sitemap( $output ) {
	$output .= "\nSitemap: " . home_url( '/sitemap.xml' ) . "\n";
	return $output;
}
add_filter( 'robots_txt', 'hdgavi_robots_sitemap' );
