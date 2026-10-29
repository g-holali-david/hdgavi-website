<?php
/**
 * HD GAVI Portfolio — Customizer: interface labels of the secondary pages
 *
 * 7.0.0: the CV pages (home, about, experience, projects, skills, education, contact,
 * availability) and the footer take their labels from hdgavi_cv_label() in inc/cv-content.php,
 * so their old label settings were removed, as were the proficiency-level labels of the stack
 * page. What remains is read by search.php, archive.php, 404.php, single.php and the secondary
 * page templates.
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_customizer_labels( $wp_customize ) {
    $panel = 'hdgavi_panel';

    $wp_customize->add_section( 'hdgavi_labels', array(
        'title'       => __( 'Libellés des pages secondaires', 'hdgavi-portfolio' ),
        'panel'       => $panel,
        'priority'    => 170,
        'description' => __( 'Titres, descriptions et boutons des pages secondaires : recherche, 404, certifications, frise, stack, veille, blog, témoignages, newsletter, uses, roadmap, présentation, mentions légales.', 'hdgavi-portfolio' ),
    ) );

    $labels = array(
        // Search page
        'label_search_title_en'    => array( 'Search — Title EN', 'Search results for:' ),
        'label_search_title_fr'    => array( 'Search — Title FR', 'Résultats pour :' ),
        'label_search_title_es'    => array( 'Search — Title ES', 'Resultados para:' ),
        'label_search_empty_en'    => array( 'Search — No result EN', 'No results found.' ),
        'label_search_empty_fr'    => array( 'Search — No result FR', 'Aucun résultat.' ),
        'label_search_empty_es'    => array( 'Search — No result ES', 'No se encontraron resultados.' ),

        // Archive page
        'label_archive_empty_en'   => array( 'Archive — No post EN', 'No posts found.' ),
        'label_archive_empty_fr'   => array( 'Archive — No post FR', 'Aucun article trouvé.' ),
        'label_archive_empty_es'   => array( 'Archive — No post ES', 'No se encontraron artículos.' ),

        // 404 page
        'label_404_text_en'        => array( '404 — Text EN', 'This page does not exist or has been moved.' ),
        'label_404_text_fr'        => array( '404 — Text FR', 'Cette page n’existe pas ou a été déplacée.' ),
        'label_404_text_es'        => array( '404 — Text ES', 'Esta página no existe o ha sido movida.' ),
        'label_404_btn_en'         => array( '404 — Button EN', 'Back to the home page' ),
        'label_404_btn_fr'         => array( '404 — Button FR', 'Retour à l’accueil' ),
        'label_404_btn_es'         => array( '404 — Button ES', 'Volver al inicio' ),

        // Certifications page — filter buttons
        'label_certs_filter_all_en'       => array( 'Certifications — Filter All EN', 'All' ),
        'label_certs_filter_all_fr'       => array( 'Certifications — Filter All FR', 'Toutes' ),
        'label_certs_filter_all_es'       => array( 'Certifications — Filter All ES', 'Todas' ),
        'label_certs_filter_obtained_en'  => array( 'Certifications — Filter Obtained EN', 'Obtained' ),
        'label_certs_filter_obtained_fr'  => array( 'Certifications — Filter Obtained FR', 'Obtenues' ),
        'label_certs_filter_obtained_es'  => array( 'Certifications — Filter Obtained ES', 'Obtenidas' ),
        'label_certs_filter_progress_en'  => array( 'Certifications — Filter In progress EN', 'In progress' ),
        'label_certs_filter_progress_fr'  => array( 'Certifications — Filter In progress FR', 'En cours' ),
        'label_certs_filter_progress_es'  => array( 'Certifications — Filter In progress ES', 'En curso' ),
        'label_certs_filter_planned_en'   => array( 'Certifications — Filter Planned EN', 'Planned' ),
        'label_certs_filter_planned_fr'   => array( 'Certifications — Filter Planned FR', 'Objectifs' ),
        'label_certs_filter_planned_es'   => array( 'Certifications — Filter Planned ES', 'Objetivos' ),
        // Certifications page — status labels
        'label_certs_status_obtained_en'  => array( 'Certifications — Status Obtained EN', 'Obtained' ),
        'label_certs_status_obtained_fr'  => array( 'Certifications — Status Obtained FR', 'Obtenue' ),
        'label_certs_status_obtained_es'  => array( 'Certifications — Status Obtained ES', 'Obtenida' ),
        'label_certs_status_progress_en'  => array( 'Certifications — Status In progress EN', 'In progress' ),
        'label_certs_status_progress_fr'  => array( 'Certifications — Status In progress FR', 'En cours' ),
        'label_certs_status_progress_es'  => array( 'Certifications — Status In progress ES', 'En curso' ),
        'label_certs_status_planned_en'   => array( 'Certifications — Status Planned EN', 'Planned' ),
        'label_certs_status_planned_fr'   => array( 'Certifications — Status Planned FR', 'Objectif' ),
        'label_certs_status_planned_es'   => array( 'Certifications — Status Planned ES', 'Objetivo' ),
        // Certifications page — headings
        'label_certs_title_en'            => array( 'Certifications — Title EN', 'Certifications' ),
        'label_certs_title_fr'            => array( 'Certifications — Title FR', 'Certifications' ),
        'label_certs_title_es'            => array( 'Certifications — Title ES', 'Certificaciones' ),
        'label_certs_desc_en'             => array( 'Certifications — Description EN', 'Certifications obtained, in progress or planned.' ),
        'label_certs_desc_fr'             => array( 'Certifications — Description FR', 'Certifications obtenues, en cours ou prévues.' ),
        'label_certs_desc_es'             => array( 'Certifications — Description ES', 'Certificaciones obtenidas, en curso o previstas.' ),
        'label_certs_empty_en'            => array( 'Certifications — Empty EN', 'No certification listed yet.' ),
        'label_certs_empty_fr'            => array( 'Certifications — Empty FR', 'Aucune certification pour le moment.' ),
        'label_certs_empty_es'            => array( 'Certifications — Empty ES', 'Ninguna certificación por el momento.' ),
        'label_certs_verify_en'           => array( 'Certifications — Verify EN', 'Verify' ),
        'label_certs_verify_fr'           => array( 'Certifications — Verify FR', 'Vérifier' ),
        'label_certs_verify_es'           => array( 'Certifications — Verify ES', 'Verificar' ),

        // Timeline page — filter buttons
        'label_tl_filter_all_en'          => array( 'Timeline — Filter All EN', 'All' ),
        'label_tl_filter_all_fr'          => array( 'Timeline — Filter All FR', 'Tous' ),
        'label_tl_filter_all_es'          => array( 'Timeline — Filter All ES', 'Todos' ),
        'label_tl_filter_work_en'         => array( 'Timeline — Filter Work EN', 'Work' ),
        'label_tl_filter_work_fr'         => array( 'Timeline — Filter Work FR', 'Emploi' ),
        'label_tl_filter_work_es'         => array( 'Timeline — Filter Work ES', 'Empleo' ),
        'label_tl_filter_education_en'    => array( 'Timeline — Filter Education EN', 'Education' ),
        'label_tl_filter_education_fr'    => array( 'Timeline — Filter Education FR', 'Formation' ),
        'label_tl_filter_education_es'    => array( 'Timeline — Filter Education ES', 'Formación' ),
        'label_tl_filter_cert_en'         => array( 'Timeline — Filter Certifications EN', 'Certifications' ),
        'label_tl_filter_cert_fr'         => array( 'Timeline — Filter Certifications FR', 'Certifications' ),
        'label_tl_filter_cert_es'         => array( 'Timeline — Filter Certifications ES', 'Certificaciones' ),
        'label_tl_filter_project_en'      => array( 'Timeline — Filter Projects EN', 'Projects' ),
        'label_tl_filter_project_fr'      => array( 'Timeline — Filter Projects FR', 'Projets' ),
        'label_tl_filter_project_es'      => array( 'Timeline — Filter Projects ES', 'Proyectos' ),
        // Timeline page — type labels
        'label_tl_type_work_en'           => array( 'Timeline — Type Work EN', 'Work' ),
        'label_tl_type_work_fr'           => array( 'Timeline — Type Work FR', 'Emploi' ),
        'label_tl_type_work_es'           => array( 'Timeline — Type Work ES', 'Empleo' ),
        'label_tl_type_education_en'      => array( 'Timeline — Type Education EN', 'Education' ),
        'label_tl_type_education_fr'      => array( 'Timeline — Type Education FR', 'Formation' ),
        'label_tl_type_education_es'      => array( 'Timeline — Type Education ES', 'Formación' ),
        'label_tl_type_cert_en'           => array( 'Timeline — Type Certification EN', 'Certification' ),
        'label_tl_type_cert_fr'           => array( 'Timeline — Type Certification FR', 'Certification' ),
        'label_tl_type_cert_es'           => array( 'Timeline — Type Certification ES', 'Certificación' ),
        'label_tl_type_project_en'        => array( 'Timeline — Type Project EN', 'Project' ),
        'label_tl_type_project_fr'        => array( 'Timeline — Type Project FR', 'Projet' ),
        'label_tl_type_project_es'        => array( 'Timeline — Type Project ES', 'Proyecto' ),
        // Timeline page — headings
        'label_timeline_title_en'         => array( 'Timeline — Title EN', 'Timeline' ),
        'label_timeline_title_fr'         => array( 'Timeline — Title FR', 'Parcours' ),
        'label_timeline_title_es'         => array( 'Timeline — Title ES', 'Trayectoria' ),
        'label_timeline_desc_en'          => array( 'Timeline — Description EN', 'Experience and education, year by year.' ),
        'label_timeline_desc_fr'          => array( 'Timeline — Description FR', 'Expériences et formations, année par année.' ),
        'label_timeline_desc_es'          => array( 'Timeline — Description ES', 'Experiencia y formación, año por año.' ),

        // Stack page — headings
        'label_stack_title_en'            => array( 'Stack — Title EN', 'Tech stack' ),
        'label_stack_title_fr'            => array( 'Stack — Title FR', 'Stack technique' ),
        'label_stack_title_es'            => array( 'Stack — Title ES', 'Stack técnico' ),
        'label_stack_desc_en'             => array( 'Stack — Description EN', 'The technologies on my CV, by area.' ),
        'label_stack_desc_fr'             => array( 'Stack — Description FR', 'Les technologies de mon CV, par domaine.' ),
        'label_stack_desc_es'             => array( 'Stack — Description ES', 'Las tecnologías de mi CV, por ámbito.' ),

        // Tech watch page
        'label_watch_filter_all_en'       => array( 'Tech watch — Filter All EN', 'All' ),
        'label_watch_filter_all_fr'       => array( 'Tech watch — Filter All FR', 'Tous' ),
        'label_watch_filter_all_es'       => array( 'Tech watch — Filter All ES', 'Todos' ),
        'label_watch_title_en'            => array( 'Tech watch — Title EN', 'Tech watch' ),
        'label_watch_title_fr'            => array( 'Tech watch — Title FR', 'Veille technologique' ),
        'label_watch_title_es'            => array( 'Tech watch — Title ES', 'Vigilancia tecnológica' ),
        'label_watch_desc_en'             => array( 'Tech watch — Description EN', 'Articles and notes on cloud and cybersecurity.' ),
        'label_watch_desc_fr'             => array( 'Tech watch — Description FR', 'Articles et notes de veille sur le cloud et la cybersécurité.' ),
        'label_watch_desc_es'             => array( 'Tech watch — Description ES', 'Artículos y notas sobre cloud y ciberseguridad.' ),
        'label_watch_search_en'           => array( 'Tech watch — Search placeholder EN', 'Search articles' ),
        'label_watch_search_fr'           => array( 'Tech watch — Search placeholder FR', 'Rechercher un article' ),
        'label_watch_search_es'           => array( 'Tech watch — Search placeholder ES', 'Buscar un artículo' ),
        'label_watch_empty_en'            => array( 'Tech watch — Empty EN', 'No article yet.' ),
        'label_watch_empty_fr'            => array( 'Tech watch — Empty FR', 'Aucun article pour le moment.' ),
        'label_watch_empty_es'            => array( 'Tech watch — Empty ES', 'Todavía no hay artículos.' ),

        // Blog page
        'label_blog_title_en'             => array( 'Blog — Title EN', 'Blog' ),
        'label_blog_title_fr'             => array( 'Blog — Title FR', 'Blog' ),
        'label_blog_title_es'             => array( 'Blog — Title ES', 'Blog' ),
        'label_blog_desc_en'              => array( 'Blog — Description EN', 'Articles on cloud-native architecture, DevOps and security.' ),
        'label_blog_desc_fr'              => array( 'Blog — Description FR', 'Articles sur l’architecture cloud-native, le DevOps et la sécurité.' ),
        'label_blog_desc_es'              => array( 'Blog — Description ES', 'Artículos sobre arquitectura cloud-native, DevOps y seguridad.' ),
        'label_blog_empty_en'             => array( 'Blog — Empty EN', 'No article yet.' ),
        'label_blog_empty_fr'             => array( 'Blog — Empty FR', 'Aucun article pour le moment.' ),
        'label_blog_empty_es'             => array( 'Blog — Empty ES', 'Todavía no hay artículos.' ),

        // Testimonials page
        'label_testi_title_en'            => array( 'Testimonials — Title EN', 'Testimonials' ),
        'label_testi_title_fr'            => array( 'Testimonials — Title FR', 'Témoignages' ),
        'label_testi_title_es'            => array( 'Testimonials — Title ES', 'Testimonios' ),
        'label_testi_desc_en'             => array( 'Testimonials — Description EN', 'Feedback from people I have worked with.' ),
        'label_testi_desc_fr'             => array( 'Testimonials — Description FR', 'Retours de personnes avec qui j’ai travaillé.' ),
        'label_testi_desc_es'             => array( 'Testimonials — Description ES', 'Comentarios de personas con las que he trabajado.' ),
        'label_testi_empty_en'            => array( 'Testimonials — Empty EN', 'No testimonial published yet.' ),
        'label_testi_empty_fr'            => array( 'Testimonials — Empty FR', 'Aucun témoignage publié pour le moment.' ),
        'label_testi_empty_es'            => array( 'Testimonials — Empty ES', 'Ningún testimonio publicado por el momento.' ),

        // Newsletter page
        'label_nl_title_en'               => array( 'Newsletter — Title EN', 'Newsletter' ),
        'label_nl_title_fr'               => array( 'Newsletter — Title FR', 'Newsletter' ),
        'label_nl_title_es'               => array( 'Newsletter — Title ES', 'Boletín' ),
        'label_nl_desc_en'                => array( 'Newsletter — Description EN', 'New tech watch articles (cloud and cybersecurity) by e-mail.' ),
        'label_nl_desc_fr'                => array( 'Newsletter — Description FR', 'Les nouveaux articles de veille (cloud et cybersécurité) par e-mail.' ),
        'label_nl_desc_es'                => array( 'Newsletter — Description ES', 'Los nuevos artículos de vigilancia (cloud y ciberseguridad) por correo.' ),
        'label_nl_btn_en'                 => array( 'Newsletter — Button EN', 'Subscribe' ),
        'label_nl_btn_fr'                 => array( 'Newsletter — Button FR', 'S’abonner' ),
        'label_nl_btn_es'                 => array( 'Newsletter — Button ES', 'Suscribirse' ),
        'label_nl_placeholder_en'         => array( 'Newsletter — Placeholder EN', 'your@email.com' ),
        'label_nl_placeholder_fr'         => array( 'Newsletter — Placeholder FR', 'votre@email.com' ),
        'label_nl_placeholder_es'         => array( 'Newsletter — Placeholder ES', 'tu@email.com' ),
        'label_nl_preview_en'             => array( 'Newsletter — Preview EN', 'Latest from the tech watch' ),
        'label_nl_preview_fr'             => array( 'Newsletter — Preview FR', 'Derniers articles de la veille' ),
        'label_nl_preview_es'             => array( 'Newsletter — Preview ES', 'Lo último de la vigilancia' ),

        // Uses page
        'label_uses_title_en'             => array( 'Uses — Title EN', 'What I use' ),
        'label_uses_title_fr'             => array( 'Uses — Title FR', 'Ce que j’utilise' ),
        'label_uses_title_es'             => array( 'Uses — Title ES', 'Lo que uso' ),
        'label_uses_desc_en'              => array( 'Uses — Description EN', 'Software and tools I work with.' ),
        'label_uses_desc_fr'              => array( 'Uses — Description FR', 'Les logiciels et outils avec lesquels je travaille.' ),
        'label_uses_desc_es'              => array( 'Uses — Description ES', 'El software y las herramientas con los que trabajo.' ),

        // Roadmap page
        'label_roadmap_title_en'          => array( 'Roadmap — Title EN', 'Goals' ),
        'label_roadmap_title_fr'          => array( 'Roadmap — Title FR', 'Objectifs' ),
        'label_roadmap_title_es'          => array( 'Roadmap — Title ES', 'Objetivos' ),
        'label_roadmap_desc_en'           => array( 'Roadmap — Description EN', 'Degree, career and certification goals.' ),
        'label_roadmap_desc_fr'           => array( 'Roadmap — Description FR', 'Objectifs de formation, de carrière et de certification.' ),
        'label_roadmap_desc_es'           => array( 'Roadmap — Description ES', 'Objetivos de formación, carrera y certificación.' ),

        // Presentation page
        'label_pres_keynums_en'           => array( 'Presentation — Figures EN', 'In short' ),
        'label_pres_keynums_fr'           => array( 'Presentation — Figures FR', 'En bref' ),
        'label_pres_keynums_es'           => array( 'Presentation — Figures ES', 'En resumen' ),
        'label_pres_skills_en'            => array( 'Presentation — Skills EN', 'Skills' ),
        'label_pres_skills_fr'            => array( 'Presentation — Skills FR', 'Compétences' ),
        'label_pres_skills_es'            => array( 'Presentation — Skills ES', 'Competencias' ),
        'label_pres_connect_en'           => array( 'Presentation — Contact EN', 'Contact' ),
        'label_pres_connect_fr'           => array( 'Presentation — Contact FR', 'Contact' ),
        'label_pres_connect_es'           => array( 'Presentation — Contact ES', 'Contacto' ),
        'label_pres_exit_en'              => array( 'Presentation — Exit EN', 'Exit' ),
        'label_pres_exit_fr'              => array( 'Presentation — Exit FR', 'Quitter' ),
        'label_pres_exit_es'              => array( 'Presentation — Exit ES', 'Salir' ),

        // Single post — share
        'label_share_en'                  => array( 'Single post — Share EN', 'Share:' ),
        'label_share_fr'                  => array( 'Single post — Share FR', 'Partager :' ),
        'label_share_es'                  => array( 'Single post — Share ES', 'Compartir:' ),

        // Legal page
        'label_legal_notice_en'           => array( 'Legal — Legal notice EN', 'Legal notice' ),
        'label_legal_notice_fr'           => array( 'Legal — Legal notice FR', 'Mentions légales' ),
        'label_legal_notice_es'           => array( 'Legal — Legal notice ES', 'Aviso legal' ),
        'label_legal_publisher_en'        => array( 'Legal — Publisher EN', 'Site publisher' ),
        'label_legal_publisher_fr'        => array( 'Legal — Publisher FR', 'Éditeur du site' ),
        'label_legal_publisher_es'        => array( 'Legal — Publisher ES', 'Editor del sitio' ),
        'label_legal_email_en'            => array( 'Legal — E-mail EN', 'E-mail:' ),
        'label_legal_email_fr'            => array( 'Legal — E-mail FR', 'E-mail :' ),
        'label_legal_email_es'            => array( 'Legal — E-mail ES', 'Correo:' ),
        'label_legal_hosting_en'          => array( 'Legal — Hosting EN', 'Hosting' ),
        'label_legal_hosting_fr'          => array( 'Legal — Hosting FR', 'Hébergement' ),
        'label_legal_hosting_es'          => array( 'Legal — Hosting ES', 'Alojamiento' ),
        'label_legal_ip_heading_en'       => array( 'Legal — Intellectual property EN', 'Intellectual property' ),
        'label_legal_ip_heading_fr'       => array( 'Legal — Intellectual property FR', 'Propriété intellectuelle' ),
        'label_legal_ip_heading_es'       => array( 'Legal — Intellectual property ES', 'Propiedad intelectual' ),
        'label_legal_privacy_en'          => array( 'Legal — Privacy policy EN', 'Privacy policy' ),
        'label_legal_privacy_fr'          => array( 'Legal — Privacy policy FR', 'Politique de confidentialité' ),
        'label_legal_privacy_es'          => array( 'Legal — Privacy policy ES', 'Política de privacidad' ),
        'label_legal_data_en'             => array( 'Legal — Data collected EN', 'Data collected' ),
        'label_legal_data_fr'             => array( 'Legal — Data collected FR', 'Données collectées' ),
        'label_legal_data_es'             => array( 'Legal — Data collected ES', 'Datos recopilados' ),
        'label_legal_analytics_en'        => array( 'Legal — Analytics EN', 'Anonymous statistics' ),
        'label_legal_analytics_fr'        => array( 'Legal — Analytics FR', 'Statistiques anonymes' ),
        'label_legal_analytics_es'        => array( 'Legal — Analytics ES', 'Estadísticas anónimas' ),
        'label_legal_rights_en'           => array( 'Legal — Your rights EN', 'Your rights' ),
        'label_legal_rights_fr'           => array( 'Legal — Your rights FR', 'Vos droits' ),
        'label_legal_rights_es'           => array( 'Legal — Your rights ES', 'Sus derechos' ),
        'label_legal_updated_en'          => array( 'Legal — Last updated EN', 'Last updated:' ),
        'label_legal_updated_fr'          => array( 'Legal — Last updated FR', 'Dernière mise à jour :' ),
        'label_legal_updated_es'          => array( 'Legal — Last updated ES', 'Última actualización:' ),
        'legal_cookies_title_en'          => array( 'Legal — Cookies title EN', 'Cookies' ),
        'legal_cookies_title_fr'          => array( 'Legal — Cookies title FR', 'Cookies' ),
        'legal_cookies_title_es'          => array( 'Legal — Cookies title ES', 'Cookies' ),
    );

    foreach ( $labels as $key => $meta ) {
        $wp_customize->add_setting( $key, array( 'default' => $meta[1], 'sanitize_callback' => 'sanitize_text_field' ) );
        $wp_customize->add_control( $key, array(
            'label'   => $meta[0],
            'section' => 'hdgavi_labels',
        ) );
    }
}
add_action( 'customize_register', 'hdgavi_customizer_labels' );
