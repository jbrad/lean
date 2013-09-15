<?php
/**
 * The template for displaying aside post formats.
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post clearfix' ); ?>>

    <div class="aside-date">
        <span class="the-date"><?php the_time('M'); ?></span>
        <span class="the-time"><?php the_time('j'); ?></span>
    </div><!--/aside-date -->

    <div id="content-<?php the_ID(); ?>" class="entry-content clearfix">

        <p class="aside-post-title"><?php the_title(); ?></p>

        <?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
            <?php the_excerpt( ); ?>
            <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', 'lean' ); ?></a>
        <?php } else { ?>
            <?php the_content( __( 'Continue Reading...', 'lean' ) ); ?>
        <?php } // end if/else ?>
        <?php
        wp_link_pages(
            array(
                'before' 	=> '<div class="page-link"><span>' . __( 'Pages:', 'lean' ) . '</span>',
                'after' 	=> '</div>'
            )
        );
        ?>
    </div><!-- /.entry-content -->

    <div class="post-meta clearfix">

        <div class="meta-comment-link pull-right">
            <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', 'lean' ); ?>">&nbsp;<span class="icon-link"></span></a>
            <?php if ( '' != get_post_format() ) { ?>
                <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'lean' ), __( '1 Comment', 'lean' ), __( '% Comments', 'lean' ), '', ''); ?></span>
            <?php } // end if ?>
        </div><!-- /meta-comment-link -->

    </div><!-- /.post-meta -->
</div><!-- /#post -->