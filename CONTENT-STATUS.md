# Content status — what's locked vs. draft

This mirrors the working copy doc's own `[LOCKED]` / `[NEW]` tags, mapped to where each line
actually lives in the theme. `[NEW]` lines are also flagged inline for editors: open any page in
the Site Editor and draft lines show a small outlined "Draft copy" tag next to them. **That tag
only appears in wp-admin — it never shows on the public site** (see `assets/css/editor.css`).

Nothing here is a request for you to review it again in this doc — it's a map, so you know where
to look when you *do* review it.

## Home (`patterns/home-*.php`, assembled in `templates/front-page.html`)

| Section | Status |
|---|---|
| Hero headline | `[LOCKED]` |
| Hero subhead | `[NEW]` |
| Problem (business risk) — all 3 lines | `[LOCKED]` |
| Problem (personal cost) — first 2 lines | `[LOCKED]` |
| Problem (personal cost) — closing line | `[NEW]` |
| What Cardo Means — both paragraphs | `[LOCKED]`, mechanically renamed from "Notch" — **see flag below, this needs a real look** |
| Method teaser — first 2 lines | `[LOCKED]` |
| Method teaser — transition line | `[NEW]` |
| Stakes — all 3 lines | `[LOCKED]` |
| Proof/outcomes — all 3 lines | `[LOCKED]`, but the **whole section** is a placeholder (brief §7.3) — no real client results exist yet |
| Qualifier — all 3 lines | `[LOCKED]` |
| Closing CTA headline | `[LOCKED]` |
| Closing CTA subhead | `[NEW]` |

## Services (`patterns/services-*.php`, assembled in `templates/page-services.html`)

| Section | Status |
|---|---|
| Hero — both lines | `[LOCKED]` |
| FIXR intro line | `[NEW]` |
| F/I/X/R short lines | `[LOCKED]`-adjacent (pulled from Pillars 3 & 5) or `[LOCKED]` |
| F/I/X/R expanded lines (all 4) | `[NEW]` |
| **Tier section (What's Included)** | **`[NEW]`, entire section drafted from scratch — highest-risk content on the site (brief §7.5)** |
| Objection handling — all 4 lines | `[LOCKED]` |
| Closing CTA | `[LOCKED]` |

## About (`patterns/about-*.php`, assembled in `templates/page-about.html`)

| Section | Status |
|---|---|
| Hero headline | `[LOCKED]` |
| Hero subhead | `[NEW]` |
| Samantha's bio | `[NEW]`, drafted from brand summary facts — needs your review/expansion. Clear to publish. |
| Brandon's bio | `[NEW]`, drafted — **NOT published** (see flag below) |
| North Star (full) | `[LOCKED]` |
| What Cardo Means (full, five associations) | `[LOCKED]`, mechanically renamed — **see flag below** |
| Who this is for — all 3 lines | `[LOCKED]` |
| Closing CTA | `[NEW]`, and button text changed from the draft (see flag below) |

## Contact (`patterns/contact-*.php` + `inc/contact-form.php`, assembled in `templates/page-contact.html`)

| Section | Status |
|---|---|
| Hero headline | `[LOCKED]` |
| Hero subhead | `[NEW]` |
| Fit-check intro | `[NEW]` |
| Fit-check reinforcing line | `[LOCKED]` |
| Form field labels/microcopy | `[NEW]` |
| Confirmation copy | `[NEW]` (includes a placeholder "2 business days" — brief left this as `[X business days]`, pick a real number) |
| Alternate path copy | `[NEW]` |
| Direct info block | `[NEW]` — all values are literal placeholders (`[placeholder — ...]`), must be replaced before launch |

---

## Flags — things I did not silently resolve

These came up while adapting the copy doc and are worth your explicit sign-off, beyond the six
open items already listed in the brief (all of which are still open — see README.md):

1. **The "What Cardo Means" wordplay doesn't survive the rename.** The five associations
   (Precision, Connection, Partnership, Progress, Quality, Practicality) lean on idioms specific
   to the word *notch* — "take it up a notch," "top-notch." Under the name Cardo, those no longer
   read as brand wordplay, just unrelated idioms sitting next to the Cardo name. The setup line
   ("A notch is a groove cut precisely enough...") still works as a metaphor-definition sentence
   since it uses "notch" as a plain noun, but the associations list likely needs a real rewrite
   built around what *Cardo* itself evokes (Latin for hinge/pivot; also the main street a Roman
   city was built around — both arguably fit the "connects two things" metaphor even better than
   notch did) rather than a find-and-replace. I shipped it find-and-replaced for now, flagged
   inline in the editor and here. See `patterns/about-what-cardo-means-full.php` and
   `patterns/home-what-cardo-means.php`.

2. **Service tier count doesn't match between the site map and the copy doc.** Brief §5 calls for
   four tiers (free diagnostic scorecard → FIXR Audit → FIXR Install → Recalibration Retainer)
   plus a bundled Audit+Install option. The copy doc only drafted three: Operations Diagnostic,
   Systems Build, Leadership & Rhythm — nothing for the free scorecard or the bundle. I built the
   three that have copy and left a clearly flagged placeholder card for the scorecard rather than
   inventing copy for either gap. See `patterns/services-tiers.php`.

3. **About page closing CTA named Brandon before his bio can be published.** The draft button
   text was "Talk to Sam & Brandon," but his involvement is still pending the conflict-of-interest
   review (brief §7.4) and his bio isn't live. Naming him in a CTA button would publicly commit to
   his involvement ahead of that clearing, so the live button currently reads "Talk to us." Swap
   back once he's cleared. See `patterns/about-cta.php`.

4. **Contact confirmation copy has a placeholder number.** The brief's copy doc left
   "within `[X business days]`" as a blank to fill in — I used "2 business days" as a placeholder
   so the page reads naturally; replace with whatever's actually accurate.
