<?php

include_once( get_template_directory() . '/lib/Standard_Nav_Walker.class.php' );

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\

	1. Localization
	2. Theme Settings
		- Menu Page
		- General Options
		- Layout Options
		- Social Options
		- Publishing
		- Page Options
		- Options Page
	3. Features
	4. Custom Header
	5. Comments Template
	6. Stylesheet and JavaScript Sources
	7. Custom Filters
	8. Helper Functions
	9. PressTrends Integration
*/

/* ----------------------------------------------------------- *
 * 1. Localization
 * ----------------------------------------------------------- */

/**
 * Defines the path to the localization files for Standard.
 */
function standard_set_theme_localization() {
	load_theme_textdomain( 'standard', get_template_directory() . '/lang' );
} // set_theme_localization
add_action( 'after_setup_theme', 'standard_set_theme_localization' );

/* ----------------------------------------------------------- *
 * 2. Theme Settings
 * ----------------------------------------------------------- */

/* ----------------------------- *
 * Menu Page
 * ----------------------------- */

/** 
 * Adds the Standard Theme options menu to the 'Appearance' menu.
 */
function standard_theme_menu() {

	add_theme_page(
		__( 'Standard', 'standard' ),
		__( 'Standard Options', 'standard' ),
		'administrator',
		'theme_options',
		'standard_theme_options_display'
	);

} // end standard_theme_menu
add_action( 'admin_menu', 'standard_theme_menu' );

/* ----------------------------- *
 * Layout Options
 * ----------------------------- */

/**
 * Provides a default value for the Standard Theme layout setting.
 */
function get_standard_theme_default_layout_options() {

	$defaults = array(
		'layout' 	=> 'right_sidebar_layout'
	);
	
	return apply_filters ( 'standard_theme_default_layout_options', $defaults );

} // end standard_theme_default_options
  
/**
 * Defines Standard's layout options.
 */
function standard_setup_theme_layout_options() {

	// If the layout options don't exist, create them.
	if( false == get_option( 'standard_theme_layout_options' ) ) {	
		add_option( 'standard_theme_layout_options', apply_filters( 'standard_theme_default_layout_options', get_standard_theme_default_layout_options() ) );
	} // end if
	
	add_settings_section(
		'layout',
		__( 'Layout', 'standard' ),
		'standard_theme_layout_options_display',
		'standard_theme_layout_options'
	);

	add_settings_field(
		'left_sidebar_layout',
		__( 'Left Sidebar', 'standard' ),
		'left_sidebar_layout_display',
		'standard_theme_layout_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-left.gif'
		)
	);

	add_settings_field(
		'right_sidebar_layout',
		__( 'Right Sidebar', 'standard' ),
		'right_sidebar_layout_display',
		'standard_theme_layout_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-right.gif'
		)
	);
	
	add_settings_field(
		'full_width_layout',
		__( 'No Sidebar / Full Width', 'standard' ),
		'full_width_layout_display',
		'standard_theme_layout_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-full.gif'
		)
	);

	add_settings_field(
		'contrast',
		__( 'Contrast', 'standard' ),
		'contrast_display',
		'standard_theme_layout_options',
		'layout'
	);
	
	register_setting(
		'standard_theme_layout_options',
		'standard_theme_layout_options',
		'standard_theme_layout_options_validate'
	);

} // end standard_setup_theme_layout_options
add_action( 'admin_init', 'standard_setup_theme_layout_options' );

/** 
 * Renders the description for the "Layout" options settings page.
 */
function standard_theme_layout_options_display() {
	_e( 'Select the layout that best fits your content.', 'standard' );	
} // end standard_theme_layout_options_display

/**
 * Renders the left-sidebar layout option.
 *
 * @params	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function left_sidebar_layout_display( $args ) {
	
	$options = get_option( 'standard_theme_layout_options' );

	$html = '<input type="radio" id="standard_theme_left_sidebar_layout" name="standard_theme_layout_options[layout]" value="left_sidebar_layout"' . checked( 'left_sidebar_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;
	
} // end left_sidebar_layout_display

/**
 * Renders the right-sidebar layout option.
 *
 * @params	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function right_sidebar_layout_display( $args ) {
	
	$options = get_option( 'standard_theme_layout_options' );
 	
	$html = '<input type="radio" id="standard_theme_right_sidebar_layout"  name="standard_theme_layout_options[layout]" value="right_sidebar_layout"' . checked( 'right_sidebar_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;
	
} // end right_sidebar_layout_display

/**
 * Renders the full width layout option.
 *
 * @params	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function full_width_layout_display( $args ) {

	$options = get_option( 'standard_theme_layout_options' );
 	
	$html = '<input type="radio" id="standard_theme_full_width_layout"  name="standard_theme_layout_options[layout]" value="full_width_layout"' . checked( 'full_width_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;

} // end full_width_layout_display

/**
 * Renders the layout option for the contrast checkbox.
 */
function contrast_display() {

	$options = get_option( 'standard_theme_layout_options' );
	
	$html = '<input type="checkbox" id="contrast" name="standard_theme_layout_options[contrast]" value="on" ' . checked( 'on', $options['contrast'], false ) . ' />';
	$html .= '&nbsp;<label for="contrast">' . __( 'Select this option if you are using a light background.', 'standard' ) . '</label>';
	
	echo $html;
	
} // end contrast_display

/**
 * Sanitization callback for the layout options. Since each of the layout options are checkboxes,
 * this function loops through the incoming options and verifies they are either empty strings
 * or the number 1.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function standard_theme_layout_options_validate( $input ) {
	
	$output = $defaults = get_standard_theme_default_layout_options();

	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) && $input[$key] == 'left_sidebar_layout' || $input[$key] == 'right_sidebar_layout' || $input[$key] == 'full_width_layout' || $key == 'contrast' ) {
			$output[$key] = $input[$key];
		} // end if	
	
	} // end foreach
	
	return apply_filters( 'standard_theme_layout_options_validate', $output, $input, $defaults );

} // end standard_theme_layout_options_validate

/* ----------------------------- *
 * 	Social Options
 * ----------------------------- */

/**
 * Defines the default values for Standard's social options.
 */
function get_standard_theme_default_social_options() {

	// Build up the semicolon delimited string of the default icons
	$available_icons = '';
	if( $handle = opendir( get_template_directory() . '/images/social/small' ) ) {
	
		while( false !== ( $filename = readdir( $handle ) ) ) {
			if( $filename != '.' && $filename != '..' ) {
				$available_icons .= get_template_directory_uri() . '/images/social/small/' . $filename . ';';
			} // end if
		} // end while
		
		closedir( $handle );
		
	} // end if

	$defaults = array(
		'active-social-icons'		=> '',
		'available-social-icons' 	=> $available_icons
	);
	
	return apply_filters ( 'standard_theme_default_social_options', $defaults );

} // end get_standard_theme_default_social_options

/**
 * Defines Standard's "social" options.
 */
function standard_setup_theme_social_options() {

	// If the theme options don't exist, create them.
//	delete_option( 'standard_theme_social_options' );
	if( false == get_option( 'standard_theme_social_options' ) ) {	
		add_option( 'standard_theme_social_options', apply_filters( 'standard_theme_default_social_options', get_standard_theme_default_social_options() ) );
	} // end if

	/* ------------------ Social Networks ------------------ */
	
	add_settings_section(
		'social',
		__( 'Social Options', 'standard' ),
		'standard_theme_social_options_display',
		'standard_theme_social_options'
	);
	
	add_settings_field(
		'available_social_icons',
		__( 'Available Icons', 'standard' ),
		'standard_available_icons_display',
		'standard_theme_social_options',
		'social'
	);

	add_settings_field(
		'active_social_icons',
		__( 'Active Icons', 'standard' ),
		'standard_active_icons_display',
		'standard_theme_social_options',
		'social'
	);
	
	register_setting(
		'standard_theme_social_options',
		'standard_theme_social_options',
		'standard_theme_social_options_validate'
	);

} // end standard_setup_theme_social_options
add_action( 'admin_init', 'standard_setup_theme_social_options' );

/** 
 * Renders the description for the "Social" options settings page.
 */
function standard_theme_social_options_display() {

	_e( 'To display an icon in the header for each social network below, add the full URL to the associated profile.', 'standard' );	

	$html = '<div class="social-icons-wrapper">';
	
		$html .= '<div id="social-icons-active" class="left">';
			$html .= '<div class="sidebar-name">';
				$html .= '<h3>' . __( 'Active Icons', 'standard' ) . '</h3>';
			$html .= '</div><!-- /.sidebar-name -->';
			$html .= '<div id="active-icons">';
				$html .= '<p class="description">' . __( 'Standard supports up to seven icons that can be displayed in the menu of your site.', 'standard' ) . '</p>';
				$html .= '<ul id="active-icon-list"></ul>';
				$html .= '<div id="active-icon-url" class="hidden">';
					$html .= '<label>' . __( 'Icon Address:', 'standard' ) . '</label>';
					$html .= '<input type="text" id="" name="" value="" class="icon-url" data-via="" data-url="" />';
					$html .= '<input type="button" class="button" id="set-social-icon-url" value="' . __( 'Done', 'standard' ). '" />';
				$html .= '</div><!-- /#active-icon-url -->';
			$html .= '</div><!-- /#active-icons -->';
		$html .= '</div><!-- /#social-icons-active -->';
		
		$html .= '<div id="social-icons-available" class="right">';
			$html .= '<div class="sidebar-name">';
				$html .= '<h3>' . __( 'Available Icons', 'standard' ) . '</h3>';
			$html .= '</div><!-- /.sidebar-name -->';
			$html .= '<div id="available-icons">';
				$html .= '<p class="description">' . __( 'Upload as many icons as many icons as you want. Chris can make this sound better.', 'standard' ) . '</p>';
				$html .= '<ul id="available-icon-list"></ul>';
			$html .= '</div><!-- /#available-icons -->';
			$html .= '<div id="social-icons-operations">';
				$html .= '<input type="button" class="button" id="upload-social-icon" value="' . __( 'Upload', 'standard') . '" />';
				$html .= '<span id="delete-icons" class="description">' . __( 'Drag social icons here to remove them from your library.', 'standard' ) . '</span>';
			$html .= '</div><!-- /#social-icons-operations -->';
		$html .= '</div><!-- /.social-icons-available -->';
		
	$html .= '</div><!-- /.social-icons-wrapper -->';
	
	echo $html;
	
} // end standard_theme_social_options_display

/**
 * Renders the available social icon input. This field is hidden and is manipulated by the functionality for powering
 * the drag and drop functionality of the icons.
 */
