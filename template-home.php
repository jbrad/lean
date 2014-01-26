<?php
/**
 * Template Name: Home Template
 *
 * The template for rendering pages without sidebars.
 *
 * @package lean
 * @version	1.3
 * @since 	1.0
 */
?>
    <style>
        body.page-template-template-home-php {
            background: #fff;
        }
        #header,
        #menu-below-header {
            display: none;
        }
        #wrapper {
            padding: 0 0 40px;
        }
        #features .row {
            margin-bottom: 60px;
        }
        .home-widgets .widget {
            margin-bottom: 40px;
        }
        #footer-widgets {
            display: none;
        }
    </style>
<?php get_header(); ?>

    <div id="wrapper">
        <div class="container">
            <div class="row">
                <section id="main" class="col-md-12 clearfix" role="main">
                    <?php if ( have_posts() ) { ?>
                        <?php while ( have_posts() ) { ?>
                            <?php the_post(); ?>
                            <div class="jumbotron">
                                <div class="container">
                                    <h1><?php the_title(); ?></h1>
                                    <p><?php the_content(); ?></p>
                                </div>
                            </div> <!-- /.jumbotron -->
                        <?php } // end while ?>
                    <?php } // end if ?>
                    <?php if( ! is_offline() || is_user_logged_in() ) { ?>
                        <div id="features" class="clearfix">
                            <div class="container">
                                <?php if( is_active_sidebar( 'sidebar-6' ) || is_active_sidebar( 'sidebar-7' ) || is_active_sidebar( 'sidebar-8' ) ) { ?>
                                    <div class="row">

                                        <div class="col-md-4 home-widgets clearfix">
                                            <?php dynamic_sidebar( 'sidebar-6' ); ?>
                                        </div><!-- /#left-footer-widget -->

                                        <div class="col-md-4 home-widgets clearfix">
                                            <?php dynamic_sidebar( 'sidebar-7' ); ?>
                                        </div><!-- /#center-footer-widget -->

                                        <div class="col-md-4 home-widgets clearfix">
                                            <?php dynamic_sidebar( 'sidebar-8' ); ?>
                                        </div><!-- /#right-footer-widget -->

                                    </div><!-- /row -->
                                <?php } // end if ?>
                                <?php if( is_active_sidebar( 'sidebar-9' ) ) { ?>
                                    <div id="bottom-home-widgets" class="row">
                                        <?php dynamic_sidebar( 'sidebar-9' ); ?>
                                    </div><!-- /#left-footer-widget -->
                                <?php } // end if ?>
                            </div><!-- /container -->
                        </div><!-- /#features -->
                    <?php } // end if ?>
            </div> <!-- /#features -->
            </section><!-- /#main -->
        </div><!--/row -->
    </div><!-- /container -->
    </div> <!-- /#wrapper -->
<?php get_footer(); ?>