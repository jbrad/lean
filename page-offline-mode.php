<?php
/**
 * The page that is rendered to the public whenever the theme is set in offline mode.
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>
<?php get_header(); ?>
	<div class="container">
	
		<?php $options = get_option( 'lean_theme_global_options' ); ?>
			<div class="row" role="main">
				<section class="col-md-12">
					<div id="offline-wrapper">
						<div id="offline-container">
					
						<article id="offline-content">
							<div class="offline-message">
								<p><?php echo $options['offline_message']; ?></p> 
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