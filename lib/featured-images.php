<?php
/**
 * Academy Pro
 *
 * This file handles the logic for outputting the featured images in the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

add_filter( 'genesis_attr_entry', 'academy_entry_class', 10, 3 );
/**
 * Adds alignment post class.
 *
 * @since 1.0.0
 *
 * @param array $attributes Existing attributes for entry element.
 * @param array $args The widget.
 * @return array Amended attributes for entry element.
 */
function academy_entry_class( $attributes, $context, $args ) {

	$alignment = genesis_get_option( 'image_alignment' );

	if ( ! empty( $alignment ) && empty( $args['params']['is_widget'] ) && ( is_home() || is_category() || is_tag() || is_author() || is_search() || genesis_is_blog_template() ) ) {
		$attributes['class'] = $attributes['class'] . ' academy-entry-image-' . $alignment . '';
	}

	return $attributes;

}

add_action( 'genesis_entry_header', 'academy_featured_image', 1 );
/**
 * Adds featured image above the entry content.
 *
 * @since 1.0.0
 */
function academy_featured_image() {

	$add_single_image = get_theme_mod( 'academy_single_image_setting', academy_customizer_get_default_image_setting() );

	$image = genesis_get_image(
		array(
			'format'  => 'html',
			'size'    => 'featured-image',
			'context' => '',
			'attr'    => array(
				'alt'   => the_title_attribute( 'echo=0' ),
				'class' => 'academy-single-image post-image',
			),
		)
	);

	if ( $add_single_image && $image && is_singular( 'post' ) ) {
		printf( '<div class="single-featured-image">%s</div>', $image );
	}

}

/**
 * Gets default post image settings for Customizer.
 *
 * @since 1.0.0
 *
 * @return int 1 for true, in order to show the image.
 */
function academy_customizer_get_default_image_setting() {

	return 1;

}
