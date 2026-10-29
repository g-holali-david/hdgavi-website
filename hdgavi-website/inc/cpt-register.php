<?php
/**
 * HD GAVI Portfolio — Custom Post Types
 * Registers 6 CPTs with meta boxes for portfolio content
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ═══════════════════════════════════════
   1. REGISTER POST TYPES
   ═══════════════════════════════════════ */

function hdgavi_register_cpts() {
    $cpts = array(
        'hdgavi_experience' => array(
            'label'    => 'Experiences',
            'singular' => 'Experience',
            'icon'     => 'dashicons-portfolio',
        ),
        'hdgavi_project' => array(
            'label'    => 'Projects',
            'singular' => 'Project',
            'icon'     => 'dashicons-lightbulb',
        ),
        'hdgavi_education' => array(
            'label'    => 'Education',
            'singular' => 'Education',
            'icon'     => 'dashicons-welcome-learn-more',
        ),
        'hdgavi_certification' => array(
            'label'    => 'Certifications',
            'singular' => 'Certification',
            'icon'     => 'dashicons-awards',
        ),
        'hdgavi_timeline' => array(
            'label'    => 'Timeline',
            'singular' => 'Timeline Event',
            'icon'     => 'dashicons-backup',
        ),
        'hdgavi_testimonial' => array(
            'label'    => 'Testimonials',
            'singular' => 'Testimonial',
            'icon'     => 'dashicons-format-quote',
        ),
        'hdgavi_skill' => array(
            'label'    => 'Skills (Stack)',
            'singular' => 'Skill',
            'icon'     => 'dashicons-chart-bar',
        ),
        'hdgavi_resource' => array(
            'label'    => 'Resources',
            'singular' => 'Resource',
            'icon'     => 'dashicons-archive',
        ),
    );

    foreach ( $cpts as $slug => $conf ) {
        register_post_type( $slug, array(
            'labels' => array(
                'name'               => $conf['label'],
                'singular_name'      => $conf['singular'],
                'add_new'            => 'Add New',
                'add_new_item'       => 'Add New ' . $conf['singular'],
                'edit_item'          => 'Edit ' . $conf['singular'],
                'new_item'           => 'New ' . $conf['singular'],
                'view_item'          => 'View ' . $conf['singular'],
                'search_items'       => 'Search ' . $conf['label'],
                'not_found'          => 'No ' . strtolower( $conf['label'] ) . ' found.',
                'not_found_in_trash' => 'No ' . strtolower( $conf['label'] ) . ' found in Trash.',
            ),
            'public'              => false,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_icon'           => $conf['icon'],
            'supports'            => array( 'title', 'page-attributes' ),
            'hierarchical'        => false,
            'has_archive'         => false,
            'rewrite'             => false,
            'show_in_rest'        => false,
            'menu_position'       => 25,
        ) );
    }
    // Resource categories taxonomy
    register_taxonomy( 'hdgavi_resource_cat', 'hdgavi_resource', array(
        'labels' => array(
            'name'          => 'Resource Categories',
            'singular_name' => 'Category',
            'add_new_item'  => 'Add New Category',
            'edit_item'     => 'Edit Category',
            'search_items'  => 'Search Categories',
        ),
        'public'       => false,
        'show_ui'      => true,
        'show_in_menu' => true,
        'hierarchical' => true,
        'rewrite'      => false,
    ) );
}
add_action( 'init', 'hdgavi_register_cpts' );

/* ═══════════════════════════════════════
   2. META BOXES
   ═══════════════════════════════════════ */

/**
 * Enqueue admin gallery scripts on project edit screens
 */
