<?php
/**
 * Academy Pro.
 *
 * This file adds the archive customizations to the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

// Moves the archive description boxes.
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
remove_action( 'genesis_before_loop', 'genesis_do_author_title_description', 15 );
remove_action( 'genesis_before_loop', 'genesis_do_author_box_archive', 15 );
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
remove_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
add_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description' );
add_action( 'genesis_before_loop', 'genesis_do_author_title_description' );
add_action( 'genesis_before_loop', 'genesis_do_author_box_archive' );
add_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );
add_action( 'genesis_before_loop', 'genesis_do_date_archive_title' );
add_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
add_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );

if ( ! function_exists( 'theme_print_category_list' ) ) {
	function theme_print_category_list(){
		if ( is_category() ) {
			echo '<nav>';
			echo do_shortcode( '[wpv-view name="category-list"]' );
			echo '</nav>';
		}
	}
}

add_action( 'genesis_before_content_sidebar_wrap', 'theme_print_category_list', 1 );

// Runs the Genesis loop.
genesis();
