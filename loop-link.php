<?php
/**
 * The template for displaying link post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php /* Main Loop */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post panel panel-default format-link clearfix' ); ?>>

	<div class="post-header clearfix">
			<div id="content-<?php the_ID(); ?>"  class="entry-content clearfix">	
			
				<?php

					// Read the attribute of the anchor from the post format
					$title = get_post_format_attribute( 'title' );
					$href = get_post_format_attribute( 'href' );
					$target = strlen( get_post_format_attribute( 'target' ) ) > 0 ? get_post_format_attribute( 'target' ) : '_blank';
					
					// And attempt to read the link from the post meta
					$href = ( '' == get_post_meta( get_the_ID(), 'link_url_field', true ) ) ? $href : get_post_meta( get_the_ID(), 'link_url_field', true );
					$post_title = strip_tags( stripslashes( get_the_title() ) );
					$content = strip_tags( get_the_content() );
					
				?>

				<?php if( is_single() && '' !== get_the_title() ) { ?>
					<h1 class="post-title entry-title">
                        <span class="fa fa-link"></span> <a href="<?php echo $href; ?>" title="<?php echo strlen( trim( $title ) ) > 0 ? $title : $post_title; ?>" target="<?php echo $target; ?>" rel="bookmark">
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
                        <span class="fa fa-link"></span> <a href="<?php echo $href; ?>" title="<?php echo strlen( trim( $title ) ) > 0 ? $title : $post_title; ?>" target="<?php echo $target; ?>" rel="bookmark">
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
		
	<?php if( '' != get_post_meta( get_the_ID(), 'link_url_field', true ) ) { ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
		</div><!-- /entry-content -->
	<?php } // end if ?>
			
    <div class="post-meta text-muted clearfix">

        <div class="meta-date-cat-tags pull-left">

            <?php $category_list = get_the_category_list( __( ', ', TRANSLATION_KEY ) ); ?>
            <?php if( $category_list ) { ?>
                    <?php printf( '<span class="the-category">' . __( 'in %1$s&nbsp;', TRANSLATION_KEY ) . '</span>', $category_list ); ?>
            <?php } // end if ?>

            <?php $tag_list = get_the_tag_list( '', __( ', ', TRANSLATION_KEY ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php printf( '<span class="fa fa-tags"></span> ' . __( '%1$s', TRANSLATION_KEY ) . '</span>', $tag_list ); ?>
            <?php } // end if ?>

        </div><!-- /meta-date-cat-tags -->

        <div class="meta-comment-link pull-right">
            <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', TRANSLATION_KEY ); ?>"><span class="fa fa-link"></span></a>
            <?php if ( '' != get_post_format() ) { ?>
                <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', TRANSLATION_KEY ), __( '1 Comment', TRANSLATION_KEY ), __( '% Comments', TRANSLATION_KEY ), '', ''); ?>&nbsp;</span>
            <?php } // end if ?>
        </div><!-- /meta-comment-link -->

    </div><!-- /.post-meta -->

</article> <!-- /#post -->