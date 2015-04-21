( function() {
    "use strict";

    var icons = bfa_vars.fa_icons.split(',');
    var prefix = bfa_vars.fa_prefix;

    var icon_shortcode = function(id) {
        return '[icon name="' + id + '" class=""]';
    }

    var bfaSelect = function( editor, url ) {
        editor.addButton('bfaSelect', function() {
            var values = [];

            for (var i = 0; i < icons.length; i++) {
                var _id = icons[i];
                values.push({text: _id, value: _id, icon: ' fa fa-fw icon-fw fa-' + _id + ' icon-' + _id });
            }

            return {
                type: 'listbox',
                name: 'bfaSelect',
                tooltip: 'Better Font Awesome Icons',
                icon: ' fa fa-flag icon-flag',
                text: 'Icons',
                label: 'Select :',
                fixedWidth: true,
                values: values,
                onselect: function(e) {
                    if (e) {
                        editor.insertContent(icon_shortcode(e.control.settings.value));
                    }

	                // Reset back to inital "Icons" text
         			this.value(null);

	                return false;
                },
                onPostRender: function() {
	                this.addClass('bfaSelect');
	            }
            
            };
        });

    };
    tinymce.PluginManager.add( 'bfa_plugin', bfaSelect );
} )();