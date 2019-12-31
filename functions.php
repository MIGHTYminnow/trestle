<?php
/**
 * Academy Pro.
 *
 * This file adds functions to the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

define( 'TRESTLE_DIR', get_stylesheet_directory() );
define( 'TRESTLE_URL', get_stylesheet_directory_uri() );

require_once( TRESTLE_DIR . '/includes/class-accessible-mega-menu.php' );

Accessible_Mega_Menu::init();


// Starts the engine.
require_once get_template_directory() . '/lib/init.php';

// Sets up the Theme.
require_once get_stylesheet_directory() . '/lib/theme-defaults.php';

add_action( 'after_setup_theme', 'academy_localization_setup' );
/**
 * Sets localization (do not remove).
 *
 * @since 1.0.0
 */
function academy_localization_setup() {

	load_child_theme_textdomain( 'academy-pro', get_stylesheet_directory() . '/languages' );

}

// Adds the theme helper functions.
require_once get_stylesheet_directory() . '/lib/helper-functions.php';

// Adds image upload and color select to WordPress Theme Customizer.
require_once get_stylesheet_directory() . '/lib/customizer/customize.php';

// Adds the theme image functions.
require_once get_stylesheet_directory() . '/lib/featured-images.php';

// Includes customizer CSS.
require_once get_stylesheet_directory() . '/lib/customizer/output.php';

// Adds the Grid Layout.
require_once get_stylesheet_directory() . '/lib/grid-layout.php';

// Adds WooCommerce support.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php';

// Includes the customizer CSS for the WooCommerce plugin.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php';

// Includes notice to install Genesis Connect for WooCommerce.
require_once get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php';

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

// Defines the child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Academy Pro' );
define( 'CHILD_THEME_URL', 'https://my.studiopress.com/themes/academy/' );
define( 'CHILD_THEME_VERSION', '1.0.10' );

add_action( 'wp_enqueue_scripts', 'academy_enqueue_scripts_styles' );
/**
 * Enqueues scripts and styles.
 *
 * @since 1.0.0
 */
function academy_enqueue_scripts_styles() {

	wp_enqueue_style( 'academy-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,400i,700,700i&display=swap', array(), CHILD_THEME_VERSION );

	wp_enqueue_style( 'academy-sp-icons', get_stylesheet_directory_uri() . '/css/sp-icons.css', array(), CHILD_THEME_VERSION );

	wp_enqueue_script( 'academy-match-height', get_stylesheet_directory_uri() . '/js/jquery.matchHeight.min.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_add_inline_script( 'academy-match-height', "jQuery(document).ready( function() { jQuery( '.half-width-entries .content .entry, .academy-grid .content .entry').matchHeight(); });" );

	wp_enqueue_script( 'global-js', get_stylesheet_directory_uri() . '/js/global.js', array( 'jquery', 'accessible-mega-menu' ), CHILD_THEME_VERSION, true );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'academy-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'academy-responsive-menu',
		'genesis_responsive_menu',
		academy_responsive_menu_settings()
	);

}

add_filter( 'body_class', 'academy_half_width_entry_class' );
/**
 * Defines the half width entries body class.
 *
 * @since 1.0.0
 *
 * @param array $classes Current classes.
 * @return array $classes Updated class array.
 */
function academy_half_width_entry_class( $classes ) {

	$site_layout = genesis_site_layout();

	if ( 'full-width-content' === $site_layout && ( is_home() || is_category() || is_tag() || is_author() || is_search() || genesis_is_blog_template() ) ) {
		$classes[] = 'half-width-entries';
	}

	return $classes;

}

/**
 * Defines the responsive menu settings.
 *
 * @since 1.0.0
 */
