<?php
/**
 * Academy Pro.
 *
 * This file adds the landing page template to the Academy Pro Theme.
 *
 * Template Name: Landing
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

add_filter( 'body_class', 'academy_add_body_class' );
/**
 * Adds the landing page body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Current list of classes.
 * @return array New classes.
 */
function academy_add_body_class( $classes ) {

	$classes[] = 'landing-page';
	return $classes;

}

// Removes skip links.
remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );

add_action( 'wp_enqueue_scripts', 'academy_dequeue_skip_links' );
/**
 * Dequeues the skip links script.
 *
 * @since 1.0.0
 */
function academy_dequeue_skip_links() {

	wp_dequeue_script( 'skip-links' );

}

// Forces full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

// Removes navigation.
remove_theme_support( 'genesis-menus' );

// Removes breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );

// Removes footer widgets.
remove_action( 'genesis_before_footer', 'academy_footer_widgets' );

// Runs the Genesis loop.
genesis();
