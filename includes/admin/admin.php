<?php
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
