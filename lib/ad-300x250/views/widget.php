<?php echo $args['before_widget']; ?>
	<?php if( '' == $ad_url ) { ?>
		<img src="<?php echo $ad_src; ?> " alt="" />
	<?php } else { ?>
		<a href="<?php echo $ad_url; ?>" target="_blank"><img src="<?php echo $ad_src; ?> " alt="" /></a>
	<?php } // end if/else ?>
<?php echo $args['after_widget']; ?>