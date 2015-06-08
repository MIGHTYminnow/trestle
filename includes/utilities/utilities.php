<?php
/**
 * Development utility functions.
 *
 * @since  2.1.0
 *
 * @package Trestle
 */

/**
 * Custom logging function for development purposes.
 */
function trestle_log( $log )  {
    if ( true === WP_DEBUG ) {
        if ( is_array( $log ) || is_object( $log ) ) {
            error_log( print_r( $log, true ) );
        } else {
            error_log( $log );
        }
    }
}