/**
 * Academy Pro.
 *
 * This file adds the Customizer Live Preview additions to the Academy Pro Theme.
 *
 * @package Academy
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    https://my.studiopress.com/themes/academy/
 */
(function($, wp) {
    "use strict";

    var $globalCSS = $('<style id="academy-custom-css" type="text/css" /></style>'),
        css = {};

    $(document).ready(function() {
        $('head').append( $globalCSS );
    }).on( 'academy-cssRefresh', function() { printGlobalCSS(css); });

})(jQuery, wp);
