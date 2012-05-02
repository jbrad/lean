<!DOCTYPE html>
<!--[if IE 8 ]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
	<head>	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11" />
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<title><?php wp_title( '' ); ?></title>
		<?php $option = get_option( 'standard_theme_general_options'); ?>
		<?php if( '' != $option['fav_icon'] ) { ?>
			<link rel="shortcut icon" href="<?php echo $option['fav_icon']; ?>" />
			<link rel="apple-touch-icon-precomposed" href="<?php echo $option['fav_icon']; ?>" />
			<link rel="apple-touch-icon-precomposed" href="<?php echo $option['fav_icon']; ?>" />
			<link rel="apple-touch-icon" href="<?php echo $option['fav_icon']; ?>" />
		<?php } // end if ?>
		<?php if( '' != $option['google_analytics'] ) { ?>
			<script type="text/javascript">
				var _gaq = _gaq || [];
				_gaq.push(['_setAccount', '<?php echo $option[ 'google_analytics' ] ?>']);
				_gaq.push(['_trackPageview']);
	
				(function() {
					var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
					var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
				})();
			</script>
		<?php } // end if ?>
		<?php wp_head(); ?>
	</head>
	<body <?php body_class(); ?>>
		<h1>Needs work from <a href="http://twitter.com/alliswell">@alliswell</a></h1>
		
		<?php $options = get_option( 'standard_theme_general_options' ); ?>
		<p><?php echo $options['offline_mode_message']; ?></p>
	</body>
</html>