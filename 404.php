<?php get_header(); ?>

<main class="container main-content">
    <div class="news-grid" style="width: 100%; text-align: center; padding: 60px 20px;">
        <h1 style="font-size: 80px; color: var(--secondary-color);">404</h1>
        <h2>Page Not Found</h2>
        <p>Sorry, the page you are looking for does not exist or has been moved.</p>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="read-more" style="margin-top: 20px;">Go to Homepage</a>
    </div>
</main>

<?php get_footer(); ?>
