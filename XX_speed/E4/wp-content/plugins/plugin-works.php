<?php
/*
 * Plugin Name:Plugin Works
 */

add_action('admin_menu', function () {
    add_menu_page(
        'Plugin works!',
        'Plugin works!',
        'manage_options',
        'plugin-works',
        function () {
            ?>
            <div class="wrap">
                <h1>Plugin works!</h1>
            </div>
            <?php
    });
});