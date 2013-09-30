<?php
/**
 * Theme settings.
 *
 * @since	1.0
 * @version	1.0
 *
 * This file is broken in the following areas:
 *
 *  - Menu Page
 *  - Global Options
 *  - Layout Options
 *  - Social Options
 *  - Publishing
 *  - Page Options
 *  - Options Page
 */

/* ----------------------------- *
 * Menu Page
 * ----------------------------- */

/**
 * Adds the menu page and the submenu options to the WordPress Dashboard.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_menu() {

    add_menu_page(
        __( 'Lean Options', 'lean' ),
        __( 'Lean', 'lean' ),
        'administrator',
        'theme_options',
        'lean_theme_options_display',
        get_template_directory_uri() . '/images/icn-lean-small.png',
        59
    );

    add_submenu_page(
        'theme_options',
        __( 'Global', 'lean' ),
        __( 'Global', 'lean' ),
        'administrator',
        'theme_options&tab=lean_theme_global_options',
        'lean_theme_options_display'
    );

    add_submenu_page(
        'theme_options',
        __( 'Presentation', 'lean' ),
        __( 'Presentation', 'lean' ),
        'administrator',
        'theme_options&tab=lean_theme_presentation_options',
        'lean_theme_options_display'
    );

    add_submenu_page(
        'theme_options',
        __( 'Social', 'lean' ),
        __( 'Social', 'lean' ),
        'administrator',
        'theme_options&tab=lean_theme_social_options',
        'lean_theme_options_display'
    );

    add_submenu_page(
        'theme_options',
        __( 'Publishing', 'lean' ),
        __( 'Publishing', 'lean' ),
        'administrator',
        'theme_options&tab=lean_theme_publishing_options',
        'lean_theme_options_display'
    );

} // end lean_theme_menu
add_action( 'admin_menu', 'lean_theme_menu' );

/* ----------------------------- *
 * Layout Options
 * ----------------------------- */

/**
 * Provides the default values for the Presentation Options.
 *
 * @since	3.0
 * @version	3.2
 */
function get_theme_default_presentation_options() {

    $defaults = array(
        'fav_icon'					=>	'',
        'contrast'					=>	'light',
        'layout' 					=> 	'right_sidebar_layout',
        'display_breadcrumbs'		=>	'always',
        'display_featured_images' 	=> 	'always'
    );

    return apply_filters ( 'lean_theme_default_presentation_options', $defaults );

} // end lean_theme_default_presentation_options

/**
 * Defines the Presentation Options. Specifically, the sections and the settings. Will also
 * create the option if it does not already exist in the database.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_setup_theme_presentation_options() {

    // If the layout options don't exist, create them.
    if( false == get_option( 'lean_theme_presentation_options' ) ) {
        add_option( 'lean_theme_presentation_options', apply_filters( 'lean_theme_default_presentation_options', get_theme_default_presentation_options() ) );
    } // end if

    // Presentation options (composed of layout and content)
    add_settings_section(
        'presentation',
        '',
        'lean_theme_presentation_options_display',
        'lean_theme_presentation_options'
    );

    // Layout
    add_settings_section(
        'layout',
        __( 'Layout and Design', 'lean' ),
        'lean_theme_layout_options_display',
        'lean_theme_presentation_options'
    );

    add_settings_field(
        'logo',
        __( 'Logo', 'lean' ),
        'logo_display',
        'lean_theme_presentation_options',
        'layout'
    );

    add_settings_field(
        'fav_icon',
        __( 'Site Icon', 'lean' ),
        'fav_icon_display',
        'lean_theme_presentation_options',
        'layout'
    );

    add_settings_field(
        'contrast',
        __( 'Contrast', 'lean' ),
        'contrast_display',
        'lean_theme_presentation_options',
        'layout'
    );

    add_settings_field(
        'left_sidebar_layout',
        __( 'Left Sidebar', 'lean' ),
        'left_sidebar_presentation_display',
        'lean_theme_presentation_options',
        'layout',
        array(
            'option_image_path' => get_template_directory_uri() . '/images/layout-left.gif'
        )
    );

    add_settings_field(
        'right_sidebar_layout',
        __( 'Right Sidebar', 'lean' ),
        'right_sidebar_presentation_display',
        'lean_theme_presentation_options',
        'layout',
        array(
            'option_image_path' => get_template_directory_uri() . '/images/layout-right.gif'
        )
    );

    add_settings_field(
        'full_width_layout',
        __( 'No Sidebar / Full Width', 'lean' ),
        'full_width_presentation_display',
        'lean_theme_presentation_options',
        'layout',
        array(
            'option_image_path' => get_template_directory_uri() . '/images/layout-full.gif'
        )
    );

    // Content
    add_settings_section(
        'content',
        __( 'Content', 'lean' ),
        'lean_theme_content_options_display',
        'lean_theme_presentation_options'
    );

    add_settings_field(
        'display_breadcrumbs',
        __( 'Display Breadcrumbs', 'lean' ),
        'display_breadcrumbs_display',
        'lean_theme_presentation_options',
        'content'
    );

    add_settings_field(
        'display_featured_images',
        __( 'Display Featured Images', 'lean' ),
        'display_featured_images_display',
        'lean_theme_presentation_options',
        'content'
    );

    register_setting(
        'lean_theme_presentation_options',
        'lean_theme_presentation_options',
        'lean_theme_presentation_options_validate'
    );

} // end lean_setup_theme_presentation_options
add_action( 'admin_init', 'lean_setup_theme_presentation_options' );

/**
 * Placeholder function for the Presentation Options display function. The section contains
 * both Layout Design and Content options each of which are responsible for displaying their own
 * own options screen.
 *
 * This function is required by the Settings API.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_presentation_options_display() {} // end lean_theme_presentation_options_display

/**
 * Renders the description for the Layout and Design options.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_layout_options_display() {
    echo '<p>' . __( 'This section controls positioning and style elements.', 'lean' ) . '</p>';
} // end lean_theme_layout_display

/**
 * Renders the description for the Content options.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_content_options_display() {
    echo '<p>' . __( 'This section controls when content elements are displayed.', 'lean' ) . '</p>';
} // end lean_theme_content_display

/**
 * Renders the option element for the Site Icon.
 *
 * @since	3.0
 * @version	3.2
 */
