<?php // Theme setup
// Load Custom Post Types
require get_template_directory() . '/custom-post-types/staff.php';
require get_template_directory() . '/custom-post-types/testimonials.php';
require get_template_directory() . '/custom-post-types/projects.php';


$block_render_paths = [
    'src/blocks/render-blocks/staff-block.php',
    'src/blocks/render-blocks/testimonial-block.php',
    'src/blocks/render-blocks/featured-work-block.php',
];

foreach ( $block_render_paths as $path ) {
    $full_path = get_template_directory() . '/' . $path;
    error_log('Trying to require: ' . $full_path);
    if ( file_exists( $full_path ) ) {
        require_once $full_path;
    } else {
        error_log('File not found: ' . $full_path);
    }
}

$register_block_dir = get_template_directory() . '/src/blocks/register-blocks/';
$register_block_files = glob( $register_block_dir . '*.php' );

foreach ( $register_block_files as $file ) {
    require_once $file;
}



function precious_works_theme_setup() {
    // Add support for dynamic <title> tag
    add_theme_support('title-tag');

    // Add support for featured images
    add_theme_support('post-thumbnails');

    // Add custom image size for pet photos (square 800x800)
    add_image_size( 'pet_photo', 800, 800, true ); // 'true' for cropping

    // Add support for editor styles (optional)
    add_theme_support('editor-styles');

    // Add custom editor stylesheet if needed
    // add_editor_style('assets/css/editor-style.css');

    // Add support for wide/full align blocks
    add_theme_support('align-wide');

    // Add block styles
    add_theme_support('wp-block-styles');

    // Load translations if needed
    load_theme_textdomain('mytheme', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'precious_works_theme_setup');

function precious_works_block_category( $categories, $post ) {
    return array_merge(
        $categories,
        [
            [
                'slug'  => 'precious-works',
                'title' => __( 'Precious Works Blocks', 'mytheme' ),
            ],
        ]
    );
}
add_filter( 'block_categories_all', 'precious_works_block_category', 10, 2 );



function theme_enqueue_styles() {
    // Enqueue the main CSS file (compiled SCSS)
    wp_enqueue_style(
        'theme-style', // Handle for the style
        get_template_directory_uri() . '/assets/css/style.css', // Path to the compiled CSS
        array(), // Dependencies (empty if none)
        filemtime(get_template_directory() . '/assets/css/style.css'), // Version based on file timestamp (cache busting)
        'all' // Media type
    );

    // Enqueue Google Font: Inter
    wp_enqueue_style( 
        'inter-font', 
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap', 
        false 
    );

    // Your new global JS
    wp_enqueue_script( 'precious-global', get_template_directory_uri() . '/assets/js/global.js', [], '1.0', true );

}
add_action('wp_enqueue_scripts', 'theme_enqueue_styles');

function precious_works_enqueue_scripts() {
    wp_enqueue_script(
        'precious-works-blocks', // Handle
        get_template_directory_uri() . '/build/index.js', // Path to compiled JS
        array('wp-blocks', 'wp-element', 'wp-editor'), // Dependencies (important for React in WP)
        filemtime(get_template_directory() . '/build/index.js'), // Cache-busting
        true // Load in footer
    );

}
add_action('enqueue_block_editor_assets', 'precious_works_enqueue_scripts'); // Loads in the block editor

add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type) {
    $disabled_post_types = array(
        'testimonials', 
        'staff', 
        'projects'
    ); 

    // Use your post type key instead of 'product'
    if (in_array($post_type, $disabled_post_types)) return false;
    return $current_status;
}



// Add the ToC meta box
function add_subtitle_meta_box() {
    add_meta_box('subtitle', 'Subtitle', 'subtitle_box_callback', 'post', 'side', 'default');
}
add_action('add_meta_boxes', 'add_subtitle_meta_box');

function subtitle_box_callback($post) {
    // Retrieve current value based on post ID
    $value = get_post_meta($post->ID, '_subtitle', true);

    // Output the textarea
    echo '<label for="subtitle_field">Enter a subtitle:</label>';
    echo '<textarea style="width:100%;" id="subtitle_field" name="subtitle_field" rows="4">' . esc_textarea($value) . '</textarea>';

    // Add nonce for security
    wp_nonce_field('subtitle_meta_box_nonce_action', 'subtitle_meta_box_nonce');
}
 
function save_subtitle_meta_box($post_id) {
    // Check nonce
    if (!isset($_POST['subtitle_meta_box_nonce']) || 
        !wp_verify_nonce($_POST['subtitle_meta_box_nonce'], 'subtitle_meta_box_nonce_action')) {
        return;
    }

    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permission
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Sanitize and save
    if (isset($_POST['subtitle_field'])) {
        update_post_meta($post_id, '_subtitle', sanitize_textarea_field($_POST['subtitle_field']));
    }
}
add_action('save_post', 'save_subtitle_meta_box');




// Add the ToC meta box
function add_toc_meta_box() {
    add_meta_box('post_toc', 'Table of Contents', 'toc_meta_box_callback', 'post', 'side', 'default');
}
add_action('add_meta_boxes', 'add_toc_meta_box');

