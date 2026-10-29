<?php
/**
 * HD GAVI Portfolio — CV content (single source of truth)
 *
 * Everything here comes from the October 2026 CV (CV_Holali_David_GAVI.pdf) and, for the
 * project descriptions, from the README of the matching public GitHub repositories.
 * Templates use these values as defaults; the demo importer seeds the database from them.
 *
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Translated texts. Each entry: array( 'en' => , 'fr' => , 'es' => ).
 * A Customizer value "cv_<key>_<lang>" overrides the default when it is set.
 */
function hdgavi_cv_texts() {
    return array(
        'role' => array(
            'en' => 'DevOps / Cloud Native Engineer',
            'fr' => 'Ingénieur DevOps / Cloud Native',
            'es' => 'Ingeniero DevOps / Cloud Native',
        ),
        'lead' => array(
            'en' => 'DevOps engineer on a work-study contract at Dassault Systèmes since November 2024, I contribute to industrialising the 3DEXPERIENCE platform: containerisation, Kubernetes orchestration, automation of validation processes and security of containerised environments.',
            'fr' => 'Ingénieur DevOps en alternance chez Dassault Systèmes depuis novembre 2024, je contribue à l’industrialisation de la plateforme 3DEXPERIENCE à travers la conteneurisation, l’orchestration Kubernetes, l’automatisation des processus de validation et la sécurisation des environnements conteneurisés.',
            'es' => 'Ingeniero DevOps en alternancia en Dassault Systèmes desde noviembre de 2024, contribuyo a la industrialización de la plataforma 3DEXPERIENCE mediante la contenedorización, la orquestación con Kubernetes, la automatización de los procesos de validación y la securización de los entornos contenedorizados.',
        ),
        'goal' => array(
            'en' => 'I would like to continue at Dassault Systèmes on a permanent contract (CDI), on Cloud, DevOps, Platform Engineering or SRE projects.',
            'fr' => 'Je souhaite poursuivre mon évolution en CDI au sein de Dassault Systèmes, sur des projets Cloud, DevOps, Platform Engineering ou SRE.',
            'es' => 'Deseo continuar mi evolución con un contrato indefinido (CDI) en Dassault Systèmes, en proyectos Cloud, DevOps, Platform Engineering o SRE.',
        ),
        'fact_search' => array(
            'en' => 'A permanent contract (CDI) at Dassault Systèmes, on Cloud, DevOps, Platform Engineering or SRE projects',
            'fr' => 'Un CDI au sein de Dassault Systèmes, sur des projets Cloud, DevOps, Platform Engineering ou SRE',
            'es' => 'Un contrato indefinido (CDI) en Dassault Systèmes, en proyectos Cloud, DevOps, Platform Engineering o SRE',
        ),
        'fact_role' => array(
            'en' => 'DevOps / Cloud Native Engineer (work-study), Dassault Systèmes, since November 2024',
            'fr' => 'Ingénieur DevOps / Cloud Native (alternance), Dassault Systèmes, depuis novembre 2024',
            'es' => 'Ingeniero DevOps / Cloud Native (alternancia), Dassault Systèmes, desde noviembre de 2024',
        ),
        'fact_education' => array(
            'en' => 'Mastère in Cybersecurity & Cloud Computing, IPSSI, 2024 – 2026',
            'fr' => 'Mastère Cybersécurité & Cloud Computing, IPSSI, 2024 – 2026',
            'es' => 'Mastère en Ciberseguridad y Cloud Computing, IPSSI, 2024 – 2026',
        ),
        'fact_languages' => array(
            'en' => 'French (fluent), English B2 (iCIMS 3DS English Test), working with the teams in the USA and India',
            'fr' => 'Français courant, anglais B2 (iCIMS 3DS English Test), collaboration avec les équipes USA et Inde',
            'es' => 'Francés (fluido), inglés B2 (iCIMS 3DS English Test), colaboración con los equipos de EE. UU. e India',
        ),
        'fact_languages_short' => array(
            'en' => 'French (fluent), English (B2)',
            'fr' => 'Français courant, anglais B2',
            'es' => 'Francés (fluido), inglés (B2)',
        ),
        'fact_interests' => array(
            'en' => 'Sport (weight training, running, football), keeping up with cloud and cybersecurity',
            'fr' => 'Sport (musculation, course à pied, football), veille technologique cloud et cybersécurité',
            'es' => 'Deporte (musculación, carrera a pie, fútbol), vigilancia tecnológica sobre cloud y ciberseguridad',
        ),
        'about' => array(
            'en' => '<p>I am a DevOps engineer on a work-study contract at Dassault Systèmes since November 2024. I work on industrialising the 3DEXPERIENCE platform: containerising its services on Red Hat UBI 8, deploying and orchestrating them on Kubernetes with Helm charts, auto-scaling and version upgrades, hardening the containers (non-root, securityContext) and automating validation tests with ODT Runner, a Java framework I developed. The validation workflows went from 9 steps to 3.</p><p>I also analyse production incidents with the teams in the USA and India, and I write the technical documentation for on-premises customers.</p><p>Alongside this work I am preparing the Mastère in Cybersecurity & Cloud Computing at IPSSI (2024 – 2026). At CNAM I followed a Master 1 in Information Systems & BI, a bachelor’s degree in computer science and a professional bachelor’s degree in Web, Mobile & BI (2024 – 2025), after the professional title “Technicien Supérieur Systèmes et Réseaux” (2023).</p><p>I would like to continue at Dassault Systèmes on a permanent contract, on Cloud, DevOps, Platform Engineering or SRE projects.</p>',
            'fr' => '<p>Je suis ingénieur DevOps en alternance chez Dassault Systèmes depuis novembre 2024. Je travaille sur l’industrialisation de la plateforme 3DEXPERIENCE : conteneurisation de ses services sous Red Hat UBI 8, déploiement et orchestration sur Kubernetes via Helm Charts, auto-scaling et montées de version, durcissement des conteneurs (non-root, securityContext) et automatisation des tests de validation avec ODT Runner, un framework Java que j’ai développé. Les workflows de validation sont passés de 9 à 3 étapes.</p><p>J’analyse aussi les incidents de production avec les équipes USA et Inde, et je rédige la documentation technique destinée aux clients On-Premises.</p><p>En parallèle, je prépare le Mastère Cybersécurité & Cloud Computing de l’IPSSI (2024 – 2026). Au CNAM, j’ai suivi un Master 1 Systèmes d’information & BI, une licence générale Informatique et une licence professionnelle Web, Mobile & BI (2024 – 2025), après le titre professionnel Technicien Supérieur Systèmes et Réseaux (2023).</p><p>Je souhaite poursuivre mon évolution en CDI au sein de Dassault Systèmes, sur des projets Cloud, DevOps, Platform Engineering ou SRE.</p>',
            'es' => '<p>Soy ingeniero DevOps en alternancia en Dassault Systèmes desde noviembre de 2024. Trabajo en la industrialización de la plataforma 3DEXPERIENCE: contenedorización de sus servicios con Red Hat UBI 8, despliegue y orquestación en Kubernetes mediante Helm Charts, auto-scaling y actualizaciones de versión, endurecimiento de los contenedores (non-root, securityContext) y automatización de las pruebas de validación con ODT Runner, un framework Java que desarrollé. Los flujos de validación pasaron de 9 a 3 pasos.</p><p>También analizo incidentes de producción con los equipos de EE. UU. e India, y redacto la documentación técnica para los clientes On-Premises.</p><p>Paralelamente preparo el Mastère en Ciberseguridad y Cloud Computing de IPSSI (2024 – 2026). En el CNAM cursé un Máster 1 en Sistemas de Información y BI, una licenciatura en Informática y una licenciatura profesional en Web, Móvil y BI (2024 – 2025), después del título profesional «Technicien Supérieur Systèmes et Réseaux» (2023).</p><p>Deseo continuar en Dassault Systèmes con un contrato indefinido, en proyectos Cloud, DevOps, Platform Engineering o SRE.</p>',
        ),
    );
}

