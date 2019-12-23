<?php
/**
 * Academy Pro.
 *
 * This file adds the required CSS to the front end to the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

add_action( 'wp_enqueue_scripts', 'academy_css', 99 );
/**
 * Checks the settings for the link color and accent color.
 * If any of these value are set the appropriate CSS is output.
 *
 * @since 1.0.0
 */
function academy_css() {

	$handle = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	$color_primary = get_theme_mod( 'academy_primary_color', academy_customizer_get_default_primary_color() );

	$intro_paragraph = get_theme_mod( 'academy-use-paragraph-styling', 1 );

	$css       = '';
	$front_css = '';

	$front_css .= ( academy_customizer_get_default_primary_color() !== $color_primary ) ? sprintf(
		'

		.content .flexible-widgets > .wrap::after,
		.hero-section::after {
			background: %1$s;
		}

		.front-page-5 .widget.widget_media_image .widget-wrap::before,
		.front-page-3 .widget-area::before,
		.hero-section-column.right::before {
			border-color: %1$s;
		}

		', $color_primary
	) : '';

	$css .= ( $intro_paragraph ) ? sprintf(
		'

		.single .content .entry-content > p:first-of-type {
			font-size: 26px;
			font-size: 2.6rem;
			letter-spacing: -0.7px;
		}

		'
	) : '';

	$css .= ( academy_customizer_get_default_primary_color() !== $color_primary ) ? sprintf(
		'

		a,
		h4,
		button.secondary:focus,
		button.secondary:hover,
		input[type="button"].secondary:focus,
		input[type="button"].secondary:hover,
		input[type="reset"].secondary:focus,
		input[type="reset"].secondary:hover,
		input[type="submit"].secondary:focus,
		input[type="submit"].secondary:hover,
		.button.secondary:focus,
		.button.secondary:hover,
		.menu > .highlight > a:hover,
		.site-title a:focus,
		.site-title a:hover,
		.entry-title a:focus,
		.entry-title a:hover,
		.genesis-nav-menu a:focus,
		.genesis-nav-menu a:hover,
		.genesis-nav-menu .current-menu-item > a,
		.genesis-nav-menu .sub-menu .current-menu-item > a:focus,
		.genesis-nav-menu .sub-menu .current-menu-item > a:hover,
		.genesis-responsive-menu .genesis-nav-menu a:focus,
		.genesis-responsive-menu .genesis-nav-menu a:hover,
		.gs-faq button:focus,
		.gs-faq button:hover,
		.gs-faq button.gs-faq--expanded:focus,
		.entry-footer .entry-meta .entry-categories a:focus,
		.entry-footer .entry-meta .entry-categories a:hover,
		.entry-footer .entry-meta .entry-tags a:focus,
		.entry-footer .entry-meta .entry-tags a:hover,
		.entry-footer .entry-meta .entry-terms a:focus,
		.entry-footer .entry-meta .entry-terms a:hover,
		.sidebar a:not(.button):focus,
		.sidebar a:not(.button):hover,
		.sp-icon-accent,
		.sub-menu-toggle:focus,
		.sub-menu-toggle:hover {
			color: %1$s;
		}

		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.button {
			background-color: %1$s;
		}

		.enews-widget::after {
			background: %1$s;
		}

		.enews-widget input[type="submit"],
		.sidebar .enews-widget input[type="submit"] {
			background-color: %1$s;
		}

		a.more-link.button.text:focus,
		a.more-link.button.text:hover,
		button.text:focus,
		button.text:hover,
		input[type="button"].text:focus,
		input[type="button"].text:hover,
		input[type="reset"].text:focus,
		input[type="reset"].text:hover,
		input[type="submit"].text:focus,
		input[type="submit"].text:hover,
		.button.text:focus,
		.button.text:hover,
		.comment-reply-link:focus,
		.comment-reply-link:hover,
		.footer-cta::before,
		.menu-toggle:focus,
		.menu-toggle:hover,
		.menu > .highlight > a:focus,
		.menu > .highlight > a:hover {
			border-color: %1$s;
			color: %1$s;
		}

		a.more-link.button.text,
		button.secondary,
		button.text,
		input[type="button"].secondary,
		input[type="reset"].secondary,
		input[type="submit"].secondary,
		input:focus,
		input[type="button"].text,
		input[type="reset"].text,
		input[type="submit"].text,
		textarea:focus,
		.archive-pagination a:focus,
		.archive-pagination a:hover,
		.archive-pagination .active a,
		.button.secondary,
		.button.text,
		.comment-reply-link,
		.entry-footer .entry-meta .entry-categories a,
		.entry-footer .entry-meta .entry-tags a,
		.entry-footer .entry-meta .entry-terms a,
		.genesis-responsive-menu .genesis-nav-menu .sub-menu a:focus,
		.genesis-responsive-menu .genesis-nav-menu .sub-menu a:hover,
		.gravatar-wrap::before,
		.menu-toggle,
		.menu > .highlight > a,
		.pricing-table .featured,
		.single-featured-image::before,
		.site-title a,
		.site-title a:focus,
		.site-title a:hover {
			border-color: %1$s;
		}

		a.button:focus,
		a.button:hover,
		button:focus,
		button:hover,
		input[type="button"]:focus,
		input[type="button"]:hover,
		input[type="reset"]:focus,
		input[type="reset"]:hover,
		input[type="submit"]:focus,
		input[type="submit"]:hover,
		.archive-pagination li a:focus,
		.archive-pagination li a:hover,
		.archive-pagination .active a,
		.button:focus,
		.button:hover,
		.enews-widget input[type="submit"]:focus,
		.enews-widget input[type="submit"]:hover,
		.sidebar .enews-widget input[type="submit"]:focus,
		.sidebar .enews-widget input[type="submit"]:hover {
			background-color: %1$s;
		}

		', $color_primary, academy_color_brightness( $color_primary, '+', 20 ), academy_color_contrast( $color_primary )
	) : '';

	if ( $css ) {
		wp_add_inline_style( $handle, $css );
	}

	if ( $front_css ) {
		wp_add_inline_style( 'academy-front-styles', $front_css );
	}

}
