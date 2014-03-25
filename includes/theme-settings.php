<?php
/**
 * Theme settings.
 *
 * @version	1.1
 * @since	1.0
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
 * @since	1.0
 * @version	1.1
 */
function theme_menu() {

    add_menu_page(
        __( THEME_NAME . ' Options', TRANSLATION_KEY ),
        __( THEME_NAME, TRANSLATION_KEY ),
        'administrator',
        'theme_options',
        'theme_options_display',
        ' ',
        59
    );

    add_submenu_page(
        'theme_options',
        __( 'Global', TRANSLATION_KEY ),
        __( 'Global', TRANSLATION_KEY ),
        'administrator',
        'theme_options&tab=theme_global_options',
        'theme_options_display'
    );

    add_submenu_page(
        'theme_options',
        __( 'Presentation', TRANSLATION_KEY ),
        __( 'Presentation', TRANSLATION_KEY ),
        'administrator',
        'theme_options&tab=theme_presentation_options',
        'theme_options_display'
    );

    add_submenu_page(
        'theme_options',
        __( 'Social', TRANSLATION_KEY ),
        __( 'Social', TRANSLATION_KEY ),
        'administrator',
        'theme_options&tab=theme_social_options',
        'theme_options_display'
    );

    add_submenu_page(
        'theme_options',
        __( 'Publishing', TRANSLATION_KEY ),
        __( 'Publishing', TRANSLATION_KEY ),
        'administrator',
        'theme_options&tab=theme_publishing_options',
        'theme_options_display'
    );

} // end theme_menu
add_action( 'admin_menu', 'theme_menu' );

/* ----------------------------- *
 * Layout Options
 * ----------------------------- */

/**
 * Provides the default values for the Presentation Options.
 *
 * @since	1.0
 * @version	1.1
 */
function get_theme_default_presentation_options() {

    $defaults = array(
        'fav_icon'					=>	'',
        'contrast'					=>	'light',
        'layout' 					=> 	'right_sidebar_layout',
        'display_breadcrumbs'		=>	'always',
        'display_featured_images' 	=> 	'always'
    );

    return apply_filters ( 'theme_default_presentation_options', $defaults );

} // end theme_default_presentation_options

/**
 * Defines the Presentation Options. Specifically, the sections and the settings. Will also
 * create the option if it does not already exist in the database.
 *
 * @since	1.0
 * @version	1.1
 */
function setup_theme_presentation_options() {

    // If the layout options don't exist, create them.
    if( false == get_option( 'theme_presentation_options' ) ) {
        add_option( 'theme_presentation_options', apply_filters( 'theme_default_presentation_options', get_theme_default_presentation_options() ) );
    } // end if

    // Presentation options (composed of layout and content)
    add_settings_section(
        'presentation',
        '',
        'theme_presentation_options_display',
        'theme_presentation_options'
    );

    // Layout
    add_settings_section(
        'layout',
        __( 'Layout and Design', TRANSLATION_KEY ),
        'theme_layout_options_display',
        'theme_presentation_options'
    );

    add_settings_field(
        'logo',
        __( 'Logo', TRANSLATION_KEY ),
        'logo_display',
        'theme_presentation_options',
        'layout'
    );

    add_settings_field(
        'fav_icon',
        __( 'Site Icon', TRANSLATION_KEY ),
        'fav_icon_display',
        'theme_presentation_options',
        'layout'
    );

    add_settings_field(
        'contrast',
        __( 'Contrast', TRANSLATION_KEY ),
        'contrast_display',
        'theme_presentation_options',
        'layout'
    );

    add_settings_field(
        'left_sidebar_layout',
        __( 'Left Sidebar', TRANSLATION_KEY ),
        'left_sidebar_presentation_display',
        'theme_presentation_options',
        'layout',
        array(
            'option_image_path' => get_template_directory_uri() . '/images/layout-left.gif'
        )
    );

    add_settings_field(
        'right_sidebar_layout',
        __( 'Right Sidebar', TRANSLATION_KEY ),
        'right_sidebar_presentation_display',
        'theme_presentation_options',
        'layout',
        array(
            'option_image_path' => get_template_directory_uri() . '/images/layout-right.gif'
        )
    );

    add_settings_field(
        'full_width_layout',
        __( 'No Sidebar / Full Width', TRANSLATION_KEY ),
        'full_width_presentation_display',
        'theme_presentation_options',
        'layout',
        array(
            'option_image_path' => get_template_directory_uri() . '/images/layout-full.gif'
        )
    );

    // Content
    add_settings_section(
        'content',
        __( 'Content', TRANSLATION_KEY ),
        'theme_content_options_display',
        'theme_presentation_options'
    );

    add_settings_field(
        'display_breadcrumbs',
        __( 'Display Breadcrumbs', TRANSLATION_KEY ),
        'display_breadcrumbs_display',
        'theme_presentation_options',
        'content'
    );

    add_settings_field(
        'display_featured_images',
        __( 'Display Featured Images', TRANSLATION_KEY ),
        'display_featured_images_display',
        'theme_presentation_options',
        'content'
    );

    // Footer
    add_settings_section(
        'footer',
        __( 'Footer', TRANSLATION_KEY ),
        'theme_footer_options_display',
        'theme_presentation_options'
    );

    add_settings_field(
        'display_footer_credits',
        __( 'Display Footer Credits', TRANSLATION_KEY ),
        'display_footer_credits_display',
        'theme_presentation_options',
        'footer'
    );

    register_setting(
        'theme_presentation_options',
        'theme_presentation_options',
        'theme_presentation_options_validate'
    );

} // end setup_theme_presentation_options
add_action( 'admin_init', 'setup_theme_presentation_options' );