function fav_icon_display() {

    $options = get_option( 'lean_theme_presentation_options' );

    $fav_icon = '';
    if( isset( $options['fav_icon'] ) ) {
        $fav_icon = $options['fav_icon'];
    } // end if

    $html = '<div id="fav_icon_preview_container">';
    $html .= '<img src="' . $fav_icon . '" id="fav_icon_preview" alt="" />';
    $html .= '</div>';
    $html .= '<input type="hidden" id="fav_icon" name="lean_theme_presentation_options[fav_icon]" value="' . esc_attr( $fav_icon ) . '" class="media-upload-field" />';
    $html .= '<input type="button" class="button" id="upload_fav_icon" value="' . __( 'Upload', 'lean' ) . '"/>';

    if( '' != trim( $fav_icon ) ) {
        $html .= '<input type="button" class="button" id="delete_fav_icon" value="' . __( 'Delete', 'lean' ) . '"/>';
    } // end if

    $html .= '&nbsp;<span class="description">' . __( 'Dimensions: 144px x 144px. Used for favicon and mobile devices.', 'lean' ) . '&nbsp;<a href="http://docs.leantheme.co/admin-panel/presentation/" target="_blank">' . __( 'Learn more', 'lean' ) . '</a>.</span>';

    echo $html;

} // end fav_icon_display

/**
 * Renders the option element for the Contrast setting.
 *
 * @since	3.0
 * @version	3.2
 */
function contrast_display() {

    $options = get_option( 'lean_theme_presentation_options' );

    $html = '<select id="contrast" name="lean_theme_presentation_options[contrast]">';
    $html .= '<option value="light"' . selected( $options['contrast'], 'light', false ) . '>' . __( 'Light', 'lean' ) . '</option>';
    $html .= '<option value="dark"' . selected( $options['contrast'], 'dark', false ) . '>' . __( 'Dark', 'lean' )  . '</option>';
    $html .= '</select>';
    $html .= '&nbsp;';
    $html .= '<span class="description">' . __( 'Can be used with <a href="themes.php?page=custom-background">custom backgrounds</a>.', 'lean' ) . '</span>';

    echo $html;

} // end contrast_display

/**
 * Renders the option element for the Logo.
 *
 * @since	3.0
 * @version	3.2
 */
function logo_display() {

    $options = get_option( 'lean_theme_presentation_options' );

    $logo = '';
    if( isset( $options['logo'] ) ) {
        $logo = $options['logo'];
    } // end if

    $html = '<div id="logo_preview_container">';
    $html .= '<img src="' . $logo . '" id="logo_preview" alt="" />';
    $html .= '</div><!-- #logo_preview_container -->';

    $html .= '<input type="hidden" id="logo" name="lean_theme_presentation_options[logo]" value="' . esc_attr( $logo ) . '" class="media-upload-field" />';
    $html .= '<input type="button" class="button" id="upload_logo" value="' . __( 'Upload', 'lean' ) . '"/>';

    if( '' != trim( $logo ) ) {
        $html .= '<input type="button" class="button" id="delete_logo" value="' . __( 'Delete', 'lean' ) . '"/>';
    } // end if

    $html .= '&nbsp;<span class="description">' . __( 'Use an image in place of the <a href="options-general.php">Site Title and Tagline</a>. <a href="themes.php?page=custom-header">Custom Headers</a> are also available.', 'lean' ) . '</span>';

    echo $html;

} // end logo_display

/**
 * Renders the option element for the Left-Sidebar Layout.
 *
 * @param	array $args	The array of options used for rendering the option. Includes a path to the option's image.
 * @since	3.0
 * @version	3.2
 */
function left_sidebar_presentation_display( $args ) {

    $options = get_option( 'lean_theme_presentation_options' );

    $html = '<input type="radio" id="lean_theme_left_sidebar_layout" name="lean_theme_presentation_options[layout]" value="left_sidebar_layout"' . checked( 'left_sidebar_layout', $options['layout'], false ) . ' />';
    $html .= '<img src="' . esc_url( $args['option_image_path'] ) . '" alt="" />';

    echo $html;

} // end left_sidebar_presentation_display

/**
 * Renders the option element for the Right-Sidebar Layout.
 *
 * @param	array $args	The array of options used for rendering the option. Includes a path to the option's image.
 * @since	3.0
 * @version	3.2
 */
function right_sidebar_presentation_display( $args ) {

    $options = get_option( 'lean_theme_presentation_options' );

    $html = '<input type="radio" id="lean_theme_right_sidebar_layout"  name="lean_theme_presentation_options[layout]" value="right_sidebar_layout"' . checked( 'right_sidebar_layout', $options['layout'], false ) . ' />';
    $html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';

    echo $html;

} // end right_sidebar_presentation_display

/**
 * Renders the option element for the Full-Width Layout.
 *
 * @param	array $args	The array of options used for rendering the option. Includes a path to the option's image.
 * @since	3.0
 * @version	3.2
 */
