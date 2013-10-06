<?php
/**
 * Renders the the Influence Widget.
 *
 * @package		lean
 * @subpackage	Influence Widget
 * @version 	1.1
 * @since		1.0
 */
?>
<?php if( $this->supports_outbound_requests() ) { ?>
	<?php echo $args['before_widget']; ?>
		
		<?php if( 'both' == $display || 'total' == $display ) { ?>
			<div class="si-total">
				<div class="si-total-number"><?php  echo number_format( $this->get_total_influence_count( $twitter, $facebook ) ); ?></div>
				<span class="si-total-title">Social Influence</span>
			</div><!-- /.si-total -->
		<?php } // end if  ?>
	
		<?php if( 'both' == $display || 'each' == $display ) { ?>
			<div class="si-individual">
				<ul class="si-indvidual-list">
					<?php if( '' != $twitter ) { ?>
						<li class="si-twitter">
							<span class="icon-twitter-sign"></span><a href="http://twitter.com/<?php echo $twitter; ?>/" title="Twitter" target="_blank"><?php echo number_format( $this->twitter_follower_count( $twitter ) ); ?></a>
						</li>
					<?php } // end if ?>
					
					<?php if( '' != $facebook ) { ?>
						<li class="si-facebook">
                            <span class="icon-facebook-sign"></span><a href="http://facebook.com/<?php echo $facebook; ?>/" title="Facebook" target="_blank"><?php echo number_format( $this->facebook_like_count( $facebook ) ); ?></a>
						</li>
					<?php } // end if ?>
				</ul>
			</div><!-- /.si-individual -->
		<?php } // end if/else ?>
		
	<?php echo $args['after_widget']; ?>
<?php } // end if ?>