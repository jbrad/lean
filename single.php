<?php
/**
 * The template for displaying a single post and its related content as well as author boxes. Uses
 * get_post_format to render the appropriate template based on the post's format.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php get_header(); ?>
<?php $presentation_options = get_option( 'theme_presentation_options' ); ?>
<?php
$singlePostFullWidth = get_post_meta( get_the_ID(), 'seo_post_level_layout', true );
if( 1 == $singlePostFullWidth ) {
    $content_width = 900;
} // end if
?>
    <div id="wrapper">
        <div class="container">
            <div class="row">

                <section id="main"
                         role="main"
                         class="col-12 <?php echo 'full_width_layout' == $presentation_options['layout'] || $singlePostFullWidth ? 'col-md-12' : 'col-md-8 col-sm-8'; ?> <?php echo 'left_sidebar_layout' == $presentation_options['layout'] ? ' col-md-push-4' : ''; ?>">

                    <?php get_template_part( 'breadcrumbs' ); ?>

                    <?php if ( have_posts() ) { ?>
                        <?php while ( have_posts() ) { ?>
                            <?php the_post(); ?>
                            <?php get_template_part( 'loop', get_post_format() ); ?>

                            <?php get_template_part( 'pagination '); ?>

                            <?php $publishing_options = get_option( 'theme_publishing_options' ); ?>
                            <?php $display_author_box = isset( $publishing_options['display_author_box'] ) ? $publishing_options['display_author_box'] : ''; ?>
                            <?php if( 'always' == $display_author_box ) { ?>
                                <?php $social_options = get_option( 'theme_social_options' ); ?>
                                <div id="author-box" class="media well">
                                    <div class="media-object pull-left">
                                        <?php echo get_avatar( get_the_author_meta( 'user_email', $post->post_author, '80' ) ); ?>
                                    </div><!-- /.author-box-image -->
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php the_author_meta( 'display_name' ); ?></h4>
                                        <p>
                                            <a class="author-link author-posts-url" href="<?php echo trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?> <?php _e( 'Posts', TRANSLATION_KEY); ?>"><span class="fa fa-list-alt"></span> <?php _e( 'Posts', TRANSLATION_KEY ); ?></a>

                                            <?php if( strlen( trim( get_the_author_meta( 'user_url' ) ) ) > 0 ) { ?>
                                                <a class="author-link author-url" href="<?php echo trailingslashit( the_author_meta( 'user_url' ) ); ?>" title="<?php _e( 'Website', TRANSLATION_KEY); ?>" target="_blank" rel="author"><span class="fa fa-globe"></span> <?php _e( 'Website', TRANSLATION_KEY ); ?></a>
                                            <?php } // end if ?>

                                            <?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ) ) > 0 ) { ?>
                                                <a class="author-link icn-twitter" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ); ?>" title="<?php _e( 'Twitter', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-twitter"></span> <?php _e( 'Twitter', TRANSLATION_KEY); ?></a>
                                            <?php } // end if ?>

                                            <?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ) ) > 0 ) { ?>
                                                <a class="author-link icn-facebook" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ); ?>" title="<?php _e( 'Facebook', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-facebook"></span> <?php _e( 'Facebook', TRANSLATION_KEY); ?></a>
                                            <?php } // end if ?>

                                            <?php
                                            // Get the Google+ ID based on if we're using the built in SEO or WordPress SEO
                                            $google_plus =
                                                using_native_seo() ?
                                                    trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'google_plus', true ) )
                                                    :
                                                    trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'googleplus', true ) );
                                            ?>

                                            <?php if( 1 < strlen( trim( $google_plus ) ) ) { ?>
                                                <a class="author-link icn-gplus" rel="author" href="<?php echo $google_plus; ?>" title="<?php _e( 'Google+', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-google-plus"></span> <?php _e( 'Google+', TRANSLATION_KEY); ?></a>
                                            <?php } // end if ?>
                                        </p>
                                        <?php if( strlen( trim( the_author_meta( 'description' ) ) > 0 ) ) { ?>
                                            <div class="author-box-description">
                                                <p><?php the_author_meta( 'description' ); ?></p>
                                            </div><!-- /.author-box-description -->
                                        <?php } // end if ?>
                                    </div>
                                </div>
                            <?php } // end if ?>

                            <?php if( is_active_sidebar( 'sidebar-2' ) ) { ?>
                                <div id="post-advertisement">
                                    <?php dynamic_sidebar( 'sidebar-2' ); ?>
                                </div><!-- #post-advertisement -->
                            <?php } // end if ?>

                            <?php comments_template( '', true ); ?>

                            <?php get_template_part( 'pagination' ); ?>

                        <?php } // end while ?>

                    <?php } // end if ?>
                </section><!-- /#main -->

                <?php if ( ! $singlePostFullWidth ) { ?>
                    <?php get_sidebar(); ?>
                <?php } // end if ?>

            </div> <!-- /row -->
        </div><!-- /container -->
    </div> <!-- /#wrapper -->
<?php get_footer(); ?>