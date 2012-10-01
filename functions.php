<?php

include_once( get_template_directory() . '/lib/Standard_Nav_Walker.class.php' );

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\

	1. Localization
	2. Theme Settings
		- Menu Page
		- Global Options
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
 * Adds the Standard options menu.
 */
function standard_theme_menu() {

	add_menu_page( 
		__( 'Standard Options', 'standard' ),
		__( 'Standard', 'standard' ),
		'administrator',
		'theme_options',
		'standard_theme_options_display',
		get_template_directory_uri() . '/images/icn-standard-small.png',
		59
	);
	
	add_submenu_page(
		'theme_options',
		__( 'Global', 'standard' ),
		__( 'Global', 'standard' ),
		'administrator',
		'theme_options&tab=standard_theme_global_options',
		'standard_theme_options_display'
	);
	
	add_submenu_page(
		'theme_options',
		__( 'Presentation', 'standard' ),
		__( 'Presentation', 'standard' ),
		'administrator',
		'theme_options&tab=standard_theme_presentation_options',
		'standard_theme_options_display'
	);
	
	add_submenu_page(
		'theme_options',
		__( 'Social', 'standard' ),
		__( 'Social', 'standard' ),
		'administrator',
		'theme_options&tab=standard_theme_social_options',
		'standard_theme_options_display'
	);
	
	add_submenu_page(
		'theme_options',
		__( 'Publishing', 'standard' ),
		__( 'Publishing', 'standard' ),
		'administrator',
		'theme_options&tab=standard_theme_publishing_options',
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
function get_standard_theme_default_presentation_options() {

	$defaults = array(
		'fav_icon'					=>	'',
		'contrast'					=>	'light',
		'layout' 					=> 	'right_sidebar_layout',
		'display_breadcrumbs'		=>	'always',
		'display_featured_images' 	=> 	'always'
	);
	
	return apply_filters ( 'standard_theme_default_presentation_options', $defaults );

} // end standard_theme_default_presentation_options
  
/**
 * Defines Standard's presentation options.
 */
function standard_setup_theme_presentation_options() {

	// If the layout options don't exist, create them.
	if( false == get_option( 'standard_theme_presentation_options' ) ) {	
		add_option( 'standard_theme_presentation_options', apply_filters( 'standard_theme_default_presentation_options', get_standard_theme_default_presentation_options() ) );
	} // end if
	
	// Presentation options (composed of layout and content)
	add_settings_section(
		'presentation',
		'',
		'standard_theme_presentation_options_display',
		'standard_theme_presentation_options'
	);
	
	// Layout 
	add_settings_section(
		'layout',
		__( 'Layout and Design', 'standard' ),
		'standard_theme_layout_options_display',
		'standard_theme_presentation_options'
	);

	add_settings_field(
		'logo',
		__( 'Logo', 'standard' ),
		'logo_display',
		'standard_theme_presentation_options',
		'layout'
	);
	
	add_settings_field(
		'fav_icon',
		__( 'Site Icon', 'standard' ),
		'fav_icon_display',
		'standard_theme_presentation_options',
		'layout'
	);
	
	add_settings_field(
		'contrast',
		__( 'Contrast', 'standard' ),
		'contrast_display',
		'standard_theme_presentation_options',
		'layout'
	);

	add_settings_field(
		'left_sidebar_layout',
		__( 'Left Sidebar', 'standard' ),
		'left_sidebar_presentation_display',
		'standard_theme_presentation_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-left.gif'
		)
	);

	add_settings_field(
		'right_sidebar_layout',
		__( 'Right Sidebar', 'standard' ),
		'right_sidebar_presentation_display',
		'standard_theme_presentation_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-right.gif'
		)
	);
	
	add_settings_field(
		'full_width_layout',
		__( 'No Sidebar / Full Width', 'standard' ),
		'full_width_presentation_display',
		'standard_theme_presentation_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-full.gif'
		)
	);
	
	// Content
	add_settings_section(
		'content',
		__( 'Content', 'standard' ),
		'standard_theme_content_options_display',
		'standard_theme_presentation_options'
	);
	
	add_settings_field(
		'display_breadcrumbs',
		__( 'Display Breadcrumbs', 'standard' ),
		'display_breadcrumbs_display',
		'standard_theme_presentation_options',
		'content'
	);
	
	add_settings_field(
		'display_featured_images',
		__( 'Display Featured Images', 'standard' ),
		'display_featured_images_display',
		'standard_theme_presentation_options',
		'content'
	);
	
	register_setting(
		'standard_theme_presentation_options',
		'standard_theme_presentation_options',
		'standard_theme_presentation_options_validate'
	);

} // end standard_setup_theme_presentation_options
add_action( 'admin_init', 'standard_setup_theme_presentation_options' );

function standard_theme_presentation_options_display() {
	/* This is a placeholder function for the Presentation option. It's composed
	 * of the Layout and Content options. 
	 */
} // end standard_theme_presentation_options_display

/** 
 * Renders the description for the "Layout and Design" options.
 */
function standard_theme_layout_options_display() {
	echo '<p>' . __( 'This section controls positioning and style elements.', 'standard' ) . '</p>';
} // end standard_theme_layout_display

/** 
 * Renders the description for the "Content" options.
 */
function standard_theme_content_options_display() {
	echo '<p>' . __( 'This section controls when content elements are displayed.', 'standard' ) . '</p>';
} // end standard_theme_content_display

/**
 * Renders the option element for the Site Icon
 */
function fav_icon_display() {

	$options = get_option( 'standard_theme_presentation_options' );
	
	$fav_icon = '';
	if( isset( $options['fav_icon'] ) ) {
		$fav_icon = $options['fav_icon'];
	} // end if
	
	$html = '<div id="fav_icon_preview_container">';
		$html .= '<img src="' . $fav_icon . '" id="fav_icon_preview" alt="" />';
	$html .= '</div>';
	$html .= '<input type="hidden" id="fav_icon" name="standard_theme_presentation_options[fav_icon]" value="' . esc_attr( $fav_icon ) . '" class="media-upload-field" />';
	$html .= '<input type="button" class="button" id="upload_fav_icon" value="' . __( 'Upload', 'standard' ) . '"/>';
	
	if( '' != trim( $fav_icon ) ) {
		$html .= '<input type="button" class="button" id="delete_fav_icon" value="' . __( 'Delete', 'standard' ) . '"/>';
	} // end if
	
	$html .= '&nbsp;<span class="description">' . __( 'Dimensions: 144px x 144px. Used for favicon and mobile devices.', 'standard' ) . '<a href="http://docs.8bit.io/standard/admin-panel/presentation/" target="_blank">' . __( 'Learn more', 'standard' ) . '</a></span>';
	
	echo $html;
	
} // end fav_icon_display

/**
 * Renders the layout option for the contrast checkbox.
 */
function contrast_display() {

	$options = get_option( 'standard_theme_presentation_options' );
	
	$html = '<select id="contrast" name="standard_theme_presentation_options[contrast]">';
		$html .= '<option value="light"' . selected( $options['contrast'], 'light', false ) . '>' . __( 'Light', 'standard' ) . '</option>';
		$html .= '<option value="dark"' . selected( $options['contrast'], 'dark', false ) . '>' . __( 'Dark', 'standard' )  . '</option>';
	$html .= '</select>';
	$html .= '&nbsp;';
	$html .= '<span class="description">' . __( 'Can be used with <a href="themes.php?page=custom-background">custom backgrounds</a>.', 'standard' ) . '</span>';

	echo $html;
	
} // end contrast_display

/**
 * Renders the option element for the Logo
 */
function logo_display() {

	$options = get_option( 'standard_theme_presentation_options' );
	
	$logo = '';
	if( isset( $options['logo'] ) ) {
		$logo = $options['logo'];
	} // end if
	
	$html = '<div id="logo_preview_container">';
		$html .= '<img src="' . $logo . '" id="logo_preview" alt="" />';
	$html .= '</div><!-- #logo_preview_container -->';
	
	$html .= '<input type="hidden" id="logo" name="standard_theme_presentation_options[logo]" value="' . esc_attr( $logo ) . '" class="media-upload-field" />';
	$html .= '<input type="button" class="button" id="upload_logo" value="' . __( 'Upload', 'standard' ) . '"/>';
	
	if( '' != trim( $logo ) ) {
		$html .= '<input type="button" class="button" id="delete_logo" value="' . __( 'Delete', 'standard' ) . '"/>';
	} // end if
	
	$html .= '&nbsp;<span class="description">' . __( 'Use an image in place of the <a href="themes.php?page=custom-header">Site Title and Tagline</a>. <a href="themes.php?page=custom-header">Custom Headers</a> are also available.', 'standard' ) . '</span>';
	
	echo $html;
	
} // end logo_display

/**
 * Renders the left-sidebar layout option.
 *
 * @param	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function left_sidebar_presentation_display( $args ) {
	
	$options = get_option( 'standard_theme_presentation_options' );

	$html = '<input type="radio" id="standard_theme_left_sidebar_layout" name="standard_theme_presentation_options[layout]" value="left_sidebar_layout"' . checked( 'left_sidebar_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;
	
} // end left_sidebar_presentation_display

/**
 * Renders the right-sidebar layout option.
 *
 * @param	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function right_sidebar_presentation_display( $args ) {
	
	$options = get_option( 'standard_theme_presentation_options' );
 	
	$html = '<input type="radio" id="standard_theme_right_sidebar_layout"  name="standard_theme_presentation_options[layout]" value="right_sidebar_layout"' . checked( 'right_sidebar_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;
	
} // end right_sidebar_presentation_display

/**
 * Renders the full width layout option.
 *
 * @param	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function full_width_presentation_display( $args ) {

	$options = get_option( 'standard_theme_presentation_options' );
 	
	$html = '<input type="radio" id="standard_theme_full_width_layout"  name="standard_theme_presentation_options[layout]" value="full_width_layout"' . checked( 'full_width_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;

} // end full_width_presentation_display

/**
 * Renders the breadcrumb options.
 *
 * @param	$args	The array of options used for rendering the option.
 */
function display_breadcrumbs_display() {
	
	$options = get_option( 'standard_theme_presentation_options' );

	$display_breadcrumbs = '';
	if( isset( $options['display_breadcrumbs'] ) ) {
		$display_breadcrumbs = $options['display_breadcrumbs'];
	} // end if

	$html = '<select id="display_breadcrumbs" name="standard_theme_presentation_options[display_breadcrumbs]">';
		$html .= '<option value="always"'. selected( $options['display_breadcrumbs'], 'always', false ) . '>' . __( 'Always', 'standard' ) . '</option>';
		$html .= '<option value="never"'. selected( $options['display_breadcrumbs'], 'never', false ) . '>' . __( 'Never', 'standard' ) . '</option>';
	$html .= '</select>';

	$html .= '&nbsp;<span class="description">' . __( 'SEO experts encourage breadcrumb use. <a href="http://docs.8bit.io/standard/admin-panel/presentation/">Learn more</a>.', 'standard' ) . '</span>';
	
	echo $html;
	
} // end display_breadcrumbs_display

/**
 * Renders the options for displaying Featured Images.
 *
 * @param	$args	The array of options used for rendering the option.
 */
