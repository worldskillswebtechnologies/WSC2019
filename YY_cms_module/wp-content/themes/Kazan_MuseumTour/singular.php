<?php get_header(); the_post(); ?>

<div class="banner">
    <?php the_post_thumbnail() ?>
</div>

<div class="container singular">
    <div class="h2"><?php the_title() ?></div>
    <p><?php the_content() ?></p>
</div>

<?php get_footer(); ?>
