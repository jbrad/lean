<?php
/**
 * The template for loop post content
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
    <?php the_excerpt( ); ?>
    <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', TRANSLATION_KEY ); ?></a>
<?php } else { ?>
    <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
<?php } // end if/else ?>