function display_featured_images_display( $args ) {

	$options = get_option( 'standard_theme_presentation_options' );

	$html = '<select id="display_featured_image" name="standard_theme_presentation_options[display_featured_images]">';
		$html .= '<option value="always"'. selected( $options['display_featured_images'], 'always', false ) . '>' . __( 'Always', 'standard' ) . '</option>';
		$html .= '<option value="never"'. selected( $options['display_featured_images'], 'never', false ) . '>' . __( 'Never', 'standard' ) . '</option>';
		$html .= '<option value="index"'. selected( $options['display_featured_images'], 'index', false ) . '>' . __( 'On index only', 'standard' ) . '</option>';
		$html .= '<option value="single-post"'. selected( $options['display_featured_images'], 'single-post', false ) . '>' . __( 'On single posts only', 'standard' ) . '</option>';
	$html .= '</select>';

	echo $html;

} // end display_featured_images_display


/**
 * Sanitization callback for the layout options. Since each of the layout options are checkboxes,
 * this function loops through the incoming options and verifies they are either empty strings
 * or the number 1.
 *	
 * @param	$input	The unsanitized collection of options.
 *
 * @return			The collection of sanitized values.
 */
function standard_theme_presentation_options_validate( $input ) {
	
	$output = array();

	foreach( $input as $key => $val ) {

		if( isset ( $input[$key] ) ) {
			$output[$key] = $input[$key];
		} // end if	
	
	} // end foreach
	
	return apply_filters( 'standard_theme_presentation_options_validate', $output, $input, get_standard_theme_default_presentation_options() );

} // end standard_theme_presentation_options_validate

/* ----------------------------- *
 * 	Social Options
 * ----------------------------- */

/**
 * Defines the default values for Standard's social options.
 */
function get_standard_theme_default_social_options() {
	
	$defaults = array(
		'active-social-icons'		=> '',
		'available-social-icons' 	=> ''
	);
	
	return apply_filters ( 'standard_theme_social_options', $defaults );

} // end get_standard_theme_default_social_options

/**
 * Defines Standard's "social" options.
 */
function standard_setup_theme_social_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'standard_theme_social_options' ) ) {	
		add_option( 'standard_theme_social_options', apply_filters( 'standard_theme_default_social_options', get_standard_theme_default_social_options() ) );
	} // end if
	
	// Look to see if any new icons have been added to the library since the last version of the theme
	get_standard_theme_default_social_options();

	/* ------------------ Social Networks ------------------ */
	
	add_settings_section(
		'social',
		'',
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

	_e( 'This section controls social network icons in the site header. Drag, drop, and position desired icons from the Icon Library to the Active Icons area. This section controls social network icons in the site header. Drag, drop, and position desired icons from the Icon Library to the Active Icons area. You can also delete all icons and <a href="javascript:;" id="reset-social-icons" class="ad_delete">restore defaults.</a>', 'standard' );	

	$html = '<div class="social-icons-wrapper">';
	
		$html .= '<div id="social-icons-active" class="left">';
			$html .= '<div class="sidebar-name">';
				$html .= '<h3>' . __( 'Active Icons', 'standard' ) . '</h3>';
			$html .= '</div><!-- /.sidebar-name -->';
			$html .= '<div id="active-icons">';
				$html .= '<p class="description">' . __( 'Click an icon to set the full URL.', 'standard' ) . '</p>';
				$html .= '<ul id="active-icon-list"></ul>';
				$html .= '<div id="active-icon-url" class="hidden">';
					$html .= '<label>' . __( 'Icon URL:', 'standard' ) . '</label>';
					$html .= '<input type="text" id="social-icon-url" value="" class="icon-url" data-via="" data-url="" />';
					$html .= '&nbsp;<span class="description" id="social-rss-icon-controls">';
						$html .= '<a href="http://docs.8bit.io/standard/social" target="_blank">' . __( 'Learn More', 'standard' ) . '</a>';
					$html .= '</span><!-- /#social-rss-icon-controls -->';
					$html .= '<span id="social-icon-controls">';
						$html .= '<input type="button" class="button" id="set-social-icon-url" value="' . __( 'Done', 'standard' ). '" />';
						$html .= '&nbsp;';
						$html .= '<a href="javascript:;" id="cancel-social-icon-url">' . __( 'Cancel', 'standard' ) . '</a>';
					$html .= '</span><!-- /#social-icon-controls -->';
				$html .= '</div><!-- /#active-icon-url -->';
				$html .= '<div id="social-icon-max" class="hidden alert alert-info"><i class="icon icon-warning"></i> ' . __( 'Standard looks best with seven icons or fewer.', 'standard' ) . '</div>';
			$html .= '</div><!-- /#active-icons -->';
		$html .= '</div><!-- /#social-icons-active -->';
		
		$html .= '<div id="social-icons-available" class="right">';
			$html .= '<div class="sidebar-name">';
				$html .= '<h3>' . __( 'Icon Library', 'standard' ) . '</h3>';
			$html .= '</div><!-- /.sidebar-name -->';
			$html .= '<div id="available-icons">';
				$html .= '<p class="description">' . __( 'Use native social icons or upload your own.', 'standard' ) . '</p>';
				$html .= '<ul id="available-icon-list"></ul>';
				$html .= '<div id="delete-icons" class="description"><i class="icon icon-trash"></i><br>' . __( 'Drag social icons here to remove them from your library.', 'standard' ) . '</div>';
			$html .= '<div id="social-icons-operations">';
				$html .= '<input type="button" class="button" id="upload-social-icon" value="' . __( 'Upload New Icon', 'standard') . '" />';
			$html .= '</div><!-- /#social-icons-operations -->';
			$html .= '</div><!-- /#available-icons -->';
		$html .= '</div><!-- /.social-icons-available -->';
		
		$html .= '<span id="standard-save-social-icons-nonce" class="hidden">' . wp_create_nonce( 'standard_save_social_icons_nonce' ) . '</span>';
		$html .= '<span id="standard-wordpress-rss-url" class="hidden">' . esc_url( standard_get_rss_feed_url() ) . '</span>';
		$html .= '<span id="standard-reset-social-icons" class="hidden">' . wp_create_nonce( 'standard_reset_social_icons_nonce' ) . '</span>';
		
	$html .= '</div><!-- /.social-icons-wrapper -->';
	
	echo $html;
	
} // end standard_theme_social_options_display

/**
 * Callback function used in the Ajax request for generating the Social Icons.
 */
function standard_save_social_icons( ) {
	
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_save_social_icons_nonce' ) && isset( $_POST['updateSocialIcons'] ) ) {
		
		// Manually create the input array of options
		$input = array(	
			'available-social-icons'	=>	$_POST['availableSocialIcons'],
			'active-social-icons' 		=> 	$_POST['activeSocialIcons']
		);
		
		if( update_option( 'standard_theme_social_options', standard_theme_social_options_validate( $input ) ) ) {
			die( '0' );
		} else {
			die( '1' );
		} // end if/else
		
	} else {
		die( '-1' );
	} // end if/else

} // end standard_save_social_icons
add_action( 'wp_ajax_standard_save_social_icons', 'standard_save_social_icons' );

/**
 * Callback function used in the Ajax request for resetting the Social Icons.
 */
function standard_reset_social_icons( ) {
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_reset_social_icons_nonce' ) ) {
		die( delete_option( 'standard_theme_social_options' ) );
	} // end if/else
} // end standard_save_social_icons
add_action( 'wp_ajax_standard_reset_social_icons', 'standard_reset_social_icons' );

/**
 * Displays the message for users attempting to delete the core set of Standard social icons.
 */
function standard_delete_social_icons() {
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard-delete-social-icon-nonce' ) ) {
		die( standard_display_delete_social_icon_message() );
	} // end if
} // end standard_delete_social_icons
add_action( 'wp_ajax_standard_delete_social_icons', 'standard_delete_social_icons' );

/**
 * Generates a message to be displayed when the user attempts to delete a Standard social icon.
 */
function standard_display_delete_social_icon_message() {

	$html = '<div id="standard-delete-social-icons" class="updated">';
		$html .= '<p>';
			$html .= __( 'You cannot delete the default set of Standard social icons. <a href="javascript:;" id="standard-hide-delete-social-icon-message">Hide this message.</a>', 'standard' );
		$html .= '</p>';
	$html .= '</div><!-- /#standard-delete-social-icons -->';
	
	echo $html;
		
} // end standard_display_delete_social_icon_message

/**
 * Renders the available social icon input. This field is hidden and is manipulated by the functionality for powering
 * the drag and drop functionality of the icons.
 */
function standard_available_icons_display() {
	
	$options = get_option( 'standard_theme_social_options' );
	
	$html = '<input type="text" id="available-social-icons" name="standard_theme_social_options[available-social-icons]" value="' . $options['available-social-icons'] . '" />';
	$html .= '<span id="standard-delete-social-icon-nonce" class="">' . wp_create_nonce( 'standard-delete-social-icon-nonce' ) . '</span>';
	
	echo $html;
	
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
 * @param	$input	The unsanitized collection of options.
 *
 * @return			The collection of sanitized values.
 */
function standard_theme_social_options_validate( $input ) {

	$output = $defaults = get_standard_theme_default_social_options();

	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) ) {
			$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if	
	
	} // end foreach
	
	return apply_filters( 'standard_theme_social_options_validate', $output, $input, $defaults );

} // end standard_theme_options_validate

/**
 * When upgrading to newer versions of Standard, looks for any new icons that may exist in the social
 * icons directory.
 *
 * If so, it will add them to the available icons. It exempts icons that are already active.
 *
 * If users have uploaded their own icons for ones that we have included, such as LinkedIn or
 * SoundCloud then they'll need to 'Restore Defaults' and configure their own. 
 *
 * @since	3.1
 */
function standard_find_new_social_icons() {
	
	// Be sure to look for any additional social icons
	$social_options = get_option( 'standard_theme_social_options' );
	
	if( $handle = opendir( get_template_directory() . '/images/social/small' ) ) {
		
		$available_icons = '';
		while( false != ( $filename = readdir( $handle ) ) ) {
			
			// If we're not looking at the current directory, the directory above, or DS_Store...
			if( '.' != $filename && '..' != $filename && '.ds_store' != strtolower( $filename) ) {
				
				// Get the icons filename
				$new_icon_filename = '/images/social/small/' . $filename . ';';
				
				// Now if this filename is not found in the active icons, we'll add it
				if( ! is_numeric ( strpos( $social_options['active-social-icons'], substr($new_icon_filename, 0, strlen( $new_icon_filename ) - 1) ) ) ) {
					$available_icons .= get_template_directory_uri() . $new_icon_filename;
				} // end if
				
			} // end if
			
		} // end while
		
		// Set the new icons
		$social_options['available-social-icons'] = $available_icons;
		
		// Update the option
		update_option( 'standard_theme_social_options', $social_options );
		
	} // end if
	
} // end standard_find_new_social_icons

/* ----------------------------- *
 * 	Global Options
 * ----------------------------- */

/**
 * Defines the default values for Standard's global options.
 */
