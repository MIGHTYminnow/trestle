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

	// Disable Accessibility
	$wp_customize->add_setting(
		'trestle-settings[disable_trestle_accessiblity]',
		array(
			'default'    => trestle_get_option( 'disable_trestle_accessiblity' ),
			'type'       => 'option',
			'capability' => 'edit_theme_options',
		)
	);
	$wp_customize->add_control(
		'trestle_accessibility_control',
		array(
			'section'   => 'trestle_settings_section',
			'settings'  => 'trestle-settings[disable_trestle_accessiblity]',
			'label'     => __( 'Disable Trestle Accessiblity Enhancements?', 'trestle' ),
			'type'      => 'checkbox',
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
