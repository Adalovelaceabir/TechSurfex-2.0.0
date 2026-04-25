<?php get_header(); ?>

<main class="container main-content">
    <div class="news-grid" style="width: 70%;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class(); ?>>
                <h1><?php the_title(); ?></h1>
                <?php if (has_post_thumbnail()) : ?>
                    <div class="featured-image" style="margin-bottom: 20px;">
                        <?php the_post_thumbnail('featured-large', array('class' => 'img-responsive')); ?>
                    </div>
                <?php endif; ?>
                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
