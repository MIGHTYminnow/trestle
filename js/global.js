/**
 * This script adds basic features to the Academy Pro theme.
 *
 * @package Academy\JS
 * @author StudioPress
 * @license GPL-2.0+
 */

 // Add Keyboard Accessibility.
(function($) {

 	$( '.content .entry *' )
 	.focus( function() {
 		$(this).closest( '.entry' ).addClass( 'focused' );
 	})
 	.blur( function() {
 		$(this).closest( '.entry' ).removeClass( 'focused' );
 	});

})(jQuery);

jQuery( document).ready(function($){

	/** Header Searchform */
	$( '.header-search-toggle button' ).on( 'click', function(){
		var expanded = ( $( this ).attr( 'aria-expanded' ) == 'true' ) ? false : true;
		$( this ).attr( 'aria-expanded', expanded );

		if ( $(window).width() < 768 ) {
			$( '.header-search-form' ).slideToggle( 'fast', function(){
				if ( true == expanded ) {
					$( '#searchform-1' ).focus();
				}
			} );
		} else {
			$( '.header-search-form' ).fadeToggle( 'fast', function() {
				if ( true == expanded ) {
					$( '#searchform-1' ).focus();
				}
			} );
		}
	});

	/** Open external links on new window */
	var h = window.location.host.toLowerCase();
	$('[href^="http"]').not('[href*="' + h + '"]').attr( "target", "_blank" );
	$('[href*="mailto:"]').attr("target", "_self");
	$( 'a[href$=".pdf"]' ).attr({ "target":"_blank" });
	$( 'a[href$=".doc"]' ).attr({ "target":"_blank" });

	$( '.elementor-price-table__price' ).each( function(){		
		if ( $(this).text().trim() == '' ) {
			$(this).addClass( 'empty-price' );
		}
	});

	$('.rev_slider').on( 'revolution.slide.onloaded', function(){
		$( '.slidelink a' ).each(function(){
			var title = $( this ).closest( '.tp-revslider-slidesli' ).data( 'title' );
			$( this ).find( 'span' ).html( '<span class="screen-reader-text">' + title + '</span>' );
		});
	});

	$( '#go-top' ).on( 'click', function(e){
		e.preventDefault();
        $('html, body').animate({
			scrollTop: 0,
		}, 1000 );
	});

	$(document).scroll(function(){
		var y = $(this).scrollTop();
		if ( y > $(window).height() ) {
			$( '#go-top' ).addClass( 'on' );
		} else {
			$( '#go-top' ).removeClass( 'on' );
		}
	});

	$(document).ready(function($){
		$( '#genesis-mobile-nav-primary' ).html( '<span class="screen-reader-text">Menu</span>' );
	});

	function setSearchFormStatus(){
		if ( $( '.site-header .search-form-input' ).val() == '' ) {
			$( '.site-header .search-form' ).addClass( 'empty' );
		} else {
			$( '.site-header .search-form' ).removeClass( 'empty' );
		}
	}

	$( '.site-header .search-form-submit' ).on( 'click', function(e){
		if ( $(window).width() < 1024 ) {
			if ( $( '.site-header .search-form' ).hasClass( 'on' ) ) {
				if ( $( '.site-header .search-form-input' ).val() == '' ) {
					e.preventDefault();
					$( '.site-header .search-form' ).removeClass( 'on' );
				}
			} else {
				e.preventDefault();
				$( '.site-header .search-form' ).addClass( 'on' );
				$( '.search-form-input' ).focus();
			}

			setSearchFormStatus();
		}
	});

	$( '.site-header .search-form-input' ).on( 'keyup', function(){
		console.log( 'keyup' );
		setSearchFormStatus();
	});

	$(document).ready(function(){
		$( '#genesis-mobile-nav-primary, #menu-main-menu button' ).removeAttr( 'aria-pressed' );

		$( '.slick-slide' ).removeAttr( 'tabindex' );
	});


	var toolset_pagination_checker;
	function remove_pagination_titles() {
		$( '.wpv-pagination-nav-links-container' ).addClass( 'titles-removed' );
		$( '.wpv-pagination-nav-links-container .page-link, .wpv-pagination-nav-links-item-current .wpv-filter-pagination-link' ).removeAttr( 'title' ).prepend( '<span class="screen-reader-text">Page </span>' );
		$( '.wpv-pagination-nav-links-container a' ).on( 'click', '', function(){
			toolset_pagination_checker = setInterval( function(){
				if ( ! $( '.wpv-pagination-nav-links-container' ).hasClass( 'titles-removed' ) ) {
					clearInterval( toolset_pagination_checker );
					remove_pagination_titles();
				}
			}, 500 );
		});
	}
	remove_pagination_titles();

	/** Add iOS class */
	var pos_start = navigator.userAgent.indexOf( 'CPU OS ' );
	var pos_end = navigator.userAgent.indexOf( ' like Mac OS' );

	if ( pos_start != -1 && pos_end != -1 ) {
		pos_start = pos_start + 7;
		var length = pos_end - pos_start;
		var ios = navigator.userAgent.substr( pos_start, length );
		jQuery( 'body' ).addClass( 'ios-' + ios );
	}
});

