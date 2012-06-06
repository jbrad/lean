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

	$options = get_option( 'standard_theme_global_options ' );
	if( 'on' == $options['display_breadcrumbs'] ) {
		if( '' !== get_the_ID() ) {
			echo Standard_Breadcrumbs::get_breadcrumb_trail( get_the_ID() );
		} // end if
	} // end if
 
} // end if
?>