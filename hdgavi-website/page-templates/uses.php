<?php
/**
 * Template Name: Uses / Mon Setup
 * Tools from the Customizer (uses_cat_N_*). Item syntax: "Tool | Description | URL" per line.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$groups = array();
for ( $cat = 1; $cat <= 8; $cat++ ) {
    $cat_en = hdgavi_opt( "uses_cat_{$cat}_en", '' );
    $items  = hdgavi_opt( "uses_cat_{$cat}_items", '' );
    if ( empty( $cat_en ) || empty( $items ) ) continue;
    $tools = array();
    foreach ( array_filter( array_map( 'trim', explode( "\n", $items ) ) ) as $line ) {
        $parts   = array_map( 'trim', explode( '|', $line ) );
        $tools[] = array(
            'name' => $parts[0],
            'desc' => isset( $parts[1] ) ? $parts[1] : '',
            'url'  => isset( $parts[2] ) ? $parts[2] : '',
        );
    }
    $groups[] = array(
        'label' => array(
            'en' => $cat_en,
            'fr' => hdgavi_opt( "uses_cat_{$cat}_fr", $cat_en ),
            'es' => hdgavi_opt( "uses_cat_{$cat}_es", $cat_en ),
        ),
        'tools' => $tools,
    );
}
?>
<section class="sec wrap sec--first" aria-labelledby="t-uses">
    <h1 class="sec-title" id="t-uses"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_uses_title', 'What I use', 'Ce que j’utilise', 'Lo que uso' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_uses_desc', 'Software and tools I work with.', 'Les logiciels et outils avec lesquels je travaille.', 'El software y las herramientas con los que trabajo.' ) ); ?></p>
        <?php endif; ?>

        <?php foreach ( $groups as $group ) : ?>
        <div class="entry">
            <h2 class="entry-label"><?php echo hdgavi_tri_arr( $group['label'] ); ?></h2>
            <ul class="uses-list">
                <?php foreach ( $group['tools'] as $tool ) : ?>
                <li>
                    <span class="uses-item-name"><?php if ( $tool['url'] ) : ?><a href="<?php echo esc_url( $tool['url'] ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $tool['name'] ); ?></a><?php else : ?><?php echo esc_html( $tool['name'] ); ?><?php endif; ?></span><?php if ( $tool['desc'] ) : ?><span class="uses-item-desc"> — <?php echo esc_html( $tool['desc'] ); ?></span><?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>

        <?php if ( ! $groups ) : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri( 'No tool listed yet.', 'Aucun outil pour le moment.', 'Ninguna herramienta por el momento.' ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
