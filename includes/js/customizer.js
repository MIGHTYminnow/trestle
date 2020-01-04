;(function () {
	/**
	 * Run function when customizer is ready.
	 */
	wp.customize.bind('ready', function () {
		wp.customize.control('trestle_header_style_control', function (control) {

			const toggleControl = (value) => {

				if (value == 'classic') {
					wp.customize.control('trestle_logo_position_control').toggle(true);
					wp.customize.control('trestle_nav_primary_location_control').toggle(true);
					wp.customize.control('trestle_mobile_nav_toggle_control').toggle(true);
				} else {
					wp.customize.control('trestle_logo_position_control').toggle(false);
					wp.customize.control('trestle_nav_primary_location_control').toggle(false);
					wp.customize.control('trestle_mobile_nav_toggle_control').toggle(false);
				}
			};

			toggleControl(control.setting.get());
			control.setting.bind(toggleControl);
		});
	});
})();
