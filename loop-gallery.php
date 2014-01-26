<?php
/**
 * The template for displaying gallery post formats.
 *
 * @package lean
 * @version	1.2.2
 * @since 	1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post panel panel-default format-gallery' ); ?>>

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

                        $image = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $image );
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
                    $slides .= '</div><a class="carousel-control left" href="#' . $gallery_link . '" data-slide="prev"><span class="fa fa-angle-left"></span></a>';
                    $slides .= '<a class="carousel-control right" href="#' . $gallery_link . '" data-slide="next"><span class="fa fa-angle-right"></span></a></div>';
                    $html .= $indicators;
                    $html .= $slides;

                    echo $html;
                ?>
                </div><!-- /.gallery-post-format-36 -->
                <?php if ( the_content() ) { ?>
                <p>
                    <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
                </p>
                <?php } //end if ?>
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

    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->