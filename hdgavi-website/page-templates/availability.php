<?php
/**
 * Template Name: Disponibilité / Availability
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$status      = hdgavi_opt( 'avail_status', 'available' );
$status_data = array(
    'available'      => array( 'Available', 'Disponible', 'Disponible', 'var(--success)', '✓' ),
    'busy'           => array( 'On a mission', 'En mission', 'En misión', 'var(--warning)', '◔' ),
    'apprenticeship' => array( 'In apprenticeship', 'En alternance', 'En alternancia', 'var(--accent)', '◔' ),
    'unavailable'    => array( 'Not available', 'Indisponible', 'No disponible', 'var(--danger)', '✕' ),
);
$sd = $status_data[ $status ] ?? $status_data['available'];
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up" style="text-align:center;max-width:600px;margin:0 auto 48px">
            <div class="section-label" style="justify-content:center">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_avail_section_en', 'Availability' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_avail_section_fr', 'Disponibilité' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_avail_section_es', 'Disponibilidad' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_avail_title_en', 'My Availability' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_avail_title_fr', 'Ma Disponibilité' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_avail_title_es', 'Mi Disponibilidad' ) ); ?></span>
            </h1>
        </div>

        <!-- Status badge -->
        <div class="avail-status-card fade-up">
            <div class="avail-dot" style="background:<?php echo esc_attr( $sd[3] ); ?>"></div>
            <div class="avail-info">
                <div class="avail-status-text" style="color:<?php echo esc_attr( $sd[3] ); ?>">
                    <span data-lang="en"><?php echo esc_html( $sd[0] ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $sd[1] ); ?></span>
                    <span data-lang="es"><?php echo esc_html( $sd[2] ); ?></span>
                </div>
                <div class="avail-detail">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'avail_detail_en', '' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'avail_detail_fr', '' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'avail_detail_es', '' ) ); ?></span>
                </div>
                <?php $avail_date = hdgavi_opt( 'avail_next_date', '' ); ?>
                <?php if ( $avail_date ) : ?>
                <div class="avail-next">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_avail_next_en', 'Available from:' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_avail_next_fr', 'Disponible à partir du :' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_avail_next_es', 'Disponible a partir de:' ) ); ?></span>
                    <strong><?php echo esc_html( $avail_date ); ?></strong>
                </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- What I'm looking for -->
        <?php $looking_en = hdgavi_opt( 'avail_looking_en', '' ); ?>
        <?php if ( ! empty( $looking_en ) ) : ?>
        <div class="avail-looking fade-up">
            <h2 class="avail-looking-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_avail_looking_en', 'What I\'m looking for' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_avail_looking_fr', 'Ce que je recherche' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_avail_looking_es', 'Lo que busco' ) ); ?></span>
            </h2>
            <div class="avail-looking-text">
                <span data-lang="en"><?php echo esc_html( $looking_en ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'avail_looking_fr', '' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'avail_looking_es', '' ) ); ?></span>
            </div>
        </div>
        <?php endif; ?>

        <!-- Preferred contract types -->
        <?php $contracts = hdgavi_opt( 'avail_contracts', '' ); ?>
        <?php if ( ! empty( $contracts ) ) : ?>
        <div class="avail-contracts fade-up">
            <h2 class="avail-looking-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_avail_contracts_en', 'Open to' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_avail_contracts_fr', 'Ouvert à' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_avail_contracts_es', 'Abierto a' ) ); ?></span>
            </h2>
            <div class="avail-tags">
                <?php foreach ( array_filter( array_map( 'trim', explode( ',', $contracts ) ) ) as $contract ) : ?>
                <span class="skill-tag"><?php echo esc_html( $contract ); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

        <!-- Recruiter info cards -->
        <div class="avail-recruiter-box fade-up">
            <?php $salary = hdgavi_opt( 'avail_salary_range', '' ); ?>
            <?php if ( ! empty( $salary ) && hdgavi_opt( 'avail_show_salary', true ) ) : ?>
            <div class="avail-info-card">
                <h3>💰
                    <span data-lang="en">Salary Expectations</span>
                    <span data-lang="fr">Prétentions salariales</span>
                    <span data-lang="es">Expectativas salariales</span>
                </h3>
                <p><?php echo esc_html( $salary ); ?></p>
            </div>
            <?php endif; ?>

            <?php $stack = hdgavi_opt( 'avail_preferred_stack', '' ); ?>
            <?php if ( ! empty( $stack ) ) : ?>
            <div class="avail-info-card">
                <h3>🛠
                    <span data-lang="en">Preferred Stack</span>
                    <span data-lang="fr">Stack préférée</span>
                    <span data-lang="es">Stack preferido</span>
                </h3>
                <div class="avail-tags">
                    <?php foreach ( array_filter( array_map( 'trim', explode( ',', $stack ) ) ) as $tech ) : ?>
                    <span class="skill-tag"><?php echo esc_html( $tech ); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <?php $location = hdgavi_opt( 'avail_location_pref_en', '' ); ?>
            <?php if ( ! empty( $location ) ) : ?>
            <div class="avail-info-card">
                <h3>📍
                    <span data-lang="en">Location</span>
                    <span data-lang="fr">Localisation</span>
                    <span data-lang="es">Ubicación</span>
                </h3>
                <p>
                    <span data-lang="en"><?php echo esc_html( $location ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'avail_location_pref_fr', $location ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'avail_location_pref_es', $location ) ); ?></span>
                </p>
            </div>
            <?php endif; ?>

            <?php $experience = hdgavi_opt( 'avail_experience_summary', '' ); ?>
            <?php if ( ! empty( $experience ) ) : ?>
            <div class="avail-info-card">
                <h3>📊
                    <span data-lang="en">Experience</span>
                    <span data-lang="fr">Expérience</span>
                    <span data-lang="es">Experiencia</span>
                </h3>
                <p><?php echo esc_html( $experience ); ?></p>
            </div>
            <?php endif; ?>
        </div>

        <!-- CTA -->
        <div class="avail-actions fade-up">
            <button type="button" class="btn-primary hdgavi-cv-download-trigger">
                <?php echo hdgavi_icon( 'download', 16 ); ?>
                <span data-lang="en">Download CV</span>
                <span data-lang="fr">Télécharger CV</span>
                <span data-lang="es">Descargar CV</span>
            </button>
            <a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>" class="btn-ghost">
                <?php echo hdgavi_icon( 'mail', 16 ); ?>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_avail_cta_en', 'Get in touch' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_avail_cta_fr', 'Me contacter' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_avail_cta_es', 'Contacto' ) ); ?></span>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
