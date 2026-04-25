<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="header">
    <div class="container">
        <div class="logo">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-title"><?php bloginfo('name'); ?></a>
                <p class="site-description"><?php bloginfo('description'); ?></p>
            <?php endif; ?>
        </div>

        <!-- Top Banner Ad Widget Area -->
        <?php if (is_active_sidebar('ad-top-banner')) : ?>
            <?php dynamic_sidebar('ad-top-banner'); ?>
        <?php else : ?>
            <div class="ad-banner top-banner">
                <div class="ad-placeholder" data-ad-size="728x90">
                    <i class="fas fa-ad"></i> Advertisement 728x90
                </div>
            </div>
        <?php endif; ?>

        <nav class="main-nav">
            <button class="mobile-menu-btn" id="mobileMenuToggle" aria-label="Menu">
                <i class="fas fa-bars"></i>
            </button>
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'menu_id' => 'navMenuList',
                'container' => false,
                'fallback_cb' => false,
                'depth' => 1,
            ));
            ?>
        </nav>
    </div>
</header>

<!-- Breaking News Ticker -->
<div class="breaking-news">
    <div class="container">
        <span class="breaking-label">Breaking:</span>
        <div class="ticker">
            <?php techsurfex_breaking_news(); ?>
        </div>
    </div>
</div>
