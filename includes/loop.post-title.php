<?php
/**
 * The template for loop post title
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php if( '' !== get_the_title() ) { ?>
    <?php if ( 'aside' == get_post_format() ) { ?>
        <p class="aside-post-title"><?php the_title(); ?></p>
    <?php } else { ?>
        <h1 class="post-title entry-title">
        <?php if( is_single() || is_page() ) { ?>
            <?php the_title(); ?>
        <?php } else { ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
        <?php } // end if ?>
        </h1>
    <?php } // end if ?>
<?php } // end if ?>