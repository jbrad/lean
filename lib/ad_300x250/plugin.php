<?php

/**
 * 300x250 is a widget for displaying a single 300x250 ad in any widgetized
 * area in Standard.
 *
 * version 1.0
 */
class Standard_Ad_300x250 extends WP_Widget {

	/**
	 * TODO
	 * - remove unnecessary media fields
	 * - client facing widget
	 */

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	public function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'Ad 300x250', 'standard' ), 
			'description' 	=> __( 'Display a 300x250 advertisement.', 'standard' )
		);	
		$this->WP_Widget( 'standard-ad-300x250', __( '300x250 Ad (Standard)', 'standard' ), $widget_opts );
		
		add_action( 'admin_print_styles', array( &$this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'register_admin_scripts' ) );
		
		add_action( 'wp_enqueue_scripts', array( &$this, 'register_widget_styles' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'register_widget_scripts' ) );
		
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
	public function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
	
		$ad_src = empty( $instance['ad_src']) ? '' : apply_filters( 'ad_src', $instance['ad_src'] );
		$ad_url = empty( $instance['ad_url']) ? '' : apply_filters( 'ad_url', $instance['ad_url'] );
		
		// Display the widget
		// TODO
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['ad_src'] = strip_tags( stripslashes( $new_instance['ad_src'] ) );
		$instance['ad_url'] = strip_tags( stripslashes( $new_instance['ad_url'] ) );
		
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @instance	The array of keys and values for the widget.
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'ad_src' 	=> '',
				'ad_url'	=> ''
			)
		);
    
		$ad_src = esc_url( $instance['ad_src'] );
		$ad_url = esc_url( $instance['ad_url'] );
    
		// Display the admin form
    	include( get_template_directory() . '/lib/ad_300x250/views/admin.php' );
		
	} // end form

	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/

	/** 
	 * TODO
	 */
	public function register_admin_styles() {
	
		wp_enqueue_style( 'thickbox' );
		
		wp_register_style( 'standard-ad-300x250', get_template_directory_uri() . '/lib/ad_300x250/css/admin.css' );
		wp_enqueue_style( 'standard-ad-300x250' );
		
	} // end register_admin_styles

	/**
	 * TODO
	 */
	public function register_admin_scripts() {
	
		// media uploader
		wp_enqueue_script('media-upload');
		
		// thickbox for overlay
		wp_enqueue_script('thickbox');
	
		// admin
		wp_register_script( 'standard-ad-300x250', get_template_directory_uri() . '/lib/ad_300x250/js/admin.js', array( 'jquery', 'media-upload','thickbox') );
		wp_enqueue_script( 'standard-ad-300x250' );
		
	} // end register_admin_scripts
	
	/**
	 * TODO
	 */
	public function register_widget_scripts() {
	
		wp_register_script( 'standard-ad-300x250', get_template_directory_uri() . '/lib/ad_300x250/js/widget.js' );
		wp_enqueue_script( 'standard-ad-300x250' );
	
	} // end register_widget_scripts
	
	/**
	 * TODO
	 */
	public function register_widget_styles() {
	
		wp_register_style( 'standard-ad-300x250', get_template_directory_uri() . '/lib/ad_300x250/css/widget.css' );
		wp_enqueue_style( 'standard-ad-300x250' );
	
	} // end register_widget_styles

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Standard_Ad_300x250" );' ) ); 
?>