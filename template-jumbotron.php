<?php
/**
 * Template Name: Jumbotron Template
 *
 * The template for rendering pages without sidebars.
 *
 * @package lean
 * @version	2.0
 * @since 	1.0
 */
?>
<?php get_header(); ?>

    <?php if ( have_posts() ) { ?>
        <?php while ( have_posts() ) { ?>
            <?php the_post(); ?>
            <header class="jumbotron">
                <div class="container">
                    <h1><?php the_title(); ?></h1>
                    <p><?php the_content(); ?></p>
                </div>
            </header <!-- /.jumbotron -->
        <?php } // end while ?>
    <?php } // end if ?>

    <div class="wrapper features">
        <div class="container">
            <section class="row" role="main">
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
                            <hr class="featurette-divider">
                            <?php featurettes(); ?>
                        </div><!-- /container -->
                    </div><!-- /#features -->
                <?php } // end if ?>
            </section><!-- /#main -->
        </div><!-- /container -->
    </div> <!-- /#wrapper -->
<?php get_footer(); ?>