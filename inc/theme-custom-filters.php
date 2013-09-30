<?php
/**
 * Custom Filters.
 *
 * @since	1.0
 * @version	1.0
 */


/**
 * This function is fired if the current version of Lean is not the latest version. If it's not, then the user will be prompted to reset their settings.
 * Once reset, all options will be reset to their default values.
 *
 * TODO review this function for 3.2
 *
 * @since	3.0
 * @version	3.2
 */
function activate_theme() {

    // If we're not using the most recent version of Lean...
    if( ! is_current_version() ) {

        // .. and the user has opted to reset the otpions
        if( array_key_exists( 'lean_theme_reset_options', $_GET ) && 'true' == $_GET['lean_theme_reset_options'] ) {

            // Remove the Preview settings. TODO remove this in 3.2.
            delete_option( 'lean_theme_general_options' );
            delete_option( 'lean_theme_social_options' );
            delete_option( 'lean_theme_layout_options' );

            // Set defaults for Lean
            get_theme_default_global_options();
            get_theme_default_presentation_options();
            get_theme_default_social_options();
            get_theme_default_publishing_options();

            // Otherwise, we have some other things to do...
        } else {

            // Set the default gravatar only if this is the first install
            if( LEAN_THEME_VERSION != get_option( 'lean_theme_version' ) ) {

                update_option( 'lean_theme_version', LEAN_THEME_VERSION );
                update_option( 'avatar_default', 'retro' );

            } // end if

        } // end if/else

    } // end if/else

    // Reset the icons
    find_new_social_icons();

} // end activate_theme
add_action( 'admin_notices', 'activate_theme' );

// rel="generator" is an invalid HTML5 attribute
remove_action( 'wp_head', 'wp_generator' );

/**
 * Adds fields for Twitter, Facebook, and Google+ to the User Profile page so that users can populate this information and have it render in the author box.
 *
 * @param	array $user_contactmethods	The array of contact fields for the user's profile.
 * @return	array The updated array of contact methods.
 * @since	3.0
 * @version	3.2
 */
function add_user_profile_fields( $user_contactmethods ) {

    $user_contactmethods['twitter'] = __( '<span class="user-profile" id="user-profile-twitter">Twitter URL</span>', 'lean' );
    $user_contactmethods['facebook'] = __( '<span class="user-profile" id="user-profile-facebook">Facebook URL</span>', 'lean' );

    if( using_native_seo() ) {
        $user_contactmethods['google_plus'] = __( '<span class="user-profile" id="user-profile-google-plus">Google+ URL</span>', 'lean' );
    } // end if

    return $user_contactmethods;

} // end add_user_profile_fields
add_filter( 'user_contactmethods', 'add_user_profile_fields' );

/**
 * If running in native SEO mode and if the current page has a meta description, renders the description to the browser.
 *
 * @version 3.0
 * @since	3.0
 */
function meta_description() {

    // If we're using Lean's native SEO, let's do the following...
    if( using_native_seo() ) {

        // If we're on the homepage, we're going to use the site's description
        if( is_home() ) {
            echo '<meta name="description" content="' . get_bloginfo( 'description' ) . '" />';
        } // end if

        // For single pages, we're setting the meta description to what the user has provided (or nothing, if it's empty
        if ( ( is_single() || is_page() ) && '' != get_post_meta( get_the_ID(), 'seo_post_meta_description', true ) ) {
            echo '<meta name="description" content="' . get_post_meta( get_the_ID(), 'seo_post_meta_description', true ) . '" />';
        } // end if/else

        // And if we're on the categories or any other archives, we'll be using the description if it has been provided
        if( is_archive() && '' != trim( category_description() ) ) {
            echo '<meta name="description" content="' . trim( str_replace( '</p>', '', str_replace( '<p>', '', category_description() ) ) ) . '" />';
        } // end if

    } // end if

} // end meta_description
add_action( 'wp_head', 'meta_description' );

/**
 * Removes the "category" relationship attribute from category anchors.
 * These are invalid HTML5 attributes.
 *
 * @param   string $str   The default set of attributes.
 * @return  string The stripped relationship tag.
 * @version 3.0
 * @since	3.0
 */
