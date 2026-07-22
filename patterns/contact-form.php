<?php
/**
 * Pattern: Contact — Form
 * Status: [NEW] field labels/microcopy — drafted for this doc, needs review.
 * The actual form markup, nonce, honeypot, and submit handling live in inc/contact-form.php
 * (loaded from functions.php) and render via the [cardo_contact_form] shortcode so the same
 * logic can be reused/tested without duplicating markup in every template.
 */
return array(
	'title'      => 'Contact — Form',
	'categories' => array( 'cardo-contact' ),
	'content'    => '<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|40","right":"var:preset|spacing|40"}}},"layout":{"type":"constrained","contentSize":"640px"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--40)">

<!-- wp:shortcode -->
[cardo_contact_form]
<!-- /wp:shortcode -->

</section>
<!-- /wp:group -->',
);
