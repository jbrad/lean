<?php
/**
 * The template for displaying the audio post format.
 * 
 * @package Standard
 * @since 	3.3
 * @version	3.3
 */
?>
<div id="post-<?php the_ID(); ?>" <?php post_class( 'post format-standard clearfix' ); ?>>
	
	<?php /* TODO: if released in wp 3.6 ?>
	<div class="audio-content">
		<?php the_post_format_audio(); ?>
	</div><!--/ audio-content -->
	<?php */ ?>
	
	<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
		<?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
			<?php the_excerpt( ); ?>
			<a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', 'standard' ); ?></a>
		<?php } else { ?>
			<?php the_content( __( 'Continue Reading...', 'standard' ) ); ?>
		<?php } // end if/else ?>
		<?php 
			wp_link_pages( 
				array( 
					'before' 	=> '<div class="page-link"><span>' . __( 'Pages:', 'standard' ) . '</span>', 
					'after' 	=> '</div>' 
				) 
			); 
		?>
	</div><!-- /.entry-content -->
	
	<div class="post-meta clearfix">
	
	
			<div class="title clearfix pull-left">
				<?php if( '' !== get_the_title() ) { ?>
					<?php if( is_single() || is_page() ) { ?>
						<h1 class="post-title entry-title"><?php the_title(); ?></h1>	
					<?php } else { ?>
						<h2 class="post-title entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', 'standard' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
						</h2>
					<?php } // end if ?>
				<?php } // end if ?>
			</div><!-- /.title-wrap -->
		
		<div class="meta-comment-link pull-right">			
		
			<a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', 'standard' ); ?>">&nbsp;<img src="<?php echo esc_url( get_template_directory_uri() . '/images/icn-permalink.png' ); ?>" alt="<?php esc_attr_e( 'permalink', 'standard' ); ?>" /></a>
			<?php if ( '' != get_post_format() ) { ?>
				<span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'standard' ), __( '1 Comment', 'standard' ), __( '% Comments', 'standard' ), '', ''); ?></span>
			<?php } // end if ?>
		</div><!-- /meta-comment-link -->

	</div><!-- /.post-meta -->
</div><!-- /#post -->