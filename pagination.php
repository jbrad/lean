<?php
/**
 * The template for providing pagination throughout the theme.
 *
 * @package Standard
 * @since 3.0
 */
?>
<?php global $wp_query; ?>
<?php $options = get_option( 'standard_theme_layout_options' ); ?>

<?php if( is_single() ) { ?>

	<div id="single-post-nav">
		<ul class="pager">
		<?php $trunc_limit = 30; ?>
			<li class="previous">
			<?php previous_post_link( '<span class="previous-page">%link</span>', __( '«', 'standard' ) . '&nbsp;' . standard_truncate_text( get_previous_post()->post_title, $trunc_limit ) ); ?>
			</li>
		<?php if( '' == get_previous_post() ) { ?>
			<li class="next">
			<?php next_post_link( '<span class="' . ( $options['layout'] == 'full_width_layout' ? 'span12' : 'span8' ) . ' no-previous-page-link next-page">%link</span>', __( '%title »', 'standard' ) ); ?>
			</li>
		<?php } else { ?>
			<li class="next">
			<?php next_post_link( '<span class="' . $pagination_width . ' next-page">%link</span>', standard_truncate_text( get_next_post()->post_title, $trunc_limit ) . '&nbsp;' . __( '»', 'standard' ) ); ?>	
			</li>
		<?php } // end if/else ?>
		</ul>	
	</div><!-- /#single-post-nav -->

<?php } elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { ?>

	<div id="post-nav">
		<ul class="pager">
		
			<?php if( get_next_posts_link() ) { ?>
				<li class="previous">
					<?php next_posts_link( __( '<span class="nav-previous meta-nav">« Older</span>', 'standard' ) ); ?>
				</li>			
			<?php } // end if ?>
			
			<?php if( get_previous_posts_link() ) { ?>
				<li class="next">
					<?php previous_posts_link( __( '<span class="nav-next meta-nav">Newer »</span>', 'standard' ) ); ?>
				</li>
			<?php } // end if ?>
		
		</ul><!-- /.pager -->
	</div><!-- /#post-nav -->

<?php } // end if/else ?>