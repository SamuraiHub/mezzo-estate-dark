# Estatein Dark — Development Notes

_Submission document for the WordPress Developer assessment._
Author: Muaz Al Jarhi

---

## 1. Overview

**Estatein Dark** is a custom WordPress theme built from the Figma template
_"Real Estate Business Website UI Template – Dark Theme"_ (Produce UI, Figma
Community). It reproduces all six designed pages — **Home, About Us, Properties,
Property Details, Services, Contact** — across the three device layouts included
in the Figma (mobile 390 px, laptop 1440 px, desktop 1920 px), as a single
responsive theme.

No page builder is required (though the theme is Elementor-compatible). It is a
hand-coded theme in HTML/CSS/PHP with editable content via Custom Post Types.

---

## 2. How the design was translated

1. **Extracted the source of truth from Figma via its REST API** — rendered all
   18 frames (6 pages × 3 breakpoints) and programmatically pulled the exact
   design tokens rather than eyeballing them:
   - Colours: purple `#703BF7` / `#A685FA`, backgrounds `#141414` / `#1A1A1A`,
     borders `#262626`/`#333`, muted text `#999999`, rating gold `#FFE500`.
   - Type: **Urbanist** (weights 400–700), sizes 15/18/20/24/40/48/60.
   - Radii: 10–12 px cards, pill buttons.
   These live as CSS custom properties in `assets/css/theme.css` (`:root`).
2. **Pulled the real imagery** (property photos, team portraits, the glass-tower
   hero, office gallery) directly from the Figma frames, then compressed them
   (9.2 MB → 1.5 MB) into `assets/images/`.
3. Rebuilt each section as semantic HTML with a small, reusable CSS component
   system (`.property-card`, `.testimonial`, `.feature-cards`, `.form-card`, …).

---

## 3. Architecture & key choices

### Reusable components
- `header.php` / `footer.php` — the navigation, mobile menu, newsletter and
  footer link columns are defined once and pulled into every page.
- `template-parts/` — announcement bar, the shared "Start Your Real Estate
  Journey" CTA band, and the 4-up feature row.
- `inc/` — concerns split into focused files: `theme-setup.php`,
  `post-types.php`, `fields.php`, `seo.php`, `forms.php`, `helpers.php`,
  `demo-content.php`.

### Content management (CPT + ACF)
Rather than hardcoding content, the manageable data is modelled as **Custom Post
Types**: `property`, `team_member`, `testimonial`, `faq`, `service`. Each has
editable fields (price, location, beds/baths, role, rating, icon, …).

Fields use **one schema, two back-ends** (`inc/fields.php`):
- If **Advanced Custom Fields** is installed, the schema is registered as an ACF
  local field group automatically (no import step).
- If ACF is **not** installed, the theme registers native meta boxes with the
  same meta keys — so it is fully editable out of the box with **zero plugin
  dependency**. Templates read values with a single `get_post_meta()` either way.

Templates query the CPTs and **fall back to demo data** if none exist, so the
site never looks empty.

### One-click demo
On activation (`after_switch_theme`, `inc/demo-content.php`) the theme creates
the six pages, assigns their templates, sets Home as the static front page,
builds the primary menu, imports the images into the Media Library, and seeds
the CPT entries. Activate → the site already matches the design.

### Elementor compatibility
`page.php` is a blank full-width canvas; the theme shares its colour palette with
the editor and registers Elementor Pro theme-builder locations. Coded design
pages and Elementor-built pages can coexist.

---

## 4. Responsiveness

One responsive theme, three breakpoints driven by CSS media queries:
`phone < 768px`, `laptop/tablet 768–1199px`, `desktop ≥ 1200px`. Grids collapse,
the nav becomes an off-canvas drawer, and forms stack. Per-device visibility
utilities (`.show-mobile` / `.show-laptop` / `.show-desktop` and `.hide-*`) let
any element target a specific device — usable in markup or Elementor's CSS
Classes field.

---

## 5. Forms

All forms (Contact, Properties, Property Details/Inquire) post to a single
secure native handler (`inc/forms.php`) via `admin-post.php`:
nonce verification, input sanitisation, a honeypot for spam, `wp_mail()` to the
site admin, and a redirect back with a success/error banner. The markup is
standard, so Contact Form 7 / WPForms / Elementor Forms can replace it if
preferred.

---

## 6. SEO, performance & accessibility

- **SEO** (`inc/seo.php`): `<title>` via `title-tag`, meta description, Open
  Graph + Twitter cards, `RealEstateAgent` JSON-LD on the front page, automatic
  `alt` fallbacks. Steps aside if Yoast/Rank Math is active.
- **Performance**: Google Fonts preconnect + `display=swap`; JavaScript loaded
  with `defer`; images carry width/height and `loading="lazy"` (hero uses
  `fetchpriority="high"`); imagery pre-compressed; no jQuery or heavy libraries.
- **Accessibility**: skip-to-content link, visible `:focus-visible` styles,
  `aria-label`s on icon buttons, real `<label>`s on every field, semantic
  landmarks, and a `prefers-reduced-motion` guard.

---

## 7. Testing notes & limitations

- Validated structurally (no duplicate functions, clean includes, balanced
  template tags). Recommended final step on your WordPress install: activate the
  theme, then visit each page and submit a form.
- Forms email the WordPress admin address; on local environments configure an
  SMTP plugin (e.g. WP Mail SMTP) to actually deliver mail.
- Images are the compressed Figma exports; swap in higher-resolution originals
  via the Media Library if desired.

---

## 8. File map

```
estate-dark/
├── style.css                     Theme header + reset
├── functions.php                 Bootstrap, enqueue, resource hints
├── header.php / footer.php       Reusable chrome
├── front-page.php                Home
├── template-about.php            About Us
├── template-properties.php       Properties (+ enquiry form)
├── template-property-details.php Property Details (demo)
├── single-property.php           Real property entries (Details layout)
├── template-services.php         Services
├── template-contact.php          Contact (+ form + gallery)
├── page.php / index.php / single.php   Fallbacks & Elementor canvas
├── template-parts/               announcement-bar, cta, feature-cards
├── inc/                          theme-setup, post-types, fields, seo,
│                                 forms, helpers, demo-content
└── assets/                       css/theme.css, js/theme.js, images/
```
