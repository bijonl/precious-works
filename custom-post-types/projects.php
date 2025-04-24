<?php
/**
 * Projects Custom Post Type
 *
 * This custom post type adds support for projects. This file declares
 * basic support for the post type, while the fields are managed by the
 * Advanced Custom Fields plugin.
 */

 function register_custom_post_type_projects() {
    $labels = apply_filters( 'projects_post_type_labels', array(
        'name'               => 'Projects',
        'singular_name'      => 'Project',
        'menu_name'          => 'Project',
        'add_new'            => 'Add New Project',
        'add_new_item'       => 'Add Project',
        'edit'               => 'Edit',
        'edit_item'          => 'Edit Project',
        'new_item'           => 'New Project',
        'view'               => 'View Project',
        'view_item'          => 'View Project',
        'search_items'       => 'Search Project',
        'not_found'          => 'No Project',
        'not_found_in_trash' => 'No Project Found in Trash',
        'parent'             => 'Parent Project',
    ));

    $args = apply_filters( 'project_post_type_args', array(
        'label'               => 'Projects',
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
        'menu_icon'           => 'dashicons-welcome-view-site',
        'show_in_rest'        => true,
        'supports'            => array( 'title', 'thumbnail', 'revisions', 'excerpt', 'editor' ),
        'labels'              => $labels,
        'map_meta_cap'        => true,
    ));

    register_post_type( 'projects', $args );
}
add_action( 'init', 'register_custom_post_type_projects' );


// Run once for user permissions

// add_action( 'admin_init', 'add_projects_caps');
// function add_projects_caps() {
// $roles = array('administrator','editor');

// foreach($roles as $the_role) {
// $role = get_role($the_role);
// $role->add_cap( 'edit_projects' );
// $role->add_cap( 'read_projects' );
// $role->add_cap( 'delete_projects' );
// $role->add_cap( 'edit_projects' );
// $role->add_cap( 'edit_others_projects' );
// $role->add_cap( 'publish_projects' );
// $role->add_cap( 'read_private_projects' );
// }
// }

function project_add_custom_metabox() {
    add_meta_box(
        'project_fields',
        'Project Fields',
        'project_metabox_content',
        'projects',
        'normal', // context: 'normal', 'side', or 'advanced'
        'default' // priority
    );
}
add_action('add_meta_boxes', 'project_add_custom_metabox');

function project_metabox_content($post) {
    $value = get_post_meta($post->ID, 'project_url', true);
    ?>
    <label for="project_url" style="display:block; font-weight:bold; margin-bottom:5px;">Project URL</label>
    <input
        type="text"
        name="project_url"
        id="project_url"
        value="<?php echo esc_attr($value); ?>"
        style="width: 100%; max-width: 600px; padding: 6px;"
    />
    <?php
}

function project_on_save_post($post_id) {
    // Verify the nonce if you add one for security (optional)
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['project_url'])) {
        update_post_meta($post_id, 'project_url', sanitize_text_field($_POST['project_url']));
    }
}; 
add_action('save_post', 'project_on_save_post');

add_action('init', 'register_project_url_attribute_meta');
function register_project_url_attribute_meta() {
    register_post_meta('projects', 'project_url', [
        'show_in_rest' => true, // This should be true for the REST API to include it
        'single' => true,
        'type' => 'string',
        'auth_callback' => function() {
            return true; // Allow for public access or add permissions
        },
    ]);
}; 

add_filter('rest_prepare_projects', 'add_project_to_rest_response', 10, 3);
function add_project_to_rest_response($data, $post, $context) {
    // Get the custom field value
    $project_url = get_post_meta($post->ID, 'project_url', true);

    // Add the custom field to the response
    if ($project_url) {
        $data->data['project_url'] = $project_url;
    }

    return $data;
}; 

