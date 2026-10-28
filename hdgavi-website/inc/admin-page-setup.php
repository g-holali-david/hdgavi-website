<?php
/**
 * HD GAVI Portfolio — Admin: Page Setup Wizard v2
 * Modern dashboard with visual page cards, progress indicators,
 * page creation/deletion, template repair, and demo content import.
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Master list of all portfolio pages.
 * slug => [ title, template, description_fr, group, icon_emoji ]
 */
function hdgavi_get_portfolio_pages() {
    return array(
        // ── Core (essential) ──
        'splash'         => array( 'Home',           'page-templates/splash.php',           'Page d\'accueil avec terminal animé',       'core',     '🏠' ),
        'about'          => array( 'About',          'page-templates/about.php',            'Présentation personnelle',                  'core',     '👤' ),
        'skills'         => array( 'Skills',         'page-templates/skills.php',           'Compétences techniques',                    'core',     '⚡' ),
        'experience'     => array( 'Experience',     'page-templates/experience.php',       'Parcours professionnel',                    'core',     '💼' ),
        'projects'       => array( 'Projects',       'page-templates/projects.php',         'Réalisations et projets',                   'core',     '🚀' ),
        'education'      => array( 'Education',      'page-templates/education.php',        'Formation académique',                      'core',     '🎓' ),
        'contact'        => array( 'Contact',        'page-templates/contact.php',          'Formulaire de contact',                     'core',     '✉️' ),

        // ── Extended ──
        'certifications' => array( 'Certifications', 'page-templates/certifications.php',   'Certifications & badges',                   'extended', '🏅' ),
        'timeline'       => array( 'Timeline',       'page-templates/timeline.php',         'Frise chronologique complète',              'extended', '📅' ),
        'stack'          => array( 'Tech Stack',     'page-templates/stack.php',            'Stack technique détaillée',                  'extended', '🔧' ),
        'watch'          => array( 'Tech Watch',     'page-templates/watch.php',            'Veille technologique',                      'extended', '📡' ),
        'blog'           => array( 'Blog',           'page-templates/blog.php',             'Articles de blog',                          'extended', '📝' ),
        'testimonials'   => array( 'Testimonials',   'page-templates/testimonials.php',     'Témoignages et recommandations',            'extended', '💬' ),

        // ── Extras ──
        'presentation'   => array( 'Presentation',   'page-templates/presentation.php',    'Mode présentation fullscreen',              'extra',    '🎬' ),
        'terminal'       => array( 'Terminal',        'page-templates/terminal.php',        'Terminal interactif (easter egg)',           'extra',    '🖥️' ),
        'newsletter'     => array( 'Newsletter',     'page-templates/newsletter.php',      'Inscription newsletter',                    'extra',    '📨' ),
        'uses'           => array( 'Uses',           'page-templates/uses.php',             'Setup, outils et équipement',               'extra',    '🛠️' ),
        'roadmap'        => array( 'Roadmap',        'page-templates/roadmap.php',          'Objectifs et roadmap',                      'extra',    '🗺️' ),
        'availability'   => array( 'Availability',   'page-templates/availability.php',    'Statut de disponibilité',                   'extra',    '📊' ),
        'services'       => array( 'Services',       'page-templates/services.php',        'Consulting, audits & formation',            'extra',    '💼' ),
        'booking'        => array( 'Booking',        'page-templates/booking.php',          'Prise de rendez-vous',                      'extra',    '📆' ),
        'resources'      => array( 'Resources',      'page-templates/resources.php',        'Ressources téléchargeables',                'extra',    '📦' ),
        'analytics'      => array( 'Analytics',      'page-templates/analytics.php',        'Dashboard analytics public',                'extra',    '📈' ),
        'legal'          => array( 'Legal',          'page-templates/legal.php',            'Mentions légales & confidentialité',         'extra',    '⚖️' ),
    );
}

/**
 * Register admin menu page under Appearance
 */
function hdgavi_admin_menu() {
    add_theme_page(
        __( 'Portfolio Setup', 'hdgavi-portfolio' ),
        __( '🎨 Portfolio Setup', 'hdgavi-portfolio' ),
        'edit_pages',
        'hdgavi-setup',
        'hdgavi_setup_page_render'
    );
}
add_action( 'admin_menu', 'hdgavi_admin_menu' );

/**
 * Show admin notice after theme activation
 */
function hdgavi_activation_notice() {
    if ( get_transient( 'hdgavi_activation_notice' ) ) {
        $url = admin_url( 'themes.php?page=hdgavi-setup' );
        echo '<div class="notice notice-info is-dismissible">';
        echo '<p><strong>HD GAVI Portfolio</strong> — ';
        echo sprintf(
            __( 'Le thème est activé ! <a href="%s">Créez les pages du portfolio</a> en un clic.', 'hdgavi-portfolio' ),
            esc_url( $url )
        );
        echo '</p></div>';
        delete_transient( 'hdgavi_activation_notice' );
    }
}
add_action( 'admin_notices', 'hdgavi_activation_notice' );

/**
 * Set transient on theme switch
 */
function hdgavi_set_activation_notice() {
    set_transient( 'hdgavi_activation_notice', true, 300 );
    $current = get_option( 'permalink_structure' );
    if ( empty( $current ) ) {
        update_option( 'permalink_structure', '/%postname%/' );
    }
    flush_rewrite_rules();

    // Auto-import demo content on first activation (non-destructive)
    if ( function_exists( 'hdgavi_import_demo_content' ) ) {
        hdgavi_import_demo_content( false );
    }
}
add_action( 'after_switch_theme', 'hdgavi_set_activation_notice' );

/**
 * Auto-flush rewrite rules once after theme version update
 */
function hdgavi_maybe_flush_rewrite() {
    $flushed_ver = get_option( 'hdgavi_flushed_version', '' );
    if ( $flushed_ver !== HDGAVI_VERSION ) {
        $current = get_option( 'permalink_structure' );
        if ( empty( $current ) ) {
            update_option( 'permalink_structure', '/%postname%/' );
        }
        flush_rewrite_rules();
        update_option( 'hdgavi_flushed_version', HDGAVI_VERSION );
    }
}
add_action( 'init', 'hdgavi_maybe_flush_rewrite' );

/**
 * Enqueue admin scripts only on our setup page
 */
function hdgavi_admin_setup_scripts( $hook ) {
    if ( $hook !== 'appearance_page_hdgavi-setup' ) return;
    add_action( 'admin_head', 'hdgavi_admin_setup_print_css' );
    add_action( 'admin_footer', 'hdgavi_admin_setup_print_js' );
}
add_action( 'admin_enqueue_scripts', 'hdgavi_admin_setup_scripts' );

function hdgavi_admin_setup_print_css() {
    echo '<style id="hdgavi-admin-setup-css">' . "\n";
    echo hdgavi_admin_setup_css();
    echo "\n</style>\n";
}

function hdgavi_admin_setup_print_js() {
    echo '<script id="hdgavi-admin-setup-js">' . "\n";
    echo 'var hdgaviSetup = ' . wp_json_encode( array(
        'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
        'nonce'      => wp_create_nonce( 'hdgavi_create_pages' ),
        'maintNonce' => wp_create_nonce( 'hdgavi_maint_toggle' ),
    ) ) . ';' . "\n";
    echo hdgavi_admin_setup_js();
    echo "\n</script>\n";
}

/**
 * Render the setup page
 */
