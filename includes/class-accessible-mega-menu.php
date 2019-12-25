<?php
class Accessible_Mega_Menu {
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( 'Accessible_Mega_Menu', 'enqueue_assets' ) );
		add_filter( 'genesis_customizer_theme_settings_config', array( 'Accessible_Mega_Menu', 'set_customizer_settings' ) );
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

	public static function set_customizer_settings( $config ) {
		$config['genesis']['sections']['genesis_accessible_mega_menu'] = array(
			'title' => __( 'Accessible Mega Menu', 'trestle' ),
			'description' => __( 'Improves the accesibility of the main navigation menu by implementing keyboard navigation.', 'trestle' ),
			'panel' => 'genesis',
			'controls' => array(
				'accessible_mega_menu' => array(
					'label' => __( 'Activate Accessible Mega Menu', 'trestle' ),
					'section' => 'genesis_accessible_mega_menu',
					'type' => 'checkbox',
					'settings' => [
						'default' => false,
					],
				),
			),
		);
		return $config;
	}

	public static function set_nav_atts( $attributes ) {
		if ( genesis_get_option( 'accessible_mega_menu' ) ) {
			$attributes['class'] .= ' accessible-mega-menu';	
		}
		return $attributes;
	}
}
