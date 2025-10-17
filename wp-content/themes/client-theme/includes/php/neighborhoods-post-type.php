<?php

// ************ CREATE NEIGHBORHOODS POST TYPE **************** //

add_action('init', 'create_neighborhoods_post_type');

function create_neighborhoods_post_type() {
  $labels = array(
    'name' => __('Neighborhoods'),
    'singular_name' => __('Neighborhood'),
    'all_items' => __('All Neighborhoods'),
    'add_new' => _x('Add New Neighborhood', 'Neighborhoods'),
    'add_new_item' => __('Add new Neighborhood'),
    'edit_item' => __('Edit Neighborhood'),
    'new_item' => __('New Neighborhood'),
    'view_item' => __('View Neighborhood'),
    'search_items' => __('Search in Neighborhoods'),
    'not_found' =>  __('No Neighborhoods found'),
    'not_found_in_trash' => __('No Neighborhoods found in trash'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true,
    'menu_icon' => 'dashicons-admin-multisite',
    'rewrite' => array('slug' => 'neighborhood'),
    'query_var' => true,
    'menu_position' => 23,
    'supports'=> array('thumbnail', 'title', 'editor', 'excerpt'),
    'show_in_rest' => true,
    'rest_base' => 'neighborhoods',
    'rest_controller_class' => 'WP_REST_Posts_Controller',
  );
  register_post_type('neighborhoods', $args);
}


$post_type = 'neighborhoods';
// Register the columns.
add_filter( "manage_neighborhoods_posts_columns", function ( $defaults ) {

	// $defaults['custom-one'] = 'Custom One';
	$defaults['type'] = 'Type';
	$defaults['featured'] = 'Featured';

	return $defaults;
} );
// Handle the value for each of the new columns.
add_action( "manage_neighborhoods_posts_custom_column", function ( $column_name, $post_id ) {
	// if ( $column_name == 'custom-one' ) {
	// 	echo 'Some value here';
	// }
	if ( $column_name == 'type' ) {
		// Display an ACF field
        $portfolio_type = get_field('portfolio_type');
        $portfolio_title = esc_html($portfolio_type['label']);
        if($portfolio_title != "Select One") {
            echo $portfolio_title;
        }
	}
    if ( $column_name == 'featured' ) {
        $featured = get_field('featured_neighborhood');
        if($featured) {
            echo '★'; // Display a star for featured neighborhoods
        } else {
            echo '—'; // Display a dash for non-featured neighborhoods
        }
	}
}, 10, 2 );