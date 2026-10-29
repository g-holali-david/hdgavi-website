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
	$seo = array(
		'home'           => array( 'Holali David GAVI — DevOps / Cloud Native Engineer', 'Holali David GAVI — Ingénieur DevOps / Cloud Native', 'Holali David GAVI — Ingeniero DevOps / Cloud Native',
			'Holali David GAVI, DevOps / Cloud Native engineer on a work-study contract at Dassault Systèmes: Kubernetes, Helm, CI/CD, containerisation and container security.',
			'Holali David GAVI, ingénieur DevOps / Cloud Native en alternance chez Dassault Systèmes : Kubernetes, Helm, CI/CD, conteneurisation et sécurisation des conteneurs.',
			'Holali David GAVI, ingeniero DevOps / Cloud Native en alternancia en Dassault Systèmes: Kubernetes, Helm, CI/CD, contenedorización y seguridad de contenedores.' ),
		'about'          => array( 'About – Holali David GAVI', 'À propos – Holali David GAVI', 'Sobre mí – Holali David GAVI',
			'Current role at Dassault Systèmes, education and goals of Holali David GAVI, DevOps / Cloud Native engineer.',
			'Poste actuel chez Dassault Systèmes, formation et objectifs de Holali David GAVI, ingénieur DevOps / Cloud Native.',
			'Puesto actual en Dassault Systèmes, formación y objetivos de Holali David GAVI, ingeniero DevOps / Cloud Native.' ),
		'skills'         => array( 'Skills – Holali David GAVI', 'Compétences – Holali David GAVI', 'Competencias – Holali David GAVI',
			'Docker, Kubernetes, Helm, Istio, Jenkins, GitLab CI, GitHub Actions, ArgoCD, AWS, Terraform, Ansible, Kyverno, Trivy, Prometheus, Grafana, Java, Python, Bash.',
			'Docker, Kubernetes, Helm, Istio, Jenkins, GitLab CI, GitHub Actions, ArgoCD, AWS, Terraform, Ansible, Kyverno, Trivy, Prometheus, Grafana, Java, Python, Bash.',
			'Docker, Kubernetes, Helm, Istio, Jenkins, GitLab CI, GitHub Actions, ArgoCD, AWS, Terraform, Ansible, Kyverno, Trivy, Prometheus, Grafana, Java, Python, Bash.' ),
		'experience'     => array( 'Experience – Holali David GAVI', 'Expérience – Holali David GAVI', 'Experiencia – Holali David GAVI',
			'DevOps / Cloud Native engineer (work-study) at Dassault Systèmes since November 2024, plus WordPress, Flutter and IT support roles.',
			'Ingénieur DevOps / Cloud Native en alternance chez Dassault Systèmes depuis novembre 2024, ainsi que des missions WordPress, Flutter et support informatique.',
			'Ingeniero DevOps / Cloud Native en alternancia en Dassault Systèmes desde noviembre de 2024, además de misiones WordPress, Flutter y soporte informático.' ),
		'projects'       => array( 'Projects – Holali David GAVI', 'Projets – Holali David GAVI', 'Proyectos – Holali David GAVI',
			'Technical projects: AWS DevOps platform, DevSecOps pipeline, GitOps microservices architecture and a DevOps CLI in Go.',
			'Projets techniques : plateforme DevOps AWS, pipeline DevSecOps, architecture microservices GitOps et CLI DevOps en Go.',
			'Proyectos técnicos: plataforma DevOps en AWS, pipeline DevSecOps, arquitectura de microservicios GitOps y una CLI DevOps en Go.' ),
		'education'      => array( 'Education – Holali David GAVI', 'Formation – Holali David GAVI', 'Formación – Holali David GAVI',
			'Mastère in Cybersecurity & Cloud Computing (IPSSI), Master 1 and bachelor’s degrees at CNAM, professional title in systems and networks.',
			'Mastère Cybersécurité & Cloud Computing (IPSSI), Master 1 et licences au CNAM, titre professionnel Technicien Supérieur Systèmes et Réseaux.',
			'Mastère en Ciberseguridad y Cloud Computing (IPSSI), Máster 1 y licenciaturas en el CNAM, título profesional en sistemas y redes.' ),
		'contact'        => array( 'Contact – Holali David GAVI', 'Contact – Holali David GAVI', 'Contacto – Holali David GAVI',
			'Contact Holali David GAVI: e-mail, phone, LinkedIn and GitHub.',
			'Contacter Holali David GAVI : e-mail, téléphone, LinkedIn et GitHub.',
			'Contactar con Holali David GAVI: correo, teléfono, LinkedIn y GitHub.' ),
		'availability'   => array( 'Availability – Holali David GAVI', 'Disponibilité – Holali David GAVI', 'Disponibilidad – Holali David GAVI',
			'Work-study at Dassault Systèmes; looking for a permanent contract on Cloud, DevOps, Platform Engineering or SRE projects.',
			'Alternance chez Dassault Systèmes ; recherche d’un CDI sur des projets Cloud, DevOps, Platform Engineering ou SRE.',
			'Alternancia en Dassault Systèmes; busca un contrato indefinido en proyectos Cloud, DevOps, Platform Engineering o SRE.' ),
		'timeline'       => array( 'Timeline – Holali David GAVI', 'Parcours – Holali David GAVI', 'Trayectoria – Holali David GAVI',
			'Experience and education of Holali David GAVI in chronological order.',
			'Expériences et formations de Holali David GAVI, par ordre chronologique.',
			'Experiencia y formación de Holali David GAVI en orden cronológico.' ),
		'blog'           => array( 'Blog – Holali David GAVI', 'Blog – Holali David GAVI', 'Blog – Holali David GAVI',
			'Articles by Holali David GAVI.', 'Articles de Holali David GAVI.', 'Artículos de Holali David GAVI.' ),
		'watch'          => array( 'Tech watch – Holali David GAVI', 'Veille – Holali David GAVI', 'Vigilancia – Holali David GAVI',
			'Tech watch on cloud and cybersecurity.', 'Veille technologique cloud et cybersécurité.', 'Vigilancia tecnológica sobre cloud y ciberseguridad.' ),
		'legal'          => array( 'Legal notice – Holali David GAVI', 'Mentions légales – Holali David GAVI', 'Aviso legal – Holali David GAVI',
			'Legal notice and privacy policy.', 'Mentions légales et politique de confidentialité.', 'Aviso legal y política de privacidad.' ),
	);

	$content = array(
		/* ── General ── */
		'general_name'           => 'Holali David GAVI',
		'general_email'          => 'g.holalidavid@gmail.com',
		'general_location'       => 'Aubervilliers (93300), Île-de-France',
		'contact_github'         => 'https://github.com/g-holali-david',
		'contact_github_handle'  => 'g-holali-david',
		'contact_linkedin'       => 'https://www.linkedin.com/in/holali-david-g-4a434631a/',
		'contact_phone'          => '07 63 15 25 91',
		'default_lang'           => 'en',
		'show_rqth'              => false,
		'footer_name'            => 'Holali David GAVI',

		/* ── Titles used by older settings ── */
		'splash_title'           => 'Holali David GAVI',
		'splash_subtitle_en'     => 'DevOps / Cloud Native Engineer',
		'splash_subtitle_fr'     => 'Ingénieur DevOps / Cloud Native',
		'splash_subtitle_es'     => 'Ingeniero DevOps / Cloud Native',
		'about_badge_en'         => 'DevOps / Cloud Native Engineer',
		'about_badge_fr'         => 'Ingénieur DevOps / Cloud Native',
		'about_badge_es'         => 'Ingeniero DevOps / Cloud Native',
		'footer_desc_en'         => 'DevOps / Cloud Native Engineer',
		'footer_desc_fr'         => 'Ingénieur DevOps / Cloud Native',
		'footer_desc_es'         => 'Ingeniero DevOps / Cloud Native',
		'seo_job_title'          => 'DevOps / Cloud Native Engineer',
		'seo_company'            => 'Dassault Systèmes',

		/* ── Hidden /terminal page ── */
		'term_page_prompt'      => '$',
		'term_page_welcome_en'  => 'Type "help" for the list of commands.',
		'term_page_welcome_fr'  => 'Tapez "help" pour la liste des commandes.',

		/* ── Contact details ── */
		'gh_repos_enabled'      => false,
		'copy_feedback_en'      => 'Copied',
		'copy_feedback_fr'      => 'Copié',
		'copy_feedback_es'      => 'Copiado',

		/* ── Legal ── */
		'legal_hosting_name'    => 'OVH / o2switch',
		'legal_hosting_address' => 'France',

		/* ── Roadmap (secondary page, CV goals only) ── */
		'roadmap_cat_1_en' => 'Education', 'roadmap_cat_1_fr' => 'Formation', 'roadmap_cat_1_icon' => '',
		'roadmap_cat_1_items' => "[ ] Mastère Cybersécurité & Cloud Computing, IPSSI (2024 – 2026)",
		'roadmap_cat_2_en' => 'Career', 'roadmap_cat_2_fr' => 'Objectif professionnel', 'roadmap_cat_2_icon' => '',
		'roadmap_cat_2_items' => "[ ] CDI au sein de Dassault Systèmes, sur des projets Cloud, DevOps, Platform Engineering ou SRE",
		'roadmap_cat_3_en' => '', 'roadmap_cat_3_fr' => '', 'roadmap_cat_3_icon' => '', 'roadmap_cat_3_items' => '',

		/* ── Uses (secondary page): no emoji icons ── */
		'uses_cat_1_icon' => '', 'uses_cat_2_icon' => '', 'uses_cat_3_icon' => '',
	);

	foreach ( $seo as $page => $v ) {
		$content[ 'seo_' . $page . '_title_en' ] = $v[0];
		$content[ 'seo_' . $page . '_title_fr' ] = $v[1];
		$content[ 'seo_' . $page . '_title_es' ] = $v[2];
		$content[ 'seo_' . $page . '_desc_en' ]  = $v[3];
		$content[ 'seo_' . $page . '_desc_fr' ]  = $v[4];
		$content[ 'seo_' . $page . '_desc_es' ]  = $v[5];
	}
	return $content;
}

