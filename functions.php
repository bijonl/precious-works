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

    // Add custom image size for pet photos (square 800x800)
    add_image_size( 'pet_photo', 800, 800, true ); // 'true' for cropping

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
        'supports'        => array(
            'anchor' => true, // Ensure anchor is supported in the block registration
        ),   
    ) );
}
add_action( 'init', 'pw_register_staff_block' );

function pw_render_staff_block( $attributes ) {
    $anchor_id = isset( $attributes['anchor'] ) ? esc_attr( $attributes['anchor'] ) : '';
    $staff_ids = isset( $attributes['staffMembers'] ) ? $attributes['staffMembers'] : [];

    // Start output buffering
    ob_start(); ?>

    <?php     if ( ! empty( $staff_ids ) ) { ?>
    <section class="staff-block-section" id="<?php echo $anchor_id ?>">
        <div class="staff-block-container container">
              <div class="testimonial-title-row title-row row">
                <div class="col-sm-6 title-col">
                    <h2>Meet the Fur-midable Team</h2>
                    <p>
                        They may nap on the job, but their impact is anything but lazy.
                        Workplace wellness starts with a tail wag and a purr.
                    </p>
                </div>
            </div>
            <div class="staff-block-row row">
                <?php foreach ( $staff_ids as $staff_id ) { 
                    // Fetch the staff member post
                    $staff_bio = get_post_field( 'post_content', $staff_id );
                    $staff_image =  get_the_post_thumbnail( $staff_id, 'pet_photo', array('class' => 'w-100 h-auto' ));
                    $staff_image_url = get_the_post_thumbnail_url( $staff_id, 'pet_photo');
                    $staff_position = get_post_meta( $staff_id, 'staff_position', true );
                    $staff_name = get_the_title($staff_id); 
                    
                    if ( get_post_status( $staff_id ) ) {
                        // Output staff info (can be changed as needed)
                        ?>
                        
                        <div class="staff-member-col col-sm-4 mx-auto" style="background-image:url(<?php echo $staff_image_url ?>);">
                            <div class="overlay pet-overlay"></div>
                            <div class="staff-position-name">
                                <h6><?php echo $staff_name ?></h6>
                                <p><?php echo $staff_position ?></p>
                            </div>
                            <div class="staff-member-content d-flex align-items-center justify-content-center h-100">
                                    <?php echo $staff_bio ?>
                            </div>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
    </section>

    <?php } 


    // Get the content from the output buffer and clean it
    $staff_output = ob_get_clean();

    return $staff_output;
}



function pw_register_testimonials_block() {
    register_block_type( 'precious-works/testimonials', array(
        'editor_script'   => 'pw-testimonials-block-editor',
        'render_callback' => 'pw_render_testimonials_block',
        'supports'        => array(
            'anchor' => true, // Ensure anchor is supported in the block registration
        ),  
    ) );
}
add_action( 'init', 'pw_register_testimonials_block' );

function pw_render_testimonials_block( $attributes ) {
    $anchor_id = isset( $attributes['anchor'] ) ? esc_attr( $attributes['anchor'] ) : '';
    $testimonial_ids = isset( $attributes['testimonials'] ) ? $attributes['testimonials'] : [];

    ob_start();
    ?>
    <section class="testimonial-section" id="<?php echo $anchor_id ?>">
        <div class="testimonial-container container">
            <div class="testimonial-title-row title-row row">
                <div class="col-sm-6 title-col">
                    <h2>Reviews: Built on Trust. Proven by Results.</h2>
                    <p>Precious Works and Bijon's approach isn't just about getting the 
                        job done—it's 
                        about building lasting trust, delivering quality work, and 
                        continuously exceeding expectations. These reviews highlight the 
                        impact he's had across a range of projects, roles, and teams.
                    </p>
                </div>
            </div>





            <div class="testimonial-row row">
                <?php foreach ( $testimonial_ids as $id ) {
                    $title        = get_the_title( $id );
                    $content      = apply_filters( 'the_content', get_post_field( 'post_content', $id ) );
                    $quote_attr   = get_post_meta( $id, 'quote_attribute', true );
                    ?>
                    <div class="testimonial-col col-sm-6">
                        <div class="testimonial-content-wrapper">
                            <div class="testimonial-content-quote">
                                <?php echo $content; ?>
                            </div>
                             <?php if ( $quote_attr ) { ?>
                             <div class="testimonial-content-attribute">
                                <p class="quote-attribute"><?php echo esc_html( $quote_attr ); ?></p>
                            </div>
                            <?php }; ?>
                        </div>
                        
                    </div>
                <?php }; ?>

            </div>
        </div>
       
    </section>
    <?php

    return ob_get_clean();
}
