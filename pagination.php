<?php
/**
 * The template for providing pagination throughout the theme.
 *
 * @package lean
 * @version	1.4
 * @since 	1.0
 */
?>
<?php global $wp_query; ?>

<?php if( is_single() && 'post' == get_post_type() ) { ?>

    <nav id="single-post-nav">
        <ul class="pager">

            <?php $trunc_limit = 30; ?>

            <?php if( '' != get_previous_post() ) { ?>
                <li class="previous">
                    <?php previous_post_link( '%link', '<span class="fa fa-chevron-left"></span> ' . __(truncate_text( get_previous_post()->post_title, $trunc_limit ) ) ); ?>
                </li>
            <?php } // end if ?>

            <?php if( '' != get_next_post() ) { ?>
                <li class="next">
                    <?php next_post_link( '%link', __(truncate_text( get_next_post()->post_title, $trunc_limit ) ) . ' <span class="fa fa-chevron-right"></span>' ); ?>
                </li>
            <?php } // end if ?>
        </ul>
    </nav><!-- /#single-post-nav -->

<?php } elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) { ?>

    <nav id="post-nav">
        <ul class="pager">

            <?php if( get_next_posts_link() ) { ?>
                <li class="previous">
                    <?php next_posts_link( __( '<span class="nav-previous meta-nav"><span class="fa fa-chevron-left"></span> Older Posts</span>', TRANSLATION_KEY ) ); ?>
                </li>
            <?php } // end if ?>

            <?php if( get_previous_posts_link() ) { ?>
                <li class="next">
                    <?php previous_posts_link( __( '<span class="nav-next meta-nav">Newer Posts <span class="fa fa-chevron-right"></span>', TRANSLATION_KEY ) ); ?>
                </li>
            <?php } // end if ?>

        </ul><!-- /.pager -->
    </nav><!-- /#post-nav -->

<?php } // end if/else ?>