<?php
/**
 * The template for displaying link post formats.
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>
<?php /* Main Loop */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post format-link clearfix' ); ?>>

	<div class="post-header clearfix">
			<div id="content-<?php the_ID(); ?>"  class="entry-content clearfix">	
			
				<?php

					// Read the attribute of the anchor from the post format
					$title = lean_get_link_post_format_attribute( 'title' );
					$href = lean_get_link_post_format_attribute( 'href' );
					$target = strlen( lean_get_link_post_format_attribute( 'target' ) ) > 0 ? lean_get_link_post_format_attribute( 'target' ) : '_blank';
					
					// And attempt to read the link from the post meta
					$href = ( '' == get_post_meta( get_the_ID(), 'lean_link_url_field', true ) ) ? $href : get_post_meta( get_the_ID(), 'lean_link_url_field', true );
					$post_title = strip_tags( stripslashes( get_the_title() ) );
					$content = strip_tags( get_the_content() );
					
				?>

				<?php if( is_single() && '' !== get_the_title() ) { ?>
					<h1 class="post-title entry-title">
                        <span class="icon-link"></span> <a href="<?php echo $href; ?>" title="<?php echo strlen( trim( $title ) ) > 0 ? $title : $post_title; ?>" target="<?php echo $target; ?>" rel="bookmark">
							<?php if( strlen( trim( $post_title ) ) > 0 ) { ?>
								<?php echo $post_title; ?>
							<?php } elseif( strlen( trim( $title ) ) > 0 ) { ?>
								<?php echo $title; ?>
							<?php } elseif( '' != $meta_href ) { ?>
								<?php the_content(); ?>
							<?php } else { ?>
								<?php echo $content; ?>
							<?php } // end if ?>
						</a>
					</h1>
				<?php } else { ?>
					<h2 class="post-title entry-title">
                        <span class="icon-link"></span> <a href="<?php echo $href; ?>" title="<?php echo strlen( trim( $title ) ) > 0 ? $title : $post_title; ?>" target="<?php echo $target; ?>" rel="bookmark">
							<?php if( strlen( trim( $post_title ) ) > 0 ) { ?>
								<?php echo $post_title; ?>
							<?php } elseif( strlen( trim( $title ) ) > 0 ) { ?>
								<?php echo $post_title; ?>
							<?php } elseif( '' != $meta_href ) { ?>
								<?php the_content(); ?>
							<?php } else { ?>
								<?php echo $content; ?>
							<?php } // end if ?>
						</a>
					</h2>
				<?php } // end if ?>
				
			</div><!-- /.entry-content -->
	</div> <!-- /.post-header -->
		
	<?php if( '' != get_post_meta( get_the_ID(), 'lean_link_url_field', true ) ) { ?>
		<div class="entry-content clearfix link-description">
			<?php the_content( __( 'Continue Reading...', 'lean' ) ); ?>
		</div><!-- /entry-content -->
	<?php } // end if ?>
			
	<div class="post-meta clearfix">

			<div class="meta-date-cat-tags pull-left">
			
				<?php if( is_multi_author() ) { ?>
					<span class="the-author">&nbsp;<?php _e( 'Posted by', 'lean' ); ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a></span>
					<time class="the-time updated">&nbsp;<?php _e( 'on ', 'lean' ) . ' '; echo get_the_time( get_option( 'date_format' ) ); ?></time>
				<?php } else { ?>
					<?php printf( '<time class="the-time updated">' . __( 'Posted on %1$s', 'lean' ) . '</time>', get_the_time( get_option( 'date_format' ) ) ); ?>
				<?php } // end if ?>
			
				<?php $category_list = get_the_category_list( __( ', ', 'lean' ) ); ?>
				<?php if( $category_list ) { ?>
					<?php printf( '<span class="the-category">' . __( 'In %1$s', 'lean' ) . '</span>', $category_list ); ?>
				<?php } // end if ?>
				
				<?php $tag_list = get_the_tag_list( '', __( ', ', 'lean' ) ); ?>
				<?php if( $tag_list ) { ?>
					<?php printf( '<span class="icon-tags"></span> ' . __( '%1$s', 'lean' ) . '</span>', $tag_list ); ?>
				<?php } // end if ?>
				
			</div><!-- /meta-date-cat-tags -->
			
			<div class="meta-comment-link pull-right">
				<a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', 'lean' ); ?>">&nbsp;<span class="icon-link"></span></a>
				<?php if ( '' != get_post_format() ) { ?>
					<span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'lean' ), __( '1 Comment', 'lean' ), __( '% Comments', 'lean' ), '', ''); ?></span>
				<?php } // end if ?>
			</div><!-- /meta-comment-link -->

	</div><!-- /.post-meta -->
	
</article> <!-- /#post -->