function academy_responsive_menu_settings() {

	$settings = array(
		'mainMenu'         => __( 'Menu', 'academy-pro' ),
		'menuIconClass'    => 'sp-icon-menu',
		'subMenu'          => __( 'Submenu', 'academy-pro' ),
		'subMenuIconClass' => 'sp-icon-plus',
		'menuClasses'      => array(
			'combine' => array(
				'.nav-primary',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Adds HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Adds Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Relocates skip links.
remove_action( 'genesis_before_header', 'genesis_skip_links', 5 );
add_action( 'genesis_before', 'genesis_skip_links', 5 );

// Adds viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Adds support for custom header.
add_theme_support(
	'custom-header', array(
		'flex-width'     => true,
		'flex-height'     => true,
		'header-selector' => '.site-title a',
		'header-text'     => false,
		'height'          => 160,
		'width'           => 600,
	)
);

// Adds structural wrap to site-inner.
add_theme_support(
	'genesis-structural-wraps', array(
		'header',
		'menu-primary',
		'menu-secondary',
		'site-inner',
		'footer-widgets',
		'footer',
	)
);

// Move breadcrumbs to bellow header.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );
add_action( 'genesis_after_header', 'genesis_do_breadcrumbs' );

// Adds support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Adds image sizes.
add_image_size( 'featured-image', 880, 360, true );
add_image_size( 'large-portrait', 300, 350, true );

add_filter( 'image_size_names_choose', 'academy_media_library_sizes' );
/**
 * Adds image sizes to Media Library.
 *
 * @since 1.0.0
 *
 * @param array $sizes Array of image sizes and their names.
 * @return array The modified list of sizes.
 */
function academy_media_library_sizes( $sizes ) {

	$sizes['large-portrait'] = __( 'Home - Large Portrait', 'academy-pro' );

	return $sizes;

}

// Removes secondary sidebar.
unregister_sidebar( 'sidebar-alt' );

// Removes site layouts.
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

// Removes output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

add_action( 'genesis_theme_settings_metaboxes', 'academy_remove_genesis_metaboxes' );
/**
 * Removes navigation meta box.
 *
 * @since 1.0.0
 *
 * @param string $_genesis_theme_settings_pagehook The page hook name.
 */
function academy_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {

	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );

}

add_filter( 'genesis_skip_links_output', 'academy_skip_links_output' );
/**
 * Removes skip link for primary navigation and adds skip link for footer widgets.
 *
 * @since 1.0.0
 *
 * @param array $links The list of skip links.
 * @return array $links The modified list of skip links.
 */
function academy_skip_links_output( $links ) {

	if ( isset( $links['genesis-nav-primary'] ) ) {
		unset( $links['genesis-nav-primary'] );
	}

	$new_links = $links;

	if ( is_active_sidebar( 'footer-cta' ) ) {
		$new_links['footer-cta'] = __( 'Skip to footer', 'academy-pro' );
	}

	return array_merge( $links, $new_links );

}

// Renames primary and secondary navigation menus.
add_theme_support(
	'genesis-menus', array(
		'primary'   => __( 'Header Menu', 'academy-pro' ),
		'secondary' => __( 'Footer Menu', 'academy-pro' ),
	)
);

// Repositions primary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav', 12 );

// Repositions the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

add_filter( 'wp_nav_menu_args', 'academy_secondary_menu_args' );
/**
 * Reduces the secondary navigation menu to one level depth.
 *
 * @since 1.0.0
 *
 * @param array $args The WP navigation menu arguments.
 * @return array The modified menu arguments.
 */
function academy_secondary_menu_args( $args ) {

	if ( 'secondary' === $args['theme_location'] ) {
		$args['depth'] = 1;
	}

	return $args;

}

add_filter( 'genesis_author_box_gravatar_size', 'academy_author_box_gravatar' );
/**
 * Modifies the size of the Gravatar in the author box.
 *
 * @since 1.0.0
 *
 * @param int $size Current Gravatar size.
 * @return int New size.
 */
function academy_author_box_gravatar( $size ) {

	return 155;

}

add_filter( 'genesis_author_box', 'academy_author_box', 10, 6 );
/**
 * Adds a wrapper around the gravatar image on single posts and author pages.
 *
 * @since 1.0.0
 *
 * @param string $output The original author box HTML.
 * @param string $context Context.
 * @param string $pattern (s)printf pattern.
 * @param string $gravatar The gravatar.
 * @param string $title The title.
 * @param string $description The description.
 * @return string The new author box HTML.
 */
function academy_author_box( $output, $context, $pattern, $gravatar, $title, $description ) {

	$gravatar = sprintf( '<div class="gravatar-wrap">%s</div>', $gravatar );

	$output = sprintf( $pattern, $gravatar, $title, $description );

	return $output;

}

add_filter( 'genesis_comment_list_args', 'academy_comments_gravatar' );
/**
 * Modifies the size of the Gravatar in the entry comments.
 *
 * @since 1.0.0
 *
 * @param array $args The comment list arguments.
 * @return array Arguments with new avatar size.
 */
function academy_comments_gravatar( $args ) {

	$args['avatar_size'] = 62;

	return $args;

}

add_filter( 'comment_author_says_text', 'academy_comment_author_says_text' );
/**
 * Modifies the author says text in comments.
 *
 * @since 1.0.0
 *
 * @return string New author says text.
 */
function academy_comment_author_says_text() {

	return '';

}

add_filter( 'get_the_content_limit', 'academy_content_limit_read_more_markup', 10, 3 );
/**
 * Modifies the generic more link markup for posts.
 *
 * @since 1.0.0
 *
 * @param string $output The current full HTML.
 * @param string $content The content HTML.
 * @param string $link The link HTML.
 * @return string The new more link HTML.
 */
function academy_content_limit_read_more_markup( $output, $content, $link ) {

	if ( is_page_template( 'page_blog.php' ) || is_home() || is_archive() || is_search() ) {
		$link = sprintf( '<span aria-hidden="true" class="more-link button text">%s &#x2192;</span>', __( 'Continue Reading', 'academy-pro' ) );
	}

	$output = sprintf( '<p>%s &#x02026;</p><p class="more-link-wrap">%s</p>', $content, str_replace( '&#x02026;', '', $link ) );

	return $output;

}

// Moves image above post title.
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
add_action( 'genesis_entry_header', 'genesis_do_post_image', 8 );

/**
 * Counts used widgets in given sidebar.
 *
 * @since 1.0.0
 *
 * @param string $id The sidebar ID.
 * @return int|void The number of widgets, or nothing.
 */
function academy_count_widgets( $id ) {

	$sidebars_widgets = wp_get_sidebars_widgets();

	if ( isset( $sidebars_widgets[ $id ] ) ) {
		return count( $sidebars_widgets[ $id ] );
	}

}

/**
 * Outputs class names based on widget count.
 *
 * @since 1.0.0
 *
 * @param string $id The widget ID.
 * @return string The class.
 */
function academy_widget_area_class( $id ) {

	$count = academy_count_widgets( $id );

	$class = '';

	if ( 1 === $count ) {
		$class .= ' widget-full';
	} elseif ( 0 === $count % 3 ) {
		$class .= ' widget-thirds';
	} elseif ( 1 === $count % 2 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

/**
 * Outputs class names based on widget count.
 *
 * @since 1.0.0
 *
 * @param string $id The widget ID.
 * @return string The class.
 */
function academy_alternate_widget_area_class( $id ) {

	$count = academy_count_widgets( $id );

	$class = '';

	if ( 1 === $count || 2 === $count ) {
		$class .= ' widget-full';
	} elseif ( 1 === $count % 3 ) {
		$class .= ' widget-thirds';
	} elseif ( 0 === $count % 2 ) {
		$class .= ' widget-halves uneven';
	} else {
		$class .= ' widget-halves';
	}

	return $class;

}

add_action( 'genesis_before_footer', 'academy_footer_cta' );
/**
 * AAdds the footer cta area.
 *
 * @since 1.0.0
 */
function academy_footer_cta() {

	genesis_widget_area(
		'footer-cta', array(
			'before' => '<div id="footer-cta" class="footer-cta"><h2 class="genesis-sidebar-title screen-reader-text">' . __( 'Footer CTA', 'academy-pro' ) . '</h2><div class="flexible-widgets widget-area ' . academy_widget_area_class( 'footer-cta' ) . '"><div class="wrap">',
			'after'  => '</div></div></div>',
		)
	);

}

add_filter( 'genesis_post_info', 'academy_post_info_filter' );
/**
 * Modifies the meta information in the entry header.
 *
 * @since 1.0.0
 *
 * @param string $post_info Current post info.
 * @return string New post info.
 */
function academy_post_info_filter( $post_info ) {

	if ( is_search() ) {
		$post_info = 'By [post_author] on [post_date] [post_edit]';
	} else {
		$post_info = 'By [post_author_posts_link] on [post_date] [post_edit]';
	}

	return $post_info;

}
/**
 * Remove entry meta for post types
 * 
 * @link https://gist.github.com/nathanrice/03a5871e5e5a27f22747
 */
add_action( 'init', 'sample_remove_entry_meta', 11 );

function sample_remove_entry_meta() {

	remove_post_type_support( 'video', 'genesis-entry-meta-before-content' );
	remove_post_type_support( 'video', 'genesis-entry-meta-after-content' );

}


add_filter( 'genesis_attr_entry', 'academy_entry_attributes', 10, 3 );
/**
 * Add itemref attribute to link entry-title to page content.
 *
 * @since  1.0.5
 *
 * @param  array $attributes Entry attributes.
 * @return array The new $attributes.
 */
function academy_entry_attributes( $attributes, $context, $args ) {

	if ( is_page() && ! is_front_page() && ! isset( $args['params']['is_widget'] ) ) {
		$attributes['itemref'] = 'page-title';
	}

	return $attributes;

}

add_filter( 'genesis_attr_entry-header', 'academy_add_entry_header_attributes' );
/**
 * Adds custom attributes for the page title.
 *
 * @since 1.0.5
 *
 * @param array $attributes The element attributes.
 * @return array $attributes The element attributes.
 */
function academy_add_entry_header_attributes( $attributes ) {

	if ( is_page() && ! is_front_page() && ! isset( $args['params']['is_widget'] ) ) {

		// Adds id.
		$attributes['id'] = 'page-title';

	}

	// Returns the attributes.
	return $attributes;

}

// Moves page and archive titles above the content wrap.
remove_action( 'genesis_before_loop', 'genesis_do_posts_page_heading' );
remove_action( 'genesis_before_loop', 'genesis_do_blog_template_heading' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_posts_page_heading' );
add_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_blog_template_heading' );



// Registers widget areas.
genesis_register_sidebar(
	array(
		'id'          => 'footer-cta',
		'name'        => __( 'Footer CTA', 'academy-pro' ),
		'description' => __( 'This is the bottom call to action section.', 'academy-pro' ),
	)
);
// allow excerpts on pages
add_action( 'init', 'wpse325327_add_excerpts_to_pages' );
function wpse325327_add_excerpts_to_pages() {
    add_post_type_support( 'page', 'excerpt' );
}

/**
 * Add <header> aria role (banner)
 */

function ct_add_header_aria_role( $open, $args ) {
	return str_replace( '<header', '<header role="banner"', $open );
}

add_filter( 'genesis_markup_site-header_open', 'ct_add_header_aria_role', 10, 2 );

/**
 * Wrap genesis_skip_links on a navigation landmark (<nav>)
 * 
 * Original code on: /genesis/lib/structure/header.php
 * @version 2.9.1
 */

function ct_genesis_skip_links( $open, $args ) {
	remove_filter( 'genesis_markup_site-header_open', 'ct_genesis_skip_links', 10, 2 );

	if ( ! genesis_a11y( 'skip-links' ) ) {
		return $open;
	}

	// Call function to add IDs to the markup.
	genesis_skiplinks_markup();

	// Determine which skip links are needed.
	$links = array();

	if ( genesis_nav_menu_supported( 'primary' ) && has_nav_menu( 'primary' ) ) {
		$links['genesis-nav-primary'] = esc_html__( 'Skip to primary navigation', 'genesis' );
	}

	$links['genesis-content'] = esc_html__( 'Skip to content', 'genesis' );

	if ( 'full-width-content' !== genesis_site_layout() ) {
		$links['genesis-sidebar-primary'] = esc_html__( 'Skip to primary sidebar', 'genesis' );
	}

	if ( in_array( genesis_site_layout(), array( 'sidebar-sidebar-content', 'sidebar-content-sidebar', 'content-sidebar-sidebar' ), true ) ) {
		$links['genesis-sidebar-secondary'] = esc_html__( 'Skip to secondary sidebar', 'genesis' );
	}

	if ( current_theme_supports( 'genesis-footer-widgets' ) ) {
		$footer_widgets = get_theme_support( 'genesis-footer-widgets' );
		if ( isset( $footer_widgets[0] ) && is_numeric( $footer_widgets[0] ) && is_active_sidebar( 'footer-1' ) ) {
			$links['genesis-footer-widgets'] = esc_html__( 'Skip to footer', 'genesis' );
		}
	}

	/**
	 * Filter the skip links.
	 *
	 * @since 2.2.0
	 *
	 * @param array $links {
	 *     Default skiplinks.
	 *
	 *     @type string HTML ID attribute value to link to.
	 *     @type string Anchor text.
	 * }
	 */
	$links = (array) apply_filters( 'genesis_skip_links_output', $links );

	// Write HTML, skiplinks in a list.
	$skiplinks = '<nav aria-labelledby="skip-to-title">';
	$skiplinks .= '<h2 id="skip-to-title" class="screen-reader-text">Skip to:</h2>';
	$skiplinks .= '<ul class="genesis-skip-link">';

	// Add markup for each skiplink.
	foreach ( $links as $key => $value ) {
		$skiplinks .= '<li><a href="' . esc_url( '#' . $key ) . '" class="screen-reader-shortcut"> ' . $value . '</a></li>';
	}

	$skiplinks .= '</ul>';
	$skiplinks .= '</nav>';

	return $open . $skiplinks;

}

remove_action( 'genesis_before', 'genesis_skip_links', 5 );

add_filter( 'genesis_markup_site-header_open', 'ct_genesis_skip_links', 10, 2 );

/**
 * Replace footer-widgets tag from <div> to <aside>
 */

function ct_genesis_markup_footer_widgets_open( $open, $args ) {
	return str_replace( '<div class="footer-widgets"', '<aside role="complementary" class="footer-widgets"', $open );
}

add_filter( 'genesis_markup_footer-widgets_open', 'ct_genesis_markup_footer_widgets_open', 10, 2 );

function ct_genesis_markup_footer_widgets_close( $close, $args ) {
	return str_replace( '</div>', '</aside>', $close );
}

add_filter( 'genesis_markup_footer-widgets_close', 'ct_genesis_markup_footer_widgets_close', 10, 2 );


/**
 * Add aria role to <footer> (contentinfo)
 */

function ct( $open, $args ) {
	return str_replace( '<footer', '<footer role="contentinfo"', $open );
}

add_filter( 'genesis_markup_site-footer_open', 'ct', 10, 2 );

add_filter( 'genesis_markup_search-form-submit_open', function( $open, $args ) {
	return '<button class="search-form-submit" type="submit">';
}, 1, 2 );

add_filter( 'genesis_markup_search-form-submit_content', function( $open, $args ) {
	return '<i class="fa fa-search" aria-hidden="true"></i><span class="screen-reader-text">Search</span>';
}, 1, 2 );

add_filter( 'genesis_markup_search-form-submit_close', function( $open, $args ) {
	return '</button>';
}, 1, 2 );

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_style( 'font-awesome' );
});

include 'includes/google-tag-manager.php';

/**
 * Apply Content Sidebar content layout to single posts.
 * 
 * @return string layout ID.
 */

add_filter( 'genesis_pre_get_option_site_layout', 'custom_set_single_posts_layout' );

function custom_set_single_posts_layout() {
if ( is_single() && 'post' == get_post_type() ) {
        return 'content-sidebar';
    }
}

/**
 * Go To Top Button
 */

if ( ! function_exists( 'theme_go_top_button' ) ) {
	function theme_go_top_button(){
		echo '<a id="go-top" href="#site-container"><span class="screen-reader-text">Go to top</span><i class="fa fa-chevron-up" aria-hidden="true"></i></a>';
	}
}

add_action( 'genesis_footer', 'theme_go_top_button' );

if ( ! function_exists( 'theme_go_top_add_target_id' ) ) {
	function theme_go_top_add_target_id( $attr ) {
		$attr['id'] = 'site-container';

		return $attr;
	}
}

add_filter( 'genesis_attr_site-container', 'theme_go_top_add_target_id' );



/**
 * Wrap Elementor on #genesis-content
 */
add_action( 'elementor/page_templates/header-footer/before_content', function(){
	echo '<main id="genesis-content">';
});

add_action( 'elementor/page_templates/header-footer/after_content', function(){
	echo '</main>';
});

// Register a custom image size for Singular Featured images
add_image_size( 'singular-featured-thumb', 2500, 600, true );

add_action( 'genesis_after_header', 'sk_display_featured_image' );
function sk_display_featured_image() {
	if ( ! is_singular( array( 'page' ) ) ) {
		return;
	}
	if ( ! has_post_thumbnail() ) {
		return;
	}
	if ( ! is_front_page() ) {
		// Display featured image above content
		echo '<div class="singular-featured-image">';
			genesis_image( array( 'size' => 'singular-featured-thumb' ) );
		echo '</div>';
	}
}

if ( ! function_exists( 'theme_chat_opener' ) ) {
	function theme_chat_opener( $data ) {
		$data['custom_launcher_selector'] = '.chat-opener';
		return $data;
	}
}

add_filter( 'intercom_settings', 'theme_chat_opener');


if ( ! function_exists( 'theme_magazine_is_active' ) ) {
	function theme_magazine_is_active( $classes, $item, $args, $depth ) {
		if ( 140 == $item->ID ) {
			if ( is_single() || is_category() ) {
				$classes[] = 'active';
			}
		}
		return $classes;
	}
}

add_filter( 'nav_menu_css_class', 'theme_magazine_is_active', 10, 4 );

function theme_category_is_active( $atts ) {
	if ( is_category() ) {
		$current_category = get_queried_object();
		if ( $current_category->term_id == $atts['id'] ) {
			return ' class="active-category"';
		}
	}

	return '';
}

add_shortcode( 'theme-category-is-active', 'theme_category_is_active' );

if ( ! function_exists( 'cta' ) ) {
	function theme_cta( $atts ) {
		$atts = shortcode_atts( array(
			'title' => '',
			'description' => '',
			'button' => '',
			'url' => '',
		), $atts, 'cta' );

		ob_start();
		?>
		<section class="banner">
			<div class="description">
				<h2><?php echo $atts['title']; ?></h2>
				<span><?php echo $atts['description']; ?></span>
			</div>
			<div class="cta">
				<a class="button" href="<?php echo $atts['url']; ?>">
					<?php echo $atts['button']; ?>
				</a>
			</div>
		</section>
		<?php
		return ob_get_clean();
	}
}

add_shortcode( 'CTA', 'theme_cta' );

add_shortcode( 'wpv-view-lazy-img', 'theme_wpv_view_lazy_img' );

function theme_wpv_view_lazy_img( $atts ) {
	if ( ! isset( $atts['name'] ) ) {
		return '';
	}
	return str_replace( '<img src="', '<img class="lazy" data-src="', do_shortcode('[wpv-view name="' . $atts['name'] . '"]') );
}

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'jquery-lazy', get_stylesheet_directory_uri() . '/js/jquery.lazy.min.js', array('jquery'), null, true );
	wp_add_inline_script( 'jquery-lazy', "jQuery(function(){jQuery('.lazy').Lazy();});" );
});


/**
 * Remove footer <h2>.
 */
if ( ! function_exists( 'theme_remove_footer_heading' ) ) {
	function theme_remove_footer_heading( $open, $args ) {
		return str_replace( genesis_sidebar_title( 'Footer' ), '', $open );
	}
}

add_filter( 'genesis_markup_footer-widgets_open', 'theme_remove_footer_heading', 1, 2 );

/**
 * Increase footer widgets heading level from <h3> to <h2>.
 */
if ( ! function_exists( 'theme_increase_footer_widgets_heading_level' ) ) {
	function theme_increase_footer_widgets_heading_level( $defaults, $args ) {
		if ( strpos( $args['id'], 'footer-' ) !== false ) {
			$defaults['before_title'] = '<h2 class="widget-title widgettitle">';
			$defaults['after_title'] = '</h2>';
		}

		return $defaults;
	}
}

add_filter( 'genesis_register_widget_area_defaults', 'theme_increase_footer_widgets_heading_level', 10, 2 );


/**
 * Remove <header> inside <article> on internal pages.
 */
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );

