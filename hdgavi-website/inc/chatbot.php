<?php
/**
 * HD GAVI Portfolio — CV question widget (optional)
 *
 * Hidden unless "chatbot_enabled" is checked and an Anthropic API key is set. The key stays on the
 * server: the browser posts to admin-ajax.php (nonce + rate limits), which calls the API.
 * The system prompt only contains facts from the CV: the cv-content.php texts (with their
 * Customizer overrides) and the CV post types the site displays (experience, education, projects,
 * skills, obtained certifications), falling back to the cv-content.php datasets.
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/** Transient that caches the system prompt (new name in 7.0.0 so an older cached prompt is never reused). */
if ( ! defined( 'HDGAVI_CHATBOT_CONTEXT_KEY' ) ) {
    define( 'HDGAVI_CHATBOT_CONTEXT_KEY', 'hdgavi_chatbot_context_v7' );
}

/**
 * Widget texts (Customizer keys chatbot_title_*, chatbot_welcome_*, chatbot_placeholder_*).
 */
function hdgavi_chatbot_texts() {
    return array(
        'title'       => hdgavi_opt_tri( 'chatbot_title', 'Questions about the CV', 'Questions sur le CV', 'Preguntas sobre el CV' ),
        'welcome'     => hdgavi_opt_tri(
            'chatbot_welcome',
            'Ask a question about the experience, education, projects or skills of Holali David GAVI. The answers are generated automatically from his CV.',
            'Posez une question sur l’expérience, la formation, les projets ou les compétences de Holali David GAVI. Les réponses sont générées automatiquement à partir de son CV.',
            'Haga una pregunta sobre la experiencia, la formación, los proyectos o las competencias de Holali David GAVI. Las respuestas se generan automáticamente a partir de su CV.'
        ),
        'placeholder' => hdgavi_opt_tri( 'chatbot_placeholder', 'Your question', 'Votre question', 'Su pregunta' ),
        'send'        => array( 'en' => 'Send', 'fr' => 'Envoyer', 'es' => 'Enviar' ),
        'close'       => array( 'en' => 'Close', 'fr' => 'Fermer', 'es' => 'Cerrar' ),
        'log'         => array( 'en' => 'Conversation', 'fr' => 'Conversation', 'es' => 'Conversación' ),
    );
}

/**
 * Render the button and the panel (footer). Element ids are used by assets/js/theme.js.
 */
function hdgavi_render_chatbot() {
    if ( ! hdgavi_opt( 'chatbot_enabled', false ) ) return;
    $api_key = hdgavi_opt( 'chatbot_api_key', '' );
    if ( empty( $api_key ) ) return;

    $t    = hdgavi_chatbot_texts();
    $lang = hdgavi_opt( 'default_lang', 'en' );
    if ( ! in_array( $lang, array( 'en', 'fr', 'es' ), true ) ) $lang = 'en';
    ?>
    <button type="button" class="chatbot-bubble" id="chatbotBubble" aria-controls="chatbotPanel" aria-haspopup="dialog"><?php echo hdgavi_tri_arr( $t['title'] ); ?></button>

    <div class="chatbot-panel" id="chatbotPanel" role="dialog" aria-modal="true" aria-labelledby="chatbotTitle">
        <div class="chatbot-header">
            <span class="chatbot-title" id="chatbotTitle"><?php echo hdgavi_tri_arr( $t['title'] ); ?></span>
            <button class="chatbot-close" id="chatbotClose" type="button" aria-label="<?php echo esc_attr( $t['close'][ $lang ] ); ?>">&times;</button>
        </div>
        <div class="chatbot-messages" id="chatbotMessages" aria-live="polite" role="log" aria-label="<?php echo esc_attr( $t['log'][ $lang ] ); ?>">
            <div class="chatbot-msg chatbot-msg-bot"><?php echo hdgavi_tri_arr( $t['welcome'] ); ?></div>
        </div>
        <div class="chatbot-input-area">
            <input type="text" id="chatbotInput" maxlength="500" autocomplete="off"
                aria-label="<?php echo esc_attr( $t['placeholder'][ $lang ] ); ?>"
                placeholder="<?php echo esc_attr( $t['placeholder'][ $lang ] ); ?>"
                data-placeholder-en="<?php echo esc_attr( $t['placeholder']['en'] ); ?>"
                data-placeholder-fr="<?php echo esc_attr( $t['placeholder']['fr'] ); ?>"
                data-placeholder-es="<?php echo esc_attr( $t['placeholder']['es'] ); ?>">
            <button type="button" id="chatbotSend"><?php echo hdgavi_tri_arr( $t['send'] ); ?></button>
        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'hdgavi_render_chatbot', 20 );

