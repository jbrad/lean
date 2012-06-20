<?php echo $args['before_widget']; ?>
	<div class="standard-pi-pic">
	<?php if( strlen( trim( $image_url ) ) > 0 ) { ?>
		<a href="<?php echo $image_url; ?>">
	<?php } // end if ?>
	
		<img src="<?php echo $image_src; ?>" alt="" />
	
	<?php if( strlen( trim( $image_url ) ) > 0 ) { ?>
		</a>
	<?php } // end if ?>
	</div><!-- /.standard-pi-pic -->
	<?php if( '' != trim( $image_description ) ) { ?>
		<p class="standard-pi-bio"><?php echo $image_description; ?></p>
	<?php } // end if ?>
<?php echo $args['after_widget']; ?>