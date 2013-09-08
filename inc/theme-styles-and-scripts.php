<?php
/**
 * Theme styles and scripts.
 *
 * @since	1.0
 * @version	1.0
 */

/**
 * Imports all theme styles and dependencies required for the theme.
 *
 * @since	1.0
 * @version	1.0
 */
function lean_add_theme_stylesheets() {

    // remove jetpack contact form styles
    wp_deregister_style('grunion.css');

    // theme
    wp_enqueue_style( 'lean', get_stylesheet_directory_uri() . '/style.css', false, LEAN_THEME_VERSION );

    // contrast
    $options = get_option( 'standard_theme_presentation_options' );
    if( 'dark' == $options['contrast'] ) {
        wp_enqueue_style( 'lean-contrast', get_template_directory_uri() . '/css/theme.contrast-light.css', array( 'lean' ), LEAN_THEME_VERSION );
    } // end if

} // end add_theme_stylesheets
add_action( 'wp_enqueue_scripts', 'lean_add_theme_stylesheets', 999 );

/**
 * Imports all theme scripts and dependencies required for managing the behavior of the theme.
 *
 * @since	1.0
 * @version	1.0
 */
function lean_add_theme_scripts() {

    // bootstrap
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/lib/bootstrap.min.js', array( 'jquery' ), LEAN_THEME_VERSION );

    // fitvid
    wp_enqueue_script( 'fitvid', get_template_directory_uri() . '/js/lib/jquery.fitvids.js', false, LEAN_THEME_VERSION );

    // comment-reply
    if ( is_singular() && get_option( 'thread_comments' ) ) {

        wp_enqueue_script( 'comment-reply' );
        wp_enqueue_script( 'md5', get_template_directory_uri() . '/js/lib/md5.js', false, LEAN_THEME_VERSION );

    } // end if

    wp_enqueue_script( 'theme-main', get_template_directory_uri() . '/js/theme.main.min.js', false, LEAN_THEME_VERSION );

} // end add_theme_scripts
add_action( 'wp_enqueue_scripts', 'lean_add_theme_scripts' );

/**
 * Adds stylesheets specifically for the administrative dashboard.
 *
 * @since	1.0
 * @version	1.0
 */
function lean_add_admin_stylesheets() {
    wp_enqueue_style( 'lean-admin', get_template_directory_uri() . '/css/admin.css', false, LEAN_THEME_VERSION );
} // end add_admin_stylesheets
add_action( 'admin_print_styles', 'lean_add_admin_stylesheets' );

/**
 * Adds JavaScript specifically for the administrative dashboard.
 *
 * @since	1.0
 * @version	1.0
 */
function lean_add_admin_script() {

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

    wp_enqueue_script( 'lean-admin', get_template_directory_uri() . '/js/admin.min.js?using_sitemap=' . get_option( 'lean_using_sitemap' ), $dependencies, LEAN_THEME_VERSION );

    $screen = get_current_screen();
    if( 'post' != $screen->base && 'page' != $screen->base ) {
        wp_enqueue_script( 'lean-admin-media', get_template_directory_uri() . '/js/admin.media-upload.min.js', $dependencies, LEAN_THEME_VERSION );
    } // end if

} // end lean_add_admin_script
add_action( 'admin_enqueue_scripts', 'lean_add_admin_script' );