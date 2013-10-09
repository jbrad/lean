<?php
/**
 * The template for displaying image post formats.
 *
 * @package lean
 * @version	1.1
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
        <?php get_template_part( 'includes/loop.post-link-pages' ); ?>
    </div><!-- /.entry-content -->

        <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->