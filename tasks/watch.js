module.exports = grunt =>
{
	'use strict';

	const config =
	{
		fonts:
		{
			files:
			[
				'templates/**/assets/styles/**/_template.css',
				'modules/**/assets/styles/**/_template.css'
			],
			tasks:
			[
				'build-fonts'
			]
		},
		styles:
		{
			files:
			[
				'assets/styles/**/*.css',
				'templates/**/assets/styles/**/*.css',
				'modules/**/assets/styles/**/*.css'
			],
			tasks:
			[
				'build-styles'
			]
		},
		scripts:
		{
			files:
			[
				'assets/scripts/**/*.js',
				'templates/**/assets/scripts/**/*.js',
				'modules/**/assets/scripts/**/*.js'
			],
			tasks:
			[
				'build-scripts'
			]
		},
		general:
		{
			files:
			[
				'includes/**/*.php',
				'modules/**/*.php',
				'templates/**/*.phtml',
				'modules/**/*.phtml'
			]
		},
		options:
		{
			livereload: grunt.option('L') || grunt.option('live-reload') ? 7000 : false,
			spawn: false
		}
	};

	return config;
};
