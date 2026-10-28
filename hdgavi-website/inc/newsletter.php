<?php
/**
 * HD GAVI Portfolio — Newsletter AJAX Handler
 * Handles subscription via the newsletter form.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * AJAX handler — newsletter subscription
 */
function hdgavi_newsletter_ajax() {
    check_ajax_referer( 'hdgavi_newsletter_nonce', 'nonce' );
    hdgavi_rate_limit( 'newsletter', 10 );

    // Honeypot — bots fill hidden fields, real users don't
    if ( ! empty( $_POST['website'] ) ) {
        wp_send_json_success( array( 'message' => 'subscribed' ) ); // silent success to fool bots
    }

    $email = isset( $_POST['email'] ) ? sanitize_email( wp_unslash( $_POST['email'] ) ) : '';
    if ( empty( $email ) || ! is_email( $email ) ) {
        wp_send_json_error( array( 'message' => 'invalid_email' ) );
    }

    $subs = get_option( 'hdgavi_newsletter_subs', array() );

    // Check for duplicate
    foreach ( $subs as $sub ) {
        if ( isset( $sub['email'] ) && strtolower( $sub['email'] ) === strtolower( $email ) ) {
            wp_send_json_error( array( 'message' => 'already_subscribed' ) );
        }
    }

    // Cap at 10 000 subscribers
    if ( count( $subs ) >= 10000 ) {
        wp_send_json_error( array( 'message' => 'list_full' ) );
    }

    // Add subscriber
    $subs[] = array(
        'email' => $email,
        'date'  => current_time( 'mysql' ),
    );
    update_option( 'hdgavi_newsletter_subs', $subs, false );

    // Generate unsubscribe token
    $token  = wp_generate_password( 32, false );
    $tokens = get_option( 'hdgavi_newsletter_unsubscribe_tokens', array() );
    $tokens[ $token ] = $email;
    update_option( 'hdgavi_newsletter_unsubscribe_tokens', $tokens, false );

    // Send confirmation email
    $name = hdgavi_opt( 'general_name', '' );
    $lang = hdgavi_opt( 'default_lang', 'en' );

    $unsub_link = '<a href="' . esc_url( home_url( '/?hdgavi_unsub=' . $token ) ) . '" style="color:' . hdgavi_ec('accent') . ';">';
    if ( $lang === 'fr' ) {
        $subject = 'Inscription à la newsletter confirmée';
        $title   = 'Merci pour votre inscription !';
        $nl_body = '<p>Vous recevrez des articles de veille technologique de ' . esc_html( $name ) . '.</p>'
            . '<p style="font-size:13px;color:' . hdgavi_ec('text_muted') . ';margin-top:24px;">Pour vous désabonner, ' . $unsub_link . 'cliquez ici</a>.</p>';
    } elseif ( $lang === 'es' ) {
        $subject = 'Suscripción al boletín confirmada';
        $title   = '¡Gracias por suscribirte!';
        $nl_body = '<p>Recibirás artículos de vigilancia tecnológica de ' . esc_html( $name ) . '.</p>'
            . '<p style="font-size:13px;color:' . hdgavi_ec('text_muted') . ';margin-top:24px;">Para cancelar la suscripción, ' . $unsub_link . 'haz clic aquí</a>.</p>';
    } else {
        $subject = 'Newsletter subscription confirmed';
        $title   = 'Thanks for subscribing!';
        $nl_body = '<p>You\'ll receive curated tech watch articles from ' . esc_html( $name ) . '.</p>'
            . '<p style="font-size:13px;color:' . hdgavi_ec('text_muted') . ';margin-top:24px;">To unsubscribe, ' . $unsub_link . 'click here</a>.</p>';
    }

    $header = hdgavi_email_header( $title, $name . ' — Newsletter' );
    $html   = hdgavi_email_wrap( $header, $nl_body, hdgavi_email_footer() );

    $mail_result = wp_mail( $email, $subject, $html, array( 'Content-Type: text/html; charset=UTF-8' ) );
    hdgavi_log_mail( $email, $subject, $mail_result );

    // Schedule welcome series (emails 2 & 3)
    hdgavi_newsletter_schedule_welcome( $email );

    wp_send_json_success( array( 'message' => 'subscribed' ) );
}
add_action( 'wp_ajax_hdgavi_newsletter', 'hdgavi_newsletter_ajax' );
add_action( 'wp_ajax_nopriv_hdgavi_newsletter', 'hdgavi_newsletter_ajax' );

/**
 * Handle unsubscribe via token in URL
 */
