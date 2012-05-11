<div class="standard-influence-wrapper">

	<div class="option">
		<label><?php _e( 'Twitter:', 'standard' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo $twitter; ?>" />
		<p class="example"><?php _e( 'http://twitter.com/<strong>standardtheme</strong>', 'standard' ); ?></p>
	</div><!-- /.option -->

	<div class="option">
		<label><?php _e( 'Facebook:', 'standard' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo $facebook; ?>" />
		<p class="example"><?php _e( 'http://facebook.com/<strong>standardtheme</strong>', 'standard' ); ?></p>
	</div><!-- /.option -->
	
	<div class="option">
		<label><?php _e( 'FeedBurner:', 'standard' ); ?></label>
		<input type="text" id="<?php echo $this->get_field_id( 'feedburner' ); ?>" name="<?php echo $this->get_field_name( 'feedburner' ); ?>" value="<?php echo $feedburner; ?>" />
		<p class="example"><?php _e( 'http://feeds.feedburner.com/<strong>8BIT</strong>', 'standard' ); ?></p>
	</div><!-- /.option -->

</div><!-- /.standard-influence-wrapper -->