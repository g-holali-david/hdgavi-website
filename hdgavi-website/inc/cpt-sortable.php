<?php
/**
 * HD GAVI Portfolio — Drag & Drop ordering for CPTs
 * Enables sortable admin lists for all portfolio CPTs using menu_order.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Enqueue jQuery UI Sortable on CPT list screens
 */
function hdgavi_sortable_enqueue( $hook ) {
    if ( $hook !== 'edit.php' ) return;

    $screen = get_current_screen();
    if ( ! $screen ) return;

    $sortable_types = array(
        'hdgavi_experience', 'hdgavi_project', 'hdgavi_education',
        'hdgavi_certification', 'hdgavi_timeline', 'hdgavi_testimonial',
        'hdgavi_skill', 'hdgavi_resource',
    );

    if ( ! in_array( $screen->post_type, $sortable_types, true ) ) return;

    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_add_inline_script( 'jquery-ui-sortable', hdgavi_sortable_js() );
    wp_add_inline_style( 'wp-admin', hdgavi_sortable_css() );
}
add_action( 'admin_enqueue_scripts', 'hdgavi_sortable_enqueue' );

/**
 * Inline JS for sortable functionality
 */
function hdgavi_sortable_js() {
    return <<<'JS'
jQuery(function($) {
    var $list = $('#the-list');
    if (!$list.length) return;

    $list.sortable({
        items: 'tr',
        cursor: 'grabbing',
        axis: 'y',
        handle: 'td',
        placeholder: 'hdgavi-sortable-placeholder',
        forcePlaceholderSize: true,
        opacity: 0.75,
        update: function() {
            var order = [];
            $list.children('tr').each(function(i) {
                var id = $(this).attr('id');
                if (id) order.push(id.replace('post-', ''));
            });
            $.post(ajaxurl, {
                action: 'hdgavi_sort_cpt',
                order: order,
                _ajax_nonce: hdgaviSort.nonce
            });
        }
    });

    // Visual indicator
    $list.find('tr').css('cursor', 'grab');
});
JS;
}

/**
 * Inline CSS for sortable placeholder
 */
function hdgavi_sortable_css() {
    return '.hdgavi-sortable-placeholder{background:#f0f6fc!important;border:2px dashed #0073aa!important;height:40px}'
         . '#the-list tr{transition:background .15s}#the-list tr.ui-sortable-helper{background:#fff;box-shadow:0 4px 12px rgba(0,0,0,.15)}';
}

/**
 * Pass nonce to JS
 */
function hdgavi_sortable_nonce() {
    $screen = get_current_screen();
    if ( ! $screen ) return;

    $sortable_types = array(
        'hdgavi_experience', 'hdgavi_project', 'hdgavi_education',
        'hdgavi_certification', 'hdgavi_timeline', 'hdgavi_testimonial',
        'hdgavi_skill', 'hdgavi_resource',
    );

    if ( ! in_array( $screen->post_type, $sortable_types, true ) ) return;

    echo '<script>var hdgaviSort = { nonce: "' . wp_create_nonce( 'hdgavi_sort_cpt' ) . '" };</script>';
}
add_action( 'admin_footer', 'hdgavi_sortable_nonce' );

/**
 * AJAX handler: save new order
 */
function hdgavi_ajax_sort_cpt() {
    check_ajax_referer( 'hdgavi_sort_cpt' );

    if ( ! current_user_can( 'edit_posts' ) ) {
        wp_send_json_error( 'Permission denied.' );
    }

    $order = $_POST['order'] ?? array();
    if ( ! is_array( $order ) ) wp_send_json_error( 'Invalid data.' );

    foreach ( $order as $position => $post_id ) {
        $post_id  = absint( $post_id );
        $position = absint( $position );
        if ( $post_id > 0 ) {
            wp_update_post( array(
                'ID'         => $post_id,
                'menu_order' => $position,
            ) );
        }
    }

    wp_send_json_success();
}
add_action( 'wp_ajax_hdgavi_sort_cpt', 'hdgavi_ajax_sort_cpt' );

/**
 * Default admin list ordering to menu_order for our CPTs
 */
function hdgavi_cpt_default_order( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) return;

    $sortable_types = array(
        'hdgavi_experience', 'hdgavi_project', 'hdgavi_education',
        'hdgavi_certification', 'hdgavi_timeline', 'hdgavi_testimonial',
        'hdgavi_skill', 'hdgavi_resource',
    );

    if ( in_array( $query->get( 'post_type' ), $sortable_types, true ) && empty( $query->get( 'orderby' ) ) ) {
        $query->set( 'orderby', 'menu_order' );
        $query->set( 'order', 'ASC' );
    }
}
add_action( 'pre_get_posts', 'hdgavi_cpt_default_order' );