/** Language-neutral location shown on the site (CV: 93300 Aubervilliers). */
function hdgavi_cv_location() {
    return hdgavi_opt( 'cv_location', 'Aubervilliers (93300), Île-de-France' );
}

/** One translated CV text, with Customizer override (cv_<key>_<lang>). */
function hdgavi_cv( $key ) {
    $texts = hdgavi_cv_texts();
    $d     = isset( $texts[ $key ] ) ? $texts[ $key ] : array( 'en' => '', 'fr' => '', 'es' => '' );
    return hdgavi_opt_tri( 'cv_' . $key, $d['en'], $d['fr'], $d['es'] );
}

/**
 * Interface labels (default values). Each one can be changed in Appearance → Customize →
 * "Libellés de l’interface" (setting label_cv_<key>_<lang>).
 */
function hdgavi_cv_label_defaults() {
    return array(
        // Section titles
        'about'          => array( 'About', 'À propos', 'Sobre mí' ),
        'experience'     => array( 'Experience', 'Expérience', 'Experiencia' ),
        'projects'       => array( 'Projects', 'Projets', 'Proyectos' ),
        'skills'         => array( 'Skills', 'Compétences', 'Competencias' ),
        'education'      => array( 'Education', 'Formation', 'Formación' ),
        'contact'        => array( 'Contact', 'Contact', 'Contacto' ),
        'availability'   => array( 'Availability', 'Disponibilité', 'Disponibilidad' ),
        // Facts (home, about, availability)
        'looking_for'    => array( 'Looking for', 'Recherche', 'Busco' ),
        'current'        => array( 'Current role', 'Poste actuel', 'Puesto actual' ),
        'location'       => array( 'Location', 'Lieu', 'Ubicación' ),
        'training'       => array( 'Education', 'Formation', 'Formación' ),
        'languages'      => array( 'Languages', 'Langues', 'Idiomas' ),
        'interests'      => array( 'Interests', 'Centres d’intérêt', 'Intereses' ),
        'status'         => array( 'Status', 'Information', 'Información' ),
        'rqth'           => array( 'RQTH (recognised disabled worker status)', 'RQTH', 'RQTH (reconocimiento de la condición de trabajador con discapacidad)' ),
        // Contact details and links
        'email'          => array( 'E-mail', 'E-mail', 'Correo' ),
        'phone'          => array( 'Phone', 'Téléphone', 'Teléfono' ),
        'cv'             => array( 'CV', 'CV', 'CV' ),
        'download_cv'    => array( 'Download the CV (PDF)', 'Télécharger le CV (PDF)', 'Descargar el CV (PDF)' ),
        'all_repos'      => array( 'All public repositories:', 'Tous les dépôts publics :', 'Todos los repositorios públicos:' ),
        // Contact form
        'write_me'       => array( 'Write to me', 'M’écrire', 'Escribirme' ),
        'form_name'      => array( 'Name', 'Nom', 'Nombre' ),
        'form_email'     => array( 'E-mail', 'E-mail', 'Correo electrónico' ),
        'form_message'   => array( 'Message', 'Message', 'Mensaje' ),
        'form_send'      => array( 'Send', 'Envoyer', 'Enviar' ),
        // Header
        'skip'           => array( 'Skip to content', 'Aller au contenu', 'Ir al contenido' ),
        'menu'           => array( 'Menu', 'Menu', 'Menú' ),
        'dark_mode'      => array( 'Dark mode', 'Mode sombre', 'Modo oscuro' ),
        // Footer links
        'footer_blog'         => array( 'Blog', 'Blog', 'Blog' ),
        'footer_watch'        => array( 'Tech watch', 'Veille', 'Vigilancia' ),
        'footer_timeline'     => array( 'Timeline', 'Parcours', 'Trayectoria' ),
        'footer_availability' => array( 'Availability', 'Disponibilité', 'Disponibilidad' ),
        'footer_legal'        => array( 'Legal notice', 'Mentions légales', 'Aviso legal' ),
    );
}

