<?php
/**
 * Renders the the Personal Image
 *
 * @subpackage	Personal Image
 * @since		3.0
 * @version 	1.0
 */
?>
<?php if( '' != $image_src ) { ?>	
	<?php echo $args['before_widget']; ?>
		<div class="standard-pi-pic">
		
			<?php if( 0 < strlen( trim( $image_url ) ) ) { ?>
				<a href="<?php echo $image_url; ?>">
			<?php } // end if ?>
		
			
			<img src="<?php echo $image_src; ?>" alt="" />
	
			
			<?php if( 0 < strlen( trim( $image_url ) ) ) { ?>
				</a>
			<?php } // end if ?>
		</div><!-- /.standard-pi-pic -->
		
		<?php if( '' != trim( $image_description ) ) { ?>
			<p class="standard-pi-bio"><?php echo $image_description; ?></p>
		<?php } // end if ?>
		
	<?php echo $args['after_widget']; ?>
<?php } // end if ?>