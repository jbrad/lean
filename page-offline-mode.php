<?php
/**
 * The page that is rendered to the public whenever the theme is set in offline mode.
 *
 * @package lean
 * @version	1.3
 * @since 	1.0
 */
?>
    <style>
        #offline-wrapper{display:table;overflow:hidden;width:100%;height:800px;text-align:center}#offline-wrapper .offline-message{margin:20px 0 40px;padding-bottom:40px;border-bottom:1px solid #e0e0e0}#offline-wrapper .offline-message p{font-weight:900;font-size:48px;line-height:1;margin-bottom:60px}#offline-wrapper #offline-title{font-size:18px}#offline-wrapper #offline-title small{color:#888;font-size:14px}#offline-container{display:table-cell;vertical-align:middle}#offline-content{position:relative;top:-50%}
    </style>
<?php get_header(); ?>
    <div class="container">

        <?php $options = get_option( 'theme_global_options' ); ?>
        <div class="row" role="main">
            <section id="main" class="col-12 col-md-12" role="main">
                <div id="offline-wrapper">
                    <div id="offline-container">

                        <article id="offline-content">
                            <div class="offline-message">
                                <p><?php echo $options['offline_message']; ?></p>

                                <?php if( is_active_sidebar( 'sidebar-10' ) ) { ?>
                                    <div class="container">
                                        <div class="row">
                                            <div id="offline-widget" class="col-md-offset-4 col-md-4">
                                                <?php dynamic_sidebar( 'sidebar-10' ); ?>
                                            </div>
                                        </div>
                                    </div><!-- /#left-footer-widget -->
                                <?php } // end if ?>

                            </div><!--/offline-message -->

                            <div class="offline-title-wrapper">
                                <h1 id="offline-title"><?php bloginfo( 'name' ); ?> <small><?php bloginfo( 'description' ); ?></small></h1>
                            </div><!--/offline-title -->

                        </article><!--/offline-content -->
                    </div><!--/offline-container -->
            </section><!--/offline-wrapper -->
        </div><!--/.span12 -->
    </div><!--/.row -->

    </div><!-- /container -->
<?php get_footer(); ?>