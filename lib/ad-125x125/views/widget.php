<?php
/**
 * Renders the the 125x125 widget
 *
 * @package		lean
 * @subpackage	125x125 Advertisement
 * @version 	1.2.1
 * @since		3.0
 */
?>
<?php $global_options = get_option( 'theme_global_options' ); $default_url = ''; ?>

<?php echo isset( $args['before_widget'] ) ? $args['before_widget'] : ''; ?>
    <div class="ad-row widget">
        <ul class="thumbnails row">
            <li class="col-md-6">
                <figure class="thumbnail">
                    <?php echo $this->display_ad( $ad1_src, $ad1_url, 1 ); ?>
                </figure><!--/.thumbnail -->
            </li><!-- /.left -->
            <li class="col-md-6">
                <figure class="thumbnail">
                    <?php echo $this->display_ad( $ad2_src, $ad2_url, 2 ); ?>
                </figure><!-- /.thumbnail -->
            </li><!-- /.right -->
        </ul><!-- /.thumbnails -->
    </div><!-- /.ad-row -->
<?php echo isset( $args['after_widget'] ) ? $args['after_widget'] : ''; ?>