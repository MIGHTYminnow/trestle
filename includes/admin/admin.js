/**
 * jQuery that runs in the WordPress admin
 *
 * @since 1.0.0
 *
 * @package Trestle
 */

// Executes when the document is ready
jQuery(document).ready(function() {
	
	// Hide Trestle layout radio buttons
	jQuery('.trestle-layout img').next('input[type="radio"]').hide();

	// Add radio button functionality to layout icons
	jQuery('.trestle-layout img').click(function() {
		jQuery(this).next('input[type="radio"]').attr('checked', true);
		jQuery('.trestle-layout img').removeClass('checked');
		jQuery(this).addClass('checked');
	});

	// Add drop-down functionality for Post Info & Meta options
	if( ! jQuery('#genesis-settings\\[trestle_manual_post_info_meta\\]').is(':checked') ) {
		jQuery('.trestle-post-info-meta').hide();
	}

	jQuery('#genesis-settings\\[trestle_manual_post_info_meta\\]').change(function() {
		jQuery('.trestle-post-info-meta').slideToggle();
	});

	// Add drop-down functionality for equal height breakpoint
	if( ! jQuery('#genesis-settings\\[trestle_equal_height_cols\\]').is(':checked') ) {
		jQuery('.trestle-equal-columns-breakpoint').hide();
	}

	jQuery('#genesis-settings\\[trestle_equal_height_cols\\]').change(function() {
		jQuery('.trestle-equal-columns-breakpoint').slideToggle();
	});

}); /* end of as page load scripts */