/** One interface label in the three languages (Customizer value first, then the default). */
function hdgavi_cv_label( $key ) {
    $defaults = hdgavi_cv_label_defaults();
    $d        = isset( $defaults[ $key ] ) ? $defaults[ $key ] : array( $key, $key, $key );
    return hdgavi_opt_tri( 'label_cv_' . $key, $d[0], $d[1], $d[2] );
}

/* ═══════════════════════════════════════
   DATASETS FOR THE CUSTOM POST TYPES
   (same shape as inc/demo-content.php items: title + meta)
   ═══════════════════════════════════════ */

function hdgavi_cv_experiences() {
    return array(
        array( 'title' => 'DevOps @ Dassault', 'meta' => array(
            '_exp_featured'   => '1',
            '_exp_title_en'   => 'DevOps / Cloud Native Engineer (work-study)',
            '_exp_title_fr'   => 'Ingénieur DevOps / Cloud Native (alternance)',
            '_exp_title_es'   => 'Ingeniero DevOps / Cloud Native (alternancia)',
            '_exp_company_en' => 'Dassault Systèmes', '_exp_company_fr' => 'Dassault Systèmes', '_exp_company_es' => 'Dassault Systèmes',
            '_exp_period_en'  => 'Nov 2024 – present',
            '_exp_period_fr'  => 'nov. 2024 – aujourd’hui',
            '_exp_period_es'  => 'nov. 2024 – actualidad',
            '_exp_location'   => 'Vélizy-Villacoublay',
            '_exp_desc_en'    => '', '_exp_desc_fr' => '', '_exp_desc_es' => '',
            '_exp_bullets_en' => "Containerised several services of the 3DEXPERIENCE platform on Red Hat UBI 8.\nDeployed and orchestrated these services on Kubernetes with Helm charts.\nStudied and implemented auto-scaling, updates and version upgrades of the 3DEXPERIENCE services on Kubernetes.\nHardened Kubernetes containers following the principle of least privilege (non-root, securityContext).\nDeveloped a Java framework (ODT Runner) to automate validation tests.\nIndustrialised the validation workflows: from 9 steps down to 3.\nAnalysed production incidents with the teams in the USA and India.\nWrote the technical documentation for on-premises customers.",
            '_exp_bullets_fr' => "Conteneurisation de plusieurs services de la plateforme 3DEXPERIENCE sous Red Hat UBI 8.\nDéploiement et orchestration sur Kubernetes via Helm Charts.\nÉtude et mise en place de l’auto-scaling, des mises à jour et des montées de version des services 3DEXPERIENCE sur Kubernetes.\nDurcissement des conteneurs Kubernetes selon le principe du moindre privilège (non-root, securityContext).\nDéveloppement d’un framework Java (ODT Runner) pour automatiser les tests de validation.\nIndustrialisation des workflows de validation : de 9 à 3 étapes.\nAnalyse des incidents de production avec les équipes USA et Inde.\nRédaction de la documentation technique pour les clients On-Premises.",
            '_exp_bullets_es' => "Contenedorización de varios servicios de la plataforma 3DEXPERIENCE con Red Hat UBI 8.\nDespliegue y orquestación en Kubernetes mediante Helm Charts.\nEstudio e implementación del auto-scaling, las actualizaciones y los cambios de versión de los servicios 3DEXPERIENCE en Kubernetes.\nEndurecimiento de los contenedores Kubernetes según el principio de mínimo privilegio (non-root, securityContext).\nDesarrollo de un framework Java (ODT Runner) para automatizar las pruebas de validación.\nIndustrialización de los flujos de validación: de 9 a 3 pasos.\nAnálisis de incidentes de producción con los equipos de EE. UU. e India.\nRedacción de la documentación técnica para los clientes On-Premises.",
            '_exp_techs'      => 'Red Hat UBI 8, Kubernetes, Helm, Java',
        ) ),
        array( 'title' => 'WordPress Dev', 'meta' => array(
            '_exp_featured'   => '',
            '_exp_title_en'   => 'WordPress Developer',
            '_exp_title_fr'   => 'Développeur WordPress',
            '_exp_title_es'   => 'Desarrollador WordPress',
            '_exp_company_en' => 'ACOMP Association', '_exp_company_fr' => 'ACOMP Association', '_exp_company_es' => 'ACOMP Association',
            '_exp_period_en'  => 'Aug – Sep 2024',
            '_exp_period_fr'  => 'août – sept. 2024',
            '_exp_period_es'  => 'ago. – sept. 2024',
            '_exp_location'   => 'Paris',
            '_exp_desc_en'    => '', '_exp_desc_fr' => '', '_exp_desc_es' => '',
            '_exp_bullets_en' => "Developed and customised WordPress sites (themes, plugins).\nStructured reusable components and improved the mobile UX.",
            '_exp_bullets_fr' => "Développement et personnalisation de sites WordPress (thèmes, plugins).\nStructuration de composants réutilisables et amélioration de l’UX mobile.",
            '_exp_bullets_es' => "Desarrollo y personalización de sitios WordPress (temas, plugins).\nEstructuración de componentes reutilizables y mejora de la UX móvil.",
            '_exp_techs'      => '',
        ) ),
        array( 'title' => 'Flutter Dev', 'meta' => array(
            '_exp_featured'   => '',
            '_exp_title_en'   => 'Cross-platform Developer (Flutter)',
            '_exp_title_fr'   => 'Développeur multiplateforme (Flutter)',
            '_exp_title_es'   => 'Desarrollador multiplataforma (Flutter)',
            '_exp_company_en' => 'Revotask', '_exp_company_fr' => 'Revotask', '_exp_company_es' => 'Revotask',
            '_exp_period_en'  => 'Aug – Sep 2024',
            '_exp_period_fr'  => 'août – sept. 2024',
            '_exp_period_es'  => 'ago. – sept. 2024',
            '_exp_location'   => 'Paris',
            '_exp_desc_en'    => '', '_exp_desc_fr' => '', '_exp_desc_es' => '',
            '_exp_bullets_en' => "Developed a cross-platform mobile application.\nImproved the UI and prepared the release on the app stores.",
            '_exp_bullets_fr' => "Développement d’une application mobile multiplateforme.\nAmélioration de l’UI et préparation du déploiement sur les stores.",
            '_exp_bullets_es' => "Desarrollo de una aplicación móvil multiplataforma.\nMejora de la UI y preparación del despliegue en las tiendas de aplicaciones.",
            '_exp_techs'      => '',
        ) ),
        array( 'title' => 'IT Support', 'meta' => array(
            '_exp_featured'   => '',
            '_exp_title_en'   => 'IT Support Technician',
            '_exp_title_fr'   => 'Technicien support informatique',
            '_exp_title_es'   => 'Técnico de soporte informático',
            '_exp_company_en' => 'Lutèce Télécom', '_exp_company_fr' => 'Lutèce Télécom', '_exp_company_es' => 'Lutèce Télécom',
            '_exp_period_en'  => 'Oct – Dec 2023',
            '_exp_period_fr'  => 'oct. – déc. 2023',
            '_exp_period_es'  => 'oct. – dic. 2023',
            '_exp_location'   => 'Pantin',
            '_exp_desc_en'    => '', '_exp_desc_fr' => '', '_exp_desc_es' => '',
            '_exp_bullets_en' => "User support, installation and configuration of network equipment.\nDeployment and configuration of Windows and Linux servers.",
            '_exp_bullets_fr' => "Support utilisateurs, installation et configuration d’équipements réseau.\nDéploiement et configuration de serveurs Windows et Linux.",
            '_exp_bullets_es' => "Soporte a usuarios, instalación y configuración de equipos de red.\nDespliegue y configuración de servidores Windows y Linux.",
            '_exp_techs'      => '',
        ) ),
    );
}

