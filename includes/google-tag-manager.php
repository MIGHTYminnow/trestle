<?php
/**
 * Print Google Tag Manager script as high in the <head> as possible
 */
function ct_gtm_prepend_head() {
	?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-WZ8NKSQ');</script>
	<!-- End Google Tag Manager -->
	<?php
}

add_action( 'genesis_doctype', 'ct_gtm_prepend_head' );

/**
 * Print Google Tag Manager noscript immediately after the opening <body>
 */
function ct_gtm_prepend_body() {
	?>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WZ8NKSQ"
	height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->
	<?php
}

add_action( 'genesis_before', 'ct_gtm_prepend_body' );
