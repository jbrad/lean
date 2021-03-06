<?php
/**
 * The template for displaying 404 pages.
 *
 * @package lean
 * @version	1.1
 * @since 	1.0
 */
?>
    <style>
        body.error404 {
            min-height: 800px;
        }
        .fa-bolt {
            font-size: 192px;
        }
        #nothing-found{padding:40px 0 180px;text-align:center}#nothing-found h1{color:#000;font-size:8em;line-height:100%}#nothing-found h1 span{color:red}#nothing-found label{float:none}
    </style>
<?php get_header(); ?>

    <div id="wrapper">
        <div class="container">
            <div class="row">

                <section id="main" class="col-12 col-md-12" role="main">

                    <article id="nothing-found" class="no-results not-found">
                        <div class="entry-content clearfix">

                            <span class="fa fa-bolt"></span>
                            <h1 class="404-title"><span><?php _e( '404', TRANSLATION_KEY ); ?></span> <?php _e( 'Whoa...you broke the Internet!', TRANSLATION_KEY ); ?></h1>
                            <p>
                                <?php _e( 'The specified address does not contain a page or blog post at this time', TRANSLATION_KEY ); ?>.
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Page Not Found', TRANSLATION_KEY ); ?>">
                                    <?php _e( 'Click here to return home.', TRANSLATION_KEY ); ?>
                                </a>
                            </p>

                            <?php theme_get_search_form(); ?>

                        </div><!-- .entry-content -->
                    </article><!-- #post-0 -->

                </section><!-- /#main -->

            </div><!-- /row -->
        </div><!-- /container -->
    </div> <!-- /#wrapper -->
<?php get_footer(); ?>