function hdgavi_cv_educations() {
    return array(
        array( 'title' => 'Mastère Cybersécurité & Cloud', 'meta' => array(
            '_edu_period'    => '2024 – 2026',
            '_edu_school'    => 'IPSSI – Paris',
            '_edu_degree_en' => 'Mastère in Cybersecurity & Cloud Computing (Bac+5)',
            '_edu_degree_fr' => 'Mastère Cybersécurité & Cloud Computing (Bac+5)',
            '_edu_degree_es' => 'Mastère en Ciberseguridad y Cloud Computing (Bac+5)',
            '_edu_notes_en'  => '', '_edu_notes_fr' => '', '_edu_notes_es' => '',
        ) ),
        array( 'title' => 'Master 1 SI & BI', 'meta' => array(
            '_edu_period'    => '2024 – 2025',
            '_edu_school'    => 'CNAM – Paris',
            '_edu_degree_en' => 'Master 1 in Information Systems & BI',
            '_edu_degree_fr' => 'Master 1 Systèmes d’information & BI',
            '_edu_degree_es' => 'Máster 1 en Sistemas de Información y BI',
            '_edu_notes_en'  => '', '_edu_notes_fr' => '', '_edu_notes_es' => '',
        ) ),
        array( 'title' => 'Licence générale Informatique', 'meta' => array(
            '_edu_period'    => '2024 – 2025',
            '_edu_school'    => 'CNAM – Île-de-France',
            '_edu_degree_en' => 'Bachelor’s degree in Computer Science',
            '_edu_degree_fr' => 'Licence générale Informatique',
            '_edu_degree_es' => 'Licenciatura en Informática',
            '_edu_notes_en'  => '', '_edu_notes_fr' => '', '_edu_notes_es' => '',
        ) ),
        array( 'title' => 'Licence pro Web Mobile BI', 'meta' => array(
            '_edu_period'    => '2024 – 2025',
            '_edu_school'    => 'CNAM – Paris',
            '_edu_degree_en' => 'Professional bachelor’s degree in Web, Mobile & BI',
            '_edu_degree_fr' => 'Licence professionnelle Web, Mobile & BI',
            '_edu_degree_es' => 'Licenciatura profesional en Web, Móvil y BI',
            '_edu_notes_en'  => '', '_edu_notes_fr' => '', '_edu_notes_es' => '',
        ) ),
        array( 'title' => 'Titre pro TSSR', 'meta' => array(
            '_edu_period'    => '2023',
            '_edu_school'    => 'Ressources Formation – Torcy',
            '_edu_degree_en' => 'Professional title “Technicien Supérieur Systèmes et Réseaux” (Bac+2)',
            '_edu_degree_fr' => 'Titre professionnel Technicien Supérieur Systèmes et Réseaux (Bac+2)',
            '_edu_degree_es' => 'Título profesional «Technicien Supérieur Systèmes et Réseaux» (Bac+2)',
            '_edu_notes_en'  => '', '_edu_notes_fr' => '', '_edu_notes_es' => '',
        ) ),
    );
}

