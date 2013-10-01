<?php
/**
 * Renders the the 300x250 widget
 *
 * @package		lean
 * @subpackage	300x250 Advertisement
 * @version 	1.1
 * @since		1.0
 */
?>
<?php $global_options = get_option( 'theme_global_options' ); ?>

<?php echo $args['before_widget']; ?>
	<?php echo $this->display_ad( $ad_src, $ad_url ); ?>
<?php echo $args['after_widget']; ?>