function full_width_presentation_display( $args ) {

    $options = get_option( 'lean_theme_presentation_options' );

    $html = '<input type="radio" id="lean_theme_full_width_layout"  name="lean_theme_presentation_options[layout]" value="full_width_layout"' . checked( 'full_width_layout', $options['layout'], false ) . ' />';
    $html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';

    echo $html;

} // end full_width_presentation_display

/**
 * Renders the option element for the Breadcrumb.
 *
 * @since	3.0
 * @version	3.2
 */
function display_breadcrumbs_display() {

    $options = get_option( 'lean_theme_presentation_options' );

    $display_breadcrumbs = '';
    if( isset( $options['display_breadcrumbs'] ) ) {
        $display_breadcrumbs = $options['display_breadcrumbs'];
    } // end if

    $html = '<select id="display_breadcrumbs" name="lean_theme_presentation_options[display_breadcrumbs]">';
    $html .= '<option value="always"'. selected( $options['display_breadcrumbs'], 'always', false ) . '>' . __( 'Always', 'lean' ) . '</option>';
    $html .= '<option value="never"'. selected( $options['display_breadcrumbs'], 'never', false ) . '>' . __( 'Never', 'lean' ) . '</option>';
    $html .= '</select>';

    $html .= '&nbsp;<span class="description">' . __( 'SEO experts encourage breadcrumb use. <a href="http://docs.leantheme.co/admin-panel/presentation/">Learn more</a>.', 'lean' ) . '</span>';

    echo $html;

} // end display_breadcrumbs_display

/**
 * Renders the option element for Featured Images.
 *
 * @since	3.0
 * @version	3.2
 */
function display_featured_images_display() {

    $options = get_option( 'lean_theme_presentation_options' );

    $html = '<select id="display_featured_image" name="lean_theme_presentation_options[display_featured_images]">';
    $html .= '<option value="always"'. selected( $options['display_featured_images'], 'always', false ) . '>' . __( 'Always', 'lean' ) . '</option>';
    $html .= '<option value="never"'. selected( $options['display_featured_images'], 'never', false ) . '>' . __( 'Never', 'lean' ) . '</option>';
    $html .= '<option value="index"'. selected( $options['display_featured_images'], 'index', false ) . '>' . __( 'On index only', 'lean' ) . '</option>';
    $html .= '<option value="single-post"'. selected( $options['display_featured_images'], 'single-post', false ) . '>' . __( 'On single posts only', 'lean' ) . '</option>';
    $html .= '</select>';

    echo $html;

} // end display_featured_images_display


/**
 * Sanitization callback for the Layout. Since each of the Layout Options are checkboxes,
 * this function loops through the incoming options and verifies they are either empty strings
 * or contain the value of '1.'
 *
 * @param	array $input	The unsanitized collection of options.
 * @return	array The collection of sanitized values.
 * @since	3.0
 * @version	3.2
 */
function lean_theme_presentation_options_validate( $input ) {

    $output = array();

    foreach( $input as $key => $val ) {

        if( isset ( $input[$key] ) ) {
            $output[$key] = $input[$key];
        } // end if

    } // end foreach

    return apply_filters( 'lean_theme_presentation_options_validate', $output, $input, get_theme_default_presentation_options() );

} // end lean_theme_presentation_options_validate

/* ----------------------------- *
 * 	Social Options
 * ----------------------------- */

/**
 * Provides the default values for the Social Options.
 *
 * @since	3.0
 * @version	3.2
 */
function get_theme_default_social_options() {

    $defaults = array(
        'active-social-icons'		=> '',
        'available-social-icons' 	=> ''
    );

    return apply_filters ( 'lean_theme_social_options', $defaults );

} // end get_theme_default_social_options

/**
 * Defines the Social Options. Specifically, the sections and the settings. Will also
 * create the option if it does not already exist in the database.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_setup_theme_social_options() {

    // If the theme options don't exist, create them.
    if( false == get_option( 'lean_theme_social_options' ) ) {
        add_option( 'lean_theme_social_options', apply_filters( 'lean_theme_default_social_options', get_theme_default_social_options() ) );
    } // end if

    // Look to see if any new icons have been added to the library since the last version of the theme
    get_theme_default_social_options();

    /* ------------------ Social Networks ------------------ */

    add_settings_section(
        'social',
        '',
        'lean_theme_social_options_display',
        'lean_theme_social_options'
    );

    add_settings_field(
        'available_social_icons',
        __( 'Available Icons', 'lean' ),
        'lean_available_icons_display',
        'lean_theme_social_options',
        'social'
    );

    add_settings_field(
        'active_social_icons',
        __( 'Active Icons', 'lean' ),
        'lean_active_icons_display',
        'lean_theme_social_options',
        'social'
    );

    register_setting(
        'lean_theme_social_options',
        'lean_theme_social_options',
        'lean_theme_social_options_validate'
    );

} // end lean_setup_theme_social_options
add_action( 'admin_init', 'lean_setup_theme_social_options' );

