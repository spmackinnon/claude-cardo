<?php
/**
 * Pattern: About — Closing CTA
 * Status: [NEW] — needs review before launch.
 *
 * Note: the drafted CTA button text was "Talk to Sam & Brandon," but Brandon's public
 * involvement is still pending conflict-of-interest clearance (see about-founder-brandon.php).
 * Naming him here would publicly commit to his involvement before that's cleared, so the button
 * below defaults to "Talk to us" instead. Swap back to naming both founders once cleared.
 */
return array(
	'title'      => 'About — Closing CTA',
	'categories' => array( 'cardo-about' ),
	'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|70","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"charcoal","textColor":"white","layout":{"type":"constrained","contentSize":"640px"}} -->
<section class="wp-block-group alignfull has-white-color has-charcoal-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--70);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--70);padding-left:var(--wp--preset--spacing--40)">

<!-- wp:heading {"level":2,"fontSize":"large","textColor":"white","style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center has-white-color has-text-color has-large-font-size">If any of this sounds like your Monday morning, let&#8217;s talk. <span class="cardo-draft-flag">Draft copy</span></h2>
<!-- /wp:heading -->

<!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
<div class="wp-block-buttons">
	<!-- wp:button -->
	<div class="wp-block-button"><a class="wp-block-button__link wp-element-button" href="/contact/#book-a-call">Talk to us</a></div>
	<!-- /wp:button -->
</div>
<!-- /wp:buttons -->

</section>
<!-- /wp:group -->',
);
