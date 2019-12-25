<?php
class Accessible_Mega_Menu {
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( 'Accessible_Mega_Menu', 'enqueue_assets' ) );
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
}
