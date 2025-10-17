// Add the following code to your theme's functions.php file or a custom plugin

function disable_acf_link_search_panel($args, $field, $post_id) {
    // Check if the field type is 'post_object' (ACF Link field)
    if ($field['type'] === 'post_object') {
        // Disable the search panel by setting the search parameter to an empty string
        $args['s'] = '';jQuery(function($) {
            // Wait for the ACF field to be ready
            acf.add_action('load', function() {
                // Target all ACF Link fields
                $('.acf-field-post-object input[type="text"]').prop('disabled', true);
            });
        });
        
    }

    return $args;
}

// Hook into the acf/fields/post_object/query filter globally for all ACF Link fields
add_filter('acf/fields/post_object/query', 'disable_acf_link_search_panel', 10, 3);
