<?php
/**
 * Template Name: Contact
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$email        = hdgavi_opt( 'general_email', '' );
$location     = hdgavi_opt( 'general_location', '' );
$github_url   = hdgavi_opt( 'contact_github', '' );
$linkedin_url = hdgavi_opt( 'contact_linkedin', '' );
$web3key      = hdgavi_opt( 'web3forms_key', '' );
$copy_enabled = hdgavi_opt( 'copy_email_enabled', true );
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up">
            <div class="section-label">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_contact_section_en', 'Get in Touch' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_contact_section_fr', 'Prendre contact' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_contact_section_es', 'Contacto' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_contact_title_en', 'Contact' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_contact_title_fr', 'Contact' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_contact_title_es', 'Contacto' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_contact_desc_en', 'Have a question or want to work together? Feel free to reach out.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_contact_desc_fr', 'Une question ou envie de collaborer ? N\'hésitez pas à me contacter.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_contact_desc_es', '¿Tienes alguna pregunta o quieres colaborar? No dudes en contactarme.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <div class="contact-grid">
            <div class="contact-info-list fade-up">
                <?php if ( ! empty( $email ) ) : ?>
                <div class="contact-info-item">
                    <?php echo hdgavi_icon( 'mail', 20 ); ?>
                    <div>
                        <div class="info-label">Email</div>
                        <div class="info-value">
                            <a href="mailto:<?php echo esc_attr( $email ); ?>" style="color:var(--text-primary)"><?php echo esc_html( $email ); ?></a>
                            <?php if ( $copy_enabled ) : ?>
                            <button class="copy-email-btn" data-email="<?php echo esc_attr( $email ); ?>" type="button" aria-label="Copy email">
                                <?php echo hdgavi_icon( 'copy', 12 ); ?>
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( ! empty( $location ) ) : ?>
                <div class="contact-info-item">
                    <?php echo hdgavi_icon( 'map-pin', 20 ); ?>
                    <div>
                        <div class="info-label">
                            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_contact_loc_en', 'Location' ) ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_contact_loc_fr', 'Localisation' ) ); ?></span>
                            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_contact_loc_es', 'Ubicación' ) ); ?></span>
                        </div>
                        <div class="info-value"><?php echo esc_html( $location ); ?></div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( ! empty( $github_url ) ) : ?>
                <div class="contact-info-item">
                    <?php echo hdgavi_icon( 'github', 20 ); ?>
                    <div>
                        <div class="info-label">GitHub</div>
                        <div class="info-value">
                            <a href="<?php echo esc_url( $github_url ); ?>" target="_blank" rel="noopener" style="color:var(--text-primary)"><?php echo esc_html( hdgavi_opt( 'contact_github_handle', '' ) ); ?></a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( ! empty( $linkedin_url ) ) : ?>
                <div class="contact-info-item">
                    <?php echo hdgavi_icon( 'linkedin', 20 ); ?>
                    <div>
                        <div class="info-label">LinkedIn</div>
                        <div class="info-value">
                            <a href="<?php echo esc_url( $linkedin_url ); ?>" target="_blank" rel="noopener" style="color:var(--text-primary)">LinkedIn</a>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <?php if ( function_exists( 'hdgavi_render_vcard_button' ) ) hdgavi_render_vcard_button(); ?>
                <?php if ( function_exists( 'hdgavi_render_qr_block' ) ) hdgavi_render_qr_block(); ?>
            </div>

            <!-- Contact Form -->
            <div class="fade-up">
                <form class="contact-form" id="contactForm" <?php if ( ! empty( $web3key ) ) : ?>action="https://api.web3forms.com/submit" method="POST"<?php endif; ?>>
                    <?php if ( ! empty( $web3key ) ) : ?>
                    <input type="hidden" name="access_key" value="<?php echo esc_attr( $web3key ); ?>">
                    <?php endif; ?>
                    <input type="hidden" name="subject" value="Portfolio Contact — <?php echo esc_attr( hdgavi_opt( 'general_name', '' ) ); ?>">
                    <input type="checkbox" name="botcheck" class="sr-only" style="display:none" tabindex="-1" autocomplete="off">

                    <div class="form-group">
                        <label for="contact-name">
                            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'form_name_en', 'Your name' ) ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'form_name_fr', 'Votre nom' ) ); ?></span>
                            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'form_name_es', 'Tu nombre' ) ); ?></span>
                        </label>
                        <input type="text" id="contact-name" name="name" required autocomplete="name">
                    </div>

                    <div class="form-group">
                        <label for="contact-email">
                            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'form_email_en', 'Your email' ) ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'form_email_fr', 'Votre email' ) ); ?></span>
                            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'form_email_es', 'Tu email' ) ); ?></span>
                        </label>
                        <input type="email" id="contact-email" name="email" required autocomplete="email">
                    </div>

                    <div class="form-group">
                        <label for="contact-message">
                            <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'form_message_en', 'Your message' ) ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'form_message_fr', 'Votre message' ) ); ?></span>
                            <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'form_message_es', 'Tu mensaje' ) ); ?></span>
                        </label>
                        <textarea id="contact-message" name="message" required rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn-submit" id="contactSubmit">
                        <?php echo hdgavi_icon( 'send', 16 ); ?>
                        <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'form_btn_en', 'Send' ) ); ?></span>
                        <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'form_btn_fr', 'Envoyer' ) ); ?></span>
                        <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'form_btn_es', 'Enviar' ) ); ?></span>
                    </button>

                    <div class="form-feedback" id="formFeedback" aria-live="polite" role="status"></div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
