<?php
/**
 * The template for displaying a single post and its related content as well as author boxes. Uses
 * get_post_format to render the appropriate template based on the post's format.
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>
<?php get_header(); ?>
<?php $presentation_options = get_option( 'lean_theme_presentation_options' ); ?>
<?php
if( 1 == get_post_meta( get_the_ID(), 'lean_seo_post_level_layout', true ) ) {
	$content_width = 900;
} // end if
?>
<div id="wrapper">
	<div class="container">
		<div class="row">

            <?php if ( 'left_sidebar_layout' == $presentation_options['layout'] ) { ?>
                <?php get_sidebar(); ?>
            <?php } // end if ?>

            <div id="main" class="<?php echo 'full_width_layout' == $presentation_options['layout'] ? 'col-md-12' : 'col-md-8'; ?> clearfix" role="main">
				
				<?php get_template_part( 'breadcrumbs' ); ?>
				
				<?php if ( have_posts() ) { ?>
					<?php while ( have_posts() ) { ?>
					<?php the_post(); ?>
					<?php get_template_part( 'loop', get_post_format() ); ?>

						<?php $publishing_options = get_option( 'lean_theme_publishing_options' ); ?>
						<?php $display_author_box = isset( $publishing_options['display_author_box'] ) ? $publishing_options['display_author_box'] : ''; ?>
			
						<?php get_template_part( 'pagination '); ?>

						<?php $social_options = get_option( 'lean_theme_social_options' ); ?>
                        <?php if( 'always' == $display_author_box ) { ?>
                            <div id="author-box" class="well clearfix">
                                <div class="author-box-image">
                                    <?php echo get_avatar( get_the_author_meta( 'user_email', $post->post_author, '80' ) ); ?>
                                </div><!-- /.author-box-image -->
                                <h4 class="author-box-name"><?php the_author_meta( 'display_name' ); ?></h4>
                                <p>
                                    <a class="author-link author-posts-url" href="<?php echo trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?> <?php _e( 'Posts', 'lean'); ?>"><span class="icon-list-alt"></span> <?php _e( 'Posts', 'lean' ); ?></a>

                                    <?php if( strlen( trim( get_the_author_meta( 'user_url' ) ) ) > 0 ) { ?>
                                        <a class="author-link author-url" href="<?php echo trailingslashit( the_author_meta( 'user_url' ) ); ?>" title="<?php _e( 'Website', 'lean'); ?>" target="_blank" rel="author"><span class="icon-globe"></span> <?php _e( 'Website', 'lean' ); ?></a>
                                    <?php } // end if ?>

                                    <?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ) ) > 0 ) { ?>
                                        <a class="author-link icn-twitter" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ); ?>" title="<?php _e( 'Twitter', 'lean'); ?>" target="_blank"><span class="icon-twitter"></span> <?php _e( 'Twitter', 'lean'); ?></a>
                                    <?php } // end if ?>

                                    <?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ) ) > 0 ) { ?>
                                        <a class="author-link icn-facebook" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ); ?>" title="<?php _e( 'Facebook', 'lean'); ?>" target="_blank"><span class="icon-facebook"></span> <?php _e( 'Facebook', 'lean'); ?></a>
                                    <?php } // end if ?>

                                    <?php
                                    // Get the Google+ ID based on if we're using Lean's SEO or WordPress SEO
                                    $google_plus =
                                        using_native_seo() ?
                                            trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'google_plus', true ) )
                                            :
                                            trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'googleplus', true ) );
                                    ?>

                                    <?php if( 1 < strlen( trim( $google_plus ) ) ) { ?>
                                        <a class="author-link icn-gplus" rel="author" href="<?php echo $google_plus; ?>" title="<?php _e( 'Google+', 'lean'); ?>" target="_blank"><span class="icon-google-plus"></span> <?php _e( 'Google+', 'lean'); ?></a>
                                    <?php } // end if ?>
                                </p>
                                <?php if( strlen( trim( the_author_meta( 'description' ) ) > 0 ) ) { ?>
                                    <div class="author-box-description">
                                        <p><?php the_author_meta( 'description' ); ?></p>
                                    </div><!-- /.author-box-description -->
                                <?php } // end if ?>
                            </div><!-- /.author-box -->
                        <?php } // end if ?>
						
						<?php if( is_active_sidebar( 'sidebar-2' ) ) { ?>
							<div id="lean-post-advertisement">
								<?php dynamic_sidebar( 'sidebar-2' ); ?>
							</div><!-- #lean-post-advertisement -->
						<?php } // end if ?>
						
						<?php get_template_part( 'pagination' ); ?>
						
						<?php comments_template( '', true ); ?>	
						
				 	<?php } // end while ?>

				<?php } // end if ?>
			</div><!-- /#main -->

            <?php if ( 'right_sidebar_layout' == $presentation_options['layout'] ) { ?>
                <?php get_sidebar(); ?>
            <?php } // end if ?>
				
		</div> <!-- /row -->
	</div><!-- /container -->
</div> <!-- /#wrapper -->
<?php get_footer(); ?>