<?php
/**
 * HD GAVI Portfolio — AI Chatbot Widget
 * Floating chat bubble that answers questions about the portfolio owner.
 * Uses WP AJAX as proxy to avoid exposing API key client-side.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Render chatbot bubble + panel (injected in footer)
 */
function hdgavi_render_chatbot() {
    if ( ! hdgavi_opt( 'chatbot_enabled', false ) ) return;
    $api_key = hdgavi_opt( 'chatbot_api_key', '' );
    if ( empty( $api_key ) ) return;
    ?>
    <!-- Chatbot bubble -->
    <div class="chatbot-bubble" id="chatbotBubble" role="button" aria-label="Chat assistant" tabindex="0">💬</div>

    <!-- Chatbot panel -->
    <div class="chatbot-panel" id="chatbotPanel" role="dialog" aria-modal="true" aria-labelledby="chatbotTitle">
        <div class="chatbot-header">
            <span class="chatbot-title" id="chatbotTitle">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'chatbot_title_en', 'Ask me anything' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'chatbot_title_fr', 'Posez-moi une question' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'chatbot_title_es', 'Pregúntame lo que quieras' ) ); ?></span>
            </span>
            <button class="chatbot-close" id="chatbotClose" type="button" aria-label="Close">✕</button>
        </div>
        <div class="chatbot-messages" id="chatbotMessages" aria-live="polite" role="log" aria-label="Chat messages">
            <div class="chatbot-msg chatbot-msg-bot">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'chatbot_welcome_en', 'Hi! I can answer questions about Holali\'s skills, experience and projects. What would you like to know?' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'chatbot_welcome_fr', 'Salut ! Je peux répondre à vos questions sur les compétences, l\'expérience et les projets de Holali. Que souhaitez-vous savoir ?' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'chatbot_welcome_es', '¡Hola! Puedo responder preguntas sobre las habilidades, experiencia y proyectos de Holali. ¿Qué te gustaría saber?' ) ); ?></span>
            </div>
        </div>
        <div class="chatbot-input-area">
            <input type="text" id="chatbotInput" placeholder="<?php echo esc_attr( hdgavi_opt( 'chatbot_placeholder_en', 'Type a question...' ) ); ?>" data-placeholder-en="<?php echo esc_attr( hdgavi_opt( 'chatbot_placeholder_en', 'Type a question...' ) ); ?>" data-placeholder-fr="<?php echo esc_attr( hdgavi_opt( 'chatbot_placeholder_fr', 'Posez une question...' ) ); ?>" data-placeholder-es="<?php echo esc_attr( hdgavi_opt( 'chatbot_placeholder_es', 'Escribe una pregunta...' ) ); ?>" autocomplete="off">
            <button type="button" id="chatbotSend" aria-label="Send">→</button>
        </div>
    </div>
    <?php
}
add_action( 'wp_footer', 'hdgavi_render_chatbot', 20 );

/**
 * AJAX handler — proxy to Anthropic API (keeps key server-side)
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
    if ( empty( $api_key ) ) {
        wp_send_json_error( array( 'message' => 'Chatbot not configured.' ) );
    }

    $question = sanitize_text_field( wp_unslash( $_POST['question'] ?? '' ) );
    if ( empty( $question ) ) {
        wp_send_json_error( array( 'message' => 'Empty question.' ) );
    }

    // Build rich context from CPT data (cached)
    $context = hdgavi_chatbot_build_context();

    // Parse conversation history from client
    $history_json = $_POST['history'] ?? '[]';
    $history = json_decode( wp_unslash( $history_json ), true );
    if ( ! is_array( $history ) ) $history = array();
    // Limit to last 8 messages for context window
    $history = array_slice( $history, -8 );

    // Build messages array
    $messages = array();
    foreach ( $history as $msg ) {
        if ( isset( $msg['role'] ) && isset( $msg['content'] ) ) {
            $role = $msg['role'] === 'user' ? 'user' : 'assistant';
            $messages[] = array( 'role' => $role, 'content' => sanitize_text_field( $msg['content'] ) );
        }
    }
    $messages[] = array( 'role' => 'user', 'content' => $question );

    // Call Anthropic API
    $response = wp_remote_post( 'https://api.anthropic.com/v1/messages', array(
        'timeout' => 15,
        'headers' => array(
            'Content-Type'      => 'application/json',
            'x-api-key'        => $api_key,
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
            if ( isset( $block['text'] ) ) $text .= $block['text'];
        }
    }

    if ( empty( $text ) ) {
        wp_send_json_error( array( 'message' => 'No response from AI.' ) );
    }

    wp_send_json_success( array( 'reply' => $text ) );
}
add_action( 'wp_ajax_hdgavi_chatbot', 'hdgavi_chatbot_ajax' );
add_action( 'wp_ajax_nopriv_hdgavi_chatbot', 'hdgavi_chatbot_ajax' );

/**
 * Build rich context from CPT data (cached in transient)
 */
