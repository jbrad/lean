<div class="standard-ad-468x60 span7">
	<?php if( '' == $ad_url ) { ?>
		<img src="<?php echo $ad_src; ?> " alt="" width="468" height="60" />
	<?php } else { ?>
		<a href="<?php echo $ad_url; ?>" target="_blank"><img src="<?php echo $ad_src; ?> " alt="" width="468" height="60" /></a>
	<?php } // end if/else ?>
</div><!-- /.standard-ad-468x60-->