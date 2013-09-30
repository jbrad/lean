<?php
/**
 * The template for displaying the header
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>
    <!DOCTYPE html>
    <!--[if IE 8 ]>
        <html id="ie8" <?php language_attributes(); ?>>
    <![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/html5shiv.min.js"></script>
        <script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/respond.min.js"></script>
    <![endif]-->
    <!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">

        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <title><?php wp_title( '' ); ?></title>
        <?php $presentation_options = get_option( 'lean_theme_presentation_options'); ?>
        <?php if( '' != $presentation_options['fav_icon'] ) { ?>
            <link rel="shortcut icon" href="<?php echo $presentation_options['fav_icon']; ?>" />
            <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $presentation_options['fav_icon']; ?>" />
        <?php } // end if ?>
        <?php global $post; ?>
        <?php if( using_native_seo() && ( ( is_single() || is_page() ) && ( 0 != strlen( trim( ( $google_plus = get_user_meta( $post->post_author, 'google_plus', true ) ) ) ) ) ) ) { ?>
            <?php if( false != is_gplusto_url( $google_plus ) ) { ?>
                <?php $google_plus = get_google_plus_from_gplus( $google_plus ); ?>
            <?php } // end if ?>
            <link rel="author" href="<?php echo trailingslashit( $google_plus ); ?>"/>
        <?php } // end if ?>
        <?php $global_options = get_option( 'lean_theme_global_options' ); ?>
        <?php if( '' != $global_options['google_analytics'] ) { ?>
            <?php if( is_user_logged_in() ) { ?>
                <!-- Google Analytics is restricted only to users who are not logged in. -->
            <?php } else { ?>
                <script type="text/javascript">
                    var _gaq = _gaq || [];
                    _gaq.push(['_setAccount', '<?php echo $global_options[ 'google_analytics' ] ?>']);
                    _gaq.push(['_trackPageview']);
                    _gaq.push(['_trackPageLoadTime']);

                    <?php if( 0 != strlen( $global_options[ 'google_analytics_domain'] ) ) { ?>
                    _gaq.push(['_setDomainName', '<?php echo $global_options[ 'google_analytics_domain' ] ?>']);
                    <?php } // end if/else ?>

                    <?php if( 1 == $global_options[ 'google_analytics_linker'] ) { ?>
                    _gaq.push(['_setAllowLinker', true]);
                    <?php } // end if/else ?>

                    (function() {
                        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
                        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
                    })();
                </script>
            <?php } // end if/else ?>
        <?php } // end if ?>
        <?php if( google_custom_search_is_active() ) { ?>
            <?php $gcse = get_option( 'widget_google-custom-search' ); ?>
            <?php $gcse = array_shift( array_values ( $gcse ) ); ?>
            <script type="text/javascript">
                (function() {
                    var cx = '<?php echo trim( $gcse['gcse_content'] ); ?>';
                    var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
                    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                        '//www.google.com/cse/cse.js?cx=' + cx;
                    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
                })();
            </script>
        <?php } // end if ?>
        <?php wp_head(); ?>
    </head>
<body <?php body_class(); ?>>

<?php if( is_offline() && ! current_user_can( 'manage_options' ) ) { ?>
    <?php get_template_part( 'page', 'offline-mode' ); ?>
    <?php exit; ?>
<?php } // end if ?>

<?php get_template_part( 'lib/breadcrumbs/lean_breadcrumbs' ); ?>

<?php if( has_nav_menu( 'menu_above_logo' ) ) { ?>
    <nav id="menu-above-header" class="menu-navigation navbar-inverse navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".menu-above">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse menu-above">
                    <?php
                    wp_nav_menu(
                        array(
                            'container_class'	=> 'menu-header-container',
                            'theme_location'  	=> 'menu_above_logo',
                            'items_wrap'      	=> '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
                            'fallback_cb'	  	=> null,
                            'walker'			=> new Bootstrap_Nav_Walker()
                        )
                    );
                    ?>

                    <?php $social_options = get_option( 'lean_theme_social_options' ); ?>
                    <?php if( isset( $social_options['active-social-icons'] ) && '' != $social_options['active-social-icons'] ) { ?>
                        <?php get_template_part( 'social-networking' ); ?>
                    <?php } // end if ?>

                </div><!-- /.nav-collapse -->


            </div><!-- /.container -->
        </div><!-- ./navbar-inner -->
    </nav> <!-- /#menu-under-header -->
<?php } // end if ?>

<?php
// Check to see if there is a header image, to set a class for the positioning of the logo
$header_image = get_header_image();
$head_class = ! empty( $header_image ) ? 'imageyup' : 'imageless';
?>

    <header id="header" class="<?php echo $head_class; ?>">

        <div id="head-wrapper" class="container clearfix">

            <?php // If a user has uploaded a header image, then display at as an anchor to the header ?>
            <?php if( 'imageyup' == $head_class && ! empty( $header_image ) ) { ?>

                <div id="header-image" class="row">
                    <div class="span12">

                        <?php if( is_front_page() || is_archive() || 'video' == get_post_format() || 'image' == get_post_format() || '' == get_the_title() ) { ?>
                            <h1>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                                    <img src="<?php esc_url( header_image() ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                                </a>
                            </h1>
                        <?php } else { ?>
                            <p>
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                                    <img src="<?php esc_url( header_image() ); ?>" alt="<?php bloginfo( 'name' ); ?>" />
                                </a>
                            </p>
                        <?php } // end if/else ?>

                    </div><!-- /.span12 -->
                </div><!-- /#header-image -->

            <?php } else { ?>

                <div id="hgroup" class="clearfix">

                    <div id="logo">

                        <?php // If a logo has been set in the Lean Presentation options, display it ?>
                        <?php if( has_logo() ) { ?>

                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                                <img src="<?php echo $presentation_options['logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" id="header-logo" />
                            </a>

                            <?php // Otherwise, we'll display the header text ?>
                        <?php } else if( has_header_text() ) { ?>

                            <?php // If the user is on the front page, archive page, or one of the post formats without titles, we render h1's. ?>
                            <?php if( is_home() || is_archive() || 'video' == get_post_format() || 'image' == get_post_format() || '' == get_the_title() ) { ?>

                                <h1 id="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                                        <?php bloginfo( 'name' ); ?>
                                    </a>
                                </h1><!-- /#site-title -->

                            <?php } else { ?>

                                <p id="site-title">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo( 'name' ); ?>" rel="home">
                                        <?php bloginfo( 'name' ); ?>
                                    </a>
                                </p><!-- /#site-title -->

                            <?php } //end if/else ?>

                            <p><small id="site-description"><?php bloginfo( 'description' ); ?></small></p>

                        <?php } // end if/else ?>

                    </div><!-- /#logo -->

                    <?php // If there's a widget in the 'Header Sidebar, then we need to display it ?>
                    <?php if ( is_active_sidebar( 'sidebar-1' ) ) {  ?>
                        <div id="header-widget">
                            <?php dynamic_sidebar( 'sidebar-1' ); ?>
                        </div><!-- /#header-widget -->
                    <?php } // end if ?>

                </div><!-- /#hgroup -->

            <?php } //end if/else ?>

        </div><!-- /#head-wrapper -->
    </header><!-- /#header -->

<?php if( has_nav_menu( 'menu_below_logo' ) ) { ?>
    <nav id="menu-below-header" class="menu-navigation navbar-inverse navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".menu-below">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse menu-below">
                <?php
                wp_nav_menu(
                    array(
                        'container_class'	=> 'menu-header-container',
                        'theme_location'  	=> 'menu_below_logo',
                        'items_wrap'      	=> '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
                        'fallback_cb'	  	=> null,
                        'walker'			=> new Bootstrap_Nav_Walker()
                    )
                );
                ?>

                <?php if( ! has_nav_menu( 'menu_above_logo' ) ) { ?>
                    <?php get_template_part( 'social-networking' ); ?>
                <?php } // end if ?>

                </div><!-- /.nav-collapse -->

            </div><!-- /.container -->
        </div><!-- ./navbar-inner -->
    </nav> <!-- /#menu-under-header -->
<?php } // end if ?>