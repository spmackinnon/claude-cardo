# Cardo — WordPress theme

Custom block (full-site-editing) theme for the Cardo Operations Inc. website, built from the
brand brief and working copy doc. Four pages — Home, Services, About, Contact — sharing one
header/footer, all content editable in the WordPress Site Editor.

No page-builder plugin, no ACF dependency, no forms-plugin dependency — see "Why no ACF /
forms plugin" below for the reasoning.

## What's here

```
theme.json              design tokens: color, type, spacing (see "Design tokens" below)
style.css               theme header + small front-end CSS (draft flags hidden, form styling)
functions.php           theme setup, pattern loader, shortcode/settings includes
templates/              page templates (block markup)
  front-page.html         → Home
  page-services.html      → Services
  page-about.html         → About
  page-contact.html       → Contact
  page.html               → fallback for any other WP page
  index.html               → fallback (required by WP for a valid block theme)
parts/
  header.html            shared site header + nav
  footer.html            shared site footer + nav + direct info
patterns/                one file per content section, registered as an insertable block pattern
  home-*.php, services-*.php, about-*.php, contact-*.php
inc/
  settings.php           adds "Cardo Settings" fields to Settings → General
  contact-form.php        [cardo_contact_form] shortcode: form markup + submit handling
  booking.php             [cardo_booking_cta] shortcode: Calendly embed / button / mailto fallback
assets/css/editor.css     editor-only styles (draft-copy flags — never loaded on the front end)
CONTENT-STATUS.md         map of every [LOCKED] vs [NEW] line in the copy doc to where it lives
```

Each page is assembled from independent `<!-- wp:pattern {"slug":"cardo/..."} /-->` blocks rather
than one long hardcoded template, so any single section (a founder bio, the proof section, a
service tier) can be edited, reordered, or removed in the Site Editor without touching the rest
of the page layout — this is what satisfies the brief's "swap without a rebuild" requirement for
the proof section and Brandon's bio.

## Design tokens (Section 3 of the brief — visual identity is NOT locked)

Every color, font, and spacing value lives in **`theme.json`** — nothing is hardcoded in a
template. To restyle once the brand is signed off:

- **Colors** — edit `settings.color.palette`. Six placeholder slugs are used throughout
  (`charcoal`, `steel`, `steel-light`, `off-white`, `white`, `accent`, `accent-dark`) — change
  the hex values, not the slugs, and every block using `has-accent-background-color` etc. updates
  everywhere at once.
- **Fonts** — edit `settings.typography.fontFamilies`. Two slugs, `body` and `heading`, both
  currently the system sans-serif stack (no web font is loaded, so there's nothing to license or
  bundle yet). Swap in real font files/`@font-face` once chosen.
- **Spacing** — `settings.spacing.spacingSizes` (steps `20`–`80`) drives every section's padding.
- **Logo** — `parts/header.html` and `parts/footer.html` currently use the Site Title block
  (text). Once a logo file exists, swap the Site Title block for a Site Logo block in both parts
  via the Site Editor, or ask for that swap here.

None of this is final — see CONTENT-STATUS.md and the open items below before treating any color
or font as approved.

## Content

Copy comes directly from the working copy doc (brand name mechanically updated from Notch to
Cardo, per instruction). **`CONTENT-STATUS.md`** maps every `[LOCKED]` vs `[NEW]` line to the
pattern file it lives in. `[NEW]` lines are also flagged inline: open any page in the Site Editor
and draft copy shows a small outlined "Draft copy" tag next to it — that tag is editor-only
(`assets/css/editor.css`, loaded via `add_editor_style()`) and never appears on the public site.

I did not treat every line as clean copy-paste — a few things didn't survive the Notch→Cardo
rename or the brief's own cross-references cleanly. Full detail is in the "Flags" section at the
bottom of `CONTENT-STATUS.md`; short version:

1. The "What Cardo Means" five-associations section is built on *notch*-specific wordplay
   ("top-notch," "take it up a notch") that doesn't function under the Cardo name — needs a
   rewrite, not a find-and-replace.
