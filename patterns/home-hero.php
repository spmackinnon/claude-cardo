<?php
/**
 * Pattern: Home — Hero
 * Status: [LOCKED] headline / [NEW] subhead — subhead needs Samantha's review before launch.
 * Tagline: not locked (Section 7, item 1). Headline leans on North Star language.
 * Structured so a tagline can slot in above the headline later without rebuilding this section —
 * see the empty "tagline slot" comment below.
 */
return array(
	'title'      => 'Home — Hero',
	'categories' => array( 'cardo-home' ),
	'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"charcoal","textColor":"white","layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull has-white-color has-charcoal-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

<!-- Tagline slot: reserved for the locked tagline once brand sign-off happens. Leave empty until then. -->

<!-- wp:heading {"level":1,"fontSize":"xx-large","style":{"typography":{"lineHeight":"1.1"}},"textColor":"white"} -->
<h1 class="wp-block-heading has-white-color has-text-color has-xx-large-font-size" style="line-height:1.1">Most people who fix businesses have never actually run one. We have — on both ends of it.</h1>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large","textColor":"steel-light"} -->
<p class="has-steel-light-color has-text-color has-large-font-size">One of us ran PM on ICI job sites. The other&#8217;s still out there in the field, standing in when things go sideways. We don&#8217;t hand you theory. We install what we know actually holds up &#8212; because we&#8217;ve been the ones relying on it.</p>
<!-- /wp:paragraph -->

<!-- wp:buttons -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/#book-a-call">Book a call</a></div>
	<!-- /wp:button -->
	<!-- wp:button {"className":"is-style-outline"} -->
	<div class="wp-block-button is-style-outline"><a class="wp-block-button__link wp-element-button" href="/services/">See how it works</a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

</section>
<!-- /wp:group -->',
);
