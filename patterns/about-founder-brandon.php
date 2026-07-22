<?php
/**
 * Pattern: About — Founder Bio: Brandon
 * Status: [NEW] — drafted, flagged for approval before publishing.
 *
 * DO NOT ADD THIS PATTERN TO THE LIVE ABOUT TEMPLATE until Brandon's union/employer
 * conflict-of-interest review clears (brief Section 7, item 4 — his current field role
 * has employment/union restrictions under review). This pattern is registered so it's
 * one click to insert in the block editor the moment it's cleared, but it is intentionally
 * left OUT of templates/page-about.html by default.
 *
 * It is registered in its own category ("cardo-about-pending") so it's easy to find in the
 * pattern inserter without being mistaken for approved content.
 */
return array(
	'title'      => 'About — Founder: Brandon (DO NOT PUBLISH — pending clearance)',
	'categories' => array( 'cardo-about-pending' ),
	'content'    => '<!-- wp:group {"tagName":"section","style":{"spacing":{"padding":{"top":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}},"border":{"width":"1px","color":"var:preset|color|steel-light"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group" style="border-color:var(--wp--preset--color--steel-light);border-width:1px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--40)">

<!-- wp:heading {"level":3,"fontSize":"large"} -->
<h3 class="wp-block-heading has-large-font-size">Brandon <span class="cardo-draft-flag">DO NOT PUBLISH — pending clearance</span></h3>
<!-- /wp:heading -->

<!-- wp:paragraph -->
<p>Brandon is an active UA Local 787 multi-trade foreman and PM &#8212; still out there, in the field, standing in when a sub no-shows or a schedule falls apart. He&#8217;s the reason Cardo&#8217;s systems get built for the people who&#8217;ll actually use them, not just the people who&#8217;ll read the report.</p>
<!-- /wp:paragraph -->

</section>
<!-- /wp:group -->',
);
