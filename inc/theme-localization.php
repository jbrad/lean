<?php
/**
 * Theme localization.
 *
 * @version	1.1
 * @since	1.0
 */

/**
 * Defines the path to the localization files.
 *
 * @version	1.1
 * @since	1.0
 */
function set_theme_localization() {
    load_theme_textdomain( TRANSLATION_KEY, get_stylesheet_directory() . '/lang' );
} // set_theme_localization
add_action( 'after_setup_theme', 'set_theme_localization' );