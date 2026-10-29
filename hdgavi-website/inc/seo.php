<?php
/**
 * HD GAVI Portfolio — SEO: meta tags, JSON-LD, OG, canonical (v7.0.0)
 * The theme-color meta tags are printed by header.php.
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
		// Extract @handle from URL (e.g. https://x.com/username gives @username)
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
 * Postal address from the CV location (shared with the vCard in inc/vcard.php).
 * The CV gives 93300 Aubervilliers, Île-de-France; a location changed in the
 * Customizer ("Contenu du CV" > Localisation) is used as the locality as is.
 *
 * @return array locality, postal_code, region, country_code, country
 */
function hdgavi_postal_address() {
	$location = function_exists( 'hdgavi_cv_location' ) ? (string) hdgavi_cv_location() : (string) hdgavi_opt( 'general_location', '' );
	$location = trim( $location );
	$address  = array(
		'locality'     => 'Aubervilliers',
		'postal_code'  => '93300',
		'region'       => 'Île-de-France',
		'country_code' => 'FR',
		'country'      => 'France',
	);
	if ( '' !== $location && false === stripos( $location, 'Aubervilliers' ) ) {
		$address['locality']    = $location;
		$address['postal_code'] = '';
		$address['region']      = '';
	}
	return $address;
}

/**
 * JSON-LD Schema.org — Person on About page & front page.
 * Facts from the CV only: name, job title, employer, address, profiles, site URL
 * (plus e-mail, phone and photo when they are set in the Customizer). No skill keyword list.
 */
function hdgavi_jsonld() {
	if ( ! is_page_template( 'page-templates/about.php' ) && ! is_front_page() ) return;

	$name     = hdgavi_opt( 'general_name', 'Holali David GAVI' );
	$job      = hdgavi_opt( 'seo_job_title', 'DevOps / Cloud Native Engineer' );
	$company  = trim( (string) hdgavi_opt( 'seo_company', 'Dassault Systèmes' ) );
	$linkedin = hdgavi_opt( 'contact_linkedin', 'https://www.linkedin.com/in/holali-david-g-4a434631a/' );
	$github   = hdgavi_opt( 'contact_github', 'https://github.com/g-holali-david' );
	$email    = hdgavi_opt( 'general_email', '' );
	$phone    = hdgavi_opt( 'contact_phone', '' );
	$photo    = hdgavi_opt( 'profile_photo', '' );
	$addr     = hdgavi_postal_address();

	$schema = array(
		'@context' => 'https://schema.org',
		'@type'    => 'Person',
		'name'     => $name,
		'jobTitle' => $job,
		'url'      => home_url( '/' ),
	);
	if ( '' !== $company ) {
		$schema['worksFor'] = array(
			'@type' => 'Organization',
			'name'  => $company,
		);
	}
	$address = array(
		'@type'           => 'PostalAddress',
		'addressLocality' => $addr['locality'],
	);
	if ( '' !== $addr['postal_code'] ) $address['postalCode']    = $addr['postal_code'];
	if ( '' !== $addr['region'] )      $address['addressRegion'] = $addr['region'];
	$address['addressCountry'] = $addr['country_code'];
	$schema['address'] = $address;

	if ( $email ) $schema['email']     = $email;
	if ( $phone ) $schema['telephone'] = $phone;
	if ( $photo ) $schema['image']     = $photo;

	$same_as = array_values( array_filter( array( $linkedin, $github ) ) );
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
