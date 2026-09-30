# Stripe Integration — TODO

Hosted Stripe Checkout: visitors click a button, WordPress creates a Checkout Session, and they're redirected to a payment page hosted by Stripe.

## Values to Replace

The following values are placeholders and must be updated before going live.

**Files containing placeholders:**
- [inc/stripe-checkout.php](inc/stripe-checkout.php)

| Field | Current Value | What to Set |
|-------|--------------|-------------|
| mode | payment | Set to "payment" for one-time charges or "subscription" for recurring billing (e.g. the retainer). If you switch to "subscription", `payment_method_collection: always` is added automatically. |
| success_url | `home_url('/checkout-success/')` + `?session_id={CHECKOUT_SESSION_ID}` | Your actual post-payment success page URL. Create the page in WordPress, or point this at an existing one. Keep the `{CHECKOUT_SESSION_ID}` template. |
| cancel_url | `home_url('/services/')` | Your actual cancel/return page URL. |
| line_items[].price | price_... | Your actual Stripe Price ID from the Dashboard (https://dashboard.stripe.com/prices) or API. |

## Configured Parameters

These parameters were configured in Checkout Studio and are already set correctly.

**Files containing these parameters:**
- [inc/stripe-checkout.php](inc/stripe-checkout.php)

| Parameter | Value |
|-----------|-------|
| ui_mode | hosted_page |
| billing_address_collection | auto |
| phone_number_collection | `{ enabled: false }` |
| automatic_tax | `{ enabled: true }` |
| allow_promotion_codes | true |
| payment_method_collection | always (sent only when mode is "subscription") |
| submit_type | auto |
| name_collection | `{ individual: { enabled: true }, business: { enabled: true, optional: true } }` |
| integration_identifier | hosted_web_0001 |
| origin_context | web |

> **Note on `ui_mode`:** The theme calls Stripe's REST API directly through the WordPress HTTP API instead of using a Stripe SDK, so no SDK version pins the value. It uses `hosted_page`, the value for current API versions and for SDK 21.0.0+. Older API versions (and SDKs below 21.0.0) call this `hosted`. If Stripe rejects `hosted_page` on your account's API version, change it to `hosted` in [inc/stripe-checkout.php](inc/stripe-checkout.php), or upgrade the account's default API version in the Dashboard. No API version is set in code, so requests use your account's default version.

## Setup

1. **API key.** Get your secret key from https://dashboard.stripe.com/test/apikeys and add it to `wp-config.php` (never commit it to the theme):
   ```php
   define( 'STRIPE_SECRET_KEY', 'sk_test_...' );
   ```
   A `STRIPE_SECRET_KEY` environment variable works too. The key is server-only. This integration has no browser-side code, so it doesn't need a publishable key.
2. **Automatic tax.** `automatic_tax` is enabled, so turn on Stripe Tax and set your origin address at https://dashboard.stripe.com/settings/tax. Otherwise, session creation fails.
3. **Dependencies.** None. The request goes through `wp_remote_post()`, so you don't need Composer or the `stripe-php` package.
4. **Place the button.** Add the `[cardo_checkout_button]` shortcode (optionally `[cardo_checkout_button label="Book the Diagnostic"]`) to any page or pattern with a Shortcode block, for example a tier card in `patterns/services-tiers.php`.

## Files

```
inc/stripe-checkout.php     [cardo_checkout_button] shortcode + checkout-session endpoint (new)
functions.php               loads inc/stripe-checkout.php (one-line change)
STRIPE_INTEGRATION_TODO.md  this file (new)
```

## How it works

1. `[cardo_checkout_button]` renders a small form that POSTs to `wp-admin/admin-post.php` with `action=cardo_create_checkout_session` and a nonce.
2. `cardo_handle_create_checkout_session()` checks the nonce, then calls `POST https://api.stripe.com/v1/checkout/sessions` with the parameters above.
3. The visitor is 303-redirected to the Stripe-hosted Checkout page (`session.url`).
4. After payment, Stripe sends them to `success_url`. If they cancel, it sends them to `cancel_url`.
5. If session creation fails, the error is written to the PHP error log and the visitor sees a generic "couldn't start checkout" message.

## Testing

- Use test-mode keys (`sk_test_...`).
- Card `4242 4242 4242 4242`, any future expiry, any CVC, and any postal code always succeeds.
- Card `4000 0025 0000 3155` requires 3D Secure authentication. Card `4000 0000 0000 9995` is declined.
- More test cards: https://docs.stripe.com/testing
- Check sessions and payments at https://dashboard.stripe.com/test/payments.

## Next steps

- **Products and prices.** Create a Product and Price for each paid tier in the Dashboard and replace `price_...`. To sell more than one tier, pass a tier identifier from the shortcode and map it to a Price ID on the server. Never trust a price sent from the browser.
- **Fulfillment.** The theme has no webhook handler yet. Add a webhook endpoint that listens for `checkout.session.completed` and verifies the `Stripe-Signature` header with a `STRIPE_WEBHOOK_SECRET` from https://dashboard.stripe.com/workbench/webhooks. Use it to trigger onboarding, for example by posting to the existing Zapier webhook. Don't rely on the success page for fulfillment.
- **Order tracking.** Payments, customers, and receipts are visible in the Stripe Dashboard. If you also want them in WordPress or a CRM, record them from the webhook.
- **Go live.** Swap in the `sk_live_...` key and live Price IDs, and confirm the tax settings in live mode.

## Resources

- Stripe support: https://support.stripe.com
- Stripe MCP (use Stripe from AI tools): https://docs.stripe.com/mcp
- Checkout docs: https://docs.stripe.com/payments/checkout
