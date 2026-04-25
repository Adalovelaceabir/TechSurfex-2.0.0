<?php
/**
 * TechSurfex Theme Functions
 * Author: Abir
 */

// Theme Setup
function techsurfex_setup() {
    // Add theme support
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', array(
        'height' => 40,
        'width' => 150,
        'flex-height' => true,
        'flex-width' => true,
    ));
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    add_theme_support('responsive-embeds');
    
    // Set thumbnail sizes
    set_post_thumbnail_size(800, 500, true);
    add_image_size('featured-large', 800, 500, true);
    add_image_size('card-image', 400, 220, true);
    
    // Register menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'techsurfex'),
    ));
}
add_action('after_setup_theme', 'techsurfex_setup');

// Enqueue Scripts and Styles
function techsurfex_scripts() {
    // Enqueue main stylesheet
    wp_enqueue_style('techsurfex-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0');
    
    // Enqueue theme JavaScript
    wp_enqueue_script('techsurfex-theme-js', get_template_directory_uri() . '/assets/js/theme.js', array(), '1.0.0', true);
    
    // Comment reply script
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'techsurfex_scripts');

// Register Widget Areas
function techsurfex_widgets_init() {
    // Main Sidebar
    register_sidebar(array(
        'name' => __('Main Sidebar', 'techsurfex'),
        'id' => 'sidebar-main',
        'description' => __('Right sidebar widget area', 'techsurfex'),
        'before_widget' => '<div class="sidebar-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ));
    
    // Top Banner Ad
    register_sidebar(array(
        'name' => __('Top Banner', 'techsurfex'),
        'id' => 'ad-top-banner',
        'description' => __('728x90 advertisement banner in header', 'techsurfex'),
        'before_widget' => '<div class="ad-banner top-banner">',
        'after_widget' => '</div>',
        'before_title' => '<div class="hidden">',
        'after_title' => '</div>',
    ));
    
    // Mid Content Ad
    register_sidebar(array(
        'name' => __('Mid Content Ad', 'techsurfex'),
        'id' => 'ad-mid-content',
        'description' => __('728x90 advertisement between featured and grid', 'techsurfex'),
        'before_widget' => '<div class="ad-banner mid-banner">',
        'after_widget' => '</div>',
        'before_title' => '<div class="hidden">',
        'after_title' => '</div>',
    ));
    
    // Bottom Banner Ad
    register_sidebar(array(
        'name' => __('Bottom Banner', 'techsurfex'),
        'id' => 'ad-bottom-banner',
        'description' => __('970x250 billboard advertisement before footer', 'techsurfex'),
        'before_widget' => '<div class="ad-banner bottom-banner">',
        'after_widget' => '</div>',
        'before_title' => '<div class="hidden">',
        'after_title' => '</div>',
    ));
    
    // Footer Columns
    for ($i = 1; $i <= 4; $i++) {
        register_sidebar(array(
            'name' => sprintf(__('Footer Column %d', 'techsurfex'), $i),
            'id' => 'footer-' . $i,
            'description' => sprintf(__('Footer widget column %d', 'techsurfex'), $i),
            'before_widget' => '<div class="footer-widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));
    }
}
add_action('widgets_init', 'techsurfex_widgets_init');

// Get category badge class based on slug
function techsurfex_category_badge_class($category) {
    $slug = $category->slug;
    $classes = array(
        'politics' => 'category-politics',
        'technology' => 'category-technology',
        'tech' => 'category-technology',
        'sports' => 'category-sports',
        'business' => 'category-business',
        'entertainment' => 'category-entertainment',
        'entertain' => 'category-entertainment',
    );
    return isset($classes[$slug]) ? $classes[$slug] : 'category-politics';
}

// Custom pagination for custom queries
function techsurfex_pagination($query = null) {
    $big = 999999999;
    $pages = paginate_links(array(
        'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $query ? $query->max_num_pages : $wp_query->max_num_pages,
        'type' => 'array',
        'prev_text' => '<i class="fas fa-angle-left"></i>',
        'next_text' => '<i class="fas fa-angle-right"></i>',
    ));
    
    if (is_array($pages)) {
        echo '<div class="pagination">';
        foreach ($pages as $page) {
            echo $page;
        }
        echo '</div>';
    }
}

// Limit excerpt length
function techsurfex_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'techsurfex_excerpt_length');

// Custom excerpt more
function techsurfex_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'techsurfex_excerpt_more');

// Get breaking news posts for ticker
function techsurfex_breaking_news() {
    $breaking_query = new WP_Query(array(
        'posts_per_page' => 5,
        'ignore_sticky_posts' => 1,
    ));
    
    if ($breaking_query->have_posts()) {
        echo '<ul>';
        while ($breaking_query->have_posts()) {
            $breaking_query->the_post();
            echo '<li><a href="' . get_permalink() . '">🔴 ' . get_the_title() . '</a></li>';
        }
        echo '</ul>';
        wp_reset_postdata();
    } else {
        echo '<ul><li><a href="#">Latest news updates coming soon</a></li></ul>';
    }
}
