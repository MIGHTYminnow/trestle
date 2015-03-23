/**
 * Trestle theme jQuery
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

// Executes when the document is ready
jQuery( document ).ready( function( $ ) {

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
        if ( $icon.text().indexOf( closedIcon ) !== -1 ) {
            $icon.text( openIcon );
        } else if ( $icon.text().indexOf( openIcon ) !== -1 ) {
            $icon.text( closedIcon );
        }
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

    });

}); /* end of page load scripts */