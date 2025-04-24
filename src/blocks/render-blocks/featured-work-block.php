<?php function pw_render_featured_work_block( $attributes ) {
    error_log('Rendering staff block');
    $anchor_id = isset( $attributes['anchor'] ) ? esc_attr( $attributes['anchor'] ) : '';
    $project_ids = isset( $attributes['featuredProjects'] ) ? $attributes['featuredProjects'] : [];

    // Start output buffering
    ob_start(); ?>

    <section class="featured-work-section" id="<?php echo $anchor_id ?>">
        <div class="feature-work-container container">
            <div class="featured-work-title-row title-row row">
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
            <div class="featured-work-row row">

            <?php print_r($project_ids) ?>
                <?php if($project_ids) {
                    foreach($project_ids as $project) {
                        echo $project; 
                    }
                } else {
                    echo 'no'; 
                }?>





            </div>


    </section>

<?php 

    return ob_get_clean();
}