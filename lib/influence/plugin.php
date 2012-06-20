<?php
/**
 * Influence is a widget for showing an aggregate of your Twitter followers,
 * FeedBurner subscribers, and more.
 *
 * version 1.0
 */
class Standard_Influence extends WP_Widget {

	/*--------------------------------------------------------*
	 * Constructor
	 *--------------------------------------------------------*/
	 
	public function __construct() {

		$widget_opts = array(
			'classname' 	=> __( 'social-influence', 'standard' ), 
			'description' 	=> __( 'Display your social influence by showcasing FeedBurner subscriptions, Twitter followers, and Facebook fans.', 'standard' )
		);	
		$this->WP_Widget( 'standard-influence-widget', __( 'Social Influence (Standard)', 'standard' ), $widget_opts );
				
		add_action( 'admin_print_styles', array( &$this, 'register_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( &$this, 'register_admin_scripts' ) );
		
		add_action( 'wp_enqueue_scripts', array( &$this, 'register_widget_styles' ) );
		
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
		
		$twitter = empty( $instance['twitter']) ? '' : apply_filters( 'twitter', $instance['twitter'] );
		$facebook = empty( $instance['facebook']) ? '' : apply_filters( 'facebook', $instance['facebook'] );
		$feedburner = empty( $instance['feedburner']) ? '' : apply_filters( 'feedburner', $instance['feedburner'] );
		$display = empty( $instance['display']) ? '' : apply_filters( 'display', $instance['display'] );
		
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

		$instance['twitter'] = strip_tags( stripslashes( $new_instance['twitter'] ) );
		$instance['facebook'] = strip_tags( stripslashes( $new_instance['facebook'] ) );
		$instance['feedburner'] = strip_tags( stripslashes( $new_instance['feedburner'] ) );
		$instance['display'] = strip_tags( stripslashes( $new_instance['display'] ) );

		// Let's also clear the transient values
		delete_transient( 'influence_twitter_' . $instance['twitter'] );
		delete_transient( 'influence_facebook_' . $instance['facebook'] );
		delete_transient( 'influence_feedburner_' . $instance['feedburner'] );

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
				'twitter'		=>	'',
				'facebook'		=>	'',
				'feedburner'	=>	'',
				'display'		=>	'both'
			)
		);
    
		$twitter = stripslashes( strip_tags( $instance['twitter'] ) );
		$facebook = stripslashes( strip_tags( $instance['facebook'] ) );
		$feedburner = stripslashes( strip_tags( $instance['feedburner'] ) );
		$display = stripslashes( strip_tags( $instance['display'] ) );

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
	
		wp_register_style( 'standard-influence', get_template_directory_uri() . '/lib/influence/css/admin.css' );
		wp_enqueue_style( 'standard-influence' );
		
	} // end register_admin_styles

	/** 
	 * Registers and Enqueues the JavaScript sources for the Media Uploader and this widget.
	 */
	public function register_admin_scripts() {

		wp_register_script( 'standard-influence', get_template_directory_uri() . '/lib/influence/js/admin.js' );
		wp_enqueue_script( 'standard-influence' );
		
	} // end register_admin_scripts
	
	/** 
	 * Registers and Enqueues the stylesheets for this widget.
	 */
	public function register_widget_styles() {
	
		wp_register_style( 'standard-influence', get_template_directory_uri() . '/lib/influence/css/widget.css' );
		wp_enqueue_style( 'standard-influence' );
	
	} // end register_widget_styles

	/*--------------------------------------------------------*
	 * Private Functions
	 *--------------------------------------------------------*/

