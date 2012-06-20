<?php echo $args['before_widget']; ?>
	<?php if ( '' != $gcse_title) { ?>
		<h4 class="widget-title google-custom-search"><?php echo $gcse_title; ?></h4>
	<?php } // end if ?>
	<?php echo $gcse_content; ?>
<?php echo $args['after_widget']; ?>