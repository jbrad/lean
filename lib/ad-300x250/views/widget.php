<?php echo $args['before_widget']; ?>
	<?php if( '' == $ad_src ) { ?>
		<a href="http://standardtheme.com" target="_blank">
			<img src="<?php echo get_template_directory_uri() . '/lib/ad-300x250/images/standard-300.jpg' ?>" alt="Standard" />
		</a>
	<?php } else { ?>
		<a href="<?php echo $ad_url; ?>" target="_blank"><img src="<?php echo $ad_src; ?> " alt="" /></a>
	<?php } // end if/else ?>
<?php echo $args['after_widget']; ?>