<?php
/**
 * 
 * CPT -- Portfolios
 *
 */

function portfolio_custom_post_type() {
	$supports = array(
		'title', // post title
		'editor', // post content
		//'author', // post author
		'thumbnail', // featured images
	);

	$labels = array(
		'name' => _x('Portfolios', 'plural'),
		'singular_name' => _x('Portfolio', 'singular'),
		'menu_name' => _x('Portfolios', 'admin menu'),
		'name_admin_bar' => _x('Portfolios', 'admin bar'),
		'add_new' => _x('Add New', 'add new'),
		'add_new_item' => __('Add New Portfolio'),
		'new_item' => __('New Portfolios'),
		'edit_item' => __('Edit Portfolios'),
		'view_item' => __('View Portfolios'),
		'all_items' => __('All Portfolios'),
		'search_items' => __('Search Portfolios'),
		'not_found' => __('No Portfolios found.'),
	);

	$args = array(
		'supports' => $supports,
		'labels' => $labels,
		'public' => true,
		'query_var' => true,
		'taxonomies' => array('post_tag'),
		'rewrite' => array('slug' => 'ev'),
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'show_in_rest' => true
	);
	register_post_type('portfolio', $args);
}
add_action('init', 'portfolio_custom_post_type');

function wporg_add_custom_box()
{
    $screens = ['post', 'portfolio'];
    foreach ($screens as $screen) {
        add_meta_box(
            'wporg_box_id',           // Unique ID
            'Custom Meta Box Title',  // Box title
            'wporg_custom_box_html',  // Content callback, must be of type callable
            $screen,                  // Post type
            'side' 
        );
    }
}
add_action('add_meta_boxes', 'wporg_add_custom_box');

function wporg_custom_box_html($post)
{
    ?>
    <label for="wporg_field">Description for this field</label>
    <select name="wporg_field" id="wporg_field" class="postbox">
        <option value="">Select something...</option>
        <option value="something">Something</option>
        <option value="else">Else</option>
    </select>
    <?php
}