<?php
/**
 * The template for author box
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<div id="author-box" class="well clearfix">
    <figure class="author-box-image">
        <?php echo get_avatar( get_the_author_meta( 'user_email', $post->post_author, '80' ) ); ?>
    </figure><!-- /.author-box-image -->
    <h4 class="author-box-name"><?php the_author_meta( 'display_name' ); ?></h4>
    <p>
        <a class="author-link author-posts-url" href="<?php echo trailingslashit( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?> <?php _e( 'Posts', TRANSLATION_KEY); ?>"><span class="fa fa-list-alt"></span> <?php _e( 'Posts', TRANSLATION_KEY ); ?></a>

        <?php if( strlen( trim( get_the_author_meta( 'user_url' ) ) ) > 0 ) { ?>
            <a class="author-link author-url" href="<?php echo trailingslashit( the_author_meta( 'user_url' ) ); ?>" title="<?php _e( 'Website', TRANSLATION_KEY); ?>" target="_blank" rel="author"><span class="fa fa-globe"></span> <?php _e( 'Website', TRANSLATION_KEY ); ?></a>
        <?php } // end if ?>

        <?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ) ) > 0 ) { ?>
            <a class="author-link icn-twitter" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'twitter', true ) ); ?>" title="<?php _e( 'Twitter', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-twitter"></span> <?php _e( 'Twitter', TRANSLATION_KEY); ?></a>
        <?php } // end if ?>

        <?php if( strlen( trim( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ) ) > 0 ) { ?>
            <a class="author-link icn-facebook" href="<?php echo trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'facebook', true ) ); ?>" title="<?php _e( 'Facebook', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-facebook"></span> <?php _e( 'Facebook', TRANSLATION_KEY); ?></a>
        <?php } // end if ?>

        <?php
        // Get the Google+ ID based on if we're using the built in SEO or WordPress SEO
        $google_plus =
            using_native_seo() ?
                trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'google_plus', true ) )
                :
                trailingslashit( get_user_meta( get_the_author_meta( 'ID' ), 'googleplus', true ) );
        ?>

        <?php if( 1 < strlen( trim( $google_plus ) ) ) { ?>
            <a class="author-link icn-gplus" rel="author" href="<?php echo $google_plus; ?>" title="<?php _e( 'Google+', TRANSLATION_KEY); ?>" target="_blank"><span class="fa fa-google-plus"></span> <?php _e( 'Google+', TRANSLATION_KEY); ?></a>
        <?php } // end if ?>
    </p>
    <?php if( strlen( trim( the_author_meta( 'description' ) ) > 0 ) ) { ?>
        <div class="author-box-description">
            <p><?php the_author_meta( 'description' ); ?></p>
        </div><!-- /.author-box-description -->
    <?php } // end if ?>
</div><!-- /.author-box -->