<?php
/*
 * Template Name: Selected Museum
 */

get_header(); the_post();
?>

<div class="selected" style="background-image:url(<?=get_the_post_thumbnail_url()?>)">
    <!-- content -->
    <div class="container">
        <div class="title">
            <div class="h2">
                <?=get_the_title()?>
            </div>
        </div>
        <p>
            <?=get_the_content()?>
        </p>
    </div>
    <!-- news posts -->
    <div class="container">
        <div class="title">
            <div class="h2">News Posts</div>
        </div>
        <div class="deck">
            <?php
            $posts = get_posts([
                'posts_per_page' => -1,
                'category_name' => get_post()->post_name,
            ]);
            foreach ($posts as $post):
                ?>
                <div class="card">
                    <div class="card-article">
                        <a href="<?=get_permalink($post)?>" class="h3">
                            <?=get_the_title($post)?>
                        </a>
                        <p>
                            <?=wp_strip_all_tags($post->post_content) ?>
                        </p>
                        <a href="<?=get_permalink($post)?>" class="btn">
                            Learn More
                        </a>
                    </div>
                    <div class="card-thumbnail">
                        <?=get_the_post_thumbnail($post)?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>

<?php get_footer() ?>