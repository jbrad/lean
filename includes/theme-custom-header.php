<?php
/**
 *
 * @version	1.1
 * @since	1.0
 */

add_theme_support(
    'custom-header',
    array(
        'header-text'				=>	true,
        'default-text-color'		=> 	'000',
        'width'						=>	940,
        'flex-width'				=>	true,
        'height'					=>	250,
        'flex-height'				=> 	true,
        'wp-head-callback'			=>  'header_style',
        'admin-head-callback'		=>	'admin_header_style',
        'admin-preview-callback'	=>	'admin_header_style'
    )
);

if( ! function_exists('header_style') ) {
    /**
     * Styles the default header as per the WordPress API.
     *
     * This function can be overridden by child themes.
     *
     * @version	1.1
     * @since	1.0
     */
    function header_style() {
        if ( HEADER_TEXTCOLOR != get_header_textcolor() ) { ?>
            <style type="text/css">
                <?php if ( 'blank' == get_header_textcolor() ) { ?>
                #site-title,
                #site-description,
                #logo {
                    clip: rect(1px 1px 1px 1px);
                    clip: rect(1px, 1px, 1px, 1px);
                }
                <?php } else { ?>
                #site-title a,
                #site-description {
                    color: #<?php echo get_header_textcolor(); ?>;
                }
                <?php } // end if ?>
            </style>
        <?php
        } // end if
    } // end header_style
} // end if

if( ! function_exists('admin_header_style') ) {
    /**
     * Styles the default header in the admin panel as per the WordPress API.
     *
     * This function can be overridden by child themes.
     *
     * @version	1.1
     * @since	1.0
     */
    function admin_header_style() { ?>
        <style type="text/css">

            .appearance_page_custom-header #headimg {
                border: none;
            }

            #headimg h1 {
                margin: 0;
            }

            #headimg h1 a {
                font-size: 32px;
                line-height: 36px;
                text-decoration: none;
            }

            #desc {
                font-size: 14px;
                line-height: 23px;
                padding: 0 0 3em;
            <?php if( '000000' == get_header_textcolor() ) { ?>
                color: #7A7A7A !important;
            <?php } else { ?>
                color: #<?php get_header_textcolor(); ?>
            <?php } // end if/else ?>
            }

        </style>
    <?php
    } // admin_header_style
} // end if

if( ! function_exists('admin_header_image') ) {
    /**
     * Markup and styles the default header in the admin panel as per the WordPress API.
     *
     * This function can be overridden by child themes.
     *
     * @version	1.1
     * @since	1.0
     */
    function admin_header_image() { ?>
        <div id="headimg">
            <?php $header_image = get_header_image();

            if ( 'blank' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) || '' == get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) ) {
                $style = ' style="display:none;"';
            } else {
                $style = ' style="color:#' . get_theme_mod( 'header_textcolor', HEADER_TEXTCOLOR ) . ';"';
            } // end if/else ?>

            <div id="header-top" class="float">
                <?php
                $presentation_options = get_option('theme_presentation_options');

                $logo = '';
                if( isset( $presentation_options['logo'] ) ) {
                    $logo = $presentation_options['logo'];
                } // end if

                if( '' == $logo ) {
                    ?>
                    <h1><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
                    <div id="desc"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></div>
                <?php
                } else {
                    ?>
                    <h1>
                        <a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <img id="theme-logo" src="<?php echo $presentation_options['logo']; ?>" alt="<?php bloginfo( 'name' ); ?>" style="display:none;" />
                        </a>
                    </h1>
                <?php
                } // end if/else
                ?>

            </div>

            <?php if ( ! empty( $header_image ) ) { ?>
                <div id="header-bottom" class="float">
                    <img id="theme-background" src="<?php echo esc_url( $header_image ); ?>" alt="" />
                </div>
            <?php } // end if ?>

        </div><!-- /#headimg -->
    <?php } // admin_header_image
} // end if