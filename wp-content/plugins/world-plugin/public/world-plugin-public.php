<?php
// Public stuff

function world_plugin_setup_shortcode() {
    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
    wp_enqueue_style(
        "world-plugin-public-style",
        plugin_dir_url(__FILE__) . "css/world-plugin-public.css"
    );

    // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    wp_enqueue_script(
        "world-plugin-public-script",
        plugin_dir_url(__FILE__) . "js/world-plugin-public.js",
        [],
        false,
        true        // Put our <script> before closing </body>
    );
    
    $data = get_option("world-plugin-data");
    //$name = $data["name"];

    $continent = $data["continents"];
    $dump = var_dump($data);

    $html = "
    $dump
    <p>Please submit a country in this region: <span>$continent</span></p>
    <form id='world-plugin-form'>
        <input type='hidden' name='action' value='world_plugin_ajax'>
        <input type='text' name='name' placeholder='Write a country!'>
        <button>Submit country</button>
    </form>
    ";

    // Shortcodes must return their content (not 'echo')
    return $html;
}

// https://developer.wordpress.org/reference/functions/add_shortcode/
add_shortcode("world-plugin-shortcode", "world_plugin_setup_shortcode");

// This handles our async request from the frontend
function world_plugin_ajax() {
    // Fetch all data
    $data = get_option("world-plugin-data");

    // Get the posted data
    $newCountry = $_POST["country"];

    // Update the key 'name'
    $data["country"] = [$newCountry];
    // Save our changes to the DB
    // https://developer.wordpress.org/reference/functions/update_option/
    update_option("world-plugin-data", $data);

    // Respons with some success message
    echo json_encode(["message" => "Success!"]);
    exit();
}

// "wp_ajax_{YOUR CUSTOM EVENT NAME}", "handler"
add_action("wp_ajax_world_plugin_ajax", "world_plugin_ajax");
// 'nopriv' is needed for not-logged-in requests
add_action("wp_ajax_nopriv_world_plugin_ajax", "world_plugin_ajax");