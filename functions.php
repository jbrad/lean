<?php

include_once( get_template_directory() . '/lib/Standard_Nav_Walker.class.php' );

/*
/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\/\ CONTENTS /\/\/\/\/\/\/\/\/\/\/\/\/\/\//\/\/\/\

	1. Localization
	2. Theme Settings
		- Menu Page
		- Layout Options
		- Social Options
		- Options Page
	3. Features
	4. Custom Header
	5. Comments Template
	6. Stylesheet and JavaScript Sources
	7. Custom Filters
	8. Helper Functions
*/

/* ----------------------------------------------------------- *
 * 1. Localization
 * ----------------------------------------------------------- */

/**
 * Defines the path to the localization files for Standard.
 */
function standard_set_theme_localization() {
	load_theme_textdomain( 'standard', get_template_directory() . '/lang' );
} // set_theme_localization
add_action( 'after_setup_theme', 'standard_set_theme_localization' );

/* ----------------------------------------------------------- *
 * 2. Theme Settings
 * ----------------------------------------------------------- */

/* ----------------------------- *
 * Menu Page
 * ----------------------------- */

/** 
 * Adds the Standard Theme options menu to the 'Appearance' menu.
 */
function standard_theme_menu() {

	add_theme_page(
		__( 'Standard', 'standard' ),
		__( 'Theme Options', 'standard' ),
		'administrator',
		'theme_options',
		'standard_theme_options_display'
	);

} // end standard_theme_menu
add_action( 'admin_menu', 'standard_theme_menu' );

/* ----------------------------- *
 * Layout Options
 * ----------------------------- */

/**
 * Provides a default value for the Standard Theme layout setting.
 */
function get_standard_theme_default_layout_options() {

	$defaults = array(
		'layout' => 'right_sidebar_layout'
	);
	
	return apply_filters ( 'standard_theme_default_layout_options', $defaults );

} // end standard_theme_default_options
  
/**
 * Defines Standard's layout options.
 */
function standard_setup_theme_layout_options() {

	// If the layout options don't exist, create them.
	if( false == get_option( 'standard_theme_layout_options' ) ) {	
		add_option( 'standard_theme_layout_options', apply_filters( 'standard_theme_default_layout_options', get_standard_theme_default_layout_options() ) );
	} // end if
	
	add_settings_section(
		'layout',
		__( 'Layout', 'standard' ),
		'standard_theme_layout_options_display',
		'standard_theme_layout_options'
	);

	add_settings_field(
		'left_sidebar_layout',
		__( 'Left Sidebar', 'standard' ),
		'left_sidebar_layout_display',
		'standard_theme_layout_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-left.gif'
		)
	);

	add_settings_field(
		'right_sidebar_layout',
		__( 'Right Sidebar', 'standard' ),
		'right_sidebar_layout_display',
		'standard_theme_layout_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-right.gif'
		)
	);
	
	add_settings_field(
		'full_width_layout',
		__( 'No Sidebar / Full Width', 'standard' ),
		'full_width_layout_display',
		'standard_theme_layout_options',
		'layout',
		array(
			'option_image_path' => get_template_directory_uri() . '/images/layout-full.gif'
		)
	);
	
	// Note there's no sanitization for this setting because they consist only of radio buttons
	register_setting(
		'standard_theme_layout_options',
		'standard_theme_layout_options',
		'standard_theme_layout_options_validate'
	);

} // end standard_setup_theme_layout_options
add_action( 'admin_init', 'standard_setup_theme_layout_options' );

/** 
 * Renders the description for the "Layout" options settings page.
 */
function standard_theme_layout_options_display() {
	_e( 'Select the layout that best fits your content.', 'standard' );	
} // end standard_theme_layout_options_display

/**
 * Renders the left-sidebar layout option.
 *
 * @params	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function left_sidebar_layout_display( $args ) {
	
	$options = get_option( 'standard_theme_layout_options' );

	$html = '<input type="radio" id="standard_theme_left_sidebar_layout" name="standard_theme_layout_options[layout]" value="left_sidebar_layout"' . checked( 'left_sidebar_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;
	
} // end left_sidebar_layout_display

/**
 * Renders the right-sidebar layout option.
 *
 * @params	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function right_sidebar_layout_display( $args ) {
	
	$options = get_option( 'standard_theme_layout_options' );
 	
	$html = '<input type="radio" id="standard_theme_right_sidebar_layout"  name="standard_theme_layout_options[layout]" value="right_sidebar_layout"' . checked( 'right_sidebar_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;
	
} // end right_sidebar_layout_display

/**
 * Renders the full width layout option.
 *
 * @params	$args	The array of options used for rendering the option. Includes a path to the option's image.
 */