/**
 * AJAX handler — proxy to the Anthropic API (keeps the key server-side)
 */
function hdgavi_chatbot_ajax() {
    check_ajax_referer( 'hdgavi_chatbot_nonce', 'nonce' );

    hdgavi_rate_limit( 'chatbot', 20 );

    // Global rate limit — cap total chatbot requests across all IPs
    $global_key   = 'hdgavi_rl_chatbot_global';
    $global_count = (int) get_transient( $global_key );
    $global_max   = (int) hdgavi_opt( 'chatbot_global_limit', 200 );
    if ( $global_count >= $global_max ) {
        wp_send_json_error( array( 'message' => 'Service temporarily unavailable. Please try again later.' ) );
    }
    set_transient( $global_key, $global_count + 1, HOUR_IN_SECONDS );

    $api_key = hdgavi_opt( 'chatbot_api_key', '' );
    if ( empty( $api_key ) || ! hdgavi_opt( 'chatbot_enabled', false ) ) {
        wp_send_json_error( array( 'message' => 'Chatbot not configured.' ) );
    }

    $question = sanitize_text_field( wp_unslash( $_POST['question'] ?? '' ) );
    $question = function_exists( 'mb_substr' ) ? mb_substr( $question, 0, 500 ) : substr( $question, 0, 500 );
    if ( '' === $question ) {
        wp_send_json_error( array( 'message' => 'Empty question.' ) );
    }

    // System prompt: CV facts only (cached)
    $context = hdgavi_chatbot_build_context();

    // Conversation history sent by the client (last 8 messages)
    $history_json = isset( $_POST['history'] ) ? wp_unslash( $_POST['history'] ) : '[]';
    $history      = json_decode( is_string( $history_json ) ? $history_json : '[]', true );
    if ( ! is_array( $history ) ) $history = array();
    $history = array_slice( $history, -8 );

    $messages = array();
    foreach ( $history as $msg ) {
        if ( ! is_array( $msg ) || ! isset( $msg['role'], $msg['content'] ) || ! is_string( $msg['content'] ) ) continue;
        $content = sanitize_text_field( $msg['content'] );
        if ( '' === $content ) continue;
        $content    = function_exists( 'mb_substr' ) ? mb_substr( $content, 0, 1000 ) : substr( $content, 0, 1000 );
        $messages[] = array( 'role' => ( 'user' === $msg['role'] ) ? 'user' : 'assistant', 'content' => $content );
    }
    $messages[] = array( 'role' => 'user', 'content' => $question );

    // Call the Anthropic Messages API
    $response = wp_remote_post( 'https://api.anthropic.com/v1/messages', array(
        'timeout' => 15,
        'headers' => array(
            'Content-Type'      => 'application/json',
            'x-api-key'         => $api_key,
            'anthropic-version' => '2023-06-01',
        ),
        'body' => wp_json_encode( array(
            'model'      => hdgavi_opt( 'chatbot_model', 'claude-sonnet-4-20250514' ),
            'max_tokens' => 400,
            'system'     => $context,
            'messages'   => $messages,
        ) ),
    ) );

    if ( is_wp_error( $response ) ) {
        wp_send_json_error( array( 'message' => 'API request failed.' ) );
    }

    $body = json_decode( wp_remote_retrieve_body( $response ), true );
    $text = '';
    if ( isset( $body['content'] ) && is_array( $body['content'] ) ) {
        foreach ( $body['content'] as $block ) {
            if ( isset( $block['type'], $block['text'] ) && 'text' === $block['type'] ) $text .= $block['text'];
        }
    }

    if ( '' === trim( $text ) ) {
        wp_send_json_error( array( 'message' => 'No answer available.' ) );
    }

    wp_send_json_success( array( 'reply' => $text ) );
}
add_action( 'wp_ajax_hdgavi_chatbot', 'hdgavi_chatbot_ajax' );
add_action( 'wp_ajax_nopriv_hdgavi_chatbot', 'hdgavi_chatbot_ajax' );

