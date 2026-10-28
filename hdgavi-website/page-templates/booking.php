<?php
/**
 * Template Name: Booking / Prise de RDV
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$calendly_url = hdgavi_opt( 'booking_calendly_url', '' );
?>

<section class="page-section">
    <div class="container">
        <div class="section-header fade-up" style="text-align:center;max-width:640px;margin:0 auto 48px">
            <div class="section-label" style="justify-content:center">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_booking_section_en', 'Book a Meeting' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_booking_section_fr', 'Prise de rendez-vous' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_booking_section_es', 'Reservar una cita' ) ); ?></span>
            </div>
            <h1 class="section-title">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_booking_title_en', 'Schedule a Call' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_booking_title_fr', 'Planifier un appel' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_booking_title_es', 'Programar una llamada' ) ); ?></span>
            </h1>
            <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
            <p class="section-desc" style="text-align:center">
                <span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_booking_desc_en', 'Pick a time slot that works for you. I\'ll confirm within 24 hours.' ) ); ?></span>
                <span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_booking_desc_fr', 'Choisissez un créneau qui vous convient. Je confirme sous 24h.' ) ); ?></span>
                <span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_booking_desc_es', 'Elija un horario que le convenga. Confirmo en 24 horas.' ) ); ?></span>
            </p>
            <?php endif; ?>
        </div>

        <?php if ( ! empty( $calendly_url ) ) : ?>
        <!-- Calendly embed -->
        <div class="booking-embed fade-up">
            <div class="calendly-inline-widget" data-url="<?php echo esc_url( $calendly_url ); ?>" style="min-width:320px;height:700px"></div>
            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
        </div>
        <?php else : ?>
        <!-- Fallback: manual booking form -->
        <div class="booking-form-wrap fade-up" style="max-width:640px;margin:0 auto">
            <div class="booking-slots">
                <h3 style="margin-bottom:16px">
                    <span data-lang="en">Available time slots</span>
                    <span data-lang="fr">Créneaux disponibles</span>
                    <span data-lang="es">Horarios disponibles</span>
                </h3>
                <div class="booking-slot-grid">
                    <?php
                    $slots = array(
                        array( 'day_en' => 'Monday — Friday', 'day_fr' => 'Lundi — Vendredi', 'day_es' => 'Lunes — Viernes', 'time' => '18:00 — 20:00 CET' ),
                        array( 'day_en' => 'Saturday', 'day_fr' => 'Samedi', 'day_es' => 'Sábado', 'time' => '10:00 — 17:00 CET' ),
                    );
                    foreach ( $slots as $slot ) : ?>
                    <div class="booking-slot-card">
                        <div class="booking-slot-day">
                            <span data-lang="en"><?php echo esc_html( $slot['day_en'] ); ?></span>
                            <span data-lang="fr"><?php echo esc_html( $slot['day_fr'] ); ?></span>
                            <span data-lang="es"><?php echo esc_html( $slot['day_es'] ); ?></span>
                        </div>
                        <div class="booking-slot-time"><?php echo esc_html( $slot['time'] ); ?></div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <?php $web3key = hdgavi_opt( 'web3forms_key', '' ); ?>
            <form class="contact-form" id="bookingForm" <?php if ( ! empty( $web3key ) ) : ?>action="https://api.web3forms.com/submit" method="POST"<?php endif; ?>>
                <?php if ( ! empty( $web3key ) ) : ?>
                <input type="hidden" name="access_key" value="<?php echo esc_attr( $web3key ); ?>">
                <?php endif; ?>
                <input type="hidden" name="subject" value="Booking Request — <?php echo esc_attr( hdgavi_opt( 'general_name', '' ) ); ?>">
                <input type="checkbox" name="botcheck" class="sr-only" style="display:none" tabindex="-1" autocomplete="off">

                <div class="form-group">
                    <label for="booking-name">
                        <span data-lang="en">Your name</span>
                        <span data-lang="fr">Votre nom</span>
                        <span data-lang="es">Su nombre</span>
                    </label>
                    <input type="text" id="booking-name" name="name" required autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="booking-email">
                        <span data-lang="en">Your email</span>
                        <span data-lang="fr">Votre email</span>
                        <span data-lang="es">Su email</span>
                    </label>
                    <input type="email" id="booking-email" name="email" required autocomplete="email">
                </div>

                <div class="form-group">
                    <label for="booking-date">
                        <span data-lang="en">Preferred date</span>
                        <span data-lang="fr">Date souhaitée</span>
                        <span data-lang="es">Fecha preferida</span>
                    </label>
                    <input type="date" id="booking-date" name="date" required min="<?php echo esc_attr( wp_date( 'Y-m-d', strtotime( '+1 day' ) ) ); ?>">
                </div>

                <div class="form-group">
                    <label for="booking-time">
                        <span data-lang="en">Preferred time</span>
                        <span data-lang="fr">Heure souhaitée</span>
                        <span data-lang="es">Hora preferida</span>
                    </label>
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
                    <label for="booking-topic">
                        <span data-lang="en">Topic / Reason</span>
                        <span data-lang="fr">Sujet / Motif</span>
                        <span data-lang="es">Tema / Motivo</span>
                    </label>
                    <textarea id="booking-topic" name="message" rows="3"></textarea>
                </div>

                <button type="submit" class="btn-submit">
                    <?php echo hdgavi_icon( 'calendar', 16 ); ?>
                    <span data-lang="en">Request booking</span>
                    <span data-lang="fr">Demander un créneau</span>
                    <span data-lang="es">Solicitar reserva</span>
                </button>

                <div class="form-feedback" id="bookingFeedback" aria-live="polite" role="status"></div>
            </form>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
