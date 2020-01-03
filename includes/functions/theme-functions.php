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
 * 3rd Party Libraries
===========================================*/

add_action( 'init', 'trestle_load_bfa' );
/**
 * Initialize the Better Font Awesome Library.
 *
 * @since  2.0.0
 */
function trestle_load_bfa() {

	// Better Font Awesome Library
	require_once trailingslashit( get_stylesheet_directory() ) . 'lib/better-font-awesome-library/better-font-awesome-library.php';

	// Set the library initialization args.
	$args = array(
			'version'             => 'latest',
			'minified'            => true,
			'remove_existing_fa'  => false,
			'load_styles'         => true,
			'load_admin_styles'   => true,
			'load_shortcode'      => true,
			'load_tinymce_plugin' => true,
	);

	// Initialize the Better Font Awesome Library.
	Better_Font_Awesome_Library::get_instance( $args );

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

add_filter( 'genesis_pre_load_favicon', 'trestle_do_custom_favicon' );
/**
 * Output custom favicon if specified in the theme options.
 *
 * @since   1.0.0
 *
 * @param   string  $favicon_url  Default favicon URL.
 *
 * @return  string  Custom favicon URL (if specified), or the default URL.
 */
function trestle_do_custom_favicon( $favicon_url ) {

	$trestle_favicon_url = trestle_get_option( 'favicon_url' );
	return $trestle_favicon_url ? $trestle_favicon_url : $favicon_url;
}

/*===========================================
 * Body Classes
===========================================*/

add_filter( 'body_class', 'trestle_body_classes' );
/**
 * Adds custom classes to the <body> element for styling purposes.
 *
 * @since 1.0.0
 *
 * @param array $classes Body classes.
 * @return array 		 Updated body classes.
 */
function trestle_body_classes( $classes ) {

	// Add 'no-jquery' class to be removed by jQuery if enabled.
	$classes[] = 'no-jquery';

	// Add 'bubble' class.
	if ( 'bubble' == trestle_get_option( 'layout' ) )
		$classes[] = 'bubble';

	// Add 'boxed' class.
	if ( 'boxed' == trestle_get_option( 'layout' ) )
		$classes[] = 'boxed';

	// Add link icon classes.
	if ( trestle_get_option( 'external_link_icons' ) ) {
		$classes[] = 'external-link-icons';
	}
	if ( trestle_get_option( 'email_link_icons' ) ) {
		$classes[] = 'email-link-icons';
	}
	if ( trestle_get_option( 'pdf_link_icons' ) ) {
		$classes[] = 'pdf-link-icons';
	}
	if ( trestle_get_option( 'doc_link_icons' ) ) {
		$classes[] = 'doc-link-icons';
	}

	// Logo position
	if ( trestle_get_option( 'logo_position' ) ) {
		$classes[] = trestle_get_option( 'logo_position' );
	}

	// Add menu style class.
	$nav_primary_location = esc_attr( trestle_get_option( 'nav_primary_location' ) );
	if ( $nav_primary_location ) {
		$classes[] = 'nav-primary-location-' . $nav_primary_location;
	}

	// Add mobile menu toggle class.
	$mobile_nav_toggle = esc_attr( trestle_get_option( 'mobile_nav_toggle' ) );
	if ( 'big-button' == $mobile_nav_toggle ) {
		$classes[] = 'big-button-nav-toggle';
	} elseif ( 'small-icon' == $mobile_nav_toggle ) {
		$classes[] = 'small-icon-nav-toggle';
	}

	// Add footer widget number class.
	$footer_widgets_number = esc_attr( trestle_get_option( 'footer_widgets_number' ) );
	if ( $footer_widgets_number ) {
		$classes[] = 'footer-widgets-number-' . $footer_widgets_number;
	}

	// Add logo class.
	if ( trestle_get_option( 'logo_id' ) || trestle_get_option( 'logo_id_mobile' ) ) {
		$classes[] = 'has-logo';
	}

	// Add fullscreen search class.
	if ( trestle_get_option( 'fullscreen_search' ) ) {
		$classes[] = 'fullscreen-search';
	}

	return $classes;

}
