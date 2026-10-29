<?php
/**
 * Template Name: Stack Technique / Tech Stack
 * Technologies grouped by area (CPT hdgavi_skill), as plain text: no levels, no bars.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;
get_header();

$skills = hdgavi_get_cpt_posts( 'hdgavi_skill' );
if ( $skills ) update_postmeta_cache( wp_list_pluck( $skills, 'ID' ) );

// Group by category, keeping the order of first appearance (menu_order).
$categories = array();
foreach ( $skills as $skill ) {
    $cat = hdgavi_meta_tri( $skill->ID, '_skill_category' );
    $key = '' !== $cat['en'] ? $cat['en'] : 'Other';
    if ( ! isset( $categories[ $key ] ) ) {
        $categories[ $key ] = array(
            'label' => '' !== $cat['en'] ? $cat : array( 'en' => 'Other', 'fr' => 'Autres', 'es' => 'Otros' ),
            'items' => array(),
        );
    }
    $name = get_post_meta( $skill->ID, '_skill_name', true );
    $categories[ $key ]['items'][] = array(
        'name'  => $name ? $name : get_the_title( $skill ),
        'years' => trim( (string) get_post_meta( $skill->ID, '_skill_years', true ) ),
    );
}
?>
<section class="sec wrap sec--first" aria-labelledby="t-stack">
    <h1 class="sec-title" id="t-stack"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_stack_title', 'Tech stack', 'Stack technique', 'Stack técnico' ) ); ?></h1>
    <div class="sec-body">
        <?php if ( hdgavi_opt( 'show_page_descriptions', true ) ) : ?>
        <p class="sec-lead"><?php echo hdgavi_tri_arr( hdgavi_opt_tri( 'label_stack_desc', 'The technologies on my CV, by area.', 'Les technologies de mon CV, par domaine.', 'Las tecnologías de mi CV, por ámbito.' ) ); ?></p>
        <?php endif; ?>

        <?php if ( $categories ) : ?>
        <dl class="skills">
            <?php foreach ( $categories as $cat ) : ?>
            <div class="entry">
                <dt><?php echo hdgavi_tri_arr( $cat['label'] ); ?></dt>
                <dd>
                    <ul class="stack stack--inline">
                        <?php foreach ( $cat['items'] as $item ) :
                            $years = $item['years'];
                            $one   = ( '1' === $years );
                        ?>
                        <li><?php echo esc_html( $item['name'] ); ?><?php if ( '' !== $years ) : ?> <span class="muted">(<?php echo hdgavi_tri( $years . ( $one ? ' year' : ' years' ), $years . ( $one ? ' an' : ' ans' ), $years . ( $one ? ' año' : ' años' ) ); ?>)</span><?php endif; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </dd>
            </div>
            <?php endforeach; ?>
        </dl>
        <?php else : ?>
        <p class="sec-lead empty-note"><?php echo hdgavi_tri( 'Nothing listed yet.', 'Rien pour le moment.', 'Nada por el momento.' ); ?></p>
        <?php endif; ?>
    </div>
</section>
<?php get_footer(); ?>
