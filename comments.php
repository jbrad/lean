<?php
/**
 * The template for displaying comments, pings, and trackbacks on posts, pages, and attachments.
 *
 * @package Lean
 * @version	1.0
 * @since 	1.0
 */
?>
<?php 
	if ( ! empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) ) {
		die ( __( 'This file cannot be loaded directly.', 'lean' ) );
	} // end if
?>

<?php if ( post_password_required() ) { ?>
	<div id="comments">
		<h3 class="nopassword"><?php _e( 'This post is password protected. Enter the password to view comments.', 'lean' ); ?></h3>
	</div><!-- #comments -->
	<?php return; ?>
<?php } // end if	?>

<?php if ( have_comments() ) { ?>

	<?php if ( ! empty( $comments_by_type['comment'] ) ) { ?>
		<div id="comments" class="clearfix">
			<h3><?php comments_number( __( 'No responses', 'lean' ), __( 'One response', 'lean' ), __( '% responses', 'lean' ) );?> <?php _e( 'to',  'lean' ); ?> <em><?php the_title(); ?></em></h3>
			<ol class="commentlist">
				<?php wp_list_comments( 'avatar_size=50&callback=lean_custom_comment&type=comment' ); ?>
			</ol>    
			<div class="comment-navigation clearfix">
				<div class="comment-prev-nav">
					<?php previous_comments_link( '<i class="icon-chevron-left"></i>' . __( 'Previous Comments', 'lean' ) ); ?>
				</div>
				<div class="comment-next-nav">
					<?php next_comments_link( __( 'Next Comments', 'lean' ) . '<i class="icon-chevron-right"></i>'); ?>
				</div>
			</div>
		</div><!-- /#comments -->
	<?php } // end if ?>

	<?php if ( ! empty( $comments_by_type['pings'] ) ) { ?>
		<div id="pings">
			<h3>
				<?php _e( 'Trackbacks and Pingbacks:', 'lean' ); ?>
			</h3>
			<ol class="pinglist">
				<?php wp_list_comments( 'type=pings&callback=list_pings&per_page=-1' ); ?>
			</ol>
		</div><!-- /#pings -->
	<?php } // end if ?>	
	
<?php } else { ?>

	<?php if( comments_open() ) { ?>
		<div id="no-comments" class="clearfix">
			<p class="title"><?php _e( 'No Comments', 'lean' ); ?></p>
			<p><?php _e( 'Be the first to start the conversation.', 'lean' ); ?></p>
		</div><!-- /#no-comments -->
	<?php } // end if ?>
	
<?php } // end if ?>

<?php lean_comment_form(); ?>