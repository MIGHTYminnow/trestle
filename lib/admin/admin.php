<?php
/*===========================================
 * Trestle Custom Theme Settings
 *
 * Modified from: http://www.billerickson.net/genesis-theme-options/
===========================================*/


/*===========================================
 * Admin styles and scripts
===========================================*/

// Add admin scripts and styles
function trestle_admin_actions() {

	// Add admin jQuery
	wp_enqueue_script( 'trestle-admin-jquery', get_stylesheet_directory_uri() . '/lib/admin/admin.js', array( 'jquery' ), '1.0', true );

	// Add admin jQuery
	wp_enqueue_style( 'trestle-admin', get_stylesheet_directory_uri() . '/lib/admin/admin.css' );

	// Add admin CSS (doesn't exist at present)
    add_editor_style( get_stylesheet_directory_uri() . '/lib/admin/editor.css' );

}

/**
 * Do Trestle default settings
 * 
 * @param  array $defaults 	default Genesis settings
 * @return array           	modified Genesis defaults array
 */
function trestle_custom_defaults( $defaults ) {
 	
 	// Trestle default key/value pairs
 	$trestle_defaults = array(
		'trestle_layout' => 'solid',
		'trestle_auto_nav' => 0,
		'trestle_include_home_link' => 0,
		'trestle_nav_button_text' => __( '[icon name="icon-list-ul"]  Navigation', 'trestle' ),
		'trestle_link_icons' => 0,
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
 					
 	// Return modified default array
	return $defaults;

}

/**
 * Add sanitization functionality to Trestle options
 */
function trestle_register_social_sanitization_filters() {
	
	// No HTML
	genesis_add_option_filter( 
		'no_html', 
		GENESIS_SETTINGS_FIELD,
		array(
			'trestle_auto_nav',
			'trestle_include_home_link',
		)
	);

	// Safe HTML
	genesis_add_option_filter( 
		'safe_html', 
		GENESIS_SETTINGS_FIELD,
		array(
			'trestle_nav_button_text',
		)
	);
}
 
 
/**
 * Register Trestle metabox
 */
function trestle_register_settings_box( $_genesis_theme_settings_pagehook ) {

	global $_genesis_admin_settings;

    // Create Trestle settings metabox
	add_meta_box( 'trestle-settings', __( 'Trestle Settings', 'trestle' ), 'trestle_settings_box', $_genesis_theme_settings_pagehook, 'main', 'high' );
	

}

/**
 * Output Trestle metabox
 */
function trestle_settings_box() {

	$img_path = get_stylesheet_directory_uri() . '/images/admin/';

	?>
	<h4><?php _e( 'Layout', 'trestle' ) ?></h4>
	<p class="trestle-layout">
		<img src="<?php echo $img_path; ?>icon-solid.gif" width="200" height="150" <?php echo 'solid' == genesis_get_option('trestle_layout') ? 'class="checked"' : '' ?> />
		<input type="radio" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_layout]" value="solid" <?php checked( esc_attr( genesis_get_option('trestle_layout') ), 'solid' ); ?> />
		<img src="<?php echo $img_path; ?>icon-bubble.gif" width="200" height="150" <?php echo 'bubble' == genesis_get_option('trestle_layout') ? 'class="checked"' : '' ?> />
		<input type="radio" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_layout]" value="bubble" <?php checked( esc_attr( genesis_get_option('trestle_layout') ), 'bubble' ); ?> />
	</p>
	<h4><?php _e( 'Primary Navigation Options', 'trestle' ) ?></h4>
	<p>
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]" value="1" <?php checked( esc_attr( genesis_get_option('trestle_auto_nav') ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]"><?php _e( 'Automatically generate nav menu (replaces custom/manual menu with auto-generated menu)', 'trestle' ); ?></label><br />
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]" value="1" <?php checked( esc_attr( genesis_get_option('trestle_include_home_link') ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]"><?php _e( 'Include Home Link', 'trestle' ); ?></label>
	</p>
	<p>
		<?php _e('Text for mobile navigation button (shortcodes can be included):', 'trestle' ); ?></label><br />
		<input class="widefat" type="text" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]" value="<?php echo esc_attr( genesis_get_option('trestle_nav_button_text') ); ?>" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]">
	</p>
	<h4><?php _e( 'Additional Settings', 'trestle' ) ?></h4>
	<p>
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_link_icons]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_link_icons]" value="1" <?php checked( esc_attr( genesis_get_option('trestle_link_icons') ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_link_icons]"><?php _e( 'Automatically add icons to external, email, pdf, and document links.', 'trestle' ); ?></label><br />
		
	</p>
	<?php
}