<?php
/**
 * The template for displaying status post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php /* Main Loop */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post format-status' ); ?>>

	<div class="post-header clearfix">
		<div class="row">
				<div class="post-avatar col-md-2">
					<?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
				</div><!-- /.post-avatar -->
			<div class="entry-content col-md-10 clearfix">
                <?php get_template_part( 'includes/loop.post-content' ); ?>
			</div><!-- /.entry-content -->
		</div><!-- /row -->
	</div> <!-- /.post-header -->
					
    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->