function full_width_layout_display( $args ) {

	$options = get_option( 'standard_theme_layout_options' );
 	
	$html = '<input type="radio" id="standard_theme_full_width_layout"  name="standard_theme_layout_options[layout]" value="full_width_layout"' . checked( 'full_width_layout', $options['layout'], false ) . ' />';
	$html .= '<img src="' . esc_url ( $args['option_image_path'] ) . '" alt="" />';
	
	echo $html;

} // end full_width_layout_display

/**
 * Sanitization callback for the layout options. Since each of the layout options are checkboxes,
 * this function loops through the incoming options and verifies they are either empty strings
 * or the number 1.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function standard_theme_layout_options_validate( $input ) {
	
	$output = $defaults = get_standard_theme_default_layout_options();
	
	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) && $input[$key] == 'left_sidebar_layout' || $input[$key] == 'right_sidebar_layout' || $input[$key] == 'full_width_layout' ) {
			$output[$key] = $input[$key];
		} // end if	
	
	} // end foreach
	
	return apply_filters( 'standard_theme_layout_options_validate', $output, $input, $defaults );

} // end standard_theme_layout_options_validate

/* ----------------------------- *
 * 	Social Options
 * ----------------------------- */

/**
 * Defines the default values for Standard's social options.
 */
function get_standard_theme_default_social_options() {

	$defaults = array(
		'twitter'			=> '',
		'facebook'			=> '',
		'google_plus'		=> '',
		'pinterest'			=> '',
		'vimeo'				=> '',
		'youtube'			=> '',
		'rss' 				=> 'on'
	);
	
	return apply_filters ( 'standard_theme_default_social_options', $defaults );

} // end get_standard_theme_default_social_options

/**
 * Defines Standard's "social" options.
 */
function standard_setup_theme_social_options() {

	// If the theme options don't exist, create them.
	if( false == get_option( 'standard_theme_social_options' ) ) {	
		add_option( 'standard_theme_social_options', apply_filters( 'standard_theme_default_social_options', get_standard_theme_default_social_options() ) );
	} // end if

	/* ------------------ Social Networks ------------------ */
	
	add_settings_section(
		'social',
		__( 'Social Options', 'standard' ),
		'standard_theme_social_options_display',
		'standard_theme_social_options'
	);
	
	add_settings_field(
		'twitter',
		__( 'Twitter', 'standard' ),
		'standard_social_option_display',
		'standard_theme_social_options',
		'social',
		array(
			'option_name' 		=> 'twitter',
			'option_image_path' => get_template_directory_uri() . '/images/social/small/twitter.png'
		)
	);
	
	add_settings_field(
		'facebook',
		__( 'Facebook', 'standard' ),
		'standard_social_option_display',
		'standard_theme_social_options',
		'social',
		array(
			'option_name' 		=> 'facebook',
			'option_image_path' => get_template_directory_uri() . '/images/social/small/facebook.png'
		)
	);
	
	add_settings_field(
		'google_plus',
		__( 'Google+', 'standard' ),
		'standard_social_option_display',
		'standard_theme_social_options',
		'social',
		array(
			'option_name' 		=> 'google_plus',
			'option_image_path' => get_template_directory_uri() . '/images/social/small/google_plus.png'
		)
	);
	
	add_settings_field(
		'pinterest',
		__( 'Pinterest', 'standard' ),
		'standard_social_option_display',
		'standard_theme_social_options',
		'social',
		array(
			'option_name' 		=> 'pinterest',
			'option_image_path' => get_template_directory_uri() . '/images/social/small/pinterest.png'
		)
	);
	
	add_settings_field(
		'vimeo',
		__( 'Vimeo', 'standard' ),
		'standard_social_option_display',
		'standard_theme_social_options',
		'social',
		array(
			'option_name' 		=> 'vimeo',
			'option_image_path' => get_template_directory_uri() . '/images/social/small/vimeo.png'
		)
	);
	
	add_settings_field(
		'youtube',
		__( 'YouTube', 'standard' ),
		'standard_social_option_display',
		'standard_theme_social_options',
		'social',
		array(
			'option_name' 		=> 'youtube',
			'option_image_path' => get_template_directory_uri() . '/images/social/small/youtube.png'
		)
	);
	
	register_setting(
		'standard_theme_social_options',
		'standard_theme_social_options',
		'standard_theme_social_options_validate'
	);

} // end standard_setup_theme_social_options
add_action( 'admin_init', 'standard_setup_theme_social_options' );

