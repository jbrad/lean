<?php
/**
 * Theme features.
 *
 * @version	1.1
 * @since	1.0
 */

/**
 * Implements the Theme Customizer for installations that are on WordPress 3.4 or greater.
 *
 * @param	$wp_customize	The WordPress Theme Customizer
 * @version	1.1
 * @since	1.0
 */
function customize_register( $wp_customize ) {

    // Presentation Options
    $wp_customize->add_section( 'theme_presentation_options',
        array(
            'title'          => __( 'Presentation', TRANSLATION_KEY ),
            'priority'       => 150
        )
    );

    // Contrast
    $wp_customize->add_setting( 'theme_presentation_options[contrast]',
        array(
            'default'        => 'dark',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'theme_presentation_options[contrast]',
        array(
            'label'      => __( 'Contrast', TRANSLATION_KEY ),
            'section'    => 'theme_presentation_options',
            'settings'   => 'theme_presentation_options[contrast]',
            'type'       => 'select',
            'choices'    => array(
                'light' => __( 'Light', TRANSLATION_KEY ),
                'dark'  => __( 'Dark', TRANSLATION_KEY )
            ),
        )
    );

    // Logo
    $wp_customize->add_setting( 'theme_presentation_options[logo]',
        array(
            'default'        => '',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'theme_presentation_options[logo]',
            array(
                'label'		=>	__( 'Logo', TRANSLATION_KEY ),
                'section'	=>	'theme_presentation_options',
                'settings'  => 'theme_presentation_options[logo]'
            )
        )
    );

    // Layout
    $wp_customize->add_setting( 'theme_presentation_options[layout]',
        array(
            'default'        => 'right_sidebar_layout',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'theme_presentation_options[layout]',
        array(
            'label'      => __( 'Layout', 'themename' ),
            'section'    => 'theme_presentation_options',
            'settings'   => 'theme_presentation_options[layout]',
            'type'       => 'select',
            'choices'    => array(
                'left_sidebar_layout' 	=> __( 'Left Sidebar', TRANSLATION_KEY ),
                'right_sidebar_layout' 	=> __( 'Right Sidebar', TRANSLATION_KEY ),
                'full_width_layout'		=> __( 'No Sidebar / Full-Width', TRANSLATION_KEY )
            ),
        )
    );

    // Breadcrumbs
    $wp_customize->add_setting( 'theme_presentation_options[display_breadcrumbs]',
        array(
            'default'        => 'always',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'theme_presentation_options[display_breadcrumbs]',
        array(
            'label'      => __( 'Display Breadcrumbs', TRANSLATION_KEY ),
            'section'    => 'theme_presentation_options',
            'settings'   => 'theme_presentation_options[display_breadcrumbs]',
            'type'       => 'select',
            'choices'    => array(
                'always' 		=>	__( 'Always', TRANSLATION_KEY ),
                'never' 		=>  __( 'Never', TRANSLATION_KEY )
            )
        )
    );

    // Featured Images
    $wp_customize->add_setting( 'theme_presentation_options[display_featured_images]',
        array(
            'default'        => 'always',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'theme_presentation_options[display_featured_images]',
        array(
            'label'      => __( 'Display Featured Images', 'themename' ),
            'section'    => 'theme_presentation_options',
            'settings'   => 'theme_presentation_options[display_featured_images]',
            'type'       => 'select',
            'choices'    => array(
                'always' 		=>	__( 'Always', TRANSLATION_KEY ),
                'never' 		=>  __( 'Never', TRANSLATION_KEY ),
                'index'			=>	__( 'On index only', TRANSLATION_KEY ),
                'single-post'	=>	__( 'On single posts only', TRANSLATION_KEY )
            ),
        )
    );

    // Featured Images
    $wp_customize->add_setting( 'theme_presentation_options[display_footer_credits]',
        array(
            'default'        => 'always',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'theme_presentation_options[display_footer_credits]',
        array(
            'label'      => __( 'Display Footer Credits', 'themename' ),
            'section'    => 'theme_presentation_options',
            'settings'   => 'theme_presentation_options[display_footer_credits]',
            'type'       => 'select',
            'choices'    => array(
                'always' 		=>	__( 'Always', TRANSLATION_KEY ),
                'never' 		=>  __( 'Never', TRANSLATION_KEY ),
            ),
        )
    );

    // Publishing Options
    $wp_customize->add_section( 'theme_publishing_options',
        array(
            'title'          => __( 'Publishing', TRANSLATION_KEY ),
            'priority'       => 151
        )
    );

    // Author Box
    $wp_customize->add_setting( 'theme_publishing_options[display_author_box]',
        array(
            'default'        => 'always',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'theme_publishing_options[display_author_box]',
        array(
            'label'      => __( 'Display Author Box', TRANSLATION_KEY ),
            'section'    => 'theme_publishing_options',
            'settings'   => 'theme_publishing_options[display_author_box]',
            'type'       => 'select',
            'choices'    => array(
                'always' 		=>	__( 'Always', TRANSLATION_KEY ),
                'never' 		=>  __( 'Never', TRANSLATION_KEY )
            )
        )
    );

    // Basic WordPress functionality (header display, backgrounds, etc)
    if ( $wp_customize->is_preview() && ! is_admin() ) {
        add_action( 'wp_footer', 'customize_preview', 21);
    } // end if
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_attachment' )->transport = 'postMessage';

} // end customize_register
add_action( 'customize_register', 'customize_register' );

/**
 * Renders the JavaScript responsible for hooking into the Theme Customizer to tweak
 * the built-in theme settings.
 *
 * @version	1.1
 * @since	1.0
 */
function customize_preview() { ?>
    <script type="text/javascript">
        (function( $ ) {

            // We need to the hide the header widget area when previewing the theme *unless* there are only widgets
            // present. If widgets are present, it means they've customized it already; otherwise, we're
            // coming from another theme.
            if( $('#header-widget').children().length !== $('#header-widget').children('div[id*=theme]').length ) {
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
<?php  } // end customize_preview

/**
 * Defines a custom meta box for displaying the post full-width layout. Only renders
 * if the blog isn't using the full-width layout.
 *
 * @version	1.1
 * @since	1.0
 */
function add_full_width_single_post() {

    $options = get_option( 'theme_presentation_options' );
    if( 'full_width_layout' != $options['layout'] ) {

        add_meta_box(
            'post_level_layout',
            __( 'Post Layout', TRANSLATION_KEY ),
            'post_level_layout_display',
            'post',
            'side',
            'core'
        );

    } // end if

} // end add_full_width_single_post
add_action( 'add_meta_boxes', 'add_full_width_single_post' );

/**
 * Renders the display for the full-width post option.
 *
 * @param	object $post	The post on which the box should be rendered.
 * @version	1.1
 * @since	1.0
 */
function post_level_layout_display( $post ) {

    wp_nonce_field( plugin_basename( __FILE__ ), 'post_level_layout_nonce' );

    $html = '<input type="checkbox" id="seo_post_level_layout" name="seo_post_level_layout" value="1"' . checked( get_post_meta( $post->ID, 'seo_post_level_layout', true ), 1, false ) . ' />';

    $html .= '&nbsp;';

    $html .= '<label for="seo_post_level_layout">';
    $html .= __( 'Hide sidebar and display post at full width.', TRANSLATION_KEY );
    $html .= '</label>';

    echo $html;

} // end post_level_layout_display

/**
 * Saves the post data for the post layout to post defined by the incoming ID.
 *
 * @param	string $post_id	The ID of the post to which we're saving the post data.
 * @since	1.0
 * @version	1.1
 */
function save_post_layout_data( $post_id ) {

    if( isset( $_POST['post_level_layout_nonce'] ) && isset( $_POST['post_type'] ) ) {

        // Don't save if the user hasn't submitted the changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        } // end if

        // Verify that the input is coming from the proper form
        if( ! wp_verify_nonce( $_POST['post_level_layout_nonce'], plugin_basename( __FILE__ ) ) ) {
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
        if( isset( $_POST['seo_post_level_layout'] ) ) {
            $post_level_layout = $_POST['seo_post_level_layout'];
        } // end if

        // If the value exists, delete it first. I don't want to write extra rows into the table.
        if ( 0 == count( get_post_meta( $post_id, 'seo_post_level_layout' ) ) ) {
            delete_post_meta( $post_id, 'seo_post_level_layout' );
        } // end if

        // Update it for this post.
        update_post_meta( $post_id, 'seo_post_level_layout', $post_level_layout );

    } // end if

} // end save_post_layout_data
add_action( 'save_post', 'save_post_layout_data' );

// If the theme is running less than 3.6, then add the Link Post Format Meta Box
//if( 3.6 > is_wp36() ) {

/**
 * Adds the post meta box for the URL to be included in the Link Post Format.
 *
 * @version		1.1
 * @since		1.0
 * @deprecated	1.0
 */
function add_url_field_to_link_post_format() {

    add_meta_box(
        'link_format_url',
        __( 'Link URL', TRANSLATION_KEY ),
        'link_url_field_display',
        'post',
        'side',
        'high'
    );

} // end hudson_add_url_to_link_post_type
add_action( 'add_meta_boxes', 'add_url_field_to_link_post_format' );

/**
 * Renders the input field for the URL in the Link Post Format related to the
 * meta box defined in the add_url_field_to_link_post_format() function.
 *
 * @param	$post	The post on which this meta box is attached.
 * @version			1.1
 * @since			1.0
 * @deprecated		1.0
 */
function link_url_field_display( $post ) {

    wp_nonce_field( plugin_basename( __FILE__ ), 'link_url_field_nonce' );

    echo '<input type="text" id="link_url_field" name="link_url_field" value="' . get_post_meta( $post->ID, 'link_url_field', true ) . '" />';

} // end link_url_field_display

/**
 * Saves the specified URL for the post specified by the incoming post ID. This is
 * related to the link_url_field_display() function.
 *
 * @param	$post_id	The ID of the post that we're serializing
 * @version				1.1
 * @since				1.0
 * @deprecated			1.0
 */
function save_link_url_data( $post_id ) {

    if( isset( $_POST['link_url_field_nonce'] ) && isset( $_POST['post_type'] ) ) {

        // Don't save if the user hasn't submitted the changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        } // end if

        // Verify that the input is coming from the proper form
        if( ! wp_verify_nonce( $_POST['link_url_field_nonce'], plugin_basename( __FILE__ ) ) ) {
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
        if( isset( $_POST['link_url_field'] ) ) {
            $link_url = esc_url( $_POST['link_url_field'] );
        } // end if

        // If the value exists, delete it first. I don't want to write extra rows into the table.
        if ( 0 == count( get_post_meta( $post_id, 'link_url_field' ) ) ) {
            delete_post_meta( $post_id, 'link_url_field' );
        } // end if

        // Update it for this post.
        update_post_meta( $post_id, 'link_url_field', $link_url );

    } // end if

} // end save_post_layout_data
add_action( 'save_post', 'save_link_url_data' );

//} // end if

/**
 * Adds the theme's menu to the admin bar on the non-admin pages.
 *
 * @since	1.0
 * @version	1.1
 */
function add_admin_bar_option() {

    if( ! is_admin() ) {

        global $wp_admin_bar;

        $wp_admin_bar->add_node(
            array(
                'id'	=>	'theme_options',
                'title'	=>	__( THEME_NAME, TRANSLATION_KEY ),
                'href'	=>	site_url() . '/wp-admin/admin.php?page=theme_options'
            )
        );

        // Global
        $wp_admin_bar->add_node(
            array(
                'id'		=>	'theme_global_options',
                'title'		=>	__( 'Global', TRANSLATION_KEY ),
                'parent'	=>	'theme_options',
                'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=theme_global_options'
            )
        );

        // Layout Options
        $wp_admin_bar->add_node(
            array(
                'id'		=>	'theme_presentation_options',
                'title'		=>	__( 'Presentation', TRANSLATION_KEY ),
                'parent'	=>	'theme_options',
                'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=theme_presentation_options'
            )
        );

        // Social Options
        $wp_admin_bar->add_node(
            array(
                'id'		=>	'theme_social_options',
                'title'		=>	__( 'Social', TRANSLATION_KEY ),
                'parent'	=>	'theme_options',
                'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=theme_social_options'
            )
        );

        // Publishing Options
        $wp_admin_bar->add_node(
            array(
                'id'		=>	'theme_publishing_options',
                'title'		=>	__( 'Publishing', TRANSLATION_KEY ),
                'parent'	=>	'theme_options',
                'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=theme_publishing_options'
            )
        );

    } // end if

} // end add_admin_bar_option
add_action( 'admin_bar_menu', 'add_admin_bar_option', 40 );

/**
 * Adds a reminder message to the admin bar that the user has the site set in Offline Mode.
 *
 * @since	1.0
 * @version	1.1
 */
function add_site_mode_admin_bar_note() {

    // Remind the user if they are in offline mode
    if( is_offline() ) {
        global $wp_admin_bar;
        $wp_admin_bar->add_node(
            array(
                'id'	=>	'theme_site_mode',
                'title'	=>	__( 'The site is currently offline. To bring it back online, click here.', TRANSLATION_KEY ),
                'href'	=>	site_url() . '/wp-admin/themes.php?page=theme_options'
            )
        );
    } // end if

} // end add_maintenance_mode_admin_bar_note
add_action( 'admin_bar_menu' , 'add_site_mode_admin_bar_note', 90 );

/**
 * Detects whether or not any of the major SEO plugins have been installed. If so, the theme's built-in SEO features will be disabled in favor of the active plugin.
 *
 * Currently supports:
 *
 * - WordPress SEO
 * - All in One SEO
 * - Platinum SEO
 *
 * @since	1.0
 * @version	1.1
 */
function detect_wordpress_seo() {

    // If the SEO notification options don't exist, create them
    if( false == get_option( 'theme_seo_notification_options' ) ) {
        add_option( 'theme_seo_notification_options', false );
    } // end if

    if( 'true' != get_option( 'theme_seo_notification_options' ) ) {

        $html = '';

        // WordPress SEO
        if( defined( 'WPSEO_URL' ) ) {

            $html = '<div id="hide-seo-message-notification" class="error"><p>' . __( 'The activation of WordPress SEO has been detected and is now running in SEO compatibility mode. <a href="' . THEME_DOCUMENTATION_URL . '/seo" target="_blank">' . __( 'Learn more', TRANSLATION_KEY ) . '</a> or <a id="hide-seo-message" href="javascript:;">hide this message</a>.', TRANSLATION_KEY) . '</p><span id="hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'hide_seo_message_nonce' ) . '</span></div>';

            // All-in-One SEO
        } elseif( class_exists( 'All_in_One_SEO_Pack' ) ) {

            $html = '<div id="hide-seo-message-notification" class="error"><p>' . __( 'The activation of All-In-One SEO has been detected and is now running in SEO compatibility mode.  <a href="' . THEME_DOCUMENTATION_URL . '/seo" target="_blank">' . __( 'Learn more', TRANSLATION_KEY ) . '</a> or <a id="hide-seo-message" href="javascript:;">hide this message</a>.', TRANSLATION_KEY) . '</p><span id="hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'hide_seo_message_nonce' ) . '</span></div>';

            // Platinum SEO
        } elseif( class_exists( 'Platinum_SEO_Pack' ) ) {

            $html =  '<div id="hide-seo-message-notification" class="error"><p>' . __( 'The activation of Platinum SEO has been detected and is now running in SEO compatibility mode.  <a href="' . THEME_DOCUMENTATION_URL . '/seo" target="_blank">' . __( 'Learn more', TRANSLATION_KEY ) . '</a> or <a id="hide-seo-message" href="javascript:;">hide this message</a>.', TRANSLATION_KEY) . '</p><span id="hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'hide_seo_message_nonce' ) . '</span></div>';

        } // end if/ese

        // Return the notice
        echo $html;

    } // end if

    // Set the option to false if the plugin is deactivated
    if( 'true' == get_option( 'theme_seo_notification_options') && using_native_seo() ) {
        update_option( 'theme_seo_notification_options', 'false' );
    } // end if

} // end detect_wordpress_seo
add_action( 'admin_notices', 'detect_wordpress_seo' );

/**
 * Callback function used in the Ajax request for hiding the notification window of WordPress SEO.
 *
 * @since	1.0
 * @version	1.1
 */
function save_wordpress_seo_message_setting( ) {

    if( wp_verify_nonce( $_REQUEST['nonce'], 'hide_seo_message_nonce' ) && isset( $_POST['hideSeoNotification'] ) ) {

        delete_option( 'theme_seo_notification_options' );
        if( update_option( 'theme_seo_notification_options', $_POST['hideSeoNotification'] ) ) {
            die( '0' );
        } else {
            die ( '1' );
        } // end if/else
    } else {
        die( '-1' );
    } // end if

} // end save_wordpress_seo_message_setting
add_action( 'wp_ajax_save_wordpress_seo_message_setting', 'save_wordpress_seo_message_setting' );

if( ! function_exists('page_menu') ) {
    /**
     * Adds a custom class to the wp_page_menu when users don't set an active menu.
     *
     * This function can be overridden by child themes.
     *
     * @param	$ulclass		The classname for the menu
     * @return	The markup for the unordered list.
     * @since	1.0
     * @version	1.1
     */
    function page_menu( $ulclass ) {
        return preg_replace( '/<ul>/', '<ul class="nav nav-menu">', $ulclass, 1 );
    } // end default_menu
    add_filter( 'wp_page_menu', 'page_menu' );
} // end if

/**
 * Adds custom background support.
 *
 * This function can be overridden by child themes.
 *
 * @since	1.0
 * @version	1.1
 */
if( ! function_exists('add_theme_background') ) {
    function add_theme_background() {
        add_theme_support( 'custom-background' );
    } // end add_theme_background
    add_action( 'init', 'add_theme_background' );
} // end if

if( ! function_exists('add_theme_editor_style') ) {
    /**
     * Includes the post editor stylesheet.
     *
     * @since	1.0
     * @version	1.1
     */
    function add_theme_editor_style() {

        add_editor_style( 'css/editor-style.css' );

    } // end add_theme_editor_style
    add_action( 'init', 'add_theme_editor_style' );
} // end if

if( ! function_exists('add_theme_menus') ) {
    /**
     * Adds three menu areas: above the logo, below the logo, and in the footer.
     *
     * This function can be overridden by child themes.
     *
     * @since	1.0
     * @version	1.1
     */
    function add_theme_menus() {

        register_nav_menus(
            array(
                'menu_above_logo' 	=> __( 'Header Menu (Upper)', TRANSLATION_KEY ),
                'menu_below_logo' 	=> __( 'Header Menu (Lower)', TRANSLATION_KEY ),
                'footer_menu' 		=> __( 'Footer Menu', TRANSLATION_KEY )
            )
        );

    } // end add_theme_menu
    add_action( 'init', 'add_theme_menus' );
} // end if

if( ! function_exists('add_theme_sidebars') ) {
    /**
     * Adds four widgetized areas: the sidebar, the left footer, center footer, and right footer.
     *
     * This function can be overridden by child themes.
     *
     * @version	1.3
     * @since	1.0
     */
    function add_theme_sidebars() {

        // main
        register_sidebar(
            array(
                'name' 			=> __( 'Sidebar', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-0',
                'description'	=> __( 'The primary sidebar.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // header
        register_sidebar(
            array(
                'name' 			=> __( 'Header', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-1',
                'description'	=> __( 'This area is designed for a 468x60 advertisement, but other widgets can be used here as well.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // post advertisements
        register_sidebar(
            array(
                'name'			=>	__( 'Below Single Post', TRANSLATION_KEY),
                'id'			=>	'sidebar-2',
                'description'	=>	__( 'Shown after post content and before comments. Ideal for the 468x60 ad widget.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // footer left
        register_sidebar(
            array(
                'name' 			=> __( 'Footer Left', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-3',
                'description'	=> __( 'Shown in the first column of the footer.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // footer center
        register_sidebar(
            array(
                'name' 			=> __( 'Footer Center', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-4',
                'description'	=> __( 'Shown in the second column of the footer.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // footer right
        register_sidebar(
            array(
                'name' 			=> __( 'Footer Right', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-5',
                'description'	=> __( 'Shown in the third column of the footer.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // home left
        register_sidebar(
            array(
                'name' 			=> __( 'Marketing Left', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-6',
                'description'	=> __( 'Shown in the first column for the marketing widgets.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // home center
        register_sidebar(
            array(
                'name' 			=> __( 'Marketing Center', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-7',
                'description'	=> __( 'Shown in the second column for the marketing widgets.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // home right
        register_sidebar(
            array(
                'name' 			=> __( 'Marketing Right', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-8',
                'description'	=> __( 'Shown in the third column for the marketing widgets.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // offline widget
        register_sidebar(
            array(
                'name' 			=> __( 'Offline Mode', TRANSLATION_KEY ),
                'id' 			=> 'sidebar-9',
                'description'	=> __( 'Shown if the site is set to offline mode.', TRANSLATION_KEY ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

    } // end add_theme_sidebars
    add_action( 'widgets_init', 'add_theme_sidebars' );
} // end if

if( ! function_exists('add_theme_features') ) {
    /**
     * Adds support for Post Formats, Post Thumbnails, Activity Tabs widget
     * Custom Image Sizes for post formats.
     *
     * This function can be overridden by child themes.
     *
     * @since	1.0
     * @version	1.1
     */
    function add_theme_features() {

        // Feedlinks
        add_theme_support( 'automatic-feed-links' );

        add_theme_support(
            'post-formats',
            array(
                'status',
                'image',
                'link',
                'quote',
                'video',
                'aside',
                'gallery'
            )
        );

        // post thumbnail support
        add_theme_support( 'post-thumbnails' );

        // infinite scroll
        add_theme_support(
            'infinite-scroll',
            array(
                'container'			=>	'main',
                'type'				=>	'click',	// Because of supporting footer widgets
                'render'			=>	'infinite_scroll',
                'wrapper'			=>	false,
                'posts_per_page'	=>	false,
                'footer'			=>	false
            )
        );

        if( using_native_seo() ) {
            add_plugin( '/lib/seo/plugin.php' );
        } // end if

        add_plugin( '/lib/activity/plugin.php' );
        add_plugin( '/lib/google-custom-search/plugin.php' );
        add_plugin( '/lib/ad-300x250/plugin.php' );
        add_plugin( '/lib/ad-125x125/plugin.php' );
        add_plugin( '/lib/ad-billboard/plugin.php' );
        add_plugin( '/lib/personal-image/plugin.php' );
        add_plugin( '/lib/influence/plugin.php' );

    } // end add_theme_features
    add_action( 'after_setup_theme', 'add_theme_features' );
} // end if

/**
 * Provides the default loop used to add Infinite Scrolling capabilities.
 *
 * @since	1.0
 * @version	1.1
 */
function infinite_scroll() {

    while( have_posts() ) {
        the_post();
        get_template_part( 'loop', get_post_format() );
    } // end while
    ?>
    <script type="text/javascript">
        (function($) {
            $(function() {
                resizeVideos($);
            });
        }(jQuery));
    </script>
<?php
} // end infinite_scroll

/**
 * Sets the media embed width to 580 or 900 (based on the layout) which is optimized
 * for the theme's post size.
 *
 * This has to be done outside of a function for it to perform correctly for JetPack
 *
 * @since	1.0
 * @version	1.1
 */
$options = get_option( 'theme_presentation_options' );
if( 'full_width_layout' == $options['layout'] ) {

    if ( ! isset( $content_width ) ) {
        $content_width = 900;
    } // end if

} else {

    if ( ! isset( $content_width ) ) {
        $content_width = 610;
    } // end if

} // end if/else

if( ! function_exists('set_theme_colors') ) {
    /**
     * Sets the values for the default color scheme for use
     * in other plugins.
     *
     * This function can be overridden by child themes.
     *
     * @since	1.0
     * @version	1.1
     */
    function set_theme_colors() {

        $themecolors = array(
            'bg' 		=> 'efefef',
            'border' 	=> 'eeeeee',
            'text' 		=> '333333',
            'link' 		=> '4D8B97',
            'url' 		=> '4D8B97',
        );

    } // end set_theme_colors
    add_action( 'init', 'set_theme_colors' );
} // end if

/**
 * Determine which search form to display based on if the author has enabled
 * Google Custom Search Widget activated.
 *
 * @since	1.0
 * @version	1.1
 */
function theme_get_search_form() {

    // First, detect if the Google Custom Search widget is active
    if( google_custom_search_is_active() ) {

        // Read the author's Google Search Engine ID. If they have multiple instances,
        // then we need to read the most recent instance of the widget.
        $gcse = get_option( 'widget_google-custom-search' );
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

        // Otherwise, display the default search form
    } else {
        get_search_form();
    } // end if

} // end theme_get_google_search_form