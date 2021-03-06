// @version 1.1.1
// @since 1.0

module.exports = function(grunt) {

    // Load Tasks
    require('load-grunt-tasks')(grunt);

    RegExp.quote = require('regexp-quote');

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        compress: {
            single: {
                options: {
                    archive: '../<%= pkg.name %>-licenses/single/<%= pkg.name %>.zip'
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
                            '!**/_gh_pages/**',
                            '!_config.yml',
                            '!**/.sass-cache/**',
                            '!**/docs/**',
                            '!lib/**/js/dev/*'
                        ],
                        dest: '<%= pkg.name %>',
                        filter: 'isFile'
                    }
                ]
            },
            support: {
                options: {
                    archive: '../<%= pkg.name %>-licenses/support/<%= pkg.name %>.zip'
                },
                files: [
                    {
                        src: [
                            '**',
                            '!**/node_modules/**',
                            '!**/bower_components/**',
                            '!**/_gh_pages/**',
                            '!**/.sass-cache/**'
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
                    'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/transition.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/alert.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/button.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/carousel.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/collapse.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/dropdown.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/modal.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tooltip.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/popover.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/scrollspy.js'
                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/tab.js'
//                    ,'bower_components/bootstrap-sass-official/vendor/assets/javascripts/bootstrap/affix.js'
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

                    'style.css': 'css/sass/style.scss'
                    , 'lib/activity/css/admin.css': 'lib/activity/css/sass/admin.scss'
                    , 'lib/google-custom-search/css/admin.css': 'lib/google-custom-search/css/sass/admin.scss'
                    , 'lib/influence/css/admin.css': 'lib/influence/css/sass/admin.scss'
                    , 'lib/personal-image/css/admin.css': 'lib/personal-image/css/sass/admin.scss'
                    , 'lib/seo/css/admin.css': 'lib/seo/css/sass/admin.scss'
                    , 'lib/ad-125x125/css/admin.css': 'lib/ad-125x125/css/sass/admin.scss'
                    , 'lib/ad-300x250/css/admin.css': 'lib/ad-300x250/css/sass/admin.scss'
                    , 'lib/ad-billboard/css/admin.css': 'lib/ad-billboard/css/sass/admin.scss',

                    'docs/assets/css/docs.min.css': 'docs/assets/css/src/docs.scss'
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
                    'jshint',
                    'uglify'
                ]
            },
            plugin_js: {
                files: 'lib/**/js/dev/*.js',
                tasks: 'jshint'
            },
            theme_sass: {
                files: 'css/sass/*.scss',
                tasks: 'sass'
            },
            plugin_sass: {
                files: 'lib/**/css/sass/*.scss',
                tasks: 'sass'
            },
            docs_sass: {
                files: 'docs/assets/css/src/docs.scss',
                tasks: 'sass'
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