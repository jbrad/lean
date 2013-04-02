<?php
/**
 * 468x60 is a widget for displaying a single 468x60 ad in any widgetized
 * area in Standard.
 *
 * @package		Standard
 * @subpackage	468x60 Advertisement Widget
 * @version		1.1
 * @since		3.0
 */
class Standard_Ad_468x60 extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	/**
	 * Initializes the widget's classname, description, and JavaScripts.
	 */  
	public function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'standard-ad-billboard', 'standard' ), 
			'description' 	=> __( 'Display a 468x60 advertisement.', 'standard' )
		);	
		$this->WP_Widget( 'standard-ad-468x60', __( '468x60 Ad', 'standard' ), $widget_opts );
		
		// We don't want to load these on the Appearance Options because we're overiding window.send_to_editor there, too.
		global $pagenow;
		if( 'themes.php' != $pagenow ) {
		
			add_action( 'admin_print_styles', array( $this, 'register_admin_styles' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'register_admin_scripts' ) );
			
		} // end if
		
	} // end constructor

	/*--------------------------------------------------------*
	 * API Functions
	 *--------------------------------------------------------*/
	 
	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array    $args		The array of form elements
	 * @param	object   $instance	The current instance of the widget
	 * @since	3.0
	 * @version	1.0
	 */
	public function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
	
		$ad_src = empty( $instance['ad_src'] ) ? '' : apply_filters( 'ad_src', $instance['ad_src'] );
		$ad_url = empty( $instance['ad_url'] ) ? '' : apply_filters( 'ad_url', $instance['ad_url'] );
		
		// Display the widget
		include( plugin_dir_path( __FILE__ ) .  'views/widget.php' );
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param  array   $new_instance	The previous instance of values before the update.
	 * @param  array   $old_instance	The new instance of values to be generated via the update.
	 * @return array                    The updated instance of the widget.
	 * @since	3.0
	 * @version	1.0
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
	 * @param   array $instance	   The array of keys and values for the widget.
 	 * @since	3.0
	 * @version	1.0
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
		include( plugin_dir_path( __FILE__ ) .  'views/admin.php' );
		
	} // end form

	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/

	/** 
	 * Registers and Enqueues the stylesheets for the Media Uploader and this widget.
	 *
	 * @since	3.0
	 * @version	1.0
	 */
	public function register_admin_styles() {
		wp_enqueue_style( 'standard-ad-468x60', get_template_directory_uri() . '/lib/standard-ad-billboard/css/admin.css', STANDARD_THEME_VERSION );
	} // end register_admin_styles

	/** 
	 * Registers and Enqueues the admin dashboard JavaScript for this widget.
	 *
	 * @since	3.0
	 * @version	1.0
	 */
	public function register_admin_scripts() {
	
		$screen = get_current_screen();

		if( 'widgets' == $screen->id ) {
			wp_enqueue_script( 'standard-ad-468x60', get_template_directory_uri() . '/lib/standard-ad-billboard/js/admin.min.js', array( 'jquery', 'media-upload','thickbox' ), false, STANDARD_THEME_VERSION );
		} // end if
		
	} // end register_admin_scripts

	/**
	 * Renders the advertisement for the specified advertisement.
	 *
	 * @param	string	$ad_src	The source of the image file
	 * @param	string	$ad_url	The URL of the advertisement
	 * @return	string	$html	The markup for the 
	 * @since 	3.2
	 * @version 1.0
	 */
	private function display_ad( $ad_src, $ad_url ) {
		
		$html = '';

		// Use the default ad if it's not specified
		if( 0 == strlen( trim( $ad_src ) ) ) {
		
			if( 0 == strlen( trim( $ad_url ) ) ) {
				$ad_url = 'http://standardtheme.com';
			} // end if
		
			$ad_src = '<img src="' . get_template_directory_uri() . '/lib/standard-ad-billboard/images/standard-468.jpg" alt="" />';
			
		} else {
			$ad_src = '<img src="' . $ad_src . '" alt="" />';
		} // end if
		
		// Check to see if the URL is empty
		if( 0 != strlen( trim( $ad_url ) ) ) {
		
			$html = '<a href="' . $ad_url . '">';
				$html .= $ad_src;
			$html .= '</a>';
			
		} else {
			$html .= $ad_src;
		} // end if
		
		return $html;
		
	} // end display_ad

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Standard_Ad_468x60" );' ) );