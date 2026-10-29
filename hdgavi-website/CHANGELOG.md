# Changelog — HD GAVI Portfolio

## [7.0.0] — 2026-10-29

### Design
- New visual identity taken from the printed CV: warm paper background, near-black ink, steel blue #2A5878, blue-grey #DFE6EB; dark mode in warm graphite with cream text.
- Typography: IBM Plex Serif (titles), IBM Plex Sans (text), IBM Plex Mono (dates, technologies), self-hosted in `assets/fonts/` — Google Fonts removed (no third-party request, CSP tightened).
- Résumé layout: section titles in a left column, dates in a meta column, content in a readable main column, hairline rules instead of cards.
- Removed the decorative layer: rounded cards with coloured side borders, navy + cyan palette, gradients, glows, pills, emoji icons, eyebrow labels with dot-grid icons, particles canvas, custom cursor, grain overlay, parallax, typing terminal on the home page, animated counters, reading progress bar, Konami toast, page fade transitions, pulsing "Hire me" button, placeholder screenshots.
- Light mode by default (follows the system preference), theme and language applied before first paint (no flash). Explicit choice stored under `hdgavi_theme_v2`.
- New header (6 links, CV, FR/EN/ES, theme) and a quiet one-line footer. Real PWA icons.

### Content
- `inc/cv-content.php` is the single source of truth for the CV: texts (FR/EN/ES), experiences, education, skills (the 7 CV categories), the 4 CV projects (descriptions taken from their GitHub READMEs) and the timeline.
- Removed what is not on the CV: surveyor experience, BTS and psychology entries, stats and trait cards, invented case-study metrics, certifications, salary, "Freelance".
- Corrected facts: location Aubervilliers (93300), Master 1 (not "Master 1 & 2"), professional title TSSR in 2023, title "Ingénieur DevOps / Cloud Native".
- Admin notice "Synchroniser avec le CV": overwrites the demo-imported CPT posts, trashes obsolete demo posts (flag `_hdgavi_demo`), never touches posts created by hand.
- Projects get "key points" (EN/FR/ES) and Spanish title/description fields in the editor.

### Code
- New template parts (`template-parts/cv-*.php`) shared by the home page and the CV pages; new helpers in `inc/bilingual.php` (`hdgavi_tri()`, `hdgavi_meta_tri()`, `hdgavi_page_url()`...).
- Header/footer no longer special-case the home page; navigation only links to pages that exist.
- `theme.js`: gimmick modules removed (1 850 → 1 300 lines); new menu, theme and language handling.
- `functions.php`: Google Fonts, critical CSS inlining (stale copy of the old design) and the injected design CSS removed.
- `theme.json` and editor styles use the new palette and fonts.
- Service worker: cache names bumped, pre-cache paths made relative to the theme folder (the old `/offline.html` path made installation fail).

## [6.2.1] — 2026-03-26

### Performance — Minification & Lazy Loading
- **CSS minified** — `style.min.css` (47KB, −18% from 57KB original)
- **JS minified** — `theme.min.js` (29KB, −34% from 44KB original)
- **Critical CSS inlined** — 10.8KB of above-fold styles (reset, variables, navbar, splash, layout, transitions, animations) inlined in `<head>` via `hdgavi_critical_css()` for instant first paint
- **Font preloading** — DM Sans 400 and Outfit 700 woff2 files preloaded in `<head>` (eliminates FOIT)
- **Google Fonts async** — Fonts CSS loaded with `media="print" onload="this.media='all'"` + `<noscript>` fallback (non-render-blocking)
- **Script defer** — `theme.min.js` loaded with `defer` attribute via `script_loader_tag` filter
- **Lazy loading images** — `loading="lazy" decoding="async"` added to: about photo, presentation photo, testimonial photos
- **LCP priority** — Splash avatar marked `fetchpriority="high"` (Largest Contentful Paint candidate)
- **Auto lazy loading** — `the_content` and `post_thumbnail_html` filters auto-add `loading="lazy" decoding="async"` to images missing these attributes
- **Emoji removal** — WordPress default emoji scripts disabled (~15KB savings)
- **DNS prefetch** — Added `dns-prefetch` for fonts.googleapis.com, fonts.gstatic.com, api.github.com

### Service Worker v6.2.1
- **4 named caches** — `hdgavi-static`, `hdgavi-fonts`, `hdgavi-pages`, `hdgavi-images` (isolated invalidation)
- **Stale-while-revalidate** for Google Fonts (instant serve, background update)
- **Cache-first** for versioned CSS/JS/woff2 (fingerprinted URLs)
- **Network-first** for HTML pages (always fresh, offline fallback to cache then `/`)
- **Cache-first with trimming** for images (max 60 entries, FIFO eviction)
- **Page cache trimming** — Max 30 pages cached, auto-eviction

### Asset Enqueue
- `hdgavi_enqueue()` auto-detects `.min.css` / `.min.js` with fallback to unminified
- Version fingerprint via `md5_file()` on the actual served file for accurate cache-busting

