<?php
/**
 * Renders the the Personal Image
 *
 * @package		lean
 * @subpackage	Personal Image Widget
 * @version 	1.1
 * @since		1.0
 */
?>
<?php if( '' != $image_src ) { ?>	
	<?php echo $args['before_widget']; ?>
    <div class="personal-image thumbnail">
        <?php if( 0 < strlen( trim( $image_url ) ) ) { ?>
            <a href="<?php echo $image_url; ?>">
        <?php } // end if ?>

        <img src="<?php echo $image_src; ?>" alt="" />

        <?php if( 0 < strlen( trim( $image_url ) ) ) { ?>
            </a>
        <?php } // end if ?>
        <div class="caption">
            <?php echo $image_description; ?>
        </div>
    </div>
	<?php echo $args['after_widget']; ?>
<?php } // end if ?>