function standard_available_icons_display() {
	
	$options = get_option( 'standard_theme_social_options' );
	
	echo '<input type="text" id="available-social-icons" name="standard_theme_social_options[available-social-icons]" value="' . $options['available-social-icons'] . '" />';
	
} // end standard_available_icons_display

/**
 * Renders the active social icon input. This field is hidden and is manipulated by the functionality for powering
 * the drag and drop functionality of the icons.
 */
function standard_active_icons_display() {

	$options = get_option( 'standard_theme_social_options' );
	echo '<input type="text" id="active-social-icons" name="standard_theme_social_options[active-social-icons]" value="' . $options['active-social-icons'] . '" />';
	
} // end standard_active_icons_display

/**
 * Sanitization callback for the social options. Since each of the social options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function standard_theme_social_options_validate( $input ) {
	
	$output = $defaults = get_standard_theme_default_social_options();

	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) ) {
			$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if	
		
		// If the feed isn't provided, then we'll default to WordPress' feed.
		if( $key == 'rss' && strlen( trim( $output[$key] ) )  == '' ) {
			$output[$key] = get_bloginfo( 'rss2_url' );
		} // end if
	
	} // end foreach
	
	return apply_filters( 'standard_theme_social_options_validate', $output, $input, $defaults );

} // end standard_theme_options_validate

/* ----------------------------- *
 * 	General Options
 * ----------------------------- */

/**
 * Defines the default values for Standard's general options.
 */
function get_standard_theme_default_general_options() {

	$defaults = array(
		'display_breadcrumbs'		=>	'on',
		'display_author_box'		=>	'on',
		'display_featured_images' 	=> 	'always',
		'offline_display_message'	=>	__( 'Our site is currently offline.', 'standard' ),
		'standard_theme_version'	=>	'3.0'
	);
	
	return apply_filters ( 'standard_theme_default_general_options', $defaults );

} // end get_standard_theme_default_general_options

/**
 * Defines Standard's "general" options.
 */
function standard_setup_theme_general_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'standard_theme_general_options' ) ) {	
		add_option( 'standard_theme_general_options', apply_filters( 'standard_theme_default_general_options', get_standard_theme_default_general_options() ) );
	} // end if
	
	/* ------------------ Page Options ------------------ */
	
	add_settings_section(
		'general',
		__( 'General Options', 'standard' ),
		'standard_theme_general_options_display',
		'standard_theme_general_options'
	);
	
	add_settings_field(
		'display_breadcrumbs',
		__( 'Breadcrumbs', 'standard' ),
		'display_breadcrumbs_display',
		'standard_theme_general_options',
		'general'
	);

	add_settings_field(
		'display_author_box',
		__( 'Author Box', 'standard' ),
		'display_author_box_display',
		'standard_theme_general_options',
		'general'
	);
	
	add_settings_field(
		'display_featured_images',
		__( 'Display Featured Images', 'standard' ),
		'display_featured_images_display',
		'standard_theme_general_options',
		'general'
	);
	
	add_settings_field(
		'google_analytics',
		__( 'Google Analytics ID', 'standard' ),
		'google_analytics_display',
		'standard_theme_general_options',
		'general'
	);
	
	add_settings_field(
		'affiliate_code',
		__( 'Affiliate Code', 'standard' ),
		'affiliate_code_display',
		'standard_theme_general_options',
		'general'
	);
	
	add_settings_field(
		'fav_icon',
		__( 'Site Icon', 'standard' ),
		'fav_icon_display',
		'standard_theme_general_options',
		'general'
	);
	
	add_settings_field(
		'offline_mode',
		__( 'Offline Mode', 'standard' ),
		'offline_mode_display',
		'standard_theme_general_options',
		'general'
	);
	
	add_settings_field(
		'offline_mode_message',
		__( 'Offline Mode Message', 'standard' ),
		'offline_mode_message_display',
		'standard_theme_general_options',
		'general'
	);
	
	register_setting(
		'standard_theme_general_options',
		'standard_theme_general_options',
		'standard_theme_general_options_validate'
	);

} // end standard_setup_theme_general_options
add_action( 'admin_init', 'standard_setup_theme_general_options' );

/** 
 * Renders the description for the "General" options settings page.
 */
function standard_theme_general_options_display() {
	_e( 'Configure general options that influence how your blog renders content, tracks analytics, and more.', 'standard' );
} // end standard_theme_social_options_display

/**
 * Renders the breadcrumb options.
 *
 * @params	$args	The array of options used for rendering the option.
 */
function display_breadcrumbs_display( $args ) {
	
	$options = get_option( 'standard_theme_general_options' );

	$html = '<input type="checkbox" id="display_breadcrumbs" name="standard_theme_general_options[display_breadcrumbs]" value="on" ' . checked( 'on', $options['display_breadcrumbs'], false ) . ' />';
	$html .= '&nbsp;<label for="display_breadcrumbs">' . __( 'Displays above post and page content.', 'standard' ) . '</label>';
	
	echo $html;
	
} // end display_breadcrumbs_display

/**
 * Renders the breadcrumb options.
 *
 * @params	$args	The array of options used for rendering the option.
 */
function display_author_box_display( $args ) {
	
	$options = get_option( 'standard_theme_general_options' );

	$html = '<input type="checkbox" id="display_author_box" name="standard_theme_general_options[display_author_box]" value="on" ' . checked( 'on', $options['display_author_box'], false ) . ' />';
	$html .= '&nbsp;<label for="display_author_box">' . __( 'Displays between post content and comments. Includes <a href="profile.php">display name</a>, <a href="profile.php">website</a>, and <a href="profile.php">biographical info</a>.', 'standard' ) . '</label>';
	
	echo $html;
	
} // end display_breadcrumbs_display

/**
 * Renders the options for displaying Featured Images.
 *
 * @params	$args	The array of options used for rendering the option.
 */
function display_featured_images_display( $args ) {

	$options = get_option( 'standard_theme_general_options' );

	$html = '<select id="display_featured_image" name="standard_theme_general_options[display_featured_images]">';
		$html .= '<option value="always"'. selected( $options['display_featured_images'], 'always', false ) . '>' . __( 'Always', 'standard' ) . '</option>';
		$html .= '<option value="never"'. selected( $options['display_featured_images'], 'never', false ) . '>' . __( 'Never', 'standard' ) . '</option>';
		$html .= '<option value="index"'. selected( $options['display_featured_images'], 'index', false ) . '>' . __( 'On index only', 'standard' ) . '</option>';
		$html .= '<option value="single-post"'. selected( $options['display_featured_images'], 'single-post', false ) . '>' . __( 'On single posts only', 'standard' ) . '</option>';
	$html .= '</select>';

	echo $html;

} // end display_featured_images_display

/**
 * Renders the option element for Google Analytics.
 */
function google_analytics_display() {

	$option = get_option( 'standard_theme_general_options' );
	
	// Only render this option for administrators
	if( current_user_can( 'manage_options' ) ) {
	
		$analytics_id = '';
		if( true == isset ( $option['google_analytics'] ) ) {
			$analytics_id = $option['google_analytics'];
		} // end if
		
		$html = '<input type="text" id="google_analytics" name="standard_theme_general_options[google_analytics]" value="' . esc_attr( $analytics_id ) . '" />';
		$html .= '&nbsp;<span class="description">' . __( 'Enter the ID only (i.e., UA-000000).', 'standard' ) . '</span>';
		
		echo $html;

	} // end if/else
	
} // end google_analytics_display

/**
 * Renders the option element for the Affiliate Code
 */
function affiliate_code_display() {

	$option = get_option( 'standard_theme_general_options' );
	
	$affiliate_code = '';
	if( true == isset ( $option['affiliate_code'] ) ) {
		$affiliate_code = $option['affiliate_code'];
	} // end if
	
	$html = '<input type="text" id="affiliate_code" name="standard_theme_general_options[affiliate_code]" value="' . esc_attr( $affiliate_code ) . '" />';
	$html .= '&nbsp;<span class="description">' . __( 'Enter your affiliate code here.', 'standard' ) . '</span>';
	
	echo $html;

} // end affiliate_code_display

/**
 * Renders the option element for the Site Icon
 */
function fav_icon_display() {

	$option = get_option( 'standard_theme_general_options' );
	
	if( '' != $option['fav_icon'] ) {
		$dimensions = 'width="16" height="16"';
	} // end if
	
	$html .= '<img src="' . $option['fav_icon'] . '" id="image_upload_preview" alt="" ' . $dimensions . '/>';
	$html .= '<input type="hidden" id="fav_icon" name="standard_theme_general_options[fav_icon]" value="' . esc_attr( $option['fav_icon'] ) . '" class="media-upload-field" />';
	$html .= '<input type="button" class="button" id="upload_fav_icon" value="' . __( 'Upload Now', 'standard' ) . '"/>';
	
	if( '' != trim( $option['fav_icon'] ) ) {
		$html .= '<input type="button" class="button" id="delete_fav_icon" value="' . __( 'Delete', 'standard' ) . '"/>';
	} // end if
	
	echo $html;
	
} // end affiliate_code_display

/**
 * Renders the options for activating Offline Line.
 */
function offline_mode_display( ) {

	$options = get_option( 'standard_theme_general_options' );

	$html = '<input type="checkbox" id="offline_mode" name="standard_theme_general_options[offline_mode]" value="on" ' . checked( 'on', $options['offline_mode'], false ) . ' " />';
	$html .= '&nbsp;<label for="offline_mode">';
		$html .= __( 'Activate offline mode. Etc. TODO.', 'standard' );
	$html .= '</label>';

	echo $html;

} // end offline_mode_display

/**
 * Renders the options for the short, 140-character message for the offline mode.
 */
function offline_mode_message_display() {

	$options = get_option( 'standard_theme_general_options' );
	echo '<input type="text" id="offline_mode_message" name="standard_theme_general_options[offline_mode_message]" value="' . esc_attr( $options['offline_mode_message'] ) . '" maxlength="140" />';

} // end offline_mode_message_display

/**
 * Sanitization callback for the general options.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function standard_theme_general_options_validate( $input ) {

	$output = $defaults = array();

	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) ) {
			$output[$key] = strip_tags( stripslashes( $input[$key] ) );
		} // end if	
		
		if( 'affiliate_code' == $key ) {
			$output[$key] = esc_url ( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if
	
	} // end foreach

	return apply_filters( 'standard_theme_general_options_validate', $output, $input, $defaults );

} // end standard_theme_general_options_validate

/* ----------------------------- *
 * 	Publishing Options
 * ----------------------------- */
 
 /**
 * Defines the default values for Standard's publishing options.
 */
function get_standard_theme_default_publishing_options() {

	$defaults = array(
		'post_advertisement_type' => 'none'
	);
	
	return apply_filters ( 'standard_theme_default_publishing_options', $defaults );

} // end get_standard_theme_default_general_options

