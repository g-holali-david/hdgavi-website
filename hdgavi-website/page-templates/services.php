<?php
/**
 * Template Name: Services / Prestations
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$calendly_url = hdgavi_opt( 'booking_calendly_url', '' );
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_services_section_en', 'What I offer' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_services_section_fr', 'Ce que je propose' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_services_section_es', 'Lo que ofrezco' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_services_title_en', 'Services' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_services_title_fr', 'Prestations' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_services_title_es', 'Servicios' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_services_desc_en', 'DevOps consulting, security audits, and technical training for teams and organizations.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_services_desc_fr', 'Consulting DevOps, audits sécurité et formation technique pour équipes et organisations.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_services_desc_es', 'Consultoría DevOps, auditorías de seguridad y formación técnica para equipos y organizaciones.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <!-- Services cards -->
        <div class="services-grid">
            <?php
            $services = array(
                array(
                    'icon'    => '🔧',
                    'key'     => 'service_1',
                    'default' => array(
                        'en' => 'DevOps Consulting',
                        'fr' => 'Consulting DevOps',
                        'es' => 'Consultoría DevOps',
                        'desc_en' => 'CI/CD pipeline design, containerization strategy, Kubernetes deployment, infrastructure as code. I help teams adopt DevOps best practices and accelerate delivery.',
                        'desc_fr' => 'Conception de pipelines CI/CD, stratégie de conteneurisation, déploiement Kubernetes, infrastructure as code. J\'aide les équipes à adopter les bonnes pratiques DevOps et accélérer les livraisons.',
                        'desc_es' => 'Diseño de pipelines CI/CD, estrategia de contenedorización, despliegue Kubernetes, infraestructura como código. Ayudo a los equipos a adoptar las mejores prácticas DevOps.',
                    ),
                    'features_en' => 'CI/CD pipelines,Docker & Kubernetes,Infrastructure as Code,GitOps workflows,Monitoring & alerting',
                    'features_fr' => 'Pipelines CI/CD,Docker & Kubernetes,Infrastructure as Code,Workflows GitOps,Monitoring & alerting',
                    'features_es' => 'Pipelines CI/CD,Docker & Kubernetes,Infraestructura como código,Flujos GitOps,Monitoreo y alertas',
                ),
                array(
                    'icon'    => '🛡️',
                    'key'     => 'service_2',
                    'default' => array(
                        'en' => 'Security Audit',
                        'fr' => 'Audit Sécurité',
                        'es' => 'Auditoría de Seguridad',
                        'desc_en' => 'Infrastructure security review, vulnerability assessment, compliance check. Identify risks and get actionable recommendations to harden your systems.',
                        'desc_fr' => 'Revue sécurité infrastructure, évaluation des vulnérabilités, vérification de conformité. Identifiez les risques et obtenez des recommandations concrètes.',
                        'desc_es' => 'Revisión de seguridad de infraestructura, evaluación de vulnerabilidades, verificación de cumplimiento. Identifique riesgos y obtenga recomendaciones concretas.',
                    ),
                    'features_en' => 'Infrastructure hardening,OWASP Top 10 review,Container security,Secret management,Compliance assessment',
                    'features_fr' => 'Durcissement infrastructure,Revue OWASP Top 10,Sécurité conteneurs,Gestion des secrets,Évaluation conformité',
                    'features_es' => 'Endurecimiento de infraestructura,Revisión OWASP Top 10,Seguridad de contenedores,Gestión de secretos,Evaluación de cumplimiento',
                ),
                array(
                    'icon'    => '📚',
                    'key'     => 'service_3',
                    'default' => array(
                        'en' => 'Technical Training',
                        'fr' => 'Formation Technique',
                        'es' => 'Formación Técnica',
                        'desc_en' => 'Hands-on workshops on Docker, Kubernetes, CI/CD, and cloud technologies. Tailored to your team\'s skill level and tech stack.',
                        'desc_fr' => 'Ateliers pratiques sur Docker, Kubernetes, CI/CD et technologies cloud. Adaptés au niveau et à la stack technique de votre équipe.',
                        'desc_es' => 'Talleres prácticos sobre Docker, Kubernetes, CI/CD y tecnologías cloud. Adaptados al nivel y stack técnico de su equipo.',
                    ),
                    'features_en' => 'Docker fundamentals,Kubernetes in production,CI/CD from zero,Cloud architecture,Hands-on labs',
                    'features_fr' => 'Fondamentaux Docker,Kubernetes en production,CI/CD de zéro,Architecture cloud,Labs pratiques',
                    'features_es' => 'Fundamentos Docker,Kubernetes en producción,CI/CD desde cero,Arquitectura cloud,Labs prácticos',
                ),
            );

            foreach ( $services as $svc ) :
                $key = $svc['key'];
                $title_en = hdgavi_opt( "{$key}_title_en", $svc['default']['en'] );
                $title_fr = hdgavi_opt( "{$key}_title_fr", $svc['default']['fr'] );
                $title_es = hdgavi_opt( "{$key}_title_es", $svc['default']['es'] );
                $desc_en  = hdgavi_opt( "{$key}_desc_en", $svc['default']['desc_en'] );
                $desc_fr  = hdgavi_opt( "{$key}_desc_fr", $svc['default']['desc_fr'] );
                $desc_es  = hdgavi_opt( "{$key}_desc_es", $svc['default']['desc_es'] );
                $feat_en  = hdgavi_opt( "{$key}_features_en", $svc['features_en'] );
                $feat_fr  = hdgavi_opt( "{$key}_features_fr", $svc['features_fr'] );
                $feat_es  = hdgavi_opt( "{$key}_features_es", $svc['features_es'] );
            ?>
            <div class="service-card fade-up">
                <div class="service-icon"><?php echo esc_html( hdgavi_opt( "{$key}_icon", $svc['icon'] ) ); ?></div>
                <h2 class="service-title">
                    <span data-lang="en"><?php echo esc_html( $title_en ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $title_fr ); ?></span>
                    <span data-lang="es"><?php echo esc_html( $title_es ); ?></span>
                </h2>
                <p class="service-desc">
                    <span data-lang="en"><?php echo esc_html( $desc_en ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( $desc_fr ); ?></span>
                    <span data-lang="es"><?php echo esc_html( $desc_es ); ?></span>
                </p>
                <ul class="service-features" data-lang="en">
                    <?php foreach ( array_filter( array_map( 'trim', explode( ',', $feat_en ) ) ) as $f ) : ?>
                    <li><?php echo esc_html( $f ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <ul class="service-features" data-lang="fr">
                    <?php foreach ( array_filter( array_map( 'trim', explode( ',', $feat_fr ) ) ) as $f ) : ?>
                    <li><?php echo esc_html( $f ); ?></li>
                    <?php endforeach; ?>
                </ul>
                <ul class="service-features" data-lang="es">
                    <?php foreach ( array_filter( array_map( 'trim', explode( ',', $feat_es ) ) ) as $f ) : ?>
                    <li><?php echo esc_html( $f ); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- Quote request form -->
        <div class="services-cta fade-up" id="devis">
            <div class="section-header" style="text-align:center;max-width:600px;margin:0 auto 32px">
                <h2 class="section-title" style="font-size:1.5rem">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'services_cta_title_en', 'Request a quote' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'services_cta_title_fr', 'Demander un devis' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'services_cta_title_es', 'Solicitar un presupuesto' ) ); ?></span>
                </h2>
                <p class="section-desc" style="text-align:center">
                    <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'services_cta_desc_en', 'Describe your project and I\'ll get back to you within 48 hours.' ) ); ?></span>
                    <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'services_cta_desc_fr', 'Décrivez votre projet et je vous recontacte sous 48h.' ) ); ?></span>
                    <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'services_cta_desc_es', 'Describa su proyecto y le responderé en 48 horas.' ) ); ?></span>
                </p>
            </div>

            <?php $web3key = hdgavi_opt( 'web3forms_key', '' ); ?>
            <form class="contact-form" id="quoteForm" <?php if ( ! empty( $web3key ) ) : ?>action="https://api.web3forms.com/submit" method="POST"<?php endif; ?> style="max-width:640px;margin:0 auto">
                <?php if ( ! empty( $web3key ) ) : ?>
                <input type="hidden" name="access_key" value="<?php echo esc_attr( $web3key ); ?>">
                <?php endif; ?>
                <input type="hidden" name="subject" value="Demande de devis — <?php echo esc_attr( hdgavi_opt( 'general_name', '' ) ); ?>">
                <input type="checkbox" name="botcheck" class="sr-only" style="display:none" tabindex="-1" autocomplete="off">

                <div class="form-group">
                    <label for="quote-name">
                        <span data-lang="en">Your name</span>
                        <span data-lang="fr">Votre nom</span>
                        <span data-lang="es">Su nombre</span>
                    </label>
                    <input type="text" id="quote-name" name="name" required autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="quote-email">
                        <span data-lang="en">Your email</span>
                        <span data-lang="fr">Votre email</span>
                        <span data-lang="es">Su email</span>
                    </label>
                    <input type="email" id="quote-email" name="email" required autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="quote-company">
                        <span data-lang="en">Company (optional)</span>
                        <span data-lang="fr">Entreprise (optionnel)</span>
                        <span data-lang="es">Empresa (opcional)</span>
                    </label>
                    <input type="text" id="quote-company" name="company" autocomplete="organization">
                </div>

                <div class="form-group">
                    <label for="quote-service">
                        <span data-lang="en">Service needed</span>
                        <span data-lang="fr">Prestation souhaitée</span>
                        <span data-lang="es">Servicio requerido</span>
                    </label>
                    <select id="quote-service" name="service" required>
                        <option value="">—</option>
                        <option value="devops-consulting">DevOps Consulting</option>
                        <option value="security-audit">Security Audit</option>
                        <option value="training">Training / Formation</option>
                        <option value="other">Other / Autre</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="quote-message">
                        <span data-lang="en">Project description</span>
                        <span data-lang="fr">Description du projet</span>
                        <span data-lang="es">Descripción del proyecto</span>
                    </label>
                    <textarea id="quote-message" name="message" required rows="5"></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <?php echo hdgavi_icon( 'send', 16 ); ?>
                    <span data-lang="en">Send request</span>
                    <span data-lang="fr">Envoyer la demande</span>
                    <span data-lang="es">Enviar solicitud</span>
                </button>

                <div class="form-feedback" id="quoteFeedback" aria-live="polite" role="status"></div>
            </form>
        </div>

        <?php if ( ! empty( $calendly_url ) ) : ?>
        <!-- Booking CTA -->
        <div class="services-booking fade-up" style="text-align:center;margin-top:48px">
            <h2 class="section-title" style="font-size:1.3rem">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'booking_title_en', 'Book a free discovery call' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'booking_title_fr', 'Réservez un appel découverte gratuit' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'booking_title_es', 'Reserve una llamada de descubrimiento gratuita' ) ); ?></span>
            </h2>
            <p class="section-desc" style="text-align:center;margin:8px auto 24px">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'booking_desc_en', '30-minute call to discuss your needs — no commitment.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'booking_desc_fr', 'Appel de 30 minutes pour discuter de vos besoins — sans engagement.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'booking_desc_es', 'Llamada de 30 minutos para discutir sus necesidades — sin compromiso.' ) ); ?></span>
            </p>
            <a href="<?php echo esc_url( $calendly_url ); ?>" class="btn-primary" target="_blank" rel="noopener">
                <?php echo hdgavi_icon( 'calendar', 16 ); ?>
                <span data-lang="en">Schedule a call</span>
                <span data-lang="fr">Planifier un appel</span>
                <span data-lang="es">Programar una llamada</span>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
