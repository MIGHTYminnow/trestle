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

}
