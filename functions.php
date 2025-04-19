<?php // Theme setup
// Load Custom Post Types
require get_template_directory() . '/custom-post-types/staff.php';
require get_template_directory() . '/custom-post-types/testimonials.php';
require get_template_directory() . '/custom-post-types/projects.php';


function precious_works_theme_setup() {
    // Add support for dynamic <title> tag
    add_theme_support('title-tag');

    // Add support for featured images
    add_theme_support('post-thumbnails');

    // Add support for editor styles (optional)
    add_theme_support('editor-styles');

    // Add custom editor stylesheet if needed
    // add_editor_style('assets/css/editor-style.css');

    // Add support for wide/full align blocks
    add_theme_support('align-wide');

    // Add block styles
    add_theme_support('wp-block-styles');

    // Load translations if needed
    load_theme_textdomain('mytheme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'precious_works_theme_setup');

function precious_works_block_category( $categories, $post ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'precious-works',
                'title' => __( 'Precious Works Blocks', 'mytheme' ),
            ],
        ]
    );
}
add_filter( 'block_categories_all', 'precious_works_block_category', 10, 2 );



function theme_enqueue_styles() {
    // Enqueue the main CSS file (compiled SCSS)
    wp_enqueue_style(
        'theme-style', // Handle for the style
        get_template_directory_uri() . '/assets/css/style.css', // Path to the compiled CSS
        array(), // Dependencies (empty if none)
        filemtime(get_template_directory() . '/assets/css/style.css'), // Version based on file timestamp (cache busting)
        'all' // Media type
    );

    // Enqueue Google Font: Inter
    wp_enqueue_style( 
        'inter-font', 
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap', 
        false 
    );

}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function precious_works_enqueue_scripts() {
    wp_enqueue_script(
        'precious-works-blocks', // Handle
        get_template_directory_uri() . '/build/index.js', // Path to compiled JS
        array('wp-blocks', 'wp-element', 'wp-editor'), // Dependencies (important for React in WP)
        filemtime(get_template_directory() . '/build/index.js'), // Cache-busting
        true // Load in footer
    );

}
add_action('enqueue_block_editor_assets', 'precious_works_enqueue_scripts'); // Loads in the block editor

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type) {
    $disabled_post_types = array(
        'testimonials', 
        'staff', 
        'projects'
    ); 

    // Use your post type key instead of 'product'
    if (in_array($post_type, $disabled_post_types)) return false;
    return $current_status;
}

add_action('init', function() {
    $meta = get_post_meta(127, 'quote_attribute', true);
    error_log('Quote attribute: ' . $meta);
});

function pw_register_staff_block() {
    register_block_type( 'precious-works/staff-block', array(
        'editor_script' => 'precious-works-staff-block-editor',
        'render_callback' => 'pw_render_staff_block',
    ) );
}
add_action( 'init', 'pw_register_staff_block' );

function pw_render_staff_block( $attributes ) {
    $staff_ids = isset( $attributes['staffMembers'] ) ? $attributes['staffMembers'] : [];

    $staff_output = '';

    if ( ! empty( $staff_ids ) ) {
        foreach ( $staff_ids as $staff_id ) {
            // Fetch the staff member post
            $staff_post = get_post( $staff_id );
            
            if ( $staff_post ) {
                // Output staff info (can be changed as needed)
                $staff_output .= '<div class="staff-member">';
                $staff_output .= '<h3>' . esc_html( $staff_post->post_title ) . '</h3>';
                // Example: You could also add more fields such as the staff post content or custom fields here
                $staff_output .= '</div>';
            }
        }
    }

    return '<section class="staff-section">' . $staff_output . '</section>';
}