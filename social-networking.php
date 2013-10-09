<?php 
/**
 * The template for rendering the social networking icons.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
 
// Read the active social icon stirng
$social_options = get_option( 'theme_social_options' );
$social_options = $social_options['active-social-icons'];	

// Read out the URLs
$social_icons_urls = explode( ';', $social_options );

// Begin to build up the list looking for the anchors for each image, too
$html = '<ul class="nav navbar-nav navbar-right nav-pills clearfix">';
foreach( $social_icons_urls as $icon_url ) {

	$icon_url_array = explode( '|' , $icon_url );
	$url = null;
	if( count( $icon_url_array ) == 1 ) {
	
		$icon = $icon_url_array[0];
	
	} else { 
	
		$icon = $icon_url_array[0];
		$url = $icon_url_array[1];
		
	} // end if/else

	// Build the line item
	if( isset( $url ) || '' != esc_url( $icon ) ) {
	
        $html .= '<li>';

        if( strpos( $icon, 'twitter.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-twitter';
        } else if( strpos( $icon, 'facebook.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-facebook';
        } else if( strpos( $icon, 'email.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-envelope';
        } else if( strpos( $icon, 'github.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-github';
        } else if (strpos( $icon, 'dribbble.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-dribbble';
        } else if (strpos( $icon, 'foursquare.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-foursquare';
        } else if (strpos( $icon, 'google_plus.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-google-plus';
        } else if (strpos( $icon, 'pinterest.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-pinterest';
        } else if (strpos( $icon, 'linkedin.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-linkedin';
        } else if (strpos( $icon, 'youtube.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-youtube';
        } else if (strpos( $icon, 'vimeo.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-play';
        } else if (strpos( $icon, 'soundcloud.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-cloud';
        } else if (strpos( $icon, 'rss.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-rss';
            $url = get_rss_feed_url();
        } // end if/else
		
		// if the image has a URL, setup the anchor...
		if( '' != $url ) {
			$html .= '<a href="' . esc_url( str_replace( 'https://', 'http://', $url ) ) . '" class="fademe" target="_blank">';
		} // end if
		
            // display the span
            $html .= '<span class="' . $font_awesome_icon_class . '"></span>';

		// ...and if the image has a URL, close the anchor
		if( '' != $url ) {
			$html .= '</a>';
		} // end if
		
		unset( $url );
		
		$html .= '</li>';
	
	} // end if/else
	
} // end foreach
$html .= '</ul>';

// Render the list
echo $html;