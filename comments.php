<?php
/**
 * The template for displaying comments, pings, and trackbacks on posts, pages, and attachments.
 *
 * @package lean
 * @version	1.1
 * @since 	1.0
 */
?>
<?php
if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
    die ( __( 'This file cannot be loaded directly.', TRANSLATION_KEY ) );
} // end if
?>

<?php if ( post_password_required() ) { ?>
    <div id="comments">
        <h3 class="page-header"><?php _e( 'This post is password protected. Enter the password to view comments.', TRANSLATION_KEY ); ?></h3>
    </div><!-- #comments -->
    <?php return; ?>
<?php } // end if	?>

<?php if ( have_comments() ) { ?>

    <?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
        <div id="comments">
            <h3 class="page-header">
                <?php comments_number( __( 'No responses', TRANSLATION_KEY ), __( 'One response', TRANSLATION_KEY ), __( '% responses', TRANSLATION_KEY ) );?> <?php _e( 'to', TRANSLATION_KEY ); ?> <em><?php the_title(); ?></em>
            </h3>
            <ol class="commentlist">
                <?php wp_list_comments( 'avatar_size=50&callback=custom_comment&type=comment' ); ?>
            </ol>
            <div class="comment-navigation clearfix">
                <div class="comment-prev-nav">
                    <?php previous_comments_link( '<span class="fa fa-chevron-left"></span>' . __( 'Previous Comments', TRANSLATION_KEY ) ); ?>
                </div>
                <div class="comment-next-nav">
                    <?php next_comments_link( __( 'Next Comments', TRANSLATION_KEY ) . '<span class="fa fa-chevron-right"></span>'); ?>
                </div>
            </div>
        </div><!-- /#comments -->
    <?php } // end if ?>

    <?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>
        <div id="pings">
            <h3 class="page-header"><?php _e('Trackbacks and Pingbacks:', TRANSLATION_KEY ); ?></h3>
            <ol class="pinglist">
                <?php wp_list_comments( 'type=pings&callback=list_pings&per_page=-1' ); ?>
            </ol>
        </div><!-- /#pings -->
    <?php } // end if ?>

<?php } else { ?>

    <?php if( comments_open() ) { ?>
        <div id="no-comments">
            <h3 class="page-header"><?php _e( 'No Comments', TRANSLATION_KEY ); ?></h3>
            <p><?php _e( 'Be the first to start the conversation.', TRANSLATION_KEY ); ?></p>
        </div><!-- /#no-comments -->
    <?php } // end if ?>

<?php } // end if ?>

<?php theme_comment_form(); ?>