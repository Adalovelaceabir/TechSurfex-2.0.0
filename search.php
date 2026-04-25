<?php get_header(); ?>

<main class="container main-content">
    <div class="news-grid" style="width: 70%;">
        <h2 class="section-title">Search Results for: <?php echo get_search_query(); ?></h2>
        
        <div class="grid-container">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <article class="news-card">
                    <div class="card-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <?php the_post_thumbnail('card-image'); ?>
                        <?php else : ?>
                            <img src="https://picsum.photos/400/220?random=<?php echo get_the_ID(); ?>" alt="<?php the_title_attribute(); ?>">
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
            <?php endwhile; else : ?>
                <p>No results found. Try a different search term.</p>
            <?php endif; ?>
        </div>
        
        <?php the_posts_pagination(array(
            'mid_size' => 2,
            'prev_text' => '<i class="fas fa-angle-left"></i>',
            'next_text' => '<i class="fas fa-angle-right"></i>',
        )); ?>
    </div>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
