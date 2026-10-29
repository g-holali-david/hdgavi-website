<?php
/**
 * HD GAVI Portfolio — SEO Admin Page
 * Dashboard page for managing all SEO settings (replaces Customizer SEO section).
 * Settings are stored as theme_mods for full backward compatibility.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/* ═══════════════════════════════════════
   1. REGISTER MENU
   ═══════════════════════════════════════ */
function hdgavi_seo_admin_menu() {
    add_menu_page(
        __( 'SEO Settings', 'hdgavi-portfolio' ),
        __( 'SEO', 'hdgavi-portfolio' ),
        'manage_options',
        'hdgavi-seo',
        'hdgavi_seo_admin_render',
        'dashicons-search',
        62
    );
}
add_action( 'admin_menu', 'hdgavi_seo_admin_menu' );

/* ═══════════════════════════════════════
   2. ENQUEUE CSS/JS ONLY ON THIS PAGE
   ═══════════════════════════════════════ */
function hdgavi_seo_admin_scripts( $hook ) {
    if ( $hook !== 'toplevel_page_hdgavi-seo' ) return;
    add_action( 'admin_head', 'hdgavi_seo_admin_print_css' );
    add_action( 'admin_footer', 'hdgavi_seo_admin_print_js' );
}
add_action( 'admin_enqueue_scripts', 'hdgavi_seo_admin_scripts' );

function hdgavi_seo_admin_print_css() {
    echo '<style>' . hdgavi_seo_admin_css() . '</style>';
}
function hdgavi_seo_admin_print_js() {
    echo '<script>' . hdgavi_seo_admin_js() . '</script>';
}

/* ═══════════════════════════════════════
   3. AJAX SAVE HANDLER
   ═══════════════════════════════════════ */
function hdgavi_seo_save_ajax() {
    check_ajax_referer( 'hdgavi_seo_save', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Unauthorized.' ) );
    }

    $fields = json_decode( wp_unslash( $_POST['fields'] ?? '{}' ), true );
    if ( ! is_array( $fields ) ) {
        wp_send_json_error( array( 'message' => 'Invalid data.' ) );
    }

    // Whitelist of allowed setting keys
    $allowed_prefixes = array( 'seo_', 'contact_twitter', 'ga_id' );
    $saved = 0;

    foreach ( $fields as $key => $value ) {
        $allowed = false;
        foreach ( $allowed_prefixes as $prefix ) {
            if ( strpos( $key, $prefix ) === 0 ) { $allowed = true; break; }
        }
        if ( ! $allowed ) continue;

        if ( $key === 'seo_og_image' || $key === 'contact_twitter' ) {
            $value = esc_url_raw( $value );
        } elseif ( $key === 'seo_indexation' ) {
            $value = (bool) $value;
        } else {
            $value = sanitize_text_field( $value );
        }
        set_theme_mod( $key, $value );
        $saved++;
    }

    wp_send_json_success( array( 'message' => $saved . ' settings saved.', 'count' => $saved ) );
}
add_action( 'wp_ajax_hdgavi_seo_save', 'hdgavi_seo_save_ajax' );

/* ═══════════════════════════════════════
   4. PAGE DEFINITIONS
   ═══════════════════════════════════════ */
function hdgavi_seo_get_pages() {
    return array(
        'home'           => array( 'label' => 'Home' ),
        'about'          => array( 'label' => 'About' ),
        'skills'         => array( 'label' => 'Skills' ),
        'experience'     => array( 'label' => 'Experience' ),
        'projects'       => array( 'label' => 'Projects' ),
        'education'      => array( 'label' => 'Education' ),
        'contact'        => array( 'label' => 'Contact' ),
        'certifications' => array( 'label' => 'Certifications' ),
        'timeline'       => array( 'label' => 'Timeline' ),
        'stack'          => array( 'label' => 'Stack' ),
        'watch'          => array( 'label' => 'Tech watch' ),
        'blog'           => array( 'label' => 'Blog' ),
        'testimonials'   => array( 'label' => 'Testimonials' ),
        'presentation'   => array( 'label' => 'Presentation' ),
        'newsletter'     => array( 'label' => 'Newsletter' ),
        'uses'           => array( 'label' => 'Uses / Setup' ),
        'roadmap'        => array( 'label' => 'Roadmap' ),
        'availability'   => array( 'label' => 'Availability' ),
        'services'       => array( 'label' => 'Services' ),
        'booking'        => array( 'label' => 'Booking' ),
        'resources'      => array( 'label' => 'Resources' ),
        'analytics'      => array( 'label' => 'Analytics' ),
        'legal'          => array( 'label' => 'Legal' ),
    );
}

