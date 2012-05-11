<?php
/**
 * A widget for displaying a personal image and an optional description for displaying in the sidebar
 * of Standard.
 *
 * version 1.0
 */
class Standard_Personal_Image extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	public function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'Personal Image', 'standard' ), 
			'description' 	=> __( 'Display a personal image and an optional description.', 'standard' )
		);	
		$this->WP_Widget( 'standard-personal-image', __( 'Personal Image (Standard)', 'standard' ), $widget_opts );
		
		// We don't want to load these on the Appearance Options because we're overiding window.send_to_editor there, too.
		// We don't have access to get_current_screen() so we're using $pagenow.
		global $pagenow;
		if( 'themes.php' != $pagenow ) {
			
			// This will be a problem because we're also overriding this with the advertisement widget. TODO.
			add_action( 'admin_print_styles', array( &$this, 'register_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'register_admin_scripts' ) );
			
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
	public function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
	
		$image_src = empty( $instance['image_src']) ? '' : apply_filters( 'image_src', $instance['image_src'] );
		$image_url = empty( $instance['image_url']) ? '' : apply_filters( 'image_url', $instance['image_url'] );
		$image_description = empty( $instance['image_description']) ? '' : apply_filters( 'image_description', $instance['image_description'] );
		
		// Display the widget
		include( plugin_dir_path( __FILE__ ) .  'views/widget.php' );
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @new_instance	The previous instance of values before the update.
	 * @old_instance	The new instance of values to be generated via the update.
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['image_src'] = strip_tags( stripslashes( $new_instance['image_src'] ) );
		$instance['image_url'] = strip_tags( stripslashes( $new_instance['image_url'] ) );
		$instance['image_description'] = strip_tags( stripslashes( $new_instance['image_description'] ) );
		
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
				'image_src' 		=> '',
				'image_url' 		=> '',
				'image_description'	=> ''
			)
		);
    
		$image_src = esc_url( $instance['image_src'] );
		$image_url = esc_url( $instance['image_url'] );
		$image_description = esc_textarea( $instance['image_description'] );
    
		// Display the admin form
		include( plugin_dir_path( __FILE__ ) .  'views/admin.php' );
		
	} // end form

	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/

	/** 
	 * Registers and Enqueues the stylesheets for the Media Uploader and this widget.
	 */
	public function register_admin_styles() {
	
		wp_enqueue_style( 'thickbox' );
		
		wp_register_style( 'standard-personal-image', get_template_directory_uri() . '/lib/personal-image/css/admin.css' );
		wp_enqueue_style( 'standard-personal-image' );
		
	} // end register_admin_styles

	/** 
	 * Registers and Enqueues the JavaScript sources for the Media Uploader and this widget.
	 */
	public function register_admin_scripts() {
	
		// media uploader
		wp_enqueue_script('media-upload');
		
		// thickbox for overlay
		wp_enqueue_script('thickbox');

		// admin
		wp_register_script( 'standard-personal-image', get_template_directory_uri() . '/lib/personal-image/js/admin.js', array( 'jquery', 'media-upload','thickbox') );
		wp_enqueue_script( 'standard-personal-image' );
		
	} // end register_admin_scripts

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Standard_Personal_Image" );' ) ); 
?>