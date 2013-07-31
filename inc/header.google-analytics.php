<?php

/**
 * TODO
 *
 * @version 1.0.0
 * @since   3.4.0
 */
function standard_theme_google_analytics() {

	$global_options = get_option( 'standard_theme_global_options' );
	if( '' != $global_options['google_analytics'] ) {

		if( is_user_logged_in() ) { ?>

			<!-- Google Analytics is restricted only to users who are not logged in. -->

		<?php } else { ?>

			<script type="text/javascript">
				var _gaq = _gaq || [];
				_gaq.push(['_setAccount', '<?php echo $global_options[ 'google_analytics' ] ?>']);
				_gaq.push(['_trackPageview']);
				_gaq.push(['_trackPageLoadTime']);

				if( 0 != strlen( $global_options[ 'google_analytics_domain'] ) ) {
					_gaq.push(['_setDomainName', '<?php echo $global_options[ 'google_analytics_domain' ] ?>']);
				} // end if/else

				if( 1 == $global_options[ 'google_analytics_linker'] ) {
					_gaq.push(['_setAllowLinker', true]);
				} // end if/else

				(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				})();
			</script>

		<?php
		} // end if/else

	} // end if

} // end standard_theme_google_analytics
add_action( 'wp_head', 'standard_theme_google_analytics' );
?>