<?php function pw_render_testimonials_block( $attributes ) {
    error_log('Rendering test block');
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