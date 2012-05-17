<div class="standard-ad-125x125">
	<div class="ad-row">
	
		<span class="left">
			<?php if( '' != $ad1_url && '' != $ad1_src ) { ?>
				<a href="<?php echo $ad1_url ?>" target="_blank">
					<img src="<?php echo $ad1_src ?>" alt="" width="125" height="125" />
				</a>
			<?php } elseif( '' != $ad1_src ) { ?>
				<img src="<?php echo $ad1_src ?>" alt="" width="125" height="125" />
			<?php } // end if/else ?>
		</span><!-- /.left -->
		
		<span class="right">
			<?php if( '' != $ad2_url && '' != $ad2_src ) { ?>
				<a href="<?php echo $ad2_url ?>" target="_blank">
					<img src="<?php echo $ad2_src ?>" alt="" width="125" height="125" />
				</a>
			<?php } elseif( '' != $ad2_src ) { ?>
				<img src="<?php echo $ad2_src ?>" alt="" width="125" height="125" />
			<?php } // end if/else ?>
		</span><!-- /.right -->
		
	</div><!-- /.ad-row -->
</div><!-- /.standard-ad-125x125-wrapper -->