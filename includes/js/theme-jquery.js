/**
 * Trestle theme jQuery
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

// Executes when the document is ready
jQuery( document ).ready( function( $ ) {

	// Get PHP vars passed via wp_localize_script()
	trestleEqualColsBreakpoint = trestle_vars.trestle_equal_cols_breakpoint;
	trestleEqualHeightCols = trestle_vars.trestle_equal_height_cols;

	// Remove .no-jquery body class
	$( 'body' ).removeClass( 'no-jquery' );

	// External Links
	var h = window.location.host.toLowerCase();
	$( '[href^="http"]' ).not( '[href*="' + h + '"]' ).addClass( 'external-link' ).attr( "target", "_blank" );

	// Add classes to different types of links
	$( 'a[href^="mailto:"]' ).addClass( 'email-link' );
	$( 'a[href*=".pdf"]' ).attr({ "target":"_blank" }).addClass( 'pdf-link' );
	$( 'a[href*=".doc"]' ).attr({ "target":"_blank" }).addClass( 'doc-link' );
	$( 'a' ).has( 'img' ).addClass( 'image-link' );

	// Add classes to parts of lists
	$( 'li:last-child' ).addClass( 'last' );
	$( 'li:first-child' ).addClass( 'first' );
	$( 'ul, ol' ).parent( 'li' ).addClass( 'parent' );

	// Mobile header toggle buttons
	$( '.site-header .title-area' ).after( '<div class="toggle-buttons" />' );
	$( '.site-header .widget-area, .nav-primary' ).each( function( i ) {
		var $target = $( this );
		var buttonClass = 'toggle-button';

        // Add classes of target element
        var targetClass = $target.attr( 'class' ).split( /\s+/ );
        $.each( targetClass, function( index, value ) {
        	buttonClass += ' targets-' + value;
        });

        if ( $( this ).is( 'nav' ) ) {
        	buttonClass += ' nav-toggle';
        }

        // Add toggle buttons to header
        $( '.toggle-buttons' ).prepend( '<a id="toggle-button-' + i + '" class="' + buttonClass + '" href="#">Toggle</a>' );

        // Add target class to nav and widget areas
        $target.addClass( 'toggle-target-' + i );
    });

    // Toggle widget areas and primary nav
    $( '.site-header .toggle-button' ).click( function( event ) {
    	event.preventDefault();

    	var $button = $( this );
    	var $target = $( '.toggle-target-' + $button.attr( 'id' ).match( /\d+/ ) );

        // Toggle buttons
        $button.toggleClass( 'open' );
        $( '.site-header .toggle-button' ).not( $button ).removeClass( 'open' );

        // Toggle targets
        $target.toggleClass( 'open' );
        $( '[class*="toggle-target"]' ).not( $target ).removeClass( 'open' );
    });

    // Mobile navigation icons
    var closedIcon = '+';
    var openIcon = '-';

    $( '.nav-primary' )
    	.find( '.genesis-nav-menu .parent:not(.current-menu-item, .current_page_item, .current_page_parent, .current_page_ancestor) > a' )
    	.after( '<a class="sub-icon" href="#">' + closedIcon + '</a>' );
    $( '.nav-primary' )
    	.find( '.genesis-nav-menu .parent.current-menu-item > a, .genesis-nav-menu .parent.current_page_item > a, .genesis-nav-menu .parent.current_page_parent > a, .genesis-nav-menu .parent.current_page_ancestor > a' )
    	.after( '<a class="sub-icon" href="#">' + openIcon + '</a>' );

    // Mobile navigation expand/contract functionality
    $( '.sub-icon' ).click( function( event ) {
    	event.preventDefault();
    	var $icon = $( this );
    	$icon.next( 'ul' ).slideToggle().toggleClass( 'open' );
    	if ( $icon.text().indexOf( closedIcon ) !== -1 )
    		$icon.text( openIcon );
    	else if ( $icon.text().indexOf( openIcon ) !== -1 )
    		$icon.text( closedIcon );
    });

    $( '.widget-area-toggle' ).click( function( event ) {
    	event.preventDefault();
    	var $button = $( this );
    	$button.toggleClass( 'open' );
    	$button.next( '.widget-area' ).slideToggle();
    });

    // Executes when complete page is fully loaded, including all frames, objects, and images
    $( window ).on( 'load', function() {

        // Equal height homepage cols
        $( '.equal-height-genesis-extender-cols .ez-home-container-area' ).each( function() {
            $( this ).children( '.widget-area' ).equalHeights( null, null, trestleEqualColsBreakpoint );
        });

    });

}); /* end of page load scripts */


/**
 * Equal Heights Plugin
 *
 * Equalize the heights of elements. Great for columns or any elements
 * that need to be the same size (floats, etc).
 *
 * Based on Rob Glazebrook's (cssnewbie.com) script
 *
 * Additions
 *  - ability to include a break point (the minimum viewport width at which the script does anything)
 *  - binds the script to run on load, orientation change (for mobile), and when resizing the window
 *
 * Usage: jQuery(object).equalHeights([minHeight], [maxHeight], [breakPoint]);
 *
 * Example 1: jQuery( ".cols" ).equalHeights(); Sets all columns to the same height.
 * Example 2: jQuery( ".cols" ).equalHeights( 400 ); Sets all cols to at least 400px tall.
 * Example 3: jQuery( ".cols" ).equalHeights( 100, 300 ); Cols are at least 100 but no more
 * than 300 pixels tall. Elements with too much content will gain a scrollbar.
 * Example 4: jQuery( ".cols" ).equalHeights( null, null,768 ); Only resize columns above 768px viewport
 *
 */
( function( $ ) {

    $.fn.equalHeights = function( minHeight, maxHeight, breakPoint ) {

        /**
         * Unbind all plugin events so that we can call this function again
         * to reset it without creating multiple handlers for the same events.
         * This allows us to manually retrigger if we have added new elements
         * into the DOM using ajax or .clone().
         */
        $( window ).off( '.equalheights', doEqualHeights );

        // Scope our local variables
        var $items, breakPoint;

        // Store the jQuery objects upon which this function has been called
        $items = this;

        // Store the breakPoint arg if it was passsed in
        breakPoint = breakPoint || 0;

        // Actual logic for this plugin
        function doEqualHeights( $items ) {

            // Calculate the tallest
            tallest = ( minHeight ) ? minHeight : 0;
            $items.each( function() {
                $( this ).height( 'auto' );
                if( $( this ).outerHeight() > tallest ) {
                    tallest = $( this ).outerHeight();
                }
            });

            // Get viewport width (taking scrollbars into account)
            var e = window;
            a = 'inner';
            if ( !( 'innerWidth' in window ) ) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            width = e[ a+'Width' ];

            // Equalize heights if viewport width is above the specified breakpoint
            if ( width >= breakPoint ) {
                if( ( maxHeight ) && tallest > maxHeight ) tallest = maxHeight;
                return $items.each( function() {
                    $( this ).height( tallest );
                });
            }
        }

        // Trigger the main plugin function
        doEqualHeights( $items );

        // Attach doEqualHeights as an event handler to the window resize events
        // We're using $.proxy() to pass in the right $items to keep our context correct
        $( window ).on( 'orientationchange.equalheights resize.equalheights equalheights.equalheights', $.proxy( doEqualHeights, null, $items ) );

    }

})( jQuery );
