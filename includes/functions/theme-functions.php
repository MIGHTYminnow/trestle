<?php
/**
 * Trestle theme functions (front-end)
 *
 * Note: all admin theme functionality is located at: lib/admin/admin.php
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

/*===========================================
 * Theme Setup
===========================================*/
add_action( 'after_setup_theme', 'trestle_add_theme_support' );
/**
 * Initialize Trestle defaults and theme options.
 *
 * @since    2.0.0
 */
function trestle_add_theme_support() {

	// Add HTML5 markup structure.
	add_theme_support( 'html5' );

	// Add viewport meta tag for mobile browsers.
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for footer widgets if specified in Trestle settings.
	add_theme_support( 'genesis-footer-widgets', trestle_get_option( 'footer_widgets_number' ) );

}

add_action( 'after_setup_theme', 'trestle_remove_genesis_css_enqueue' );
/**
 * Stop Genesis from enqueuing the child theme stylesheet in the usual way.
 *
 * @since    2.1.0
 */
function trestle_remove_genesis_css_enqueue() {

	remove_action( 'genesis_meta', 'genesis_load_stylesheet' );

}

/*===========================================
 * 3rd Party Libraries
===========================================*/

add_action( 'init', 'trestle_load_bfa' );
/**
 * Initialize the Better Font Awesome Library.
 *
 * @since  2.0.0
 */
function trestle_load_bfa() {

	// Better Font Awesome Library
	require_once trailingslashit( get_stylesheet_directory() ) . 'lib/better-font-awesome-library/better-font-awesome-library.php';

	// Set the library initialization args.
	$args = array(
			'version'             => 'latest',
			'minified'            => true,
			'remove_existing_fa'  => false,
			'load_styles'         => true,
			'load_admin_styles'   => true,
			'load_shortcode'      => true,
			'load_tinymce_plugin' => true,
	);

	// Initialize the Better Font Awesome Library.
	Better_Font_Awesome_Library::get_instance( $args );

}

/*===========================================
 * Header
===========================================*/

add_action( 'wp_enqueue_scripts', 'trestle_header_actions', 15 );
/**
 * Loads theme scripts and styles.
 *
 * @since  1.0.0
 */
function trestle_header_actions() {

	// Our main stylesheet.
	wp_enqueue_style( 'trestle', get_stylesheet_uri(), array(), TRESTLE_THEME_VERSION );

	// Google fonts.
	wp_enqueue_style( 'theme-google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700' );

	// Theme jQuery.
	wp_enqueue_script( 'theme-jquery', get_stylesheet_directory_uri() . '/includes/js/theme-jquery.js', array( 'jquery' ), TRESTLE_THEME_VERSION, true );

	// Prepare and include some necessary variables.
	$mobile_nav_text = apply_filters( 'trestle_mobile_nav_text', __( 'Navigation', 'trestle' ) );
	wp_localize_script(
		'theme-jquery',
		'trestle_vars',
		array(
			'mobile_nav_text' => esc_attr( $mobile_nav_text ),
		)
	);

	// Get WP uploads directory.
	$upload_dir = wp_upload_dir();
	$upload_path = $upload_dir['basedir'];
	$upload_url = $upload_dir['baseurl'];

	// Custom CSS (if it exists).
	$custom_css_file = '/trestle/custom.css';
	if ( is_readable( $upload_path . $custom_css_file ) )
		wp_enqueue_style( 'trestle-custom-css', $upload_url . $custom_css_file );

	// Custom jQuery (if it exists).
	$custom_js_file = '/trestle/custom.js';
	if ( is_readable( $upload_path . $custom_js_file ) )
		wp_enqueue_script( 'trestle-custom-jquery', $upload_url . $custom_js_file, array( 'jquery' ), TRESTLE_THEME_VERSION, true );

}

add_filter( 'genesis_pre_load_favicon', 'trestle_do_custom_favicon' );
/**
 * Output custom favicon if specified in the theme options.
 *
 * @since   1.0.0
 *
 * @param   string  $favicon_url  Default favicon URL.
 *
 * @return  string  Custom favicon URL (if specified), or the default URL.
 */
function trestle_do_custom_favicon( $favicon_url ) {

	$trestle_favicon_url = trestle_get_option( 'favicon_url' );
	return $trestle_favicon_url ? $trestle_favicon_url : $favicon_url;
}

/*===========================================
 * Body Classes
===========================================*/