/** 
 * Renders the description for the "Social" options settings page.
 */
function standard_theme_social_options_display() {
	_e( 'To display an icon in the header for each social network below, add the full URL to the associated profile.', 'standard' );
} // end standard_theme_social_options_display

/**
 * Provides functionality for rendering each of the social options. This one function is used for each option because the 
 * major of the options are text inputs. Others, which are defined by the 'option_name' ID, are rendered conditionally.
 *
 * @params	$args	The option's name, description, and optional image path.
 */
function standard_social_option_display($args) {
	
	$options = get_option( 'standard_theme_social_options' );
	
	$url = '';
	if( true == isset ( $options[ $args['option_name'] ] ) ) {
		$url = $options[$args['option_name']];
	} // end if
	
	$html = '<input type="text" id="' . $args['option_name'] . '" name="standard_theme_social_options[' . $args['option_name'] . ']" value="' . esc_attr( $url ) . '" />';
	$html .= '<img src="' . esc_url( $args['option_image_path'] ) . '" alt="' . esc_attr( ucwords( $args['option_name'] ) ) . '" class="social_option" />';
	
	echo $html;
	
} // end standard_social_option_display

/**
 * Sanitization callback for the social options. Since each of the social options are text inputs,
 * this function loops through the incoming option and strips all tags and slashes from the value
 * before serializing it.
 *	
 * @params	$input	The unsanitized collection of options.
 *
 * @returns			The collection of sanitized values.
 */
function standard_theme_social_options_validate( $input ) {
	
	$output = $defaults = get_standard_theme_default_social_options();

	foreach( $input as $key => $val ) {
	
		if( isset ( $input[$key] ) ) {
			$output[$key] = esc_url_raw( strip_tags( stripslashes( $input[$key] ) ) );
		} // end if	
	
	} // end foreach
	
	return apply_filters( 'standard_theme_social_options_validate', $output, $input, $defaults );

} // end standard_theme_options_validate

/* ----------------------------- *
 * 	Options Page
 * ----------------------------- */

/**
 * Renders the theme options display page.
 */
function standard_theme_options_display() {
?>	
	<div class="wrap">
	
		<div id="icon-themes" class="icon32"></div>
		<h2><?php _e( 'Standard Options', 'standard' ); ?></h2>
		<?php settings_errors(); ?>
		
		<?php $active_tab = isset( $_GET['tab'] ) ? $_GET['tab'] : 'standard_theme_layout_options'; ?>
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_layout_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_layout_options"><?php _e( 'Layout', 'standard' ); ?></a>
			<a class="nav-tab <?php echo $active_tab == 'standard_theme_social_options' ? 'nav-tab-active' : ''; ?>" href="?page=theme_options&amp;tab=standard_theme_social_options"><?php _e( 'Social Options', 'standard' ); ?></a>
		</h2>

		<form method="post" action="options.php">
			<?php

				if( 'standard_theme_layout_options' == $active_tab ) {
				
					settings_fields( 'standard_theme_layout_options' );
					do_settings_sections( 'standard_theme_layout_options' );
				
				} else {
				
					settings_fields( 'standard_theme_social_options' );
					do_settings_sections( 'standard_theme_social_options' );
				
				} // end if/else
				
				submit_button();
			?>
		</form>
	</div><!-- /.wrap -->
<?php
} // end standard_theme_options_display

/* ----------------------------------------------------------- *
 * 3. Features
 * ----------------------------------------------------------- */

/**
 * Adds a custom class to the wp_page_menu when users don't set an active menu.
 * 
 * @param	ulclass		The classname for the menu
 *
 * @returns	The markup for the unordered list.
 */
function standard_page_menu( $ulclass ) {
	return preg_replace( '/<ul>/', '<ul class="nav nav-menu">', $ulclass, 1 );
} // end standard_default_menu
add_filter( 'wp_page_menu', 'standard_page_menu' );
 
/**
 * Adds custom background support.
 */
function standard_add_theme_background() {
	add_custom_background();
} // end standard_add_theme_background
add_action( 'init', 'standard_add_theme_background' );

/**
 * Includes the post editor stylesheet.
 */
function standard_add_theme_editor_style() {
	
	add_editor_style( 'css/editor-style.css' );
	
	$options = get_option( 'standard_theme_layout_options' );
	if( 'full_width_layout' == $options['layout'] ) {
		add_editor_style( 'css/editor-style-full.css' );
	} // end if

} // end standard_add_theme_editor_style
add_action( 'init', 'standard_add_theme_editor_style' );

