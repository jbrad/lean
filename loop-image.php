<?php
/**
 * The template for displaying image post formats.
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post format-image' ); ?>>

    <?php if ( '' != get_the_post_thumbnail() ) { ?>
        <div class="post-format-image clearfix">
            <a class="thumbnail-link fademe" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', 'lean' ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'post-format-image' );	?></a>
        </div> <!-- /.thumbnail -->
    <?php }  // end if ?>

    <div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
        <?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
            <?php the_excerpt( ); ?>
            <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', 'lean' ); ?></a>
        <?php } else { ?>
            <?php if( function_exists( 'the_post_format_image' ) ) { ?>
                <div class="image-post-format-36">
                    <?php the_post_format_image(); ?>
                </div><!-- /.image-post-format-36 -->
                <p>
                    <?php echo get_the_content( __( '<p>Continue Reading...</p>', 'lean' ) ); ?>
                </p>
            <?php } else { ?>
                <?php the_content( __( 'Continue Reading...', 'lean' ) ); ?>
            <?php } // end if/else ?>
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

        <div class="meta-date-cat-tags pull-left">

            <?php if( is_multi_author() ) { ?>
                <span class="the-author">&nbsp;<?php _e( 'Posted by', 'lean' ); ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a></span>
                <span class="the-time updated"><?php _e( 'on', 'lean' ); ?>&nbsp;<?php echo get_the_time( get_option( 'date_format' ) ); ?></span>
            <?php } else { ?>
                <?php printf( '<span class="the-time updated">' . __( 'Posted on %1$s', 'lean' ) . '</span>', get_the_time( get_option( 'date_format' ) ) ); ?>
            <?php } // end if ?>

            <?php $category_list = get_the_category_list( __( ', ', 'lean' ) ); ?>
            <?php if( $category_list ) { ?>
                <?php printf( '<span class="the-category">' . __( 'In %1$s', 'lean' ) . '</span>', $category_list ); ?>
            <?php } // end if ?>

            <?php $tag_list = get_the_tag_list( '', __( ', ', 'lean' ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php printf( '<span class="the-tags">' . __( '%1$s', 'lean' ) . '</span>', $tag_list ); ?>
            <?php } // end if ?>

        </div><!-- /meta-date-cat-tags -->

        <div class="meta-comment-link pull-right">
            <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', 'lean' ); ?>">&nbsp;<span class="icon-link"></span></a>
            <?php if ( '' != get_post_format() ) { ?>
                <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'lean' ), __( '1 Comment', 'lean' ), __( '% Comments', 'lean' ), '', ''); ?></span>
            <?php } // end if ?>
        </div><!-- /meta-comment-link -->

    </div><!-- /.post-meta -->
</div><!-- /#post -->