module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		cssmin: {
			vendor:{
				files: {
					'webroot/css/front/vendor.min.css': [
						'webroot/css/front/vendor/bootstrap.min.css',
						'webroot/css/front/vendor/animate.css',
						'webroot/css/front/vendor/font-awesome.min.css',
					]
				}
			}
		},
		sass: {
			dist: {
				files: {
					'webroot/css/front/front.min.css' : 'webroot/css/front/sass/theme.scss'
				}
			}
		},
		postcss: {
			options: {
				map: false, // inline sourcemaps
				processors: [
					require('pixrem')(), // add fallbacks for rem units
					require('autoprefixer')({browsers: 'last 8 versions'}), // add vendor prefixes
					require('cssnano')() // minify the result
				]
			},
			dist: {
				src: 'webroot/css/front/front.min.css'
			}
		},
		// JS
		uglify: {
			dev: {
				options: {
					beautify: false,
					mangle: true
				},
				files: {
					'webroot/js/front/app.min.js': [
						'webroot/js/front/app/app.js'
					]
				}
			},
			vendor: {
				files: {
					'webroot/js/front/vendor.min.js': [
						'webroot/js/front/vendor/jquery-3.1.1.min.js',
						'webroot/js/front/vendor/moment.js',
						'webroot/js/front/vendor/bootstrap.min.js',
						'webroot/js/front/vendor/bootstrap-datetimepicker.min.js',
						'webroot/js/front/vendor/imagesloaded.js',
						'webroot/js/front/vendor/isotope.pkgd.min.js',
						'webroot/js/front/vendor/vue.js',
						'webroot/js/front/vendor/vue-resource.js'
					]
				}
			}
		},
		watch: {
			scripts: {
				files: [
					'webroot/js/front/app/*.js',
				],
				tasks: ['uglify:dev'],
				options: {
					nospawn: true
				}
			},
			css: {
				files: '**/*.scss',
				tasks: ['sass', 'postcss']
			}
		}
	});


	grunt.loadNpmTasks('grunt-contrib-cssmin');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-postcss');

	grunt.registerTask('default',['watch']);
	grunt.registerTask('vendor', ['cssmin:vendor', 'uglify:vendor']);
	grunt.registerTask('all', ['cssmin:vendor', 'uglify:vendor','uglify:dev','sass','postcss']);

}