function get_standard_theme_default_global_options() {

	$defaults = array(
		'site_mode'					=>	'online',
		'feedburner_url'			=>	'',
		'google_analytics'			=>	'',
		'affiliate_code'			=>	'',
		'offline_display_message'	=>	__( 'Our site is currently offline.', 'standard' )
	);
	
	return apply_filters ( 'standard_theme_default_global_options', $defaults );

} // end get_standard_theme_default_global_options

/**
 * Defines Standard's "global" options.
 */
function standard_setup_theme_global_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'standard_theme_global_options' ) ) {	
		add_option( 'standard_theme_global_options', apply_filters( 'standard_theme_default_global_options', get_standard_theme_default_global_options() ) );
	} // end if
	
	/* ------------------ Page Options ------------------ */
	
	add_settings_section(
		'global',
		'',
		'standard_theme_global_options_display',
		'standard_theme_global_options'
	);
	
	add_settings_field(
		'feedburner_url',
		__( 'FeedBurner URL', 'standard' ),
		'feedburner_url_display',
		'standard_theme_global_options',
		'global'
	);
	
	add_settings_field(
		'google_analytics',
		__( 'Google Analytics', 'standard' ),
		'google_analytics_display',
		'standard_theme_global_options',
		'global'
	);
	
	add_settings_field(
		'affiliate_code',
		__( 'Affiliate Code', 'standard' ),
		'affiliate_code_display',
		'standard_theme_global_options',
		'global'
	);
	
	add_settings_field(
		'site_mode',
		__( 'Site Mode', 'standard' ),
		'site_mode_display',
		'standard_theme_global_options',
		'global'
	);
	
	add_settings_field(
		'offline_message',
		__( 'Offline Message', 'standard' ),
		'offline_message_display',
		'standard_theme_global_options',
		'global'
	);
	
	register_setting(
		'standard_theme_global_options',
		'standard_theme_global_options',
		'standard_theme_global_options_validate'
	);

} // end standard_setup_theme_global_options
add_action( 'admin_init', 'standard_setup_theme_global_options' );

/** 
 * Renders the description for the "Global" options settings page.
 */
function standard_theme_global_options_display() {

	$html = '<h3>' . __( 'Site Configuration ', 'standard' ) . '</h3>';
	$html .= '<p>' . __( 'This section controls site wide features.', 'standard' ) . '</p>';
	
	echo $html;
	
} // end standard_theme_global_options_display

/**
 * Renders the option element for Google Analytics.
 */
function feedburner_url_display() {

	$option = get_option( 'standard_theme_global_options' );
	
	// Only render this option for administrators
	if( current_user_can( 'manage_options' ) ) {
	
		$feedburner_url = '';
		if( true == isset ( $option['feedburner_url'] ) ) {
			$feedburner_url = $option['feedburner_url'];
		} // end if
		
		$html = '<input type="text" id="feedburner_url" name="standard_theme_global_options[feedburner_url]" placeholder="http://feeds.feedburner.com/example" value="' . esc_attr( $feedburner_url ) . '" />';
		$html .= '&nbsp;<span class="description">' . __( 'Use in place of the native RSS feed.', 'standard' ) . '</span>';
		
		echo $html;

	} // end if/else
	
} // end google_analytics_display

/**
 * Renders the option element for Google Analytics.
 */
function google_analytics_display() {

	$option = get_option( 'standard_theme_global_options' );
	
	// Only render this option for administrators
	if( current_user_can( 'manage_options' ) ) {
	
		$analytics_id = '';
		if( true == isset ( $option['google_analytics'] ) ) {
			$analytics_id = $option['google_analytics'];
		} // end if
		
		$html = '<input type="text" id="google_analytics" name="standard_theme_global_options[google_analytics]" placeholder="UA-000000" value="' . esc_attr( $analytics_id ) . '" />';
		$html .= '&nbsp;<span class="description">' . __( 'Enter the ID only.', 'standard' ) . '</span>';
		
		echo $html;

	} // end if/else
	
} // end google_analytics_display

/**
 * Renders the option element for the Affiliate Code
 */
function affiliate_code_display() {

	$option = get_option( 'standard_theme_global_options' );
	
	$affiliate_code = '';
	if( true == isset ( $option['affiliate_code'] ) ) {
		$affiliate_code = $option['affiliate_code'];
	} // end if
	
	$html = '<input type="text" id="affiliate_code" name="standard_theme_global_options[affiliate_code]" value="' . esc_attr( $affiliate_code ) . '" />';
	$html .= '&nbsp;<span class="description">' . __( 'Earn money by recommending Standard to your site visitors. <a href="http://docs.8bit.io/standard/affiliates" target="_blank">Learn more</a>.', 'standard' ) . '</span>';
	
	echo $html;

} // end affiliate_code_display

/**
 * Renders the options for activating Offline Line.
 */
function site_mode_display( ) {

	$options = get_option( 'standard_theme_global_options' );

	$site_mode = '';
	if( isset( $options['site_mode'] ) ) {
		$site_mode = $options['site_mode'];
	} // end if

	$html = '<select id="site_mode" name="standard_theme_global_options[site_mode]">';
		$html .= '<option value="online"' . selected( $site_mode, 'online', false ) . '>' . __( 'Online', 'standard' ) .'</option>';
		$html .= '<option value="offline"' . selected( $site_mode, 'offline', false ) . '>' . __( 'Offline', 'standard' ) .'</option>';
	$html .= '</select>';
	
	$html .= '&nbsp;';
	
	$html .= '<span class="description">';
		$html .= __( 'WARNING: Taking site offline will hide all content from site visitors and search engines.', 'standard' );
	$html .= '</span>';

	echo $html;

} // end site_mode_display

/**
 * Renders the options for the short, 140-character message for the offline mode.
 */
function offline_message_display() {

	$options = get_option( 'standard_theme_global_options' );
	
	$offline_message = '';
	if( isset( $options['offline_message'] ) ) {
		$offline_message = $options['offline_message'];
	} // end if
	
	echo '<input type="text" id="offline_message" name="standard_theme_global_options[offline_message]" value="' . esc_attr( $offline_message ) . '" maxlength="140" />';

} // end offline_message_display

/**
 * Sanitization callback for the global options.
 *	
 * @param	$input	The unsanitized collection of options.
 *
 * @return			The collection of sanitized values.
 */
function standard_theme_global_options_validate( $input ) {

	$output = array();

	foreach( $input as $key => $val ) {

		if( isset ( $input[$key] ) ) {
			$output[$key] = strip_tags( stripslashes( $input[$key] ) );
		} // end if	
		
		if( 'affiliate_code' == $key ) {
			$output[$key] = esc_url ( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if
	
	} // end foreach

	return apply_filters( 'standard_theme_global_options_validate', $output, $input, get_standard_theme_default_global_options() );

} // end standard_theme_global_options_validate

/* ----------------------------- *
 * 	Publishing Options
 * ----------------------------- */
 
 /**
 * Defines the default values for Standard's post options in the Publishing screen.
 */
function get_standard_theme_default_publishing_options() {

	$defaults = array(
		'display_author_box'			=>	'always'
	);
	
	return apply_filters ( 'standard_theme_default_publishing_options', $defaults );

} // end get_standard_theme_default_publishing_options

/**
 * Defines Standard's "publishing" options.
 */
function standard_setup_theme_publishing_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'standard_theme_publishing_options' ) ) {	
		add_option( 'standard_theme_publishing_options', apply_filters( 'standard_theme_publishing_options', get_standard_theme_default_publishing_options() ) );
	} // end if
	
	// Publishing options (composed of Post and Pages)
	add_settings_section(
		'publishing',
		'',
		'standard_theme_publishing_options_display',
		'standard_theme_publishing_options'
	);

	// Post options
	add_settings_section(
		'post',
		__( 'Posts', 'standard' ),
		'standard_theme_post_options_display',
		'standard_theme_publishing_options'
	);
	
	add_settings_field(
		'display_author_box',
		__( 'Display Author Box', 'standard' ),
		'display_author_box_display',
		'standard_theme_publishing_options',
		'post'
	);
	
	// Page options
	add_settings_section(
		'page',
		__( 'Pages', 'standard' ),
		'standard_theme_page_options_display',
		'standard_theme_publishing_options'
	);
	
	add_settings_field(
		'privacy_policy_template',
		__( 'Privacy Policy', 'standard' ),
		'privacy_policy_template_display',
		'standard_theme_publishing_options',
		'page'
	);

	add_settings_field(
		'comment_policy_template',
		__( 'Comment Policy', 'standard' ),
		'comment_policy_template_display',
		'standard_theme_publishing_options',
		'page'
	);

	register_setting(
		'standard_theme_publishing_options',
		'standard_theme_publishing_options',
		'standard_theme_publishing_options_validate'
	);

} // end standard_setup_theme_publishing_options
add_action( 'admin_init', 'standard_setup_theme_publishing_options' );

function standard_theme_publishing_options_display() {
	/* This is a placeholder function for the Presentation option. It's composed
	 * of the Post and Page options. 
	 */
} // end standard_theme_presentation_options_display

/** 
 * Renders the description for the "Post" options settings in the Publishing section.
 */
function standard_theme_post_options_display() {
	echo '<p>' . __( 'This section controls publisher-centric features available on individual posts.', 'standard' ) . '</p>';
} // end standard_theme_post_options_display

/** 
 * Renders the description for the "Page" options settings in the Publishing section.
 */
function standard_theme_page_options_display() {
	echo '<p>' . __( 'This section controls publisher-centric features available for pages.', 'standard' ) . '</p>';
} // end standard_theme_page_options_display

/**
 * Renders the author box option.
 *
 * @param	$args	The array of options used for rendering the option.
 */
function display_author_box_display() {
	
	$options = get_option( 'standard_theme_publishing_options' );

	$display_author_box = '';
	if( isset( $options['display_author_box'] ) ) {
		$display_author_box = $options['display_author_box'];
	} // end if

	$html = '<select id="display_author_box" name="standard_theme_publishing_options[display_author_box]">';
		$html .= '<option value="always"' . selected( $options['display_author_box'], 'always', false ) . '>' . __( 'Always', 'standard' ) . '</option>';
		$html .= '<option value="never"' . selected( $options['display_author_box'], 'never', false ) . '>' . __( 'Never', 'standard' )  . '</option>';
	$html .= '</select>';

	$html .= '&nbsp;<span class="description">' . __( "Display name, website, social networks, and bio from the <a href='profile.php'>author's profile</a> after post content.", 'standard' ) . '</span>';
	
	echo $html;
	
} // end display_author_box_display

/**
 * Renders the option for generating a Privacy Policy from within the Standard dashboard.
 */
