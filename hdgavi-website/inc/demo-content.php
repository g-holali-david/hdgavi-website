<?php
/**
 * HD GAVI Portfolio — Demo Content Importer (v6.2.0)
 * Pre-fills the Customizer with realistic default content for Holali David GAVI.
 * Triggered from Portfolio Setup page or on theme activation.
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Returns the full array of demo content for all Customizer options.
 */
function hdgavi_get_demo_content() {
	return array(

		/* ── General ── */
		'general_name'           => 'Holali David GAVI',
		'general_email'          => 'g.holalidavid@gmail.com',
		'general_location'       => 'Saint-Denis (93), Île-de-France',
		'contact_github'         => 'https://github.com/g-holali-david',
		'contact_github_handle'  => 'g-holali-david',
		'contact_linkedin'       => 'https://www.linkedin.com/in/holali-david-g-4a434631a/',
		'contact_phone'          => '07 63 15 25 91',
		'default_lang'           => 'en',
		'logo_monogram'          => 'HD',
		'logo_text'              => 'GAVI',
		'show_rqth'              => false,
		'footer_name'            => 'Holali David GAVI',
		'footer_year'            => '2026',

		/* ── Splash ── */
		'splash_title'           => 'Holali David GAVI',
		'splash_subtitle_en'     => 'Cloud & DevOps Engineer',
		'splash_subtitle_fr'     => 'Ingénieur Cloud & DevOps',
		'splash_subtitle_es'     => 'Ingeniero Cloud & DevOps',
		'splash_btn_en'          => 'Explore',
		'splash_btn_fr'          => 'Explorer',
		'splash_btn_es'          => 'Explorar',
		'splash_cv_btn_en'       => 'Download CV',
		'splash_cv_btn_fr'       => 'Télécharger CV',
		'splash_cv_btn_es'       => 'Descargar CV',
		'terminal_enabled'       => true,

		/* ── Terminal lines ── */
		'terminal_lines_en'      => json_encode( array(
			array( 'cmd' => '$ whoami', 'out' => 'Holali David GAVI — Cloud & DevOps Engineer' ),
			array( 'cmd' => '$ kubectl get skills', 'out' => 'Docker ✓  Kubernetes ✓  Helm ✓  Java ✓' ),
			array( 'cmd' => '$ cat stack.txt', 'out' => 'Kubernetes | Docker | Terraform | CI/CD | Cloud Security' ),
			array( 'cmd' => '$ cat motivation.txt', 'out' => 'Curious. Persistent. Passionate about code.' ),
		) ),
		'terminal_lines_fr'      => json_encode( array(
			array( 'cmd' => '$ whoami', 'out' => 'Holali David GAVI — Ingénieur Cloud & DevOps' ),
			array( 'cmd' => '$ kubectl get skills', 'out' => 'Docker ✓  Kubernetes ✓  Helm ✓  Java ✓' ),
			array( 'cmd' => '$ cat stack.txt', 'out' => 'Kubernetes | Docker | Terraform | CI/CD | Sécurité Cloud' ),
			array( 'cmd' => '$ cat motivation.txt', 'out' => 'Curieux. Persévérant. Passionné par le code.' ),
		) ),

		/* ── About ── */
		'about_badge_en'         => 'Cloud & DevOps Engineer',
		'about_badge_fr'         => 'Ingénieur Cloud & DevOps',
		'about_badge_es'         => 'Ingeniero Cloud & DevOps',
		'about_quote_en'         => "I don't look for the easy way, I look to understand.",
		'about_quote_fr'         => 'Je ne cherche pas la facilité, je cherche à comprendre.',
		'about_quote_es'         => 'No busco lo fácil, busco comprender.',
		'about_text_en'          => "<p>I'm a curious person. When I discover a topic that interests me, I dig until I truly understand how it works. That's how I learned IT — on my own, in the evenings, before it even became my job.</p><p>What I love most about this job is that when I'm working, everything else fades away. Coding gives me real satisfaction, a kind of flow where hours pass without me noticing.</p><p>I'm patient and persistent. Changing careers twice, starting studies from scratch, juggling two Master's degrees in evening classes while working — that takes discipline. But I don't see it as a sacrifice. I genuinely enjoy learning.</p><p>I always strive for quality in what I produce. For me, IT should automate as much as possible, simplify, and make things more reliable.</p><p>When I understand something, I need to structure it and document it — first for myself, then for others. I believe that well-commented code and clear documentation is a form of respect for those who come after. I'm not the loudest in a team, but you can count on me.</p>",
		'about_text_fr'          => "<p>Je suis quelqu'un de curieux. Quand je découvre un sujet qui m'intéresse, je creuse jusqu'à comprendre comment ça fonctionne vraiment. C'est comme ça que j'ai appris l'informatique — seul, le soir, avant même d'en faire mon métier.</p><p>Ce que j'aime le plus dans ce métier, c'est qu'en travaillant j'oublie tout le reste. Le code me procure une vraie satisfaction, une sorte de flow où les heures passent sans que je m'en rende compte.</p><p>Je suis patient et persévérant. Changer de carrière deux fois, reprendre les études à zéro, cumuler deux masters en cours du soir tout en travaillant — ça demande de la discipline. Mais je ne vois pas ça comme un sacrifice, j'aime apprendre.</p><p>Je cherche toujours la qualité dans ce que je produis. Pour moi, l'informatique doit servir à automatiser au maximum, à simplifier, à rendre les choses plus fiables.</p><p>Quand je comprends quelque chose, j'ai besoin de le structurer et de le documenter — d'abord pour moi, puis pour les autres. Je crois que du code bien commenté et une documentation claire, c'est une forme de respect envers ceux qui passeront après. Je ne suis pas le plus bruyant dans une équipe, mais on peut compter sur moi.</p>",

		/* ── Stats ── */
		'stat_1_number'          => '1+',
		'stat_1_label_en'        => 'Year in DevOps & Cloud',
		'stat_1_label_fr'        => 'An en DevOps & Cloud',
		'stat_1_label_es'        => 'Año en DevOps & Cloud',
		'stat_2_number'          => '8',
		'stat_2_label_en'        => 'Technical projects',
		'stat_2_label_fr'        => 'Projets techniques',
		'stat_2_label_es'        => 'Proyectos técnicos',
		'stat_3_number'          => '2',
		'stat_3_label_en'        => "Parallel Master's degrees",
		'stat_3_label_fr'        => 'Mastères en parallèle',
		'stat_3_label_es'        => 'Másteres en paralelo',
		'stat_4_number'          => '3',
		'stat_4_label_en'        => 'Languages spoken',
		'stat_4_label_fr'        => 'Langues parlées',
		'stat_4_label_es'        => 'Idiomas hablados',

		/* ── Traits ── */
		'trait_1_en' => 'Curious',     'trait_1_fr' => 'Curieux',     'trait_1_es' => 'Curioso',     'trait_1_desc_en' => 'Self-taught since 2016, I learn because I want to, not because I have to', 'trait_1_desc_fr' => "Autodidacte depuis 2016, j'apprends par envie, pas par obligation", 'trait_1_desc_es' => 'Autodidacta desde 2016, aprendo por ganas, no por obligación', 'trait_1_color' => '#06B6D4',
		'trait_2_en' => 'Passionate',  'trait_2_fr' => 'Passionné',   'trait_2_es' => 'Apasionado',  'trait_2_desc_en' => "Coding makes everything else fade away, it's where I feel at home", 'trait_2_desc_fr' => 'Le code me fait oublier tout le reste, c\'est là que je me sens à ma place', 'trait_2_desc_es' => 'El código me hace olvidar todo lo demás, es donde me siento en casa', 'trait_2_color' => '#818CF8',
		'trait_3_en' => 'Persistent',  'trait_3_fr' => 'Persévérant', 'trait_3_es' => 'Persistente', 'trait_3_desc_en' => "Two career changes, two parallel Master's degrees, still standing", 'trait_3_desc_fr' => 'Deux reconversions, deux masters en parallèle, toujours debout', 'trait_3_desc_es' => 'Dos cambios de carrera, dos másteres en paralelo, sigo en pie', 'trait_3_color' => '#22C55E',
		'trait_4_en' => 'Creative',    'trait_4_fr' => 'Créatif',     'trait_4_es' => 'Creativo',    'trait_4_desc_en' => 'A problem = a solution to build. That\'s what fuels my side projects', 'trait_4_desc_fr' => "Un problème = une solution à développer. C'est ce qui alimente mes projets perso", 'trait_4_desc_es' => 'Un problema = una solución por construir. Eso alimenta mis proyectos personales', 'trait_4_color' => '#F59E0B',
		'trait_5_en' => 'Rigorous',    'trait_5_fr' => 'Rigoureux',   'trait_5_es' => 'Riguroso',    'trait_5_desc_en' => 'I chase quality, I document everything, I aim for perfection', 'trait_5_desc_fr' => 'Je cherche la qualité, je documente, je vise la perfection', 'trait_5_desc_es' => 'Busco la calidad, documento todo, apunto a la perfección', 'trait_5_color' => '#06B6D4',
		'trait_6_en' => 'Pragmatic',   'trait_6_fr' => 'Pragmatique', 'trait_6_es' => 'Pragmático',  'trait_6_desc_en' => 'IT should automate and simplify, not add complexity', 'trait_6_desc_fr' => "L'informatique doit automatiser et simplifier, pas compliquer", 'trait_6_desc_es' => 'La informática debe automatizar y simplificar, no complicar', 'trait_6_color' => '#818CF8',
		'trait_7_en' => 'Reliable',    'trait_7_fr' => 'Fiable',      'trait_7_es' => 'Fiable',      'trait_7_desc_en' => 'Not the loudest, but you can count on me. I document, I structure, I leave things clear', 'trait_7_desc_fr' => 'Pas le plus bruyant, mais on peut compter sur moi. Je documente, je structure, je laisse les choses claires', 'trait_7_desc_es' => 'No soy el más ruidoso, pero se puede contar conmigo', 'trait_7_color' => '#22C55E',

		/* ── Content below is now managed via CPTs (Experience, Projects, Education, Skills) ── */
		/* ── Use the Portfolio Setup page to import demo CPT data ── */

		/* ── Self-learning ── */
		'selflearn_title_en' => 'Self-learning & online courses',
		'selflearn_title_fr' => 'Autoformation & cours en ligne',
		'selflearn_title_es' => 'Autoformación y cursos en línea',
		'selflearn_list'     => "Introduction to Cybersecurity (Cisco)\nNetworking Basics (Cisco)\nNetworking Devices and Initial Configuration (Cisco)\nAWS Solutions Architect Associate Cert Prep (LinkedIn)\nDocker for Developers (LinkedIn)\nLearning Docker (LinkedIn)\nObject-Oriented Programming with Python (OpenClassrooms)\nPython Basics (OpenClassrooms)\nCoding with JavaScript (OpenClassrooms)\nProgramming in C++ (OpenClassrooms)\nVirtualization Environments (OpenClassrooms)\nInformation Systems Discovery (OpenClassrooms)\nPowerShell Scripts on Windows Server (OpenClassrooms)\nFront-end Environment Setup (OpenClassrooms)",

		/* ── Footer ── */
		'footer_desc_en'     => 'Cloud & DevOps Engineer. Containerization, Kubernetes, CI/CD automation and cloud security.',
		'footer_desc_fr'     => 'Ingénieur Cloud & DevOps. Conteneurisation, Kubernetes, automatisation CI/CD et sécurité cloud.',
		'footer_desc_es'     => 'Ingeniero Cloud & DevOps. Contenedorización, Kubernetes, automatización CI/CD y seguridad cloud.',

		/* ── Legal ── */
		'legal_hosting_name'    => 'OVH / o2switch',
		'legal_hosting_address' => 'France',

		/* ── SEO ── */
		'seo_job_title'      => 'Cloud & DevOps Engineer',
		'seo_company'        => '',
		'seo_home_title_en'  => 'Holali David GAVI — Cloud & DevOps Engineer Portfolio',
		'seo_home_title_fr'  => 'Holali David GAVI — Portfolio Ingénieur Cloud & DevOps',
		'seo_home_title_es'  => 'Holali David GAVI — Portfolio Ingeniero Cloud & DevOps',
		'seo_home_desc_en'   => 'Portfolio of Holali David GAVI — Cloud & DevOps Engineer. Specialized in Docker/Kubernetes containerization, CI/CD automation and cloud security.',
		'seo_home_desc_fr'   => 'Portfolio de Holali David GAVI — Ingénieur Cloud & DevOps. Spécialisé en conteneurisation Docker/Kubernetes, automatisation CI/CD et sécurité cloud.',
		'seo_home_desc_es'   => 'Portfolio de Holali David GAVI — Ingeniero Cloud & DevOps. Especializado en contenedorización Docker/Kubernetes, automatización CI/CD y seguridad cloud.',
		'seo_about_title_en' => 'About – Holali David GAVI',
		'seo_about_title_fr' => 'À propos – Holali David GAVI',
		'seo_about_title_es' => 'Sobre mí – Holali David GAVI',
		'seo_about_desc_en'  => 'Learn about Holali David GAVI — background, values, career journey from psychology to DevOps engineering.',
		'seo_about_desc_fr'  => 'Découvrez Holali David GAVI — parcours, valeurs, de la psychologie à l\'ingénierie DevOps.',
		'seo_about_desc_es'  => 'Descubre a Holali David GAVI — trayectoria, valores, de la psicología a la ingeniería DevOps.',
		'seo_skills_title_en'  => 'Skills – Holali David GAVI',
		'seo_skills_title_fr'  => 'Compétences – Holali David GAVI',
		'seo_skills_title_es'  => 'Habilidades – Holali David GAVI',
		'seo_skills_desc_en'   => 'Technical skills: Docker, Kubernetes, Terraform, CI/CD, Python, cloud security and infrastructure automation.',
		'seo_skills_desc_fr'   => 'Compétences techniques : Docker, Kubernetes, Terraform, CI/CD, Python, sécurité cloud et automatisation d\'infrastructure.',
		'seo_skills_desc_es'   => 'Habilidades técnicas: Docker, Kubernetes, Terraform, CI/CD, Python, seguridad cloud y automatización de infraestructura.',
		'seo_experience_title_en' => 'Experience – Holali David GAVI',
		'seo_experience_title_fr' => 'Expérience – Holali David GAVI',
		'seo_experience_title_es' => 'Experiencia – Holali David GAVI',
		'seo_experience_desc_en'  => 'Professional experience: Cloud & DevOps Engineer with hands-on Kubernetes containerization and CI/CD pipeline automation.',
		'seo_experience_desc_fr'  => 'Expérience professionnelle : Ingénieur Cloud & DevOps avec expertise en conteneurisation Kubernetes et automatisation de pipelines CI/CD.',
		'seo_experience_desc_es'  => 'Experiencia profesional: Ingeniero Cloud & DevOps con expertise en contenedorización Kubernetes y automatización de pipelines CI/CD.',
		'seo_projects_title_en' => 'Projects – Holali David GAVI',
		'seo_projects_title_fr' => 'Projets – Holali David GAVI',
		'seo_projects_title_es' => 'Proyectos – Holali David GAVI',
		'seo_projects_desc_en'  => 'Portfolio projects: Kubernetes deployments, CI/CD pipelines, infrastructure as code, full-stack applications.',
		'seo_projects_desc_fr'  => 'Projets portfolio : déploiements Kubernetes, pipelines CI/CD, infrastructure as code, applications full-stack.',
		'seo_projects_desc_es'  => 'Proyectos portfolio: despliegues Kubernetes, pipelines CI/CD, infraestructura como código, aplicaciones full-stack.',
		'seo_education_title_en' => 'Education – Holali David GAVI',
		'seo_education_title_fr' => 'Formation – Holali David GAVI',
		'seo_education_title_es' => 'Formación – Holali David GAVI',
		'seo_education_desc_en'  => 'Education: IPSSI Paris (Cloud & DevOps), CNAM, Université de Lille. Self-taught developer turned DevOps engineer.',
		'seo_education_desc_fr'  => 'Formation : IPSSI Paris (Cloud & DevOps), CNAM, Université de Lille. Autodidacte devenu ingénieur DevOps.',
		'seo_education_desc_es'  => 'Formación: IPSSI París (Cloud & DevOps), CNAM, Universidad de Lille. Autodidacta convertido en ingeniero DevOps.',
		'seo_contact_title_en' => 'Contact – Holali David GAVI',
		'seo_contact_title_fr' => 'Contact – Holali David GAVI',
		'seo_contact_title_es' => 'Contacto – Holali David GAVI',
		'seo_contact_desc_en'  => 'Get in touch with Holali David GAVI for DevOps, cloud engineering, or collaboration opportunities.',
		'seo_contact_desc_fr'  => 'Contactez Holali David GAVI pour des opportunités DevOps, cloud engineering ou collaboration.',
		'seo_contact_desc_es'  => 'Contacta con Holali David GAVI para oportunidades DevOps, cloud engineering o colaboración.',
		'seo_certifications_title_en' => 'Certifications – Holali David GAVI',
		'seo_certifications_title_fr' => 'Certifications – Holali David GAVI',
		'seo_certifications_title_es' => 'Certificaciones – Holali David GAVI',
		'seo_certifications_desc_en'  => 'Professional certifications: Cisco Cybersecurity, Docker, Kubernetes, and cloud platforms.',
		'seo_certifications_desc_fr'  => 'Certifications professionnelles : Cisco Cybersécurité, Docker, Kubernetes et plateformes cloud.',
		'seo_certifications_desc_es'  => 'Certificaciones profesionales: Cisco Ciberseguridad, Docker, Kubernetes y plataformas cloud.',
		'seo_watch_title_en' => 'Tech Watch – Holali David GAVI',
		'seo_watch_title_fr' => 'Veille Tech – Holali David GAVI',
		'seo_watch_title_es' => 'Vigilancia Tech – Holali David GAVI',
		'seo_watch_desc_en'  => 'Tech watch: articles and resources on DevOps, cloud-native, Kubernetes, and infrastructure trends.',
		'seo_watch_desc_fr'  => 'Veille technologique : articles et ressources sur le DevOps, le cloud-native, Kubernetes et les tendances infra.',
		'seo_watch_desc_es'  => 'Vigilancia tecnológica: artículos y recursos sobre DevOps, cloud-native, Kubernetes y tendencias infra.',
		'seo_blog_title_en' => 'Blog – Holali David GAVI',
		'seo_blog_title_fr' => 'Blog – Holali David GAVI',
		'seo_blog_title_es' => 'Blog – Holali David GAVI',
		'seo_blog_desc_en'  => 'Blog posts about DevOps engineering, cloud architecture, and lessons from the field.',
		'seo_blog_desc_fr'  => 'Articles de blog sur l\'ingénierie DevOps, l\'architecture cloud et les leçons du terrain.',
		'seo_blog_desc_es'  => 'Artículos de blog sobre ingeniería DevOps, arquitectura cloud y lecciones del terreno.',
		'seo_timeline_title_en' => 'Timeline – Holali David GAVI',
		'seo_timeline_title_fr' => 'Parcours – Holali David GAVI',
		'seo_timeline_title_es' => 'Trayectoria – Holali David GAVI',
		'seo_timeline_desc_en'  => 'Career timeline: from self-taught developer to DevOps Engineer at Dassault Systèmes.',
		'seo_timeline_desc_fr'  => 'Parcours professionnel : d\'autodidacte à Ingénieur DevOps chez Dassault Systèmes.',
		'seo_timeline_desc_es'  => 'Trayectoria profesional: de autodidacta a Ingeniero DevOps en Dassault Systèmes.',
		'seo_stack_title_en' => 'Tech Stack – Holali David GAVI',
		'seo_stack_title_fr' => 'Stack Technique – Holali David GAVI',
		'seo_stack_title_es' => 'Stack Técnico – Holali David GAVI',
		'seo_stack_desc_en'  => 'Technical stack: tools and technologies used daily — Docker, Kubernetes, Helm, Terraform, GitLab CI.',
		'seo_stack_desc_fr'  => 'Stack technique : outils et technologies du quotidien — Docker, Kubernetes, Helm, Terraform, GitLab CI.',
		'seo_stack_desc_es'  => 'Stack técnico: herramientas y tecnologías del día a día — Docker, Kubernetes, Helm, Terraform, GitLab CI.',
		'seo_testimonials_title_en' => 'Testimonials – Holali David GAVI',
		'seo_testimonials_title_fr' => 'Témoignages – Holali David GAVI',
		'seo_testimonials_title_es' => 'Testimonios – Holali David GAVI',
		'seo_testimonials_desc_en'  => 'What colleagues and collaborators say about working with Holali David GAVI.',
		'seo_testimonials_desc_fr'  => 'Ce que disent collègues et collaborateurs de leur travail avec Holali David GAVI.',
		'seo_testimonials_desc_es'  => 'Lo que dicen colegas y colaboradores sobre trabajar con Holali David GAVI.',
		'seo_newsletter_title_en' => 'Newsletter – Holali David GAVI',
		'seo_newsletter_title_fr' => 'Newsletter – Holali David GAVI',
		'seo_newsletter_title_es' => 'Newsletter – Holali David GAVI',
		'seo_newsletter_desc_en'  => 'Subscribe to receive updates on DevOps, cloud engineering, and new projects.',
		'seo_newsletter_desc_fr'  => 'Abonnez-vous pour recevoir les actualités DevOps, cloud engineering et nouveaux projets.',
		'seo_newsletter_desc_es'  => 'Suscríbete para recibir novedades sobre DevOps, cloud engineering y nuevos proyectos.',
		'seo_uses_title_en' => 'Uses – Holali David GAVI',
		'seo_uses_title_fr' => 'Mon Setup – Holali David GAVI',
		'seo_uses_title_es' => 'Mi Setup – Holali David GAVI',
		'seo_uses_desc_en'  => 'Hardware, software, and tools I use daily for DevOps engineering and development.',
		'seo_uses_desc_fr'  => 'Matériel, logiciels et outils que j\'utilise quotidiennement pour l\'ingénierie DevOps.',
		'seo_uses_desc_es'  => 'Hardware, software y herramientas que uso a diario para ingeniería DevOps y desarrollo.',
		'seo_roadmap_title_en' => 'Roadmap – Holali David GAVI',
		'seo_roadmap_title_fr' => 'Objectifs – Holali David GAVI',
		'seo_roadmap_title_es' => 'Hoja de Ruta – Holali David GAVI',
		'seo_roadmap_desc_en'  => 'Career goals and learning roadmap: certifications, technologies, and professional milestones.',
		'seo_roadmap_desc_fr'  => 'Objectifs de carrière et plan d\'apprentissage : certifications, technologies et jalons professionnels.',
		'seo_roadmap_desc_es'  => 'Objetivos profesionales y hoja de ruta: certificaciones, tecnologías y hitos profesionales.',
		'seo_availability_title_en' => 'Availability – Holali David GAVI',
		'seo_availability_title_fr' => 'Disponibilité – Holali David GAVI',
		'seo_availability_title_es' => 'Disponibilidad – Holali David GAVI',
		'seo_availability_desc_en'  => 'Current availability, preferred contract types, and how to work together.',
		'seo_availability_desc_fr'  => 'Disponibilité actuelle, types de contrats recherchés et comment collaborer.',
		'seo_availability_desc_es'  => 'Disponibilidad actual, tipos de contrato preferidos y cómo colaborar.',
		'seo_legal_title_en' => 'Legal Notice – Holali David GAVI',
		'seo_legal_title_fr' => 'Mentions Légales – Holali David GAVI',
		'seo_legal_title_es' => 'Aviso Legal – Holali David GAVI',
		'seo_legal_desc_en'  => 'Legal notice, privacy policy, and cookie information.',
		'seo_legal_desc_fr'  => 'Mentions légales, politique de confidentialité et informations sur les cookies.',
		'seo_legal_desc_es'  => 'Aviso legal, política de privacidad e información sobre cookies.',

		/* ── Visual effects ── */
		'fx_particles'       => true,
		'fx_particles_color' => 'rgba(6,182,212,0.4)',
		'fx_particles_speed' => 1,
		'fx_particles_density' => 50,
		'fx_counter'         => true,
		'fx_progress_bar'    => true,
		'fx_progress_color'  => '#06B6D4',
		'fx_grain'           => false,
		'fx_parallax'        => false,
		'fx_custom_cursor'   => false,

		/* ── Easter eggs ── */
		'konami_enabled'     => true,
		'konami_msg_en'      => "🎮 You know the Konami code? We're going to get along.",
		'konami_msg_fr'      => '🎮 Tu connais le Konami code ? On va bien s\'entendre.',
		'konami_msg_es'      => '🎮 ¿Conoces el código Konami? Nos vamos a llevar bien.',

		/* ── Terminal page ── */
		'term_page_prompt'      => 'visitor@hdgavi:~$',
		'term_page_welcome_en'  => 'Welcome to my terminal. Type "help" for available commands.',
		'term_page_welcome_fr'  => 'Bienvenue dans mon terminal. Tape "help" pour voir les commandes disponibles.',

		/* ── GitHub repos ── */
		'gh_repos_enabled'      => true,
		'limit_github_repos'    => 6,

		/* ── Contact labels ── */
		'form_name_en'    => 'Your name',
		'form_name_fr'    => 'Votre nom',
		'form_email_en'   => 'Your email',
		'form_email_fr'   => 'Votre email',
		'form_message_en' => 'Your message',
		'form_message_fr' => 'Votre message',
		'form_btn_en'     => 'Send',
		'form_btn_fr'     => 'Envoyer',

		/* ── Certifications, Timeline, Stack, Testimonials → now managed via CPTs ── */

		/* ── Uses (equipment & tools) ── */
		'uses_cat_1_en' => 'Development', 'uses_cat_1_fr' => 'Développement', 'uses_cat_1_icon' => '💻', 'uses_cat_1_items' => "VS Code — Main editor\nIntelliJ IDEA — Java projects\nGit — Version control\nDocker Desktop — Containerization",
		'uses_cat_2_en' => 'DevOps Tools', 'uses_cat_2_fr' => 'Outils DevOps', 'uses_cat_2_icon' => '⚙️', 'uses_cat_2_items' => "kubectl — Kubernetes CLI\nHelm — K8s package manager\nTerraform — IaC\nAnsible — Configuration management",
		'uses_cat_3_en' => 'Terminal & OS', 'uses_cat_3_fr' => 'Terminal & OS', 'uses_cat_3_icon' => '🖥️', 'uses_cat_3_items' => "Ubuntu 24.04 — Primary OS\nzsh + oh-my-zsh — Shell\nWindows 11 — Secondary\nWireGuard — VPN",

		/* ── Roadmap ── */
		'roadmap_cat_1_en' => 'Certifications', 'roadmap_cat_1_fr' => 'Certifications', 'roadmap_cat_1_icon' => '🎓', 'roadmap_cat_1_items' => "[x] Cisco Introduction to Cybersecurity\n[x] Cisco Networking Basics\n[ ] AWS Solutions Architect Associate\n[ ] CKA (Certified Kubernetes Administrator)",
		'roadmap_cat_2_en' => 'Technical Skills', 'roadmap_cat_2_fr' => 'Compétences techniques', 'roadmap_cat_2_icon' => '🔧', 'roadmap_cat_2_items' => "[x] Docker multi-stage builds\n[x] Helm Charts\n[ ] ArgoCD / GitOps\n[ ] Service Mesh (Istio)\n[ ] Go lang",
		'roadmap_cat_3_en' => 'Career Goals', 'roadmap_cat_3_fr' => 'Objectifs carrière', 'roadmap_cat_3_icon' => '🎯', 'roadmap_cat_3_items' => "[ ] Complete Master's in Cybersecurity & Cloud\n[ ] Transition to full-time DevOps/SRE Engineer\n[ ] Contribute to open source Kubernetes projects",

		/* ── Availability ── */
		'avail_status'     => 'apprenticeship',
		'avail_detail_en'  => 'Currently in apprenticeship at Dassault Systèmes (until Sept. 2026). Open to discussions for post-graduation opportunities.',
		'avail_detail_fr'  => 'Actuellement en alternance chez Dassault Systèmes (jusqu\'en sept. 2026). Ouvert aux discussions pour des opportunités post-diplôme.',
		'avail_next_date'  => 'September 2026',
		'avail_looking_en' => 'A DevOps / Cloud / SRE engineer position in a company that values automation, reliability and continuous learning.',
		'avail_looking_fr' => 'Un poste d\'ingénieur DevOps / Cloud / SRE dans une entreprise qui valorise l\'automatisation, la fiabilité et l\'apprentissage continu.',
		'avail_contracts'  => 'CDI, Freelance',
		'avail_salary_range'       => '42-50K€ (negotiable)',
		'avail_preferred_stack'    => 'Docker, Kubernetes, Helm, Terraform, CI/CD, Linux, Python',
		'avail_location_pref_en'   => 'Remote / Île-de-France / Hybrid',
		'avail_location_pref_fr'   => 'Télétravail / Île-de-France / Hybride',
		'avail_location_pref_es'   => 'Remoto / Île-de-France / Híbrido',
		'avail_experience_summary' => '2+ years Cloud & DevOps (Dassault Systèmes)',

		/* ── Testimonials → managed via CPT hdgavi_testimonial ── */
	);
}

