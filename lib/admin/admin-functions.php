<?php
/**
 * Trestle admin functions
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

/**
 * Loads admin scripts and styles.
 *
 * @since 1.0.0
 */
function trestle_admin_actions() {
	// Add admin jQuery
	wp_enqueue_script( 'trestle-admin-jquery', get_stylesheet_directory_uri() . '/lib/admin/admin.js', array( 'jquery' ), '1.0.0', true );

	// Add admin jQuery
	wp_enqueue_style( 'trestle-admin', get_stylesheet_directory_uri() . '/lib/admin/admin.css' );

	// Add admin CSS
    add_editor_style( get_stylesheet_directory_uri() . '/lib/admin/editor-style.css' );
}

/**
 * Sets up Trestle default settings.
 *
 * @since 1.0.0
 *
 * @param array $defaults Genesis default settings.
 * @return array Genesis settings updated to include Trestle defaults.
 */
function trestle_custom_defaults( $defaults ) {
 	// Trestle default key/value pairs
 	$trestle_defaults = array(
		'trestle_layout' => 'solid',
		'trestle_auto_nav' => 0,
		'trestle_include_home_link' => 0,
		'trestle_home_link_text' => __( 'Home', 'trestle' ),
		'trestle_nav_button_text' => '[icon name="icon-list-ul"]  ' . __( 'Navigation', 'trestle' ),
		'trestle_read_more_text' => __( 'Read&nbsp;More&nbsp;&raquo;', 'trestle' ),
		'trestle_revisions_number' => 3,
		'trestle_equal_height_cols' => 1,
		'trestle_equal_cols_breakpoint' => 768,
	);

	// Populate Trestle settings with default values if they don't yet exist
	$options = get_option( GENESIS_SETTINGS_FIELD );

	foreach ( $trestle_defaults as $k => $v ) {
		// Add defaults to Genesis default settings array
		$defaults[$k] = $v;

		// Update actual options if they don't yet exist
		if ( $options && ! array_key_exists( $k, $options ) ) 
			$options[$k] = $v;
	}

	// Update options with defaults
	update_option( GENESIS_SETTINGS_FIELD, $options );
 					
	return $defaults;
}

/**
 * Adds sanitization for various Trestle admin settings.
 *
 * @since 1.0.0
 */
function trestle_register_social_sanitization_filters() {
	// 1 or 0
	genesis_add_option_filter( 
		'one_zero', 
		GENESIS_SETTINGS_FIELD,
		array(
			'trestle_auto_nav',
			'trestle_include_home_link',
			'trestle_custom_nav_extras',
			'trestle_manual_post_info_meta',
			'trestle_equal_height_cols',
			'trestle_external_link_icons',
			'trestle_email_link_icons',
			'trestle_pdf_link_icons',
			'trestle_doc_link_icons',
		)
	);

	// Integer
	genesis_add_option_filter( 
		'absint', 
		GENESIS_SETTINGS_FIELD,
		array(
			'trestle_revisions_number',
			'trestle_footer_widgets_number',
			'trestle_equal_cols_breakpoint',
		)
	);

	// No HTML
	genesis_add_option_filter( 
		'no_html', 
		GENESIS_SETTINGS_FIELD,
		array(
			'trestle_layout',
		)
	);

	// Safe HTML
	genesis_add_option_filter( 
		'safe_html', 
		GENESIS_SETTINGS_FIELD,
		array(
			'trestle_home_link_text',
			'trestle_nav_button_text',
			'trestle_custom_nav_extras_text',
			'trestle_read_more_text'
		)
	);
}
 
/**
 * Registers Trestle admin settings box.
 *
 * @since 1.0.0
 *
 * @global array $_genesis_admin_settings Genesis admin settings.
 *
 * @param string $_genesis_theme_settings_pagehook Hook for main Genesis settings page in admin.
 */
