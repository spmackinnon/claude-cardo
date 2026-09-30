<?php
/**
 * Cardo theme bootstrap.
 */

defined( 'ABSPATH' ) || exit;

define( 'CARDO_THEME_VERSION', '0.1.0' );
define( 'CARDO_THEME_DIR', get_template_directory() );
define( 'CARDO_THEME_URI', get_template_directory_uri() );

/**
 * Theme supports + asset enqueuing.
 */
function cardo_setup() {
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' ) );
	add_editor_style( 'assets/css/editor.css' );
}
add_action( 'after_setup_theme', 'cardo_setup' );

function cardo_enqueue_assets() {
	wp_enqueue_style( 'cardo-style', get_stylesheet_uri(), array(), CARDO_THEME_VERSION );
}
add_action( 'wp_enqueue_scripts', 'cardo_enqueue_assets' );

/**
 * Register block pattern category + auto-load every pattern in /patterns.
 * Each file in /patterns returns an array with 'title', 'categories', 'content'
 * (and optionally 'description'). The pattern slug is derived from the filename,
 * namespaced as cardo/<filename>.
 */
function cardo_register_pattern_categories() {
	register_block_pattern_category( 'cardo-home', array( 'label' => __( 'Cardo — Home', 'cardo' ) ) );
	register_block_pattern_category( 'cardo-services', array( 'label' => __( 'Cardo — Services', 'cardo' ) ) );
	register_block_pattern_category( 'cardo-about', array( 'label' => __( 'Cardo — About', 'cardo' ) ) );
	register_block_pattern_category( 'cardo-about-pending', array( 'label' => __( 'Cardo — About (pending approval, do not publish)', 'cardo' ) ) );
	register_block_pattern_category( 'cardo-contact', array( 'label' => __( 'Cardo — Contact', 'cardo' ) ) );
}
add_action( 'init', 'cardo_register_pattern_categories' );

function cardo_register_patterns() {
	foreach ( glob( CARDO_THEME_DIR . '/patterns/*.php' ) as $pattern_file ) {
		$slug = 'cardo/' . basename( $pattern_file, '.php' );
		$data = require $pattern_file;

		if ( ! is_array( $data ) || empty( $data['content'] ) ) {
			continue;
		}

		register_block_pattern(
			$slug,
			array(
				'title'       => $data['title'] ?? $slug,
				'description' => $data['description'] ?? '',
				'categories'  => $data['categories'] ?? array(),
				'content'     => $data['content'],
			)
		);
	}
}
add_action( 'init', 'cardo_register_patterns' );

/**
 * [cardo_year] — used in the footer copyright line (block template parts are static HTML
 * files, so a shortcode is the simplest way to keep the year current without hardcoding it).
 */
add_shortcode( 'cardo_year', fn() => esc_html( gmdate( 'Y' ) ) );

/**
 * Contact form (submission handling), settings, and booking CTA.
 */
require CARDO_THEME_DIR . '/inc/settings.php';
require CARDO_THEME_DIR . '/inc/contact-form.php';
require CARDO_THEME_DIR . '/inc/booking.php';
require CARDO_THEME_DIR . '/inc/stripe-checkout.php';
