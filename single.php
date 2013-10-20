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
if( 1 == get_post_meta( get_the_ID(), 'seo_post_level_layout', true ) ) {
	$content_width = 900;
} // end if
?>
<div id="wrapper">
	<div class="container">
		<div class="row">

            <section id="main" class="<?php echo get_section_class(); ?>" role="main">
				
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
                            <?php get_template_part( 'includes/author-box' ); ?>
                        <?php } // end if ?>
						
                        <?php if( is_active_sidebar( 'sidebar-2' ) ) { ?>
							<div id="post-advertisement">
								<?php dynamic_sidebar( 'sidebar-2' ); ?>
							</div><!-- #post-advertisement -->
						<?php } // end if ?>
						
						<?php get_template_part( 'pagination' ); ?>
						
						<?php comments_template( '', true ); ?>	
						
				 	<?php } // end while ?>

				<?php } // end if ?>
			</section><!-- /#main -->

            <?php get_sidebar(); ?>

		</div> <!-- /row -->
	</div><!-- /container -->
</div> <!-- /#wrapper -->
<?php get_footer(); ?>