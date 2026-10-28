# Prompt pour continuer le développement du thème HD GAVI Portfolio

Copie-colle ce prompt au début de ta prochaine conversation avec Claude :

---

## Contexte

Je travaille sur mon thème WordPress portfolio **HD GAVI Portfolio** (v7.0). C'est un thème custom pour mon portfolio d'ingénieur Cloud & DevOps.

### Ce qui a été fait dans la session précédente :
- **8 Custom Post Types** : Experience, Project (avec études de cas + carrousel images), Education, Certification, Timeline, Testimonial, Skill (stack technique), Resource (marketplace free/paid)
- **CV Download Gate** : modale lead capture + proxy PDF sécurisé + email notif + dashboard admin
- **Mode Recruteur** : bouton navbar pulsant + page availability enrichie
- **Newsletter améliorée** : auto-send sur publish + welcome series 3 emails
- **Chatbot IA enrichi** : contexte CPT, historique multi-turn, quick actions
- **Dashboard Analytics public** : stats visiteurs + GitHub API
- **Page Resources** : sidebar collapsible + CPT + taxonomie + free/gated/paid + Stripe-ready
- **Multilingual EN/FR/ES** : dropdown langue, CSS dynamique
- **9 corrections de sécurité** : path traversal, CSV injection, email filter, URL sanitization, etc.
- **Audit complet : 82/82 checks PASS**

### Ce qu'il reste à faire (par priorité) :

**PRIORITÉ 1 — Compléter l'existant :**
1. Ajouter `data-lang="es"` aux templates existants (experience, education, certifications, timeline, testimonials, about, contact, blog, watch, splash, footer)
2. Ajouter les champs `_es` aux meta boxes des CPTs existants (experience, education, certification, timeline, testimonial)
3. Créer les pages WordPress pour Resources et Analytics dans `inc/admin-page-setup.php`
4. Ajouter du contenu de démo pour les Resources (modules Terraform, cheat sheets, Docker templates)
5. Régénérer `critical.min.css`

**PRIORITÉ 2 — Nouvelles features :**
6. Page **Services / Prestations** (consulting DevOps, audit sécurité, formation + formulaire devis)
7. **Booking / Prise de RDV** (intégration Calendly ou formulaire maison)
8. Migrer la page Skills vers le CPT `hdgavi_skill` ou fusionner avec Stack
9. Ajouter ES au chatbot (welcome message, placeholder)
10. Convertir le bouton langue du splash en dropdown

**PRIORITÉ 3 — Polish :**
11. Drag & drop ordering pour les CPTs dans l'admin
12. Meta SEO en espagnol
13. Vérifier PWA (manifest.json, service worker)
14. Lazy load optimisé pour le carrousel
15. Test mobile réel

### Conventions du projet :
- Préfixe : `hdgavi_`
- Helpers : `hdgavi_opt()`, `hdgavi_get_cpt_posts()`, `hdgavi_icon()`
- Trilingue : `data-lang="en"` / `data-lang="fr"` / `data-lang="es"` spans
- Sécurité : `esc_html`/`esc_url`/`esc_attr` en sortie, `sanitize_text_field`/`esc_url_raw` en entrée
- Minification : `npx clean-css-cli style.css -o style.min.css` + `npx terser assets/js/theme.js -o assets/js/theme.min.js --compress --mangle`
- Toujours régénérer les fichiers minifiés après chaque modification
- Ne jamais casser la structure HTML existante (risque de régression CSS)

### Comment commencer :
Commence par la **Priorité 1** — c'est le plus urgent pour que le site soit cohérent en 3 langues. Ensuite on passera aux nouvelles features.

---
