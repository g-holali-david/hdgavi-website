=== HD GAVI Portfolio ===
Contributors: Holali David GAVI
Tags: portfolio, multi-page, dark-mode, bilingual, devops, cloud
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 6.2.1
License: GPL-2.0-or-later

Portfolio WordPress theme — Multi-page, bilingual EN/FR, dark mode default, full Customizer control.

== Description ==

HD GAVI Portfolio is a fully configurable WordPress portfolio theme designed for developers, engineers, and tech professionals. Every visible text is configurable through the WordPress Customizer — no code editing required.

Key features:
* 20 page templates with dedicated designs
* Bilingual EN/FR with one-click language toggle
* Dark mode by default with light mode toggle
* Interactive terminal animation on splash page
* AI chatbot widget (Anthropic API)
* Contact form with email templates (4 templates)
* Newsletter subscription system
* GitHub repositories integration
* PWA-ready (Service Worker + manifest)
* Privacy-friendly analytics (no cookies)
* WCAG 2.1 accessibility features
* SEO optimized (JSON-LD, hreflang, per-page meta)

== Page Templates ==

Core (7):
1. Splash Page — Animated homepage with terminal
2. About — Personal presentation with personality traits
3. Skills — Technical skills grid (7 categories)
4. Experience — Professional timeline (5 entries, detailed bullets)
5. Projects — Project cards (8 entries) + GitHub repos
6. Education — Academic timeline + self-learning courses
7. Contact — Contact form with email templates

Extended (6):
8. Certifications — Badge display with filters (12 slots)
9. Timeline — Full career chronology
10. Tech Stack — Detailed stack with proficiency levels
11. Tech Watch — Curated articles from WordPress posts
12. Blog — Technical articles
13. Testimonials — Colleague feedback cards

Extra (7):
14. Presentation — Fullscreen slides mode
15. Terminal — Interactive CLI easter egg
16. Newsletter — Email subscription
17. Uses — Hardware/software setup
18. Roadmap — Goals and objectives tracker
19. Availability — Status and contract preferences
20. Legal — Privacy policy and legal notice

== Installation ==

1. Upload the theme ZIP via Appearance → Themes → Add New → Upload
2. Activate the theme
3. Go to Appearance → Portfolio Setup
4. Click "Import demo content" to pre-fill the Customizer
5. Click "Create selected pages" to generate all portfolio pages
6. Customize content via Appearance → Customize

== Setup Guide ==

After activation:
1. The theme will prompt you to visit Portfolio Setup
2. Select which pages to create (all are recommended)
3. Import demo content for a quick start
4. Edit content in the Customizer (Appearance → Customize)
5. Upload your profile photo and CV PDF
6. Configure the contact form (Web3Forms key or WP Mail SMTP)

Required settings:
* Permalinks must be set to /%postname%/ (auto-configured)
* A static front page will be set automatically (splash page)

== Frequently Asked Questions ==

= How do I change the language? =
Go to Customizer → 1. General → Default Language. Visitors can also toggle via the navbar button.

= How do I configure the contact form? =
The theme uses its own email system via wp_mail(). For reliable delivery, install WP Mail SMTP and configure an SMTP provider.

= How do I enable the AI chatbot? =
Go to Customizer → Effects & Toggles → enable Chatbot, then enter your Anthropic API key.

= Can I add more experiences/projects? =
The theme supports 5 experience entries and 8 project entries via the Customizer.

== Changelog ==

= 6.2.0 =
* Version harmonization across all files
* Fixed cache-busting for theme assets
* Fixed page-wrapper CSS for pages without navbar
* Added rate limiting on all AJAX endpoints
* Upgraded IP hashing to HMAC-SHA256 (GDPR)
* Added Content-Security-Policy header
* GDPR-compliant newsletter unsubscribe (token-only URL)
* Added skip-to-content link (WCAG 2.4.1)
* Added aria-live on dynamic feedback areas
* Chatbot bubble keyboard accessible
* aria-hidden on inactive language spans
* Added hreflang tags (en, fr, x-default)
* Bilingual server-side meta description for crawlers
* JSON-LD WebSite schema on front page
* Sitemap with lastmod dates
* Google Fonts preconnect
* Dynamic service worker URL
* Stats batch writes (performance)
* Async follow-up emails via WP-Cron
* Demo content importer (Portfolio Setup page)
* CHANGELOG.md added
* Grain overlay hidden by default

= 6.1.1 =
* Bug fixes and template refinements

= 6.1.0 =
* Lots 2-7: Added 13 new page templates
* Chatbot, vCard, QR code, newsletter features
* Extended Customizer with 31 sections

= 6.0.0 =
* Complete rewrite: multi-page architecture
* Bilingual EN/FR system
* Dark mode default
* Full Customizer control
