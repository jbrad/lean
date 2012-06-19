<div class="widget standard-pi-widget">
	<div class="standard-pi-pic">
	<?php if( strlen( trim( $image_url ) ) > 0 ) { ?>
		<a href="<?php echo $image_url; ?>">
	<?php } // end if ?>
	
		<img src="<?php echo $image_src; ?>" alt="" />
	
	<?php if( strlen( trim( $image_url ) ) > 0 ) { ?>
		</a>
	<?php } // end if ?>
	</div><!-- /.standard-pi-pic -->
	<p class="standard-pi-bio"><?php echo $image_description; ?></p>
</div><!-- /.standard-pi-widget -->