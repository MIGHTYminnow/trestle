<?php
/**
 * Academy Pro.
 *
 * This file adds the WooCommerce styles and the custom CSS to the Academy Pro Theme's custom WooCommerce stylesheet.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

add_filter( 'woocommerce_enqueue_styles', 'academy_woocommerce_styles' );
/**
 * Enqueues the theme's custom WooCommerce styles to the WooCommerce plugin.
 *
 * @since 1.0.0
 *
 * @return array Required values for the theme's WooCommerce stylesheet.
 */
function academy_woocommerce_styles( $enqueue_styles ) {

	$enqueue_styles['academy-woocommerce-styles'] = array(
		'deps'    => '',
		'media'   => 'screen',
		'src'     => get_stylesheet_directory_uri() . '/lib/woocommerce/academy-woocommerce.css',
		'version' => CHILD_THEME_VERSION,
	);

	return $enqueue_styles;

}

add_action( 'wp_enqueue_scripts', 'academy_woocommerce_css' );
/**
 * Adds the themes's custom CSS to the WooCommerce stylesheet.
 *
 * @since 1.0.0
 */
function academy_woocommerce_css() {

	// If WooCommerce isn't active, exits early.
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$color_link = get_theme_mod( 'academy_primary_color', academy_customizer_get_default_primary_color() );

	$woo_css = '';

	$woo_css .= ( academy_customizer_get_default_primary_color() !== $color_link ) ? sprintf( '

		.woocommerce div.product p.price,
		.woocommerce div.product span.price,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:focus,
		.woocommerce ul.products li.product h3:hover,
		.woocommerce ul.products li.product .price,
		.woocommerce ul.products li.product .woocommerce-loop-category__title:hover,
		.woocommerce ul.products li.product .woocommerce-loop-product__title:hover,
		.woocommerce ul.products li.product h3:hover,
		.woocommerce .widget_layered_nav ul li.chosen a::before,
		.woocommerce .widget_layered_nav_filters ul li a::before,
		.woocommerce .widget_rating_filter ul li.chosen a::before,
		.woocommerce .widget_rating_filter ul li.chosen a::before,
		.woocommerce .woocommerce-breadcrumb a:hover,
		.woocommerce .woocommerce-breadcrumb a:focus,
		.woocommerce-error::before,
		.woocommerce-info::before,
		.woocommerce-message::before {
			color: %1$s;
		}

		ul.woocommerce-error,
		.woocommerce a.button.secondary,
		.woocommerce a.button.text,
		.woocommerce button.secondary,
		.woocommerce button.text,
		.woocommerce input[type="button"].secondary,
		.woocommerce input[type="reset"].secondary,
		.woocommerce input[type="submit"].secondary,
		.woocommerce input[type="button"].text,
		.woocommerce input[type="reset"].text,
		.woocommerce input[type="submit"].text,
		.woocommerce nav.woocommerce-pagination ul li a:focus,
		.woocommerce nav.woocommerce-pagination ul li a:hover,
		.woocommerce nav.woocommerce-pagination ul li span.current,
		.woocommerce .button.secondary,
		.woocommerce .button.text,
		.woocommerce-error,
		.woocommerce-info,
		.woocommerce-message {
			border-color: %1$s;
		}

		.woocommerce a.button,
		.woocommerce a.button.alt,
		.woocommerce button.button,
		.woocommerce button.button.alt,
		.woocommerce a.button:focus,
		.woocommerce a.button:hover,
		.woocommerce a.button.alt:focus,
		.woocommerce a.button.alt:hover,
		.woocommerce button.button:focus,
		.woocommerce button.button:hover,
		.woocommerce button.button.alt:focus,
		.woocommerce button.button.alt:hover,
		.woocommerce input.button,
		.woocommerce input.button:focus,
		.woocommerce input.button:hover,
		.woocommerce input.button.alt,
		.woocommerce input.button.alt:focus,
		.woocommerce input.button.alt:hover,
		.woocommerce input.button[type="submit"],
		.woocommerce input[type="submit"]:focus,
		.woocommerce input[type="submit"]:hover,
		.woocommerce nav.woocommerce-pagination ul li a:focus,
		.woocommerce nav.woocommerce-pagination ul li a:hover,
		.woocommerce nav.woocommerce-pagination ul li span.current,
		.woocommerce span.onsale,
		.woocommerce #respond input#submit,
		.woocommerce #respond input#submit:focus,
		.woocommerce #respond input#submit:hover,
		.woocommerce #respond input#submit.alt,
		.woocommerce #respond input#submit.alt:focus,
		.woocommerce #respond input#submit.alt:hover {
			background-color: %1$s;
		}

		.woocommerce a.button.text:focus,
		.woocommerce a.button.text:hover,
		.woocommerce a.button.secondary:focus,
		.woocommerce a.button.secondary:hover,
		.woocommerce button.text:focus,
		.woocommerce button.text:hover,
		.woocommerce button.secondary:focus,
		.woocommerce button.secondary:hover,
		.woocommerce input[type="button"].secondary:focus,
		.woocommerce input[type="button"].secondary:hover,
		.woocommerce input[type="reset"].secondary:focus,
		.woocommerce input[type="reset"].secondary:hover,
		.woocommerce input[type="submit"].secondary:focus,
		.woocommerce input[type="submit"].secondary:hover,
		.woocommerce input[type="button"].text:focus,
		.woocommerce input[type="button"].text:hover,
		.woocommerce input[type="reset"].text:focus,
		.woocommerce input[type="reset"].text:hover,
		.woocommerce input[type="submit"].text:focus,
		.woocommerce input[type="submit"].text:hover,
		.woocommerce .button.secondary:focus,
		.woocommerce .button.secondary:hover,
		.woocommerce .button.text:focus,
		.woocommerce .button.text:hover {
			border-color: %1$s;
			color: %1$s;
		}

	', $color_link ) : '';

	if ( $woo_css ) {
		wp_add_inline_style( 'academy-woocommerce-styles', $woo_css );
	}

}
