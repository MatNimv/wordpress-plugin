<?php
// Admin stuff

function matildas_plugin_admin_view() {
    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
    wp_enqueue_style(
        "matildas-plugin-admin-style",
        // https://developer.wordpress.org/reference/functions/plugin_dir_url/
        plugin_dir_url(__FILE__) . "css/matildas-plugin-admin.css"
    );

    // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    wp_enqueue_script(
        "matildas-plugin-admin-script",
        plugin_dir_url(__FILE__) . "js/matildas-plugin-admin.js"
    );

    echo "
        <h1>Matildas plugin</h1>
        <p class='mitt-admin-test'>Hello!</p>
    ";
}

function matildas_plugin_setup_admin_menu() {
    // https://developer.wordpress.org/reference/functions/add_menu_page/
    add_menu_page(
        "Matildas Plugin Settings",     // Page title
        "Matildas Plugin",              // Menu title
        "manage_options",           // User permissions
        "matildas-plugin-settings",     // Slug
        "matildas_plugin_admin_view",   // View function
        "dashicons-category",          // Menu icon
        100                         // Menu item position (order)
    );
}

// https://developer.wordpress.org/reference/functions/add_action/
add_action("admin_menu", "matildas_plugin_setup_admin_menu");