/**
 * Import demo content into Customizer via set_theme_mod()
 * Only sets options that don't already have a value (non-destructive)
 *
 * @param bool $force  If true, overwrite existing values
 * @return array       Summary of import results
 */
function hdgavi_import_demo_content( $force = false ) {
	$demo    = hdgavi_get_demo_content();
	$set     = 0;
	$skipped = 0;

	foreach ( $demo as $key => $value ) {
		$existing = get_theme_mod( $key );
		if ( ! $force && $existing !== false && $existing !== '' ) {
			$skipped++;
			continue;
		}
		set_theme_mod( $key, $value );
		$set++;
	}

	return array(
		'total'   => count( $demo ),
		'set'     => $set,
		'skipped' => $skipped,
	);
}

/**
 * Demo blog & veille articles
 */
function hdgavi_get_demo_articles() {
	return array(
		/* ── Veille Tech articles ── */
		array(
			'title'    => 'Kubernetes 1.32 : les nouveautés qui changent la donne',
			'title_en' => 'Kubernetes 1.32: Game-Changing New Features',
			'title_fr' => 'Kubernetes 1.32 : les nouveautés qui changent la donne',
			'title_es' => 'Kubernetes 1.32: Las novedades que cambian las reglas del juego',
			'excerpt_en' => 'Kubernetes 1.32 brings major improvements in security and performance. Sidecar Containers reach GA, structured authorization goes beta, and dual-stack becomes default.',
			'excerpt_fr' => 'Kubernetes 1.32 apporte des améliorations majeures en sécurité et performance. Les Sidecar Containers passent en GA, l\'autorisation structurée arrive en beta.',
			'excerpt_es' => 'Kubernetes 1.32 trae mejoras importantes en seguridad y rendimiento. Los Sidecar Containers llegan a GA y la autorización estructurada pasa a beta.',
			'content'  => '<div data-lang="fr">
<p>La version 1.32 de Kubernetes apporte des améliorations majeures en matière de sécurité et de performance. Parmi les points forts : le support natif des Sidecar Containers passe en GA, permettant une gestion plus fine des proxies de service mesh comme Istio et Linkerd.</p>
<p>Le nouveau mécanisme de <strong>Structured Authorization Configuration</strong> (beta) permet de définir des chaînes d\'autorisation avec plusieurs webhooks, offrant une granularité sans précédent dans le contrôle d\'accès. Côté stockage, le <strong>volume group snapshots</strong> atteint la beta, simplifiant les sauvegardes cohérentes de volumes multiples.</p>
<h3>Points clés à retenir</h3>
<ul>
<li><strong>Sidecar Containers GA</strong> — Cycle de vie séparé des containers principaux, idéal pour les proxies et agents de logging</li>
<li><strong>CEL pour l\'admission</strong> — Les validating admission policies remplacent progressivement les webhooks pour les cas simples</li>
<li><strong>CPU Manager amélioré</strong> — Meilleure isolation des workloads sensibles à la latence</li>
<li><strong>Dual-stack par défaut</strong> — IPv4 + IPv6 natif sans configuration supplémentaire</li>
</ul>
<p>Pour les équipes DevOps, cette version consolide la tendance vers un Kubernetes plus sécurisé par défaut et plus simple à opérer. La migration depuis la 1.31 est fluide — aucune API n\'est supprimée dans cette release.</p>
</div>
<div data-lang="en">
<p>Kubernetes version 1.32 brings major improvements in security and performance. Among the highlights: native Sidecar Containers support reaches GA, enabling finer-grained management of service mesh proxies like Istio and Linkerd.</p>
<p>The new <strong>Structured Authorization Configuration</strong> mechanism (beta) allows defining authorization chains with multiple webhooks, offering unprecedented granularity in access control. On the storage side, <strong>volume group snapshots</strong> reaches beta, simplifying consistent backups of multiple volumes.</p>
<h3>Key takeaways</h3>
<ul>
<li><strong>Sidecar Containers GA</strong> — Separate lifecycle from main containers, ideal for proxies and logging agents</li>
<li><strong>CEL for admission</strong> — Validating admission policies are gradually replacing webhooks for simple use cases</li>
<li><strong>Improved CPU Manager</strong> — Better isolation for latency-sensitive workloads</li>
<li><strong>Dual-stack by default</strong> — Native IPv4 + IPv6 without additional configuration</li>
</ul>
<p>For DevOps teams, this release consolidates the trend toward a more secure-by-default and easier-to-operate Kubernetes. Migration from 1.31 is smooth — no APIs are removed in this release.</p>
</div>',
			'category' => 'veille',
			'tags'     => array( 'kubernetes', 'devops', 'cloud' ),
			'source'   => 'kubernetes.io',
			'url'      => 'https://kubernetes.io/blog/2024/12/11/kubernetes-v1-32-release/',
			'date'     => '2025-01-15',
		),
		array(
			'title'    => 'Docker Scout : l\'analyse de vulnérabilités intégrée à votre workflow CI/CD',
			'title_en' => 'Docker Scout: Vulnerability Analysis Built Into Your CI/CD Workflow',
			'title_fr' => 'Docker Scout : l\'analyse de vulnérabilités intégrée à votre workflow CI/CD',
			'title_es' => 'Docker Scout: Análisis de vulnerabilidades integrado en tu flujo CI/CD',
			'excerpt_en' => 'Docker Scout transforms container image security with persistent SBOM, continuous CVE monitoring, and CI/CD pipeline integration.',
			'excerpt_fr' => 'Docker Scout transforme la sécurité des images containers avec un SBOM persistant, un suivi continu des CVE et une intégration CI/CD.',
			'excerpt_es' => 'Docker Scout transforma la seguridad de imágenes de contenedores con SBOM persistente, monitoreo continuo de CVE e integración CI/CD.',
			'content'  => '<div data-lang="fr">
<p>Docker Scout transforme la manière dont les équipes gèrent la sécurité des images containers. Intégré directement dans Docker Desktop et les pipelines CI/CD, il analyse chaque image pour détecter les CVE connues et propose des recommandations de remédiation contextuelles.</p>
<p>Contrairement à Trivy ou Grype qui se limitent au scan, Docker Scout crée un <strong>Software Bill of Materials (SBOM)</strong> persistant et le compare en continu contre les bases de vulnérabilités mises à jour. Cela signifie que même vos images déjà déployées sont réévaluées quand une nouvelle CVE est publiée.</p>
<h3>Intégration dans un pipeline GitLab CI</h3>
<p>L\'intégration est simple : une commande <code>docker scout cves</code> dans votre stage de test suffit à bloquer le pipeline si une vulnérabilité critique est détectée. Le rapport est exportable en SARIF pour s\'intégrer aux dashboards de sécurité existants.</p>
<p>En production, la fonctionnalité <strong>Policy Evaluation</strong> permet de définir des règles organisationnelles : pas d\'image avec des CVE critiques non corrigées, base images à jour de moins de 30 jours, etc.</p>
</div>
<div data-lang="en">
<p>Docker Scout is transforming how teams manage container image security. Integrated directly into Docker Desktop and CI/CD pipelines, it analyzes each image to detect known CVEs and provides contextual remediation recommendations.</p>
<p>Unlike Trivy or Grype which are limited to scanning, Docker Scout creates a persistent <strong>Software Bill of Materials (SBOM)</strong> and continuously compares it against updated vulnerability databases. This means even your already-deployed images are reassessed when a new CVE is published.</p>
<h3>Integration in a GitLab CI pipeline</h3>
<p>Integration is straightforward: a <code>docker scout cves</code> command in your test stage is enough to block the pipeline if a critical vulnerability is detected. The report is exportable in SARIF format to integrate with existing security dashboards.</p>
<p>In production, the <strong>Policy Evaluation</strong> feature allows defining organizational rules: no images with unpatched critical CVEs, base images updated within the last 30 days, etc.</p>
</div>',
			'category' => 'veille',
			'tags'     => array( 'docker', 'security', 'cicd' ),
			'source'   => 'docs.docker.com',
			'url'      => 'https://docs.docker.com/scout/',
			'date'     => '2025-02-03',
		),
		array(
			'title'    => 'Terraform vs OpenTofu : quel avenir pour l\'Infrastructure as Code ?',
			'title_en' => 'Terraform vs OpenTofu: What Future for Infrastructure as Code?',
			'title_fr' => 'Terraform vs OpenTofu : quel avenir pour l\'Infrastructure as Code ?',
			'title_es' => 'Terraform vs OpenTofu: ¿Qué futuro para la Infraestructura como Código?',
			'excerpt_en' => 'Since HashiCorp\'s BSL license change, OpenTofu has emerged as a community fork. One year later, we compare features, migration paths, and ecosystem maturity.',
			'excerpt_fr' => 'Depuis le changement de licence BSL de HashiCorp, OpenTofu s\'impose comme fork communautaire. Un an après, on compare fonctionnalités, migration et maturité.',
			'excerpt_es' => 'Desde el cambio de licencia BSL de HashiCorp, OpenTofu se ha consolidado como fork comunitario. Un año después, comparamos funcionalidades y madurez.',
			'content'  => '<div data-lang="fr">
<p>Depuis le changement de licence de Terraform vers BSL par HashiCorp en août 2023, la communauté open source s\'est mobilisée autour d\'OpenTofu, un fork maintenu par la Linux Foundation. Un an et demi plus tard, où en sommes-nous ?</p>
<p>OpenTofu 1.9 apporte des fonctionnalités que Terraform n\'a pas : le <strong>chiffrement natif du state file</strong>, les <strong>variables dans les blocs backend</strong>, et le support des <strong>provider-defined functions</strong>. Ces ajouts répondent à des demandes de la communauté ignorées depuis des années par HashiCorp.</p>
<h3>Migration : est-ce le moment ?</h3>
<p>La migration est techniquement simple — OpenTofu est rétrocompatible avec Terraform 1.6. Cependant, la décision dépend surtout de votre contexte :</p>
<ul>
<li><strong>Startups et PME</strong> — OpenTofu est le choix évident, pas de risques de licence</li>
<li><strong>Grands groupes avec support HashiCorp</strong> — Terraform Cloud/Enterprise reste pertinent</li>
<li><strong>Projets open source</strong> — OpenTofu est obligatoire pour rester sous licence permissive</li>
</ul>
<p>Mon avis : surveillez les deux projets. La concurrence pousse HashiCorp à innover plus vite, et la communauté OpenTofu gagne en maturité chaque mois.</p>
</div>
<div data-lang="en">
<p>Since HashiCorp changed Terraform\'s license to BSL in August 2023, the open source community has rallied around OpenTofu, a fork maintained by the Linux Foundation. A year and a half later, where do we stand?</p>
<p>OpenTofu 1.9 brings features that Terraform lacks: <strong>native state file encryption</strong>, <strong>variables in backend blocks</strong>, and support for <strong>provider-defined functions</strong>. These additions address community requests that HashiCorp had ignored for years.</p>
<h3>Migration: is now the right time?</h3>
<p>Migration is technically straightforward — OpenTofu is backward-compatible with Terraform 1.6. However, the decision depends mostly on your context:</p>
<ul>
<li><strong>Startups and SMBs</strong> — OpenTofu is the obvious choice, no licensing risks</li>
<li><strong>Large enterprises with HashiCorp support</strong> — Terraform Cloud/Enterprise remains relevant</li>
<li><strong>Open source projects</strong> — OpenTofu is mandatory to stay under a permissive license</li>
</ul>
<p>My take: watch both projects. Competition is pushing HashiCorp to innovate faster, and the OpenTofu community is maturing every month.</p>
</div>',
			'category' => 'veille',
			'tags'     => array( 'devops', 'cloud', 'iac' ),
			'source'   => 'opentofu.org',
			'url'      => 'https://opentofu.org/blog/',
			'date'     => '2025-02-18',
		),
		array(
			'title'    => 'ArgoCD + GitOps : déploiement continu sur Kubernetes en pratique',
			'title_en' => 'ArgoCD + GitOps: Continuous Deployment on Kubernetes in Practice',
			'title_fr' => 'ArgoCD + GitOps : déploiement continu sur Kubernetes en pratique',
			'title_es' => 'ArgoCD + GitOps: Despliegue continuo en Kubernetes en la práctica',
			'excerpt_en' => 'GitOps transforms Kubernetes deployments. ArgoCD watches Git repos, auto-syncs clusters, and provides complete audit trails.',
			'excerpt_fr' => 'Le GitOps transforme les déploiements Kubernetes. ArgoCD surveille les repos Git, synchronise les clusters et fournit un audit trail complet.',
			'excerpt_es' => 'GitOps transforma los despliegues en Kubernetes. ArgoCD vigila los repos Git, sincroniza clústeres y proporciona un registro de auditoría completo.',
			'content'  => '<div data-lang="fr">
<p>Le GitOps transforme la façon dont on déploie sur Kubernetes : plus de <code>kubectl apply</code> manuel, plus de scripts de déploiement fragiles. Avec ArgoCD, l\'état désiré de votre cluster est défini dans Git, et toute dérive est automatiquement corrigée.</p>
<p>Le principe est simple : ArgoCD surveille un repository Git contenant vos manifests Kubernetes (ou Helm charts, Kustomize). Dès qu\'un commit modifie la configuration, ArgoCD synchronise automatiquement le cluster pour correspondre à l\'état déclaré.</p>
<h3>Architecture type</h3>
<p>Un setup GitOps mature comprend généralement :</p>
<ul>
<li><strong>App of Apps pattern</strong> — Une application ArgoCD racine qui gère toutes les autres</li>
<li><strong>Sealed Secrets</strong> — Les secrets chiffrés dans Git, déchiffrés uniquement dans le cluster</li>
<li><strong>ApplicationSets</strong> — Déploiement multi-cluster/multi-environnement à partir d\'un seul template</li>
<li><strong>Notifications</strong> — Alertes Slack/Teams sur les changements de sync status</li>
</ul>
<p>L\'avantage majeur : un audit trail complet. Chaque changement en production est un commit Git, avec auteur, date, et message. Le rollback se résume à un <code>git revert</code>.</p>
</div>
<div data-lang="en">
<p>GitOps is transforming how we deploy to Kubernetes: no more manual <code>kubectl apply</code>, no more fragile deployment scripts. With ArgoCD, the desired state of your cluster is defined in Git, and any drift is automatically corrected.</p>
<p>The principle is simple: ArgoCD watches a Git repository containing your Kubernetes manifests (or Helm charts, Kustomize). As soon as a commit modifies the configuration, ArgoCD automatically synchronizes the cluster to match the declared state.</p>
<h3>Typical architecture</h3>
<p>A mature GitOps setup typically includes:</p>
<ul>
<li><strong>App of Apps pattern</strong> — A root ArgoCD application that manages all others</li>
<li><strong>Sealed Secrets</strong> — Secrets encrypted in Git, decrypted only within the cluster</li>
<li><strong>ApplicationSets</strong> — Multi-cluster/multi-environment deployment from a single template</li>
<li><strong>Notifications</strong> — Slack/Teams alerts on sync status changes</li>
</ul>
<p>The major advantage: a complete audit trail. Every production change is a Git commit, with author, date, and message. Rollback comes down to a simple <code>git revert</code>.</p>
</div>',
			'category' => 'veille',
			'tags'     => array( 'kubernetes', 'cicd', 'devops' ),
			'source'   => 'argo-cd.readthedocs.io',
			'url'      => 'https://argo-cd.readthedocs.io/en/stable/',
			'date'     => '2025-03-01',
		),
		array(
			'title'    => 'GitHub Actions : les bonnes pratiques pour des pipelines sécurisés',
			'title_en' => 'GitHub Actions: Best Practices for Secure Pipelines',
			'title_fr' => 'GitHub Actions : les bonnes pratiques pour des pipelines sécurisés',
			'title_es' => 'GitHub Actions: Buenas prácticas para pipelines seguros',
			'excerpt_en' => 'GitHub Actions is the CI/CD standard but flexibility can be a security trap. Pin actions by hash, scope permissions, and adopt SLSA attestations.',
			'excerpt_fr' => 'GitHub Actions est le standard CI/CD mais sa flexibilité peut être un piège. Pinnez les actions par hash, limitez les permissions, adoptez les attestations SLSA.',
			'excerpt_es' => 'GitHub Actions es el estándar CI/CD pero su flexibilidad puede ser una trampa de seguridad. Fija las acciones por hash y adopta las atestaciones SLSA.',
			'content'  => '<div data-lang="fr">
<p>GitHub Actions est devenu le standard de facto pour la CI/CD dans l\'écosystème GitHub. Mais sa flexibilité peut devenir un piège de sécurité si les bonnes pratiques ne sont pas suivies.</p>
<h3>Les erreurs les plus courantes</h3>
<ul>
<li><strong>Actions tierces non pinnées</strong> — Utilisez toujours le hash du commit (<code>actions/checkout@8ade135</code>) plutôt que le tag (<code>@v4</code>) pour éviter les attaques de supply chain</li>
<li><strong>Secrets dans les logs</strong> — GitHub masque automatiquement les secrets, mais les valeurs dérivées (base64, substring) ne sont pas protégées</li>
<li><strong>pull_request_target mal utilisé</strong> — Ce trigger a accès aux secrets du repo cible, un PR malveillant peut les exfiltrer</li>
<li><strong>Permissions trop larges</strong> — Définissez toujours <code>permissions:</code> au niveau du job avec le minimum nécessaire</li>
</ul>
<h3>Template sécurisé recommandé</h3>
<p>Activez les <strong>Rulesets</strong> pour forcer la CI verte avant merge. Utilisez des <strong>environments</strong> avec approbation manuelle pour les déploiements production. Et configurez <strong>Dependabot</strong> pour maintenir vos actions à jour automatiquement.</p>
<p>Enfin, adoptez les <strong>attestations SLSA</strong> (Supply-chain Levels for Software Artifacts) pour signer vos artefacts de build — c\'est le futur de la supply chain security.</p>
</div>
<div data-lang="en">
<p>GitHub Actions has become the de facto standard for CI/CD in the GitHub ecosystem. But its flexibility can become a security pitfall if best practices are not followed.</p>
<h3>Most common mistakes</h3>
<ul>
<li><strong>Unpinned third-party actions</strong> — Always use the commit hash (<code>actions/checkout@8ade135</code>) rather than the tag (<code>@v4</code>) to prevent supply chain attacks</li>
<li><strong>Secrets in logs</strong> — GitHub automatically masks secrets, but derived values (base64, substring) are not protected</li>
<li><strong>Misused pull_request_target</strong> — This trigger has access to the target repo\'s secrets; a malicious PR can exfiltrate them</li>
<li><strong>Overly broad permissions</strong> — Always define <code>permissions:</code> at the job level with the minimum required</li>
</ul>
<h3>Recommended secure template</h3>
<p>Enable <strong>Rulesets</strong> to enforce green CI before merging. Use <strong>environments</strong> with manual approval for production deployments. And configure <strong>Dependabot</strong> to keep your actions up to date automatically.</p>
<p>Finally, adopt <strong>SLSA attestations</strong> (Supply-chain Levels for Software Artifacts) to sign your build artifacts — this is the future of supply chain security.</p>
</div>',
			'category' => 'veille',
			'tags'     => array( 'cicd', 'security', 'devops' ),
			'source'   => 'github.blog',
			'url'      => 'https://github.blog/security/',
			'date'     => '2025-03-10',
		),
		array(
			'title'    => 'Prometheus + Grafana : monitoring Kubernetes de A à Z',
			'title_en' => 'Prometheus + Grafana: Kubernetes Monitoring from A to Z',
			'title_fr' => 'Prometheus + Grafana : monitoring Kubernetes de A à Z',
			'title_es' => 'Prometheus + Grafana: Monitoreo de Kubernetes de la A a la Z',
			'excerpt_en' => 'The Prometheus/Grafana duo remains the reference for Kubernetes monitoring. USE and RED methods, smart alerting, and multi-cluster with Thanos or Mimir.',
			'excerpt_fr' => 'Le duo Prometheus/Grafana reste la référence pour le monitoring Kubernetes. Méthodes USE et RED, alerting intelligent, multi-cluster avec Thanos ou Mimir.',
			'excerpt_es' => 'El dúo Prometheus/Grafana sigue siendo la referencia para el monitoreo de Kubernetes. Métodos USE y RED, alertas inteligentes, multi-clúster con Thanos o Mimir.',
			'content'  => '<div data-lang="fr">
<p>Le duo Prometheus/Grafana reste la référence pour le monitoring des clusters Kubernetes. Avec le kube-prometheus-stack (anciennement prometheus-operator), le déploiement est simplifié via un seul Helm chart qui installe Prometheus, Grafana, Alertmanager, et les exporteurs essentiels.</p>
<h3>Métriques essentielles à surveiller</h3>
<ul>
<li><strong>USE Method</strong> — Utilization, Saturation, Errors pour chaque ressource (CPU, mémoire, réseau, disque)</li>
<li><strong>RED Method</strong> — Rate, Errors, Duration pour chaque service (latence P99, taux d\'erreur 5xx)</li>
<li><strong>Kubernetes-specific</strong> — Pod restart count, pending pods, node conditions, PVC usage</li>
</ul>
<h3>Alerting intelligent</h3>
<p>Évitez le piège des alertes excessives. Concentrez-vous sur les symptômes (latence utilisateur élevée) plutôt que les causes (CPU à 80%). Utilisez les <strong>recording rules</strong> pour pré-calculer les métriques complexes et réduire la charge sur Prometheus.</p>
<p>Pour les environnements multi-cluster, <strong>Thanos</strong> ou <strong>Mimir</strong> permettent d\'agréger les métriques avec du stockage long terme sur object storage (S3/GCS).</p>
</div>
<div data-lang="en">
<p>The Prometheus/Grafana duo remains the reference for Kubernetes cluster monitoring. With the kube-prometheus-stack (formerly prometheus-operator), deployment is simplified via a single Helm chart that installs Prometheus, Grafana, Alertmanager, and essential exporters.</p>
<h3>Essential metrics to monitor</h3>
<ul>
<li><strong>USE Method</strong> — Utilization, Saturation, Errors for each resource (CPU, memory, network, disk)</li>
<li><strong>RED Method</strong> — Rate, Errors, Duration for each service (P99 latency, 5xx error rate)</li>
<li><strong>Kubernetes-specific</strong> — Pod restart count, pending pods, node conditions, PVC usage</li>
</ul>
<h3>Smart alerting</h3>
<p>Avoid the trap of excessive alerts. Focus on symptoms (high user latency) rather than causes (CPU at 80%). Use <strong>recording rules</strong> to pre-compute complex metrics and reduce the load on Prometheus.</p>
<p>For multi-cluster environments, <strong>Thanos</strong> or <strong>Mimir</strong> allow aggregating metrics with long-term storage on object storage (S3/GCS).</p>
</div>',
			'category' => 'veille',
			'tags'     => array( 'kubernetes', 'devops', 'cloud' ),
			'source'   => 'prometheus.io',
			'url'      => 'https://prometheus.io/docs/introduction/overview/',
			'date'     => '2025-03-20',
		),

		/* ── Articles scientifiques — Mémoire M2 Cybersécurité & Cloud ── */

		array(
			'title'    => 'Architectures cloud-native et industrialisation : de la conteneurisation à l\'Infrastructure as Code',
			'content'  => '<div data-lang="fr">
<p><em>Article rédigé par <strong>Holali David GAVI</strong> dans le cadre du Master 2 Cybersécurité et Cloud.</em></p>

<h2>Résumé</h2>
<p>L\'adoption massive des architectures cloud-native transforme en profondeur les pratiques d\'ingénierie logicielle. Cet article examine l\'évolution des architectures applicatives depuis le monolithe jusqu\'aux microservices, analyse les mécanismes techniques de la conteneurisation (namespaces, cgroups, layer filesystem), étudie le modèle d\'orchestration déclaratif de Kubernetes, et évalue le rôle de Helm et de l\'Infrastructure as Code dans l\'industrialisation des déploiements. Une attention particulière est portée à l\'intégration de ces briques technologiques au sein de pipelines CI/CD et à l\'émergence du paradigme GitOps. L\'analyse s\'appuie sur la littérature académique et les retours d\'expérience industriels documentés par la CNCF.</p>

<h2>Introduction</h2>
<p>La transformation numérique des organisations impose une accélération sans précédent des cycles de livraison logicielle. Selon le rapport DORA — <em>Accelerate State of DevOps</em> (Forsgren et al., 2018), les organisations les plus performantes déploient en production plusieurs fois par jour, avec un délai de quelques minutes entre le commit et le déploiement. Cette vélocité n\'est atteignable qu\'à travers une industrialisation complète de la chaîne de production logicielle, de la compilation au déploiement en passant par la validation et la sécurisation.</p>
<p>Les architectures cloud-native, telles que définies par la Cloud Native Computing Foundation (CNCF, 2024), constituent le socle technique de cette industrialisation. Elles reposent sur quatre piliers : la conteneurisation, l\'orchestration dynamique, les microservices et l\'automatisation déclarative. Cet article propose une analyse structurée de chacun de ces piliers et de leur articulation au sein d\'une chaîne de livraison moderne.</p>

<h2>Évolution des architectures logicielles</h2>
<p>L\'architecture <strong>monolithique</strong> — une seule base de code, un seul artefact de déploiement, une seule base de données — a longtemps dominé le développement logiciel. Richardson (2018) la décrit comme « le point de départ naturel de tout projet », offrant une simplicité de développement et de débogage. Cependant, à mesure que l\'application grandit, le monolithe devient un frein : les cycles de déploiement s\'allongent, les régressions se multiplient, et la mise à l\'échelle ne peut se faire qu\'en dupliquant l\'ensemble de l\'application (scaling vertical).</p>
<p>Les <strong>architectures orientées services</strong> (SOA), apparues dans les années 2000, ont introduit la décomposition fonctionnelle. Toutefois, comme le soulignent Newman (2021) et Fowler (2014), la SOA souffrait d\'une complexité inhérente à l\'Enterprise Service Bus (ESB) et aux protocoles SOAP/WSDL, créant un couplage fort entre les services via un bus central — lui-même point de défaillance unique.</p>
<p>La rupture survient avec les <strong>microservices</strong>, popularisés à partir de 2012 par les retours d\'expérience de Netflix, Amazon et Spotify. Fowler et Lewis (2014) les définissent comme « un style architectural composé de petits services autonomes, communiquant via des mécanismes légers ». Chaque service possède sa propre base de données (pattern <em>Database per Service</em>), son propre cycle de vie et peut être déployé indépendamment. La méthodologie <strong>Twelve-Factor App</strong> (Wiggins, 2012) formalise les principes sous-jacents : configuration externalisée, processus stateless, disposabilité et parité dev/prod.</p>

<h2>Conteneurisation : fondements et bonnes pratiques</h2>
<p>La conteneurisation repose sur deux mécanismes du noyau Linux décrits par Merkel (2014) : les <strong>namespaces</strong> (isolation des processus, du réseau, du système de fichiers) et les <strong>cgroups</strong> (limitation des ressources CPU, mémoire, I/O). Contrairement à la virtualisation par hyperviseur, les conteneurs partagent le noyau hôte, offrant un ratio performance/isolation nettement supérieur.</p>
<p><strong>Docker</strong>, créé par Solomon Hykes en 2013, a démocratisé la conteneurisation grâce à deux innovations : le <strong>Dockerfile</strong> (description déclarative de la construction d\'une image) et le <strong>layer filesystem</strong> basé sur OverlayFS (partage et cache des couches entre images). Les bonnes pratiques documentées par Hightower et al. (2019) incluent le multi-stage build, l\'utilisation d\'images minimales (Alpine, Distroless), l\'exécution non-root et le scan de vulnérabilités (Trivy, Docker Scout).</p>
<p>L\'<strong>Open Container Initiative</strong> (OCI, 2015) a standardisé les formats d\'images et les runtimes, permettant l\'émergence d\'alternatives comme containerd, CRI-O et Podman. Depuis Kubernetes 1.24, le support direct de Docker (dockershim) a été retiré au profit de l\'interface CRI standardisée — une preuve de la maturité de cet écosystème.</p>

<h2>Orchestration Kubernetes : modèle déclaratif et auto-réparation</h2>
<p>Kubernetes (K8s), issu du système interne <strong>Borg</strong> de Google (Burns et al., 2016), implémente un modèle d\'<strong>état désiré</strong> (<em>desired state management</em>). L\'opérateur déclare l\'état souhaité en YAML ; les contrôleurs Kubernetes assurent en permanence la convergence de l\'état réel vers cet état désiré. Ce principe, emprunté à la théorie du contrôle automatique, garantit une auto-réparation (self-healing) : la perte d\'un Pod est automatiquement compensée par le ReplicaSet.</p>
<p>L\'architecture repose sur un <strong>control plane</strong> (kube-apiserver, etcd, kube-scheduler, controller-manager) et des <strong>worker nodes</strong> (kubelet, kube-proxy). La base de données etcd, utilisant l\'algorithme de consensus Raft (Ongaro & Ousterhout, 2014), assure la cohérence forte de l\'état du cluster. Les <strong>Custom Resource Definitions</strong> (CRD) et le pattern <strong>Operator</strong> (Dobies & Wood, 2022) permettent d\'étendre Kubernetes avec une logique opérationnelle codifiée — par exemple, un opérateur PostgreSQL automatisant les backups, le failover et les mises à jour de version.</p>

<h2>Helm et le packaging applicatif</h2>
<p>Un déploiement Kubernetes typique implique 10 à 20 manifests YAML interdépendants. <strong>Helm</strong>, gestionnaire de packages de Kubernetes, résout cette complexité via le concept de <strong>Chart</strong> : une collection de templates Go paramétrables (<code>values.yaml</code>) regroupant tous les manifests d\'une application. Un même Chart peut être instancié différemment selon l\'environnement (développement, staging, production) en surchargeant les valeurs.</p>
<p>Le mécanisme de <strong>releases versionnées</strong> permet des rollbacks instantanés (<code>helm rollback</code>), tandis que les <strong>hooks</strong> (pre-install, pre-upgrade) orchestrent les actions du cycle de vie, telles que les migrations de base de données. La tendance actuelle, notée par Sayfan (2021), est au stockage des Charts dans des registres OCI, unifiant la gestion des images et des Charts dans un même artefact.</p>

<h2>Infrastructure as Code et CI/CD</h2>
<p>L\'<strong>Infrastructure as Code</strong> (IaC) applique les pratiques du génie logiciel à la gestion de l\'infrastructure. Morris (2020) distingue l\'approche déclarative (Terraform, CloudFormation — on décrit l\'état final) de l\'approche impérative (Ansible, scripts — on décrit les étapes). Le <strong>state file</strong> de Terraform maintient la correspondance entre le code et les ressources cloud réelles, offrant une prévisibilité totale via le cycle <code>plan → apply</code>.</p>
<p>La <strong>CI/CD</strong>, théorisée par Humble et Farley (2010), automatise le cycle complet du commit au déploiement. Un pipeline moderne enchaîne : compilation, tests, analyse statique (SonarQube), build d\'image Docker, scan de sécurité (Trivy, Snyk), push vers un registre et déploiement via Helm ou GitOps. Le paradigme <strong>GitOps</strong>, où Git est la source unique de vérité synchronisée en continu par ArgoCD ou Flux, représente l\'aboutissement de cette industrialisation.</p>

<h2>Conclusion</h2>
<p>Les architectures cloud-native ne sont pas une simple évolution technologique mais un changement de paradigme dans la manière de concevoir, livrer et opérer les applications. La conteneurisation apporte la portabilité et la reproductibilité, Kubernetes fournit l\'orchestration déclarative et l\'auto-réparation, Helm standardise le packaging, et l\'IaC avec la CI/CD automatisent l\'ensemble de la chaîne. L\'enjeu pour les organisations n\'est plus d\'adopter ces technologies individuellement, mais de les intégrer dans une chaîne cohérente et sécurisée — ce que les parties suivantes de cette série examinent en détail.</p>

<h2>Références</h2>
<ul class="ref-list">
<li>Burns, B., Grant, B., Oppenheimer, D., Brewer, E. & Wilkes, J. (2016). « Borg, Omega, and Kubernetes ». <em>ACM Queue</em>, 14(1), 70-93.</li>
<li>CNCF (2024). <em>Cloud Native Survey 2024</em>. Cloud Native Computing Foundation.</li>
<li>Dobies, J. & Wood, J. (2022). <em>Kubernetes Operators</em>. O\'Reilly Media.</li>
<li>Forsgren, N., Humble, J. & Kim, G. (2018). <em>Accelerate: The Science of Lean Software and DevOps</em>. IT Revolution Press.</li>
<li>Fowler, M. & Lewis, J. (2014). « Microservices: a definition of this new architectural term ». martinfowler.com.</li>
<li>Hightower, K., Burns, B. & Beda, J. (2019). <em>Kubernetes: Up and Running</em>, 2nd Ed. O\'Reilly Media.</li>
<li>Humble, J. & Farley, D. (2010). <em>Continuous Delivery</em>. Addison-Wesley.</li>
<li>Merkel, D. (2014). « Docker: Lightweight Linux Containers for Consistent Development and Deployment ». <em>Linux Journal</em>, 2014(239).</li>
<li>Morris, K. (2020). <em>Infrastructure as Code</em>, 2nd Ed. O\'Reilly Media.</li>
<li>Newman, S. (2021). <em>Building Microservices</em>, 2nd Ed. O\'Reilly Media.</li>
<li>Ongaro, D. & Ousterhout, J. (2014). « In Search of an Understandable Consensus Algorithm ». <em>USENIX ATC \'14</em>.</li>
<li>Richardson, C. (2018). <em>Microservices Patterns</em>. Manning Publications.</li>
<li>Sayfan, G. (2021). <em>Mastering Kubernetes</em>, 3rd Ed. Packt Publishing.</li>
<li>Wiggins, A. (2012). « The Twelve-Factor App ». 12factor.net.</li>
</ul>
</div>
<div data-lang="en">
<p><em>Article written by <strong>Holali David GAVI</strong> as part of the Master 2 Cybersecurity and Cloud program.</em></p>

<h2>Abstract</h2>
<p>The massive adoption of cloud-native architectures is profoundly transforming software engineering practices. This article examines the evolution of application architectures from monoliths to microservices, analyzes the technical mechanisms of containerization (namespaces, cgroups, layer filesystem), studies the declarative orchestration model of Kubernetes, and evaluates the role of Helm and Infrastructure as Code in industrializing deployments. Particular attention is paid to integrating these technology building blocks within CI/CD pipelines and to the emergence of the GitOps paradigm. The analysis draws on academic literature and industrial experience documented by the CNCF.</p>

<h2>Introduction</h2>
<p>The digital transformation of organizations demands an unprecedented acceleration of software delivery cycles. According to the DORA report — <em>Accelerate State of DevOps</em> (Forsgren et al., 2018), the highest-performing organizations deploy to production multiple times a day, with a lead time of just minutes between commit and deployment. This velocity is only achievable through complete industrialization of the software production chain, from compilation to deployment through validation and security.</p>
<p>Cloud-native architectures, as defined by the Cloud Native Computing Foundation (CNCF, 2024), form the technical foundation of this industrialization. They rest on four pillars: containerization, dynamic orchestration, microservices, and declarative automation. This article offers a structured analysis of each pillar and how they articulate within a modern delivery pipeline.</p>

<h2>Evolution of software architectures</h2>
<p>The <strong>monolithic</strong> architecture — a single codebase, a single deployment artifact, a single database — long dominated software development. Richardson (2018) describes it as "the natural starting point for any project," offering simplicity in development and debugging. However, as the application grows, the monolith becomes a hindrance: deployment cycles lengthen, regressions multiply, and scaling can only be achieved by duplicating the entire application (vertical scaling).</p>
<p><strong>Service-oriented architectures</strong> (SOA), which emerged in the 2000s, introduced functional decomposition. However, as Newman (2021) and Fowler (2014) point out, SOA suffered from inherent complexity in the Enterprise Service Bus (ESB) and SOAP/WSDL protocols, creating tight coupling between services through a central bus — itself a single point of failure.</p>
<p>The breakthrough came with <strong>microservices</strong>, popularized from 2012 onward by experience reports from Netflix, Amazon, and Spotify. Fowler and Lewis (2014) define them as "an architectural style composed of small autonomous services communicating via lightweight mechanisms." Each service has its own database (the <em>Database per Service</em> pattern), its own lifecycle, and can be deployed independently. The <strong>Twelve-Factor App</strong> methodology (Wiggins, 2012) formalizes the underlying principles: externalized configuration, stateless processes, disposability, and dev/prod parity.</p>

<h2>Containerization: foundations and best practices</h2>
<p>Containerization relies on two Linux kernel mechanisms described by Merkel (2014): <strong>namespaces</strong> (process, network, and filesystem isolation) and <strong>cgroups</strong> (CPU, memory, and I/O resource limitation). Unlike hypervisor-based virtualization, containers share the host kernel, offering a significantly better performance-to-isolation ratio.</p>
<p><strong>Docker</strong>, created by Solomon Hykes in 2013, democratized containerization through two innovations: the <strong>Dockerfile</strong> (declarative description of image building) and the <strong>layer filesystem</strong> based on OverlayFS (sharing and caching layers between images). Best practices documented by Hightower et al. (2019) include multi-stage builds, using minimal images (Alpine, Distroless), non-root execution, and vulnerability scanning (Trivy, Docker Scout).</p>
<p>The <strong>Open Container Initiative</strong> (OCI, 2015) standardized image formats and runtimes, enabling alternatives like containerd, CRI-O, and Podman to emerge. Since Kubernetes 1.24, direct Docker support (dockershim) has been removed in favor of the standardized CRI interface — proof of this ecosystem\'s maturity.</p>

<h2>Kubernetes orchestration: declarative model and self-healing</h2>
<p>Kubernetes (K8s), derived from Google\'s internal <strong>Borg</strong> system (Burns et al., 2016), implements a <strong>desired state</strong> model (<em>desired state management</em>). The operator declares the desired state in YAML; Kubernetes controllers continuously ensure convergence of the actual state toward the desired state. This principle, borrowed from automatic control theory, guarantees self-healing: the loss of a Pod is automatically compensated by the ReplicaSet.</p>
<p>The architecture relies on a <strong>control plane</strong> (kube-apiserver, etcd, kube-scheduler, controller-manager) and <strong>worker nodes</strong> (kubelet, kube-proxy). The etcd database, using the Raft consensus algorithm (Ongaro & Ousterhout, 2014), ensures strong consistency of the cluster state. <strong>Custom Resource Definitions</strong> (CRDs) and the <strong>Operator</strong> pattern (Dobies & Wood, 2022) allow extending Kubernetes with codified operational logic — for example, a PostgreSQL operator automating backups, failover, and version upgrades.</p>

<h2>Helm and application packaging</h2>
<p>A typical Kubernetes deployment involves 10 to 20 interdependent YAML manifests. <strong>Helm</strong>, the Kubernetes package manager, solves this complexity through the <strong>Chart</strong> concept: a collection of parameterizable Go templates (<code>values.yaml</code>) bundling all manifests for an application. The same Chart can be instantiated differently per environment (development, staging, production) by overriding values.</p>
<p>The <strong>versioned releases</strong> mechanism enables instant rollbacks (<code>helm rollback</code>), while <strong>hooks</strong> (pre-install, pre-upgrade) orchestrate lifecycle actions such as database migrations. The current trend, noted by Sayfan (2021), is storing Charts in OCI registries, unifying image and Chart management in a single artifact.</p>

<h2>Infrastructure as Code and CI/CD</h2>
<p><strong>Infrastructure as Code</strong> (IaC) applies software engineering practices to infrastructure management. Morris (2020) distinguishes the declarative approach (Terraform, CloudFormation — describing the final state) from the imperative approach (Ansible, scripts — describing the steps). Terraform\'s <strong>state file</strong> maintains the mapping between code and actual cloud resources, offering total predictability through the <code>plan → apply</code> cycle.</p>
<p><strong>CI/CD</strong>, theorized by Humble and Farley (2010), automates the complete cycle from commit to deployment. A modern pipeline chains: compilation, tests, static analysis (SonarQube), Docker image build, security scanning (Trivy, Snyk), push to a registry, and deployment via Helm or GitOps. The <strong>GitOps</strong> paradigm, where Git is the single source of truth continuously synchronized by ArgoCD or Flux, represents the culmination of this industrialization.</p>

<h2>Conclusion</h2>
<p>Cloud-native architectures are not merely a technological evolution but a paradigm shift in how applications are designed, delivered, and operated. Containerization brings portability and reproducibility, Kubernetes provides declarative orchestration and self-healing, Helm standardizes packaging, and IaC with CI/CD automate the entire chain. The challenge for organizations is no longer adopting these technologies individually, but integrating them into a coherent and secure pipeline — which the following parts of this series examine in detail.</p>

<h2>References</h2>
<ul class="ref-list">
<li>Burns, B., Grant, B., Oppenheimer, D., Brewer, E. & Wilkes, J. (2016). "Borg, Omega, and Kubernetes." <em>ACM Queue</em>, 14(1), 70-93.</li>
<li>CNCF (2024). <em>Cloud Native Survey 2024</em>. Cloud Native Computing Foundation.</li>
<li>Dobies, J. & Wood, J. (2022). <em>Kubernetes Operators</em>. O\'Reilly Media.</li>
<li>Forsgren, N., Humble, J. & Kim, G. (2018). <em>Accelerate: The Science of Lean Software and DevOps</em>. IT Revolution Press.</li>
<li>Fowler, M. & Lewis, J. (2014). "Microservices: a definition of this new architectural term." martinfowler.com.</li>
<li>Hightower, K., Burns, B. & Beda, J. (2019). <em>Kubernetes: Up and Running</em>, 2nd Ed. O\'Reilly Media.</li>
<li>Humble, J. & Farley, D. (2010). <em>Continuous Delivery</em>. Addison-Wesley.</li>
<li>Merkel, D. (2014). "Docker: Lightweight Linux Containers for Consistent Development and Deployment." <em>Linux Journal</em>, 2014(239).</li>
<li>Morris, K. (2020). <em>Infrastructure as Code</em>, 2nd Ed. O\'Reilly Media.</li>
<li>Newman, S. (2021). <em>Building Microservices</em>, 2nd Ed. O\'Reilly Media.</li>
<li>Ongaro, D. & Ousterhout, J. (2014). "In Search of an Understandable Consensus Algorithm." <em>USENIX ATC \'14</em>.</li>
<li>Richardson, C. (2018). <em>Microservices Patterns</em>. Manning Publications.</li>
<li>Sayfan, G. (2021). <em>Mastering Kubernetes</em>, 3rd Ed. Packt Publishing.</li>
<li>Wiggins, A. (2012). "The Twelve-Factor App." 12factor.net.</li>
</ul>
</div>',
			'category' => 'blog',
			'tags'     => array( 'cloud-native', 'kubernetes', 'docker', 'devops', 'cicd', 'mémoire-m2' ),
			'date'     => '2025-03-15',
		),
		array(
			'title'    => 'Gestion de l\'état dans les systèmes distribués : sessions, tokens et cohérence',
			'content'  => '<div data-lang="fr">
<p><em>Article rédigé par <strong>Holali David GAVI</strong> dans le cadre du Master 2 Cybersécurité et Cloud.</em></p>

<h2>Résumé</h2>
<p>La gestion de l\'état constitue l\'un des défis majeurs des architectures distribuées. Cet article analyse les différentes stratégies — du maintien d\'état en mémoire locale (sticky sessions) à son externalisation (Redis, Memcached), en passant par les approches sans état serveur (JWT, SSO/OIDC). Il examine les implications de chaque stratégie sur la scalabilité horizontale, la résilience et la cohérence des données, en s\'appuyant sur les modèles théoriques (théorème CAP, cohérence éventuelle) et les patterns d\'architecture reconnus (CQRS, Event Sourcing, Circuit Breaker).</p>

<h2>Introduction</h2>
<p>Dans une architecture monolithique, la gestion de l\'état est triviale : la session utilisateur réside dans la mémoire du processus applicatif. Dès lors que l\'application est distribuée sur plusieurs instances, cette simplicity disparaît. Le choix entre maintenir l\'état localement, l\'externaliser vers un store partagé ou l\'éliminer entièrement via des tokens auto-portants détermine profondément la topologie du système, ses modes de défaillance et sa capacité à évoluer.</p>
<p>Kleppmann (2017), dans <em>Designing Data-Intensive Applications</em>, établit que toute décision sur la gestion de l\'état est un compromis entre cohérence, disponibilité et tolérance aux partitions. Cet article propose un cadre d\'analyse comparatif des stratégies existantes et de leurs impacts opérationnels.</p>

<h2>Stateful vs Stateless : implications architecturales</h2>
<p>Un service <strong>stateless</strong> ne conserve aucune information entre deux requêtes : chaque requête est auto-suffisante (Kleppmann, 2017). Ce modèle simplifie drastiquement le scaling horizontal — tout Pod Kubernetes peut traiter toute requête, et un HorizontalPodAutoscaler suffit à gérer l\'élasticité. La perte d\'un Pod n\'entraîne aucune perte de données utilisateur.</p>
<p>Un service <strong>stateful</strong> maintient un état interne (base de données, cache, file de messages). Dans Kubernetes, les <strong>StatefulSets</strong> répondent à ce besoin via des identités réseau stables, un stockage persistant par Pod et un déploiement ordonné (Burns, 2018). La <em>shared-nothing architecture</em> (Stonebraker, 1986), reprise par la méthodologie Twelve-Factor (Wiggins, 2012), préconise l\'externalisation de tout état vers des services dédiés pour maintenir les processus applicatifs stateless.</p>

<h2>Sticky sessions : fonctionnement et limites</h2>
<p>Les <strong>sticky sessions</strong> routent systématiquement les requêtes d\'un utilisateur vers la même instance backend, via un cookie injecté par le load balancer ou un hash de l\'adresse IP (Tanenbaum & Van Steen, 2017). Cette approche, bien que simple à implémenter, présente des limitations documentées par Burns et al. (2016) :</p>
<ul>
<li><strong>Répartition inégale</strong> — Certaines instances accumulent plus de sessions longues, créant des hotspots avec un déséquilibre pouvant atteindre un ratio 5:1.</li>
<li><strong>Perte de session au redémarrage</strong> — Un rolling update ou un crash détruit toutes les sessions rattachées au Pod.</li>
<li><strong>Incompatibilité avec l\'autoscaling</strong> — Le scale-down est risqué puisque la suppression d\'un Pod entraîne la perte des sessions qu\'il héberge.</li>
</ul>
<p>Kubernetes supporte l\'affinité de session (<code>sessionAffinity: ClientIP</code>), mais la documentation officielle la recommande uniquement comme solution transitoire (Kubernetes Documentation, 2024).</p>

<h2>Externalisation de session</h2>
<p>L\'externalisation déplace l\'état de session vers un datastore partagé, conformément au pattern <em>Externalized Session State</em> (Fowler, 2002). Les solutions principales sont :</p>
<ul>
<li><strong>Redis</strong> — Store clé-valeur en mémoire avec TTL natif. Latence sub-milliseconde, réplication via Redis Sentinel ou Redis Cluster (Carlson, 2013). C\'est la solution la plus répandue dans l\'écosystème Kubernetes (chart Bitnami).</li>
<li><strong>Memcached</strong> — Cache distribué en mémoire pure, sans persistance. Plus simple que Redis mais sans réplication native.</li>
<li><strong>RDBMS</strong> — PostgreSQL/MySQL avec table de sessions indexée. Cohérence ACID mais latence supérieure. Spring Session (Pivotal, 2023) fournit une abstraction transparente.</li>
</ul>
<p>Avec Redis comme backend, les Pods applicatifs deviennent interchangeables : un rolling update ne provoque aucune perte de session utilisateur.</p>

<h2>Authentification sans état : JWT, CAS, SSO</h2>
<p>Les <strong>JSON Web Tokens</strong> (RFC 7519, Jones et al., 2015) sont des jetons autoportants contenant les claims d\'identité, signés cryptographiquement. Le serveur valide le token localement sans consulter une base de données — un avantage majeur pour les microservices. Toutefois, McLean (2023) documente le défi de la révocation : un JWT reste valide jusqu\'à expiration. La combinaison access token (15 min) + refresh token (httpOnly cookie) atténue ce risque.</p>
<p>Le <strong>CAS</strong> (Central Authentication Service), développé à Yale, centralise l\'authentification via des Service Tickets validés serveur-à-serveur (Aubry et al., 2004). Les protocoles modernes de <strong>SSO</strong> — <strong>OpenID Connect</strong> (couche d\'identité sur OAuth 2.0) et <strong>SAML 2.0</strong> (Hughes et al., 2005) — sont implémentés par des IdP comme Keycloak, Auth0 et Azure AD. Dans Kubernetes, l\'API server supporte nativement OIDC pour l\'authentification des utilisateurs.</p>

<h2>Approches hybrides et patterns d\'architecture</h2>
<p>Les systèmes complexes combinent plusieurs stratégies. Le pattern <strong>API Gateway</strong> (Richardson, 2018) centralise la validation JWT et le rate limiting, tandis que les microservices communiquent de manière stateless en interne. Un pattern courant est le <strong>cache hiérarchique</strong> : cache in-process (Caffeine, ~ns) → cache distribué (Redis, ~ms) → base de données (~10ms).</p>
<p>Le pattern <strong>CQRS</strong> (Young, 2010) sépare les modèles de lecture et d\'écriture, permettant une optimisation indépendante de chaque chemin. Combiné à l\'<strong>Event Sourcing</strong> (Betts et al., 2013), il offre un audit trail naturel et la possibilité de reconstruire l\'état complet du système. <strong>Apache Kafka</strong>, comme log distribué immuable, sert de colonne vertébrale événementielle : Narkhede et al. (2017) argumentent que synchroniser des événements plutôt que des états résout élégamment le problème de cohérence inter-services.</p>

<h2>Impacts sur scalabilité et résilience</h2>
<p>Le <strong>théorème CAP</strong> (Brewer, 2000 ; Gilbert & Lynch, 2002) établit qu\'un système distribué ne peut garantir simultanément cohérence, disponibilité et tolérance aux partitions. Les services stateless maximisent la disponibilité ; les services stateful doivent choisir : CP (etcd, ZooKeeper) ou AP (Cassandra, DynamoDB). La <strong>cohérence éventuelle</strong> (Vogels, 2009) constitue un compromis pragmatique pour de nombreux cas d\'usage.</p>
<p>Nygard (2018) identifie les patterns de résilience essentiels pour les systèmes distribués avec état :</p>
<ul>
<li><strong>Circuit Breaker</strong> — Coupe les appels vers un service défaillant pour éviter les pannes en cascade (implémenté par Resilience4j, Istio).</li>
<li><strong>Bulkhead</strong> — Isole les composants pour limiter le blast radius. En Kubernetes, les Resource Quotas et LimitRanges matérialisent ce pattern.</li>
<li><strong>Retry avec backoff exponentiel</strong> — Évite la surcharge d\'un service en cours de récupération.</li>
</ul>
<p>Pour les services stateful, la résilience passe par la réplication (synchrone ou asynchrone) et le failover automatique. Le <strong>RPO</strong> (Recovery Point Objective) et le <strong>RTO</strong> (Recovery Time Objective) guident le choix entre réplication synchrone (RPO=0, latence élevée) et asynchrone (RPO>0, performance optimale).</p>

<h2>Conclusion</h2>
<p>Le choix d\'une stratégie de gestion de l\'état ne se réduit pas à une décision technique isolée : il structure fondamentalement l\'architecture du système, ses modes de défaillance et son coût opérationnel. La tendance dominante — services applicatifs stateless avec externalisation de l\'état vers des stores spécialisés — offre le meilleur compromis entre scalabilité et maintenabilité. Cependant, chaque contexte impose ses contraintes (latence, cohérence, régulation), et les approches hybrides restent la norme dans les systèmes réels.</p>

<h2>Références</h2>
<ul class="ref-list">
<li>Aubry, S., Mazurier, J. & Mishra, P. (2004). « CAS: a Central Authentication Service ». Yale University ITS.</li>
<li>Betts, D. et al. (2013). <em>Exploring CQRS and Event Sourcing</em>. Microsoft Patterns & Practices.</li>
<li>Brewer, E. (2000). « Towards Robust Distributed Systems ». <em>ACM PODC Keynote</em>.</li>
<li>Burns, B. (2018). <em>Designing Distributed Systems</em>. O\'Reilly Media.</li>
<li>Burns, B. et al. (2016). « Borg, Omega, and Kubernetes ». <em>ACM Queue</em>, 14(1).</li>
<li>Carlson, J. (2013). <em>Redis in Action</em>. Manning Publications.</li>
<li>Fowler, M. (2002). <em>Patterns of Enterprise Application Architecture</em>. Addison-Wesley.</li>
<li>Gilbert, S. & Lynch, N. (2002). « Brewer\'s Conjecture ». <em>ACM SIGACT News</em>, 33(2).</li>
<li>Hughes, J. et al. (2005). « SAML 2.0 Technical Overview ». OASIS.</li>
<li>Jones, M. et al. (2015). « JSON Web Token (JWT) ». RFC 7519, IETF.</li>
<li>Kleppmann, M. (2017). <em>Designing Data-Intensive Applications</em>. O\'Reilly Media.</li>
<li>McLean, T. (2023). « Critical vulnerabilities in JSON Web Token libraries ». auth0.com.</li>
<li>Narkhede, N. et al. (2017). <em>Kafka: The Definitive Guide</em>. O\'Reilly Media.</li>
<li>Nygard, M. (2018). <em>Release It!</em>, 2nd Ed. Pragmatic Bookshelf.</li>
<li>Richardson, C. (2018). <em>Microservices Patterns</em>. Manning Publications.</li>
<li>Stonebraker, M. (1986). « The Case for Shared Nothing ». <em>IEEE Database Engineering Bulletin</em>.</li>
<li>Tanenbaum, A. & Van Steen, M. (2017). <em>Distributed Systems</em>, 3rd Ed. Pearson.</li>
<li>Vogels, W. (2009). « Eventually Consistent ». <em>Communications of the ACM</em>, 52(1).</li>
<li>Young, G. (2010). « CQRS Documents ». cqrs.files.wordpress.com.</li>
</ul>
</div>
<div data-lang="en">
<p><em>Article written by <strong>Holali David GAVI</strong> as part of the Master 2 Cybersecurity and Cloud program.</em></p>

<h2>Abstract</h2>
<p>State management is one of the major challenges of distributed architectures. This article analyzes the different strategies — from maintaining state in local memory (sticky sessions) to externalizing it (Redis, Memcached), through stateless server approaches (JWT, SSO/OIDC). It examines the implications of each strategy on horizontal scalability, resilience, and data consistency, drawing on theoretical models (CAP theorem, eventual consistency) and recognized architecture patterns (CQRS, Event Sourcing, Circuit Breaker).</p>

<h2>Introduction</h2>
<p>In a monolithic architecture, state management is trivial: the user session resides in the application process memory. Once the application is distributed across multiple instances, this simplicity disappears. The choice between maintaining state locally, externalizing it to a shared store, or eliminating it entirely via self-contained tokens profoundly determines the system\'s topology, its failure modes, and its ability to evolve.</p>
<p>Kleppmann (2017), in <em>Designing Data-Intensive Applications</em>, establishes that every decision about state management is a trade-off between consistency, availability, and partition tolerance. This article proposes a comparative analytical framework of existing strategies and their operational impacts.</p>

<h2>Stateful vs Stateless: architectural implications</h2>
<p>A <strong>stateless</strong> service retains no information between two requests: each request is self-sufficient (Kleppmann, 2017). This model drastically simplifies horizontal scaling — any Kubernetes Pod can handle any request, and a HorizontalPodAutoscaler is sufficient to manage elasticity. The loss of a Pod causes no user data loss.</p>
<p>A <strong>stateful</strong> service maintains internal state (database, cache, message queue). In Kubernetes, <strong>StatefulSets</strong> address this need with stable network identities, per-Pod persistent storage, and ordered deployment (Burns, 2018). The <em>shared-nothing architecture</em> (Stonebraker, 1986), adopted by the Twelve-Factor methodology (Wiggins, 2012), advocates externalizing all state to dedicated services to keep application processes stateless.</p>

<h2>Sticky sessions: how they work and their limitations</h2>
<p><strong>Sticky sessions</strong> consistently route a user\'s requests to the same backend instance, via a cookie injected by the load balancer or an IP address hash (Tanenbaum & Van Steen, 2017). This approach, while simple to implement, has limitations documented by Burns et al. (2016):</p>
<ul>
<li><strong>Uneven distribution</strong> — Some instances accumulate more long-lived sessions, creating hotspots with imbalances that can reach a 5:1 ratio.</li>
<li><strong>Session loss on restart</strong> — A rolling update or crash destroys all sessions attached to the Pod.</li>
<li><strong>Incompatibility with autoscaling</strong> — Scale-down is risky since removing a Pod causes the loss of the sessions it hosts.</li>
</ul>
<p>Kubernetes supports session affinity (<code>sessionAffinity: ClientIP</code>), but the official documentation recommends it only as a transitional solution (Kubernetes Documentation, 2024).</p>

<h2>Session externalization</h2>
<p>Externalization moves session state to a shared datastore, in accordance with the <em>Externalized Session State</em> pattern (Fowler, 2002). The main solutions are:</p>
<ul>
<li><strong>Redis</strong> — In-memory key-value store with native TTL. Sub-millisecond latency, replication via Redis Sentinel or Redis Cluster (Carlson, 2013). It is the most widely used solution in the Kubernetes ecosystem (Bitnami chart).</li>
<li><strong>Memcached</strong> — Pure in-memory distributed cache, without persistence. Simpler than Redis but without native replication.</li>
<li><strong>RDBMS</strong> — PostgreSQL/MySQL with an indexed sessions table. ACID consistency but higher latency. Spring Session (Pivotal, 2023) provides a transparent abstraction.</li>
</ul>
<p>With Redis as a backend, application Pods become interchangeable: a rolling update causes no user session loss.</p>

<h2>Stateless authentication: JWT, CAS, SSO</h2>
<p><strong>JSON Web Tokens</strong> (RFC 7519, Jones et al., 2015) are self-contained tokens carrying identity claims, cryptographically signed. The server validates the token locally without querying a database — a major advantage for microservices. However, McLean (2023) documents the revocation challenge: a JWT remains valid until expiration. The combination of access token (15 min) + refresh token (httpOnly cookie) mitigates this risk.</p>
<p><strong>CAS</strong> (Central Authentication Service), developed at Yale, centralizes authentication via Service Tickets validated server-to-server (Aubry et al., 2004). Modern <strong>SSO</strong> protocols — <strong>OpenID Connect</strong> (identity layer on OAuth 2.0) and <strong>SAML 2.0</strong> (Hughes et al., 2005) — are implemented by IdPs like Keycloak, Auth0, and Azure AD. In Kubernetes, the API server natively supports OIDC for user authentication.</p>

<h2>Hybrid approaches and architecture patterns</h2>
<p>Complex systems combine multiple strategies. The <strong>API Gateway</strong> pattern (Richardson, 2018) centralizes JWT validation and rate limiting, while microservices communicate statelessly internally. A common pattern is the <strong>hierarchical cache</strong>: in-process cache (Caffeine, ~ns) → distributed cache (Redis, ~ms) → database (~10ms).</p>
<p>The <strong>CQRS</strong> pattern (Young, 2010) separates read and write models, allowing independent optimization of each path. Combined with <strong>Event Sourcing</strong> (Betts et al., 2013), it offers a natural audit trail and the ability to reconstruct the system\'s complete state. <strong>Apache Kafka</strong>, as an immutable distributed log, serves as the event backbone: Narkhede et al. (2017) argue that synchronizing events rather than states elegantly solves the inter-service consistency problem.</p>

<h2>Impact on scalability and resilience</h2>
<p>The <strong>CAP theorem</strong> (Brewer, 2000; Gilbert & Lynch, 2002) establishes that a distributed system cannot simultaneously guarantee consistency, availability, and partition tolerance. Stateless services maximize availability; stateful services must choose: CP (etcd, ZooKeeper) or AP (Cassandra, DynamoDB). <strong>Eventual consistency</strong> (Vogels, 2009) is a pragmatic compromise for many use cases.</p>
<p>Nygard (2018) identifies essential resilience patterns for distributed stateful systems:</p>
<ul>
<li><strong>Circuit Breaker</strong> — Cuts calls to a failing service to prevent cascading failures (implemented by Resilience4j, Istio).</li>
<li><strong>Bulkhead</strong> — Isolates components to limit the blast radius. In Kubernetes, Resource Quotas and LimitRanges materialize this pattern.</li>
<li><strong>Retry with exponential backoff</strong> — Prevents overloading a service that is recovering.</li>
</ul>
<p>For stateful services, resilience relies on replication (synchronous or asynchronous) and automatic failover. <strong>RPO</strong> (Recovery Point Objective) and <strong>RTO</strong> (Recovery Time Objective) guide the choice between synchronous replication (RPO=0, high latency) and asynchronous replication (RPO>0, optimal performance).</p>

<h2>Conclusion</h2>
<p>Choosing a state management strategy is not just an isolated technical decision: it fundamentally structures the system\'s architecture, its failure modes, and its operational cost. The dominant trend — stateless application services with state externalized to specialized stores — offers the best trade-off between scalability and maintainability. However, each context imposes its constraints (latency, consistency, regulation), and hybrid approaches remain the norm in real-world systems.</p>

<h2>References</h2>
<ul class="ref-list">
<li>Aubry, S., Mazurier, J. & Mishra, P. (2004). "CAS: a Central Authentication Service." Yale University ITS.</li>
<li>Betts, D. et al. (2013). <em>Exploring CQRS and Event Sourcing</em>. Microsoft Patterns & Practices.</li>
<li>Brewer, E. (2000). "Towards Robust Distributed Systems." <em>ACM PODC Keynote</em>.</li>
<li>Burns, B. (2018). <em>Designing Distributed Systems</em>. O\'Reilly Media.</li>
<li>Burns, B. et al. (2016). "Borg, Omega, and Kubernetes." <em>ACM Queue</em>, 14(1).</li>
<li>Carlson, J. (2013). <em>Redis in Action</em>. Manning Publications.</li>
<li>Fowler, M. (2002). <em>Patterns of Enterprise Application Architecture</em>. Addison-Wesley.</li>
<li>Gilbert, S. & Lynch, N. (2002). "Brewer\'s Conjecture." <em>ACM SIGACT News</em>, 33(2).</li>
<li>Hughes, J. et al. (2005). "SAML 2.0 Technical Overview." OASIS.</li>
<li>Jones, M. et al. (2015). "JSON Web Token (JWT)." RFC 7519, IETF.</li>
<li>Kleppmann, M. (2017). <em>Designing Data-Intensive Applications</em>. O\'Reilly Media.</li>
<li>McLean, T. (2023). "Critical vulnerabilities in JSON Web Token libraries." auth0.com.</li>
<li>Narkhede, N. et al. (2017). <em>Kafka: The Definitive Guide</em>. O\'Reilly Media.</li>
<li>Nygard, M. (2018). <em>Release It!</em>, 2nd Ed. Pragmatic Bookshelf.</li>
<li>Richardson, C. (2018). <em>Microservices Patterns</em>. Manning Publications.</li>
<li>Stonebraker, M. (1986). "The Case for Shared Nothing." <em>IEEE Database Engineering Bulletin</em>.</li>
<li>Tanenbaum, A. & Van Steen, M. (2017). <em>Distributed Systems</em>, 3rd Ed. Pearson.</li>
<li>Vogels, W. (2009). "Eventually Consistent." <em>Communications of the ACM</em>, 52(1).</li>
<li>Young, G. (2010). "CQRS Documents." cqrs.files.wordpress.com.</li>
</ul>
</div>',
			'category' => 'blog',
			'tags'     => array( 'distributed-systems', 'cloud', 'security', 'architecture', 'mémoire-m2' ),
			'date'     => '2025-03-17',
		),
		array(
			'title'    => 'Résilience, stratégies d\'upgrade et gouvernance des déploiements cloud-native',
			'content'  => '<div data-lang="fr">
<p><em>Article rédigé par <strong>Holali David GAVI</strong> dans le cadre du Master 2 Cybersécurité et Cloud.</em></p>

<h2>Résumé</h2>
<p>Le déploiement continu d\'applications distribuées exige des stratégies de mise à jour qui garantissent la continuité de service, la capacité de rollback et la traçabilité des changements. Cet article compare les stratégies de déploiement (rolling update, blue/green, canary), analyse les défis spécifiques de la migration de bases de données et de la gestion des dépendances inter-services, et examine les mécanismes de rollback et d\'observabilité nécessaires à une gouvernance opérationnelle rigoureuse.</p>

<h2>Introduction</h2>
<p>Déployer une nouvelle version d\'un service dans un environnement distribué n\'est jamais anodin. Beyer et al. (2016), dans le <em>Site Reliability Engineering</em> de Google, établissent que « la majorité des incidents de production sont causés par des changements » — déploiements, modifications de configuration, migrations de données. La capacité à déployer fréquemment tout en minimisant le risque est un marqueur de maturité organisationnelle (Forsgren et al., 2018). Cet article analyse les stratégies et les mécanismes qui rendent cela possible.</p>

<h2>Rolling updates : déploiement progressif natif</h2>
<p>Le <strong>rolling update</strong> est la stratégie par défaut dans Kubernetes. Il remplace progressivement les anciens Pods par les nouveaux via deux paramètres : <code>maxUnavailable</code> (nombre maximum de Pods indisponibles) et <code>maxSurge</code> (nombre maximum de Pods supplémentaires). Les <strong>readiness probes</strong> garantissent qu\'un nouveau Pod ne reçoit du trafic qu\'une fois opérationnel (Hightower et al., 2019).</p>
<p>Le <strong>graceful shutdown</strong> est critique : à la réception du signal SIGTERM, le Pod doit drainer les requêtes en cours avant de s\'arrêter. Le <code>terminationGracePeriodSeconds</code> et les hooks <code>preStop</code> orchestrent cette séquence (Luksa, 2018). Les <strong>PodDisruptionBudgets</strong> (PDB) ajoutent une couche de protection en garantissant un nombre minimum de Pods disponibles lors des opérations de maintenance.</p>

<h2>Blue/Green et Canary : contrôle avancé du trafic</h2>
<p>Le <strong>blue/green deployment</strong> maintient deux environnements identiques et bascule le trafic instantanément (Humble & Farley, 2010). Dans Kubernetes, cela se réalise via la manipulation des selectors de Service. L\'inconvénient principal est le coût : deux environnements complets coexistent temporairement.</p>
<p>Le <strong>canary deployment</strong> expose progressivement la nouvelle version à un sous-ensemble d\'utilisateurs (1%, 5%, 25%...). Les service mesh comme <strong>Istio</strong> permettent un routage granulaire via les VirtualServices (Posta & Maloku, 2022). <strong>Argo Rollouts</strong> et <strong>Flagger</strong> automatisent le processus en analysant les métriques Prometheus (taux d\'erreur, latence P99) pour décider d\'augmenter le trafic ou de rollback automatiquement — ce que Prodan (2023) qualifie de « progressive delivery ».</p>

<h2>Migration de bases de données sans downtime</h2>
<p>La migration de schéma en déploiement continu est l\'un des défis les plus complexes de l\'ingénierie logicielle. Sadalage et Fowler (2012) formalisent le pattern <strong>Expand and Contract</strong> : (1) ajout de la nouvelle structure sans supprimer l\'ancienne, (2) migration des données existantes, (3) suppression de l\'ancienne structure une fois le rollback vers la version précédente inutile.</p>
<p>Les outils de migration (Flyway, Liquibase, Alembic) gèrent les scripts versionnés et le suivi de leur exécution. Dans Kubernetes, les migrations sont typiquement exécutées via des <strong>Helm hooks pre-upgrade</strong> ou des <strong>Init Containers</strong>. Kleppmann (2017) insiste sur la nécessité de séparer les migrations de schéma du déploiement applicatif pour éviter les situations de blocage.</p>

<h2>Gestion des dépendances multi-services</h2>
<p>Newman (2021) identifie la gestion des dépendances inter-services comme « le problème fondamental des architectures distribuées ». Les dépendances se manifestent à trois niveaux : déploiement (versioning d\'API), runtime (Circuit Breaker, Timeout, Fallback — Nygard, 2018) et données (Bounded Contexts du Domain-Driven Design — Evans, 2003).</p>
<p>Le <strong>Consumer-Driven Contract Testing</strong> (Pact) vérifie automatiquement la compatibilité entre producteur et consommateur à chaque commit. Pour l\'orchestration des déploiements, ArgoCD propose les <strong>Sync Waves</strong> : déploiement séquentiel par priorité (bases de données → services backend → API gateways → frontends).</p>

<h2>Patterns de rollback</h2>
<p>Beyer et al. (2016) affirment que « la capacité de rollback rapidement est plus importante que la capacité de déployer rapidement ». Kubernetes offre un rollback natif via <code>kubectl rollout undo</code>, basé sur l\'historique des ReplicaSets. Helm encapsule le rollback au niveau des releases. En <strong>GitOps</strong>, un rollback est un simple <code>git revert</code> — auditable et reproductible.</p>
<p>Pour les <strong>rollbacks de données</strong>, la complexité augmente considérablement. Les stratégies incluent les snapshots pré-migration (Volume Snapshot CSI), les migrations réversibles (scripts up/down), et l\'Event Sourcing qui permet de « rejouer » l\'historique jusqu\'à un point antérieur (Betts et al., 2013).</p>

<h2>Observabilité et monitoring</h2>
<p>L\'<strong>observabilité</strong>, concept emprunté à la théorie du contrôle (Kalman, 1960), repose sur trois piliers selon Majors et al. (2022) :</p>
<ul>
<li><strong>Métriques</strong> — Prometheus (CNCF) avec la méthodologie RED (Rate, Errors, Duration) pour les services et USE (Utilization, Saturation, Errors) pour les ressources (Gregg, 2020). Les SLIs, SLOs et SLAs structurent le lien entre observabilité et objectifs métier.</li>
<li><strong>Logs</strong> — Stack EFK (Elasticsearch, Fluent Bit, Kibana) ou Loki + Grafana. Loki n\'indexe que les labels, réduisant les coûts par rapport à Elasticsearch.</li>
<li><strong>Traces distribuées</strong> — OpenTelemetry (CNCF) fournit un SDK unifié. Jaeger, Zipkin ou Tempo stockent et visualisent les traces. Le trace ID propagé via le header W3C <code>traceparent</code> permet de suivre une requête à travers tous les services.</li>
</ul>
<p>La convergence des trois piliers (Grafana unifié avec Mimir, Loki, Tempo) réduit le <strong>MTTR</strong> (Mean Time To Resolution). En matière de gouvernance, les <strong>blameless postmortems</strong> (Beyer et al., 2016) analysent les causes systémiques des incidents pour produire des améliorations concrètes.</p>

<h2>Conclusion</h2>
<p>La résilience des déploiements cloud-native repose sur un triptyque : des stratégies de déploiement adaptées au niveau de risque (rolling update pour les changements courants, canary pour les changements majeurs), des mécanismes de rollback éprouvés et testés régulièrement, et une observabilité complète permettant de détecter et diagnostiquer rapidement toute dégradation. La gouvernance opérationnelle, soutenue par l\'audit trail de GitOps et la culture des postmortems, transforme chaque incident en opportunité d\'amélioration.</p>

<h2>Références</h2>
<ul class="ref-list">
<li>Betts, D. et al. (2013). <em>Exploring CQRS and Event Sourcing</em>. Microsoft Patterns & Practices.</li>
<li>Beyer, B. et al. (2016). <em>Site Reliability Engineering</em>. O\'Reilly Media / Google.</li>
<li>Evans, E. (2003). <em>Domain-Driven Design</em>. Addison-Wesley.</li>
<li>Forsgren, N. et al. (2018). <em>Accelerate</em>. IT Revolution Press.</li>
<li>Gregg, B. (2020). <em>Systems Performance</em>, 2nd Ed. Addison-Wesley.</li>
<li>Hightower, K. et al. (2019). <em>Kubernetes: Up and Running</em>, 2nd Ed. O\'Reilly.</li>
<li>Humble, J. & Farley, D. (2010). <em>Continuous Delivery</em>. Addison-Wesley.</li>
<li>Kalman, R. E. (1960). « On the General Theory of Control Systems ». <em>IFAC Proceedings</em>.</li>
<li>Kleppmann, M. (2017). <em>Designing Data-Intensive Applications</em>. O\'Reilly Media.</li>
<li>Luksa, M. (2018). <em>Kubernetes in Action</em>. Manning Publications.</li>
<li>Majors, C. et al. (2022). <em>Observability Engineering</em>. O\'Reilly Media.</li>
<li>Newman, S. (2021). <em>Building Microservices</em>, 2nd Ed. O\'Reilly Media.</li>
<li>Nygard, M. (2018). <em>Release It!</em>, 2nd Ed. Pragmatic Bookshelf.</li>
<li>Posta, C. & Maloku, R. (2022). <em>Istio in Action</em>. Manning Publications.</li>
<li>Prodan, S. (2023). « Progressive Delivery with Flagger ». flagger.app.</li>
<li>Sadalage, P. & Fowler, M. (2012). <em>Refactoring Databases</em>. Addison-Wesley.</li>
</ul>
</div>
<div data-lang="en">
<p><em>Article written by <strong>Holali David GAVI</strong> as part of the Master 2 Cybersecurity and Cloud program.</em></p>

<h2>Abstract</h2>
<p>Continuous deployment of distributed applications requires update strategies that guarantee service continuity, rollback capability, and change traceability. This article compares deployment strategies (rolling update, blue/green, canary), analyzes the specific challenges of database migration and inter-service dependency management, and examines the rollback and observability mechanisms necessary for rigorous operational governance.</p>

<h2>Introduction</h2>
<p>Deploying a new version of a service in a distributed environment is never trivial. Beyer et al. (2016), in Google\'s <em>Site Reliability Engineering</em>, establish that "the majority of production incidents are caused by changes" — deployments, configuration modifications, data migrations. The ability to deploy frequently while minimizing risk is a marker of organizational maturity (Forsgren et al., 2018). This article analyzes the strategies and mechanisms that make this possible.</p>

<h2>Rolling updates: native progressive deployment</h2>
<p>The <strong>rolling update</strong> is the default strategy in Kubernetes. It progressively replaces old Pods with new ones via two parameters: <code>maxUnavailable</code> (maximum number of unavailable Pods) and <code>maxSurge</code> (maximum number of extra Pods). <strong>Readiness probes</strong> ensure that a new Pod only receives traffic once it is operational (Hightower et al., 2019).</p>
<p><strong>Graceful shutdown</strong> is critical: upon receiving the SIGTERM signal, the Pod must drain in-flight requests before stopping. The <code>terminationGracePeriodSeconds</code> and <code>preStop</code> hooks orchestrate this sequence (Luksa, 2018). <strong>PodDisruptionBudgets</strong> (PDB) add a layer of protection by guaranteeing a minimum number of available Pods during maintenance operations.</p>

<h2>Blue/Green and Canary: advanced traffic control</h2>
<p>The <strong>blue/green deployment</strong> maintains two identical environments and switches traffic instantly (Humble & Farley, 2010). In Kubernetes, this is achieved by manipulating Service selectors. The main drawback is cost: two complete environments coexist temporarily.</p>
<p>The <strong>canary deployment</strong> progressively exposes the new version to a subset of users (1%, 5%, 25%...). Service meshes like <strong>Istio</strong> enable granular routing via VirtualServices (Posta & Maloku, 2022). <strong>Argo Rollouts</strong> and <strong>Flagger</strong> automate the process by analyzing Prometheus metrics (error rate, P99 latency) to decide whether to increase traffic or rollback automatically — what Prodan (2023) calls "progressive delivery."</p>

<h2>Zero-downtime database migration</h2>
<p>Schema migration in continuous deployment is one of the most complex challenges in software engineering. Sadalage and Fowler (2012) formalize the <strong>Expand and Contract</strong> pattern: (1) add the new structure without removing the old one, (2) migrate existing data, (3) remove the old structure once rollback to the previous version is no longer needed.</p>
<p>Migration tools (Flyway, Liquibase, Alembic) manage versioned scripts and track their execution. In Kubernetes, migrations are typically executed via <strong>Helm pre-upgrade hooks</strong> or <strong>Init Containers</strong>. Kleppmann (2017) emphasizes the need to separate schema migrations from application deployment to avoid deadlock situations.</p>

<h2>Multi-service dependency management</h2>
<p>Newman (2021) identifies inter-service dependency management as "the fundamental problem of distributed architectures." Dependencies manifest at three levels: deployment (API versioning), runtime (Circuit Breaker, Timeout, Fallback — Nygard, 2018), and data (Bounded Contexts from Domain-Driven Design — Evans, 2003).</p>
<p><strong>Consumer-Driven Contract Testing</strong> (Pact) automatically verifies compatibility between producer and consumer at each commit. For deployment orchestration, ArgoCD offers <strong>Sync Waves</strong>: sequential deployment by priority (databases → backend services → API gateways → frontends).</p>

<h2>Rollback patterns</h2>
<p>Beyer et al. (2016) assert that "the ability to rollback quickly is more important than the ability to deploy quickly." Kubernetes offers native rollback via <code>kubectl rollout undo</code>, based on ReplicaSet history. Helm encapsulates rollback at the release level. In <strong>GitOps</strong>, a rollback is a simple <code>git revert</code> — auditable and reproducible.</p>
<p>For <strong>data rollbacks</strong>, complexity increases considerably. Strategies include pre-migration snapshots (Volume Snapshot CSI), reversible migrations (up/down scripts), and Event Sourcing which allows "replaying" history to a previous point (Betts et al., 2013).</p>

<h2>Observability and monitoring</h2>
<p><strong>Observability</strong>, a concept borrowed from control theory (Kalman, 1960), rests on three pillars according to Majors et al. (2022):</p>
<ul>
<li><strong>Metrics</strong> — Prometheus (CNCF) with the RED methodology (Rate, Errors, Duration) for services and USE (Utilization, Saturation, Errors) for resources (Gregg, 2020). SLIs, SLOs, and SLAs structure the link between observability and business objectives.</li>
<li><strong>Logs</strong> — EFK stack (Elasticsearch, Fluent Bit, Kibana) or Loki + Grafana. Loki indexes only labels, reducing costs compared to Elasticsearch.</li>
<li><strong>Distributed traces</strong> — OpenTelemetry (CNCF) provides a unified SDK. Jaeger, Zipkin, or Tempo store and visualize traces. The trace ID propagated via the W3C <code>traceparent</code> header allows following a request across all services.</li>
</ul>
<p>The convergence of all three pillars (unified Grafana with Mimir, Loki, Tempo) reduces <strong>MTTR</strong> (Mean Time To Resolution). In terms of governance, <strong>blameless postmortems</strong> (Beyer et al., 2016) analyze the systemic causes of incidents to produce concrete improvements.</p>

<h2>Conclusion</h2>
<p>Cloud-native deployment resilience rests on a triptych: deployment strategies adapted to the risk level (rolling update for routine changes, canary for major changes), proven and regularly tested rollback mechanisms, and comprehensive observability enabling rapid detection and diagnosis of any degradation. Operational governance, supported by the GitOps audit trail and postmortem culture, transforms each incident into an improvement opportunity.</p>

<h2>References</h2>
<ul class="ref-list">
<li>Betts, D. et al. (2013). <em>Exploring CQRS and Event Sourcing</em>. Microsoft Patterns & Practices.</li>
<li>Beyer, B. et al. (2016). <em>Site Reliability Engineering</em>. O\'Reilly Media / Google.</li>
<li>Evans, E. (2003). <em>Domain-Driven Design</em>. Addison-Wesley.</li>
<li>Forsgren, N. et al. (2018). <em>Accelerate</em>. IT Revolution Press.</li>
<li>Gregg, B. (2020). <em>Systems Performance</em>, 2nd Ed. Addison-Wesley.</li>
<li>Hightower, K. et al. (2019). <em>Kubernetes: Up and Running</em>, 2nd Ed. O\'Reilly.</li>
<li>Humble, J. & Farley, D. (2010). <em>Continuous Delivery</em>. Addison-Wesley.</li>
<li>Kalman, R. E. (1960). "On the General Theory of Control Systems." <em>IFAC Proceedings</em>.</li>
<li>Kleppmann, M. (2017). <em>Designing Data-Intensive Applications</em>. O\'Reilly Media.</li>
<li>Luksa, M. (2018). <em>Kubernetes in Action</em>. Manning Publications.</li>
<li>Majors, C. et al. (2022). <em>Observability Engineering</em>. O\'Reilly Media.</li>
<li>Newman, S. (2021). <em>Building Microservices</em>, 2nd Ed. O\'Reilly Media.</li>
<li>Nygard, M. (2018). <em>Release It!</em>, 2nd Ed. Pragmatic Bookshelf.</li>
<li>Posta, C. & Maloku, R. (2022). <em>Istio in Action</em>. Manning Publications.</li>
<li>Prodan, S. (2023). "Progressive Delivery with Flagger." flagger.app.</li>
<li>Sadalage, P. & Fowler, M. (2012). <em>Refactoring Databases</em>. Addison-Wesley.</li>
</ul>
</div>',
			'category' => 'blog',
			'tags'     => array( 'devops', 'kubernetes', 'cloud', 'monitoring', 'resilience', 'mémoire-m2' ),
			'date'     => '2025-03-19',
		),
		array(
			'title'    => 'Sécurité des environnements cloud-native : du modèle Zero Trust à la supply chain logicielle',
			'content'  => '<div data-lang="fr">
<p><em>Article rédigé par <strong>Holali David GAVI</strong> dans le cadre du Master 2 Cybersécurité et Cloud.</em></p>

<h2>Résumé</h2>
<p>La sécurité des environnements cloud-native ne peut reposer sur le modèle périmétrique traditionnel. Cet article examine l\'application du modèle Zero Trust aux architectures Kubernetes, analyse les solutions de gestion des secrets (Vault, Sealed Secrets, SOPS), évalue les mécanismes de contrôle d\'accès (RBAC, Network Policies, eBPF/Cilium) et étudie les enjeux de sécurité de la supply chain logicielle (SBOM, Sigstore, SLSA). Une synthèse sur le scanning de vulnérabilités runtime (Falco) et l\'audit de conformité complète l\'analyse.</p>

<h2>Introduction</h2>
<p>Le rapport Mandiant (2023) indique que 67% des intrusions cloud exploitent le mouvement latéral après une compromission initiale. Dans un cluster Kubernetes, où des centaines de Pods communiquent via un réseau plat, un seul Pod compromis peut potentiellement atteindre tous les services. Le modèle de sécurité périmétrique — un firewall séparant l\'intérieur (de confiance) de l\'extérieur (hostile) — est structurellement inadapté à cette réalité. Cet article analyse les approches de sécurité adaptées aux architectures cloud-native.</p>

<h2>Zero Trust : principes et implémentation</h2>
<p>Le <strong>Zero Trust</strong>, formalisé par Kindervag (2010) chez Forrester et normalisé par le NIST SP 800-207 (Rose et al., 2020), repose sur trois principes : vérification explicite de chaque requête, moindre privilège systématique et hypothèse de brèche (assume breach). En Kubernetes, ce modèle se traduit par :</p>
<ul>
<li><strong>Service Mesh</strong> (Istio, Linkerd) — Chiffrement mTLS automatique entre tous les Pods, sans modification du code applicatif. Chaque service dispose d\'une identité cryptographique (SPIFFE).</li>
<li><strong>Network Policies</strong> — Micro-segmentation réseau au niveau L3/L4. Une politique default-deny bloque tout trafic non explicitement autorisé.</li>
<li><strong>Cilium/eBPF</strong> — Extension des Network Policies au niveau L7 (HTTP, gRPC, Kafka), permettant de restreindre les méthodes et les chemins autorisés (Isovalent, 2024).</li>
</ul>

<h2>Gestion des secrets dans Kubernetes</h2>
<p>Les Secrets natifs Kubernetes sont encodés en Base64, <strong>pas chiffrés</strong> — stockés en clair dans etcd par défaut. Le rapport GitGuardian (2024) révèle 12,8 millions de secrets exposés sur GitHub en 2023. Des solutions complémentaires sont indispensables :</p>
<ul>
<li><strong>HashiCorp Vault</strong> — Gestion centralisée avec chiffrement, rotation automatique et <strong>secrets dynamiques</strong> (credentials à durée de vie limitée). Intégration Kubernetes via le Vault Agent Injector ou le CSI Provider (Brikman, 2024).</li>
<li><strong>Sealed Secrets</strong> (Bitnami) — Secrets chiffrés stockables dans Git, déchiffrés uniquement par le contrôleur dans le cluster. Solution de référence pour le GitOps.</li>
<li><strong>SOPS</strong> (Mozilla) — Chiffrement sélectif des valeurs YAML/JSON avec AWS KMS, GCP KMS ou PGP. Compatible ArgoCD et Flux.</li>
<li><strong>External Secrets Operator</strong> — Synchronisation depuis AWS Secrets Manager, Azure Key Vault ou GCP Secret Manager vers des Secrets Kubernetes natifs.</li>
</ul>

<h2>RBAC et contrôle d\'accès granulaire</h2>
<p>Le RBAC Kubernetes repose sur quatre objets : Role, ClusterRole, RoleBinding, ClusterRoleBinding. Le <strong>CIS Kubernetes Benchmark</strong> (Center for Internet Security, 2024) recommande de désactiver l\'auto-montage du token ServiceAccount et de créer des ServiceAccounts dédiés par workload plutôt que d\'utiliser le compte <code>default</code>.</p>
<p>Les <strong>Admission Controllers</strong> ajoutent une couche de validation avant la persistance dans etcd. OPA/Gatekeeper et Kyverno implémentent le pattern « Policy as Code » : interdire les conteneurs privileged, exiger des resource limits, bloquer les images de registres non approuvés. Kyverno offre en plus la capacité de <strong>mutation</strong> (injection automatique de labels, sidecars) et de <strong>génération</strong> (création automatique de NetworkPolicies par namespace).</p>

<h2>Sécurité de la supply chain logicielle</h2>
<p>Les attaques SolarWinds (2020) et Log4Shell (2021) ont révélé la vulnérabilité critique des chaînes d\'approvisionnement logicielles. Le framework <strong>SLSA</strong> (Google) définit quatre niveaux de maturité, du build documenté (niveau 1) au build hermétique et reproductible avec revue à deux personnes (niveau 4).</p>
<p><strong>Sigstore</strong> (Linux Foundation) fournit une infrastructure de signature gratuite : Cosign signe les images, Rekor assure un log de transparence immuable, et Fulcio émet des certificats éphémères basés sur OIDC (Lorenc & Meadows, 2022). Les <strong>SBOM</strong> (Software Bill of Materials), générés au format SPDX ou CycloneDX par Syft (Anchore), inventorient tous les composants d\'un logiciel. Grype les analyse pour détecter les CVE.</p>

<h2>Détection runtime et scanning continu</h2>
<p><strong>Trivy</strong> (Aqua Security) analyse les images, les fichiers IaC et les configurations Kubernetes. <strong>Docker Scout</strong> réévalue les images déjà déployées quand de nouvelles CVE sont publiées. Au runtime, <strong>Falco</strong> (Sysdig, CNCF) détecte les comportements anormaux via eBPF : exécution d\'un shell dans un conteneur, lecture de <code>/etc/shadow</code>, connexion sortante inattendue. Les alertes alimentent les SOAR/SIEM pour corrélation et réponse automatisée (Sysdig, 2024).</p>

<h2>Audit et conformité continue</h2>
<p>Les <strong>Kubernetes Audit Logs</strong> enregistrent chaque requête API avec quatre niveaux de verbosité (None, Metadata, Request, RequestResponse). En GitOps, l\'historique Git constitue un audit trail naturel — chaque changement est un commit avec auteur, date et diff. Les <strong>Cloud Trail</strong> (AWS CloudTrail, Azure Activity Log, GCP Cloud Audit Logs) enregistrent les actions sur les ressources cloud. La corrélation des trois sources permet la reconstitution complète des événements lors d\'un incident.</p>

<h2>Conclusion</h2>
<p>La sécurité des environnements cloud-native est un processus continu, pas un état final. L\'approche Zero Trust, combinée à une gestion rigoureuse des secrets, un RBAC granulaire, une supply chain logicielle sécurisée et une détection runtime proactive, réduit significativement la surface d\'attaque. L\'automatisation de ces contrôles via le Policy as Code transforme la conformité d\'un exercice ponctuel en un processus vérifiable en continu.</p>

<h2>Références</h2>
<ul class="ref-list">
<li>Brikman, Y. (2024). <em>Terraform: Up & Running</em>, 3rd Ed. O\'Reilly Media.</li>
<li>Center for Internet Security (2024). <em>CIS Kubernetes Benchmark v1.9</em>.</li>
<li>GitGuardian (2024). <em>State of Secrets Sprawl 2024</em>.</li>
<li>Isovalent (2024). « Cilium Network Policies ». docs.cilium.io.</li>
<li>Kindervag, J. (2010). « No More Chewy Centers: Introducing the Zero Trust Model ». Forrester.</li>
<li>Lorenc, D. & Meadows, S. (2022). « Sigstore: Software Signing for Everybody ». sigstore.dev.</li>
<li>Mandiant (2023). <em>M-Trends 2023</em>.</li>
<li>Rose, S. et al. (2020). « Zero Trust Architecture ». NIST SP 800-207.</li>
<li>Sysdig (2024). « Runtime Security with Falco ». sysdig.com.</li>
</ul>
</div>
<div data-lang="en">
<p><em>Article written by <strong>Holali David GAVI</strong> as part of the Master 2 Cybersecurity and Cloud program.</em></p>

<h2>Abstract</h2>
<p>Cloud-native environment security cannot rely on the traditional perimeter model. This article examines the application of the Zero Trust model to Kubernetes architectures, analyzes secrets management solutions (Vault, Sealed Secrets, SOPS), evaluates access control mechanisms (RBAC, Network Policies, eBPF/Cilium), and studies the security challenges of the software supply chain (SBOM, Sigstore, SLSA). A synthesis on runtime vulnerability scanning (Falco) and compliance auditing completes the analysis.</p>

<h2>Introduction</h2>
<p>The Mandiant report (2023) indicates that 67% of cloud intrusions exploit lateral movement after an initial compromise. In a Kubernetes cluster, where hundreds of Pods communicate over a flat network, a single compromised Pod can potentially reach all services. The perimeter security model — a firewall separating the inside (trusted) from the outside (hostile) — is structurally inadequate for this reality. This article analyzes security approaches adapted to cloud-native architectures.</p>

<h2>Zero Trust: principles and implementation</h2>
<p><strong>Zero Trust</strong>, formalized by Kindervag (2010) at Forrester and standardized by NIST SP 800-207 (Rose et al., 2020), rests on three principles: explicit verification of every request, systematic least privilege, and assume breach. In Kubernetes, this model translates to:</p>
<ul>
<li><strong>Service Mesh</strong> (Istio, Linkerd) — Automatic mTLS encryption between all Pods, without modifying application code. Each service has a cryptographic identity (SPIFFE).</li>
<li><strong>Network Policies</strong> — Network micro-segmentation at L3/L4. A default-deny policy blocks all traffic not explicitly authorized.</li>
<li><strong>Cilium/eBPF</strong> — Extension of Network Policies to L7 (HTTP, gRPC, Kafka), allowing restriction of authorized methods and paths (Isovalent, 2024).</li>
</ul>

<h2>Secrets management in Kubernetes</h2>
<p>Native Kubernetes Secrets are Base64-encoded, <strong>not encrypted</strong> — stored in plaintext in etcd by default. The GitGuardian report (2024) reveals 12.8 million secrets exposed on GitHub in 2023. Complementary solutions are essential:</p>
<ul>
<li><strong>HashiCorp Vault</strong> — Centralized management with encryption, automatic rotation, and <strong>dynamic secrets</strong> (short-lived credentials). Kubernetes integration via the Vault Agent Injector or CSI Provider (Brikman, 2024).</li>
<li><strong>Sealed Secrets</strong> (Bitnami) — Encrypted secrets storable in Git, decrypted only by the controller in the cluster. The reference solution for GitOps.</li>
<li><strong>SOPS</strong> (Mozilla) — Selective encryption of YAML/JSON values with AWS KMS, GCP KMS, or PGP. Compatible with ArgoCD and Flux.</li>
<li><strong>External Secrets Operator</strong> — Synchronization from AWS Secrets Manager, Azure Key Vault, or GCP Secret Manager to native Kubernetes Secrets.</li>
</ul>

<h2>RBAC and granular access control</h2>
<p>Kubernetes RBAC relies on four objects: Role, ClusterRole, RoleBinding, ClusterRoleBinding. The <strong>CIS Kubernetes Benchmark</strong> (Center for Internet Security, 2024) recommends disabling ServiceAccount token auto-mounting and creating dedicated ServiceAccounts per workload rather than using the <code>default</code> account.</p>
<p><strong>Admission Controllers</strong> add a validation layer before persistence in etcd. OPA/Gatekeeper and Kyverno implement the "Policy as Code" pattern: prohibit privileged containers, require resource limits, block images from unapproved registries. Kyverno additionally offers <strong>mutation</strong> capability (automatic injection of labels, sidecars) and <strong>generation</strong> (automatic creation of NetworkPolicies per namespace).</p>

<h2>Software supply chain security</h2>
<p>The SolarWinds (2020) and Log4Shell (2021) attacks revealed the critical vulnerability of software supply chains. The <strong>SLSA</strong> framework (Google) defines four maturity levels, from documented build (level 1) to hermetic and reproducible build with two-person review (level 4).</p>
<p><strong>Sigstore</strong> (Linux Foundation) provides a free signing infrastructure: Cosign signs images, Rekor ensures an immutable transparency log, and Fulcio issues ephemeral OIDC-based certificates (Lorenc & Meadows, 2022). <strong>SBOMs</strong> (Software Bill of Materials), generated in SPDX or CycloneDX format by Syft (Anchore), inventory all components of a software package. Grype analyzes them to detect CVEs.</p>

<h2>Runtime detection and continuous scanning</h2>
<p><strong>Trivy</strong> (Aqua Security) analyzes images, IaC files, and Kubernetes configurations. <strong>Docker Scout</strong> reassesses already-deployed images when new CVEs are published. At runtime, <strong>Falco</strong> (Sysdig, CNCF) detects anomalous behaviors via eBPF: shell execution in a container, reading <code>/etc/shadow</code>, unexpected outbound connection. Alerts feed SOAR/SIEM systems for correlation and automated response (Sysdig, 2024).</p>

<h2>Audit and continuous compliance</h2>
<p><strong>Kubernetes Audit Logs</strong> record every API request at four verbosity levels (None, Metadata, Request, RequestResponse). In GitOps, Git history constitutes a natural audit trail — every change is a commit with author, date, and diff. <strong>Cloud Trail</strong> services (AWS CloudTrail, Azure Activity Log, GCP Cloud Audit Logs) record actions on cloud resources. Correlating all three sources enables complete event reconstruction during an incident.</p>

<h2>Conclusion</h2>
<p>Cloud-native environment security is a continuous process, not a final state. The Zero Trust approach, combined with rigorous secrets management, granular RBAC, a secured software supply chain, and proactive runtime detection, significantly reduces the attack surface. Automating these controls via Policy as Code transforms compliance from a one-off exercise into a continuously verifiable process.</p>

<h2>References</h2>
<ul class="ref-list">
<li>Brikman, Y. (2024). <em>Terraform: Up & Running</em>, 3rd Ed. O\'Reilly Media.</li>
<li>Center for Internet Security (2024). <em>CIS Kubernetes Benchmark v1.9</em>.</li>
<li>GitGuardian (2024). <em>State of Secrets Sprawl 2024</em>.</li>
<li>Isovalent (2024). "Cilium Network Policies." docs.cilium.io.</li>
<li>Kindervag, J. (2010). "No More Chewy Centers: Introducing the Zero Trust Model." Forrester.</li>
<li>Lorenc, D. & Meadows, S. (2022). "Sigstore: Software Signing for Everybody." sigstore.dev.</li>
<li>Mandiant (2023). <em>M-Trends 2023</em>.</li>
<li>Rose, S. et al. (2020). "Zero Trust Architecture." NIST SP 800-207.</li>
<li>Sysdig (2024). "Runtime Security with Falco." sysdig.com.</li>
</ul>
</div>',
			'category' => 'blog',
			'tags'     => array( 'security', 'kubernetes', 'cloud', 'zero-trust', 'mémoire-m2' ),
			'date'     => '2025-03-22',
		),
		array(
			'title'    => 'Haute disponibilité, reprise après sinistre et Chaos Engineering dans le cloud',
			'content'  => '<div data-lang="fr">
<p><em>Article rédigé par <strong>Holali David GAVI</strong> dans le cadre du Master 2 Cybersécurité et Cloud.</em></p>

<h2>Résumé</h2>
<p>Assurer la continuité de service d\'un système distribué exige une ingénierie proactive de la résilience. Cet article analyse les architectures haute disponibilité (multi-AZ, multi-régions), les stratégies de backup et de reprise après sinistre (RPO/RTO, PCA/PRA), l\'approche du Chaos Engineering comme validation empirique de la résilience, et les mécanismes d\'auto-scaling (HPA, VPA, KEDA, Karpenter). Les tests de charge et le capacity planning complètent cette étude de la robustesse des systèmes cloud-native.</p>

<h2>Introduction</h2>
<p>La disponibilité d\'un système se mesure en « nines » : 99,9% autorise 8,76 heures d\'indisponibilité par an ; 99,99% n\'en autorise que 52,6 minutes. Atteindre ces niveaux dans un environnement distribué, où chaque composant peut défaillir indépendamment, nécessite une conception qui anticipe la panne plutôt que de tenter de l\'éviter. Rosenthal et Jones (2020) posent le principe fondateur : « la question n\'est pas de savoir si un composant va tomber en panne, mais quand ». Cet article examine les stratégies techniques qui rendent cette réalité gérable.</p>

<h2>Architectures multi-zones et multi-régions</h2>
<p>Les fournisseurs cloud structurent leur infrastructure en régions et zones de disponibilité (AZ). L\'architecture <strong>multi-AZ</strong> constitue le minimum pour la production : les composants critiques sont distribués sur 3 AZ via les <strong>topology spread constraints</strong> et l\'<strong>anti-affinité</strong> de Kubernetes (Burns, 2018). Les managed Kubernetes (EKS, AKS, GKE) distribuent automatiquement leur control plane sur 3 AZ.</p>
<p>L\'architecture <strong>multi-régions</strong> adresse les pannes régionales, la conformité réglementaire et la latence. Trois modèles coexistent : Active-Passive (répliques en lecture seule), Active-Active (toutes les régions traitent les écritures, nécessitant la résolution de conflits) et Active-Active avec partitionnement géographique. Verma et al. (2015) décrivent l\'architecture Google Spanner, capable de maintenir la cohérence forte à l\'échelle mondiale via des horloges atomiques (TrueTime API).</p>

<h2>Stratégies de backup et restauration</h2>
<p>La règle <strong>3-2-1</strong> prescrit 3 copies, 2 supports différents, 1 copie hors site. Dans Kubernetes, <strong>Velero</strong> (VMware) sauvegarde les ressources et les PersistentVolumes via les Volume Snapshots CSI sur object storage (S3, GCS). Pour les bases de données, trois approches coexistent : snapshots de volume (rapide mais nécessitant un quiesce), backup logique (pg_dump — portable et granulaire) et backup continu avec Point-in-Time Recovery via l\'archivage des WAL (pgBackRest, Barman).</p>
<p>Preston de Guise (2020) insiste : <strong>un backup non testé n\'est pas un backup</strong>. Les exercices de restauration doivent être réguliers, automatisés et documentés. Le RTO mesuré doit être comparé au RTO contractuel.</p>

<h2>RPO, RTO et plans de continuité</h2>
<p>Le <strong>RPO</strong> (Recovery Point Objective) définit la perte de données maximale acceptable ; le <strong>RTO</strong> (Recovery Time Objective) définit le délai de restauration maximal (Schmidt, 2006). Le <strong>Plan de Continuité d\'Activité</strong> (PCA) et le <strong>Plan de Reprise d\'Activité</strong> (PRA), cadrés par la norme ISO 22301:2019, formalisent les procédures : critères de déclenchement du failover, rôles et responsabilités, procédure de failback, et canaux de communication hors-bande.</p>

<h2>Chaos Engineering : valider la résilience par l\'expérimentation</h2>
<p>Le <strong>Chaos Engineering</strong> (Rosenthal & Jones, 2020) provoque délibérément des pannes pour vérifier empiriquement la résilience du système. La méthodologie suit un cycle scientifique : hypothèse → expérimentation → observation → analyse → amélioration.</p>
<ul>
<li><strong>Chaos Monkey</strong> (Netflix) — Termine aléatoirement des instances en production. Le <em>Simian Army</em> étend ce concept aux pannes de zone (Chaos Gorilla) et de région (Chaos Kong).</li>
<li><strong>Litmus</strong> (CNCF) — Framework natif Kubernetes avec des expériences définies comme CRD : pod-delete, network-loss, cpu-hog, node-drain, disk-fill. Intégrable dans les pipelines CI/CD.</li>
<li><strong>Chaos Mesh</strong> (PingCAP, CNCF) — Dashboard web, injection avancée de pannes réseau (partition, duplication, corruption DNS) via eBPF.</li>
</ul>

<h2>Auto-scaling et élasticité</h2>
<p>L\'élasticité automatique opère à trois niveaux dans Kubernetes :</p>
<ul>
<li><strong>HPA</strong> (Horizontal Pod Autoscaler) — Ajuste le nombre de réplicas selon l\'utilisation CPU ou des custom metrics Prometheus. <strong>KEDA</strong> (Kubernetes Event-Driven Autoscaling) étend le HPA avec 60+ scalers (Kafka, SQS, RabbitMQ, cron) et le scale-to-zero.</li>
<li><strong>VPA</strong> (Vertical Pod Autoscaler) — Ajuste les requests/limits CPU et mémoire. Utile pour les workloads à consommation imprévisible, mais incompatible avec le HPA sur la même métrique.</li>
<li><strong>Cluster Autoscaler / Karpenter</strong> — Ajuste le nombre de nœuds. Karpenter (CNCF) sélectionne dynamiquement le type d\'instance optimal pour chaque workload (Karpenter Documentation, 2024).</li>
</ul>

<h2>Tests de charge et capacity planning</h2>
<p>Le capacity planning vise à maintenir l\'utilisation sous 70% en régime nominal (Gregg, 2020). Les tests de charge se déclinent en trois types : <strong>load testing</strong> (charge nominale), <strong>stress testing</strong> (au-delà des limites, pour identifier le point de rupture) et <strong>soak testing</strong> (charge soutenue sur la durée, pour détecter fuites mémoire et dégradation progressive).</p>
<p><strong>k6</strong> (Grafana Labs) offre un scripting en JavaScript avec un runtime Go performant et des métriques Prometheus natives. <strong>Locust</strong> (Python) permet de distribuer les workers sur Kubernetes pour générer des millions de requêtes par seconde. La corrélation entre les métriques de charge et les métriques d\'infrastructure identifie précisément les goulots d\'étranglement.</p>

<h2>Conclusion</h2>
<p>La haute disponibilité et la résilience ne sont pas des propriétés émergentes : elles se conçoivent, se testent et se mesurent. L\'architecture multi-AZ/multi-régions fournit la fondation, les backups testés et les plans de continuité garantissent la reprise, le Chaos Engineering valide empiriquement les hypothèses de résilience, et l\'auto-scaling assure l\'adaptation à la charge. L\'ensemble forme un système de défense en profondeur où chaque couche compense les défaillances des autres.</p>

<h2>Références</h2>
<ul class="ref-list">
<li>Burns, B. (2018). <em>Designing Distributed Systems</em>. O\'Reilly Media.</li>
<li>Gregg, B. (2020). <em>Systems Performance</em>, 2nd Ed. Addison-Wesley.</li>
<li>Karpenter Documentation (2024). « Just-in-time Nodes ». karpenter.sh.</li>
<li>Preston de Guise, W. (2020). <em>Data Protection</em>. CRC Press.</li>
<li>Rosenthal, C. & Jones, N. (2020). <em>Chaos Engineering</em>. O\'Reilly Media.</li>
<li>Schmidt, K. (2006). <em>High Availability and Disaster Recovery</em>. Springer.</li>
<li>Velero Documentation (2024). « Backup and Restore ». velero.io.</li>
<li>Verma, A. et al. (2015). « Large-scale Cluster Management at Google with Borg ». <em>EuroSys \'15</em>.</li>
</ul>
</div>
<div data-lang="en">
<p><em>Article written by <strong>Holali David GAVI</strong> as part of the Master 2 Cybersecurity and Cloud program.</em></p>

<h2>Abstract</h2>
<p>Ensuring service continuity of a distributed system requires proactive resilience engineering. This article analyzes high availability architectures (multi-AZ, multi-region), backup and disaster recovery strategies (RPO/RTO, BCP/DRP), the Chaos Engineering approach as empirical resilience validation, and auto-scaling mechanisms (HPA, VPA, KEDA, Karpenter). Load testing and capacity planning complete this study of cloud-native system robustness.</p>

<h2>Introduction</h2>
<p>System availability is measured in "nines": 99.9% allows 8.76 hours of downtime per year; 99.99% allows only 52.6 minutes. Achieving these levels in a distributed environment, where each component can fail independently, requires a design that anticipates failure rather than trying to prevent it. Rosenthal and Jones (2020) state the foundational principle: "the question is not whether a component will fail, but when." This article examines the technical strategies that make this reality manageable.</p>

<h2>Multi-zone and multi-region architectures</h2>
<p>Cloud providers structure their infrastructure into regions and availability zones (AZs). The <strong>multi-AZ</strong> architecture is the minimum for production: critical components are distributed across 3 AZs via <strong>topology spread constraints</strong> and Kubernetes <strong>anti-affinity</strong> (Burns, 2018). Managed Kubernetes services (EKS, AKS, GKE) automatically distribute their control plane across 3 AZs.</p>
<p>The <strong>multi-region</strong> architecture addresses regional failures, regulatory compliance, and latency. Three models coexist: Active-Passive (read-only replicas), Active-Active (all regions process writes, requiring conflict resolution), and Active-Active with geographic partitioning. Verma et al. (2015) describe the Google Spanner architecture, capable of maintaining strong consistency at global scale via atomic clocks (TrueTime API).</p>

<h2>Backup and restoration strategies</h2>
<p>The <strong>3-2-1 rule</strong> prescribes 3 copies, 2 different media, 1 off-site copy. In Kubernetes, <strong>Velero</strong> (VMware) backs up resources and PersistentVolumes via Volume Snapshots CSI to object storage (S3, GCS). For databases, three approaches coexist: volume snapshots (fast but requiring quiesce), logical backup (pg_dump — portable and granular), and continuous backup with Point-in-Time Recovery via WAL archiving (pgBackRest, Barman).</p>
<p>Preston de Guise (2020) insists: <strong>an untested backup is not a backup</strong>. Restoration exercises must be regular, automated, and documented. The measured RTO must be compared to the contractual RTO.</p>

<h2>RPO, RTO, and continuity plans</h2>
<p><strong>RPO</strong> (Recovery Point Objective) defines the maximum acceptable data loss; <strong>RTO</strong> (Recovery Time Objective) defines the maximum restoration delay (Schmidt, 2006). The <strong>Business Continuity Plan</strong> (BCP) and the <strong>Disaster Recovery Plan</strong> (DRP), framed by ISO 22301:2019, formalize procedures: failover trigger criteria, roles and responsibilities, failback procedure, and out-of-band communication channels.</p>

<h2>Chaos Engineering: validating resilience through experimentation</h2>
<p><strong>Chaos Engineering</strong> (Rosenthal & Jones, 2020) deliberately provokes failures to empirically verify system resilience. The methodology follows a scientific cycle: hypothesis → experimentation → observation → analysis → improvement.</p>
<ul>
<li><strong>Chaos Monkey</strong> (Netflix) — Randomly terminates instances in production. The <em>Simian Army</em> extends this concept to zone failures (Chaos Gorilla) and region failures (Chaos Kong).</li>
<li><strong>Litmus</strong> (CNCF) — Kubernetes-native framework with experiments defined as CRDs: pod-delete, network-loss, cpu-hog, node-drain, disk-fill. Integrable into CI/CD pipelines.</li>
<li><strong>Chaos Mesh</strong> (PingCAP, CNCF) — Web dashboard, advanced network fault injection (partition, duplication, DNS corruption) via eBPF.</li>
</ul>

<h2>Auto-scaling and elasticity</h2>
<p>Automatic elasticity operates at three levels in Kubernetes:</p>
<ul>
<li><strong>HPA</strong> (Horizontal Pod Autoscaler) — Adjusts the number of replicas based on CPU usage or custom Prometheus metrics. <strong>KEDA</strong> (Kubernetes Event-Driven Autoscaling) extends HPA with 60+ scalers (Kafka, SQS, RabbitMQ, cron) and scale-to-zero.</li>
<li><strong>VPA</strong> (Vertical Pod Autoscaler) — Adjusts CPU and memory requests/limits. Useful for workloads with unpredictable consumption, but incompatible with HPA on the same metric.</li>
<li><strong>Cluster Autoscaler / Karpenter</strong> — Adjusts the number of nodes. Karpenter (CNCF) dynamically selects the optimal instance type for each workload (Karpenter Documentation, 2024).</li>
</ul>

<h2>Load testing and capacity planning</h2>
<p>Capacity planning aims to keep utilization below 70% under normal load (Gregg, 2020). Load tests come in three types: <strong>load testing</strong> (nominal load), <strong>stress testing</strong> (beyond limits, to identify the breaking point), and <strong>soak testing</strong> (sustained load over time, to detect memory leaks and progressive degradation).</p>
<p><strong>k6</strong> (Grafana Labs) offers JavaScript scripting with a performant Go runtime and native Prometheus metrics. <strong>Locust</strong> (Python) allows distributing workers on Kubernetes to generate millions of requests per second. Correlating load metrics with infrastructure metrics precisely identifies bottlenecks.</p>

<h2>Conclusion</h2>
<p>High availability and resilience are not emergent properties: they are designed, tested, and measured. Multi-AZ/multi-region architecture provides the foundation, tested backups and continuity plans guarantee recovery, Chaos Engineering empirically validates resilience assumptions, and auto-scaling ensures adaptation to load. Together, they form a defense-in-depth system where each layer compensates for the failures of others.</p>

<h2>References</h2>
<ul class="ref-list">
<li>Burns, B. (2018). <em>Designing Distributed Systems</em>. O\'Reilly Media.</li>
<li>Gregg, B. (2020). <em>Systems Performance</em>, 2nd Ed. Addison-Wesley.</li>
<li>Karpenter Documentation (2024). "Just-in-time Nodes." karpenter.sh.</li>
<li>Preston de Guise, W. (2020). <em>Data Protection</em>. CRC Press.</li>
<li>Rosenthal, C. & Jones, N. (2020). <em>Chaos Engineering</em>. O\'Reilly Media.</li>
<li>Schmidt, K. (2006). <em>High Availability and Disaster Recovery</em>. Springer.</li>
<li>Velero Documentation (2024). "Backup and Restore." velero.io.</li>
<li>Verma, A. et al. (2015). "Large-scale Cluster Management at Google with Borg." <em>EuroSys \'15</em>.</li>
</ul>
</div>',
			'category' => 'blog',
			'tags'     => array( 'cloud', 'kubernetes', 'resilience', 'chaos-engineering', 'mémoire-m2' ),
			'date'     => '2025-03-24',
		),
		array(
			'title'    => 'GitOps, Policy as Code et gouvernance du cycle de déploiement',
			'content'  => '<div data-lang="fr">
<p><em>Article rédigé par <strong>Holali David GAVI</strong> dans le cadre du Master 2 Cybersécurité et Cloud.</em></p>

<h2>Résumé</h2>
<p>La gouvernance des déploiements cloud-native nécessite des mécanismes qui garantissent la traçabilité, la conformité et l\'optimisation des coûts à l\'échelle. Cet article examine le paradigme GitOps comme cadre opérationnel (ArgoCD, Flux), analyse l\'approche Policy as Code pour l\'application automatisée des politiques de sécurité et de conformité (OPA/Gatekeeper, Kyverno, Crossplane), étudie les modèles de multi-tenancy dans Kubernetes, et évalue les pratiques FinOps et les exigences de conformité réglementaire (ISO 27001, SOC 2, RGPD).</p>

<h2>Introduction</h2>
<p>À mesure que les organisations augmentent le nombre de services, de clusters et d\'équipes opérant sur des infrastructures cloud, la gouvernance devient un enjeu critique. Comment garantir que chaque déploiement respecte les politiques de sécurité ? Comment assurer la traçabilité des changements pour l\'audit ? Comment optimiser les coûts tout en maintenant la conformité réglementaire ? Le paradigme GitOps, combiné au Policy as Code, propose une réponse structurée à ces questions.</p>

<h2>GitOps : Git comme source unique de vérité</h2>
<p>Le <strong>GitOps</strong>, formalisé par Alexis Richardson (Weaveworks, 2017) et normalisé par OpenGitOps (CNCF, 2022), repose sur quatre principes : état déclaratif, versionné dans Git, tiré automatiquement (pull-based) et réconcilié en continu. Un agent dans le cluster compare en permanence l\'état réel avec l\'état décrit dans Git et corrige toute dérive.</p>
<p>L\'avantage sécuritaire du modèle pull est significatif : le pipeline CI n\'a plus besoin de credentials d\'accès au cluster. Seul l\'agent GitOps dispose des permissions nécessaires — une compromission du serveur CI ne donne plus accès à la production (Limoncelli et al., 2020).</p>

<h2>ArgoCD et Flux en pratique</h2>
<p><strong>ArgoCD</strong> (Intuit, CNCF graduated), adopté par 60% des organisations utilisant GitOps (CNCF Survey, 2024), repose sur trois composants : Application Controller (réconciliation), Repo Server (génération de manifests) et API Server (dashboard web, authentification OIDC/LDAP). Le pattern <strong>App of Apps</strong> permet de gérer des centaines de services via une Application racine. Les <strong>ApplicationSets</strong> automatisent la création d\'Applications par cluster, namespace ou entrée dans une liste.</p>
<p><strong>Flux</strong> (Weaveworks, CNCF graduated) adopte une approche modulaire avec des contrôleurs spécialisés : Source Controller, Kustomize Controller, Helm Controller, Notification Controller. Plus léger qu\'ArgoCD, Flux est adapté aux workflows entièrement automatisés sans interface graphique.</p>

<h2>Policy as Code : OPA, Kyverno, Crossplane</h2>
<p>Le <strong>Policy as Code</strong> remplace les documents de politique statiques par des contrôles automatisés et auditables. <strong>OPA/Gatekeeper</strong> (CNCF graduated) utilise le langage Rego pour définir des ConstraintTemplates instanciés en Constraints. Les modes deny (bloquant) et warn (informatif) permettent une adoption progressive. L\'audit mode vérifie rétroactivement les ressources existantes.</p>
<p><strong>Kyverno</strong> (Nirmata) écrit les politiques en YAML natif Kubernetes, avec trois actions : Validate, Mutate (injection automatique de labels, sidecars) et Generate (création de NetworkPolicies par namespace). <strong>Crossplane</strong> (Upbound, CNCF incubating) étend le modèle déclaratif aux ressources cloud (RDS, S3, VPC) via des CRD et des Compositions qui exposent des abstractions de haut niveau aux développeurs.</p>

<h2>Multi-tenancy et isolation</h2>
<p>Le SIG Multi-Tenancy de Kubernetes (2024) distingue le <strong>soft multi-tenancy</strong> (isolation logique via namespaces, RBAC, Network Policies, Resource Quotas — pour des équipes internes de confiance) du <strong>hard multi-tenancy</strong> (isolation forte avec runtime sandboxé gVisor/Kata Containers, nœuds dédiés — pour des clients ne se faisant pas confiance).</p>
<p><strong>vCluster</strong> (Loft Labs) crée des clusters virtuels à l\'intérieur d\'un cluster hôte : chaque tenant dispose de son propre API server et etcd, avec une isolation quasi complète tout en partageant l\'infrastructure physique. Les <strong>Hierarchical Namespaces</strong> (HNC) permettent l\'héritage de quotas et RBAC dans des hiérarchies de namespaces.</p>

<h2>FinOps et optimisation des coûts</h2>
<p>Le <strong>FinOps</strong> (FinOps Foundation, 2023) vise à maximiser la valeur de chaque euro dépensé dans le cloud. Les organisations gaspillent en moyenne 32% de leurs dépenses cloud, principalement en surprovisionnement. Les leviers d\'optimisation dans Kubernetes incluent :</p>
<ul>
<li><strong>Right-sizing</strong> — Le VPA analyse la consommation historique et recommande des requests/limits optimaux. <strong>OpenCost</strong> (CNCF) attribue les coûts par namespace, deployment et équipe.</li>
<li><strong>Spot instances</strong> — 60-90% moins chères, gérées par Karpenter qui diversifie les types d\'instances pour minimiser les interruptions simultanées.</li>
<li><strong>Scale-to-zero</strong> — KEDA et Knative suppriment les Pods inactifs. Appliqué aux environnements dev/staging la nuit, les économies atteignent 40-60%.</li>
<li><strong>Reserved instances</strong> — 30-72% d\'économies pour les workloads stables (bases de données, services critiques).</li>
</ul>

<h2>Conformité réglementaire : ISO 27001, SOC 2, RGPD</h2>
<p><strong>ISO 27001:2022</strong> impose un système de management de la sécurité de l\'information (SMSI) avec des contrôles pertinents pour le cloud-native : gestion de la configuration (A.8.9), cycle de développement sécurisé (A.8.25), séparation des environnements (A.8.31). L\'approche GitOps facilite la conformité via l\'historique versionné des configurations.</p>
<p><strong>SOC 2 Type II</strong> évalue les contrôles de sécurité sur 6 à 12 mois. Les preuves (logs Kubernetes, historique Git, rapports de scan) doivent être collectées en continu. <strong>Drata</strong> et <strong>Vanta</strong> automatisent cette collecte.</p>
<p>Le <strong>RGPD</strong> impose la localisation des données en région EU, le droit à l\'effacement (Article 17 — nécessitant parfois le « crypto-shredding »), le Privacy by Design (Article 25) et le registre des traitements (Article 30). La <strong>compliance as code</strong> via OPA/Kyverno, les scans automatisés et les dashboards de conformité transforment la conformité en processus continu et vérifiable.</p>

<h2>Conclusion</h2>
<p>La gouvernance des déploiements cloud-native repose sur l\'automatisation et la traçabilité. Le GitOps fournit le cadre opérationnel (source de vérité versionnée, réconciliation continue, audit trail naturel), le Policy as Code garantit le respect automatique des politiques de sécurité, et les pratiques FinOps optimisent l\'allocation des ressources. L\'ensemble constitue un système de gouvernance adaptatif, où chaque changement est déclaratif, auditable et réversible — répondant ainsi aux exigences réglementaires tout en préservant la vélocité des équipes.</p>

<h2>Références</h2>
<ul class="ref-list">
<li>ArgoCD Documentation (2024). « App of Apps Pattern ». argo-cd.readthedocs.io.</li>
<li>CNCF (2024). <em>Cloud Native Survey 2024</em>.</li>
<li>Crossplane Documentation (2024). « Compositions and Claims ». docs.crossplane.io.</li>
<li>FinOps Foundation (2023). <em>State of FinOps 2023</em>.</li>
<li>ISO (2022). <em>ISO/IEC 27001:2022</em>.</li>
<li>Kubernetes SIG Multi-Tenancy (2024). « Multi-tenancy Concepts ». kubernetes.io.</li>
<li>Limoncelli, T. A. et al. (2020). <em>The Practice of Cloud System Administration</em>, 2nd Ed. Addison-Wesley.</li>
<li>OpenCost Documentation (2024). « Kubernetes Cost Monitoring ». opencost.io.</li>
<li>OpenGitOps (2022). « GitOps Principles v1.0 ». opengitops.dev.</li>
<li>Richardson, A. (2017). « GitOps — Operations by Pull Request ». Weaveworks Blog.</li>
</ul>
</div>
<div data-lang="en">
<p><em>Article written by <strong>Holali David GAVI</strong> as part of the Master 2 Cybersecurity and Cloud program.</em></p>

<h2>Abstract</h2>
<p>Cloud-native deployment governance requires mechanisms that guarantee traceability, compliance, and cost optimization at scale. This article examines the GitOps paradigm as an operational framework (ArgoCD, Flux), analyzes the Policy as Code approach for automated enforcement of security and compliance policies (OPA/Gatekeeper, Kyverno, Crossplane), studies multi-tenancy models in Kubernetes, and evaluates FinOps practices and regulatory compliance requirements (ISO 27001, SOC 2, GDPR).</p>

<h2>Introduction</h2>
<p>As organizations increase the number of services, clusters, and teams operating on cloud infrastructure, governance becomes a critical concern. How can you ensure that every deployment complies with security policies? How can you guarantee change traceability for auditing? How can you optimize costs while maintaining regulatory compliance? The GitOps paradigm, combined with Policy as Code, offers a structured answer to these questions.</p>

<h2>GitOps: Git as the single source of truth</h2>
<p><strong>GitOps</strong>, formalized by Alexis Richardson (Weaveworks, 2017) and standardized by OpenGitOps (CNCF, 2022), rests on four principles: declarative state, versioned in Git, automatically pulled (pull-based), and continuously reconciled. An agent in the cluster continuously compares the actual state with the state described in Git and corrects any drift.</p>
<p>The security advantage of the pull model is significant: the CI pipeline no longer needs credentials to access the cluster. Only the GitOps agent has the necessary permissions — a compromise of the CI server no longer grants access to production (Limoncelli et al., 2020).</p>

<h2>ArgoCD and Flux in practice</h2>
<p><strong>ArgoCD</strong> (Intuit, CNCF graduated), adopted by 60% of organizations using GitOps (CNCF Survey, 2024), relies on three components: Application Controller (reconciliation), Repo Server (manifest generation), and API Server (web dashboard, OIDC/LDAP authentication). The <strong>App of Apps</strong> pattern allows managing hundreds of services via a root Application. <strong>ApplicationSets</strong> automate Application creation per cluster, namespace, or list entry.</p>
<p><strong>Flux</strong> (Weaveworks, CNCF graduated) takes a modular approach with specialized controllers: Source Controller, Kustomize Controller, Helm Controller, Notification Controller. Lighter than ArgoCD, Flux is suited for fully automated workflows without a graphical interface.</p>

<h2>Policy as Code: OPA, Kyverno, Crossplane</h2>
<p><strong>Policy as Code</strong> replaces static policy documents with automated and auditable controls. <strong>OPA/Gatekeeper</strong> (CNCF graduated) uses the Rego language to define ConstraintTemplates instantiated as Constraints. Deny (blocking) and warn (informational) modes allow progressive adoption. Audit mode retroactively checks existing resources.</p>
<p><strong>Kyverno</strong> (Nirmata) writes policies in native Kubernetes YAML, with three actions: Validate, Mutate (automatic injection of labels, sidecars), and Generate (automatic creation of NetworkPolicies per namespace). <strong>Crossplane</strong> (Upbound, CNCF incubating) extends the declarative model to cloud resources (RDS, S3, VPC) via CRDs and Compositions that expose high-level abstractions to developers.</p>

<h2>Multi-tenancy and isolation</h2>
<p>The Kubernetes SIG Multi-Tenancy (2024) distinguishes <strong>soft multi-tenancy</strong> (logical isolation via namespaces, RBAC, Network Policies, Resource Quotas — for trusted internal teams) from <strong>hard multi-tenancy</strong> (strong isolation with sandboxed runtime gVisor/Kata Containers, dedicated nodes — for untrusted clients).</p>
<p><strong>vCluster</strong> (Loft Labs) creates virtual clusters inside a host cluster: each tenant has its own API server and etcd, with near-complete isolation while sharing physical infrastructure. <strong>Hierarchical Namespaces</strong> (HNC) allow inheritance of quotas and RBAC in namespace hierarchies.</p>

<h2>FinOps and cost optimization</h2>
<p><strong>FinOps</strong> (FinOps Foundation, 2023) aims to maximize the value of every dollar spent in the cloud. Organizations waste an average of 32% of their cloud spending, mainly through over-provisioning. Optimization levers in Kubernetes include:</p>
<ul>
<li><strong>Right-sizing</strong> — VPA analyzes historical consumption and recommends optimal requests/limits. <strong>OpenCost</strong> (CNCF) attributes costs by namespace, deployment, and team.</li>
<li><strong>Spot instances</strong> — 60-90% cheaper, managed by Karpenter which diversifies instance types to minimize simultaneous interruptions.</li>
<li><strong>Scale-to-zero</strong> — KEDA and Knative remove idle Pods. Applied to dev/staging environments at night, savings reach 40-60%.</li>
<li><strong>Reserved instances</strong> — 30-72% savings for stable workloads (databases, critical services).</li>
</ul>

<h2>Regulatory compliance: ISO 27001, SOC 2, GDPR</h2>
<p><strong>ISO 27001:2022</strong> mandates an Information Security Management System (ISMS) with controls relevant to cloud-native: configuration management (A.8.9), secure development lifecycle (A.8.25), environment separation (A.8.31). The GitOps approach facilitates compliance through versioned configuration history.</p>
<p><strong>SOC 2 Type II</strong> evaluates security controls over 6 to 12 months. Evidence (Kubernetes logs, Git history, scan reports) must be collected continuously. <strong>Drata</strong> and <strong>Vanta</strong> automate this collection.</p>
<p>The <strong>GDPR</strong> mandates data localization in the EU region, the right to erasure (Article 17 — sometimes requiring "crypto-shredding"), Privacy by Design (Article 25), and the processing records register (Article 30). <strong>Compliance as code</strong> via OPA/Kyverno, automated scans, and compliance dashboards transform compliance into a continuous and verifiable process.</p>

<h2>Conclusion</h2>
<p>Cloud-native deployment governance relies on automation and traceability. GitOps provides the operational framework (versioned source of truth, continuous reconciliation, natural audit trail), Policy as Code ensures automatic compliance with security policies, and FinOps practices optimize resource allocation. Together, they form an adaptive governance system where every change is declarative, auditable, and reversible — meeting regulatory requirements while preserving team velocity.</p>

<h2>References</h2>
<ul class="ref-list">
<li>ArgoCD Documentation (2024). "App of Apps Pattern." argo-cd.readthedocs.io.</li>
<li>CNCF (2024). <em>Cloud Native Survey 2024</em>.</li>
<li>Crossplane Documentation (2024). "Compositions and Claims." docs.crossplane.io.</li>
<li>FinOps Foundation (2023). <em>State of FinOps 2023</em>.</li>
<li>ISO (2022). <em>ISO/IEC 27001:2022</em>.</li>
<li>Kubernetes SIG Multi-Tenancy (2024). "Multi-tenancy Concepts." kubernetes.io.</li>
<li>Limoncelli, T. A. et al. (2020). <em>The Practice of Cloud System Administration</em>, 2nd Ed. Addison-Wesley.</li>
<li>OpenCost Documentation (2024). "Kubernetes Cost Monitoring." opencost.io.</li>
<li>OpenGitOps (2022). "GitOps Principles v1.0." opengitops.dev.</li>
<li>Richardson, A. (2017). "GitOps — Operations by Pull Request." Weaveworks Blog.</li>
</ul>
</div>',
			'category' => 'blog',
			'tags'     => array( 'gitops', 'security', 'cloud', 'kubernetes', 'finops', 'mémoire-m2' ),
			'date'     => '2025-03-26',
		),
	);
}

/**
 * Import demo articles (blog + veille)
 */
function hdgavi_import_demo_articles( $force = false ) {
	if ( ! $force && get_option( 'hdgavi_demo_articles_imported' ) ) {
		return array( 'created' => 0, 'skipped' => 'already imported' );
	}

	$articles = hdgavi_get_demo_articles();
	$created  = 0;

	// Ensure categories exist
	if ( ! term_exists( 'veille', 'category' ) ) {
		wp_insert_term( 'Veille', 'category', array( 'slug' => 'veille' ) );
	}
	if ( ! term_exists( 'blog', 'category' ) ) {
		wp_insert_term( 'Blog', 'category', array( 'slug' => 'blog' ) );
	}

	foreach ( $articles as $article ) {
		$exists = get_posts( array( 'post_type' => 'post', 'title' => $article['title'], 'post_status' => array( 'publish', 'draft', 'private', 'trash' ), 'posts_per_page' => 1, 'fields' => 'ids' ) );
		if ( ! empty( $exists ) ) {
			if ( ! $force ) continue;
			// Force mode: update existing post instead of creating duplicate
			$post_id = $exists[0];
			$cat_id = get_cat_ID( $article['category'] );
			wp_update_post( array(
				'ID'            => $post_id,
				'post_content'  => $article['content'],
				'post_status'   => 'publish',
				'post_category' => array( $cat_id ),
			) );
		} else {
			$cat_id = get_cat_ID( $article['category'] );
			$post_id = wp_insert_post( array(
				'post_title'    => $article['title'],
				'post_content'  => $article['content'],
				'post_status'   => 'publish',
				'post_type'     => 'post',
				'post_category' => array( $cat_id ),
				'post_date'     => $article['date'] . ' 10:00:00',
				'post_author'   => get_current_user_id() ?: 1,
			) );
		}

		if ( is_wp_error( $post_id ) ) continue;

		// Mark as demo content for cleanup
		update_post_meta( $post_id, '_hdgavi_demo', '1' );

		// Set tags
		if ( ! empty( $article['tags'] ) ) {
			wp_set_post_tags( $post_id, $article['tags'] );
		}

		// Set watch meta (for veille articles)
		if ( ! empty( $article['source'] ) ) {
			update_post_meta( $post_id, 'watch_source', $article['source'] );
		}
		if ( ! empty( $article['url'] ) ) {
			update_post_meta( $post_id, 'watch_url', $article['url'] );
		}

		// Trilingual watch fields
		foreach ( array( 'title_en', 'title_fr', 'title_es', 'excerpt_en', 'excerpt_fr', 'excerpt_es' ) as $lang_key ) {
			if ( ! empty( $article[ $lang_key ] ) ) {
				update_post_meta( $post_id, '_watch_' . $lang_key, $article[ $lang_key ] );
			}
		}

		$created++;
	}

	update_option( 'hdgavi_demo_articles_imported', true, false );
	return array( 'created' => $created );
}

/**
 * Demo resources (CPT hdgavi_resource)
 */
function hdgavi_get_demo_resources() {
    return array(
        array(
            'title'   => 'Terraform AWS Starter Modules',
            'meta'    => array(
                '_res_desc_en'       => 'Production-ready Terraform modules for AWS: VPC, ECS, RDS, S3, CloudFront. Includes best practices for security groups, IAM roles, and state management.',
                '_res_desc_fr'       => 'Modules Terraform prêts pour la production sur AWS : VPC, ECS, RDS, S3, CloudFront. Inclut les bonnes pratiques pour les groupes de sécurité, rôles IAM et gestion d\'état.',
                '_res_desc_es'       => 'Módulos Terraform listos para producción en AWS: VPC, ECS, RDS, S3, CloudFront. Incluye buenas prácticas para grupos de seguridad, roles IAM y gestión de estado.',
                '_res_type'          => 'free',
                '_res_gated'         => '1',
                '_res_file_format'   => 'HCL / ZIP',
                '_res_icon'          => '🏗️',
            ),
            'category' => 'Terraform',
        ),
        array(
            'title'   => 'Kubernetes Cheat Sheet',
            'meta'    => array(
                '_res_desc_en'       => 'Comprehensive kubectl cheat sheet with common commands for pods, deployments, services, configmaps, secrets, and debugging. PDF format, printable A4.',
                '_res_desc_fr'       => 'Aide-mémoire kubectl complet avec les commandes courantes pour les pods, déploiements, services, configmaps, secrets et débogage. Format PDF, imprimable A4.',
                '_res_desc_es'       => 'Hoja de referencia completa de kubectl con comandos comunes para pods, deployments, services, configmaps, secrets y depuración. Formato PDF, imprimible A4.',
                '_res_type'          => 'free',
                '_res_gated'         => '',
                '_res_file_format'   => 'PDF',
                '_res_icon'          => '📋',
            ),
            'category' => 'Cheat Sheets',
        ),
        array(
            'title'   => 'Docker Compose Templates Collection',
            'meta'    => array(
                '_res_desc_en'       => '15+ production-ready Docker Compose templates: LAMP, MERN, monitoring (Prometheus + Grafana), CI/CD runners, databases, and reverse proxy setups.',
                '_res_desc_fr'       => '15+ templates Docker Compose prêts pour la production : LAMP, MERN, monitoring (Prometheus + Grafana), runners CI/CD, bases de données et reverse proxy.',
                '_res_desc_es'       => '15+ plantillas Docker Compose listas para producción: LAMP, MERN, monitoreo (Prometheus + Grafana), runners CI/CD, bases de datos y configuraciones de reverse proxy.',
                '_res_type'          => 'free',
                '_res_gated'         => '1',
                '_res_file_format'   => 'YAML / ZIP',
                '_res_icon'          => '🐳',
            ),
            'category' => 'Docker',
        ),
        array(
            'title'   => 'CI/CD Pipeline Blueprints',
            'meta'    => array(
                '_res_desc_en'       => 'Ready-to-use CI/CD pipeline configurations for GitHub Actions, GitLab CI, and Jenkins. Includes build, test, security scan, and deploy stages.',
                '_res_desc_fr'       => 'Configurations de pipelines CI/CD prêtes à l\'emploi pour GitHub Actions, GitLab CI et Jenkins. Inclut les étapes build, test, scan sécurité et déploiement.',
                '_res_desc_es'       => 'Configuraciones de pipelines CI/CD listas para usar en GitHub Actions, GitLab CI y Jenkins. Incluye etapas de build, test, escaneo de seguridad y despliegue.',
                '_res_type'          => 'free',
                '_res_gated'         => '1',
                '_res_file_format'   => 'YAML / ZIP',
                '_res_icon'          => '⚙️',
            ),
            'category' => 'CI/CD',
        ),
        array(
            'title'   => 'Helm Chart Starter Kit',
            'meta'    => array(
                '_res_desc_en'       => 'Opinionated Helm chart template with values schema, health checks, HPA, PDB, NetworkPolicy, and ServiceMonitor. Perfect starting point for microservices.',
                '_res_desc_fr'       => 'Template de chart Helm avec schéma de values, health checks, HPA, PDB, NetworkPolicy et ServiceMonitor. Point de départ idéal pour les microservices.',
                '_res_desc_es'       => 'Plantilla de chart Helm con esquema de values, health checks, HPA, PDB, NetworkPolicy y ServiceMonitor. Punto de partida ideal para microservicios.',
                '_res_type'          => 'paid',
                '_res_price'         => '€9',
                '_res_file_format'   => 'TAR.GZ',
                '_res_icon'          => '⎈',
            ),
            'category' => 'Kubernetes',
        ),
    );
}

function hdgavi_import_demo_resources( $force = false ) {
    if ( ! $force && get_option( 'hdgavi_demo_resources_imported' ) ) {
        return array( 'created' => 0, 'skipped' => 'already imported' );
    }

    $resources = hdgavi_get_demo_resources();
    $created   = 0;

    foreach ( $resources as $index => $resource ) {
        $exists = get_posts( array( 'post_type' => 'hdgavi_resource', 'title' => $resource['title'], 'post_status' => array( 'publish', 'draft', 'private', 'trash' ), 'posts_per_page' => 1, 'fields' => 'ids' ) );
        if ( ! empty( $exists ) ) {
            if ( ! $force ) continue;
            $post_id = $exists[0];
            wp_update_post( array( 'ID' => $post_id, 'post_status' => 'publish', 'menu_order' => $index + 1 ) );
            foreach ( $resource['meta'] as $key => $val ) {
                update_post_meta( $post_id, $key, $val );
            }
            continue;
        }

        $post_id = wp_insert_post( array(
            'post_title'  => $resource['title'],
            'post_status' => 'publish',
            'post_type'   => 'hdgavi_resource',
            'menu_order'  => $index + 1,
            'post_author' => get_current_user_id() ?: 1,
        ) );

        if ( is_wp_error( $post_id ) ) continue;

        update_post_meta( $post_id, '_hdgavi_demo', '1' );
        foreach ( $resource['meta'] as $key => $val ) {
            update_post_meta( $post_id, $key, $val );
        }

        // Set taxonomy
        if ( ! empty( $resource['category'] ) ) {
            wp_set_object_terms( $post_id, $resource['category'], 'hdgavi_resource_cat' );
        }

        $created++;
    }

    update_option( 'hdgavi_demo_resources_imported', true, false );
    return array( 'created' => $created );
}

/**
 * Demo experiences (CPT hdgavi_experience)
 */
function hdgavi_get_demo_experiences() {
    return array(
        array( 'title' => 'DevOps @ Dassault', 'meta' => array(
            '_exp_featured' => '1',
            '_exp_title_en' => 'DevOps Engineering Apprentice – K8s Containerization', '_exp_title_fr' => 'Apprenti Ingénieur DevOps – Conteneurisation K8s',
            '_exp_company_en' => 'Dassault Systèmes', '_exp_company_fr' => 'Dassault Systèmes',
            '_exp_period_en' => 'November 2024 – Present', '_exp_period_fr' => 'Novembre 2024 – Présent',
            '_exp_location' => 'Vélizy-Villacoublay',
            '_exp_desc_en' => 'Contributing to the On-Premise Container project: migrating 3DEXPERIENCE platform services from VM architecture to containerized deployment on Kubernetes.',
            '_exp_desc_fr' => "Contribution au projet On-Premise Container : migration des services de la plateforme 3DEXPERIENCE d'une architecture VM vers un déploiement conteneurisé sur Kubernetes.",
            '_exp_bullets_en' => "Built Docker images (Red Hat UBI 8) for platform services (Passport, FCS, 3DSpace)\nDeployed and orchestrated multi-service platform on Kubernetes via Helm Charts\nImplemented non-root security (securityContext, privilege separation) across all containers\nDeveloped the ODT Runner: CLI tool for test automation (Java, Docker, YAML, Chrome Headless)\nReduced test workflow from 9 manual steps to 3 automated steps",
            '_exp_bullets_fr' => "Construction d'images Docker (Red Hat UBI 8) pour les services de la plateforme (Passport, FCS, 3DSpace)\nDéploiement et orchestration multi-services sur Kubernetes via Helm Charts\nImplémentation de la sécurité non-root (securityContext, séparation des privilèges)\nDéveloppement de l'ODT Runner : CLI pour l'automatisation des tests (Java, Docker, YAML)\nRéduction du workflow de tests de 9 étapes manuelles à 3 étapes automatisées",
            '_exp_techs' => 'Docker, Kubernetes, Helm, Java, Linux, Bash, Python, CI/CD',
        )),
        array( 'title' => 'WordPress Dev', 'meta' => array(
            '_exp_title_en' => 'WordPress Developer', '_exp_title_fr' => 'Développeur WordPress',
            '_exp_company_en' => 'ACOMP Association', '_exp_company_fr' => 'ACOMP Association',
            '_exp_period_en' => 'August – September 2024', '_exp_period_fr' => 'Août – Septembre 2024',
            '_exp_location' => 'Paris',
            '_exp_desc_en' => 'Developed and customized WordPress websites. Built reusable components and optimized mobile UX.',
            '_exp_desc_fr' => 'Développement et personnalisation de sites WordPress (thèmes, plugins). Structuration de composants réutilisables et amélioration UX mobile.',
            '_exp_techs' => 'WordPress, PHP, CSS',
        )),
        array( 'title' => 'Flutter Dev', 'meta' => array(
            '_exp_title_en' => 'Mobile Developer (Flutter)', '_exp_title_fr' => 'Développeur multiplateforme (Flutter)',
            '_exp_company_en' => 'Revotask', '_exp_company_fr' => 'Revotask',
            '_exp_period_en' => 'August – September 2024', '_exp_period_fr' => 'Août – Septembre 2024',
            '_exp_location' => 'Paris',
            '_exp_desc_en' => 'Developed a cross-platform mobile application. Improved UI and prepared store deployment.',
            '_exp_desc_fr' => "Développement d'une application mobile multiplateforme. Amélioration de l'interface utilisateur et préparation au déploiement stores.",
            '_exp_techs' => 'Flutter, Dart',
        )),
        array( 'title' => 'IT Support', 'meta' => array(
            '_exp_title_en' => 'IT Support Technician', '_exp_title_fr' => 'Technicien Support Informatique',
            '_exp_company_en' => 'Lutèce Télécom', '_exp_company_fr' => 'Lutèce Télécom',
            '_exp_period_en' => 'October – December 2023', '_exp_period_fr' => 'Octobre – Décembre 2023',
            '_exp_location' => 'Pantin',
            '_exp_desc_en' => 'User support, network equipment installation, Windows and Linux server deployment.',
            '_exp_desc_fr' => "Support utilisateurs, installation et configuration d'équipements réseaux. Déploiement et configuration de serveurs Windows et Linux.",
            '_exp_techs' => 'Windows Server, Linux, Networking',
        )),
        array( 'title' => 'Surveyor', 'meta' => array(
            '_exp_title_en' => 'Surveyor – Networks & Infrastructure', '_exp_title_fr' => 'Géomètre – Réseaux & Infrastructures',
            '_exp_company_en' => 'GRDF (apprenticeship) then SPAC (permanent)', '_exp_company_fr' => 'GRDF (alternance) puis SPAC (CDI)',
            '_exp_period_en' => 'November 2018 – July 2022', '_exp_period_fr' => 'Novembre 2018 – Juillet 2022',
            '_exp_desc_en' => 'Topographic surveys and georeferencing of gas network infrastructure. Technical plan production. Created an automated project management tool in Excel VBA.',
            '_exp_desc_fr' => "Relevés topographiques et géoréférencement d'infrastructures réseaux. Production et mise à jour de plans techniques. Création d'un outil de gestion de projets automatisé en VBA.",
            '_exp_techs' => 'Topography, AutoCAD, Excel VBA, GIS',
        )),
    );
}

/**
 * Demo education (CPT hdgavi_education)
 */
function hdgavi_get_demo_educations() {
    return array(
        array( 'title' => 'M2 Cybersecurity', 'meta' => array(
            '_edu_period' => '2024 – 2026', '_edu_school' => 'IPSSI – Paris',
            '_edu_degree_en' => "Master's Degree in Cybersecurity & Cloud Computing", '_edu_degree_fr' => 'Mastère 1 & 2 Cybersécurité & Cloud Computing (Bac+5)',
            '_edu_notes_en' => 'Apprenticeship at Dassault Systèmes.', '_edu_notes_fr' => 'En alternance chez Dassault Systèmes.',
        )),
        array( 'title' => 'M2 SIAD', 'meta' => array(
            '_edu_period' => '2024 – 2025', '_edu_school' => 'CNAM – Paris',
            '_edu_degree_en' => "Master's Degree in Information Systems & Business Intelligence", '_edu_degree_fr' => "Master 1 & 2 Systèmes d'Information & BI (Bac+5)",
            '_edu_notes_en' => 'Apache Spark, decision-support systems, data architecture.', '_edu_notes_fr' => 'Apache Spark, systèmes décisionnels, architecture data.',
        )),
        array( 'title' => 'Licence', 'meta' => array(
            '_edu_period' => '2024 – 2025', '_edu_school' => 'CNAM – Île-de-France',
            '_edu_degree_en' => "Bachelor's Degree in Computer Science + Professional Bachelor's in Web, Mobile & BI", '_edu_degree_fr' => 'Licence Pro Web, Mobile & BI + Licence Informatique L3',
        )),
        array( 'title' => 'TP TSSR', 'meta' => array(
            '_edu_period' => '2024', '_edu_school' => 'Ressources Formation – Torcy',
            '_edu_degree_en' => 'Advanced Technician Certification — Systems & Networks', '_edu_degree_fr' => 'TP Technicien Supérieur Systèmes et Réseaux',
        )),
        array( 'title' => 'BTS Géomètre', 'meta' => array(
            '_edu_period' => '2018 – 2020', '_edu_school' => 'EBTP – Vincennes',
            '_edu_degree_en' => 'Higher National Diploma in Surveying & Topography', '_edu_degree_fr' => 'BTS Géomètre Topographe',
            '_edu_notes_en' => 'Apprenticeship at GRDF.', '_edu_notes_fr' => 'En alternance chez GRDF.',
        )),
    );
}

/**
 * Demo certifications (CPT hdgavi_certification)
 */
function hdgavi_get_demo_certifications() {
    return array(
        array( 'title' => 'Intro Cybersecurity', 'meta' => array( '_cert_name' => 'Introduction to Cybersecurity', '_cert_org' => 'Cisco', '_cert_status' => 'obtained', '_cert_date' => '2024' )),
        array( 'title' => 'Networking Basics', 'meta' => array( '_cert_name' => 'Networking Basics', '_cert_org' => 'Cisco', '_cert_status' => 'obtained', '_cert_date' => '2024' )),
        array( 'title' => 'Networking Devices', 'meta' => array( '_cert_name' => 'Networking Devices and Initial Configuration', '_cert_org' => 'Cisco', '_cert_status' => 'obtained', '_cert_date' => '2024' )),
        array( 'title' => 'AWS SAA', 'meta' => array( '_cert_name' => 'AWS Solutions Architect Associate', '_cert_org' => 'Amazon Web Services', '_cert_status' => 'in-progress', '_cert_date' => '2025' )),
        array( 'title' => 'CKA', 'meta' => array( '_cert_name' => 'Certified Kubernetes Administrator (CKA)', '_cert_org' => 'CNCF', '_cert_status' => 'planned', '_cert_date' => '2026' )),
        array( 'title' => 'Docker Dev', 'meta' => array( '_cert_name' => 'Docker for Developers', '_cert_org' => 'LinkedIn Learning', '_cert_status' => 'obtained', '_cert_date' => '2024' )),
    );
}

/**
 * Demo timeline events (CPT hdgavi_timeline)
 */
function hdgavi_get_demo_timeline() {
    return array(
        array( 'title' => 'TL DevOps', 'meta' => array( '_tl_title_en' => 'DevOps Engineering Apprentice', '_tl_title_fr' => 'Apprenti Ingénieur DevOps', '_tl_period' => '2024 – Present', '_tl_type' => 'work', '_tl_desc_en' => 'Dassault Systèmes — 3DEXPERIENCE containerization on Kubernetes', '_tl_desc_fr' => 'Dassault Systèmes — Conteneurisation 3DEXPERIENCE sur Kubernetes', '_tl_icon' => '⚙️' )),
        array( 'title' => 'TL Master', 'meta' => array( '_tl_title_en' => "Master's Cybersecurity & Cloud", '_tl_title_fr' => 'Mastère Cybersécurité & Cloud', '_tl_period' => '2024 – 2026', '_tl_type' => 'education', '_tl_desc_en' => 'IPSSI Paris — Cloud security, K8s security, DevOps', '_tl_desc_fr' => 'IPSSI Paris — Sécurité cloud, Kubernetes security, DevOps', '_tl_icon' => '🎓' )),
        array( 'title' => 'TL WordPress', 'meta' => array( '_tl_title_en' => 'WordPress Developer', '_tl_title_fr' => 'Développeur WordPress', '_tl_period' => '2024', '_tl_type' => 'work', '_tl_desc_en' => 'ACOMP Association — Custom themes and plugins', '_tl_desc_fr' => 'ACOMP Association — Thèmes et plugins personnalisés', '_tl_icon' => '💻' )),
        array( 'title' => 'TL TSSR', 'meta' => array( '_tl_title_en' => 'Systems & Networks Technician', '_tl_title_fr' => 'Technicien Systèmes & Réseaux', '_tl_period' => '2024', '_tl_type' => 'education', '_tl_desc_en' => 'Ressources Formation — IT career pivot', '_tl_desc_fr' => 'Ressources Formation — Début reconversion informatique', '_tl_icon' => '🎓' )),
        array( 'title' => 'TL IT Support', 'meta' => array( '_tl_title_en' => 'IT Support Technician', '_tl_title_fr' => 'Technicien Support Informatique', '_tl_period' => '2023', '_tl_type' => 'work', '_tl_desc_en' => 'Lutèce Télécom — Network equipment, Windows/Linux servers', '_tl_desc_fr' => 'Lutèce Télécom — Équipements réseaux, serveurs Windows/Linux', '_tl_icon' => '🖥️' )),
        array( 'title' => 'TL Surveyor', 'meta' => array( '_tl_title_en' => 'Surveyor – Networks & Infrastructure', '_tl_title_fr' => 'Géomètre – Réseaux & Infrastructures', '_tl_period' => '2018 – 2022', '_tl_type' => 'work', '_tl_desc_en' => 'GRDF then SPAC — Topographic surveys and georeferencing', '_tl_desc_fr' => 'GRDF puis SPAC — Relevés topographiques et géoréférencement', '_tl_icon' => '📐' )),
        array( 'title' => 'TL BTS', 'meta' => array( '_tl_title_en' => 'BTS Surveyor Topographer', '_tl_title_fr' => 'BTS Géomètre Topographe', '_tl_period' => '2018 – 2020', '_tl_type' => 'education', '_tl_desc_en' => 'EBTP — Apprenticeship at GRDF', '_tl_desc_fr' => 'EBTP — En alternance chez GRDF', '_tl_icon' => '🎓' )),
        array( 'title' => 'TL Psychology', 'meta' => array( '_tl_title_en' => "Master 1 in Psychology", '_tl_title_fr' => 'Master 1 en Psychologie', '_tl_period' => '2016 – 2018', '_tl_type' => 'education', '_tl_desc_en' => 'University of Lille — Occupational psychology', '_tl_desc_fr' => 'Université de Lille — Psychologie du travail', '_tl_icon' => '🧠' )),
    );
}

/**
 * Demo skills (CPT hdgavi_skill)
 */
function hdgavi_get_demo_skills() {
    $skills = array();
    $categories = array(
        array( 'en' => 'Containerization', 'fr' => 'Conteneurisation', 'es' => 'Contenedorización', 'techs' => array(
            array( 'name' => 'Docker', 'level' => 'expert', 'usage' => 'daily', 'years' => '2' ),
            array( 'name' => 'Kubernetes', 'level' => 'expert', 'usage' => 'daily', 'years' => '2' ),
            array( 'name' => 'Helm Charts', 'level' => 'advanced', 'usage' => 'daily', 'years' => '1' ),
            array( 'name' => 'Podman', 'level' => 'intermediate', 'usage' => 'occasional', 'years' => '1' ),
        )),
        array( 'en' => 'CI/CD & Automation', 'fr' => 'CI/CD & Automatisation', 'es' => 'CI/CD y automatización', 'techs' => array(
            array( 'name' => 'GitLab CI', 'level' => 'advanced', 'usage' => 'regular', 'years' => '2' ),
            array( 'name' => 'Jenkins', 'level' => 'intermediate', 'usage' => 'occasional', 'years' => '1' ),
            array( 'name' => 'Bash', 'level' => 'expert', 'usage' => 'daily', 'years' => '3' ),
            array( 'name' => 'Python', 'level' => 'advanced', 'usage' => 'daily', 'years' => '2' ),
            array( 'name' => 'Ansible', 'level' => 'intermediate', 'usage' => 'occasional', 'years' => '1' ),
            array( 'name' => 'Terraform', 'level' => 'advanced', 'usage' => 'regular', 'years' => '1' ),
        )),
        array( 'en' => 'Cloud & Infrastructure', 'fr' => 'Cloud & Infrastructure', 'es' => 'Cloud e infraestructura', 'techs' => array(
            array( 'name' => 'AWS', 'level' => 'advanced', 'usage' => 'regular', 'years' => '1' ),
            array( 'name' => 'Azure', 'level' => 'intermediate', 'usage' => 'occasional', 'years' => '1' ),
            array( 'name' => 'Linux', 'level' => 'expert', 'usage' => 'daily', 'years' => '3' ),
            array( 'name' => 'Nginx', 'level' => 'advanced', 'usage' => 'regular', 'years' => '2' ),
        )),
        array( 'en' => 'Development', 'fr' => 'Développement', 'es' => 'Desarrollo', 'techs' => array(
            array( 'name' => 'Java', 'level' => 'advanced', 'usage' => 'regular', 'years' => '2' ),
            array( 'name' => 'Spring Boot', 'level' => 'intermediate', 'usage' => 'occasional', 'years' => '1' ),
            array( 'name' => 'React JS', 'level' => 'intermediate', 'usage' => 'occasional', 'years' => '1' ),
            array( 'name' => 'Go', 'level' => 'learning', 'usage' => 'learning', 'years' => '0' ),
        )),
    );

    foreach ( $categories as $cat ) {
        foreach ( $cat['techs'] as $tech ) {
            $skills[] = array(
                'title' => $tech['name'],
                'meta'  => array(
                    '_skill_category_en' => $cat['en'], '_skill_category_fr' => $cat['fr'], '_skill_category_es' => $cat['es'],
                    '_skill_name' => $tech['name'], '_skill_level' => $tech['level'],
                    '_skill_usage' => $tech['usage'], '_skill_years' => $tech['years'],
                ),
            );
        }
    }
    return $skills;
}

/**
 * Generic CPT importer (reused for all types)
 */
function hdgavi_import_demo_cpt( $post_type, $items, $option_key, $force = false ) {
    if ( ! $force && get_option( $option_key ) ) {
        return array( 'created' => 0, 'skipped' => 'already imported' );
    }

    $created = 0;
    foreach ( $items as $index => $item ) {
        $exists = get_posts( array(
            'post_type'      => $post_type,
            'title'          => $item['title'],
            'post_status'    => array( 'publish', 'draft', 'private', 'trash' ),
            'posts_per_page' => 1,
            'fields'         => 'ids',
        ) );
        if ( ! empty( $exists ) ) {
            if ( ! $force ) continue;
            $post_id = $exists[0];
            wp_update_post( array(
                'ID'          => $post_id,
                'post_status' => 'publish',
                'menu_order'  => $index + 1,
            ) );
            foreach ( $item['meta'] as $key => $val ) {
                update_post_meta( $post_id, $key, $val );
            }
            update_post_meta( $post_id, '_hdgavi_demo', '1' );
            $created++;
            continue;
        }

        $post_id = wp_insert_post( array(
            'post_title'  => $item['title'],
            'post_status' => 'publish',
            'post_type'   => $post_type,
            'menu_order'  => $index + 1,
            'post_author' => get_current_user_id() ?: 1,
        ) );

        if ( is_wp_error( $post_id ) ) continue;

        update_post_meta( $post_id, '_hdgavi_demo', '1' );
        foreach ( $item['meta'] as $key => $val ) {
            update_post_meta( $post_id, $key, $val );
        }

        $created++;
    }

    update_option( $option_key, true, false );
    return array( 'created' => $created );
}

/**
 * Demo projects (CPT hdgavi_project) with gallery screenshots
 */
function hdgavi_get_demo_projects() {
    $placeholder = 'https://placehold.co/800x500/%s/%s?text=%s';
    return array(
        array(
            'title' => '3DEXPERIENCE Platform',
            'meta'  => array(
                '_proj_tag'        => 'pro',
                '_proj_title_en'   => '3DEXPERIENCE Platform – Containerized Deployment',
                '_proj_title_fr'   => 'Plateforme 3DEXPERIENCE – Déploiement conteneurisé',
                '_proj_title_es'   => 'Plataforma 3DEXPERIENCE – Despliegue contenedorizado',
                '_proj_desc_en'    => 'Industrialized deployment of the 3DEXPERIENCE platform using Docker, Kubernetes and Helm at Dassault Systèmes.',
                '_proj_desc_fr'    => 'Industrialisation du déploiement de la plateforme 3DEXPERIENCE via Docker, Kubernetes et Helm chez Dassault Systèmes.',
                '_proj_desc_es'    => 'Industrialización del despliegue de la plataforma 3DEXPERIENCE usando Docker, Kubernetes y Helm en Dassault Systèmes.',
                '_proj_techs'      => 'Docker, Kubernetes, Helm, Bash, Python, CI/CD',
                '_proj_is_case_study' => '1',
                '_proj_problem_en' => 'Manual deployment took 4+ hours per environment with frequent configuration drift.',
                '_proj_problem_fr' => 'Le déploiement manuel prenait plus de 4h par environnement avec des dérives de configuration fréquentes.',
                '_proj_solution_en' => 'Containerized all services, created Helm charts with value overrides per environment, automated CI/CD pipeline.',
                '_proj_solution_fr' => 'Conteneurisation de tous les services, création de charts Helm avec overrides par environnement, pipeline CI/CD automatisé.',
                '_proj_result_en'  => 'Deployment time reduced from 4h to 15min. Zero configuration drift. 99.9% uptime.',
                '_proj_result_fr'  => 'Temps de déploiement réduit de 4h à 15min. Zéro dérive de configuration. 99.9% uptime.',
                '_proj_metrics'    => 'Deploy time:4h→15min, Uptime:99.2%→99.9%, Envs:3→12',
                '_proj_gallery'    => sprintf( $placeholder, '1a1a2e', '06B6D4', 'K8s+Dashboard' ) . "\n"
                                    . sprintf( $placeholder, '0d1117', '58a6ff', 'Helm+Charts' ) . "\n"
                                    . sprintf( $placeholder, '1c1c2e', '22C55E', 'CI/CD+Pipeline' ),
            ),
        ),
        array(
            'title' => 'ODT Runner',
            'meta'  => array(
                '_proj_tag'        => 'pro',
                '_proj_title_en'   => 'ODT Runner – Containerized Test Orchestrator',
                '_proj_title_fr'   => 'ODT Runner – Orchestrateur de tests conteneurisés',
                '_proj_title_es'   => 'ODT Runner – Orquestador de pruebas contenedorizadas',
                '_proj_desc_en'    => 'Automated containerized test orchestrator for 3DEXPERIENCE platform validation. Reduced workflow from 9 to 3 steps.',
                '_proj_desc_fr'    => "Orchestrateur de tests automatisés conteneurisés pour la validation 3DEXPERIENCE. Réduction du workflow de 9 à 3 étapes.",
                '_proj_desc_es'    => 'Orquestador de pruebas contenedorizadas para la validación de 3DEXPERIENCE. Reducción del flujo de 9 a 3 pasos.',
                '_proj_techs'      => 'Docker, Java, YAML, Chrome Headless, Bash',
                '_proj_gallery'    => sprintf( $placeholder, '0f172a', '818CF8', 'Test+Runner' ) . "\n"
                                    . sprintf( $placeholder, '1e293b', 'f59e0b', 'Test+Results' ),
            ),
        ),
        array(
            'title' => 'AWS 3-tier Architecture',
            'meta'  => array(
                '_proj_tag'        => 'academic',
                '_proj_title_en'   => 'AWS 3-tier High Availability Architecture',
                '_proj_title_fr'   => 'Architecture AWS 3-tiers haute disponibilité',
                '_proj_title_es'   => 'Arquitectura AWS 3-tiers de alta disponibilidad',
                '_proj_desc_en'    => 'Deployed a highly available 3-tier cloud architecture on AWS with Terraform.',
                '_proj_desc_fr'    => "Déploiement d'une architecture cloud 3-tiers hautement disponible sur AWS avec Terraform.",
                '_proj_desc_es'    => 'Despliegue de una arquitectura cloud 3-tiers de alta disponibilidad en AWS con Terraform.',
                '_proj_techs'      => 'AWS, Terraform, VPC, ALB, ASG',
                '_proj_gallery'    => sprintf( $placeholder, '232f3e', 'ff9900', 'AWS+Diagram' ) . "\n"
                                    . sprintf( $placeholder, '131a22', '06B6D4', 'Terraform+Plan' ) . "\n"
                                    . sprintf( $placeholder, '1a1a2e', '22C55E', 'CloudWatch' ) . "\n"
                                    . sprintf( $placeholder, '0d1117', 'f59e0b', 'Cost+Explorer' ),
            ),
        ),
        array(
            'title' => 'Linux Hardening',
            'meta'  => array(
                '_proj_tag'        => 'academic',
                '_proj_title_en'   => 'Linux Infrastructure Hardening',
                '_proj_title_fr'   => 'Hardening Infrastructure Linux',
                '_proj_title_es'   => 'Endurecimiento de infraestructura Linux',
                '_proj_desc_en'    => 'PKI, SSH multi-factor authentication, Fail2ban intrusion prevention and ModSecurity WAF.',
                '_proj_desc_fr'    => 'PKI, authentification SSH multi-facteurs, prévention d\'intrusion Fail2ban et pare-feu applicatif ModSecurity.',
                '_proj_desc_es'    => 'PKI, autenticación SSH multifactor, prevención de intrusiones Fail2ban y WAF ModSecurity.',
                '_proj_techs'      => 'Linux, PKI, SSH MFA, Fail2ban, ModSecurity',
                '_proj_gallery'    => sprintf( $placeholder, '1a1a2e', 'ef4444', 'Fail2ban+Logs' ) . "\n"
                                    . sprintf( $placeholder, '0d1117', '22C55E', 'PKI+Setup' ),
            ),
        ),
        array(
            'title' => 'HD GAVI Portfolio',
            'meta'  => array(
                '_proj_tag'        => 'personal',
                '_proj_title_en'   => 'HD GAVI Portfolio – Custom WordPress Theme',
                '_proj_title_fr'   => 'HD GAVI Portfolio – Thème WordPress custom',
                '_proj_title_es'   => 'HD GAVI Portfolio – Tema WordPress personalizado',
                '_proj_desc_en'    => 'Full-featured portfolio theme with 8 CPTs, trilingual support, AI chatbot, CV download gate, and analytics dashboard.',
                '_proj_desc_fr'    => 'Thème portfolio complet avec 8 CPTs, support trilingue, chatbot IA, gate de téléchargement CV et dashboard analytics.',
                '_proj_desc_es'    => 'Tema portfolio completo con 8 CPTs, soporte trilingüe, chatbot IA, descarga de CV y dashboard analytics.',
                '_proj_techs'      => 'WordPress, PHP, JavaScript, CSS, REST API',
                '_proj_link'       => 'https://github.com/g-holali-david/hdgavi-portfolio',
                '_proj_gallery'    => sprintf( $placeholder, '0B0F1A', '06B6D4', 'Portfolio+Home' ) . "\n"
                                    . sprintf( $placeholder, '1a1a2e', '818CF8', 'Projects+Page' ) . "\n"
                                    . sprintf( $placeholder, '0d1117', '22C55E', 'Admin+Dashboard' ),
            ),
        ),
    );
}

function hdgavi_import_demo_projects( $force = false ) {
    if ( ! $force && get_option( 'hdgavi_demo_projects_imported' ) ) {
        return array( 'created' => 0, 'skipped' => 'already imported' );
    }

    $projects = hdgavi_get_demo_projects();
    $created  = 0;

    foreach ( $projects as $index => $project ) {
        $exists = get_posts( array( 'post_type' => 'hdgavi_project', 'title' => $project['title'], 'post_status' => array( 'publish', 'draft', 'private', 'trash' ), 'posts_per_page' => 1, 'fields' => 'ids' ) );
        if ( ! empty( $exists ) ) {
            if ( ! $force ) continue;
            $post_id = $exists[0];
            wp_update_post( array( 'ID' => $post_id, 'post_status' => 'publish', 'menu_order' => $index + 1 ) );
            foreach ( $project['meta'] as $key => $val ) {
                if ( in_array( $key, array( '_proj_link' ), true ) ) {
                    update_post_meta( $post_id, $key, esc_url_raw( $val ) );
                } else {
                    update_post_meta( $post_id, $key, sanitize_textarea_field( $val ) );
                }
            }
            continue;
        }

        $post_id = wp_insert_post( array(
            'post_title'  => $project['title'],
            'post_status' => 'publish',
            'post_type'   => 'hdgavi_project',
            'menu_order'  => $index + 1,
            'post_author' => get_current_user_id() ?: 1,
        ) );

        if ( is_wp_error( $post_id ) ) continue;

        update_post_meta( $post_id, '_hdgavi_demo', '1' );
        foreach ( $project['meta'] as $key => $val ) {
            if ( in_array( $key, array( '_proj_link' ), true ) ) {
                update_post_meta( $post_id, $key, esc_url_raw( $val ) );
            } else {
                update_post_meta( $post_id, $key, sanitize_textarea_field( $val ) );
            }
        }

        $created++;
    }

    update_option( 'hdgavi_demo_projects_imported', true, false );
    return array( 'created' => $created );
}

/**
 * AJAX handler for demo content import
 */
function hdgavi_ajax_import_demo() {
	check_ajax_referer( 'hdgavi_create_pages', 'nonce' );
	if ( ! current_user_can( 'edit_theme_options' ) ) {
		wp_send_json_error( array( 'message' => 'Permission denied.' ) );
	}

	$force  = ! empty( $_POST['force'] );
	$result = hdgavi_import_demo_content( $force );

	// Import all demo CPTs
	$articles_result  = hdgavi_import_demo_articles( $force );
	$resources_result = hdgavi_import_demo_resources( $force );
	$projects_result  = hdgavi_import_demo_projects( $force );
	$exp_result       = hdgavi_import_demo_cpt( 'hdgavi_experience', hdgavi_get_demo_experiences(), 'hdgavi_demo_experiences_imported', $force );
	$edu_result       = hdgavi_import_demo_cpt( 'hdgavi_education', hdgavi_get_demo_educations(), 'hdgavi_demo_educations_imported', $force );
	$cert_result      = hdgavi_import_demo_cpt( 'hdgavi_certification', hdgavi_get_demo_certifications(), 'hdgavi_demo_certifications_imported', $force );
	$tl_result        = hdgavi_import_demo_cpt( 'hdgavi_timeline', hdgavi_get_demo_timeline(), 'hdgavi_demo_timeline_imported', $force );
	$skill_result     = hdgavi_import_demo_cpt( 'hdgavi_skill', hdgavi_get_demo_skills(), 'hdgavi_demo_skills_imported', $force );

	$details = array(
		'options'        => $result['set'] . ' set, ' . $result['skipped'] . ' skipped',
		'articles'       => $articles_result['created'] ?? ( $articles_result['skipped'] ?? 0 ),
		'resources'      => $resources_result['created'] ?? ( $resources_result['skipped'] ?? 0 ),
		'projects'       => $projects_result['created'] ?? ( $projects_result['skipped'] ?? 0 ),
		'experiences'    => $exp_result['created'] ?? ( $exp_result['skipped'] ?? 0 ),
		'educations'     => $edu_result['created'] ?? ( $edu_result['skipped'] ?? 0 ),
		'certifications' => $cert_result['created'] ?? ( $cert_result['skipped'] ?? 0 ),
		'timeline'       => $tl_result['created'] ?? ( $tl_result['skipped'] ?? 0 ),
		'skills'         => $skill_result['created'] ?? ( $skill_result['skipped'] ?? 0 ),
	);

	$cpt_total = ( $projects_result['created'] ?? 0 ) + ( $exp_result['created'] ?? 0 ) + ( $edu_result['created'] ?? 0 )
	           + ( $cert_result['created'] ?? 0 ) + ( $tl_result['created'] ?? 0 ) + ( $skill_result['created'] ?? 0 )
	           + ( $resources_result['created'] ?? 0 );

	$msg = sprintf(
		'Options: %d set, %d skipped. Articles: %d. CPTs: %d (edu:%d, exp:%d, skill:%d, proj:%d, cert:%d, tl:%d, res:%d).',
		$result['set'],
		$result['skipped'],
		$articles_result['created'] ?? 0,
		$cpt_total,
		$edu_result['created'] ?? 0,
		$exp_result['created'] ?? 0,
		$skill_result['created'] ?? 0,
		$projects_result['created'] ?? 0,
		$cert_result['created'] ?? 0,
		$tl_result['created'] ?? 0,
		$resources_result['created'] ?? 0
	);
	if ( $force ) $msg .= ' [FORCE mode]';

	wp_send_json_success( array(
		'message' => $msg,
		'details' => $details,
	) );
}
add_action( 'wp_ajax_hdgavi_import_demo', 'hdgavi_ajax_import_demo' );

/**
 * Auto-import demo content if it was never imported and key fields are empty.
 * Runs once, then sets a flag so it doesn't run again.
 */
function hdgavi_maybe_auto_import_demo() {
    if ( get_option( 'hdgavi_demo_auto_imported' ) ) return;
    // Only auto-import if no name is set (fresh install)
    $name = get_theme_mod( 'general_name' );
    if ( ! empty( $name ) ) {
        update_option( 'hdgavi_demo_auto_imported', true, false );
        return;
    }
    hdgavi_import_demo_content( false );
    update_option( 'hdgavi_demo_auto_imported', true, false );
}
add_action( 'admin_init', 'hdgavi_maybe_auto_import_demo' );
