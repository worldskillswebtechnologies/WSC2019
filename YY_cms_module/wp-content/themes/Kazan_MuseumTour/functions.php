<?php

// login page
add_action('login_enqueue_scripts', function () {
    wp_enqueue_style('login-custom-style', get_stylesheet_directory_uri() . '/css/login.css');
});

// post -> news post
// page -> museum
add_action('init', function () {
    $post = get_post_type_object('post');
    foreach ($post->labels as $key => $value) {
        $value = str_replace('Post', 'News Post', $value);
        $value = str_replace('post', 'news post', $value);
        $post->labels->{$key} = $value;
    }

    $page = get_post_type_object('page');
    foreach ($page->labels as $key => $value) {
        $value = str_replace('Page', 'Museum', $value);
        $value = str_replace('page', 'museum', $value);
        $page->labels->{$key} = $value;
    }
});

// remove dashboard metabox
remove_action('welcome_panel', 'wp_welcome_panel');
add_action('admin_menu', function() {
    remove_meta_box('wpseo-dashboard-overview','dashboard','normal');
    remove_meta_box('dashboard_primary','dashboard','side');
});






















