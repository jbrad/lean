<?php
/**
 * The page that is rendered to the public whenever the theme is set in offline mode.
 *
 * @package Standard
 * @since 3.0
 */
?>
<?php get_header(); ?>
	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div id="main" class="span12 clearfix" role="main">
					<div style="width:640px;margin:0 auto;padding:120px;text-align:center;">
						<iframe width="560" height="315" src="http://www.youtube.com/embed/WUUptX0i55g" frameborder="0" allowfullscreen></iframe>
						<?php $options = get_option( 'standard_theme_global_options' ); ?>
						<h1>PC Load Letter? The Fck does that mean?</h1>
						<p><?php echo $options['offline_mode_message']; ?></p> 
					</div>
				</div><!-- /#main -->			
			</div><!--/row -->
		</div><!-- /container -->
	</div> <!-- /#wrapper -->
<?php get_footer(); ?>