/**
 * Defines Standard's "publishing" options.
 */
function standard_setup_theme_publishing_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'standard_theme_publishing_options' ) ) {	
		add_option( 'standard_theme_publishing_options', apply_filters( 'standard_theme_publishing_options', get_standard_theme_default_publishing_options() ) );
	} // end if
	
	add_settings_section(
		'publishing',
		__( 'Publishing', 'standard' ),
		'standard_theme_publishing_options_display',
		'standard_theme_publishing_options'
	);
	
	add_settings_field(
		'privacy_policy_template',
		__( 'Privacy Policy', 'standard' ),
		'privacy_policy_template_display',
		'standard_theme_publishing_options',
		'publishing'
	);

	add_settings_field(
		'comment_policy_template',
		__( 'Comment Policy', 'standard' ),
		'comment_policy_template_display',
		'standard_theme_publishing_options',
		'publishing'
	);
	
	add_settings_field(
		'post_advertisement_type',
		__( 'Display Advertisements Using', 'standard' ),
		'post_advertisement_type_display',
		'standard_theme_publishing_options',
		'publishing'
	);
	
	add_settings_field(
		'post_advertisement_image',
		__( 'Advertisement Image', 'standard' ),
		'post_advertisement_image_display',
		'standard_theme_publishing_options',
		'publishing'
	);
	
	add_settings_field(
		'post_advertisement_adsense',
		__( 'Advertisement Adsense', 'standard' ),
		'post_advertisement_adsense_display',
		'standard_theme_publishing_options',
		'publishing'
	);

	register_setting(
		'standard_theme_publishing_options',
		'standard_theme_publishing_options',
		'standard_theme_publishing_options_validate'
	);
	
} // end standard_setup_theme_publishing_options
add_action( 'admin_init', 'standard_setup_theme_publishing_options' );

/** 
 * Renders the description for the "Publishing" options settings page.
 */
function standard_theme_publishing_options_display() {
	_e( 'TODO', 'standard' );
} // end standard_theme_publishing_options_display

/**
 * Renders the option for generating a Privacy Policy from within the Standard dashboard.
 */
function privacy_policy_template_display() {

	// First, detect if the privacy policy page exists
	$privacy_policy = get_page_by_title( __( 'Privacy Policy', 'standard' ) );
	
	// Options to display if the page doesn't already exist
	$html = '<div id="generate-privacy-policy-wrapper"' . ( '' == $privacy_policy ? ' ' : ' class="hidden" ' )  . '>';
		$html .= '<input type="submit" class="button-secondary" id="generate_privacy_policy" name="generate_privacy_policy" value="' . __( 'Generate Policy', 'standard' ) . '" />';
		$html .= '<span id="standard-privacy-policy-nonce" class="hidden">' . wp_create_nonce( 'standard_generate_privacy_policy_nonce' ) . '</span>';
		$html .= '&nbsp;';
		$html .= '<span class="description">' . __( 'Click here to generate a Privacy Policy. TODO.', 'standard' ) . '</span>';
	$html .= '</div><!-- /#generate-private-policy-wrapper -->';
	
	// Options to display if the page already exists
	$html .= '<div id="has-privacy-policy-wrapper"' . ( '' == $privacy_policy ? ' class="hidden" ' : '' )  . '>';
	
		$policy_id = $privacy_policy->ID == '' ? 'null-policy' : $privacy_policy->ID;
		$html .= '<span>' . __( 'You can view and edit your privacy policy <a id="edit-privacy-policy" href="post.php?post=' . $policy_id . '&action=edit">here</a>.', 'standard' ) . '</span>';
	$html .= '</div><!-- /#has-privacy-policy-wrapper -->';
	
	echo $html;

} // end privacy_policy_template_display

/**
 * Renders the option for generating a Comment Policy from within the Standard dashboard.
 */
function comment_policy_template_display() {

	// First, detect if the privacy policy page exists
	$comment_policy = get_page_by_title( __( 'Comment Policy', 'standard' ) );
	
	// Options to display if the page doesn't already exist
	$html = '<div id="generate-comment-policy-wrapper"' . ( '' == $comment_policy ? ' ' : ' class="hidden" ' )  . '>';
		$html .= '<input type="submit" class="button-secondary" id="generate_comment_policy" name="generate_comment_policy" value="' . __( 'Generate Policy', 'standard' ) . '" />';
		$html .= '<span id="standard-comment-policy-nonce" class="hidden">' . wp_create_nonce( 'standard_generate_comment_policy_nonce' ) . '</span>';
		$html .= '&nbsp;';
		$html .= '<span class="description">' . __( 'Click here to generate a Comment Policy. TODO.', 'standard' ) . '</span>';
	$html .= '</div><!-- /#generate-comment-policy-wrapper -->';
	
	// Options to display if the page already exists
	$html .= '<div id="has-comment-policy-wrapper"' . ( '' == $comment_policy ? ' class="hidden" ' : '' )  . '>';
	
		$policy_id = $comment_policy->ID == '' ? 'null-comment-policy' : $comment_policy->ID;
		$html .= '<span>' . __( 'You can view and edit your comment policy <a id="edit-comment-policy" href="post.php?post=' . $policy_id . '&action=edit">here</a>.', 'standard' ) . '</span>';
	$html .= '</div><!-- /#has-comment-policy-wrapper -->';
	
	echo $html;

} // end comment_policy_template_display

/**
 * Callback function used in the Ajax request for generating the Privacy Policy.
 */
function standard_generate_privacy_policy_page( ) {
	
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_generate_privacy_policy_nonce' ) && isset( $_POST['generatePrivacyPolicy'] ) ) {
		
		$page_id = standard_create_page( 'privacy-policy', __( 'Privacy Policy', 'standard' ), 'template-policy' );
		if( $page_id > 0 ) {
			die( (string)$page_id );
		} else {
			die( '1' );
		} // end if/else
		
	} else {
		die( '-1' );
	} // end if/else

} // end standard_generate_privacy_policy_page
add_action( 'wp_ajax_standard_generate_privacy_policy_page', 'standard_generate_privacy_policy_page' );

/**
 * Callback function used in the Ajax request for generating the Comment Policy.
 */
function standard_generate_comment_policy_page( ) {
	
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_generate_comment_policy_nonce' ) && isset( $_POST['generateCommentPolicy'] ) ) {
		
		$page_id = standard_create_page( 'comment-policy', __( 'Comment Policy', 'standard' ), 'template-policy' );
		if( $page_id > 0 ) {
			die( (string)$page_id );
		} else {
			die( '1' );
		} // end if/else
		
	} else {
		die( '-1' );
	} // end if/else

} // end standard_generate_comment_policy_page
add_action( 'wp_ajax_standard_generate_comment_policy_page', 'standard_generate_comment_policy_page' );

/**
 * TODO
 */
function post_advertisement_type_display() {

	$options = get_option( 'standard_theme_publishing_options' );

	$html = '<select id="post_advertisement_type" name="standard_theme_publishing_options[post_advertisement_type]">';
		$html .= '<option value="none"' . selected( 'none', $options['post_advertisement_type'], false ) . '>' . __( 'None', 'standard' ) . '</option>';
		$html .= '<option value="image"' . selected( 'image', $options['post_advertisement_type'], false ) . '>' . __( 'Banner Image', 'standard' ) . '</option>';
		$html .= '<option value="adsense"' . selected( 'adsense', $options['post_advertisement_type'], false ) . '>' . __( 'Adsense', 'standard' ) . '</option>';
	$html .= '</select>';
	
	echo $html;

} // end post_advertisement_type_display

/**
 * TODO
 */
function post_advertisement_image_display() {

	$options = get_option( 'standard_theme_publishing_options' );

	$html = '<input type="hidden" id="post_advertisement_image" name="standard_theme_publishing_options[post_advertisement_image]" value="' . esc_url( $options['post_advertisement_image'] ) . '" class="post_advertisement_image media-upload-field-raw" />';
	
	$html .= '<input type="button" class="button" id="upload_post_advertisement_image" value="' . __( 'Upload Now', 'standard' ) . '" class="post_advertisement_image" />';

	if( '' != trim( $options['post_advertisement_image']) ) {
		$html .= '<input type="button" class="button" id="delete_post_advertisement_image" value="' . __( 'Delete', 'standard' ) . '"/>';
	} // end if
	
	$html .= '<span class="description">' . __( 'This advertisement will appear between your post content and your comments.', 'standard' ) . '</span>';
	$html .= '<p id="image_upload_preview">' . $options['post_advertisement_image'] . '</p>';
	
	echo $html;

} // end post_advertisement_image_display

/**
 * TODO
 */
function post_advertisement_adsense_display() {

	$options = get_option( 'standard_theme_publishing_options' );

	echo '<input type="text" id="post_advertisement_adsense" name="standard_theme_publishing_options[post_advertisement_adsense]" value="' . $options['post_advertisement_adsense'] . '" class="post_advertisement_adsense" />';

} // end post_advertisement_image_display

/**
 * Sanitization callback for the publishing options.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function standard_theme_publishing_options_validate( $input ) {

	$output = $defaults = get_standard_theme_default_publishing_options();

	foreach( $input as $key => $val ) {

		if( isset ( $input[$key] ) ) {
		
			// If we're working with the post advertisement image, we don't need to remove tags because there's an anchor
			if( 'post_advertisement_image' == $key ) {
				$output[$key] = $input[$key];
			} else {
				$output[$key] = strip_tags( stripslashes( $input[$key] ) );
			} // end if/else
			
		} // end if	
	
	} // end foreach

	return apply_filters( 'standard_theme_publishing_options_validate', $output, $input, $defaults );

} // end standard_theme_publishing_options_validate

/* ----------------------------- *
 * 	Options Page
 * ----------------------------- */

/**
 * Renders the theme options display page.
 */
function standard_theme_options_display() {
?>	
	<div class="wrap">

		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Standard Options', 'standard' ); ?></h2>
		<?php settings_errors(); ?>
		
		<?php $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'standard_theme_general_options'; ?>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_general_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_general_options"><?php _e( 'General Options', 'standard' ); ?></a>
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_layout_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_layout_options"><?php _e( 'Layout', 'standard' ); ?></a>
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_social_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_social_options"><?php _e( 'Social Options', 'standard' ); ?></a>
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_publishing_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_publishing_options"><?php _e( 'Publishing', 'standard' ); ?></a>
		</h2>

		<form method="post" action="options.php">
			<?php

				if( 'standard_theme_general_options' == $active_tab ) {
				
					settings_fields( 'standard_theme_general_options' );
					do_settings_sections( 'standard_theme_general_options' );
					
				} else if( 'standard_theme_layout_options' == $active_tab ) {
				
					settings_fields( 'standard_theme_layout_options' );
					do_settings_sections( 'standard_theme_layout_options' );

				} else if( 'standard_theme_social_options' == $active_tab ) {
				
					settings_fields( 'standard_theme_social_options' );
					do_settings_sections( 'standard_theme_social_options' );					
					
				} else {
				
					settings_fields( 'standard_theme_publishing_options' );
					do_settings_sections( 'standard_theme_publishing_options' );
				
				} // end if/else
				
				submit_button();
			?>
		</form>
	</div><!-- /.wrap -->
<?php
} // end standard_theme_options_display

