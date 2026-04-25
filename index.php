<?php get_header(); ?>

<main class="container main-content">
    
    <?php
    // Get featured post (latest post on first page only)
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $featured_id = '';
    
    if (!is_paged()) {
        $featured_query = new WP_Query(array(
            'posts_per_page' => 1,
            'ignore_sticky_posts' => 1,
        ));
        
        if ($featured_query->have_posts()) {
            while ($featured_query->have_posts()) {
                $featured_query->the_post();
                $featured_id = get_the_ID();
                ?>
                <section class="featured-article">
                    <article class="featured">
                        <div class="featured-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('featured-large', array('class' => 'img-responsive')); ?>
                            <?php else : ?>
                                <img src="https://picsum.photos/id/104/800/500" alt="Featured Image" class="img-responsive">
                            <?php endif; ?>
                            <?php $categories = get_the_category(); ?>
                            <?php if (!empty($categories)) : ?>
                                <span class="category-badge <?php echo techsurfex_category_badge_class($categories[0]); ?>"><?php echo esc_html($categories[0]->name); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="featured-content">
                            <h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
                            <div class="meta">
                                <span><i class="fas fa-user"></i> By <?php the_author(); ?></span>
                                <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                                <span><i class="far fa-comment"></i> <?php comments_number('0', '1', '%'); ?> Comments</span>
                            </div>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                        </div>
                    </article>
                </section>
                <?php
            }
            wp_reset_postdata();
        }
    }
    ?>
    
    <!-- Mid Content Ad -->
    <?php if (is_active_sidebar('ad-mid-content')) : ?>
        <?php dynamic_sidebar('ad-mid-content'); ?>
    <?php else : ?>
        <div class="ad-banner mid-banner">
            <div class="ad-placeholder" data-ad-size="728x90">
                <i class="fas fa-ad"></i> Mid-page Advertisement 728x90
            </div>
        </div>
    <?php endif; ?>
    
    <!-- News Grid Section -->
    <section class="news-grid">
        <h2 class="section-title">Latest News</h2>
        
        <div class="grid-container">
            <?php
            // Grid query - exclude featured post if on first page
            $grid_args = array(
                'posts_per_page' => 6,
                'paged' => $paged,
                'ignore_sticky_posts' => 1,
            );
            
            if (!is_paged() && !empty($featured_id)) {
                $grid_args['post__not_in'] = array($featured_id);
            }
            
            $grid_query = new WP_Query($grid_args);
            
            if ($grid_query->have_posts()) :
                while ($grid_query->have_posts()) : $grid_query->the_post();
                    ?>
                    <article class="news-card">
                        <div class="card-image">
                            <?php if (has_post_thumbnail()) : ?>
                                <?php the_post_thumbnail('card-image'); ?>
                            <?php else : ?>
                                <img src="https://picsum.photos/400/220?random=<?php echo get_the_ID(); ?>" alt="<?php the_title_attribute(); ?>">
                            <?php endif; ?>
                            <?php $categories = get_the_category(); ?>
                            <?php if (!empty($categories)) : ?>
                                <span class="category-badge <?php echo techsurfex_category_badge_class($categories[0]); ?>"><?php echo esc_html($categories[0]->name); ?></span>
                            <?php endif; ?>
                        </div>
                        <div class="card-content">
                            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="meta">
                                <span><i class="fas fa-user"></i> By <?php the_author(); ?></span> | 
                                <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                            </div>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 15, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="read-more">Read More</a>
                        </div>
                    </article>
                    <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No posts found.</p>';
            endif;
            ?>
        </div>
        
        <?php techsurfex_pagination($grid_query); ?>
    </section>
    
    <!-- Sidebar -->
    <?php get_sidebar(); ?>
    
    <!-- Bottom Banner Ad -->
    <?php if (is_active_sidebar('ad-bottom-banner')) : ?>
        <?php dynamic_sidebar('ad-bottom-banner'); ?>
    <?php else : ?>
        <div class="ad-banner bottom-banner">
            <div class="ad-placeholder" data-ad-size="970x250">
                <i class="fas fa-ad"></i> Billboard 970x250 — Ad Space
            </div>
        </div>
    <?php endif; ?>
    
</main>

<?php get_footer(); ?>
