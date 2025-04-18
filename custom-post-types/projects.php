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
        // 'supports'            => array( 'title', 'thumbnail', 'revisions' ),
        'labels'              => $labels,
        'map_meta_cap'        => true,
    ));

    register_post_type( 'projects', $args );
}
add_action( 'init', 'register_custom_post_type_projects' );


// Run once for user permissions

add_action( 'admin_init', 'add_projects_caps');
function add_projects_caps() {
$roles = array('administrator','editor');

foreach($roles as $the_role) {
$role = get_role($the_role);
$role->add_cap( 'edit_projects' );
$role->add_cap( 'read_projects' );
$role->add_cap( 'delete_projects' );
$role->add_cap( 'edit_projects' );
$role->add_cap( 'edit_others_projects' );
$role->add_cap( 'publish_projects' );
$role->add_cap( 'read_private_projects' );
}
}
