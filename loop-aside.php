<?php
/**
 * The template for displaying aside post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post panel panel-default format-aside clearfix' ); ?>>

    <time class="aside-date">
        <span class="the-date"><?php the_time('M'); ?></span>
        <span class="the-time"><?php the_time('j'); ?></span>
    </time><!--/aside-date -->

    <div id="content-<?php the_ID(); ?>" class="entry-content clearfix">

        <?php get_template_part( 'includes/loop.post-title' ); ?>

        <?php get_template_part( 'includes/loop.post-content' ); ?>
        <?php get_template_part( 'includes/loop.post-link-pages' ); ?>
    </div><!-- /.entry-content -->

    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->