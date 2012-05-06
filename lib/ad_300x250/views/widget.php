<div class="standard-ad-300x250 widget">
	<?php if( '' == $ad_url ) { ?>
		<img src="<?php echo $ad_src; ?> " alt="" width="300" height="250" />
	<?php } else { ?>
		<a href="<?php echo $ad_url; ?>" target="_blank"><img src="<?php echo $ad_src; ?> " alt="" width="300" height="250" /></a>
	<?php } // end if/else ?>
</div><!-- /.standard-ad-300x250 -->