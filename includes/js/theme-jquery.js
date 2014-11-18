/**
 * Trestle theme jQuery
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

// Executes when the document is ready
jQuery(document).ready(function() {

	// Get PHP vars passed via wp_localize_script()
	trestleEqualColsBreakpoint = php_vars.trestle_equal_cols_breakpoint;
	trestleEqualHeightCols = php_vars.trestle_equal_height_cols

	// Remove .no-jquery body class
	jQuery('body').removeClass('no-jquery');
	
	// External Links
	var h = window.location.host.toLowerCase();
	jQuery('[href^="http"]').not('[href*="' + h + '"]').addClass('external-link').attr("target", "_blank");

	// Add classes to different types of links
	jQuery('a[href^="mailto:"]').addClass('email-link');
	jQuery('a[href*=".pdf"]').attr({"target":"_blank"}).addClass('pdf-link');
	jQuery('a[href*=".doc"]').attr({"target":"_blank"}).addClass('doc-link');
	jQuery('a').has('img').addClass('image-link');

	// Add classes to parts of lists
	jQuery('li:last-child').addClass('last');
	jQuery('li:first-child').addClass('first');
	jQuery('ul, ol').parent('li').addClass('parent');

	// Mobile header toggle buttons
	jQuery('.site-header .title-area').after('<div class="toggle-buttons" />');
	jQuery('.site-header .widget-area, .nav-primary').each(function(i) {
		var target = jQuery(this);

		var buttonClass = 'toggle-button';

        // Add classes of target element
        var targetClass = target.attr('class').split(/\s+/);
        jQuery.each(targetClass, function(index,value) {
        	buttonClass += ' targets-' + value;
        });
        
        if ( jQuery(this).is( 'nav' ) ) {
        	buttonClass += ' nav-toggle';
        }

        // Add toggle buttons to header
        jQuery('.toggle-buttons').prepend('<a id="toggle-button-' + i + '" class="' + buttonClass + '" href="#">Toggle</a>');

        // Add target class to nav and widget areas
        target.addClass('toggle-target-' + i );
    });
	
    // Toggle widget areas and primary nav
    jQuery('.site-header .toggle-button').click( function( event ) {
    	event.preventDefault();

    	var button = jQuery(this);
    	var target = jQuery( '.toggle-target-' + button.attr('id').match(/\d+/) );

        // Toggle buttons
        button.toggleClass('open');
        jQuery('.site-header .toggle-button').not(button).removeClass('open');

        // Toggle targets
        target.toggleClass('open');
        jQuery('[class*="toggle-target"]').not(target).removeClass('open');
    });

    // Mobile navigation icons
    var closedIcon = '+';
    var openIcon = '-';

    jQuery('.nav-primary').find('.genesis-nav-menu .parent:not(.current-menu-item, .current_page_item, .current_page_parent, .current_page_ancestor) > a').after('<a class="sub-icon" href="#">' + closedIcon + '</a>');
    jQuery('.nav-primary').find('.genesis-nav-menu .parent.current-menu-item > a, .genesis-nav-menu .parent.current_page_item > a, .genesis-nav-menu .parent.current_page_parent > a, .genesis-nav-menu .parent.current_page_ancestor > a').after('<a class="sub-icon" href="#">' + openIcon + '</a>');
    
    // Mobile navigation expand/contract functionality
    jQuery('.sub-icon').click(function(event) {
    	event.preventDefault();
    	var icon = jQuery(this);
    	icon.next('ul').slideToggle().toggleClass('open');
    	if ( icon.text().indexOf( closedIcon ) !== -1 )
    		icon.text(openIcon);
    	else if ( icon.text().indexOf( openIcon ) !== -1 )
    		icon.text(closedIcon);
    });
    
    jQuery('.widget-area-toggle').click(function(event) {
    	event.preventDefault();
    	var button = jQuery(this);
    	button.toggleClass('open');
    	button.next('.widget-area').slideToggle();
    });

	// Equal height homepage cols
	jQuery('.equal-height-genesis-extender-cols .ez-home-container-area').each(function() {
		jQuery(this).children('.widget-area').equalHeights(null,null,trestleEqualColsBreakpoint);
	});

	
}); /* end of as page load scripts */


// Executes when complete page is fully loaded, including all frames, objects, and images
jQuery(window).load(function() {

});




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
 * Example 1: jQuery(".cols").equalHeights(); Sets all columns to the same height.
 * Example 2: jQuery(".cols").equalHeights(400); Sets all cols to at least 400px tall.
 * Example 3: jQuery(".cols").equalHeights(100,300); Cols are at least 100 but no more
 * than 300 pixels tall. Elements with too much content will gain a scrollbar.
 * Example 4: jQuery(".cols").equalHeights(null, null,768); Only resize columns above 768px viewport
 * 
 */
 (function(jQuery) {
 	jQuery.fn.equalHeights = function(minHeight, maxHeight, breakPoint) {
 		var items = this;
 		breakPoint = breakPoint || 0;

         // Bind functionality to appropriate events
         jQuery(window).on('load orientationchange resize equalheights', function() {
         	tallest = (minHeight) ? minHeight : 0;
         	items.each(function() {
         		jQuery(this).height('auto');
         		if(jQuery(this).outerHeight() > tallest) {
         			tallest = jQuery(this).outerHeight();
         		}
         	});

             // Get viewport width (taking scrollbars into account)
             var e = window;
             a = 'inner';
             if (!('innerWidth' in window )) {
             	a = 'client';
             	e = document.documentElement || document.body;
             }
             width = e[ a+'Width' ];

             // Equalize column heights if above the specified breakpoint
             if ( width >= breakPoint ) {
             	if((maxHeight) && tallest > maxHeight) tallest = maxHeight;
             	console.log(tallest);
             	return items.each(function() {
             		jQuery(this).height(tallest);
             	});
             }
         });
     }

 })(jQuery);