<?php
class Accessible_Mega_Menu {
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( 'Accessible_Mega_Menu', 'enqueue_assets' ) );
		add_action( 'customize_register', array( 'Accessible_Mega_Menu', 'set_customizer_settings' ), 11 );
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

	public static function set_customizer_settings( $wp_customize ) {
		$wp_customize->add_setting(
			'trestle-settings[mega_menu_title]',
			array(
				'default' => '',
				'type'    => 'option',
			)
		);

		$wp_customize->add_control(
			'trestle_mega_menu_title',
			array(
				'section' => 'trestle_settings_section',
				'settings' => 'trestle-settings[mega_menu_title]',
				'label' => __( 'Mega Menu', 'trestle' ),
				'type' => 'hidden',
			)
		);

		$wp_customize->add_setting(
			'trestle-settings[mega_menu]',
			array(
				'default' => trestle_get_option( 'mega_menu' ),
				'type' => 'option',
				'capability' => 'edit_theme_options',
			)
		);
		$wp_customize->add_control(
			'trestle_mega_menu_control',
			array(
				'section' => 'trestle_settings_section',
				'settings' => 'trestle-settings[mega_menu]',
				'label' => __( 'Use Mega Menu', 'trestle' ),
				'description' => __( 'Boost the accessibility of the already accessible main navigation menu by allowing you to navigate using the arrow keys (up/down/right/left) plus the default Tab navigation.<br><br>
					Use the <b>left/right arrow keys</b> to jump to the next/previous submenu. <br>
					Use the <b>up/down arrow keys</b> to go to the next/previous submenu item. <br><br>
					<b>Please note that this option will disable clickability on the top level links of your menu if that top level link contains submenus. If you enable this, it is recommended to add the same link as the first item of the submenu.</b>', 'trestle' ),
				'type' => 'checkbox',
			)
		);
	}

	public static function set_nav_atts( $attributes ) {
		if ( trestle_get_option( 'mega_menu' ) ) {
			$attributes['class'] .= ' accessible-mega-menu';	
		}
		return $attributes;
	}
}