function privacy_policy_template_display() {

	// First, detect if the privacy policy page exists
	$privacy_policy = get_page_by_title( __( 'Privacy Policy', 'standard' ) );
	
	// Options to display if the page doesn't already exist
	$html = '<div id="generate-privacy-policy-wrapper"' . ( '' == $privacy_policy ? ' ' : ' class="hidden" ' )  . '>';
		$html .= '<input type="submit" class="button-secondary" id="generate_privacy_policy" name="generate_privacy_policy" value="' . __( 'Generate', 'standard' ) . '" />';
		$html .= '<span id="standard-privacy-policy-nonce" class="hidden">' . wp_create_nonce( 'standard_generate_privacy_policy_nonce' ) . '</span>';
		$html .= '&nbsp;';
		$html .= '<span class="description">' . __( '<a href="http://docs.8bit.io/standard/admin-panel/publishing/" target="_blank">' . __( 'Learn more', 'standard' ) . '</a>.', 'standard' ) . '</span>';
	$html .= '</div><!-- /#generate-private-policy-wrapper -->';
	
	// Options to display if the page already exists
	$html .= '<div id="has-privacy-policy-wrapper"' . ( '' == $privacy_policy ? ' class="hidden" ' : '' )  . '>';
	
		$policy_id = 'null-privacy-policy';
		if( null != $privacy_policy ) {
			$policy_id = $privacy_policy->ID;
		} // end if
		
		$html .= '<input type="submit" class="button-secondary" id="delete_privacy_policy" name="delete_privacy_policy" value="' . __( 'Delete', 'standard' ) . '" />';
		$html .= '&nbsp;';
		$html .= '<span>' . __( 'Warning, customizations will be lost. You can view or edit your policy ', 'standard' ) . '<a id="edit-privacy-policy" href="post.php?post=' . $policy_id . '&action=edit">' . __( 'here', 'standard' ) . '</a>.</span>';
		$html .= '<span class="hidden" id="privacy_policy_id">' . $policy_id . '</span>';
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
		$html .= '<input type="submit" class="button-secondary" id="generate_comment_policy" name="generate_comment_policy" value="' . __( 'Generate', 'standard' ) . '" />';
		$html .= '<span id="standard-comment-policy-nonce" class="hidden">' . wp_create_nonce( 'standard_generate_comment_policy_nonce' ) . '</span>';
		$html .= '&nbsp;';
		$html .= '<span class="description">' . __( '<a href="http://docs.8bit.io/standard/admin-panel/publishing/" target="_blank">' . __( 'Learn more', 'standard' ) . '</a>.', 'standard' ) . '</span>';
	$html .= '</div><!-- /#generate-comment-policy-wrapper -->';
	
	// Options to display if the page already exists
	$html .= '<div id="has-comment-policy-wrapper"' . ( '' == $comment_policy ? ' class="hidden" ' : '' )  . '>';
	
		$policy_id = 'null-comment-policy';
		if( null != $comment_policy ) {
			$policy_id = $comment_policy->ID;
		} // end if
		
		$html .= '<input type="submit" class="button-secondary" id="delete_comment_policy" name="delete_comment_policy" value="' . __( 'Delete', 'standard' ) . '" />';
		$html .= '&nbsp;';
		$html .= '<span>' . __( 'Warning, customizations will be lost. You can view or edit your policy ', 'standard' ) . '<a id="edit-comment-policy" href="post.php?post=' . $policy_id . '&action=edit">' . __( 'here', 'standard' ) . '</a>.</span>';
		$html .= '<span class="hidden" id="comment_policy_id">' . $policy_id . '</span>';
	$html .= '</div><!-- /#has-comment-policy-wrapper -->';
	
	echo $html;

} // end comment_policy_template_display

/**
 * Callback function used in the Ajax request for generating the Privacy Policy.
 */
function standard_generate_privacy_policy_page( ) {
	
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_generate_privacy_policy_nonce' ) && isset( $_POST['generatePrivacyPolicy'] ) ) {
		
		$page_id = standard_create_page( 'privacy-policy', __( 'Privacy Policy', 'standard' ) );
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
 * Callback function used in the Ajax request for deleting the Privacy Policy.
 */
function standard_delete_privacy_policy_page( ) {
	
	// We'll be using the same nonce for generating the policy.
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_generate_privacy_policy_nonce' ) && isset( $_POST['deletePrivacyPolicy'] ) && isset( $_POST['page_id'] ) ) {
		
		if( standard_delete_page( $_POST['page_id'] ) ) {
			die( '0' );
		} else {
			die( '1' );
		} // end if/else
		
	} else {
		die( '-1' );
	} // end if/else

} // end standard_delete_privacy_policy_page
add_action( 'wp_ajax_standard_delete_privacy_policy_page', 'standard_delete_privacy_policy_page' );

/**
 * Callback function used in the Ajax request for generating the Comment Policy.
 */
