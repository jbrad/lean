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

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post panel panel-default format-status' ); ?>>

    <div class="post-header clearfix">
        <div class="row">
            <div class="post-avatar col-md-2 col-sm-4 col-xs-12">
                <?php echo get_avatar( get_the_author_meta( 'ID' ), 80 ); ?>
            </div><!-- /.post-avatar -->
            <div class="entry-content col-md-10 col-sm-8 col-xs-12 clearfix">
                <?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
                    <?php the_excerpt( ); ?>
                    <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', TRANSLATION_KEY ); ?></a>
                <?php } else { ?>
                    <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
                <?php } // end if/else ?>
            </div><!-- /.entry-content -->
        </div><!-- /row -->
    </div> <!-- /.post-header -->

    <div class="post-meta text-muted clearfix">

        <div class="meta-date-cat-tags pull-left">

            <?php $category_list = get_the_category_list( __( ', ', TRANSLATION_KEY ) ); ?>
            <?php if( $category_list ) { ?>
                <?php printf( '<span class="the-category">' . __( 'in %1$s&nbsp;', TRANSLATION_KEY ) . '</span>', $category_list ); ?>
            <?php } // end if ?>

            <?php $tag_list = get_the_tag_list( '', __( ', ', TRANSLATION_KEY ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php printf( '<span class="fa fa-tags"></span> ' . __( '%1$s', TRANSLATION_KEY ) . '</span>', $tag_list ); ?>
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