/**
 * Adds three menu areas: above the logo, below the logo, and in the footer.
 */
function standard_add_theme_menus() {

	register_nav_menus(
		array(
			'menu_above_logo' 	=> __( 'Menu Above Logo', 'standard' ),
			'menu_below_logo' 	=> __( 'Menu Below Logo', 'standard' ),
			'footer_menu' 		=> __( 'Footer Menu', 'standard' )
		)
	);

} // end add_theme_menu
add_action( 'init', 'standard_add_theme_menus' );

/**
 * Adds four widgetized areas: the sidebar, the left footer, center footer, and right footer.
 */
function standard_add_theme_sidebars() {

	// main
	register_sidebar(
		array(
			'name' 			=> __( 'Sidebar', 'standard' ),
			'id' 			=> 'sidebar-1',
			'description'	=> __( 'The primary sidebar.', 'standard' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);
	
	// footer left
	register_sidebar(
		array(
			'name' 			=> __( 'Footer Left', 'standard' ),
			'id' 			=> 'sidebar-2',
			'description'	=> __( 'Shown in the first column of the footer.', 'standard' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);
	
	// footer center
	register_sidebar(
		array(
			'name' 			=> __( 'Footer Center', 'standard' ),
			'id' 			=> 'sidebar-3',
			'description'	=> __( 'Shown in the second column of the footer.', 'standard' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);
	
	// footer right
	register_sidebar(
		array(
			'name' 			=> __( 'Footer Right', 'standard' ),
			'id' 			=> 'sidebar-4',
			'description'	=> __( 'Shown in the third column of the footer.', 'standard' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);
	
} // end add_theme_sidebars
add_action( 'widgets_init', 'standard_add_theme_sidebars' );

/**
 * Adds support for Post Formats, Post Thumbnails, Activity Tabs widget
 * Custom Image Sizes for post formats.
 */
function standard_add_theme_features() {

	// enable select post formats
	add_theme_support( 
		'post-formats',
		array(
			'status',
			'image',
			'link',
			'quote',
			'video'
		)
	);
	
	// post thumbnail support
	add_theme_support( 'post-thumbnails' );

	if( ! in_array( get_template_directory() . '/lib/activity/standard_popularity.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		include_once( get_template_directory() . '/lib/activity/widget.php' );
	} // end if

} // end add_theme_features
add_action( 'after_setup_theme', 'standard_add_theme_features' );

/*
 * Sets the media embed width to 580 or 900 (based on the layout) which is optimized 
 * for the theme's post size.
 */
function standard_set_media_embed_size() {

	$options = get_option( 'standard_theme_layout_options' );
	if( 'full_width_layout' == $options['layout'] ) {
	
		if ( isset( $content_width ) ) {
			$content_width = 900;
		} // end if 
	
	} else {
	
		if ( isset( $content_width ) ) {
			$content_width = 580;
		} // end if
	
	} // end if/else

} // end set_media_embed_size
add_action( 'init', 'standard_set_media_embed_size' );

/**
 * Sets the values for the default color scheme of Standard for use
 * in other plugins.
 */
function standard_set_theme_colors() {

	$themecolors = array(
		'bg' 		=> 'efefef',
		'border' 	=> 'eeeeee',
		'text' 		=> '333333',
		'link' 		=> '4D8B97',
		'url' 		=> '4D8B97',
	);

} // end standard_set_theme_colors
add_action( 'init', 'standard_set_theme_colors' );

/* ----------------------------------------------------------- *
 * 4. Custom Header
 * ----------------------------------------------------------- */
 
// The default header text color 
define( 'HEADER_TEXTCOLOR', '000' ); 

// Remove support for header text
define( 'NO_HEADER_TEXT', false );

// Height and width of your custom header.
define( 'HEADER_IMAGE_WIDTH', 940 ); 
define( 'HEADER_IMAGE_HEIGHT', 250 );

// Random header on by default
add_theme_support( 'custom-header');

// Add Custom header in admin
add_custom_image_header( 'standard_header_style', 'standard_admin_header_style', 'standard_admin_header_image' );

// Feedlinks
add_theme_support( 'automatic-feed-links' );

/**
 * Styles the default header.
 */
function standard_header_style() { 
	if ( HEADER_TEXTCOLOR != get_header_textcolor() ) { ?>
		<style type="text/css">
			<?php if ( 'blank' == get_header_textcolor() ) { ?>
				#site-title,
				#site-description,
				#logo {
					position: absolute !important;
					clip: rect(1px 1px 1px 1px);
					clip: rect(1px, 1px, 1px, 1px);
				}
			<?php } else { ?>
				#site-title a,
				#site-description {
					color: #<?php echo get_header_textcolor(); ?> !important;
				}
			<?php } // end if ?>		
		</style>
	<?php
	} // end if 
} // end header_style

/**
 * Styles the default header in the admin dashboard.
 */
function standard_admin_header_style() { ?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
			font-family: "Helvetica Neue", Arial, Helvetica, "Nimbus Sans L", sans-serif;
		}
		#headimg h1 {
			margin: 0;
		}
		#headimg h1 a {
			font-size: 32px;
			line-height: 36px;
			text-decoration: none;
		}
		#desc {
			font-size: 14px;
			line-height: 23px;
			padding: 0 0 3em;
			color: #7A7A7A !important;
		
		}
		#headimg img {
			max-width: 1000px;
			height: auto;
			width: 100%;
		}
		.float {
			float: left;
			position: relative;
			width: 100%;
		}
		
		#header-top {
			z-index: 2;
		}
		
		#header-bottom {
			z-index: 1;
		}
	</style>
<?php
} // admin_header_style

