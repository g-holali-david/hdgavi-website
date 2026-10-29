<?php
/**
 * Template Name: Services / Prestations
 * Areas of work (Customizer service_N_*, defaults taken from the CV) and a message form (AJAX).
 * Not linked from the menu.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$calendly_url = hdgavi_opt( 'booking_calendly_url', '' );

$services = array(
    array(
        'key'     => 'service_1',
        'default' => array(
            'en'      => 'Containerisation and Kubernetes',
            'fr'      => 'Conteneurisation et Kubernetes',
            'es'      => 'Contenedorización y Kubernetes',
            'desc_en' => 'Containerising services on Red Hat UBI 8, deploying and orchestrating them on Kubernetes with Helm charts, auto-scaling and version upgrades.',
            'desc_fr' => 'Conteneurisation de services sous Red Hat UBI 8, déploiement et orchestration sur Kubernetes via Helm Charts, auto-scaling et montées de version.',
            'desc_es' => 'Contenedorización de servicios con Red Hat UBI 8, despliegue y orquestación en Kubernetes con Helm Charts, auto-scaling y actualizaciones de versión.',
        ),
        'features_en' => 'Docker,Kubernetes,Helm,Istio',
        'features_fr' => 'Docker,Kubernetes,Helm,Istio',
        'features_es' => 'Docker,Kubernetes,Helm,Istio',
    ),
    array(
        'key'     => 'service_2',
        'default' => array(
            'en'      => 'CI/CD and test automation',
            'fr'      => 'CI/CD et automatisation des tests',
            'es'      => 'CI/CD y automatización de pruebas',
            'desc_en' => 'Pipelines with Jenkins, GitLab CI, GitHub Actions and ArgoCD; automated validation tests and shorter validation workflows.',
            'desc_fr' => 'Pipelines Jenkins, GitLab CI, GitHub Actions et ArgoCD ; automatisation des tests de validation et industrialisation des workflows de validation.',
            'desc_es' => 'Pipelines con Jenkins, GitLab CI, GitHub Actions y ArgoCD; automatización de las pruebas de validación y de los flujos de validación.',
        ),
        'features_en' => 'Git,Jenkins,GitLab CI,GitHub Actions,ArgoCD',
        'features_fr' => 'Git,Jenkins,GitLab CI,GitHub Actions,ArgoCD',
        'features_es' => 'Git,Jenkins,GitLab CI,GitHub Actions,ArgoCD',
    ),
    array(
        'key'     => 'service_3',
        'default' => array(
            'en'      => 'Container security',
            'fr'      => 'Sécurité des conteneurs',
            'es'      => 'Seguridad de contenedores',
            'desc_en' => 'Hardening containers under the principle of least privilege (non-root, securityContext), image scanning with Trivy, policies with Kyverno.',
            'desc_fr' => 'Durcissement des conteneurs selon le principe du moindre privilège (non-root, securityContext), analyse des images avec Trivy, politiques Kyverno.',
            'desc_es' => 'Endurecimiento de contenedores según el principio de mínimo privilegio (non-root, securityContext), análisis de imágenes con Trivy, políticas Kyverno.',
        ),
        'features_en' => 'Kyverno,Trivy',
        'features_fr' => 'Kyverno,Trivy',
        'features_es' => 'Kyverno,Trivy',
    ),
);

/** Comma-separated features as a plain technology line, one per language. */
$features_html = function ( $csv_by_lang ) {
    $default = hdgavi_opt( 'default_lang', 'en' );
    $out     = '';
    foreach ( $csv_by_lang as $lang => $csv ) {
        $items = array_filter( array_map( 'trim', explode( ',', (string) $csv ) ) );
        if ( ! $items ) continue;
        $hidden = ( $lang !== $default ) ? ' aria-hidden="true"' : '';
        $out   .= '<ul class="stack" data-lang="' . esc_attr( $lang ) . '"' . $hidden . '>';
        foreach ( $items as $item ) $out .= '<li>' . esc_html( $item ) . '</li>';
        $out .= '</ul>';
    }
    return $out;
};
?>
<section class="sec wrap sec--first" aria-labelledby="t-services">
    <h1 class="sec-title" id="t-services"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_services_title', 'Areas of work', 'Domaines d’intervention', 'Ámbitos de trabajo' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_services_desc', 'What I work on at Dassault Systèmes and in my personal projects.', 'Ce sur quoi je travaille chez Dassault Systèmes et dans mes projets personnels.', 'En qué trabajo en Dassault Systèmes y en mis proyectos personales.' ) ); ?></p>
        <?php endif; ?>

        <?php foreach ( $services as $svc ) :
            $key   = $svc['key'];
            $title = hdgavi_opt_tri( "{$key}_title", $svc['default']['en'], $svc['default']['fr'], $svc['default']['es'] );
            $desc  = hdgavi_opt_tri( "{$key}_desc", $svc['default']['desc_en'], $svc['default']['desc_fr'], $svc['default']['desc_es'] );
            $feat  = hdgavi_opt_tri( "{$key}_features", $svc['features_en'], $svc['features_fr'], $svc['features_es'] );
        ?>
        <article class="entry">
            <?php
            // one ul.stack per language (the hidden ones take no grid cell); escaped in the closure
            $fh = $features_html( $feat );
            echo '' !== $fh ? $fh : '<p class="when"></p>';
            ?>
            <div class="what">
                <h2><?php echo hdgavi_tri_arr( $title ); ?></h2>
                <p class="desc"><?php echo hdgavi_tri_arr( $desc ); ?></p>
            </div>
        </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="sec wrap" id="devis" aria-labelledby="t-quote">
    <h2 class="sec-title" id="t-quote"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'services_cta_title', 'Write to me', 'M’écrire', 'Escribirme' ) ); ?></h2>
    <div class="sec-body">
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'services_cta_desc', 'Describe the context of your request; I answer by e-mail.', 'Décrivez le contexte de votre demande, je réponds par e-mail.', 'Describa el contexto de su solicitud; respondo por correo.' ) ); ?></p>

        <?php $web3key = hdgavi_opt( 'web3forms_key', '' ); ?>
        <form class="contact-form service-form sec-main" id="quoteForm" <?php if ( ! empty( $web3key ) ) : ?>action="https://api.web3forms.com/submit" method="POST"<?php endif; ?>>
            <?php if ( ! empty( $web3key ) ) : ?>
            <input type="hidden" name="access_key" value="<?php echo esc_attr( $web3key ); ?>">
            <?php endif; ?>
            <input type="hidden" name="subject" value="Demande de devis — <?php echo esc_attr( hdgavi_opt( 'general_name', '' ) ); ?>">
            <input type="checkbox" name="botcheck" class="sr-only" style="display:none" tabindex="-1" autocomplete="off">

            <div class="form-group">
                <label for="quote-name"><?php echo hdgavi_tri( 'Name', 'Nom', 'Nombre' ); ?></label>
                <input type="text" id="quote-name" name="name" required autocomplete="name">
            </div>

            <div class="form-group">
                <label for="quote-email"><?php echo hdgavi_tri( 'E-mail', 'E-mail', 'Correo electrónico' ); ?></label>
                <input type="email" id="quote-email" name="email" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="quote-company"><?php echo hdgavi_tri( 'Company (optional)', 'Entreprise (facultatif)', 'Empresa (opcional)' ); ?></label>
                <input type="text" id="quote-company" name="company" autocomplete="organization">
            </div>

            <div class="form-group">
                <label for="quote-service"><?php echo hdgavi_tri( 'Subject', 'Sujet', 'Tema' ); ?></label>
                <select id="quote-service" name="service" required>
                    <option value="">—</option>
                    <option value="devops-consulting" data-lang-text-en="Containers, Kubernetes, CI/CD" data-lang-text-fr="Conteneurs, Kubernetes, CI/CD" data-lang-text-es="Contenedores, Kubernetes, CI/CD">Containers, Kubernetes, CI/CD</option>
                    <option value="security-audit" data-lang-text-en="Container security" data-lang-text-fr="Sécurité des conteneurs" data-lang-text-es="Seguridad de contenedores">Container security</option>
                    <option value="other" data-lang-text-en="Other" data-lang-text-fr="Autre" data-lang-text-es="Otro">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="quote-message"><?php echo hdgavi_tri( 'Message', 'Message', 'Mensaje' ); ?></label>
                <textarea id="quote-message" name="message" required rows="5"></textarea>
            </div>

            <button type="submit" class="btn btn-submit"><?php echo hdgavi_tri( 'Send', 'Envoyer', 'Enviar' ); ?></button>

            <div class="form-feedback" id="quoteFeedback" aria-live="polite" role="status"></div>
        </form>
    </div>
</section>

<?php if ( ! empty( $calendly_url ) ) : ?>
<section class="sec wrap" aria-labelledby="t-call">
    <h2 class="sec-title" id="t-call"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'booking_title', 'Schedule a call', 'Planifier un appel', 'Programar una llamada' ) ); ?></h2>
    <div class="sec-body">
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'booking_desc', 'Booking through Calendly.', 'Réservation via Calendly.', 'Reserva a través de Calendly.' ) ); ?></p>
        <p class="sec-main"><a href="<?php echo esc_url( $calendly_url ); ?>" class="btn-ghost" target="_blank" rel="noopener"><?php echo hdgavi_tri( 'Open Calendly', 'Ouvrir Calendly', 'Abrir Calendly' ); ?></a></p>
    </div>
</section>
<?php endif; ?>
<?php get_footer(); ?>
