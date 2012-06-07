<?php
/**
 * The template for displaying breadcrumbs. Supports both Standard and Yoast Breadcrumbs.
 *
 * @package Standard
 * @since 3.0
 */
?>
<?php 
if( function_exists( 'yoast_breadcrumb' ) ) {

	yoast_breadcrumb( '', '' );

} else {

	$presentation_options = get_option( 'standard_theme_presentation_options ' );
	if( 'on' == $presentation_options['display_breadcrumbs'] ) {
		if( '' !== get_the_ID() ) {
			echo Standard_Breadcrumbs::get_breadcrumb_trail( get_the_ID() );
		} // end if
	} // end if
 
} // end if
?>