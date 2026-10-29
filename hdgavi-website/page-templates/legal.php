<?php
/**
 * Template Name: Mentions Légales / Legal
 * Legal notice and privacy policy, laid out like the CV: label column + text column.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$email   = hdgavi_opt( 'general_email', '' );
$updated = hdgavi_opt( 'legal_updated', '' );
$updated = '' !== $updated
    ? array( 'en' => $updated, 'fr' => $updated, 'es' => $updated )
    : array( 'en' => 'October 2026', 'fr' => 'octobre 2026', 'es' => 'octubre de 2026' );

/** One row: label in the meta column, text in the main column ($h: heading level of the label). */
$row = function ( $label, $html, $h = 'h2' ) {
    $h = ( 'h3' === $h ) ? 'h3' : 'h2';
    echo '<div class="entry"><' . $h . ' class="entry-label">' . hdgavi_tri_arr( $label ) . '</' . $h . '><div class="what legal-text">' . $html . '</div></div>'; // phpcs:ignore -- parts escaped by the callers
};
$opt_p = function ( $key, $en, $fr, $es ) {
    return '<p>' . hdgavi_tri_arr( hdgavi_opt_tri( $key, $en, $fr, $es ) ) . '</p>';
};
?>
<section class="sec wrap sec--first" aria-labelledby="t-legal">
    <h1 class="sec-title" id="t-legal"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_legal_notice', 'Legal notice', 'Mentions légales', 'Aviso legal' ) ); ?></h1>
    <div class="sec-body">
        <?php
        $publisher = esc_html( hdgavi_opt( 'general_name', 'Holali David GAVI' ) );
        if ( hdgavi_opt( 'general_location', '' ) ) {
            $publisher .= '<br>' . esc_html( hdgavi_opt( 'general_location', '' ) );
        }
        if ( $email ) {
            $publisher .= '<br>' . hdgavi_tri_arr( hdgavi_opt_tri( 'label_legal_email', 'E-mail:', 'E-mail :', 'Correo:' ) ) . ' <a href="mailto:' . esc_attr( antispambot( $email ) ) . '">' . esc_html( antispambot( $email ) ) . '</a>';
        }
        $row( hdgavi_opt_tri( 'label_legal_publisher', 'Site publisher', 'Éditeur du site', 'Editor del sitio' ), '<p>' . $publisher . '</p>' );

        $host = trim( hdgavi_opt( 'legal_hosting_name', '' ) . ( hdgavi_opt( 'legal_hosting_address', '' ) ? ', ' . hdgavi_opt( 'legal_hosting_address', '' ) : '' ), ', ' );
        if ( '' !== $host ) {
            $row( hdgavi_opt_tri( 'label_legal_hosting', 'Hosting', 'Hébergement', 'Alojamiento' ), '<p>' . esc_html( $host ) . '</p>' );
        }

        $row(
            hdgavi_opt_tri( 'label_legal_ip_heading', 'Intellectual property', 'Propriété intellectuelle', 'Propiedad intelectual' ),
            $opt_p( 'legal_ip',
                'All content on this site (texts, images, code) is the property of the publisher unless otherwise stated. Any reproduction without prior authorisation is prohibited.',
                'L’ensemble du contenu de ce site (textes, images, code) est la propriété de l’éditeur sauf mention contraire. Toute reproduction sans autorisation préalable est interdite.',
                'Todo el contenido de este sitio (textos, imágenes, código) es propiedad del editor salvo mención contraria. Queda prohibida toda reproducción sin autorización previa.'
            )
        );
        ?>
    </div>
</section>

<section class="sec wrap" aria-labelledby="t-privacy">
    <h2 class="sec-title" id="t-privacy"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_legal_privacy', 'Privacy policy', 'Politique de confidentialité', 'Política de privacidad' ) ); ?></h2>
    <div class="sec-body">
        <?php
        $row(
            hdgavi_opt_tri( 'label_legal_data', 'Data collected', 'Données collectées', 'Datos recopilados' ),
            $opt_p( 'legal_data',
                'The forms of this site only collect what they ask for: name, e-mail address and message (contact form); name, e-mail address, role and reason (CV request); e-mail address (newsletter). This data is only used to answer you or to send the newsletter.',
                'Les formulaires de ce site ne collectent que ce qu’ils demandent : nom, adresse e-mail et message (formulaire de contact) ; nom, adresse e-mail, fonction et motif (demande de CV) ; adresse e-mail (newsletter). Ces données servent uniquement à vous répondre ou à envoyer la newsletter.',
                'Los formularios de este sitio solo recogen lo que piden: nombre, correo electrónico y mensaje (formulario de contacto); nombre, correo electrónico, cargo y motivo (solicitud del CV); correo electrónico (boletín). Estos datos solo se utilizan para responderle o para enviar el boletín.'
            ),
            'h3'
        );
        $row(
            hdgavi_opt_tri( 'legal_cookies_title', 'Cookies', 'Cookies', 'Cookies' ),
            $opt_p( 'legal_cookies',
                'This site stores your preferences (language, theme) in your browser’s localStorage and uses no tracking cookies.',
                'Ce site enregistre vos préférences (langue, thème) dans le localStorage de votre navigateur et n’utilise aucun cookie de traçage.',
                'Este sitio guarda sus preferencias (idioma, tema) en el localStorage de su navegador y no utiliza cookies de seguimiento.'
            ),
            'h3'
        );
        if ( hdgavi_opt( 'stats_enabled', true ) ) {
            $row(
                hdgavi_opt_tri( 'label_legal_analytics', 'Anonymous statistics', 'Statistiques anonymes', 'Estadísticas anónimas' ),
                $opt_p( 'legal_analytics',
                    'Page views are counted with an anonymised hash of your IP address combined with the date. This hash cannot be reversed to identify you. The data is kept for 90 days.',
                    'Les pages vues sont comptées à l’aide d’une empreinte anonymisée de votre adresse IP combinée à la date. Cette empreinte ne permet pas de vous identifier. Les données sont conservées 90 jours.',
                    'Las páginas vistas se cuentan con un hash anónimo de su dirección IP combinada con la fecha. Este hash no permite identificarle. Los datos se conservan 90 días.'
                ),
                'h3'
            );
        }
        $row(
            hdgavi_opt_tri( 'label_legal_rights', 'Your rights', 'Vos droits', 'Sus derechos' ),
            $opt_p( 'legal_rights',
                'Under the GDPR and the French Data Protection Act, you can access, correct and delete your personal data. Write to me by e-mail to exercise these rights.',
                'Conformément au RGPD et à la loi Informatique et Libertés, vous disposez d’un droit d’accès, de rectification et de suppression de vos données personnelles. Écrivez-moi par e-mail pour exercer ces droits.',
                'De conformidad con el RGPD, usted tiene derecho de acceso, rectificación y supresión de sus datos personales. Escríbame por correo para ejercer estos derechos.'
            ),
            'h3'
        );
        ?>
        <p class="sec-main legal-updated"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_legal_updated', 'Last updated:', 'Dernière mise à jour :', 'Última actualización:' ) ); ?> <?php echo hdgavi_tri_arr( $updated ); ?></p>
    </div>
</section>
<?php get_footer(); ?>
