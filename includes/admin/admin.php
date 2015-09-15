<?php
/**
 * Trestle admin functions.
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

/**
 * Set up Trestle default settings.
 *
 * @since  2.0.0
 *
 * @return  array  Genesis settings updated to include Trestle defaults.
 */
function trestle_settings_defaults() {

	// Trestle default key/value pairs.
	$trestle_defaults = array(
		'layout'                => 'solid',
		'logo_id'               => '',
		'logo_id_mobile'        => '',
		'favicon_url'           => '',
		'nav_primary_location'  => 'full',
		'mobile_nav_toggle'     => 'small-icon',
		'search_in_nav'         => '',
		'read_more_text'        => __( 'Read&nbsp;More&nbsp;&raquo;', 'trestle' ),
		'revisions_number'      => 3,
		'footer_widgets_number' => 3,
		'external_link_icons'   => 0,
		'email_link_icons'      => 0,
		'pdf_link_icons'        => 0,
		'doc_link_icons'        => 0,
	);

	// Populate Trestle settings with default values if they don't yet exist.
	$options = get_option( TRESTLE_SETTINGS_FIELD );

	// Set up an empty array if we're running for the first time.
	if ( ! $options ) {
		$options = array();
	}

	// Bail early if the settings match the defaults.
	if ( $options === $trestle_defaults ) {
		return;
	}

	// Populate any defaults that are missing.
	foreach ( $trestle_defaults as $k => $v ) {

		// Check each key to only add the missing settings.
		if ( ! array_key_exists( $k, $options ) ) {
			$options[$k] = $v;
		}
	}

	// Update options with defaults.
	update_option( TRESTLE_SETTINGS_FIELD, $options );

}

/**
 * Wrapper function to get Trestle options.
 *
 * @since   2.0.0
 * @uses    genesis_get_option()
 *
 * @return  mixed    Trestle option value.
 */
function trestle_get_option( $key, $setting = null, $use_cache = true ) {

	// Set default to TRESTLE_SETTINGS_FIELD.
	$setting = $setting ? $setting : TRESTLE_SETTINGS_FIELD;

	return genesis_get_option( $key, $setting, false );

}

add_action( 'admin_enqueue_scripts', 'trestle_admin_actions' );
/**
 * Loads admin scripts and styles.
 *
 * @since 1.0.0
 */
function trestle_admin_actions() {

	// Google fonts.
	$font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Lato:300,400,700' );
	add_editor_style( $font_url );

	// Include the main stylesheet in the editor.
	add_editor_style( get_stylesheet_uri() );

}

add_filter( 'tiny_mce_before_init', 'trestle_tiny_mce_before_init' );
/**
 * Add custom classes to the body of TinyMCE previews.
 *
 * @since  2.2.0
 */
function trestle_tiny_mce_before_init( $init_array ) {

	global $post;

	$screen = get_current_screen();

	// If we're on an edit screen, add an appropriate 'post-id-XX' or 'page-id-XX'.
	if ( is_object( $screen ) && 'edit' == $screen->parent_base ) {

		// Custom post types always use 'post', so we only need to handle pages.
		$post_type = ( 'page' == $post->post_type ) ? 'page' : 'post';

		$init_array['body_class'] .= sprintf( ' %s-id-%s',
			$post_type,
			$post->ID
		);
	}

	return $init_array;
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
			'name' 		=> 'Easy FancyBox',
			'slug' 		=> 'easy-fancybox',
			'required'  => false,
		),

		array(
			'name' 		=> 'Equal Height Columns',
			'slug' 		=> 'equal-height-columns',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Exclude Pages',
			'slug' 		=> 'exclude-pages',
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
			'name' 		=> 'RICG Responsive Images',
			'slug' 		=> 'ricg-responsive-images',
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
			'name' 		=> 'WordPress SEO by Yoast',
			'slug' 		=> 'wordpress-seo',
			'required' 	=> false,
		),

	);

	// Change this to your theme text domain, used for internationalising strings.
	$theme_text_domain = 'trestle';

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
