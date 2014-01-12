<?php
/**
 * The template for rendering the footer.
 *
 * @package lean
 * @version	1.1
 * @since 	1.0
 */
?>

		<footer id="footer" class="clearfix">
			
			<?php if( ! is_offline() || is_user_logged_in() ) { ?>
				<?php if( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) ) { ?>
					<div id="footer-widgets" class="clearfix">
						<div class="container">
							<div class="row">
								
								<div id="left-footer-widgets" class="col-md-4 clearfix">
									<?php dynamic_sidebar( 'sidebar-3' ); ?>
								</div><!-- /#left-footer-widget -->
									
								<div id="center-footer-widgets" class="col-md-4 clearfix">
									<?php dynamic_sidebar( 'sidebar-4' ); ?>
								</div><!-- /#center-footer-widget -->
									
								<div id="right-footer-widgets" class="col-md-4 clearfix">
									<?php dynamic_sidebar( 'sidebar-5' ); ?>
								</div><!-- /#right-footer-widget -->
								
							</div><!-- /row -->
						</div><!-- /container -->
					</div><!-- /#footer-widgets -->
				<?php } // end if ?>							
			<?php } // end if ?>
			
			<div id="sub-floor" class="clearfix">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div id="footer-links" class="pull-left">
								<?php  
									if( has_nav_menu( 'footer_menu' ) && ( ! is_offline() || is_user_logged_in() ) ) {
										wp_nav_menu( 
											array(
												'theme_location'  	=> 'footer_menu',
												'container_class' 	=> 'menu-footer-nav-container navbar',
												'items_wrap'      	=> '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
												'fallback_cb'		=> false,
												'depth'          	=> 1
											)
										); 	
									} // end if 
								?>
							</div><!-- /#footer-links -->
										
							<?php $global_options = get_option( 'theme_global_options' ); ?>
							<div id="credit" class="pull-right">
								<?php
                                    $jasonbradley_url = 'http://jasonbradley.me';
                                    $theme_url = THEME_URL;
								?>

								<?php if( null != get_page_by_path( 'privacy-policy' ) && 0 != get_page_by_path( 'privacy-policy' )->ID && 'publish' == get_page_by_path( 'privacy-policy' )->post_status ) { ?>
									<?php printf( __( '&copy; %1$s %2$s &mdash; %3$s &mdash; %4$s by %5$s', TRANSLATION_KEY ), date( 'Y' ), '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>', '<a href="' . get_permalink( get_page_by_path( 'privacy-policy' )->ID ) . '">Privacy Policy</a>', '<a href="' . $theme_url . '" target="_blank">' . THEME_NAME . '</a>', '<a href="' . $jasonbradley_url . '" target="_blank">Jason Bradley</a>' ); ?>
								<?php } else { ?>
									<?php printf( __( '&copy; %1$s %2$s &mdash; %3$s by %4$s', TRANSLATION_KEY ), date( 'Y' ), '<a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>', '<a href="' . $theme_url . '" target="_blank">' . THEME_NAME . '</a>', '<a href="' . $jasonbradley_url . '" target="_blank">Jason Bradley</a>' ); ?>
								<?php } // end if/else ?>

							</div><!-- /#credits -->
						</div><!--/span12-->
					</div><!-- /row -->
				</div><!-- /.container -->
			</div><!-- /#sub-floor -->
		</footer><!-- /#footer -->
		<?php wp_footer(); ?>
	</body>
</html>