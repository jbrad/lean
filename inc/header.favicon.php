<?php
/**
 * If the user has defined a Google Analytics code, then this will write it out to the <head>
 * element of the page.
 *
 * @version 1.1
 * @since   1.0
 */
function fav_icon() {

    $presentation_options = get_option( 'theme_presentation_options');

    if( '' != $presentation_options['fav_icon'] ) {
        ?>
        <link rel="shortcut icon" href="<?php echo $presentation_options['fav_icon']; ?>" />
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $presentation_options['fav_icon']; ?>" />
    <?php
    } // end if

} // end fav_icon
add_action( 'wp_head', 'fav_icon' );
?>