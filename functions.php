<?php

/**
 * Lean 2.0.2
 * Lean is a sleek, exacting product designed for uncluttered and sophisticated presentation of your content on desktop and mobile devices.
 *
 * This file enables core features of the theme including sidebars, menus, post thumbnails, post formats, header, backgrounds, and more.
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
 * @package	lean
 * @version	2.0.2
 * @since	1.0
 *
 */

/* Variables */

include_once( get_template_directory() . '/includes/theme-variables.php' );

/* ----------------------------------------------------------- *
 * Dependencies
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/native-seo.php' );
include_once( get_template_directory() . '/includes/header.favicon.php' );
include_once( get_template_directory() . '/includes/header.google-analytics.php' );
include_once( get_template_directory() . '/includes/header.google-plus.php' );
include_once( get_template_directory() . '/includes/footer.google-custom-search.php' );

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
 * 8.	Custom Post Types
 * ----------------------------------------------------------- */

/* ----------------------------------------------------------- *
 * 1. Localization
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/theme-localization.php' );

/* ----------------------------------------------------------- *
 * 2. Theme Settings
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/theme-settings.php' );

/* ----------------------------------------------------------- *
 * 3. Features
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/theme-features.php' );

/* ----------------------------------------------------------- *
 * 4. Custom Header
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/theme-custom-header.php' );

/* ----------------------------------------------------------- *
 * 5. Comments Template
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/theme-custom-comments.php' );

/* ----------------------------------------------------------- *
 * 6. Stylesheets and JavaScript Sources
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/theme-styles-and-scripts.php' );

/* ----------------------------------------------------------- *
 * 7. Custom Filters
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/theme-custom-filters.php' );

/* ----------------------------------------------------------- *
 * 8. Custom Post Types
 * ----------------------------------------------------------- */

include_once( get_template_directory() . '/includes/theme-custom-post-types.php' );