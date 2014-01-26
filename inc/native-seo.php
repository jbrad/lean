<?php
/**
 * Helper function for determining if any other SEO plugins are installed.
 *
 * @return	boolean True if 'WordPress SEO', 'All In One SEO', or 'Platinum SEO' are installed.
 * @version	1.1
 * @since	1.0
 */
function using_native_seo() {
    return ! ( defined( 'WPSEO_URL' ) || class_exists( 'All_in_One_SEO_Pack' ) || class_exists( 'Platinum_SEO_Pack' ) );
} // end using_native_seo