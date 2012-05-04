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
		<div style="width:640px;margin:0 auto;padding:120px;text-align:center;">
			<iframe width="560" height="315" src="http://www.youtube.com/embed/WUUptX0i55g" frameborder="0" allowfullscreen></iframe>
			<?php $options = get_option( 'standard_theme_general_options' ); ?>
			<h1>PC Load Letter? The Fck does that mean?</h1>
			<p><?php echo $options['offline_mode_message']; ?></p> 
		</div>
	</body>
</html>