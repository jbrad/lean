<?php
/**
 * Renders the the 300x250 widget
 *
 * @package		Standard
 * @subpackage	300x250 Advertisement
 * @version 	1.0
 * @since		3.0
 */
?>

<?php 
	$global_options = get_option( 'standard_theme_global_options' );
	$default_url = 'http://standardtheme.com';
?>

<?php echo $args['before_widget']; ?>
	<?php if( '' == $ad_src ) { ?>
		<a href="<?php echo $default_url; ?>" target="_blank">
			<img src="<?php echo get_template_directory_uri() . '/lib/standard-ad-300x250/images/standard-300.jpg' ?>" alt="Standard" />
		</a>
	<?php } else { ?>
		<?php $ad_url = 0 == strlen( $ad_url ) ? $default_url : $ad_url; ?>
		<a href="<?php echo $ad_url; ?>" target="_blank">
			<img src="<?php echo $ad_src; ?> " alt="" />
		</a>
	<?php } // end if/else ?>
<?php echo $args['after_widget']; ?>