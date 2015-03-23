/**
 * JavaScript for the Customizer Preview
 *
 * @since  1.0.0
 */

( function( $ ) {

	// Layout
	wp.customize( 'genesis-settings[trestle_layout]', function( value ) {
	    value.bind( function( value ) {

	    	var $body = $( 'body' );

	    	switch ( value ) {
	    		case 'solid':
	    			$body.removeClass( 'bubble' );
	    		break;
	    		case 'bubble':
	    			$body.addClass( 'bubble' );
	    		break;
	    	}

	    });
	});

	// Custom logo
	wp.customize( 'genesis-settings[trestle_logo_url]', function( value ) {
	    value.bind( function( url ) {

	    	var $body = $( 'body' );

	        if ( 0 === $.trim( url ).length ) {
	        	$body.removeClass( 'has-logo' );
	            $( '.site-title a.image-link' ).remove();
	        } else {
	        	$body.addClass( 'has-logo' );
	            $( '.site-title a.image-link' ).remove();
	            $( '.site-title' ).append( '<a href="/" class="image-link"><img class="logo logo-full show" src="' + url + '" /></a>' );
	        }

	    });
	});

	// Favicon
	wp.customize( 'genesis-settings[trestle_favicon_url]', function( value ) {
	    value.bind( function( url ) {

	    	var $faviconElem = $( 'link[rel="Shortcut Icon"]' );
	    	$faviconElem.attr( 'href', url );

	    });
	});

	// Primary Nav Location
	wp.customize( 'genesis-settings[trestle_nav_primary_location]', function( value ) {
	    value.bind( function( value ) {

	    	var $body = $( 'body' );
	    	var $nav = $( '.nav-primary' );

	    	switch ( value ) {
	    		case 'full':
	    			$body.removeClass( 'nav-primary-location-header' )
	    				 .addClass( 'nav-primary-location-full' );
	    			$nav.remove().insertAfter( '.site-header' );
	    		break;
	    		case 'header':
	    			$body.removeClass( 'nav-primary-location-full' )
	    				 .addClass( 'nav-primary-location-header' );
	    			$nav.remove().appendTo( '.site-header .wrap' );
	    		break;
	    	}

	    });
	});

	// Custom Read More Link Text
	wp.customize( 'genesis-settings[trestle_read_more_text]', function( value )  {
		value.bind( function( value ) {

			$( 'a.more-link' ).text( value );

		});
	});

	// External Links
	wp.customize( 'genesis-settings[trestle_external_link_icons]', function( value )  {
		value.bind( function( value ) {

			var $body = $( 'body' );

			if ( value ) {
	    		$body.addClass( 'external-link-icons' );
			} else {
	    		$body.removeClass( 'external-link-icons' );
			}

		});
	});

	// Email Links
	wp.customize( 'genesis-settings[trestle_email_link_icons]', function( value )  {
		value.bind( function( value ) {

			var $body = $( 'body' );

			if ( value ) {
	    		$body.addClass( 'email-link-icons' );
			} else {
	    		$body.removeClass( 'email-link-icons' );
			}

		});
	});

	// PDF Links
	wp.customize( 'genesis-settings[trestle_pdf_link_icons]', function( value )  {
		value.bind( function( value ) {

			var $body = $( 'body' );

			if ( value ) {
	    		$body.addClass( 'pdf-link-icons' );
			} else {
	    		$body.removeClass( 'pdf-link-icons' );
			}

		});
	});

	// Doc Links
	wp.customize( 'genesis-settings[trestle_doc_link_icons]', function( value )  {
		value.bind( function( value ) {

			var $body = $( 'body' );

			if ( value ) {
	    		$body.addClass( 'doc-link-icons' );
			} else {
	    		$body.removeClass( 'doc-link-icons' );
			}

		});
	});

})( jQuery );
