<?php
/**
 * The template for displaying video post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php /* Video Loop */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post panel panel-default format-video clearfix' ); ?>>

	<div id="content-<?php the_ID(); ?>" class="entry-content">
        <?php get_template_part( 'includes/loop.post-content' ); ?>
        <?php get_template_part( 'includes/loop.post-link-pages' ); ?>
	</div><!-- /.entry-content -->

    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article> <!-- /#post- -->