<?php get_header(); ?>

<main class="container my-5" role="main" aria-label="Blog post content">
  <div class="row justify-content-center">

    <?php
    // Fetch your TOC items from custom post meta
    $toc_items = get_post_meta(get_the_ID(), '_post_toc', true);
    ?>

    <!-- Sidebar TOC (Desktop only) -->
    <?php if (!empty($toc_items) && is_array($toc_items)) { ?>
      <aside class="col-lg-3 d-none d-lg-block">
        <nav class="position-sticky" style="top: 100px;" aria-label="Table of contents">
          <h2 class="h6">Table of Contents</h2>
          <ul class="list-unstyled small">
            <?php foreach ($toc_items as $item) { ?>
              <li>
                <a href="<?php echo esc_url($item['url']); ?>">
                  <?php echo esc_html($item['text']); ?>
                </a>
              </li>
            <?php } ?>
          </ul>
            <p class="ai-text"><em>
                AI tools are becoming commonplace across industries—including content creation. 
                While I don't use AI to write fully write these posts, I do leverage it for support with 
                wording, clarity, and occasional fact-checking (yes, even this disclaimer is getting 
                a little help from AI). The ideas, structure, analogies, and opinions shared here are 
                entirely my own, grounded in real-world development experience and informed by outside 
                research, which I cite wherever possible. My goal is to maintain transparency not just in 
                what I write, but how I write it.
            </em></p>
        </nav>
     
    </aside>
    <?php } ?>

    <!-- Main Content -->
    <div class="col-12 ms-auto col-lg-8">
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <!-- Title & Subtitle -->
        <header class="mb-4">
          <h1><?php the_title(); ?></h1>
          <p class="lead text-muted">Subtitle goes here if needed.</p>
        </header>

        <!-- Mobile Dropdown TOC -->
        <?php if (!empty($toc_items) && is_array($toc_items)) { ?>
          <div class="d-block d-lg-none mb-3">
            <button class="btn btn-outline-secondary w-100 mb-2" type="button" data-bs-toggle="collapse" data-bs-target="#mobileToc" aria-expanded="false" aria-controls="mobileToc">
              Jump to section
            </button>
            <div class="collapse" id="mobileToc">
              <nav aria-label="Table of contents (mobile)">
                <ul class="list-unstyled small">
                  <?php foreach ($toc_items as $item) { ?>
                    <li>
                      <a href="<?php echo esc_url($item['url']); ?>">
                        <?php echo esc_html($item['text']); ?>
                      </a>
                    </li>
                  <?php } ?>
                </ul>
              </nav>
            </div>
          </div>
        <?php } ?>

        <!-- Post Content -->
        <div class="post-content">
          <?php the_content(); ?>
        </div>

      </article>
    </div>

  </div>
</main>

<?php get_footer(); ?>
