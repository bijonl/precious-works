<?php function pw_render_staff_block( $attributes ) {
    error_log('Rendering staff block');
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