/* ----------------------------------------------------------- *
 * 3. Features
 * ----------------------------------------------------------- */

/**
 * Defines a custom meta box for displaying the post full width layout. Only renders
 * if the blog isn't using the full width layout.
 */
function standard_add_full_width_single_post() {

	$options = get_option( 'standard_theme_layout_options' );
	if( 'full_width_layout' != $options['layout'] ) {
	
		add_meta_box(
			'post_level_layout',
			__( 'Page Layout', 'standard' ),
			'standard_post_level_layout_display',
			'post',
			'side',
			'core'
		);
		
	} // end if

} // end standard_add_full_width_single_post
add_action( 'add_meta_boxes', 'standard_add_full_width_single_post' );

/**
 * Renders the display for the full-width post option.
 *
 * @params	$post	The post on which the box should be rendered.
 */
function standard_post_level_layout_display( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'standard_post_level_layout_nonce' );

	$html = '<input type="checkbox" id="standard_seo_post_level_layout" name="standard_seo_post_level_layout" value="1"' . checked( get_post_meta( $post->ID, 'standard_seo_post_level_layout', true ), 1, false ) . ' />';

	$html .= '&nbsp;';

	$html .= '<label for="standard_seo_post_level_layout">';
		$html .= __( 'Display this post in full width?', 'standard' );
	$html .= '</label>';

	echo $html;
	
} // end standard_post_level_layout_display

/**
 * Saves the post data to post defined by the incoming ID.
 *
 * @params	$post_id	The ID of the post to which we're saving the post data.
 */
function standard_save_post_layout_data( $post_id ) {
	
	// Don't save if the user hasn't submitted the changes
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	} // end if
	
	// Verify that the input is coming from the proper form
	if( ! wp_verify_nonce( $_POST['standard_post_level_layout_nonce'], plugin_basename( __FILE__ ) ) ) {
		return;
	} // end if
	
	// Make sure the user has permissions to post
	if( 'post' == $_POST['post_type']) {
		if( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		} // end if
	} // end if/else

	// Read the meta description
	$post_level_layout = $_POST['standard_seo_post_level_layout'];
	
	// Update it for this post
	update_post_meta( $post_id, 'standard_seo_post_level_layout', $post_level_layout );

} // end standard_save_post_layout_data
add_action( 'save_post', 'standard_save_post_layout_data' );

/**
 * Adds the 'Standard' menu to the admin bar on the non-admin pages.
 */
function standard_add_admin_bar_option() {
	
	if( ! is_admin() ) {
		
		global $wp_admin_bar;
		
		$wp_admin_bar->add_node(
			array(
				'id'	=>	'standard_options',
				'title'	=>	__( 'Standard', 'standard' ),
				'href'	=>	get_bloginfo( 'url' ) . '/wp-admin/themes.php?page=theme_options'
			)
		);
		
		// General Options
		$wp_admin_bar->add_node(
			array(
				'id'		=>	'standard_theme_general_options',
				'title'		=>	__( 'General Options', 'standard' ),
				'parent'	=>	'standard_options',
				'href'		=>	get_bloginfo( 'url' ) . '/wp-admin/themes.php?page=theme_options&tab=standard_theme_general_options'
			)
		);
	
		// Layout Options
		$wp_admin_bar->add_node(
			array(
				'id'		=>	'standard_theme_layout_options',
				'title'		=>	__( 'Layout', 'standard' ),
				'parent'	=>	'standard_options',
				'href'		=>	get_bloginfo( 'url' ) . '/wp-admin/themes.php?page=theme_options&tab=standard_theme_layout_options'
			)
		);
		
		// Social Options
		$wp_admin_bar->add_node(
			array(
				'id'		=>	'standard_theme_social_options',
				'title'		=>	__( 'Social Options', 'standard' ),
				'parent'	=>	'standard_options',
				'href'		=>	get_bloginfo( 'url' ) . '/wp-admin/themes.php?page=theme_options&tab=standard_theme_social_options'
			)
		);
		
		// Publishing Options
		$wp_admin_bar->add_node(
			array(
				'id'		=>	'standard_theme_publishing_options',
				'title'		=>	__( 'Publishing', 'standard' ),
				'parent'	=>	'standard_options',
				'href'		=>	get_bloginfo( 'url' ) . '/wp-admin/themes.php?page=theme_options&tab=standard_theme_publishing_options'
			)
		);
		
	} // end if
	
} // end standard_add_admin_bar_option
add_action( 'admin_bar_menu', 'standard_add_admin_bar_option', 40 );

function standard_add_maintenance_mode_admin_bar_note() {

	// Remind the user if they are in maintenance mode
	$options = get_option( 'standard_theme_general_options' );
	
	if( 'on' == $options['offline_mode'] ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_node(
			array(
				'id'	=>	'standard_theme_maintenance_mode',
				'title'	=>	__( 'Standard is currently running in offline mode.', 'standard' ),
				'href'	=>	get_bloginfo( 'url' ) . '/wp-admin/themes.php?page=theme_options'
			)
		);
	} // end if

} // end standard_add_maintenance_mode_admin_bar_note
add_action( 'admin_bar_menu' , 'standard_add_maintenance_mode_admin_bar_note', 90 );

/**
 * Detects whether or not Yoast's WordPress SEO plugin has been installed. If so, it will display a notice that informs users
 * it will enhance the SEO of their Standard installation.
 */
function standard_detect_wordpress_seo() {

	// If the SEO notification options don't exist, create them
	if( false == get_option( 'standard_theme_seo_notification_options' ) ) {	
		add_option( 'standard_theme_seo_notification_options', false );
	} // end if
	
	if( 'true' != get_option( 'standard_theme_seo_notification_options' ) ) {
		
		// WordPress SEO
		if( defined( 'WPSEO_URL' ) ) {

			echo '<div id="standard-hide-seo-message-notification" class="updated"><p>' . __( 'Standard has detected the activation of WordPress SEO and is now running in manual SEO mode. <a id="standard-hide-seo-message" href="javascript;">Hide this message.</a>', 'standard') . '</p><span id="standard-hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'standard_hide_seo_message_nonce' ) . '</span></div>';
		
		// All-in-One SEO
		} elseif( class_exists( 'All_in_One_SEO_Pack' ) ) {
		
			echo '<div id="standard-hide-seo-message-notification" class="updated"><p>' . __( 'Standard has detected the activation of All-In-One SEO and is now running in manual SEO mode. <a id="standard-hide-seo-message" href="javascript;">Hide this message.</a>', 'standard') . '</p><span id="standard-hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'standard_hide_seo_message_nonce' ) . '</span></div>';
		
		} // end if/else
		
	} // end if

	// Set the option to false if the plugin is deactivated
	if( 'true' == get_option( 'standard_theme_seo_notification_options') && ! defined( 'WPSEO_URL' ) ) {
		update_option( 'standard_theme_seo_notification_options', 'false' );
	} // end if

} // end standard_detect_wordpress_seo
add_action( 'admin_notices', 'standard_detect_wordpress_seo' );

/**
 * Registers and enqueues the JavaScript responsible for saving the option for hiding the 
 * WordPress SEO notification.
 */
function standard_register_wordpress_seo_message_script() {
	
	wp_register_script( 'seo-notification', get_template_directory_uri() . '/js/admin.seo-notification.js' );
	wp_enqueue_script( 'seo-notification' );

} // end standard_register_wordpress_seo_message_script
add_action( 'admin_head', 'standard_register_wordpress_seo_message_script' );

/**
 * Callback function used in the Ajax request for hiding the notification window of WordPress SEO.
 */
function standard_save_wordpress_seo_message_setting( ) {
	
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_hide_seo_message_nonce' ) && isset( $_POST['hideSeoNotification'] ) ) {
	
		delete_option( 'standard_theme_seo_notification_options' );
		if( update_option( 'standard_theme_seo_notification_options', $_POST['hideSeoNotification'] ) ) {
			die( '0' );
		} else {
			die ( '1' );
		} // end if/else
	} else {
		die( '-1' );
	} // end if
	
} // end standard_save_wordpress_seo_message_setting
add_action( 'wp_ajax_standard_save_wordpress_seo_message_setting', 'standard_save_wordpress_seo_message_setting' );

/**
 * Adds a custom class to the wp_page_menu when users don't set an active menu.
 * 
 * @param	ulclass		The classname for the menu
 *
 * @returns	The markup for the unordered list.
 */
if( ! function_exists( 'standard_page_menu' ) ) { 
	function standard_page_menu( $ulclass ) {
		return preg_replace( '/<ul>/', '<ul class="nav nav-menu">', $ulclass, 1 );
	} // end standard_default_menu
	add_filter( 'wp_page_menu', 'standard_page_menu' );
} // end if
 
/**
 * Adds custom background support.
 */
if( ! function_exists( 'standard_add_theme_background' ) ) { 
	function standard_add_theme_background() {
		add_custom_background();
	} // end standard_add_theme_background
	add_action( 'init', 'standard_add_theme_background' );
} // end if

/**
 * Includes the post editor stylesheet.
 */
if( ! function_exists( 'standard_add_theme_editor_style' ) ) { 
	function standard_add_theme_editor_style() {
		
		add_editor_style( 'css/editor-style.css' );
		
		$options = get_option( 'standard_theme_layout_options' );
		if( 'full_width_layout' == $options['layout'] ) {
			add_editor_style( 'css/editor-style-full.css' );
		} // end if
	
	} // end standard_add_theme_editor_style
	add_action( 'init', 'standard_add_theme_editor_style' );
} // end if

/**
 * Adds three menu areas: above the logo, below the logo, and in the footer.
 */
if( ! function_exists( 'standard_add_theme_menus' ) ) { 
	function standard_add_theme_menus() {
	
		register_nav_menus(
			array(
				'menu_above_logo' 	=> __( 'Menu Above Logo', 'standard' ),
				'menu_below_logo' 	=> __( 'Menu Below Logo', 'standard' ),
				'footer_menu' 		=> __( 'Footer Menu', 'standard' )
			)
		);
	
	} // end add_theme_menu
	add_action( 'init', 'standard_add_theme_menus' );
} // end if