function standard_generate_comment_policy_page( ) {
	
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_generate_comment_policy_nonce' ) && isset( $_POST['generateCommentPolicy'] ) ) {
		
		$page_id = standard_create_page( 'comment-policy', __( 'Comment Policy', 'standard' ) );
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
 * Callback function used in the Ajax request for deleting the Privacy Policy.
 */
function standard_delete_comment_policy_page( ) {
	
	// We'll be using the same nonce for generating the policy.
	if( wp_verify_nonce( $_REQUEST['nonce'], 'standard_generate_comment_policy_nonce' ) && isset( $_POST['deleteCommentPolicy'] ) && isset( $_POST['page_id'] ) ) {
		
		if( standard_delete_page( $_POST['page_id'] ) ) {
			die( '0' );
		} else {
			die( '1' );
		} // end if/else
		
	} else {
		die( '-1' );
	} // end if/else

} // end standard_delete_comment_policy_page
add_action( 'wp_ajax_standard_delete_comment_policy_page', 'standard_delete_comment_policy_page' );

/**
 * Sanitization callback for the post options in the Publishing options.
 *	
 * @param	$input	The unsanitized collection of options.
 *
 * @return			The collection of sanitized values.
 */
function standard_theme_publishing_options_validate( $input ) {

	$output = array();

	foreach( $input as $key => $val ) {

		if( isset ( $input[$key] ) ) {
			$output[$key] = strip_tags( stripslashes( $input[$key] ) );
		} // end if	
	
	} // end foreach

	return apply_filters( 'standard_theme_publishing_options_validate', $output, $input, get_standard_theme_default_publishing_options() );

} // end standard_theme_publishing_options_validate

/* ----------------------------- *
 * 	Options Page
 * ----------------------------- */

/**
 * Renders the theme options display page.
 */
function standard_theme_options_display() {
?>
	<div id="standard-options" class="wrap">
		<div id="standard-info">
		
			<div id="icon-themes" class="icon32"></div>
			<h3 id="standard-title"><?php _e( 'Standard', 'standard' ); ?> <span><?php _e( 'for publishers', 'standard' ); ?></span></h3>
			
			<div id="standard-desc">
				<p><?php _e( 'Standard is a sleek, exacting product designed for uncluttered and sophisticated presentation of your content on desktop and mobile devices.', 'standard' ); ?></p>
			</div>
		</div><!--/#standard-info -->
		
		<div id="standard-options-links">
			<ul>
				<li><a class="standard-docs" href="http://docs.8bit.io/standard/" target="_blank"><?php _e( 'Documentation', 'standard' ); ?></a></li>
				<li><a class="standard-support" href="http://support.8bit.io" target="_blank"><?php _e( 'Support', 'standard' ); ?></a></li>
				<li><a class="standard-blog" href="http://8bit.io" target="_blank"><?php _e( 'Blog', 'standard' ); ?></a></li>
			</ul>
		</div>
		
		<div class="clear"></div>
		
		<?php $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'standard_theme_global_options'; ?>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_global_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_global_options"><?php _e( 'Global', 'standard' ); ?></a>
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_presentation_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_presentation_options"><?php _e( 'Presentation', 'standard' ); ?></a>
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_social_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_social_options"><?php _e( 'Social', 'standard' ); ?></a>
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_publishing_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_publishing_options"><?php _e( 'Publishing', 'standard' ); ?></a>
		</h2>
		
		<div id="message-container"><?php settings_errors(); ?></div>

		<form method="post" action="options.php">
			<?php

				if( 'standard_theme_global_options' == $active_tab ) {
				
					settings_fields( 'standard_theme_global_options' );
					do_settings_sections( 'standard_theme_global_options' );
					
				} else if( 'standard_theme_presentation_options' == $active_tab ) {
				
					settings_fields( 'standard_theme_presentation_options' );
					do_settings_sections( 'standard_theme_presentation_options' );

				} else if( 'standard_theme_social_options' == $active_tab ) {
				
					settings_fields( 'standard_theme_social_options' );
					do_settings_sections( 'standard_theme_social_options' );					
					
				} else {
			
					do_settings_sections( 'standard_theme_publishing_options' );
					settings_fields( 'standard_theme_publishing_options' );
					
				} // end if/else
				
				// Display the 'Save Changes' button
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
 * Implements the Theme Customizer for installations that are on WordPress 3.4 or greater.
 * 
 * @param	$wp_customize	The WordPress Theme Customizer
 */
if( standard_is_on_wp34() ) {
	
	function standard_customize_register( $wp_customize ) {

		// Presentation Options
		$wp_customize->add_section( 'standard_theme_presentation_options', 
			array(
				'title'          => __( 'Presentation', 'standard' ),
				'priority'       => 150
			) 
		);
	
		// Contrast
		$wp_customize->add_setting( 'standard_theme_presentation_options[contrast]', 
			array(
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'edit_theme_options'
			) 
		);
	
		$wp_customize->add_control( 'standard_theme_presentation_options[contrast]', 
			array(
				'label'      => __( 'Contrast', 'standard' ),
				'section'    => 'standard_theme_presentation_options',
				'settings'   => 'standard_theme_presentation_options[contrast]',
				'type'       => 'select',
				'choices'    => array(
					'light' => __( 'Light', 'standard' ),
					'dark'  => __( 'Dark', 'standard' )
				),
			) 
		);
		
		// Logo
		$wp_customize->add_setting( 'standard_theme_presentation_options[logo]', 
			array(
				'default'        => '',
				'type'           => 'option',
				'capability'     => 'edit_theme_options'
			) 
		);
		
		$wp_customize->add_control( 
			new WP_Customize_Image_Control( 
				$wp_customize, 
				'standard_theme_presentation_options[logo]',
				array(
					'label'		=>	__( 'Logo', 'standard' ),
					'section'	=>	'standard_theme_presentation_options',
					'settings'  => 'standard_theme_presentation_options[logo]'
				)
			)
		);
		
		// Layout
		$wp_customize->add_setting( 'standard_theme_presentation_options[layout]', 
			array(
				'default'        => 'right_sidebar_layout',
				'type'           => 'option',
				'capability'     => 'edit_theme_options'
			) 
		);
	
		$wp_customize->add_control( 'standard_theme_presentation_options[layout]', 
			array(
				'label'      => __( 'Layout', 'themename' ),
				'section'    => 'standard_theme_presentation_options',
				'settings'   => 'standard_theme_presentation_options[layout]',
				'type'       => 'select',
				'choices'    => array(
					'left_sidebar_layout' 	=> __( 'Left Sidebar', 'standard' ),
					'right_sidebar_layout' 	=> __( 'Right Sidebar', 'standard' ),
					'full_width_layout'		=> __( 'No Sidebar / Full-Width', 'standard' )
				),
			) 
		);
		
		// Breadcrumbs
		$wp_customize->add_setting( 'standard_theme_presentation_options[display_breadcrumbs]', 
			array(
				'default'        => 'always',
				'type'           => 'option',
				'capability'     => 'edit_theme_options'
			) 
		);
	
		$wp_customize->add_control( 'standard_theme_presentation_options[display_breadcrumbs]', 
			array(
				'label'      => __( 'Display Breadcrumbs', 'standard' ),
				'section'    => 'standard_theme_presentation_options',
				'settings'   => 'standard_theme_presentation_options[display_breadcrumbs]',
				'type'       => 'select',
				'choices'    => array(
					'always' 		=>	__( 'Always', 'standard' ),
					'never' 		=>  __( 'Never', 'standard' )
				)
			) 
		);
		
		// Featured Images
		$wp_customize->add_setting( 'standard_theme_presentation_options[display_featured_images]', 
			array(
				'default'        => 'always',
				'type'           => 'option',
				'capability'     => 'edit_theme_options'
			) 
		);
	
		$wp_customize->add_control( 'standard_theme_presentation_options[display_featured_images]', 
			array(
				'label'      => __( 'Display Featured Images', 'themename' ),
				'section'    => 'standard_theme_presentation_options',
				'settings'   => 'standard_theme_presentation_options[display_featured_images]',
				'type'       => 'select',
				'choices'    => array(
					'always' 		=>	__( 'Always', 'standard' ),
					'never' 		=>  __( 'Never', 'standard' ),
					'index'			=>	__( 'On index only', 'standard' ),
					'single-post'	=>	__( 'On single posts only', 'standard' )
				),
			) 
		);
		
		// Publishing Options
		$wp_customize->add_section( 'standard_theme_publishing_options', 
			array(
				'title'          => __( 'Publishing', 'standard' ),
				'priority'       => 151
			) 
		);
	
		// Author Box
		$wp_customize->add_setting( 'standard_theme_publishing_options[display_author_box]', 
			array(
				'default'        => 'always',
				'type'           => 'option',
				'capability'     => 'edit_theme_options'
			) 
		);
	
		$wp_customize->add_control( 'standard_theme_publishing_options[display_author_box]', 
			array(
				'label'      => __( 'Display Author Box', 'standard' ),
				'section'    => 'standard_theme_publishing_options',
				'settings'   => 'standard_theme_publishing_options[display_author_box]',
				'type'       => 'select',
				'choices'    => array(
					'always' 		=>	__( 'Always', 'standard' ),
					'never' 		=>  __( 'Never', 'standard' )
				)
			) 
		);
		
		// Basic WordPress functionality (header display, backgrounds, etc)
		if ( $wp_customize->is_preview() && ! is_admin() ) {
			add_action( 'wp_footer', 'standard_customize_preview', 21);
		} // end if
		$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->get_setting( 'background_attachment' )->transport = 'postMessage';
		
	} // end standard_customize_register
	add_action( 'customize_register', 'standard_customize_register' );
	
 	/**
	 * Renders the JavaScript responsible for hooking into the Theme Customizer to tweak
	 * the built-in theme settings.
	 */
	function standard_customize_preview() { ?>
		<script type="text/javascript">
		(function( $ ) {
		
			// We need to the hide the header widget area when previewing the theme *unless* there are only Standard widgets
			// present. If Standard widgets are present, it means they've customized it already; otherwise, we're 
			// coming from another theme.
			if( $('#header-widget').children().length !== $('#header-widget').children('div[id*=standard]').length ) {
				$('#header-widget').hide();
			} // end if

			// Mark the background as fixed, move it to scroll otherwise.
			$('body').css('background-attachment', 'fixed');
			wp.customize('background_attachment', function(value) {
				value.bind(function(to) {
					if( 'scroll' === to ) {
						$('body').css('background-attachment', '');
					} else if( 'fixed' === to ) {
						$('body').css('background-attachment', 'fixed');
					} // end if
				});
			});

			wp.customize('header_textcolor', function(value) {
				value.bind(function(to) {
					
					// We only care about this if there's no logo
					if($('#header-logo').length === 0) {
					
						// If 'to' is blank or empty then we're toggling the display
						if( 'blank' === to ) {
		
							$('#site-title').hide();
							$('#site-description').hide();
							
						} else {
						
							$('#site-title').show();
							$('#site-description').show();
							
							$('#site-title a, #site-title, #site-description').css('color', to.toString());
							
						} // end if/else
					
					} // end if
					
				});			
			})
		})( jQuery );
		</script>
	<?php  } // end standard_customize_preview

} // end if

/**
 * Defines a custom meta box for displaying the post full width layout. Only renders
 * if the blog isn't using the full width layout.
 */
function standard_add_full_width_single_post() {

	$options = get_option( 'standard_theme_presentation_options' );
	if( 'full_width_layout' != $options['layout'] ) {
	
		add_meta_box(
			'post_level_layout',
			__( 'Standard Layout', 'standard' ),
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
 * @param	$post	The post on which the box should be rendered.
 */
function standard_post_level_layout_display( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'standard_post_level_layout_nonce' );

	$html = '<input type="checkbox" id="standard_seo_post_level_layout" name="standard_seo_post_level_layout" value="1"' . checked( get_post_meta( $post->ID, 'standard_seo_post_level_layout', true ), 1, false ) . ' />';

	$html .= '&nbsp;';

	$html .= '<label for="standard_seo_post_level_layout">';
		$html .= __( 'Hide sidebar and display post at full width.', 'standard' );
	$html .= '</label>';

	echo $html;
	
} // end standard_post_level_layout_display

/**
 * Saves the post data to post defined by the incoming ID.
 *
 * @param	$post_id	The ID of the post to which we're saving the post data.
 */
function standard_save_post_layout_data( $post_id ) {
	
	if( isset( $_POST['standard_post_level_layout_nonce'] ) && isset( $_POST['post_type'] ) ) {
	
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
		$post_level_layout = '';
		if( isset( $_POST['standard_seo_post_level_layout'] ) ) {
			$post_level_layout = $_POST['standard_seo_post_level_layout'];
		} // end if
		
		// If the value exists, delete it first. I don't want to write extra rows into the table.
		if ( 0 == count( get_post_meta( $post_id, 'standard_seo_post_level_layout' ) ) ) {
			delete_post_meta( $post_id, 'standard_seo_post_level_layout' );
		} // end if
		
		// Update it for this post.
		update_post_meta( $post_id, 'standard_seo_post_level_layout', $post_level_layout );

	} // end if

} // end standard_save_post_layout_data
add_action( 'save_post', 'standard_save_post_layout_data' );

/**
 * Add the post meta box for the link post format URL.
 */
function standard_add_url_field_to_link_post_format() {
	
	add_meta_box(
		'link_format_url',
		__( 'Link URL', 'standard' ),
		'standard_link_url_field_display',
		'post',
		'side',
		'high'
	);
	
} // end hudson_add_url_to_link_post_type
add_action( 'add_meta_boxes', 'standard_add_url_field_to_link_post_format' );

/**
 * Renders the input field for the URL.
 * 
 * @param	$post	The post on which this meta box is attached.
 */
function standard_link_url_field_display( $post ) {
	
	wp_nonce_field( plugin_basename( __FILE__ ), 'standard_link_url_field_nonce' );

	echo '<input type="text" id="standard_link_url_field" name="standard_link_url_field" value="' . get_post_meta( $post->ID, 'standard_link_url_field', true ) . '" />';
	
} // end standard_link_url_field_display

/**
 * Sets the URL for the given post.
 *
 * @param	$post_id	The ID of the post that we're serializing
 */
function standard_save_link_url_data( $post_id ) {
	
	if( isset( $_POST['standard_link_url_field_nonce'] ) && isset( $_POST['post_type'] ) ) {
	
		// Don't save if the user hasn't submitted the changes
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		} // end if
		
		// Verify that the input is coming from the proper form
		if( ! wp_verify_nonce( $_POST['standard_link_url_field_nonce'], plugin_basename( __FILE__ ) ) ) {
			return;
		} // end if
		
		// Make sure the user has permissions to post
		if( 'post' == $_POST['post_type']) {
			if( ! current_user_can( 'edit_post', $post_id ) ) {
				return;
			} // end if
		} // end if/else
	
		// Read the Link's URL
		$link_url = '';
		if( isset( $_POST['standard_link_url_field'] ) ) {
			$link_url = esc_url( $_POST['standard_link_url_field'] );
		} // end if
		
		// If the value exists, delete it first. I don't want to write extra rows into the table.
		if ( 0 == count( get_post_meta( $post_id, 'standard_link_url_field' ) ) ) {
			delete_post_meta( $post_id, 'standard_link_url_field' );
		} // end if

		// Update it for this post.
		update_post_meta( $post_id, 'standard_link_url_field', $link_url );

	} // end if

} // end standard_save_post_layout_data
add_action( 'save_post', 'standard_save_link_url_data' );

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
				'href'	=>	site_url() . '/wp-admin/admin.php?page=theme_options'
			)
		);
		
		// Global
		$wp_admin_bar->add_node(
			array(
				'id'		=>	'standard_theme_global_options',
				'title'		=>	__( 'Global', 'standard' ),
				'parent'	=>	'standard_options',
				'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=standard_theme_global_options'
			)
		);
	
		// Layout Options
		$wp_admin_bar->add_node(
			array(
				'id'		=>	'standard_theme_presentation_options',
				'title'		=>	__( 'Presentation', 'standard' ),
				'parent'	=>	'standard_options',
				'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=standard_theme_presentation_options'
			)
		);
		
		// Social Options
		$wp_admin_bar->add_node(
			array(
				'id'		=>	'standard_theme_social_options',
				'title'		=>	__( 'Social', 'standard' ),
				'parent'	=>	'standard_options',
				'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=standard_theme_social_options'
			)
		);
		
		// Publishing Options
		$wp_admin_bar->add_node(
			array(
				'id'		=>	'standard_theme_publishing_options',
				'title'		=>	__( 'Publishing', 'standard' ),
				'parent'	=>	'standard_options',
				'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=standard_theme_publishing_options'
			)
		);
		
	} // end if
	
} // end standard_add_admin_bar_option
add_action( 'admin_bar_menu', 'standard_add_admin_bar_option', 40 );

/**
 * Adds a reminder message to the admin bar that the user has set their site in offline mode.
 */
