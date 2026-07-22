<?php
/**
 * Pattern: Contact — Alternate Path (book a call)
 * Status: [NEW] copy — needs review.
 * Calendly (or similar) embed is not yet configured — Samantha needs to supply the booking
 * link. The shortcode below renders a plain button linking to that URL until it's set; once
 * set, it renders the inline scheduling widget instead. Configure via
 * Settings → General → Cardo Settings, or the CARDO_BOOKING_URL constant in wp-config.php.
 */
return array(
	'title'      => 'Contact — Alternate Path (Book a Call)',
	'categories' => array( 'cardo-contact' ),
	'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"backgroundColor":"steel-light","layout":{"type":"constrained","contentSize":"640px"}} -->
<section id="book-a-call" class="wp-block-group alignfull has-steel-light-background-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--40)">

<!-- wp:heading {"level":2,"fontSize":"large"} -->
<h2 class="wp-block-heading has-large-font-size">Would rather talk than type?</h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"fontSize":"large"} -->
<p class="has-large-font-size">Book a call directly &#8212; no form, no waiting on us to reach out. <span class="cardo-draft-flag">Draft copy</span></p>
<!-- /wp:paragraph -->

<!-- wp:shortcode -->
[cardo_booking_cta]
<!-- /wp:shortcode -->

</section>
<!-- /wp:group -->',
);
