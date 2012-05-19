<div class="standard-influence-wrapper">
	
	<?php if( 'both' == $display || 'total' == $display ) { ?>
		<div class="standard-influence-total">
			Total Influence: <?php echo number_format( $this->get_total_influence_count( $twitter, $facebook, $feedburner ) ); ?>
		</div><!-- /.standard-influence-total -->
	<?php } // end if  ?>

	<?php if( 'both' == $display || 'each' == $display ) { ?>
		<div class="standard-influence-total">
			<?php if( '' != $twitter ) { ?>
				Twitter: <?php echo number_format( $this->twitter_follower_count( $twitter ) ); ?>
				<br />
			<?php } // end if ?>
			
			<?php if( '' != $facebook ) { ?>
				Facebook: <?php echo number_format( $this->facebook_like_count( $facebook ) ); ?>
				<br />
			<?php } // end if ?>
			
			<?php if( '' != $feedburner ) { ?>
				FeedBurner: <?php echo number_format( $this->feedburner_subscriber_count( $feedburner ) ); ?>
				<br />
			<?php } // end if ?>	
		</div><!-- /.standard-influence-individual -->
	<?php } // end if/else ?>
	
</div><!-- /.standard-influence-wrapper -->