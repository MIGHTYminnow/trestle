<?php
/**
 * Academy Pro.
 *
 * This file adds the default theme settings to the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

add_filter( 'genesis_theme_settings_defaults', 'academy_theme_defaults' );
/**
 * Updates theme settings on reset.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default theme settings.
 * @return array Modified defaults.
 */
function academy_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 6;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 200;
	$defaults['content_archive_thumbnail'] = 1;
	$defaults['image_alignment']           = 'alignnone';
	$defaults['image_size']                = 'featured-image';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'full-width-content';

	return $defaults;

}

add_action( 'after_switch_theme', 'academy_theme_setting_defaults' );
/**
 * Updates theme settings on activation.
 *
 * @since 1.0.0
 */
function academy_theme_setting_defaults() {

	if ( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings(
			array(
				'blog_cat_num'              => 6,
				'content_archive'           => 'full',
				'content_archive_limit'     => 200,
				'content_archive_thumbnail' => 1,
				'image_alignment'           => 'alignnone',
				'image_size'                => 'featured-image',
				'posts_nav'                 => 'numeric',
				'site_layout'               => 'full-width-content',
			)
		);

	}

	update_option( 'posts_per_page', 6 );

}
