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
		'layout'                     => 'solid',
		'logo_id'                    => '',
		'logo_id_mobile'             => '',
		'favicon_url'                => '',
		'logo_position'              => '',
		'nav_primary_location'       => 'full',
		'mobile_nav_toggle'          => 'small-icon',
		'search_in_nav'              => '',
		'fullscreen_search'          => '',
		'read_more_text'             => __( 'Read&nbsp;More&nbsp;&raquo;', 'trestle' ),
		'revisions_number'           => 3,
		'footer_widgets_number'      => 3,
		'external_link_icons'        => 0,
		'email_link_icons'           => 0,
		'pdf_link_icons'             => 0,
		'doc_link_icons'             => 0,
		'site_title_color'           => '#333',
		'site_description_color'     => '#999',
		'site_bg_color'              => '#F5F5F6',
		'body_text_color'            => '#666',
		'header_bg_color'            => '#fff',
		'menu_bg_color'              => '#333',
		'menu_text_color'            => '#999',
		'sub_menu_bg_color'          => '#fff',
		'sub_menu_text_color'        => '#999',
		'footer_bg_color'            => '#fff',
		'footer_text_color'          => '#999',
		'h1_text_color'              => '#333',
		'h2_text_color'              => '#333',
		'h3_text_color'              => '#333',
		'h4_text_color'              => '#333',
		'h5_text_color'              => '#333',
		'h6_text_color'              => '#333',
		'site_title_font_size'       => '28px',
		'site_description_font_size' => '16px',
		'google_font_code'           => '',
		'body_font_family'           => '',
		'h1_font_size'               => '28px',
		'h2_font_size'               => '24px',
		'h3_font_size'               => '20px',
		'h4_font_size'               => '18px',
		'h5_font_size'               => '16px',
		'h6_font_size'               => '16px',
		'h1_text_decoration'         => '',
		'h2_text_decoration'         => '',
		'h3_text_decoration'         => '',
		'h4_text_decoration'         => '',
		'h5_text_decoration'         => '',
		'h6_text_decoration'         => '',
		'h1_text_style'              => '',
		'h2_text_style'              => '',
		'h3_text_style'              => '',
		'h4_text_style'              => '',
		'h5_text_style'              => '',
		'h6_text_style'              => '',
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
