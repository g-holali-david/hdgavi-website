<?php
/**
 * Template Name: Resources / Boîte à outils
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

// Get all resource categories
$categories = get_terms( array(
    'taxonomy'   => 'hdgavi_resource_cat',
    'hide_empty' => true,
    'orderby'    => 'name',
) );
if ( is_wp_error( $categories ) ) $categories = array();

// Get all resources
$resources = hdgavi_get_cpt_posts( 'hdgavi_resource' );
if ( $resources ) update_postmeta_cache( wp_list_pluck( $resources, 'ID' ) );
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_res_section_en', 'Resources' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_res_section_fr', 'Ressources' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_res_section_es', 'Recursos' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_res_title_en', 'Toolbox & Resources' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_res_title_fr', 'Boîte à outils & Ressources' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_res_title_es', 'Herramientas y Recursos' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_res_desc_en', 'Terraform modules, Docker templates, cheat sheets and scripts to accelerate your projects.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_res_desc_fr', 'Modules Terraform, templates Docker, cheat sheets et scripts pour accélérer vos projets.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_res_desc_es', 'Módulos Terraform, plantillas Docker, cheat sheets y scripts para acelerar tus proyectos.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <div class="res-layout">
            <!-- Sidebar -->
            <aside class="res-sidebar fade-up">
                <nav class="res-nav">
                    <button class="res-nav-item active" data-res-filter="all">
                        <span data-lang="en">All</span>
                        <span data-lang="fr">Tout</span>
                        <span data-lang="es">Todo</span>
                        <span class="res-nav-count"><?php echo count( $resources ); ?></span>
                    </button>
                    <?php foreach ( $categories as $cat ) :
                        // Count resources in this category
                        $cat_count = 0;
                        foreach ( $resources as $r ) {
                            $terms = wp_get_post_terms( $r->ID, 'hdgavi_resource_cat', array( 'fields' => 'slugs' ) );
                            if ( in_array( $cat->slug, $terms, true ) ) $cat_count++;
                        }
                    ?>
                    <button class="res-nav-item" data-res-filter="<?php echo esc_attr( $cat->slug ); ?>">
                        <?php echo esc_html( $cat->name ); ?>
                        <span class="res-nav-count"><?php echo $cat_count; ?></span>
                    </button>
                    <?php endforeach; ?>

                    <div class="res-nav-divider"></div>

                    <button class="res-nav-item" data-res-filter="free">
                        <span data-lang="en">Free</span>
                        <span data-lang="fr">Gratuit</span>
                        <span data-lang="es">Gratis</span>
                    </button>
                    <button class="res-nav-item" data-res-filter="paid">
                        <span data-lang="en">Paid</span>
                        <span data-lang="fr">Payant</span>
                        <span data-lang="es">De pago</span>
                    </button>
                </nav>
            </aside>

            <!-- Main content -->
            <div class="res-content">
                <?php if ( empty( $resources ) ) : ?>
                <p class="section-desc fade-up">
                    <span data-lang="en">Resources coming soon.</span>
                    <span data-lang="fr">Ressources à venir.</span>
                    <span data-lang="es">Recursos próximamente.</span>
                </p>
                <?php endif; ?>

                <div class="res-grid">
                    <?php foreach ( $resources as $res ) :
                        $id       = $res->ID;
                        $type     = get_post_meta( $id, '_res_type', true ) ?: 'free';
                        $price    = get_post_meta( $id, '_res_price', true );
                        $buy_url  = get_post_meta( $id, '_res_buy_url', true );
                        $dl_url   = get_post_meta( $id, '_res_download_url', true );
                        $gated    = get_post_meta( $id, '_res_gated', true );
                        $format   = get_post_meta( $id, '_res_file_format', true );
                        $preview  = get_post_meta( $id, '_res_preview_image', true );
                        $icon     = get_post_meta( $id, '_res_icon', true );
                        $terms    = wp_get_post_terms( $id, 'hdgavi_resource_cat', array( 'fields' => 'slugs' ) );
                        $cat_slugs = is_array( $terms ) ? implode( ' ', $terms ) : '';
                    ?>
                    <div class="res-card fade-up" data-res-cats="<?php echo esc_attr( $cat_slugs ); ?>" data-res-type="<?php echo esc_attr( $type ); ?>">
                        <?php if ( $preview ) : ?>
                        <div class="res-card-image">
                            <img src="<?php echo esc_url( $preview ); ?>" alt="<?php echo esc_attr( $res->post_title ); ?>" loading="lazy" decoding="async">
                        </div>
                        <?php endif; ?>

                        <div class="res-card-body">
                            <div class="res-card-top">
                                <?php if ( $type === 'paid' && $price ) : ?>
                                <span class="res-badge res-badge-paid"><?php echo esc_html( $price ); ?></span>
                                <?php else : ?>
                                <span class="res-badge res-badge-free">
                                    <span data-lang="en">Free</span>
                                    <span data-lang="fr">Gratuit</span>
                                    <span data-lang="es">Gratis</span>
                                </span>
                                <?php endif; ?>
                                <?php if ( $format ) : ?>
                                <span class="res-format"><?php echo esc_html( $format ); ?></span>
                                <?php endif; ?>
                            </div>

                            <h3 class="res-card-title">
                                <?php if ( $icon ) : ?><span class="res-card-icon"><?php echo esc_html( $icon ); ?></span><?php endif; ?>
                                <?php echo esc_html( $res->post_title ); ?>
                            </h3>

                            <p class="res-card-desc">
                                <span data-lang="en"><?php echo esc_html( get_post_meta( $id, '_res_desc_en', true ) ); ?></span>
                                <span data-lang="fr"><?php echo esc_html( get_post_meta( $id, '_res_desc_fr', true ) ); ?></span>
                                <span data-lang="es"><?php echo esc_html( get_post_meta( $id, '_res_desc_es', true ) ); ?></span>
                            </p>

                            <div class="res-card-actions">
                                <?php if ( $type === 'paid' && $buy_url ) : ?>
                                <a href="<?php echo esc_url( $buy_url ); ?>" class="btn-primary res-btn" target="_blank" rel="noopener">
                                    <span data-lang="en">Buy</span>
                                    <span data-lang="fr">Acheter</span>
                                    <span data-lang="es">Comprar</span>
                                </a>
                                <?php elseif ( $gated ) : ?>
                                <button type="button" class="btn-primary res-btn hdgavi-res-gate-trigger" data-res-id="<?php echo esc_attr( $id ); ?>" data-res-url="<?php echo esc_attr( $dl_url ); ?>">
                                    <?php echo hdgavi_icon( 'download', 14 ); ?>
                                    <span data-lang="en">Download</span>
                                    <span data-lang="fr">Télécharger</span>
                                    <span data-lang="es">Descargar</span>
                                </button>
                                <?php elseif ( $dl_url ) : ?>
                                <a href="<?php echo esc_url( $dl_url ); ?>" class="btn-primary res-btn" download>
                                    <?php echo hdgavi_icon( 'download', 14 ); ?>
                                    <span data-lang="en">Download</span>
                                    <span data-lang="fr">Télécharger</span>
                                    <span data-lang="es">Descargar</span>
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