/* ═══════════════════════════════════════
   5. RENDER PAGE
   ═══════════════════════════════════════ */
function hdgavi_seo_admin_render() {
    $pages = hdgavi_seo_get_pages();
    $nonce = wp_create_nonce( 'hdgavi_seo_save' );

    // Count filled fields
    $filled = 0;
    $total  = 0;
    foreach ( $pages as $slug => $info ) {
        foreach ( array( 'title_en', 'title_fr', 'title_es', 'desc_en', 'desc_fr', 'desc_es' ) as $f ) {
            $total++;
            if ( hdgavi_opt( "seo_{$slug}_{$f}", '' ) !== '' ) $filled++;
        }
    }
    $pct = $total > 0 ? round( ( $filled / $total ) * 100 ) : 0;
    ?>
    <div class="wrap hdgavi-seo-wrap">

        <!-- Header -->
        <div class="hdgavi-header">
            <div class="hdgavi-header-left">
                <div>
                    <h1>SEO Settings</h1>
                    <p class="hdgavi-setup-intro">Manage meta titles, descriptions, JSON-LD schema, and social sharing for all pages.</p>
                </div>
            </div>
            <div class="hdgavi-header-right">
                <span class="hdgavi-version">v<?php echo esc_html( HDGAVI_VERSION ); ?></span>
            </div>
        </div>

        <!-- Toast -->
        <div class="hdgavi-toast" id="seoToast">
            <span class="hdgavi-toast-icon" id="seoToastIcon"></span>
            <div class="hdgavi-toast-body">
                <div class="hdgavi-toast-title" id="seoToastTitle"></div>
                <div class="hdgavi-toast-msg" id="seoToastMsg"></div>
            </div>
            <button class="hdgavi-toast-close" id="seoToastClose" type="button">&times;</button>
        </div>

        <!-- Progress -->
        <div class="hdgavi-progress-panel">
            <div class="hdgavi-progress-stats">
                <div class="hdgavi-stat-circle">
                    <svg viewBox="0 0 36 36" class="hdgavi-circular-chart">
                        <path class="hdgavi-circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        <path class="hdgavi-circle-fill" stroke-dasharray="<?php echo intval( $pct ); ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                    </svg>
                    <div class="hdgavi-stat-number"><?php echo intval( $pct ); ?>%</div>
                </div>
                <div>
                    <div class="hdgavi-stat-label">SEO Completion</div>
                    <div class="hdgavi-stat-sub"><?php echo intval( $filled ); ?> / <?php echo intval( $total ); ?> fields filled (titles and descriptions, EN/FR/ES)</div>
                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="hdgavi-seo-tabs">
            <button type="button" class="hdgavi-seo-tab active" data-tab="pages">Per-page SEO</button>
            <button type="button" class="hdgavi-seo-tab" data-tab="jsonld">JSON-LD</button>
            <button type="button" class="hdgavi-seo-tab" data-tab="social">Social and Open Graph</button>
            <button type="button" class="hdgavi-seo-tab" data-tab="advanced">Advanced</button>
        </div>

        <form id="hdgavi-seo-form">
            <input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>">

            <!-- TAB: Per-Page SEO -->
            <div class="hdgavi-seo-panel active" data-panel="pages">

                <!-- Page sub-tabs -->
                <div class="hdgavi-page-tabs" id="pageTabs">
                    <?php $first = true; foreach ( $pages as $slug => $info ) : ?>
                    <button type="button" class="hdgavi-page-tab<?php echo $first ? ' active' : ''; ?>" data-page="<?php echo esc_attr( $slug ); ?>">
                        <span><?php echo esc_html( $info['label'] ); ?></span>
                        <?php
                        $has_en = hdgavi_opt( "seo_{$slug}_title_en", '' ) !== '' || hdgavi_opt( "seo_{$slug}_desc_en", '' ) !== '';
                        $has_fr = hdgavi_opt( "seo_{$slug}_title_fr", '' ) !== '' || hdgavi_opt( "seo_{$slug}_desc_fr", '' ) !== '';
                        if ( $has_en && $has_fr ) : ?>
                            <span class="hdgavi-page-tab-dot done"></span>
                        <?php elseif ( $has_en || $has_fr ) : ?>
                            <span class="hdgavi-page-tab-dot partial"></span>
                        <?php endif; ?>
                    </button>
                    <?php $first = false; endforeach; ?>
                </div>

                <!-- Page fields -->
                <?php $first = true; foreach ( $pages as $slug => $info ) : ?>
                <div class="hdgavi-page-fields<?php echo $first ? ' active' : ''; ?>" data-page-fields="<?php echo esc_attr( $slug ); ?>">
                    <div class="hdgavi-field-header">
                        <h3><?php echo esc_html( $info['label'] ); ?></h3>
                    </div>

                    <?php foreach ( array( 'en' => 'English', 'fr' => 'Fran&ccedil;ais', 'es' => 'Espa&ntilde;ol' ) as $lang => $lang_label ) : ?>
                    <div class="hdgavi-lang-group">
                        <div class="hdgavi-lang-badge"><?php echo strtoupper( $lang ); ?></div>
                        <div class="hdgavi-lang-fields">
                            <div class="hdgavi-field">
                                <label>SEO Title (<?php echo $lang_label; ?>)</label>
                                <input type="text" name="seo_<?php echo esc_attr( $slug ); ?>_title_<?php echo $lang; ?>" value="<?php echo esc_attr( hdgavi_opt( "seo_{$slug}_title_{$lang}", '' ) ); ?>" placeholder="<?php echo esc_attr( hdgavi_opt( 'general_name', '' ) ); ?> — <?php echo esc_attr( $info['label'] ); ?>">
                                <span class="hdgavi-char-count"></span>
                            </div>
                            <div class="hdgavi-field">
                                <label>Meta Description (<?php echo $lang_label; ?>)</label>
                                <textarea name="seo_<?php echo esc_attr( $slug ); ?>_desc_<?php echo $lang; ?>" rows="2" placeholder="155-160 characters recommended"><?php echo esc_textarea( hdgavi_opt( "seo_{$slug}_desc_{$lang}", '' ) ); ?></textarea>
                                <span class="hdgavi-char-count"></span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>

                    <!-- SERP preview -->
                    <div class="hdgavi-serp-preview">
                        <div class="hdgavi-serp-label">Google Preview</div>
                        <div class="hdgavi-serp-card">
                            <div class="hdgavi-serp-url"><?php echo esc_html( home_url( '/' . $slug . '/' ) ); ?></div>
                            <div class="hdgavi-serp-title" data-preview-title="seo_<?php echo esc_attr( $slug ); ?>_title_<?php echo esc_attr( hdgavi_opt( 'default_lang', 'en' ) ); ?>"><?php echo esc_html( hdgavi_opt( "seo_{$slug}_title_" . hdgavi_opt( 'default_lang', 'en' ), hdgavi_opt( 'general_name', '' ) . ' — ' . $info['label'] ) ); ?></div>
                            <div class="hdgavi-serp-desc" data-preview-desc="seo_<?php echo esc_attr( $slug ); ?>_desc_<?php echo esc_attr( hdgavi_opt( 'default_lang', 'en' ) ); ?>"><?php echo esc_html( hdgavi_opt( "seo_{$slug}_desc_" . hdgavi_opt( 'default_lang', 'en' ), '' ) ); ?></div>
                        </div>
                    </div>
                </div>
                <?php $first = false; endforeach; ?>
            </div>

            <!-- TAB: JSON-LD & Schema -->
            <div class="hdgavi-seo-panel" data-panel="jsonld">
                <div class="hdgavi-panel-section">
                    <h3>Person (JSON-LD)</h3>
                    <p class="description">Printed on the home and About pages: name, job title, employer, address (from the CV location), LinkedIn, GitHub and site URL.</p>

                    <div class="hdgavi-fields-grid">
                        <div class="hdgavi-field">
                            <label>Job title</label>
                            <input type="text" name="seo_job_title" value="<?php echo esc_attr( hdgavi_opt( 'seo_job_title', 'DevOps / Cloud Native Engineer' ) ); ?>">
                        </div>
                        <div class="hdgavi-field">
                            <label>Employer <span class="hdgavi-optional">worksFor, leave empty to omit</span></label>
                            <input type="text" name="seo_company" value="<?php echo esc_attr( hdgavi_opt( 'seo_company', 'Dassault Systèmes' ) ); ?>">
                        </div>
                    </div>
                </div>

                <div class="hdgavi-panel-section">
                    <h3>WebSite</h3>
                    <p class="description">Includes <code>SearchAction</code> for Google Sitelinks and <code>SiteNavigationElement</code> for site structure. Generated automatically on the homepage.</p>
                    <div class="hdgavi-info-box">
                        <strong>Auto-generated:</strong> WebSite name, URL, SearchAction, and SiteNavigationElement (from your published portfolio pages) are generated automatically. No configuration needed.
                    </div>
                </div>
            </div>

            <!-- TAB: Social & OG -->
            <div class="hdgavi-seo-panel" data-panel="social">
                <div class="hdgavi-panel-section">
                    <h3>Open Graph</h3>
                    <div class="hdgavi-fields-grid">
                        <div class="hdgavi-field">
                            <label>OG Type</label>
                            <select name="seo_og_type">
                                <?php $og_type = hdgavi_opt( 'seo_og_type', 'website' ); ?>
                                <option value="website" <?php selected( $og_type, 'website' ); ?>>website</option>
                                <option value="profile" <?php selected( $og_type, 'profile' ); ?>>profile</option>
                                <option value="article" <?php selected( $og_type, 'article' ); ?>>article</option>
                            </select>
                        </div>
                        <div class="hdgavi-field">
                            <label>OG Image URL</label>
                            <input type="url" name="seo_og_image" value="<?php echo esc_attr( hdgavi_opt( 'seo_og_image', '' ) ); ?>" placeholder="https://...">
                        </div>
                    </div>
                </div>

                <div class="hdgavi-panel-section">
                    <h3>Twitter / X</h3>
                    <div class="hdgavi-fields-grid">
                        <div class="hdgavi-field">
                            <label>Card Type</label>
                            <select name="seo_twitter_card">
                                <?php $tw_card = hdgavi_opt( 'seo_twitter_card', 'summary_large_image' ); ?>
                                <option value="summary_large_image" <?php selected( $tw_card, 'summary_large_image' ); ?>>summary_large_image</option>
                                <option value="summary" <?php selected( $tw_card, 'summary' ); ?>>summary</option>
                            </select>
                        </div>
                        <div class="hdgavi-field">
                            <label>Twitter/X Profile URL</label>
                            <input type="url" name="contact_twitter" value="<?php echo esc_attr( hdgavi_opt( 'contact_twitter', '' ) ); ?>" placeholder="https://x.com/username">
                            <span class="hdgavi-hint">Used for the <code>twitter:site</code> meta tag.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- TAB: Advanced -->
            <div class="hdgavi-seo-panel" data-panel="advanced">
                <div class="hdgavi-panel-section">
                    <h3>Indexation</h3>
                    <div class="hdgavi-field">
                        <label class="hdgavi-checkbox-label">
                            <input type="checkbox" name="seo_indexation" value="1" <?php checked( hdgavi_opt( 'seo_indexation', true ) ); ?>>
                            Allow search engine indexation
                        </label>
                        <span class="hdgavi-hint">Uncheck to add <code>noindex, nofollow</code> — blocks Google, Bing, etc.</span>
                    </div>
                </div>
                <div class="hdgavi-panel-section">
                    <h3>Google Analytics</h3>
                    <div class="hdgavi-field" style="max-width:400px">
                        <label>Google Analytics ID</label>
                        <input type="text" name="ga_id" value="<?php echo esc_attr( hdgavi_opt( 'ga_id', '' ) ); ?>" placeholder="G-XXXXXXXXXX">
                    </div>
                </div>
            </div>

        </form>

        <!-- Sticky save bar -->
        <div class="hdgavi-action-bar">
            <div class="hdgavi-action-bar-inner">
                <div class="hdgavi-action-left">
                    <span class="hdgavi-unsaved" id="seoUnsaved" style="display:none">Unsaved changes</span>
                </div>
                <div class="hdgavi-action-right">
                    <button type="button" class="hdgavi-btn hdgavi-btn-primary" id="seoSaveBtn">Save All Settings</button>
                </div>
            </div>
        </div>

    </div>
    <?php
}

