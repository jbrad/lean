<div class="standard-personal-image">
	
	<?php if( strlen( trim( $image_url ) ) > 0 ) { ?>
		<a href="<?php echo $image_url; ?>">
	<?php } // end if ?>
	
		<img class="standard-personal-image" src="<?php echo $image_src; ?>" alt="" />
	
	<?php if( strlen( trim( $image_url ) ) > 0 ) { ?>
		</a>
	<?php } // end if ?>
	
	<p class="standard-personal-image_bio"><?php echo $image_description; ?></p>
</div><!-- /.standard-personal-image -->