/**
 * Marks and styles the header image in the admin dashboard.
 */
function standard_admin_header_image() { ?>
	<div id="headimg">
		<?php $header_image = get_header_image();

		if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) ) { 
			$style = ' style="display:none;"'; 
		} else { 
			$style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"'; 
		} // end if/else ?>
   
   		<div id="header-top" class="float">
			<h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1> 
			<div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div> 
		</div>
		
		<?php if ( ! empty( $header_image ) ) { ?>
			<div id="header-bottom" class="float">
				<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
			</div>
		<?php } // end if ?>
		
	</div><!-- /#headimg -->
<?php } // admin_header_image 
 
/* ----------------------------------------------------------- *
 * 5. Comments Template
 * ----------------------------------------------------------- */
  
 /**
 * Generates the content container for each post (and page if enabled).
 *
 * @comment	The current comment being displayed.
 * @args	Array containing arguments for displaying the comment.
 * @depth	The depth of where this comment falls in the tree.
 */
  
function custom_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID(); ?>">
		<div class="comment-container">
			<?php if ( "comment" == get_comment_type() ) { ?>
				<div class="avatar-holder">
					<?php 
					$default = null;
					if( get_comment_author_email() == get_the_author_meta( 'user_email' ) ) {
						$default = get_the_author_meta( 'user_email' );
					} else {
						$default = get_comment_author_email();
					} // end if/else
					echo get_avatar( $default, '50' );
					?>
				</div><!-- /.avatar-holder -->
			<?php } // end if ?>	
			
			<div class="comment-entry"	id="comment-<?php comment_ID(); ?>">
			
				<div class="comment-head">
					<span class="name"><?php comment_author_link(); ?></span>
					<?php if ( get_comment_type() == "comment" ) { ?>
						<span class="date"><a href="<?php echo get_comment_link(); ?>" title="<?php esc_attr_e( 'Permalink', 'standard'); ?>"><?php printf( __( '%1$s at %2$s', '_s' ), get_comment_date( get_option( 'date_format' ) ), get_comment_time( get_option( 'time_format' ) ) ); ?></a></span>
						<span class="edit"><?php edit_comment_link( __( 'Edit', 'standard' ), '', '' ); ?></span>
					<?php } // end if ?>
				</div><!-- /.comment-head -->
				
				<?php if ( '0' == $comment->comment_approved ) { ?>
					<span class='unapproved label warning'>
						<?php _e( 'Your comment will appear after being approved.', 'standard' ); ?>
					</span>
				<?php } // end if ?>
				
				<div class="comment-text">
					<?php comment_text(); ?>
				</div><!-- /.comment-text -->
				
				<div class="reply">
					<?php 
						comment_reply_link( 
							array_merge( 
								$args, 
								array(
									'depth' 		=> $depth, 
									'max_depth' 	=> $args['max_depth'], 
									'reply_text' 	=> __( 'Reply', 'standard') 
								) 
							) 
						); 
						?>
				</div><!-- /.reply -->
				
			</div><!-- /.comment-entry -->
		</div><!-- /comment-container -->
<?php } // end custom_comment

/**
 * Generates the list of pings for the given post.
 *
 * @comment	The current ping being displayed.
 * @args	Array containing arguments for displaying the ping.
 * @depth	The depth of where this comment falls in the tree.
 */
 