function hdgavi_newsletter_unsubscribe() {
    if ( empty( $_GET['hdgavi_unsub'] ) ) return;

    $token  = sanitize_text_field( wp_unslash( $_GET['hdgavi_unsub'] ) );
    $tokens = get_option( 'hdgavi_newsletter_unsubscribe_tokens', array() );

    if ( ! isset( $tokens[ $token ] ) ) {
        wp_die( 'Invalid or expired unsubscribe link.', 'Unsubscribe', array( 'response' => 404 ) );
    }

    $email = $tokens[ $token ];
    $subs  = get_option( 'hdgavi_newsletter_subs', array() );
    $subs  = array_values( array_filter( $subs, function ( $sub ) use ( $email ) {
        return strtolower( $sub['email'] ) !== strtolower( $email );
    } ) );
    update_option( 'hdgavi_newsletter_subs', $subs, false );

    // Remove used token
    unset( $tokens[ $token ] );
    update_option( 'hdgavi_newsletter_unsubscribe_tokens', $tokens, false );

    wp_die( 'You have been unsubscribed successfully.', 'Unsubscribed', array( 'response' => 200 ) );
}
add_action( 'template_redirect', 'hdgavi_newsletter_unsubscribe' );

/**
 * Auto-send newsletter when a new post is published
 */
function hdgavi_newsletter_on_publish( $new_status, $old_status, $post ) {
    if ( $new_status !== 'publish' || $old_status === 'publish' ) return;
    if ( $post->post_type !== 'post' ) return;
    if ( ! hdgavi_opt( 'newsletter_auto_send', true ) ) return;

    // Prevent duplicate sends (transient lock)
    $lock = 'hdgavi_nl_sent_' . $post->ID;
    if ( get_transient( $lock ) ) return;
    set_transient( $lock, true, DAY_IN_SECONDS );

    $subs = get_option( 'hdgavi_newsletter_subs', array() );
    if ( empty( $subs ) ) return;

    $name      = hdgavi_opt( 'general_name', 'Holali David GAVI' );
    $title     = $post->post_title;
    $excerpt   = wp_trim_words( wp_strip_all_tags( $post->post_content ), 40 );
    $url       = get_permalink( $post->ID );
    $reading   = ceil( str_word_count( wp_strip_all_tags( $post->post_content ) ) / 200 );
    $tags      = get_the_tags( $post->ID );
    $tag_html  = '';
    if ( $tags ) {
        foreach ( array_slice( $tags, 0, 4 ) as $tag ) {
            $tag_html .= '<span style="display:inline-block;padding:2px 8px;background:rgba(6,182,212,0.1);color:' . hdgavi_ec('accent') . ';border-radius:4px;font-size:11px;margin-right:4px">' . esc_html( $tag->name ) . '</span>';
        }
    }

    $header = hdgavi_email_header( '📝 New Article', $name . '\'s Portfolio' );
    $body = '
    <h2 style="color:' . hdgavi_ec('text_heading') . ';margin:0 0 12px;font-size:18px;line-height:1.3">' . esc_html( $title ) . '</h2>
    <p style="color:' . hdgavi_ec('text_label') . ';font-size:12px;margin:0 0 16px">' . esc_html( $reading ) . ' min read</p>
    ' . ( $tag_html ? '<div style="margin-bottom:16px">' . $tag_html . '</div>' : '' ) . '
    <p style="color:' . hdgavi_ec('text_secondary') . ';line-height:1.6">' . esc_html( $excerpt ) . '</p>
    <p style="margin-top:20px">
        <a href="' . esc_url( $url ) . '" style="display:inline-block;padding:10px 24px;background:' . hdgavi_ec('accent') . ';color:' . hdgavi_ec('header_bg') . ';border-radius:6px;font-weight:600;text-decoration:none">Read article →</a>
    </p>';
    $footer = hdgavi_email_footer();
    $html   = hdgavi_email_wrap( $header, $body, $footer );

    // Schedule batch sending via WP-Cron instead of synchronous loop
    $batch_data = array(
        'post_id' => $post->ID,
        'title'   => $title,
        'html'    => $html,
        'offset'  => 0,
    );
    update_option( 'hdgavi_nl_batch_' . $post->ID, $batch_data, false );
    wp_schedule_single_event( time(), 'hdgavi_newsletter_send_batch', array( $post->ID ) );
}
add_action( 'transition_post_status', 'hdgavi_newsletter_on_publish', 10, 3 );

/**
 * WP-Cron handler: send newsletter in batches of 50
 */
