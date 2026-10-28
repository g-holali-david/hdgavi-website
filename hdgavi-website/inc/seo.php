<?php
/**
 * HD GAVI Portfolio — SEO: meta tags, JSON-LD, OG, canonical, hreflang (v6.2.0)
 * @package HDGavi_Portfolio
 */
if ( ! defined( 'ABSPATH' ) ) exit;

function hdgavi_seo_head() {
	// Indexation control
	if ( ! hdgavi_opt( 'seo_indexation', true ) ) {
		echo '<meta name="robots" content="noindex, nofollow">' . "\n";
	}

	$name         = hdgavi_opt( 'general_name', 'Holali David GAVI' );
	$og_image     = hdgavi_opt( 'seo_og_image', '' );
	$url          = get_permalink();
	$default_lang = hdgavi_opt( 'default_lang', 'en' );

	// Determine current page slug for per-page SEO
	$page_slug = 'home';
	$slug_map  = array(
		'about', 'skills', 'experience', 'projects', 'education', 'contact',
		'watch', 'blog', 'certifications', 'timeline', 'stack', 'testimonials',
		'presentation', 'newsletter', 'uses', 'roadmap', 'availability', 'legal',
		'services', 'booking', 'resources', 'analytics',
	);
	foreach ( $slug_map as $slug ) {
		if ( is_page_template( "page-templates/{$slug}.php" ) ) {
			$page_slug = $slug;
			break;
		}
	}

	$seo_title_en = hdgavi_opt( "seo_{$page_slug}_title_en", $name . ' — Portfolio' );
	$seo_title_fr = hdgavi_opt( "seo_{$page_slug}_title_fr", $name . ' — Portfolio' );
	$seo_title_es = hdgavi_opt( "seo_{$page_slug}_title_es", $name . ' — Portfolio' );
	$seo_desc_en  = hdgavi_opt( "seo_{$page_slug}_desc_en", '' );
	$seo_desc_fr  = hdgavi_opt( "seo_{$page_slug}_desc_fr", '' );
	$seo_desc_es  = hdgavi_opt( "seo_{$page_slug}_desc_es", '' );

	// Pick server-side language for crawlers (they don't run JS)
	$seo_titles = array( 'en' => $seo_title_en, 'fr' => $seo_title_fr, 'es' => $seo_title_es );
	$seo_descs  = array( 'en' => $seo_desc_en, 'fr' => $seo_desc_fr, 'es' => $seo_desc_es );
	$seo_title  = $seo_titles[ $default_lang ] ?? $seo_title_en;
	$seo_desc   = $seo_descs[ $default_lang ] ?? $seo_desc_en;

	// Meta description
	if ( ! empty( $seo_desc ) ) {
		echo '<meta name="description" content="' . esc_attr( $seo_desc ) . '">' . "\n";
	}

	// Canonical
	echo '<link rel="canonical" href="' . esc_url( $url ) . '">' . "\n";

	// Hreflang omitted — bilingual system is client-side (same URL for both languages).
	// Hreflang requires distinct URLs per language; outputting identical URLs confuses crawlers.

	// Open Graph
	echo '<meta property="og:type" content="' . esc_attr( hdgavi_opt( 'seo_og_type', 'website' ) ) . '">' . "\n";
	echo '<meta property="og:site_name" content="' . esc_attr( $name ) . ' — Portfolio">' . "\n";
	$og_locales = array( 'en' => 'en_US', 'fr' => 'fr_FR', 'es' => 'es_ES' );
	echo '<meta property="og:locale" content="' . esc_attr( $og_locales[ $default_lang ] ?? 'en_US' ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( $seo_title ) . '">' . "\n";
	if ( ! empty( $seo_desc ) ) {
		echo '<meta property="og:description" content="' . esc_attr( $seo_desc ) . '">' . "\n";
	}
	echo '<meta property="og:url" content="' . esc_url( $url ) . '">' . "\n";
	if ( ! empty( $og_image ) ) {
		echo '<meta property="og:image" content="' . esc_url( $og_image ) . '">' . "\n";
	}

	// Twitter Card
	echo '<meta name="twitter:card" content="' . esc_attr( hdgavi_opt( 'seo_twitter_card', 'summary_large_image' ) ) . '">' . "\n";
	echo '<meta name="twitter:title" content="' . esc_attr( $seo_title ) . '">' . "\n";
	$twitter_url = hdgavi_opt( 'contact_twitter', '' );
	if ( ! empty( $twitter_url ) ) {
		// Extract @handle from URL (e.g. https://x.com/username → @username)
		$twitter_handle = '@' . basename( rtrim( $twitter_url, '/' ) );
		echo '<meta name="twitter:site" content="' . esc_attr( $twitter_handle ) . '">' . "\n";
		echo '<meta name="twitter:creator" content="' . esc_attr( $twitter_handle ) . '">' . "\n";
	}
	if ( ! empty( $seo_desc ) ) {
		echo '<meta name="twitter:description" content="' . esc_attr( $seo_desc ) . '">' . "\n";
	}
	if ( ! empty( $og_image ) ) {
		echo '<meta name="twitter:image" content="' . esc_url( $og_image ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'hdgavi_seo_head', 5 );

/**
 * JSON-LD Schema.org — Person on About page & front page
 */
function hdgavi_jsonld() {
	if ( ! is_page_template( 'page-templates/about.php' ) && ! is_front_page() ) return;

	$name     = hdgavi_opt( 'general_name', 'Holali David GAVI' );
	$email    = hdgavi_opt( 'general_email', '' );
	$job      = hdgavi_opt( 'seo_job_title', 'Cloud & DevOps Engineer' );
	$company  = hdgavi_opt( 'seo_company', '' );
	$github   = hdgavi_opt( 'contact_github', '' );
	$linkedin = hdgavi_opt( 'contact_linkedin', '' );
	$twitter  = hdgavi_opt( 'contact_twitter', '' );
	$photo    = hdgavi_opt( 'profile_photo', '' );
	$phone    = hdgavi_opt( 'contact_phone', '' );
	$location = hdgavi_opt( 'general_location', '' );
	$skills   = hdgavi_opt( 'seo_knows_about', 'Docker, Kubernetes, CI/CD, Terraform, Cloud Security, DevOps, Linux' );

	$schema = array(
		'@context'  => 'https://schema.org',
		'@type'     => 'Person',
		'name'      => $name,
		'jobTitle'  => $job,
		'url'       => home_url( '/' ),
	);
	if ( $company ) {
		$schema['worksFor'] = array(
			'@type' => 'Organization',
			'name'  => $company,
		);
	}
	if ( $email )    $schema['email'] = $email;
	if ( $phone )    $schema['telephone'] = $phone;
	if ( $photo )    $schema['image'] = $photo;
	if ( $location ) $schema['address'] = array( '@type' => 'PostalAddress', 'addressLocality' => $location );
	if ( $skills )   $schema['knowsAbout'] = array_map( 'trim', explode( ',', $skills ) );

	$same_as = array();
	if ( $github )   $same_as[] = $github;
	if ( $linkedin ) $same_as[] = $linkedin;
	if ( $twitter )  $same_as[] = $twitter;
	if ( ! empty( $same_as ) ) $schema['sameAs'] = $same_as;

	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'hdgavi_jsonld', 10 );

/**
 * JSON-LD Schema.org — WebSite + SearchAction on front page
 * Enables Google Sitelinks search box
 */
function hdgavi_jsonld_website() {
	if ( ! is_front_page() ) return;
	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'WebSite',
		'name'            => hdgavi_opt( 'general_name', '' ) . ' — Portfolio',
		'url'             => home_url( '/' ),
		'potentialAction' => array(
			'@type'       => 'SearchAction',
			'target'      => array(
				'@type'        => 'EntryPoint',
				'urlTemplate'  => home_url( '/?s={search_term_string}' ),
			),
			'query-input' => 'required name=search_term_string',
		),
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'hdgavi_jsonld_website', 10 );

/**
 * JSON-LD Schema.org — SiteNavigationElement
 * Signals site structure to Google for sitelinks
 */
function hdgavi_jsonld_navigation() {
	if ( ! is_front_page() ) return;

	// Build navigation from published portfolio pages
	$pages = get_pages( array( 'post_status' => 'publish' ) );
	$front_id = (int) get_option( 'page_on_front' );

	// Priority order for sitelinks (most important pages first)
	$priority_templates = array(
		'about', 'skills', 'experience', 'projects', 'education', 'contact',
		'certifications', 'blog', 'watch', 'timeline', 'stack',
	);

	$nav_items = array();
	foreach ( $priority_templates as $tpl ) {
		foreach ( $pages as $page ) {
			if ( $page->ID === $front_id ) continue;
			$template = get_page_template_slug( $page->ID );
			if ( strpos( $template, $tpl ) !== false ) {
				$nav_items[] = array(
					'@type' => 'SiteNavigationElement',
					'name'  => $page->post_title,
					'url'   => get_permalink( $page->ID ),
				);
				break;
			}
		}
	}

	if ( empty( $nav_items ) ) return;

	$schema = array(
		'@context'        => 'https://schema.org',
		'@type'           => 'ItemList',
		'itemListElement' => $nav_items,
	);
	echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . '</script>' . "\n";
}
add_action( 'wp_head', 'hdgavi_jsonld_navigation', 10 );

/**
 * Google Analytics — only loaded after cookie consent
 */
function hdgavi_ga() {
	$ga_id = hdgavi_opt( 'ga_id', '' );
	if ( empty( $ga_id ) ) return;
	if ( is_admin() ) return;
	?>
	<script>
	(function(){
		if (localStorage.getItem('hdgavi_cookie_consent') !== 'accepted') return;
		var s = document.createElement('script');
		s.async = true;
		s.src = 'https://www.googletagmanager.com/gtag/js?id=<?php echo esc_attr( $ga_id ); ?>';
		document.head.appendChild(s);
		window.dataLayer = window.dataLayer || [];
		function gtag(){ dataLayer.push(arguments); }
		gtag('js', new Date());
		gtag('config', '<?php echo esc_js( $ga_id ); ?>');
	})();
	</script>
	<?php
}
add_action( 'wp_head', 'hdgavi_ga', 1 );

/**
 * Cookie consent banner — renders in footer, only when GA is configured
 */
function hdgavi_cookie_banner() {
	$ga_id = hdgavi_opt( 'ga_id', '' );
	if ( empty( $ga_id ) ) return;
	if ( is_admin() ) return;
	?>
	<div class="cookie-banner" id="cookieBanner" role="dialog" aria-label="Cookie consent" style="display:none">
		<p>
			<span data-lang="en"><?php echo esc_html( hdgavi_opt( 'label_cookie_text_en', 'This site uses cookies for analytics.' ) ); ?></span>
			<span data-lang="fr"><?php echo esc_html( hdgavi_opt( 'label_cookie_text_fr', 'Ce site utilise des cookies pour les statistiques.' ) ); ?></span>
			<span data-lang="es"><?php echo esc_html( hdgavi_opt( 'label_cookie_text_es', 'Este sitio utiliza cookies para las estadísticas.' ) ); ?></span>
		</p>
		<div class="cookie-actions">
			<button type="button" class="btn-primary btn-sm" id="cookieAccept">
				<span data-lang="en">Accept</span>
				<span data-lang="fr">Accepter</span>
				<span data-lang="es">Aceptar</span>
			</button>
			<button type="button" class="btn-ghost btn-sm" id="cookieDecline">
				<span data-lang="en">Decline</span>
				<span data-lang="fr">Refuser</span>
				<span data-lang="es">Rechazar</span>
			</button>
		</div>
	</div>
	<script>
	(function(){
		var consent = localStorage.getItem('hdgavi_cookie_consent');
		if (consent) return;
		var banner = document.getElementById('cookieBanner');
		if (!banner) return;
		banner.style.display = '';
		document.getElementById('cookieAccept').addEventListener('click', function(){
			localStorage.setItem('hdgavi_cookie_consent', 'accepted');
			banner.style.display = 'none';
			location.reload();
		});
		document.getElementById('cookieDecline').addEventListener('click', function(){
			localStorage.setItem('hdgavi_cookie_consent', 'declined');
			banner.style.display = 'none';
		});
	})();
	</script>
	<?php
}
add_action( 'wp_footer', 'hdgavi_cookie_banner', 99 );
