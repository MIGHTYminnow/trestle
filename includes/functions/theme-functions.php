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
 * 3rd Party Libraries
===========================================*/

add_action( 'init', 'trestle_load_bfa' );
/**
 * Initialize the Better Font Awesome Library.
 *
 * @since  2.0.0
 */
function trestle_load_bfa() {

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

add_action( 'wp_enqueue_scripts', 'trestle_header_actions' );
/**
 * Loads theme scripts and styles.
 *
 * @since  1.0.0
 */
function trestle_header_actions() {

	// Google fonts.
	wp_enqueue_style( 'theme-google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700' );

	// Theme jQuery.
	wp_enqueue_script( 'theme-jquery', get_stylesheet_directory_uri() . '/includes/js/theme-jquery.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

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
		wp_enqueue_script( 'trestle-custom-jquery', $upload_url . $custom_js_file, array( 'jquery' ), CHILD_THEME_VERSION, true );

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
	return genesis_get_option( 'favicon_url', 'trestle-settings' ) ? genesis_get_option( 'favicon_url', 'trestle-settings' ) : $favicon_url;
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
	if ( 'bubble' == genesis_get_option( 'layout', 'trestle-settings' ) )
		$classes[] = 'bubble';

	// Add link icon classes.
	if ( genesis_get_option( 'external_link_icons', 'trestle-settings' ) )
		$classes[] = 'external-link-icons';
	if ( genesis_get_option( 'email_link_icons', 'trestle-settings' ) )
		$classes[] = 'email-link-icons';
	if ( genesis_get_option( 'pdf_link_icons', 'trestle-settings' ) )
		$classes[] = 'pdf-link-icons';
	if ( genesis_get_option( 'doc_link_icons', 'trestle-settings' ) )
		$classes[] = 'doc-link-icons';

	// Add menu style class.
	if ( genesis_get_option( 'nav_primary_location', 'trestle-settings' ) )
		$classes[] = 'nav-primary-location-' . esc_attr( genesis_get_option( 'nav_primary_location', 'trestle-settings' ) );

	// Add footer widget number class.
	if ( genesis_get_option( 'footer_widgets_number', 'trestle-settings' ) )
		$classes[] = 'footer-widgets-number-' . esc_attr( genesis_get_option( 'footer_widgets_number', 'trestle-settings' ) );

	// Add logo class.
	if ( genesis_get_option( 'logo_url', 'trestle-settings' ) || genesis_get_option( 'logo_url_mobile', 'trestle-settings' ) )
		$classes[] = 'has-logo';

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

	$logo_url = genesis_get_option( 'logo_url', 'trestle-settings' );
	$logo_url_mobile = genesis_get_option( 'logo_url_mobile', 'trestle-settings' );
	$logo_html = '';

	// Regular logo.
	if ( $logo_url ) {

		// Default logo class.
		$classes = array('logo-full');

		// If no mobile logo is specified, make regular logo act as mobile logo too.
		if( ! $logo_url_mobile )
			$classes[] = 'show';

		$logo_html .= sprintf( '<img class="logo %s" alt="%s" src="%s" />',
			implode(' ', $classes),
			esc_attr( get_bloginfo( 'name' ) ),
			$logo_url
		);
	}

	// Mobile logo.
	if ( $logo_url_mobile ) {

		// Default mobile logo class.
		$classes = array('logo-mobile');

		// If no regular logo is specified, make mobile logo act as regular logo too.
		if( ! $logo_url )
			$classes[] = 'show';

		$logo_html .= sprintf( '<img class="logo %s" alt="%s" src="%s" />',
			implode(' ', $classes),
			esc_attr( get_bloginfo( 'name' ) ),
			$logo_url_mobile
		);
	}

	if ( $logo_html ) {
		$inside .= sprintf( '<a href="%s" title="%s">%s</a>',
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

add_action( 'init', 'trestle_nav_primary_location' );
/**
 * Move primary navigation into the header if need be.
 *
 * @since  1.2.0
 */
function trestle_nav_primary_location() {

	if ( 'header' == genesis_get_option( 'nav_primary_location', 'trestle-settings' ) ) {
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

	if ( 'primary' == $menu_args->theme_location && genesis_get_option( 'search_in_nav', 'trestle-settings' ) ) {
		return $nav_items . '<li class="right custom">' . get_search_form( false ) . '</li>';
	}

	return $nav_items;
}


/*===========================================
 * Posts & Pages
===========================================*/

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

	$trestle_revisions_number = esc_attr( genesis_get_option( 'revisions_number', 'trestle-settings' ) );

	if ( isset( $trestle_revisions_number ) )
		return $trestle_revisions_number;

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
	$custom_text = esc_attr( genesis_get_option( 'read_more_text', 'trestle-settings' ) );

	if ( $custom_text ) {
		return '&hellip;&nbsp;<a class="more-link" title="' . $custom_text . '" href="' . get_permalink() . '">' . $custom_text . '</a>';
	} else {
		return $default_text;
	}
}
