<?php
/**
 * Trestle admin functions.
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

add_action( 'admin_enqueue_scripts', 'trestle_admin_actions' );
/**
 * Loads admin scripts and styles.
 *
 * @since 1.0.0
 */
function trestle_admin_actions() {

	// Include the main stylesheet in the editor
	add_editor_style( get_stylesheet_uri() );
}

add_filter( 'genesis_theme_settings_defaults', 'trestle_custom_defaults' );
/**
 * Sets up Trestle default settings.
 *
 * @since  1.0.0
 *
 * @param  array  $defaults  Genesis default settings.
 * @return  array  Genesis settings updated to include Trestle defaults.
 */
function trestle_custom_defaults( $defaults ) {

 	// Trestle default key/value pairs
 	$trestle_defaults = array(
		'trestle_layout'                => 'solid',
		'trestle_logo_url'              => '',
		'trestle_logo_url_mobile'       => '',
		'trestle_nav_primary_location'  => 'full',
		'trestle_read_more_text'        => __( 'Read&nbsp;More&nbsp;&raquo;', 'trestle' ),
		'trestle_revisions_number'      => 3,
		'trestle_footer_widgets_number' => 3,
	);

	// Populate Trestle settings with default values if they don't yet exist
	$options = get_option( GENESIS_SETTINGS_FIELD );

	foreach ( $trestle_defaults as $k => $v ) {

		// Add defaults to Genesis default settings array
		$defaults[$k] = $v;

		// Update actual options if they don't yet exist
		if ( $options && ! array_key_exists( $k, $options ) )
			$options[$k] = $v;
	}

	// Update options with defaults
	update_option( GENESIS_SETTINGS_FIELD, $options );

	return $defaults;
}

add_action( 'tgmpa_register', 'trestle_register_required_plugins' );
/**
 * Loads required & recommended plugins.
 *
 * Utilizes TGM Plugin Activation class:
 * https://github.com/thomasgriffin/TGM-Plugin-Activation
 *
 * @since 1.0.0
 *
 * @see tgmpa() in /includes/classes/class-tgm-plugin-activation.php
 */
function trestle_register_required_plugins() {

	$plugins = array(
		// Required plugins
		array(
			'name' 		=> 'Better Font Awesome',
			'slug' 		=> 'better-font-awesome',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Respond.js',
			'slug' 		=> 'respondjs',
			'required' 	=> true,
		),

		// Optional plugins
		array(
			'name' 		=> 'Black Studio TinyMCE Widget',
			'slug' 		=> 'black-studio-tinymce-widget',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Events Manager',
			'slug' 		=> 'events-manager',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Exclude Pages',
			'slug' 		=> 'exclude-pages',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Facebook Open Graph Meta Tags for WordPress',
			'slug' 		=> 'wonderm00ns-simple-facebook-open-graph-tags',
			'required'  => false,
		),

		array(
			'name' 		=> 'FancyBox for WordPress',
			'slug' 		=> 'fancybox-for-wordpress',
			'required'  => false,
		),

		array(
			'name' 		=> 'Genesis Featured Widget Amplified',
			'slug' 		=> 'genesis-featured-widget-amplified',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Genesis Simple Edits',
			'slug' 		=> 'genesis-simple-edits',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Google Analytics for WordPress',
			'slug' 		=> 'google-analytics-for-wordpress',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Jetpack by WordPress.com',
			'slug' 		=> 'jetpack',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'MapPress Easy Google Maps',
			'slug' 		=> 'mappress-google-maps-for-wordpress',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'My Page Order',
			'slug' 		=> 'my-page-order',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'NextGen Gallery',
			'slug' 		=> 'nextgen-gallery',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Post Thumbnail Editor',
			'slug' 		=> 'post-thumbnail-editor',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Post Types Order',
			'slug' 		=> 'post-types-order',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Responsive Video Embeds',
			'slug' 		=> 'responsive-video-embeds',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Social Media Widget',
			'slug' 		=> 'social-media-widget',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Widget Context',
			'slug' 		=> 'widget-context',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Simple Image Sizes',
			'slug' 		=> 'simple-image-sizes',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Simple Section Navigation',
			'slug' 		=> 'simple-section-navigation',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Types - Custom Fields and Custom Post Types Management',
			'slug' 		=> 'types',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'WP Hotkeys',
			'slug' 		=> 'wp-hotkeys',
			'required' 	=> false,
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
			'notice_can_install_recommended'			=> _n_noop( 'Recommended plugin: %1$s.', 'Recommended plugins: %1$s.' ), // %1$s = plugin name(s)
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
