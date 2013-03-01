<?php
/**
 * Google Custom Search is a widget that aims to make it easy to add a Google Custom Search
 * box to any widgetized area of your blog.
 *
 * @package		Standard
 * @subpackage	Google Custom Search Widget
 * @version 	1.0
 * @since		3.0
 */
class Google_Custom_Search extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	
	/**
	 * Initializes the widget's classname, description, and JavaScripts.
	 */ 
	function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'standard-google-custom-search', 'standard' ), 
			'description' 	=> __( 'Easily add Google Custom Search to your Standard-powered blog.', 'standard' )
		);	
		$this->WP_Widget( 'standard-google-custom-search', __( 'Google Custom Search', 'standard' ), $widget_opts );
		
		add_action( 'admin_print_styles', array( $this, 'load_admin_stylesheets') );
		add_action( 'admin_enqueue_scripts', array( $this, 'load_admin_scripts') );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_stylesheets' ) );
		
		// If this widget isn't active and our search results page exists, let's delete it
		// If the widget is now active, then create the search results template; otherwise, delete what exists
		//print_r( is_active_widget( false, false, $this->id_base, true ) );
		//die();
		if( is_active_widget( false, false, $this->id_base, true ) ) {
			$this->create_search_results_template();
		} else {
			$this->delete_search_results_template();
		} // end if
		
	} // end constructor

	/*--------------------------------------------------------*
	 * API Functions
	 *--------------------------------------------------------*/
	 
	/**
	 * Outputs the content of the widget.
	 *
	 * @param	array    $args		The array of form elements
	 * @param	object   $instance	The current instance of the wdiget
	 * @since	3.0
	 * @version	3.0
	 */
	function widget( $args, $instance ) {
	
		extract( $args, EXTR_SKIP );

		$gcse_content = empty( $instance['gcse_content'] ) ? '' : apply_filters( 'gcse_content', $instance['gcse_content'] );
    
		// Display the widget
		include( get_template_directory() . '/lib/google-custom-search/views/widget.php' );
		
	} // end widget
	
	/**
	 * Processes the widget's options to be saved.
	 *
	 * @param	object $new_instance	The previous instance of values before the update.
	 * @param	object $old_instance	The new instance of values to be generated via the update.
	 * @since	3.0
	 * @version	3.0
	 */
	function update( $new_instance, $old_instance ) {
		
		$instance = $old_instance;

		$instance['gcse_content'] = $new_instance['gcse_content'];
		
		return $instance;
		
	} // end widget
	
	/**
	 * Generates the administration form for the widget.
	 *
	 * @param	array $instance	The array of keys and values for the widget.
 	 * @since	3.0
	 * @version	3.0
	 */
	function form( $instance ) {

		$instance = wp_parse_args(
			(array)$instance,
			array(
				'gcse_content' 		=> ''
			)
		);

    	$gcse_content = esc_textarea( $instance['gcse_content'] );
   
		// Display the admin form
		include( get_template_directory() . '/lib/google-custom-search/views/admin.php' );
		
	} // end form
	
	/*--------------------------------------------------------*
	 * Helper Functions
	 *--------------------------------------------------------*/
	
	/**
	 * Loads the administrative stylesheets for the dashboard.
	 *
	 * @since	3.0
	 * @version	3.0
	 */
	function load_admin_stylesheets() {
		wp_enqueue_style( 'gcse-admin', get_template_directory_uri() . '/lib/google-custom-search/css/admin.css', false, STANDARD_THEME_VERSION );
	} // end load_stylesheets
	
	/**
	 * Loads the administrative JavaScripts for the dashboard.
	 *
	 * @since	3.0
	 * @version	3.0
	 */
	function load_admin_scripts() {
		wp_enqueue_script( 'gcse-admin', get_template_directory_uri() . '/lib/google-custom-search/js/admin.min.js', false, STANDARD_THEME_VERSION );
	} // end load_stylesheets
	
	/**
	 * Loads the stylesheets for the sidebar and the page template.
	 *
	 * @since	3.0
	 * @version	3.0
	 */
	function load_stylesheets() {
		wp_enqueue_style( 'gcse-widget', get_template_directory_uri() . '/lib/google-custom-search/css/widget.css', false, STANDARD_THEME_VERSION );
	} // end load_stylesheets
	
	/**
	 * Creates the search results page that will be used to render the results based on the search.
	 * If a page with the 'Search Results' slug already exists, an error will be thrown.
	 *
	 * @since	3.0
	 * @version	3.0
	 */
	private function create_search_results_template() {

		if( null == get_page_by_title( 'search results' ) ) { 

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
					'post_content'		=>	$this->get_template_content( get_template_directory_uri() . '/lib/google-custom-search/lib/Standard_Google_Custom_Search.template.php' )
				)
			);
			
			// If the value exists, delete it first. I don't want to write extra rows into the table.
			if ( 0 == count( get_post_meta( $page_id, 'standard_google_custom_search' ) ) ) {
				delete_post_meta( $page_id, 'standard_google_custom_search' );
			} // end if
			
			// Mark that this post was created by Standard
			update_post_meta( $page_id, 'standard_google_custom_search', true );

		} else {
		
			$this->existing_search_results_template();
		
		} // end if
		
	} // end create_search_results_template
	
	/**
	 * Deletes the search results page when the widget is no longer active.
	 *
	 * @since	3.0
	 * @version	3.0
	 */
	public function delete_search_results_template() {

		$query = new WP_Query('post_type=page&meta_key=standard_google_custom_search');
		if( $query->have_posts() ) {
		
			$query->the_post();
			wp_delete_post( get_the_ID(), true );
			
			wp_reset_postdata();
			
		} // end
		
	} // end delete_search_results_template
	
	/**
	 * Renders a notification if the user already has an existing search results template.
	 *
	 * @since	3.0
	 * @version	3.0
	 */
	public function existing_search_results_template() {

		$page = get_page_by_title( 'search results', OBJECT, 'page' );
		$page_id = $page->ID;

		// If we're on the widgets page...
		if( $this->is_page( 'widgets.php' ) ) {
		
			// ... and a search results page already exists, then we need to throw up an error.
			if( 1 != get_post_meta( $page_id, 'standard_google_custom_search', true ) ) {
			
				echo '<div id="standard-gcse-template-exists-notification" class="updated"><p>' . __( 'Could not configure Google Custom Search widget because the required "search-results" permalink is already in use. Please rename <a href="post.php?post=' . $page_id . '&action=edit">the existing page\'s permalink</a>, or <a href="post.php?post=' . $page_id . '&action=edit">delete the page</a>, and try again.', 'standard') . '</p></div>';
			
			} // end if
		
		// Otherwise, if we're editing the generated Search Results page, then we need to display a message.
		} else if ( isset( $_GET['post'] ) && $page_id == $_GET['post'] ) {
		
			// If the user is trying to delete the page, don't let them.
			if( isset( $_GET['action'] ) && 'trash' == strtolower( $_GET['action'] ) ) {
				
				wp_redirect( $_SERVER['HTTP_REFERER'] );
				exit;
			
			// Otherwise, they are on the post edit page so they should be able to see the message.
			} else {
			
				echo '<div id="standard-gcse-template-notification" class="updated"><p>' . __( 'This page was generated by Standard for use with the Google Custom Search widget. <a href="widgets.php">Remove the widget</a> from all sidebar to delete this page.', 'standard' ) . '</p></div>';	
				
			} // end if
				
		} // end if		

	} // end existing_search_results_template
	
	/**
	 * Determines if were on the page specified by the incoming filename.
	 *
	 * @param	string	$page_file_name	The name of hte file (i.e., widgets.php) to evaluate
	 * @return	boolean	Whether or not we are on the specified page.
	 * @since	3.2
	 * @version	3.2
	 */
	private function is_page( $page_file_name ) {
		return 0 < strpos( $_SERVER['REQUEST_URI'], $page_file_name );
	} // end is_widgets_page
	
	/**
	 * Retrieves the content of the template file from the incoming URL.
	 *
	 * @param	string	$url		The URL of the template
	 * @returns	content	$template	The content of the template
	 * @since	3.0
	 * @version	3.2
	 */
	private function get_template_content( $url ) {
		
		$template = null;
		
		// First, check to see if curl is enabled. If so, we'll use it.
		if( function_exists( 'curl_init' ) ) {
			$template = $this->curl( $url );
		} elseif( function_exists( 'file_get_contents' ) ) {
			$template = $this->file_get_contents( $url );
		} // end if
		
		return $template;
		
	} // end get_template
	
	/**
	 * Retrieves the response from the specified URL using one of PHP's outbound request facilities.
	 *
	 * @params	$url	The URL of the feed to retrieve.
	 * @returns			The response from the URL; null if empty.
	 */
	private function get_feed_response( $url ) {
		
		$response = null;
		
		// First, check to see if curl is enabled. If so, we'll use it.
		if( function_exists( 'curl_init' ) ) {
			$response = $this->curl( $url );
		} elseif( function_exists( 'file_get_contents' ) ) {
			$response = $this->file_get_contents( $url );
		} // end if
		
		return $response;
		
	} // end get_feed_response
	
	/**
	 * Retrieves the response from the specified URL using PHP's cURL module.
	 *
	 * @params	$url	The URL of the feed to retrieve.
	 * @returns			The response from the URL.
	 */
	private function curl( $url ) {

		$curl = curl_init( $url );

		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_HEADER, false );
		curl_setopt( $curl, CURLOPT_USERAGENT,  '' );
		
		// Increasing the TIMEOUT in hopes that it works better for some hosting environments
		curl_setopt( $curl, CURLOPT_TIMEOUT, 10000 );
		
		$response = curl_exec( $curl );
		if( 0 !== curl_errno( $curl ) || 200 !== curl_getinfo( $curl, CURLINFO_HTTP_CODE ) ) {
			$response = null;
		} // end if
		curl_close( $curl );
		
		return $response;
		
	} // end curl
	
	/**
	 * Retrieves the response from the specified URL using PHP's file_get_contents method.
	 *
	 * @params	$url	The URL of the feed to retrieve.
	 * @returns			The response from the URL.
	 */
	private function file_get_contents( $url ) {
		return file_get_contents( $url );
	} // end file_get_contents
	
	/**
	 * Determines if the current hosting platform supports curl or file_get_contents for making outbound requests.
	 *
	 * @returns		True if the server supports outbound requests; false, otherwise.
	 */
	private function supports_outbound_requests() {
		return function_exists( 'curl_init' ) || function_exists( 'file_get_contents' );
	} // end supports_outbound_requests

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Google_Custom_Search" );' ) ); 