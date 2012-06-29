<div class="google-custom-search wrapper">

    <div class="option">
    	<p><?php _e( 'Paste your Google Custom Search Engine code here. ', 'standard' ); ?>
    	<?php _e( '<em><a href="http://docs.8bit.io/standard/widgets/google-custom-search-widget/" target="_blank">Learn More</a>.</em>', 'standard'); ?></p>
    	<textarea id="<?php echo $this->get_field_id( 'gcse_content' ); ?>" name="<?php echo $this->get_field_name( 'gcse_content' ); ?>" rows="10" cols="30"><?php echo $gcse_content; ?></textarea>
    </div><!-- /.option -->
    
</div><!-- /wrapper -->