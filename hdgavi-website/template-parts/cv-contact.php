<?php
/**
 * CV section: contact details, optionally followed by the contact form.
 * Args: heading = 'h1' | 'h2', first = bool, form = bool
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

$args     = wp_parse_args( isset( $args ) ? $args : array(), array( 'heading' => 'h2', 'first' => false, 'form' => false ) );
$email    = hdgavi_opt( 'general_email', '' );
$phone    = hdgavi_opt( 'contact_phone', '' );
$github   = hdgavi_opt( 'contact_github', '' );
$linkedin = hdgavi_opt( 'contact_linkedin', '' );
$cv_url   = hdgavi_opt( 'cv_pdf_url', '' );
$web3key  = hdgavi_opt( 'web3forms_key', '' );
$h        = ( 'h1' === $args['heading'] ) ? 'h1' : 'h2';
$strip    = function ( $url ) { return preg_replace( '#^https?://(www\.)?#', '', untrailingslashit( $url ) ); };
?>
<section class="sec wrap<?php echo $args['first'] ? ' sec--first' : ''; ?>" id="contact" aria-labelledby="t-contact">
    <<?php echo $h; ?> class="sec-title" id="t-contact"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'contact' ) ); ?></<?php echo $h; ?>>
    <div class="sec-body">
        <dl class="coords">
            <?php if ( $email ) : ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'email' ) ); ?></dt>
                <dd>
                    <a href="mailto:<?php echo esc_attr( antispambot( $email ) ); ?>"><?php echo esc_html( antispambot( $email ) ); ?></a>
                    <?php if ( hdgavi_opt( 'copy_email_enabled', true ) ) : ?>
                    <button class="copy-email-btn" data-email="<?php echo esc_attr( $email ); ?>" type="button" aria-label="Copy e-mail address"><?php echo hdgavi_icon( 'copy', 14 ); ?></button>
                    <?php endif; ?>
                </dd>
            </div>
            <?php endif; ?>
            <?php if ( $phone ) : ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'phone' ) ); ?></dt>
                <dd><a href="tel:<?php echo esc_attr( preg_replace( '/[^0-9+]/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a></dd>
            </div>
            <?php endif; ?>
            <?php if ( $linkedin ) : ?>
            <div class="entry">
                <dt>LinkedIn</dt>
                <dd><a href="<?php echo esc_url( $linkedin ); ?>" rel="me noopener"><?php echo esc_html( $strip( $linkedin ) ); ?></a></dd>
            </div>
            <?php endif; ?>
            <?php if ( $github ) : ?>
            <div class="entry">
                <dt>GitHub</dt>
                <dd><a href="<?php echo esc_url( $github ); ?>" rel="me noopener"><?php echo esc_html( $strip( $github ) ); ?></a></dd>
            </div>
            <?php endif; ?>
            <?php if ( $cv_url ) : ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'cv' ) ); ?></dt>
                <dd><a href="<?php echo esc_url( home_url( '/?hdgavi_cv=preview' ) ); ?>" target="_blank" rel="noopener" type="application/pdf"><?php echo esc_html( basename( wp_parse_url( $cv_url, PHP_URL_PATH ) ) ); ?></a></dd>
            </div>
            <?php endif; ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'location' ) ); ?></dt>
                <dd><?php echo esc_html( hdgavi_cv_location() ); ?></dd>
            </div>
        </dl>

        <?php if ( $args['form'] ) : ?>
        <div class="entry">
            <p class="when"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'write_me' ) ); ?></p>
            <form class="contact-form" id="contactForm" <?php if ( ! empty( $web3key ) ) : ?>action="https://api.web3forms.com/submit" method="POST"<?php endif; ?>>
                <?php if ( ! empty( $web3key ) ) : ?>
                <input type="hidden" name="access_key" value="<?php echo esc_attr( $web3key ); ?>">
                <?php endif; ?>
                <input type="hidden" name="subject" value="Portfolio — <?php echo esc_attr( hdgavi_opt( 'general_name', '' ) ); ?>">
                <input type="checkbox" name="botcheck" class="sr-only" style="display:none" tabindex="-1" autocomplete="off">

                <div class="form-group">
                    <label for="contact-name"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'form_name' ) ); ?></label>
                    <input type="text" id="contact-name" name="name" required autocomplete="name">
                </div>
                <div class="form-group">
                    <label for="contact-email"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'form_email' ) ); ?></label>
                    <input type="email" id="contact-email" name="email" required autocomplete="email">
                </div>
                <div class="form-group">
                    <label for="contact-message"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'form_message' ) ); ?></label>
                    <textarea id="contact-message" name="message" required rows="6"></textarea>
                </div>
                <button type="submit" class="btn" id="contactSubmit"><?php echo hdgavi_tri_arr( hdgavi_cv_label( 'form_send' ) ); ?></button>
                <div class="form-feedback" id="formFeedback" aria-live="polite" role="status"></div>
            </form>
        </div>
        <?php endif; ?>
    </div>
</section>