function list_pings( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>
	<li id="comment-<?php comment_ID(); ?>">
		<span class="author">
			<?php comment_author_link(); ?>
		</span> -
		<span class="date">
			<?php echo get_comment_date( 'F j, Y' ); ?>
		</span>
		<span class="pingcontent">
			<?php comment_text(); ?>
		</span>
<?php } // end list_pings
 
/* ----------------------------------------------------------- *
 * 6. Stylesheets and JavaScript Sources
 * ----------------------------------------------------------- */

/**
 * Imports all theme styles and dependencies required for rendering the theme.
 */
function standard_add_theme_stylesheets() {

	// comment-reply
	if ( is_singular() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' );
	} // end if

	// bootstrap
	wp_register_style( 'bootstrap', get_template_directory_uri() . '/css/lib/bootstrap.css' );
	wp_enqueue_style( 'bootstrap' ); 

	// bootstrap-responsive
	wp_register_style( 'bootstrap-responsive', get_template_directory_uri() . '/css/lib/bootstrap-responsive.css' );
	wp_enqueue_style( 'bootstrap-responsive' ); 

	// theme
	wp_register_style( 'standard', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'standard' ); 

} // end add_theme_stylesheets
add_action( 'wp_enqueue_scripts', 'standard_add_theme_stylesheets' );


/**
 * Imports all theme scripts and dependencies required for managing the behavior of the theme.
 */
function standard_add_theme_scripts() {

	// jquery
	wp_enqueue_script( 'jquery' );
	
	// bootstrap
	wp_register_script( 'bootstrap', get_template_directory_uri() . '/js/lib/bootstrap/bootstrap.js', array( 'jquery' ) );
	wp_enqueue_script( 'bootstrap' );
	
	// fitvid		
	wp_register_script( 'fitvid', get_template_directory_uri() . '/js/lib/jquery.fitvids.js' );
	wp_enqueue_script( 'fitvid' );	
	
	// theme		
	wp_register_script( 'theme', get_template_directory_uri() . '/js/theme.js' );
	wp_enqueue_script( 'theme' );	

} // end add_theme_scripts
add_action( 'wp_enqueue_scripts', 'standard_add_theme_scripts' );

/**
 * Adds styles specifically for the administrative dashboard.
 */
function standard_add_admin_stylesheets() {

	wp_register_style( 'standard-admin', get_template_directory_uri() . '/css/admin.css' );
	wp_enqueue_style( 'standard-admin' );

} // end add_admin_stylesheets
add_action( 'admin_print_styles', 'standard_add_admin_stylesheets' );

/**
 * Adds scripts specifically for the administrative dashboard.
 */
function standard_add_admin_scripts() {

	wp_register_script( 'standard-admin', get_template_directory_uri() . '/js/admin.js' );
	wp_enqueue_script( 'standard-admin' );	

} // end add_admin_scripts
add_action( 'admin_enqueue_scripts', 'standard_add_admin_scripts' );

/* ----------------------------------------------------------- *
 * 7. Custom Filters
 * ----------------------------------------------------------- */

/** 
 * Called when no menus are active by the wp_nav_menu located above the header.
 */
function standard_fallback_nav_menu( ) {
	wp_page_menu( 'show_home=1&include=-1' );
} // end standard_fallback_nav_menu

/**
 * Removes any paragraph tags that are wrapping anchors.
 *
 * @params		$content	The post content
 * @returns					The anchor without paragraph tags.
 */
function standard_process_link_post_format_content( $content ) {

	// If this is an image post type, remove the paragraph wrapper from it.
	if( 'link' == get_post_format( get_the_ID() ) ) {
		$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	} // end if
	
	return $content;
	 
} // standard_process_link_post_format_content
add_filter( 'the_content', 'standard_process_link_post_format_content' );

/**
 * Removes any paragraph tags that are wrapping images, anchors around images,
 * or paragraphs around iframes or objects.
 *
 * @params		$title		The the of the post
 * @params		$id			The ID of the current post
 * @returns					The title based on the status of the post and the link
 */
function standard_process_link_post_format_title( $title, $id ) {
	
	if( 'link' == get_post_format( $id ) ) {
	
		// If the title has been provided, we won't do anything; otherwise, we use the content.
		if( strlen( $title ) == 0 ) {
			
			$title = standard_get_link_post_format_attribute( 'title' );
			$href = standard_get_link_post_format_attribute( 'href' );
			$target = standard_get_link_post_format_attribute( 'target' );

			global $post;
			$content = strip_tags( $post->post_content );
			
			// Now set the title
			if( strlen( $title ) == 0 ) {
				$title = $content;
			} // end if
			
		} // end if 
	
	} // end if
	
	return $title;
	
} // end standard_process_link_post_format_title
add_filter( 'the_title', 'standard_process_link_post_format_title', 10, 2 );