function hdgavi_cv_skill_groups() {
    return array(
        array( 'en' => 'Containers & orchestration', 'fr' => 'Conteneurs & orchestration', 'es' => 'Contenedores y orquestación', 'items' => array( 'Docker', 'Kubernetes', 'Helm', 'Istio (service mesh)' ) ),
        array( 'en' => 'CI/CD & GitOps', 'fr' => 'CI/CD & GitOps', 'es' => 'CI/CD y GitOps', 'items' => array( 'Git', 'Jenkins', 'GitLab CI', 'GitHub Actions', 'ArgoCD' ) ),
        array( 'en' => 'Cloud & IaC', 'fr' => 'Cloud & IaC', 'es' => 'Cloud e IaC', 'items' => array( 'AWS', 'Terraform', 'Ansible' ) ),
        array( 'en' => 'DevSecOps', 'fr' => 'DevSecOps', 'es' => 'DevSecOps', 'items' => array( 'Kyverno (Policy as Code)', 'Trivy' ) ),
        array( 'en' => 'Observability', 'fr' => 'Observabilité', 'es' => 'Observabilidad', 'items' => array( 'Prometheus', 'Grafana' ) ),
        array( 'en' => 'Languages', 'fr' => 'Langages', 'es' => 'Lenguajes', 'items' => array( 'Java', 'Python', 'Bash' ) ),
        array( 'en' => 'Operating systems', 'fr' => 'OS', 'es' => 'Sistemas operativos', 'items' => array( 'Linux', 'Windows' ) ),
    );
}