add_filter( 'body_class', 'trestle_body_classes' );
/**
 * Adds custom classes to the <body> element for styling purposes.
 *
 * @since 1.0.0
 *
 * @param array $classes Body classes.
 * @return array 		 Updated body classes.
 */
function trestle_body_classes( $classes ) {

	// Add 'no-jquery' class to be removed by jQuery if enabled.
	$classes[] = 'no-jquery';

	// Add 'bubble' class.
	if ( 'bubble' == trestle_get_option( 'layout' ) )
		$classes[] = 'bubble';

	// Add link icon classes.
	if ( trestle_get_option( 'external_link_icons' ) ) {
		$classes[] = 'external-link-icons';
	}
	if ( trestle_get_option( 'email_link_icons' ) ) {
		$classes[] = 'email-link-icons';
	}
	if ( trestle_get_option( 'pdf_link_icons' ) ) {
		$classes[] = 'pdf-link-icons';
	}
	if ( trestle_get_option( 'doc_link_icons' ) ) {
		$classes[] = 'doc-link-icons';
	}

	// Add menu style class.
	$nav_primary_location = esc_attr( trestle_get_option( 'nav_primary_location' ) );
	if ( $nav_primary_location ) {
		$classes[] = 'nav-primary-location-' . $nav_primary_location;
	}

	// Add mobile menu toggle class.
	$mobile_nav_toggle = esc_attr( trestle_get_option( 'mobile_nav_toggle' ) );
	if ( 'big-button' == $mobile_nav_toggle ) {
		$classes[] = 'big-button-nav-toggle';
	} elseif ( 'small-icon' == $mobile_nav_toggle ) {
		$classes[] = 'small-icon-nav-toggle';
	}

	// Add footer widget number class.
	$footer_widgets_number = esc_attr( trestle_get_option( 'footer_widgets_number' ) );
	if ( $footer_widgets_number ) {
		$classes[] = 'footer-widgets-number-' . $footer_widgets_number;
	}

	// Add logo class.
	if ( trestle_get_option( 'logo_id' ) || trestle_get_option( 'logo_id_mobile' ) ) {
		$classes[] = 'has-logo';
	}

	return $classes;

}


/*===========================================
 * Header
===========================================*/

add_filter( 'genesis_seo_title', 'trestle_do_logos', 10, 3 );
/**
 * Output logos.
 *
 * @since 1.0.0
 */
function trestle_do_logos( $title, $inside, $wrap ) {

	$logo_id = trestle_get_option( 'logo_id' );
	$logo_id_mobile = trestle_get_option( 'logo_id_mobile' );
	$logo_html = '';

	// Regular logo.
	if ( $logo_id ) {

		// Default logo classes.
		$classes = array(
			'logo',
			'logo-full'
		);

		// If no mobile logo is specified, make regular logo act as mobile logo too.
		if( ! $logo_id_mobile ) {
			$classes[] = 'show';
		}

		// Prepare the classes.
		$logo_attr = array(
			'class'	=> implode( $classes, ' ' ),
		);

		// Build the <img> tag.
		$logo_html .= wp_get_attachment_image( $logo_id, 'full', false, $logo_attr );

	}

	// Mobile logo.
	if ( $logo_id_mobile ) {

		// Default mobile logo class.
		$classes = array(
			'logo',
			'logo-mobile'
		);

		// If no regular logo is specified, make mobile logo act as regular logo too.
		if( ! $logo_id )
			$classes[] = 'show';

		// Prepare the classes.
		$logo_attr = array(
			'class'	=> implode( $classes, ' ' ),
		);

		// Build the <img> tag.
		$logo_html .= wp_get_attachment_image( $logo_id_mobile, 'full', false, $logo_attr );

	}

	if ( $logo_html ) {
		$inside .= sprintf( '<a href="%s" title="%s" class="logos">%s</a>',
			trailingslashit( home_url() ),
			esc_attr( get_bloginfo( 'name' ) ),
			$logo_html
		);
	}

	// Build the title.
	$title  = genesis_html5() ? sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ) : sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );
	$title .= genesis_html5() ? "{$inside}</{$wrap}>" : '';

	// Echo (filtered).
	return $title;

}


/*===========================================
 * Navigation
===========================================*/

add_action( 'wp_loaded', 'trestle_nav_primary_location' );
/**
 * Move primary navigation into the header if need be.
 *
 * This is hooked on wp_loaded instead of init because for some reason init
 * won't fire on the customizer preview.
 *
 * @since  1.2.0
 */
