<?php get_header() ?>

<div class="banner">
    <img src="<?=get_stylesheet_directory_uri().'/images/category.jpg'?>" alt="category image page">
</div>

<div class="container">
    <div class="title">
        <div class="h2"><?=single_term_title()?></div>
    </div>
    <div class="deck">
        <?php while(have_posts()): the_post(); ?>
            <div class="card">
                <div class="card-article">
                    <a href="<?=get_permalink()?>" class="h3">
                        <?=get_the_title()?>
                    </a>
                    <p>
                        <?=wp_strip_all_tags(get_the_content()) ?>
                    </p>
                    <a href="<?=get_permalink()?>" class="btn">
                        Learn More
                    </a>
                </div>
                <div class="card-thumbnail">
                    <?=get_the_post_thumbnail()?>
                </div>
            </div>
        <?php endwhile ?>
    </div>
</div>

<?php get_footer() ?>
