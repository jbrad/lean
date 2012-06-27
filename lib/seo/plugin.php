<?php

/**
 * Standard SEO guides publishers in defining SEO-friendly title, permalinks, and
 * meta descriptions by giving custom fields at the post and page level and by
 * providing a "what Google sees" preview.
 *
 * version 1.0
 */
class Standard_SEO {
	 
	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/
	
	/**
	 * Initializes the plugin by setting filters
	 */
	function __construct() {
	
		add_action( 'admin_print_styles', array( &$this, 'admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'admin_scripts' ) );
		
	    add_action( 'add_meta_boxes', array( &$this, 'seo_meta_boxes' ) );
	    add_action( 'save_post', array( &$this, 'save_postdata' ) );
	    
	} // end constructor
	
	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/
	
	/**
 	 * Adds the Standard SEO meta box to the post and page screens in the dashboard.
	 */
	public function seo_meta_boxes() {

		add_meta_box(
			'post_level_seo',
			__( 'Standard SEO', 'standard' ),
			array( &$this, 'post_level_display' ),
			'post',
			'normal',
			'high'
		);

		add_meta_box(
			'post_level_seo',
			__( 'Standard SEO', 'standard' ),
			array( &$this, 'post_level_display' ),
			'page',
			'normal',
			'high'
		);

	} // end action_method_name
	
	/**
	 * Renders the actual Standard SEO Preview meta box and preview area to the page. 
	 *
	 * @params	$post	The post on which the box should be rendered.
	 */
	public function post_level_display( $post ) {

		wp_nonce_field( plugin_basename( __FILE__ ), 'standard_seo_nonce' );
	
		$html = '<div id="search-engine-preview">';
			
			$html .= '<p id="search-results-title"><span id="post-title"></span>' . __( ' - ', 'standard' ) . '<span id="blog-title"></span></p>';
			$html .= '<p id="search-results-meta"><span id="permalink"></span></p>';
			$html .= '<p id="search-results-meta-description"><span id="date">Date</span> - <span id="description">' . get_post_meta( $post->ID, 'standard_seo_post_meta_description', true ) . '</span></p>';
			$html .= '<span id="site-title" class="hidden">' . get_bloginfo( 'title' ) . '</span>';
			$html .= '<span id="todays-date" class="hidden">' . date( get_option( 'date_format' ) ) . '</span>';
			
		$html .= '</div><!-- /#search-engine-preview -->';
		
		$html .= '<div id="meta-description-container">';
		
			// The label for the meta description
			$html .= '<p>' . __( 'Meta Description: ', 'standard' ) . '</p>';
			
			// The input field for the meta description
			$html .= '<textarea id="standard_seo_post_meta_description" name="standard_seo_post_meta_description" maxlength="140">' . get_post_meta( $post->ID, 'standard_seo_post_meta_description', true ) . '</textarea>';
			
			// The description for the field
			$html .= '<div id="standard-seo-description-wrapper">';
				$html .= '<p class="description">';
					$html .= __( 'The meta description is limited to 140 characters. If not provided, no description will be added to the page.', 'standard' );
					$html .= '&nbsp;<span id="character-count">' . __( '140', 'standard' ) . '</span>' . __( ' characters remaining.', 'standard' );
				$html .= '</p>';
			$html .= '</div><!-- /#standard-seo-description-wrapper -->';
		
		$html .= '</div><!-- /#meta-description-container -->';
		
		echo $html;
		
	} // end post-Level_display
	
	/**
	 * Saves the post data to post defined by the incoming ID.
	 *
	 * @params	$post_id	The ID of the post to which we're saving the post data.
	 */
	public function save_postdata( $post_id ) {
		
		if( isset( $_POST['standard_seo_nonce'] ) ) {
		
			// Don't save if the user hasn't submitted the changes
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			} // end if
			
			// Verify that the input is coming from the proper form
			if( ! wp_verify_nonce( $_POST['standard_seo_nonce'], plugin_basename( __FILE__ ) ) ) {
				return;
			} // end if
			
			// Make sure the user has permissions to post
			if( 'post' == $_POST['post_type']) {
				if( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				} // end if
			} // end if/else
			
			// Read the meta description
			$meta_description = $_POST['standard_seo_post_meta_description'];

			// Delete the data if it exists. I don't want to add extra rows to the table.
			if( 0 == count( get_post_meta( $post_id, 'standard_seo_post_meta_description' ) ) ) {
				delete_post_meta( $post_id, 'standard_seo_post_meta_description' );
			} // end if

			// Update it for this post
			update_post_meta( $post_id, 'standard_seo_post_meta_description', $meta_description );

		} // end if
			
	} // end save_postdata
  
	/*--------------------------------------------*
	 * Helper Functions
	 *---------------------------------------------*/
	
	/**
	 * Registers and enqueues stylesheets for the administration panel.
	 */
	public function admin_styles() {
	
		wp_register_style( 'standard-seo-admin', get_template_directory_uri() . '/lib/seo/css/admin.css' );
		wp_enqueue_style( 'standard-seo-admin' );

	} // end admin_styles
	
	/**
	 * Registers and enqueues JavaScript sources for the administration panel.
	 */
	public function admin_scripts() {
	
		$screen = get_current_screen();
		
		if( 'post' == $screen->id || 'page' == $screen->id ) { 
		
			wp_register_script( 'standard-seo-admin', get_template_directory_uri() . '/lib/seo/js/admin.js' );
			wp_enqueue_script( 'standard-seo-admin' );
			
		} // end if 

	} // end admin_scripts
  
} // end class
new Standard_SEO();
?>