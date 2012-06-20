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
	 
	function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'standard-google-custom-search', 'standard' ), 
			'description' 	=> __( 'Easily add Google Custom Search to your Standard-powered blog.', 'standard' )
		);	
		$this->WP_Widget( 'standard-google-custom-search', __( 'Google Custom Search', 'standard' ), $widget_opts );
		
		add_action( 'admin_print_styles', array( &$this, 'load_admin_stylesheets') );
		add_action( 'wp_print_styles', array( &$this, 'load_stylesheets' ) );
		
		$this->create_search_results_template();
		
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
		include( get_template_directory() . '/lib/google-custom-search/views/widget.php' );
		
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
				'gcse_content' 		=> ''
			)
		);
		
    	$gcse_title = strip_tags( stripslashes( $instance['gcse_title'] ) );
    	$gcse_content = esc_textarea( $instance['gcse_content'] );
   
		// Display the admin form
		include( get_template_directory() . '/lib/google-custom-search/views/admin.php' );
		
	} // end form
	
	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/
	
	/**
	 * Loads the administrative stylesheets for the dashboard.
	 */
	function load_admin_stylesheets() {
		
		wp_register_style( 'gcse-admin', get_template_directory_uri() . '/lib/google-custom-search/css/admin.css' );
		wp_enqueue_style( 'gcse-admin' );
		
	} // end load_stylesheets
	
	/**
	 * Loads the stylesheets for the sidebar and the page template.
	 */
	function load_stylesheets() {
		
		wp_register_style( 'gcse-widget', get_template_directory_uri() . '/lib/google-custom-search/css/widget.css' );
		wp_enqueue_style( 'gcse-widget' );
		
	} // end load_stylesheets
	
	/**
	 * Creates the search results page that will be used to render the results based on the search.
	 * If a page with the 'Search Results' slug already exists, an error will be thrown.
	 */
	private function create_search_results_template() {
		
		if( 0 == count( get_page_by_path( 'search-results' ) ) ) { 

			// Get the current user
			$current_user = wp_get_current_user();
			
			// Create the page
			$page_id = wp_insert_post(	
				array(
					'comment_status'	=>	'closed',
					'ping_status'		=>	'closed',
					'post_author'		=>	$current_user->ID,
					'post_name'			=>	'search-results',
					'post_title'		=>	__( 'Search Results', 'standard' ),
					'post_status'		=>	'publish',
					'post_type'			=>	'page',
					'post_content'		=>	file_get_contents( get_template_directory_uri() . '/lib/google-custom-search/lib/Standard_Google_Custom_Search.template.php' )
				)
			);
			
			update_post_meta( $page_id, 'standard_google_custom_search', true );
		
		} else {
		
			add_action( 'admin_notices', array( &$this, 'existing_search_results_template' ) );
		
		} // end if
		
	} // end create_search_results_template
	
	/**
	 * Renders a notification if the user already has an existing search results template.
	 */
	public function existing_search_results_template() {
		
		$page_id = get_page_by_path( 'search-results' )->ID;
		
		if( 'widgets' == get_current_screen()->id ) {
		
			if( ( '' || false || null ) == get_post_meta( $page_id, 'standard_google_custom_search' ) ) {
			
				echo '<div id="standard-gcse-template-exists-notification" class="updated"><p>' . __( 'Standard has detected that you already have a search results template. Please <a href="post.php?post=' . $page_id . '&action=edit">delete this page</a> or change the page\'s permalink. TODO: Chris will need to rework this verbiage.', 'standard') . '</p></div>';
			
			} // end if

		} // end if		
		
	} // end existing_search_results_template

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Google_Custom_Search" );' ) ); 

?>