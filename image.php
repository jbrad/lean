<?php
/**
 * The template for rendering images and attached images.
 *
 * @package lean
 * @version	1.1
 * @since 	1.0
 */
?>
<?php get_header(); ?>
<?php $presentation_options = get_option( 'theme_presentation_options' ); ?>

    <div id="wrapper">
        <div class="container">
            <div class="row">

                <section id="main"
                         role="main"
                         class="col-12 <?php echo 'full_width_layout' == $presentation_options['layout'] || get_post_meta( get_the_ID(), 'standard_seo_post_level_layout', true ) ? 'col-md-12' : 'col-md-8 col-sm-8'; ?> <?php echo 'left_sidebar_layout' == $presentation_options['layout'] ? ' col-md-push-4' : ''; ?>">

                    <?php get_template_part( 'breadcrumbs' ); ?>

                    <?php if ( have_posts() ) { ?>
                        <?php while ( have_posts() ) { ?>
                            <?php the_post(); ?>

                            <article id="post-<?php the_ID(); ?>" <?php post_class( 'post format-standard' ); ?>>

                                <div class="post-header clearfix">
                                    <div class="title-wrap">
                                        <h1 class="post-title entry-title"><?php the_title(); ?></h1>
                                        <div class="post-header-meta">
                                            <?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( 'Permalink to %s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>"><time class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></time></a>
                                            <?php } else { ?>
                                                <time class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></time>
                                            <?php } // end if/else ?>
                                        </div><!-- /.post-header-meta -->
                                    </div><!-- /.title-wrap -->
                                </div> <!-- /.post-header -->

                                <div id="content-<?php the_ID(); ?>" class="entry-content">
                                    <div class="content">
                                        <?php $image_attributes = wp_get_attachment_image_src( $attachment_id, 'large' ); ?>
                                        <img src="<?php echo esc_url( $image_attributes[0] ); ?>" width="<?php echo $image_attributes[1]; ?>" height="<?php echo $image_attributes[2]; ?>" />
                                    </div><!-- ./content -->
                                    <div id="image-thumbnails" class="clearfix">
                                        <div class="pull-left">
                                            <?php previous_image_link(); ?>
                                        </div>
                                        <div class="pull-right">
                                            <?php next_image_link(); ?>
                                        </div>
                                    </div><!-- /#image-thumbmails -->
                                </div><!-- /.entry-content -->
                            </article> <!-- /#post -->
                            <?php comments_template( '', true ); ?>
                            <?php get_template_part( 'pagination' ); ?>

                        <?php } // end while ?>
                    <?php } // end if  ?>
                </section><!-- /#main -->

                <?php get_sidebar(); ?>

            </div><!-- /.row -->
        </div><!-- /.container -->
    </div><!-- /#wrapper -->

<?php get_footer(); ?>