<?php
// Public stuff

require_once __DIR__ . "/../includes/public-functions.php";

function world_plugin_setup_shortcode() {
    wp_enqueue_style(
        "world-plugin-public-style",
        plugin_dir_url(__FILE__) . "css/world-plugin-public.css"
    );

    wp_enqueue_script(
        "world-plugin-public-script",
        plugin_dir_url(__FILE__) . "js/world-plugin-public.js",
        [],
        false,
        true // Put our <script> before closing </body>
    );

    //min alert funktion
    wp_enqueue_script(
        "world-plugin-header",
        plugin_dir_url(__FILE__) . "js/world-plugin-header.js",
    );

    //OM användaren INTE har skrivit in något, syns detta:
    $message = "";
    if (!isset($POST["country"])){
        $message = "";
    } else {
        //OM användaren har skrivit in något:
        $message = getCountryOnContinentInfo($POST["country"]);
    }
    
    $data = get_option("world-plugin-data");
    $continent = $data["continents"];

    $html = "
    <p>Please submit a country in this region: <span>$continent</span></p>
    <form id='world-plugin-form'>
        <input type='hidden' name='action' value='world_plugin_ajax'>
        <input type='text' name='country' placeholder='Write a country!'>
        <p>$message</p>
        <button>Submit country</button>
    </form>
    ";

    //returnerar htmlen
    return $html;
}

// https://developer.wordpress.org/reference/functions/add_shortcode/
add_shortcode("world-plugin-shortcode", "world_plugin_setup_shortcode");
//add_shortcode("world-plugin-shortcode", "world_plugin_setup_two_shortcode");

// This handles our async request from the frontend
function world_plugin_ajax() {
    // Fetch all data
    $data = get_option("world-plugin-data");
    $data["country"] = [];

    // Get the posted data
    $newCountry = $_POST["country"];

    if (getCountryOnContinentInfo($newCountry) == false){
        http_response_code(404);
        //här ska något felmeddelande komma 
        //fram till användaren

        echo '<script>alertWindow("Submitted country is not in continent.")</script>';
        echo json_encode(["message" => "Submitted country is not in continent."]);
        exit();
    } else {
    // Uppdaterar nyckelns array
    array_push($data["country"], $newCountry);
    // Save our changes to the DB
    update_option("world-plugin-data", $data);

    // Respons with some success message
    "<script>alertWindow('You submitted $newCountry!)</script>";
    echo json_encode(["message" => "Successfully added a new country!"]);
    exit();
    }

}

// "wp_ajax_{YOUR CUSTOM EVENT NAME}", "handler"
add_action("wp_ajax_world_plugin_ajax", "world_plugin_ajax");
// 'nopriv' is needed for not-logged-in requests
add_action("wp_ajax_nopriv_world_plugin_ajax", "world_plugin_ajax");