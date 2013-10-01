<?php

/**
 * Lean 1.0
 * Lean is a sleek, exacting product designed for uncluttered and sophisticated presentation of your content on desktop and mobile devices.
 *
 * This file enables core features of Lean including sidebars, menus, post thumbnails, post formats, header, backgrounds, and more.
 * Some functions are able to be overridden using child themes. These functions will be wrapped in a function_exists() conditional.
 *
 * This file is broken in the following areas:
 *
 *	1. Localization
 *	2. Theme Settings
 * 	3. Features
 * 	4. Custom Header
 *	5. Comments Template
 *	6. Stylesheet and JavaScript Sources
 *	7. Custom Filters
 *	8. Helper Functions
 *
 * @package	Lean
 * @since	1.0
 * @version	1.0
 *
 */

// Define a theme version. This is used for cache-busting stylesheets, JavaScript, and for serializing the version in the database
define( 'THEME_VERSION', '1.0.0' );

// Define the theme's name.
define( 'THEME_NAME', 'Lean' );

// Define a theme version. This is used for cache-busting stylesheets, JavaScript, and for serializing the version in the database
define( 'TRANSLATION_KEY', 'lean' );

// Define a theme version. This is used for cache-busting stylesheets, JavaScript, and for serializing the version in the database
define( 'THEME_URL', 'http://leantheme.co' );

/* ----------------------------------------------------------- *
 * Dependencies
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/inc/native-seo.php' );
include_once( get_template_directory() . '/inc/header.favicon.php' );
include_once( get_template_directory() . '/inc/header.google-analytics.php' );
include_once( get_template_directory() . '/inc/header.google-plus.php' );
include_once( get_template_directory() . '/inc/footer.google-custom-search.php' );

include_once( get_template_directory() . '/lib/Bootstrap_Nav_Walker.class.php' );

/* ----------------------------------------------------------- *
 * Contents
 *
 * 1.	Localization
 * 2.	Theme Settings
 * 3.	Features
 * 4.	Custom Header
 * 5.	Comments Template
 * 6.	Stylesheet and JavaScript Sources
 * 7.	Custom Filters
 * 8.	Helper Functions
 * ----------------------------------------------------------- */

/* ----------------------------------------------------------- *
 * 1. Localization
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/inc/theme-localization.php' );

/* ----------------------------------------------------------- *
 * 2. Theme Settings
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/inc/theme-settings.php' );

/* ----------------------------------------------------------- *
 * 3. Features
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/inc/theme-features.php' );

/* ----------------------------------------------------------- *
 * 4. Custom Header
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/inc/theme-custom-header.php' );

/* ----------------------------------------------------------- *
 * 5. Comments Template
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/inc/theme-custom-comments.php' );

/* ----------------------------------------------------------- *
 * 6. Stylesheets and JavaScript Sources
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/inc/theme-styles-and-scripts.php' );

/* ----------------------------------------------------------- *
 * 7. Custom Filters
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/inc/theme-custom-filters.php' );