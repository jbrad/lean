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

        <h1 class="lead"><?php the_title(); ?></h1>

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

    <div class="post-meta text-muted clearfix">

        <div class="meta-comment-link pull-right">
            <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', TRANSLATION_KEY ); ?>"><span class="fa fa-link"></span></a>
            <?php if ( '' != get_post_format() ) { ?>
                <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', TRANSLATION_KEY ), __( '1 Comment', TRANSLATION_KEY ), __( '% Comments', TRANSLATION_KEY ), '', ''); ?>&nbsp;</span>
            <?php } // end if ?>
        </div><!-- /meta-comment-link -->

    </div><!-- /.post-meta -->

</article><!-- /#post -->