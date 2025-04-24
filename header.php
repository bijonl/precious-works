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
    <div class="alert-bar">
        <nav class="utility-nav container">
            <div class="row">
                <div class="text-center col-sm-12 ms-auto">
                    <p>If you are looking for bijonlb.com, you're in the right place!</p>
                </div>
            </div>
        </nav>
    </div>
    <!-- Site Header -->
    <?php include(locate_template('components/navigation/header-navigation.php')); ?>
<!-- Start of Main Content -->
<main id="main-content" class="site-main" role="main">