/**
 * Remove <article> inside <main> on internal pages.
 */
add_filter( 'genesis_markup_entry_open', function( $open, $args ) {
	return str_replace( '<article', '<div', $open );
}, 10, 2 );


add_filter( 'genesis_markup_entry_close', function( $close, $args ) {
	return str_replace( '</article>', '</div>', $close );
}, 10, 2 );

add_action( 'wp_enqueue_scripts', function(){
	wp_enqueue_script( 'mega-menu', get_stylesheet_directory_uri() . '/js/jquery-accessibleMegaMenu.js', array( 'jquery' ), null, true );
}, 5 );

/*
What's the problem?
	There are 2 issues we have to resolve:
	1) Minor problem: mediaelement-core and mediaelement-migrate are not being added to any of the two merged-minified files.
	2) Major problem: They are being loaded before the header merged-minified file. This files contains the jQuery source. So, 
	   mediaelement-core and mediaelement-migrate are not working fine, because they depend on jQuery.

Why is this happening?
	We are using a script that uses the views-pagination-script.

	- views-pagination-script is in footer by default, and it requires wp-mediaelement
	- wp-mediaelement is in footer by default, and it requires mediaelement
	- mediaelement is in header by default, and it requires mediaelement-core and mediaelement-migrate
	- Both mediaelement-core and mediaelement-migrate are in footer by default, but, as they are required by mediaelement, they are moved to the header
	- When the minifier plugin merges the header scripts via fastvelocity_min_merge_header_scripts(), the plugin doesn't know that mediaelement-core and mediaelement-migrate
	are being moved to the header, because it consults the registered information for those scripts ($wp_scripts->registered[$id_of_script]) and not if they are
	really going to be loaded on footer/header (they could do via $wp_scripts->groups maybe).

	This is the code they use to check if a script is going to footer:
			# is it a footer script?
			$is_footer = 0; 
			if (isset($wp_scripts->registered[$handle]->extra["group"]) || isset($wp_scripts->registered[$handle]->args)) { 
				$is_footer = 1; 
			}

How can we fix this?

	OPTION A:
		Move the merged-minified header file position in queue, to print it before mediaelement-core and mediaelement-migrate:

		This will only fix 1 of our issues: the videos page will work, but the files won't be included on the merged file (that means
		less optimization).

		add_action( 'wp_print_scripts', function(){
			if ( ! is_admin() ) {
				global $wp_scripts;
				array_unshift( $wp_scripts->queue, 'fvm-header-0' );
				unset( $wp_scripts->queue[ count( $wp_scripts->queue ) - 1 ] );
			}
		}, PHP_INT_MAX );

	OPTION B (preferred solution):
		Edit the registered information of mediaelement-core and mediaelement-migrate to tell fastvelocity_min_merge_header_scripts() that
		they are loaded on header.

		This will fix our 2 issues to resolve, but may brake something else in other pages (we will need to test).

		(See code below)

Additional notes:
	This is related to a bug on WordPress Trac:
	https://core.trac.wordpress.org/ticket/44484
*/

