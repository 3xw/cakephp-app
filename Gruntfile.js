module.exports = function(grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		cssmin: {
			vendor:{
				files: {
					'webroot/css/front/vendor.min.css': [
						'webroot/css/front/vendor/bootstrap/bootstrap.min.css',
						'webroot/css/front/vendor/3xw/animate.css',
					],
					'webroot/css/admin/vendor.min.css': [
						'webroot/css/admin/vendor/bootstrap/bootstrap.min.css',
						'webroot/css/admin/vendor/select2/select2.min.css',
						'webroot/css/admin/vendor/trumbowyg/trumbowyg.min.css',
						'webroot/css/admin/vendor/3xw/animate.min.css',
					]
				}
			}
		},
		sass: {
			dist: {
				files: {
					'webroot/css/front/front.min.css' : 'webroot/css/front/sass/theme.scss',
					'webroot/css/admin/admin.min.css' : 'webroot/css/admin/sass/theme.scss'
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
				src: 'webroot/css/front/front.min.css',
				src: 'webroot/css/admin/admin.min.css'
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
					],
					'webroot/js/admin/app.min.js': [
						'webroot/js/admin/app/app.js'
					]
				}
			},
			vendor: {
				files: {
					'webroot/js/front/vendor.min.js': [
						'webroot/js/front/vendor/jquery/jquery-3.2.1.min.js',
						'webroot/js/front/vendor/moment/moment.js',
						'webroot/js/front/vendor/popper/popper.min.js',
						'webroot/js/front/vendor/bootstrap/bootstrap.min.js',
						'webroot/js/front/vendor/imagesloaded/imagesloaded.js',
						'webroot/js/front/vendor/isotope/isotope.pkgd.min.js',
						'webroot/js/front/vendor/vuejs/vue.js',
						'webroot/js/front/vendor/vuejs/vue-resource.js'
					],
					'webroot/js/admin/vendor.min.js': [
						'webroot/js/admin/vendor/jquery/jquery-3.2.1.min.js',
						'webroot/js/admin/vendor/popper/popper.min.js',
						'webroot/js/admin/vendor/moment/moment.js',
						'webroot/js/admin/vendor/bootstrap/bootstrap.min.js',
						'webroot/js/admin/vendor/select2/select2.min.js',
						'webroot/js/admin/vendor/trumbowyg/trumbowyg.min.js',
						'webroot/js/admin/vendor/vuejs/vue2.js',
						'webroot/js/admin/vendor/vuejs/vue-resource.min.js'
					]
				}
			}
		},
		watch: {
			scripts: {
				files: [
					'webroot/js/front/app/*.js',
					'webroot/js/admin/app/*.js'
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
