<?php
/**
 * Custom comments.
 *
 * @since	1.0
 * @version	1.0
 */

if( ! function_exists('custom_comment') ) {
    /**
     * Generates the comment container for each post (and page if enabled).
     *
     * @param	array $comment    The current comment being displayed.
     * @param	array $args       Array containing arguments for displaying the comment.
     * @param	int   $depth      The depth of where this comment falls in the tree.
     * @since	1.0
     * @version	1.0
     */
    function custom_comment( $comment, $args, $depth ) {
        $GLOBALS['comment'] = $comment; ?>

        <li <?php comment_class( 'clearfix' ); ?> id="li-comment-<?php comment_ID(); ?>">

        <div class="comment-container clearfix">

            <?php if ( "comment" == get_comment_type() ) { ?>
                <div class="avatar-holder">
                    <?php echo get_avatar( get_comment_author_email(), '50' ); ?>
                </div><!-- /.avatar-holder -->
            <?php } // end if ?>

            <div class="comment-entry"	id="comment-<?php comment_ID(); ?>">

                <div class="comment-head">
						<span class="name">
							<?php if( '' == get_comment_author_url() ) { ?>
                                <?php comment_author(); ?>
                            <?php } else { ?>
                                <a href="<?php comment_author_url(); ?>" target="_blank"><?php comment_author(); ?></a>
                            <?php } // end if/else ?>
						</span>
                    <?php if ( get_comment_type() == "comment" ) { ?>
                        <span class="date"><a href="<?php echo get_comment_link(); ?>" title="<?php esc_attr_e( 'Permalink', 'lean'); ?>"><?php printf( __( '%1$s at %2$s', '_s' ), get_comment_date( get_option( 'date_format' ) ), get_comment_time( get_option( 'time_format' ) ) ); ?></a></span>
                        <span class="edit"><?php edit_comment_link( __( 'Edit', 'lean' ), '', '' ); ?></span>
                    <?php } // end if ?>
                </div><!-- /.comment-head -->

                <?php if ( '0' == $comment->comment_approved ) { ?>
                    <span class='unapproved label warning'>
							<?php _e( 'Your comment will appear after being approved.', 'lean' ); ?>
						</span>
                <?php } // end if ?>

                <div class="comment-text">
                    <?php comment_text(); ?>
                </div><!-- /.comment-text -->

                <div class="reply clearfix">
                    <?php
                    comment_reply_link(
                        array_merge(
                            $args,
                            array(
                                'depth' 		=> $depth,
                                'max_depth' 	=> $args['max_depth'],
                                'reply_text' 	=> __( 'Reply', 'lean')
                            )
                        )
                    );
                    ?>
                </div><!-- /.reply -->

            </div><!-- /.comment-entry -->
        </div><!-- /comment-container -->
    <?php } // end custom_comment
} // end if

/**
 * Generates the comment container for each post (and page if enabled).
 *
 * @param	array $comment    The current comment being displayed.
 * @param	array $args       Array containing arguments for displaying the comment.
 * @param	int   $depth      The depth of where this comment falls in the tree.
 * @since	1.0
 * @version	1.0
 */
function list_pings( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment; ?>
    <li id="comment-<?php comment_ID(); ?>">
		<span class="author">
			<?php comment_author_link(); ?>
		</span> -
		<span class="date">
			<?php echo get_comment_date( get_option( 'date_format' ) ); ?>
		</span>
		<span class="pingcontent">
			<?php comment_text(); ?>
		</span>
    </li>
<?php } // end list_pings