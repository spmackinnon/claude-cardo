<?php
/**
 * [cardo_booking_cta] — "Book a call" button/embed.
 *
 * Renders an inline Calendly embed if the configured booking URL looks like a Calendly link,
 * a plain "Book a call" button for any other scheduling tool's URL, or a mailto: fallback if
 * no booking URL has been configured yet (Settings → General → Cardo Settings).
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'cardo_booking_cta', 'cardo_render_booking_cta' );

function cardo_render_booking_cta() {
	$booking_url = cardo_get_booking_url();

	if ( ! $booking_url ) {
		$admin_email = get_option( 'admin_email' );
		return sprintf(
			'<p class="cardo-booking-fallback"><a class="wp-block-button__link wp-element-button" href="%s">%s</a></p><p class="cardo-draft-flag">Booking link not configured yet — set one in Settings → General → Cardo Settings.</p>',
			esc_url( 'mailto:' . $admin_email ),
			esc_html__( 'Email us to book a call', 'cardo' )
		);
	}

	if ( false !== strpos( $booking_url, 'calendly.com' ) ) {
		return sprintf(
			'<div class="cardo-calendly-embed" style="min-width:320px;height:700px;"><iframe src="%s" width="100%%" height="100%%" frameborder="0" title="%s" loading="lazy"></iframe></div>',
			esc_url( $booking_url ),
			esc_attr__( 'Book a call with Cardo', 'cardo' )
		);
	}

	return sprintf(
		'<p><a class="wp-block-button__link wp-element-button" href="%s" target="_blank" rel="noopener">%s</a></p>',
		esc_url( $booking_url ),
		esc_html__( 'Book a call', 'cardo' )
	);
}
