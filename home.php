<?php get_header(); ?>

<div class="container py-5">
  <h1 class="mb-4">#PreciousBlogs</h1>
  <div class="alert alert-warning mb-4" role="alert">
      <strong>Note:</strong> These blog posts are finalized, but the layout and design of this page are still in progress.
  </div>

  <?php if ( have_posts() ) { ?>
    <div class="row row-cols-1 row-cols-md-2 g-4">

      <?php while ( have_posts() ) { the_post(); ?>
        <div class="col">
          <div class="card h-100">
            <div class="card-body">
              <h5 class="card-title">
                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                  <?php the_title(); ?>
                </a>
              </h5>
            </div>
            <div class="card-footer">
              <small class="text-muted">Posted on <?php echo get_the_date(); ?></small>
            </div>
          </div>
        </div>
      <?php } ?>

    </div>

    <div class="mt-5">
      <?php the_posts_pagination(); ?>
    </div>

  <?php } else { ?>
    <p>No posts found.</p>
  <?php } ?>

</div>

<?php get_footer(); ?>
