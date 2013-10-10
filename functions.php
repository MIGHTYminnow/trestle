<?php

/*===========================================
 * Genesis Theme Basics
===========================================*/

// Start the engine
include_once( get_template_directory() . '/lib/init.php' );

// Other includes
require_once dirname( __FILE__ ) . '/includes/admin/admin.php';

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Trestle' );
define( 'CHILD_THEME_URL', 'http://www.mightyminnow.com/2013/08/our-new-mobile-first-child-theme-for-genesis-2-0/' );
define( 'CHILD_THEME_VERSION', '1.3' );

// Add HTML5 markup structure
add_theme_support( 'html5' );

// Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );


/*===========================================
 * Header styles and scripts
===========================================*/

function trestle_header_actions() {

	// Google fonts
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Lato:300,700' );

	// Custom jQuery
	wp_enqueue_script( 'trestle_jquery', get_stylesheet_directory_uri() . '/includes/js/trestle-jquery.js', array( 'jquery' ), '1.0', true );

}
add_action( 'wp_enqueue_scripts', 'trestle_header_actions');


/*===========================================
 * Admin styles and scripts
===========================================*/
function trestle_admin_actions() {
    add_editor_style( get_stylesheet_directory_uri() . '/includes/admin/admin.css' );
}
add_action( 'init', 'trestle_admin_actions' );


/*===========================================
 * Load Required/Suggested Plugins
 * 
 * Utilizes TGM Plugin Activation class: https://github.com/thomasgriffin/TGM-Plugin-Activation
===========================================*/

// Include plugin activation class
require_once dirname( __FILE__ ) . '/includes/classes/class-tgm-plugin-activation.php';

// Fetch & install plugins from wordpress.org
function trestle_register_required_plugins() {

	$plugins = array(

		// Required plugins
		array(
			'name' 		=> 'Font Awesome Icons',
			'slug' 		=> 'font-awesome',
			'required' 	=> true,
		),

		// Optional plugins
		array(
			'name' 		=> 'Black Studio TinyMCE Widget',
			'slug' 		=> 'black-studio-tinymce-widget',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Events Manager',
			'slug' 		=> 'events-manager',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Exclude Pages',
			'slug' 		=> 'exclude-pages',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'FancyBox for WordPress',
			'slug' 		=> 'fancybox-for-wordpress',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Genesis Featured Widget Amplified',
			'slug' 		=> 'genesis-featured-widget-amplified',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Genesis Simple Edits',
			'slug' 		=> 'genesis-simple-edits',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'MapPress Easy Google Maps',
			'slug' 		=> 'mappress-google-maps-for-wordpress',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'My Page Order',
			'slug' 		=> 'my-page-order',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'NextGen Gallery',
			'slug' 		=> 'nextgen-gallery',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Post Thumbnail Editor',
			'slug' 		=> 'post-thumbnail-editor',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Social Media Widget',
			'slug' 		=> 'social-media-widget',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Widget Context',
			'slug' 		=> 'widget-context',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Respond.js',
			'slug' 		=> 'respondjs',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Simple Image Sizes',
			'slug' 		=> 'simple-image-sizes',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Simple Section Navigation',
			'slug' 		=> 'simple-section-navigation',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Types - Custom Fields and Custom Post Types Management',
			'slug' 		=> 'types',
			'required' 	=> true,
		),

	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'mightyminnow';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );

}
add_action( 'tgmpa_register', 'trestle_register_required_plugins' );


/*===========================================
 * Auto & Mobile Navigation
===========================================*/

function trestle_nav_modifications() {

	// Auto-generate nav if Genesis theme setting is checked
	if ( 1 == genesis_get_option( 'auto_nav' ) ) {

		// Remove existing nav
		remove_action( 'genesis_after_header', 'genesis_do_nav' );

		// Replace existing nav with auto-generated nav
		function trestle_auto_nav() {
			
			$args = array(
				'echo'           => false,
				'show_home'      => genesis_get_option( 'include_home_link' ),
				'menu_class'     => ''
			);

			$ul_class = 'menu genesis-nav-menu menu-primary';

			$nav = preg_replace('/<ul>/', '<ul class="' . $ul_class . '">', wp_page_menu( $args ) , 1);

			$nav_markup_open = genesis_markup( array(
				'html5'   => '<nav %s>',
				'xhtml'   => '<div id="nav">',
				'context' => 'nav-primary',
				'echo'    => false,
			) );
			$nav_markup_open .= genesis_structural_wrap( 'menu-primary', 'open', 0 );

			$nav_markup_close  = genesis_structural_wrap( 'menu-primary', 'close', 0 );
			$nav_markup_close .= genesis_html5() ? '</nav>' : '</div>';

			echo apply_filters ( 'trestle_do_nav', $nav_markup_open . $nav . $nav_markup_close );
		}
		add_action( 'genesis_after_header', 'trestle_auto_nav', 10 );

	}

	// Add mobile menu button
	function trestle_add_mobile_nav() {
		if ( 1 == genesis_get_option( 'auto_nav' ) || has_nav_menu( 'primary' ) )
			echo '<a id="menu-button" class="button" href="javascript: void()"><i class="icon-list-ul"></i>&nbsp;&nbsp;Navigation</a>';
	}
    add_action( 'genesis_after_header', 'trestle_add_mobile_nav', 0 );
            	
           
}
add_action( 'init', 'trestle_nav_modifications' );


/*===========================================
 * Actions & Filters
===========================================*/


/*===========================================
 * Footer
===========================================*/
function trestle_custom_footer($output) {
	return $output . '<p class="mm">[footer_childtheme_link before=""] by <a href="http://mightyminnow.com">MIGHTYminnow</a></p>';
}
add_filter( 'genesis_footer_output', 'trestle_custom_footer' );


/*===========================================
 * Shortcodes
===========================================*/