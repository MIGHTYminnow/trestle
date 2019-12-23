<?php
/**
 * Academy Pro.
 *
 * This file adds the pricing page template to the Academy Pro Theme.
 *
 * Template Name: Pricing
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

add_filter( 'body_class', 'academy_add_body_class' );
/**
 * Adds the pricing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Current list of classes.
 * @return array New classes.
 */
function academy_add_body_class( $classes ) {

	$classes[] = 'pricing-page';
	return $classes;

}

// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Removes footer cta.
remove_action( 'genesis_before_footer', 'academy_footer_cta' );

// Runs the Genesis loop.
genesis();
