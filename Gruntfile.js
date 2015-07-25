/*jslint node: true */
"use strict";

module.exports = function( grunt ) {

	// Grab package as variable for later use/
	var pkg = grunt.file.readJSON( 'package.json' );

	// Load all tasks.
	require('load-grunt-tasks')(grunt, {scope: 'devDependencies'});

	// Project configuration
	grunt.initConfig( {
		pkg: pkg,
		devUpdate: {
	        main: {
	            options: {
	                updateType: 'prompt',
	                packages: {
	                    devDependencies: true
	                },
	            }
	        }
	    },
	    prompt: {
			version: {
				options: {
					questions: [
						{
							config:  'newVersion',
							type:    'input',
							message: 'What specific version would you like',
							default: '<%= pkg.version %>' 
						}
					]
				}
			}
		},
		replace: {
			package: {
				src: ['package.json'],
   				overwrite: true,
    			replacements: [
	    			{
	    				from: /("version":\s*).*,\n/g,
	    				to: '$1"<%= newVersion %>",\n'
	    			}
    			]
			},
			style: {
				src: ['style.css'],
   				overwrite: true,
    			replacements: [
	    			{
	    				from: /(Version:\s*).*/g,
	    				to: '$1<%= newVersion %>'
	    			}
    			]
			},
			functions: {
				src: ['functions.php'],
   				overwrite: true,
    			replacements: [
	    			{
	    				from: /(define\( \'TRESTLE_THEME_VERSION\'\,\s*\').*\'/g,
	    				to: '$1<%= newVersion %>\''
	    			}
    			]
			}
		},
	    makepot: {
	        target: {
	            options: {
	                domainPath: '/languages/',    // Where to save the POT file.
	                potFilename: 'trestle.pot',   // Name of the POT file.
	                type: 'wp-theme'  // Type of project (wp-plugin or wp-theme).
	            }
	        }
	    },
	    wpcss: {
	        stylesheet: {
	            options: {
	                commentSpacing: true, // Whether to clean up newlines around comments between CSS rules.
	                config: 'default'            // Which CSSComb config to use for sorting properties.
	            },
	    		files: {
	    			'style.css': ['style.css']
	    		}
	    	},
	    }
	} );

	grunt.registerTask( 'build', [
		'prompt',
		'replace',
		'makepot',
		'wpcss',
	] );

	grunt.util.linefeed = '\n';
};