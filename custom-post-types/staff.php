<?php
/**
 * Staff Custom Post Type
 *
 * This custom post type adds support for projects. This file declares
 * basic support for the post type, while the fields are managed by the
 * Advanced Custom Fields plugin.
 */

 function register_custom_post_type_staff() {
    $labels = apply_filters( 'staff_post_type_labels', array(
        'name'               => 'Staff',
        'singular_name'      => 'Staff',
        'menu_name'          => 'Staff',
        'add_new'            => 'Add New Staff',
        'add_new_item'       => 'Add Staff',
        'edit'               => 'Edit',
        'edit_item'          => 'Edit Staff',
        'new_item'           => 'New Staff',
        'view'               => 'View Staff',
        'view_item'          => 'View Staff',
        'search_items'       => 'Search Staff',
        'not_found'          => 'No Staff',
        'not_found_in_trash' => 'No Staff Found in Trash',
        'parent'             => 'Parent Staff',
    ));

    $args = apply_filters( 'staff_post_type_args', array(
        'label'               => 'Staff',
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
        'menu_icon'           => 'dashicons-admin-users',
        'show_in_rest'        => true,
        'supports'            => array( 'title', 'thumbnail', 'revisions', 'editor' ),
        'labels'              => $labels,
        'map_meta_cap'        => true,
    ));

    register_post_type( 'staff', $args );
}
add_action( 'init', 'register_custom_post_type_staff' );


// Run once for user permissions
//
// add_action( 'admin_init', 'add_staff_caps');
// function add_staff_caps() {
// $roles = array('administrator','editor');

// foreach($roles as $the_role) {
// $role = get_role($the_role);
// $role->add_cap( 'edit_staff' );
// $role->add_cap( 'read_staff' );
// $role->add_cap( 'delete_staff' );
// $role->add_cap( 'edit_staff' );
// $role->add_cap( 'edit_others_staff' );
// $role->add_cap( 'publish_staff' );
// $role->add_cap( 'read_private_staff' );
// }
// }

function staff_add_custom_metabox() {
    add_meta_box(
        'staff_fields',
        'Staff Fields',
        'staff_metabox_content',
        'staff',
        'normal', // context: 'normal', 'side', or 'advanced'
        'default' // priority
    );
}
add_action('add_meta_boxes', 'staff_add_custom_metabox');

function staff_metabox_content($post) {
    $value = get_post_meta($post->ID, 'staff_position', true);
    ?>
    <label for="staff_position" style="display:block; font-weight:bold; margin-bottom:5px;">Staff Member Position</label>
    <input
        type="text"
        name="staff_position"
        id="staff_position"
        value="<?php echo esc_attr($value); ?>"
        style="width: 100%; max-width: 600px; padding: 6px;"
    />
    <?php
}

function staff_on_save_post($post_id) {
    // Verify the nonce if you add one for security (optional)
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['staff_position'])) {
        update_post_meta($post_id, 'staff_position', sanitize_text_field($_POST['staff_position']));
    }
}; 
add_action('save_post', 'staff_on_save_post');

add_action('init', 'register_staff_position_attribute_meta');
function register_staff_position_attribute_meta() {
    register_post_meta('staff', 'staff_position', [
        'show_in_rest' => true, // This should be true for the REST API to include it
        'single' => true,
        'type' => 'string',
        'auth_callback' => function() {
            return true; // Allow for public access or add permissions
        },
    ]);
}; 

add_filter('rest_prepare_staff', 'add_staff_to_rest_response', 10, 3);
function add_staff_to_rest_response($data, $post, $context) {
    // Get the custom field value
    $staff_position = get_post_meta($post->ID, 'staff_position', true);

    // Add the custom field to the response
    if ($staff_position) {
        $data->data['staff_position'] = $staff_position;
    }

    return $data;
}; 