/**
 * Adds four widgetized areas: the sidebar, the left footer, center footer, and right footer.
 */
if( ! function_exists( 'standard_add_theme_sidebars' ) ) { 
	function standard_add_theme_sidebars() {
	
		// main
		register_sidebar(
			array(
				'name' 			=> __( 'Sidebar', 'standard' ),
				'id' 			=> 'sidebar-1',
				'description'	=> __( 'The primary sidebar.', 'standard' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			)
		);
		
		// footer left
		register_sidebar(
			array(
				'name' 			=> __( 'Footer Left', 'standard' ),
				'id' 			=> 'sidebar-2',
				'description'	=> __( 'Shown in the first column of the footer.', 'standard' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			)
		);
		
		// footer center
		register_sidebar(
			array(
				'name' 			=> __( 'Footer Center', 'standard' ),
				'id' 			=> 'sidebar-3',
				'description'	=> __( 'Shown in the second column of the footer.', 'standard' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			)
		);
		
		// footer right
		register_sidebar(
			array(
				'name' 			=> __( 'Footer Right', 'standard' ),
				'id' 			=> 'sidebar-4',
				'description'	=> __( 'Shown in the third column of the footer.', 'standard' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			)
		);
		
	} // end add_theme_sidebars
	add_action( 'widgets_init', 'standard_add_theme_sidebars' );
} // end if

/**
 * Adds support for Post Formats, Post Thumbnails, Activity Tabs widget
 * Custom Image Sizes for post formats.
 */
if( ! function_exists( 'standard_add_theme_features' ) ) { 
	function standard_add_theme_features() {
	
		// enable select post formats
		add_theme_support( 
			'post-formats',
			array(
				'status',
				'image',
				'link',
				'quote',
				'video'
			)
		);
		
		// post thumbnail support
		add_theme_support( 'post-thumbnails' );

		/** TODO move all of this into a helper function */

		// Activity Tabs	
		if( ! in_array( get_template_directory() . '/lib/activity/plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			include_once( get_template_directory() . '/lib/activity/plugin.php' );
		} // end if

		// Standard SEO, if WordPress SEO and All-In-One aren't defined
		if( standard_using_native_seo() ) {
			if( ! in_array( get_template_directory() . '/lib/seo/plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
				include_once( get_template_directory() . '/lib/seo/plugin.php' );
			} // end if			
		} // end if

		// Google Custom Search
		if( ! in_array( get_template_directory() . '/lib/google-custom-search/plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			include_once( get_template_directory() . '/lib/google-custom-search/plugin.php' );
		} // end if	
		
		// 300x250 advertisements
		if( ! in_array( get_template_directory() . '/lib/ad-300x250/plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			include_once( get_template_directory() . '/lib/ad-300x250/plugin.php' );
		} // end if	

		// 125x125 advertisements
		if( ! in_array( get_template_directory() . '/lib/ad-125x125/plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			include_once( get_template_directory() . '/lib/ad-125x125/plugin.php' );
		} // end if	

		// Personal Image
		if( ! in_array( get_template_directory() . '/lib/personal-image/plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			include_once( get_template_directory() . '/lib/personal-image/plugin.php' );
		} // end if	

		// Influence
		if( ! in_array( get_template_directory() . '/lib/influence/plugin.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
			include_once( get_template_directory() . '/lib/influence/plugin.php' );
		} // end if	

	} // end add_theme_features
	add_action( 'after_setup_theme', 'standard_add_theme_features' );
} // end if

/*
 * Sets the media embed width to 580 or 900 (based on the layout) which is optimized 
 * for the theme's post size.
 */
if( ! function_exists( 'standard_set_media_embed_size' ) ) { 
	function standard_set_media_embed_size() {
	
		$options = get_option( 'standard_theme_layout_options' );
		if( 'full_width_layout' == $options['layout'] ) {
		
			if ( isset( $content_width ) ) {
				$content_width = 900;
			} // end if 
		
		} else {
		
			if ( isset( $content_width ) ) {
				$content_width = 580;
			} // end if
		
		} // end if/else
	
	} // end set_media_embed_size
	add_action( 'init', 'standard_set_media_embed_size' );
} // end if

/**
 * Sets the values for the default color scheme of Standard for use
 * in other plugins.
 */
if( ! function_exists( 'standard_set_theme_colors' ) ) { 
	function standard_set_theme_colors() {
	
		$themecolors = array(
			'bg' 		=> 'efefef',
			'border' 	=> 'eeeeee',
			'text' 		=> '333333',
			'link' 		=> '4D8B97',
			'url' 		=> '4D8B97',
		);
	
	} // end standard_set_theme_colors
	add_action( 'init', 'standard_set_theme_colors' );
} // end if

/* ----------------------------------------------------------- *
 * 4. Custom Header
 * ----------------------------------------------------------- */
 
// The default header text color 
if ( ! defined( 'HEADER_TEXTCOLOR' ) ) {
	define( 'HEADER_TEXTCOLOR', '000' ); 
} // end if

// Remove support for header text
if ( ! defined( 'NO_HEADER_TEXT' ) ) {
	define( 'NO_HEADER_TEXT', false );
} // end if

// Height and width of your custom header.
if ( ! defined( 'HEADER_IMAGE_WIDTH' ) ) {
	define( 'HEADER_IMAGE_WIDTH', 940 ); 
} // end if

if ( ! defined( 'HEADER_IMAGE_HEIGHT' ) ) {
	define( 'HEADER_IMAGE_HEIGHT', 250 );
} // end if

// Random header on by default
add_theme_support( 'custom-header');

// Add Custom header in admin
add_custom_image_header( 'standard_header_style', 'standard_admin_header_style', 'standard_admin_header_image' );

// Feedlinks
add_theme_support( 'automatic-feed-links' );

/**
 * Styles the default header.
 */
if( ! function_exists( 'standard_header_style' ) ) {
	function standard_header_style() { 
		if ( HEADER_TEXTCOLOR != get_header_textcolor() ) { ?>
			<style type="text/css">
				<?php if ( 'blank' == get_header_textcolor() ) { ?>
					#site-title,
					#site-description,
					#logo {
						position: absolute !important;
						clip: rect(1px 1px 1px 1px);
						clip: rect(1px, 1px, 1px, 1px);
					}
				<?php } else { ?>
					#site-title a,
					#site-description {
						color: #<?php echo get_header_textcolor(); ?> !important;
					}
				<?php } // end if ?>		
			</style>
		<?php
		} // end if 
	} // end header_style
} // end if

/**
 * Styles the default header in the admin dashboard.
 */
if( ! function_exists( 'standard_admin_header_style' ) ) {
	function standard_admin_header_style() { ?>
		<style type="text/css">
			.appearance_page_custom-header #headimg {
				border: none;
			}
			#headimg h1,
			#desc {
				font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
			}
			#headimg h1 {
				margin: 0;
			}
			#headimg h1 a {
				font-size: 32px;
				line-height: 36px;
				text-decoration: none;
			}
			#desc {
				font-size: 14px;
				line-height: 23px;
				padding: 0 0 3em;
				color: #7A7A7A !important;
			
			}
			#headimg img {
				max-width: 1000px;
				height: auto;
				width: 100%;
			}
			.float {
				float: left;
				position: relative;
				width: 100%;
			}
			
			#header-top {
				z-index: 2;
			}
			
			#header-bottom {
				z-index: 1;
			}
		</style>
	<?php
	} // admin_header_style
} // end if

/**
 * Marks and styles the header image in the admin dashboard.
 */
if( ! function_exists( 'standard_admin_header_image' ) ) {
	function standard_admin_header_image() { ?>
		<div id="headimg">
			<?php $header_image = get_header_image();
	
			if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) ) { 
				$style = ' style="display:none;"'; 
			} else { 
				$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"'; 
			} // end if/else ?>
	   
	   		<div id="header-top" class="float">
				<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1> 
				<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div> 
			</div>
			
			<?php if ( ! empty( $header_image ) ) { ?>
				<div id="header-bottom" class="float">
					<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
				</div>
			<?php } // end if ?>
			
		</div><!-- /#headimg -->
	<?php } // admin_header_image 
} // end if
 
/* ----------------------------------------------------------- *
 * 5. Comments Template
 * ----------------------------------------------------------- */
  
 /**
 * Generates the content container for each post (and page if enabled).
 *
 * @comment	The current comment being displayed.
 * @args	Array containing arguments for displaying the comment.
 * @depth	The depth of where this comment falls in the tree.
 */
function custom_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment-container">
			<?php if ( "comment" == get_comment_type() ) { ?>
				<div class="avatar-holder">
					<?php 
					$default = null;
					if( get_comment_author_email() == get_the_author_meta( 'user_email' ) ) {
						$default = get_the_author_meta( 'user_email' );
					} else {
						$default = get_comment_author_email();
					} // end if/else
					echo get_avatar( $default, '50' );
					?>
				</div><!-- /.avatar-holder -->
			<?php } // end if ?>	
			
			<div class="comment-entry"	id="comment-<?php comment_ID(); ?>">
			
				<div class="comment-head">
					<span class="name">
						<?php if( '' == get_comment_author_url() ) { ?>
							<?php comment_author(); ?>
						<?php } else { ?>
							<a href="<?php comment_author_url(); ?>" target="_blank"><?php comment_author(); ?></a>
						<?php } // end if/else ?>
					</span>
					<?php if ( get_comment_type() == "comment" ) { ?>
						<span class="date"><a href="<?php echo get_comment_link(); ?>" title="<?php esc_attr_e( 'Permalink', 'standard'); ?>"><?php printf( __( '%1$s at %2$s', '_s' ), get_comment_date( get_option( 'date_format' ) ), get_comment_time( get_option( 'time_format' ) ) ); ?></a></span>
						<span class="edit"><?php edit_comment_link( __( 'Edit', 'standard' ), '', '' ); ?></span>
					<?php } // end if ?>
				</div><!-- /.comment-head -->
				
				<?php if ( '0' == $comment->comment_approved ) { ?>
					<span class='unapproved label warning'>
						<?php _e( 'Your comment will appear after being approved.', 'standard' ); ?>
					</span>
				<?php } // end if ?>
				
				<div class="comment-text">
					<?php comment_text(); ?>
				</div><!-- /.comment-text -->
				
				<div class="reply">
					<?php 
						comment_reply_link( 
							array_merge( 
								$args, 
								array(
									'depth' 		=> $depth, 
									'max_depth' 	=> $args['max_depth'], 
									'reply_text' 	=> __( 'Reply', 'standard') 
								) 
							) 
						); 
						?>
				</div><!-- /.reply -->
				
			</div><!-- /.comment-entry -->
		</div><!-- /comment-container -->
<?php } // end custom_comment

