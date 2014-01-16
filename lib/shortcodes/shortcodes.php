<?php 
/**
 * Trestle shortcodes
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

/*===========================================
 * Shortcodes
===========================================*/

// Fix for empty <p> tags around shortcodes
function shortcode_empty_paragraph_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

    return $content;
}
add_filter('the_content', 'shortcode_empty_paragraph_fix');

/**
 * Columns - [col class="one-half first no-list-margin"]
 *
 * Classes:
 *     - width (one-half, one-third, etc - uses native Genesis column classes in style.css)
 *     - first (used to specify the first column in a row)
 *     - no-list-margin (will cause contained list elements to collapse as one on mobile sizes)
 */
function column( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'class' => 'one-half',
    ), $atts ) );
    return '<div class="col ' . $class . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'col', 'column' );