<?php
/**
 * The template for displaying gallery post formats.
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>

<div id="post-<?php the_ID(); ?>" <?php post_class( 'post format-gallery' ); ?>>

    <div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
            <?php if( function_exists( 'get_post_gallery' ) ) { ?>
                <div class="gallery-post-format">
                    <?php

                    $gallery = get_post_gallery_images( $post );

                    $indicators = '<ol class="carousel-indicators">';
                    $slides = '<div class="carousel-inner">';
                    $html = '<div id="gallery-';
                    $html .= get_the_ID();
                    $html .= '" class="carousel slide">';
                    $index = 0;

                    foreach( $gallery as $image ) {
                        $indicators .= '<li data-target="#gallery-';
                        $indicators .= get_the_ID();
                        $indicators .= '" data-slide-to="';
                        $indicators .= strval($index);
                        $indicators .= '" class="';

                        if ($index == 0) {
                            $indicators .= 'active';
                        }

                        $indicators .= '"></li>';

                        $slides .= '<div class="item';
                        if ($index == 0) {
                            $slides .= ' active';
                        }
                        $slides .= '"><img src="';
                        $slides .= $image;
                        $slides .= '"></a>';
                        $slides .= '</div>';

                        $index ++;
                    }

                    $indicators .= '</ol>';
                    $slides .= '</div><a class="carousel-control left" href="#gallery-';
                    $slides .= get_the_ID();
                    $slides .= '" data-slide="prev"><span class="icon-prev"></span></a>
    <a class="carousel-control right" href="#gallery-';
                    $slides .= get_the_ID();
                    $slides .= '" data-slide="next"><span class="icon-next"></span></a></div>';
                    $html .= $indicators;
                    $html .= $slides;

                    echo $html;

                    ?>
                </div><!-- /.gallery-post-format-36 -->
                <p>
                    <?php the_content( __( 'Continue Reading...', 'standard' ) ); ?>
                </p>
            <?php } else { ?>
                <?php the_content( __( 'Continue Reading...', 'standard' ) ); ?>
            <?php } // end if/else ?>
        <?php
        wp_link_pages(
            array(
                'before' 	=> '<div class="page-link"><span>' . __( 'Pages:', 'standard' ) . '</span>',
                'after' 	=> '</div>'
            )
        );
        ?>
    </div><!-- /.entry-content -->

    <div class="post-meta clearfix">

        <div class="meta-date-cat-tags pull-left">

            <?php if( is_multi_author() ) { ?>
                <span class="the-author">&nbsp;<?php _e( 'Posted by', 'standard' ); ?>&nbsp;<a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a></span>
                <span class="the-time updated"><?php _e( 'on', 'standard' ); ?>&nbsp;<?php echo get_the_time( get_option( 'date_format' ) ); ?></span>
            <?php } else { ?>
                <?php printf( '<span class="the-time updated">' . __( 'Posted on %1$s', 'standard' ) . '</span>', get_the_time( get_option( 'date_format' ) ) ); ?>
            <?php } // end if ?>

            <?php $category_list = get_the_category_list( __( ', ', 'standard' ) ); ?>
            <?php if( $category_list ) { ?>
                <?php printf( '<span class="the-category">' . __( 'In %1$s', 'standard' ) . '</span>', $category_list ); ?>
            <?php } // end if ?>

            <?php $tag_list = get_the_tag_list( '', __( ', ', 'standard' ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php printf( '<span class="the-tags">' . __( '%1$s', 'standard' ) . '</span>', $tag_list ); ?>
            <?php } // end if ?>

        </div><!-- /meta-date-cat-tags -->

        <div class="meta-comment-link pull-right">
            <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', 'standard' ); ?>">&nbsp;<span class="icon-link"></span></a>
            <?php if ( '' != get_post_format() ) { ?>
                <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', 'standard' ), __( '1 Comment', 'standard' ), __( '% Comments', 'standard' ), '', ''); ?></span>
            <?php } // end if ?>
        </div><!-- /meta-comment-link -->

    </div><!-- /.post-meta -->
</div><!-- /#post -->