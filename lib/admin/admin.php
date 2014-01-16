<?php
/**
 * Trestle admin functionality
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

// Require admin functions
require_once dirname( __FILE__ ) . '/admin-functions.php';

// Trestle admin scripts and styles
add_action( 'admin_enqueue_scripts', 'trestle_admin_actions' );

// Trestle default settings
add_filter( 'genesis_theme_settings_defaults', 'trestle_custom_defaults' );

// Sanitize settings
add_action( 'genesis_settings_sanitizer_init', 'trestle_register_social_sanitization_filters' );
 
// Register Trestle settings metabox
add_action( 'genesis_theme_settings_metaboxes', 'trestle_register_settings_box' );

// Required & recommended plugins
add_action( 'tgmpa_register', 'trestle_register_required_plugins' );