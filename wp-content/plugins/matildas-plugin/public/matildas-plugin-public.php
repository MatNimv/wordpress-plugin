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
        plugin_dir_url(__FILE__) . "js/matildas-plugin-public.js",
        [],
        false,
        true        // Put our <script> before closing </body>
    );

    $html = "
        <form id='matildas-plugin-form'>
            <input type='text' name='country' placeholder='Write a country!'>
            <button>Submit country</button>
        </form>
    ";

    // Shortcodes must return their content (not 'echo')
    return $html;
}

// https://developer.wordpress.org/reference/functions/add_shortcode/
add_shortcode("matildas-plugin-shortcode", "matildas_plugin_setup_shortcode");

