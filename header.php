<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (local version example - uncomment and set correct path) -->
    <!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.min.css"> -->

    <!-- Temporary: Bootstrap CDN for dev (replace later with local file) -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-..." 
        crossorigin="anonymous"
    />

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <header class="site-header py-3 border-bottom">
        <div class="container">
            <h1 class="site-title">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="text-decoration-none text-dark">
                    <?php bloginfo('name'); ?>
                </a>
            </h1>
            <p class="site-description mb-0"><?php bloginfo('description'); ?></p>
        </div>
    </header>
