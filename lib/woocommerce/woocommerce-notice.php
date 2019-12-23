<?php
/**
 * Academy Pro.
 *
 * This file adds the Genesis Connect for WooCommerce notice to the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */

add_action( 'admin_print_styles', 'academy_remove_woocommerce_notice' );
/**
 * Removes the default WooCommerce Notice.
 *
 * @since 1.0.0
 */
function academy_remove_woocommerce_notice() {

	// If below version WooCommerce 2.3.0, exits early.
	if ( ! class_exists( 'WC_Admin_Notices' ) ) {
		return;
	}

	WC_Admin_Notices::remove_notice( 'theme_support' );

}

add_action( 'admin_notices', 'academy_woocommerce_theme_notice' );
/**
 * Adds a prompt to activate Genesis Connect for WooCommerce
 * if WooCommerce is active but Genesis Connect is not.
 *
 * @since 1.0.0
 */
function academy_woocommerce_theme_notice() {

	// If WooCommerce isn't active or Genesis Connect is active, exits early.
	if ( ! class_exists( 'WooCommerce' ) || function_exists( 'gencwooc_setup' ) ) {
		return;
	}

	// If user doesn't have access, exits early.
	if ( ! current_user_can( 'manage_woocommerce' ) ) {
		return;
	}

	// If message dismissed, exits early.
	if ( get_user_option( 'academy_woocommerce_message_dismissed', get_current_user_id() ) ) {
		return;
	}

	/* translators: %s: child theme name */
	$notice_html = sprintf( __( 'Please install and activate <a href="https://wordpress.org/plugins/genesis-connect-woocommerce/" target="_blank">Genesis Connect for WooCommerce</a> to <strong>enable WooCommerce support for %s</strong>.', 'academy-pro' ), esc_html( CHILD_THEME_NAME ) );

	if ( current_user_can( 'install_plugins' ) ) {
		$plugin_slug  = 'genesis-connect-woocommerce';
		$admin_url    = network_admin_url( 'update.php' );
		$install_link = sprintf(
			'<a href="%s">%s</a>', wp_nonce_url(
				add_query_arg(
					array(
						'action' => 'install-plugin',
						'plugin' => $plugin_slug,
					),
					$admin_url
				),
				'install-plugin_' . $plugin_slug
			), __( 'install and activate Genesis Connect for WooCommerce', 'academy-pro' )
		);

		/* translators: 1: plugin install prompt presented as link, 2: child theme name */
		$notice_html = sprintf( __( 'Please %1$s to <strong>enable WooCommerce support for %2$s</strong>.', 'academy-pro' ), $install_link, esc_html( CHILD_THEME_NAME ) );
	}

	echo '<div class="notice notice-info is-dismissible academy-woocommerce-notice"><p>' . $notice_html . '</p></div>';

}

add_action( 'wp_ajax_academy_dismiss_woocommerce_notice', 'academy_dismiss_woocommerce_notice' );
/**
 * Adds option to dismiss Genesis Connect for Woocommerce plugin install prompt.
 *
 * @since 1.0.0
 */
function academy_dismiss_woocommerce_notice() {

	update_user_option( get_current_user_id(), 'academy_woocommerce_message_dismissed', 1 );

}

add_action( 'admin_enqueue_scripts', 'academy_notice_script' );
/**
 * Enqueues script to clear the Genesis Connect for WooCommerce plugin install prompt on dismissal.
 *
 * @since 1.0.0
 */
function academy_notice_script() {

	wp_enqueue_script( 'academy_notice_script', get_stylesheet_directory_uri() . '/lib/woocommerce/js/notice-update.js', array( 'jquery' ), '1.0', true );

}

add_action( 'switch_theme', 'academy_reset_woocommerce_notice', 10, 2 );
/**
 * Clears the Genesis Connect for WooCommerce plugin install prompt on theme change.
 *
 * @since 1.0.0
 */
function academy_reset_woocommerce_notice() {

	global $wpdb;

	$args = array(
		'meta_key'   => $wpdb->prefix . 'academy_woocommerce_message_dismissed',
		'meta_value' => 1,
	);

	$users = get_users( $args );

	foreach ( $users as $user ) {
		delete_user_option( $user->ID, 'academy_woocommerce_message_dismissed' );
	}

}

add_action( 'deactivated_plugin', 'academy_reset_woocommerce_notice_on_deactivation', 10, 2 );
/**
 * Clears the Genesis Connect for WooCommerce plugin prompt on deactivation.
 *
 * @since 1.0.0
 *
 * @param string $plugin               Path to the main plugin file from plugins directory.
 * @param bool   $network_deactivating Whether the plugin is deactivated for all sites in the network.
 *                                     or just the current site. Multisite only. Default false.
 */
function academy_reset_woocommerce_notice_on_deactivation( $plugin, $network_deactivating ) {

	// Conditional checks to see if we're deactivating WooCommerce or Genesis Connect for WooCommerce.
	if ( 'woocommerce/woocommerce.php' !== $plugin && 'genesis-connect-woocommerce/genesis-connect-woocommerce.php' !== $plugin ) {
		return;
	}

	academy_reset_woocommerce_notice();

}