function hdgavi_admin_gallery_scripts( $hook ) {
    if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) return;
    $screen = get_current_screen();
    if ( ! $screen || $screen->post_type !== 'hdgavi_project' ) return;

    wp_enqueue_media();
    wp_enqueue_script( 'jquery-ui-sortable' );
    wp_enqueue_script(
        'hdgavi-admin-gallery',
        get_template_directory_uri() . '/assets/js/admin-gallery.js',
        array( 'jquery', 'jquery-ui-sortable' ),
        HDGAVI_VERSION,
        true
    );
    wp_add_inline_style( 'wp-admin', '
        .hdgavi-gallery-grid{display:flex;flex-wrap:wrap;gap:8px;margin:8px 0}
        .hdgavi-gallery-item{position:relative;width:120px;height:80px;border-radius:8px;overflow:hidden;border:2px solid #ddd;cursor:grab;transition:border-color .2s,box-shadow .2s}
        .hdgavi-gallery-item:hover{border-color:#0073aa;box-shadow:0 2px 8px rgba(0,0,0,.12)}
        .hdgavi-gallery-item img{width:100%;height:100%;object-fit:cover;display:block}
        .hdgavi-gallery-remove{position:absolute;top:2px;right:2px;width:22px;height:22px;background:rgba(0,0,0,.65);color:#fff;border:none;border-radius:50%;font-size:14px;cursor:pointer;display:none;align-items:center;justify-content:center;line-height:1}
        .hdgavi-gallery-item:hover .hdgavi-gallery-remove{display:flex}
        .hdgavi-gallery-placeholder{width:120px;height:80px;border:2px dashed #0073aa;border-radius:8px;background:#f0f6fc}
        .hdgavi-gallery-item.ui-sortable-helper{box-shadow:0 4px 16px rgba(0,0,0,.2);z-index:10}
    ' );
}
add_action( 'admin_enqueue_scripts', 'hdgavi_admin_gallery_scripts' );

function hdgavi_cpt_meta_boxes() {
    // Experience
    add_meta_box( 'hdgavi_exp_meta', 'Experience Details', 'hdgavi_exp_meta_render', 'hdgavi_experience', 'normal', 'high' );
    // Project
    add_meta_box( 'hdgavi_proj_meta', 'Project Details', 'hdgavi_proj_meta_render', 'hdgavi_project', 'normal', 'high' );
    // Education
    add_meta_box( 'hdgavi_edu_meta', 'Education Details', 'hdgavi_edu_meta_render', 'hdgavi_education', 'normal', 'high' );
    // Certification
    add_meta_box( 'hdgavi_cert_meta', 'Certification Details', 'hdgavi_cert_meta_render', 'hdgavi_certification', 'normal', 'high' );
    // Timeline
    add_meta_box( 'hdgavi_tl_meta', 'Timeline Details', 'hdgavi_tl_meta_render', 'hdgavi_timeline', 'normal', 'high' );
    // Testimonial
    add_meta_box( 'hdgavi_testi_meta', 'Testimonial Details', 'hdgavi_testi_meta_render', 'hdgavi_testimonial', 'normal', 'high' );
    // Skill
    add_meta_box( 'hdgavi_skill_meta', 'Skill Details', 'hdgavi_skill_meta_render', 'hdgavi_skill', 'normal', 'high' );
    // Project — Case Study (extra section)
    add_meta_box( 'hdgavi_proj_case_meta', 'Case Study / Gallery', 'hdgavi_proj_case_meta_render', 'hdgavi_project', 'normal', 'default' );
    // Resource
    add_meta_box( 'hdgavi_res_meta', 'Resource Details', 'hdgavi_res_meta_render', 'hdgavi_resource', 'normal', 'high' );
    // Watch article (standard post in "veille" category)
    add_meta_box( 'hdgavi_watch_meta', 'Watch Article — Trilingual Fields', 'hdgavi_watch_meta_render', 'post', 'normal', 'high' );
}
add_action( 'add_meta_boxes', 'hdgavi_cpt_meta_boxes' );

/* ── Shared helpers ── */

function hdgavi_meta_field( $post_id, $key, $default = '' ) {
    return get_post_meta( $post_id, $key, true ) ?: $default;
}

function hdgavi_render_text( $post_id, $key, $label, $placeholder = '' ) {
    $val = hdgavi_meta_field( $post_id, $key );
    echo '<p><label><strong>' . esc_html( $label ) . '</strong><br>';
    echo '<input type="text" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" style="width:100%" placeholder="' . esc_attr( $placeholder ) . '"></label></p>';
}

function hdgavi_render_textarea( $post_id, $key, $label, $rows = 3, $placeholder = '' ) {
    $val = hdgavi_meta_field( $post_id, $key );
    echo '<p><label><strong>' . esc_html( $label ) . '</strong><br>';
    echo '<textarea name="' . esc_attr( $key ) . '" rows="' . intval( $rows ) . '" style="width:100%" placeholder="' . esc_attr( $placeholder ) . '">' . esc_textarea( $val ) . '</textarea></label></p>';
}

function hdgavi_render_select( $post_id, $key, $label, $options ) {
    $val = hdgavi_meta_field( $post_id, $key );
    echo '<p><label><strong>' . esc_html( $label ) . '</strong><br>';
    echo '<select name="' . esc_attr( $key ) . '" style="width:100%">';
    foreach ( $options as $k => $v ) {
        echo '<option value="' . esc_attr( $k ) . '"' . selected( $val, $k, false ) . '>' . esc_html( $v ) . '</option>';
    }
    echo '</select></label></p>';
}

function hdgavi_render_checkbox( $post_id, $key, $label ) {
    $val = hdgavi_meta_field( $post_id, $key );
    echo '<p><label><input type="checkbox" name="' . esc_attr( $key ) . '" value="1"' . checked( $val, '1', false ) . '> <strong>' . esc_html( $label ) . '</strong></label></p>';
}

function hdgavi_render_image( $post_id, $key, $label ) {
    $val = hdgavi_meta_field( $post_id, $key );
    echo '<p><label><strong>' . esc_html( $label ) . '</strong><br>';
    echo '<input type="url" name="' . esc_attr( $key ) . '" value="' . esc_attr( $val ) . '" style="width:100%" placeholder="https://..."></label></p>';
}

function hdgavi_section_heading( $title ) {
    echo '<h4 style="margin:20px 0 8px;padding-top:16px;border-top:1px solid #ddd;color:#0073aa">' . esc_html( $title ) . '</h4>';
}

function hdgavi_render_gallery( $post_id, $key ) {
    $val = get_post_meta( $post_id, $key, true );
    $urls = $val ? array_filter( array_map( 'trim', explode( "\n", $val ) ) ) : array();
    ?>
    <div class="hdgavi-gallery-field" id="hdgavi-gallery-<?php echo esc_attr( $key ); ?>">
        <div class="hdgavi-gallery-grid" id="hdgavi-gallery-grid-<?php echo esc_attr( $key ); ?>">
            <?php foreach ( $urls as $url ) : ?>
            <div class="hdgavi-gallery-item" data-url="<?php echo esc_attr( $url ); ?>">
                <img src="<?php echo esc_url( $url ); ?>" alt="">
                <button type="button" class="hdgavi-gallery-remove" title="Remove">&times;</button>
            </div>
            <?php endforeach; ?>
        </div>
        <p style="margin:8px 0 4px">
            <button type="button" class="button hdgavi-gallery-add" data-key="<?php echo esc_attr( $key ); ?>">
                📷 Add Screenshots
            </button>
            <button type="button" class="button hdgavi-gallery-add-url" data-key="<?php echo esc_attr( $key ); ?>" style="margin-left:4px">
                🔗 Add URL
            </button>
        </p>
        <textarea name="<?php echo esc_attr( $key ); ?>" id="hdgavi-gallery-data-<?php echo esc_attr( $key ); ?>" style="display:none"><?php echo esc_textarea( $val ); ?></textarea>
        <p class="description">Drag images to reorder. Click 📷 to upload from media library or 🔗 to add external URLs.</p>
    </div>
    <?php
}

/* ── Experience meta box ── */

function hdgavi_exp_meta_render( $post ) {
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_render_checkbox( $id, '_exp_featured', 'Featured (highlighted)' );

    hdgavi_section_heading( 'English' );
    hdgavi_render_text( $id, '_exp_title_en', 'Job Title (EN)' );
    hdgavi_render_text( $id, '_exp_company_en', 'Company (EN)' );
    hdgavi_render_text( $id, '_exp_period_en', 'Period (EN)', 'Jan 2024 — Present' );
    hdgavi_render_textarea( $id, '_exp_desc_en', 'Description (EN)', 2 );
    hdgavi_render_textarea( $id, '_exp_bullets_en', 'Key achievements (EN, one per line)', 4 );

    hdgavi_section_heading( 'French' );
    hdgavi_render_text( $id, '_exp_title_fr', 'Job Title (FR)' );
    hdgavi_render_text( $id, '_exp_company_fr', 'Company (FR)' );
    hdgavi_render_text( $id, '_exp_period_fr', 'Period (FR)', 'Jan 2024 — Aujourd\'hui' );
    hdgavi_render_textarea( $id, '_exp_desc_fr', 'Description (FR)', 2 );
    hdgavi_render_textarea( $id, '_exp_bullets_fr', 'Key achievements (FR, one per line)', 4 );

    hdgavi_section_heading( 'Español' );
    hdgavi_render_text( $id, '_exp_title_es', 'Job Title (ES)' );
    hdgavi_render_text( $id, '_exp_company_es', 'Company (ES)' );
    hdgavi_render_text( $id, '_exp_period_es', 'Period (ES)', 'Ene 2024 — Presente' );
    hdgavi_render_textarea( $id, '_exp_desc_es', 'Description (ES)', 2 );
    hdgavi_render_textarea( $id, '_exp_bullets_es', 'Key achievements (ES, one per line)', 4 );

    hdgavi_section_heading( 'Common' );
    hdgavi_render_text( $id, '_exp_location', 'Location', 'Vélizy-Villacoublay, France' );
    hdgavi_render_text( $id, '_exp_techs', 'Technologies (comma-separated)', 'Docker, Kubernetes, Helm' );
}

/* ── Project meta box ── */

function hdgavi_proj_meta_render( $post ) {
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_render_select( $id, '_proj_tag', 'Category', array(
        ''         => '— None —',
        'pro'      => 'Professional',
        'academic' => 'Academic',
        'personal' => 'Personal',
    ) );

    hdgavi_section_heading( 'English' );
    hdgavi_render_text( $id, '_proj_title_en', 'Title (EN)' );
    hdgavi_render_textarea( $id, '_proj_desc_en', 'Description (EN)', 2 );
    hdgavi_render_textarea( $id, '_proj_points_en', 'Key points (EN), one per line', 4 );

    hdgavi_section_heading( 'French' );
    hdgavi_render_text( $id, '_proj_title_fr', 'Title (FR)' );
    hdgavi_render_textarea( $id, '_proj_desc_fr', 'Description (FR)', 2 );
    hdgavi_render_textarea( $id, '_proj_points_fr', 'Key points (FR), one per line', 4 );

    hdgavi_section_heading( 'Spanish' );
    hdgavi_render_text( $id, '_proj_title_es', 'Title (ES)' );
    hdgavi_render_textarea( $id, '_proj_desc_es', 'Description (ES)', 2 );
    hdgavi_render_textarea( $id, '_proj_points_es', 'Key points (ES), one per line', 4 );

    hdgavi_section_heading( 'Common' );
    hdgavi_render_text( $id, '_proj_techs', 'Technologies (comma-separated)', 'React, Node.js, PostgreSQL' );
    hdgavi_render_text( $id, '_proj_link', 'Project URL', 'https://github.com/...' );
}

/* ── Education meta box ── */

function hdgavi_edu_meta_render( $post ) {
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_render_text( $id, '_edu_period', 'Period', '2023 — 2025' );
    hdgavi_render_text( $id, '_edu_school', 'School / Institution' );

    hdgavi_section_heading( 'English' );
    hdgavi_render_text( $id, '_edu_degree_en', 'Degree / Diploma (EN)' );
    hdgavi_render_text( $id, '_edu_notes_en', 'Notes (EN)', 'Specialization, honors...' );

    hdgavi_section_heading( 'French' );
    hdgavi_render_text( $id, '_edu_degree_fr', 'Degree / Diploma (FR)' );
    hdgavi_render_text( $id, '_edu_notes_fr', 'Notes (FR)' );

    hdgavi_section_heading( 'Español' );
    hdgavi_render_text( $id, '_edu_degree_es', 'Degree / Diploma (ES)' );
    hdgavi_render_text( $id, '_edu_notes_es', 'Notes (ES)' );
}

/* ── Certification meta box ── */

function hdgavi_cert_meta_render( $post ) {
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_render_text( $id, '_cert_name', 'Certification Name' );
    hdgavi_render_text( $id, '_cert_org', 'Organization', 'Cisco, AWS, Google...' );
    hdgavi_render_text( $id, '_cert_date', 'Date', 'March 2025' );
    hdgavi_render_select( $id, '_cert_status', 'Status', array(
        'obtained'    => 'Obtained',
        'in-progress' => 'In progress',
        'planned'     => 'Planned',
    ) );
    hdgavi_render_text( $id, '_cert_url', 'Verification URL', 'https://...' );
    hdgavi_render_image( $id, '_cert_badge', 'Badge Image URL' );
}

/* ── Timeline meta box ── */

function hdgavi_tl_meta_render( $post ) {
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_render_text( $id, '_tl_period', 'Period', '2023 — 2025' );
    hdgavi_render_select( $id, '_tl_type', 'Type', array(
        'work'          => 'Work',
        'education'     => 'Education',
        'certification' => 'Certification',
        'project'       => 'Project',
    ) );
    hdgavi_render_text( $id, '_tl_icon', 'Icon (emoji)', '' );

    hdgavi_section_heading( 'English' );
    hdgavi_render_text( $id, '_tl_title_en', 'Title (EN)' );
    hdgavi_render_textarea( $id, '_tl_desc_en', 'Description (EN)', 2 );

    hdgavi_section_heading( 'French' );
    hdgavi_render_text( $id, '_tl_title_fr', 'Title (FR)' );
    hdgavi_render_textarea( $id, '_tl_desc_fr', 'Description (FR)', 2 );

    hdgavi_section_heading( 'Español' );
    hdgavi_render_text( $id, '_tl_title_es', 'Title (ES)' );
    hdgavi_render_textarea( $id, '_tl_desc_es', 'Description (ES)', 2 );
}

/* ── Testimonial meta box ── */

function hdgavi_testi_meta_render( $post ) {
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_section_heading( 'English' );
    hdgavi_render_textarea( $id, '_testi_quote_en', 'Quote (EN)', 4 );
    hdgavi_render_text( $id, '_testi_role_en', 'Role (EN)', 'Engineering Manager' );

    hdgavi_section_heading( 'French' );
    hdgavi_render_textarea( $id, '_testi_quote_fr', 'Quote (FR)', 4 );
    hdgavi_render_text( $id, '_testi_role_fr', 'Role (FR)', 'Responsable Ingénierie' );

    hdgavi_section_heading( 'Español' );
    hdgavi_render_textarea( $id, '_testi_quote_es', 'Quote (ES)', 4 );
    hdgavi_render_text( $id, '_testi_role_es', 'Role (ES)', 'Gerente de Ingeniería' );

    hdgavi_section_heading( 'Common' );
    hdgavi_render_text( $id, '_testi_name', 'Person Name' );
    hdgavi_render_text( $id, '_testi_company', 'Company' );
    hdgavi_render_text( $id, '_testi_relation', 'Relation', 'Manager, Colleague...' );
    hdgavi_render_image( $id, '_testi_photo', 'Photo URL' );
}

/* ── Skill meta box ── */

function hdgavi_skill_meta_render( $post ) {
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_section_heading( 'Category (bilingual)' );
    hdgavi_render_text( $id, '_skill_category_en', 'Category (EN)', 'Containerization' );
    hdgavi_render_text( $id, '_skill_category_fr', 'Category (FR)', 'Conteneurisation' );
    hdgavi_render_text( $id, '_skill_category_es', 'Category (ES)', 'Contenedorización' );

    hdgavi_section_heading( 'Skill Details' );
    hdgavi_render_text( $id, '_skill_name', 'Technology Name', 'Docker' );
    hdgavi_render_select( $id, '_skill_level', 'Proficiency Level', array(
        'expert'       => 'Expert',
        'advanced'     => 'Advanced',
        'intermediate' => 'Intermediate',
        'learning'     => 'Learning',
    ) );
    hdgavi_render_select( $id, '_skill_usage', 'Usage Frequency', array(
        'daily'        => 'Daily use',
        'regular'      => 'Regular',
        'occasional'   => 'Occasional',
        'learning'     => 'Currently learning',
    ) );
    hdgavi_render_text( $id, '_skill_years', 'Years of Experience', '3' );
    hdgavi_render_image( $id, '_skill_icon', 'Icon URL (SVG or image)', 'https://...' );
}

/* ── Project Case Study + Gallery meta box ── */

function hdgavi_proj_case_meta_render( $post ) {
    $id = $post->ID;

    hdgavi_render_checkbox( $id, '_proj_is_case_study', 'Enable Case Study view for this project' );

    hdgavi_section_heading( 'Case Study — English' );
    hdgavi_render_textarea( $id, '_proj_problem_en', 'Problem (EN)', 3, 'What challenge needed solving?' );
    hdgavi_render_textarea( $id, '_proj_solution_en', 'Solution (EN)', 3, 'How was it solved?' );
    hdgavi_render_textarea( $id, '_proj_result_en', 'Result (EN)', 3, 'What was the impact?' );

    hdgavi_section_heading( 'Case Study — French' );
    hdgavi_render_textarea( $id, '_proj_problem_fr', 'Problem (FR)', 3 );
    hdgavi_render_textarea( $id, '_proj_solution_fr', 'Solution (FR)', 3 );
    hdgavi_render_textarea( $id, '_proj_result_fr', 'Result (FR)', 3 );

    hdgavi_section_heading( 'Case Study — Español' );
    hdgavi_render_textarea( $id, '_proj_problem_es', 'Problem (ES)', 3 );
    hdgavi_render_textarea( $id, '_proj_solution_es', 'Solution (ES)', 3 );
    hdgavi_render_textarea( $id, '_proj_result_es', 'Result (ES)', 3 );

    hdgavi_section_heading( 'Metrics & Visuals' );
    hdgavi_render_text( $id, '_proj_metrics', 'Metrics (key:value, comma-sep)', 'Deploy time:4h->15min, Uptime:99.2%->99.9%' );
    hdgavi_render_image( $id, '_proj_before_img', 'Before Image URL' );
    hdgavi_render_image( $id, '_proj_after_img', 'After Image URL' );

    hdgavi_section_heading( 'Screenshot Gallery' );
    hdgavi_render_gallery( $id, '_proj_gallery' );
}

/* ── Resource meta box ── */

function hdgavi_res_meta_render( $post ) {
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_section_heading( 'Content (bilingual)' );
    hdgavi_render_textarea( $id, '_res_desc_en', 'Description (EN)', 3 );
    hdgavi_render_textarea( $id, '_res_desc_fr', 'Description (FR)', 3 );
    hdgavi_render_textarea( $id, '_res_desc_es', 'Description (ES)', 3 );

    hdgavi_section_heading( 'Pricing' );
    hdgavi_render_select( $id, '_res_type', 'Type', array(
        'free' => 'Free',
        'paid' => 'Paid',
    ) );
    hdgavi_render_text( $id, '_res_price', 'Price (leave empty if free)', '€19' );
    hdgavi_render_text( $id, '_res_buy_url', 'Buy URL (Gumroad / Stripe link)', 'https://gumroad.com/...' );

    hdgavi_section_heading( 'Download' );
    hdgavi_render_checkbox( $id, '_res_gated', 'Gated download (require name + email for free resources)' );
    hdgavi_render_text( $id, '_res_download_url', 'Download file URL', 'https://...' );
    hdgavi_render_text( $id, '_res_file_format', 'File format', 'ZIP, PDF, HCL...' );

    hdgavi_section_heading( 'Visual' );
    hdgavi_render_image( $id, '_res_preview_image', 'Preview / Cover Image URL' );
    hdgavi_render_text( $id, '_res_icon', 'Icon emoji or short label', '🏗️' );
}

/**
 * Watch article meta box (standard posts in "veille" category)
 */
function hdgavi_watch_meta_render( $post ) {
    if ( ! has_category( 'veille', $post->ID ) ) {
        echo '<p style="color:#787c82;font-style:italic">This meta box applies to posts in the <strong>Veille</strong> category only.</p>';
        return;
    }
    wp_nonce_field( 'hdgavi_cpt_save', 'hdgavi_cpt_nonce' );
    $id = $post->ID;

    hdgavi_section_heading( 'English' );
    hdgavi_render_text( $id, '_watch_title_en', 'Title (EN)' );
    hdgavi_render_textarea( $id, '_watch_excerpt_en', 'Excerpt (EN)', 2 );

    hdgavi_section_heading( 'French' );
    hdgavi_render_text( $id, '_watch_title_fr', 'Titre (FR)' );
    hdgavi_render_textarea( $id, '_watch_excerpt_fr', 'Extrait (FR)', 2 );

    hdgavi_section_heading( 'Español' );
    hdgavi_render_text( $id, '_watch_title_es', 'Título (ES)' );
    hdgavi_render_textarea( $id, '_watch_excerpt_es', 'Extracto (ES)', 2 );

    hdgavi_section_heading( 'Source' );
    hdgavi_render_text( $id, 'watch_source', 'Source Name', 'e.g. kubernetes.io' );
    hdgavi_render_text( $id, 'watch_url', 'External URL', 'https://...' );
}

/* ═══════════════════════════════════════
   3. SAVE META
   ═══════════════════════════════════════ */

function hdgavi_cpt_save_meta( $post_id ) {
    if ( ! isset( $_POST['hdgavi_cpt_nonce'] ) ) return;
    if ( ! wp_verify_nonce( $_POST['hdgavi_cpt_nonce'], 'hdgavi_cpt_save' ) ) return;
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    if ( ! current_user_can( 'edit_post', $post_id ) ) return;

    // Only process our CPTs + veille posts
    $allowed_types = array( 'hdgavi_experience', 'hdgavi_project', 'hdgavi_education', 'hdgavi_certification', 'hdgavi_timeline', 'hdgavi_testimonial', 'hdgavi_skill', 'hdgavi_resource' );
    $post_type = get_post_type( $post_id );
    if ( ! in_array( $post_type, $allowed_types, true ) ) {
        if ( $post_type !== 'post' || ! has_category( 'veille', $post_id ) ) return;
    }

    $text_fields = array(
        '_exp_title_en', '_exp_title_fr', '_exp_title_es',
        '_exp_company_en', '_exp_company_fr', '_exp_company_es',
        '_exp_period_en', '_exp_period_fr', '_exp_period_es',
        '_exp_location', '_exp_techs',
        '_exp_desc_en', '_exp_desc_fr', '_exp_desc_es',
        '_proj_tag', '_proj_title_en', '_proj_title_fr', '_proj_title_es', '_proj_techs',
        '_proj_desc_en', '_proj_desc_fr', '_proj_desc_es', '_proj_metrics',
        '_edu_period', '_edu_school',
        '_edu_degree_en', '_edu_degree_fr', '_edu_degree_es',
        '_edu_notes_en', '_edu_notes_fr', '_edu_notes_es',
        '_cert_name', '_cert_org', '_cert_date', '_cert_status',
        '_tl_period', '_tl_type', '_tl_icon',
        '_tl_title_en', '_tl_title_fr', '_tl_title_es',
        '_tl_desc_en', '_tl_desc_fr', '_tl_desc_es',
        '_testi_name', '_testi_company', '_testi_relation',
        '_testi_role_en', '_testi_role_fr', '_testi_role_es',
        // Skill
        '_skill_name', '_skill_level', '_skill_usage', '_skill_years',
        '_skill_category_en', '_skill_category_fr', '_skill_category_es',
        // Resource
        '_res_type', '_res_price', '_res_file_format', '_res_icon',
        // Watch article
        '_watch_title_en', '_watch_title_fr', '_watch_title_es',
        'watch_source',
    );

    $url_fields = array(
        '_proj_link', '_cert_url', '_cert_badge', '_testi_photo',
        '_proj_before_img', '_proj_after_img', '_skill_icon',
        '_res_buy_url', '_res_download_url', '_res_preview_image',
        'watch_url',
    );

    $textarea_fields = array(
        '_exp_bullets_en', '_exp_bullets_fr', '_exp_bullets_es',
        '_testi_quote_en', '_testi_quote_fr', '_testi_quote_es',
        // Case study
        '_proj_problem_en', '_proj_problem_fr', '_proj_problem_es',
        '_proj_solution_en', '_proj_solution_fr', '_proj_solution_es',
        '_proj_result_en', '_proj_result_fr', '_proj_result_es',
        '_proj_gallery',
        '_proj_points_en', '_proj_points_fr', '_proj_points_es',
        '_res_desc_en', '_res_desc_fr', '_res_desc_es',
        // Watch article excerpts
        '_watch_excerpt_en', '_watch_excerpt_fr', '_watch_excerpt_es',
    );

    $checkbox_fields = array( '_exp_featured', '_proj_is_case_study', '_res_gated' );

    foreach ( $text_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_text_field( wp_unslash( $_POST[ $key ] ) ) );
        }
    }

    foreach ( $url_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, esc_url_raw( wp_unslash( $_POST[ $key ] ) ) );
        }
    }

    foreach ( $textarea_fields as $key ) {
        if ( isset( $_POST[ $key ] ) ) {
            update_post_meta( $post_id, $key, sanitize_textarea_field( wp_unslash( $_POST[ $key ] ) ) );
        }
    }

    foreach ( $checkbox_fields as $key ) {
        update_post_meta( $post_id, $key, isset( $_POST[ $key ] ) ? '1' : '' );
    }
}
add_action( 'save_post', 'hdgavi_cpt_save_meta' );