function standard_add_site_mode_admin_bar_note() {

	// Remind the user if they are in offline mode
	if( standard_is_offline() ) {
		global $wp_admin_bar;
		$wp_admin_bar->add_node(
			array(
				'id'	=>	'standard_theme_site_mode',
				'title'	=>	__( 'The site is currently offline. To bring it back online, click here.', 'standard' ),
				'href'	=>	site_url() . '/wp-admin/themes.php?page=theme_options'
			)
		);
	} // end if

} // end standard_add_maintenance_mode_admin_bar_note
add_action( 'admin_bar_menu' , 'standard_add_site_mode_admin_bar_note', 90 );

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
		
		$html = '';
		
		// WordPress SEO
		if( defined( 'WPSEO_URL' ) ) {

			$html = '<div id="standard-hide-seo-message-notification" class="error"><p>' . __( 'Standard has detected the activation of WordPress SEO and is now running in SEO compatibility mode. <a href="http://docs.8bit.io/standard/seo" target="_blank">' . __( 'Learn more', 'standard' ) . '</a> or <a id="standard-hide-seo-message" href="javascript:;">hide this message</a>.', 'standard') . '</p><span id="standard-hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'standard_hide_seo_message_nonce' ) . '</span></div>';
		
		// All-in-One SEO
		} elseif( class_exists( 'All_in_One_SEO_Pack' ) ) {
		
			$html = '<div id="standard-hide-seo-message-notification" class="error"><p>' . __( 'Standard has detected the activation of All-In-One SEO and is now running in SEO compatibility mode.  <a href="http://docs.8bit.io/standard/seo" target="_blank">' . __( 'Learn more', 'standard' ) . '</a> or <a id="standard-hide-seo-message" href="javascript:;">hide this message</a>.', 'standard') . '</p><span id="standard-hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'standard_hide_seo_message_nonce' ) . '</span></div>';
		
		// Platinum SEO
		} elseif( class_exists( 'Platinum_SEO_Pack' ) ) {
		
			$html =  '<div id="standard-hide-seo-message-notification" class="error"><p>' . __( 'Standard has detected the activation of Platinum SEO and is now running in SEO compatibility mode.  <a href="http://docs.8bit.io/standard/seo" target="_blank">' . __( 'Learn more', 'standard' ) . '</a> or <a id="standard-hide-seo-message" href="javascript:;">hide this message</a>.', 'standard') . '</p><span id="standard-hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'standard_hide_seo_message_nonce' ) . '</span></div>';
		
		} // end if/ese
		
		// Return the notice
		echo $html;
		
	} // end if

	// Set the option to false if the plugin is deactivated
	if( 'true' == get_option( 'standard_theme_seo_notification_options') && standard_using_native_seo() ) {
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
 * @return	The markup for the unordered list.
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
		if( standard_is_on_wp34() ) {
			add_theme_support( 'custom-background' );
		} else {
			add_custom_background();
		} // end if/else
	} // end standard_add_theme_background
	add_action( 'init', 'standard_add_theme_background' );
} // end if

/**
 * Includes the post editor stylesheet.
 */
if( ! function_exists( 'standard_add_theme_editor_style' ) ) { 
	function standard_add_theme_editor_style() {
		
		add_editor_style( 'css/editor-style.css' );
		
		$options = get_option( 'standard_theme_presentation_options' );
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
				'menu_above_logo' 	=> __( 'Header Menu (Upper)', 'standard' ),
				'menu_below_logo' 	=> __( 'Header Menu (Lower)', 'standard' ),
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
				'id' 			=> 'sidebar-0',
				'description'	=> __( 'The primary sidebar.', 'standard' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			)
		);
		
		// header
		register_sidebar(
			array(
				'name' 			=> __( 'Header', 'standard' ),
				'id' 			=> 'sidebar-1',
				'description'	=> __( 'This area is designed for a 468x60 advertisement, but other widgets can be used here as well.', 'standard' ),
				'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>'
			)
		);
		
		// post advertisements
		register_sidebar(
			array(
				'name'			=>	__( 'Below Single Post', 'standard'),
				'id'			=>	'sidebar-2',
				'description'	=>	__( 'Shown after post content and before comments. Ideal for the 468x60 ad widget.', 'standard' ),
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
				'id' 			=> 'sidebar-3',
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
				'id' 			=> 'sidebar-4',
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
				'id' 			=> 'sidebar-5',
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
	
		// Feedlinks
		add_theme_support( 'automatic-feed-links' );
	
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

		if( standard_using_native_seo() ) {
			standard_add_plugin( '/lib/seo/plugin.php' );
		} // end if

		standard_add_plugin( '/lib/activity/plugin.php' );
		standard_add_plugin( '/lib/google-custom-search/plugin.php' );
		standard_add_plugin( '/lib/standard-ad-300x250/plugin.php' );
		standard_add_plugin( '/lib/standard-ad-125x125/plugin.php' );
		standard_add_plugin( '/lib/standard-ad-billboard/plugin.php' );
		standard_add_plugin( '/lib/personal-image/plugin.php' );
		standard_add_plugin( '/lib/influence/plugin.php' );

	} // end add_theme_features
	add_action( 'after_setup_theme', 'standard_add_theme_features' );
} // end if

/*
 * Sets the media embed width to 580 or 900 (based on the layout) which is optimized 
 * for the theme's post size.
 */
if( ! function_exists( 'standard_set_media_embed_size' ) ) { 
	function standard_set_media_embed_size() {
	
		$options = get_option( 'standard_theme_presentation_options' );
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

/**
 * Determine which search form to display based on if the author has enabled
 * Google Custom Search Widget activated.
 */
function standard_get_search_form() {
	
	// First, detect if the Google Custom Search widget is active
	if( standard_google_custom_search_is_active() ) {

		// Read the author's Google Search Engine ID. If they have multiple instances,
		// then we need to read the most recent instance of the widget.
		$gcse = get_option( 'widget_standard-google-custom-search' );
		$gcse = array_shift( array_values ( $gcse ) );
		
		// Programmatically create the widget	
		$o = new Google_Custom_Search();
		$o->widget( 
			array(
				'before_widget' => '', 
				'after_widget' 	=> '' 
			), 
			array( 
				'gcse_content' 	=> 	trim( $gcse['gcse_content'] )
			) 
		);
	
	// Otherwise, display the default 
	} else {
		get_search_form();
	} // end if
	
} // end standard_get_google_search_form

/* ----------------------------------------------------------- *
 * 4. Custom Header
 * ----------------------------------------------------------- */
 
if( standard_is_on_wp34() ) {

	add_theme_support( 
		'custom-header',
		array(
			'header-text'				=>	true,
			'default-text-color'		=> 	'000',
			'width'						=>	940,
			'flex-width'				=>	true,
			'height'					=>	250,
			'flex-height'				=> 	true,
			'wp-head-callback'			=>  'standard_header_style',
			'admin-head-callback'		=>	'standard_admin_header_style',
			'admin-preview-callback'	=>	'standard_admin_header_image'
		)
	);

} else {

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

} // end if/else

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
						clip: rect(1px 1px 1px 1px);
						clip: rect(1px, 1px, 1px, 1px);
					}
				<?php } else { ?>
					#site-title a,
					#site-description {
						color: #<?php echo get_header_textcolor(); ?>;
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
				margin-left: 40px;
			}
			#header-top.no-background {
				margin-left: -40px;
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
				color: #7A7A7A;
			}
			#header-bottom img {
				width: 900px;
				height: auto;
				margin-left: -4%;
			}
			.float {
				float: left;
				position: relative;
				width: 100%;
			}
			#header-bottom {
				z-index: -2;
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
			<?php   		
	   			$presentation_options = get_option('standard_theme_presentation_options');
				if( '' == $presentation_options['logo'] ) {
			?>
					<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1> 
					<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div> 
			<?php
				} else {
			?>
				<h1>
					<a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img id="standard-theme-logo" src="<?php echo $presentation_options['logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" style="display:none;" />
					</a>
				</h1> 
			<?php
				} // end if/else
			?>
				
			</div>
			
			<?php if ( ! empty( $header_image ) ) { ?>
				<div id="header-bottom" class="float">
					<img id="standard-theme-background" src="<?php echo esc_url( $header_image ); ?>" alt="" />
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
 * @param	$comment	The current comment being displayed.
 * @param	$args		Array containing arguments for displaying the comment.
 * @param	$depth		The depth of where this comment falls in the tree.
 */
if( ! function_exists( 'custom_comment' ) ) {
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
} // end if 

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
	</li>
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

	// if VideoPress is loaded, we need to add styles for responsive
	if( class_exists( 'VideoPress' ) ) {
	
		wp_register_style( 'standard-videopress', get_template_directory_uri() . '/css/theme.videopress.css' );
		wp_enqueue_style( 'standard-videopress' ); 
		
	} // end if
	
	// theme
	wp_register_style( 'standard', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'standard' ); 
	
	// contrast
	$options = get_option( 'standard_theme_presentation_options' );
	if( 'dark' == $options['contrast'] ) {
	
		wp_register_style( 'standard-contrast', get_template_directory_uri() . '/css/theme.contrast-light.css' );
		wp_enqueue_style( 'standard-contrast' ); 
		
 	} // end if

} // end add_theme_stylesheets
add_action( 'wp_enqueue_scripts', 'standard_add_theme_stylesheets', 999 );


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
	
	// if VideoPress is loaded, we need to add scripts for responsive
	if( class_exists( 'VideoPress' ) ) {
	
		wp_register_script( 'standard-videopress', get_template_directory_uri() . '/js/theme.videopress.js' );
		wp_enqueue_script( 'standard-videopress' ); 
			
	} // end if

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
	if( 'toplevel_page_theme_options' == $screen->id || 'appearance_page_theme_options' == $screen->id ) {
	
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
	if( ( 'toplevel_page_theme_options' || 'appearance_page_theme_options' ) == $screen->id ) {
		wp_register_script( 'standard-site-mode', get_template_directory_uri() . '/js/admin.site-mode.js' );
		wp_enqueue_script( 'standard-site-mode' );
	} // end if

	// sitemap management script. 
	if( 'post'  == $screen->id || 'edit-page' == $screen->id || 'page' == $screen->id ) {
	
		wp_register_script( 'standard-admin-sitemap', get_template_directory_uri() . '/js/admin.template-sitemap.js?using_sitemap=' . get_option( 'standard_using_sitemap' ) );
		wp_enqueue_script( 'standard-admin-sitemap' );	
		
	} // end if
	
	// widgets
	if( 'widgets' == $screen->id ) {
	
		wp_register_script( 'standard-admin-widgets', get_template_directory_uri() . '/js/admin.widgets.js' );
		wp_enqueue_script( 'standard-admin-widgets' );
	
	} // end if
	
	// favicon and post/page upload script
	if( 'toplevel_page_theme_options' == $screen->id || 'appearance_page_theme_options' == $screen->id ) {
		
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
		
		// standard's media-upload script. only upload this on the admin pages
		wp_register_script( 'standard-media-upload', get_template_directory_uri() . '/js/admin.media-upload.js', array( 'jquery', 'jquery-ui-core', 'media-upload','thickbox' ) );
		wp_enqueue_script( 'standard-media-upload' );
		
		// standard's policy generation script
		wp_register_script( 'standard-publishing-options', get_template_directory_uri() . '/js/admin.publishing-options.js' );
		wp_enqueue_script( 'standard-publishing-options' );
		
		// social options
		wp_register_script( 'standard-admin-social-options', get_template_directory_uri() . '/js/admin.social-options.js' );
		wp_enqueue_script( 'standard-admin-social-options' );
		
	} // end if

	// standard's post-title notification	
	if( 'post' == $screen->id || 'page' == $screen->id ) {

		wp_register_script( 'standard-post-editor', get_template_directory_uri() . '/js/admin.post.js' );
		wp_enqueue_script( 'standard-post-editor' );
	
	} // end if
	
	// standard's admin menu controller
	wp_register_script( 'standard-admin-menu', get_template_directory_uri() . '/js/admin.menu.js' );
	wp_enqueue_script( 'standard-admin-menu' );

} // end add_admin_scripts
add_action( 'admin_enqueue_scripts', 'standard_add_admin_scripts' );

/* ----------------------------------------------------------- *
 * 7. Custom Filters
 * ----------------------------------------------------------- */

/** 
 * This function is fired  if the current version of Standard is not the latest version. If it's not, then the user will be prompted to reset their settings.
 * Once reset, all options will be reset to their default values.
 *
 * TODO review this function for 3.2
 */
