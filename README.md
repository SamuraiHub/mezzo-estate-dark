# Estatein Dark — WordPress Theme

A modern, dark-theme **real estate** WordPress theme built from the Figma
_"Real Estate Business Website UI Template – Dark Theme"_. Fully responsive,
Elementor-compatible, with reusable header / footer / section parts and a
one-click demo that reproduces all six pages out of the box.

---

## What's included

**Six pages**, each faithful to the Figma across mobile / laptop / desktop:

| Page | Template file |
|------|---------------|
| Home | `front-page.php` |
| About Us | `template-about.php` |
| Properties | `template-properties.php` |
| Property Details | `template-property-details.php` |
| Services | `template-services.php` |
| Contact Us | `template-contact.php` |

**Reusable, separated building blocks** (edit once → updates everywhere):
- `header.php` — logo, navigation, mobile menu, Contact button
- `footer.php` — link columns, newsletter, social, copyright
- `template-parts/announcement-bar.php` — dismissible top bar
- `template-parts/cta.php` — shared "Start Your Real Estate Journey" band
- `template-parts/feature-cards.php` — the 4-up feature row

---

## Installation

### Option A — upload the ZIP (recommended)
1. In WordPress: **Appearance → Themes → Add New → Upload Theme**.
2. Choose `estate-dark.zip` and click **Install Now**, then **Activate**.
3. On activation the theme **auto-creates all six pages, assigns their
   templates, sets Home as the static front page, and builds the main menu.**
   Just open the site — it already looks like the design.

### Option B — manual
1. Copy the `estate-dark` folder into `wp-content/themes/`.
2. **Appearance → Themes → Activate** "Estatein Dark".

> Fonts (Urbanist) load from Google Fonts. Everything else — icons, layout,
> colours — is self-contained in the theme.

---

## Responsive behaviour

This is **one responsive theme** (the recommended, SEO-friendly approach): every
page automatically adapts its layout at three breakpoints —

- **Phone** &nbsp;`< 768px`
- **Laptop / tablet** &nbsp;`768–1199px`
- **Desktop** &nbsp;`≥ 1200px`

### Show content on specific devices only
As requested, you can also show/hide any element **per device** using utility
classes (they work in normal HTML and inside Elementor's "CSS Classes" field):

```html
<div class="show-mobile">Only on phones</div>
<div class="show-laptop">Only on laptops / tablets</div>
<div class="show-desktop">Only on large desktops</div>

<!-- or hide on one device -->
<div class="hide-mobile">Hidden on phones</div>
```

Elementor also has built-in per-device visibility (Advanced → Responsive) which
works with this theme too.

---

## Elementor compatibility

- The theme declares Elementor support and shares its colour palette with the editor.
- `page.php` is a **blank full-width canvas**, so any page built in Elementor
  renders edge-to-edge with no theme wrappers fighting it.
- If you have **Elementor Pro**, the theme registers Theme-Builder locations, so
  you can override the header/footer from **Templates → Theme Builder**.
- To build a page visually: create a Page → **Edit with Elementor**. To keep a
  coded design page, leave its Page Template set (e.g. "Services").

---

## Managing content (Custom Post Types)

Editable content is modelled as Custom Post Types you'll find in the dashboard:

- **Properties** — price, location, bedrooms, bathrooms, area, type + featured image
- **Team** — role, social link + photo
- **Testimonials** — author, location, rating (stars)
- **FAQs** — question (title) + answer (body)
- **Services** — icon + summary

Add/edit an entry and it appears on the matching page automatically (Home
featured properties, About team, Contact, etc.). The demo import seeds a few of
each so the dashboard isn't empty.

**ACF-ready:** if you install **Advanced Custom Fields**, the theme registers the
same fields as an ACF field group automatically. If ACF isn't installed, native
meta boxes provide the identical fields — so it works either way, no plugin
required.

Set your own logo and site title under **Appearance → Customize**. You can also
rebuild any page with **Elementor**.

---

## Forms

The Contact, Properties and Property-Details forms are **fully functional** — they
post securely (nonce + honeypot + sanitisation) and email the site admin via
`wp_mail()`, then show a success/error message. On local setups, add an SMTP
plugin (e.g. **WP Mail SMTP**) so mail is actually delivered. Prefer a plugin?
The markup is standard, so Contact Form 7 / WPForms / Elementor Forms drop in cleanly.

---

## SEO, performance & accessibility

- Meta description, Open Graph & Twitter cards, and `RealEstateAgent` JSON-LD
  (auto-disabled if Yoast / Rank Math is active).
- Deferred JS, font preconnect, lazy-loaded images with dimensions, compressed
  imagery, no jQuery.
- Skip link, visible focus styles, ARIA labels, real form labels,
  `prefers-reduced-motion` support.

---

## Notes

- Real imagery is pulled from the Figma design and bundled (compressed) in
  `assets/images/`; replace with higher-res originals via the Media Library anytime.
- See `DEVELOPMENT.md` for the full development write-up.
