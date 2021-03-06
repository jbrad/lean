<?php
/**
 * The template for starting The Loop and rendering general content features such as the breadcrumbs, pagination, and sidebars. Uses
 * get_template_part to render the appropriate template based on the current post's format.
 *
 * @package lean
 * @version	1.1
 * @since 	1.0
 */
?>

<?php get_header(); ?>
<?php $presentation_options = get_option( 'theme_presentation_options' ); ?>

    <div id="wrapper">
        <div class="container">
            <div class="row">

                <section id="main"
                         role="main"
                         class="col-12 <?php echo 'full_width_layout' == $presentation_options['layout'] ? 'col-md-12' : 'col-md-8 col-sm-8'; ?> <?php echo 'left_sidebar_layout' == $presentation_options['layout'] ? ' col-md-push-4' : ''; ?>">

                    <?php get_template_part( 'breadcrumbs' ); ?>

                    <?php if ( is_archive() ) { ?>
                        <div id="archive-page-title">
                            <h3>
                                <?php _e( 'Archives For ', TRANSLATION_KEY ); ?>
                                <?php if( is_date_archive() ) { ?>
                                    <?php echo get_date_archive_label(); ?>
                                <?php } elseif ( is_author() ) { ?>

                                    <?php
                                    $author_data = is_using_pretty_permalinks() ?
                                        get_userdata( get_query_var( 'author' ) )  :
                                        get_userdata( user_trailingslashit( get_query_var( 'author' ) ) );

                                    echo ( null == $author_data ) ? get_query_var( 'author_name' ) : $author_data->display_name;
                                    ?>

                                <?php } elseif ( '' == single_tag_title( '', false ) ) { ?>
                                    <?php echo get_cat_name( get_query_var( 'cat' ) ); ?>
                                <?php } else { ?>
                                    <?php echo single_tag_title() ?>
                                <?php } // end if/else ?>
                            </h3>
                            <?php if( '' != category_description() ) { ?>
                                <?php echo category_description(); ?>
                            <?php } // end if ?>
                        </div>
                    <?php } // end if ?>

                    <?php if ( have_posts() ) { ?>

                        <?php while ( have_posts() ) { ?>
                            <?php the_post(); ?>
                            <?php get_template_part( 'loop', get_post_format() ); ?>
                        <?php } // end while ?>

                        <?php // If infinite scroll is on, the we won't render pagination ?>
                        <?php if( false == wp_script_is( 'the-neverending-homepage-css' ) ) { ?>
                            <?php get_template_part( 'pagination' ); ?>
                        <?php } // end if ?>

                    <?php } else { ?>

                        <article id="post-0" class="post no-results not-found">
                            <header class="entry-header">
                                <h1 class="entry-title"><?php _e( 'Page or resource not found', TRANSLATION_KEY ); ?></h1>
                            </header><!-- .entry-header -->
                            <div class="entry-content">
                                <p><?php _e( 'No results were found.', TRANSLATION_KEY ); ?></p>
                                <?php get_search_form(); ?>
                            </div><!-- .entry-content -->
                        </article><!-- #post-0 -->

                    <?php } // end if/else ?>

                </section><!-- /#main -->

                <?php get_sidebar(); ?>

            </div><!-- /row -->
        </div><!-- /container -->
    </div> <!-- /#wrapper -->

<?php get_footer(); ?>