<?php

/**
 * Genesis Theme Setup
 * @since  1.0
 *
 * This setup function attaches all theme functionality 
 * via the appropriate hooks and filters and includes
 * additional theme files
 */

add_action( 'genesis_setup' ,'trestle_theme_setup', 15 );
function trestle_theme_setup() {

	/*===========================================
	 * Trestle theme settings
	===========================================*/

	// Child theme definitions (do not remove)
	define( 'CHILD_THEME_NAME', 'Trestle' );
	define( 'CHILD_THEME_URL', 'http://demo.mightyminnow.com/theme/trestle/' );
	define( 'CHILD_THEME_VERSION', '1.0' );

	// Load theme text domain
	load_theme_textdomain( 'trestle', get_template_directory() . '/languages');

	// Add HTML5 markup structure
	add_theme_support( 'html5' );

	// Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for custom background
	add_theme_support( 'custom-background' );

	// Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );


	/*===========================================
	 * Required Files
	===========================================*/
	
	// Trestle theme functions
	require_once dirname( __FILE__ ) . '/lib/functions/trestle-functions.php';

	// Admin functionality
	require_once dirname( __FILE__ ) . '/lib/admin/admin.php';
	
	// Plugin activation class
	require_once dirname( __FILE__ ) . '/lib/classes/class-tgm-plugin-activation.php';


	/*===========================================
	 * Styles and scripts
	===========================================*/

	add_action( 'wp_enqueue_scripts', 'trestle_header_actions');


	/*===========================================
	 * Admin styles and scripts
	===========================================*/
	
	add_action( 'init', 'trestle_admin_actions' );


	/*===========================================
	 * Load Required/Suggested Plugins
	 * 
	 * Utilizes TGM Plugin Activation class: 
	 * https://github.com/thomasgriffin/TGM-Plugin-Activation
	===========================================*/
	
	add_action( 'tgmpa_register', 'trestle_register_required_plugins' );


	/*===========================================
	 * Auto & Mobile Navigation
	===========================================*/	
	
	// Implement auto-nav
	add_action( 'init', 'trestle_nav_modifications' );

	// Add mobile nav button
	add_action( 'genesis_after_header', 'trestle_add_mobile_nav', 0 );


	/*===========================================
	 * Actions & Filters
	===========================================*/

	// Add jquery class to body for styling nav if jQuery isn't enabled (jQuery will remove this class if enabled)
	add_filter('body_class','no_jquery');


	/*===========================================
	 * Footer
	===========================================*/

	// Add Trestle custom footer attribute to Mm
	add_filter( 'genesis_footer_output', 'trestle_custom_footer' );

}