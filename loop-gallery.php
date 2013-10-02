<?php
/**
 * The template for displaying gallery post formats.
 *
 * @package lean
 * @version	1.0
 * @since 	1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post format-gallery' ); ?>>

    <div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
            <?php if( function_exists( 'get_post_gallery' ) ) { ?>
                <div class="gallery-post-format">
                    <?php

                    $gallery = get_post_gallery_images( $post );
                    $gallery_link = 'gallery-' . get_the_ID();

                    $indicators = '<ol class="carousel-indicators">';
                    $slides = '<div class="carousel-inner">';
                    $html = '<div id="' . $gallery_link . '" class="carousel slide">';
                    $index = 0;

                    foreach( $gallery as $image ) {
                        $indicators .= '<li data-target="#' . $gallery_link . '" data-slide-to="';
                        $indicators .= strval($index);
                        $indicators .= '" class="';

                        if ($index == 0) {
                            $indicators .= 'active';
                        }

                        $indicators .= '"></li>';

                        $slides .= '<figure class="item';
                        if ($index == 0) {
                            $slides .= ' active';
                        }
                        $slides .= '"><img src="';
                        $slides .= $image;
                        $slides .= '"></a>';
                        $slides .= '</figure>';

                        $index ++;
                    }

                    $indicators .= '</ol>';
                    $slides .= '</div><a class="carousel-control left" href="#' . $gallery_link . '" data-slide="prev"><span class="icon-prev"></span></a>';
                    $slides .= '<a class="carousel-control right" href="#' . $gallery_link . '" data-slide="next"><span class="icon-next"></span></a></div>';
                    $html .= $indicators;
                    $html .= $slides;

                    echo $html;

                    ?>
                </div><!-- /.gallery-post-format-36 -->
                <p>
                    <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
                </p>
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

    <div class="post-meta clearfix">

        <div class="meta-date-cat-tags pull-left">

            <?php if( is_multi_author() ) { ?>
                <span class="the-author">&nbsp;<?php _e( 'Posted by', TRANSLATION_KEY ); ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a></span>
                <time class="the-time updated"><?php _e( 'on', TRANSLATION_KEY ); ?>&nbsp;<?php echo get_the_time( get_option( 'date_format' ) ); ?></time>
            <?php } else { ?>
                <?php printf( '<time class="the-time updated">' . __( 'Posted on %1$s', TRANSLATION_KEY ) . '</time>', get_the_time( get_option( 'date_format' ) ) ); ?>
            <?php } // end if ?>

            <?php $category_list = get_the_category_list( __( ', ', TRANSLATION_KEY ) ); ?>
            <?php if( $category_list ) { ?>
                <?php printf( '<span class="the-category">' . __( 'In %1$s', TRANSLATION_KEY ) . '</span>', $category_list ); ?>
            <?php } // end if ?>

            <?php $tag_list = get_the_tag_list( '', __( ', ', TRANSLATION_KEY ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php printf( '<span class="the-tags">' . __( '%1$s', TRANSLATION_KEY ) . '</span>', $tag_list ); ?>
            <?php } // end if ?>

        </div><!-- /meta-date-cat-tags -->

        <div class="meta-comment-link pull-right">
            <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', TRANSLATION_KEY ); ?>">&nbsp;<span class="icon-link"></span></a>
            <?php if ( '' != get_post_format() ) { ?>
                <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', TRANSLATION_KEY ), __( '1 Comment', TRANSLATION_KEY ), __( '% Comments', TRANSLATION_KEY ), '', ''); ?></span>
            <?php } // end if ?>
        </div><!-- /meta-comment-link -->

    </div><!-- /.post-meta -->
</article><!-- /#post -->