/* ═══════════════════════════════════════
   4. ADMIN COLUMNS
   ═══════════════════════════════════════ */

function hdgavi_exp_columns( $cols ) {
    return array(
        'cb'       => '<input type="checkbox">',
        'title'    => 'Post Title',
        'company'  => 'Company',
        'period'   => 'Period',
        'featured' => 'Featured',
        'date'     => 'Date',
    );
}
function hdgavi_exp_column_data( $col, $post_id ) {
    if ( $col === 'company' )  echo esc_html( get_post_meta( $post_id, '_exp_company_en', true ) );
    if ( $col === 'period' )   echo esc_html( get_post_meta( $post_id, '_exp_period_en', true ) );
    if ( $col === 'featured' ) echo get_post_meta( $post_id, '_exp_featured', true ) ? '⭐' : '—';
}
add_filter( 'manage_hdgavi_experience_posts_columns', 'hdgavi_exp_columns' );
add_action( 'manage_hdgavi_experience_posts_custom_column', 'hdgavi_exp_column_data', 10, 2 );

function hdgavi_proj_columns( $cols ) {
    return array(
        'cb'    => '<input type="checkbox">',
        'title' => 'Post Title',
        'tag'   => 'Category',
        'techs' => 'Technologies',
        'date'  => 'Date',
    );
}
function hdgavi_proj_column_data( $col, $post_id ) {
    if ( $col === 'tag' )   echo esc_html( ucfirst( get_post_meta( $post_id, '_proj_tag', true ) ) );
    if ( $col === 'techs' ) echo esc_html( get_post_meta( $post_id, '_proj_techs', true ) );
}
add_filter( 'manage_hdgavi_project_posts_columns', 'hdgavi_proj_columns' );
add_action( 'manage_hdgavi_project_posts_custom_column', 'hdgavi_proj_column_data', 10, 2 );

