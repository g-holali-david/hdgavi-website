<?php
/**
 * HD GAVI Portfolio — RSS Tech Watch Importer
 * Fetches articles from configured RSS feeds and creates draft posts in the "veille" category.
 * Runs via WP-Cron every 6 hours when enabled.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ═══════════════════════════════════════
   1. CUSTOM CRON INTERVAL
   ═══════════════════════════════════════ */
function hdgavi_rss_cron_interval( $schedules ) {
    $schedules['hdgavi_6hours'] = array(
        'interval' => 21600,
        'display'  => __( 'Every 6 hours', 'hdgavi-portfolio' ),
    );
    return $schedules;
}
add_filter( 'cron_schedules', 'hdgavi_rss_cron_interval' );

/* ═══════════════════════════════════════
   2. SCHEDULE / UNSCHEDULE
   ═══════════════════════════════════════ */
function hdgavi_rss_schedule() {
    if ( ! wp_next_scheduled( 'hdgavi_rss_import_cron' ) ) {
        wp_schedule_event( time(), 'hdgavi_6hours', 'hdgavi_rss_import_cron' );
    }
}

function hdgavi_rss_unschedule() {
    $timestamp = wp_next_scheduled( 'hdgavi_rss_import_cron' );
    if ( $timestamp ) {
        wp_unschedule_event( $timestamp, 'hdgavi_rss_import_cron' );
    }
}

// Manage cron based on toggle
function hdgavi_rss_manage_cron() {
    if ( hdgavi_opt( 'rss_enabled', false ) ) {
        hdgavi_rss_schedule();
    } else {
        hdgavi_rss_unschedule();
    }
}
add_action( 'after_switch_theme', 'hdgavi_rss_manage_cron' );
add_action( 'customize_save_after', 'hdgavi_rss_manage_cron' );

// Cleanup on theme deactivation
add_action( 'switch_theme', 'hdgavi_rss_unschedule' );

/* ═══════════════════════════════════════
   3. GET CONFIGURED FEEDS
   ═══════════════════════════════════════ */
function hdgavi_rss_default_feeds() {
    return array(
        'https://kubernetes.io/feed.xml',
        'https://www.docker.com/blog/feed/',
        'https://github.blog/feed/',
        'https://www.hashicorp.com/blog/feed',
        'https://aws.amazon.com/blogs/devops/feed/',
        'https://cloud.google.com/blog/products/devops-sre/rss',
        'https://grafana.com/blog/index.xml',
    );
}

function hdgavi_rss_get_feeds() {
    $default_feeds = implode( "\n", hdgavi_rss_default_feeds() );

    $raw = hdgavi_opt( 'rss_feeds', $default_feeds );
    $lines = array_filter( array_map( 'trim', explode( "\n", $raw ) ) );
    $feeds = array();
    foreach ( $lines as $line ) {
        $url = esc_url_raw( $line );
        if ( ! empty( $url ) ) {
            $feeds[] = $url;
        }
    }
    return $feeds;
}

/* ═══════════════════════════════════════
   4. IMPORT FUNCTION
   ═══════════════════════════════════════ */
