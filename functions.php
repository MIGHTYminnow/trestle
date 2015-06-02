<?php

/**
 * Theme functionality.
 *
 * @since  1.0.0
 *
 * @package Trestle
 */

/*===========================================
 * Required Files
===========================================*/

// Theme functions.
require_once dirname( __FILE__ ) . '/includes/functions/theme-functions.php';

// Admin functionality.
require_once dirname( __FILE__ ) . '/includes/admin/admin.php';

// Customizer controls.
require_once dirname( __FILE__ ) . '/includes/admin/customizer.php';

// Shortcodes.
require_once dirname( __FILE__ ) . '/includes/shortcodes/shortcodes.php';

// Additional sidebars.
require_once dirname( __FILE__ ) . '/includes/widget-areas/widget-areas.php';

// Plugin activation class.
require_once dirname( __FILE__ ) . '/includes/classes/class-tgm-plugin-activation.php';

// Better Font Awesome Library.
require_once dirname( __FILE__ ) . '/lib/better-font-awesome-library/better-font-awesome-library.php';

// Utility functions.
require_once dirname( __FILE__ ) . '/includes/functions/utilities.php';


add_action( 'genesis_setup', 'trestle_theme_setup', 15 );
/**
 * Initialize Trestle.
 *
 * @since  1.0.0
 */
function trestle_theme_setup() {

	/*===========================================
	 * Theme Setup
	===========================================*/

	// Child theme definitions (do not remove).
	define( 'TRESTLE_THEME_NAME', 'Trestle' );
	define( 'TRESTLE_THEME_URL', 'http://demo.mightyminnow.com/theme/trestle/' );
	define( 'TRESTLE_THEME_VERSION', '2.0.1' );
	define( 'TRESTLE_SETTINGS_FIELD', 'trestle-settings' );

	// Setup default theme settings.
	trestle_settings_defaults();

	// Load theme text domain.
	load_theme_textdomain( 'trestle', get_stylesheet_directory() . '/languages' );

}
