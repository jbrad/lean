<?php
/**
 * The template for displaying audio post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post format-audio clearfix' ); ?>>

	<div class="post-header clearfix">
		<div class="title-wrap clearfix row">
            <div class="col-sm-1 hidden-xs">
                <span class="fa fa-music"></span>
            </div> <!-- /.col-md-1 -->
            <div class="col-sm-11 col-xs-12">
                <?php get_template_part( 'includes/loop.post-title' ); ?>
            </div> <!-- /.col-md-11 -->
		</div><!-- /.title-wrap -->
	</div><!-- /.post-header -->

	<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
        <?php get_template_part( 'includes/loop.post-content' ); ?>
        <?php get_template_part( 'includes/loop.post-link-pages' ); ?>
	</div><!-- /.entry-content -->

    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->