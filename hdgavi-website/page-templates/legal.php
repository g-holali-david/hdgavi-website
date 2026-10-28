<?php
/**
 * Template Name: Mentions Légales / Legal
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();
?>

<section class="page-section">
    <div class="container" style="max-width:800px">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_section_en', 'Legal' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_section_fr', 'Juridique' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_section_es', 'Jurídico' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_title_en', 'Legal Notice & Privacy Policy' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_title_fr', 'Mentions Légales & Politique de Confidentialité' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_title_es', 'Aviso Legal y Política de Privacidad' ) ); ?></span>
            </h1>
        </div>

        <div class="legal-content about-text fade-up">
            <!-- Mentions légales -->
            <h2>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_notice_en', 'Legal Notice' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_notice_fr', 'Mentions Légales' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_notice_es', 'Aviso Legal' ) ); ?></span>
            </h2>

            <h3>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_publisher_en', 'Site publisher' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_publisher_fr', 'Éditeur du site' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_publisher_es', 'Editor del sitio' ) ); ?></span>
            </h3>
            <p>
                <?php echo esc_html( hdgavi_opt( 'general_name', 'Holali David GAVI' ) ); ?><br>
                <?php echo esc_html( hdgavi_opt( 'general_location', '' ) ); ?><br>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_email_en', 'Email:' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_email_fr', 'Email :' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_email_es', 'Email:' ) ); ?></span>
                <?php echo esc_html( hdgavi_opt( 'general_email', '' ) ); ?>
            </p>

            <h3>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_hosting_en', 'Hosting' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_hosting_fr', 'Hébergement' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_hosting_es', 'Alojamiento' ) ); ?></span>
            </h3>
            <p>
                <?php echo esc_html( hdgavi_opt( 'legal_hosting_name', '' ) ); ?><br>
                <?php echo esc_html( hdgavi_opt( 'legal_hosting_address', '' ) ); ?>
            </p>

            <h3>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_ip_heading_en', 'Intellectual property' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_ip_heading_fr', 'Propriété intellectuelle' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_ip_heading_es', 'Propiedad intelectual' ) ); ?></span>
            </h3>
            <p>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'legal_ip_en', 'All content on this site (texts, images, code) is the property of the publisher unless otherwise stated. Any reproduction without prior authorization is prohibited.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'legal_ip_fr', 'L\'ensemble du contenu de ce site (textes, images, code) est la propriété de l\'éditeur sauf mention contraire. Toute reproduction sans autorisation préalable est interdite.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'legal_ip_es', 'Todo el contenido de este sitio (textos, imágenes, código) es propiedad del editor salvo mención contraria. Queda prohibida toda reproducción sin autorización previa.' ) ); ?></span>
            </p>

            <!-- Politique de confidentialité -->
            <h2 style="margin-top:40px">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_privacy_en', 'Privacy Policy' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_privacy_fr', 'Politique de Confidentialité' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_privacy_es', 'Política de Privacidad' ) ); ?></span>
            </h2>

            <h3>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_data_en', 'Data collected' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_data_fr', 'Données collectées' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_data_es', 'Datos recopilados' ) ); ?></span>
            </h3>
            <p>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'legal_data_en', 'This site may collect the following data through the contact form: name, email address and message content. This data is used solely to respond to your request.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'legal_data_fr', 'Ce site peut collecter les données suivantes via le formulaire de contact : nom, adresse email et contenu du message. Ces données sont utilisées uniquement pour répondre à votre demande.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'legal_data_es', 'Este sitio puede recopilar los siguientes datos a través del formulario de contacto: nombre, dirección de email y contenido del mensaje. Estos datos se utilizan únicamente para responder a su solicitud.' ) ); ?></span>
            </p>

            <h3>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'legal_cookies_title_en', 'Cookies' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'legal_cookies_title_fr', 'Cookies' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'legal_cookies_title_es', 'Cookies' ) ); ?></span>
            </h3>
            <p>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'legal_cookies_en', 'This site uses localStorage for user preferences (language, theme) but does not use tracking cookies. Anonymous visitor statistics may be collected without cookies.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'legal_cookies_fr', 'Ce site utilise le localStorage pour les préférences utilisateur (langue, thème) mais n\'utilise pas de cookies de traçage. Des statistiques anonymes de visite peuvent être collectées sans cookies.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'legal_cookies_es', 'Este sitio utiliza localStorage para las preferencias del usuario (idioma, tema) pero no utiliza cookies de seguimiento. Se pueden recopilar estadísticas anónimas de visitas sin cookies.' ) ); ?></span>
            </p>

            <?php if ( hdgavi_opt( 'stats_enabled', true ) ) : ?>
            <h3>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_analytics_en', 'Anonymous analytics' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_analytics_fr', 'Statistiques anonymes' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_analytics_es', 'Estadísticas anónimas' ) ); ?></span>
            </h3>
            <p>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'legal_analytics_en', 'Page views are counted using an anonymized hash of your IP address combined with the date. This hash cannot be reversed to identify you. Data is retained for 90 days.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'legal_analytics_fr', 'Les pages vues sont comptées en utilisant un hash anonymisé de votre adresse IP combinée à la date. Ce hash ne peut pas être inversé pour vous identifier. Les données sont conservées 90 jours.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'legal_analytics_es', 'Las páginas vistas se cuentan usando un hash anónimo de su dirección IP combinada con la fecha. Este hash no puede revertirse para identificarle. Los datos se conservan 90 días.' ) ); ?></span>
            </p>
            <?php endif; ?>

            <h3>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_rights_en', 'Your rights' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_rights_fr', 'Vos droits' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_rights_es', 'Sus derechos' ) ); ?></span>
            </h3>
            <p>
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'legal_rights_en', 'In accordance with the GDPR and the French Data Protection Act, you have the right to access, rectify and delete your personal data. Contact me by email to exercise these rights.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'legal_rights_fr', 'Conformément au RGPD et à la loi Informatique et Libertés, vous disposez d\'un droit d\'accès, de rectification et de suppression de vos données personnelles. Contactez-moi par email pour exercer ces droits.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'legal_rights_es', 'De conformidad con el RGPD, usted tiene derecho de acceso, rectificación y supresión de sus datos personales. Contácteme por email para ejercer estos derechos.' ) ); ?></span>
            </p>

            <p style="margin-top:32px;font-size:0.8125rem;color:var(--text-tertiary)">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_legal_updated_en', 'Last updated:' ) ); ?> <?php echo esc_html( hdgavi_opt( 'legal_updated', wp_date( 'F Y' ) ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_legal_updated_fr', 'Dernière mise à jour :' ) ); ?> <?php echo esc_html( hdgavi_opt( 'legal_updated', wp_date( 'F Y' ) ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_legal_updated_es', 'Última actualización:' ) ); ?> <?php echo esc_html( hdgavi_opt( 'legal_updated', wp_date( 'F Y' ) ) ); ?></span>
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