function remove_category_anchor_rel( $str ) {

    if( strpos( $str, 'rel="category"' ) ) {
        $str = trim( str_replace( 'rel="category"', "", $str ) );
    } elseif( strpos( $str, 'rel="category tag"' ) ) {
        $str = trim( str_replace( 'rel="category tag"', "", $str ) );
    } // end if/else

    return $str;

} // end remove_category_anchor_rel
add_filter( 'the_category', 'remove_category_anchor_rel' );

/**
 * Removes the "attachment" relationship attribute from anchors.
 * These are invalid HTML5 attributes.
 *
 * @param   string $str    The default set of attributes.
 * @return	string The stripped relationship tag.
 * @version 3.0
 * @since	3.0
 */
function remove_anchor_attachment_rel( $str ) {
    return preg_replace( '/(rel="attachment)[a-zA-Z0-9\s\-]*\"/', trim( '' ), trim( $str ) );
} // end remove_anchor_attachment_rel
add_filter( 'the_content', 'remove_anchor_attachment_rel' );

/**
 * Adds a "previous" relationship attribute to the 'Next' pagination option.
 *
 * @param	string $attrs  The current set of attributes of the anchor
 * @return  string The pagination link with the additional attribute.
 * @version 3.0
 * @since	3.0
 */
function add_rel_to_next_pagination( $attrs ) {
    $attrs .= 'rel="previous"';
    return $attrs;
} // end add_rel_to_pagination
add_filter( 'next_posts_link_attributes', 'add_rel_to_next_pagination' );

/**
 * Adds a "next" relationship attribute to the 'Previous' pagination option.
 *
 * @param  string $attrs  The current set of attributes of the anchor
 * @return string The pagination link with the additional attribute.
 * @version 3.0
 * @since	3.0
 */
function add_rel_to_previous_pagination( $attrs ) {
    $attrs .= 'rel="next"';
    return $attrs;
} // end add_rel_to_pagination
add_filter( 'previous_posts_link_attributes', 'add_rel_to_previous_pagination' );

/**
 * Provides a default alt tag for the image based on the title, if no
 * alt tag is provided.
 *
 * @param   string $html   The markup for the image
 * @param   string $id     The ID of the image
 * @param   string $alt    The alternative text of the image
 * @param   string $title  The title of the image (autogenerated by WordPress or editing by users)
 * @return  string The markup with an alt tag.
 * @version 3.0
 * @since	3.0
 */
function apply_image_alt_in_editor( $html, $id, $alt, $title ) {

    if( strlen( $alt ) == 0 ) {
        $html = str_replace( 'alt=""', 'alt="' . $title . '"', $html );
    } // end if

    return $html;

} // end apply_image_alt_in_editor
add_filter( 'get_image_tag', 'apply_image_alt_in_editor', 10, 4 );