function hdgavi_setup_page_render() {
    $pages  = hdgavi_get_portfolio_pages();
    $groups = array(
        'core'     => array( 'label' => 'Pages principales',     'icon' => '🏗️', 'desc' => 'Les 7 pages essentielles de votre portfolio. Recommandé : tout créer.',  'color' => '#06B6D4' ),
        'extended' => array( 'label' => 'Pages étendues',        'icon' => '🧩', 'desc' => 'Enrichissez votre portfolio avec du contenu complémentaire.',             'color' => '#8B5CF6' ),
        'extra'    => array( 'label' => 'Pages supplémentaires', 'icon' => '✨', 'desc' => 'Pages optionnelles, utilitaires et easter eggs.',                         'color' => '#F59E0B' ),
    );

    $total_existing = 0;
    $total_pages    = count( $pages );
    foreach ( $pages as $slug => $meta ) {
        $p = get_page_by_path( $slug, OBJECT, 'page' );
        if ( $p && get_post_meta( $p->ID, '_wp_page_template', true ) === $meta[1] ) $total_existing++;
    }
    $progress_pct = $total_pages > 0 ? round( ( $total_existing / $total_pages ) * 100 ) : 0;
    $is_maint   = (bool) get_theme_mod( 'maintenance_mode', false );
    $cpt_types  = array( 'hdgavi_education', 'hdgavi_experience', 'hdgavi_skill', 'hdgavi_project', 'hdgavi_certification', 'hdgavi_timeline', 'hdgavi_resource' );
    $total_cpts = 0;
    foreach ( $cpt_types as $cpt ) {
        $counts = wp_count_posts( $cpt );
        $total_cpts += ( $counts ? (int) $counts->publish : 0 );
    }

    // Maintenance text settings — labels + defaults (matching customizer-toggles.php)
    $maint_text_fields = array(
        'maintenance_title_en' => array( 'Title (EN)',  'Site under maintenance' ),
        'maintenance_title_fr' => array( 'Titre (FR)',  'Site sous maintenance' ),
        'maintenance_title_es' => array( 'Título (ES)', 'Sitio en mantenimiento' ),
        'maintenance_desc_en'  => array( 'Message (EN)', 'Come back soon!' ),
        'maintenance_desc_fr'  => array( 'Message (FR)', 'Revenez bientôt !' ),
        'maintenance_desc_es'  => array( 'Mensaje (ES)', '¡Vuelve pronto!' ),
        'maintenance_icon'     => array( 'Icon (emoji)', '🚧' ),
        'maintenance_role_en'  => array( 'Role (EN)',  '' ),
        'maintenance_role_fr'  => array( 'Rôle (FR)',  '' ),
        'maintenance_role_es'  => array( 'Rol (ES)',   '' ),
        'maintenance_company'  => array( 'Company',    '' ),
    );
    $maint_toggle_fields = array(
        'maint_show_banner'    => 'Banner',
        'maint_show_photo'     => 'Photo',
        'maint_show_role'      => 'Role & company',
        'maint_show_info'      => 'Info grid',
        'maint_show_skills'    => 'Skills tags',
        'maint_show_github'    => 'GitHub',
        'maint_show_linkedin'  => 'LinkedIn',
        'maint_show_email'     => 'Email link',
        'maint_show_cv'        => 'CV button',
        'maint_show_form'      => 'Contact form',
        'maint_show_particles' => 'Particles',
        'maint_show_lang'      => 'Lang switcher',
    );
    ?>
    <div class="wrap hdgavi-setup-wrap">

        <!-- Header -->
        <div class="hdgavi-header">
            <div class="hdgavi-header-left">
                <div class="hdgavi-logo">HD</div>
                <div>
                    <h1>Portfolio Setup</h1>
                    <p class="hdgavi-setup-intro">Configurez et gérez les pages de votre portfolio en quelques clics.</p>
                </div>
            </div>
            <div class="hdgavi-header-right">
                <span class="hdgavi-version">v<?php echo esc_html( HDGAVI_VERSION ); ?></span>
            </div>
        </div>

        <!-- Progress overview -->
        <div class="hdgavi-progress-panel">
            <div class="hdgavi-progress-stats">
                <div class="hdgavi-stat-circle">
                    <svg viewBox="0 0 36 36" class="hdgavi-circular-chart">
                        <path class="hdgavi-circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                        <path class="hdgavi-circle-fill" stroke-dasharray="<?php echo intval( $progress_pct ); ?>, 100" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831"/>
                    </svg>
                    <div class="hdgavi-stat-number"><?php echo intval( $progress_pct ); ?>%</div>
                </div>
                <div class="hdgavi-stat-details">
                    <div class="hdgavi-stat-label"><?php echo esc_html( $total_existing ); ?> / <?php echo esc_html( $total_pages ); ?> pages créées</div>
                    <div class="hdgavi-stat-sub">
                        <?php if ( $total_existing === $total_pages ) : ?>
                            Toutes les pages sont en place !
                        <?php elseif ( $total_existing === 0 ) : ?>
                            Aucune page créée. Commencez par les pages principales.
                        <?php else : ?>
                            <?php echo esc_html( $total_pages - $total_existing ); ?> page(s) restante(s) à créer.
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="hdgavi-quick-actions">
                <label class="hdgavi-toggle-option">
                    <input type="checkbox" id="hdgavi-set-frontpage" checked>
                    <span>Définir Home comme page d'accueil</span>
                </label>
                <label class="hdgavi-toggle-option">
                    <input type="checkbox" id="hdgavi-create-veille-cat" checked>
                    <span>Créer la catégorie « Veille »</span>
                </label>
            </div>
        </div>

        <!-- Status Dashboard -->
        <div class="hdgavi-status-grid">
            <div class="hdgavi-status-card <?php echo $is_maint ? 'status-on' : 'status-off'; ?>">
                <div class="hdgavi-status-card-icon">🚧</div>
                <div class="hdgavi-status-card-body">
                    <span class="hdgavi-status-card-label">Maintenance</span>
                    <span class="hdgavi-status-card-value" id="hdgavi-maint-status-text"><?php echo $is_maint ? 'Active' : 'Inactive'; ?></span>
                </div>
                <button type="button" class="hdgavi-maint-toggle-btn <?php echo $is_maint ? 'active' : ''; ?>" id="hdgavi-dashboard-maint-toggle" title="Toggle maintenance mode">
                    <span class="hdgavi-toggle-track"><span class="hdgavi-toggle-thumb"></span></span>
                </button>
            </div>
            <div class="hdgavi-status-card">
                <div class="hdgavi-status-card-icon">📄</div>
                <div class="hdgavi-status-card-body">
                    <span class="hdgavi-status-card-label">Pages</span>
                    <span class="hdgavi-status-card-value"><?php echo esc_html( $total_existing ); ?> / <?php echo esc_html( $total_pages ); ?></span>
                </div>
            </div>
            <div class="hdgavi-status-card">
                <div class="hdgavi-status-card-icon">🗂️</div>
                <div class="hdgavi-status-card-body">
                    <span class="hdgavi-status-card-label">CPT Entries</span>
                    <span class="hdgavi-status-card-value"><?php echo esc_html( $total_cpts ); ?></span>
                </div>
            </div>
            <div class="hdgavi-status-card">
                <div class="hdgavi-status-card-icon">🏷️</div>
                <div class="hdgavi-status-card-body">
                    <span class="hdgavi-status-card-label">Version</span>
                    <span class="hdgavi-status-card-value">v<?php echo esc_html( HDGAVI_VERSION ); ?></span>
                </div>
            </div>
        </div>

        <!-- Maintenance Settings Panel -->
        <div class="hdgavi-panel" id="hdgavi-maint-settings-panel">
            <div class="hdgavi-panel-header hdgavi-panel-collapsible" id="hdgavi-maint-settings-toggle" style="cursor:pointer">
                <span class="hdgavi-panel-icon">🚧</span>
                <strong>Maintenance Page Settings</strong>
                <span class="hdgavi-collapse-arrow" style="margin-left:auto;font-size:11px;color:#94A3B8;transition:transform .3s">▼</span>
            </div>
            <div class="hdgavi-panel-body" id="hdgavi-maint-settings-body" style="display:none">
                <div class="hdgavi-maint-fields-grid">
                    <?php foreach ( $maint_text_fields as $key => $field ) : ?>
                    <div class="hdgavi-maint-field">
                        <label for="mf-<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field[0] ); ?></label>
                        <input type="text" id="mf-<?php echo esc_attr( $key ); ?>" data-maint-text="<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( get_theme_mod( $key, $field[1] ) ); ?>">
                    </div>
                    <?php endforeach; ?>
                </div>
                <hr style="border:0;border-top:1px solid #e2e4e7;margin:18px 0">
                <p style="font-size:12px;font-weight:600;color:#50575e;margin:0 0 10px;text-transform:uppercase;letter-spacing:0.5px">Éléments visibles</p>
                <div class="hdgavi-maint-toggles-grid">
                    <?php foreach ( $maint_toggle_fields as $key => $label ) : ?>
                    <label class="hdgavi-toggle-option">
                        <input type="checkbox" data-maint-toggle="<?php echo esc_attr( $key ); ?>" <?php checked( get_theme_mod( $key, true ) ); ?>>
                        <span><?php echo esc_html( $label ); ?></span>
                    </label>
                    <?php endforeach; ?>
                </div>
                <div class="hdgavi-panel-actions">
                    <button type="button" class="hdgavi-btn hdgavi-btn-primary" id="hdgavi-save-maint-btn">
                        Sauvegarder
                    </button>
                </div>
            </div>
        </div>

        <?php
        $permalink_structure = get_option( 'permalink_structure' );
        if ( empty( $permalink_structure ) ) : ?>
        <div class="hdgavi-alert hdgavi-alert-warn">
            <span class="hdgavi-alert-icon">⚠️</span>
            <div>
                <strong>Permaliens non configurés</strong>
                <p>Les liens du portfolio nécessitent le format <code>/%postname%/</code>. <a href="<?php echo esc_url( admin_url( 'options-permalink.php' ) ); ?>">Configurer →</a></p>
            </div>
        </div>
        <?php endif; ?>

        <!-- Toast notification -->
        <div class="hdgavi-toast" id="hdgaviToast" aria-live="polite">
            <div class="hdgavi-toast-icon" id="hdgaviToastIcon"></div>
            <div class="hdgavi-toast-body">
                <div class="hdgavi-toast-title" id="hdgaviToastTitle"></div>
                <div class="hdgavi-toast-msg" id="hdgaviToastMsg"></div>
            </div>
            <button type="button" class="hdgavi-toast-close" id="hdgaviToastClose" aria-label="Fermer">&times;</button>
        </div>

        <!-- Page groups -->
        <?php foreach ( $groups as $group_key => $group ) :
            $group_count = 0;
            $group_existing = 0;
            foreach ( $pages as $slug => $meta ) {
                if ( $meta[3] !== $group_key ) continue;
                $group_count++;
                $p = get_page_by_path( $slug, OBJECT, 'page' );
                if ( $p && get_post_meta( $p->ID, '_wp_page_template', true ) === $meta[1] ) $group_existing++;
            }
        ?>
        <div class="hdgavi-setup-group">
            <div class="hdgavi-group-header">
                <div class="hdgavi-group-title-row">
                    <span class="hdgavi-group-icon" style="background:<?php echo esc_attr( $group['color'] ); ?>1a;color:<?php echo esc_attr( $group['color'] ); ?>"><?php echo $group['icon']; ?></span>
                    <div>
                        <h2><?php echo esc_html( $group['label'] ); ?></h2>
                        <p class="description"><?php echo esc_html( $group['desc'] ); ?></p>
                    </div>
                </div>
                <div class="hdgavi-group-counter">
                    <span class="hdgavi-group-badge" style="background:<?php echo esc_attr( $group['color'] ); ?>1a;color:<?php echo esc_attr( $group['color'] ); ?>"><?php echo esc_html( $group_existing ); ?>/<?php echo esc_html( $group_count ); ?></span>
                </div>
            </div>
            <div class="hdgavi-setup-grid">
                <?php foreach ( $pages as $slug => $meta ) :
                    if ( $meta[3] !== $group_key ) continue;
                    $existing = get_page_by_path( $slug, OBJECT, 'page' );
                    $exists   = (bool) $existing;
                    $tpl_ok   = $exists && get_post_meta( $existing->ID, '_wp_page_template', true ) === $meta[1];
                    $status   = '';
                    if ( $exists && $tpl_ok )       $status = 'exists';
                    elseif ( $exists && ! $tpl_ok )  $status = 'no-template';
                    $edit_url = $exists ? get_edit_post_link( $existing->ID ) : '';
                    $view_url = $exists ? get_permalink( $existing->ID ) : '';
                ?>
                <div class="hdgavi-setup-card <?php echo esc_attr( $status ); ?>" data-slug="<?php echo esc_attr( $slug ); ?>">
                    <div class="hdgavi-card-icon"><?php echo $meta[4]; ?></div>
                    <div class="hdgavi-card-body">
                        <div class="hdgavi-card-top">
                            <label class="hdgavi-card-label">
                                <input type="checkbox"
                                       name="hdgavi_pages[]"
                                       value="<?php echo esc_attr( $slug ); ?>"
                                       <?php echo $status === 'exists' ? 'disabled checked' : 'checked'; ?>
                                       class="hdgavi-page-cb">
                                <strong class="hdgavi-card-title"><?php echo esc_html( $meta[0] ); ?></strong>
                            </label>
                            <?php if ( $status === 'exists' ) : ?>
                                <span class="hdgavi-card-badge hdgavi-badge-ok">✓ Créée</span>
                            <?php elseif ( $status === 'no-template' ) : ?>
                                <span class="hdgavi-card-badge hdgavi-badge-warn">⚠ Template</span>
                            <?php else : ?>
                                <span class="hdgavi-card-badge hdgavi-badge-new">+ Nouvelle</span>
                            <?php endif; ?>
                        </div>
                        <code class="hdgavi-card-slug">/<?php echo esc_html( $slug ); ?>/</code>
                        <span class="hdgavi-card-desc"><?php echo esc_html( $meta[2] ); ?></span>
                        <?php if ( $exists ) : ?>
                        <div class="hdgavi-card-actions">
                            <?php if ( $view_url ) : ?><a href="<?php echo esc_url( $view_url ); ?>" target="_blank" class="hdgavi-card-link">Voir →</a><?php endif; ?>
                            <?php if ( $edit_url ) : ?><a href="<?php echo esc_url( $edit_url ); ?>" class="hdgavi-card-link">Modifier</a><?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endforeach; ?>

        <!-- Sticky action bar -->
        <div class="hdgavi-action-bar" id="hdgaviActionBar">
            <div class="hdgavi-action-bar-inner">
                <div class="hdgavi-action-left">
                    <button type="button" class="hdgavi-btn-text" id="hdgavi-select-all">Tout sélectionner</button>
                    <span class="hdgavi-separator">|</span>
                    <button type="button" class="hdgavi-btn-text" id="hdgavi-select-none">Tout décocher</button>
                    <span class="hdgavi-separator">—</span>
                    <span class="hdgavi-selected-count" id="hdgaviCount">0</span>
                </div>
                <div class="hdgavi-action-right">
                    <button type="button" class="hdgavi-btn hdgavi-btn-primary" id="hdgavi-create-btn">
                        Créer les pages
                    </button>
                    <button type="button" class="hdgavi-btn hdgavi-btn-outline" id="hdgavi-repair-btn" title="Forcer l'assignation des templates">
                        Réparer
                    </button>
                    <button type="button" class="hdgavi-btn hdgavi-btn-outline" id="hdgavi-flush-btn" title="Régénérer les permaliens">
                        Fix 404
                    </button>
                    <button type="button" class="hdgavi-btn hdgavi-btn-danger" id="hdgavi-delete-btn" title="Supprimer les pages créées par le thème">
                        Supprimer les pages
                    </button>
                </div>
            </div>
        </div>

        <!-- Demo content panel -->
        <div class="hdgavi-panel">
            <div class="hdgavi-panel-header">
                <span class="hdgavi-panel-icon">📦</span>
                <strong>Contenu de démonstration</strong>
            </div>
            <div class="hdgavi-panel-body">
                <p class="description">Pré-remplit le Customizer avec le contenu de démo (textes, compétences, expériences…). Les champs déjà renseignés ne seront pas écrasés sauf si vous cochez « Forcer ».</p>
                <div class="hdgavi-panel-actions">
                    <button type="button" class="hdgavi-btn hdgavi-btn-primary" id="hdgavi-demo-btn">
                        Importer le contenu
                    </button>
                    <label class="hdgavi-toggle-option">
                        <input type="checkbox" id="hdgavi-force-demo">
                        <span>Forcer l'écrasement</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- RSS Tech Watch panel -->
        <?php
        $rss_enabled     = (bool) hdgavi_opt( 'rss_enabled', false );
        $rss_last        = get_option( 'hdgavi_rss_last_import', '' );
        $rss_last_result = get_option( 'hdgavi_rss_last_result', array() );
        $rss_drafts      = count( get_posts( array( 'post_type' => 'post', 'post_status' => 'draft', 'meta_key' => '_hdgavi_rss', 'meta_value' => '1', 'posts_per_page' => -1, 'fields' => 'ids' ) ) );
        $rss_feeds_raw   = hdgavi_opt( 'rss_feeds', implode( "\n", function_exists( 'hdgavi_rss_default_feeds' ) ? hdgavi_rss_default_feeds() : array() ) );
        $rss_feeds       = function_exists( 'hdgavi_rss_get_feeds' ) ? hdgavi_rss_get_feeds() : array();
        $rss_max         = intval( hdgavi_opt( 'rss_max_per_feed', 5 ) );
        ?>
        <div class="hdgavi-panel" style="border-color:<?php echo $rss_enabled ? 'rgba(6,182,212,0.3)' : 'rgba(239,68,68,0.2)'; ?>">
            <div class="hdgavi-panel-header">
                <span class="hdgavi-panel-icon">📡</span>
                <strong>RSS Tech Watch</strong>
                <button type="button" class="hdgavi-maint-toggle-btn <?php echo $rss_enabled ? 'active' : ''; ?>" id="hdgavi-rss-toggle" title="Activer/désactiver l'import RSS" style="margin-left:auto">
                    <span class="hdgavi-toggle-track"><span class="hdgavi-toggle-thumb"></span></span>
                </button>
            </div>
            <div class="hdgavi-panel-body">
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:16px">
                    <div style="padding:12px 16px;background:#f8f9fa;border-radius:10px">
                        <div style="font-size:11px;color:#787c82;font-weight:600;text-transform:uppercase;letter-spacing:0.5px">Dernier import</div>
                        <div style="font-size:14px;font-weight:600;color:#1d2327;margin-top:4px"><?php echo $rss_last ? esc_html( $rss_last ) : 'Jamais'; ?></div>
                    </div>
                    <div style="padding:12px 16px;background:#f8f9fa;border-radius:10px">
                        <div style="font-size:11px;color:#787c82;font-weight:600;text-transform:uppercase;letter-spacing:0.5px">Brouillons à valider</div>
                        <div style="font-size:14px;font-weight:600;color:#1d2327;margin-top:4px"><?php echo $rss_drafts; ?> article(s) <?php if ( $rss_drafts > 0 ) : ?><a href="<?php echo esc_url( admin_url( 'edit.php?post_status=draft' ) ); ?>" style="font-size:12px">→ Voir</a><?php endif; ?></div>
                    </div>
                </div>
                <?php if ( ! empty( $rss_last_result ) ) : ?>
                <p class="description" style="margin-bottom:12px">Dernier résultat : <?php echo esc_html( sprintf( '%d importé(s), %d ignoré(s), %d erreur(s) depuis %d feed(s).', $rss_last_result['imported'] ?? 0, $rss_last_result['skipped'] ?? 0, $rss_last_result['errors'] ?? 0, $rss_last_result['feeds'] ?? 0 ) ); ?></p>
                <?php endif; ?>

                <!-- RSS Settings -->
                <div class="hdgavi-maint-fields-grid" style="margin-bottom:14px">
                    <div class="hdgavi-maint-field" style="grid-column:1/-1">
                        <label for="rss-feeds-input">Flux RSS (une URL par ligne)</label>
                        <textarea id="rss-feeds-input" data-rss-setting="rss_feeds" rows="6" style="width:100%;padding:8px 12px;border:1.5px solid #e2e4e7;border-radius:8px;font-size:12px;font-family:'JetBrains Mono',monospace;resize:vertical"><?php echo esc_textarea( $rss_feeds_raw ); ?></textarea>
                    </div>
                    <div class="hdgavi-maint-field">
                        <label for="rss-max-input">Articles max par feed</label>
                        <input type="number" id="rss-max-input" data-rss-setting="rss_max_per_feed" value="<?php echo esc_attr( $rss_max ); ?>" min="1" max="20" style="width:100%">
                    </div>
                </div>

                <div class="hdgavi-panel-actions">
                    <button type="button" class="hdgavi-btn hdgavi-btn-primary" id="hdgavi-rss-save-btn">
                        Sauvegarder
                    </button>
                    <button type="button" class="hdgavi-btn hdgavi-btn-outline" id="hdgavi-rss-import-btn">
                        Importer maintenant
                    </button>
                </div>
            </div>
        </div>

        <!-- Cleanup panel -->
        <div class="hdgavi-panel" style="border-color:rgba(239,68,68,0.3)">
            <div class="hdgavi-panel-header">
                <span class="hdgavi-panel-icon">🧹</span>
                <strong>Nettoyage complet</strong>
            </div>
            <div class="hdgavi-panel-body">
                <p class="description" style="color:#EF4444;">Supprime <strong>tous</strong> les contenus créés par le thème : CPT (education, experience, skills, projects, certifications, timeline, resources), articles de démo, pages du portfolio, options et flags d'import. <strong>Faites ceci avant de désinstaller le thème.</strong></p>
                <div class="hdgavi-panel-actions">
                    <button type="button" class="hdgavi-btn hdgavi-btn-danger" id="hdgavi-cleanup-btn">
                        Tout supprimer
                    </button>
                </div>
            </div>
        </div>

        <!-- Results -->
        <div id="hdgavi-results" class="hdgavi-results" style="display:none"></div>
    </div>
    <?php
}