function trestle_register_settings_box( $_genesis_theme_settings_pagehook ) {
	global $_genesis_admin_settings;

    // Create Trestle settings metabox
    $settings_box_title = __( 'Trestle Settings <small>by</small>', 'trestle' ) . ' <a href="http://mightyminnow.com" target="_blank">MIGHTYminnow</a>';
	add_meta_box( 'trestle-settings', $settings_box_title, 'trestle_settings_box', $_genesis_theme_settings_pagehook, 'main', 'high' );
}

/**
 * Outputs contents of Trestle admin settings box on Genesis settings page.
 *
 * @since 1.0.0
 */
function trestle_settings_box() {
	// Set path for image radio inputs
	$img_path = get_stylesheet_directory_uri() . '/images/admin/';

	?>
	<h4><?php _e( 'Layout', 'trestle' ) ?></h4>
	<p class="trestle-layout">
		<img src="<?php echo $img_path; ?>icon-solid.gif" width="200" height="160" <?php echo 'solid' == genesis_get_option( 'trestle_layout' ) ? 'class="checked"' : '' ?> />
		<input type="radio" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_layout]" value="solid" <?php checked( esc_attr( genesis_get_option( 'trestle_layout' ) ), 'solid' ); ?> />
		<img src="<?php echo $img_path; ?>icon-bubble.gif" width="200" height="160" <?php echo 'bubble' == genesis_get_option( 'trestle_layout' ) ? 'class="checked"' : '' ?> />
		<input type="radio" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_layout]" value="bubble" <?php checked( esc_attr( genesis_get_option( 'trestle_layout' ) ), 'bubble' ); ?> />
	</p>
	
	<h4><?php _e( 'Primary Navigation', 'trestle' ) ?></h4>
	<p>
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_auto_nav' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_auto_nav]"><?php _e( 'Automatically generate nav menu (replaces custom/manual menu with auto-generated menu)', 'trestle' ); ?></label><br />
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_include_home_link' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_include_home_link]"><?php _e( 'Include home link', 'trestle' ); ?></label>
	</p>
	
	<p>
		<?php _e( 'Home link text (shortcodes can be included):', 'trestle' ); ?></label><br />
		<input class="widefat" type="text" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_home_link_text]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_home_link_text]" value="<?php echo esc_attr( genesis_get_option( 'trestle_home_link_text' ) ); ?>" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_home_link_text]">
	</p>
	
	<p>
		<?php _e( 'Text for mobile navigation button (shortcodes can be included):', 'trestle' ); ?></label><br />
		<input class="widefat" type="text" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]" value="<?php echo esc_attr( genesis_get_option( 'trestle_nav_button_text' ) ); ?>" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_nav_button_text]">
	</p>
	
	<h4><?php _e( 'Primary Navigation Extras', 'trestle' ) ?></h4>
	<p><input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_custom_nav_extras]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_custom_nav_extras]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_custom_nav_extras' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_custom_nav_extras]"><?php _e( 'Display custom navigation extras content (overrides standard Genesis navigation extras)', 'trestle' ); ?></label></p>
	<p>
		<?php _e( 'Custom navigation extras text:', 'trestle' ); ?><br />
		<input class="widefat" type="text" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_custom_nav_extras_text]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_custom_nav_extras_text]" value="<?php echo esc_attr( genesis_get_option( 'trestle_custom_nav_extras_text' ) ); ?>" /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_custom_nav_extras_text]">
	</p>
	
	<h4><?php _e( 'Blog/Posts', 'trestle' ) ?></h4>
	<p>
		<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_read_more_text]"><?php _e( 'Custom read more link text', 'trestle' ); ?></label>: <input type="text" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_read_more_text]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_read_more_text]" value="<?php echo esc_attr( genesis_get_option( 'trestle_read_more_text' ) ); ?>" />
	</p>
	<p>
		<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_revisions_number]"><?php _e( 'Number of post revisions', 'trestle' ) ?>: </label>
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_revisions_number]" />
			<option value="-1" <?php selected( esc_attr( genesis_get_option( 'trestle_revisions_number' ) ), '-1' ); ?> >Unlimited</option>
			<?php
				for( $i=0; $i<=10; $i++ ) {
					echo '<option value="' . $i . '" ' . selected( esc_attr( genesis_get_option( 'trestle_revisions_number' ) ), $i, false ) . '>' . $i . '</option>' . "\n";
				}
			?>
		</select>
	</p>
	
	<h4><?php _e( 'Post Info & Meta', 'trestle' ) ?></h4>
	<p><input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_manual_post_info_meta]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_manual_post_info_meta]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_manual_post_info_meta' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_manual_post_info_meta]"><?php _e( 'Manually select where to show Post Info & Meta', 'trestle' ); ?></label></p>
	<div class="trestle-post-info-meta">
		<div class="one-half first">
			<b><?php _e( 'Show Post Info on:', 'trestle' ) ?></b>
				<?php
				$post_types = get_post_types();
				foreach ( $post_types as $post_type ) {
					$post_type_object = get_post_type_object( $post_type );
					$name = $post_type_object->labels->name;
					$slug = $post_type_object->name;
				?>
				<hr />
				<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_info_<?php echo $slug ?>_single]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_info_<?php echo $slug ?>_single]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_post_info_' . $slug . '_single' ) ), 1); ?> /> 
				<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_info_<?php echo $slug ?>_single]"><?php printf( __( '%s (single)', 'trestle' ), $name ); ?></label><br />

				<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_info_<?php echo $slug ?>_archive]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_info_<?php echo $slug ?>_archive]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_post_info_' . $slug . '_archive' ) ), 1); ?> /> 
				<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_info_<?php echo $slug ?>_archive]"><?php printf( __( '%s (archive)', 'trestle' ), $name ); ?></label>
				<?php
				}
				?>
			<br /><br />
		</div>
		<div class="one-half">
			<b><?php _e( 'Show Post Meta on:', 'trestle' ) ?></b>
				<?php
				$post_types = get_post_types();
				foreach ( $post_types as $post_type ) {
					$post_type_object = get_post_type_object( $post_type );
					$name = $post_type_object->labels->name;
					$slug = $post_type_object->name;
				?>
				<hr />
				<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_meta_<?php echo $slug ?>_single]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_meta_<?php echo $slug ?>_single]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_post_meta_' . $slug . '_single' ) ), 1); ?> /> 
				<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_meta_<?php echo $slug ?>_single]"><?php printf( __( '%s (single)', 'trestle' ), $name ); ?></label><br />

				<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_meta_<?php echo $slug ?>_archive]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_meta_<?php echo $slug ?>_archive]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_post_meta_' . $slug . '_archive' ) ), 1); ?> /> 
				<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_post_meta_<?php echo $slug ?>_archive]"><?php printf( __( '%s (archive)', 'trestle' ), $name ); ?></label>
				<?php
				}
				?>
			<br /><br />
		</div>
	</div>
			
	<h4><?php _e( 'Footer Widgets', 'trestle' ) ?></h4>
	<p class="trestle-layout">
		<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_footer_widgets_number]"><?php _e( 'Number', 'trestle' ); ?>: </label>
		<select name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_footer_widgets_number]" />
			<?php
				for( $i=0; $i<=6; $i++ ) {
					echo '<option value="' . $i . '" ' . selected( esc_attr( genesis_get_option( 'trestle_footer_widgets_number' ) ), $i, false ) . '>' . $i . '</option>' . "\n";
				}
			?>
		</select>
	</p>

	<h4><?php _e( 'Genesis Extender Plugin', 'trestle' ) ?></h4>
	<p>
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_equal_height_cols]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_equal_height_cols]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_equal_height_cols' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_equal_height_cols]"><?php _e( 'Automatically equalize height of Genesis Extender homepage columns', 'trestle' ); ?></label>
	</p>
	<p class="trestle-equal-columns-breakpoint">
		<label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_equal_cols_breakpoint]"><?php _e( 'Implement at', 'trestle' ); ?></label> <input type="text" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_equal_cols_breakpoint]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_equal_cols_breakpoint]" value="<?php echo esc_attr( genesis_get_option( 'trestle_equal_cols_breakpoint' ) ); ?>" size="4"/>px&nbsp;<?php _e( 'and wider (should match main CSS breakpoint)', 'trestle' ); ?>
	</p>

	<h4><?php _e( 'Link Icons', 'trestle' ) ?></h4>
	<p>
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_external_link_icons]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_external_link_icons]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_external_link_icons' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_external_link_icons]"><?php _e( 'Add icons to external links', 'trestle' ); ?></label><br />
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_email_link_icons]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_email_link_icons]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_email_link_icons' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_email_link_icons]"><?php _e( 'Add icons to email links', 'trestle' ); ?></label><br />
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_pdf_link_icons]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_pdf_link_icons]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_pdf_link_icons' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_pdf_link_icons]"><?php _e( 'Add icons to .pdf links', 'trestle' ); ?></label><br />
		<input type="checkbox" id="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_document_link_icons]" name="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_doc_link_icons]" value="1" <?php checked( esc_attr( genesis_get_option( 'trestle_doc_link_icons' ) ), 1); ?> /> <label for="<?php echo GENESIS_SETTINGS_FIELD; ?>[trestle_document_link_icons]"><?php _e( 'Add icons to .doc links', 'trestle' ); ?></label>
	</p>
	<?php
}