/**
 * Renders the description for the Social Options page.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_social_options_display() {

    _e( 'This section controls social network icons in the site header. Drag, drop, and position desired icons from the Icon Library to the Active Icons area. This section controls social network icons in the site header. Drag, drop, and position desired icons from the Icon Library to the Active Icons area. You can also delete all icons and <a href="javascript:;" id="reset-social-icons" class="ad_delete">restore defaults.</a>', 'lean' );

    $html = '<div class="social-icons-wrapper">';

    $html .= '<div id="social-icons-active" class="left">';
    $html .= '<div class="sidebar-name">';
    $html .= '<h3>' . __( 'Active Icons', 'lean' ) . '</h3>';
    $html .= '</div><!-- /.sidebar-name -->';
    $html .= '<div id="active-icons">';
    $html .= '<p class="description">' . __( 'Click an icon to set the full URL.', 'lean' ) . '</p>';
    $html .= '<ul id="active-icon-list"></ul>';
    $html .= '<div id="active-icon-url" class="hidden">';
    $html .= '<label>' . __( 'Icon URL:', 'lean' ) . '</label>';
    $html .= '<input type="text" id="social-icon-url" value="" class="icon-url" data-via="" data-url="" />';
    $html .= '&nbsp;<span class="description" id="social-rss-icon-controls">';
    $html .= '<a href="http://docs.leantheme.co/social" target="_blank">' . __( 'Learn More', 'lean' ) . '</a>';
    $html .= '</span><!-- /#social-rss-icon-controls -->';
    $html .= '<span id="social-icon-controls">';
    $html .= '<input type="button" class="button" id="set-social-icon-url" value="' . __( 'Done', 'lean' ). '" />';
    $html .= '&nbsp;';
    $html .= '<a href="javascript:;" id="cancel-social-icon-url">' . __( 'Cancel', 'lean' ) . '</a>';
    $html .= '</span><!-- /#social-icon-controls -->';
    $html .= '</div><!-- /#active-icon-url -->';
    $html .= '<div id="social-icon-max" class="hidden alert alert-info"><i class="icon icon-warning"></i> ' . __( 'Lean looks best with seven icons or fewer.', 'lean' ) . '</div>';
    $html .= '</div><!-- /#active-icons -->';
    $html .= '</div><!-- /#social-icons-active -->';

    $html .= '<div id="social-icons-available" class="right">';
    $html .= '<div class="sidebar-name">';
    $html .= '<h3>' . __( 'Icon Library', 'lean' ) . '</h3>';
    $html .= '</div><!-- /.sidebar-name -->';
    $html .= '<div id="available-icons">';
    $html .= '<p class="description">' . __( 'Use native social icons or upload your own.', 'lean' ) . '</p>';
    $html .= '<ul id="available-icon-list"></ul>';
    $html .= '<div id="delete-icons" class="description"><i class="icon icon-trash"></i><br>' . __( 'Drag social icons here to remove them from your library.', 'lean' ) . '</div>';
    $html .= '<div id="social-icons-operations">';
    $html .= '<input type="button" class="button" id="upload-social-icon" value="' . __( 'Upload New Icon', 'lean') . '" />';
    $html .= '</div><!-- /#social-icons-operations -->';
    $html .= '</div><!-- /#available-icons -->';
    $html .= '</div><!-- /.social-icons-available -->';

    $html .= '<span id="lean-save-social-icons-nonce" class="hidden">' . wp_create_nonce( 'lean_save_social_icons_nonce' ) . '</span>';
    $html .= '<span id="lean-wordpress-rss-url" class="hidden">' . esc_url( get_rss_feed_url() ) . '</span>';
    $html .= '<span id="lean-reset-social-icons" class="hidden">' . wp_create_nonce( 'lean_reset_social_icons_nonce' ) . '</span>';

    $html .= '</div><!-- /.social-icons-wrapper -->';

    echo $html;

} // end lean_theme_social_options_display

/**
 * Callback function used in the Ajax request for generating the Social Icons.
 *
 * @since 	3.0
 * @version	3.2
 */
