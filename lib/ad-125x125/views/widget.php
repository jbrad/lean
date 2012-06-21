<?php echo $args['before_widget']; ?>
	<div class="ad-row">
		<ul class="thumbnails">
			<li class="span2">
			
				<?php if( '' == $ad1_url && '' == $ad1_src ) { ?>
					<a class="thumbnail" href="http://standardtheme.com" target="_blank">
						<img src="<?php echo get_template_directory_uri() . '/lib/ad-125x125/css/fake-125.jpg' ?>" alt="Standard" />
					</a>
				<?php } elseif( '' != $ad1_url && '' != $ad1_src ) { ?>
					<a class="thumbnail" href="<?php echo $ad1_url ?>" target="_blank">
						<img src="<?php echo $ad1_src ?>" alt="" />
					</a>
				<?php } elseif( '' != $ad1_src ) { ?>
					<div class="thumbnail">
						<img src="<?php echo $ad1_src ?>" alt="" />
					</div> <!-- ad thumbnail -->
				<?php } // end if/else ?>
			</li><!-- /.left -->
			
			<li class="span2">
				<?php if( '' == $ad2_url && '' == $ad2_src ) { ?>
					<a class="thumbnail" href="http://standardtheme.com" target="_blank">
						<img src="<?php echo get_template_directory_uri() . '/lib/ad-125x125/css/fake-125.jpg' ?>" alt="Standard" />
					</a>
				<?php } elseif( '' != $ad2_url && '' != $ad2_src ) { ?>
					<a class="thumbnail" href="<?php echo $ad2_url ?>" target="_blank">
						<img src="<?php echo $ad2_src ?>" alt="" />
					</a>
				<?php } elseif( '' != $ad2_src ) { ?>
					<div class="thumbnail">
						<img src="<?php echo $ad2_src ?>" alt="" />
					</div> <!-- ad thumbnail -->
				<?php } // end if/else ?>
			</li><!-- /.right -->
		</ul><!-- /.thumbnails -->
		
	</div><!-- /.ad-row -->
<?php echo $args['after_widget']; ?>