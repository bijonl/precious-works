<?php
function pw_render_staff_block( $attributes ) {
    $anchor_id = isset( $attributes['anchor'] ) ? esc_attr( $attributes['anchor'] ) : '';
    $staff_ids = isset( $attributes['staffMembers'] ) ? $attributes['staffMembers'] : [];

    // Start output buffering
    ob_start(); ?>

    <?php if ( ! empty( $staff_ids ) ) { ?>
        <section class="staff-block-section" id="<?php echo $anchor_id ?>">
            <div class="staff-block-container container">
                <div class="testimonial-title-row title-row row">
                    <div class="col-lg-6 title-col">
                        <h2>Meet the Fur-midable Team</h2>
                        <p>
                            They may nap on the job, but their impact is anything but lazy.
                            Workplace wellness starts with a tail wag and a purr.
                        </p>
                    </div>
                </div>
                <div class="staff-block-row row g-5">
                    <?php foreach ( $staff_ids as $staff_id ) { 
                        // Fetch the staff member post
                        $staff_bio = get_post_field( 'post_content', $staff_id );
                        $staff_image_url = get_the_post_thumbnail_url( $staff_id, 'pet_photo');
                        $staff_position = get_post_meta( $staff_id, 'staff_position', true );
                        $staff_name = get_the_title( $staff_id );
                        $name_id = 'staff-' . $staff_id . '-name';

                        if ( get_post_status( $staff_id ) ) { ?>
                            <div 
                                class="staff-member-col col-lg-6 col-xxl-3" 
                                tabindex="0" 
                                aria-labelledby="<?php echo esc_attr( $name_id ); ?>">
                                <div class="staff-content-wrapper" style="background-image:url(<?php echo esc_url( $staff_image_url ); ?>);">
                                    <div class="overlay pet-overlay"></div>
                                    <div class="staff-position-name">
                                        <h6 id="<?php echo esc_attr( $name_id ); ?>"><?php echo esc_html( $staff_name ); ?></h6>
                                        <p><?php echo esc_html( $staff_position ); ?></p>
                                    </div>
                                    <div class="staff-member-content">
                                        <?php echo wp_kses_post( $staff_bio ); ?>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    } ?>
                </div>
            </div>
        </section>
    <?php }

    return ob_get_clean();
}
?>
