<?php
/**
 * The template for rendering the footer.
 *
 * @package lean
 * @version	1.1
 * @since 	1.0
 */
?>
<?php $presentation_options = get_option( 'theme_presentation_options' ); ?>
<?php $dark = 'dark' == $presentation_options['contrast']; ?>

<footer>

    <?php if( ! is_offline() || is_user_logged_in() ) { ?>
        <?php if( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) || is_active_sidebar( 'sidebar-5' ) ) { ?>
            <div class="jumbotron footer-widgets">
                <div class="container">
                    <div class="row">

                        <div class="footer-widget col-md-4">
                            <?php dynamic_sidebar( 'sidebar-3' ); ?>
                        </div><!-- /.footer-widget  -->

                        <div class="footer-widget col-md-4">
                            <?php dynamic_sidebar( 'sidebar-4' ); ?>
                        </div><!-- /.footer-widget  -->

                        <div class="footer-widget col-md-4">
                            <?php dynamic_sidebar( 'sidebar-5' ); ?>
                        </div><!-- /.footer-widget  -->

                    </div><!-- /row -->
                </div><!-- /container -->
            </div><!-- /.jumbotron -->
        <?php } // end if ?>
    <?php } // end if ?>

    <nav id="footer-menu" class="menu-navigation navbar-fixed-bottom navbar navbar-default<?php echo $dark ? ' navbar-inverse' : ''; ?>" role="navigation">
        <div class="container">

                <?php
                wp_nav_menu(
                    array(
                        'container_class'	=> 'menu-footer-container',
                        'theme_location'  	=> 'footer_menu',
                        'items_wrap'      	=> '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
                        'fallback_cb'	  	=> null,
                        'walker'			=> new Bootstrap_Nav_Walker()
                    )
                );
                ?>

                <?php $global_options = get_option( 'theme_global_options' ); ?>
                <p class="navbar-text navbar-right">
                    <?php if( 'always' == $presentation_options['display_footer_credits'] ) { ?>
                        <?php
                            $jasonbradley_url = 'http://jasonbradley.me';
                            $theme_url = THEME_URL;
                        ?>
                        <?php if( null != get_page_by_path( 'privacy-policy' ) && 0 != get_page_by_path( 'privacy-policy' )->ID && 'publish' == get_page_by_path( 'privacy-policy' )->post_status ) { ?>
                            <?php printf( __( '&copy; %1$s %2$s &mdash; %3$s &mdash; %4$s by %5$s', TRANSLATION_KEY ), date( 'Y' ), '<a class="navbar-link" href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>', '<a class="navbar-link" href="' . get_permalink( get_page_by_path( 'privacy-policy' )->ID ) . '">Privacy Policy</a>', '<a class="navbar-link" href="' . $theme_url . '" target="_blank">' . THEME_NAME . '</a>', '<a class="navbar-link" href="' . $jasonbradley_url . '" target="_blank">Jason Bradley</a>' ); ?>
                        <?php } else { ?>
                            <?php printf( __( '&copy; %1$s %2$s &mdash; %3$s by %4$s', TRANSLATION_KEY ), date( 'Y' ), '<a class="navbar-link" href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>', '<a class="navbar-link" href="' . $theme_url . '" target="_blank">' . THEME_NAME . '</a>', '<a class="navbar-link" href="' . $jasonbradley_url . '" target="_blank">Jason Bradley</a>' ); ?>
                        <?php } // end if/else ?>
                    <?php } else { ?>
                        <?php printf( __( '&copy; %1$s %2$s', TRANSLATION_KEY ), date( 'Y' ), '<a class="navbar-link" href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>'); ?>
                    <?php } // end if ?>
                </p>
        </div><!-- /.container -->
    </nav> <!-- /#menu-under-header -->

</footer><!-- /#footer -->
<?php wp_footer(); ?>
</body>
</html>