<?php
/**
 * The template for displaying gallery post formats.
 *
 * @package lean
 * @version	1.2
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
                        // get the large image by default
                        $image = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $image );

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
        <?php get_template_part( 'includes/loop.post-link-pages' ); ?>
    </div><!-- /.entry-content -->

    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->