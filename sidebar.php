<aside class="sidebar">
    <?php if (is_active_sidebar('sidebar-main')) : ?>
        <?php dynamic_sidebar('sidebar-main'); ?>
    <?php else : ?>
        <div class="sidebar-widget">
            <h3><i class="fas fa-chart-line"></i> Trending Now</h3>
            <ul>
                <li><a href="#">Add widgets in Appearance → Widgets</a></li>
                <li><a href="#">Customize this sidebar area</a></li>
            </ul>
        </div>
        <div class="sidebar-widget">
            <h3><i class="far fa-envelope"></i> Subscribe</h3>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    <?php endif; ?>
</aside>