/**
 * English version of a CV text (cv-content.php + Customizer override), as plain text.
 */
function hdgavi_chatbot_cv_text( $key ) {
    if ( ! function_exists( 'hdgavi_cv' ) ) return '';
    $texts = hdgavi_cv( $key );
    return hdgavi_chatbot_plain( isset( $texts['en'] ) ? $texts['en'] : '' );
}

/** Strip tags and collapse whitespace. */
function hdgavi_chatbot_plain( $text ) {
    $text = wp_strip_all_tags( (string) $text );
    $flat = preg_replace( '/\s+/u', ' ', $text );
    return trim( is_string( $flat ) ? $flat : $text );
}

/**
 * Items of a CV post type as meta arrays, or the matching cv-content.php dataset when the post type
 * has no published post.
 */
function hdgavi_chatbot_items( $post_type, $dataset_fn ) {
    $items = array();
    $posts = function_exists( 'hdgavi_get_cpt_posts' ) ? hdgavi_get_cpt_posts( $post_type ) : array();
    foreach ( $posts as $p ) {
        $meta = array();
        foreach ( (array) get_post_meta( $p->ID ) as $k => $values ) {
            if ( is_string( $k ) && '' !== $k && '_' === $k[0] && isset( $values[0] ) && is_string( $values[0] ) ) {
                $meta[ $k ] = $values[0];
            }
        }
        $items[] = $meta;
    }
    if ( empty( $items ) && '' !== $dataset_fn && function_exists( $dataset_fn ) ) {
        foreach ( call_user_func( $dataset_fn ) as $row ) {
            if ( isset( $row['meta'] ) && is_array( $row['meta'] ) ) $items[] = $row['meta'];
        }
    }
    return $items;
}

/** Read one key of a meta array as plain text. */
function hdgavi_chatbot_meta( $meta, $key ) {
    return isset( $meta[ $key ] ) ? hdgavi_chatbot_plain( $meta[ $key ] ) : '';
}

/**
 * Build the system prompt (cached in a transient, cleared when CV content changes).
 */
