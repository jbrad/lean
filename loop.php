<?php
/**
 * The template for displaying standard post formats.
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post format-standard clearfix' ); ?>>

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

            <h1 class="post-title entry-title">
                <?php if( is_single() || is_page() ) { ?>
                    <?php the_title(); ?>
                <?php } else { ?>
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>"><?php the_title(); ?></a>
                <?php } // end if ?>
            </h1>

            <div class="post-header-meta text-muted">
                <?php if( strlen( trim( get_the_title() ) ) == 0 ) { ?>
                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php printf( esc_attr__( '%s', TRANSLATION_KEY ), the_title_attribute( 'echo=0' ) ); ?>"><time class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></time></a>
                <?php } else { ?>
                    <time class="the-time updated"><?php the_time( get_option( 'date_format' ) ); ?></time>
                <?php } // end if/else ?>
                <?php if( is_multi_author() ) { ?>
                    by <span class="the-author"><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo get_the_author_meta( 'display_name' ); ?>"><?php echo the_author_meta( 'display_name' ); ?></a></span>
                <?php } // end if ?>
            </div><!-- /.post-header-meta -->

        </div><!-- /.title-wrap -->

    </div> <!-- /.post-header -->

    <div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
        <?php if( ( is_category() || is_archive() || is_home() ) && has_excerpt() ) { ?>
            <?php the_excerpt( ); ?>
            <a href="<?php echo get_permalink(); ?>"><?php _e( 'Continue Reading...', TRANSLATION_KEY ); ?></a>
        <?php } else { ?>
            <?php the_content( __( 'Continue Reading...', TRANSLATION_KEY ) ); ?>
        <?php } // end if/else ?>
        <?php
        wp_link_pages(
            array(
                'before' 	=> '<div class="page-link"><span>' . __( 'Pages:', TRANSLATION_KEY ) . '</span>',
                'after' 	=> '</div>'
            )
        );
        ?>
    </div><!-- /.entry-content -->

    <div class="post-meta text-muted clearfix">

        <div class="meta-date-cat-tags pull-left">

            <?php $category_list = get_the_category_list( __( ' ', TRANSLATION_KEY ) ); ?>
            <?php if( $category_list ) { ?>
                <?php printf( '<span class="the-category">' . __( '%1$s&nbsp;', TRANSLATION_KEY ) . '</span>', $category_list ); ?>
            <?php } // end if ?>

            <?php $tag_list = get_the_tag_list( '', __( ' ', TRANSLATION_KEY ) ); ?>
            <?php if( $tag_list ) { ?>
                <?php printf( '<span class="tags"></span> ' . __( '%1$s', TRANSLATION_KEY ) . '</span>', $tag_list ); ?>
            <?php } // end if ?>

        </div><!-- /meta-date-cat-tags -->

        <div class="meta-comment-link pull-right">
            <a class="pull-right post-link" href="<?php the_permalink(); ?>" title="<?php esc_attr_e( 'permalink', TRANSLATION_KEY ); ?>"><span class="fa fa-link"></span></a>
            <?php if( comments_open() ) { ?>
                <span class="the-comment-link"><?php comments_popup_link( __( 'Leave a comment', TRANSLATION_KEY ), __( '1 Comment', TRANSLATION_KEY ), __( '% Comments', TRANSLATION_KEY ), '', ''); ?>&nbsp;</span>
            <?php } // end if ?>
        </div><!-- /meta-comment-link -->

    </div><!-- /.post-meta -->

</article><!-- /#post -->
