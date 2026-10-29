<?php
/**
 * Template Name: Booking / Prise de RDV
 * Calendly embed when a URL is set, otherwise a request form (AJAX). Not linked from the menu.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$calendly_url = hdgavi_opt( 'booking_calendly_url', '' );
?>
<section class="sec wrap sec--first" aria-labelledby="t-booking">
    <h1 class="sec-title" id="t-booking"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_booking_title', 'Schedule a call', 'Planifier un appel', 'Programar una llamada' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_booking_desc', 'Choose a date and a time; I confirm by e-mail.', 'Choisissez une date et une heure, je confirme par e-mail.', 'Elija una fecha y una hora; confirmo por correo.' ) ); ?></p>
        <?php endif; ?>

        <?php if ( ! empty( $calendly_url ) ) : ?>
        <div class="booking-embed">
            <div class="calendly-inline-widget" data-url="<?php echo esc_url( $calendly_url ); ?>"></div>
            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
        </div>
        <?php else : ?>
        <?php
        $slots = array(
            array( 'day_en' => 'Monday to Friday', 'day_fr' => 'Du lundi au vendredi', 'day_es' => 'De lunes a viernes', 'time' => '18:00 – 20:00 CET' ),
            array( 'day_en' => 'Saturday', 'day_fr' => 'Samedi', 'day_es' => 'Sábado', 'time' => '10:00 – 17:00 CET' ),
        );
        ?>
        <dl class="booking-slots sec-main">
            <?php foreach ( $slots as $slot ) : ?>
            <div>
                <dt><?php echo hdgavi_tri( $slot['day_en'], $slot['day_fr'], $slot['day_es'] ); ?></dt>
                <dd><?php echo esc_html( $slot['time'] ); ?></dd>
            </div>
            <?php endforeach; ?>
        </dl>

        <?php $web3key = hdgavi_opt( 'web3forms_key', '' ); ?>
        <form class="contact-form booking-form sec-main" id="bookingForm" <?php if ( ! empty( $web3key ) ) : ?>action="https://api.web3forms.com/submit" method="POST"<?php endif; ?>>
            <?php if ( ! empty( $web3key ) ) : ?>
            <input type="hidden" name="access_key" value="<?php echo esc_attr( $web3key ); ?>">
            <?php endif; ?>
            <input type="hidden" name="subject" value="Booking Request — <?php echo esc_attr( hdgavi_opt( 'general_name', '' ) ); ?>">
            <input type="checkbox" name="botcheck" class="sr-only" style="display:none" tabindex="-1" autocomplete="off">

            <div class="form-group">
                <label for="booking-name"><?php echo hdgavi_tri( 'Name', 'Nom', 'Nombre' ); ?></label>
                <input type="text" id="booking-name" name="name" required autocomplete="name">
            </div>

            <div class="form-group">
                <label for="booking-email"><?php echo hdgavi_tri( 'E-mail', 'E-mail', 'Correo electrónico' ); ?></label>
                <input type="email" id="booking-email" name="email" required autocomplete="email">
            </div>

            <div class="form-group">
                <label for="booking-date"><?php echo hdgavi_tri( 'Preferred date', 'Date souhaitée', 'Fecha preferida' ); ?></label>
                <input type="date" id="booking-date" name="date" required min="<?php echo esc_attr( wp_date( 'Y-m-d', strtotime( '+1 day' ) ) ); ?>">
            </div>

            <div class="form-group">
                <label for="booking-time"><?php echo hdgavi_tri( 'Preferred time', 'Heure souhaitée', 'Hora preferida' ); ?></label>
                <select id="booking-time" name="time" required>
                    <option value="">—</option>
                    <option value="10:00">10:00</option>
                    <option value="11:00">11:00</option>
                    <option value="14:00">14:00</option>
                    <option value="15:00">15:00</option>
                    <option value="16:00">16:00</option>
                    <option value="18:00">18:00</option>
                    <option value="19:00">19:00</option>
                </select>
            </div>

            <div class="form-group">
                <label for="booking-topic"><?php echo hdgavi_tri( 'Subject', 'Sujet', 'Tema' ); ?></label>
                <textarea id="booking-topic" name="message" rows="3"></textarea>
            </div>

            <button type="submit" class="btn btn-submit"><?php echo hdgavi_tri( 'Send the request', 'Envoyer la demande', 'Enviar la solicitud' ); ?></button>

            <div class="form-feedback" id="bookingFeedback" aria-live="polite" role="status"></div>
        </form>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
