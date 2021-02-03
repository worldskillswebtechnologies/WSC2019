<?php get_header() ?>

<h1>Front Page</h1>

<div id="visual">
    <div class="cover">
        <div class="h1">
            Welcome to Kazan Museum
        </div>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit.
        </p>
    </div>
</div>

<div class="container">
    <div class="title">
        <div class="h2">News Posts</div>
    </div>
    <div class="deck">
        <?php
        $posts = get_posts([
            'posts_per_page' => 6
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

<div class="container">
    <div class="title">
        <div class="h2">Museums</div>
    </div>
    <div class="deck">
        <?php
        $posts = get_posts([
            'posts_per_page' => -1,
            'post_type' => 'page',
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

<div class="container">
    <div class="title">
        <div class="h2">Contact Form</div>
    </div>
    <div class="form">
        <form action="https://formspree.io/email@domain.tld" method="POST">
            <div class="form-group">
                <input type="text" name="name" class="input" placeholder="Name">
            </div>
            <div class="form-group">
                <input type="email" name="_replyto" class="input" placeholder="Email">
            </div>
            <div class="form-group">
                <textarea name="content" class="input" rows="8" placeholder="Content"></textarea>
            </div>
            <div class="form-button">
                <input type="submit" value="Send" class="btn">
            </div>
        </form>
    </div>
</div>










<?php get_footer() ?>
