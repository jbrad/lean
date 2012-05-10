<div class="standard-personal-image-wrapper">

    <div class="option">
    
    	<label for="<?php echo $this->get_field_id( 'image_src' ); ?>"><?php _e( 'Personal Image:', 'standard' ); ?></label>

		<div class="preview_image_container">
	    	<img src="<?php echo $image_src; ?>" alt="" class="preview_image" />
	    </div><!-- /.preview_image_container -->
    	
    	<span class="description"><?php _e( 'Maximum width is 300 pixels.', 'standard' ); ?></span>
    	<a href="javascript:;" class="img_delete <?php echo '' == $image_src ? 'hidden' : '' ?>"><?php _e( 'Delete Image', 'standard' ); ?></a>
    	
		<!-- Hidden fields used to track uploaded images and links -->
		<input type="hidden" id="<?php echo $this->get_field_id( 'image_src' ); ?>" name="<?php echo $this->get_field_name( 'image_src' ); ?>" value="<?php echo $image_src; ?>" class="img_src" />
		<!-- /Hidden -->
    	
    </div><!-- /.option -->
    
    <div class="bio option">
    	<label for="<?php echo $this->get_field_id( 'image_description' ); ?>"><?php _e( 'Bio (Optional):', 'standard' ); ?></label>
    	<textarea id="<?php echo $this->get_field_id( 'image_description' ); ?>" name="<?php echo $this->get_field_name( 'image_description' ); ?>" maxlength="160" rows="3" cols="30"><?php echo $image_description; ?></textarea>
    	<span class="description"><?php _e( '160 character limit.', 'standard' ); ?></span>
    </div><!-- /.option -->
    
</div><!-- /.standard-personal-image-wrapper -->