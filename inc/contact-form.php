<?php
/**
 * [cardo_contact_form] — native contact form (no page-builder/forms-plugin dependency).
 *
 * Fields match the brief: Name, Company name, Phone or email, Approximate annual revenue
 * (soft qualifier dropdown), and an open-text prompt. On submit it:
 *   1. Emails the site admin.
 *   2. POSTs the submission as JSON to the webhook URL configured in
 *      Settings → General → Cardo Settings (or the CARDO_ZAPIER_WEBHOOK_URL constant),
 *      so it can feed Zapier or any other automation/CRM tool.
 *   3. Redirects back to the same page with a flag that swaps the form for the
 *      confirmation copy, avoiding duplicate submissions on refresh.
 *
 * If a dedicated forms plugin (WPForms/Fluent Forms/Gravity Forms) is preferred later,
 * this shortcode can be swapped out in patterns/contact-form.php without touching anything
 * else on the page.
 */

defined( 'ABSPATH' ) || exit;

add_shortcode( 'cardo_contact_form', 'cardo_render_contact_form' );

function cardo_maybe_handle_contact_submission() {
	if ( ! isset( $_POST['cardo_contact_nonce'] ) ) {
		return;
	}

	if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['cardo_contact_nonce'] ) ), 'cardo_contact_form' ) ) {
		return;
	}

	// Honeypot — real users never fill this in.
	if ( ! empty( $_POST['cardo_website'] ) ) {
		return;
	}

	$name    = isset( $_POST['cardo_name'] ) ? sanitize_text_field( wp_unslash( $_POST['cardo_name'] ) ) : '';
	$company = isset( $_POST['cardo_company'] ) ? sanitize_text_field( wp_unslash( $_POST['cardo_company'] ) ) : '';
	$contact = isset( $_POST['cardo_contact'] ) ? sanitize_text_field( wp_unslash( $_POST['cardo_contact'] ) ) : '';
	$revenue = isset( $_POST['cardo_revenue'] ) ? sanitize_text_field( wp_unslash( $_POST['cardo_revenue'] ) ) : '';
	$note    = isset( $_POST['cardo_note'] ) ? sanitize_textarea_field( wp_unslash( $_POST['cardo_note'] ) ) : '';

	if ( '' === $name || '' === $contact ) {
		return;
	}

	$revenue_labels = cardo_revenue_options();
	$revenue_label  = $revenue_labels[ $revenue ] ?? $revenue;

	$submission = array(
		'name'          => $name,
		'company'       => $company,
		'contact'       => $contact,
		'revenue'       => $revenue,
		'revenue_label' => $revenue_label,
		'note'          => $note,
		'submitted_at'  => current_time( 'mysql' ),
		'source_url'    => home_url( add_query_arg( array(), wp_unslash( $_SERVER['REQUEST_URI'] ?? '' ) ) ),
	);

	$to      = get_option( 'admin_email' );
	$subject = sprintf( 'New Cardo contact form submission — %s', $name );
	$body    = "New submission from the Cardo contact form:\n\n"
		. "Name: {$name}\n"
		. "Company: {$company}\n"
		. "Phone/email: {$contact}\n"
		. "Approximate annual revenue: {$revenue_label}\n"
		. "What would've made last week easier: {$note}\n";
	wp_mail( $to, $subject, $body );

	$webhook_url = cardo_get_zapier_webhook_url();
	if ( $webhook_url ) {
		wp_remote_post(
			$webhook_url,
			array(
				'timeout'  => 10,
				'blocking' => false,
				'headers'  => array( 'Content-Type' => 'application/json' ),
				'body'     => wp_json_encode( $submission ),
			)
		);
	}

	$redirect_url = remove_query_arg( 'cardo_submitted', wp_get_referer() ?: home_url( '/contact/' ) );
	$redirect_url = add_query_arg( 'cardo_submitted', '1', $redirect_url );
	wp_safe_redirect( $redirect_url . '#contact-form' );
	exit;
}
add_action( 'template_redirect', 'cardo_maybe_handle_contact_submission' );

function cardo_revenue_options() {
	return array(
		''           => 'Prefer not to say',
		'under-1m'   => 'Under $1M',
		'1m-3m'      => '$1M–$3M',
		'3m-5m'      => '$3M–$5M',
		'5m-10m'     => '$5M–$10M',
		'10m-plus'   => '$10M+',
	);
}

function cardo_render_contact_form() {
	ob_start();

	if ( isset( $_GET['cardo_submitted'] ) && '1' === $_GET['cardo_submitted'] ) {
		?>
		<div class="cardo-form-confirmation" id="contact-form">
			<p>
				<?php
				esc_html_e(
					'Got it. We’ll get back to you within 2 business days — usually faster during slow season, slower during bidding season, same as everybody else in this trade.',
					'cardo'
				);
				?>
			</p>
		</div>
		<?php
	} else {
		?>
		<form class="cardo-contact-form" method="post" id="contact-form">
			<?php wp_nonce_field( 'cardo_contact_form', 'cardo_contact_nonce' ); ?>

			<p class="cardo-honeypot" aria-hidden="true">
				<label>Leave this field empty
					<input type="text" name="cardo_website" value="" tabindex="-1" autocomplete="off">
				</label>
			</p>

			<p>
				<label for="cardo_name">Name
					<input type="text" id="cardo_name" name="cardo_name" required>
				</label>
			</p>

			<p>
				<label for="cardo_company">Company name
					<input type="text" id="cardo_company" name="cardo_company" required>
				</label>
			</p>

			<p>
				<label for="cardo_contact">Phone or email
					<input type="text" id="cardo_contact" name="cardo_contact" required>
				</label>
			</p>

			<p>
				<label for="cardo_revenue">Approximate annual revenue
					<select id="cardo_revenue" name="cardo_revenue">
						<?php foreach ( cardo_revenue_options() as $value => $label ) : ?>
							<option value="<?php echo esc_attr( $value ); ?>"><?php echo esc_html( $label ); ?></option>
						<?php endforeach; ?>
					</select>
				</label>
			</p>

			<p>
				<label for="cardo_note">What&#8217;s the one thing that would&#8217;ve made last week easier?
					<textarea id="cardo_note" name="cardo_note" rows="3"></textarea>
				</label>
			</p>

			<p>
				<button type="submit" class="wp-block-button__link wp-element-button">Send it</button>
			</p>
		</form>
		<?php
	}

	return ob_get_clean();
}
