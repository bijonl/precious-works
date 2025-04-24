<?php function pw_register_featured_work_block() {
    register_block_type( 'precious-works/featured-projects', array(
        'editor_script' => 'pw-featured-work-block-editor',
        'render_callback' => 'pw_render_featured_work_block',
        'supports'        => array(
            'anchor' => true, // Ensure anchor is supported in the block registration
        ),   
    ) );
}
add_action( 'init', 'pw_register_featured_work_block' ); ?>