/**
 * Placeholder function for the Presentation Options display function. The section contains
 * both Layout Design and Content options each of which are responsible for displaying their own
 * own options screen.
 *
 * This function is required by the Settings API.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_presentation_options_display() {} // end theme_presentation_options_display

/**
 * Renders the description for the Layout and Design options.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_layout_options_display() {
    echo '<p>' . __( 'This section controls positioning and style elements.', TRANSLATION_KEY ) . '</p>';
} // end theme_layout_options_display

/**
 * Renders the description for the Content options.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_content_options_display() {
    echo '<p>' . __( 'This section controls when content elements are displayed.', TRANSLATION_KEY ) . '</p>';
} // end theme_content_options_display

/**
 * Renders the description for the Footer options.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_footer_options_display() {
    echo '<p>' . __( 'This section controls what footer credit elements are displayed.', TRANSLATION_KEY ) . '</p>';
} // end theme_footer_options_display

/**
 * Renders the option element for the Site Icon.
 *
 * @since	1.0
 * @version	1.1
 */
function fav_icon_display() {

    $options = get_option( 'theme_presentation_options' );

    $fav_icon = '';
    if( isset( $options['fav_icon'] ) ) {
        $fav_icon = $options['fav_icon'];
    } // end if

    $html = '<div id="fav_icon_preview_container">';
    $html .= '<img src="' . $fav_icon . '" id="fav_icon_preview" alt="" />';
    $html .= '</div>';
    $html .= '<input type="hidden" id="fav_icon" name="theme_presentation_options[fav_icon]" value="' . esc_attr( $fav_icon ) . '" class="media-upload-field" />';
    $html .= '<input type="button" class="button upload button-secondary" id="upload_fav_icon" value="' . __( 'Upload', TRANSLATION_KEY ) . '"/>';

    if( '' != trim( $fav_icon ) ) {
        $html .= '<input type="button" class="button button-delete" id="delete_fav_icon" value="' . __( 'Delete', TRANSLATION_KEY ) . '"/>';
    } // end if

    $html .= '&nbsp;<span class="description">' . __( 'Dimensions: 144px x 144px. Used for favicon and mobile devices.', TRANSLATION_KEY ) . '&nbsp;<a href="http://docs.leantheme.co/admin-panel/presentation/" target="_blank">' . __( 'Learn more', TRANSLATION_KEY ) . '</a>.</span>';

    echo $html;

} // end fav_icon_display

/**
 * Renders the option element for the Contrast setting.
 *
 * @since	1.0
 * @version	1.1
 */
function contrast_display() {

    $options = get_option( 'theme_presentation_options' );

    $html = '<select id="contrast" name="theme_presentation_options[contrast]">';
    $html .= '<option value="light"' . selected( $options['contrast'], 'light', false ) . '>' . __( 'Light', TRANSLATION_KEY ) . '</option>';
    $html .= '<option value="dark"' . selected( $options['contrast'], 'dark', false ) . '>' . __( 'Dark', TRANSLATION_KEY )  . '</option>';
    $html .= '</select>';
    $html .= '&nbsp;';
    $html .= '<span class="description">' . __( 'Can be used with <a href="themes.php?page=custom-background">custom backgrounds</a>.', TRANSLATION_KEY ) . '</span>';

    echo $html;

} // end contrast_display

/**
 * Renders the option element for the Logo.
 *
 * @since	1.0
 * @version	1.1
 */
function logo_display() {

    $options = get_option( 'theme_presentation_options' );

    $logo = '';
    if( isset( $options['logo'] ) ) {
        $logo = $options['logo'];
    } // end if

    $html = '<div id="logo_preview_container">';
    $html .= '<img src="' . $logo . '" id="logo_preview" alt="" />';
    $html .= '</div><!-- #logo_preview_container -->';

    $html .= '<input type="hidden" id="logo" name="theme_presentation_options[logo]" value="' . esc_attr( $logo ) . '" class="media-upload-field" />';
    $html .= '<input type="button" class="button upload button-secondary" id="upload_logo" value="' . __( 'Upload', TRANSLATION_KEY ) . '"/>';

    if( '' != trim( $logo ) ) {
        $html .= '<input type="button" class="button button-delete" id="delete_logo" value="' . __( 'Delete', TRANSLATION_KEY ) . '"/>';
    } // end if

    $html .= '&nbsp;<span class="description">' . __( 'Use an image in place of the <a href="options-general.php">Site Title and Tagline</a>. <a href="themes.php?page=custom-header">Custom Headers</a> are also available.', TRANSLATION_KEY ) . '</span>';

    echo $html;

} // end logo_display

/**
 * Renders the option element for the Left-Sidebar Layout.
 *
 * @param	array $args	The array of options used for rendering the option. Includes a path to the option's image.
 * @since	1.0
 * @version	1.1
 */
function left_sidebar_presentation_display( $args ) {

    $options = get_option( 'theme_presentation_options' );

    $html = '<input type="radio" id="theme_left_sidebar_layout" name="theme_presentation_options[layout]" value="left_sidebar_layout"' . checked( 'left_sidebar_layout', $options['layout'], false ) . ' />';
    $html .= '<img src="' . esc_url( $args['option_image_path'] ) . '" alt="" />';

    echo $html;

} // end left_sidebar_presentation_display

/**
 * Renders the option element for the Right-Sidebar Layout.
 *
 * @param	array $args	The array of options used for rendering the option. Includes a path to the option's image.
 * @since	1.0
 * @version	1.1
 */
function right_sidebar_presentation_display( $args ) {

    $options = get_option( 'theme_presentation_options' );

    $html = '<input type="radio" id="theme_right_sidebar_layout"  name="theme_presentation_options[layout]" value="right_sidebar_layout"' . checked( 'right_sidebar_layout', $options['layout'], false ) . ' />';
    $html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';

    echo $html;

} // end right_sidebar_presentation_display

