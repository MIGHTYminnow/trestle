<?php
/*===========================================
 * Trestle Custom Theme Settings
 *
 * Modified from: http://www.billerickson.net/genesis-theme-options/
===========================================*/

/**
 * Register Defaults
 *
 * @param array $defaults
 * @return  array $defaults updated defaults
 */
 
function trestle_custom_defaults( $defaults ) {
 	
 	// Trestle default key/value pairs
 	$trestle_defaults = array(
		'trestle_auto_nav' => '0',
		'trestle_include_home_link' => '0',
		'trestle_nav_button_text' => __( '[icon name="icon-list-ul"]  Navigation', 'trestle' ),
	);

	// Populate Trestle settings with default values if they don't yet exist
	$options = get_option( GENESIS_SETTINGS_FIELD );
	foreach ( $trestle_defaults as $k => $v ) {

		// Add defaults to Genesis default settings array
		$defaults[$k] = $v;

		// Update actual options if they don't yet exist
		if ( $options && !array_key_exists( $k, $options ) ) 
			$options[$k] = $v;

	}
	update_option( GENESIS_SETTINGS_FIELD, $options );

	//
 					
 	// Return modified default array
	return $defaults;

}
add_filter( 'genesis_theme_settings_defaults', 'trestle_custom_defaults' );

// Also perform
 
/**
 * Sanitization
 */
 
function trestle_register_social_sanitization_filters() {
	
	// No HTML
	genesis_add_option_filter( 
		'no_html', 
		GENESIS_SETTINGS_FIELD,
		array(
			'auto_nav',
			'include_home_link',
		)
	);

	// Safe HTML
	genesis_add_option_filter( 
		'safe_html', 
		GENESIS_SETTINGS_FIELD,
		array(
			'nav_button_text',
		)
	);
}
add_action( 'genesis_settings_sanitizer_init', 'trestle_register_social_sanitization_filters' );
 
 
/**
 * Register Metabox
 *
 * @param string $_genesis_theme_settings_pagehook
 */
 
function trestle_register_settings_box( $_genesis_theme_settings_pagehook ) {

	global $_genesis_admin_settings;

	// Remove default Genesis nav metabox
    remove_meta_box('genesis-theme-settings-nav', $_genesis_admin_settings->pagehook, 'main');

    // Call our own custom nav metabox which combines our own settings with Genesis'
	add_meta_box('mm-navigation-settings', __( 'Navigation', 'trestle' ), 'trestle_navigation_settings_box', $_genesis_theme_settings_pagehook, 'main', 'high');
	

}
add_action('genesis_theme_settings_metaboxes', 'trestle_register_settings_box');

/**
 * Create Navigation Metabox
 */
 
function trestle_navigation_settings_box() {
	?>
	<h4><?php _e( 'Primary Navigation Options', 'trestle' ) ?></h4>
	<p>
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]" value="1" <?php checked( esc_attr( genesis_get_option('trestle_auto_nav') ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]"><?php _e( 'Automatically generate nav menu (replaces custom/manual menu with auto-generated menu)', 'trestle' ); ?></label><br />
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]" value="1" <?php checked( esc_attr( genesis_get_option('trestle_include_home_link') ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]"><?php _e( 'Include Home Link', 'trestle' ); ?></label>
	</p>
	<p>
		<?php _e('Text for mobile navigation button (shortcodes can be included):', 'trestle' ); ?></label><br />
		<input class="widefat" type="text" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]" value="<?php echo esc_attr( genesis_get_option('trestle_nav_button_text') ); ?>" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]">
	</p>
	<?php

	$trestle_nav_title = __( 'Trestle Auto Nav Placeholder', 'trestle' );

	// Create placeholder menu for 'primary' spot if auto-nav is selected - this ensures that nav extras can be used even when no custom menu is formally set to primary
	if ( 1 == genesis_get_option( 'auto_nav' ) && !wp_get_nav_menu_object( $trestle_nav_title ) && !has_nav_menu( 'primary' ) ) {
		
		// Create placholder menu
		wp_create_nav_menu( $trestle_nav_title );

		// Assign placeholder menu to 'primary'
		$menu_locations = get_theme_mod('nav_menu_locations');
		$menu_locations['primary'] = wp_get_nav_menu_object( $trestle_nav_title )->term_id;
		set_theme_mod( 'nav_menu_locations', $menu_locations );
		
	}

	// Remove placeholder menu if auto-nav is disabled
	$menus = get_registered_nav_menus();
	if ( 1 != genesis_get_option( 'auto_nav' ) && wp_get_nav_menu_object( $trestle_nav_title ) && $trestle_nav_title != $menus['primary'] )
		wp_delete_nav_menu( $trestle_nav_title );

	// Output default Genesis nav options
	$genesis_settings_object = new Genesis_Admin_Settings;
	$genesis_settings_object->nav_box();

}