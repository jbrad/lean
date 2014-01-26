<?php
/**
 * The template for displaying chat post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php /* Main Loop */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post panel panel-default format-chat' ); ?>>

    <div class="post-header clearfix">
        <div class="row">
            <div class="col-sm-2 hidden-xs">
                <span class="fa fa-comments-o"></span>
            </div><!-- /.post-avatar -->
            <div class="entry-content col-md-10 col-xs-12">
                <?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
                    <?php the_excerpt( ); ?>
                    <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', TRANSLATION_KEY ); ?></a>
                <?php } else { ?>
                    <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
                <?php } // end if/else ?>
            </div><!-- /.entry-content -->
        </div><!-- /row -->
    </div> <!-- /.post-header -->

    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->