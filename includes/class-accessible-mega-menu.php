<?php
class Accessible_Mega_Menu {
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( 'Accessible_Mega_Menu', 'enqueue_assets' ) );
		add_filter( 'genesis_attr_nav-primary', array( 'Accessible_Mega_Menu', 'set_nav_atts' ) );
	}

	public static function enqueue_assets() {
		wp_enqueue_script(
			'accessible-mega-menu',
			TRESTLE_URL . '/libraries/accessible-mega-menu/accessible-mega-menu.js',
			array( 'jquery' ),
			false,
			true
		);
	}

	public static function set_nav_atts( $attributes ) {
		$attributes['class'] .= ' accessible-mega-menu';
		return $attributes;
	}
}