jQuery(document).on('gform_post_render', function(){
	/** Make Homepage Gravity Forms Accessible */
	jQuery( '#input_16_1, #input_1_2' ).attr( 'autocomplete', 'email' );
	jQuery( '#input_16_2, #input_1_1_3' ).attr( 'autocomplete', 'given-name' );
	jQuery( '#input_16_3, #input_1_1_6' ).attr( 'autocomplete', 'family-name' );

	jQuery( '.gfield_error input' ).eq(0).focus();

	jQuery( '.gfield_error input, .gfield_error select, .gfield_error textarea' ).each(function(){
		var id = jQuery(this).closest( '.gfield' ).find( '.validation_message' ).attr( 'id' );
		jQuery(this).attr( 'aria-describedby', '#' + id );
	});
});

/* -------------------------------------------------------- *
 * - Accessible Mega Menu
 * -------------------------------------------------------- */
jQuery( document) .ready( function($){
	function handleNavItemLink( $a ) {
		if ( $(window).width() < 1024 || $a.parent().children( '.sub-nav' ).size() == 0 ) {
			if ( ! $a.attr('href').includes( $(location).attr('protocol') + '//' + $(location).attr('hostname') ) && $a.attr('href').substr(0,1) != '#' && $a.attr('href').substr(0,1) != '/' ) {
			} else {
				window.location.href = $a.attr( 'href' );
			}
		}
	}
	$( '#menu-main-menu' ).on( 'keydown', '.nav-item > a', function(e){
		if ( 13 == e.keyCode) {
			handleNavItemLink( $(this ) );
		}
	});
	$( '#menu-main-menu' ).on( 'click', '.nav-item > a', function(e){
		handleNavItemLink( $(this ) );
	});

	$( '#genesis-nav-primary > .wrap' ).addClass( 'nav-menu-wrapper' );
	$( '#menu-main-menu' ).addClass( 'nav-menu' );
	$( '#menu-main-menu > li' ).addClass( 'nav-item' );
	$( '#menu-main-menu > li > ul' ).addClass( 'sub-nav-group' ).wrap( '<div class="sub-nav"></div>');

    $(".accessible-mega-menu > .nav-menu-wrapper").accessibleMegaMenu({
        /* prefix for generated unique id attributes, which are required 
           to indicate aria-owns, aria-controls and aria-labelledby */
        uuidPrefix: "accessible-megamenu",

        /* css class used to define the megamenu styling */
        menuClass: "nav-menu",

        /* css class for a top-level navigation item in the megamenu */
        topNavItemClass: "nav-item",

        /* css class for a megamenu panel */
        panelClass: "sub-nav",

        /* css class for a group of items within a megamenu panel */
        panelGroupClass: "sub-nav-group",

        /* css class for the hover state */
        hoverClass: "hover",

        /* css class for the focus state */
        focusClass: "focus",

        /* css class for the open state */
        openClass: "open"
    });

	$(document).ready(function(){ // Do after all document ready code has been executed.
		$( '#menu-main-menu .sub-menu-toggle' ).each(function(){
			var text = $(this).closest( '.menu-item' ).find( 'a' ).first().text();
			$(this).find( '.screen-reader-text' ).html( text );
		});
	});
});
