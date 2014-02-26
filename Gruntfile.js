// @version 1.1.1
// @since 1.0

module.exports = function(grunt) {

    // Load Tasks
    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-rename');
    grunt.loadNpmTasks('grunt-contrib-copy');
    grunt.loadNpmTasks('grunt-sed');
    grunt.loadNpmTasks('grunt-sass');

    RegExp.quote = require('regexp-quote');

    var scssFiles = {
        "css/admin.css": 'css/sass/admin.scss',
        "css/editor-style.css": 'css/sass/editor-style.scss',
        "css/theme.dark.css": 'css/sass/theme.dark.scss',

        "style.css": 'css/sass/style.scss'
        , "lib/activity/css/admin.css": 'lib/activity/css/sass/admin.scss'
        , "lib/google-custom-search/css/admin.css": 'lib/google-custom-search/css/sass/admin.scss'
        , "lib/influence/css/admin.css": 'lib/influence/css/sass/admin.scss'
        , "lib/personal-image/css/admin.css": 'lib/personal-image/css/sass/admin.scss'
        , "lib/seo/css/admin.css": 'lib/seo/css/sass/admin.scss'
        , "lib/ad-125x125/css/admin.css": 'lib/ad-125x125/css/sass/admin.scss'
        , "lib/ad-300x250/css/admin.css": 'lib/ad-300x250/css/sass/admin.scss'
        , "lib/ad-billboard/css/admin.css": 'lib/ad-billboard/css/sass/admin.scss'
    };

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
                    "-W099": true,
                    "-W040": true
                },
                src: [
                    'js/dev/*.js'
                ]
            },
            plugins: {
                options: {
                    "-W099": true,
                    "-W040": true
                },
                src: [
                    'lib/**/js/dev/*.js'
                ]
            }
        },

        sass: {
            dist: {
                options: {
                    includePaths: ['css/scss'],
                    outputStyle: 'compressed'
                },
                files: scssFiles
            },
            dev: {
                options: {
                    includePaths: ['css/scss'],
                    outputStyle: 'nested'
                },
                files: scssFiles
            }
        },

        imagemin: {
            png: {
                options: {
                    optimizationLevel: 7
                },
                files: [
                    {
                        expand: true,
                        cwd: 'images/',
                        src: '*.png',
                        dest: 'images/',
                        ext: '.png'
                    }
                ]
            },
            social: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'images/social/small',
                        src: '*.png',
                        dest: 'images/social/small',
                        ext: '.png'
                    }
                ]
            },
            screenshot: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: '.',
                        src: 'screenshot.png',
                        dest: '.',
                        ext: '.png'
                    }
                ]
            },
            css: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'css/img',
                        src: '*.png',
                        dest: 'css/img',
                        ext: '.png'
                    }
                ]
            },
            ad_125: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'lib/ad-125x125/images',
                        src: '*.jpg',
                        dest: 'lib/ad-125x125/images',
                        ext: '.jpg'
                    }
                ]
            },
            ad_300: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'lib/ad-300x250/images',
                        src: '*.jpg',
                        dest: 'lib/ad-300x250/images',
                        ext: '.jpg'
                    }
                ]
            },
            billboard: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'lib/ad-billboard/images',
                        src: '*.jpg',
                        dest: 'lib/ad-billboard/images',
                        ext: '.jpg'
                    }
                ]
            },
            personal_image: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'lib/personal-image/css',
                        src: '*.jpg',
                        dest: 'lib/personal-image/css',
                        ext: '.jpg'
                    }
                ]
            },
            influence: {
                options: {
                    progressive: true
                },
                files: [
                    {
                        expand: true,
                        cwd: 'lib/influence/css',
                        src: '*.png',
                        dest: 'lib/influence/css',
                        ext: '.png'
                    }
                ]
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
            },
            images : {
                files: 'images/*.png',
                tasks: 'imagemin:png'
            },
            images_social : {
                files: 'images/social/small/*.png',
                tasks: 'imagemin:social'
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

    grunt.registerTask('default', ['watch']);
    grunt.registerTask('setup', ['copy', 'sass:dev', 'jshint', 'watch']);
    grunt.registerTask('setup', ['copy', 'sass:dev', 'jshint', 'watch']);
    grunt.registerTask('dist', ['sass:dist', 'jshint', 'concat', 'uglify']);
    grunt.registerTask('build', ['sass:dist', 'jshint', 'concat', 'uglify', 'imagemin', 'compress']);

    // Version numbering task.
    // grunt change-version-number --oldver=A.B.C --newver=X.Y.Z
    // This can be overzealous, so its changes should always be manually reviewed!
    grunt.registerTask('change-version-number', ['sed']);

};