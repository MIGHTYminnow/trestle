<?php
/**
 * Academy Pro.
 *
 * This defines the helper functions for use in the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

/**
 * Gets the default primary color for Customizer.
 * Abstracted here since at least two functions use it.
 *
 * @since 1.0.0
 *
 * @return string Hex color code for primary color.
 */
function academy_customizer_get_default_primary_color() {

	return '#666';

}

/**
 * Get default top banner section text.
 *
 * @since 1.0.0
 *
 * @return string Text to use in the top banner.
 */
function academy_get_default_top_banner_text() {

	return __( 'Limited Time Offer - Try the course right now, <a href="#">FREE for 14 days</a>!', 'academy-pro' );

}

/**
 * Get default hero section title.
 *
 * @since 1.0.0
 *
 * @return string Text to use in the title.
 */
function academy_get_default_hero_title_text() {

	return __( 'Build Your Online Training Business the Smarter Way', 'academy-pro' );

}

/**
 * Get default hero section description.
 *
 * @return string Text to use in the description.
 *
 * @since 1.0.0
 */
function academy_get_default_hero_desc_text() {

	return __( 'Discover how you can build a profitable online training business in record time. Create, launch, and scale online courses even if you have never made a dollar online, created a single lesson, or have no marketing list.', 'academy-pro' );

}

/**
 * Get default primary button text.
 *
 * @return string Text to use in the button.
 *
 * @since 1.0.0
 */
function academy_get_default_hero_button_primary_text() {

	return __( 'Join Now', 'academy-pro' );

}

/**
 * Get default secondary button text.
 *
 * @return string Text to use in the button.
 *
 * @since 1.0.0
 */
function academy_get_default_hero_button_secondary_text() {

	return __( 'Get More Info', 'academy-pro' );

}

/**
 * Get default logos header text.
 *
 * @return string Text to use as a header for the hero logo images.
 *
 * @since 1.0.0
 */
function academy_get_default_hero_logo_header() {

	return __( 'As Featured In:', 'academy-pro' );

}


/**
 * Get the default video Thumbnail for the hero section.
 *
 * @return string video Thumbnail for the video shortcode
 *
 * @since 1.0.0
 */
function academy_get_default_video_thumbnail() {

	return get_stylesheet_directory_uri() . '/images/hero-video-thumb.jpg';

}

/**
 * Calculates if white or black would contrast more with the provided color.
 *
 * @since 1.0.0
 *
 * @param string $color A color in hex format.
 * @return string The hex code for the most contrasting color: dark grey or white.
 */
function academy_color_contrast( $color ) {

	$hexcolor = str_replace( '#', '', $color );

	$red   = hexdec( substr( $hexcolor, 0, 2 ) );
	$green = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue  = hexdec( substr( $hexcolor, 4, 2 ) );

	$luminosity = ( ( $red * 0.2126 ) + ( $green * 0.7152 ) + ( $blue * 0.0722 ) );

	return ( $luminosity > 128 ) ? '#000000' : '#ffffff';

}

/**
 * Calculate the color brightness.
 * Abstracted here since at least two functions use it.
 *
 * @since 1.0.0
 *
 * @return string Hex code for the color brightness.
 */
function academy_color_brightness( $color, $op, $change ) {

	$hexcolor = str_replace( '#', '', $color );
	$red      = hexdec( substr( $hexcolor, 0, 2 ) );
	$green    = hexdec( substr( $hexcolor, 2, 2 ) );
	$blue     = hexdec( substr( $hexcolor, 4, 2 ) );

	if ( '+' !== $op && isset( $op ) ) {
		$red   = max( 0, min( 255, $red - $change ) );
		$green = max( 0, min( 255, $green - $change ) );
		$blue  = max( 0, min( 255, $blue - $change ) );
	} else {
		$red   = max( 0, min( 255, $red + $change ) );
		$green = max( 0, min( 255, $green + $change ) );
		$blue  = max( 0, min( 255, $blue + $change ) );
	}

	$newhex  = '#';
	$newhex .= strlen( dechex( $red ) ) === 1 ? '0' . dechex( $red ) : dechex( $red );
	$newhex .= strlen( dechex( $green ) ) === 1 ? '0' . dechex( $green ) : dechex( $green );
	$newhex .= strlen( dechex( $blue ) ) === 1 ? '0' . dechex( $blue ) : dechex( $blue );

	// Force darken if brighten color is the same as color inputted.
	if ( $newhex === $hexcolor && $op === '+' ) {
		$newhex = '#111111';
	}

	return $newhex;

}
