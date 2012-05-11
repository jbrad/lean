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

	<div class="option">
		<label class="inline"><?php _e( 'Display:', 'standard' ); ?></label>
		<select id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' );  ?>">
			<option <?php selected( $display, 'each' ); ?> value="each"><?php _e( 'Individual counts', 'standard' ); ?></option>
			<option <?php selected( $display, 'total' ); ?> value="total"><?php _e( 'Total influence', 'standard' ); ?></option>
		</select>
	</div><!-- /.option -->
	
	<?php if( array_key_exists( 'standard_influence_debug', $_GET ) && 'true' == $_GET['standard_influence_debug'] ) { ?>
		<div class="option errors">
			<fieldset>
				<legend>Error Log</legend>
				
				<?php if( '' != $twitter ) { ?>
					<p>
						<label><?php _e( 'Twitter', 'standard' ) ?></label>
						<span><?php echo $this->twitter_follower_count( $twitter, true ); ?></span>
					</p>
				<?php } // end if ?>
	
				<?php if( '' != $facebook ) { ?>
					<p>
						<label><?php _e( 'Facebook', 'standard' ) ?></label>
						<span><?php echo $this->facebook_like_count( $facebook, true ); ?></span>
					</p>
				<?php } // end if ?>
	
				<?php if( '' != $feedburner ) { ?>
					<p>
						<label><?php _e( 'FeedBurner', 'standard' ) ?></label>
						<span><?php echo $this->feedburner_subscriber_count( $feedburner, true ); ?></span>
					</p>
				<?php } // end if ?>
				
			</fieldset>
		</div><!-- /.errors -->
	<?php } // end if ?>

</div><!-- /.standard-influence-wrapper -->