<div class="google-custom-search wrapper">

    <div class="option">
    	<label for="<?php echo $this->get_field_id( 'gcse_title' ); ?>"><?php _e( 'Title (Optional):', 'standard '); ?></label>
    	<input type="text" id="<?php echo $this->get_field_id( 'gcse_title' ); ?>" name="<?php echo $this->get_field_name( 'gcse_title' ); ?>" value="<?php echo strip_tags( stripslashes( $gcse_title ) ); ?>" />
    </div><!-- /.option -->
    
    <br />
    
    <div class="option">
    	<label for="<?php echo $this->get_field_id( 'gcse_content' ); ?>"><?php _e( 'Paste the code provided by Google for your search box:', 'standard'); ?></label>
    	<textarea id="<?php echo $this->get_field_id( 'gcse_content' ); ?>" name="<?php echo $this->get_field_name( 'gcse_content' ); ?>" rows="10" cols="30"><?php echo $gcse_content; ?></textarea>
    </div><!-- /.option -->
    
</div><!-- /wrapper -->