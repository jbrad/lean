<?php
/**
 * 125x125 is a widget for displaying a single 125x125 ad in any widgetized area.
 *
 * @package		lean
 * @subpackage	125x125 Advertisement Widget
 * @version		1.1
 * @since		1.0
 */
class Ad_125x125 extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	/**
	 * Initializes the widget's classname, description, and JavaScripts.
	 */    
	public function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'ad-125x125', TRANSLATION_KEY ),
			'description' 	=> __( 'Display a 125x125 advertisement.', TRANSLATION_KEY ),
		);	
		$this->WP_Widget( 'ad-125x125', __( '125x125 Ad', TRANSLATION_KEY ), $widget_opts );
		
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
	 * @since	1.0
	 * @version	1.1
	 */
	public function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );
		
		// advertisement 1
		$ad1_src = empty( $instance['ad1_src']) ? '' : apply_filters( 'ad1_src', $instance['ad1_src'] );
		$ad1_url = empty( $instance['ad1_url']) ? '' : apply_filters( 'ad1_url', $instance['ad1_url'] );

		// advertisement 2
		$ad2_src = empty( $instance['ad2_src']) ? '' : apply_filters( 'ad2_src', $instance['ad2_src'] );
		$ad2_url = empty( $instance['ad2_url']) ? '' : apply_filters( 'ad2_url', $instance['ad2_url'] );
		
		// Display the widget
		include( plugin_dir_path( __FILE__ ) .  'views/widget.php' );
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param  array   $new_instance	The previous instance of values before the update.
	 * @param  array   $old_instance	The new instance of values to be generated via the update.
	 * @return array                    The updated instance of the widget.
	 * @since	1.0
	 * @version	1.1
	 */
	public function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		// advertisement 1
		$instance['ad1_src'] = strip_tags( stripslashes( $new_instance['ad1_src'] ) );
		$instance['ad1_url'] = strip_tags( stripslashes( $new_instance['ad1_url'] ) );

		// advertisement 2
		$instance['ad2_src'] = strip_tags( stripslashes( $new_instance['ad2_src'] ) );
		$instance['ad2_url'] = strip_tags( stripslashes( $new_instance['ad2_url'] ) );
		
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	$instance	The array of keys and values for the widget.
 	 * @since	1.0
	 * @version	1.1
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'ad1_src' 	=> 	'',
				'ad1_url'	=> 	'',
				'ad2_src' 	=> 	'',
				'ad2_url'	=>	''
			)
		);
    
    	// advertising 1
		$ad1_src = esc_url( $instance['ad1_src'] );
		$ad1_url = esc_url( $instance['ad1_url'] );

    	// advertising 2
		$ad2_src = esc_url( $instance['ad2_src'] );
		$ad2_url = esc_url( $instance['ad2_url'] );
    
		// Display the admin form
		include( plugin_dir_path( __FILE__ ) .  'views/admin.php' );
		
	} // end form

	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/

	/** 
	 * Registers and Enqueues the stylesheets for the Media Uploader and this widget.
	 *
	 * @since	1.0
	 * @version	1.1
	 */
	public function register_admin_styles() {
		wp_enqueue_style( 'ad-125x125', get_template_directory_uri() . '/lib/ad-125x125/css/admin.css', array( 'thickbox' ), THEME_VERSION );
	} // end register_admin_styles

	/** 
	 * Registers and Enqueues the admin dashboard JavaScript for this widget.
	 *
	 * @since	1.0
	 * @version	1.1
	 */
	public function register_admin_scripts() {
	
		$screen = get_current_screen();

		if( 'widgets' == $screen->id ) {
			wp_enqueue_script( 'ad-125x125', get_template_directory_uri() . '/lib/ad-125x125/js/admin.min.js', array( 'jquery', 'media-upload','thickbox' ), false, THEME_VERSION );
		} // end if 
		
	} // end register_admin_scripts
	
	/**
	 * Renders the advertisement for the specified advertisement.
	 *
	 * @param	string	$ad_src	The source of the image file
	 * @param	string	$ad_url	The URL of the advertisement
	 * @param	int		$number	The ID of the advertisement
	 * @return	string	$html	The markup for the
     * @version 1.1
	 * @since 	1.0
	 */
	private function display_ad( $ad_src, $ad_url, $number ) {
		
		$html = '';
		
		// Use the default ad if it's not specified
		if( 0 == strlen( trim( $ad_src ) ) ) {
		
			if( 0 == strlen( trim( $ad_url ) ) ) {
				$ad_url = 'THEME_URL';
			} // end if
		
			$ad_src = '<img class="img-responsive" src="' . get_template_directory_uri() . '/lib/ad-125x125/images/ad-170-' . $number . '.jpg' . '" alt="" />';
			
		} else {
			$ad_src = '<img class="img-responsive" src="' . $ad_src . '" alt="" />';
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
add_action( 'widgets_init', create_function( '', 'register_widget( "Ad_125x125" );' ) );