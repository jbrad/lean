<?php
/**
 * The template for loop post link pages
 *
 * @package lean
 * @version	1.2
 * @since 	1.0
 */
?>
<?php
    wp_link_pages(
        array(
            'before' 	=> '<div class="page-link"><span>' . __( 'Pages:', TRANSLATION_KEY ) . '</span>',
            'after' 	=> '</div>'
        )
    );
?>