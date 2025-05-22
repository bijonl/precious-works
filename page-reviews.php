<?php get_header(); ?>

<?php 
$review_args = array(
    'post_type'      => 'testimonials', 
    'posts_per_page' => -1, 
    'orderby'        => 'menu_order', 
    'order'          => 'ASC', 
    'post_status'    => 'publish', 
); 

$all_reviews = new WP_Query($review_args); 
$page_id = get_the_ID(); 
$title = get_the_title(); 
$header_image = get_the_post_thumbnail($page_id, 'large', array(
    'class' => 'w-100 h-auto', 
    'alt' => get_the_title($page_id) . ' header image'
)); 
?>

<main id="maincontent" tabindex="-1">
    <section class="reviews-page-hero" aria-labelledby="page-title" role="region">
        <div class="reviews-hero-container container">
            <div class="reviews-hero-row row justify-content-center position-relative">
                <div class="col-lg-7 col-xl-5">
                    <h1 id="page-title" class="h1"><?php echo esc_html($title); ?></h1>
                    <p class="mb-4">
                        Throughout my career, I've been fortunate to build strong relationships with talented people — from creatives and project managers to clients and agency leaders.
                        And I am humbled that those same people took the time to write some nice things about me below.
                    </p>
                    <p class="mb-4">
                       When you work with me, you will get my all. I take pride in my work
                       and I am passionate about every part of the process, every detail, 
                       and I strive to bring that energy to <strong>every</strong> project.
                    </p>
                    <a href="mailto:bijonlb.dev@gmail.com" class="pw-solid-button" aria-label="Email Bijon Lebowitz now">Talk to me Today!</a>

                    <p class="small-text pt-5">
                        <em>
                            To see the original recommendations, visit my 
                            <a href="https://www.linkedin.com/in/bijonlb/" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn profile of Bijon Lebowitz">
                                LinkedIn profile
                            </a>.
                        </em>
                    </p>                
                </div>
                <div class="col-lg-4 col-xl-3 pt-sm-4 pt-4 pt-md-4 pt-lg-0">
                    <?php echo $header_image ?>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-0" aria-labelledby="testimonials-heading" role="region">
        <div class="reviews-content-container container">
            <h2 id="testimonials-heading" class="visually-hidden">Testimonials</h2>
            <div class="reviews-content-container-row" role="list">
                <?php  
                if ( $all_reviews->have_posts() ) { 
                    $index = 0; 
                    while ( $all_reviews->have_posts() ) {
                        $all_reviews->the_post();
                        $id = get_the_ID(); 

                        $title      = get_the_title( $id );
                        $content    = apply_filters( 'the_content', get_post_field( 'post_content', $id ) );
                        $quote_attr = get_post_meta( $id, 'quote_attribute', true );
                        ?>
                        <div class="testimonial-col" role="listitem">
                            <article 
                                class="testimonial-content-wrapper" 
                                tabindex="0" 
                                role="article" 
                                aria-labelledby="testimonial-title-<?php echo esc_attr($id); ?>" 
                                aria-describedby="testimonial-content-<?php echo esc_attr($id); ?>"
                            >
                                <h3 id="testimonial-title-<?php echo esc_attr($id); ?>" class="visually-hidden">Testimonial from <?php echo esc_html($title); ?></h3>
                                <blockquote id="testimonial-content-<?php echo esc_attr($id); ?>" class="testimonial-content-quote">
                                    <?php echo wp_kses_post($content); ?>
                                </blockquote>
                                <?php if ( $quote_attr ) { ?>
                                    <footer class="testimonial-content-attribute">
                                        <p class="quote-attribute"><?php echo esc_html( $quote_attr ); ?></p>
                                    </footer>
                                <?php } ?>
                            </article>
                        </div>
                        <?php 
                        $index++;
                    } 
                } 
                wp_reset_postdata(); 
                ?>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>
