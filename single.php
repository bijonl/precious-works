<?php get_header(); ?>
<?php
    $id = get_the_id(); 
    $toc_items = get_post_meta(get_the_ID(), '_post_toc', true);
    $subtitle = get_post_meta(get_the_ID(), '_subtitle', true);
    $date = get_the_date('F d, Y'); 
    $modified = get_the_modified_date('F d, Y'); 
    $title = get_the_title(); 
?>

<main class="container my-5" role="main" aria-label="Blog post content">
  <div class="row justify-content-center">
    <!-- Sidebar TOC (Desktop only) -->
    <?php if (!empty($toc_items) && is_array($toc_items)) { ?>
      <aside class="col-lg-3 ms-auto d-none d-lg-block">
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
    <div class="col-12 mx-auto col-lg-7">
      <article id="post-<?php echo $id ?>" <?php post_class(); ?>>

        <!-- Title & Subtitle -->
        <header class="mb-4 blog-meta-header">
          <div class="d-flex">
            <p class="me-4"><b>Published:</b> <?php echo $date ?></p>
            <p><b>Last Modified:</b> <?php echo $modified ?></p>
          </div>
          <h1><?php echo $title ?></h1>
          <?php if($subtitle) { ?>
              <p class="lead text-muted"><em><?php echo $subtitle ?></em></p>
          <?php } ?>
          <p class="color-pink">Written by: Bijon L Banerjee</p>
        </header>
        <!-- Mobile Dropdown TOC -->
        <?php if (!empty($toc_items) && is_array($toc_items)) { ?>
          <div class="d-block d-lg-none mb-3">
              <nav class="mobile-toc" aria-label="Table of contents (mobile)">
                <ul class="list-unstyled small d-flex">
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
        <?php } ?>
        <!-- Post Content -->
        <div class="post-content">
          <?php the_content(); ?>
        </div>
        <p class="ai-text d-block d-lg-none"><em>
                AI tools are becoming commonplace across industries—including content creation. 
                While I don't use AI to write fully write these posts, I do leverage it for support with 
                wording, clarity, and occasional fact-checking (yes, even this disclaimer is getting 
                a little help from AI). The ideas, structure, analogies, and opinions shared here are 
                entirely my own, grounded in real-world development experience and informed by outside 
                research, which I cite wherever possible. My goal is to maintain transparency not just in 
                what I write, but how I write it.
        </em></p>

      </article>
    </div>

  </div>
</main>

<?php get_footer(); ?>
