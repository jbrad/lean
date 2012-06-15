<?php 

	// Read the active social icon stirng
	$social_options = get_option( 'standard_theme_social_options' ); 
	$social_options = $social_options['active-social-icons'];	
	
	// Read out the URLs
	$social_icons_urls = explode( ';', $social_options );
	
	// Begin to build up the list looking for the anchors for each image, too
	$html = '<ul class="nav social-icons clearfix">';
	foreach( $social_icons_urls as $icon_url ) {
	
		$icon_url_array = explode( '|' , $icon_url );
		if( count( $icon_url_array ) == 1 ) {
		
			$icon = $icon_url_array[0];
		
		} else { 
		
			$icon = $icon_url_array[0];
			$url = $icon_url_array[1];
			
		} // end if/else
		
		// Build the line item
		$html .= '<li>';
		if( isset( $url ) ) {	
		
			$html .= '<a href="' . esc_url( $url ) . '" class="fademe" target="_blank"><img src="' . esc_url( $icon ) . '" alt="" /></a>';
			
			// We have to unset the reference so the next icon doesn't inherit this url
			unset( $url );
			
		} else {
			$html .= '<img src="' . esc_url( $icon ) . '" alt="" />';
		} // end if/else
		$html .= '</li>';
		
	} // end foreach
	$html .= '</ul>';
	
	// Render the list
	echo $html;
	
?>