/**
 * Settings that the "sync with the CV" action always overwrites (facts that changed with the new CV).
 */
function hdgavi_cv_sync_keys() {
	$keys = array( 'general_location', 'splash_subtitle_en', 'splash_subtitle_fr', 'splash_subtitle_es',
		'about_badge_en', 'about_badge_fr', 'about_badge_es', 'footer_desc_en', 'footer_desc_fr', 'footer_desc_es',
		'seo_job_title', 'seo_company', 'gh_repos_enabled', 'show_rqth', 'term_page_prompt', 'copy_feedback_en', 'copy_feedback_fr', 'copy_feedback_es',
		'roadmap_cat_1_en', 'roadmap_cat_1_fr', 'roadmap_cat_1_icon', 'roadmap_cat_1_items',
		'roadmap_cat_2_en', 'roadmap_cat_2_fr', 'roadmap_cat_2_icon', 'roadmap_cat_2_items',
		'roadmap_cat_3_en', 'roadmap_cat_3_fr', 'roadmap_cat_3_icon', 'roadmap_cat_3_items',
		'uses_cat_1_icon', 'uses_cat_2_icon', 'uses_cat_3_icon' );
	foreach ( array_keys( hdgavi_get_demo_content() ) as $key ) {
		if ( 0 === strpos( $key, 'seo_' ) ) $keys[] = $key;
	}
	return array_unique( $keys );
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
    // No demo resources: the previous examples (templates, kits, prices) were invented.
    return array();
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
 * Demo experiences (CPT hdgavi_experience) — from the CV, see inc/cv-content.php
 */
function hdgavi_get_demo_experiences() {
    return hdgavi_cv_experiences();
}

/**
 * Demo education (CPT hdgavi_education) — from the CV
 */
function hdgavi_get_demo_educations() {
    return hdgavi_cv_educations();
}

/**
 * Demo certifications (CPT hdgavi_certification) — none: the CV lists no certification
 */
function hdgavi_get_demo_certifications() {
    return array();
}

/**
 * Demo timeline events (CPT hdgavi_timeline) — from the CV
 */
function hdgavi_get_demo_timeline() {
    return hdgavi_cv_timeline();
}

/**
 * Demo skills (CPT hdgavi_skill) — the seven categories of the CV
 */
function hdgavi_get_demo_skills() {
    return hdgavi_cv_skills();
}

/**
 * Generic CPT importer (reused for all types).
 * With $force: matching posts (by title) are overwritten — theme meta absent from the dataset is
 * deleted — and demo posts (_hdgavi_demo = 1) that are no longer in the dataset go to the trash.
 * Posts created by hand (without the demo flag) are never trashed.
 */
function hdgavi_import_demo_cpt( $post_type, $items, $option_key, $force = false ) {
    if ( ! $force && get_option( $option_key ) ) {
        return array( 'created' => 0, 'skipped' => 'already imported' );
    }

    $created  = 0;
    $updated  = 0;
    $keep_ids = array();
    foreach ( $items as $index => $item ) {
        $exists = get_posts( array(
            'post_type'      => $post_type,
            'title'          => $item['title'],
            'post_status'    => array( 'publish', 'draft', 'private', 'trash' ),
            'posts_per_page' => 1,
            'fields'         => 'ids',
        ) );
        if ( ! empty( $exists ) ) {
            $post_id    = $exists[0];
            $keep_ids[] = $post_id;
            if ( ! $force ) continue;
            if ( 'trash' === get_post_status( $post_id ) ) wp_untrash_post( $post_id );
            wp_update_post( array(
                'ID'          => $post_id,
                'post_status' => 'publish',
                'menu_order'  => $index + 1,
            ) );
            hdgavi_demo_replace_meta( $post_id, $item['meta'] );
            $updated++;
            continue;
        }

        $post_id = wp_insert_post( array(
            'post_title'  => $item['title'],
            'post_status' => 'publish',
            'post_type'   => $post_type,
            'menu_order'  => $index + 1,
            'post_author' => get_current_user_id() ?: 1,
        ) );

        if ( is_wp_error( $post_id ) || ! $post_id ) continue;
        $keep_ids[] = $post_id;

        update_post_meta( $post_id, '_hdgavi_demo', '1' );
        foreach ( $item['meta'] as $key => $val ) {
            update_post_meta( $post_id, $key, $val );
        }

        $created++;
    }

    $trashed = $force ? hdgavi_demo_trash_obsolete( $post_type, $keep_ids ) : 0;

    update_option( $option_key, true, false );
    return array( 'created' => $created, 'updated' => $updated, 'trashed' => $trashed );
}

/**
 * Overwrite the theme meta of a post with a dataset item; theme meta not in the item is deleted.
 */
function hdgavi_demo_replace_meta( $post_id, $meta ) {
    $prefixes = array( '_exp_', '_proj_', '_edu_', '_cert_', '_tl_', '_skill_' );
    foreach ( array_keys( get_post_meta( $post_id ) ) as $key ) {
        foreach ( $prefixes as $prefix ) {
            if ( 0 === strpos( $key, $prefix ) && ! array_key_exists( $key, $meta ) ) {
                delete_post_meta( $post_id, $key );
                break;
            }
        }
    }
    foreach ( $meta as $key => $val ) {
        update_post_meta( $post_id, $key, $val );
    }
    update_post_meta( $post_id, '_hdgavi_demo', '1' );
}

/**
 * Trash the demo posts of a type that are not in $keep_ids. Returns how many were trashed.
 */
function hdgavi_demo_trash_obsolete( $post_type, $keep_ids ) {
    $obsolete = get_posts( array(
        'post_type'      => $post_type,
        'post_status'    => array( 'publish', 'draft', 'private' ),
        'posts_per_page' => -1,
        'fields'         => 'ids',
        'meta_key'       => '_hdgavi_demo',
        'meta_value'     => '1',
        'post__not_in'   => $keep_ids ? $keep_ids : array( 0 ),
    ) );
    foreach ( $obsolete as $id ) {
        wp_trash_post( $id );
    }
    return count( $obsolete );
}

/**
 * Demo projects (CPT hdgavi_project) — the four projects of the CV
 */
function hdgavi_get_demo_projects() {
    return hdgavi_cv_projects();
}

function hdgavi_import_demo_projects( $force = false ) {
    return hdgavi_import_demo_cpt( 'hdgavi_project', hdgavi_get_demo_projects(), 'hdgavi_demo_projects_imported', $force );
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

/* ═══════════════════════════════════════
   SYNC WITH THE NEW CV (one click, from the admin notice)
   ═══════════════════════════════════════ */

define( 'HDGAVI_CV_CONTENT_VERSION', '2026-10' );

/**
 * Overwrite the CV content (experience, education, skills, projects, timeline, certifications,
 * plus the settings listed in hdgavi_cv_sync_keys()) with the data of inc/cv-content.php.
 */
function hdgavi_sync_cv_content() {
    $demo = hdgavi_get_demo_content();
    foreach ( hdgavi_cv_sync_keys() as $key ) {
        if ( array_key_exists( $key, $demo ) ) set_theme_mod( $key, $demo[ $key ] );
    }
    $report = array(
        'experience'     => hdgavi_import_demo_cpt( 'hdgavi_experience', hdgavi_get_demo_experiences(), 'hdgavi_demo_experiences_imported', true ),
        'education'      => hdgavi_import_demo_cpt( 'hdgavi_education', hdgavi_get_demo_educations(), 'hdgavi_demo_educations_imported', true ),
        'skills'         => hdgavi_import_demo_cpt( 'hdgavi_skill', hdgavi_get_demo_skills(), 'hdgavi_demo_skills_imported', true ),
        'projects'       => hdgavi_import_demo_projects( true ),
        'timeline'       => hdgavi_import_demo_cpt( 'hdgavi_timeline', hdgavi_get_demo_timeline(), 'hdgavi_demo_timeline_imported', true ),
        'certifications' => hdgavi_import_demo_cpt( 'hdgavi_certification', hdgavi_get_demo_certifications(), 'hdgavi_demo_certifications_imported', true ),
        // The demo "resources" (templates, kits, prices) were invented: imported ones go to the trash.
        'resources'      => array( 'created' => 0, 'updated' => 0, 'trashed' => hdgavi_demo_trash_obsolete( 'hdgavi_resource', array() ) ),
    );
    update_option( 'hdgavi_cv_content_version', HDGAVI_CV_CONTENT_VERSION, false );
    return $report;
}

function hdgavi_handle_sync_cv() {
    if ( ! current_user_can( 'edit_theme_options' ) ) wp_die( 'Permission denied.' );
    check_admin_referer( 'hdgavi_sync_cv' );
    $report = hdgavi_sync_cv_content();
    $parts  = array();
    foreach ( $report as $type => $r ) {
        $parts[] = $type . ': ' . intval( $r['created'] ?? 0 ) . ' créé(s), ' . intval( $r['updated'] ?? 0 ) . ' mis à jour, ' . intval( $r['trashed'] ?? 0 ) . ' à la corbeille';
    }
    set_transient( 'hdgavi_cv_sync_report', implode( ' · ', $parts ), 120 );
    wp_safe_redirect( wp_get_referer() ? wp_get_referer() : admin_url() );
    exit;
}
add_action( 'admin_post_hdgavi_sync_cv', 'hdgavi_handle_sync_cv' );

function hdgavi_sync_cv_notice() {
    if ( ! current_user_can( 'edit_theme_options' ) ) return;
    $report = get_transient( 'hdgavi_cv_sync_report' );
    if ( $report ) {
        delete_transient( 'hdgavi_cv_sync_report' );
        echo '<div class="notice notice-success is-dismissible"><p><strong>Contenu synchronisé avec le CV.</strong> ' . esc_html( $report ) . '</p></div>';
        return;
    }
    if ( HDGAVI_CV_CONTENT_VERSION === get_option( 'hdgavi_cv_content_version' ) ) return;
    ?>
    <div class="notice notice-warning">
        <p><strong>HD GAVI Portfolio 7 :</strong> le contenu du site (expériences, formations, compétences, projets) peut être aligné sur le CV d’octobre 2026.
        Les anciennes entrées importées automatiquement qui ne figurent plus sur le CV seront mises à la corbeille ; les contenus créés à la main ne sont pas touchés.</p>
        <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" style="margin:0 0 10px">
            <input type="hidden" name="action" value="hdgavi_sync_cv">
            <?php wp_nonce_field( 'hdgavi_sync_cv' ); ?>
            <button type="submit" class="button button-primary">Synchroniser avec le CV</button>
        </form>
    </div>
    <?php
}
add_action( 'admin_notices', 'hdgavi_sync_cv_notice' );
