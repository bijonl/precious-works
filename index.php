<?php get_header(); ?>

<main>
  <h1>Hello from the theme index.php</h1>
  <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    endif;
  ?>
</main>

<?php get_footer(); ?>