/**
 * Removes any paragraph tags that are wrapping images, anchors around images,
 * or paragraphs around iframes or objects.
 *
 * @params		$content	The post content
 * @returns					The [optional] anchor and image.
 */
function standard_remove_paragraph_on_media( $content ) {

	// If this is an image post type, remove the paragraph wrapper from it.
	if( 'image' == get_post_format( get_the_ID() ) ) {
		$content = preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
	} // end if

	// If this is a video post format and iframes or objects are used, we need to remove the paragraph wrappers.
	if( 'video' == get_post_format( get_the_ID() ) ) {
		if( strpos($content, 'iframe' ) > 0 ) { 
		    $content = preg_replace( '/<p>\s*(<iframe .*>*.<\/iframe>)\s*<\/p>/iU', '\1', $content );
		} elseif( strpos($content, 'object') > 0 ) {
			$content = preg_replace( '/<p>\s*(<object .*>*.<\/object>)\s*<\/p>/iU', '\1', $content );
		} // end if/else
		
	} // end if

	return $content;
		
} // end standard_remove_paragraph_on_media
add_filter( 'the_content', 'standard_remove_paragraph_on_media' );

/**
 * Wraps the video post format with a container in order to improve styling.
 *
 * @param	$html	The content of the video post format
 * @param	$url	The url of the post
 * @param	$args	Additional arguments passed in by WordPress core
 * @returns			The post content wrapped in a container.
 */
function standard_wrap_embeds( $html, $url, $args ) {
	
	if( 'video' == get_post_format( get_the_ID() ) ) {
		$html = '<div class="video-container">' . $html . '</div>';
	} // end if
	
	return $html;
	
} // end standard_wrap_embebds
add_filter( 'embed_oembed_html', 'standard_wrap_embeds', 10, 3 ) ;

/**
 * Renders a simplified version of the search form.
 *
 * @returns		The search form.
 */
function standard_search_form() {

	// Get the default text for the search form
	$query = strlen( get_search_query() ) == 0 ? __( 'Search...', 'standard' ) : get_search_query();

	// Render the form
	$form = '<form role="search" method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '">';
		$form .= '<input type="text" value="' . $query . '" name="s" id="s" />';
	$form .= '</form>';
	
	return $form;

} // end standard_search_form
add_filter( 'get_search_form', 'standard_search_form' );

/**
 * Formats the link post format properly for the RSS feed.
 *
 * @params		$content	The post content
 * @returns					The properly content formatted for RSS
 */
function standard_post_format_rss( $content ) {

	if( 'link' == get_post_format( get_the_ID() ) ) {
		
		global $post;
		$post_content = $post->post_content;
		$post_title = $post->post_title;
		
		// Read the attribute of the anchor from the post format
		$title = standard_get_link_post_format_attribute( 'title' );
		$href = standard_get_link_post_format_attribute( 'href' );
		$target = standard_get_link_post_format_attribute( 'target' );
		
		// Build up the link
		$content = '<a href="' . $href . '" title="' . $title . '" target="' . $target . '">';
		
			if( strlen( trim( $post_title ) ) > 0 ) {
				$content .= $post_title;
			} elseif( strlen( trim( $title ) ) > 0 ) {
				$content .= $title;
			} else {
				$content .= $post_content;
			} // end if/else
		
		$content .= '</a>';
		
	} // end if
	
	return $content;
		
} // end standard_post_format_rss
add_filter( 'the_content_feed', 'standard_post_format_rss' );

/**
 * Calls the Standard SEO Titles plugin during the wp_title action to render
 * SEO-friendly page titles.
 */
function standard_seo_titles() {

	include_once( get_template_directory() . '/lib/seotitles/standard_seotitles.php' );
	echo Standard_SeoTitles::get_page_title( get_the_ID() );
	
} // end standard_seo_tiltes
add_filter( 'wp_title', 'standard_seo_titles' );

/**
 * Place all widget titles in h4 tags rather than h3 tags to improve SEO. Also adds the
 * 'widget-title' class to the heading elements.
 *
 * @params	$params		The array of parameters that provide styling for the widget.
 * @returns				The updated array of parameters.
 */
function standard_modify_widget_titles( $params ) {

	$params[0]['before_title'] = '<h4 class="' . $params[0]['widget_name'] . ' widget-title">' ;
    return $params;
    
} // end standard_modify_widget_titles
add_filter( 'dynamic_sidebar_params', 'standard_modify_widget_titles' );

