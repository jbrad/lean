<?php
/**
 * The template for displaying quote post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php /* Main Loop */ ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post panel panel-default format-quote clearfix' ); ?>>
		
	<div class="post-header clearfix">
			<div class="content row">
                <div class="col-sm-1 hidden-xs">
                    <span class="fa fa-quote-left"></span>
                </div> <!-- /.col-md-1 -->
                <div class="col-sm-11 col-xs-12">
                    <?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
                        <?php the_excerpt( ); ?>
                        <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', TRANSLATION_KEY ); ?></a>
                    <?php } else { ?>
                        <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
                    <?php } // end if/else ?>
                </div> <!-- /.col-md-11 -->
			</div><!-- /.entry-content -->
	</div> <!-- /.post-header -->

	<div id="content-<?php the_ID(); ?>" class="entry-content clearfix">

        <h1 class="post-title entry-title">
        <?php if( is_single() || is_page() ) { ?>
            <?php the_title(); ?>
        <?php } else { ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
        <?php } // end if ?>
        </h1>

        <?php
            wp_link_pages(
                array(
                    'before' 	=> '<div class="page-link"><span>' . __( 'Pages:', TRANSLATION_KEY ) . '</span>',
                    'after' 	=> '</div>'
                )
            );
        ?>
		
	</div><!-- /.entry-content -->
	
    <?php get_template_part( 'includes/loop.post-meta' ); ?>

</article><!-- /#post -->