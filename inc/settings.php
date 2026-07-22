<?php
/**
 * Cardo settings — Zapier/webhook URL and booking link, both editable from
 * wp-admin → Settings → General without touching code.
 */

defined( 'ABSPATH' ) || exit;

function cardo_register_settings() {
	register_setting(
		'general',
		'cardo_zapier_webhook_url',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '',
		)
	);
	register_setting(
		'general',
		'cardo_booking_url',
		array(
			'type'              => 'string',
			'sanitize_callback' => 'esc_url_raw',
			'default'           => '',
		)
	);

	add_settings_section(
		'cardo_settings_section',
		__( 'Cardo Settings', 'cardo' ),
		function () {
			echo '<p>' . esc_html__( 'Connect the contact form to your CRM/automation tool and set the "Book a call" link.', 'cardo' ) . '</p>';
		},
		'general'
	);

	add_settings_field(
		'cardo_zapier_webhook_url',
		__( 'Contact form webhook URL', 'cardo' ),
		function () {
			$value = get_option( 'cardo_zapier_webhook_url', '' );
			echo '<input type="url" class="regular-text" name="cardo_zapier_webhook_url" value="' . esc_attr( $value ) . '" placeholder="https://hooks.zapier.com/...">';
			echo '<p class="description">' . esc_html__( 'Every contact form submission is POSTed here as JSON (name, company, contact, revenue range, note). Leave blank to disable — submissions still email the site admin either way.', 'cardo' ) . '</p>';
		},
		'general',
		'cardo_settings_section'
	);

	add_settings_field(
		'cardo_booking_url',
		__( 'Booking link (Calendly or similar)', 'cardo' ),
		function () {
			$value = get_option( 'cardo_booking_url', '' );
			echo '<input type="url" class="regular-text" name="cardo_booking_url" value="' . esc_attr( $value ) . '" placeholder="https://calendly.com/...">';
			echo '<p class="description">' . esc_html__( 'Powers the "Book a call" buttons site-wide and the Contact page alternate path. Leave blank to fall back to a mailto: link.', 'cardo' ) . '</p>';
		},
		'general',
		'cardo_settings_section'
	);
}
add_action( 'admin_init', 'cardo_register_settings' );

/**
 * Prefer a wp-config.php constant over the DB option, for sites that manage secrets that way.
 */
function cardo_get_zapier_webhook_url() {
	if ( defined( 'CARDO_ZAPIER_WEBHOOK_URL' ) && CARDO_ZAPIER_WEBHOOK_URL ) {
		return CARDO_ZAPIER_WEBHOOK_URL;
	}
	return get_option( 'cardo_zapier_webhook_url', '' );
}

function cardo_get_booking_url() {
	if ( defined( 'CARDO_BOOKING_URL' ) && CARDO_BOOKING_URL ) {
		return CARDO_BOOKING_URL;
	}
	return get_option( 'cardo_booking_url', '' );
}
