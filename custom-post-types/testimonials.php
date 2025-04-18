<?php
/**
 * Testimonial Custom Post Type
 *
 * This custom post type adds support for projects. This file declares
 * basic support for the post type, while the fields are managed by the
 * Advanced Custom Fields plugin.
 */

 function register_custom_post_type_testimonial() {
    $labels = apply_filters( 'testimonial_post_type_labels', array(
        'name'               => 'Testimonials',
        'singular_name'      => 'Testimonial',
        'menu_name'          => 'Testimonial',
        'add_new'            => 'Add New Testimonial',
        'add_new_item'       => 'Add Testimonial',
        'edit'               => 'Edit',
        'edit_item'          => 'Edit Testimonial',
        'new_item'           => 'New Testimonial',
        'view'               => 'View Testimonial',
        'view_item'          => 'View Testimonial',
        'search_items'       => 'Search Testimonial',
        'not_found'          => 'No Testimonial',
        'not_found_in_trash' => 'No Testimonial Found in Trash',
        'parent'             => 'Parent Testimonial',
    ));

    $args = apply_filters( 'testimonial_post_type_args', array(
        'label'               => 'Testimonial',
        'description'         => '',
        'public'              => true,
        'publicly_queryable'  => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'capability_type'     => 'page',
        'hierarchical'        => true,
        'query_var'           => true,
        'has_archive'         => false,
        'exclude_from_search' => false,
        'menu_icon'           => 'dashicons-star-filled',
        'show_in_rest'        => true,
        // 'supports'            => array( 'title', 'thumbnail', 'revisions' ),
        'labels'              => $labels,
        'map_meta_cap'        => true,
    ));

    register_post_type( 'testimonials', $args );
}
add_action( 'init', 'register_custom_post_type_testimonial' );


// Run once for user permissions
//
// add_action( 'admin_init', 'add_testimonial_caps');
// function add_testimonial_caps() {
// $roles = array('administrator','editor');

// foreach($roles as $the_role) {
//     $role = get_role($the_role);
//     $role->add_cap( 'edit_testimonial' );
//     $role->add_cap( 'read_testimonial' );
//     $role->add_cap( 'delete_testimonial' );
//     $role->add_cap( 'edit_testimonial' );
//     $role->add_cap( 'edit_others_testimonial' );
//     $role->add_cap( 'publish_testimonial' );
//     $role->add_cap( 'read_private_testimonial' );
//     }
// }

function testimonial_add_custom_metabox() {
    add_meta_box(
        'testimonial_fields',
        'Testimonial Fields',
        'testimonials_metabox_content',
        'testimonials',
        'normal', // context: 'normal', 'side', or 'advanced'
        'default' // priority
    );
}
add_action('add_meta_boxes', 'testimonial_add_custom_metabox');

function testimonials_metabox_content($post) {
    $value = get_post_meta($post->ID, 'quote_attribute', true);
    ?>
    <label for="quote_attribute" style="display:block; font-weight:bold; margin-bottom:5px;">Quote / Attribution</label>
    <input
        type="text"
        name="quote_attribute"
        id="quote_attribute"
        value="<?php echo esc_attr($value); ?>"
        style="width: 100%; max-width: 600px; padding: 6px;"
    />
    <?php
}

function on_save_post($post_id) {
    // Verify the nonce if you add one for security (optional)
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['quote_attribute'])) {
        update_post_meta($post_id, 'quote_attribute', sanitize_text_field($_POST['quote_attribute']));
    }
}
add_action('save_post', 'on_save_post');

add_action('init', 'register_quote_attribute_meta');
function register_quote_attribute_meta() {
    register_post_meta('testimonials', 'quote_attribute', [
        'show_in_rest' => true, // This should be true for the REST API to include it
        'single' => true,
        'type' => 'string',
        'auth_callback' => function() {
            return true; // Allow for public access or add permissions
        },
    ]);

    error_log("Quote attribute registered and available in REST");

}

add_filter('rest_prepare_testimonials', 'add_quote_attribute_to_rest_response', 10, 3);

function add_quote_attribute_to_rest_response($data, $post, $context) {
    // Get the custom field value
    $quote_attribute = get_post_meta($post->ID, 'quote_attribute', true);

    // Add the custom field to the response
    if ($quote_attribute) {
        $data->data['quote_attribute'] = $quote_attribute;
    }

    return $data;
}