2. The site map calls for four service tiers + a bundle; the copy doc only drafted three. The
   free-diagnostic-scorecard tier and the bundle have no copy yet — I left a flagged placeholder
   rather than invent it.
3. The About page CTA button was drafted as "Talk to Sam & Brandon," but Brandon's bio isn't
   cleared to publish yet, so the live button says "Talk to us" instead.

## Open items (brief Section 7 — flagged, not silently resolved)

1. **Tagline not locked.** Hero sections lean on North Star language. `patterns/home-hero.php`
   has an explicit empty "tagline slot" comment above the headline so one can be dropped in
   without touching layout.
2. **Visual identity not locked.** See "Design tokens" above.
3. **Home proof/outcomes section is placeholder copy.** `patterns/home-proof.php` — three
   independent columns, swap one at a time as real results land. Recommended format once they
   exist: *"[Client] went from [specific chaos] to [specific result] in [timeframe]."*
4. **Brandon's bio is pending conflict-of-interest clearance.** `patterns/about-founder-brandon.php`
   is registered as an insertable pattern (title starts "DO NOT PUBLISH") but is **not** included
   in `templates/page-about.html`. Once cleared: open the About page in the Site Editor, insert
   the "About — Founder: Brandon" pattern under the Samantha bio, and update the About CTA button
   back to naming both founders.
5. **Services tier/scope copy is high-risk draft**, not pulled from the locked messaging bank.
   Flagged inline and in `patterns/services-tiers.php`.
6. **Offer names aren't final.** Only functional labels are used (Operations Diagnostic, Systems
   Build, Leadership & Rhythm) — search for these strings in `patterns/services-tiers.php` when
   final names are ready; nothing else references them.

## Contact form + webhook (brief Section 4)

The Contact page form is a small native implementation (`inc/contact-form.php`,
`[cardo_contact_form]` shortcode) rather than a forms plugin — kept the plugin count down per the
brief's performance guidance, while still meeting the "webhook/Zapier integration, not a dead-end
form" requirement:

- On submit, it emails the site admin **and** POSTs the submission as JSON to a webhook URL.
- Set that URL in **wp-admin → Settings → General → Cardo Settings → "Contact form webhook URL"**
  (or define `CARDO_ZAPIER_WEBHOOK_URL` in `wp-config.php` if you'd rather manage it outside the
  DB). Point it at a Zapier "Catch Hook" trigger, Make.com webhook, or any other automation tool.
  Leave blank and the form still works (admin email only).
- Basic spam mitigation is a honeypot field (no CAPTCHA plugin needed for a v1).
- If a dedicated forms plugin (WPForms, Fluent Forms, Gravity Forms) is preferred instead, only
  `patterns/contact-form.php` needs to change (swap the shortcode for the plugin's) — nothing
  else on the page depends on this implementation.

**Booking link** — set in the same Settings → General screen ("Booking link"). A Calendly URL
renders as an inline embed; any other URL renders as a plain button; blank falls back to a
mailto: link. Used by every "Book a call" button site-wide plus the Contact page's alternate path.

## Recommended plugins (not bundled, per the brief's "minimize plugin count")

- **SEO**: Yoast SEO or Rank Math — either drops in cleanly; the theme uses clean heading
  hierarchy (one `<h1>` per page) so there's nothing to fight.
- Nothing else is required to run the site as built.

## Testing status — please read before treating this as launch-ready

I built and PHP-lint-checked every file in this environment, but **could not run a live
WordPress instance to test in a browser** — this sandbox has no working Docker daemon (no
systemd, restricted ulimits), which rules out `wp-env`/`wp-env start` here. That means:

- Block markup, PHP syntax, and pattern registration are verified statically (`php -l` on every
  `.php` file; templates hand-checked against the WP block grammar).
- I have **not** visually confirmed rendering, responsive behavior, the contact form's actual
  submit → email → webhook flow, or the Site Editor experience in a real WordPress admin.

Before launch, someone should pull this theme into an actual WordPress install (local via
`wp-env`, Local, MAMP, or a staging server) and click through all four pages, submit the contact
form, and confirm the webhook fires.
