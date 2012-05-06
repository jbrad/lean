<div class="standard-ad-300x250-wrapper">

	<?php if( '' == $ad_url ) { ?>
		<img src="<?php echo $ad_src; ?>" alt="" />
	<?php } else { ?>
		<a href="<?php echo $ad_url; ?>" target="_blank" class="ad_url"><img src="<?php echo $ad_src; ?>" alt="" /></a>
	<?php } // end if/else ?>
	
	<!-- Hidden fields used to track uploaded images and links -->
	<input type="hidden" id="<?php echo $this->get_field_id( 'ad_src' ); ?>" name="<?php echo $this->get_field_name( 'ad_src' ); ?>" value="<?php echo $ad_src; ?>" class="ad_src" />
	<input type="hidden" id="<?php echo $this->get_field_id( 'ad_url' ); ?>" name="<?php echo $this->get_field_name( 'ad_url' ); ?>" value="<?php echo $ad_url; ?>" class="ad_url" />
	<input type="hidden" class="widget-parent-id" value="" />
	<!-- /Hidden fields -->

	<a href="javascript:;" class="ad_delete <?php echo ('' == $ad_url && '' == $ad_src) ? 'hidden' : '' ?>"><?php _e( 'Delete Advertisement', 'standard' ); ?></a>
	<a href="javascript:;" class="ad_upload <?php echo ('' != $ad_url || '' != $ad_src) ? 'hidden' : '' ?>"><?php _e( 'Upload Advertisement', 'standard'); ?></a>
	
</div><!-- /.standard-ad-300x250-wrapper -->