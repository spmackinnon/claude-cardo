<?php
/**
 * Stripe Checkout (hosted) — [cardo_checkout_button] shortcode + session-creation endpoint.
 *
 * The button POSTs to wp-admin/admin-post.php?action=cardo_create_checkout_session, which
 * creates a Checkout Session via Stripe's API and 303-redirects the visitor to the
 * Stripe-hosted payment page. Uses the WordPress HTTP API directly (same as the contact
 * form's webhook) rather than the stripe-php SDK, so the theme stays dependency-free.
 *
 * Secret key: define STRIPE_SECRET_KEY in wp-config.php (or set it as an environment variable).
 * See STRIPE_INTEGRATION_TODO.md for the placeholder values that still need replacing.
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'cardo_checkout_button', 'cardo_render_checkout_button' );

function cardo_get_stripe_secret_key() {
	if ( defined( 'STRIPE_SECRET_KEY' ) && STRIPE_SECRET_KEY ) {
		return STRIPE_SECRET_KEY;
	}
	return getenv( 'STRIPE_SECRET_KEY' ) ?: '';
}

function cardo_handle_create_checkout_session() {
	if ( ! isset( $_POST['cardo_checkout_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cardo_checkout_nonce'] ) ), 'cardo_checkout' ) ) {
		wp_die( esc_html__( 'Invalid checkout request.', 'cardo' ), '', array( 'response' => 400 ) );
	}

	$secret_key = cardo_get_stripe_secret_key();
	if ( ! $secret_key ) {
		wp_die( esc_html__( 'Payments are not configured yet.', 'cardo' ), '', array( 'response' => 500 ) );
	}

	// TODO: Set mode to "subscription" if selling recurring products.
	$mode = 'payment';

	$session_params = array(
		'ui_mode'                    => 'hosted_page',
		'billing_address_collection' => 'auto',
		'phone_number_collection'    => array( 'enabled' => 'false' ),
		'automatic_tax'              => array( 'enabled' => 'true' ),
		'allow_promotion_codes'      => 'true',
		'submit_type'                => 'auto',
		'name_collection'            => array(
			'individual' => array( 'enabled' => 'true' ),
			'business'   => array(
				'enabled'  => 'true',
				'optional' => 'true',
			),
		),
		'integration_identifier'     => 'hosted_web_0001',
		'origin_context'             => 'web',
		'mode'                       => $mode,
		// TODO: Replace with real success/cancel pages and Stripe Price IDs.
		'success_url'                => home_url( '/checkout-success/' ) . '?session_id={CHECKOUT_SESSION_ID}',
		'cancel_url'                 => home_url( '/services/' ),
		'line_items'                 => array(
			array(
				'price'    => 'price_...',
				'quantity' => 1,
			),
		),
	);
	if ( 'subscription' === $mode ) {
		$session_params['payment_method_collection'] = 'always';
	}

	$response = wp_remote_post(
		'https://api.stripe.com/v1/checkout/sessions',
		array(
			'timeout' => 20,
			'headers' => array( 'Authorization' => 'Bearer ' . $secret_key ),
			'body'    => $session_params,
		)
	);

	$session = is_wp_error( $response ) ? null : json_decode( wp_remote_retrieve_body( $response ), true );
	if ( empty( $session['url'] ) ) {
		error_log( 'Cardo Stripe Checkout error: ' . ( is_wp_error( $response ) ? $response->get_error_message() : wp_remote_retrieve_body( $response ) ) );
		wp_die( esc_html__( 'Sorry, we couldn’t start checkout. Please try again or contact us.', 'cardo' ), '', array( 'response' => 502 ) );
	}

	wp_redirect( $session['url'], 303 );
	exit;
}
add_action( 'admin_post_nopriv_cardo_create_checkout_session', 'cardo_handle_create_checkout_session' );
add_action( 'admin_post_cardo_create_checkout_session', 'cardo_handle_create_checkout_session' );

function cardo_render_checkout_button( $atts ) {
	$atts = shortcode_atts( array( 'label' => __( 'Pay now', 'cardo' ) ), $atts, 'cardo_checkout_button' );

	ob_start();
	?>
	<form class="cardo-checkout-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
		<input type="hidden" name="action" value="cardo_create_checkout_session">
		<?php wp_nonce_field( 'cardo_checkout', 'cardo_checkout_nonce' ); ?>
		<button type="submit" class="wp-block-button__link wp-element-button"><?php echo esc_html( $atts['label'] ); ?></button>
	</form>
	<?php
	return ob_get_clean();
}
