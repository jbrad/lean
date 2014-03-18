<?php
/**
 * Template Name: Sitemap
 *
 * The template for rendering an SEO-friendly site map.
 *
 * @package lean
 * @version	1.4.1
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
                         class="col-12 <?php echo 'full_width_layout' == $presentation_options['layout'] ? 'col-md-12' : 'col-md-8 col-sm-8'; ?> <?php echo 'left_sidebar_layout' == $presentation_options['layout'] ? ' col-md-push-4' : ''; ?>">

                    <?php get_template_part( 'breadcrumbs' ); ?>

                    <?php if ( have_posts() ) { ?>
                        <?php while ( have_posts() ) { ?>
                            <?php the_post(); ?>
                            <article id="post-<?php the_ID(); ?> format-standard" <?php post_class( 'post' ); ?>>
                                <div class="post-header clearfix">
                                    <h1 class="post-title entry-title"><?php the_title(); ?></h1>
                                </div><!-- /.post-header -->
                                <div id="content-<?php the_ID(); ?>" class="entry-content clearfix">
                                    <h2 id="authors" class="page-header lead"><?php _e( 'Authors', TRANSLATION_KEY ); ?></h2>

                                    <ul id="sitemap-authors" class="nav nav-pills">
                                        <?php
                                        foreach( get_users() as $user ) {
                                            $query = new WP_Query( 'author=' . $user->ID . '&posts_per_page=1' );
                                            if( $query->have_posts() ) {
                                                echo '<li>';
                                                echo '<div class="sitemap-author-meta thumbnail">';
                                                echo '<figure>';
                                                echo get_avatar( $user->user_email, $size = '80' );
                                                echo '</figure>';
                                                $query->the_post();
                                                echo '<span class="badge">';
                                                the_author_posts();
                                                echo '</span>';
                                                the_author_posts_link();
                                                echo '</div>';
                                                echo '</li>';
                                            } // end if
                                            wp_reset_postdata();
                                        } // end foreach
                                        ?>
                                    </ul>

                                    <ul id="sitemap-pages" class="nav nav-stacked">
                                        <?php
                                        wp_list_pages(
                                            array(
                                                'exclude'	=> get_the_ID(),
                                                'title_li' 	=> '<h2 id="pages" class="page-header lead">Pages</h2>'
                                            )
                                        );
                                        ?>
                                    </ul>

                                    <h2 id="posts" class="page-header lead"><?php _e( 'Posts', TRANSLATION_KEY ); ?></h2>
                                    <ul id="sitemap-posts">
                                        <?php
                                        $category_list = '';
                                        foreach ( get_categories() as $category ) {

                                            $category_list .= '<li><h3 class="lead">' . $category->cat_name . '</h3></li>';
                                            $category_list .= '<ul>';

                                            $category_query = new WP_Query( 'posts_per_page=-1&cat=' . $category->cat_ID );
                                            if( $category_query->have_posts() ) {

                                                while( $category_query->have_posts() ) {

                                                    $category_query->the_post();
                                                    $cat = get_the_category();
                                                    if ( '' != get_the_title() ) {
                                                        $category_list .= '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
                                                    } // end if

                                                } // end while

                                                $category_list .= '</ul>';
                                                $category_list .= '</li>';

                                            } // end if

                                        } // end foreach
                                        wp_reset_postdata();

                                        echo $category_list;
                                        ?>
                                    </ul>

                                </div><!-- /.entry-content -->
                            </article> <!-- /#post -->
                        <?php } // end while ?>
                    <?php } // end if ?>
                </section><!-- /#main -->

                <?php get_sidebar(); ?>

            </div><!--/ row -->
        </div><!--/container -->
    </div> <!-- /#wrapper -->
<?php get_footer(); ?>