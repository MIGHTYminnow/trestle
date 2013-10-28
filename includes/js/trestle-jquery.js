// Executes when the document is ready
jQuery(document).ready(function() {
	
	// Remove .no-jquery body class
	jQuery('body').removeClass('no-jquery');

	// Get our URL
	var h = window.location.host.toLowerCase();
	
	// External Links
	jQuery('[href^="http://"],[href^="https://"]').not('[href*="' + h + '"], .button, .menu-primary a').addClass('externalLink').attr("target", "_blank");

	// Add classes to different types of media links
	jQuery('a[href^="mailto:"]:not(.button)').addClass('emailLink');
	jQuery('a[href*=".pdf"]:not(.button)').attr({"target":"_blank"}).addClass('pdfLink');
	jQuery('a[href*=".doc"]:not(.button)').attr({"target":"_blank"}).addClass('docLink');
	jQuery('img').parent('a:not(.button)').addClass('imageLink').removeClass('externalLink');

	// Add classes to parts of lists
	jQuery('li:last-child').addClass('last');
	jQuery('li:first-child').addClass('first');
	jQuery('ul, ol').parent('li').addClass('parent');

	// Mobile navigation button
	jQuery('#menu-button').click(function() {
		var button = jQuery(this);
		button.toggleClass('open');
        jQuery('.menu-primary').slideToggle();
    });

    // Mobile navigation icons
    var closedIcon = '+';
    var openIcon = '-';

    jQuery('.genesis-nav-menu .parent:not(.current-menu-item, .current_page_item, .current_page_parent, .current_page_ancestor) > a').after('<a class="sub-icon" href="javascript:void()">' + closedIcon + '</a>');
    jQuery('.genesis-nav-menu .parent.current-menu-item > a, .genesis-nav-menu .parent.current_page_item > a, .genesis-nav-menu .parent.current_page_parent > a, .genesis-nav-menu .parent.current_page_ancestor > a').after('<a class="sub-icon" href="javscript: void()">' + openIcon + '</a>');
    
    // Mobile navigation expand/contract functionality
    jQuery('.sub-icon').click(function() {
		var icon = jQuery(this);
		icon.next('ul').slideToggle();
		if ( icon.text().indexOf( closedIcon ) !== -1 )
			icon.text(openIcon);
		else if ( icon.text().indexOf( openIcon ) !== -1 )
			icon.text(closedIcon);
    });

}); /* end of as page load scripts */


// Executes when complete page is fully loaded, including all frames, objects, and images
jQuery(window).load(function() {

});