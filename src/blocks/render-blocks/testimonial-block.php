<?php
function pw_render_testimonials_block( $attributes ) {
    error_log('Rendering test block');
    $anchor_id = isset( $attributes['anchor'] ) ? esc_attr( $attributes['anchor'] ) : '';
    $testimonial_ids = isset( $attributes['testimonials'] ) ? $attributes['testimonials'] : [];

    ob_start();
    ?>
    <section class="testimonial-section" id="<?php echo $anchor_id; ?>" aria-labelledby="testimonial-heading">
        <div class="testimonial-container container">
            <div class="testimonial-title-row title-row row align-items-center">
                <div class="col-lg-6 title-col">
                    <h2 id="testimonial-heading">Reviews: Built on Trust. Proven by Results.</h2>
                    <p>
                        Precious Works and Bijon's approach isn't just about getting the job done—
                        it's about building lasting trust, delivering quality work, and continuously
                        exceeding expectations. These reviews highlight the impact he's had across
                        a range of projects, roles, and teams.
                    </p>
                </div>
                <div class="col-lg-6 button-wrapper text-lg-end">
                    <a href="/reviews/" target="_self" rel="noopener noreferrer" class="pw-solid-button" aria-label="see more reviews" title="visit precious.works/reviews"> 
                        See More Reviews                              
                    </a>
                </div>
            </div>
            <div class="testimonial-row row">
                <?php foreach ( $testimonial_ids as $index => $id ) {
                    $title        = get_the_title( $id );
                    $content      = apply_filters( 'the_content', get_post_field( 'post_content', $id ) );
                    $quote_attr   = get_post_meta( $id, 'quote_attribute', true );
                    ?>
                    <div class="testimonial-col col-lg-6">
                        <article 
                            class="testimonial-content-wrapper" 
                            tabindex="0" 
                            role="region" 
                            aria-label="Testimonial <?php echo $index + 1; ?>: <?php echo esc_attr( $title ); ?>"
                        >
                            <div class="testimonial-content-quote">
                                <?php echo $content; ?>
                            </div>
                            <?php if ( $quote_attr ) { ?>
                                <div class="testimonial-content-attribute">
                                    <p class="quote-attribute"><?php echo esc_html( $quote_attr ); ?></p>
                                </div>
                            <?php } ?>
                        </article>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
    <?php

    return ob_get_clean();
}