/* ═══════════════════════════════════════
   6. CSS
   ═══════════════════════════════════════ */
function hdgavi_seo_admin_css() {
    return '
    .hdgavi-seo-wrap{max-width:1060px;padding-bottom:120px}

    /* Header */
    .hdgavi-header{display:flex;align-items:flex-end;justify-content:space-between;margin:12px 0 24px;padding:0 0 16px;border-bottom:1px solid #dcdcde}
    .hdgavi-header-left{display:flex;align-items:center;gap:12px}
    .hdgavi-header h1{font-size:22px;margin:0;padding:0;font-weight:600;color:#1d2327}
    .hdgavi-setup-intro{color:#50575e;font-size:13px;margin:4px 0 0}
    .hdgavi-version{color:#50575e;font-size:12px}

    /* Progress */
    .hdgavi-progress-panel{display:flex;align-items:center;gap:24px;padding:16px 20px;margin-bottom:24px;background:#fff;border:1px solid #dcdcde;border-radius:2px}
    .hdgavi-progress-stats{display:flex;align-items:center;gap:16px}
    .hdgavi-stat-circle{position:relative;width:56px;height:56px;flex-shrink:0}
    .hdgavi-circular-chart{width:56px;height:56px;transform:rotate(-90deg)}
    .hdgavi-circle-bg{fill:none;stroke:#dcdcde;stroke-width:3}
    .hdgavi-circle-fill{fill:none;stroke:#2A5878;stroke-width:3}
    .hdgavi-stat-number{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:600;color:#1d2327}
    .hdgavi-stat-label{font-size:14px;font-weight:600;color:#1d2327}
    .hdgavi-stat-sub{font-size:13px;color:#50575e;margin-top:2px}

    /* Toast */
    .hdgavi-toast{position:fixed;top:40px;right:24px;z-index:100001;display:none;align-items:flex-start;gap:12px;padding:12px 40px 12px 16px;min-width:300px;max-width:480px;background:#fff;border:1px solid #8c8f94;border-radius:2px;box-shadow:0 2px 8px rgba(0,0,0,.12)}
    .hdgavi-toast.visible{display:flex}
    .hdgavi-toast.error{border-color:#b32d2e}
    .hdgavi-toast-icon{display:none}
    .hdgavi-toast-body{flex:1;min-width:0}
    .hdgavi-toast-title{font-weight:600;font-size:14px;color:#1d2327}
    .hdgavi-toast.error .hdgavi-toast-title{color:#b32d2e}
    .hdgavi-toast-msg{font-size:13px;color:#50575e;margin-top:3px}
    .hdgavi-toast-close{position:absolute;top:6px;right:8px;font-size:18px;color:#50575e;cursor:pointer;background:none;border:none;padding:4px;line-height:1}

    /* Main tabs */
    .hdgavi-seo-tabs{display:flex;margin:0;border-bottom:1px solid #dcdcde;overflow-x:auto}
    .hdgavi-seo-tab{margin-bottom:-1px;padding:10px 16px;font-size:13px;font-weight:600;color:#50575e;background:none;border:1px solid transparent;border-bottom:0;cursor:pointer;white-space:nowrap;font-family:inherit}
    .hdgavi-seo-tab:hover{color:#1d2327}
    .hdgavi-seo-tab.active{color:#1d2327;background:#fff;border-color:#dcdcde}

    /* Tab panels */
    .hdgavi-seo-panel{display:none;background:#fff;border:1px solid #dcdcde;border-top:0;padding:24px}
    .hdgavi-seo-panel.active{display:block}

    /* Page sub-tabs */
    .hdgavi-page-tabs{display:flex;flex-wrap:wrap;gap:4px;margin-bottom:20px;padding-bottom:16px;border-bottom:1px solid #dcdcde}
    .hdgavi-page-tab{display:inline-flex;align-items:center;gap:6px;padding:5px 10px;font-size:12px;color:#50575e;background:#f6f7f7;border:1px solid #dcdcde;border-radius:2px;cursor:pointer;white-space:nowrap;font-family:inherit}
    .hdgavi-page-tab:hover{color:#1d2327;border-color:#8c8f94}
    .hdgavi-page-tab.active{color:#fff;background:#2A5878;border-color:#2A5878}
    .hdgavi-page-tab-dot{width:6px;height:6px;border-radius:50%;flex-shrink:0;border:1px solid currentColor}
    .hdgavi-page-tab-dot.done{background:currentColor}

    /* Page field panels */
    .hdgavi-page-fields{display:none}
    .hdgavi-page-fields.active{display:block}
    .hdgavi-field-header{margin-bottom:8px}
    .hdgavi-field-header h3{font-size:15px;margin:0;font-weight:600;color:#1d2327}

    /* Language groups */
    .hdgavi-lang-group{display:flex;gap:16px;padding:16px 0;border-top:1px solid #dcdcde}
    .hdgavi-lang-badge{width:32px;flex-shrink:0;padding-top:22px;font-family:Menlo,Consolas,monospace;font-size:12px;font-weight:600;color:#50575e}
    .hdgavi-lang-fields{flex:1;display:flex;flex-direction:column;gap:12px}

    /* Fields */
    .hdgavi-field{display:flex;flex-direction:column;gap:4px}
    .hdgavi-field label{font-size:13px;font-weight:600;color:#1d2327}
    .hdgavi-field input[type="text"],.hdgavi-field input[type="url"],.hdgavi-field textarea,.hdgavi-field select{width:100%;padding:6px 10px;border:1px solid #8c8f94;border-radius:2px;font-size:14px;font-family:inherit;background:#fff}
    .hdgavi-field input:focus,.hdgavi-field textarea:focus,.hdgavi-field select:focus{outline:2px solid #2A5878;outline-offset:0;border-color:#2A5878;box-shadow:none}
    .hdgavi-field textarea{resize:vertical;min-height:56px}
    .hdgavi-fields-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:16px;margin-top:16px}
    .hdgavi-field.full-width{grid-column:1/-1}
    .hdgavi-char-count{font-size:11px;color:#646970;text-align:right}
    .hdgavi-char-count.warn{color:#996800}
    .hdgavi-char-count.danger{color:#b32d2e}
    .hdgavi-optional{font-size:12px;font-weight:400;color:#646970}
    .hdgavi-hint{font-size:12px;color:#646970;font-weight:400}
    .hdgavi-hint code{padding:1px 4px;font-size:12px}
    .hdgavi-checkbox-label{display:flex;align-items:center;gap:8px;font-size:14px;cursor:pointer;font-weight:400}
    .hdgavi-checkbox-label input{width:16px;height:16px}

    /* SERP preview */
    .hdgavi-serp-preview{margin-top:20px;padding-top:16px;border-top:1px solid #dcdcde}
    .hdgavi-serp-label{font-size:12px;font-weight:600;color:#646970;margin-bottom:8px}
    .hdgavi-serp-card{max-width:600px;padding:12px 0}
    .hdgavi-serp-url{font-size:12px;color:#202124;font-family:Arial,sans-serif;margin-bottom:2px}
    .hdgavi-serp-title{font-size:18px;color:#1a0dab;font-family:Arial,sans-serif;line-height:1.3;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .hdgavi-serp-desc{font-size:13px;color:#4d5156;font-family:Arial,sans-serif;line-height:1.5;margin-top:2px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}

    /* Panel sections */
    .hdgavi-panel-section{margin-bottom:24px;padding-bottom:24px;border-bottom:1px solid #dcdcde}
    .hdgavi-panel-section:last-child{border-bottom:none;margin-bottom:0;padding-bottom:0}
    .hdgavi-panel-section h3{font-size:15px;font-weight:600;color:#1d2327;margin:0 0 4px}
    .hdgavi-panel-section .description{font-size:13px;color:#50575e;margin:0}
    .hdgavi-info-box{margin-top:16px;padding:12px 16px;background:#f6f7f7;border:1px solid #dcdcde;border-radius:2px;font-size:13px;color:#1d2327}

    /* Sticky action bar */
    .hdgavi-action-bar{position:sticky;bottom:0;z-index:100;margin:24px 0 0}
    .hdgavi-action-bar-inner{display:flex;align-items:center;justify-content:space-between;padding:12px 20px;background:#fff;border:1px solid #dcdcde;border-radius:2px}
    .hdgavi-action-left{font-size:13px;color:#996800;font-weight:600}
    .hdgavi-action-right{display:flex;align-items:center;gap:8px}

    /* Buttons */
    .hdgavi-btn{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;font-size:13px;font-weight:600;border-radius:2px;border:1px solid transparent;cursor:pointer;font-family:inherit;white-space:nowrap}
    .hdgavi-btn-primary{background:#2A5878;border-color:#2A5878;color:#fff}
    .hdgavi-btn-primary:hover,.hdgavi-btn-primary:focus{background:#1E4460;border-color:#1E4460;color:#fff}
    .hdgavi-btn-loading{opacity:.6;pointer-events:none}
    .hdgavi-unsaved{display:inline-flex;align-items:center;gap:6px}

    @media(max-width:782px){
        .hdgavi-fields-grid{grid-template-columns:1fr}
        .hdgavi-lang-group{flex-direction:column}
        .hdgavi-lang-badge{padding-top:0}
        .hdgavi-action-bar-inner{flex-direction:column;gap:12px;text-align:center}
    }
    ';
}

/* ═══════════════════════════════════════
   7. JAVASCRIPT
   ═══════════════════════════════════════ */
function hdgavi_seo_admin_js() {
    return "
    (function(){
        /* ── Toast ── */
        var toast = document.getElementById('seoToast');
        function showToast(title, msg, type, duration) {
            document.getElementById('seoToastTitle').textContent = title;
            document.getElementById('seoToastMsg').textContent = msg;
            toast.className = 'hdgavi-toast visible ' + type;
            if (duration) setTimeout(function(){ toast.className = 'hdgavi-toast'; }, duration);
        }
        document.getElementById('seoToastClose').addEventListener('click', function(){ toast.className = 'hdgavi-toast'; });

        /* ── Main tabs ── */
        var tabs = document.querySelectorAll('.hdgavi-seo-tab');
        var panels = document.querySelectorAll('.hdgavi-seo-panel');
        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                tabs.forEach(function(t){ t.classList.remove('active'); });
                panels.forEach(function(p){ p.classList.remove('active'); });
                tab.classList.add('active');
                document.querySelector('[data-panel=\"' + tab.dataset.tab + '\"]').classList.add('active');
            });
        });

        /* ── Page sub-tabs ── */
        var pageTabs = document.querySelectorAll('.hdgavi-page-tab');
        var pageFields = document.querySelectorAll('.hdgavi-page-fields');
        pageTabs.forEach(function(pt) {
            pt.addEventListener('click', function() {
                pageTabs.forEach(function(t){ t.classList.remove('active'); });
                pageFields.forEach(function(f){ f.classList.remove('active'); });
                pt.classList.add('active');
                document.querySelector('[data-page-fields=\"' + pt.dataset.page + '\"]').classList.add('active');
            });
        });

        /* ── Character counters ── */
        function updateCharCount(input) {
            var counter = input.parentElement.querySelector('.hdgavi-char-count');
            if (!counter) return;
            var len = input.value.length;
            var isTitle = input.name.indexOf('_title_') > -1;
            var max = isTitle ? 60 : 160;
            var warn = isTitle ? 50 : 140;
            counter.textContent = len + ' / ' + max;
            counter.className = 'hdgavi-char-count' + (len > max ? ' danger' : len > warn ? ' warn' : '');
        }
        document.querySelectorAll('.hdgavi-lang-fields input, .hdgavi-lang-fields textarea').forEach(function(el) {
            updateCharCount(el);
            el.addEventListener('input', function(){ updateCharCount(el); updatePreview(el); setUnsaved(); });
        });

        /* ── SERP preview ── */
        function updatePreview(input) {
            var name = input.name;
            var titleEl = document.querySelector('[data-preview-title=\"' + name + '\"]');
            var descEl = document.querySelector('[data-preview-desc=\"' + name + '\"]');
            if (titleEl) titleEl.textContent = input.value || titleEl.dataset.previewTitle;
            if (descEl) descEl.textContent = input.value || '';
        }

        /* ── Unsaved indicator ── */
        var unsaved = document.getElementById('seoUnsaved');
        var isDirty = false;
        function setUnsaved() { isDirty = true; unsaved.style.display = ''; }
        document.querySelectorAll('#hdgavi-seo-form input, #hdgavi-seo-form textarea, #hdgavi-seo-form select').forEach(function(el) {
            el.addEventListener('change', setUnsaved);
        });

        /* ── Save ── */
        var saveBtn = document.getElementById('seoSaveBtn');
        saveBtn.addEventListener('click', function() {
            saveBtn.classList.add('hdgavi-btn-loading');
            showToast('Saving...', 'Updating SEO settings', 'loading');

            var form = document.getElementById('hdgavi-seo-form');
            var fields = {};
            form.querySelectorAll('input[name], textarea[name], select[name]').forEach(function(el) {
                if (el.type === 'checkbox') {
                    fields[el.name] = el.checked ? '1' : '';
                } else {
                    fields[el.name] = el.value;
                }
            });

            var fd = new FormData();
            fd.append('action', 'hdgavi_seo_save');
            fd.append('nonce', form.querySelector('[name=nonce]').value);
            fd.append('fields', JSON.stringify(fields));

            fetch(ajaxurl, { method: 'POST', body: fd, credentials: 'same-origin' })
                .then(function(r){ return r.json(); })
                .then(function(data) {
                    saveBtn.classList.remove('hdgavi-btn-loading');
                    if (data.success) {
                        showToast('Saved', data.data.message, 'success', 3000);
                        isDirty = false;
                        unsaved.style.display = 'none';
                    } else {
                        showToast('Error', data.data.message || 'Save failed', 'error', 4000);
                    }
                })
                .catch(function(err) {
                    saveBtn.classList.remove('hdgavi-btn-loading');
                    showToast('Error', err.message, 'error', 4000);
                });
        });

        /* ── Warn on leave ── */
        window.addEventListener('beforeunload', function(e) {
            if (isDirty) { e.preventDefault(); e.returnValue = ''; }
        });
    })();
    ";
}
