<?php function pw_register_testimonials_block() {
    register_block_type( 'precious-works/testimonials', array(
        'editor_script'   => 'pw-testimonials-block-editor',
        'render_callback' => 'pw_render_testimonials_block',
        'supports'        => array(
            'anchor' => true, // Ensure anchor is supported in the block registration
        ),  
    ) );
}
add_action( 'init', 'pw_register_testimonials_block' ); ?>