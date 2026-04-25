<?php get_header(); ?>

<main class="container main-content">
    <div class="news-grid" style="width: 70%;">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <article <?php post_class('featured'); ?> style="display: block;">
                <div class="featured-image">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('featured-large', array('class' => 'img-responsive')); ?>
                    <?php endif; ?>
                </div>
                <div class="featured-content" style="width: 100%;">
                    <h1><?php the_title(); ?></h1>
                    <div class="meta">
                        <span><i class="fas fa-user"></i> By <?php the_author(); ?></span>
                        <span><i class="far fa-calendar-alt"></i> <?php echo get_the_date(); ?></span>
                        <span><i class="far fa-comment"></i> <?php comments_number('0', '1', '%'); ?> Comments</span>
                        <?php $categories = get_the_category(); ?>
                        <?php if (!empty($categories)) : ?>
                            <span><i class="fas fa-folder"></i> <?php the_category(', '); ?></span>
                        <?php endif; ?>
                    </div>
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    <?php comments_template(); ?>
                </div>
            </article>
        <?php endwhile; endif; ?>
    </div>
    
    <?php get_sidebar(); ?>
</main>

<?php get_footer(); ?>
