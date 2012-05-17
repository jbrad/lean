<?php 

	$social_options = get_option( 'standard_theme_social_options' ); 
	$social_options = $social_options['active-social-icons'];	
	
	$social_icons_urls = explode( ';', $social_options );
	$html .= '<ul class="nav social-icons clearfix">';
	foreach( $social_icons_urls as $icon_url ) {
	
		$icon_url_array = explode( '|' , $icon_url );
		if( count( $icon_url_array ) == 1 ) {
		
			$icon = $icon_url_array[0];
		
		} else { 
		
			$icon = $icon_url_array[0];
			$url = $icon_url_array[1];
			
		} // end if/else
		
		$html .= '<li>';
			$html .= '<a href="' . esc_url( $url ) . '" class="fademe" target="_blank"><img src="' . esc_url( $icon ) . '" alt="" /></a>';
		$html .= '</li>';
		
	} // end foreach
	$html .= '</ul>';
	
	echo $html;
	
?>