add_action( 'wp_print_scripts', function(){
	if ( ! is_admin() ) {
		global $wp_scripts;
		$wp_scripts->registered['mediaelement-core']->args = null;
		$wp_scripts->registered['mediaelement-migrate']->args = null;
	}
});

/**
 * Custom Footer Credits
 */

add_filter('genesis_footer_output', 'theme_custom_footer_credits');

function theme_custom_footer_credits( $creds ) {
	return 'Copyright &copy; ' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . ' &middot; <a href="/privacy-policy/">Privacy Policy</a> &middot; <a href="/sitemap/">Sitemap</a> <br> Website by <a href="https://mightyminnow.com">MIGHTYminnow</a> &middot; Most photos by <a href="/hasain-rasheed/">Hasain Rasheed</a>';
}





add_action( 'genesis_after_endwhile', 'theme_posts_nav', 5 );

function theme_posts_nav() {
	remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
	if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
		ob_start();
		genesis_numeric_posts_nav();
		
		echo str_replace( 'aria-label="Current page"', '', ob_get_clean() );
	} else {
		genesis_prev_next_posts_nav();
	}

}


add_action( 'template_redirect', function(){
	if ( is_category() || is_search() ) {
		add_action( 'genesis_entry_header', function(){
			echo '<a class="post-wrapper-link" href="' . get_permalink() . '">';
		}, 1 );

		add_action( 'genesis_entry_footer', function(){
			echo '</a>';
		}, 1 );

		add_filter( 'genesis_markup_entry-image-link_open', function ( $open, $args ) {
			return str_replace( '<a', '<div', $open );
		}, 10, 2 );

		add_filter( 'genesis_markup_entry-image-link_close', function ( $close, $args ) {
			return str_replace( '</a>', '</div>', $close );
		}, 10, 2 );

		add_filter( 'genesis_link_post_title', '__return_false' );

		add_filter( 'genesis_post_info', function ( $info ) {
			return str_replace( '[post_edit]', '', $info );
		} );
	}
});


add_filter( 'genesis_attr_entry-title', 'theme_entry_title_id' );

function theme_entry_title_id( $attributes ) {

	
		$attributes['id'] = 'page-title';
	

	return $attributes;

}