/**
 * Generates the list of pings for the given post.
 *
 * @comment	The current ping being displayed.
 * @args	Array containing arguments for displaying the ping.
 * @depth	The depth of where this comment falls in the tree.
 */
 
function list_pings( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>">
		<span class="author">
			<?php comment_author_link(); ?>
		</span> -
		<span class="date">
			<?php echo get_comment_date( get_option( 'date_format' ) ); ?>
		</span>
		<span class="pingcontent">
			<?php comment_text(); ?>
		</span>
<?php } // end list_pings
 
/* ----------------------------------------------------------- *
 * 6. Stylesheets and JavaScript Sources
 * ----------------------------------------------------------- */

/**
 * Imports all theme styles and dependencies required for rendering the theme.
 */
function standard_add_theme_stylesheets() {

	// remove jetpack contact form styles 
	wp_deregister_style('grunion.css');

	// bootstrap
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/lib/bootstrap.css' );
	wp_enqueue_style( 'bootstrap' ); 

	// bootstrap-responsive
	wp_register_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/lib/bootstrap-responsive.css' );
	wp_enqueue_style( 'bootstrap-responsive' ); 

	// theme
	wp_register_style( 'standard', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'standard' ); 
	
	// contrast
	$options = get_option( 'standard_theme_layout_options' );
	if( 'on' == $options['contrast'] ) {
		wp_register_style( 'standard-contrast', get_stylesheet_directory_uri() . '/css/theme.contrast-light.css' );
		wp_enqueue_style( 'standard-contrast' ); 
 	} // end if

} // end add_theme_stylesheets
add_action( 'wp_enqueue_scripts', 'standard_add_theme_stylesheets' );


/**
 * Imports all theme scripts and dependencies required for managing the behavior of the theme.
 */
function standard_add_theme_scripts() {

	// jquery
	wp_enqueue_script( 'jquery' );
	
	// bootstrap
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/lib/bootstrap/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap' );
	
	// fitvid		
	wp_register_script( 'fitvid', get_template_directory_uri() . '/js/lib/jquery.fitvids.js' );
	wp_enqueue_script( 'fitvid' );	
	
	// comment-reply
	if ( is_singular() && get_option( 'thread_comments' ) ) { 
	
		wp_enqueue_script( 'comment-reply' );
		
		wp_register_script( 'md5', get_template_directory_uri() . '/js/lib/md5.js' );
		wp_enqueue_script( 'md5' );
		
		wp_register_script( 'theme-comments', get_template_directory_uri() . '/js/theme.comments.js' );
		wp_enqueue_script( 'theme-comments' );
		
	} // end if
	
	// theme		
	wp_register_script( 'theme', get_template_directory_uri() . '/js/theme.js' );
	wp_enqueue_script( 'theme' );	

} // end add_theme_scripts
add_action( 'wp_enqueue_scripts', 'standard_add_theme_scripts' );

/**
 * Adds styles specifically for the administrative dashboard.
 */
function standard_add_admin_stylesheets() {

	$screen = get_current_screen();

	wp_register_style( 'standard-admin', get_template_directory_uri() . '/css/admin.css' );
	wp_enqueue_style( 'standard-admin' );
	
	if( 'appearance_page_custom-header' == $screen->id ) {
	
		wp_register_style( 'standard-admin-header', get_template_directory_uri() . '/css/admin.header.css' );
		wp_enqueue_style( 'standard-admin-header' );	
		
	} // end if
	
	// thickbox styles for the fav icon upload
	if( 'appearance_page_theme_options' == $screen->id) {
	
		wp_enqueue_style( 'thickbox' );
		
		wp_register_style( 'standard-admin-social-options', get_template_directory_uri() . '/css/admin.social-options.css' );
		wp_enqueue_style( 'standard-admin-social-options' );
		
	} // end if

} // end add_admin_stylesheets
add_action( 'admin_print_styles', 'standard_add_admin_stylesheets' );

/**
 * Adds scripts specifically for the administrative dashboard.
 */
