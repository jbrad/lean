<?php
/**
 * The template for displaying image post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post format-image' ); ?>>

    <?php if ( '' != get_the_post_thumbnail() ) { ?>
        <figure class="post-format-image clearfix">
            <a class="thumbnail-link fademe" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_post_thumbnail( 'post-format-image' );	?></a>
        </figure> <!-- /.thumbnail -->
    <?php }  // end if ?>

    <div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
        <?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
            <?php the_excerpt( ); ?>
            <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', TRANSLATION_KEY ); ?></a>
        <?php } else { ?>
            <?php if( function_exists( 'the_post_format_image' ) ) { ?>
                <figure class="image-post-format-36">
                    <?php the_post_format_image(); ?>
                </figure><!-- /.image-post-format-36 -->
                <p>
                    <?php echo get_the_content( __( '<p>Continue Reading...</p>', TRANSLATION_KEY ) ); ?>
                </p>
            <?php } else { ?>
                <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
            <?php } // end if/else ?>
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

        <div class="meta-date-cat-tags pull-left">

            <?php $category_list = get_the_category_list( __( ' ', TRANSLATION_KEY ) ); ?>
            <?php if( $category_list ) { ?>
                <?php printf( '<span class="the-category">' . __( '%1$s&nbsp;', TRANSLATION_KEY ) . '</span>', $category_list ); ?>
            <?php } // end if ?>

            <?php $tag_list = get_the_tag_list( '', __( ' ', TRANSLATION_KEY ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php printf( '<span class="tags"></span> ' . __( '%1$s', TRANSLATION_KEY ) . '</span>', $tag_list ); ?>
            <?php } // end if ?>

        </div><!-- /meta-date-cat-tags -->

        <div class="meta-comment-link pull-right">
            <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', TRANSLATION_KEY ); ?>"><span class="fa fa-link"></span></a>
            <?php if ( '' != get_post_format() ) { ?>
                <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', TRANSLATION_KEY ), __( '1 Comment', TRANSLATION_KEY ), __( '% Comments', TRANSLATION_KEY ), '', ''); ?>&nbsp;</span>
            <?php } // end if ?>
        </div><!-- /meta-comment-link -->

    </div><!-- /.post-meta -->

</article><!-- /#post -->