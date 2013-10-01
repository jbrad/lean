<?php
/**
 * The template for displaying video post formats.
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>
<?php /* Video Loop */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post format-video clearfix' ); ?>>

	<div id="content-<?php the_ID(); ?>" class="entry-content">
		<?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
			<?php the_excerpt( ); ?>
			<a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', TRANSLATION_KEY ); ?></a>
		<?php } else { ?>
			<?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
		<?php } // end if/else ?>
		<?php 
			wp_link_pages( 
				array( 
					'before' 	=> '<div class="page-link"><span>' . __( 'Pages:', TRANSLATION_KEY ) . '</span>',
					'after' 	=> '</div>' 
				) 
			); 
		?>
	</div><!-- /.entry-content -->
	
	<div class="post-meta clearfix">

			<div class="meta-date-cat-tags pull-left">
			
				<?php if( is_multi_author() ) { ?>
					<span class="the-author">&nbsp;<?php _e( 'Posted by', TRANSLATION_KEY ); ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a></span>
					<time class="the-time updated">&nbsp;<?php _e( 'on', TRANSLATION_KEY ) . '&nbsp;'; echo get_the_time( get_option( 'date_format' ) ); ?></time>
				<?php } else { ?>
					<?php printf( '<time class="the-time updated">' . __( 'Posted on %1$s', TRANSLATION_KEY ) . '</time>&nbsp;', get_the_time( get_option( 'date_format' ) ) ); ?>
				<?php } // end if ?>
			
				<?php $category_list = get_the_category_list( __( ', ', TRANSLATION_KEY ) ); ?>
				<?php if( $category_list ) { ?>
					<?php printf( '<span class="the-category">' . __( 'In %1$s', TRANSLATION_KEY ) . '</span>', $category_list ); ?>
				<?php } // end if ?>
				
				<?php $tag_list = get_the_tag_list( '', __( ', ', TRANSLATION_KEY ) ); ?>
				<?php if( $tag_list ) { ?>
                    <?php printf( '<span class="icon-tags"></span> ' . __( '%1$s', TRANSLATION_KEY ) . '</span>', $tag_list ); ?>
				<?php } // end if ?>
				
			</div><!-- /meta-date-cat-tags -->
			
			<div class="meta-comment-link pull-right">
				<a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', TRANSLATION_KEY ); ?>">&nbsp;<span class="icon-link"></span></a>
				<?php if ( '' != get_post_format() ) { ?>
					<span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', TRANSLATION_KEY ), __( '1 Comment', TRANSLATION_KEY ), __( '% Comments', TRANSLATION_KEY ), '', ''); ?></span>
				<?php } // end if ?>
			</div><!-- /meta-comment-link -->

	</div><!-- /.post-meta -->

</article> <!-- /#post- -->