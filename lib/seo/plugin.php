<?php

/**
 * SEO guides publishers in defining SEO-friendly title, permalinks, and
 * meta descriptions by giving custom fields at the post and page level and by
 * providing a "what Google sees" preview.
 *
 * @package		lean
 * @subpackage	SEO
 * @version		1.0
 * @since		1.0
 */
class SEO {

	/*--------------------------------------------*
	 * Constructor
	 *--------------------------------------------*/

	/**
	 * Initializes the widget's classname, description, and JavaScripts.
	 */
	function __construct() {

		add_action( 'admin_print_styles', array( $this, 'admin_styles' ) );

	    add_action( 'add_meta_boxes', array( $this, 'seo_meta_boxes' ) );
	    add_action( 'save_post', array( $this, 'save_postdata' ) );

	} // end constructor

	/*--------------------------------------------*
	 * Core Functions
	 *---------------------------------------------*/

	/**
 	 * Adds the SEO meta box to the post and page screens in the dashboard.
 	 *
	 * @since	1.0
	 * @version	1.1
	 */
	public function seo_meta_boxes() {

		add_meta_box(
			'post_level_seo',
			__( 'SEO', TRANSLATION_KEY ),
			array( &$this, 'post_level_display' ),
			'post',
			'normal',
			'high'
		);

		add_meta_box(
			'post_level_seo',
			__( 'SEO', TRANSLATION_KEY ),
			array( &$this, 'post_level_display' ),
			'page',
			'normal',
			'high'
		);

	} // end action_method_name

	/**
	 * Renders the actual SEO Preview meta box and preview area to the page.
	 *
	 * @params	object $post	The post on which the box should be rendered.
	 * @since	1.0
	 * @version	1.1
	 */
	public function post_level_display( $post ) {

		wp_nonce_field( plugin_basename( __FILE__ ), 'seo_nonce' );

		$html = '<p>' . __( 'Search Results Preview ', TRANSLATION_KEY ) . '</p>';
		$html .= '<div id="search-engine-preview">';

			$html .= '<p id="search-results-title"><span id="post-title"></span>' . ' ' . __( '|', TRANSLATION_KEY ) . ' ' . '<span id="blog-title"></span></p>';
			$html .= '<p id="search-results-meta"><span id="permalink"></span></p>';

			// Look to see if the user has the Google Profile URL specified
			$current_user = wp_get_current_user();
			if( '' != get_user_meta( $current_user->ID, 'google_plus', true ) ) {

				// Determine if the user is using a gplus.to address
				$google_plus_url = user_trailingslashit( get_user_meta( $current_user->ID, 'google_plus', true ) );
				if( is_gplusto_url ( $google_plus_url ) ) {

					$google_plus_url = get_google_plus_from_gplus( $google_plus_url );

					// Read the URL into an array
					$google_plus_id = explode( '/',  trailingslashit( $google_plus_url ) );

					// Note the third index of this array should always be at 3 after user_trailingslashit
					$google_plus_id = isset( $google_plus_id[3] ) ? $google_plus_id[3] : $google_plus_id[1];

				// The user isn't using gplus.to, so the index of the ID is different
				} else {

					// Read the URL into an array
					$google_plus_id = explode( '/',  trailingslashit( $google_plus_url ) );

					// Note the third index of this array should alwas be at 5 after user_trailingslashit
					$google_plus_id = $google_plus_id[3];

				} // end if/else

				// Now create the element
				$html .= '<p id="google-plus-avatar">';
					$html .= '<img src="https://profiles.google.com/s2/photos/profile/' . $google_plus_id . '" alt="" width="44" height="44" />';
				$html .= '</p>';

			} // end if

			$html .= '<p id="search-results-meta-description"><span id="date">Date</span> - <span id="description">' . get_post_meta( $post->ID, 'seo_post_meta_description', true ) . '</span></p>';
			$html .= '<span id="site-title" class="hidden">' . get_bloginfo( 'name' ) . '</span>';
			$html .= '<span id="todays-date" class="hidden">' . date( get_option( 'date_format' ) ) . '</span>';

		$html .= '</div><!-- /#search-engine-preview -->';

		$html .= '<div id="meta-description-container">';

			// The label for the meta description
			$html .= '<p>' . __( 'Meta Description ', TRANSLATION_KEY ) . '(<span id="character-count">' . __( '140', TRANSLATION_KEY ) . '</span>' . ' ' . __( 'characters remaining)', TRANSLATION_KEY );'</p>';

			// The input field for the meta description
			$html .= '<textarea id="seo_post_meta_description" name="seo_post_meta_description" maxlength="140">' . get_post_meta( $post->ID, 'seo_post_meta_description', true ) . '</textarea>';

			// The description for the field
			$html .= '<p class="description">';
				$html .= __( 'Writing a meta description for every post is strongly recommended for SEO. If not provided, no description will be published.', TRANSLATION_KEY );
			$html .= '</p>';

		$html .= '</div><!-- /#meta-description-container -->';

		echo $html;

	} // end post-Level_display

	/**
	 * Saves the post data to post defined by the incoming ID.
	 *
	 * @params	int $post_id	The ID of the post to which we're saving the post data.
	 * @since	1.0
	 * @version	1.1
	 */
	public function save_postdata( $post_id ) {

		if( isset( $_POST['seo_nonce'] ) ) {

			// Don't save if the user hasn't submitted the changes
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
				return;
			} // end if

			// Verify that the input is coming from the proper form
			if( ! wp_verify_nonce( $_POST['seo_nonce'], plugin_basename( __FILE__ ) ) ) {
				return;
			} // end if

			// Make sure the user has permissions to post
			if( 'post' == $_POST['post_type']) {
				if( ! current_user_can( 'edit_post', $post_id ) ) {
					return;
				} // end if
			} // end if/else

			// Read the meta description
			$meta_description = $_POST['seo_post_meta_description'];

			// Delete the data if it exists. I don't want to add extra rows to the table.
			if( 0 == count( get_post_meta( $post_id, 'seo_post_meta_description' ) ) ) {
				delete_post_meta( $post_id, 'seo_post_meta_description' );
			} // end if

			// Update it for this post
			update_post_meta( $post_id, 'seo_post_meta_description', $meta_description );

		} // end if

	} // end save_postdata

	/*--------------------------------------------*
	 * Helper Functions
	 *---------------------------------------------*/

	/**
	 * Registers and enqueues stylesheets for the administration panel.
	 *
	 * @since	1.0
	 * @version	1.1
	 */
	public function admin_styles() {
		wp_enqueue_style( 'seo-admin', get_template_directory_uri() . '/lib/seo/css/admin.css', false, THEME_VERSION );
	} // end admin_styles

} // end class
new SEO();