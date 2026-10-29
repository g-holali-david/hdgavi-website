=== HD GAVI Portfolio ===
Contributors: Holali David GAVI
Tags: portfolio, multi-page, bilingual, translation-ready, one-column
Requires at least: 6.0
Tested up to: 6.7
Requires PHP: 7.4
Stable tag: 7.0.0
License: GPL-2.0-or-later

Portfolio of Holali David GAVI, DevOps / Cloud Native engineer. Laid out like the printed CV, in French, English and Spanish, with light and dark modes.

== Description ==

The home page reads like the CV: summary, experience, projects, skills, education and contact. Each section also has its own page.

* Content of the CV in one place: inc/cv-content.php (texts, experiences, education, skills, projects, timeline). The texts can be overridden in Appearance → Customize → "Contenu du CV".
* Experiences, education, skills and projects are custom post types, editable in the admin.
* Typography: IBM Plex Serif, Sans and Mono, self-hosted in assets/fonts/ (SIL Open Font License). No request to Google Fonts.
* Colours taken from the CV: paper, ink, steel blue #2A5878, blue-grey #DFE6EB. Dark mode in warm graphite.
* EN / FR / ES switch and light / dark switch, applied before the first paint (no flash).
* Contact form, CV download (direct link to the PDF set in the Customizer), JSON-LD, sitemap, hreflang.

== Page templates ==

Main: Home (CV), About, Experience, Projects, Skills, Education, Contact, Availability.
Secondary (not in the menu): Timeline, Tech Stack, Certifications, Tech Watch, Blog, Testimonials, Presentation, Terminal, Newsletter, Uses, Roadmap, Services, Booking, Resources, Analytics, Legal.

== Installation ==

1. Upload the theme ZIP via Appearance → Themes → Add New → Upload, then activate it.
2. Appearance → Portfolio Setup: create the pages (the Home page is set as the front page).
3. In the admin, click "Synchroniser avec le CV" in the yellow notice: experiences, education, skills, projects and timeline are replaced by the content of the CV. Old demo entries that are not on the CV go to the trash; content you created yourself is never touched.
4. Appearance → Customize: profile photo, CV (PDF), e-mail, phone, LinkedIn, GitHub.

== Development ==

style.css is the stylesheet loaded by WordPress (style.min.css is its minified copy); assets/js/theme.js is minified to theme.min.js.
Regenerate the minified files after any change:
  npx clean-css-cli style.css -o style.min.css
  npx terser assets/js/theme.js -o assets/js/theme.min.js --compress --mangle

== Changelog ==

= 7.0.0 =
* New design based on the printed CV; decorative effects removed (cards with coloured borders, navy and cyan palette, gradients, glows, emoji icons, particles, custom cursor, grain, typing terminal, counters, trait cards, pulsing "Hire me" button).
* Content aligned with the October 2026 CV, with a one-click synchronisation for existing sites.
* Self-hosted IBM Plex fonts, light mode by default (follows the system setting), dark mode in warm graphite.
* See CHANGELOG.md for details.

= 6.2.1 =
* Minification, lazy loading, service worker caches.
