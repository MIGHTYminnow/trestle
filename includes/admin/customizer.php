<?php
/**
 * Trestle Customizer Controls.
 *
 * @since  2.0.0
 *
 * @package  Trestle
 */

add_action( 'customize_register', 'trestle_customizer_controls' );
/**
 * Register Trestle's controls.
 *
 * @since  2.0.0
 *
 * @param  $wp_customize  The Customizer Object.
 */
function trestle_customizer_controls( $wp_customize ) {

	// Remove extra colors panel from the custom background theme support function.
	$wp_customize->remove_section('colors');

	/**
	 * Add Colors panel
	 */
	$wp_customize->add_panel( 'trestle_colors_panel', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Colors', 'trestle'),
		'description'    => __('Color settings pertaining Trestle', 'trestle'),
	) );

	/**
	 *  Header Colors Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_header_colors_section',
		array(
			'title'    => __( 'Header', 'trestle' ),
			'priority' => 60,
			'panel'    => 'trestle_colors_panel',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[site_title_color]',
		array(
			'default'    => trestle_get_option( 'site_title_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_site_title_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[site_title_color]',
				'label'      => __( 'Site Title', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[site_description_color]',
		array(
			'default'    => trestle_get_option( 'site_description_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_site_description_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[site_description_color]',
				'label'      => __( 'Site Description', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[header_bg_color]',
		array(
			'default'    => trestle_get_option( 'header_bg_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_header_bg_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[header_bg_color]',
				'label'      => __( 'Header Background Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[menu_bg_color]',
		array(
			'default'    => trestle_get_option( 'menu_bg_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_menu_bg_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[menu_bg_color]',
				'label'      => __( 'Menu Background Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[menu_text_color]',
		array(
			'default'    => trestle_get_option( 'menu_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_menu_text_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[menu_text_color]',
				'label'      => __( 'Menu Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[menu_text_hover_color]',
		array(
			'default'    => trestle_get_option( 'menu_text_hover_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_menu_text_hover_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[menu_text_hover_color]',
				'label'      => __( 'Menu Text Hover Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[current_menu_item_color]',
		array(
			'default'    => trestle_get_option( 'current_menu_item_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_current_menu_item_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[current_menu_item_color]',
				'label'      => __( 'Current Menu Item Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[sub_menu_bg_color]',
		array(
			'default'    => trestle_get_option( 'sub_menu_bg_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_sub_menu_bg_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[sub_menu_bg_color]',
				'label'      => __( 'Sub-menu Background Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[sub_menu_text_color]',
		array(
			'default'    => trestle_get_option( 'sub_menu_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_sub_menu_text_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[sub_menu_text_color]',
				'label'      => __( 'Sub-menu Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[sub_menu_text_hover_color]',
		array(
			'default'    => trestle_get_option( 'sub_menu_text_hover_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_sub_menu_text_hover_color_control',
			array(
				'section'    => 'trestle_header_colors_section',
				'settings'   => 'trestle-settings[sub_menu_text_hover_color]',
				'label'      => __( 'Sub-menu Text Hover Color', 'trestle' ),
			)
		)
	);


	/**
	 *  Body Colors Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_body_colors_section',
		array(
			'title'    => __( 'Body', 'trestle' ),
			'priority' => 60,
			'panel'    => 'trestle_colors_panel',
		)
	);

	$wp_customize->add_setting(
	'trestle-settings[site_bg_color]',
		array(
			'default'    => trestle_get_option( 'site_bg_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_site_bg_color_control',
			array(
				'section'    => 'trestle_body_colors_section',
				'settings'   => 'trestle-settings[site_bg_color]',
				'label'      => __( 'Site Background Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[body_text_color]',
		array(
			'default'    => trestle_get_option( 'body_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_body_text_color_control',
			array(
				'section'    => 'trestle_body_colors_section',
				'settings'   => 'trestle-settings[body_text_color]',
				'label'      => __( 'Body Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[body_link_color]',
		array(
			'default'    => trestle_get_option( 'body_link_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_body_link_color_control',
			array(
				'section'    => 'trestle_body_colors_section',
				'settings'   => 'trestle-settings[body_link_color]',
				'label'      => __( 'Body Link Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[body_link_hover_color]',
		array(
			'default'    => trestle_get_option( 'body_link_hover_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_body_link_hover_color_control',
			array(
				'section'    => 'trestle_body_colors_section',
				'settings'   => 'trestle-settings[body_link_hover_color]',
				'label'      => __( 'Body Link Hover Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[entry_title_link_color]',
		array(
			'default'    => trestle_get_option( 'entry_title_link_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_entry_title_link_color_control',
			array(
				'section'    => 'trestle_body_colors_section',
				'settings'   => 'trestle-settings[entry_title_link_color]',
				'label'      => __( 'Entry Title Link Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[entry_title_link_hover_color]',
		array(
			'default'    => trestle_get_option( 'entry_title_link_hover_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_entry_title_link_hover_color_control',
			array(
				'section'    => 'trestle_body_colors_section',
				'settings'   => 'trestle-settings[entry_title_link_hover_color]',
				'label'      => __( 'Entry Title Link Hover Color', 'trestle' ),
			)
		)
	);

	/**
	 *  Sidebar Colors Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_sidebar_colors_section',
		array(
			'title'    => __( 'Sidebar', 'trestle' ),
			'priority' => 60,
			'panel'    => 'trestle_colors_panel',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[sidebar_text_color]',
		array(
			'default'    => trestle_get_option( 'sidebar_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_sidebar_text_color_control',
			array(
				'section'    => 'trestle_sidebar_colors_section',
				'settings'   => 'trestle-settings[sidebar_text_color]',
				'label'      => __( 'Sidebar Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[widget_title_color]',
		array(
			'default'    => trestle_get_option( 'widget_title_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_widget_title_color_control',
			array(
				'section'    => 'trestle_sidebar_colors_section',
				'settings'   => 'trestle-settings[widget_title_color]',
				'label'      => __( 'Widget Title Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[sidebar_link_color]',
		array(
			'default'    => trestle_get_option( 'sidebar_link_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_sidebar_link_color_control',
			array(
				'section'    => 'trestle_sidebar_colors_section',
				'settings'   => 'trestle-settings[sidebar_link_color]',
				'label'      => __( 'Sidebar Link Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[sidebar_link_hover_color]',
		array(
			'default'    => trestle_get_option( 'sidebar_link_hover_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_sidebar_link_hover_color_control',
			array(
				'section'    => 'trestle_sidebar_colors_section',
				'settings'   => 'trestle-settings[sidebar_link_hover_color]',
				'label'      => __( 'Sidebar Link Hover Color', 'trestle' ),
			)
		)
	);

	/**
	 *  Footer Colors Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_footer_colors_section',
		array(
			'title'    => __( 'Footer', 'trestle' ),
			'priority' => 60,
			'panel'    => 'trestle_colors_panel',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[footer_bg_color]',
		array(
			'default'    => trestle_get_option( 'footer_bg_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_footer_bg_color_control',
			array(
				'section'    => 'trestle_footer_colors_section',
				'settings'   => 'trestle-settings[footer_bg_color]',
				'label'      => __( 'Footer Background Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[footer_text_color]',
		array(
			'default'    => trestle_get_option( 'footer_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_footer_text_color_control',
			array(
				'section'    => 'trestle_footer_colors_section',
				'settings'   => 'trestle-settings[footer_text_color]',
				'label'      => __( 'Footer Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[footer_link_color]',
		array(
			'default'    => trestle_get_option( 'footer_link_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_footer_link_color_control',
			array(
				'section'    => 'trestle_footer_colors_section',
				'settings'   => 'trestle-settings[footer_link_color]',
				'label'      => __( 'Footer Link Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[footer_link_hover_color]',
		array(
			'default'    => trestle_get_option( 'footer_link_hover_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_footer_link_hover_color_control',
			array(
				'section'    => 'trestle_footer_colors_section',
				'settings'   => 'trestle-settings[footer_link_hover_color]',
				'label'      => __( 'Footer Link Hover Color', 'trestle' ),
			)
		)
	);

	/**
	 *  Footer Widget Colors Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_footer_widgets_colors_section',
		array(
			'title'    => __( 'Footer Widgets Area', 'trestle' ),
			'priority' => 60,
			'panel'    => 'trestle_colors_panel',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[footer_widgets_bg_color]',
		array(
			'default'    => trestle_get_option( 'footer_widgets_bg_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_footer_widgets_bg_color_control',
			array(
				'section'    => 'trestle_footer_widgets_colors_section',
				'settings'   => 'trestle-settings[footer_widgets_bg_color]',
				'label'      => __( 'Footer Widgets Area Background Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[footer_widgets_text_color]',
		array(
			'default'    => trestle_get_option( 'footer_widgets_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_footer_widgets_text_color_control',
			array(
				'section'    => 'trestle_footer_widgets_colors_section',
				'settings'   => 'trestle-settings[footer_widgets_text_color]',
				'label'      => __( 'Footer Widgets Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[footer_widgets_link_color]',
		array(
			'default'    => trestle_get_option( 'footer_widgets_link_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_footer_widgets_link_color_control',
			array(
				'section'    => 'trestle_footer_widgets_colors_section',
				'settings'   => 'trestle-settings[footer_widgets_link_color]',
				'label'      => __( 'Footer Widgets Link Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[footer_widgets_link_hover_color]',
		array(
			'default'    => trestle_get_option( 'footer_widgets_link_hover_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_footer_widgets_link_hover_color_control',
			array(
				'section'    => 'trestle_footer_widgets_colors_section',
				'settings'   => 'trestle-settings[footer_widgets_link_hover_color]',
				'label'      => __( 'Footer Widgets Link Hover Color', 'trestle' ),
			)
		)
	);

	/**
	 *  Text Colors Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_text_colors_section',
		array(
			'title'    => __( 'Headings', 'trestle' ),
			'priority' => 60,
			'panel'    => 'trestle_colors_panel',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h1_text_color]',
		array(
			'default'    => trestle_get_option( 'h1_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_h1_text_color_control',
			array(
				'section'    => 'trestle_text_colors_section',
				'settings'   => 'trestle-settings[h1_text_color]',
				'label'      => __( 'h1 Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h2_text_color]',
		array(
			'default'    => trestle_get_option( 'h2_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_h2_text_color_control',
			array(
				'section'    => 'trestle_text_colors_section',
				'settings'   => 'trestle-settings[h2_text_color]',
				'label'      => __( 'h2 Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h3_text_color]',
		array(
			'default'    => trestle_get_option( 'h3_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_h3_text_color_control',
			array(
				'section'    => 'trestle_text_colors_section',
				'settings'   => 'trestle-settings[h3_text_color]',
				'label'      => __( 'h3 Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h4_text_color]',
		array(
			'default'    => trestle_get_option( 'h4_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_h4_text_color_control',
			array(
				'section'    => 'trestle_text_colors_section',
				'settings'   => 'trestle-settings[h4_text_color]',
				'label'      => __( 'h4 Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h5_text_color]',
		array(
			'default'    => trestle_get_option( 'h5_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_h5_text_color_control',
			array(
				'section'    => 'trestle_text_colors_section',
				'settings'   => 'trestle-settings[h5_text_color]',
				'label'      => __( 'h5 Text Color', 'trestle' ),
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h6_text_color]',
		array(
			'default'    => trestle_get_option( 'h6_text_color' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'trestle_h6_text_color_control',
			array(
				'section'    => 'trestle_text_colors_section',
				'settings'   => 'trestle-settings[h6_text_color]',
				'label'      => __( 'h6 Text Color', 'trestle' ),
			)
		)
	);

	/**
	 * Add Fonts panel
	 */
	$wp_customize->add_panel( 'trestle_fonts_panel', array(
		'priority'       => 30,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __('Fonts', 'trestle'),
		'description'    => __('Font settings pertaining Trestle', 'trestle'),
	) );

	/**
	 *  Header Fonts Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_header_fonts_section',
		array(
			'title'    => __( 'Header', 'trestle' ),
			'priority' => 10,
			'panel'    => 'trestle_fonts_panel',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[site_title_font_size]',
		array(
			'default'    => trestle_get_option( 'site_title_font_size' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_site_title_font_size_control',
		array(
			'section'  => 'trestle_header_fonts_section',
			'settings' => 'trestle-settings[site_title_font_size]',
			'label'    => __( 'Site Title Font Size', 'trestle' ),
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[site_description_font_size]',
		array(
			'default'    => trestle_get_option( 'site_description_font_size' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_site_description_font_size_control',
		array(
			'section'  => 'trestle_header_fonts_section',
			'settings' => 'trestle-settings[site_description_font_size]',
			'label'    => __( 'Site Description Font Size', 'trestle' ),
		)
	);

	/**
	 *  Text Font Settings Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_text_fonts_section',
		array(
			'title'    => __( 'Headings', 'trestle' ),
			'priority' => 20,
			'panel'    => 'trestle_fonts_panel',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h1_font_size]',
		array(
			'default'    => trestle_get_option( 'h1_font_size' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h1_font_size_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h1_font_size]',
			'label'    => __( 'h1 Font Size', 'trestle' ),
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h1_text_decoration]',
		array(
			'default'    => trestle_get_option( 'h1_text_decoration' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h1_text_decoration_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h1_text_decoration]',
			'label'    => __( 'h1 Text Decoration', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''             => 'None',
				'line-through' => 'Line-through',
				'overline'     => 'Overline',
				'underline'    => 'Underline',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h1_text_style]',
		array(
			'default'    => trestle_get_option( 'h1_text_style' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h1_text_style_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h1_text_style]',
			'label'    => __( 'h1 Text Style', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''           => 'None',
				'capitalize' => 'Capitalize',
				'lowercase'  => 'Lowercase',
				'uppercase'  => 'Uppercase',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h2_font_size]',
		array(
			'default'    => trestle_get_option( 'h2_font_size' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h2_font_size_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h2_font_size]',
			'label'    => __( 'h2 Font Size', 'trestle' ),
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h2_text_decoration]',
		array(
			'default'    => trestle_get_option( 'h2_text_decoration' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h2_text_decoration_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h2_text_decoration]',
			'label'    => __( 'h2 Text Decoration', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''             => 'None',
				'line-through' => 'Line-through',
				'overline'     => 'Overline',
				'underline'    => 'Underline',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h2_text_style]',
		array(
			'default'    => trestle_get_option( 'h2_text_style' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h2_text_style_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h2_text_style]',
			'label'    => __( 'h2 Text Style', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''           => 'None',
				'capitalize' => 'Capitalize',
				'lowercase'  => 'Lowercase',
				'uppercase'  => 'Uppercase',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h3_font_size]',
		array(
			'default'    => trestle_get_option( 'h3_font_size' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h3_font_size_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h3_font_size]',
			'label'    => __( 'h3 Font Size', 'trestle' ),
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h3_text_decoration]',
		array(
			'default'    => trestle_get_option( 'h3_text_decoration' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h3_text_decoration_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h3_text_decoration]',
			'label'    => __( 'h3 Text Decoration', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''             => 'None',
				'line-through' => 'Line-through',
				'overline'     => 'Overline',
				'underline'    => 'Underline',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h3_text_style]',
		array(
			'default'    => trestle_get_option( 'h3_text_style' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h3_text_style_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h3_text_style]',
			'label'    => __( 'h3 Text Style', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''           => 'None',
				'capitalize' => 'Capitalize',
				'lowercase'  => 'Lowercase',
				'uppercase'  => 'Uppercase',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h4_font_size]',
		array(
			'default'    => trestle_get_option( 'h4_font_size' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h4_font_size_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h4_font_size]',
			'label'    => __( 'h4 Font Size', 'trestle' ),
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h4_text_decoration]',
		array(
			'default'    => trestle_get_option( 'h4_text_decoration' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h4_text_decoration_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h4_text_decoration]',
			'label'    => __( 'h4 Text Decoration', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''             => 'None',
				'line-through' => 'Line-through',
				'overline'     => 'Overline',
				'underline'    => 'Underline',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h4_text_style]',
		array(
			'default'    => trestle_get_option( 'h4_text_style' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h4_text_style_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h4_text_style]',
			'label'    => __( 'h4 Text Style', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''           => 'None',
				'capitalize' => 'Capitalize',
				'lowercase'  => 'Lowercase',
				'uppercase'  => 'Uppercase',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h5_font_size]',
		array(
			'default'    => trestle_get_option( 'h5_font_size' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h5_font_size_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h5_font_size]',
			'label'    => __( 'h5 Font Size', 'trestle' ),
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h5_text_decoration]',
		array(
			'default'    => trestle_get_option( 'h5_text_decoration' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h5_text_decoration_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h5_text_decoration]',
			'label'    => __( 'h5 Text Decoration', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''             => 'None',
				'line-through' => 'Line-through',
				'overline'     => 'Overline',
				'underline'    => 'Underline',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h5_text_style]',
		array(
			'default'    => trestle_get_option( 'h5_text_style' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h5_text_style_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h5_text_style]',
			'label'    => __( 'h5 Text Style', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''           => 'None',
				'capitalize' => 'Capitalize',
				'lowercase'  => 'Lowercase',
				'uppercase'  => 'Uppercase',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h6_font_size]',
		array(
			'default'    => trestle_get_option( 'h6_font_size' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h6_font_size_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h6_font_size]',
			'label'    => __( 'h6 Font Size', 'trestle' ),
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h6_text_decoration]',
		array(
			'default'    => trestle_get_option( 'h6_text_decoration' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h6_text_decoration_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h6_text_decoration]',
			'label'    => __( 'h6 Text Decoration', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''             => 'None',
				'line-through' => 'Line-through',
				'overline'     => 'Overline',
				'underline'    => 'Underline',
			)
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[h6_text_style]',
		array(
			'default'    => trestle_get_option( 'h6_text_style' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_h6_text_style_control',
		array(
			'section'  => 'trestle_text_fonts_section',
			'settings' => 'trestle-settings[h6_text_style]',
			'label'    => __( 'h6 Text Style', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''           => 'None',
				'capitalize' => 'Capitalize',
				'lowercase'  => 'Lowercase',
				'uppercase'  => 'Uppercase',
			)
		)
	);

	/**
	 *  Google Fonts Settings Section, controls and settings
	 */
	// Add the section.
	$wp_customize->add_section(
		'trestle_google_fonts_section',
		array(
			'title'    => __( 'Google Fonts', 'trestle' ),
			'priority' => 60,
			'panel'    => 'trestle_fonts_panel',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[google_font_code]',
		array(
			'default'    => trestle_get_option( 'google_font_code' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_google_font_code_control',
		array(
			'section'     => 'trestle_google_fonts_section',
			'settings'    => 'trestle-settings[google_font_code]',
			'label'       => __( 'Google Font Code', 'trestle' ),
			'description' => '<a target="_blank" href="http://themes.mightyminnow.com/trestle/google-font-styling-setup/">' . __( 'How do I setup Google fonts?' ) . '</a>',
		)
	);

	$wp_customize->add_setting(
		'trestle-settings[body_font_family]',
		array(
			'default'    => trestle_get_option( 'body_font_family' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);

	$wp_customize->add_control(
		'trestle_body_font_family_control',
		array(
			'section'  => 'trestle_google_fonts_section',
			'settings' => 'trestle-settings[body_font_family]',
			'label'    => __( 'Body Font Family Name', 'trestle' ),
		)
	);

	/**
	 * Site Layout Section (originally from Genesis).
	 */

	$wp_customize->add_setting(
		'trestle-settings[layout]',
		array(
			'default'    => trestle_get_option( 'layout' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_layout_control',
		array(
			'section'  => 'genesis_layout',
			'settings' => 'trestle-settings[layout]',
			'label'    => __( 'Layout', 'trestle' ),
			'type'     => 'radio',
			'choices'  => array(
				'bubble' => __( 'Bubble', 'trestle' ),
				'solid'  => __( 'Solid', 'trestle' ),
				'boxed'  => __( 'Boxed', 'trestle' ),
			)
		)
	);

	/**
	 * Trestle Settings Section.
	 */

	// Add the section.
	$wp_customize->add_section(
		'trestle_settings_section',
		array(
			'title'    => __( 'Trestle Settings', 'trestle' ),
			'priority' => 160,
		)
	);

	// Upload a logo.
	$wp_customize->add_setting(
		'trestle-settings[logo_id]',
		array(
			'default'           => trestle_get_option( 'logo_id' ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'trestle_logo_control',
			array(
				'label'     => __( 'Upload a logo', 'trestle' ),
				'section'   => 'trestle_settings_section',
				'settings'  => 'trestle-settings[logo_id]',
				'mime_type' => 'image',
			)
		)
	);

	// Upload a mobile logo.
	$wp_customize->add_setting(
		'trestle-settings[logo_id_mobile]',
		array(
			'default'           => trestle_get_option( 'logo_id_mobile' ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Media_Control(
			$wp_customize,
			'trestle_mobile_logo_control',
			array(
				'label'      => __( 'Upload a mobile logo', 'trestle' ),
				'section'    => 'trestle_settings_section',
				'settings'   => 'trestle-settings[logo_id_mobile]',
				'mime_type'  => 'image',
			)
		)
	);

	// Upload a mobile logo.
	$wp_customize->add_setting(
		'trestle-settings[favicon_url]',
		array(
			'default'           => trestle_get_option( 'favicon_url' ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'trestle_favicon_control',
			array(
				'label'    => __( 'Upload a favicon', 'trestle' ),
				'section'  => 'trestle_settings_section',
				'settings' => 'trestle-settings[favicon_url]',
			)
		)
	);

	// Logo position
	$wp_customize->add_setting(
		'trestle-settings[logo_position]',
		array(
			'default'    => trestle_get_option( 'logo_position' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_logo_position_control',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[logo_position]',
			'label'    => __( 'Logo Position', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				''   => __( 'Left', 'trestle' ),
				'center' => __( 'Center', 'trestle' ),
			)
		)
	);

	// Primary nav style.
	$wp_customize->add_setting(
		'trestle-settings[nav_primary_location]',
		array(
			'default'    => trestle_get_option( 'nav_primary_location' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_nav_primary_location_control',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[nav_primary_location]',
			'label'    => __( 'Menu style', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				'full'   => __( 'Full Width', 'trestle' ),
				'header' => __( 'Header Right', 'trestle' ),
				'center' => __( 'Center', 'trestle' ),
			)
		)
	);

	// Mobile nav toggle.
	$wp_customize->add_setting(
		'trestle-settings[mobile_nav_toggle]',
		array(
			'default'    => trestle_get_option( 'mobile_nav_toggle' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_mobile_nav_toggle_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[mobile_nav_toggle]',
			'label'     => __( 'Mobile Menu Toggle', 'trestle' ),
			'type'      => 'select',
			'choices'   => array(
				'small-icon'    => __( 'Small Icon', 'trestle' ),
				'big-button'    => __( 'Big Button', 'trestle' ),
			)
		)
	);

	// Primary nav extras.
	$wp_customize->add_setting(
		'trestle-settings[search_in_nav]',
		array(
			'default'    => trestle_get_option( 'search_in_nav' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_search_in_nav_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[search_in_nav]',
			'label'     => __( 'Add search to mobile navigation', 'trestle' ),
			'type'      => 'checkbox',
		)
	);

	// Fullscreen search
	$wp_customize->add_setting(
		'trestle-settings[fullscreen_search]',
		array(
			'default'    => trestle_get_option( 'fullscreen_search' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_fullscreen_search_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[fullscreen_search]',
			'label'     => __( 'Use full screen search?', 'trestle' ),
			'type'      => 'checkbox',
		)
	);

	// Blog post custom read more link text.
	$wp_customize->add_setting(
		'trestle-settings[read_more_text]',
		array(
			'default'           => trestle_get_option( 'read_more_text' ),
			'type'              => 'option',
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'wp_kses_post',
		)
	);
	$wp_customize->add_control(
		'trestle_read_more_text_control',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[read_more_text]',
			'label'    => __( 'Custom read more link text', 'trestle' ),
		)
	);

	// Post revisions number.
	$wp_customize->add_setting(
		'trestle-settings[revisions_number]',
		array(
			'default'    => trestle_get_option( 'revisions_number' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
			'sanitize_callback' => 'absint',
		)
	);
	$wp_customize->add_control(
		'trestle_revisions_number_control',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[revisions_number]',
			'label'    => __( 'Number of post revisions', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				'-1' => __( 'Unlimited', 'trestle' ),
				'0'  => '0',
				'1'  => '1',
				'2'  => '2',
				'3'  => '3',
				'4'  => '4',
				'5'  => '5',
				'6'  => '6',
				'7'  => '7',
				'8'  => '8',
				'9'  => '9',
				'10' => '10',
			)
		)
	);

	// Footer Widget Areas.
	$wp_customize->add_setting(
		'trestle-settings[footer_widgets_number]',
		array(
			'default'    => trestle_get_option( 'footer_widgets_number' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_footer_widgets_number_control',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[footer_widgets_number]',
			'label'    => __( 'Number of footer widgets', 'trestle' ),
			'type'     => 'select',
			'choices'  => array(
				'0' => '0',
				'1' => '1',
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
				'6' => '6',
			)
		)
	);

	// Add a label for the link icons.
	$wp_customize->add_setting(
		'trestle-settings[link_icons_title]',
		array(
			'default' => '',
			'type'    => 'option',
		)
	);
	$wp_customize->add_control(
		'trestle_link_icons_title',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[link_icons_title]',
			'label'    => __( 'Icon links', 'trestle' ),
			'type'     => 'hidden',
		)
	);

	// External Link Icons.
	$wp_customize->add_setting(
		'trestle-settings[external_link_icons]',
		array(
			'default'    => trestle_get_option( 'external_link_icons' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_external_link_icons',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[external_link_icons]',
			'label'    => __( 'Add icons to external links', 'trestle' ),
			'type'     => 'checkbox',
		)
	);

	// E-mail Link Icons.
	$wp_customize->add_setting(
		'trestle-settings[email_link_icons]',
		array(
			'default'    => trestle_get_option( 'email_link_icons' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_email_link_icons',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[email_link_icons]',
			'label'    => __( 'Add icons to email links', 'trestle' ),
			'type'     => 'checkbox',
		)
	);

	// PDF Link Icons.
	$wp_customize->add_setting(
		'trestle-settings[pdf_link_icons]',
		array(
			'default'    => trestle_get_option( 'pdf_link_icons' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_pdf_link_icons',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[pdf_link_icons]',
			'label'    => __( 'Add icons to .pdf links', 'trestle' ),
			'type'     => 'checkbox',
		)
	);

	// Doc Link Icons.
	$wp_customize->add_setting(
		'trestle-settings[doc_link_icons]',
		array(
			'default'    => trestle_get_option( 'doc_link_icons' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_doc_link_icons',
		array(
			'section'  => 'trestle_settings_section',
			'settings' => 'trestle-settings[doc_link_icons]',
			'label'    => __( 'Add icons to .doc links', 'trestle' ),
			'type'     => 'checkbox',
		)
	);

}