function hdgavi_cv_skills() {
    $skills = array();
    foreach ( hdgavi_cv_skill_groups() as $group ) {
        foreach ( $group['items'] as $name ) {
            $skills[] = array( 'title' => $name, 'meta' => array(
                '_skill_name'        => $name,
                '_skill_category_en' => $group['en'],
                '_skill_category_fr' => $group['fr'],
                '_skill_category_es' => $group['es'],
                '_skill_level'       => '',
                '_skill_usage'       => '',
                '_skill_years'       => '',
            ) );
        }
    }
    return $skills;
}

function hdgavi_cv_projects() {
    return array(
        array( 'title' => 'Plateforme DevOps AWS', 'meta' => array(
            '_proj_tag'      => '',
            '_proj_title_en' => 'AWS DevOps platform',
            '_proj_title_fr' => 'Plateforme DevOps AWS',
            '_proj_title_es' => 'Plataforma DevOps en AWS',
            '_proj_desc_en'  => 'End-to-end DevOps platform on AWS: Terraform infrastructure, Ansible configuration, a Jenkins pipeline and Prometheus monitoring, used to deploy a React dashboard.',
            '_proj_desc_fr'  => 'Plateforme DevOps de bout en bout sur AWS : infrastructure Terraform, configuration Ansible, pipeline Jenkins et supervision Prometheus, pour déployer un tableau de bord React.',
            '_proj_desc_es'  => 'Plataforma DevOps de extremo a extremo en AWS: infraestructura con Terraform, configuración con Ansible, pipeline de Jenkins y supervisión con Prometheus, para desplegar un panel React.',
            '_proj_points_en' => "Terraform modules for the VPC, security groups and EC2 instances (Jenkins, Ansible), behind an ALB and an NLB.\nAnsible roles: Jenkins installation, user management, SSH hardening and firewall.\nDeclarative Jenkins pipeline: the dev branch goes to pre-production, main goes to production.\nPrometheus and Node Exporter on every server, Jenkins metrics scraped through the ALB.",
            '_proj_points_fr' => "Modules Terraform pour le VPC, les groupes de sécurité et les instances EC2 (Jenkins, Ansible), derrière un ALB et un NLB.\nRôles Ansible : installation de Jenkins, gestion des utilisateurs, durcissement SSH et pare-feu.\nPipeline Jenkins déclaratif : la branche dev part en préproduction, main en production.\nPrometheus et Node Exporter sur chaque serveur, métriques Jenkins collectées via l’ALB.",
            '_proj_points_es' => "Módulos Terraform para la VPC, los grupos de seguridad y las instancias EC2 (Jenkins, Ansible), detrás de un ALB y un NLB.\nRoles de Ansible: instalación de Jenkins, gestión de usuarios, endurecimiento de SSH y cortafuegos.\nPipeline declarativo de Jenkins: la rama dev va a preproducción y main a producción.\nPrometheus y Node Exporter en cada servidor; métricas de Jenkins recogidas a través del ALB.",
            '_proj_techs'    => 'Terraform, Jenkins, Ansible, Prometheus, React',
            '_proj_link'     => 'https://github.com/g-holali-david/aws-devops-automation',
        ) ),
        array( 'title' => 'Pipeline DevSecOps', 'meta' => array(
            '_proj_tag'      => '',
            '_proj_title_en' => 'DevSecOps pipeline',
            '_proj_title_fr' => 'Pipeline DevSecOps',
            '_proj_title_es' => 'Pipeline DevSecOps',
            '_proj_desc_en'  => 'GitHub Actions pipeline that runs four security scanners in parallel, produces a unified HTML report and blocks the merge on critical findings.',
            '_proj_desc_fr'  => 'Pipeline GitHub Actions qui lance quatre scanners de sécurité en parallèle, produit un rapport HTML unifié et bloque la fusion en cas de faille critique.',
            '_proj_desc_es'  => 'Pipeline de GitHub Actions que ejecuta cuatro escáneres de seguridad en paralelo, genera un informe HTML unificado y bloquea la fusión ante hallazgos críticos.',
            '_proj_points_en' => "Trivy on container images, Grype on an SBOM generated by Syft, Gitleaks on the Git history, Checkov on Terraform code.\nResults in SARIF, visible in the GitHub Security tab.\nHTML report generated in Python: a score from 0 to 100 and findings by severity.\nPolicy gates label the pull request security-passed or security-blocked; also published as a reusable workflow.",
            '_proj_points_fr' => "Trivy sur les images de conteneur, Grype sur un SBOM généré par Syft, Gitleaks sur l’historique Git, Checkov sur le code Terraform.\nRésultats au format SARIF, visibles dans l’onglet Security de GitHub.\nRapport HTML généré en Python : score de 0 à 100 et constats par sévérité.\nPolicy gates : la pull request est étiquetée security-passed ou security-blocked ; workflow réutilisable dans d’autres dépôts.",
            '_proj_points_es' => "Trivy sobre las imágenes de contenedor, Grype sobre un SBOM generado con Syft, Gitleaks sobre el historial de Git y Checkov sobre el código Terraform.\nResultados en formato SARIF, visibles en la pestaña Security de GitHub.\nInforme HTML generado en Python: puntuación de 0 a 100 y hallazgos por gravedad.\nPolicy gates que etiquetan la pull request como security-passed o security-blocked; también disponible como workflow reutilizable.",
            '_proj_techs'    => 'Trivy, Checkov, Grype, Gitleaks',
            '_proj_link'     => 'https://github.com/g-holali-david/hdgavi-security-pipeline',
        ) ),
        array( 'title' => 'Architecture microservices GitOps', 'meta' => array(
            '_proj_tag'      => '',
            '_proj_title_en' => 'GitOps microservices architecture',
            '_proj_title_fr' => 'Architecture microservices GitOps',
            '_proj_title_es' => 'Arquitectura de microservicios GitOps',
            '_proj_desc_en'  => 'Three microservices deployed on Kubernetes with GitOps, from continuous integration to canary rollout, with observability.',
            '_proj_desc_fr'  => 'Trois microservices déployés sur Kubernetes en GitOps, de l’intégration continue au déploiement canary, avec observabilité.',
            '_proj_desc_es'  => 'Tres microservicios desplegados en Kubernetes con GitOps, desde la integración continua hasta el despliegue canary, con observabilidad.',
            '_proj_points_en' => "Go API gateway (reverse proxy, JWT validation, rate limiting), Go authentication service, Python/FastAPI worker fed by a Redis queue, PostgreSQL.\nMulti-stage Docker images (distroless for Go) and one Helm chart per service.\nGitHub Actions CI: tests, lint, Trivy scan, push to GHCR; ArgoCD (app-of-apps) syncs the cluster.\nArgo Rollouts canary (10%, 50%, 100%), Prometheus and Grafana dashboards.",
            '_proj_points_fr' => "Passerelle API en Go (reverse proxy, validation JWT, limitation de débit), service d’authentification en Go, worker Python/FastAPI alimenté par une file Redis, PostgreSQL.\nImages Docker multi-stage (distroless pour Go) et une chart Helm par service.\nCI GitHub Actions : tests, lint, scan Trivy, publication sur GHCR ; ArgoCD (app-of-apps) synchronise le cluster.\nDéploiement canary avec Argo Rollouts (10 %, 50 %, 100 %), tableaux de bord Prometheus et Grafana.",
            '_proj_points_es' => "API gateway en Go (proxy inverso, validación JWT, limitación de tasa), servicio de autenticación en Go, worker Python/FastAPI alimentado por una cola Redis, PostgreSQL.\nImágenes Docker multi-stage (distroless para Go) y un chart de Helm por servicio.\nCI con GitHub Actions: tests, lint, análisis con Trivy y publicación en GHCR; ArgoCD (app-of-apps) sincroniza el clúster.\nDespliegue canary con Argo Rollouts (10 %, 50 %, 100 %), paneles de Prometheus y Grafana.",
            '_proj_techs'    => 'Go, Kubernetes, Helm, ArgoCD, Grafana',
            '_proj_link'     => 'https://github.com/g-holali-david/hdgavi-microservices-gitops',
        ) ),
        array( 'title' => 'CLI DevOps en Go', 'meta' => array(
            '_proj_tag'      => '',
            '_proj_title_en' => 'DevOps CLI in Go',
            '_proj_title_fr' => 'CLI DevOps en Go',
            '_proj_title_es' => 'CLI DevOps en Go',
            '_proj_desc_en'  => 'devkit, a command-line tool written in Go (Cobra) for everyday DevOps tasks.',
            '_proj_desc_fr'  => 'devkit, un outil en ligne de commande écrit en Go (Cobra) pour les tâches DevOps courantes.',
            '_proj_desc_es'  => 'devkit, una herramienta de línea de comandos escrita en Go (Cobra) para las tareas DevOps habituales.',
            '_proj_points_en' => "Dockerfile linting with a quality score and optimisation hints.\nProduction-ready Helm chart scaffolding: non-root, resource limits, PDB, HPA, probes.\nKubernetes RBAC audit and cost estimate per namespace.\nCI pipeline generation (GitHub Actions, GitLab CI); Linux, macOS and Windows binaries released with GoReleaser.",
            '_proj_points_fr' => "Analyse de Dockerfile avec score de qualité et suggestions d’optimisation.\nGénération de charts Helm prêtes pour la production : non-root, limites de ressources, PDB, HPA, sondes.\nAudit RBAC Kubernetes et estimation des coûts par namespace.\nGénération de pipelines CI (GitHub Actions, GitLab CI) ; binaires Linux, macOS et Windows publiés avec GoReleaser.",
            '_proj_points_es' => "Análisis de Dockerfile con puntuación de calidad y sugerencias de optimización.\nGeneración de charts de Helm listos para producción: non-root, límites de recursos, PDB, HPA, sondas.\nAuditoría RBAC de Kubernetes y estimación de costes por namespace.\nGeneración de pipelines de CI (GitHub Actions, GitLab CI); binarios para Linux, macOS y Windows publicados con GoReleaser.",
            '_proj_techs'    => 'Helm, audit RBAC, Docker, Kubernetes',
            '_proj_link'     => 'https://github.com/g-holali-david/devkit',
        ) ),
    );
}