function hdgavi_chatbot_build_context() {
    $cached = get_transient( HDGAVI_CHATBOT_CONTEXT_KEY );
    if ( is_string( $cached ) && '' !== $cached ) return $cached;

    $name     = hdgavi_chatbot_plain( hdgavi_opt( 'general_name', 'Holali David GAVI' ) );
    $email    = hdgavi_chatbot_plain( hdgavi_opt( 'general_email', '' ) );
    $phone    = hdgavi_chatbot_plain( hdgavi_opt( 'contact_phone', '' ) );
    $linkedin = esc_url_raw( hdgavi_opt( 'contact_linkedin', '' ) );
    $github   = esc_url_raw( hdgavi_opt( 'contact_github', '' ) );
    $location = hdgavi_chatbot_plain( function_exists( 'hdgavi_cv_location' ) ? hdgavi_cv_location() : '' );
    $contact  = function_exists( 'hdgavi_page_url' ) ? hdgavi_page_url( 'contact' ) : home_url( '/contact/' );

    // Profile
    $profile = array(
        'Name'             => $name,
        'Title'            => hdgavi_chatbot_cv_text( 'role' ),
        'Current position' => hdgavi_chatbot_cv_text( 'fact_role' ),
        'Location'         => $location,
        'Looking for'      => hdgavi_chatbot_cv_text( 'fact_search' ),
        'Education'        => hdgavi_chatbot_cv_text( 'fact_education' ),
        'Languages'        => hdgavi_chatbot_cv_text( 'fact_languages' ),
        'Interests'        => hdgavi_chatbot_cv_text( 'fact_interests' ),
        'Summary'          => trim( hdgavi_chatbot_cv_text( 'lead' ) . ' ' . hdgavi_chatbot_cv_text( 'goal' ) ),
    );
    $lines = array( 'PROFILE' );
    foreach ( $profile as $label => $value ) {
        if ( '' !== $value ) $lines[] = $label . ': ' . $value;
    }

    $lines[] = '';
    $lines[] = 'CONTACT';
    if ( '' !== $email )    $lines[] = 'E-mail: ' . $email;
    if ( '' !== $phone )    $lines[] = 'Phone: ' . $phone;
    if ( '' !== $linkedin ) $lines[] = 'LinkedIn: ' . $linkedin;
    if ( '' !== $github )   $lines[] = 'GitHub: ' . $github;
    $lines[] = 'Contact page: ' . $contact;

    // Experience
    $lines[] = '';
    $lines[] = 'EXPERIENCE';
    foreach ( hdgavi_chatbot_items( 'hdgavi_experience', 'hdgavi_cv_experiences' ) as $m ) {
        $title = hdgavi_chatbot_meta( $m, '_exp_title_en' );
        if ( '' === $title ) continue;
        $where = implode( ', ', array_filter( array( hdgavi_chatbot_meta( $m, '_exp_company_en' ), hdgavi_chatbot_meta( $m, '_exp_location' ) ) ) );
        $line  = '- ' . $title . ( '' !== $where ? ', ' . $where : '' );
        $when  = hdgavi_chatbot_meta( $m, '_exp_period_en' );
        if ( '' !== $when ) $line .= ' (' . $when . ')';
        $lines[] = $line;
        $desc = hdgavi_chatbot_meta( $m, '_exp_desc_en' );
        if ( '' !== $desc ) $lines[] = '  ' . $desc;
        $bullets = isset( $m['_exp_bullets_en'] ) ? preg_split( '/\r\n|\r|\n/', (string) $m['_exp_bullets_en'] ) : array();
        foreach ( $bullets as $b ) {
            $b = hdgavi_chatbot_plain( $b );
            if ( '' !== $b ) $lines[] = '  ' . $b;
        }
        $techs = hdgavi_chatbot_meta( $m, '_exp_techs' );
        if ( '' !== $techs ) $lines[] = '  Technologies: ' . $techs;
    }

    // Education
    $lines[] = '';
    $lines[] = 'EDUCATION';
    foreach ( hdgavi_chatbot_items( 'hdgavi_education', 'hdgavi_cv_educations' ) as $m ) {
        $degree = hdgavi_chatbot_meta( $m, '_edu_degree_en' );
        if ( '' === $degree ) continue;
        $line   = '- ' . $degree;
        $school = hdgavi_chatbot_meta( $m, '_edu_school' );
        if ( '' !== $school ) $line .= ', ' . $school;
        $when = hdgavi_chatbot_meta( $m, '_edu_period' );
        if ( '' !== $when ) $line .= ' (' . $when . ')';
        $notes = hdgavi_chatbot_meta( $m, '_edu_notes_en' );
        if ( '' !== $notes ) $line .= '. ' . $notes;
        $lines[] = $line;
    }

    // Projects
    $lines[] = '';
    $lines[] = 'PROJECTS';
    foreach ( hdgavi_chatbot_items( 'hdgavi_project', 'hdgavi_cv_projects' ) as $m ) {
        $title = hdgavi_chatbot_meta( $m, '_proj_title_en' );
        if ( '' === $title ) continue;
        $desc    = hdgavi_chatbot_meta( $m, '_proj_desc_en' );
        $lines[] = '- ' . $title . ( '' !== $desc ? ': ' . $desc : '' );
        $points  = isset( $m['_proj_points_en'] ) ? preg_split( '/\r\n|\r|\n/', (string) $m['_proj_points_en'] ) : array();
        foreach ( $points as $pt ) {
            $pt = hdgavi_chatbot_plain( $pt );
            if ( '' !== $pt ) $lines[] = '  ' . $pt;
        }
        $techs = hdgavi_chatbot_meta( $m, '_proj_techs' );
        if ( '' !== $techs ) $lines[] = '  Technologies: ' . $techs;
        $link = isset( $m['_proj_link'] ) ? esc_url_raw( $m['_proj_link'] ) : '';
        if ( '' !== $link ) $lines[] = '  Repository: ' . $link;
    }

    // Skills (names by category; the CV gives no levels)
    $groups = array();
    foreach ( hdgavi_chatbot_items( 'hdgavi_skill', '' ) as $m ) {
        $skill = hdgavi_chatbot_meta( $m, '_skill_name' );
        if ( '' === $skill ) continue;
        $cat = hdgavi_chatbot_meta( $m, '_skill_category_en' );
        $groups[ '' !== $cat ? $cat : 'Other' ][] = $skill;
    }
    if ( empty( $groups ) && function_exists( 'hdgavi_cv_skill_groups' ) ) {
        foreach ( hdgavi_cv_skill_groups() as $g ) {
            $groups[ $g['en'] ] = $g['items'];
        }
    }
    $lines[] = '';
    $lines[] = 'SKILLS';
    foreach ( $groups as $cat => $skills ) {
        $lines[] = '- ' . $cat . ': ' . implode( ', ', $skills );
    }

    // Certifications listed on the site as obtained
    $certs = array();
    foreach ( hdgavi_chatbot_items( 'hdgavi_certification', '' ) as $m ) {
        $cert   = hdgavi_chatbot_meta( $m, '_cert_name' );
        $status = hdgavi_chatbot_meta( $m, '_cert_status' );
        if ( '' === $cert || ( '' !== $status && 'obtained' !== $status ) ) continue;
        $line = '- ' . $cert;
        $org  = hdgavi_chatbot_meta( $m, '_cert_org' );
        if ( '' !== $org ) $line .= ', ' . $org;
        $date = hdgavi_chatbot_meta( $m, '_cert_date' );
        if ( '' !== $date ) $line .= ' (' . $date . ')';
        $certs[] = $line;
    }
    if ( ! empty( $certs ) ) {
        $lines[] = '';
        $lines[] = 'CERTIFICATIONS';
        $lines   = array_merge( $lines, $certs );
    }

    $rules = 'You answer visitors\' questions about ' . $name . ' on his CV website. You are an automatic assistant, not ' . $name . ': refer to him in the third person. '
        . 'Use only the facts listed below, taken from his CV. Do not add, guess or estimate anything else: no dates, durations, figures, employers, clients, results, skill levels or opinions that are not listed. '
        . 'If the answer is not in the facts, say that the CV does not mention it and suggest the contact page or the e-mail address. '
        . 'Salary expectations and a start date are not published: say so and suggest contacting him. Do not speculate about his private life or health. '
        . 'Answer in the language of the question (French, English or Spanish), in plain text, in two or three sentences, without emoji, lists or Markdown.';

    $context = $rules . "\n\n" . implode( "\n", $lines );

    // Cache for 1 hour (cleared when CV content changes, see below)
    set_transient( HDGAVI_CHATBOT_CONTEXT_KEY, $context, HOUR_IN_SECONDS );
    return $context;
}

/**
 * Clear the cached system prompt when CV content changes.
 */
function hdgavi_chatbot_bust_cache( $post_id ) {
    $cpt_types = array( 'hdgavi_experience', 'hdgavi_project', 'hdgavi_education', 'hdgavi_certification', 'hdgavi_skill' );
    if ( in_array( get_post_type( $post_id ), $cpt_types, true ) ) {
        delete_transient( HDGAVI_CHATBOT_CONTEXT_KEY );
    }
}
add_action( 'save_post', 'hdgavi_chatbot_bust_cache' );
add_action( 'before_delete_post', 'hdgavi_chatbot_bust_cache' );

/** Customizer changes (CV texts, name, contact details) also clear it. */
function hdgavi_chatbot_bust_cache_all() {
    delete_transient( HDGAVI_CHATBOT_CONTEXT_KEY );
}
add_action( 'customize_save_after', 'hdgavi_chatbot_bust_cache_all' );