function hdgavi_cert_columns( $cols ) {
    return array(
        'cb'     => '<input type="checkbox">',
        'title'  => 'Post Title',
        'org'    => 'Organization',
        'status' => 'Status',
        'date'   => 'Date',
    );
}
function hdgavi_cert_column_data( $col, $post_id ) {
    if ( $col === 'org' )    echo esc_html( get_post_meta( $post_id, '_cert_org', true ) );
    if ( $col === 'status' ) echo esc_html( ucfirst( str_replace( '-', ' ', get_post_meta( $post_id, '_cert_status', true ) ) ) );
}
add_filter( 'manage_hdgavi_certification_posts_columns', 'hdgavi_cert_columns' );
add_action( 'manage_hdgavi_certification_posts_custom_column', 'hdgavi_cert_column_data', 10, 2 );

function hdgavi_skill_columns( $cols ) {
    return array(
        'cb'       => '<input type="checkbox">',
        'title'    => 'Post Title',
        'category' => 'Category',
        'level'    => 'Level',
        'usage'    => 'Usage',
        'years'    => 'Years',
        'date'     => 'Date',
    );
}
function hdgavi_skill_column_data( $col, $post_id ) {
    if ( $col === 'category' ) echo esc_html( get_post_meta( $post_id, '_skill_category_en', true ) );
    if ( $col === 'level' )    echo esc_html( ucfirst( get_post_meta( $post_id, '_skill_level', true ) ) );
    if ( $col === 'usage' )    echo esc_html( ucfirst( get_post_meta( $post_id, '_skill_usage', true ) ) );
    if ( $col === 'years' )    echo esc_html( get_post_meta( $post_id, '_skill_years', true ) );
}
add_filter( 'manage_hdgavi_skill_posts_columns', 'hdgavi_skill_columns' );
add_action( 'manage_hdgavi_skill_posts_custom_column', 'hdgavi_skill_column_data', 10, 2 );

/* ═══════════════════════════════════════
   5. HELPER: Query CPT posts (used by templates)
   ═══════════════════════════════════════ */

function hdgavi_get_cpt_posts( $post_type, $limit = -1 ) {
    return get_posts( array(
        'post_type'      => $post_type,
        'posts_per_page' => $limit,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
        'post_status'    => 'publish',
    ) );
}