function standard_add_admin_scripts() {

	$screen = get_current_screen();

	// admin header script	
	if( 'appearance_page_custom-header' == $screen->id ) {
		wp_register_script( 'standard-admin-header', get_template_directory_uri() . '/js/admin.header.js' );
		wp_enqueue_script( 'standard-admin-header' );	
	} // end if

	// standard-specific styles
	if( 'appearance_page_theme_options' == $screen->id ) {
		wp_register_script( 'standard-offline-mode', get_template_directory_uri() . '/js/admin.offline-mode.js' );
		wp_enqueue_script( 'standard-offline-mode' );
	} // end if

	// sitemap management script. 
	if( 'post'  == $screen->id || 'edit-page' == $screen->id || 'page' == $screen->id ) {
		wp_register_script( 'standard-admin-sitemap', get_template_directory_uri() . '/js/admin.template-sitemap.js?using_sitemap=' . get_option( 'standard_using_sitemap' ) );
		wp_enqueue_script( 'standard-admin-sitemap' );	
	} // end if
	
	// favicon upload script
	if( 'appearance_page_theme_options' == $screen->id) {
		
		// jquery ui
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-widget' );
		wp_enqueue_script( 'jquery-ui-mouse' );
		wp_enqueue_script( 'jquery-ui-draggable' );
		wp_enqueue_script( 'jquery-ui-droppable' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		
		// media uploader
		wp_enqueue_script( 'media-upload' );
		
		// thickbox for overlay
		wp_enqueue_script( 'thickbox' );
		
		// standard's media-upload script
		wp_register_script( 'standard-media-upload', get_template_directory_uri() . '/js/admin.media-upload.js', array( 'jquery', 'jquery-ui-core', 'media-upload','thickbox' ) );
		wp_enqueue_script( 'standard-media-upload' );
		
		// standard's policy generation script
		wp_register_script( 'standard-publishing-options', get_template_directory_uri() . '/js/admin.publishing-options.js' );
		wp_enqueue_script( 'standard-publishing-options' );
		
		// social options
		wp_register_script( 'standard-admin-social-options', get_template_directory_uri() . '/js/admin.social-options.js' );
		wp_enqueue_script( 'standard-admin-social-options' );
		
	} // end if

} // end add_admin_scripts
add_action( 'admin_enqueue_scripts', 'standard_add_admin_scripts' );

/* ----------------------------------------------------------- *
 * 7. Custom Filters
 * ----------------------------------------------------------- */

/** 
 * This function is fired  if the current version of Standard is not the latest version. If it's not, then the user will be prompted to reset their settings.
 * Once reset, all options will be reset to their default values.
 */
function standard_activate_theme() {
	
	$options = get_option( 'standard_theme_general_options' );
	if( ! array_key_exists( 'standard_theme_version', $options ) ) {
	
		if( array_key_exists( 'standard_theme_reset_options', $_GET ) && 'true' == $_GET['standard_theme_reset_options'] ) {
		
			delete_option( 'standard_theme_layout_options' );
			delete_option( 'standard_theme_social_options' );
			delete_option( 'standard_theme_general_options' );
			delete_option( 'standard_theme_publishing_options' );
			
		} else {
		
			echo '<div id="standard-old-version" class="updated"><p>' . __( 'Standard has detected that you are running a preview version of the theme. In order to continue installation, your old settings must be reset. <a href="?standard_theme_reset_options=true">Please click here to reset your options</a>.', 'standard') . '</p></div>';
		
		} // end if/else
	
	} // end if
		
} // end standard_activate_theme
add_action( 'admin_notices', 'standard_activate_theme' );

// rel="generator" is an invalid HTML5 attribute
remove_action( 'wp_head', 'wp_generator' );

/**
 * If running in native SEO mode and if the current page has a meta description, renders the description
 * to the browser.
 */
function standard_meta_description() {

	if( standard_using_native_seo() ) {
	
		if ( ( is_single() || is_page() ) && '' != get_post_meta( get_the_ID(), 'standard_seo_post_meta_description', true ) ) {
			echo '<meta name="description" content="' . get_post_meta( get_the_ID(), 'standard_seo_post_meta_description', true ) . '" />';
		} // end if/else
	
	} // end if
	
} // end standard_meta_description
add_action( 'wp_head', 'standard_meta_description' );

/**
 * Removes the "category" relationship attribute from category anchors.
 * These are invalid HTML5 attributes.
 *
 * @param   $str    The default set of attributes.
 * @returns         The stripped relationship tag.
 */
function standard_remove_category_anchor_rel( $str ) {

    if( strpos( $str, 'rel="category"' ) ) {
        $str = trim( str_replace( 'rel="category"', "", $str ) );
    } elseif( strpos( $str, 'rel="category tag"' ) ) {
        $str = trim( str_replace( 'rel="category tag"', "", $str ) );
    } // end if/else

    return $str;

} // end standard_remove_category_anchor_rel
add_filter( 'the_category', 'standard_remove_category_anchor_rel' );

/**
 * Removes the "attachment" relationship attribute from anchors.
 * These are invalid HTML5 attributes.
 *
 * @param   $str    The default set of attributes.
 * @returns         The stripped relationship tag.
 */
function standard_remove_anchor_attachment_rel( $str ) {
    return preg_replace( '/(rel="attachment)[a-zA-Z0-9\s\-]*\"/', trim( '' ), trim( $str ) );
} // end standard_remove_anchor_attachment_rel
add_filter( 'the_content', 'standard_remove_anchor_attachment_rel' );

/**
 * Adds a "previous" relationship attribute to the 'Next' pagination option.
 *
 * @params  $attrs  The current set of attributes of the anchor
 * @returns         The pagination link with the additional attribute.
 */
function standard_add_rel_to_next_pagination( $attrs ) {
    $attrs .= 'rel="previous"';
    return $attrs;
} // end add_rel_to_pagination
add_filter( 'next_posts_link_attributes', 'standard_add_rel_to_next_pagination' );

/**
 * Adds a "next" relationship attribute to the 'Previous' pagination option.
 *
 * @params  $attrs  The current set of attributes of the anchor
 * @returns         The pagination link with the additional attribute.
 */
function standard_add_rel_to_previous_pagination( $attrs ) {
    $attrs .= 'rel="next"';
    return $attrs;
} // end add_rel_to_pagination
add_filter( 'previous_posts_link_attributes', 'standard_add_rel_to_previous_pagination' );

/**
 * Provides a default alt tag for the image based on the title, if no
 * alt tag is provided.
 *
 * @param   $html   The markup for the image
 * @param   $id     The ID of the image
 * @param   $alt    The alternative text of the image
 * @param   $title  The title of the image (autogenerated by WordPress or editing by users)
 * @returns         The markup with an alt tag.
 */
function standard_apply_image_alt_in_editor( $html, $id, $alt, $title ) {

    if( strlen( $alt ) == 0 ) {
        $html = str_replace( 'alt=""', 'alt="' . $title . '"', $html );
    } // end if

    return $html;

} // end standard_apply_image_alt_in_editor
add_filter( 'get_image_tag', 'standard_apply_image_alt_in_editor', 10, 4 );

/** 
 * Called when no menus are active by the wp_nav_menu located above the header.
 */
function standard_fallback_nav_menu( ) {
	wp_page_menu( 'show_home=1&include=-1' );
} // end standard_fallback_nav_menu

/**
 * Removes any paragraph tags that are wrapping anchors.
 *
 * @params		$content	The post content
 * @returns					The anchor without paragraph tags.
 */
if( ! function_exists( 'standard_process_link_post_format_content' ) ) {
	function standard_process_link_post_format_content( $content ) {
	
		// If this is an image post type, remove the paragraph wrapper from it.
		if( 'link' == get_post_format( get_the_ID() ) ) {
			$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
		} // end if
		
		return $content;
		 
	} // standard_process_link_post_format_content
	add_filter( 'the_content', 'standard_process_link_post_format_content' );
} // end if

/**
 * Removes any paragraph tags that are wrapping images, anchors around images,
 * or paragraphs around iframes or objects.
 *
 * @params		$title		The the of the post
 * @params		$id			The ID of the current post
 * @returns					The title based on the status of the post and the link
 */
if( ! function_exists( 'standard_process_link_post_format_title' ) ) {
	function standard_process_link_post_format_title( $title, $id ) {
		
		if( 'link' == get_post_format( $id ) ) {
		
			// If the title has been provided, we won't do anything; otherwise, we use the content.
			if( strlen( $title ) == 0 ) {
				
				$title = standard_get_link_post_format_attribute( 'title' );
				$href = standard_get_link_post_format_attribute( 'href' );
				$target = standard_get_link_post_format_attribute( 'target' );
	
				global $post;
				$content = strip_tags( $post->post_content );
				
				// Now set the title
				if( strlen( $title ) == 0 ) {
					$title = $content;
				} // end if
				
			} // end if 
		
		} // end if
		
		return $title;
		
	} // end standard_process_link_post_format_title
	add_filter( 'the_title', 'standard_process_link_post_format_title', 10, 2 );
} // end if

/**
 * Removes any paragraph tags that are wrapping images, anchors around images,
 * or paragraphs around iframes or objects.
 *
 * @params		$content	The post content
 * @returns					The [optional] anchor and image.
 */
if( ! function_exists( 'standard_remove_paragraph_on_media' ) ) {
	function standard_remove_paragraph_on_media( $content ) {
	
		// If this is an image post type, remove the paragraph wrapper from it.
		if( 'image' == get_post_format( get_the_ID() ) ) {
			$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
		} // end if
	
		// If this is a video post format and iframes or objects are used, we need to remove the paragraph wrappers.
		if( 'video' == get_post_format( get_the_ID() ) ) {
			if( strpos($content, 'iframe' ) > 0 ) { 
			    $content = preg_replace( '/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content );
			} elseif( strpos($content, 'object') > 0 ) {
				$content = preg_replace( '/<p>\s*(<object .*>*.<\/object>)\s*<\/p>/iU', '\1', $content );
			} // end if/else
			
		} // end if
	
		return $content;
			
	} // end standard_remove_paragraph_on_media
	add_filter( 'the_content', 'standard_remove_paragraph_on_media' );
} // end if

/**
 * Wraps the video post format with a container in order to improve styling.
 *
 * @param	$html	The content of the video post format
 * @param	$url	The url of the post
 * @param	$args	Additional arguments passed in by WordPress core
 * @returns			The post content wrapped in a container.
 */
if( ! function_exists( 'standard_wrap_embeds' ) ) {
	function standard_wrap_embeds( $html, $url, $args ) {

		if( 'video' == get_post_format( get_the_ID() ) ) {
			$html = '<div class="video-container">' . $html . '</div>';
		} // end if
		
		return $html;
		
	} // end standard_wrap_embebds
	add_filter( 'embed_oembed_html', 'standard_wrap_embeds', 10, 3 ) ;
} // end if

/**
 * Renders a simplified version of the search form.
 *
 * @returns		The search form.
 */
if( ! function_exists( 'standard_search_form' ) ) {
	function standard_search_form() {
	
		// Get the default text for the search form
		$query = strlen( get_search_query() ) == 0 ? __( 'Search...', 'standard' ) : get_search_query();
	
		// Render the form
		$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">';
			$form .= '<input type="text" value="' . $query . '" name="s" id="s" />';
		$form .= '</form>';
		
		return $form;
	
	} // end standard_search_form
	add_filter( 'get_search_form', 'standard_search_form' );
} // end if

/**
 * Formats the link post format properly for the RSS feed.
 *
 * @params		$content	The post content
 * @returns					The properly content formatted for RSS
 */
if( ! function_exists( 'standard_post_format_rss' ) ) {
	function standard_post_format_rss( $content ) {
	
		if( 'link' == get_post_format( get_the_ID() ) ) {
			
			global $post;
			$post_content = $post->post_content;
			$post_title = $post->post_title;
			
			// Read the attribute of the anchor from the post format
			$title = standard_get_link_post_format_attribute( 'title' );
			$href = standard_get_link_post_format_attribute( 'href' );
			$target = standard_get_link_post_format_attribute( 'target' );
			
			// Build up the link
			$content = '<a href="' . $href . '" title="' . $title . '" target="' . $target . '">';
			
				if( strlen( trim( $post_title ) ) > 0 ) {
					$content .= $post_title;
				} elseif( strlen( trim( $title ) ) > 0 ) {
					$content .= $title;
				} else {
					$content .= $post_content;
				} // end if/else
			
			$content .= '</a>';
			
		} // end if
		
		return $content;
			
	} // end standard_post_format_rss
	add_filter( 'the_content_feed', 'standard_post_format_rss' );
} // end if

/**
 * Calls the Standard SEO Titles plugin during the wp_title action to render
 * SEO-friendly page titles.
 */
if( ! ( defined( 'WPSEO_URL' ) || class_exists( 'All_in_One_SEO_Pack' ) ) ) {
	function standard_seo_titles() {
			
		include_once( get_template_directory() . '/lib/seotitles/standard_seotitles.php' );
		echo Standard_SeoTitles::get_page_title( get_the_ID() );
		
	} // end standard_seo_tiltes
	add_filter( 'wp_title', 'standard_seo_titles' );
} // end if

/**
 * Place all widget titles in h4 tags rather than h3 tags to improve SEO. Also adds the
 * 'widget-title' class to the heading elements.
 *
 * @params	$params		The array of parameters that provide styling for the widget.
 * @returns				The updated array of parameters.
 */
if( ! function_exists( 'standard_modify_widget_titles' ) ) {
	function standard_modify_widget_titles( $params ) {
	
		$params[0]['before_title'] = '<h4 class="' . $params[0]['widget_name'] . ' widget-title">' ;
	    return $params;
	    
	} // end standard_modify_widget_titles
	add_filter( 'dynamic_sidebar_params', 'standard_modify_widget_titles' );
} // end if

/**
 * Adds the title attribute to the 'Next and 'Previous' post pagination anchors.
 *
 * @params	$attrs	The current set of attributes of the anchor
 * @returns			The pagination link with the additional attribute.
 */
if( ! function_exists( 'standard_add_title_to_single_post_pagination' ) ) {
	function standard_add_title_to_single_post_pagination( $link ) {
		
		if( strpos( $link, 'rel="prev"' ) > 0 ) {
		
			$previous_post = get_previous_post();
			$link = str_replace( 'rel="prev"', 'rel="prev" title="' . esc_attr( get_the_title( $previous_post->ID ) ) . '"', $link );
			
		} else if( strpos( $link, 'rel="next"' ) > 0 ) {
		
			$next_post = get_next_post();
	        $link = str_replace( 'rel="next"', 'rel="next" title="' . esc_attr( get_the_title( $next_post->ID ) ) . '"', $link );
			
		} // end if/else
		
		return $link;
		
	} // end standard_add_title_to_single_post_pagination
	add_filter( 'next_post_link', 'standard_add_title_to_single_post_pagination' );
	add_filter( 'previous_post_link', 'standard_add_title_to_single_post_pagination' );
} // end if

/**
 * If the post that's being saved is the sitemap, set a flag to prevent use of duplicate sitemaps.
 */
function standard_save_post( ) {

	// if we're saving the page that's using the sitemap but the template is no longer used, delete the option
	if( get_option( 'standard_using_sitemap' ) == $_POST['post_ID'] && strpos( $_POST['page_template'], 'template-sitemap.php' ) == false ) {
		delete_option( 'standard_using_sitemap' );
	} // end if

	// if we're not using the sitemap, but this post has it set, update the option with this post's id
	if( get_option( 'standard_using_sitemap' ) == false && strpos( $_POST['page_template'], 'template-sitemap.php' ) > -1 ) {
		update_option( 'standard_using_sitemap', $_POST['post_ID'] );
	} // end if

} // end standard_save_post
add_action( 'save_post', 'standard_save_post' );

/**
 * Updates the Standard Sitemap Flag if the post being deleted is the actual sitemap.
 *
 * @params	$id		The ID of the post being deleted.
 */
function standard_delete_post( $id ) {

	// if the page being deleted has the sitemap template, we need to delete the option
	if( get_option( 'standard_using_sitemap') == $id ) {
		delete_option( 'standard_using_sitemap' );
	} // end if

} // end standard_delet_post
add_action( 'before_delete_post', 'standard_delete_post' );

/** 
 * Introduces custom messaging to the Image Uploader on the 'post' and 'page' screens.
 * Also marks the alternate tag as required. Will populate it with the title
 * if it is left empty.
 *
 * @params	$form_fields	The array of form fields in the uploader
 * @params	$post			The post object
 */
function standard_attachment_fields_to_edit( $form_fields, $post ) {

	// Mark the alt field as required
	$form_fields['image_alt']['required'] = true;
	
	// Provide a Standard description for title and alt
	$form_fields['post_title']['helps'] =	__( 'TODO', 'standard' );
	$form_fields['image_alt']['helps'] = __( 'Provide a description for your image. TODO.', 'standard' );
	
	// If the alt field is empty, then we're populating it with the title
	if( '' == $form_fields['image_alt']['value'] ) {
		$form_fields['image_alt']['value'] = $form_fields['post_title']['value'];
	} // end if
	
	return $form_fields;
		
} // end standard_attachment_fields_to_edit
add_action( 'attachment_fields_to_edit', 'standard_attachment_fields_to_edit', 11, 2 );

/* ----------------------------------------------------------- *
 * 8. Helper Functions
 * ----------------------------------------------------------- */

/**
 * Determines whether or not the user is viewing a date archive.
 *
 * @returns	True if the current page is for a date archive.
 */
function standard_is_date_archive() {
	return '' != get_query_var( 'year' ) || '' != get_query_var( 'monthnum' ) || '' != get_query_var( 'day' ) || '' != get_query_var( 'm' );
} // end standard_is_date_archive

/**
 * Generates a label for the current archive based on whether or not the user is viewing year, month, or day. Uses the
 * users date format to properly format the date.
 *
 * @returns	The label for the current archive
 */
function standard_get_date_archive_label() {

	$archive_label = '';
	
	if( '' != get_query_var( 'day' ) ) {

		$archive_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, get_query_var( 'monthnum' ), get_query_var( 'day' ), get_query_var( 'year' ) ) );

	} elseif( '' != get_query_var( 'monthnum' ) ) {
	
		// This particular format is not localized. The 'date_format' uses month and year and we only need month and year.
		// The archives widget built into WordPress follows the format that we're providing see.
		// Lines 938 - 939 of general-template.php in WordPress core.
		$archive_label .= get_the_time( 'F Y' );
		
	} elseif ( '' != get_query_var( 'm' ) ) {
	
		if( strlen( get_query_var( 'm' ) ) == 6 ) {
					
			// See comment in Lines 1602 - 1604
			$archive_label .= get_the_time( 'F Y' );
		
		} else {

			$year = substr( get_query_var( 'm' ), 0, 4 );
			$month = substr( get_query_var( 'm' ), 4, 2);
			$day = substr( get_query_var( 'm' ), 6, 2 );
			
			$archive_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, $month, $day, $year ) );
		
		} // end if/else
		
	} elseif( '' != get_query_var( 'year' ) ) {

		$archive_label .= get_query_var( 'year' );
		
	} // end if
	
	return $archive_label;

} // end standard_get_date_archive_label

