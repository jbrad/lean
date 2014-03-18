<?php

/**
 * Custom post types.
 *
 * @version	1.1
 * @since	1.0
 */

function slides_posttype() {
    create_custom_post_type(
        'Slides',
        'Slide',
        array('title', 'excerpt', 'thumbnail', 'page-attributes'),
        'slides',
        'dashicons-images-alt2'
    );
}

add_action( 'init', 'slides_posttype' );

function featurettes_posttype() {
    create_custom_post_type(
        'Featurettes',
        'Featurette',
        array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
        'featurettes',
        'dashicons-star-filled'
    );
}

add_action( 'init', 'featurettes_posttype' );

/**
 * @param $plural_name
 * @param $singular_name
 * @param $icon
 */
function create_custom_post_type($plural_name, $singular_name, $supports, $slug, $icon)
{
    register_post_type($plural_name,
        array(
            'labels' => array(
                'name' => __($plural_name),
                'singular_name' => __($singular_name),
                'add_new' => __('Add New ' . $singular_name),
                'add_new_item' => __('Add New ' . $singular_name),
                'edit_item' => __('Edit ' . $singular_name),
                'new_item' => __('Add New ' . $singular_name),
                'view_item' => __('View ' . $singular_name),
                'search_items' => __('Search ' . $singular_name),
                'not_found' => __('No ' . $plural_name . ' found'),
                'not_found_in_trash' => __('No ' . $plural_name . ' found in trash')
            ),
            'public' => true,
            'supports' => $supports,
            'capability_type' => 'post',
            'rewrite' => array('slug' => $slug),
            'menu_position' => 12,
            'menu_icon' => $icon
        )
    );
}
