<footer class="footer">
    <div class="container">
        <div class="footer-widgets">
            <?php for ($i = 1; $i <= 4; $i++) : ?>
                <?php if (is_active_sidebar('footer-' . $i)) : ?>
                    <div class="footer-widget-col">
                        <?php dynamic_sidebar('footer-' . $i); ?>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
        </div>
        <div class="copyright">
            <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?> | Created by Abir. All Rights Reserved.</p>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
