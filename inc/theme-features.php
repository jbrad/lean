<?php
/**
 * Theme features.
 *
 * @since	1.0
 * @version	1.0
 */

/**
 * Implements the Theme Customizer for installations that are on WordPress 3.4 or greater.
 *
 * @param	$wp_customize	The WordPress Theme Customizer
 * @since	3.0
 * @version	3.2
 */
function lean_customize_register( $wp_customize ) {

    // Presentation Options
    $wp_customize->add_section( 'lean_theme_presentation_options',
        array(
            'title'          => __( 'Presentation', 'lean' ),
            'priority'       => 150
        )
    );

    // Contrast
    $wp_customize->add_setting( 'lean_theme_presentation_options[contrast]',
        array(
            'default'        => '',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'lean_theme_presentation_options[contrast]',
        array(
            'label'      => __( 'Contrast', 'lean' ),
            'section'    => 'lean_theme_presentation_options',
            'settings'   => 'lean_theme_presentation_options[contrast]',
            'type'       => 'select',
            'choices'    => array(
                'light' => __( 'Light', 'lean' ),
                'dark'  => __( 'Dark', 'lean' )
            ),
        )
    );

    // Logo
    $wp_customize->add_setting( 'lean_theme_presentation_options[logo]',
        array(
            'default'        => '',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'lean_theme_presentation_options[logo]',
            array(
                'label'		=>	__( 'Logo', 'lean' ),
                'section'	=>	'lean_theme_presentation_options',
                'settings'  => 'lean_theme_presentation_options[logo]'
            )
        )
    );

    // Layout
    $wp_customize->add_setting( 'lean_theme_presentation_options[layout]',
        array(
            'default'        => 'right_sidebar_layout',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'lean_theme_presentation_options[layout]',
        array(
            'label'      => __( 'Layout', 'themename' ),
            'section'    => 'lean_theme_presentation_options',
            'settings'   => 'lean_theme_presentation_options[layout]',
            'type'       => 'select',
            'choices'    => array(
                'left_sidebar_layout' 	=> __( 'Left Sidebar', 'lean' ),
                'right_sidebar_layout' 	=> __( 'Right Sidebar', 'lean' ),
                'full_width_layout'		=> __( 'No Sidebar / Full-Width', 'lean' )
            ),
        )
    );

    // Breadcrumbs
    $wp_customize->add_setting( 'lean_theme_presentation_options[display_breadcrumbs]',
        array(
            'default'        => 'always',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'lean_theme_presentation_options[display_breadcrumbs]',
        array(
            'label'      => __( 'Display Breadcrumbs', 'lean' ),
            'section'    => 'lean_theme_presentation_options',
            'settings'   => 'lean_theme_presentation_options[display_breadcrumbs]',
            'type'       => 'select',
            'choices'    => array(
                'always' 		=>	__( 'Always', 'lean' ),
                'never' 		=>  __( 'Never', 'lean' )
            )
        )
    );

    // Featured Images
    $wp_customize->add_setting( 'lean_theme_presentation_options[display_featured_images]',
        array(
            'default'        => 'always',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'lean_theme_presentation_options[display_featured_images]',
        array(
            'label'      => __( 'Display Featured Images', 'themename' ),
            'section'    => 'lean_theme_presentation_options',
            'settings'   => 'lean_theme_presentation_options[display_featured_images]',
            'type'       => 'select',
            'choices'    => array(
                'always' 		=>	__( 'Always', 'lean' ),
                'never' 		=>  __( 'Never', 'lean' ),
                'index'			=>	__( 'On index only', 'lean' ),
                'single-post'	=>	__( 'On single posts only', 'lean' )
            ),
        )
    );

    // Publishing Options
    $wp_customize->add_section( 'lean_theme_publishing_options',
        array(
            'title'          => __( 'Publishing', 'lean' ),
            'priority'       => 151
        )
    );

    // Author Box
    $wp_customize->add_setting( 'lean_theme_publishing_options[display_author_box]',
        array(
            'default'        => 'always',
            'type'           => 'option',
            'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control( 'lean_theme_publishing_options[display_author_box]',
        array(
            'label'      => __( 'Display Author Box', 'lean' ),
            'section'    => 'lean_theme_publishing_options',
            'settings'   => 'lean_theme_publishing_options[display_author_box]',
            'type'       => 'select',
            'choices'    => array(
                'always' 		=>	__( 'Always', 'lean' ),
                'never' 		=>  __( 'Never', 'lean' )
            )
        )
    );

    // Basic WordPress functionality (header display, backgrounds, etc)
    if ( $wp_customize->is_preview() && ! is_admin() ) {
        add_action( 'wp_footer', 'lean_customize_preview', 21);
    } // end if
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'background_attachment' )->transport = 'postMessage';

} // end lean_customize_register
add_action( 'customize_register', 'lean_customize_register' );

/**
 * Renders the JavaScript responsible for hooking into the Theme Customizer to tweak
 * the built-in theme settings.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_customize_preview() { ?>
    <script type="text/javascript">
        (function( $ ) {

            // We need to the hide the header widget area when previewing the theme *unless* there are only Lean widgets
            // present. If Lean widgets are present, it means they've customized it already; otherwise, we're
            // coming from another theme.
            if( $('#header-widget').children().length !== $('#header-widget').children('div[id*=lean]').length ) {
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
<?php  } // end lean_customize_preview

/**
 * Defines a custom meta box for displaying the post full-width layout. Only renders
 * if the blog isn't using the full-width layout.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_add_full_width_single_post() {

    $options = get_option( 'lean_theme_presentation_options' );
    if( 'full_width_layout' != $options['layout'] ) {

        add_meta_box(
            'post_level_layout',
            __( 'Lean Layout', 'lean' ),
            'lean_post_level_layout_display',
            'post',
            'side',
            'core'
        );

    } // end if

} // end lean_add_full_width_single_post
add_action( 'add_meta_boxes', 'lean_add_full_width_single_post' );

/**
 * Renders the display for the full-width post option.
 *
 * @param	object $post	The post on which the box should be rendered.
 * @since	3.0
 * @version	3.2
 */
function lean_post_level_layout_display( $post ) {

    wp_nonce_field( plugin_basename( __FILE__ ), 'lean_post_level_layout_nonce' );

    $html = '<input type="checkbox" id="lean_seo_post_level_layout" name="lean_seo_post_level_layout" value="1"' . checked( get_post_meta( $post->ID, 'lean_seo_post_level_layout', true ), 1, false ) . ' />';

    $html .= '&nbsp;';

    $html .= '<label for="lean_seo_post_level_layout">';
    $html .= __( 'Hide sidebar and display post at full width.', 'lean' );
    $html .= '</label>';

    echo $html;

} // end lean_post_level_layout_display

/**
 * Saves the post data for the post layout to post defined by the incoming ID.
 *
 * @param	string $post_id	The ID of the post to which we're saving the post data.
 * @since	3.0
 * @version	3.2
 */
function lean_save_post_layout_data( $post_id ) {

    if( isset( $_POST['lean_post_level_layout_nonce'] ) && isset( $_POST['post_type'] ) ) {

        // Don't save if the user hasn't submitted the changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        } // end if

        // Verify that the input is coming from the proper form
        if( ! wp_verify_nonce( $_POST['lean_post_level_layout_nonce'], plugin_basename( __FILE__ ) ) ) {
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
        if( isset( $_POST['lean_seo_post_level_layout'] ) ) {
            $post_level_layout = $_POST['lean_seo_post_level_layout'];
        } // end if

        // If the value exists, delete it first. I don't want to write extra rows into the table.
        if ( 0 == count( get_post_meta( $post_id, 'lean_seo_post_level_layout' ) ) ) {
            delete_post_meta( $post_id, 'lean_seo_post_level_layout' );
        } // end if

        // Update it for this post.
        update_post_meta( $post_id, 'lean_seo_post_level_layout', $post_level_layout );

    } // end if

} // end lean_save_post_layout_data
add_action( 'save_post', 'lean_save_post_layout_data' );

// If Lean is running less than 3.6, then add the Link Post Format Meta Box
//if( 3.6 > lean_is_wp36() ) {

/**
 * Adds the post meta box for the URL to be included in the Link Post Format.
 *
 * @since		3.1
 * @version		3.2
 * @deprecated	3.5.1
 */
function lean_add_url_field_to_link_post_format() {

    add_meta_box(
        'link_format_url',
        __( 'Link URL', 'lean' ),
        'lean_link_url_field_display',
        'post',
        'side',
        'high'
    );

} // end hudson_add_url_to_link_post_type
add_action( 'add_meta_boxes', 'lean_add_url_field_to_link_post_format' );

/**
 * Renders the input field for the URL in the Link Post Format related to the
 * meta box defined in the lean_add_url_field_to_link_post_format() function.
 *
 * @param	$post	The post on which this meta box is attached.
 * @since			3.1
 * @version			3.2
 * @deprecated		3.5.1
 */
function lean_link_url_field_display( $post ) {

    wp_nonce_field( plugin_basename( __FILE__ ), 'lean_link_url_field_nonce' );

    echo '<input type="text" id="lean_link_url_field" name="lean_link_url_field" value="' . get_post_meta( $post->ID, 'lean_link_url_field', true ) . '" />';

} // end lean_link_url_field_display

/**
 * Saves the specified URL for the post specified by the incoming post ID. This is
 * related to the lean_link_url_field_display() function.
 *
 * @param	$post_id	The ID of the post that we're serializing
 * @since				3.1
 * @version				3.2
 * @deprecated			3.5.1
 */
function lean_save_link_url_data( $post_id ) {

    if( isset( $_POST['lean_link_url_field_nonce'] ) && isset( $_POST['post_type'] ) ) {

        // Don't save if the user hasn't submitted the changes
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        } // end if

        // Verify that the input is coming from the proper form
        if( ! wp_verify_nonce( $_POST['lean_link_url_field_nonce'], plugin_basename( __FILE__ ) ) ) {
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
        if( isset( $_POST['lean_link_url_field'] ) ) {
            $link_url = esc_url( $_POST['lean_link_url_field'] );
        } // end if

        // If the value exists, delete it first. I don't want to write extra rows into the table.
        if ( 0 == count( get_post_meta( $post_id, 'lean_link_url_field' ) ) ) {
            delete_post_meta( $post_id, 'lean_link_url_field' );
        } // end if

        // Update it for this post.
        update_post_meta( $post_id, 'lean_link_url_field', $link_url );

    } // end if

} // end lean_save_post_layout_data
add_action( 'save_post', 'lean_save_link_url_data' );

//} // end if

/**
 * Adds the 'Lean' menu to the admin bar on the non-admin pages.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_add_admin_bar_option() {

    if( ! is_admin() ) {

        global $wp_admin_bar;

        $wp_admin_bar->add_node(
            array(
                'id'	=>	'lean_options',
                'title'	=>	__( 'Lean', 'lean' ),
                'href'	=>	site_url() . '/wp-admin/admin.php?page=theme_options'
            )
        );

        // Global
        $wp_admin_bar->add_node(
            array(
                'id'		=>	'lean_theme_global_options',
                'title'		=>	__( 'Global', 'lean' ),
                'parent'	=>	'lean_options',
                'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=lean_theme_global_options'
            )
        );

        // Layout Options
        $wp_admin_bar->add_node(
            array(
                'id'		=>	'lean_theme_presentation_options',
                'title'		=>	__( 'Presentation', 'lean' ),
                'parent'	=>	'lean_options',
                'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=lean_theme_presentation_options'
            )
        );

        // Social Options
        $wp_admin_bar->add_node(
            array(
                'id'		=>	'lean_theme_social_options',
                'title'		=>	__( 'Social', 'lean' ),
                'parent'	=>	'lean_options',
                'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=lean_theme_social_options'
            )
        );

        // Publishing Options
        $wp_admin_bar->add_node(
            array(
                'id'		=>	'lean_theme_publishing_options',
                'title'		=>	__( 'Publishing', 'lean' ),
                'parent'	=>	'lean_options',
                'href'		=>	site_url() . '/wp-admin/admin.php?page=theme_options&tab=lean_theme_publishing_options'
            )
        );

    } // end if

} // end lean_add_admin_bar_option
add_action( 'admin_bar_menu', 'lean_add_admin_bar_option', 40 );

/**
 * Adds a reminder message to the admin bar that the user has the site set in Offline Mode.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_add_site_mode_admin_bar_note() {

    // Remind the user if they are in offline mode
    if( lean_is_offline() ) {
        global $wp_admin_bar;
        $wp_admin_bar->add_node(
            array(
                'id'	=>	'lean_theme_site_mode',
                'title'	=>	__( 'The site is currently offline. To bring it back online, click here.', 'lean' ),
                'href'	=>	site_url() . '/wp-admin/themes.php?page=theme_options'
            )
        );
    } // end if

} // end lean_add_maintenance_mode_admin_bar_note
add_action( 'admin_bar_menu' , 'lean_add_site_mode_admin_bar_note', 90 );

/**
 * Detects whether or not any of the major SEO plugins have been installed. If so, Lean's built-in SEO features will be disabled in favor of the active plugin.
 *
 * Currently, Lean supports:
 *
 * - WordPress SEO
 * - All in One SEO
 * - Platinum SEO
 *
 * @since	3.0
 * @version	3.2
 */
function lean_detect_wordpress_seo() {

    // If the SEO notification options don't exist, create them
    if( false == get_option( 'lean_theme_seo_notification_options' ) ) {
        add_option( 'lean_theme_seo_notification_options', false );
    } // end if

    if( 'true' != get_option( 'lean_theme_seo_notification_options' ) ) {

        $html = '';

        // WordPress SEO
        if( defined( 'WPSEO_URL' ) ) {

            $html = '<div id="lean-hide-seo-message-notification" class="error"><p>' . __( 'Lean has detected the activation of WordPress SEO and is now running in SEO compatibility mode. <a href="http://docs.8bit.io/lean/seo" target="_blank">' . __( 'Learn more', 'lean' ) . '</a> or <a id="lean-hide-seo-message" href="javascript:;">hide this message</a>.', 'lean') . '</p><span id="lean-hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'lean_hide_seo_message_nonce' ) . '</span></div>';

            // All-in-One SEO
        } elseif( class_exists( 'All_in_One_SEO_Pack' ) ) {

            $html = '<div id="lean-hide-seo-message-notification" class="error"><p>' . __( 'Lean has detected the activation of All-In-One SEO and is now running in SEO compatibility mode.  <a href="http://docs.8bit.io/lean/seo" target="_blank">' . __( 'Learn more', 'lean' ) . '</a> or <a id="lean-hide-seo-message" href="javascript:;">hide this message</a>.', 'lean') . '</p><span id="lean-hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'lean_hide_seo_message_nonce' ) . '</span></div>';

            // Platinum SEO
        } elseif( class_exists( 'Platinum_SEO_Pack' ) ) {

            $html =  '<div id="lean-hide-seo-message-notification" class="error"><p>' . __( 'Lean has detected the activation of Platinum SEO and is now running in SEO compatibility mode.  <a href="http://docs.8bit.io/lean/seo" target="_blank">' . __( 'Learn more', 'lean' ) . '</a> or <a id="lean-hide-seo-message" href="javascript:;">hide this message</a>.', 'lean') . '</p><span id="lean-hide-seo-message-nonce" class="hidden">' . wp_create_nonce( 'lean_hide_seo_message_nonce' ) . '</span></div>';

        } // end if/ese

        // Return the notice
        echo $html;

    } // end if

    // Set the option to false if the plugin is deactivated
    if( 'true' == get_option( 'lean_theme_seo_notification_options') && using_native_seo() ) {
        update_option( 'lean_theme_seo_notification_options', 'false' );
    } // end if

} // end lean_detect_wordpress_seo
add_action( 'admin_notices', 'lean_detect_wordpress_seo' );

/**
 * Callback function used in the Ajax request for hiding the notification window of WordPress SEO.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_save_wordpress_seo_message_setting( ) {

    if( wp_verify_nonce( $_REQUEST['nonce'], 'lean_hide_seo_message_nonce' ) && isset( $_POST['hideSeoNotification'] ) ) {

        delete_option( 'lean_theme_seo_notification_options' );
        if( update_option( 'lean_theme_seo_notification_options', $_POST['hideSeoNotification'] ) ) {
            die( '0' );
        } else {
            die ( '1' );
        } // end if/else
    } else {
        die( '-1' );
    } // end if

} // end lean_save_wordpress_seo_message_setting
add_action( 'wp_ajax_lean_save_wordpress_seo_message_setting', 'lean_save_wordpress_seo_message_setting' );

if( ! function_exists('lean_page_menu') ) {
    /**
     * Adds a custom class to the wp_page_menu when users don't set an active menu.
     *
     * This function can be overridden by child themes.
     *
     * @param	$ulclass		The classname for the menu
     * @return	The markup for the unordered list.
     * @since	3.0
     * @version	3.2
     */
    function lean_page_menu( $ulclass ) {
        return preg_replace( '/<ul>/', '<ul class="nav nav-menu">', $ulclass, 1 );
    } // end lean_default_menu
    add_filter( 'wp_page_menu', 'lean_page_menu' );
} // end if

/**
 * Adds custom background support.
 *
 * This function can be overridden by child themes.
 *
 * @since	3.0
 * @version	3.2
 */
if( ! function_exists('lean_add_theme_background') ) {
    function lean_add_theme_background() {
        add_theme_support( 'custom-background' );
    } // end lean_add_theme_background
    add_action( 'init', 'lean_add_theme_background' );
} // end if

if( ! function_exists('lean_add_theme_editor_style') ) {
    /**
     * Includes the post editor stylesheet.
     *
     * @since	3.0
     * @version	3.2
     */
    function lean_add_theme_editor_style() {

        add_editor_style( 'css/editor-style.css' );

    } // end lean_add_theme_editor_style
    add_action( 'init', 'lean_add_theme_editor_style' );
} // end if

if( ! function_exists('lean_add_theme_menus') ) {
    /**
     * Adds three menu areas: above the logo, below the logo, and in the footer.
     *
     * This function can be overridden by child themes.
     *
     * @since	3.0
     * @version	3.2
     */
    function lean_add_theme_menus() {

        register_nav_menus(
            array(
                'menu_above_logo' 	=> __( 'Header Menu (Upper)', 'lean' ),
                'menu_below_logo' 	=> __( 'Header Menu (Lower)', 'lean' ),
                'footer_menu' 		=> __( 'Footer Menu', 'lean' )
            )
        );

    } // end add_theme_menu
    add_action( 'init', 'lean_add_theme_menus' );
} // end if

if( ! function_exists('lean_add_theme_sidebars') ) {
    /**
     * Adds four widgetized areas: the sidebar, the left footer, center footer, and right footer.
     *
     * This function can be overridden by child themes.
     *
     * @since	3.0
     * @version	3.2
     */
    function lean_add_theme_sidebars() {

        // main
        register_sidebar(
            array(
                'name' 			=> __( 'Sidebar', 'lean' ),
                'id' 			=> 'sidebar-0',
                'description'	=> __( 'The primary sidebar.', 'lean' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // header
        register_sidebar(
            array(
                'name' 			=> __( 'Header', 'lean' ),
                'id' 			=> 'sidebar-1',
                'description'	=> __( 'This area is designed for a 468x60 advertisement, but other widgets can be used here as well.', 'lean' ),
                'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // post advertisements
        register_sidebar(
            array(
                'name'			=>	__( 'Below Single Post', 'lean'),
                'id'			=>	'sidebar-2',
                'description'	=>	__( 'Shown after post content and before comments. Ideal for the 468x60 ad widget.', 'lean' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // footer left
        register_sidebar(
            array(
                'name' 			=> __( 'Footer Left', 'lean' ),
                'id' 			=> 'sidebar-3',
                'description'	=> __( 'Shown in the first column of the footer.', 'lean' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // footer center
        register_sidebar(
            array(
                'name' 			=> __( 'Footer Center', 'lean' ),
                'id' 			=> 'sidebar-4',
                'description'	=> __( 'Shown in the second column of the footer.', 'lean' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

        // footer right
        register_sidebar(
            array(
                'name' 			=> __( 'Footer Right', 'lean' ),
                'id' 			=> 'sidebar-5',
                'description'	=> __( 'Shown in the third column of the footer.', 'lean' ),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<h3 class="widget-title">',
                'after_title'   => '</h3>'
            )
        );

    } // end add_theme_sidebars
    add_action( 'widgets_init', 'lean_add_theme_sidebars' );
} // end if

if( ! function_exists('lean_add_theme_features') ) {
    /**
     * Adds support for Post Formats, Post Thumbnails, Activity Tabs widget
     * Custom Image Sizes for post formats.
     *
     * This function can be overridden by child themes.
     *
     * @since	3.0
     * @version	3.2
     */
    function lean_add_theme_features() {

        // Feedlinks
        add_theme_support( 'automatic-feed-links' );

        // WordPress 3.6 Post Format Support
        if( 3.6 >= lean_is_wp36() ) {

            add_theme_support(
                'post-formats',
                array(
                    'status',
                    'chat',
                    'image',
                    'link',
                    'quote',
                    'video',
                    'aside',
                    'gallery',
                    'audio'
                )
            );


        } else {

            add_theme_support(
                'post-formats',
                array(
                    'status',
                    'image',
                    'link',
                    'quote',
                    'video',
                    'aside'
                )
            );

        } // end if

        // post thumbnail support
        add_theme_support( 'post-thumbnails' );

        // infinite scroll
        add_theme_support(
            'infinite-scroll',
            array(
                'container'			=>	'main',
                'type'				=>	'click',	// Because Lean supports footer widgets
                'render'			=>	'lean_infinite_scroll',
                'wrapper'			=>	false,
                'posts_per_page'	=>	false,
                'footer'			=>	false
            )
        );

        if( using_native_seo() ) {
            lean_add_plugin( '/lib/seo/plugin.php' );
        } // end if

        lean_add_plugin( '/lib/activity/plugin.php' );
        lean_add_plugin( '/lib/google-custom-search/plugin.php' );
        lean_add_plugin( '/lib/lean-ad-300x250/plugin.php' );
        lean_add_plugin( '/lib/lean-ad-125x125/plugin.php' );
        lean_add_plugin( '/lib/lean-ad-billboard/plugin.php' );
        lean_add_plugin( '/lib/personal-image/plugin.php' );
        lean_add_plugin( '/lib/influence/plugin.php' );

    } // end add_theme_features
    add_action( 'after_setup_theme', 'lean_add_theme_features' );
} // end if

/**
 * Provides the default loop used to add Infinite Scrolling capabilities
 * to Lean.
 *
 * @since	3.2
 * @version	3.2
 */
function lean_infinite_scroll() {

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
} // end lean_infinite_scroll

/**
 * Sets the media embed width to 580 or 900 (based on the layout) which is optimized
 * for the theme's post size.
 *
 * This has to be done outside of a function for it to perform correctly for JetPack
 *
 * @since	3.0
 * @version	3.2
 */
$options = get_option( 'lean_theme_presentation_options' );
if( 'full_width_layout' == $options['layout'] ) {

    if ( ! isset( $content_width ) ) {
        $content_width = 900;
    } // end if

} else {

    if ( ! isset( $content_width ) ) {
        $content_width = 610;
    } // end if

} // end if/else

if( ! function_exists('lean_set_theme_colors') ) {
    /**
     * Sets the values for the default color scheme of Lean for use
     * in other plugins.
     *
     * This function can be overridden by child themes.
     *
     * @since	3.0
     * @version	3.2
     */
    function lean_set_theme_colors() {

        $themecolors = array(
            'bg' 		=> 'efefef',
            'border' 	=> 'eeeeee',
            'text' 		=> '333333',
            'link' 		=> '4D8B97',
            'url' 		=> '4D8B97',
        );

    } // end lean_set_theme_colors
    add_action( 'init', 'lean_set_theme_colors' );
} // end if

/**
 * Determine which search form to display based on if the author has enabled
 * Google Custom Search Widget activated.
 *
 * @since	3.0
 * @version	3.2
 */
function lean_get_search_form() {

    // First, detect if the Google Custom Search widget is active
    if( lean_google_custom_search_is_active() ) {

        // Read the author's Google Search Engine ID. If they have multiple instances,
        // then we need to read the most recent instance of the widget.
        $gcse = get_option( 'widget_lean-google-custom-search' );
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

} // end lean_get_google_search_form