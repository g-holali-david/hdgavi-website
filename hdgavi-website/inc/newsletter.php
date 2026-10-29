<?php
/**
 * HD GAVI Portfolio — Newsletter AJAX Handler
 * Handles subscription via the newsletter form, the new-article e-mails and the two welcome e-mails.
 * E-mails are written in the site's default language (EN / FR / ES) and use the shared wrapper of
 * inc/email-templates.php.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/** Language used for newsletter e-mails. */
function hdgavi_newsletter_lang() {
    $lang = hdgavi_opt( 'default_lang', 'en' );
    return in_array( $lang, array( 'en', 'fr', 'es' ), true ) ? $lang : 'en';
}

/** One string of the newsletter e-mails in the given language. */
function hdgavi_newsletter_str( $key, $lang ) {
    $s = array(
        'confirm_subject' => array( 'en' => 'Newsletter subscription confirmed', 'fr' => 'Inscription à la newsletter confirmée', 'es' => 'Suscripción al boletín confirmada' ),
        'confirm_title'   => array( 'en' => 'Subscription confirmed', 'fr' => 'Inscription confirmée', 'es' => 'Suscripción confirmada' ),
        'confirm_body'    => array( 'en' => 'You will receive the tech watch articles published by %s.', 'fr' => 'Vous recevrez les articles de veille technologique publiés par %s.', 'es' => 'Recibirá los artículos de vigilancia tecnológica publicados por %s.' ),
        'unsub_text'      => array( 'en' => 'To unsubscribe, %sclick here%s.', 'fr' => 'Pour vous désabonner, %scliquez ici%s.', 'es' => 'Para darse de baja, %shaga clic aquí%s.' ),
        'unsub_link'      => array( 'en' => 'Unsubscribe', 'fr' => 'Se désabonner', 'es' => 'Darse de baja' ),
        'new_title'       => array( 'en' => 'New article', 'fr' => 'Nouvel article', 'es' => 'Nuevo artículo' ),
        'new_subject'     => array( 'en' => 'New article: %s', 'fr' => 'Nouvel article : %s', 'es' => 'Nuevo artículo: %s' ),
        'reading'         => array( 'en' => '%d min read', 'fr' => '%d min de lecture', 'es' => '%d min de lectura' ),
        'tags'            => array( 'en' => 'Tags: %s', 'fr' => 'Mots-clés : %s', 'es' => 'Etiquetas: %s' ),
        'read'            => array( 'en' => 'Read the article', 'fr' => 'Lire l’article', 'es' => 'Leer el artículo' ),
        'recent_title'    => array( 'en' => 'Recent articles', 'fr' => 'Articles récents', 'es' => 'Artículos recientes' ),
        'recent_body'     => array( 'en' => 'The latest articles published on the site.', 'fr' => 'Les derniers articles publiés sur le site.', 'es' => 'Los últimos artículos publicados en el sitio.' ),
        'about_title'     => array( 'en' => 'About me', 'fr' => 'Qui je suis', 'es' => 'Sobre mí' ),
        'about_link'      => array( 'en' => 'The CV online', 'fr' => 'Le CV en ligne', 'es' => 'El CV en línea' ),
    );
    return isset( $s[ $key ][ $lang ] ) ? $s[ $key ][ $lang ] : ( isset( $s[ $key ]['en'] ) ? $s[ $key ]['en'] : '' );
}

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

    // Confirmation e-mail
    $name = hdgavi_opt( 'general_name', '' );
    $lang = hdgavi_newsletter_lang();

    $unsub_url = home_url( '/?hdgavi_unsub=' . $token );
    $subject   = hdgavi_newsletter_str( 'confirm_subject', $lang );
    $title     = hdgavi_newsletter_str( 'confirm_title', $lang );
    $nl_body   = '<p>' . sprintf( esc_html( hdgavi_newsletter_str( 'confirm_body', $lang ) ), esc_html( $name ) ) . '</p>'
        . '<p style="font-size:13px;margin-top:24px;">' . sprintf( esc_html( hdgavi_newsletter_str( 'unsub_text', $lang ) ), '<a href="' . esc_url( $unsub_url ) . '">', '</a>' ) . '</p>';

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

    wp_die( 'You have been unsubscribed.', 'Unsubscribed', array( 'response' => 200 ) );
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

    $lang      = hdgavi_newsletter_lang();
    $name      = hdgavi_opt( 'general_name', 'Holali David GAVI' );
    $title     = $post->post_title;
    $excerpt   = wp_trim_words( wp_strip_all_tags( $post->post_content ), 40 );
    $url       = get_permalink( $post->ID );
    $reading   = max( 1, (int) ceil( str_word_count( wp_strip_all_tags( $post->post_content ) ) / 200 ) );
    $tags      = get_the_tags( $post->ID );
    $tag_names = array();
    if ( $tags && ! is_wp_error( $tags ) ) {
        foreach ( array_slice( $tags, 0, 4 ) as $tag ) {
            $tag_names[] = $tag->name;
        }
    }

    $header = hdgavi_email_header( hdgavi_newsletter_str( 'new_title', $lang ), $name );
    $body   = '<h2 style="margin:0 0 12px;font-size:18px;line-height:1.3">' . esc_html( $title ) . '</h2>'
        . '<p style="font-size:12px;margin:0 0 16px">' . esc_html( sprintf( hdgavi_newsletter_str( 'reading', $lang ), $reading ) ) . '</p>'
        . ( $tag_names ? '<p style="font-size:12px;margin:0 0 16px">' . esc_html( sprintf( hdgavi_newsletter_str( 'tags', $lang ), implode( ', ', $tag_names ) ) ) . '</p>' : '' )
        . '<p style="line-height:1.6">' . esc_html( $excerpt ) . '</p>'
        . '<p style="margin-top:20px"><a href="' . esc_url( $url ) . '">' . esc_html( hdgavi_newsletter_str( 'read', $lang ) ) . '</a></p>';
    $html = hdgavi_email_wrap( $header, $body, hdgavi_email_footer() );

    // Schedule batch sending via WP-Cron instead of synchronous loop
    $batch_data = array(
        'post_id' => $post->ID,
        'title'   => $title,
        'html'    => $html,
        'offset'  => 0,
        'lang'    => $lang,
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

    $subs    = get_option( 'hdgavi_newsletter_subs', array() );
    $tokens  = get_option( 'hdgavi_newsletter_unsubscribe_tokens', array() );
    $offset  = (int) $batch['offset'];
    $chunk   = array_slice( $subs, $offset, 50 );
    $lang    = isset( $batch['lang'] ) ? $batch['lang'] : hdgavi_newsletter_lang();
    $subject = sprintf( hdgavi_newsletter_str( 'new_subject', $lang ), $batch['title'] );

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
        $final_html = str_replace( '</body>', '<p style="text-align:center;font-size:11px;margin-top:24px"><a href="' . esc_url( $unsub_url ) . '">' . esc_html( hdgavi_newsletter_str( 'unsub_link', $lang ) ) . '</a></p></body>', $batch['html'] );

        $batch_result = wp_mail( $email, $subject, $final_html, array( 'Content-Type: text/html; charset=UTF-8' ) );
        hdgavi_log_mail( $email, $subject, $batch_result );
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

/**
 * Welcome e-mails: 2 = recent articles, 3 = short CV summary (cv-content.php texts).
 */
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
    $lang = hdgavi_newsletter_lang();

    if ( 2 === (int) $step ) {
        $title  = hdgavi_newsletter_str( 'recent_title', $lang );
        $intro  = trim( (string) hdgavi_opt( 'welcome_email_2_body', '' ) );
        // A stored copy of the pre-7.0 default ("most popular articles") counts as not customised.
        if ( '' === $intro || 'Here are my most popular articles on Cloud, DevOps and Cybersecurity.' === $intro ) {
            $intro = hdgavi_newsletter_str( 'recent_body', $lang );
        }
        $body  = '<p style="line-height:1.6">' . esc_html( $intro ) . '</p>';
        $posts = get_posts( array( 'posts_per_page' => 3, 'orderby' => 'date', 'order' => 'DESC' ) );
        foreach ( $posts as $p ) {
            $body .= '<p style="margin:12px 0"><a href="' . esc_url( get_permalink( $p->ID ) ) . '">' . esc_html( $p->post_title ) . '</a><br><span style="font-size:12px">' . esc_html( get_the_date( '', $p->ID ) ) . '</span></p>';
        }
    } else {
        $title = hdgavi_newsletter_str( 'about_title', $lang );
        $intro = trim( (string) hdgavi_opt( 'welcome_email_3_body', '' ) );
        // The pre-7.0 default advertised services that are not on the CV: never send it.
        if ( '' === $intro || 0 === strpos( $intro, 'I offer consulting in Cloud/DevOps' ) ) {
            $lead  = function_exists( 'hdgavi_cv' ) ? hdgavi_cv( 'lead' ) : array();
            $goal  = function_exists( 'hdgavi_cv' ) ? hdgavi_cv( 'goal' ) : array();
            $intro = trim( ( isset( $lead[ $lang ] ) ? $lead[ $lang ] : '' ) . ' ' . ( isset( $goal[ $lang ] ) ? $goal[ $lang ] : '' ) );
        }
        $body = '<p style="line-height:1.6">' . esc_html( wp_strip_all_tags( $intro ) ) . '</p>'
            . '<p style="margin-top:20px"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html( hdgavi_newsletter_str( 'about_link', $lang ) ) . '</a></p>';
    }

    $subject = $title . ' — ' . $name;
    $header  = hdgavi_email_header( $title, $name );
    $html    = hdgavi_email_wrap( $header, $body, hdgavi_email_footer() );
    $welcome_result = wp_mail( $email, $subject, $html, array( 'Content-Type: text/html; charset=UTF-8' ) );
    hdgavi_log_mail( $email, $subject, $welcome_result );
}
add_action( 'hdgavi_welcome_email', 'hdgavi_send_welcome_email', 10, 2 );
