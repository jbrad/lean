<div class="standard-influence-wrapper">

	<?php if( '' != $twitter ) { ?>
		Twitter: <?php echo $this->twitter_follower_count( $twitter ); ?>
		<br />
	<?php } // end if ?>
	
	<?php if( '' != $facebook ) { ?>
		Facebook: <?php echo $this->facebook_like_count( $facebook ); ?>
		<br />
	<?php } // end if ?>
	
	<?php if( '' != $feedburner ) { ?>
		FeedBurner: <?php echo $this->feedburner_subscriber_count( $feedburner ); ?>
		<br />
	<?php } // end if ?>
	
	Total Influence: <?php echo $this->get_total_influence_count( $twitter, $facebook, $feedburner ); ?>
	
</div><!-- /.standard-influence-wrapper -->