function lean_save_social_icons( ) {

    if( wp_verify_nonce( $_REQUEST['nonce'], 'lean_save_social_icons_nonce' ) && isset( $_POST['updateSocialIcons'] ) ) {

        // Manually create the input array of options
        $input = array(
            'available-social-icons'	=>	$_POST['availableSocialIcons'],
            'active-social-icons' 		=> 	$_POST['activeSocialIcons']
        );

        if( update_option( 'lean_theme_social_options', lean_theme_social_options_validate( $input ) ) ) {
            die( '0' );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end lean_save_social_icons
add_action( 'wp_ajax_lean_save_social_icons', 'lean_save_social_icons' );

/**
 * Callback function used in the Ajax request for resetting the Social Icons.
 *
 * @since 	3.0
 * @version	3.2
 */
function lean_reset_social_icons( ) {
    if( wp_verify_nonce( $_REQUEST['nonce'], 'lean_reset_social_icons_nonce' ) ) {
        die( delete_option( 'lean_theme_social_options' ) );
    } // end if/else
} // end lean_save_social_icons
add_action( 'wp_ajax_lean_reset_social_icons', 'lean_reset_social_icons' );

/**
 * Displays the message for users attempting to delete the core set of social icons.
 *
 * @since 	3.0
 * @version	3.2
 */
function lean_delete_social_icons() {
    if( wp_verify_nonce( $_REQUEST['nonce'], 'lean-delete-social-icon-nonce' ) ) {
        die( lean_display_delete_social_icon_message() );
    } // end if
} // end lean_delete_social_icons
add_action( 'wp_ajax_lean_delete_social_icons', 'lean_delete_social_icons' );

/**
 * Generates a message to be displayed when the user attempts to delete a social icon.
 *
 * @since 	3.0
 * @version	3.2
 */
function lean_display_delete_social_icon_message() {

    $html = '<div id="lean-delete-social-icons" class="updated">';
    $html .= '<p>';
    $html .= __( 'You cannot delete the default set of Lean social icons. <a href="javascript:;" id="lean-hide-delete-social-icon-message">Hide this message.</a>', 'lean' );
    $html .= '</p>';
    $html .= '</div><!-- /#lean-delete-social-icons -->';

    echo $html;

} // end lean_display_delete_social_icon_message

/**
 * Renders the available social icon input. This field is hidden and is manipulated by the functionality for powering
 * the drag and drop ability of the icons.
 *
 * @since 	3.0
 * @version	3.2
 */
function lean_available_icons_display() {

    $options = get_option( 'lean_theme_social_options' );

    $html = '<input type="text" id="available-social-icons" name="lean_theme_social_options[available-social-icons]" value="' . $options['available-social-icons'] . '" />';
    $html .= '<span id="lean-delete-social-icon-nonce" class="">' . wp_create_nonce( 'lean-delete-social-icon-nonce' ) . '</span>';

    echo $html;

} // end lean_available_icons_display

/**
 * Renders the active social icon input. This field is hidden and is manipulated by the functionality for powering
 * the drag and drop ability of the icons.
 *
 * @since 	3.0
 * @version	3.2
 */
function lean_active_icons_display() {

    $options = get_option( 'lean_theme_social_options' );
    echo '<input type="text" id="active-social-icons" name="lean_theme_social_options[active-social-icons]" value="' . $options['active-social-icons'] . '" />';

} // end lean_active_icons_display

/**
 * Sanitization callback for the Social Options. Since each of the options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *
 * @param	array $input	The unsanitized collection of options.
 * @return	array The collection of sanitized values.
 * @since 	3.0
 * @version	3.2
 */
function lean_theme_social_options_validate( $input ) {

    $output = $defaults = get_theme_default_social_options();

    foreach( $input as $key => $val ) {

        if( isset ( $input[$key] ) ) {
            $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
        } // end if

    } // end foreach

    return apply_filters( 'lean_theme_social_options_validate', $output, $input, $defaults );

} // end lean_theme_options_validate

/**
 * When upgrading to newer versions of Lean, this function looks for any new icons that may exist in the social icons directory.
 *
 * If so, it will add them to the available icons. It excludes icons that are already active.
 *
 * If users have uploaded their own icons for ones that we have included, such as LinkedIn or
 * SoundCloud then they'll need to 'Restore Defaults' and configure their own.
 *
 * @since 	3.1
 * @version	3.1
 */
function find_new_social_icons() {

    // Be sure to look for any additional social icons
    $social_options = get_option( 'lean_theme_social_options' );

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
        update_option( 'lean_theme_social_options', $social_options );

    } // end if

} // end find_new_social_icons

/* ----------------------------- *
 * 	Global Options
 * ----------------------------- */

/**
 * Provides the default values for the Global Options.
 *
 * @since	3.0
 * @version	3.2
 */
function get_theme_default_global_options() {

    $defaults = array(
        'site_mode'					=>	'online',
        'feedburner_url'			=>	'',
        'google_analytics'			=>	'',
        'offline_display_message'	=>	__( 'Our site is currently offline.', 'lean' )
    );

    return apply_filters ( 'lean_theme_default_global_options', $defaults );

} // end get_theme_default_global_options

/**
 * Defines the Global Options. Specifically, the sections and the settings. Will also
 * create the option if it does not already exist in the database.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_setup_theme_global_options() {

    // If the theme options don't exist, create them.
    if( false == get_option( 'lean_theme_global_options' ) ) {
        add_option( 'lean_theme_global_options', apply_filters( 'lean_theme_default_global_options', get_theme_default_global_options() ) );
    } // end if

    /* ------------------ Page Options ------------------ */

    add_settings_section(
        'global',
        '',
        'lean_theme_global_options_display',
        'lean_theme_global_options'
    );

    add_settings_field(
        'feedburner_url',
        __( 'FeedBurner URL', 'lean' ),
        'feedburner_url_display',
        'lean_theme_global_options',
        'global'
    );

    add_settings_field(
        'google_analytics',
        __( 'Google Analytics', 'lean' ),
        'google_analytics_display',
        'lean_theme_global_options',
        'global'
    );

    add_settings_field(
        'site_mode',
        __( 'Site Mode', 'lean' ),
        'site_mode_display',
        'lean_theme_global_options',
        'global'
    );

    add_settings_field(
        'offline_message',
        __( 'Offline Message', 'lean' ),
        'offline_message_display',
        'lean_theme_global_options',
        'global'
    );

    register_setting(
        'lean_theme_global_options',
        'lean_theme_global_options',
        'lean_theme_global_options_validate'
    );

} // end lean_setup_theme_global_options
add_action( 'admin_init', 'lean_setup_theme_global_options' );

/**
 * Renders the description for the Global Options page.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_global_options_display() {

    $html = '<h3>' . __( 'Site Configuration ', 'lean' ) . '</h3>';
    $html .= '<p>' . __( 'This section controls site wide features.', 'lean' ) . '</p>';

    echo $html;

} // end lean_theme_global_options_display

/**
 * Renders the option element for FeedBurner.
 *
 * @since	3.0
 * @version	3.2
 */
function feedburner_url_display() {

    $option = get_option( 'lean_theme_global_options' );

    // Only render this option for administrators
    if( current_user_can( 'manage_options' ) ) {

        $feedburner_url = '';
        if( true == isset ( $option['feedburner_url'] ) ) {
            $feedburner_url = $option['feedburner_url'];
        } // end if

        $html = '<input type="text" id="feedburner_url" name="lean_theme_global_options[feedburner_url]" placeholder="http://feeds.feedburner.com/example" value="' . esc_attr( $feedburner_url ) . '" />';
        $html .= '&nbsp;<span class="description">' . __( 'Use in place of the native RSS feed.', 'lean' ) . '</span>';

        echo $html;

    } // end if/else

} // end google_analytics_display

/**
 * Renders the option element for Google Analytics.
 *
 * @since	3.0
 * @version	3.2
 */
function google_analytics_display() {

    $option = get_option( 'lean_theme_global_options' );

    // Only render this option for administrators
    if( current_user_can( 'manage_options' ) ) {

        $analytics_id = '';
        if( true == isset ( $option['google_analytics'] ) ) {
            $analytics_id = $option['google_analytics'];
        } // end if

        $html = '<input type="text" id="google_analytics" name="lean_theme_global_options[google_analytics]" placeholder="UA-000000" value="' . esc_attr( $analytics_id ) . '" />';
        $html .= '&nbsp;<span class="description">' . __( 'Enter the ID only.', 'lean' ) . '</span>';

        echo $html;

    } // end if/else

} // end google_analytics_display

/**
 * Renders the option element for activating Offline Mode.
 *
 * @since	3.0
 * @version	3.2
 */
function site_mode_display( ) {

    $options = get_option( 'lean_theme_global_options' );

    $site_mode = '';
    if( isset( $options['site_mode'] ) ) {
        $site_mode = $options['site_mode'];
    } // end if

    $html = '<select id="site_mode" name="lean_theme_global_options[site_mode]">';
    $html .= '<option value="online"' . selected( $site_mode, 'online', false ) . '>' . __( 'Online', 'lean' ) .'</option>';
    $html .= '<option value="offline"' . selected( $site_mode, 'offline', false ) . '>' . __( 'Offline', 'lean' ) .'</option>';
    $html .= '</select>';

    $html .= '&nbsp;';

    $html .= '<span class="description">';
    $html .= __( 'WARNING: Taking site offline will hide all content from site visitors and search engines.', 'lean' );
    $html .= '</span>';

    echo $html;

} // end site_mode_display

/**
 * Renders the option element for the 140-character message for Offline Mode.
 *
 * @since	3.0
 * @version	3.2
 */
function offline_message_display() {

    $options = get_option( 'lean_theme_global_options' );

    $offline_message = '';
    if( isset( $options['offline_message'] ) ) {
        $offline_message = $options['offline_message'];
    } // end if

    echo '<input type="text" id="offline_message" name="lean_theme_global_options[offline_message]" value="' . esc_attr( $offline_message ) . '" maxlength="140" />';

} // end offline_message_display

/**
 * Sanitization callback for the Global Options. Since each of the options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *
 * @param	array $input	The unsanitized collection of options.
 * @return	array The collection of sanitized values.
 * @since 	3.0
 * @version	3.2
 */
function lean_theme_global_options_validate( $input ) {

    $output = array();

    foreach( $input as $key => $val ) {

        if( isset ( $input[$key] ) ) {
            $output[$key] = strip_tags( stripslashes( $input[$key] ) );
        } // end if

    } // end foreach

    return apply_filters( 'lean_theme_global_options_validate', $output, $input, get_theme_default_global_options() );

} // end lean_theme_global_options_validate

/* ----------------------------- *
 * 	Publishing Options
 * ----------------------------- */

/**
 * Provides the default values for the Post Options on the Publishing Options page.
 *
 * @since	3.0
 * @version	3.2
 */
function get_theme_default_publishing_options() {

    $defaults = array(
        'display_author_box'			=>	'always'
    );

    return apply_filters ( 'lean_theme_default_publishing_options', $defaults );

} // end get_theme_default_publishing_options

/**
 * Defines the Publishing Options. Specifically, the sections and the settings. Will also
 * create the option if it does not already exist in the database.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_setup_theme_publishing_options() {

    // If the theme options don't exist, create them.
    if( false == get_option( 'lean_theme_publishing_options' ) ) {
        add_option( 'lean_theme_publishing_options', apply_filters( 'lean_theme_publishing_options', get_theme_default_publishing_options() ) );
    } // end if

    // Publishing options (composed of Post and Pages)
    add_settings_section(
        'publishing',
        '',
        'lean_theme_publishing_options_display',
        'lean_theme_publishing_options'
    );

    // Post options
    add_settings_section(
        'post',
        __( 'Posts', 'lean' ),
        'lean_theme_post_options_display',
        'lean_theme_publishing_options'
    );

    add_settings_field(
        'display_author_box',
        __( 'Display Author Box', 'lean' ),
        'display_author_box_display',
        'lean_theme_publishing_options',
        'post'
    );

    // Page options
    add_settings_section(
        'page',
        __( 'Pages', 'lean' ),
        'lean_theme_page_options_display',
        'lean_theme_publishing_options'
    );

    add_settings_field(
        'privacy_policy_template',
        __( 'Privacy Policy', 'lean' ),
        'privacy_policy_template_display',
        'lean_theme_publishing_options',
        'page'
    );

    add_settings_field(
        'comment_policy_template',
        __( 'Comment Policy', 'lean' ),
        'comment_policy_template_display',
        'lean_theme_publishing_options',
        'page'
    );

    register_setting(
        'lean_theme_publishing_options',
        'lean_theme_publishing_options',
        'lean_theme_publishing_options_validate'
    );

} // end lean_setup_theme_publishing_options
add_action( 'admin_init', 'lean_setup_theme_publishing_options' );

/**
 * Placeholder function for the Publishing Options display function. The section contains
 * both Post and Page options each of which are responsible for displaying their own
 * own options screen.
 *
 * This function is required by the Settings API.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_publishing_options_display() {}

/**
 * Renders the description for the Post Options settings on the Publishing page.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_post_options_display() {
    echo '<p>' . __( 'This section controls publisher-centric features available on individual posts.', 'lean' ) . '</p>';
} // end lean_theme_post_options_display

/**
 * Renders the description for the Page Options settings on the Publishing page.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_page_options_display() {
    echo '<p>' . __( 'This section controls publisher-centric features available for pages.', 'lean' ) . '</p>';
} // end lean_theme_page_options_display

/**
 * Renders the option element for the Author Box.
 *
 * @since	3.0
 * @version	3.2
 */
function display_author_box_display() {

    $options = get_option( 'lean_theme_publishing_options' );

    $display_author_box = '';
    if( isset( $options['display_author_box'] ) ) {
        $display_author_box = $options['display_author_box'];
    } // end if

    $html = '<select id="display_author_box" name="lean_theme_publishing_options[display_author_box]">';
    $html .= '<option value="always"' . selected( $options['display_author_box'], 'always', false ) . '>' . __( 'Always', 'lean' ) . '</option>';
    $html .= '<option value="never"' . selected( $options['display_author_box'], 'never', false ) . '>' . __( 'Never', 'lean' )  . '</option>';
    $html .= '</select>';

    $html .= '&nbsp;<span class="description">' . __( "Display name, website, social networks, and bio from the <a href='profile.php'>author's profile</a> after post content.", 'lean' ) . '</span>';

    echo $html;

} // end display_author_box_display

/**
 * Renders the option for generating the Privacy Policy from within the WorsPress Dashboard.
 *
 * @since	3.0
 * @version	3.2
 */
function privacy_policy_template_display() {

    // First, detect if the privacy policy page exists
    $privacy_policy = get_page_by_title( __( 'Privacy Policy', 'lean' ) );

    // Options to display if the page doesn't already exist
    $html = '<div id="generate-privacy-policy-wrapper"' . ( '' == $privacy_policy ? ' ' : ' class="hidden" ' )  . '>';
    $html .= '<input type="submit" class="button-secondary" id="generate_privacy_policy" name="generate_privacy_policy" value="' . __( 'Generate', 'lean' ) . '" />';
    $html .= '<span id="lean-privacy-policy-nonce" class="hidden">' . wp_create_nonce( 'lean_generate_privacy_policy_nonce' ) . '</span>';
    $html .= '&nbsp;';
    $html .= '<span class="description">' . __( '<a href="http://docs.leantheme.co/admin-panel/publishing/" target="_blank">' . __( 'Learn more', 'lean' ) . '</a>.', 'lean' ) . '</span>';
    $html .= '</div><!-- /#generate-private-policy-wrapper -->';

    // Options to display if the page already exists
    $html .= '<div id="has-privacy-policy-wrapper"' . ( '' == $privacy_policy ? ' class="hidden" ' : '' )  . '>';

    $policy_id = 'null-privacy-policy';
    if( null != $privacy_policy ) {
        $policy_id = $privacy_policy->ID;
    } // end if

    $html .= '<input type="submit" class="button-secondary" id="delete_privacy_policy" name="delete_privacy_policy" value="' . __( 'Delete', 'lean' ) . '" />';
    $html .= '&nbsp;';
    $html .= '<span>' . __( 'Warning, customizations will be lost. You can view or edit your policy ', 'lean' ) . '<a id="edit-privacy-policy" href="post.php?post=' . $policy_id . '&action=edit">' . __( 'here', 'lean' ) . '</a>.</span>';
    $html .= '<span class="hidden" id="privacy_policy_id">' . $policy_id . '</span>';
    $html .= '</div><!-- /#has-privacy-policy-wrapper -->';

    echo $html;

} // end privacy_policy_template_display

/**
 * Renders the option for generating the Comment Policy from within the WordPress Dashboard.
 *
 * @since	3.0
 * @version	3.2
 */
function comment_policy_template_display() {

    // First, detect if the privacy policy page exists
    $comment_policy = get_page_by_title( __( 'Comment Policy', 'lean' ) );

    // Options to display if the page doesn't already exist
    $html = '<div id="generate-comment-policy-wrapper"' . ( '' == $comment_policy ? ' ' : ' class="hidden" ' )  . '>';
    $html .= '<input type="submit" class="button-secondary" id="generate_comment_policy" name="generate_comment_policy" value="' . __( 'Generate', 'lean' ) . '" />';
    $html .= '<span id="lean-comment-policy-nonce" class="hidden">' . wp_create_nonce( 'lean_generate_comment_policy_nonce' ) . '</span>';
    $html .= '&nbsp;';
    $html .= '<span class="description">' . __( '<a href="http://docs.leantheme.co/admin-panel/publishing/" target="_blank">' . __( 'Learn more', 'lean' ) . '</a>.', 'lean' ) . '</span>';
    $html .= '</div><!-- /#generate-comment-policy-wrapper -->';

    // Options to display if the page already exists
    $html .= '<div id="has-comment-policy-wrapper"' . ( '' == $comment_policy ? ' class="hidden" ' : '' )  . '>';

    $policy_id = 'null-comment-policy';
    if( null != $comment_policy ) {
        $policy_id = $comment_policy->ID;
    } // end if

    $html .= '<input type="submit" class="button-secondary" id="delete_comment_policy" name="delete_comment_policy" value="' . __( 'Delete', 'lean' ) . '" />';
    $html .= '&nbsp;';
    $html .= '<span>' . __( 'Warning, customizations will be lost. You can view or edit your policy ', 'lean' ) . '<a id="edit-comment-policy" href="post.php?post=' . $policy_id . '&action=edit">' . __( 'here', 'lean' ) . '</a>.</span>';
    $html .= '<span class="hidden" id="comment_policy_id">' . $policy_id . '</span>';
    $html .= '</div><!-- /#has-comment-policy-wrapper -->';

    echo $html;

} // end comment_policy_template_display

/**
 * Callback function used in the Ajax request for generating the Privacy Policy.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_generate_privacy_policy_page( ) {

    if( wp_verify_nonce( $_REQUEST['nonce'], 'lean_generate_privacy_policy_nonce' ) && isset( $_POST['generatePrivacyPolicy'] ) ) {

        $page_id = create_page( 'privacy-policy', __( 'Privacy Policy', 'lean' ) );
        if( $page_id > 0 ) {
            die( (string)$page_id );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end lean_generate_privacy_policy_page
add_action( 'wp_ajax_lean_generate_privacy_policy_page', 'lean_generate_privacy_policy_page' );

/**
 * Callback function used in the Ajax request for deleting the Privacy Policy.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_delete_privacy_policy_page( ) {

    // We'll be using the same nonce for generating the policy.
    if( wp_verify_nonce( $_REQUEST['nonce'], 'lean_generate_privacy_policy_nonce' ) && isset( $_POST['deletePrivacyPolicy'] ) && isset( $_POST['page_id'] ) ) {

        if( delete_page( $_POST['page_id'] ) ) {
            die( '0' );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end lean_delete_privacy_policy_page
add_action( 'wp_ajax_lean_delete_privacy_policy_page', 'lean_delete_privacy_policy_page' );

/**
 * Callback function used in the Ajax request for generating the Comment Policy.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_generate_comment_policy_page( ) {

    if( wp_verify_nonce( $_REQUEST['nonce'], 'lean_generate_comment_policy_nonce' ) && isset( $_POST['generateCommentPolicy'] ) ) {

        $page_id = create_page( 'comment-policy', __( 'Comment Policy', 'lean' ) );
        if( $page_id > 0 ) {
            die( (string)$page_id );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end lean_generate_comment_policy_page
add_action( 'wp_ajax_lean_generate_comment_policy_page', 'lean_generate_comment_policy_page' );

/**
 * Callback function used in the Ajax request for deleting the Privacy Policy.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_delete_comment_policy_page( ) {

    // We'll be using the same nonce for generating the policy.
    if( wp_verify_nonce( $_REQUEST['nonce'], 'lean_generate_comment_policy_nonce' ) && isset( $_POST['deleteCommentPolicy'] ) && isset( $_POST['page_id'] ) ) {

        if( delete_page( $_POST['page_id'] ) ) {
            die( '0' );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end lean_delete_comment_policy_page
add_action( 'wp_ajax_lean_delete_comment_policy_page', 'lean_delete_comment_policy_page' );

/**
 * Sanitization callback for the Publishing Options. Since each of the options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *
 * @param	array $input	The unsanitized collection of options.
 * @return	array The collection of sanitized values.
 * @since 	3.0
 * @version	3.2
 */
function lean_theme_publishing_options_validate( $input ) {

    $output = array();

    foreach( $input as $key => $val ) {

        if( isset ( $input[ $key ] ) ) {
            $output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
        } // end if

    } // end foreach

    return apply_filters( 'lean_theme_publishing_options_validate', $output, $input, get_theme_default_publishing_options() );

} // end lean_theme_publishing_options_validate

/* ----------------------------- *
 * 	Options Page
 * ----------------------------- */

/**
 * Renders the header for the theme options page.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_theme_options_display() {
    ?>
    <div id="lean-options" class="wrap">
        <div id="lean-info">

            <div id="icon-themes" class="icon32"></div>
            <h3 id="lean-title"><?php _e( 'Lean', 'lean' ); ?> <span><?php _e( 'for publishers', 'lean' ); ?></span></h3>

            <div id="lean-desc">
                <p><?php _e( 'Lean is a sleek, exacting product designed for uncluttered and sophisticated presentation of your content on desktop and mobile devices.', 'lean' ); ?></p>
            </div>
        </div><!--/#lean-info -->

        <div id="lean-options-links">
            <ul>
                <li><a class="lean-docs" href="http://docs.leantheme.co/" target="_blank"><?php _e( 'Documentation', 'lean' ); ?></a></li>
                <li><a class="lean-support" href="http://support.leantheme.co" target="_blank"><?php _e( 'Support', 'lean' ); ?></a></li>
                <li><a class="lean-blog" href="http://jasonbradley.me" target="_blank"><?php _e( 'Blog', 'lean' ); ?></a></li>
            </ul>
        </div>

        <div class="clear"></div>

        <?php $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'lean_theme_global_options'; ?>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab <?php echo $active_tab == 'lean_theme_global_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=lean_theme_global_options"><?php _e( 'Global', 'lean' ); ?></a>
            <a class="nav-tab <?php echo $active_tab == 'lean_theme_presentation_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=lean_theme_presentation_options"><?php _e( 'Presentation', 'lean' ); ?></a>
            <a class="nav-tab <?php echo $active_tab == 'lean_theme_social_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=lean_theme_social_options"><?php _e( 'Social', 'lean' ); ?></a>
            <a class="nav-tab <?php echo $active_tab == 'lean_theme_publishing_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=lean_theme_publishing_options"><?php _e( 'Publishing', 'lean' ); ?></a>
        </h2>

        <div id="message-container"><?php settings_errors(); ?></div>

        <form method="post" action="options.php">
            <?php

            if( 'lean_theme_global_options' == $active_tab ) {

                settings_fields( 'lean_theme_global_options' );
                do_settings_sections( 'lean_theme_global_options' );

            } else if( 'lean_theme_presentation_options' == $active_tab ) {

                settings_fields( 'lean_theme_presentation_options' );
                do_settings_sections( 'lean_theme_presentation_options' );

            } else if( 'lean_theme_social_options' == $active_tab ) {

                settings_fields( 'lean_theme_social_options' );
                do_settings_sections( 'lean_theme_social_options' );

            } else {

                do_settings_sections( 'lean_theme_publishing_options' );
                settings_fields( 'lean_theme_publishing_options' );

            } // end if/else

            // Display the 'Save Changes' button
            submit_button();

            ?>
        </form>
    </div><!-- /.wrap -->
<?php
} // end lean_theme_options_display