function hdgavi_newsletter_send_batch( $post_id ) {
    $batch = get_option( 'hdgavi_nl_batch_' . $post_id );
    if ( ! $batch ) return;

    $subs   = get_option( 'hdgavi_newsletter_subs', array() );
    $tokens = get_option( 'hdgavi_newsletter_unsubscribe_tokens', array() );
    $offset = (int) $batch['offset'];
    $chunk  = array_slice( $subs, $offset, 50 );

    if ( empty( $chunk ) ) {
        delete_option( 'hdgavi_nl_batch_' . $post_id );
        return;
    }

    $tokens_updated = false;
    foreach ( $chunk as $sub ) {
        $email = $sub['email'] ?? '';
        if ( ! $email || ! is_email( $email ) ) continue;

        $token = array_search( strtolower( $email ), array_map( 'strtolower', $tokens ) );
        if ( ! $token ) {
            $token = wp_generate_password( 32, false );
            $tokens[ $token ] = $email;
            $tokens_updated = true;
        }

        $unsub_url  = home_url( '/?hdgavi_unsub=' . $token );
        $final_html = str_replace( '</body>', '<p style="text-align:center;font-size:11px;color:' . hdgavi_ec('text_muted') . ';margin-top:24px"><a href="' . esc_url( $unsub_url ) . '" style="color:' . hdgavi_ec('text_muted') . '">Unsubscribe</a></p></body>', $batch['html'] );

        $batch_result = wp_mail( $email, 'New: ' . $batch['title'], $final_html, array( 'Content-Type: text/html; charset=UTF-8' ) );
        hdgavi_log_mail( $email, 'New: ' . $batch['title'], $batch_result );
    }

    if ( $tokens_updated ) {
        update_option( 'hdgavi_newsletter_unsubscribe_tokens', $tokens, false );
    }

    // Schedule next batch
    $batch['offset'] = $offset + 50;
    update_option( 'hdgavi_nl_batch_' . $post_id, $batch, false );
    wp_schedule_single_event( time() + 30, 'hdgavi_newsletter_send_batch', array( $post_id ) );
}
add_action( 'hdgavi_newsletter_send_batch', 'hdgavi_newsletter_send_batch' );

/**
 * Welcome series: schedule emails on subscribe
 */
function hdgavi_newsletter_schedule_welcome( $email ) {
    if ( ! hdgavi_opt( 'newsletter_welcome_series', true ) ) return;
    // Email 2: 3 days later
    wp_schedule_single_event( time() + ( 3 * DAY_IN_SECONDS ), 'hdgavi_welcome_email', array( $email, 2 ) );
    // Email 3: 7 days later
    wp_schedule_single_event( time() + ( 7 * DAY_IN_SECONDS ), 'hdgavi_welcome_email', array( $email, 3 ) );
}

function hdgavi_send_welcome_email( $email, $step ) {
    if ( ! is_email( $email ) ) return;

    // Verify still subscribed
    $subs = get_option( 'hdgavi_newsletter_subs', array() );
    $found = false;
    foreach ( $subs as $sub ) {
        if ( strtolower( $sub['email'] ?? '' ) === strtolower( $email ) ) { $found = true; break; }
    }
    if ( ! $found ) return;

    $name = hdgavi_opt( 'general_name', 'Holali David GAVI' );

    if ( $step === 2 ) {
        $subject = 'My best articles — ' . $name;
        $header  = hdgavi_email_header( '📚 Top Articles', 'Curated picks from ' . $name );
        $body    = '<p style="color:' . hdgavi_ec('text_secondary') . ';line-height:1.6">' . esc_html( hdgavi_opt( 'welcome_email_2_body', 'Here are my most popular articles on Cloud, DevOps and Cybersecurity.' ) ) . '</p>';
        // Get 3 most recent posts
        $posts = get_posts( array( 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' ) );
        foreach ( $posts as $p ) {
            $body .= '<p style="margin:12px 0"><a href="' . esc_url( get_permalink( $p->ID ) ) . '" style="color:' . hdgavi_ec('accent') . ';font-weight:600">' . esc_html( $p->post_title ) . '</a><br><span style="color:' . hdgavi_ec('text_muted') . ';font-size:12px">' . esc_html( get_the_date( '', $p->ID ) ) . '</span></p>';
        }
    } else {
        $subject = 'Let\'s work together — ' . $name;
        $header  = hdgavi_email_header( '🤝 Services', $name );
        $body    = '<p style="color:' . hdgavi_ec('text_secondary') . ';line-height:1.6">' . esc_html( hdgavi_opt( 'welcome_email_3_body', 'I offer consulting in Cloud/DevOps, security audits and mentoring. Interested in working together?' ) ) . '</p>'
            . '<p style="margin-top:20px"><a href="' . esc_url( home_url( '/contact/' ) ) . '" style="display:inline-block;padding:10px 24px;background:' . hdgavi_ec('accent') . ';color:' . hdgavi_ec('header_bg') . ';border-radius:6px;font-weight:600;text-decoration:none">Get in touch →</a></p>';
    }

    $footer = hdgavi_email_footer();
    $html   = hdgavi_email_wrap( $header, $body, $footer );
    $welcome_result = wp_mail( $email, $subject, $html, array( 'Content-Type: text/html; charset=UTF-8' ) );
    hdgavi_log_mail( $email, $subject, $welcome_result );
}
add_action( 'hdgavi_welcome_email', 'hdgavi_send_welcome_email', 10, 2 );
