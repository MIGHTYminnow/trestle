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
function trestle_shortcode_empty_paragraph_fix($content)
{   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);

    return $content;
}
add_filter('the_content', 'trestle_shortcode_empty_paragraph_fix');

/**
 * Columns
 * 
 * Example:
 * [col class="one-half first no-list-margin"] Contents [/col]
 *
 * Classes:
 *     - width (one-half, one-third, etc - uses native Genesis column classes in style.css)
 *     - first (used to specify the first column in a row)
 *     - no-list-margin (will cause contained list elements to collapse as one on mobile sizes)
 */
function trestle_column( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'class' => '',
    ), $atts ) );
    return '<div class="col ' . $class . '">' . do_shortcode( $content ) . '</div>';
}
add_shortcode( 'col', 'trestle_column' );

/**
 * Buttons
 * 
 * Example:
 * [button href="url" class="class"]Text[/button]
 */
function trestle_button( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'href' => '#',
        'class' => '',
    ), $atts ) );
    return '<a class="button ' . $class . '" href="' . $href . '">' . do_shortcode( $content ) . '</a>';
}
add_shortcode( 'button', 'trestle_button' );

/**
 * Blockquote
 * 
 * Example:
 * [blockquote name="Speaker" sub_text="Position, Company"]Contents[/blockquote]
 */
function trestle_blockquote( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'name' => '',
        'sub_text' => '',
    ), $atts ) );
    
    $sub_text_html = $sub_text ? '<em>' . $sub_text . '</em>' : '';
    $cite = $name ? '<cite>' . $name . $sub_text_html . '</cite>' : '';

    return '<blockquote><p>' . $content . $cite . '</p></blockquote>';
}
add_shortcode( 'blockquote', 'trestle_blockquote' );