/**
 * Renders the option element for the Full-Width Layout.
 *
 * @param	array $args	The array of options used for rendering the option. Includes a path to the option's image.
 * @since	1.0
 * @version	1.1
 */
function full_width_presentation_display( $args ) {

    $options = get_option( 'theme_presentation_options' );

    $html = '<input type="radio" id="theme_full_width_layout"  name="theme_presentation_options[layout]" value="full_width_layout"' . checked( 'full_width_layout', $options['layout'], false ) . ' />';
    $html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';

    echo $html;

} // end full_width_presentation_display

/**
 * Renders the option element for the Breadcrumb.
 *
 * @since	1.0
 * @version	1.1
 */
function display_breadcrumbs_display() {

    $options = get_option( 'theme_presentation_options' );

    $display_breadcrumbs = '';
    if( isset( $options['display_breadcrumbs'] ) ) {
        $display_breadcrumbs = $options['display_breadcrumbs'];
    } // end if

    $html = '<select id="display_breadcrumbs" name="theme_presentation_options[display_breadcrumbs]">';
    $html .= '<option value="always"'. selected( $options['display_breadcrumbs'], 'always', false ) . '>' . __( 'Always', TRANSLATION_KEY ) . '</option>';
    $html .= '<option value="never"'. selected( $options['display_breadcrumbs'], 'never', false ) . '>' . __( 'Never', TRANSLATION_KEY ) . '</option>';
    $html .= '</select>';

    $html .= '&nbsp;<span class="description">' . __( 'SEO experts encourage breadcrumb use. <a href="http://docs.leantheme.co/admin-panel/presentation/">Learn more</a>.', TRANSLATION_KEY ) . '</span>';

    echo $html;

} // end display_breadcrumbs_display

/**
 * Renders the option element for Featured Images.
 *
 * @since	1.0
 * @version	1.1
 */
function display_featured_images_display() {

    $options = get_option( 'theme_presentation_options' );

    $html = '<select id="display_featured_image" name="theme_presentation_options[display_featured_images]">';
    $html .= '<option value="always"'. selected( $options['display_featured_images'], 'always', false ) . '>' . __( 'Always', TRANSLATION_KEY ) . '</option>';
    $html .= '<option value="never"'. selected( $options['display_featured_images'], 'never', false ) . '>' . __( 'Never', TRANSLATION_KEY ) . '</option>';
    $html .= '<option value="index"'. selected( $options['display_featured_images'], 'index', false ) . '>' . __( 'On index only', TRANSLATION_KEY ) . '</option>';
    $html .= '<option value="single-post"'. selected( $options['display_featured_images'], 'single-post', false ) . '>' . __( 'On single posts only', TRANSLATION_KEY ) . '</option>';
    $html .= '</select>';

    echo $html;

} // end display_featured_images_display

/**
 * Renders the option element for Fotoer Credits.
 *
 * @since	2.0
 * @version	2.0
 */