function standard_activate_theme() {

	// If we're not using the most recent version of Standard...
	if( ! standard_is_current_version() ) {

		// .. and the user has opted to reset the otpions
		if( array_key_exists( 'standard_theme_reset_options', $_GET ) && 'true' == $_GET['standard_theme_reset_options'] ) {
			
				// Remove the Preview settings. TODO remove this in 3.2.
				delete_option( 'standard_theme_general_options' );
				delete_option( 'standard_theme_social_options' );
				delete_option( 'standard_theme_layout_options' );
				
				// Set defaults for Standard
				get_standard_theme_default_global_options();
				get_standard_theme_default_presentation_options();
				get_standard_theme_default_social_options();
				get_standard_theme_default_publishing_options();
				
		// Otherwise, we have some other things to do...
		} else {
			
			// Set the default gravatar only if this is the first install
			if( '3.1' != get_option( 'standard_theme_version' ) ) {
				
				update_option( 'standard_theme_version', '3.1' );
				update_option( 'avatar_default', 'retro' );
				
			} // end if
			
		} // end if/else
		
	} // end if/else
		
	// Reset the icons
	standard_find_new_social_icons();	
		
} // end standard_activate_theme
add_action( 'admin_notices', 'standard_activate_theme' );

// rel="generator" is an invalid HTML5 attribute
remove_action( 'wp_head', 'wp_generator' );

/** 
 * Adds fields for Twitter, Facebook, and Google+ to the User Profile page so that users can populate this
 * information and have it render in the author box.
 * 
 * @param	$user_contactmethods	The array of contact fields for the user's profile.
 *
 * @return	The updated array of contact methods.
 */
function standard_add_user_profile_fields( $user_contactmethods ) {
	
	$user_contactmethods['twitter'] = __( '<span class="standard-user-profile" id="standard-user-profile-twitter">Twitter URL</span>', 'standard' );
	$user_contactmethods['facebook'] = __( '<span class="standard-user-profile" id="standard-user-profile-facebook">Facebook URL</span>', 'standard' );
	
	if( standard_using_native_seo() ) {
		$user_contactmethods['google_plus'] = __( '<span class="standard-user-profile" id="standard-user-profile-google-plus">Google+ URL</span>', 'standard' );
	} // end if

	return $user_contactmethods;
	
} // end standard_add_user_profile_fields
add_filter( 'user_contactmethods', 'standard_add_user_profile_fields' );

/**
 * If running in native SEO mode and if the current page has a meta description, renders the description
 * to the browser.
 */
function standard_meta_description() {

	// If we're using Standard's native SEO, let's do the following...
	if( standard_using_native_seo() ) {
	
		// If we're on the homepage, we're going to use the site's description
		if( is_home() ) {
			echo '<meta name="description" content="' . get_bloginfo( 'description' ) . '" />';
		} // end if
	
		// For single pages, we're setting the meta description to what the user has provided (or nothing, if it's empty
		if ( ( is_single() || is_page() ) && '' != get_post_meta( get_the_ID(), 'standard_seo_post_meta_description', true ) ) {
			echo '<meta name="description" content="' . get_post_meta( get_the_ID(), 'standard_seo_post_meta_description', true ) . '" />';
		} // end if/else
		
		// And if we're on the categories or any other archives, we'll be using the description if it has been provided
		if( is_archive() && '' != trim( category_description() ) ) {
			echo '<meta name="description" content="' . trim( str_replace( '</p>', '', str_replace( '<p>', '', category_description() ) ) ) . '" />';
		} // end if
		
	} // end if
	
} // end standard_meta_description
add_action( 'wp_head', 'standard_meta_description' );

/**
 * Removes the "category" relationship attribute from category anchors.
 * These are invalid HTML5 attributes.
 *
 * @param   $str    The default set of attributes.
 * @return         The stripped relationship tag.
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
 * @return         The stripped relationship tag.
 */
function standard_remove_anchor_attachment_rel( $str ) {
    return preg_replace( '/(rel="attachment)[a-zA-Z0-9\s\-]*\"/', trim( '' ), trim( $str ) );
} // end standard_remove_anchor_attachment_rel
add_filter( 'the_content', 'standard_remove_anchor_attachment_rel' );

/**
 * Adds a "previous" relationship attribute to the 'Next' pagination option.
 *
 * @param  $attrs  The current set of attributes of the anchor
 * @return         The pagination link with the additional attribute.
 */
function standard_add_rel_to_next_pagination( $attrs ) {
    $attrs .= 'rel="previous"';
    return $attrs;
} // end add_rel_to_pagination
add_filter( 'next_posts_link_attributes', 'standard_add_rel_to_next_pagination' );

/**
 * Adds a "next" relationship attribute to the 'Previous' pagination option.
 *
 * @param  $attrs  The current set of attributes of the anchor
 * @return         The pagination link with the additional attribute.
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
 * @return         The markup with an alt tag.
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
 * @param		$content	The post content
 * @return					The anchor without paragraph tags.
 */