/**
 * Adds the title attribute to the 'Next and 'Previous' post pagination anchors.
 *
 * @params	$attrs	The current set of attributes of the anchor
 * @returns			The pagination link with the additional attribute.
 */
function standard_add_title_to_single_post_pagination( $link ) {

	if( strpos( $link, 'rel="prev"' ) > 0 ) {
	
		$previous_post = get_previous_post();
		$link = str_replace( 'rel="prev"', 'rel="prev" title="' . esc_attr( get_the_title( $previous_post->ID ) ) . '"', $link );
		
	} else if( strpos( $link, 'rel="next"' ) > 0 ) {
	
		$next_post = get_next_post();
        $link = str_replace( 'rel="next"', 'rel="next" title="' . esc_attr( get_the_title( $next_post->ID ) ) . '"', $link );
		
	} // end if/else
	
	return $link;
	
} // end standard_add_title_to_single_post_pagination
add_filter( 'next_post_link', 'standard_add_title_to_single_post_pagination' );
add_filter( 'previous_post_link', 'standard_add_title_to_single_post_pagination' );

/* ----------------------------------------------------------- *
 * 8. Helper Functions
 * ----------------------------------------------------------- */

/**
 * Determines whether or not the user is viewing a date archive.
 *
 * @returns	True if the current page is for a date archive.
 */
function standard_is_date_archive() {
	return '' != get_query_var( 'year' ) || '' != get_query_var( 'monthnum' ) || '' != get_query_var( 'day' ) || '' != get_query_var( 'm' );
} // end standard_is_date_archive

/**
 * Generates a label for the current archive based on whether or not the user is viewing year, month, or day. Uses the
 * users date format to properly format the date.
 *
 * @returns	The label for the current archive
 */
function standard_get_date_archive_label() {

	$archive_label = '';
	
	if( '' != get_query_var( 'day' ) ) {

		$archive_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, get_query_var( 'monthnum' ), get_query_var( 'day' ), get_query_var( 'year' ) ) );

	} elseif( '' != get_query_var( 'monthnum' ) ) {
	
		$archive_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, get_query_var( 'monthnum' ), 1, get_query_var( 'year' ) ) );
		
	} elseif ( '' != get_query_var( 'm' ) ) {
	
		if( strlen( get_query_var( 'm' ) ) == 6 ) {
		
			$year = substr( get_query_var( 'm' ), 0, 4 );
			$month = substr( get_query_var( 'm' ), 4, 6);
			
			$archive_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, $month, 1, $year ) );
		
		} else {

			$year = substr( get_query_var( 'm' ), 0, 4 );
			$month = substr( get_query_var( 'm' ), 4, 2);
			$day = substr( get_query_var( 'm' ), 6, 2 );
			
			$archive_label .= date( get_option( 'date_format' ), mktime(0, 0, 0, $month, $day, $year ) );
		
		} // end if/else
		
	} elseif( '' != get_query_var( 'year' ) ) {

		$archive_label .= get_query_var( 'year' );
		
	} // end if
	
	return $archive_label;

} // end standard_get_date_archive_label

/**
 * Returns the requested attribute from the link in the content based on the incoming
 * attributes.
 *
 * @param	$attr	The attribute to extract from the link.
 *
 * @returns			The value of the attribute or empty for none.
 */
function standard_get_link_post_format_attribute( $attr ) {

	// Get the post data. We aren't using helpers because this function
	// is called too early in the page lifecycle to call get_the_content
	// and get_the_title.
	global $post;
	$post_content = $post->post_content;
	$post_title = $post->post_title;

	$match = array();
	$result = '';
	switch ( strtolower( $attr )  ) {
		
		case 'title':
			preg_match( '/title=[\"]([^\'"]+)[\'"]/', $post_content, $match );
			$result = count( $match ) > 0 && $match[1] ? $match[1] : '';
			break;
			
		case 'href':
			preg_match( '/href=[\"]([^\'"]+)[\'"]/', $post_content, $match );
			$result = count( $match ) > 0 && $match[1] ? $match[1] : ''; 
			$result = strlen( $result ) == 0 ? $post_content : $result;
			break;
			
		case 'target':
			preg_match( '/target=[\"]([^\'"]+)[\'"]/', $post_content, $match );
			$result = count( $match ) > 0 && $match[0] ? $match[0] : '';
			break;
			
		default:
			$result = '';
			break;
		
	} // end switch
	
	return $result;

} // end standard_get_link_post_format_attribute