/**
 * Loads required & recommended plugins.
 *
 * Utilizes TGM Plugin Activation class: 
 * https://github.com/thomasgriffin/TGM-Plugin-Activation
 *
 * @since 1.0.0
 *
 * @see tgmpa() in /lib/classes/class-tgm-plugin-activation.php
 */
function trestle_register_required_plugins() {
	$plugins = array(
		// Required plugins
		array(
			'name' 		=> 'Better Font Awesome',
			'slug' 		=> 'better-font-awesome',
			'required' 	=> true,
		),

		array(
			'name' 		=> 'Respond.js',
			'slug' 		=> 'respondjs',
			'required' 	=> true,
		),

		// Optional plugins
		array(
			'name' 		=> 'Black Studio TinyMCE Widget',
			'slug' 		=> 'black-studio-tinymce-widget',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Events Manager',
			'slug' 		=> 'events-manager',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Exclude Pages',
			'slug' 		=> 'exclude-pages',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Facebook Open Graph Meta Tags for WordPress',
			'slug' 		=> 'wonderm00ns-simple-facebook-open-graph-tags',
			'required'  => false,
		),

		array(
			'name' 		=> 'FancyBox for WordPress',
			'slug' 		=> 'fancybox-for-wordpress',
			'required'  => false,
		),

		array(
			'name' 		=> 'Genesis Featured Widget Amplified',
			'slug' 		=> 'genesis-featured-widget-amplified',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Genesis Simple Edits',
			'slug' 		=> 'genesis-simple-edits',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Google Analytics for WordPress',
			'slug' 		=> 'google-analytics-for-wordpress',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Jetpack by WordPress.com',
			'slug' 		=> 'jetpack',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'MapPress Easy Google Maps',
			'slug' 		=> 'mappress-google-maps-for-wordpress',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'My Page Order',
			'slug' 		=> 'my-page-order',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'NextGen Gallery',
			'slug' 		=> 'nextgen-gallery',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Post Thumbnail Editor',
			'slug' 		=> 'post-thumbnail-editor',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Post Types Order',
			'slug' 		=> 'post-types-order',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Responsive Video Embeds',
			'slug' 		=> 'responsive-video-embeds',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Social Media Widget',
			'slug' 		=> 'social-media-widget',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Widget Context',
			'slug' 		=> 'widget-context',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Simple Image Sizes',
			'slug' 		=> 'simple-image-sizes',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Simple Section Navigation',
			'slug' 		=> 'simple-section-navigation',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'Types - Custom Fields and Custom Post Types Management',
			'slug' 		=> 'types',
			'required' 	=> false,
		),

		array(
			'name' 		=> 'WP Hotkeys',
			'slug' 		=> 'wp-hotkeys',
			'required' 	=> false,
		),
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'mightyminnow';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'Recommended plugin: %1$s.', 'Recommended plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa( $plugins, $config );
}