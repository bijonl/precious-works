<?php function pw_render_featured_work_block( $attributes ) {
    $anchor_id = isset( $attributes['anchor'] ) ? esc_attr( $attributes['anchor'] ) : '';
    $project_ids = isset( $attributes['featuredProjects'] ) ? $attributes['featuredProjects'] : [];

    // Start output buffering
    ob_start(); ?>

    <section class="featured-work-section" id="<?php echo $anchor_id ?>">
        <div class="feature-work-container container">
            <?php if(is_front_page()) { ?>
                <div class="featured-work-title-row title-row row g-3 align-items-center">
                    <div class="col-lg-6 title-col">
                        <h2><?php echo is_front_page() ? 'Featured Projects - More Coming Soon!' : get_the_title(); ?> </h2>
                        <p> I focus on delivering polished, straightforward results that fit 
                            the client's needs, from design to functionality. With experience 
                            across a range of industries—law, media, nonprofits, and the arts—I've 
                            tailored my approach to each unique need. Check out a few of my recent 
                            projects below.
                        </p>
                    </div>
                    <div class="col-lg-6 button-wrapper text-lg-end">
                        <a href="/precious-projects/" target="_self" rel="noopener noreferrer" class="pw-solid-button" aria-label="see all projects" title="visit precious.works/precious-projects"> 
                            See All Projects                              
                        </a>
                    </div>
                </div>
            <?php } ?>
            <div class="featured-work-row row">
                <?php if($project_ids) {
                    foreach($project_ids as $project) { ?>
                    <?php $title = get_the_title($project);  
                    $image = get_the_post_thumbnail($project, ); 
                    $description = get_the_excerpt($project); 
                    $url = get_post_meta($project, 'project_url', true);                     
                    ?>
                    
                    <div class="col-lg-6 mx-auto single-project" role="region" aria-label="Project: <?php echo esc_attr($title) ?>">
                        <div class="project-content">
                            <div class="project-logo">
                                <?php echo $image ?>
                            </div>
                            <div class="project-title">
                                <h5><?php echo esc_attr($title) ?></h5>
                            </div>
                            <div class="project-description">
                                <?php echo $description ?>
                            </div>
                            <div class="project-button">
                                <a href="<?php echo esc_url($url); ?>" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="pw-solid-button"
                                aria-label="View project: <?php echo esc_attr($title); ?>"
                                title="View project: <?php echo esc_attr($title); ?>">
                                    See Project
                                </a>
                            </div>
                        </div>
                    </div>
                <?php }
                } ?>
            </div>
    </section>
<?php 

    return ob_get_clean();
}