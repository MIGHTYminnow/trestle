/**
 * Trestle theme jQuery
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

// Executes when the document is ready
jQuery(document).ready(function() {
	
	// Remove .no-jquery body class
	jQuery('body').removeClass('no-jquery');
	
	// External Links
	var h = window.location.host.toLowerCase();
	jQuery('[href^="http://"],[href^="https://"]').not('[href*="' + h + '"]').addClass('external-link').attr("target", "_blank");

	// Add classes to different types of links
	jQuery('a[href^="mailto:"]').addClass('email-link');
	jQuery('a[href*=".pdf"]').attr({"target":"_blank"}).addClass('pdf-link');
	jQuery('a[href*=".doc"]').attr({"target":"_blank"}).addClass('doc-link');
	jQuery('a').has('img').addClass('image-link');

	// Add classes to parts of lists
	jQuery('li:last-child').addClass('last');
	jQuery('li:first-child').addClass('first');
	jQuery('ul, ol').parent('li').addClass('parent');

	// Mobile navigation button
	jQuery('#menu-button').click(function() {
		var button = jQuery(this);
		button.toggleClass('open');
        jQuery('.nav-primary').slideToggle();
    });

    // Mobile navigation icons
    var closedIcon = '+';
    var openIcon = '-';

    jQuery('.nav-primary').find('.genesis-nav-menu .parent:not(.current-menu-item, .current_page_item, .current_page_parent, .current_page_ancestor) > a').after('<a class="sub-icon" href="javascript:void()">' + closedIcon + '</a>');
    jQuery('.nav-primary').find('.genesis-nav-menu .parent.current-menu-item > a, .genesis-nav-menu .parent.current_page_item > a, .genesis-nav-menu .parent.current_page_parent > a, .genesis-nav-menu .parent.current_page_ancestor > a').after('<a class="sub-icon" href="javscript: void()">' + openIcon + '</a>');
    
    // Mobile navigation expand/contract functionality
    jQuery('.sub-icon').click(function() {
		var icon = jQuery(this);
		icon.next('ul').slideToggle().toggleClass('open');
		if ( icon.text().indexOf( closedIcon ) !== -1 )
			icon.text(openIcon);
		else if ( icon.text().indexOf( openIcon ) !== -1 )
			icon.text(closedIcon);
    });

}); /* end of as page load scripts */


// Executes when complete page is fully loaded, including all frames, objects, and images
jQuery(window).load(function() {

});