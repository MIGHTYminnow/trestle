Trestle (beta)
=======

**IMPORTANT: If you're using a version of Trestle that is prior to the [commit e3db022b760254df95cc6e306ea53b3da46b6ed1](https://github.com/MickeyKay/trestle/commit/e3db022b760254df95cc6e306ea53b3da46b6ed1), please make sure to update your version of Trestle, or at least merge in the changes in this commit or a later commit, including changes to these files:**
* functions.php
* lib/functions/theme-functions.php
* lib/admin/admin-functions.php

This will ensure you avoid the bug in which posts spontaneously switch post_type when looping through a query.

=======


### A handy boilerplate child theme for serious Genesis developers.

### [View Demo &rarr;](http://demo.mightyminnow.com/theme/trestle/)

#### Intro
Trestle takes a lot of the grunt work out of building sites using the Genesis Framework, providing quick and easy-to-implement solutions to common problems and repetitive tasks. We’ve taken Genesis’ rock-solid foundation, integrated mobile-first CSS, responsive navigation, a full-featured settings panel, and much more. Download. Install. Enjoy.

#### Features
Here are some of Trestle's many features, check out the [Trestle Demo](http://demo.mightyminnow.com/theme/trestle/) for a full list.
* Responsive navigation menu
* Mobile first CSS
* Custom control over post info and meta
* Multiple page layouts
* Auto-generating primary navigation
* Ability to auto-install your favorite plugins
* Helpful theme jQuery
* Compatibility with Genesis Extender plugin
* Optional link icons
* Built-in shortcodes (columns, buttons, Font Awesome, etc)
* Front-end styles appear in editor as well
* And more!

#### Settings & Usage
* The Trestle control panel is located at **Genesis &rarr; Theme Settings**, in the **Trestle** metabox.
* Examples and usage can all be viewed on the [Trestle Demo](http://demo.mightyminnow.com/theme/trestle/)

#### To Do
* Convert non-theme functionality to separate Genesis-dependant plugin
* Add in Grunt support for:
    * Sass
    * Auto-ordering of CSS
    * Translation
    * Check other themes for other ideas. . .
* Switch to customizer for theme options instead of Genesis panel (pros? cons?)
