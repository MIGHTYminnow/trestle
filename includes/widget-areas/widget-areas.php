<?php

/**
 * Trestle widget area registration and functionality.
 *
 * @since  1.0.0
 *
 * @package Trestle
 */

//add_action( 'widgets_init', 'trestle_register_widget_areas' );
/**
 * Register custom widget areas.
 *
 * @since 1.0.0
 */
function trestle_register_widget_areas() {
	genesis_register_widget_area( array(
		'id'            => 'sample-widget-area',
		'name'          => __( 'Sample Widget Area', 'trestle' ),
		'description'   => __( 'This is the sample widget area', 'trestle' ),
	) );
}

//add_action( 'genesis_header', 'trestle_output_sample_widget_area' );
/**
 * Output sample widget area.
 *
 * @since  1.2.0
 */
function trestle_output_sample_widget_area() {
	genesis_widget_area( 'sample-widget-area', array(
		'before' => '<aside class="sample-widget-area widget-area">',
		'after' => '</aside>',
	) );
}