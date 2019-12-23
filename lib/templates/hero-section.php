<?php
/**
 * Academy Pro
 *
 * This file handles the logic and templating for outputting the Hero Section on the Front Page in the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

// Sets up hero section content.
$title                 = get_theme_mod( 'academy-hero-title-text', academy_get_default_hero_title_text() );
$description           = get_theme_mod( 'academy-hero-description-text', academy_get_default_hero_desc_text() );
$button_primary_text   = get_theme_mod( 'academy-hero-button-primary-text', academy_get_default_hero_button_primary_text() );
$button_primary_url    = get_theme_mod( 'academy-hero-button-primary-url' );
$button_secondary_text = get_theme_mod( 'academy-hero-button-secondary-text', academy_get_default_hero_button_secondary_text() );
$button_secondary_url  = get_theme_mod( 'academy-hero-button-secondary-url' );

// Sets up hero video section.
$video_self_hosted = get_theme_mod( 'academy-hero-video-upload' );
$video_hosted_url  = get_theme_mod( 'academy-hero-hosted-video' );
$video_src_url     = wp_get_attachment_url( $video_self_hosted );
$video_thumb       = get_theme_mod( 'academy-hero-video-thumb', academy_get_default_video_thumbnail() );
$video_thumb_id    = attachment_url_to_postid( $video_thumb );
$video_thumb_alt   = get_post_meta( $video_thumb_id, '_wp_attachment_image_alt', true );

if ( $video_hosted_url ) {
	$video_src_url = $video_hosted_url;
}

// Sets up logo section data.
$logo_header    = get_theme_mod( 'academy-hero-logo-header', academy_get_default_hero_logo_header() );
$logo_image_ids = get_theme_mod( 'academy-hero-logos-images', array() );

// Prepares logo data if images are set.
$logos = array();
if ( array_filter( $logo_image_ids ) ) {
	foreach ( $logo_image_ids as $id ) {
		$logos[ $id ]['src'] = wp_get_attachment_image_src( $id, 'full' );
		$logos[ $id ]['alt'] = get_post_meta( $id, '_wp_attachment_image_alt', true );
	}
}

// Column classes.
$classes = array(
	'columns' => '',
	'left'    => 'hero-section-column left',
	'right'   => 'hero-section-column right',
);

if ( $video_src_url || $video_thumb || $video_hosted_url ) {
	$classes['columns'] = 'has-columns';
	$classes['left']   .= ' one-half first';
	$classes['right']  .= ' one-half';
}

echo '<div class="wrap hero-section ' . esc_attr( $classes['columns'] ) . '">';

if ( $title || $description || is_active_sidebar( 'hero-section' ) ) {

	echo '<div class="' . esc_attr( $classes['left'] ) . '">';

	if ( $title ) {
		echo '<h1 class="hero-title">' . $title . '</h1>';
	}

	if ( $description ) {
		echo '<p class="hero-description">' . $description . '</p>';
	}

	if ( $button_primary_text ) {
		echo '<a class="button primary" href="' . esc_html( $button_primary_url ) . '">' . $button_primary_text . '</a>';
	}

	if ( $button_secondary_text ) {
		echo '<a class="button text" href="' . esc_html( $button_secondary_url ) . '">' . $button_secondary_text . '</a>';
	}

	echo '</div>';

}

if ( $video_src_url ) {

	echo '<div class="' . esc_attr( $classes['right'] ) . '">';
		echo '<div class="hero-video-container">';

		$attr = array(
			'src'     => $video_src_url,
			'poster'  => $video_thumb,
			'preload' => 'none',
		);

		echo wp_video_shortcode( $attr );
		echo '</div>';

	echo '</div>';

} elseif ( $video_thumb ) {

	echo '<div class="' . esc_attr( $classes['right'] ) . '">';

		echo '<img class="hero-image" src="' . esc_url( $video_thumb ) . '" alt="' . $video_thumb_alt . '" />';

	echo '</div>';

}

if ( $logos ) {

	echo '<div class="hero-section-logos wrap">';

	if ( $logo_header ) {
		echo '<div class="hero-logos-header">' . $logo_header . '</div>';
	}

	foreach ( $logos as $logo ) {

		$logo_image = esc_url( $logo['src'][0] );
		$logo_alt   = esc_html( $logo['alt'] );

		if ( $logo_image ) {
			echo '<img class="hero-section-logo" src="' . $logo_image . '" alt="' . $logo_alt . '" />';
		}
	}

	echo '</div>';

}

echo '</div>';