if( ! function_exists( 'standard_process_link_post_format_content' ) ) {
	function standard_process_link_post_format_content( $content ) {
	
		// If this is an link post type, remove the paragraph wrapper from it
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
 * @param		$title		The the of the post
 * @param		$id			The ID of the current post
 * @return					The title based on the status of the post and the link
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
 * @param		$content	The post content
 * @return					The [optional] anchor and image.
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
 * @return			The post content wrapped in a container.
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
 * @return		The search form.
 */
if( ! function_exists( 'standard_search_form' ) ) {
	function standard_search_form() {
	
		// Get the default text for the search form
		$query = strlen( get_search_query() ) == 0 ? '' : get_search_query();
	
		// Render the form
		$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">';
			$form .= '<input placeholder="' . __( 'Search...', 'standard' ) . '" type="text" value="' . $query . '" name="s" id="s" />';
		$form .= '</form>';
		
		return $form;
	
	} // end standard_search_form
	add_filter( 'get_search_form', 'standard_search_form' );
} // end if

/**
 * Formats the link post format properly for the RSS feed.
 *
 * @param		$content	The post content
 * @return					The properly content formatted for RSS
 */
if( ! function_exists( 'standard_post_format_rss' ) ) {
	function standard_post_format_rss( $content ) {
	
		// If it's a link post format, make sure the link and title are properly rendered
		if( 'link' == get_post_format( get_the_ID() ) ) {
			
			// Get the post title and the post content
			global $post;
			$post_content = $post->post_content;
			$post_title = $post->post_title;
			
			// If there's no link meta data, then we'll handle this the 3.0 way. TODO mark this as deprecated.
			if( '' == get_post_meta( get_the_ID(), 'standard_link_url_field', true ) ) {
			
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
		
		// If it's an image post format, make sure the featured image is prepended to the content
		} elseif ( 'image' == get_post_format( get_the_ID() ) && '' != get_the_post_thumbnail( get_the_ID() ) ) { 
		
			$featured_image = '<p>';
				$featured_image .= '<a href="' . get_permalink( get_the_ID() ) . '" target="_blank" title="' . get_the_title() . '">';
					$featured_image .= get_the_post_thumbnail( get_the_ID(), 'large' );
				$featured_image .= '</a>';
			$featured_image .= '</p>';
			
			$content = $featured_image . $content;
			
		} // end if
		
		return $content;
			
	} // end standard_post_format_rss
	add_filter( 'the_content_feed', 'standard_post_format_rss' );
} // end if

/**
 * Calls the Standard SEO Titles plugin during the wp_title action to render
 * SEO-friendly page titles.
 */
if( standard_using_native_seo() ) {
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
 * @param	$params		The array of parameters that provide styling for the widget.
 * @return				The updated array of parameters.
 */
if( ! function_exists( 'standard_modify_widget_titles' ) ) {
	function standard_modify_widget_titles( $params ) {
	
		$params[0]['before_title'] = '<h4 class="' . $params[0]['widget_name'] . ' widget-title">' ;
		$params[0]['after_title'] = '</h4>';
		
	    return $params;
	    
	} // end standard_modify_widget_titles
	add_filter( 'dynamic_sidebar_params', 'standard_modify_widget_titles' );
} // end if

/**
 * Adds the title attribute to the 'Next and 'Previous' post pagination anchors.
 *
 * @param	$attrs	The current set of attributes of the anchor
 * @return			The pagination link with the additional attribute.
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

	if( isset( $_POST['page_template'] ) && isset( $_POST['page_template'] ) ) {

		// if we're saving the page that's using the sitemap but the template is no longer used, delete the option
		if( get_option( 'standard_using_sitemap' ) == $_POST['post_ID'] && strpos( $_POST['page_template'], 'template-sitemap.php' ) == false ) {
			delete_option( 'standard_using_sitemap' );
		} // end if
	
		// if we're not using the sitemap, but this post has it set, update the option with this post's id
		if( ( '' == get_option( 'standard_using_sitemap' ) || false == get_option( 'standard_using_sitemap' ) ) && strpos( $_POST['page_template'], 'template-sitemap.php' ) > -1 ) {
			update_option( 'standard_using_sitemap', $_POST['post_ID'] );
		} // end if
	
	} // end if

} // end standard_save_post
add_action( 'save_post', 'standard_save_post' );

/**
 * Updates the Standard Sitemap Flag if the post being deleted is the actual sitemap.
 *
 * @param	$id		The ID of the post being deleted.
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
 * @param	$form_fields	The array of form fields in the uploader
 * @param	$post			The post object
 * @return					The updated array of form fields
 * @since	3.1
 */
function standard_attachment_fields_to_edit( $form_fields, $post ) {

	// Mark the alt field as required
	$form_fields['image_alt']['required'] = true;
	
	// Provide a Standard description for title and alt
	$form_fields['post_title']['helps'] =	__( 'A title is required for search engines.', 'standard' );
	$form_fields['image_alt']['helps'] = __( 'An alternate text description is required for search engines.', 'standard' );

	// If the image alt is empty, then we'll provide it by cleaning up the image's file name
	if( empty( $form_fields['image_alt']['value'] ) ) {
			
		// First, we grab the image's file name
		$filename = $form_fields['post_title']['value'];
		
		// Next, we strip out all anything that isn't alphanumeric
		$filename = preg_replace('/[^a-z0-9.]+/i', ' ', $filename);
				
		// Then we update both the image and the post title
		$form_fields['image_alt']['value'] = $filename;
		$form_fields['post_title']['value'] = $filename;
		
	} // end if
	
	return $form_fields;
		
} // end standard_attachment_fields_to_edit
add_action( 'attachment_fields_to_edit', 'standard_attachment_fields_to_edit', 11, 2 );

/**
 * If the user has set a FeedBurner URL in the Global Options, then we'll
 * redirect all traffic from the existing WordPress feed to FeedBurner.
 */
function standard_redirect_rss_feeds() {

	global $feed;

	// If we're not on a feed or we're requesting feedburner then stop the redirect
	if( ! is_feed() || preg_match( '/feedburner/i', $_SERVER['HTTP_USER_AGENT'] ) || standard_is_offline() ) {
		return;
	} // end if
	
	// Otherwise, get the RSS feed from the user's settings
	$rss_feed_url = standard_get_rss_feed_url();

	// If they have setup feedburner, let's redirect them
	if( strpos( $rss_feed_url, 'feedburner' ) > 0 && '' != $rss_feed_url ) {
	
		switch( $feed ) {
		
			case 'feed':
			case 'rdf':
			case 'rss':
			case 'rss2':
			case 'atom':
			
				if( '' != $rss_feed_url ) {
	
					header( "Location: " . $rss_feed_url );
					die;
					
				} // end if
				
				break;
				
			default:
				break;
				
		} // end switch/case
		
	} // end if
	
} // end standard_redirect_rss_feeds
add_action( 'template_redirect', 'standard_redirect_rss_feeds' );

/** 
 * If Standard is in offline mode, then we'll stop all RSS feeds from publishing content.
 */
if( standard_is_offline() ) {

	function standard_disable_feed() {
		wp_die( get_bloginfo( 'name' ) . __( ' is currently offline. ', 'standard' ) );
	} // end standard_disable_feeds
	
	add_action( 'do_feed', 'standard_disable_feed', 1 );
	add_action( 'do_feed_rdf', 'standard_disable_feed', 1 );
	add_action( 'do_feed_rss', 'standard_disable_feed', 1 );
	add_action( 'do_feed_rss2', 'standard_disable_feed', 1 );
	add_action( 'do_feed_atom', 'standard_disable_feed', 1 );
	
} // end if

/**
 * Custom action that is used to initialize the Standard menu separator.
 *
 * @param	$position	Where you want the separator to appear.
 */
function standard_add_admin_menu_separator( $position ) {

  global $menu;

  $menu[$position] = array(
  	0	=>	'',
  	1	=>	'read',
  	2	=>	'separator' . $position,
  	3	=>	'',
  	4	=>	'wp-menu-separator'
  );

} // end standard_add_admin_separator
add_action( 'init_standard_menu', 'standard_add_admin_menu_separator' );

/**
 * Defines the function used to set the position of the custom separator.
 */
function standard_set_admin_menu_separator() {

	// Eventually, we should make the 57 value more flexible
	do_action( 'init_standard_menu', 57 );
	
} // end standard_set_admin_menu_separator
add_action( 'init', 'standard_set_admin_menu_separator' );

/* ----------------------------------------------------------- *
 * 8. Helper Functions
 * ----------------------------------------------------------- */

/**
 * Determines whether or not the user is viewing a date archive.
 *
 * @return	True if the current page is for a date archive.
 */
function standard_is_date_archive() {
	return '' != get_query_var( 'year' ) || '' != get_query_var( 'monthnum' ) || '' != get_query_var( 'day' ) || '' != get_query_var( 'm' );
} // end standard_is_date_archive

/**
 * Generates a label for the current archive based on whether or not the user is viewing year, month, or day. Uses the
 * users date format to properly format the date.
 *
 * @return	The label for the current archive
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
 * @return			The value of the attribute or empty for none.
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
			break;
		
	} // end switch
	
	return $result;

} // end standard_get_link_post_format_attribute

/**
 * Looks at the active widgets to determine whether or not the Google Custom Search widget is active.
 *
 * @return	Whether or not the Google Custom Search is active
 */
function standard_google_custom_search_is_active() {
	
	$gcse_is_active = false;

	if( true ) { 
		foreach( ( $widgets = get_option( 'sidebars_widgets' ) ) as $key => $val ) { 
			if( is_array( $widgets[$key] ) ) {
				foreach($widgets[$key] as $widget) {
				
					// We're using 'phaned_widgets' as a subset of 'orphaned_widgets' to make sure we aren't getting the 0 index
					if( $key != 'wp_inactive_widgets' && strpos( $key, 'phaned_widgets_' ) == 0 ) {
						if( strpos( $widget, '-custom-search' ) > 0 ) {
							$gcse_is_active = true;
						} // end if
					} // end if
					
				} // end foreach
			} // end if
		} // end foreach 
	} // end if

	return $gcse_is_active;

} // end standard_google_custom_search_is_active

/**
 * Builds and renders the custom comment form template.
 */
function standard_comment_form() {

	// Gotta read the layout options so we apply the proper ID to our element wrapper
	$layout_options = get_option( 'standard_theme_presentation_options' );
	$layout = 'full_width_layout' == $layout_options['layout'] ? '-full' : '';
	
	// Grab the current commenter and the required options. This is so we can mark fields as required.
	$commenter = wp_get_current_commenter();
	$req = get_option( 'require_name_email' );
	$aria_req = ( $req ? " aria-required='true'" : '' );
	
	// The field elements with wrappers so we can access them via CSS and JavaScript
	$fields =  array(
		'author' 	=> '<div id="comment-form-elements' . $layout . '"><p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'standard' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
		'email'  	=> '<p class="comment-form-email"><label for="email">' . __( 'Email', 'standard' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
		'url'		=> '<p class="comment-form-url"><label for="url">' . __( 'Website', 'standard' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div><!-- /#comment-form-elements --></div><!-- /#comment-form-wrapper -->',
	);
	
	// Now actually render the form
	comment_form(
		array( 
			'comment_notes_before'	=>	'<div id="comment-form-wrapper"><div id="comment-form-avatar">' . get_avatar( '', $size = '30' )  . '</div>',
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

	$truncated = null == $string ? '' : $string;
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
 * @return	True if 'WordPress SEO', 'All In One SEO', 'Platinum SEO Pack', or 'wpSEO' are installed.
 */
function standard_using_native_seo() {
	return ! ( defined( 'WPSEO_URL' ) || class_exists( 'All_in_One_SEO_Pack' ) || class_exists( 'Platinum_SEO_Pack' ) );
} // end standard_using_native_seo 

/**
 * If Standard is set to online mode, this function loads and redirects all traffic to the
 * page template defined for offline mode.
 */
function standard_is_offline() {

	$global_options = get_option( 'standard_theme_global_options' );
	
	$site_mode = '';
	if( isset( $global_options['site_mode'] ) && '' != $global_options['site_mode'] ) {
		$site_mode = $global_options['site_mode'];
	} // end if
	
	return 'offline' == $site_mode;
	
} // end standard_site_mode

/**
 * Helper function for programmatically creating a page.
 * 
 * @param	$slug		The slug by which the page will be accessed
 * @param	$title		The title of the page
 * @param	$template	The name of the template file (without the file extension)
 *
 * @return	The ID of the page once it was created, or 0 if it failed.
 */
function standard_create_page( $slug, $title, $template = '' ) {

	$current_user = wp_get_current_user();
	
	// Grab the content for the page being created
	$page_content = '';
	if( 'privacy-policy' == $slug ) {
		$page_content = file_get_contents( get_template_directory_uri() . '/lib/Standard_Privacy_Policy.template.html' );
	} elseif( 'comment-policy' == $slug ) {
		$page_content = file_get_contents( get_template_directory_uri() . '/lib/Standard_Comment_Policy.template.html' );
	} // end if/else
	
	// Create the page
	$page_id = wp_insert_post(	
		array(
			'comment_status'	=>	'closed',
			'ping_status'		=>	'closed',
			'post_author'		=>	$current_user->ID,
			'post_name'			=>	$slug,
			'post_title'		=>	$title,
			'post_type'			=>	'page',
			'post_content'		=>	$page_content,
			'post_status'		=>	'draft'
		)
	);
	
	// Set the template
	if( '' != $template ) {
		update_post_meta( $page_id, '_wp_page_template', '' != $template ? $template .= '.php' : $template );
	} // end if
		
	return $page_id;

} // end standard_create_page

/**
 * Helper function for programmatically deleting a page.
 * 
 * @param	$id			The ID of the page to delete
 *
 * @return True if deleting of the page was successful; otherwise, false.
 */
function standard_delete_page( $id ) {
	return null != wp_delete_post( $id, true );
} // end standard_delete_page

/**
 * If not already active, includes the plugin by using the specified path.
 *
 * @param	$str_path	The path to the plugin to include.
 */
function standard_add_plugin( $str_path ) {
	if( ! in_array( get_template_directory() . $str_path, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		include_once( get_template_directory() . $str_path );
	} // end if	
} // end standard_add_plugin


/**
 * Determines whether or not Standard is on WordPress 3.4.
 *
 * @return	true	If Standard is running on WordPress 3.4 or greater.
 */
function standard_is_on_wp34() {
	return function_exists( 'get_custom_header' );
} // end standard_is_on_wp34

/**
 * Returns the URL to the RSS feed based on what option the user
 * has selected throughout the theme.
 */
function standard_get_rss_feed_url() {

	$global_options = get_option( 'standard_theme_global_options' );
	
	$url = (string)get_feed_link( 'rss2' );
	if( isset( $global_options['feedburner_url'] ) && '' != $global_options['feedburner_url'] ) {
		$url = $global_options['feedburner_url'];
	} // end if

	return $url;

} // end standard_get_rss_feed_url

/**
 * Returns whether or not the user has uploaded a logo.
 *
 * @return	True if the user has uploaded a logo, false, if not.
 */
function standard_has_logo() {

    $presentation_options = get_option( 'standard_theme_presentation_options' );

    $logo = '';
    if( isset( $presentation_options['logo'] ) ) {
        $logo = $presentation_options['logo'];
    } // end if

    return $logo;

} // end standard_has_logo

/**
 * Returns whether or not the user has specified to display header text.
 *
 * @return	True if the user wants to display header text; otherwise, false.
 */
function standard_has_header_text() {
	return ! ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) );
} // end standard_has_header_text

/**
 * Determines if the incoming URL is a gplus.to URL or a raw Google+ URL.
 *
 * @param	$url	The URL to evaluate
 * @return			Whether or not the URL is a gplus.to URL
 * @since	3.1
 */
function standard_is_gplusto_url( $url ) {
	return strpos( $url, 'gplus.to' );
} // end standard_is_gplusto_url

/**
 * Retrieves the user's Google+ ID from their gplus.to address.
 *
 * @param	$url	The URL to evaluate
 * @return			The full Google+ URL from the incoming URL.
 * @since	3.1
 */
function standard_get_google_plus_from_gplus( $url ) {

	$gplus_url = $url;
	
	// Get the headers from the gplus.to, URL
	$headers = @get_headers( $url );
	$url_parts = explode( '/', $headers[5] );
	
	// If the 5th index exists, the Google+ ID will be here
	if( isset( $url_parts[5] ) ) {
		$gplus_url = 'https://plus.google.com/' . $url_parts[5];
	} // end if
	
	return user_trailingslashit( $gplus_url );
	
} // standard_get_google_plus_from_gplus

/**
 * Determines whether or not the user is using pretty permalinks.
 *
 * @return	True if pretty permalinks are enabled; false, otherwise.
 * @since	3.1
 */
function standard_is_using_pretty_permalinks() {
	
	global $wp_rewrite;
	return '/%postname%/' == $wp_rewrite->permalink_structure;
	
} // end standard_is_using_pretty_premalinks

/**
 * 
 * @returns	True if the current version of Standard is 3.1; false, otherwise.
 * @since 	3.1
 */
function standard_is_current_version() {
	return '3.1' == get_option( 'standard_theme_version' ) ? true : false;
} // end standard_is_current_version

?>