	/** 
	 * Retrieves the number of followers for the incoming username.
	 *
	 * The function fill first check the cache to see if it's available. If not,
	 * a request will be sent to Twitter for a JSON response. If the request or
	 * the response fails, then the follower count value will be given a negative
	 * value.
	 *
	 * Error codes:
	 * -1: Uninitialize value
	 * -2: Problem with a response from Twitter
	 * -3: Problem decoding the JSON returned from Twitter
	 *
	 * @params	$username	The username of the Twitter account from which to pull followers
	 *
	 * @returns	The total number of followers for the given Twitter account.
	 */
	private function twitter_follower_count( $username, $debug = false ) {
	
		// This value represents an uninitialized value
		$follower_count = -1;
		
		$transient_key = 'influence_twitter_' . $username;
	
		// First, we check the cache to see if it's available.
		if( ! ( $follower_count = get_transient( $transient_key ) ) ) {
		
			// If it's not available, we'll attempt to read the value from Twitter
			if( ( $response = file_get_contents( 'https://twitter.com/users/show/' . $username . '.json ' ) ) ) {
			
				// Attempt to decode the JSON response
				if( ( $twitter = json_decode( $response ) ) && isset( $twitter->followers_count ) ) {
				
					$follower_count = $twitter->followers_count;
					
					// Cache the value for 24 hours
					set_transient( $transient_key, $follower_count, 60 * 60 * 24 );
					
					// Store a last known good value so we can always pull something later
					if( $follower_count > 0 ) {
						update_option( $transient_key, $follower_count );
					} // end if
					
				} else {
				
					// This value indicates that there was a problem decoding JSON
					$follower_count = -3;
					
				} // end if/else
			
			} else {
				
				// This value indicates that there was a problem getting a response from Twitter
				$follower_count = -2;
					
			} // end if	
		
		// If it's not in the cache, try to read the last known good value
		} else {
			$follower_count = get_option( $transient_key );	
		} // end if

		// If debug mode is running, return the raw follower count; otherwise, return the value or 0 if it's an error.
		$follower_count = $debug ? $follower_count : ( $follower_count < 0 ? 0 : $follower_count );
		
		return $follower_count;

	} // end twitter_follower_count
	
	/** 
	 * Retrieves the number of likes for the incoming username.
	 *
	 * The function fill first check the cache to see if it's available. If not,
	 * a request will be sent to Facebook for a JSON response. If the request or
	 * the response fails, then the follower count value will be given a negative
	 * value.
	 *
	 * Error codes:
	 * -1: Uninitialize value
	 * -2: Problem with a response from Facebook
	 * -3: Problem decoding the JSON returned from Facebook
	 *
	 * @params	$username	The username of the Facebook page from which to pull likes
	 *
	 * @returns	The total number of likes for the given Facebook page.
	 */
	private function facebook_like_count( $username, $debug = false ) {
	
		// This value represents an uninitialized value
		$like_count = -1;
		
		$transient_key = 'influence_facebook_' . $username;

		// First, we check the cache to see if it's available.
		if( ! ( $like_count = get_transient( $transient_key ) ) ) {
		
			// If it's not available, we'll attempt to read the value from Twitter
			if( ( $response = file_get_contents( 'http://graph.facebook.com/' . $username . '/' ) ) ) {
			
				// Attempt to decode the JSON response
				if( ( $facebook = json_decode( $response ) ) && isset( $facebook->likes ) ) {
				
					$like_count = $facebook->likes;
					
					// Cache the value for 24 hours
					set_transient( $transient_key, $like_count, 60 * 60 * 24 );
					
					// Store a last known good value so we can always pull something later
					if( $like_count > 0 ) {
						update_option( $transient_key, $like_count );
					} // end if
					
				} else {
				
					// This value indicates that there was a problem decoding JSON
					$like_count = -3;
					
				} // end if/else
			
			} else {
				
				// This value indicates that there was a problem getting a response from Twitter
				$like_count = -2;
					
			} // end if	
		
		// If it's not in the cache, try to read the last known good value
		} else {
			$like_count = get_option( $transient_key );
		} // end if

		// If debug mode is running, return the raw like count; otherwise, return the value or 0 if it's an error.
		$like_count = $debug ? $like_count : ( $like_count < 0 ? 0 : $like_count );

		return $like_count;

	} // end facebook_like_count
	
