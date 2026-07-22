<?php
/**
 * Pattern: Services — What's Included (tiers)
 * Status: [NEW] — this entire section was drafted from scratch (the messaging bank has no
 * service-tier copy yet). HIGHER RISK than the rest of the site — needs extra review before
 * launch (brief Section 7, item 5).
 *
 * Also flagging a mismatch for Samantha's review: the site map (brief Section 5) lists FOUR
 * tiers — free diagnostic scorecard, FIXR Audit, FIXR Install, Recalibration Retainer (plus a
 * bundled Audit+Install option) — but the working copy doc only drafted THREE: Operations
 * Diagnostic, Systems Build, Leadership & Rhythm. There's no drafted copy anywhere for the
 * "free diagnostic scorecard" entry-point offer, and no bundle pricing/copy. Rather than invent
 * either, this pattern ships the three tiers that exist and leaves a clearly flagged placeholder
 * card for the scorecard so the section can hold a fourth tier without a layout change once
 * that copy exists.
 *
 * Names below are functional labels only, per brief Section 7 item 6 — do not treat as final
 * product names. Each tier is an independent block so cards can be reordered, renamed, or
 * dropped without touching the rest of the page.
 */
return array(
	'title'      => 'Services — Tiers (draft, high-risk)',
	'categories' => array( 'cardo-services' ),
	'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"off-white","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-off-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

<!-- wp:heading {"level":2,"fontSize":"x-large"} -->
<h2 class="wp-block-heading has-x-large-font-size">What&#8217;s included <span class="cardo-draft-flag">Draft — names + scope not final</span></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"small","textColor":"steel"} -->
<p class="has-steel-color has-text-color has-small-font-size">Working titles below — final offer names TBD. Copy is drafted, not pulled from the approved messaging bank; treat as a starting structure. <span class="cardo-draft-flag">Whole section is draft</span></p>
<!-- /wp:paragraph -->

<!-- wp:columns {"style":{"spacing":{"margin":{"top":"var:preset|spacing|50"}}}} -->
<div class="wp-block-columns" style="margin-top:var(--wp--preset--spacing--50)">

	<!-- wp:column {"style":{"border":{"width":"1px","color":"var:preset|color|steel-light"},"spacing":{"padding":"var:preset|spacing|40"}}} -->
	<div class="wp-block-column" style="border-color:var(--wp--preset--color--steel-light);border-width:1px;padding:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"level":3,"fontSize":"medium"} -->
		<h3 class="wp-block-heading has-medium-font-size">Operations Diagnostic</h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"fontSize":"small","textColor":"steel"} -->
		<p class="has-steel-color has-text-color has-small-font-size">Working label for &#8220;FIXR Audit&#8221;</p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph -->
		<p>The FIXR walk-through. We spend time on-site and in the office finding exactly where the business is losing time, money, or trust &#8212; and hand you a punch list, not a report that sits in a drawer.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"style":{"border":{"width":"1px","color":"var:preset|color|steel-light"},"spacing":{"padding":"var:preset|spacing|40"}}} -->
	<div class="wp-block-column" style="border-color:var(--wp--preset--color--steel-light);border-width:1px;padding:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"level":3,"fontSize":"medium"} -->
		<h3 class="wp-block-heading has-medium-font-size">Systems Build</h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"fontSize":"small","textColor":"steel"} -->
		<p class="has-steel-color has-text-color has-small-font-size">Working label for &#8220;FIXR Install&#8221;</p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph -->
		<p>We build the specific systems your diagnostic points to &#8212; scheduling, job costing, reporting, whatever&#8217;s actually broken. No off-the-shelf software forced onto a crew that won&#8217;t use it.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

	<!-- wp:column {"style":{"border":{"width":"1px","color":"var:preset|color|steel-light"},"spacing":{"padding":"var:preset|spacing|40"}}} -->
	<div class="wp-block-column" style="border-color:var(--wp--preset--color--steel-light);border-width:1px;padding:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"level":3,"fontSize":"medium"} -->
		<h3 class="wp-block-heading has-medium-font-size">Leadership &#38; Rhythm</h3>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"fontSize":"small","textColor":"steel"} -->
		<p class="has-steel-color has-text-color has-small-font-size">Working label for &#8220;Recalibration Retainer&#8221;</p>
		<!-- /wp:paragraph -->
		<!-- wp:paragraph -->
		<p>A recurring check-in structure &#8212; weekly numbers, monthly priorities &#8212; so the systems hold after the build is done. This is the part most consultants skip.</p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:column -->

</div>
<!-- /wp:columns -->

<!-- wp:group {"style":{"border":{"width":"1px","style":"dashed","color":"var:preset|color|steel"},"spacing":{"padding":"var:preset|spacing|40","margin":{"top":"var:preset|spacing|40"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group" style="border-color:var(--wp--preset--color--steel);border-style:dashed;border-width:1px;margin-top:var(--wp--preset--spacing--40);padding:var(--wp--preset--spacing--40)">
	<!-- wp:paragraph {"fontSize":"small"} -->
	<p class="has-small-font-size"><strong>Entry point (not yet drafted):</strong> the site map calls for a free diagnostic scorecard ahead of the Operations Diagnostic, plus a bundled Audit+Install option. Neither has copy yet — this card is a placeholder for that content. <span class="cardo-draft-flag">Needs copy from Samantha</span></p>
	<!-- /wp:paragraph -->
</div>
<!-- /wp:group -->

<!-- wp:paragraph {"fontSize":"small","textColor":"steel"} -->
<p class="has-steel-color has-text-color has-small-font-size">Note: whether these are sold as a package or &#224; la carte still needs a decision &#8212; copy above assumes sequential (Diagnostic &#8594; Build &#8594; Rhythm). Adjust if the pricing structure differs. <span class="cardo-draft-flag">Draft copy</span></p>
<!-- /wp:paragraph -->

</section>
<!-- /wp:group -->',
);
