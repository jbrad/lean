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

                            <div class="sharedaddy sd-block sd-social sd-gplus">
                                <h3 class="sd-title">Google+</h3>
                                <div class="sd-content">
                                    <a href="https://plus.google.com/+JasonBradley70">
                                        <img src="https://lh5.googleusercontent.com/-yCuzeh5zIKg/AAAAAAAAAAI/AAAAAAAAADE/1GHFiQBu5t8/photo.jpg?sz=40" alt="Jason Bradley" width="20" height="20" align="absmiddle" scale="0">
                                    </a>
                                    <a rel="author" href="https://plus.google.com/+JasonBradley70" class="gplus-profile">Jason Bradley</a>
                                    <span class="g-follow-wrapper">
                                        <span class="g-follow" data-href="https://plus.google.com/+JasonBradley70" data-rel="author" data-height="15"></span>
                                    </span>
                                </div>
                            </div>

                            <?php $publishing_options = get_option( 'theme_publishing_options' ); ?>
                            <?php $display_author_box = isset( $publishing_options['display_author_box'] ) ? $publishing_options['display_author_box'] : ''; ?>
                            <?php if( 'always' == $display_author_box ) { ?>
                                <?php $social_options = get_option( 'theme_social_options' ); ?>
                                <div class="author-box media well">
                                    <div class="media-object pull-left">
                                        <?php echo get_avatar( get_the_author_meta( 'user_email', $post->post_author, '80' ) ); ?>
                                    </div><!-- /.author-box-image -->
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php the_author_meta( 'display_name' ); ?></h4>
                                        <?php if( strlen( trim( the_author_meta( 'description' ) ) > 0 ) ) { ?>
                                            <p><?php the_author_meta( 'description' ); ?></p>
                                        <?php } // end if ?>
                                        <p>
                                            <ul class="list-inline">
                                                <li>
                                                    <a class="author-link author-posts-url" href="<?php echo trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?> <?php _e( 'Posts', TRANSLATION_KEY); ?>"><span class="fa fa-list-alt"></span> <?php _e( 'Posts', TRANSLATION_KEY ); ?></a>
                                                </li>
                                                <li>
                                                    <?php if( strlen( trim( get_the_author_meta( 'user_url' ) ) ) > 0 ) { ?>
                                                        <a class="author-link author-url" href="<?php echo trailingslashit( the_author_meta( 'user_url' ) ); ?>" title="<?php _e( 'Website', TRANSLATION_KEY); ?>" target="_blank" rel="author"><span class="fa fa-globe"></span> <?php _e( 'Website', TRANSLATION_KEY ); ?></a>
                                                    <?php } // end if ?>
                                                </li>
                                                <li>
                                                    <?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ) ) > 0 ) { ?>
                                                        <a class="author-link icn-twitter" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ); ?>" title="<?php _e( 'Twitter', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-twitter"></span> <?php _e( 'Twitter', TRANSLATION_KEY); ?></a>
                                                    <?php } // end if ?>
                                                </li>
                                                <li>
                                                    <?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ) ) > 0 ) { ?>
                                                        <a class="author-link icn-facebook" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ); ?>" title="<?php _e( 'Facebook', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-facebook"></span> <?php _e( 'Facebook', TRANSLATION_KEY); ?></a>
                                                    <?php } // end if ?>
                                                </li>

                                                <?php
                                                // Get the Google+ ID based on if we're using the built in SEO or WordPress SEO
                                                $google_plus =
                                                    using_native_seo() ?
                                                        trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'google_plus', true ) )
                                                        :
                                                        trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'googleplus', true ) );
                                                ?>
                                                <li>
                                                    <?php if( 1 < strlen( trim( $google_plus ) ) ) { ?>
                                                        <a class="author-link icn-gplus" rel="author" href="<?php echo $google_plus; ?>" title="<?php _e( 'Google+', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-google-plus"></span> <?php _e( 'Google+', TRANSLATION_KEY); ?></a>
                                                    <?php } // end if ?>
                                                </li>
                                            </ul>
                                        </p>
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