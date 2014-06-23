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
 * Widget Areas
===========================================*/

/**
 * Register custom widget areas
 *
 * @since 1.0.0
 */
function trestle_register_widget_areas() {

}

/*===========================================
 * Head Styles & Scripts
===========================================*/

/**
 * Loads theme scripts and styles.
 *
 * @since  1.0.0
 */
function trestle_header_actions() {
	// Google fonts
	wp_enqueue_style( 'theme-google-fonts', '//fonts.googleapis.com/css?family=Lato:300,400,700' );

	// Theme jQuery
	wp_enqueue_script( 'theme-jquery', get_stylesheet_directory_uri() . '/lib/js/theme-jquery.js', array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Custom CSS (if it exists)
	$custom_css_file = 'wp-content/uploads/trestle/custom.css';
	if ( is_readable( ABSPATH . $custom_css_file ) )
		wp_enqueue_style( 'trestle-custom-css', '/' . $custom_css_file );
	
	// Custom jQuery (if it exists)
	$custom_js_file = 'wp-content/uploads/trestle/custom.js';
	if ( is_readable( ABSPATH . $custom_js_file ) )
		wp_enqueue_script( 'trestle-custom-jquery', '/' . $custom_js_file, array( 'jquery' ), CHILD_THEME_VERSION, true );

	// Pass PHP variables to theme jQuery
	$php_vars = array (
		'trestle_equal_cols_breakpoint' => genesis_get_option( 'trestle_equal_cols_breakpoint' ),
	);
	wp_localize_script( 'theme-jquery', 'php_vars', $php_vars );
}


/*===========================================
 * Body Classes
===========================================*/

/**
 * Adds custom classes to the <body> element for styling purposes.
 *
 * @since 1.0.0
 *
 * @param array $classes Body classes.
 * @return array 		 Updated body classes.
 */
function trestle_body_classes( $classes ) {
	// Add 'no-jquery' class to be removed by jQuery if enabled
	$classes[] = 'no-jquery';

	// Add 'bubble' class
	if ( 'bubble' == genesis_get_option( 'trestle_layout' ) )
		$classes[] = 'bubble';

	// Add link icon classes
	if ( genesis_get_option( 'trestle_external_link_icons' ) )
		$classes[] = 'external-link-icons';
	if ( genesis_get_option( 'trestle_email_link_icons' ) )
		$classes[] = 'email-link-icons';
	if ( genesis_get_option( 'trestle_pdf_link_icons' ) )
		$classes[] = 'pdf-link-icons';
	if ( genesis_get_option( 'trestle_doc_link_icons' ) )
		$classes[] = 'doc-link-icons';

	// Add footer widget number class
	if ( genesis_get_option( 'trestle_footer_widgets_number' ) )
		$classes[] = 'footer-widgets-number-' . esc_attr( genesis_get_option( 'trestle_footer_widgets_number' ) );

	// Add class for equal height Genesis Extender columns
	if ( 1 == genesis_get_option( 'trestle_equal_height_cols' ) )
		$classes[] = 'equal-height-genesis-extender-cols';

	// Add logo class
	if ( genesis_get_option( 'trestle_logo_url' ) || genesis_get_option( 'trestle_logo_url_mobile' ) )
		$classes[] = 'has-logo';
	
	return $classes;
}

/*===========================================
 * Header
===========================================*/

/**
 * Output logos.
 *
 * @since 1.0.0
 */
function trestle_do_logos( $title, $inside, $wrap ) {
	$logo_url = genesis_get_option( 'trestle_logo_url' );
	$logo_url_mobile = genesis_get_option( 'trestle_logo_url_mobile' );
	$logo_html = '';

	// Regular logo
	if ( $logo_url ) {

		// Default logo class
		$classes = array('logo-full');

		// If no mobile logo is specified, make regular logo act as mobile logo too
		if( ! $logo_url_mobile )
			$classes[] = 'show';

		$logo_html .= sprintf( '<img class="logo %s" alt="%s" src="%s" />',
			implode(' ', $classes),
			esc_attr( get_bloginfo( 'name' ) ),
			$logo_url 
		);
	}

	// Mobile logo
	if ( $logo_url_mobile ) {

		// Default mobile logo class
		$classes = array('logo-mobile');

		// If no regular logo is specified, make mobile logo act as regular logo too
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

	//* Build the title
	$title  = genesis_html5() ? sprintf( "<{$wrap} %s>", genesis_attr( 'site-title' ) ) : sprintf( '<%s id="title">%s</%s>', $wrap, $inside, $wrap );
	$title .= genesis_html5() ? "{$inside}</{$wrap}>" : '';

	//* Echo (filtered)
	return $title;
}


/*===========================================
 * Auto & Mobile Navigation
===========================================*/

/**
 * Performs modifications to the primary navigation menu
 *
 * @since  1.0.0
 *
 * @see trestle_add_mobile_nav()
 * @see trestle_auto_nav_items()
 * @see trestle_custom_nav_extras()
 * @see trestle_nav_placeholder()
 */
function trestle_nav_modifications() {
	// Add mobile nav button
	add_action( 'genesis_after_header', 'trestle_add_mobile_nav', 0 );

	// Auto-generate nav if Genesis theme setting is checked
	if ( 1 == genesis_get_option( 'trestle_auto_nav' ) )
		add_filter( 'wp_nav_menu_items', 'trestle_auto_nav_items', 9, 2 );

	// Do custom nav extras
	if ( 1 == genesis_get_option( 'trestle_custom_nav_extras' ) ) {
		// Remove default nav extras
		remove_filter( 'wp_nav_menu_items', 'genesis_nav_right' );
		
		// Add custom nav extras
		add_filter( 'wp_nav_menu_items', 'trestle_custom_nav_extras', 10, 2 );
	}

	// Create placeholder navigation menu object if needed
	trestle_nav_placeholder();
}

/**
 * Adds button to open primary mobile navigation menu.
 *
 * @since 1.0.0
 */
function trestle_add_mobile_nav() {
	// Only add the button if there is a primary menu
	if ( 1 == genesis_get_option( 'trestle_auto_nav' ) || has_nav_menu( 'primary' ) )
		echo '<a id="menu-button" class="button" href="javascript:void(0)">' . do_shortcode( genesis_get_option( 'trestle_nav_button_text' ) ) . '</a>';
}

/**
 * Auto-generates list of pages for use in the primary navigation menu.
 *
 * @since 1.0.0
 *
 * @param string   $nav_items <li> list of navigation menu items.
 * @param stdClass $menu_args Arguments for the menu.
 * @return string  <li> list of (modified) navigation menu items.
 */
function trestle_auto_nav_items( $nav_items, stdClass $menu_args ) {
	if ( 'primary' == $menu_args->theme_location ) {
		$args = array(
			'depth'          => genesis_get_option( 'trestle_auto_nav_depth' ) ? genesis_get_option( 'trestle_auto_nav_depth' ) : 0,
			'echo'           => false,
			'show_home'      => ( genesis_get_option( 'trestle_include_home_link' ) && genesis_get_option( 'trestle_home_link_text' ) ) ? do_shortcode( genesis_get_option( 'trestle_home_link_text' ) ): genesis_get_option( 'trestle_include_home_link' ),
			'menu_class'     => 'auto-menu'
		);

		$ul_class = 'menu genesis-nav-menu menu-primary';

		$menu_args = new stdClass();

		$menu_args->theme_location = 'primary';

		$nav_items = wp_page_menu( $args );

		// Remove opening <div class="auto-nav"><ul>
		$nav_items = preg_replace( '/<div\s*.*auto-menu[^>]*>\s*<ul>/', '', $nav_items );

		// Remove closing </ul></div>
		$nav_items = preg_replace( '/<\/ul>\s*<\/div>/', '', $nav_items );
	}
			
	return $nav_items;
}

/**
 * Replaces standard Genesis navigation extras with custom input navigation extras.
 *
 * @since 1.0.0
 *
 * @param string   $nav_items <li> list of menu items.
 * @param stdClass $menu_args Arguments for the menu.
 * @return string   <li> list of menu items with custom navigation extras <li> appended.
 */
function trestle_custom_nav_extras( $nav_items, stdClass $menu_args ) {
	if ( 'primary' == $menu_args->theme_location ) {
		$custom_text = esc_attr( genesis_get_option( 'trestle_custom_nav_extras_text' ) );
		return $nav_items . '<li class="right custom">' . do_shortcode( genesis_get_option( 'trestle_custom_nav_extras_text' ) ) . '</li>';
	}

	return $nav_items;
}

/**
 * Generates a placeholder navigation menu object.
 *
 * When using Trestle's auto-generated navigation feature,
 * it is necessary to ensure that some nav menu object is
 * selected as primary otherwise no navigation will be generated.
 *
 * @since 1.0.0
 */
function trestle_nav_placeholder() {
	// Set title for Trestle placeholder navigation menu
	$trestle_nav_title = __( 'Trestle Auto Nav Placeholder', 'trestle' );

	// Create placeholder menu for 'primary' spot if auto-nav is selected - this ensures that nav extras can be used even when no custom menu is formally set to primary
	if ( 1 == genesis_get_option( 'trestle_auto_nav' ) && ! wp_get_nav_menu_object( $trestle_nav_title ) && ! has_nav_menu( 'primary' ) ) {
		// Create placholder menu
		wp_create_nav_menu( $trestle_nav_title );

		// Assign placeholder menu to 'primary'
		$menu_locations = get_theme_mod( 'nav_menu_locations' );
		$menu_locations['primary'] = wp_get_nav_menu_object( $trestle_nav_title )->term_id;
		set_theme_mod( 'nav_menu_locations', $menu_locations );
	}

	// Remove placeholder menu if auto-nav is disabled
	$menus = get_registered_nav_menus();

	if ( 1 != genesis_get_option( 'trestle_auto_nav' ) && wp_get_nav_menu_object( $trestle_nav_title ) && $trestle_nav_title != $menus['primary'] )
		wp_delete_nav_menu( $trestle_nav_title );
}


/*===========================================
 * Posts & Pages
===========================================*/

/**
 * Sets the number of post revisions. 
 *
 * @since  1.0.0
 *
 * @param  int $num Default number of post revisions.
 * @return int      Number of post revisions specified in Trestle admin panel.
 */
function trestle_update_revisions_number( $num ) {
	$trestle_revisions_number = esc_attr( genesis_get_option( 'trestle_revisions_number' ) );

	if ( isset( $trestle_revisions_number ) )
		return $trestle_revisions_number;

	return $num;
}

/**
 * Manually controls display of post info/meta for all post types.
 *
 * @since 1.0.0
 *
 * @see trestle_set_page_post_type()
 * @global object $post The current $post object.
 */
function trestle_post_info_meta() {
	if ( ! is_admin() && in_the_loop() && genesis_get_option( 'trestle_manual_post_info_meta' ) ) {

		global $post;

		// Get post type
		$orig_post_type = '';
		
		$post_type = get_post_type( $post->ID );

		// Override "page" post type to allow for Post Info & Meta (reset back to page below)
		if ( 'page' == $post_type ) {
			$orig_post_type = 'page';
			set_post_type( $post->ID, 'post' );
		}		
				
		// Remove all Post Info & Meta
		remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
		remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

		// Single
		if ( is_singular() ) {
			$single_info_option = 'trestle_post_info_' . $post_type . '_single';
			$single_meta_option = 'trestle_post_meta_' . $post_type . '_single';
		
			// Post Info
			if ( genesis_get_option( $single_info_option ) )
				add_action( 'genesis_entry_header', 'genesis_post_info', 12 );

			// Post Meta
			if ( genesis_get_option( $single_meta_option ) )
				add_action( 'genesis_entry_footer', 'genesis_post_meta' );
		}

		// Archive
		if ( ! is_singular() ) {
			$archive_info_option = 'trestle_post_info_' . $post_type . '_archive';
			$archive_meta_option = 'trestle_post_meta_' . $post_type . '_archive';
			
			// Post Info
			if ( genesis_get_option( $archive_info_option ) )
				add_action( 'genesis_entry_header', 'genesis_post_info', 12 );

			// Post Meta
			if ( genesis_get_option( $archive_meta_option ) )
				add_action( 'genesis_entry_footer', 'genesis_post_meta' );
		}
	
		// Reset post type back to page if need be
		if ( ! empty( $orig_post_type ) && 'page' == $orig_post_type )
			add_action( 'genesis_entry_footer', 'trestle_set_page_post_type' );
	}
}

/**
 * Unset Genesis default featured image fallback of 'first-attached'
 *
 * This function prevents Genesis' default behavior of displaying
 * the 'first-attached' image as a post's featured image (in archive)
 * views, even when the post has no current featured image.
 *
 * @since 1.0.0
 *
 * @param array $args Default Genesis image args
 * @return array Updated image args
 */
function trestle_featured_image_fallback( $args ) {
	$args['fallback'] = false;
	return $args;
}


/*===========================================
 * General Actions & Filters
===========================================*/

/**
 * Resets post type back to page once post info / meta functionality is done.
 *
 * @since 1.0.0
 *
 * @global object $post The current $post object.
 */
function trestle_set_page_post_type() {
	global $post;
	set_post_type( $post->ID, 'page' );
}

/**
 * Displays custom Trestle "read more" text in place of WordPress default.
 *
 * @since 1.0.0
 *
 * @param string $default_text Default "read more" text.
 * @return string (Updated) "read more" text.
 */
function trestle_read_more_link( $default_text ) {
	// Get Trestle custom "read more" link text
	$custom_text = esc_attr( genesis_get_option( 'trestle_read_more_text' ) );

	if ( $custom_text )	
		return '&hellip;&nbsp;<a class="more-link" title="' . $custom_text . '" href="' . get_permalink() . '">' . $custom_text . '</a>';
	else
		return $default_text;
}