function trestle_nav_primary_location() {

	if ( 'header' == trestle_get_option( 'nav_primary_location' ) ) {
		remove_action( 'genesis_after_header', 'genesis_do_nav' );
		add_action( 'genesis_header', 'genesis_do_nav', 12 );
	}

}

add_filter( 'wp_nav_menu_items', 'trestle_custom_nav_extras', 10, 2 );
/**
 * Add custom nav extras.
 *
 * @since 1.0.0
 *
 * @param  string   $nav_items <li> list of menu items.
 * @param  stdClass $menu_args Arguments for the menu.
 * @return string   <li> list of menu items with custom navigation extras <li> appended.
 */
function trestle_custom_nav_extras( $nav_items, stdClass $menu_args ) {

	if ( 'primary' == $menu_args->theme_location && trestle_get_option( 'search_in_nav' ) ) {
		return $nav_items . '<li class="right custom">' . get_search_form( false ) . '</li>';
	}

	return $nav_items;
}


/*===========================================
 * Posts & Pages
===========================================*/

add_filter( 'post_class', 'trestle_post_classes' );
/**
 * Add extra classes to posts in certain situations.
 *
 * @since  2.2.0
 *
 * @param array $classes Post classes.
 * @return array 		 Updated post classes.
 */
function trestle_post_classes( $classes ) {

	// If post doesn't have a featured image.
	if ( ! has_post_thumbnail() ) {
		$classes[] = 'no-featured-image';
	}

	return $classes;

}

add_filter( 'wp_revisions_to_keep', 'trestle_update_revisions_number', 10, 2 );
/**
 * Sets the number of post revisions.
 *
 * @since  1.0.0
 *
 * @param  int $num Default number of post revisions.
 * @return int      Number of post revisions specified in Trestle admin panel.
 */
function trestle_update_revisions_number( $num ) {

	$trestle_revisions_number = esc_attr( trestle_get_option( 'revisions_number' ) );

	if ( isset( $trestle_revisions_number ) ) {
		return $trestle_revisions_number;
	}

	return $num;
}

add_filter( 'genesis_get_image_default_args', 'trestle_featured_image_fallback' );
/**
 * Unset Genesis default featured image fallback of 'first-attached'.
 *
 * This function prevents Genesis' default behavior of displaying
 * the 'first-attached' image as a post's featured image (in archive)
 * views, even when the post has no current featured image.
 *
 * @since 1.0.0
 *
 * @param array $args Default Genesis image args.
 * @return array Updated image args.
 */
function trestle_featured_image_fallback( $args ) {

	$args['fallback'] = false;

	return $args;
}


/*===========================================
 * General Actions & Filters
===========================================*/

add_filter( 'excerpt_more', 'trestle_read_more_link' );
add_filter( 'get_the_content_more_link', 'trestle_read_more_link' );
add_filter( 'the_content_more_link', 'trestle_read_more_link' );
/**
 * Displays custom Trestle "read more" text in place of WordPress default.
 *
 * @since 1.0.0
 *
 * @param string $default_text Default "read more" text.
 * @return string (Updated) "read more" text.
 */
function trestle_read_more_link( $default_text ) {

	// Get Trestle custom "read more" link text.
	$custom_text = esc_attr( trestle_get_option( 'read_more_text' ) );

	if ( $custom_text ) {
		return '&hellip;&nbsp;<a class="more-link" title="' . $custom_text . '" href="' . get_permalink() . '">' . $custom_text . '</a>';
	} else {
		return $default_text;
	}
}


/*===========================================
 * Helper Functions
===========================================*/

/**
 * Check if image has specified image size.
 *
 * @since 2.2.0
 *
 * @param int $image_id ID of image to check.
 * @param string $image_size Slug of image size to check for.
 *
 * @return true|false Whether or not the image has the specified size generated.
 */
function trestle_image_has_size( $image_id, $image_size = null ) {

	global $_wp_additional_image_sizes;

	// Return with error if no image_size is specified.
	if ( ! $image_size ) {
		return new WP_Error( 'no_image_size_specified', __( 'Please specify an image size.', 'trestle' ) );
	}

	// Get the attributes for the specified image size.
	$image_size_atts = $_wp_additional_image_sizes[ $image_size ];

	// Get data for specified image ID and size.
	$img_data = wp_get_attachment_image_src( $image_id, $image_size );

	// Check if the dimensions match.
	if ( $img_data[1] == $image_size_atts['width'] && $img_data[2] == $image_size_atts['height'] ) {
		return true;
	}

	return false;

}
