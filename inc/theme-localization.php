<?php
/**
 * Theme localization.
 *
 * @since	1.0
 * @version	1.0
 */

/**
 * Defines the path to the localization files.
 *
 * @since	1.0
 * @version	1.0
 */
function lean_set_theme_localization() {
    load_theme_textdomain( 'standard', get_stylesheet_directory() . '/lang' );
} // set_theme_localization
add_action( 'after_setup_theme', 'lean_set_theme_localization' );