function hdgavi_chatbot_build_context() {
    $cached = get_transient( 'hdgavi_chatbot_context' );
    if ( $cached ) return $cached;

    $name     = hdgavi_opt( 'general_name', 'Holali David GAVI' );
    $badge    = hdgavi_opt( 'about_badge_en', '' );
    $email    = hdgavi_opt( 'general_email', '' );
    $location = hdgavi_opt( 'general_location', '' );

    // Experience from CPT
    $exp_lines = array();
    $experiences = hdgavi_get_cpt_posts( 'hdgavi_experience' );
    foreach ( $experiences as $e ) {
        $title   = get_post_meta( $e->ID, '_exp_title_en', true );
        $company = get_post_meta( $e->ID, '_exp_company_en', true );
        $period  = get_post_meta( $e->ID, '_exp_period_en', true );
        $techs   = get_post_meta( $e->ID, '_exp_techs', true );
        $desc    = get_post_meta( $e->ID, '_exp_desc_en', true );
        if ( $title ) $exp_lines[] = "{$title} at {$company} ({$period}). {$desc} Technologies: {$techs}";
    }

    // Education from CPT
    $edu_lines = array();
    $educations = hdgavi_get_cpt_posts( 'hdgavi_education' );
    foreach ( $educations as $e ) {
        $degree = get_post_meta( $e->ID, '_edu_degree_en', true );
        $school = get_post_meta( $e->ID, '_edu_school', true );
        $period = get_post_meta( $e->ID, '_edu_period', true );
        if ( $degree ) $edu_lines[] = "{$degree} — {$school} ({$period})";
    }

    // Projects from CPT
    $proj_lines = array();
    $projects = hdgavi_get_cpt_posts( 'hdgavi_project' );
    foreach ( array_slice( $projects, 0, 8 ) as $p ) {
        $title = get_post_meta( $p->ID, '_proj_title_en', true );
        $desc  = get_post_meta( $p->ID, '_proj_desc_en', true );
        $techs = get_post_meta( $p->ID, '_proj_techs', true );
        if ( $title ) $proj_lines[] = "{$title}: {$desc} ({$techs})";
    }

    // Skills from CPT
    $skill_lines = array();
    $skills = hdgavi_get_cpt_posts( 'hdgavi_skill' );
    $skill_cats = array();
    foreach ( $skills as $s ) {
        $cat  = get_post_meta( $s->ID, '_skill_category_en', true ) ?: 'Other';
        $name_s = get_post_meta( $s->ID, '_skill_name', true );
        $level = get_post_meta( $s->ID, '_skill_level', true );
        if ( ! isset( $skill_cats[ $cat ] ) ) $skill_cats[ $cat ] = array();
        $skill_cats[ $cat ][] = "{$name_s} ({$level})";
    }
    foreach ( $skill_cats as $cat => $items ) {
        $skill_lines[] = "{$cat}: " . implode( ', ', $items );
    }

    // Certifications from CPT
    $cert_lines = array();
    $certs = hdgavi_get_cpt_posts( 'hdgavi_certification' );
    foreach ( $certs as $c ) {
        $cn = get_post_meta( $c->ID, '_cert_name', true );
        $co = get_post_meta( $c->ID, '_cert_org', true );
        $cs = get_post_meta( $c->ID, '_cert_status', true );
        if ( $cn ) $cert_lines[] = "{$cn} ({$co}) — {$cs}";
    }

    // Recent blog posts
    $blog_lines = array();
    $posts = get_posts( array( 'posts_per_page' => 5, 'orderby' => 'date', 'order' => 'DESC' ) );
    foreach ( $posts as $p ) {
        $blog_lines[] = $p->post_title;
    }

    // Availability
    $avail = hdgavi_opt( 'avail_status', 'available' );
    $contracts = hdgavi_opt( 'avail_contracts', '' );

    $context = "You are a helpful and friendly assistant on the portfolio website of {$name}. "
        . "Answer questions about this person accurately based on the data below. "
        . "Be concise (2-3 sentences max). Answer in the same language as the question. "
        . "If you don't know something, suggest contacting {$name} via the contact form.\n\n"
        . "=== PROFILE ===\n"
        . "Name: {$name}\nTitle: {$badge}\nLocation: {$location}\nEmail: {$email}\n"
        . "Availability: {$avail}\nOpen to: {$contracts}\n\n"
        . "=== EXPERIENCE ===\n" . implode( "\n", $exp_lines ) . "\n\n"
        . "=== EDUCATION ===\n" . implode( "\n", $edu_lines ) . "\n\n"
        . "=== PROJECTS ===\n" . implode( "\n", $proj_lines ) . "\n\n"
        . "=== SKILLS ===\n" . implode( "\n", $skill_lines ) . "\n\n"
        . "=== CERTIFICATIONS ===\n" . implode( "\n", $cert_lines ) . "\n\n"
        . "=== RECENT BLOG POSTS ===\n" . implode( "\n", $blog_lines );

    // Cache for 1 hour (busted on CPT save via hook)
    set_transient( 'hdgavi_chatbot_context', $context, HOUR_IN_SECONDS );
    return $context;
}

/**
 * Bust chatbot context cache when CPT content changes
 */
function hdgavi_chatbot_bust_cache( $post_id ) {
    $type = get_post_type( $post_id );
    $cpt_types = array( 'hdgavi_experience', 'hdgavi_project', 'hdgavi_education', 'hdgavi_certification', 'hdgavi_skill', 'hdgavi_testimonial', 'post' );
    if ( in_array( $type, $cpt_types, true ) ) {
        delete_transient( 'hdgavi_chatbot_context' );
    }
}
add_action( 'save_post', 'hdgavi_chatbot_bust_cache' );