function hdgavi_cv_timeline() {
    return array(
        array( 'title' => 'TL Dassault', 'meta' => array( '_tl_period' => '2024', '_tl_type' => 'work', '_tl_icon' => '',
            '_tl_title_en' => 'DevOps / Cloud Native Engineer (work-study)', '_tl_title_fr' => 'Ingénieur DevOps / Cloud Native (alternance)', '_tl_title_es' => 'Ingeniero DevOps / Cloud Native (alternancia)',
            '_tl_desc_en' => 'Dassault Systèmes, Vélizy-Villacoublay', '_tl_desc_fr' => 'Dassault Systèmes, Vélizy-Villacoublay', '_tl_desc_es' => 'Dassault Systèmes, Vélizy-Villacoublay' ) ),
        array( 'title' => 'TL Mastère', 'meta' => array( '_tl_period' => '2024 – 2026', '_tl_type' => 'education', '_tl_icon' => '',
            '_tl_title_en' => 'Mastère in Cybersecurity & Cloud Computing', '_tl_title_fr' => 'Mastère Cybersécurité & Cloud Computing', '_tl_title_es' => 'Mastère en Ciberseguridad y Cloud Computing',
            '_tl_desc_en' => 'IPSSI, Paris', '_tl_desc_fr' => 'IPSSI, Paris', '_tl_desc_es' => 'IPSSI, París' ) ),
        array( 'title' => 'TL CNAM', 'meta' => array( '_tl_period' => '2024 – 2025', '_tl_type' => 'education', '_tl_icon' => '',
            '_tl_title_en' => 'Master 1 in Information Systems & BI, two bachelor’s degrees', '_tl_title_fr' => 'Master 1 Systèmes d’information & BI, licence générale Informatique, licence pro Web, Mobile & BI', '_tl_title_es' => 'Máster 1 en Sistemas de Información y BI, dos licenciaturas',
            '_tl_desc_en' => 'CNAM, Paris and Île-de-France', '_tl_desc_fr' => 'CNAM, Paris et Île-de-France', '_tl_desc_es' => 'CNAM, París e Île-de-France' ) ),
        array( 'title' => 'TL ACOMP', 'meta' => array( '_tl_period' => '2024', '_tl_type' => 'work', '_tl_icon' => '',
            '_tl_title_en' => 'WordPress Developer', '_tl_title_fr' => 'Développeur WordPress', '_tl_title_es' => 'Desarrollador WordPress',
            '_tl_desc_en' => 'ACOMP Association, Paris', '_tl_desc_fr' => 'ACOMP Association, Paris', '_tl_desc_es' => 'ACOMP Association, París' ) ),
        array( 'title' => 'TL Revotask', 'meta' => array( '_tl_period' => '2024', '_tl_type' => 'work', '_tl_icon' => '',
            '_tl_title_en' => 'Cross-platform Developer (Flutter)', '_tl_title_fr' => 'Développeur multiplateforme (Flutter)', '_tl_title_es' => 'Desarrollador multiplataforma (Flutter)',
            '_tl_desc_en' => 'Revotask, Paris', '_tl_desc_fr' => 'Revotask, Paris', '_tl_desc_es' => 'Revotask, París' ) ),
        array( 'title' => 'TL Lutece', 'meta' => array( '_tl_period' => '2023', '_tl_type' => 'work', '_tl_icon' => '',
            '_tl_title_en' => 'IT Support Technician', '_tl_title_fr' => 'Technicien support informatique', '_tl_title_es' => 'Técnico de soporte informático',
            '_tl_desc_en' => 'Lutèce Télécom, Pantin', '_tl_desc_fr' => 'Lutèce Télécom, Pantin', '_tl_desc_es' => 'Lutèce Télécom, Pantin' ) ),
        array( 'title' => 'TL TSSR', 'meta' => array( '_tl_period' => '2023', '_tl_type' => 'education', '_tl_icon' => '',
            '_tl_title_en' => 'Professional title “Technicien Supérieur Systèmes et Réseaux” (Bac+2)', '_tl_title_fr' => 'Titre professionnel Technicien Supérieur Systèmes et Réseaux (Bac+2)', '_tl_title_es' => 'Título profesional «Technicien Supérieur Systèmes et Réseaux» (Bac+2)',
            '_tl_desc_en' => 'Ressources Formation, Torcy', '_tl_desc_fr' => 'Ressources Formation, Torcy', '_tl_desc_es' => 'Ressources Formation, Torcy' ) ),
    );
}
