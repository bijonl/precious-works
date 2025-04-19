<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS (Replace with local version in production) -->
    <link 
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
        rel="stylesheet" 
        integrity="sha384-..." 
        crossorigin="anonymous"
    />

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Skip link for screen reader and keyboard users -->
    <a class="visually-hidden-focusable" href="#main-content">Skip to main content</a>
    <!-- Site Wrapper -->
    <div id="page" class="site">
    <!-- Site Header -->
    <header class="site-header py-3 border-bottom" role="banner">
        <div class="container">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <div>
                    <h1 class="site-title mb-0">
                        <a href="<?php echo esc_url(home_url('/')); ?>" 
                            class="text-decoration-none text-dark">
                            <?php bloginfo('name'); ?>
                        </a>
                    </h1>
                    <p class="site-description mb-0">
                        <?php bloginfo('description'); ?>
                    </p>
                </div>
            </div>
        </div>
    </header>
<!-- Start of Main Content -->
<main id="main-content" class="site-main" role="main">