/**
 * Returns the requested attribute from the link in the content based on the incoming
 * attributes.
 *
 * @param	$attr	The attribute to extract from the link.
 *
 * @returns			The value of the attribute or empty for none.
 */
function standard_get_link_post_format_attribute( $attr ) {

	// Get the post data. We aren't using helpers because this function
	// is called too early in the page lifecycle to call get_the_content
	// and get_the_title.
	global $post;
	$post_content = $post->post_content;
	$post_title = $post->post_title;

	$match = array();
	$result = '';
	switch ( strtolower( $attr )  ) {
		
		case 'title':
			preg_match( '/title=[\"]([^\'"]+)[\'"]/', $post_content, $match );
			$result = count( $match ) > 0 && $match[1] ? $match[1] : '';
			break;
			
		case 'href':
			preg_match( '/href=[\"]([^\'"]+)[\'"]/', $post_content, $match );
			$result = count( $match ) > 0 && $match[1] ? $match[1] : ''; 
			$result = strlen( $result ) == 0 ? $post_content : $result;
			break;
			
		case 'target':
			preg_match( '/target=[\"]([^\'"]+)[\'"]/', $post_content, $match );
			$result = count( $match ) > 0 && $match[0] ? $match[0] : '';
			break;
			
		default:
			$result = '';
			break;
		
	} // end switch
	
	return $result;

} // end standard_get_link_post_format_attribute

/**
 * Looks at the active widgets to determine whether or not the Google Custom Search widget is active.
 *
 * @returns	Whether or not the Google Custom Search is active
 */
function standard_google_custom_search_is_active() {
	
	$gcse_is_active = false;
	foreach( ( $widgets = get_option( 'sidebars_widgets' ) ) as $key => $val ) { 
		if( is_array( $widgets[$key] ) ) {
			foreach($widgets[$key] as $widget) {
				if( $key != 'wp_inactive_widgets' ) {
					if( strpos( $widget, '-custom-search' ) > 0 ) {
						$gcse_is_active = true;
					} // end if
				} // end if
			} // end foreach
		} // end if
	} // end foreach 

	return $gcse_is_active;

} // end standard_google_custom_search_is_active

/**
 * Builds and renders the custom comment form template.
 */
function standard_comment_form() {

	// Gotta read the layout options so we apply the proper ID to our element wrapper
	$layout_options = get_option( 'standard_theme_layout_options' );
	$layout = 'full_width_layout' == $layout_options['layout'] ? '-full' : '';
	
	// Grab the current commenter and the required options. This is so we can mark fields as required.
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	// The field elements with wrappers so we can access them via CSS and JavaScript
	$fields =  array(
		'author' 	=> '<div id="comment-form-elements' . $layout . '"><p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  	=> '<p class="comment-form-email"><label for="email">' . __( 'Email', 'domainreference' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'		=> '<p class="comment-form-url"><label for="url">' . __( 'Website', 'domainreference' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div><!-- /#comment-form-elements --></div><!-- /#comment-form-wrapper -->',
	);
	
	// Now actually render the form
	comment_form(
		array( 
			'comment_notes_before'	=>	'<div id="comment-form-wrapper"><p id="comment-form-avatar">' . get_avatar( '', $size = '50' )  . '</p>',
			'fields'				=>	apply_filters( 'comment_form_default_fields', $fields ),
			'comment_notes_after' 	=>	'<p class="form-allowed-tags">' . sprintf( __( 'Text formatting is available via select <a href="javascript:;">HTML</a>. %s', 'standard' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'logged_in_as'			=>	'<div id="comment-form-wrapper"><p id="comment-form-avatar">' . get_avatar( get_the_author_meta( 'user_email', wp_get_current_user()->ID ), $size = '50' )  . '</p><p id="logged-in-container">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ), wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p></div><!-- /#comment-form-wrapper -->'
		)
	);

} // end standard_comment_form

/**
 * Truncates string at the last breakable space within the string at the
 * character limit and then adds the truncation indicator.
 *
 * @string                   The string to possibly truncate
 * @$character_limit         The number of characters to limit the string to
 * @$truncation_indicator    The characters to end truncation with (if needed)
 */

function standard_truncate_text( $string, $character_limit = 50, $truncation_indicator = '...' ) {

	$truncated = $string;
    if ( strlen( $string ) >= ( $character_limit + 1 ) ) {
    
        $truncated = substr( $string, 0, $character_limit );

        if ( substr_count( $truncated, ' ') > 1 ) {
            $last_space = strrpos( $truncated, ' ' );
            $truncated = substr( $truncated, 0, $last_space );
        } // end if

        $truncated = $truncated . $truncation_indicator;
        
    } // end if/else
    
    return $truncated;
    
} // end standard_truncate_text

/**
 * Helper function for determining if any other SEO plugins are installed. Returns true, if so.
 *
 * @returns	True if 'WordPress SEO' or 'All In One SEO' are installed.
 */
function standard_using_native_seo() {
	return ! ( defined( 'WPSEO_URL' ) || class_exists( 'All_in_One_SEO_Pack' ) );
} // end standard_using_native_seo 

/**
 * If Standard is set to online mode, this function loads and redirects all traffic to the
 * page template defined for offline mode.
 */
function standard_offline_mode() {

	$general_options = get_option('standard_theme_general_options');
	if( 'on' == $general_options['offline_mode'] && ! current_user_can( 'publish_posts' ) ) {
		get_template_part( 'page-offline-mode' );
		exit;
	} // end if
	
} // end standard_offline_mode

/**
 * Helper function for programmatically creating a page.
 * 
 * @params	$slug		The slug by which the page will be accessed
 * @params	$title		The title of the page
 * @params	$template	The name of the template file (without the file extension)
 *
 * @returns	The ID of the page once it was created, or 0 if it failed.
 */
function standard_create_page( $slug, $title, $template = '' ) {

	$current_user = wp_get_current_user();
	
	$page_id = wp_insert_post(	
		array(
			'comment_status'	=>	'closed',
			'ping_status'		=>	'closed',
			'post_author'		=>	$current_user->ID,
			'post_name'			=>	$slug,
			'post_title'		=>	$title,
			'post_status'		=>	'publish',
			'post_type'			=>	'page'
		)
	);
	
	// Set the template
	update_post_meta( $page_id, '_wp_page_template', '' != $template ? $template .= '.php' : $template );
		
	return $page_id;

} // end dittymail_create_page

/* ----------------------------------------------------------- *
 * 9. PressTrends Integration
 * ----------------------------------------------------------- */

// Start of Presstrends Magic
function presstrends() {

	// PressTrends Account API Key
	$api_key = '9fh4lc4ki76p5z3evxxhumir728x4f8mfph5';
	
	// Start of Metrics
	global $wpdb;
	$data = get_transient( 'presstrends_data' );
	
	if ( ! $data || $data == '' ){
	
		$api_base = 'http://api.presstrends.io/index.php/api/sites/update/api/';
		$url = $api_base . $api_key . '/';
		$data = array();
		$count_posts = wp_count_posts();
		$count_pages = wp_count_posts( 'page' );
		$comments_count = wp_count_comments();
		$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
		$plugin_count = count( get_option( 'active_plugins' ) );
		
		$all_plugins = get_plugins();
		foreach( $all_plugins as $plugin_file => $plugin_data ) {
			$plugin_name .= $plugin_data['Name'];
			$plugin_name .= '&';
		} // end foreach
		
		$posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM {$wpdb->prefix}posts WHERE post_type='post' AND comment_count > 0" );
		$comments_to_posts = number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' );
		$pingback_result = $wpdb->get_var( 'SELECT COUNT(comment_ID) FROM '.$wpdb->comments.' WHERE comment_type = "pingback"' );
		$data['url'] = stripslashes( str_replace( array( 'http://', '/', ':' ), '', site_url() ) );
		$data['posts'] = $count_posts->publish;
		$data['pages'] = $count_pages->publish;
		$data['comments'] = $comments_count->total_comments;
		$data['approved'] = $comments_count->approved;
		$data['spam'] = $comments_count->spam;
		$data['pingbacks'] = $pingback_result;
		$data['post_conversion'] = $comments_to_posts;
		$data['theme_version'] = $theme_data['Version'];
		$data['theme_name'] = $theme_data['Name'];
		$data['site_name'] = str_replace( ' ', '', get_bloginfo( 'name' ) );
		$data['plugins'] = $plugin_count;
		$data['plugin'] = urlencode($plugin_name);
		$data['wpversion'] = get_bloginfo('version');
		
		foreach ( $data as $k => $v ) {
			$url .= $k . '/' . $v . '/';
		} // end foreach
		
		$response = wp_remote_get( $url );
		set_transient('presstrends_data', $data, 60 * 60 * 24 );
		
	} // end if
	
} // end presstrends
add_action( 'admin_init', 'presstrends' );
?>