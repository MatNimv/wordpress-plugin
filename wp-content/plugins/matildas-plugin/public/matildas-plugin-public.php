<?php
// Public stuff

function matilda_plugin_setup_shortcode() {
    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
    wp_enqueue_style(
        "matildas-plugin-public-style",
        plugin_dir_url(__FILE__) . "css/matildas-plugin-public.css"
    );

    // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    wp_enqueue_script(
        "matildas-plugin-public-script",
        plugin_dir_url(__FILE__) . "js/matildas-plugin-public.js"
    );

    $html = "
        <p class='ett-test'>Hejjjjjj!</p>
    ";

    // Shortcodes must return their content (not 'echo')
    return $html;
}

// https://developer.wordpress.org/reference/functions/add_shortcode/
add_shortcode("matildas-plugin-shortcode", "matildas_plugin_setup_shortcode");