/* ═══════════════════════════════════════
   AJAX HANDLERS
   ═══════════════════════════════════════ */

/**
 * Create selected pages
 */
function hdgavi_ajax_create_pages() {
    check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
    if ( ! current_user_can( 'edit_pages' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    $slugs         = isset( $_POST['slugs'] ) ? array_map( 'sanitize_key', (array) $_POST['slugs'] ) : array();
    $set_front     = ! empty( $_POST['set_frontpage'] );
    $create_veille = ! empty( $_POST['create_veille'] );
    $all_pages     = hdgavi_get_portfolio_pages();
    $results       = array();

    foreach ( $slugs as $slug ) {
        if ( ! isset( $all_pages[ $slug ] ) ) continue;
        $meta     = $all_pages[ $slug ];
        $existing = get_page_by_path( $slug, OBJECT, 'page' );

        if ( $existing ) {
            $current_tpl = get_post_meta( $existing->ID, '_wp_page_template', true );
            if ( empty( $current_tpl ) || $current_tpl === 'default' ) {
                update_post_meta( $existing->ID, '_wp_page_template', $meta[1] );
                $results[] = array( 'slug' => $slug, 'status' => 'fixed', 'message' => $meta[0] . ' — template corrigé' );
            } else {
                $results[] = array( 'slug' => $slug, 'status' => 'skipped', 'message' => $meta[0] . ' — existe déjà' );
            }
            if ( $slug === 'splash' && $set_front ) {
                update_option( 'show_on_front', 'page' );
                update_option( 'page_on_front', $existing->ID );
            }
            continue;
        }

        $page_id = wp_insert_post( array(
            'post_title'   => $meta[0],
            'post_name'    => $slug,
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
            'post_author'  => get_current_user_id() ?: 1,
        ) );

        if ( is_wp_error( $page_id ) ) {
            $results[] = array( 'slug' => $slug, 'status' => 'error', 'message' => $meta[0] . ' — ' . $page_id->get_error_message() );
            continue;
        }

        update_post_meta( $page_id, '_wp_page_template', $meta[1] );
        $tracked = get_option( 'hdgavi_created_page_ids', array() );
        $tracked[ $slug ] = $page_id;
        update_option( 'hdgavi_created_page_ids', $tracked, false );
        $results[] = array( 'slug' => $slug, 'status' => 'created', 'message' => $meta[0] . ' — créée ✓' );

        if ( $slug === 'splash' && $set_front ) {
            update_option( 'show_on_front', 'page' );
            update_option( 'page_on_front', $page_id );
        }
    }

    if ( $create_veille && ! term_exists( 'veille', 'category' ) ) {
        wp_insert_term( 'Veille', 'category', array( 'slug' => 'veille' ) );
        $results[] = array( 'slug' => 'veille', 'status' => 'created', 'message' => 'Catégorie « Veille » — créée ✓' );
    }

    flush_rewrite_rules();
    wp_send_json_success( array( 'results' => $results ) );
}
add_action( 'wp_ajax_hdgavi_create_pages', 'hdgavi_ajax_create_pages' );

/**
 * Delete pages created by the theme
 */
function hdgavi_ajax_delete_pages() {
    check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
    if ( ! current_user_can( 'delete_pages' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    $tracked = get_option( 'hdgavi_created_page_ids', array() );
    $all_pages = hdgavi_get_portfolio_pages();
    $results = array();
    $deleted = 0;

    // Delete tracked pages
    foreach ( $tracked as $slug => $page_id ) {
        if ( get_post( $page_id ) ) {
            wp_delete_post( $page_id, true );
            $title = isset( $all_pages[ $slug ] ) ? $all_pages[ $slug ][0] : $slug;
            $results[] = array( 'slug' => $slug, 'status' => 'deleted', 'message' => $title . ' — supprimée' );
            $deleted++;
        }
    }

    // Also check for pages matching portfolio slugs (created manually)
    foreach ( $all_pages as $slug => $meta ) {
        if ( isset( $tracked[ $slug ] ) ) continue;
        $page = get_page_by_path( $slug, OBJECT, 'page' );
        if ( $page ) {
            wp_delete_post( $page->ID, true );
            $results[] = array( 'slug' => $slug, 'status' => 'deleted', 'message' => $meta[0] . ' — supprimée' );
            $deleted++;
        }
    }

    // Clean up tracking
    delete_option( 'hdgavi_created_page_ids' );

    // Reset front page if it was set to splash
    $front_page_id = (int) get_option( 'page_on_front' );
    if ( $front_page_id && ! get_post( $front_page_id ) ) {
        update_option( 'show_on_front', 'posts' );
        delete_option( 'page_on_front' );
    }

    flush_rewrite_rules();

    wp_send_json_success( array(
        'results' => $results,
        'summary' => $deleted . ' page(s) supprimée(s).',
    ) );
}
add_action( 'wp_ajax_hdgavi_delete_pages', 'hdgavi_ajax_delete_pages' );

/**
 * Repair all templates
 */
function hdgavi_ajax_repair_templates() {
    check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
    if ( ! current_user_can( 'edit_pages' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    $all_pages = hdgavi_get_portfolio_pages();
    $results   = array();
    $fixed     = 0;

    foreach ( $all_pages as $slug => $meta ) {
        $page = get_page_by_path( $slug, OBJECT, 'page' );
        if ( ! $page ) continue;
        $current_tpl = get_post_meta( $page->ID, '_wp_page_template', true );
        if ( $current_tpl !== $meta[1] ) {
            update_post_meta( $page->ID, '_wp_page_template', $meta[1] );
            $results[] = array( 'slug' => $slug, 'status' => 'fixed', 'message' => $meta[0] . ' — template corrigé' );
            $fixed++;
        } else {
            $results[] = array( 'slug' => $slug, 'status' => 'skipped', 'message' => $meta[0] . ' — déjà correct' );
        }
    }

    flush_rewrite_rules();
    wp_send_json_success( array( 'results' => $results, 'summary' => $fixed . ' template(s) corrigé(s)' ) );
}
add_action( 'wp_ajax_hdgavi_repair_templates', 'hdgavi_ajax_repair_templates' );

/**
 * Flush rewrite rules
 */
function hdgavi_ajax_flush_permalinks() {
    check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    $current = get_option( 'permalink_structure' );
    $changed = false;
    if ( empty( $current ) ) {
        update_option( 'permalink_structure', '/%postname%/' );
        $changed = true;
    }
    flush_rewrite_rules();

    $msg = $changed
        ? 'Permaliens configurés en /%postname%/ et règles de réécriture régénérées.'
        : 'Règles de réécriture régénérées (permaliens : ' . $current . ').';

    wp_send_json_success( array( 'message' => $msg ) );
}
add_action( 'wp_ajax_hdgavi_flush_permalinks', 'hdgavi_ajax_flush_permalinks' );

/**
 * Save maintenance page settings from dashboard
 */
function hdgavi_ajax_save_maintenance_settings() {
    check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    $allowed_texts = array(
        'maintenance_title_en', 'maintenance_title_fr', 'maintenance_title_es',
        'maintenance_desc_en', 'maintenance_desc_fr', 'maintenance_desc_es',
        'maintenance_icon',
        'maintenance_role_en', 'maintenance_role_fr', 'maintenance_role_es',
        'maintenance_company',
    );
    $allowed_toggles = array(
        'maint_show_banner', 'maint_show_photo', 'maint_show_role',
        'maint_show_info', 'maint_show_skills', 'maint_show_github',
        'maint_show_linkedin', 'maint_show_email', 'maint_show_cv',
        'maint_show_form', 'maint_show_particles', 'maint_show_lang',
    );

    if ( isset( $_POST['maint_texts'] ) && is_array( $_POST['maint_texts'] ) ) {
        foreach ( $_POST['maint_texts'] as $key => $val ) {
            if ( in_array( $key, $allowed_texts, true ) ) {
                set_theme_mod( $key, sanitize_text_field( wp_unslash( $val ) ) );
            }
        }
    }

    foreach ( $allowed_toggles as $key ) {
        set_theme_mod( $key, ! empty( $_POST['maint_toggles'][ $key ] ) );
    }

    wp_send_json_success( array( 'message' => 'Réglages maintenance sauvegardés.' ) );
}
add_action( 'wp_ajax_hdgavi_save_maintenance_settings', 'hdgavi_ajax_save_maintenance_settings' );

/**
 * Save RSS settings from dashboard
 */
function hdgavi_ajax_save_rss_settings() {
    check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    if ( isset( $_POST['rss_feeds'] ) ) {
        set_theme_mod( 'rss_feeds', sanitize_textarea_field( wp_unslash( $_POST['rss_feeds'] ) ) );
    }
    if ( isset( $_POST['rss_max_per_feed'] ) ) {
        set_theme_mod( 'rss_max_per_feed', absint( $_POST['rss_max_per_feed'] ) );
    }

    wp_send_json_success( array( 'message' => 'Réglages RSS sauvegardés.' ) );
}
add_action( 'wp_ajax_hdgavi_save_rss_settings', 'hdgavi_ajax_save_rss_settings' );

/**
 * Toggle RSS enabled from dashboard
 */
function hdgavi_ajax_toggle_rss() {
    check_ajax_referer( 'hdgavi_maint_toggle', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) wp_send_json_error();
    $new_val = ! (bool) get_theme_mod( 'rss_enabled', false );
    set_theme_mod( 'rss_enabled', $new_val );
    // Manage cron
    if ( function_exists( 'hdgavi_rss_manage_cron' ) ) {
        hdgavi_rss_manage_cron();
    }
    wp_send_json_success( array( 'rss_enabled' => $new_val ) );
}
add_action( 'wp_ajax_hdgavi_toggle_rss', 'hdgavi_ajax_toggle_rss' );

/**
 * Full cleanup: delete all theme content before uninstall
 */
function hdgavi_ajax_full_cleanup() {
    check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( array( 'message' => 'Permission denied.' ) );
    }

    $deleted = 0;

    // 1. Delete all CPT posts
    $cpt_types = array(
        'hdgavi_education', 'hdgavi_experience', 'hdgavi_skill',
        'hdgavi_project', 'hdgavi_certification', 'hdgavi_timeline',
        'hdgavi_resource',
    );
    foreach ( $cpt_types as $cpt ) {
        $posts = get_posts( array(
            'post_type'      => $cpt,
            'post_status'    => 'any',
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ) );
        foreach ( $posts as $pid ) {
            wp_delete_post( $pid, true );
            $deleted++;
        }
    }

    // 2. Delete portfolio pages created by the theme
    $theme_pages = hdgavi_get_portfolio_pages();
    foreach ( $theme_pages as $slug => $meta ) {
        $page = get_page_by_path( $slug, OBJECT, 'page' );
        if ( $page ) {
            wp_delete_post( $page->ID, true );
            $deleted++;
        }
    }

    // 3. Delete demo articles — by meta tag OR by demo categories (veille/blog)
    $demo_articles = get_posts( array(
        'post_type'      => 'post',
        'meta_key'       => '_hdgavi_demo',
        'meta_value'     => '1',
        'post_status'    => 'any',
        'posts_per_page' => -1,
        'fields'         => 'ids',
    ) );
    // Also find articles in veille category (legacy articles without _hdgavi_demo tag)
    $veille_id = get_cat_ID( 'veille' );
    if ( $veille_id ) {
        $veille_articles = get_posts( array(
            'post_type'      => 'post',
            'category'       => $veille_id,
            'post_status'    => 'any',
            'posts_per_page' => -1,
            'fields'         => 'ids',
        ) );
        $demo_articles = array_unique( array_merge( $demo_articles, $veille_articles ) );
    }
    foreach ( $demo_articles as $pid ) {
        wp_delete_post( $pid, true );
        $deleted++;
    }

    // 4. Delete import flags and theme options
    $options_to_delete = array(
        'hdgavi_demo_imported',
        'hdgavi_demo_auto_imported',
        'hdgavi_demo_articles_imported',
        'hdgavi_demo_resources_imported',
        'hdgavi_demo_projects_imported',
        'hdgavi_demo_experiences_imported',
        'hdgavi_demo_educations_imported',
        'hdgavi_demo_certifications_imported',
        'hdgavi_demo_timeline_imported',
        'hdgavi_demo_skills_imported',
        'hdgavi_contacts',
        'hdgavi_newsletter_subs',
        'hdgavi_newsletter_unsubscribe_tokens',
    );
    foreach ( $options_to_delete as $opt ) {
        delete_option( $opt );
    }

    // 5. Delete batch options
    global $wpdb;
    $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE 'hdgavi_nl_batch_%'" );

    // 6. Delete rate limit transients
    $wpdb->query( "DELETE FROM {$wpdb->options} WHERE option_name LIKE '%hdgavi_rl_%'" );

    $msg = sprintf( '%d élément(s) supprimé(s). Tous les flags d\'import ont été réinitialisés. Vous pouvez désinstaller le thème proprement.', $deleted );
    wp_send_json_success( array( 'message' => $msg ) );
}
add_action( 'wp_ajax_hdgavi_full_cleanup', 'hdgavi_ajax_full_cleanup' );

/* ═══════════════════════════════════════
   CLEANUP ON THEME DEACTIVATION
   ═══════════════════════════════════════ */
function hdgavi_deactivation_cleanup_flag() {
    $tracked = get_option( 'hdgavi_created_page_ids', array() );
    if ( ! empty( $tracked ) ) {
        set_transient( 'hdgavi_cleanup_available', true, 3600 );
    }
}
add_action( 'switch_theme', 'hdgavi_deactivation_cleanup_flag' );

/* ═══════════════════════════════════════
   CSS
   ═══════════════════════════════════════ */
function hdgavi_admin_setup_css() {
    return '
    /* Reset & Layout */
    .hdgavi-setup-wrap{max-width:1060px;padding-bottom:120px;font-family:-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,sans-serif}

    /* Header */
    .hdgavi-header{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;padding:24px 28px;background:linear-gradient(135deg,#0B0F1A 0%,#162032 50%,#0d1929 100%);border-radius:16px;color:#fff;position:relative;overflow:hidden}
    .hdgavi-header::after{content:"";position:absolute;top:-50%;right:-10%;width:300px;height:300px;background:radial-gradient(circle,rgba(6,182,212,0.12) 0%,transparent 70%);pointer-events:none}
    .hdgavi-header-left{display:flex;align-items:center;gap:16px;z-index:1}
    .hdgavi-header h1{color:#fff;font-size:22px;margin:0;padding:0;font-weight:700;letter-spacing:-0.02em}
    .hdgavi-setup-intro{color:#94A3B8;font-size:13px;margin:4px 0 0}
    .hdgavi-logo{width:44px;height:44px;display:flex;align-items:center;justify-content:center;background:rgba(6,182,212,0.15);border:1.5px solid rgba(6,182,212,0.4);border-radius:12px;font-size:15px;font-weight:800;color:#06B6D4;letter-spacing:1px}
    .hdgavi-header-right{z-index:1}
    .hdgavi-version{background:rgba(6,182,212,0.15);color:#06B6D4;padding:5px 12px;border-radius:20px;font-size:12px;font-weight:600;letter-spacing:0.5px}

    /* Progress panel */
    .hdgavi-progress-panel{display:flex;align-items:center;justify-content:space-between;gap:24px;padding:20px 24px;margin-bottom:24px;background:#fff;border:1px solid #e2e4e7;border-radius:14px;flex-wrap:wrap}
    .hdgavi-progress-stats{display:flex;align-items:center;gap:16px}
    .hdgavi-stat-circle{position:relative;width:64px;height:64px;flex-shrink:0}
    .hdgavi-circular-chart{width:64px;height:64px;transform:rotate(-90deg)}
    .hdgavi-circle-bg{fill:none;stroke:#e5e7eb;stroke-width:3.5}
    .hdgavi-circle-fill{fill:none;stroke:#06B6D4;stroke-width:3.5;stroke-linecap:round;transition:stroke-dasharray .6s ease}
    .hdgavi-stat-number{position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:700;color:#1d2327}
    .hdgavi-stat-label{font-size:15px;font-weight:600;color:#1d2327}
    .hdgavi-stat-sub{font-size:13px;color:#787c82;margin-top:2px}
    .hdgavi-quick-actions{display:flex;flex-direction:column;gap:8px}
    .hdgavi-toggle-option{display:flex;align-items:center;gap:8px;font-size:13px;cursor:pointer;color:#50575e}
    .hdgavi-toggle-option input{accent-color:#06B6D4;width:16px;height:16px}

    /* Alerts */
    .hdgavi-alert{display:flex;align-items:flex-start;gap:12px;padding:14px 18px;border-radius:12px;margin-bottom:20px;font-size:13px}
    .hdgavi-alert-warn{background:#FFFBEB;border:1px solid #FDE68A;color:#92400E}
    .hdgavi-alert p{margin:4px 0 0}
    .hdgavi-alert-icon{font-size:20px;flex-shrink:0}

    /* Toast */
    .hdgavi-toast{position:fixed;top:40px;right:24px;z-index:100001;display:none;align-items:flex-start;gap:12px;padding:16px 20px;min-width:340px;max-width:480px;background:#fff;border-radius:14px;box-shadow:0 12px 40px rgba(0,0,0,0.15),0 0 0 1px rgba(0,0,0,0.04);animation:hdgavi-slide-in .4s cubic-bezier(0.16,1,0.3,1)}
    .hdgavi-toast.visible{display:flex}
    .hdgavi-toast.success{border-left:4px solid #22C55E}
    .hdgavi-toast.error{border-left:4px solid #EF4444}
    .hdgavi-toast.loading{border-left:4px solid #06B6D4}
    .hdgavi-toast-icon{font-size:22px;line-height:1;flex-shrink:0}
    .hdgavi-toast-body{flex:1;min-width:0}
    .hdgavi-toast-title{font-weight:600;font-size:14px;color:#1d2327}
    .hdgavi-toast-msg{font-size:13px;color:#50575e;margin-top:3px}
    .hdgavi-toast-close{position:absolute;top:8px;right:10px;font-size:18px;color:#94A3B8;cursor:pointer;background:none;border:none;padding:4px;line-height:1}
    .hdgavi-toast-close:hover{color:#1d2327}
    @keyframes hdgavi-slide-in{from{opacity:0;transform:translateY(-12px) scale(0.97)}to{opacity:1;transform:translateY(0) scale(1)}}

    /* Groups */
    .hdgavi-setup-group{margin-bottom:32px}
    .hdgavi-group-header{display:flex;align-items:center;justify-content:space-between;gap:12px;margin-bottom:14px}
    .hdgavi-group-title-row{display:flex;align-items:center;gap:12px}
    .hdgavi-group-icon{display:flex;align-items:center;justify-content:center;width:40px;height:40px;border-radius:10px;font-size:20px;flex-shrink:0}
    .hdgavi-setup-group h2{font-size:16px;margin:0;font-weight:600;color:#1d2327}
    .hdgavi-setup-group .description{color:#787c82;font-size:13px;margin:2px 0 0}
    .hdgavi-group-badge{display:inline-flex;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:700}
    .hdgavi-group-counter{flex-shrink:0}
    .hdgavi-setup-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:12px}

    /* Cards */
    .hdgavi-setup-card{display:flex;align-items:flex-start;gap:14px;padding:16px 18px;border:1.5px solid #e2e4e7;border-radius:14px;background:#fff;transition:all .25s ease;position:relative;cursor:default}
    .hdgavi-setup-card:hover{border-color:#06B6D4;box-shadow:0 4px 16px rgba(6,182,212,0.08);transform:translateY(-2px)}
    .hdgavi-setup-card.exists{background:linear-gradient(135deg,#f0fdf4 0%,#f8fffe 100%);border-color:#bbf7d0}
    .hdgavi-setup-card.exists:hover{border-color:#22C55E}
    .hdgavi-setup-card.no-template{border-color:#fcd34d;background:linear-gradient(135deg,#fffbeb 0%,#fff9e6 100%)}
    .hdgavi-setup-card.just-created{animation:hdgavi-card-pop .5s ease;border-color:#22C55E;box-shadow:0 0 0 3px rgba(34,197,94,0.15)}
    .hdgavi-setup-card.just-deleted{animation:hdgavi-card-remove .4s ease forwards}
    @keyframes hdgavi-card-pop{0%{transform:scale(1)}50%{transform:scale(1.02)}100%{transform:scale(1)}}
    @keyframes hdgavi-card-remove{to{opacity:0;transform:scale(0.95) translateY(8px)}}
    .hdgavi-card-icon{font-size:28px;line-height:1;flex-shrink:0;width:40px;height:40px;display:flex;align-items:center;justify-content:center;background:#f8f9fa;border-radius:10px}
    .hdgavi-card-body{display:flex;flex-direction:column;gap:4px;min-width:0;flex:1}
    .hdgavi-card-top{display:flex;align-items:center;justify-content:space-between;gap:8px}
    .hdgavi-card-label{display:flex;align-items:center;gap:8px;cursor:pointer}
    .hdgavi-card-label input[type="checkbox"]{width:16px;height:16px;accent-color:#06B6D4;flex-shrink:0}
    .hdgavi-card-title{font-size:14px;color:#1d2327}
    .hdgavi-card-slug{font-size:11px;color:#64748B;background:#f1f5f9;padding:2px 8px;border-radius:6px;display:inline-block;width:fit-content;font-family:"JetBrains Mono",monospace;border:none}
    .hdgavi-card-desc{font-size:12px;color:#787c82;line-height:1.4}
    .hdgavi-card-badge{font-size:11px;font-weight:600;padding:3px 10px;border-radius:20px;white-space:nowrap;letter-spacing:0.02em}
    .hdgavi-badge-ok{background:#dcfce7;color:#166534}
    .hdgavi-badge-warn{background:#fef3c7;color:#92400e}
    .hdgavi-badge-new{background:#dbeafe;color:#1e40af}
    .hdgavi-card-actions{display:flex;gap:12px;margin-top:4px}
    .hdgavi-card-link{font-size:12px;color:#06B6D4;text-decoration:none;font-weight:500}
    .hdgavi-card-link:hover{color:#0891b2;text-decoration:underline}

    /* Sticky action bar */
    .hdgavi-action-bar{position:sticky;bottom:0;z-index:100;margin:28px -12px 0;padding:0 12px}
    .hdgavi-action-bar-inner{display:flex;align-items:center;justify-content:space-between;gap:16px;padding:14px 24px;background:#fff;border:1px solid #e2e4e7;border-radius:14px;box-shadow:0 -4px 32px rgba(0,0,0,0.08)}
    .hdgavi-action-left{display:flex;align-items:center;gap:8px;font-size:13px;color:#50575e}
    .hdgavi-action-right{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
    .hdgavi-separator{color:#d1d5db;font-size:12px}
    .hdgavi-selected-count{font-weight:600;color:#1d2327}

    /* Buttons */
    .hdgavi-btn{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;font-size:13px;font-weight:600;border-radius:10px;border:none;cursor:pointer;transition:all .2s;font-family:inherit;white-space:nowrap}
    .hdgavi-btn-primary{background:#06B6D4;color:#fff}
    .hdgavi-btn-primary:hover{background:#0891b2;box-shadow:0 4px 12px rgba(6,182,212,0.3)}
    .hdgavi-btn-outline{background:#fff;color:#50575e;border:1.5px solid #d1d5db}
    .hdgavi-btn-outline:hover{border-color:#06B6D4;color:#06B6D4}
    .hdgavi-btn-danger{background:#fff;color:#EF4444;border:1.5px solid #fca5a5}
    .hdgavi-btn-danger:hover{background:#fef2f2;border-color:#EF4444}
    .hdgavi-btn-text{background:none;border:none;color:#06B6D4;cursor:pointer;font-size:13px;font-weight:500;padding:0;font-family:inherit}
    .hdgavi-btn-text:hover{color:#0891b2;text-decoration:underline}

    /* Loading state */
    .hdgavi-btn-loading{position:relative;color:transparent !important;pointer-events:none}
    .hdgavi-btn-loading::after{content:"";position:absolute;width:16px;height:16px;top:50%;left:50%;margin:-8px 0 0 -8px;border:2px solid currentColor;border-top-color:transparent;border-radius:50%;animation:hdgavi-spin .6s linear infinite}
    .hdgavi-btn-primary.hdgavi-btn-loading::after{border-color:#fff;border-top-color:transparent}
    @keyframes hdgavi-spin{to{transform:rotate(360deg)}}

    /* Panel */
    .hdgavi-panel{border:1px solid #e2e4e7;border-radius:14px;overflow:hidden;background:#fff;margin-top:28px}
    .hdgavi-panel-header{display:flex;align-items:center;gap:10px;padding:16px 22px;background:#f8f9fa;border-bottom:1px solid #e2e4e7;font-size:14px}
    .hdgavi-panel-icon{font-size:20px}
    .hdgavi-panel-body{padding:18px 22px}
    .hdgavi-panel-actions{display:flex;align-items:center;gap:16px;margin-top:14px;flex-wrap:wrap}

    /* Results */
    .hdgavi-results{margin-top:20px;padding:18px 22px;border-radius:14px;background:#f8f9fa;border:1px solid #e2e4e7}
    .hdgavi-results ul{margin:12px 0 0;list-style:none;padding:0}
    .hdgavi-results li{padding:8px 14px;font-size:13px;border-radius:8px;margin-bottom:4px;display:flex;align-items:center;gap:10px}
    .hdgavi-results li::before{content:"";display:block;width:7px;height:7px;border-radius:50%;flex-shrink:0}
    .hdgavi-results li.created{background:#f0fdf4;color:#166534}
    .hdgavi-results li.created::before{background:#22C55E}
    .hdgavi-results li.fixed{background:#fffbeb;color:#92400e}
    .hdgavi-results li.fixed::before{background:#F59E0B}
    .hdgavi-results li.skipped{background:#f8f9fa;color:#787c82}
    .hdgavi-results li.skipped::before{background:#94A3B8}
    .hdgavi-results li.error{background:#fef2f2;color:#b91c1c}
    .hdgavi-results li.error::before{background:#EF4444}
    .hdgavi-results li.deleted{background:#fef2f2;color:#b91c1c}
    .hdgavi-results li.deleted::before{background:#EF4444}
    .hdgavi-results .hdgavi-summary{font-weight:600;font-size:14px;margin-bottom:4px}

    /* Status grid */
    .hdgavi-status-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px}
    .hdgavi-status-card{display:flex;align-items:center;gap:14px;padding:18px 20px;border:1.5px solid #e2e4e7;border-radius:14px;background:#fff;transition:all .3s}
    .hdgavi-status-card.status-on{border-color:#fca5a5;background:linear-gradient(135deg,#fef2f2,#fff5f5)}
    .hdgavi-status-card.status-off{border-color:#bbf7d0;background:linear-gradient(135deg,#f0fdf4,#f8fffe)}
    .hdgavi-status-card-icon{font-size:26px;width:44px;height:44px;display:flex;align-items:center;justify-content:center;background:#f8f9fa;border-radius:10px;flex-shrink:0}
    .hdgavi-status-card-body{display:flex;flex-direction:column;gap:2px;min-width:0}
    .hdgavi-status-card-label{font-size:11px;color:#787c82;font-weight:600;text-transform:uppercase;letter-spacing:0.5px}
    .hdgavi-status-card-value{font-size:17px;font-weight:700;color:#1d2327}

    /* Toggle switch */
    .hdgavi-maint-toggle-btn{margin-left:auto;background:none;border:none;cursor:pointer;padding:4px;flex-shrink:0}
    .hdgavi-toggle-track{display:block;width:44px;height:24px;background:#d1d5db;border-radius:12px;position:relative;transition:background .3s}
    .hdgavi-maint-toggle-btn.active .hdgavi-toggle-track{background:#EF4444}
    .hdgavi-toggle-thumb{position:absolute;top:2px;left:2px;width:20px;height:20px;background:#fff;border-radius:50%;transition:transform .3s;box-shadow:0 1px 3px rgba(0,0,0,0.2)}
    .hdgavi-maint-toggle-btn.active .hdgavi-toggle-thumb{transform:translateX(20px)}

    /* Maintenance settings panel */
    .hdgavi-panel-collapsible:hover{background:#f1f5f9}
    .hdgavi-maint-fields-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
    .hdgavi-maint-field label{display:block;font-size:12px;font-weight:600;color:#50575e;margin-bottom:4px}
    .hdgavi-maint-field input{width:100%;padding:8px 12px;border:1.5px solid #e2e4e7;border-radius:8px;font-size:13px;font-family:inherit;transition:border-color .2s}
    .hdgavi-maint-field input:focus{border-color:#06B6D4;outline:none;box-shadow:0 0 0 3px rgba(6,182,212,0.1)}
    .hdgavi-maint-toggles-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:8px}

    /* Responsive */
    @media(max-width:782px){
        .hdgavi-setup-grid{grid-template-columns:1fr}
        .hdgavi-action-bar-inner{flex-direction:column;gap:12px;text-align:center}
        .hdgavi-action-right{justify-content:center}
        .hdgavi-progress-panel{flex-direction:column;align-items:flex-start}
        .hdgavi-group-header{flex-direction:column;align-items:flex-start;gap:8px}
        .hdgavi-status-grid{grid-template-columns:1fr 1fr}
        .hdgavi-maint-fields-grid{grid-template-columns:1fr}
        .hdgavi-maint-toggles-grid{grid-template-columns:1fr 1fr}
    }
    ';
}

/* ═══════════════════════════════════════
   JAVASCRIPT
   ═══════════════════════════════════════ */
function hdgavi_admin_setup_js() {
    return "
    (function(){
        var createBtn  = document.getElementById('hdgavi-create-btn');
        var deleteBtn  = document.getElementById('hdgavi-delete-btn');
        var resultsDiv = document.getElementById('hdgavi-results');
        var toast      = document.getElementById('hdgaviToast');
        var toastIcon  = document.getElementById('hdgaviToastIcon');
        var toastTitle = document.getElementById('hdgaviToastTitle');
        var toastMsg   = document.getElementById('hdgaviToastMsg');
        var countEl    = document.getElementById('hdgaviCount');

        /* ── Toast ── */
        var toastTimer = null;
        function showToast(title, msg, type, duration) {
            clearTimeout(toastTimer);
            toast.className = 'hdgavi-toast visible ' + type;
            var icons = { success:'✅', error:'❌', loading:'⏳' };
            toastIcon.textContent = icons[type] || '⏳';
            toastTitle.textContent = title;
            toastMsg.textContent = msg || '';
            if (duration) toastTimer = setTimeout(function(){ toast.classList.remove('visible'); }, duration);
        }
        function hideToast() { toast.classList.remove('visible'); clearTimeout(toastTimer); }
        document.getElementById('hdgaviToastClose').addEventListener('click', hideToast);

        /* ── Loading state ── */
        function setLoading(btn, loading) {
            btn.classList.toggle('hdgavi-btn-loading', loading);
            btn.disabled = loading;
        }

        /* ── Selection counter ── */
        function getCheckboxes() { return document.querySelectorAll('.hdgavi-page-cb:not(:disabled)'); }
        function updateCount() {
            var checked = 0;
            getCheckboxes().forEach(function(cb) { if (cb.checked) checked++; });
            countEl.textContent = checked + ' sélectionnée(s)';
        }
        document.querySelectorAll('.hdgavi-page-cb').forEach(function(cb) { cb.addEventListener('change', updateCount); });
        updateCount();

        document.getElementById('hdgavi-select-all').addEventListener('click', function() {
            getCheckboxes().forEach(function(cb) { cb.checked = true; }); updateCount();
        });
        document.getElementById('hdgavi-select-none').addEventListener('click', function() {
            getCheckboxes().forEach(function(cb) { cb.checked = false; }); updateCount();
        });

        /* ── Animate cards ── */
        function animateCard(slug, status) {
            var card = document.querySelector('[data-slug=\"' + slug + '\"]');
            if (!card) return;
            if (status === 'created' || status === 'fixed') {
                card.classList.remove('no-template');
                card.classList.add('exists', 'just-created');
                var cb = card.querySelector('input[type=checkbox]');
                if (cb) { cb.checked = true; cb.disabled = true; }
                var badge = card.querySelector('.hdgavi-card-badge');
                if (badge) { badge.className = 'hdgavi-card-badge hdgavi-badge-ok'; badge.textContent = '✓ Créée'; }
                setTimeout(function(){ card.classList.remove('just-created'); }, 2000);
            } else if (status === 'deleted') {
                card.classList.add('just-deleted');
                setTimeout(function(){
                    card.classList.remove('exists','just-deleted','no-template');
                    var cb = card.querySelector('input[type=checkbox]');
                    if (cb) { cb.checked = false; cb.disabled = false; }
                    var badge = card.querySelector('.hdgavi-card-badge');
                    if (badge) { badge.className = 'hdgavi-card-badge hdgavi-badge-new'; badge.textContent = '+ Nouvelle'; }
                    var actions = card.querySelector('.hdgavi-card-actions');
                    if (actions) actions.remove();
                }, 400);
            }
        }

        /* ── Results HTML ── */
        function buildResultsHTML(results, summaryText) {
            var html = '<p class=\"hdgavi-summary\">' + summaryText + '</p><ul>';
            results.forEach(function(r) { html += '<li class=\"' + r.status + '\">' + r.message + '</li>'; });
            return html + '</ul>';
        }

        /* ── AJAX helper ── */
        function doAction(action, formData, btn, loadingTitle) {
            setLoading(btn, true);
            showToast(loadingTitle, 'Veuillez patienter…', 'loading');
            resultsDiv.style.display = 'none';
            return fetch(hdgaviSetup.ajaxUrl, { method:'POST', body:formData, credentials:'same-origin' })
                .then(function(r) { return r.json(); })
                .then(function(resp) {
                    setLoading(btn, false);
                    if (!resp.success) {
                        showToast('Erreur', resp.data && resp.data.message || 'Erreur inconnue', 'error', 6000);
                        return null;
                    }
                    return resp.data;
                })
                .catch(function(err) {
                    setLoading(btn, false);
                    showToast('Erreur réseau', err.message, 'error', 6000);
                    return null;
                });
        }

        /* ── Create pages ── */
        createBtn.addEventListener('click', function() {
            var checked = [];
            getCheckboxes().forEach(function(cb) { if (cb.checked) checked.push(cb.value); });
            if (!checked.length) { showToast('Rien à faire', 'Aucune page sélectionnée.', 'error', 3000); return; }
            if (!confirm('Créer ' + checked.length + ' page(s) ?')) return;

            var data = new FormData();
            data.append('action', 'hdgavi_create_pages');
            data.append('nonce', hdgaviSetup.nonce);
            data.append('set_frontpage', document.getElementById('hdgavi-set-frontpage').checked ? '1' : '');
            data.append('create_veille', document.getElementById('hdgavi-create-veille-cat').checked ? '1' : '');
            checked.forEach(function(slug) { data.append('slugs[]', slug); });

            doAction('hdgavi_create_pages', data, createBtn, 'Création des pages…').then(function(d) {
                if (!d) return;
                var results = d.results;
                var created = results.filter(function(r){ return r.status==='created'; }).length;
                var fixed = results.filter(function(r){ return r.status==='fixed'; }).length;
                var summary = created + ' page(s) créée(s)';
                if (fixed > 0) summary += ', ' + fixed + ' template(s) corrigé(s)';

                showToast('Terminé !', summary, 'success', 5000);
                resultsDiv.style.display = 'block';
                resultsDiv.innerHTML = buildResultsHTML(results, summary);
                results.forEach(function(r, i) { setTimeout(function() { animateCard(r.slug, r.status); }, i * 150); });
                updateCount();
            });
        });

        /* ── Delete pages ── */
        deleteBtn.addEventListener('click', function() {
            if (!confirm('⚠️ Supprimer TOUTES les pages du portfolio ?\\n\\nCette action est irréversible. Les pages seront définitivement supprimées.')) return;
            if (!confirm('Dernière confirmation : êtes-vous vraiment sûr(e) ?')) return;

            var data = new FormData();
            data.append('action', 'hdgavi_delete_pages');
            data.append('nonce', hdgaviSetup.nonce);

            doAction('hdgavi_delete_pages', data, deleteBtn, 'Suppression des pages…').then(function(d) {
                if (!d) return;
                showToast('Supprimé', d.summary, 'success', 5000);
                resultsDiv.style.display = 'block';
                resultsDiv.innerHTML = buildResultsHTML(d.results, d.summary);
                d.results.forEach(function(r, i) { setTimeout(function() { animateCard(r.slug, r.status); }, i * 100); });
                updateCount();
            });
        });

        /* ── Repair templates ── */
        document.getElementById('hdgavi-repair-btn').addEventListener('click', function() {
            if (!confirm('Forcer l\\'assignation des templates sur toutes les pages existantes ?')) return;
            var btn = this;
            var data = new FormData();
            data.append('action', 'hdgavi_repair_templates');
            data.append('nonce', hdgaviSetup.nonce);
            doAction('hdgavi_repair_templates', data, btn, 'Réparation…').then(function(d) {
                if (!d) return;
                showToast('Terminé !', d.summary, 'success', 5000);
                resultsDiv.style.display = 'block';
                resultsDiv.innerHTML = buildResultsHTML(d.results, d.summary);
                d.results.forEach(function(r, i) { setTimeout(function() { animateCard(r.slug, r.status); }, i * 120); });
            });
        });

        /* ── Flush permalinks ── */
        document.getElementById('hdgavi-flush-btn').addEventListener('click', function() {
            var btn = this;
            var data = new FormData();
            data.append('action', 'hdgavi_flush_permalinks');
            data.append('nonce', hdgaviSetup.nonce);
            doAction('hdgavi_flush_permalinks', data, btn, 'Régénération…').then(function(d) {
                if (!d) return;
                showToast('Terminé !', d.message, 'success', 4000);
            });
        });

        /* ── Demo content ── */
        document.getElementById('hdgavi-demo-btn').addEventListener('click', function() {
            var btn = this;
            var data = new FormData();
            data.append('action', 'hdgavi_import_demo');
            data.append('nonce', hdgaviSetup.nonce);
            data.append('force', document.getElementById('hdgavi-force-demo').checked ? '1' : '');
            doAction('hdgavi_import_demo', data, btn, 'Import du contenu…').then(function(d) {
                if (!d) return;
                showToast('Contenu importé !', d.message, 'success', 8000);
                resultsDiv.style.display = 'block';
                resultsDiv.innerHTML = '<p class=\"hdgavi-summary\">' + d.message + '</p><p style=\"margin-top:8px\">Allez dans <strong>Apparence → Personnaliser</strong> pour voir et modifier le contenu.</p>';
            });
        });

        /* ── RSS toggle ── */
        var rssToggle = document.getElementById('hdgavi-rss-toggle');
        if (rssToggle) {
            rssToggle.addEventListener('click', function() {
                var btn = this;
                var data = new FormData();
                data.append('action', 'hdgavi_toggle_rss');
                data.append('nonce', hdgaviSetup.maintNonce);
                fetch(hdgaviSetup.ajaxUrl, {method:'POST', body:data, credentials:'same-origin'})
                    .then(function(r){return r.json();})
                    .then(function(resp){
                        if (!resp.success) return;
                        var isOn = resp.data.rss_enabled;
                        btn.classList.toggle('active', isOn);
                        var panel = btn.closest('.hdgavi-panel');
                        panel.style.borderColor = isOn ? 'rgba(6,182,212,0.3)' : 'rgba(239,68,68,0.2)';
                        showToast('RSS', isOn ? 'Import RSS activé (toutes les 6h)' : 'Import RSS désactivé', 'success', 3000);
                    });
            });
        }

        /* ── RSS save settings ── */
        var rssSaveBtn = document.getElementById('hdgavi-rss-save-btn');
        if (rssSaveBtn) {
            rssSaveBtn.addEventListener('click', function() {
                var data = new FormData();
                data.append('action', 'hdgavi_save_rss_settings');
                data.append('nonce', hdgaviSetup.nonce);
                var feedsInput = document.getElementById('rss-feeds-input');
                var maxInput = document.getElementById('rss-max-input');
                if (feedsInput) data.append('rss_feeds', feedsInput.value);
                if (maxInput) data.append('rss_max_per_feed', maxInput.value);
                doAction('hdgavi_save_rss_settings', data, rssSaveBtn, 'Sauvegarde…').then(function(d) {
                    if (!d) return;
                    showToast('RSS', d.message, 'success', 3000);
                });
            });
        }

        /* ── RSS import now ── */
        var rssBtn = document.getElementById('hdgavi-rss-import-btn');
        if (rssBtn) {
            rssBtn.addEventListener('click', function() {
                var data = new FormData();
                data.append('action', 'hdgavi_rss_import_now');
                data.append('nonce', hdgaviSetup.nonce);
                doAction('hdgavi_rss_import_now', data, rssBtn, 'Import RSS en cours…').then(function(d) {
                    if (!d) return;
                    showToast('RSS Import', d.message, d.errors > 0 ? 'error' : 'success', 6000);
                    resultsDiv.style.display = 'block';
                    resultsDiv.innerHTML = '<p class=\"hdgavi-summary\">' + d.message + '</p><p style=\"margin-top:8px\">Les articles importés sont en <strong>brouillon</strong>. <a href=\"edit.php?post_status=draft\">Articles → Brouillons</a> pour valider.</p>';
                });
            });
        }

        document.getElementById('hdgavi-cleanup-btn').addEventListener('click', function() {
            if (!confirm('⚠️ ATTENTION : Cela va supprimer définitivement TOUS les contenus du thème (CPT, pages, articles de démo, options). Cette action est irréversible.\\n\\nContinuer ?')) return;
            if (!confirm('Dernière confirmation : êtes-vous sûr de vouloir tout supprimer ?')) return;
            var btn = this;
            var data = new FormData();
            data.append('action', 'hdgavi_full_cleanup');
            data.append('nonce', hdgaviSetup.nonce);
            doAction('hdgavi_full_cleanup', data, btn, 'Nettoyage en cours…').then(function(d) {
                if (!d) return;
                showToast('Nettoyage terminé', d.message, 'success', 8000);
                resultsDiv.style.display = 'block';
                resultsDiv.innerHTML = '<p class=\"hdgavi-summary\" style=\"color:#EF4444\">' + d.message + '</p><p style=\"margin-top:8px\">Vous pouvez maintenant désinstaller le thème proprement.</p>';
                setTimeout(function() { location.reload(); }, 3000);
            });
        });

        /* ── Dashboard maintenance toggle ── */
        var maintToggle = document.getElementById('hdgavi-dashboard-maint-toggle');
        if (maintToggle) {
            maintToggle.addEventListener('click', function() {
                var btn = this;
                var data = new FormData();
                data.append('action', 'hdgavi_toggle_maintenance');
                data.append('nonce', hdgaviSetup.maintNonce);
                fetch(hdgaviSetup.ajaxUrl, {method:'POST', body:data, credentials:'same-origin'})
                    .then(function(r){return r.json();})
                    .then(function(resp){
                        if (!resp.success) return;
                        var isOn = resp.data.maintenance_mode;
                        btn.classList.toggle('active', isOn);
                        var card = btn.closest('.hdgavi-status-card');
                        card.classList.toggle('status-on', isOn);
                        card.classList.toggle('status-off', !isOn);
                        document.getElementById('hdgavi-maint-status-text').textContent = isOn ? 'Active' : 'Inactive';
                        showToast('Maintenance', isOn ? 'Mode maintenance activé' : 'Site en ligne', 'success', 3000);
                        // Sync admin bar if present
                        var barDot = document.querySelector('#wp-admin-bar-hdgavi-maintenance-toggle .hdgavi-maint-dot');
                        var barLink = document.querySelector('#wp-admin-bar-hdgavi-maintenance-toggle .ab-item');
                        if (barDot && barLink) {
                            barDot.className = 'hdgavi-maint-dot ' + (isOn ? 'on' : 'off');
                            barLink.innerHTML = barDot.outerHTML + (isOn ? 'Maintenance ON' : 'Site Live');
                        }
                    });
            });
        }

        /* ── Save maintenance settings ── */
        var saveMaintBtn = document.getElementById('hdgavi-save-maint-btn');
        if (saveMaintBtn) {
            saveMaintBtn.addEventListener('click', function() {
                var data = new FormData();
                data.append('action', 'hdgavi_save_maintenance_settings');
                data.append('nonce', hdgaviSetup.nonce);
                document.querySelectorAll('[data-maint-text]').forEach(function(input) {
                    data.append('maint_texts[' + input.dataset.maintText + ']', input.value);
                });
                document.querySelectorAll('[data-maint-toggle]').forEach(function(cb) {
                    data.append('maint_toggles[' + cb.dataset.maintToggle + ']', cb.checked ? '1' : '');
                });
                doAction('hdgavi_save_maintenance_settings', data, saveMaintBtn, 'Sauvegarde…').then(function(d) {
                    if (!d) return;
                    showToast('Sauvegardé', d.message, 'success', 3000);
                });
            });
        }

        /* ── Collapsible maintenance settings panel ── */
        var settingsToggle = document.getElementById('hdgavi-maint-settings-toggle');
        if (settingsToggle) {
            settingsToggle.addEventListener('click', function() {
                var body = document.getElementById('hdgavi-maint-settings-body');
                var arrow = this.querySelector('.hdgavi-collapse-arrow');
                var isHidden = body.style.display === 'none';
                body.style.display = isHidden ? '' : 'none';
                if (arrow) arrow.style.transform = isHidden ? 'rotate(180deg)' : '';
            });
        }
    })();
    ";
}
