<?php
/**
 * Renders the the 125x125 widget
 *
 * @package		Standard
 * @subpackage	125x125 Advertisement
 * @version 	1.0
 * @since		3.0
 */
?>
<?php 
	$global_options = get_option( 'standard_theme_global_options' );
	$default_url = 'http://standardtheme.com';
?>

<?php echo isset( $args['before_widget'] ) ? $args['before_widget'] : ''; ?>
	<div class="standard-ad-row">
		<ul class="thumbnails">
			<li class="span2">
				<?php $ad_url = 0 == strlen( $ad1_url ) ? $default_url : $ad1_url; ?>
				<?php if( '' == $ad1_url && '' == $ad1_src ) { ?>
					<a class="thumbnail" href="<?php echo $default_url; ?>" target="_blank">
						<img src="<?php echo get_template_directory_uri() . '/lib/standard-ad-125x125/images/standard-125-1.jpg' ?>" alt="<?php __( 'Standard', 'standard' ); ?>" />
					</a>
				<?php } elseif( '' != $ad1_url && '' != $ad1_src ) { ?>
					<a class="thumbnail" href="<?php echo $ad1_url ?>" target="_blank">
						<img src="<?php echo $ad1_src ?>" alt="" />
					</a>
				<?php } // end if/else ?>
			</li><!-- /.left -->
			
			<li class="span2">
				<?php $ad_url = 0 == strlen( $ad2_url ) ? $default_url : $ad1_url; ?>
				<?php if( '' == $ad2_url && '' == $ad2_src ) { ?>
					<a class="thumbnail" href="<?php echo $default_url; ?>" target="_blank">
						<img src="<?php echo get_template_directory_uri() . '/lib/standard-ad-125x125/images/standard-125-2.jpg' ?>" alt="<?php __( 'Standard', 'standard' ); ?>" />
					</a>
				<?php } elseif( '' != $ad2_url && '' != $ad2_src ) { ?>
					<a class="thumbnail" href="<?php echo $ad2_url ?>" target="_blank">
						<img src="<?php echo $ad2_src ?>" alt="" />
					</a>
				<?php } // end if/else ?>
			</li><!-- /.right -->
		</ul><!-- /.thumbnails -->
		
	</div><!-- /.standard-ad-row -->
<?php echo isset( $args['after_widget'] ) ? $args['after_widget'] : ''; ?>