<?php
/**
 * Trestle theme functions (front-end)
 *
 * Note: all admin theme functionality is located at: lib/admin/admin.php
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

/*===========================================
 * Theme Setup
===========================================*/
add_action( 'after_setup_theme', 'trestle_add_theme_support' );
/**
 * Initialize Trestle defaults and theme options.
 *
 * @since    2.0.0
 */
function trestle_add_theme_support() {

	// Add HTML5 markup structure.
	add_theme_support( 'html5' );

	// Add viewport meta tag for mobile browsers.
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for footer widgets if specified in Trestle settings.
	add_theme_support( 'genesis-footer-widgets', trestle_get_option( 'footer_widgets_number' ) );

	if( ! trestle_get_option( 'disable_trestle_accessiblity' ) ) {
		//* Add Accessibility support.
		add_theme_support( 'genesis-accessibility', array( 'headings', 'drop-down-menu',  'search-form', 'skip-links', 'rems' ) );
	}

	//* Add Custom Background support.
	add_theme_support( 'custom-background' );

}

add_action( 'after_setup_theme', 'trestle_remove_genesis_css_enqueue' );
/**
 * Stop Genesis from enqueuing the child theme stylesheet in the usual way.
 *
 * @since    2.1.0
 */
function trestle_remove_genesis_css_enqueue() {

	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

}

/*===========================================
 * Header
===========================================*/

add_action( 'wp_enqueue_scripts', 'trestle_header_actions', 15 );
/**
 * Loads theme scripts and styles.
 *
 * @since  1.0.0
 */
function trestle_header_actions() {

	// Our main stylesheet.
	wp_enqueue_style( 'trestle', get_stylesheet_uri(), array(), TRESTLE_THEME_VERSION );

	// Google fonts.
	wp_enqueue_style( 'theme-google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700' );

	// Theme jQuery.
	wp_enqueue_script( 'theme-jquery', get_stylesheet_directory_uri() . '/includes/js/theme-jquery.js', array( 'jquery' ), TRESTLE_THEME_VERSION, true );

	// Prepare and include some necessary variables.
	$mobile_nav_text = apply_filters( 'trestle_mobile_nav_text', __( 'Navigation', 'trestle' ) );
	wp_localize_script(
		'theme-jquery',
		'trestle_vars',
		array(
			'mobile_nav_text' => esc_attr( $mobile_nav_text ),
		)
	);

	// Get WP uploads directory.
	$upload_dir = wp_upload_dir();
	$upload_path = $upload_dir['basedir'];
	$upload_url = $upload_dir['baseurl'];

	// Custom CSS (if it exists).
	$custom_css_file = '/trestle/custom.css';
	if ( is_readable( $upload_path . $custom_css_file ) )
		wp_enqueue_style( 'trestle-custom-css', $upload_url . $custom_css_file );

	// Custom jQuery (if it exists).
	$custom_js_file = '/trestle/custom.js';
	if ( is_readable( $upload_path . $custom_js_file ) )
		wp_enqueue_script( 'trestle-custom-jquery', $upload_url . $custom_js_file, array( 'jquery' ), TRESTLE_THEME_VERSION, true );

}
