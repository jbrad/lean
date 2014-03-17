<?php
/**
 * Theme styles and scripts.
 *
 * @version	1.1
 * @since	1.0
 */

/**
 * Imports all theme styles and dependencies required for the theme.
 *
 * @version	1.1
 * @since	1.0
 */
function add_theme_stylesheets() {

    // remove jetpack contact form styles
    wp_deregister_style('grunion.css');

    // theme
    wp_enqueue_style( 'theme', get_stylesheet_directory_uri() . '/style.css', false, THEME_VERSION );

} // end add_theme_stylesheets
add_action( 'wp_enqueue_scripts', 'add_theme_stylesheets', 999 );

/**
 * Imports all theme scripts and dependencies required for managing the behavior of the theme.
 *
 * @version	1.1
 * @since	1.0
 */
function add_theme_scripts() {

    wp_enqueue_script( 'theme-main', get_template_directory_uri() . '/js/theme.main.min.js', array( 'jquery' ), THEME_VERSION );

    // comment-reply
    if ( is_singular() && get_option( 'thread_comments' ) ) {

        wp_enqueue_script( 'comment-reply' );
        wp_enqueue_script( 'md5', get_template_directory_uri() . '/js/md5.min.js', false, THEME_VERSION );

    } // end if

} // end add_theme_scripts
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

/**
 * Adds stylesheets specifically for the administrative dashboard.
 *
 * @version	1.1
 * @since	1.0
 */
function add_admin_stylesheets() {
    wp_enqueue_style( 'theme-admin', get_template_directory_uri() . '/css/admin.css', false, THEME_VERSION );
} // end add_admin_stylesheets
add_action( 'admin_print_styles', 'add_admin_stylesheets' );

/**
 * Adds JavaScript specifically for the administrative dashboard.
 *
 * @version	1.1
 * @since	1.0
 */
function add_admin_script() {

    $dependencies = array(
        'jquery-ui-core',
        'jquery-ui-widget',
        'jquery-ui-mouse',
        'jquery-ui-draggable',
        'jquery-ui-droppable',
        'jquery-ui-sortable',
        'media-upload',
        'thickbox'
    );

    wp_enqueue_script( 'theme-admin', get_template_directory_uri() . '/js/admin.min.js?using_sitemap=' . get_option( 'using_sitemap' ), $dependencies, THEME_VERSION );

    $screen = get_current_screen();
    if( 'post' != $screen->base && 'page' != $screen->base ) {
        wp_enqueue_script( 'theme-admin-media', get_template_directory_uri() . '/js/admin.media-upload.min.js', $dependencies, THEME_VERSION );
    } // end if

    wp_enqueue_media();

} // end add_admin_script
add_action( 'admin_enqueue_scripts', 'add_admin_script' );