function hdgavi_rss_import() {
    if ( ! hdgavi_opt( 'rss_enabled', false ) ) {
        return array( 'imported' => 0, 'skipped' => 0, 'errors' => 0, 'message' => 'RSS import disabled.' );
    }

    $feeds       = hdgavi_rss_get_feeds();
    $max_per_feed = intval( hdgavi_opt( 'rss_max_per_feed', 5 ) );
    $imported    = 0;
    $skipped     = 0;
    $errors      = 0;

    // Ensure veille category exists
    if ( ! term_exists( 'veille', 'category' ) ) {
        wp_insert_term( 'Veille', 'category', array( 'slug' => 'veille' ) );
    }
    $veille_cat_id = get_cat_ID( 'veille' );

    // Load WordPress feed functions
    include_once ABSPATH . WPINC . '/feed.php';

    foreach ( $feeds as $feed_url ) {
        $feed = fetch_feed( $feed_url );
        if ( is_wp_error( $feed ) ) {
            $errors++;
            error_log( 'HD GAVI RSS: failed to fetch ' . $feed_url . ' — ' . $feed->get_error_message() );
            continue;
        }

        $source_host = str_replace( 'www.', '', parse_url( $feed_url, PHP_URL_HOST ) );
        $items = $feed->get_items( 0, $max_per_feed );

        foreach ( $items as $item ) {
            $item_url   = $item->get_permalink();
            $item_title = $item->get_title();

            if ( empty( $item_url ) || empty( $item_title ) ) continue;

            // Anti-doublon: check by watch_url meta
            $exists = get_posts( array(
                'post_type'      => 'post',
                'meta_key'       => 'watch_url',
                'meta_value'     => $item_url,
                'posts_per_page' => 1,
                'post_status'    => 'any',
                'fields'         => 'ids',
            ) );
            if ( ! empty( $exists ) ) {
                $skipped++;
                continue;
            }

            // Extract description/content
            $description = $item->get_description();
            if ( empty( $description ) ) {
                $description = $item->get_content();
            }
            $clean_desc = wp_kses_post( $description );

            // Build bilingual content (EN only for RSS, FR can be added manually)
            $content = '<div data-lang="en">' . $clean_desc . '</div>'
                     . '<div data-lang="fr">' . $clean_desc . '</div>';

            // Extract tags from feed categories
            $feed_tags = array();
            $categories = $item->get_categories();
            if ( $categories ) {
                foreach ( array_slice( $categories, 0, 5 ) as $cat ) {
                    $tag = sanitize_title( $cat->get_label() );
                    if ( ! empty( $tag ) && strlen( $tag ) < 30 ) {
                        $feed_tags[] = $tag;
                    }
                }
            }

            // Get publication date
            $pub_date = $item->get_date( 'Y-m-d H:i:s' );
            if ( empty( $pub_date ) ) {
                $pub_date = current_time( 'mysql' );
            }

            // Create draft post
            $post_id = wp_insert_post( array(
                'post_title'    => sanitize_text_field( $item_title ),
                'post_content'  => $content,
                'post_status'   => 'draft',
                'post_type'     => 'post',
                'post_category' => array( $veille_cat_id ),
                'post_date'     => $pub_date,
            ) );

            if ( is_wp_error( $post_id ) ) {
                $errors++;
                continue;
            }

            // Set meta
            update_post_meta( $post_id, 'watch_url', esc_url_raw( $item_url ) );
            update_post_meta( $post_id, 'watch_source', $source_host );
            update_post_meta( $post_id, '_watch_title_en', sanitize_text_field( $item_title ) );
            update_post_meta( $post_id, '_hdgavi_rss', '1' );

            // Set tags
            if ( ! empty( $feed_tags ) ) {
                wp_set_post_tags( $post_id, $feed_tags );
            }

            $imported++;
        }
    }

    // Store last import timestamp
    update_option( 'hdgavi_rss_last_import', current_time( 'mysql' ), false );
    update_option( 'hdgavi_rss_last_result', array(
        'imported' => $imported,
        'skipped'  => $skipped,
        'errors'   => $errors,
        'feeds'    => count( $feeds ),
    ), false );

    return array(
        'imported' => $imported,
        'skipped'  => $skipped,
        'errors'   => $errors,
        'message'  => sprintf( '%d imported, %d skipped, %d errors from %d feeds.', $imported, $skipped, $errors, count( $feeds ) ),
    );
}

// WP-Cron hook
add_action( 'hdgavi_rss_import_cron', 'hdgavi_rss_import' );

/* ═══════════════════════════════════════
   5. AJAX: MANUAL TRIGGER
   ═══════════════════════════════════════ */
function hdgavi_ajax_rss_import_now() {
    check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    $result = hdgavi_rss_import();
    wp_send_json_success( $result );
}
add_action( 'wp_ajax_hdgavi_rss_import_now', 'hdgavi_ajax_rss_import_now' );
