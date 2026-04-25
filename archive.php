<?php get_header(); ?>

<main class="container main-content">
    <div class="news-grid" style="width: 70%;">
        <h2 class="section-title">
            <?php
            if (is_category()) {
                single_cat_title();
            } elseif (is_tag()) {
                single_tag_title();
            } elseif (is_author()) {
                echo 'Posts by ' . get_the_author();
            } elseif (is_date()) {
                echo get_the_date('F Y');
            } else {
                echo 'Archives';
            }
            ?>
        </h2>
        
        <div class="grid-container">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
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
            <?php endwhile; endif; ?>
        </div>
        
        <?php the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '<i class="fas fa-angle-left"></i>',
            'next_text' => '<i class="fas fa-angle-right"></i>',
            'screen_reader_text' => ' ',
        )); ?>
    </div>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
