<?php
/**
 * Renders the administration dashboard for the Personal Image widget.
 *
 * @package		Lean
 * @subpackage	Personal Image Widget
 * @version 	1.0
 * @since		3.0
 */
?>
<div class="personal-image-wrapper">

    <div class="option">
    
    	<label for="<?php echo $this->get_field_id( 'image_src' ); ?>"><?php _e( 'Personal Image:', 'lean' ); ?></label>

		<div class="personal_image_preview_image_container">
	    	<img src="<?php echo $image_src; ?>" alt="" class="preview_image" />
	    </div><!-- /.preview_image_container -->
    	
    	<span class="description"><?php _e( 'Maximum width is 360 pixels.', 'lean' ); ?></span>
    	<a href="javascript:;" class="img_delete <?php echo '' == $image_src ? 'hidden' : '' ?>"><?php _e( 'Delete Image', 'lean' ); ?></a>
    	
		<!-- Hidden fields used to track the default headshot, uploaded images, and links -->
		<input type="hidden" id="personal-image-default-url" value="<?php echo get_template_directory_uri() . '/lib/personal-image/css/fake-personal.jpg' ?>" />
		<input type="hidden" id="<?php echo $this->get_field_id( 'image_src' ); ?>" name="<?php echo $this->get_field_name( 'image_src' ); ?>" value="<?php echo $image_src; ?>" class="img_src" />
		<input type="hidden" id="<?php echo $this->get_field_id( 'image_url' ); ?>" name="<?php echo $this->get_field_name( 'image_url' ); ?>" value="<?php echo $image_url; ?>" class="img_url" />

		<!-- /Hidden -->
    	
    </div><!-- /.option -->
    
    <div class="bio option">
    	<label for="<?php echo $this->get_field_id( 'image_description' ); ?>"><?php _e( 'Bio (Optional):', 'lean' ); ?></label>
    	<textarea id="<?php echo $this->get_field_id( 'image_description' ); ?>" name="<?php echo $this->get_field_name( 'image_description' ); ?>" maxlength="400" rows="3" cols="30"><?php echo $image_description; ?></textarea>
    	<p class="description"><span><?php _e( '400', 'lean' ); ?></span>&nbsp;<?php _e( 'characters remaining', 'lean' ); ?></p>
    </div><!-- /.option -->
    
</div><!-- /.personal-image-wrapper -->