<?php
/**
 * The tempate for rendering the sidebar. Will be on the left or the right of the of the screen depending
 * on the layout that the user has selected in the Dashboard.
 *
 * @package lean
 * @version	1.1
 * @since 	1.0
 */
?>
<?php $presentation_options = get_option( 'theme_presentation_options' ); ?>

<?php if ( 'full_width_layout' != $presentation_options['layout'] && ! get_post_meta( get_the_ID(), 'standard_seo_post_level_layout', true ) ) { ?>

    <aside id="sidebar" class="col-12 col-md-4 <?php echo 'left_sidebar_layout' == $presentation_options['layout'] ? 'col-md-pull-8' : ''; ?>">
        <?php if ( ! dynamic_sidebar( 'sidebar-0' ) ) { ?>

            <div class="alert">
                <p><strong>Heads up!</strong> It seems you haven't added any widgets to your Sidebar just yet.</p>
                <p><a class="btn btn-primary" href="<?php echo get_site_url(); ?>/wp-admin/widgets.php"><span class="icon-plus"></span> Add Widgets</a></p>
            </div>

        <?php } // end if ?>
    </aside><!-- /#sidebar -->

<?php } //end if ?>