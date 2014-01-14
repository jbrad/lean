<?php
/**
 * The template for displaying standard post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post panel panel-default format-standard clearfix' ); ?>>

	<div class="post-header clearfix">

		<?php $presentation_options = get_option( 'theme_presentation_options' ); ?>
		<?php if ( '' != get_the_post_thumbnail() ) { ?>
			<?php if( $presentation_options['display_featured_images'] == 'always' || ( $presentation_options['display_featured_images'] == 'single-post' && is_single() ) || ( $presentation_options['display_featured_images'] == 'index' && is_home() ) ) { ?>
				<figure class="thumbnail pull-left">
					<a class="thumbnail-link fademe" href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( '%s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>">
						<?php the_post_thumbnail( 'thumbnail' ); ?>
					</a>
				</figure> <!-- /.thumbnail -->
			<?php } // end if ?> 
		<?php } // end if ?> 
		<div class="title-wrap clearfix">

            <?php get_template_part( 'includes/loop.post-title' ); ?>

			<div class="post-header-meta text-muted">
				<?php if( is_multi_author() ) { ?>
					<span class="the-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a>&nbsp;&mdash;&nbsp;</span>
				<?php } // end if ?>
				<?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>"><time class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></time></a>
				<?php } else { ?>
					<time class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></time>
				<?php } // end if/else ?>
				<?php if( comments_open() ) { ?>
					<span class="the-comment-link">&mdash;&nbsp;<?php comments_popup_link( __( 'Leave a comment', TRANSLATION_KEY ), __( '1 Comment', TRANSLATION_KEY ), __( '% Comments', TRANSLATION_KEY ), '', '' ); ?></span>
				<?php } // end if ?>
			</div><!-- /.post-header-meta -->

		</div><!-- /.title-wrap -->

	</div> <!-- /.post-header -->

	<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
        <?php get_template_part( 'includes/loop.post-content' ); ?>
        <?php get_template_part( 'includes/loop.post-link-pages' ); ?>
	</div><!-- /.entry-content -->

    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->