if( ! function_exists('process_link_post_format_content') ) {

    /**
     * Removes any paragraph tags that are wrapping anchors.
     *
     * @param      string $content    The post content
     * @return     string The anchor without paragraph tags.
     * @version    3.0
     * @since	   3.0
     * @deprecated 3.3
     */
    function process_link_post_format_content( $content ) {

        // If this is an link post type, remove the paragraph wrapper from it
        if( 'link' == get_post_format( get_the_ID() ) ) {
            $content = preg_replace( '/<p>\s*(<a .*>)?\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
        } // end if

        return $content;

    } // process_link_post_format_content
    add_filter( 'the_content', 'process_link_post_format_content' );
} // end if

if( ! function_exists('process_link_post_format_title') /*&& 3.6 > is_wp36()*/ ) {

    /**
     * Removes any paragraph tags that are wrapping images, anchors around images,
     * or paragraphs around iframes or objects.
     *
     * @param		string $title		The the of the post
     * @param		string $id			The ID of the current post
     * @return		string The title based on the status of the post and the link
     * @version 	3.0
     * @since		3.0
     * @deprecated  3.3
     */
    function process_link_post_format_title( $title, $id ) {

        if( 'link' == get_post_format( $id ) ) {

            // If the title has been provided, we won't do anything; otherwise, we use the content.
            if( strlen( $title ) == 0 ) {

                $title = get_post_format_attribute( 'title' );
                $href = get_post_format_attribute( 'href' );
                $target = get_post_format_attribute( 'target' );

                global $post;
                $content = strip_tags( $post->post_content );

                // Now set the title
                if( strlen( $title ) == 0 ) {
                    $title = $content;
                } // end if

            } // end if

        } // end if

        return $title;

    } // end process_link_post_format_title
    add_filter( 'the_title', 'process_link_post_format_title', 10, 2 );

} // end if

if( ! function_exists('remove_paragraph_on_media') ) {

    /**
     * Removes any paragraph tags that are wrapping images, anchors around images,
     * or paragraphs around iframes or objects.
     *
     * @param	string $content	The post content
     * @return	string The [optional] anchor and image.
     * @version 3.0
     * @since	3.0
     */
    function remove_paragraph_on_media( $content ) {

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

    } // end remove_paragraph_on_media
    add_filter( 'the_content', 'remove_paragraph_on_media' );

} // end if

if( ! function_exists('wrap_embeds') ) {

    /**
     * Wraps the video post format with a container in order to improve styling.
     *
     * @param	string $html	The content of the video post format
     * @param	string $url	The url of the post
     * @param	array $args	Additional arguments passed in by WordPress core
     * @return	string The post content wrapped in a container.
     * @version 3.0
     * @since	3.0
     */
    function wrap_embeds( $html, $url, $args ) {

        if( 'video' == get_post_format( get_the_ID() ) ) {
            $html = '<div class="video-container">' . $html . '</div>';
        } // end if

        return $html;

    } // end wrap_embebds
    add_filter( 'embed_oembed_html', 'wrap_embeds', 10, 3 ) ;

} // end if

if( ! function_exists('search_form') ) {

    /**
     * Renders a simplified version of the search form.
     *
     * @return	string The search form.
     * @version 3.0
     * @since	3.0
     */
    function search_form() {

        // Get the default text for the search form
        $query = strlen( get_search_query() ) == 0 ? '' : get_search_query();

        // Render the form
        $form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">';
        $form .= '<input placeholder="' . __( 'Search...', 'lean' ) . '" type="text" value="' . $query . '" name="s" id="s" class="form-control"/>';
        $form .= '</form>';

        return $form;

    } // end search_form
    add_filter( 'get_search_form', 'search_form' );

} // end if

/**
 * Formats the link post format properly for the RSS feed.
 *
 * @param		string $content	The post content
 * @return		string The properly content formatted for RSS
 * @version 	3.0
 * @since		3.0
 * @deprecated 	3.3
 */
if( ! function_exists('post_format_rss') /*&& 3.6 < is_wp36()*/ ) {

    function post_format_rss( $content ) {

        // If it's a link post format, make sure the link and title are properly rendered
        if( 'link' == get_post_format( get_the_ID() ) ) {

            // Get the post title and the post content
            global $post;
            $post_content = $post->post_content;
            $post_title = $post->post_title;

            // If there's no link meta data, then we'll handle this the 3.0 way.
            // @deprecated since we're actually full on incoporating this functionality
            if( '' == get_post_meta( get_the_ID(), 'link_url_field', true ) ) {

                // Read the attribute of the anchor from the post format
                $title = get_post_format_attribute( 'title' );
                $href = get_post_format_attribute( 'href' );
                $target = get_post_format_attribute( 'target' );

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

    } // end post_format_rss
    add_filter( 'the_content_feed', 'post_format_rss' );
} // end if

/**
 * Formats the link post format properly for viewing in the template
 *
 * @param		string $content	The post content
 * @return		string The properly content formatted for RSS
 * @version 	3.3
 * @since		3.3
 */
if( is_wp36() ) {

    /**
     * Returns the URL from the link post format.
     *
     * Falls back to the post permalink if no URL is found in the post.
     *
     * @since  3.3
     * @return string URL
     */
    function get_link_url() {
        return ( get_the_post_format_url() ) ? get_the_post_format_url() : apply_filters( 'the_permalink', get_permalink() );
    } // get_link_url

} // end if

if( using_native_seo() ) {
    /**
     * Calls the Lean SEO Titles plugin during the wp_title action to render
     * SEO-friendly page titles.
     *
     * @version 3.0
     * @since	3.0
     */
    function seo_titles() {

        include_once( get_template_directory() . '/lib/seotitles/seotitles.php' );
        return SeoTitles::get_page_title( get_the_ID() );

    } // end seo_tiltes
    add_filter( 'wp_title', 'seo_titles' );
} // end if

if( ! function_exists('modify_widget_titles') ) {
    /**
     * Place all widget titles in h4 tags rather than h3 tags to improve SEO. Also adds the
     * 'widget-title' class to the heading elements.
     *
     * @param	array $params		The array of parameters that provide styling for the widget.
     * @return	array The updated array of parameters.
     * @version 3.0
     * @since	3.0
     */
    function modify_widget_titles( $params ) {

        $params[0]['before_title'] = '<h4 class="' . $params[0]['widget_name'] . ' widget-title">' ;
        $params[0]['after_title'] = '</h4>';

        return $params;

    } // end modify_widget_titles
    add_filter( 'dynamic_sidebar_params', 'modify_widget_titles' );
} // end if

if( ! function_exists('add_title_to_single_post_pagination') ) {
    /**
     * Adds the title attribute to the 'Next and 'Previous' post pagination anchors.
     *
     * @param	string $link	The anchor element for the next or previous post.
     * @return	string The pagination link with the additional attribute.
     * @version 3.0
     * @since	3.0
     */
    function add_title_to_single_post_pagination( $link ) {

        if( strpos( $link, 'rel="prev"' ) > 0 ) {

            $previous_post = get_previous_post();
            $link = str_replace( 'rel="prev"', 'rel="prev" title="' . esc_attr( get_the_title( $previous_post->ID ) ) . '"', $link );

        } else if( strpos( $link, 'rel="next"' ) > 0 ) {

            $next_post = get_next_post();
            $link = str_replace( 'rel="next"', 'rel="next" title="' . esc_attr( get_the_title( $next_post->ID ) ) . '"', $link );

        } // end if/else

        return $link;

    } // end add_title_to_single_post_pagination
    add_filter( 'next_post_link', 'add_title_to_single_post_pagination' );
    add_filter( 'previous_post_link', 'add_title_to_single_post_pagination' );
} // end if

/**
 * If the post that's being saved is the sitemap, set a flag to prevent use of duplicate sitemaps.
 *
 * @version 3.0
 * @since	3.0
 */
function save_post( ) {

    if( isset( $_POST['page_template'] ) && isset( $_POST['page_template'] ) ) {

        // if we're saving the page that's using the sitemap but the template is no longer used, delete the option
        if( get_option( 'using_sitemap' ) == $_POST['post_ID'] && strpos( $_POST['page_template'], 'template-sitemap.php' ) == false ) {
            delete_option( 'using_sitemap' );
        } // end if

        // if we're not using the sitemap, but this post has it set, update the option with this post's id
        if( ( '' == get_option( 'using_sitemap' ) || false == get_option( 'using_sitemap' ) ) && strpos( $_POST['page_template'], 'template-sitemap.php' ) > -1 ) {
            update_option( 'using_sitemap', $_POST['post_ID'] );
        } // end if

    } // end if

} // end save_post
add_action( 'save_post', 'save_post' );
/**
 * Updates the Lean Sitemap Flag if the post being deleted is the actual sitemap.
 *
 * @param	string $id		The ID of the post being deleted.
 * @version 3.0
 * @since	3.0
 */
function delete_post( $id ) {

    // if the page being deleted has the sitemap template, we need to delete the option
    if( get_option( 'using_sitemap') == $id ) {
        delete_option( 'using_sitemap' );
    } // end if

} // end delet_post
add_action( 'before_delete_post', 'delete_post' );

/**
 * Introduces custom messaging to the Image Uploader on the 'post' and 'page' screens.
 * Also marks the alternate tag as required. Will populate it with the title
 * if it is left empty.
 *
 * This function is specifically used in WordPress 3.4.
 *
 * @param		array 	$form_fields	The array of form fields in the uploader
 * @param		object 	$post			The post object
 * @return		array 					The updated array of form fields
 * @since		3.1
 * @version		3.1
 * @deprecated 	3.3
 */
function attachment_fields_to_edit_wp34( $form_fields, $post ) {

    // Mark the alt field as required
    $form_fields['image_alt']['required'] = true;

    // Provide a Lean description for title and alt
    $form_fields['post_title']['helps'] =	__( 'A title is required for search engines.', 'lean' );
    $form_fields['image_alt']['helps'] = __( 'An alternate text description is required for search engines.', 'lean' );

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

} // end attachment_fields_to_edit
if( '3.5.1' > get_bloginfo( 'version' ) || '3.5' > get_bloginfo( 'version' ) ) {
    add_action( 'attachment_fields_to_edit', 'attachment_fields_to_edit_wp34', 11, 2 );
} // end if

/**
 * If the user has set a FeedBurner URL in the Global Options, then we'll
 * redirect all traffic from the existing WordPress feed to FeedBurner.
 *
 * @since	3.0
 * @version	3.0
 */
function redirect_rss_feeds() {

    global $feed;

    // If we're not on a feed or we're requesting feedburner then stop the redirect
    if( ! is_feed() || preg_match( '/feedburner/i', $_SERVER['HTTP_USER_AGENT'] ) || is_offline() ) {
        return;
    } // end if

    // Otherwise, get the RSS feed from the user's settings
    $rss_feed_url = get_rss_feed_url();

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

} // end redirect_rss_feeds
add_action( 'template_redirect', 'redirect_rss_feeds' );

if( is_offline() ) {

    /**
     * If theme is in offline mode, then we'll stop all RSS feeds from publishing content.
     *
     * @version 3.0
     * @since	3.0
     */
    function disable_feed() {
        wp_die( get_bloginfo( 'name' ) . ' ' . __( 'is currently offline.', 'lean' ) . ' ' );
    } // end disable_feeds

    add_action( 'do_feed', 'disable_feed', 1 );
    add_action( 'do_feed_rdf', 'disable_feed', 1 );
    add_action( 'do_feed_rss', 'disable_feed', 1 );
    add_action( 'do_feed_rss2', 'disable_feed', 1 );
    add_action( 'do_feed_atom', 'disable_feed', 1 );

} // end if

/**
 * Custom action that is used to initialize the menu separator.
 *
 * @param	int $position	Where you want the separator to appear.
 * @version 3.0
 * @since	3.0
 */
function add_admin_menu_separator( $position ) {

    global $menu;

    $menu[$position] = array(
        0	=>	'',
        1	=>	'read',
        2	=>	'separator' . $position,
        3	=>	'',
        4	=>	'wp-menu-separator'
    );

} // end add_admin_separator
add_action( 'init_menu', 'add_admin_menu_separator' );

/**
 * Defines the function used to set the position of the custom separator.
 *
 * @version 3.0
 * @since	3.0
 */
function set_admin_menu_separator() {

    // Eventually, we should make the 57 value more flexible
    do_action( 'init_menu', 57 );

} // end set_admin_menu_separator
add_action( 'init', 'set_admin_menu_separator' );

/* ----------------------------------------------------------- *
 * 8. Helper Functions
 * ----------------------------------------------------------- */

/**
 * Determines whether or not the user is viewing a date archive.
 *
 * @return	True if the current page is for a date archive.
 * @since	3.0
 * @version	3.0
 */
function is_date_archive() {
    return '' != get_query_var( 'year' ) || '' != get_query_var( 'monthnum' ) || '' != get_query_var( 'day' ) || '' != get_query_var( 'm' );
} // end is_date_archive

/**
 * Generates a label for the current archive based on whether or not the user is viewing year, month, or day. Uses the
 * users date format to properly format the date.
 *
 * @return	string The label for the current archive
 * @since	3.0
 * @version	3.0
 */
function get_date_archive_label() {

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

} // end get_date_archive_label

/**
 * Returns the requested attribute from the link in the content based on the incoming
 * attributes.
 *
 * @param	array $attr	The attribute to extract from the link.
 * @return	string The value of the attribute or empty for none.
 * @since	3.0
 * @version	3.0
 */
function get_post_format_attribute( $attr ) {

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

} // end get_post_format_attribute

/**
 * Looks at the active widgets to determine whether or not the Google Custom Search widget is active.
 *
 * @return	boolean Whether or not the Google Custom Search is active
 * @since	3.0
 * @version	3.2
 */
function google_custom_search_is_active() {

    $gcse_is_active = false;

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

    return $gcse_is_active;

} // end google_custom_search_is_active

if( ! function_exists('comment_form') ) {
    /**
     * Builds and renders the custom comment form template.
     *
     * @since	3.0
     * @version	3.0
     */
    function comment_form() {

        // Gotta read the layout options so we apply the proper ID to our element wrapper
        $layout_options = get_option( 'theme_presentation_options' );
        $layout = 'full_width_layout' == $layout_options['layout'] ? '-full' : '';

        // Grab the current commenter and the required options. This is so we can mark fields as required.
        $commenter = wp_get_current_commenter();
        $req = get_option( 'require_name_email' );
        $aria_req = ( $req ? " aria-required='true'" : '' );

        // The field elements with wrappers so we can access them via CSS and JavaScript
        $fields =  array(
            'author' 	=> '<div id="comment-form-elements' . $layout . '"><p class="comment-form-author">' . '<label for="author">' . __( 'Name', 'lean' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
            'email'  	=> '<p class="comment-form-email"><label for="email">' . __( 'Email', 'lean' ) . '</label> ' . ( $req ? '<span class="required">*</span>' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>',
            'url'		=> '<p class="comment-form-url"><label for="url">' . __( 'Website', 'lean' ) . '</label>' . '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p></div><!-- /#comment-form-elements --></div><!-- /#comment-form-wrapper -->',
        );

        // Now actually render the form
        comment_form(
            array(
                'comment_notes_before'	=>	'<div id="comment-form-wrapper"><div id="comment-form-avatar">' . get_avatar( '', $size = '30' )  . '</div>',
                'fields'				=>	apply_filters( 'comment_form_default_fields', $fields ),
                'comment_notes_after' 	=>	'<p class="form-allowed-tags">' . sprintf( __( 'Text formatting is available via select <a id="allowed-tags-trigger" href="javascript:;">HTML</a>. %s', 'lean' ), ' <pre id="allowed-tags">' . allowed_tags() . '</pre>' ) . '</p>',
                'logged_in_as'			=>	'<div id="comment-form-wrapper"><p id="comment-form-avatar">' . get_avatar( get_the_author_meta( 'user_email', wp_get_current_user()->ID ), $size = '50' )  . '</p><p id="logged-in-container">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ), admin_url( 'profile.php' ), get_the_author_meta( 'user_nicename', wp_get_current_user()->ID ), wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p></div><!-- /#comment-form-wrapper -->'
            )
        );

    } // end comment_form
} // end if

/**
 * Truncates string at the last breakable space within the string at the
 * character limit and then adds the truncation indicator.
 *
 * @param	string $string                  The string to possibly truncate
 * @param	int $character_limit            Optional. The number of characters to limit the string to
 * @param	string $truncation_indicator    Optional. The characters to end truncation with (if needed)
 * @return	string The original or the truncated string based on the length of the original string.
 * @since	3.0
 * @version	3.0
 */

function truncate_text( $string, $character_limit = 50, $truncation_indicator = '...' ) {

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

} // end truncate_text

/**
 * If Lean is set to online mode, this function loads and redirects all traffic to the
 * page template defined for offline mode.
 *
 * @return	boolean Whether or not the site is set into offline mode.
 * @since	3.0
 * @version	3.0
 */
function is_offline() {

    $global_options = get_option( 'lean_theme_global_options' );

    $site_mode = '';
    if( isset( $global_options['site_mode'] ) && '' != $global_options['site_mode'] ) {
        $site_mode = $global_options['site_mode'];
    } // end if

    return 'offline' == $site_mode;

} // end site_mode

/**
 * Helper function for programmatically creating a page.
 *
 * @param	string $slug		The slug by which the page will be accessed
 * @param	string $title		The title of the page
 * @param	string $template	The name of the template file (without the file extension)
 * @return	string The ID of the page once it was created, or 0 if it failed.
 * @since	3.0
 * @version	3.0
 */
function create_page( $slug, $title, $template = '' ) {

    $current_user = wp_get_current_user();

    // Grab the content for the page being created
    $page_content = '';
    if( 'privacy-policy' == $slug ) {
        $page_content = file_get_contents( get_template_directory_uri() . '/lib/Privacy_Policy.template.html' );
    } elseif( 'comment-policy' == $slug ) {
        $page_content = file_get_contents( get_template_directory_uri() . '/lib/Comment_Policy.template.html' );
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

} // end create_page

/**
 * Helper function for programmatically deleting a page.
 *
 * @param   int $id			The ID of the page to delete
 * @return  boolean True if deleting of the page was successful; otherwise, false.
 * @since	3.0
 * @version	3.0
 */
function delete_page( $id ) {
    return null != wp_delete_post( $id, true );
} // end delete_page

/**
 * If not already active, includes the plugin by using the specified path.
 *
 * @param	string $str_path	The path to the plugin to include.
 * @since	3.0
 * @version	3.0
 */
function add_plugin( $str_path ) {
    if( ! in_array( get_template_directory() . $str_path, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
        include_once( get_template_directory() . $str_path );
    } // end if
} // end add_plugin

/**
 * Returns the URL to the RSS feed based on what option the user
 * has selected throughout the theme.
 *
 * @return	string The default feel link unless the user has specified a custom URL
 * @since	3.0
 * @version	3.0
 */
function get_rss_feed_url() {

    $global_options = get_option( 'lean_theme_global_options' );

    $url = (string)get_feed_link( 'rss2' );
    if( isset( $global_options['feedburner_url'] ) && '' != $global_options['feedburner_url'] ) {
        $url = $global_options['feedburner_url'];
    } // end if

    return $url;

} // end get_rss_feed_url

/**
 * Determines if the user has uploaded a logo or not.
 *
 * @return	boolean True if the user has uploaded a logo, false, if not.
 * @since	3.0
 * @version	3.0
 */
function has_logo() {

    $presentation_options = get_option( 'theme_presentation_options' );

    $logo = '';
    if( isset( $presentation_options['logo'] ) ) {
        $logo = $presentation_options['logo'];
    } // end if

    return $logo;

} // end has_logo

/**
 * Determines whether or not the user has opted to display header text or not.
 *
 * @return	boolean True if the user wants to display header text; otherwise, false.
 * @since	3.0
 * @version	3.0
 */
function has_header_text() {
    return ! ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) );
} // end has_header_text

/**
 * Determines whether or not the user is using pretty permalinks.
 *
 * @return	boolean True if pretty permalinks are enabled; false, otherwise.
 * @since	3.1
 * @version	3.1
 */
function is_using_pretty_permalinks() {

    global $wp_rewrite;
    return '/%postname%/' == $wp_rewrite->permalink_structure;

} // end is_using_pretty_premalinks

/**
 * Determines if the current version of Lean is the most current version.
 *
 * @return	boolean True if the current version of Lean is 3.1; false, otherwise.
 * @since 	3.1
 * @version	3.2
 */
function is_current_version() {
    return LEAN_THEME_VERSION == get_option( 'lean_theme_version' ) ? true : false;
} // end is_current_version

/**
 * Determines whether or not Lean is being run on WordPress 3.6
 *
 * @return	float	The current version of WordPress.
 */
function is_wp36() {

    global $wp_version;
    return 0 == strpos( $wp_version, '3.6' );

} // end is_wp36

/**
 * Removes shortcodes from gallery posts
 *
 */

function remove_shortcode_from_gallery_post_format($content) {
    if( 'gallery' == get_post_format( get_the_ID() ) ) {
        $content = strip_shortcodes( $content );
    }
    return $content;
}
add_filter('the_content', 'remove_shortcode_from_gallery_post_format');