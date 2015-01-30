(function() {

	if( typeof bfa_vars != 'undefined' ) {
		var icons = bfa_vars.fa_icons.split(',');
		var prefix = bfa_vars.fa_prefix;

		var icon_i = function(id) {
			return '<i class="fa ' + prefix + '-' + 'fw ' + prefix + '-' + id + '"></i>';
		}

		var icon_shortcode = function(id) {
			return '[icon name="' + id + '" class=""]';
		}

		var createControl = function(name, controlManager) {
			if (name != 'bfaSelect') return null;
			var listBox = controlManager.createListBox('bfaSelect', {
				title: 'Icons',
				onselect: function(v) {
					var editor = this.control_manager.editor;
					if (v) {
						editor.selection.setContent(icon_shortcode(v));
					}		
					return false;
				}
			});

			for (var i = 0; i < icons.length; i++) {
				var _id = icons[i];
				listBox.add(icon_i(_id) + ' ' + _id, _id);
			}

			return listBox;
		};

		tinymce.create('tinymce.plugins.bfa_plugin', {
			createControl: createControl
		});

		tinymce.PluginManager.add('bfa_plugin', tinymce.plugins.bfa_plugin);

	}
})();