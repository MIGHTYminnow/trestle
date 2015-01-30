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
	$( 'a[href$=".pdf"]' ).attr({ "target":"_blank" }).addClass( 'pdf-link' );
	$( 'a[href$=".doc"]' ).attr({ "target":"_blank" }).addClass( 'doc-link' );
	$( 'a' ).has( 'img' ).addClass( 'image-link' );

	// Add classes to parts of lists
	$( 'li:last-child' ).addClass( 'last' );
	$( 'li:first-child' ).addClass( 'first' );
	$( 'ul, ol' ).parent( 'li' ).addClass( 'parent' );

	// Mobile header toggle buttons
	$( '.site-header .title-area' ).after( '<div class="toggle-buttons" />' );
	$( '.site-header .widget-area, .nav-primary' ).each( function( i ) {

        // Store target
        $target = $( this );

        // Scope variables
        var $target, buttonClass, targetClass;

        // Setup classes
        buttonClass = 'toggle-button';
        targetClass = $target.attr( 'class' ).split( /\s+/ );

        // Add targets-[] class to buttonClass
        $.each( targetClass, function( index, value ) {
        	buttonClass += ' targets-' + value;
        });

        // Add nav-toggle class to buttonClass if the button is for the nav
        if ( $target.is( 'nav' ) ) {
        	buttonClass += ' nav-toggle';
        }

        // Add toggle buttons to header
        $( '.toggle-buttons' ).prepend( '<a id="toggle-button-' + i + '" class="' + buttonClass + '" href="#">Toggle</a>' );

        // Add target class to nav and widget areas
        $target.addClass( 'toggle-target-' + i );
    });

    // Toggle widget areas and primary nav
    $( '.site-header .toggle-button' ).click( function( event ) {

        // Prevent default behavior
    	event.preventDefault();

        // Scope our variables
        var $button, $target;

        // Get toggle button that was clicked
    	$button = $( this );

    	//Remove focus
    	$button.blur();

        // Match the button to the right target
    	$target = $( '.toggle-target-' + $button.attr( 'id' ).match( /\d+/ ) );

        // Toggle buttons
        $button.toggleClass( 'open' );
        $( '.site-header .toggle-button' ).not( $button ).removeClass( 'open' );

        // Toggle targets
        $target.toggleClass( 'open' );
        $( '[class^="toggle-target"]' ).not( $target ).removeClass( 'open' );
    });

    // Mobile navigation icons
    var closedIcon = '+';
    var openIcon = '-';

    // Insert the icons into the nav where appropriate
    $( '.nav-primary' ).find( '.genesis-nav-menu .parent:not( .current-menu-item, .current_page_item, .current_page_parent, .current_page_ancestor) > a' ).after( '<a class="sub-icon" href="#">' + closedIcon + '</a>' );
    $( '.nav-primary' ).find( '.genesis-nav-menu .parent.current-menu-item > a, .genesis-nav-menu .parent.current_page_item > a, .genesis-nav-menu .parent.current_page_parent > a, .genesis-nav-menu .parent.current_page_ancestor > a' ).after( '<a class="sub-icon" href="#">' + openIcon + '</a>' );

    // Mobile navigation expand/contract functionality
    $( '.sub-icon' ).click( function( event ) {

    	// Prevent default behavior
    	event.preventDefault();

    	// Get icon click
    	var $icon = $( this );

    	// Remove focus
    	$icon.blur();

        // Expand/contract
    	$icon.next( 'ul' ).slideToggle().toggleClass( 'open' );

        // Change the icon to indicate open/closed
        if ( $icon.text().indexOf( closedIcon ) !== -1 )
    		$icon.text( openIcon );
    	else if ( $icon.text().indexOf( openIcon ) !== -1 )
    		$icon.text( closedIcon );
    });

    // Header widget area expand/contract functionality
    $( '.widget-area-toggle' ).click( function( event ) {

    	// Prevent default behavior
    	event.preventDefault();

    	// Get button clicked
    	var $button = $( this );

    	// Remove focus
    	$button.blur();

        // Expand/contract
    	$button.toggleClass( 'open' ).next( '.widget-area' ).slideToggle();
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
 * Features
 *  - ability to include a break point (the minimum viewport width at which the script does anything)
 *  - binds to window resize events (resize and orientationchange)
 *  - will automatically detect new elements added to the DOM
 *  - can be called multiple times without duplicating any events
 *
 * Usage: jQuery( object ).equalHeights( [minHeight], [maxHeight], [breakPoint] );
 *
 * Example 1: jQuery( ".cols" ).equalHeights(); Sets all columns to the same height.
 * Example 2: jQuery( ".cols" ).equalHeights( 400 ); Sets all cols to at least 400px tall.
 * Example 3: jQuery( ".cols" ).equalHeights( 100, 300 ); Cols are at least 100 but no more
 * than 300 pixels tall. Elements with too much content will gain a scrollbar.
 * Example 4: jQuery( ".cols" ).equalHeights( null, null, 768 ); Only resize columns above 768px viewport
 */
( function( $ ) {

    $.fn.equalHeights = function( minHeight, maxHeight, breakPoint ) {

    	// Scope our variables
        var selector, args, eventData, resizeSet;

        // Get the selector used to call equalHeights
        selector = this.selector;

        // Use the args that were passed in or use the defaults
        minHeight = minHeight || null;
        maxHeight = maxHeight || null;
        breakPoint = breakPoint || 0;

        // Combine args into an array
        args = [ minHeight, maxHeight, breakPoint ];

        // Check if our global already exists
        if ( window.equalHeightsItems ) {

    		// It does, so add or overwrite the current object in it
    		window.equalHeightsItems[selector] = args;

        } else {

        	// It doesn't, so create the global and store the current object in it
        	window.equalHeightsItems = {};
        	window.equalHeightsItems[selector] = args;
        }

        // Function to do the equalizing of the heights
        function doEqualHeights( selector, args ) {

        	// Scope our variables
        	var $items, tallest, e, a, width;

        	// Grab the collection of items fresh from the DOM
        	$items = $( selector );

        	// Store the passed in args
        	minHeight = args[0];
        	maxHeight = args[1];
        	breakPoint = args[2];

            // Calculate the tallest item
            tallest = ( minHeight ) ? minHeight : 0;
            $items.each( function() {
                $( this ).height( 'auto' );
                if( $( this ).outerHeight() > tallest ) {
                    tallest = $( this ).outerHeight();
                }
            });

            // Get viewport width (taking scrollbars into account)
            e = window;
            a = 'inner';
            if ( !( 'innerWidth' in window ) ) {
                a = 'client';
                e = document.documentElement || document.body;
            }
            width = e[ a+'Width' ];

            // Equalize heights if viewport width is above the breakpoint
            if ( width >= breakPoint ) {
                if( ( maxHeight ) && tallest > maxHeight ) tallest = maxHeight;
                return $items.each( function() {
                    $( this ).height( tallest );
                });
            }
        }

        // Function to trigger the equalizing
        function triggerEqualHeights() {

        	// Loop through each object in our global
        	$.each( window.equalHeightsItems, function( selector, args ) {

        		// Call doEqualHeights and pass in the current object
        		doEqualHeights( selector, args );
        	});
        }

        // Grab the event data from the window object
		eventData = $( window ).data('events');

		// Check if the window has the smartresize event
		if ( eventData.resize ) {

			// Check if the smartresize event has our namespace
			$( eventData.resize ).each( function() {

				// It does, so store this information in a variable
				if( this.namespace == 'equalheights' ) { resizeSet = true; }
			});
		}

		// Bind the window smartresize event to our trigger function if we
		// haven't already done so
        if ( ! resizeSet ) {
        	$( window ).on( 'resize.equalheights', triggerEqualHeights );
        }

        // Trigger the first equalizing
        triggerEqualHeights();
    }

})( jQuery );
