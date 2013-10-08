// as the page loads, cal these scripts
jQuery(document).ready(function() {
	
	var h = window.location.host.toLowerCase();
	jQuery("a[href^='http']:not([href*='" + h + "']), a[href$='.pdf'], a[hrefjQuery$='.mp3'], a[href$='.m4a'], a[href$='.wav']").attr("target", "_blank");
	
	// Specifically for press kit link
	jQuery("a[href*='press-kit']").attr("target", "_blank");
	jQuery("a[href^='http://']:not([href*='" + h + "'])").addClass("externalLink");
	jQuery("a[href^='https://']:not([href*='" + h + "'])").addClass("externalLink");
	jQuery("img").parent().removeClass("externalLink");
	
	// Niceify the HRs
	jQuery('hr').wrap('<div class="hr"></div>');
	
	// Add classes to different types of media links
	jQuery('a[href^="http://www.youtube"]').removeClass('externalLink');
	jQuery('a[href^="mailto:"]').addClass('emailLink');
	jQuery('a[href*=".pdf"]').attr({"target":"_blank"});
	jQuery('a[href*=".pdf"]').addClass('pdfLink');
	jQuery("img").parent().removeClass("pdfLink");

	// Add classes to parts of lists
	jQuery('li:last-child').addClass('last');
	jQuery('li:first-child').addClass('first');
	jQuery('.children').parent('li').addClass('parent');

	// Mobile navigation button
	jQuery('#menu-button').click(function() {
		var button = jQuery(this);
		button.toggleClass('open');
        jQuery('.menu-primary').slideToggle();
    });

    // Mobile navigation icons
    var closedIcon = '+';
    var openIcon = '-';

    jQuery('.genesis-nav-menu .parent:not(.current-menu-item, .current_page_item, .current_page_parent, .current_page_ancestor) > a').after('<a class="sub-icon" href="javscript: void()">' + closedIcon + '</a>');
    jQuery('.genesis-nav-menu .parent.current-menu-item > a, .genesis-nav-menu .parent.current_page_item > a, .genesis-nav-menu .parent.current_page_parent > a, .genesis-nav-menu .parent.current_page_ancestor > a').after('<a class="sub-icon" href="javscript: void()">' + openIcon + '</a>');
    
    jQuery('.sub-icon').click(function() {
		var icon = jQuery(this);
		icon.next('ul').slideToggle();
		if ( icon.text().indexOf( closedIcon ) !== -1 )
			icon.text(openIcon);
		else if ( icon.text().indexOf( openIcon ) !== -1 )
			icon.text(closedIcon);
    });

}); /* end of as page load scripts */


// executes when complete page is fully loaded, including all frames, objects and images
jQuery(window).load(function() {

});
