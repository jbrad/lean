<?php 
/**
 * The template for rendering the social networking icons.
 *
 * @package lean
 * @version	1.1
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
	
		$use_font_awesome = false;
        $html .= '<li>';
        if( strpos( $icon, 'rss.png' ) > 0 ) {
            $url = get_rss_feed_url();
            $font_awesome_icon_class = 'icon-rss';
            $use_font_awesome = true;
        } // end if/else

        if( strpos( $icon, 'twitter.png' ) > 0 ) {
            $font_awesome_icon_class = 'icon-twitter';
            $use_font_awesome = true;
        } // end if/else
		
		// if the image has a URL, setup the anchor...
		if( '' != $url ) {
			$html .= '<a href="' . esc_url( str_replace( 'https://', 'http://', $url ) ) . '" class="fademe" target="_blank">';
		} // end if
		
            if ( $use_font_awesome == 1 ) {
                // display the span
                $html .= '<span class="' . $font_awesome_icon_class . '"></span>';
            } else {
                // display the image
                $html .= '<img src="' . esc_url( $icon ) . '" alt="" />';
            }
		
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