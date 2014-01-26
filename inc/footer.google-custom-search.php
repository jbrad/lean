<?php
/**
 * If the Google Custom Search widget is active, then render the JavaScript necessary for the widget
 * in the header of the page.
 *
 * @version 1.1
 * @since 1.0
 */
function google_custom_search() {

    if( google_custom_search_is_active() ) {

        $gcse = get_option( 'widget_google-custom-search' );
        $gcse = array_shift( array_values ( $gcse ) );

        ?>
        <script type="text/javascript">
            (function() {
                var cx = '<?php echo trim( $gcse['gcse_content'] ); ?>';
                var gcse = document.createElement('script'); gcse.type = 'text/javascript'; gcse.async = true;
                gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
                    '//www.google.com/cse/cse.js?cx=' + cx;
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
            })();
        </script>
    <?php
    } // end if

} // end google_custom_search
add_action( 'wp_footer', 'google_custom_search' );
?>