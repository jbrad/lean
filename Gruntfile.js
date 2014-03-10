// @version 1.1.1
// @since 1.0

module.exports = function(grunt) {

    // Load Tasks
    require('load-grunt-tasks')(grunt);

    RegExp.quote = require('regexp-quote');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        compress: {
            blogger: {
                options: {
                    archive: '../<%= pkg.name %>-versions/blogger/<%= pkg.name %>.zip'
                },
                files: [
                    {
                        src: [
                            '**',
                            '!**css/lib/**',
                            '!**css/sass/**',
                            '!Gruntfile.js',
                            '!codekit-config.json',
                            '!package.json',
                            '!bower.json',
                            '!*.md',
                            '!js/dev/*',
                            '!**js/lib/**',
                            '!**/node_modules/**',
                            '!**/bower_components/**',
                            '!lib/**/js/dev/*'
                        ],
                        dest: '<%= pkg.name %>',
                        filter: 'isFile'
                    }
                ]
            },
            developer: {
                options: {
                    archive: '../<%= pkg.name %>-versions/developer/<%= pkg.name %>.zip'
                },
                files: [
                    {
                        src: [
                            '**',
                            '!**/node_modules/**',
                            '!**/bower_components/**'
                        ],
                        dest: '<%= pkg.name %>'
                    }
                ]
            }
        },

        concat: {
            options: {
                stripBanners: false
            },
            bootstrap: {
                src: [
                    'bower_components/bootstrap-sass/js/transition.js'
//                    ,'bower_components/bootstrap-sass/js/alert.js'
                    ,'bower_components/bootstrap-sass/js/button.js'
                    ,'bower_components/bootstrap-sass/js/carousel.js'
                    ,'bower_components/bootstrap-sass/js/collapse.js'
                    ,'bower_components/bootstrap-sass/js/dropdown.js'
//                    ,'bower_components/bootstrap-sass/js/modal.js'
//                    ,'bower_components/bootstrap-sass/js/tooltip.js'
//                    ,'bower_components/bootstrap-sass/js/popover.js'
//                    ,'bower_components/bootstrap-sass/js/scrollspy.js'
                    ,'bower_components/bootstrap-sass/js/tab.js'
//                    ,'bower_components/bootstrap-sass/js/affix.js'
                ],
                dest: 'js/lib/bootstrap.min.js'
            }
        },

        uglify: {
            theme: {
                options: {
                    beautify: false,
                    mangle: true
                },
                files: {
                    'js/theme.main.min.js': [
                        'js/lib/bootstrap.min.js',
                        'bower_components/fitvids/jquery.fitvids.js',
                        'js/dev/theme.*.js'
                    ]
                }
            },

            admin: {
                options: {
                    beautify: false,
                    mangle: true
                },
                files: {
                    'js/admin.min.js': [
                        'js/dev/admin.*.js',
                        'lib/**/js/dev/admin.js'
                    ],
                    'js/admin.media-upload.min.js': ['js/dev/admin.media-upload.js']
                }
            },

            md5: {
                options: {
                    preserveComments: 'some'
                },
                files: {
                    'js/md5.min.js': ['bower_components/js-md5/js/md5.min.js']
                }
            },

            widgets: {
                files: {
                    'lib/google-custom-search/js/admin.min.js': 'lib/google-custom-search/js/dev/admin.js'
                    ,'lib/personal-image/js/admin.min.js': 'lib/personal-image/js/dev/admin.js'
                    ,'lib/seo/js/admin.min.js': 'lib/seo/js/dev/admin.js'
                    ,'lib/ad-125x125/js/admin.min.js': 'lib/ad-125x125/js/dev/admin.js'
                    ,'lib/ad-300x250/js/admin.min.js': 'lib/ad-300x250/js/dev/admin.js'
                    ,'lib/ad-billboard/js/admin.min.js': 'lib/ad-billboard/js/dev/admin.js'
                }
            }

        },

        jshint: {
            theme: {
                options: {
                    '-W099': true,
                    '-W040': true
                },
                src: [
                    'js/dev/*.js'
                ]
            },
            plugins: {
                options: {
                    '-W099': true,
                    '-W040': true
                },
                src: [
                    'lib/**/js/dev/*.js'
                ]
            }
        },

        sass: {
            dist: {
                options: {
                    style: 'compressed'
                },
                files: {
                    'css/admin.css': 'css/sass/admin.scss',
                    'css/editor-style.css': 'css/sass/editor-style.scss',
                    'css/theme.dark.css': 'css/sass/theme.dark.scss',
            
                    'style.css': 'css/sass/style.scss'
                    , 'lib/activity/css/admin.css': 'lib/activity/css/sass/admin.scss'
                    , 'lib/google-custom-search/css/admin.css': 'lib/google-custom-search/css/sass/admin.scss'
                    , 'lib/influence/css/admin.css': 'lib/influence/css/sass/admin.scss'
                    , 'lib/personal-image/css/admin.css': 'lib/personal-image/css/sass/admin.scss'
                    , 'lib/seo/css/admin.css': 'lib/seo/css/sass/admin.scss'
                    , 'lib/ad-125x125/css/admin.css': 'lib/ad-125x125/css/sass/admin.scss'
                    , 'lib/ad-300x250/css/admin.css': 'lib/ad-300x250/css/sass/admin.scss'
                    , 'lib/ad-billboard/css/admin.css': 'lib/ad-billboard/css/sass/admin.scss'
                }
            }
        },

        copy: {
            font_awesome_fonts: {
                src: 'bower_components/font-awesome/fonts/*',
                dest: 'fonts/',
                expand: true,
                flatten: true
            }
        },

        watch: {
            theme_js: {
                files: 'js/dev/*.js',
                tasks: [
                    'jshint:theme',
                    'uglify:theme',
                    'uglify:admin'
                ]
            },
            plugin_js: {
                files: 'lib/**/js/dev/*.js',
                tasks: 'jshint:plugins'
            },
            theme_sass: {
                files: 'css/sass/*.scss',
                tasks: 'sass:dev'
            },
            plugin_sass: {
                files: 'lib/**/css/sass/*.scss',
                tasks: 'sass:dev'
            }
        },

        sed: {
            versionNumber: {
                pattern: (function () {
                    var old = grunt.option('oldver')
                    return old ? RegExp.quote(old) : old
                })(),
                replacement: grunt.option('newver'),
                recursive: true
            }
        }

    });

    grunt.registerTask('default', ['copy', 'dist', 'watch']);
    grunt.registerTask('dist', ['sass', 'jshint', 'concat', 'uglify']);
    grunt.registerTask('build', ['dist', 'compress']);

    // Version numbering task.
    // grunt change-version-number --oldver=A.B.C --newver=X.Y.Z
    // This can be overzealous, so its changes should always be manually reviewed!
    grunt.registerTask('change-version-number', ['sed']);

};