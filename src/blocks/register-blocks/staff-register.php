<?php function pw_register_staff_block() {
    register_block_type( 'precious-works/staff-block', array(
        'editor_script' => 'precious-works-staff-block-editor',
        'render_callback' => 'pw_render_staff_block',
        'supports'        => array(
            'anchor' => true, // Ensure anchor is supported in the block registration
        ),   
    ) );
}
add_action( 'init', 'pw_register_staff_block' ); ?>