### Theme Cleanup on Deactivation
- **Page tracking** — `hdgavi_created_page_ids` option tracks all pages created by the Setup Wizard
- **Cleanup notice** — Admin notice shown after switching away from the theme, offering 3 options:
  - 🗑️ **Delete pages** — Moves portfolio pages to trash (recoverable)
  - 🧹 **Full cleanup** — Deletes pages + all Customizer settings, options (`hdgavi_contact_messages`, `hdgavi_newsletter_subscribers`, `hdgavi_page_views`), transients, and empty `veille` category
  - ✕ **Dismiss** — Keep everything, hide notice
- **Safety** — Pages go to trash (not permanent delete), front page reset if it was splash, double confirmation prompt, `delete_pages` capability required

### Bug Fixes (Audit)
- **ES5 compliance** — `const`/`let` in theme.js replaced with `var` (inherited from v6.2.0)
- **Minifier** — Preserves `/** */` version header in theme.min.js
- **Critical CSS** — Added `.section-header`, `.section-label`, `.section-title`, `.section-desc` (35/35 selectors)
- **Footer image** — Added `loading="lazy" decoding="async"` to footer avatar
- **Version coherence** — functions.php docblock, readme.txt stable tag aligned to 6.2.1

## [6.2.0] — 2026-03-26

### Critical Bug Fixes
- **Version harmonization** — All files now report `6.2.0` (style.css, functions.php, sw.js, theme.js, readme.txt)
- **Cache-busting fix** — `hdgavi_remove_version_strings()` no longer strips the MD5 hash from theme assets
- **Service Worker** — `CACHE_NAME` updated to `hdgavi-v6.2.0`, forces browser cache invalidation
- **Duplicate `lang` attribute** — Removed manual `lang="..."` from `<html>` tag; WordPress `language_attributes()` now respects theme default language via `locale` filter
- **Page-wrapper positioning** — `.page-wrapper` and `<main>` are now always rendered (not just when navbar is visible), fixing CSS on all pages
- **Parasitic directories** — Removed `{assets/` artifacts from ZIP
- **Contact storage limit** — Capped at 5,000 entries with `autoload=false`
- **Newsletter storage limit** — Capped at 10,000 subscribers with `autoload=false`

### Security
- **Rate limiting** — New `hdgavi_rate_limit()` helper applied to: contact (5/h), chatbot (20/h), newsletter (5/h), unsubscribe (10/h)
- **IP hashing (GDPR)** — Upgraded from MD5 to HMAC-SHA256 with `wp_salt('auth')`
- **Content-Security-Policy** — Added CSP header covering scripts, styles, fonts, images and API connections
- **Newsletter unsubscribe** — Email removed from URL; uses token-only GDPR-compliant approach

### Accessibility (WCAG 2.1)
- **Skip-to-content** — `<a class="skip-link">` added after `wp_body_open()` (criterion 2.4.1)
- **`aria-live`** — Added to contact form feedback, newsletter feedback, and chatbot messages
- **Chatbot keyboard access** — Bubble now responds to Enter/Space keydown events
- **`aria-hidden`** — Inactive `data-lang` spans/divs marked `aria-hidden="true"` in `setLang()`

### SEO
- **`hreflang` tags** — `en`, `fr` and `x-default` alternate links added to all pages
- **Bilingual meta** — Server-side meta description and OG/Twitter tags use theme default language (crawlers don't execute JS)
- **JSON-LD WebSite** — Schema.org `WebSite` object added on front page
- **Sitemap `<lastmod>`** — Each page/post now has a `<lastmod>` date; `esc_xml()` replaced by `esc_attr()`

### Performance
- **Google Fonts preconnect** — `<link rel="preconnect">` injected at priority 1
- **Dynamic SW URL** — Service worker path injected via `wp_localize_script` instead of hardcoded
- **Stats batch writes** — Visitor tracking buffered in transients, flushed every 10 visits or 5 minutes
- **Async email sends** — Follow-up emails (confirmation, welcome, mini CV) sent via WP-Cron instead of synchronously

### New Features
- **Demo content importer** — New "Import demo content" button in Portfolio Setup page pre-fills all Customizer options with Holali David GAVI's real content
- **Non-destructive import** — Existing values preserved unless "Force" is checked

### Documentation
- **CHANGELOG.md** — New file (this file)
- **readme.txt** — Updated to v6.2.0 with full template list and installation guide

### Other
- **Grain overlay** — `display:none` by default in CSS to prevent flash before JS init
- **Dead file removed** — `inc/ajax-contact.php` deleted (replaced by email-templates.php since v6.0)

## [6.1.1] — Previous release
- Minor bug fixes and template additions

## [6.1.0] — Initial multi-page release
- 20 page templates
- Full Customizer integration
- Bilingual EN/FR system
- Dark mode default
