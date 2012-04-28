<?php

/**
 * Google Custom Search is a widget that aims to make it easy to add a Google Custom Search
 * box to any widgetized area of your blog.
 *
 * version 1.0
 */
class Google_Custom_Search extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	function Google_Custom_Search() {

		$widget_opts = array(
			'classname' 	=> __( 'Google Custom Search', 'standard' ), 
			'description' 	=> __( 'Easily add Google Custom Search to your Standard-powered blog.', 'standard' )
		);	
		$this->WP_Widget( 'google-custom-search', __( 'Google Custom Search (Standard)', 'standard' ), $widget_opts );
		
		if( is_admin() ) {
		
			wp_register_style( 'gcse-admin', get_template_directory_uri() . '/lib/gcse/css/admin.css' );
			wp_enqueue_style( 'gcse-admin' );
			
		} // end if
		
	} // end constructor

	/*--------------------------------------------------------*
	 * API Functions
	 *--------------------------------------------------------*/
	 
	/**
	 * Outputs the content of the widget.
	 *
	 * @args			The array of form elements
	 * @instance
	 */
	function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );

		$gcse_title = empty( $instance['gcse_title'] ) ? '' : apply_filters( 'gcse_title', $instance['gcse_title'] );
		$gcse_content = empty( $instance['gcse_content'] ) ? '' : apply_filters( 'gcse_content', $instance['gcse_content'] );
    
		// Display the widget
		include( get_template_directory() . '/lib/gcse/views/widget.php' );
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['gcse_title'] = strip_tags( stripslashes( $new_instance['gcse_title'] ) );
		$instance['gcse_content'] = $new_instance['gcse_content'];
		
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	function form( $instance ) {

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'gcse_title' 		=> '',
				'gcse_content' 		=> 'tomtom'
			)
		);
		
    	$gcse_title = strip_tags( stripslashes( $instance['gcse_title'] ) );
    	$gcse_content = esc_textarea( $instance['gcse_content'] );
   
		// Display the admin form
		include( get_template_directory() . '/lib/gcse/views/admin.php' );
		
	} // end form

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget("Google_Custom_Search");' ) ); 

?>