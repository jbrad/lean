<?php
/**
 * Template Name: Image Slider Template
 *
 * The template for rendering image slider with home widgets.
 *
 * @package lean
 * @version	2.0
 * @since 	2.0
 */
?>
<?php get_header(); ?>

    <?php featured_slider(); ?>

    <div id="wrapper">
        <div class="container">
            <div class="row">
                <section id="main" class="col-md-12 clearfix" role="main">
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
            </div><!--/row -->
        </div><!-- /container -->
    </div> <!-- /#wrapper -->
<?php get_footer(); ?>