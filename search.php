<?php
/**
 * The template for displaying search results. It's based on index.php. If the user has the Google Custom Search Widget enabled,
 * then the will display that template rather than the default search results page.
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

            <?php if ( 'left_sidebar_layout' == $presentation_options['layout'] ) { ?>
                <?php get_sidebar(); ?>
            <?php } // end if ?>

            <section id="main" class="<?php echo 'full_width_layout' == $presentation_options['layout'] ? 'col-md-12' : 'col-md-8'; ?> clearfix" role="main">
				
				<?php // Even if google custom search is active, we may be coming from the 4040 page so we'll run this template. ?>
				<?php if( ! google_custom_search_is_active() || '' != get_query_var( 's' ) ) { ?>
					
					<?php get_template_part( 'breadcrumbs' ); ?>

					<div id="search-page-title"> 
	                    <h3><?php _e( 'Search Results For "', TRANSLATION_KEY ); echo get_query_var( 's' ); _e( '"', TRANSLATION_KEY ); ?></h3>
	                </div> 
				
					<?php if ( have_posts() ) { ?>
					
						<?php while ( have_posts() ) { ?>
							<?php the_post(); ?>
							<?php get_template_part( 'loop', get_post_format() ); ?>
						<?php } // end while ?>
				
						<?php get_template_part( 'pagination' ); ?>
						
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
			
				<?php if ( 'right_sidebar_layout' == $presentation_options['layout'] ) { ?>
					<?php get_sidebar(); ?>
				<?php } // end if ?>
			
			<?php } // end if ?>
	
		</div><!-- /row -->
	</div><!-- /container -->
</div><!-- /#wrapper -->

<?php get_footer(); ?>