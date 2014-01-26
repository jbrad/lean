<?php
/**
 * Determines if the incoming URL is a gplus.to URL or a vanilla Google+ URL.
 *
 * @param	string $url	The URL to evaluate
 * @return	boolean Whether or not the URL is a gplus.to URL
 * @version	1.1
 * @since	1.0
 */
function is_gplusto_url( $url ) {
    return false != stristr( $url, 'gplus.to' );
} // end is_gplusto_url

/**
 * Determines if the incoming URL is a Google+ vanity URL.
 *
 * @param	string $url	The URL to evaluate
 * @return	boolean 	Whether or not the URL is a Google Plus Vanity URL
 * @version	1.1
 * @since	1.0
 */
function is_google_plus_vanity_url( $url ) {
    return false != stristr( $url, '/+' );
} // end is_google_plus_vanity_url

/**
 * Retrieves the user's Google+ ID from their gplus.to address.
 *
 * @param	string $url	The URL to evaluate
 * @return	string The full Google+ URL from the incoming URL.
 * @version	1.1
 * @since	1.0
 */
function get_google_plus_from_gplus( $url ) {

    $gplus_url = $url;

    // Check to see if http:// is there
    if( false == stristr( $url, 'http://' ) ) {
        $url = 'http://' . $url;
    } // end if

    // Get the headers from the gplus.to, URL
    $headers = @get_headers( $url );
    $url_parts = explode( '/', $headers[5] );

    // If the 5th index exists, the Google+ ID will be here
    if( isset( $url_parts[5] ) ) {
        $gplus_url = 'https://plus.google.com/' . $url_parts[5];
    } // end if

    return user_trailingslashit( $gplus_url );

} // get_google_plus_from_gplus

/**
 * Echos the publisher's Google Plus URL to the header of the page, if it's defined.
 *
 * @version 1.1
 * @since   1.0
 */
function google_plus() {

    global $post;

    $html = '';
    if( using_native_seo() && ( ( is_single() || is_page() ) && ( 0 != strlen( trim( ( $google_plus = get_user_meta( $post->post_author, 'google_plus', true ) ) ) ) ) ) ) {

        if( false != is_gplusto_url( $google_plus ) ) {
            $google_plus = get_google_plus_from_gplus( $google_plus );
        } // end if

        $html = '<link rel="author" href="' . trailingslashit( $google_plus ) . '"/>';

    } // end if

    echo $html;

} // end google_plus
add_action( 'wp_head', 'google_plus' );