<?php
/**
 * Renders the administration dashboard for the Google Custom Search widget.
 *
 * @package		lean
 * @subpackage	Influence Widget
 * @version		1.1
 * @since		1.0
 */
?>
<div class="influence-wrapper">

<?php if( $this->supports_outbound_requests() ) { ?>

		<div class="option">
			<label><?php _e( 'Twitter:', TRANSLATION_KEY ); ?></label>
			<input type="text" id="<?php esc_attr_e( $this->get_field_id( 'twitter' ) ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'twitter' ) ); ?>" value="<?php echo $twitter; ?>" placeholder="<?php _e( 'Username (without \'@\')', TRANSLATION_KEY ); ?>" />
		</div><!-- /.option -->
	
		<div class="option">
			<label><?php _e( 'Facebook Fan Page:', TRANSLATION_KEY ); ?></label>
			<input type="text" id="<?php esc_attr_e( $this->get_field_id( 'facebook' ) ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'facebook' ) ); ?>" value="<?php echo $facebook; ?>" placeholder="<?php esc_attr_e( 'Username only', TRANSLATION_KEY ); ?>" />
		</div><!-- /.option -->
	
		<div class="option">
			<label class="inline"><?php _e( 'Display', TRANSLATION_KEY ); ?></label>
			<select id="<?php esc_attr_e( $this->get_field_id( 'display' ) ); ?>" name="<?php esc_attr_e( $this->get_field_name( 'display' ) );  ?>">
				<option <?php selected( $display, 'each' ); ?> value="each"><?php _e( 'Individual count', TRANSLATION_KEY ); ?></option>
				<option <?php selected( $display, 'total' ); ?> value="total"><?php _e( 'Total influence', TRANSLATION_KEY ); ?></option>
				<option <?php selected( $display, 'both' ); ?> value="both"><?php _e( 'Both', TRANSLATION_KEY ); ?></option>
			</select>
		</div><!-- /.option -->
		
		<?php if( array_key_exists( 'lean_influence_debug', $_GET ) && 'true' == $_GET['lean_influence_debug'] ) { ?>
			<div class="option errors">
				<fieldset>
					<legend>Error Log</legend>
					
					<?php if( '' != $twitter ) { ?>
						<p>
							<label><?php _e( 'Twitter', TRANSLATION_KEY ) ?></label>
							<span><?php echo $this->twitter_follower_count( $twitter, true ); ?></span>
						</p>
					<?php } // end if ?>
		
					<?php if( '' != $facebook ) { ?>
						<p>
							<label><?php _e( 'Facebook', TRANSLATION_KEY ) ?></label>
							<span><?php echo $this->facebook_like_count( $facebook, true ); ?></span>
						</p>
					<?php } // end if ?>
					
				</fieldset>
			</div><!-- /.errors -->
		<?php } // end if ?>
		
<?php } else { ?>

	<div class="option">
		<p><?php _e( 'Unfortunately, your web host does not support features that this widget requires.', TRANSLATION_KEY ); ?></p>
		<!--<p><?php _e( '<a href="TODO">Learn more</a> about this error.', TRANSLATION_KEY ); ?></p>-->
	</div><!-- /.option -->

<?php } // end if ?>

</div><!-- /.influence-wrapper -->