<?php
/**
 * The template for loop post meta
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php $is_standard_post_format = ('' == get_post_format() ); ?>
<?php $is_aside_post_format = ('aside' == get_post_format() ); ?>

<div class="post-meta text-muted clearfix">

    <?php if ( !$is_aside_post_format ) { ?>
        <div class="meta-date-cat-tags pull-left">

            <?php if ( !$is_standard_post_format ) { ?>
                <?php if( is_multi_author() ) { ?>
                    <span class="the-author">&nbsp;<?php _e( 'Posted by', TRANSLATION_KEY ); ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a></span>
                    <time class="the-time updated"><?php _e( 'on ', TRANSLATION_KEY ) . '&nbsp;'; echo get_the_time( get_option( 'date_format' ) ); ?></time>
                <?php } else { ?>
                    <?php printf( '<time class="the-time updated">' . __( 'Posted on %1$s', TRANSLATION_KEY ) . '</time>&nbsp;', get_the_time( get_option( 'date_format' ) ) ); ?>
                <?php } // end if ?>
            <?php } // end if ?>

            <?php $category_list = get_the_category_list( __( ', ', TRANSLATION_KEY ) ); ?>
            <?php if( $category_list ) { ?>
                <?php if ( $is_standard_post_format ) {  ?>
                    <?php printf( '<span class="the-category">' . __( 'In %1$s&nbsp;', TRANSLATION_KEY ) . '</span>', $category_list ); ?>
                <?php } else { ?>
                    <?php printf( '<span class="the-category">' . __( 'in %1$s&nbsp;', TRANSLATION_KEY ) . '</span>', $category_list ); ?>
                <?php } // end if ?>

            <?php } // end if ?>

            <?php $tag_list = get_the_tag_list( '', __( ', ', TRANSLATION_KEY ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php printf( '<span class="fa fa-tags"></span> ' . __( '%1$s', TRANSLATION_KEY ) . '</span>', $tag_list ); ?>
            <?php } // end if ?>

        </div><!-- /meta-date-cat-tags -->
    <?php } //endif ?>

    <div class="meta-comment-link pull-right">
        <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', TRANSLATION_KEY ); ?>"><span class="fa fa-link"></span></a>
        <?php if ( '' != get_post_format() ) { ?>
            <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', TRANSLATION_KEY ), __( '1 Comment', TRANSLATION_KEY ), __( '% Comments', TRANSLATION_KEY ), '', ''); ?>&nbsp;</span>
        <?php } // end if ?>
    </div><!-- /meta-comment-link -->

</div><!-- /.post-meta -->