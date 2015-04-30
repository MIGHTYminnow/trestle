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

add_filter('the_content', 'trestle_shortcode_empty_paragraph_fix');
/**
 * Fix for empty <p> tags around shortcodes
 *
 * @since  1.0.0
 *
 * @param   string  $content  HTML content.
 *
 * @return  string            Updated content.
 */
function trestle_shortcode_empty_paragraph_fix( $content ) {
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
        );

    $content = strtr($content, $array);

    return $content;
}

add_shortcode( 'col', 'trestle_column' );
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
 *
 * @param   array  $atts  Shortcode attributes.
 *
 * @return  string        Shortcode output.
 */
function trestle_column( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'class' => '',
        ), $atts ) );
    return '<div class="col ' . $class . '">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'button', 'trestle_button' );
/**
 * Button
 *
 * Example: [button href="url" title="title" target="target" class="class"]Text[/button]
 *
 * @param   array  $atts  Shortcode attributes.
 *
 * @return  string        Shortcode output.
 */
function trestle_button( $atts, $content = null ) {
    extract( shortcode_atts( array(
        'href' => '#',
        'target' => '',
        'title' => '',
        'class' => '',
        ), $atts ) );
    return '<a class="button ' . $class . '" href="' . $href . '" title="' . $title . '" target="' . $target . '">' . do_shortcode( $content ) . '</a>';
}

add_shortcode( 'date', 'trestle_date' );
/**
 * Date
 *
 * Example: [date format="M d, Y"]
 *
 * @param   array  $atts  Shortcode attributes.
 *
 * @return  string        Shortcode output.
 */
function trestle_date( $atts ) {
    extract( shortcode_atts( array(
        'format' => 'M d, Y',
    ), $atts ) );

    if ( ! $format ) {
        $format = 'M d, Y';
    }

    return date( $format );
}

add_shortcode( 'blockquote', 'trestle_blockquote_shortcode' );
/**
 * Blockquote
 *
 * Example: [blockquote citation=""]Content[/blockquote]
 *
 * @since   1.2.0
 *
 * @param   array  $atts  Shortcode attributes.
 *
 * @return  string        Shortcode output.
 */
function trestle_blockquote_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'citation'      => '',
    ), $atts );

    ob_start(); ?>

        <blockquote>

        <?php if ( $content ) : ?>
            <?php echo $content; ?>
        <?php endif; ?>

        <?php if ( $atts['citation'] ) : ?>
            <cite>- <?php echo $atts['citation']; ?></cite>
        <?php endif; ?>

        </blockquote>

    <?php

    $output = ob_get_clean();

    return $output;
}
