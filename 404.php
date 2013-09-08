<?php
/**
 * The template for displaying 404 pages.
 *
 * @package Standard
 * @version	3.2
 * @since 	3.0
 */
?>
<?php get_header(); ?>

<div id="wrapper">
	<div class="container">
		<div class="row">

			<div id="main" class="col-md-12 clearfix" role="main">
		
					<div id="nothing-found" class="no-results not-found">
						<div class="entry-content clearfix">

                            <span class="icon-bolt"></span>
							<h1 class="404-title"><span><?php _e( '404', 'standard' ); ?></span> <?php _e( 'Whoa...you broke the Internet!', 'standard' ); ?></h1>
							<p>
								<?php _e( 'The specified address does not contain a page or blog post at this time', 'standard' ); ?>. 
								<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Page Not Found', 'standard' ); ?>">
									<?php _e( 'Click here to return home.', 'standard' ); ?>
								</a>
							</p>
							
							<?php standard_get_search_form(); ?>
							
						</div><!-- .entry-content -->
					</div><!-- #post-0 -->
		
			</div><!-- /#main -->
		
		</div><!-- /row -->
	</div><!-- /container -->
</div> <!-- /#wrapper -->
<?php get_footer(); ?>