	/** 
	 * Retrieves the number of subscribers for the FeedBurner feed identified by the
	 * incoming user name.
	 *
	 * The function fill first check the cache to see if it's available. If not,
	 * a request will be sent to Facebook for a JSON response. If the request or
	 * the response fails, then the follower count value will be given a negative
	 * value.
	 *
	 * Error codes:
	 * -1: Uninitialize value
	 * -2: Problem with a response from Facebook
	 * -3: Problem decoding the JSON returned from Facebook
	 * -4: Indicates that there was a problem retireving the circulation XML value.
	 *
	 * @params	$username	The username of the FeedBurner feed from which to pull subscribers
	 *
	 * @returns	The total number of subscribers for the given FeedBurner feed.
	 */
	private function feedburner_subscriber_count( $username, $debug = false ) {
	
		// This value represents an uninitialized value
		$subscriber_count = -1;
		
		$transient_key = 'influence_feedburner_' . $username;

		// First, we check the cache to see if it's available.
		if( ! ( $subscriber_count = get_transient( $transient_key ) ) ) {
		
			// If it's not available, we'll attempt to read the value from FeedBurner. We're suppressing errors since we're catching them.
			if( ( $response = @file_get_contents( 'http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri=' . $username ) ) ) {

				// Attempt to decode the XML response
				if( ( $xml = new SimpleXmlElement( $response, LIBXML_NOCDATA ) ) ) {

					if( ( $subscriber_count = (string)$xml->feed->entry['circulation'] ) ) {
					
						// Cache the value for 24 hours
						set_transient( $transient_key, $subscriber_count, 60 * 60 * 24 );
						
						// Store a last known good value so we can always pull something later
						if( $subscriber_count > 0 ) {
							update_option( $transient_key, $subscriber_count );
						} // end if
						
					} else {
					
						// This value indicates that the circulation value could not be retrieved
						$subscriber_count = -4;
						
					} // end if

				} else {
				
					// This value indicates that there was a problem decoding JSON
					$subscriber_count = -3;
					
				} // end if/else
			
			} else {
				
				// This value indicates that there was a problem getting a response from FeedBurner
				$subscriber_count = -2;
					
			} // end if	
		
		// If it's not in the cache, try to read the last known good value
		} else {
			$subscriber_count = get_option( $transient_key );	
		} // end if

		// If debug mode is running, return the raw like count; otherwise, return the value or 0 if it's an error.
		$subscriber_count = $debug ? $subscriber_count : ( $subscriber_count < 0 ? 0 : $subscriber_count );

		return $subscriber_count;	
	
	} // end feedburner_subscriber_count
	
	
	/** 
	 * Retrieves the number of subscribers for the FeedBurner feed identified by the
	 * incoming user name.
	 *
	 * @params	$twitter	The Twitter username from which to pull followers
	 * @params	$facebook	The ID of the Facebook page from which to pull likes
	 * @params	$feedburner	The FeedBurner feed from which to pull subscribers
	 *
	 * @returns	The total influence as calculated by all three services.
	 */
	private function get_total_influence_count( $twitter, $facebook, $feedburner, $debug = false ) {
	
		$influence = 0;
	
		if( '' != $twitter ) { 
			$influence += $this->twitter_follower_count( $twitter, $debug );
		} // end if
		
		if( '' != $facebook ) {
			$influence += $this->facebook_like_count( $facebook, $debug );
		} // end if
		
		if( '' != $feedburner ) { 
			$influence += $this->feedburner_subscriber_count( $feedburner, $debug );
		} // end if
	
		return $influence;
	
	} // end get_total_influence_count

} // end class
add_action( 'widgets_init', create_function( '', 'register_widget( "Standard_Influence" );' ) ); 
?>