function display_footer_credits_display() {

    $options = get_option( 'theme_presentation_options' );

    $html = '<select id="display_footer_credits" name="theme_presentation_options[display_footer_credits]">';
    $html .= '<option value="always"'. selected( $options['display_footer_credits'], 'always', false ) . '>' . __( 'Always', TRANSLATION_KEY ) . '</option>';
    $html .= '<option value="never"'. selected( $options['display_footer_credits'], 'never', false ) . '>' . __( 'Never', TRANSLATION_KEY ) . '</option>';
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
 * @since	1.0
 * @version	1.1
 */
function theme_presentation_options_validate( $input ) {

    $output = array();

    foreach( $input as $key => $val ) {

        if( isset ( $input[$key] ) ) {
            $output[$key] = $input[$key];
        } // end if

    } // end foreach

    return apply_filters( 'theme_presentation_options_validate', $output, $input, get_theme_default_presentation_options() );

} // end theme_presentation_options_validate

/* ----------------------------- *
 * 	Social Options
 * ----------------------------- */

/**
 * Provides the default values for the Social Options.
 *
 * @since	1.0
 * @version	1.1
 */
function get_theme_default_social_options() {

    $defaults = array(
        'active-social-icons'		=> '',
        'available-social-icons' 	=> ''
    );

    return apply_filters ( 'theme_social_options', $defaults );

} // end get_theme_default_social_options

/**
 * Defines the Social Options. Specifically, the sections and the settings. Will also
 * create the option if it does not already exist in the database.
 *
 * @since	1.0
 * @version	1.1
 */
function setup_theme_social_options() {

    // If the theme options don't exist, create them.
    if( false == get_option( 'theme_social_options' ) ) {
        add_option( 'theme_social_options', apply_filters( 'theme_default_social_options', get_theme_default_social_options() ) );
    } // end if

    // Look to see if any new icons have been added to the library since the last version of the theme
    get_theme_default_social_options();

    /* ------------------ Social Networks ------------------ */

    add_settings_section(
        'social',
        '',
        'theme_social_options_display',
        'theme_social_options'
    );

    add_settings_field(
        'available_social_icons',
        __( 'Available Icons', TRANSLATION_KEY ),
        'available_icons_display',
        'theme_social_options',
        'social'
    );

    add_settings_field(
        'active_social_icons',
        __( 'Active Icons', TRANSLATION_KEY ),
        'active_icons_display',
        'theme_social_options',
        'social'
    );

    register_setting(
        'theme_social_options',
        'theme_social_options',
        'theme_social_options_validate'
    );

} // end setup_theme_social_options
add_action( 'admin_init', 'setup_theme_social_options' );

/**
 * Renders the description for the Social Options page.
 *
 * @since	1.0
 * @version	1.2
 */
function theme_social_options_display() {

    _e( 'This section controls social network icons in the site header. Drag, drop, and position desired icons from the Icon Library to the Active Icons area. This section controls social network icons in the site header. Drag, drop, and position desired icons from the Icon Library to the Active Icons area. You can also delete all icons and <a href="javascript:;" id="reset-social-icons" class="ad_delete">restore defaults.</a>', TRANSLATION_KEY );

    $html = '<div class="social-icons-wrapper">';

    $html .= '<div id="social-icons-active" class="left">';
    $html .= '<div class="sidebar-name">';
    $html .= '<h3>' . __( 'Active Icons', TRANSLATION_KEY ) . '</h3>';
    $html .= '</div><!-- /.sidebar-name -->';
    $html .= '<div id="active-icons">';
    $html .= '<p class="description">' . __( 'Click an icon to set the full URL. The icon will not display correctly without it.', TRANSLATION_KEY ) . '</p>';
    $html .= '<ul id="active-icon-list"></ul>';
    $html .= '<div id="active-icon-url" class="hidden">';
    $html .= '<label>' . __( 'Icon URL:', TRANSLATION_KEY ) . '</label>';
    $html .= '<input type="text" id="social-icon-url" value="" class="icon-url" data-via="" data-url="" />';
    $html .= '&nbsp;<span class="description" id="social-rss-icon-controls">';
    $html .= '<a href="' . THEME_DOCUMENTATION_URL . '/social" target="_blank">' . __( 'Learn More', TRANSLATION_KEY ) . '</a>';
    $html .= '</span><!-- /#social-rss-icon-controls -->';
    $html .= '<span id="social-icon-controls">';
    $html .= '<input type="button" class="button" id="set-social-icon-url" value="' . __( 'Done', TRANSLATION_KEY ). '" />';
    $html .= '&nbsp;';
    $html .= '<a href="javascript:;" id="cancel-social-icon-url">' . __( 'Cancel', TRANSLATION_KEY ) . '</a>';
    $html .= '</span><!-- /#social-icon-controls -->';
    $html .= '</div><!-- /#active-icon-url -->';
    $html .= '<div id="social-icon-max" class="hidden alert alert-info">' . __( '' . THEME_NAME . ' looks best with seven icons or fewer.', TRANSLATION_KEY ) . '</div>';
    $html .= '</div><!-- /#active-icons -->';
    $html .= '</div><!-- /#social-icons-active -->';

    $html .= '<div id="social-icons-available" class="right">';
    $html .= '<div class="sidebar-name">';
    $html .= '<h3>' . __( 'Icon Library', TRANSLATION_KEY ) . '</h3>';
    $html .= '</div><!-- /.sidebar-name -->';
    $html .= '<div id="available-icons">';
    $html .= '<p class="description">' . __( 'Drag over icons that you want to use to Active Icons.', TRANSLATION_KEY ) . '</p>';
    $html .= '<ul id="available-icon-list"></ul>';
    $html .= '</div><!-- /#available-icons -->';
    $html .= '</div><!-- /.social-icons-available -->';

    $html .= '<span id="save-social-icons-nonce" class="hidden">' . wp_create_nonce( 'save_social_icons_nonce' ) . '</span>';
    $html .= '<span id="wordpress-rss-url" class="hidden">' . esc_url( get_rss_feed_url() ) . '</span>';
    $html .= '<span id="reset-social-icons" class="hidden">' . wp_create_nonce( 'reset_social_icons_nonce' ) . '</span>';

    $html .= '</div><!-- /.social-icons-wrapper -->';

    echo $html;

} // end theme_social_options_display

/**
 * Callback function used in the Ajax request for generating the Social Icons.
 *
 * @version	1.1
 * @since 	1.0
 */
function save_social_icons( ) {

    if( wp_verify_nonce( $_REQUEST['nonce'], 'save_social_icons_nonce' ) && isset( $_POST['updateSocialIcons'] ) ) {

        // Manually create the input array of options
        $input = array(
            'available-social-icons'	=>	$_POST['availableSocialIcons'],
            'active-social-icons' 		=> 	$_POST['activeSocialIcons']
        );

        if( update_option( 'theme_social_options', theme_social_options_validate( $input ) ) ) {
            die( '0' );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end save_social_icons
add_action( 'wp_ajax_save_social_icons', 'save_social_icons' );

/**
 * Displays the message for users attempting to delete the core set of social icons.
 *
 * @since 	1.0
 * @version	1.1
 */
function delete_social_icons() {
    if( wp_verify_nonce( $_REQUEST['nonce'], 'delete-social-icon-nonce' ) ) {
        die( display_delete_social_icon_message() );
    } // end if
} // end delete_social_icons
add_action( 'wp_ajax_delete_social_icons', 'delete_social_icons' );

/**
 * Generates a message to be displayed when the user attempts to delete a social icon.
 *
 * @since 	1.0
 * @version	1.1
 */
function display_delete_social_icon_message() {

    $html = '<div id="delete-social-icons" class="updated">';
    $html .= '<p>';
    $html .= __( 'You cannot delete the default set of ' . THEME_NAME . ' social icons. <a href="javascript:;" id="hide-delete-social-icon-message">Hide this message.</a>', TRANSLATION_KEY );
    $html .= '</p>';
    $html .= '</div><!-- /#delete-social-icons -->';

    echo $html;

} // end display_delete_social_icon_message

/**
 * Renders the available social icon input. This field is hidden and is manipulated by the functionality for powering
 * the drag and drop ability of the icons.
 *
 * @since 	1.0
 * @version	1.1
 */
function available_icons_display() {

    $options = get_option( 'theme_social_options' );

    $html = '<input type="text" id="available-social-icons" name="theme_social_options[available-social-icons]" value="' . $options['available-social-icons'] . '" />';
    $html .= '<span id="delete-social-icon-nonce" class="">' . wp_create_nonce( 'delete-social-icon-nonce' ) . '</span>';

    echo $html;

} // end available_icons_display

/**
 * Renders the active social icon input. This field is hidden and is manipulated by the functionality for powering
 * the drag and drop ability of the icons.
 *
 * @since 	1.0
 * @version	1.1
 */
function active_icons_display() {

    $options = get_option( 'theme_social_options' );
    echo '<input type="text" id="active-social-icons" name="theme_social_options[active-social-icons]" value="' . $options['active-social-icons'] . '" />';

} // end active_icons_display

/**
 * Sanitization callback for the Social Options. Since each of the options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *
 * @param	array $input	The unsanitized collection of options.
 * @return	array The collection of sanitized values.
 * @since 	1.0
 * @version	1.1
 */
function theme_social_options_validate( $input ) {

    $output = $defaults = get_theme_default_social_options();

    foreach( $input as $key => $val ) {

        if( isset ( $input[$key] ) ) {
            $output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
        } // end if

    } // end foreach

    return apply_filters( 'theme_social_options_validate', $output, $input, $defaults );

} // end theme_options_validate

/**
 * When upgrading to newer versions, this function looks for any new icons that may exist in the social icons directory.
 *
 * If so, it will add them to the available icons. It excludes icons that are already active.
 *
 * If users have uploaded their own icons for ones that we have included, such as LinkedIn or
 * SoundCloud then they'll need to 'Restore Defaults' and configure their own.
 *
 * @version	1.1
 * @since 	1.0
 */
function find_new_social_icons() {

    // Be sure to look for any additional social icons
    $social_options = get_option( 'theme_social_options' );

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
        update_option( 'theme_social_options', $social_options );

    } // end if

} // end find_new_social_icons

/* ----------------------------- *
 * 	Global Options
 * ----------------------------- */

/**
 * Provides the default values for the Global Options.
 *
 * @since	1.0
 * @version	1.1
 */
function get_theme_default_global_options() {

    $defaults = array(
        'site_mode'					=>	'online',
        'feedburner_url'			=>	'',
        'google_analytics'			=>	'',
        'offline_display_message'	=>	__( 'Our site is currently offline.', TRANSLATION_KEY )
    );

    return apply_filters ( 'theme_default_global_options', $defaults );

} // end get_theme_default_global_options

/**
 * Defines the Global Options. Specifically, the sections and the settings. Will also
 * create the option if it does not already exist in the database.
 *
 * @since	1.0
 * @version	1.1
 */
function setup_theme_global_options() {

    // If the theme options don't exist, create them.
    if( false == get_option( 'theme_global_options' ) ) {
        add_option( 'theme_global_options', apply_filters( 'theme_default_global_options', get_theme_default_global_options() ) );
    } // end if

    /* ------------------ Page Options ------------------ */

    add_settings_section(
        'global',
        '',
        'theme_global_options_display',
        'theme_global_options'
    );

    add_settings_field(
        'feedburner_url',
        __( 'FeedBurner URL', TRANSLATION_KEY ),
        'feedburner_url_display',
        'theme_global_options',
        'global'
    );

    add_settings_field(
        'google_analytics',
        __( 'Google Analytics', TRANSLATION_KEY ),
        'google_analytics_display',
        'theme_global_options',
        'global'
    );

    add_settings_field(
        'site_mode',
        __( 'Site Mode', TRANSLATION_KEY ),
        'site_mode_display',
        'theme_global_options',
        'global'
    );

    add_settings_field(
        'offline_message',
        __( 'Offline Message', TRANSLATION_KEY ),
        'offline_message_display',
        'theme_global_options',
        'global'
    );

    register_setting(
        'theme_global_options',
        'theme_global_options',
        'theme_global_options_validate'
    );

} // end setup_theme_global_options
add_action( 'admin_init', 'setup_theme_global_options' );

/**
 * Renders the description for the Global Options page.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_global_options_display() {

    $html = '<h3>' . __( 'Site Configuration ', TRANSLATION_KEY ) . '</h3>';
    $html .= '<p>' . __( 'This section controls site wide features.', TRANSLATION_KEY ) . '</p>';

    echo $html;

} // end theme_global_options_display

/**
 * Renders the option element for FeedBurner.
 *
 * @since	1.0
 * @version	1.1
 */
function feedburner_url_display() {

    $option = get_option( 'theme_global_options' );

    // Only render this option for administrators
    if( current_user_can( 'manage_options' ) ) {

        $feedburner_url = '';
        if( true == isset ( $option['feedburner_url'] ) ) {
            $feedburner_url = $option['feedburner_url'];
        } // end if

        $html = '<input type="text" id="feedburner_url" name="theme_global_options[feedburner_url]" placeholder="http://feeds.feedburner.com/example" value="' . esc_attr( $feedburner_url ) . '" />';
        $html .= '&nbsp;<span class="description">' . __( 'Use in place of the native RSS feed.', TRANSLATION_KEY ) . '</span>';

        echo $html;

    } // end if/else

} // end google_analytics_display

/**
 * Renders the option element for Google Analytics.
 *
 * @since	1.0
 * @version	1.1
 */
function google_analytics_display() {

    $option = get_option( 'theme_global_options' );

    // Only render this option for administrators
    if( current_user_can( 'manage_options' ) ) {

        $analytics_id = '';
        if( true == isset ( $option['google_analytics'] ) ) {
            $analytics_id = $option['google_analytics'];
        } // end if

        $html = '<input type="text" id="google_analytics" name="theme_global_options[google_analytics]" placeholder="UA-000000" value="' . esc_attr( $analytics_id ) . '" />';
        $html .= '&nbsp;<span class="description">' . __( 'Enter the ID only.', TRANSLATION_KEY ) . '</span>';

        echo $html;

    } // end if/else

} // end google_analytics_display

/**
 * Renders the option element for activating Offline Mode.
 *
 * @since	1.0
 * @version	1.1
 */
function site_mode_display( ) {

    $options = get_option( 'theme_global_options' );

    $site_mode = '';
    if( isset( $options['site_mode'] ) ) {
        $site_mode = $options['site_mode'];
    } // end if

    $html = '<select id="site_mode" name="theme_global_options[site_mode]">';
    $html .= '<option value="online"' . selected( $site_mode, 'online', false ) . '>' . __( 'Online', TRANSLATION_KEY ) .'</option>';
    $html .= '<option value="offline"' . selected( $site_mode, 'offline', false ) . '>' . __( 'Offline', TRANSLATION_KEY ) .'</option>';
    $html .= '</select>';

    $html .= '&nbsp;';

    $html .= '<span class="description">';
    $html .= __( 'WARNING: Taking site offline will hide all content from site visitors and search engines.', TRANSLATION_KEY );
    $html .= '</span>';

    echo $html;

} // end site_mode_display

/**
 * Renders the option element for the 140-character message for Offline Mode.
 *
 * @since	1.0
 * @version	1.1
 */
function offline_message_display() {

    $options = get_option( 'theme_global_options' );

    $offline_message = '';
    if( isset( $options['offline_message'] ) ) {
        $offline_message = $options['offline_message'];
    } // end if

    echo '<input type="text" id="offline_message" name="theme_global_options[offline_message]" value="' . esc_attr( $offline_message ) . '" maxlength="140" />';

} // end offline_message_display

/**
 * Sanitization callback for the Global Options. Since each of the options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *
 * @param	array $input	The unsanitized collection of options.
 * @return	array The collection of sanitized values.
 * @since 	1.0
 * @version	1.1
 */
function theme_global_options_validate( $input ) {

    $output = array();

    foreach( $input as $key => $val ) {

        if( isset ( $input[$key] ) ) {
            $output[$key] = strip_tags( stripslashes( $input[$key] ) );
        } // end if

    } // end foreach

    return apply_filters( 'theme_global_options_validate', $output, $input, get_theme_default_global_options() );

} // end theme_global_options_validate

/* ----------------------------- *
 * 	Publishing Options
 * ----------------------------- */

/**
 * Provides the default values for the Post Options on the Publishing Options page.
 *
 * @since	1.0
 * @version	1.1
 */
function get_theme_default_publishing_options() {

    $defaults = array(
        'display_author_box'			=>	'always'
    );

    return apply_filters ( 'theme_default_publishing_options', $defaults );

} // end get_theme_default_publishing_options

/**
 * Defines the Publishing Options. Specifically, the sections and the settings. Will also
 * create the option if it does not already exist in the database.
 *
 * @since	1.0
 * @version	1.1
 */
function setup_theme_publishing_options() {

    // If the theme options don't exist, create them.
    if( false == get_option( 'theme_publishing_options' ) ) {
        add_option( 'theme_publishing_options', apply_filters( 'theme_publishing_options', get_theme_default_publishing_options() ) );
    } // end if

    // Publishing options (composed of Post and Pages)
    add_settings_section(
        'publishing',
        '',
        'theme_publishing_options_display',
        'theme_publishing_options'
    );

    // Post options
    add_settings_section(
        'post',
        __( 'Posts', TRANSLATION_KEY ),
        'theme_post_options_display',
        'theme_publishing_options'
    );

    add_settings_field(
        'display_author_box',
        __( 'Display Author Box', TRANSLATION_KEY ),
        'display_author_box_display',
        'theme_publishing_options',
        'post'
    );

    // Page options
    add_settings_section(
        'page',
        __( 'Pages', TRANSLATION_KEY ),
        'theme_page_options_display',
        'theme_publishing_options'
    );

    add_settings_field(
        'privacy_policy_template',
        __( 'Privacy Policy', TRANSLATION_KEY ),
        'privacy_policy_template_display',
        'theme_publishing_options',
        'page'
    );

    add_settings_field(
        'comment_policy_template',
        __( 'Comment Policy', TRANSLATION_KEY ),
        'comment_policy_template_display',
        'theme_publishing_options',
        'page'
    );

    register_setting(
        'theme_publishing_options',
        'theme_publishing_options',
        'theme_publishing_options_validate'
    );

} // end setup_theme_publishing_options
add_action( 'admin_init', 'setup_theme_publishing_options' );

/**
 * Placeholder function for the Publishing Options display function. The section contains
 * both Post and Page options each of which are responsible for displaying their own
 * own options screen.
 *
 * This function is required by the Settings API.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_publishing_options_display() {}

/**
 * Renders the description for the Post Options settings on the Publishing page.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_post_options_display() {
    echo '<p>' . __( 'This section controls publisher-centric features available on individual posts.', TRANSLATION_KEY ) . '</p>';
} // end theme_post_options_display

/**
 * Renders the description for the Page Options settings on the Publishing page.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_page_options_display() {
    echo '<p>' . __( 'This section controls publisher-centric features available for pages.', TRANSLATION_KEY ) . '</p>';
} // end theme_page_options_display

/**
 * Renders the option element for the Author Box.
 *
 * @since	1.0
 * @version	1.1
 */
function display_author_box_display() {

    $options = get_option( 'theme_publishing_options' );

    $display_author_box = '';
    if( isset( $options['display_author_box'] ) ) {
        $display_author_box = $options['display_author_box'];
    } // end if

    $html = '<select id="display_author_box" name="theme_publishing_options[display_author_box]">';
    $html .= '<option value="always"' . selected( $options['display_author_box'], 'always', false ) . '>' . __( 'Always', TRANSLATION_KEY ) . '</option>';
    $html .= '<option value="never"' . selected( $options['display_author_box'], 'never', false ) . '>' . __( 'Never', TRANSLATION_KEY )  . '</option>';
    $html .= '</select>';

    $html .= '&nbsp;<span class="description">' . __( "Display name, website, social networks, and bio from the <a href='profile.php'>author's profile</a> after post content.", TRANSLATION_KEY ) . '</span>';

    echo $html;

} // end display_author_box_display

/**
 * Renders the option for generating the Privacy Policy from within the WorsPress Dashboard.
 *
 * @since	1.0
 * @version	1.1
 */
function privacy_policy_template_display() {

    // First, detect if the privacy policy page exists
    $privacy_policy = get_page_by_title( __( 'Privacy Policy', TRANSLATION_KEY ) );

    // Options to display if the page doesn't already exist
    $html = '<div id="generate-privacy-policy-wrapper"' . ( '' == $privacy_policy ? ' ' : ' class="hidden" ' )  . '>';
    $html .= '<input type="submit" class="button-secondary" id="generate_privacy_policy" name="generate_privacy_policy" value="' . __( 'Generate', TRANSLATION_KEY ) . '" />';
    $html .= '<span id="privacy-policy-nonce" class="hidden">' . wp_create_nonce( 'generate_privacy_policy_nonce' ) . '</span>';
    $html .= '&nbsp;';
    $html .= '<span class="description">' . __( '<a href="http://docs.leantheme.co/admin-panel/publishing/" target="_blank">' . __( 'Learn more', TRANSLATION_KEY ) . '</a>.', TRANSLATION_KEY ) . '</span>';
    $html .= '</div><!-- /#generate-private-policy-wrapper -->';

    // Options to display if the page already exists
    $html .= '<div id="has-privacy-policy-wrapper"' . ( '' == $privacy_policy ? ' class="hidden" ' : '' )  . '>';

    $policy_id = 'null-privacy-policy';
    if( null != $privacy_policy ) {
        $policy_id = $privacy_policy->ID;
    } // end if

    $html .= '<input type="submit" class="button button-delete" id="delete_privacy_policy" name="delete_privacy_policy" value="' . __( 'Delete', TRANSLATION_KEY ) . '" />';
    $html .= '&nbsp;';
    $html .= '<span>' . __( 'Warning, customizations will be lost. You can view or edit your policy ', TRANSLATION_KEY ) . '<a id="edit-privacy-policy" href="post.php?post=' . $policy_id . '&action=edit">' . __( 'here', TRANSLATION_KEY ) . '</a>.</span>';
    $html .= '<span class="hidden" id="privacy_policy_id">' . $policy_id . '</span>';
    $html .= '</div><!-- /#has-privacy-policy-wrapper -->';

    echo $html;

} // end privacy_policy_template_display

/**
 * Renders the option for generating the Comment Policy from within the WordPress Dashboard.
 *
 * @since	1.0
 * @version	1.1
 */
function comment_policy_template_display() {

    // First, detect if the privacy policy page exists
    $comment_policy = get_page_by_title( __( 'Comment Policy', TRANSLATION_KEY ) );

    // Options to display if the page doesn't already exist
    $html = '<div id="generate-comment-policy-wrapper"' . ( '' == $comment_policy ? ' ' : ' class="hidden" ' )  . '>';
    $html .= '<input type="submit" class="button-secondary" id="generate_comment_policy" name="generate_comment_policy" value="' . __( 'Generate', TRANSLATION_KEY ) . '" />';
    $html .= '<span id="comment-policy-nonce" class="hidden">' . wp_create_nonce( 'generate_comment_policy_nonce' ) . '</span>';
    $html .= '&nbsp;';
    $html .= '<span class="description">' . __( '<a href="http://docs.leantheme.co/admin-panel/publishing/" target="_blank">' . __( 'Learn more', TRANSLATION_KEY ) . '</a>.', TRANSLATION_KEY ) . '</span>';
    $html .= '</div><!-- /#generate-comment-policy-wrapper -->';

    // Options to display if the page already exists
    $html .= '<div id="has-comment-policy-wrapper"' . ( '' == $comment_policy ? ' class="hidden" ' : '' )  . '>';

    $policy_id = 'null-comment-policy';
    if( null != $comment_policy ) {
        $policy_id = $comment_policy->ID;
    } // end if

    $html .= '<input type="submit" class="button button-delete" id="delete_comment_policy" name="delete_comment_policy" value="' . __( 'Delete', TRANSLATION_KEY ) . '" />';
    $html .= '&nbsp;';
    $html .= '<span>' . __( 'Warning, customizations will be lost. You can view or edit your policy ', TRANSLATION_KEY ) . '<a id="edit-comment-policy" href="post.php?post=' . $policy_id . '&action=edit">' . __( 'here', TRANSLATION_KEY ) . '</a>.</span>';
    $html .= '<span class="hidden" id="comment_policy_id">' . $policy_id . '</span>';
    $html .= '</div><!-- /#has-comment-policy-wrapper -->';

    echo $html;

} // end comment_policy_template_display

/**
 * Callback function used in the Ajax request for generating the Privacy Policy.
 *
 * @since	1.0
 * @version	1.1
 */
function generate_privacy_policy_page( ) {

    if( wp_verify_nonce( $_REQUEST['nonce'], 'generate_privacy_policy_nonce' ) && isset( $_POST['generatePrivacyPolicy'] ) ) {

        $page_id = create_page( 'privacy-policy', __( 'Privacy Policy', TRANSLATION_KEY ) );
        if( $page_id > 0 ) {
            die( (string)$page_id );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end generate_privacy_policy_page
add_action( 'wp_ajax_generate_privacy_policy_page', 'generate_privacy_policy_page' );

/**
 * Callback function used in the Ajax request for deleting the Privacy Policy.
 *
 * @since	1.0
 * @version	1.1
 */
function delete_privacy_policy_page( ) {

    // We'll be using the same nonce for generating the policy.
    if( wp_verify_nonce( $_REQUEST['nonce'], 'generate_privacy_policy_nonce' ) && isset( $_POST['deletePrivacyPolicy'] ) && isset( $_POST['page_id'] ) ) {

        if( delete_page( $_POST['page_id'] ) ) {
            die( '0' );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end delete_privacy_policy_page
add_action( 'wp_ajax_delete_privacy_policy_page', 'delete_privacy_policy_page' );

/**
 * Callback function used in the Ajax request for generating the Comment Policy.
 *
 * @since	1.0
 * @version	1.1
 */
function generate_comment_policy_page( ) {

    if( wp_verify_nonce( $_REQUEST['nonce'], 'generate_comment_policy_nonce' ) && isset( $_POST['generateCommentPolicy'] ) ) {

        $page_id = create_page( 'comment-policy', __( 'Comment Policy', TRANSLATION_KEY ) );
        if( $page_id > 0 ) {
            die( (string)$page_id );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end generate_comment_policy_page
add_action( 'wp_ajax_generate_comment_policy_page', 'generate_comment_policy_page' );

/**
 * Callback function used in the Ajax request for deleting the Privacy Policy.
 *
 * @since	1.0
 * @version	1.1
 */
function delete_comment_policy_page( ) {

    // We'll be using the same nonce for generating the policy.
    if( wp_verify_nonce( $_REQUEST['nonce'], 'generate_comment_policy_nonce' ) && isset( $_POST['deleteCommentPolicy'] ) && isset( $_POST['page_id'] ) ) {

        if( delete_page( $_POST['page_id'] ) ) {
            die( '0' );
        } else {
            die( '1' );
        } // end if/else

    } else {
        die( '-1' );
    } // end if/else

} // end delete_comment_policy_page
add_action( 'wp_ajax_delete_comment_policy_page', 'delete_comment_policy_page' );

/**
 * Sanitization callback for the Publishing Options. Since each of the options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *
 * @param	array $input	The unsanitized collection of options.
 * @return	array The collection of sanitized values.
 * @since 	1.0
 * @version	1.1
 */
function theme_publishing_options_validate( $input ) {

    $output = array();

    foreach( $input as $key => $val ) {

        if( isset ( $input[ $key ] ) ) {
            $output[$key] = strip_tags( stripslashes( $input[ $key ] ) );
        } // end if

    } // end foreach

    return apply_filters( 'theme_publishing_options_validate', $output, $input, get_theme_default_publishing_options() );

} // end theme_publishing_options_validate

/* ----------------------------- *
 * 	Options Page
 * ----------------------------- */

/**
 * Renders the header for the theme options page.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_options_display() {
    ?>
    <div id="theme-options" class="wrap">
        <div id="theme-info">

            <h3 id="theme-title" class="fa fa-compress"> <?php _e( THEME_NAME, TRANSLATION_KEY ); ?> <span><?php _e( 'for publishers', TRANSLATION_KEY ); ?></span></h3>

            <div id="theme-desc">
                <p><?php _e( '' . THEME_NAME . ' is a sleek, exacting product designed for uncluttered and sophisticated presentation of your content on desktop and mobile devices.', TRANSLATION_KEY ); ?></p>
            </div>
        </div><!--/#theme-info -->

        <div id="theme-options-links">
            <ul>
                <li><a class="fa fa-wrench" href="<?php echo THEME_DOCUMENTATION_URL; ?>" target="_blank"> <?php _e( 'Documentation', TRANSLATION_KEY ); ?></a></li>
                <li><a class="fa fa-globe" href="<?php echo THEME_SUPPORT_URL; ?>" target="_blank"> <?php _e( 'Support', TRANSLATION_KEY ); ?></a></li>
                <li><a class="fa fa-heart" href="<?php echo THEME_BLOG_URL; ?>" target="_blank"> <?php _e( 'Blog', TRANSLATION_KEY ); ?></a></li>
            </ul>
        </div>

        <div class="clear"></div>

        <?php $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'theme_global_options'; ?>
        <h2 class="nav-tab-wrapper">
            <a class="nav-tab <?php echo $active_tab == 'theme_global_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=theme_global_options"><?php _e( 'Global', TRANSLATION_KEY ); ?></a>
            <a class="nav-tab <?php echo $active_tab == 'theme_presentation_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=theme_presentation_options"><?php _e( 'Presentation', TRANSLATION_KEY ); ?></a>
            <a class="nav-tab <?php echo $active_tab == 'theme_social_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=theme_social_options"><?php _e( 'Social', TRANSLATION_KEY ); ?></a>
            <a class="nav-tab <?php echo $active_tab == 'theme_publishing_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=theme_publishing_options"><?php _e( 'Publishing', TRANSLATION_KEY ); ?></a>
        </h2>

        <div id="message-container"><?php settings_errors(); ?></div>

        <form method="post" action="options.php">
            <?php

            if( 'theme_global_options' == $active_tab ) {

                settings_fields( 'theme_global_options' );
                do_settings_sections( 'theme_global_options' );

            } else if( 'theme_presentation_options' == $active_tab ) {

                settings_fields( 'theme_presentation_options' );
                do_settings_sections( 'theme_presentation_options' );

            } else if( 'theme_social_options' == $active_tab ) {

                settings_fields( 'theme_social_options' );
                do_settings_sections( 'theme_social_options' );

            } else {

                do_settings_sections( 'theme_publishing_options' );
                settings_fields( 'theme_publishing_options' );

            } // end if/else

            // Display the 'Save Changes' button
            submit_button();

            ?>
        </form>
    </div><!-- /.wrap -->
<?php
} // end theme_options_display