module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),

        compress: {
            blogger: {
                options: {
                    archive: '../<%= pkg.name %>-versions/<%= pkg.name %>/<%= pkg.name %>.zip'
                },
                files: [
                    {src: [
                        '**',
                        '!**css/lib/**',
                        '!**css/less/**',
                        '!Gruntfile.js',
                        '!codekit-config.json',
                        '!package.json',
                        '!bower.json',
                        '!*.md',
                        '!js/dev/*',
                        '!**js/lib/**',
                        '!**/node_modules/**',
                        '!**/css/lib/less/**',
                        '!lib/**/js/dev/*'
                    ],
                        dest: '<%= pkg.name %>',
                        filter: 'isFile'
                    }
                ]
            },
            designer: {
                options: {
                    archive: '../<%= pkg.name %>-versions/designer/<%= pkg.name %>.zip'
                },
                files: [
                    {src: [
                        '**',
                        '!Gruntfile.js',
                        '!package.json',
                        '!bower.json',
                        '!**js/lib/bootstrap/**',
                        '!**js/lib/fitvids/**',
                        '!**js/lib/js-md5/**',
                        '!**/node_modules/**'
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
                    {src: [
                        '**',
                        '!**/node_modules/**'
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
                    'js/lib/twitter/transition.js',
                    'js/lib/twitter/alert.js',
                    'js/lib/twitter/button.js',
                    'js/lib/twitter/carousel.js',
                    'js/lib/twitter/collapse.js',
                    'js/lib/twitter/dropdown.js',
                    'js/lib/twitter/modal.js',
                    'js/lib/twitter/tooltip.js',
                    'js/lib/twitter/popover.js',
                    'js/lib/twitter/scrollspy.js',
                    'js/lib/twitter/tab.js',
                    'js/lib/twitter/affix.js'
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
                        'js/dev/theme.*.js',
                        'js/lib/fitvids/*.js',
                        'js/lib/bootstrap.min.js'
                    ]
                }
            },

            admin: {
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
                    'js/md5.min.js': ['js/lib/js-md5/*.js']
                }
            },

            respond: {
                options: {
                    preserveComments: 'some'
                },
                files: {
                    'js/respond.min.js': ['js/lib/respond/*.js']
                }
            },

            shiv: {
                options: {
                    preserveComments: 'some'
                },
                files: {
                    'js/html5shiv.min.js': ['js/lib/html5shiv-dist/*.js']
                }
            },

            widgets: {
                files: {
                    'lib/google-custom-search/js/admin.min.js': ['lib/google-custom-search/js/dev/admin.js'],
                    'lib/personal-image/js/admin.min.js': ['lib/personal-image/js/dev/admin.js'],
                    'lib/seo/js/admin.min.js': ['lib/seo/js/dev/admin.js'],
                    'lib/ad-125x125/js/admin.min.js': ['lib/ad-125x125/js/dev/admin.js'],
                    'lib/ad-300x250/js/admin.min.js': ['lib/ad-300x250/js/dev/admin.js'],
                    'lib/ad-billboard/js/admin.min.js': ['lib/ad-billboard/js/dev/admin.js']
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

        less: {
            theme: {
                options: {
                    paths: ["css/less"],
                    yuicompress: true
                },
                files: {
                    "style.css": "css/less/style.less",
                    "css/theme-responsive.css": "css/less/theme-responsive.less",
                    "css/admin.css": "css/less/admin.less",
                    "css/editor-style.css": "css/less/editor-style.less",
                    "css/theme.contrast-light.css": "css/less/theme.contrast-light.less"
                }
            },
            plugins: {
                options: {
                    paths: ["css/less"],
                    yuicompress: false
                },
                files: {
                    "lib/activity/css/admin.css": 'lib/activity/css/less/admin.less',
                    "lib/activity/css/widget.css": 'lib/activity/css/less/widget.less',
                    "lib/google-custom-search/css/admin.css": 'lib/google-custom-search/css/less/admin.less',
                    "lib/google-custom-search/css/widget.css": 'lib/google-custom-search/css/less/widget.less',
                    "lib/influence/css/admin.css": 'lib/influence/css/less/admin.less',
                    "lib/influence/css/widget.css": 'lib/influence/css/less/widget.less',
                    "lib/personal-image/css/admin.css": 'lib/personal-image/css/less/admin.less',
                    "lib/personal-image/css/widget.css": 'lib/personal-image/css/less/widget.less',
                    "lib/seo/css/admin.css": 'lib/seo/css/less/admin.less',
                    "lib/ad-125x125/css/admin.css": 'lib/ad-125x125/css/less/admin.less',
                    "lib/ad-125x125/css/widget.css": 'lib/ad-125x125/css/less/widget.less',
                    "lib/ad-300x250/css/admin.css": 'lib/ad-300x250/css/less/admin.less',
                    "lib/ad-300x250/css/widget.css": 'lib/ad-300x250/css/less/widget.less',
                    "lib/ad-billboard/css/admin.css": 'lib/ad-billboard/css/less/admin.less',
                    "lib/ad-billboard/css/widget.css": 'lib/ad-billboard/css/less/widget.less'
                }
            },
            production: {
                options: {
                    paths: ["css/less"],
                    yuicompress: true
                },
                files: {
                    "style.css": "css/less/style.less",
                    "css/theme-responsive.css": "css/less/theme-responsive.less",
                    "css/admin.css": "css/less/admin.less",
                    "css/editor-style.css": "css/less/editor-style.less",
                    "css/theme.contrast-light.css": "css/less/theme.contrast-light.less",

                    // Widgets
                    "lib/activity/css/admin.css": 'lib/activity/css/less/admin.less',
                    "lib/activity/css/widget.css": 'lib/activity/css/less/widget.less',
                    "lib/google-custom-search/css/admin.css": 'lib/google-custom-search/css/less/admin.less',
                    "lib/google-custom-search/css/widget.css": 'lib/google-custom-search/css/less/widget.less',
                    "lib/influence/css/admin.css": 'lib/influence/css/less/admin.less',
                    "lib/influence/css/widget.css": 'lib/influence/css/less/widget.less',
                    "lib/personal-image/css/admin.css": 'lib/personal-image/css/less/admin.less',
                    "lib/personal-image/css/widget.css": 'lib/personal-image/css/less/widget.less',
                    "lib/seo/css/admin.css": 'lib/seo/css/less/admin.less',
                    "lib/ad-125x125/css/admin.css": 'lib/ad-125x125/css/less/admin.less',
                    "lib/ad-125x125/css/widget.css": 'lib/ad-125x125/css/less/widget.less',
                    "lib/ad-300x250/css/admin.css": 'lib/ad-300x250/css/less/admin.less',
                    "lib/ad-300x250/css/widget.css": 'lib/ad-300x250/css/less/widget.less',
                    "lib/ad-billboard/css/admin.css": 'lib/ad-billboard/css/less/admin.less',
                    "lib/ad-billboard/css/widget.css": 'lib/ad-billboard/css/less/widget.less'
                }
            }
        },

        bower: {
            install: {
                options: {
                    targetDir: 'components',
                    layout: 'byType',
                    install: true,
                    verbose: false,
                    cleanTargetDir: false,
                    cleanBowerDir: true
                }
            }
        },

        rename: {
            less: {
                src: 'css/lib/twitter',
                dest: 'css/lib/bootstrap'
            },
            js: {
                src: 'js/lib/twitter',
                dest: 'js/lib/bootstrap'
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
                        src: ['*.png'],
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
                        src: ['*.png'],
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
                        src: ['screenshot.png'],
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
                        src: ['*.png'],
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
                        src: ['*.jpg'],
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
                        src: ['*.jpg'],
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
                        src: ['*.jpg'],
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
                        src: ['*.jpg'],
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
                        src: ['*.png'],
                        dest: 'lib/influence/css',
                        ext: '.png'
                    }
                ]
            }
        },

        watch: {
            theme_js: {
                files: ['js/dev/*.js'],
                tasks: ['jshint:theme', 'uglify:theme', 'uglify:admin']
            },
            plugin_js: {
                files: ['lib/**/js/dev/*.js'],
                tasks: ['jshint:plugins']
            },
            theme_less: {
                files: [
                    'css/less/*.less'
                ],
                tasks: ['less:theme']
            },
            plugin_less: {
                files: [
                    'lib/**/css/less/*.less'
                ],
                tasks: ['less:plugins']
            },
            images : {
                files: [
                    'images/*.png'
                ],
                tasks: ['imagemin:png']
            },
            images_social : {
                files: [
                    'images/social/small/*.png'
                ],
                tasks: ['imagemin:social']
            }
        }

    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-compress');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-bower-task');
    grunt.loadNpmTasks('grunt-contrib-imagemin');
    grunt.loadNpmTasks('grunt-rename');

    grunt.registerTask('default', ['watch']);
    grunt.registerTask('setup', ['bower', 'less:theme', 'less:plugins', 'jshint', 'watch']);
    grunt.registerTask('build', ['less:production', 'jshint', 'concat', 'uglify', 'imagemin', 'compress']);

};