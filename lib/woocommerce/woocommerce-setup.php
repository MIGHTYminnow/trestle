<?php
/**
 * Academy Pro.
 *
 * This file adds the required WooCommerce setup functions to the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

add_action( 'wp_enqueue_scripts', 'academy_products_match_height', 99 );
/**
 * Prints an inline script to the footer to keep products the same height.
 *
 * @since 1.0.0
 */
function academy_products_match_height() {

	// If WooCommerce isn't active or not on a WooCommerce page, exits early.
	if ( ! class_exists( 'WooCommerce' ) || ! is_shop() && ! is_woocommerce() && ! is_cart() ) {
		return;
	}

	wp_add_inline_script( 'academy-match-height', "jQuery(document).ready( function() { jQuery( '.product .woocommerce-LoopProduct-link').matchHeight(); });" );

}

add_filter( 'woocommerce_style_smallscreen_breakpoint', 'academy_woocommerce_breakpoint' );
/**
 * Modifies the WooCommerce breakpoints.
 *
 * @since 1.0.0
 */
function academy_woocommerce_breakpoint() {

	$current = genesis_site_layout();
	$layouts = array(
		'content-sidebar',
		'sidebar-content',
	);

	if ( in_array( $current, $layouts, true ) ) {
		return '1200px';
	} else {
		return '1023px';
	}

}

add_filter( 'genesiswooc_default_products_per_page', 'academy_default_products_per_page' );
/**
 * Sets the default products per page value.
 *
 * @since 1.0.0
 *
 * @return int Number of products to show per page.
 */
function academy_default_products_per_page() {

	return 8;

}

add_filter( 'loop_shop_columns', 'academy_woo_loop_columns' );
/**
 * Modifies number of product columns.
 *
 * @since 1.0.0
 *
 * @return int Number of columns for product archives.
 */
function academy_woo_loop_columns() {

	$site_layout = genesis_site_layout();

	if ( 'full-width-content' === $site_layout ) {
		return 4;
	} else {
		return 2;
	}

}

add_filter( 'woocommerce_pagination_args', 'academy_woocommerce_pagination' );
/**
 * Updates the next and previous arrows to the default Genesis style.
 *
 * @since 1.0.0
 *
 * @param array $args The pagination arguments.
 * @return array Arguments with modified next and previous text strings.
 */
function academy_woocommerce_pagination( $args ) {

	$args['prev_text'] = sprintf( '&laquo; %s', __( 'Previous Page', 'academy-pro' ) );
	$args['next_text'] = sprintf( '%s &raquo;', __( 'Next Page', 'academy-pro' ) );

	return $args;

}

add_action( 'after_switch_theme', 'academy_woocommerce_image_dimensions_after_theme_setup', 1 );
/**
 * Defines WooCommerce image sizes on theme activation.
 *
 * @since 1.0.0
 */
function academy_woocommerce_image_dimensions_after_theme_setup() {

	global $pagenow;

	if ( ! isset( $_GET['activated'] ) || 'themes.php' !== $pagenow || ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	academy_update_woocommerce_image_dimensions();

}

add_action( 'activated_plugin', 'academy_woocommerce_image_dimensions_after_woo_activation', 10, 2 );
/**
 * Defines the WooCommerce image sizes on WooCommerce activation.
 *
 * @since 1.0.0
 *
 * @param string $plugin The plugin path or slug.
 */
function academy_woocommerce_image_dimensions_after_woo_activation( $plugin ) {

	// Checks to see if WooCommerce is being activated.
	if ( 'woocommerce/woocommerce.php' !== $plugin ) {
		return;
	}

	academy_update_woocommerce_image_dimensions();

}

/**
 * Updates WooCommerce image dimensions.
 *
 * @since 1.0.0
 */
function academy_update_woocommerce_image_dimensions() {

	// Updates image size options.
	update_option( 'woocommerce_single_image_width', 830 );    // Single product image.
	update_option( 'woocommerce_thumbnail_image_width', 500 ); // Catalog image.

	// Updates image cropping option.
	update_option( 'woocommerce_thumbnail_cropping', '1:1' );

}

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'academy_gallery_image_thumbnail' );
/**
 * Filters the WooCommerce gallery image dimensions.
 *
 * @since 1.0.5
 *
 * @param array $size The gallery image size and crop arguments.
 * @return array The modified gallery image size and crop arguments.
 */
function academy_gallery_image_thumbnail( $size ) {

	$size = array(
		'width'  => 180,
		'height' => 180,
		'crop'   => 1,
	);

	return $size;

}
