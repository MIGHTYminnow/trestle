<?php
/**
 * This file adds the grid layout for the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

// Registers the grid layout for category archives.
genesis_register_layout(
	'academy-grid', array(
		'label' => __( 'Three-column Grid', 'academy-pro' ),
		'img'   => get_stylesheet_directory_uri() . '/images/grid.gif',
		'type'  => array( 'category', 'post_tag' ),
	)
);

// Adds site layouts back to categories and tags.
if ( function_exists( 'genesis_add_type_to_layout' ) ) {
	genesis_add_type_to_layout( 'content-sidebar', array( 'category', 'post_tag' ) );
	genesis_add_type_to_layout( 'sidebar-content', array( 'category', 'post_tag' ) );
	genesis_add_type_to_layout( 'full-width-content', array( 'category', 'post_tag' ) );
}

add_action( 'genesis_meta', 'academy_grid_layout' );
/**
 * Sets up the grid layout.
 *
 * @since 1.0.0
 */
function academy_grid_layout() {

	$site_layout = genesis_site_layout();

	if ( 'academy-grid' === $site_layout ) {

		remove_action( 'genesis_after_content', 'genesis_get_sidebar' );
		remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
		add_filter( 'genesis_skip_links_output', 'academy_grid_skip_links_output' );
		add_filter( 'genesis_pre_get_option_content_archive_limit', 'academy_grid_archive_limit' );
		add_filter( 'genesis_pre_get_option_content_archive_thumbnail', 'academy_grid_archive_thumbnail' );
		add_filter( 'genesis_pre_get_option_content_archive', 'academy_grid_content_archive' );
		add_filter( 'genesis_pre_get_option_image_size', 'academy_grid_image_size' );
		add_filter( 'genesis_pre_get_option_image_alignment', 'academy_grid_image_alignment' );

	}

}

add_filter( 'genesis_pre_get_option_site_layout', 'academy_grid_category_layout' );
/**
 * Sets the default layout for category and tag archive pages.
 *
 * @since 1.0.0
 *
 * @param string $layout The current layout.
 * @return string The new layout.
 */
function academy_grid_category_layout( $layout ) {

	$layout_option = get_theme_mod( 'academy-grid-option', true );

	if ( $layout_option && ( is_category() || is_tag() ) ) {
		$layout = 'academy-grid';
	}

	return $layout;

}

add_action( 'pre_get_posts', 'academy_grid_posts_per_page' );
/**
 * Sets the number of posts in the grid.
 *
 * @since 1.0.0
 *
 * @param WP_Query $query The query object.
 */
function academy_grid_posts_per_page( $query ) {

	$site_layout = genesis_site_layout( false );

	$posts = get_theme_mod( 'academy-grid-posts-per-page', academy_get_default_grid_posts_per_page() );

	if ( ! $query->is_main_query() ) {
		return;
	}

	if ( 'academy-grid' === $site_layout ) {
		$query->set( 'posts_per_page', intval( $posts ) );
	}

}

/**
 * Gets the content limit for the grid layout.
 *
 * @since 1.0.0
 *
 * @return int The grid content limit.
 */
function academy_grid_archive_limit() {

	return get_theme_mod( 'academy-grid-archive-limit', academy_get_default_grid_limit() );

}

/**
 * Gets the archive thumbnail for the grid layout.
 *
 * @since 1.0.0
 *
 * @return bool The grid archive thumbnail.
 */
function academy_grid_archive_thumbnail() {

	return get_theme_mod( 'academy-grid-thumbnail', true );

}

/**
 * Gets the grid image size.
 *
 * @since 1.0.0
 *
 * @return string The grid image size.
 */
function academy_grid_image_size() {

	return 'featured-image';

}

/**
 * Gets the grid image alignment.
 *
 * @since 1.0.0
 *
 * @return string The grid image alignment.
 */
function academy_grid_image_alignment() {

	return 'alignnone';

}

/**
 * Gets default grid layout posts per page.
 *
 * @since 1.0.0
 *
 * @return string Number of posts to show.
 */
function academy_get_default_grid_posts_per_page() {

	return 6;

}
/**
 * Gets default grid layout content limit.
 *
 * @since 1.0.0
 *
 * @return string Number of characters to show.
 */
function academy_get_default_grid_limit() {

	return 200;

}
/**
 * Gets default grid layout content limit.
 *
 * @since 1.0.0
 *
 * @return string Content display option.
 */
function academy_content_archive_option() {

	return 'full';

}

/**
 * Sets the grid content display type.
 *
 * @since 1.0.0
 *
 * @return string The grid display type.
 */
function academy_grid_content_archive() {

	return get_theme_mod( 'academy-content-archive', academy_content_archive_option() );

}

/**
 * Removes skip link for primary sidebar on grid layout.
 *
 * @since 1.0.0
 *
 * @param array $links The current skip links.
 * @return array The new skip links.
 */
function academy_grid_skip_links_output( $links ) {

	if ( isset( $links['genesis-sidebar-primary'] ) ) {
		unset( $links['genesis-sidebar-primary'] );
	}

	return $links;

}