function toc_meta_box_callback($post) {
    wp_nonce_field('toc_meta_box_nonce', 'toc_nonce');

    $toc_items = get_post_meta($post->ID, '_post_toc', true);
    if (!is_array($toc_items)) {
        $toc_items = [];
    }

    echo '<div id="toc-items-container">';

    if (empty($toc_items)) {
        $toc_items[] = ['text' => '', 'url' => ''];
    }

    foreach ($toc_items as $index => $item) {
        $text = esc_attr($item['text']);
        $url = esc_attr($item['url']);
        echo '
        <p style="margin-bottom:10px;" data-index="'.$index.'">
            <label>Text: <input type="text" name="post_toc['.$index.'][text]" value="'.$text.'" style="width: 40%; margin-right:5%;"></label>
            <label>URL: <input type="text" name="post_toc['.$index.'][url]" value="'.$url.'" style="width: 40%; margin-right:5%;"></label>
            <button type="button" class="remove-toc-item-button" style="color:#fff; background:#d9534f; border:none; padding:5px 10px; cursor:pointer;">Remove</button>
        </p>';
    }

    echo '</div>';

    echo '<button type="button" id="add-toc-item" style="margin-top:10px;">Add Item</button>';

    ?>
    <script>
    (function(){
      const container = document.getElementById('toc-items-container');
      const addButton = document.getElementById('add-toc-item');

      // Add new item
      addButton.addEventListener('click', function() {
        const index = container.children.length;
        const p = document.createElement('p');
        p.style.marginBottom = '10px';
        p.setAttribute('data-index', index);
        p.innerHTML = `
          <label>Text: <input type="text" name="post_toc[${index}][text]" style="width: 40%; margin-right:5%;"></label>
          <label>URL: <input type="text" name="post_toc[${index}][url]" style="width: 40%; margin-right:5%;"></label>
          <button type="button" class="remove-toc-item-button" style="color:#fff; background:#d9534f; border:none; padding:5px 10px; cursor:pointer;">Remove</button>
        `;
        container.appendChild(p);
      });

      // Delegate remove button clicks
      container.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('remove-toc-item-button')) {
          const p = event.target.closest('p');
          if (p) {
            container.removeChild(p);
            // After removal, re-index inputs so PHP receives continuous indexes
            Array.from(container.children).forEach((child, i) => {
              child.setAttribute('data-index', i);
              const textInput = child.querySelector('input[type="text"][name*="[text]"]');
              const urlInput = child.querySelector('input[type="text"][name*="[url]"]');
              if (textInput) textInput.name = `post_toc[${i}][text]`;
              if (urlInput) urlInput.name = `post_toc[${i}][url]`;
            });
          }
        }
      });
    })();
    </script>
    <?php
}


// Save the meta box data
function save_toc_meta_box_data($post_id) {
    if (!isset($_POST['toc_nonce']) || !wp_verify_nonce($_POST['toc_nonce'], 'toc_meta_box_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['post_toc']) && is_array($_POST['post_toc'])) {
        $sanitized = [];
        foreach ($_POST['post_toc'] as $item) {
            $text = sanitize_text_field($item['text'] ?? '');
            $url = esc_url_raw($item['url'] ?? '');
            if ($text && $url) {
                $sanitized[] = ['text' => $text, 'url' => $url];
            }
        }
        update_post_meta($post_id, '_post_toc', $sanitized);
    } else {
        delete_post_meta($post_id, '_post_toc');
    }
}
add_action('save_post', 'save_toc_meta_box_data');


function add_custom_og_meta_tags() {
    if (is_single()) {
        global $post;

        // Get Yoast SEO title & description
        $yoast_title = get_post_meta($post->ID, '_yoast_wpseo_title', true);
        $yoast_description = get_post_meta($post->ID, '_yoast_wpseo_metadesc', true);

        // Fallbacks if Yoast fields are empty
        $meta_title = $yoast_title ? $yoast_title : get_the_title($post);
        $meta_description = $yoast_description ? $yoast_description : wp_trim_words(strip_tags($post->post_content), 30);

        // Get featured image URL
        $thumbnail_id = get_post_thumbnail_id($post->ID);
        $image_url = $thumbnail_id ? wp_get_attachment_url($thumbnail_id) : '';

        ?>
        <meta property="og:title" content="<?php echo esc_attr($meta_title); ?>" />
        <meta property="og:description" content="<?php echo esc_attr($meta_description); ?>" />
        <meta property="og:url" content="<?php the_permalink(); ?>" />
        <meta property="og:site_name" content="Precious Works" />
        <meta property="og:type" content="article" />
        <?php if ($image_url): ?>
            <meta property="og:image" content="<?php echo esc_url($image_url); ?>" />
        <?php endif; ?>
        <?php
    }
}
add_action('wp_head', 'add_custom_og_meta_tags');

add_filter('render_block', function ($block_content, $block) {

    if ( in_array( $block['blockName'], [ 'core/heading', 'core/paragraph', 'gravityforms/form' ] ) ) {
    $column_class = ( $block['blockName'] === 'gravityforms/form' ) 
        ? 'col-sm-8 mx-auto' 
        : 'col-12';

    return '<div class="container"><div class="row"><div class="' . esc_attr( $column_class ) . '">'
        . $block_content .
        '</div></div></div>';
    }

    return $block_content;
}, 10, 2);





