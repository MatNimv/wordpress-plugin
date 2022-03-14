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
        true
    );

    //hämtning av all data 
    $data = get_option("world-plugin-data");
    $continent = $data["continents"];

    $html = "
    <div id='wrapper'
    style='background-color: rgb(95, 157, 218);height: 300px;display: flex;flex-direction: column;align-items: center'';
    '>
        <p style='font-size: 27px;color: white;'>Please submit a country in this region: <span style='font-weight: bolder;'>$continent</span></p>
        <form id='world-plugin-form' style='display: flex;flex-direction: column;gap: 15px;align-items: center;'>
            <input type='hidden' name='action' value='world_plugin_ajax'>
            <input style='height: 50px;width: 150px;font-size: 20px;text-align: center; color: grey;' type='text' name='country' placeholder='Write a country!'>
            <button style='height: 30px;width: 130px;'>Submit</button>
        </form>
    </div>
    ";

    //returnerar htmlen
    return $html;
}

//lägger till shortcoden för användning
add_shortcode("world-plugin-shortcode", "world_plugin_setup_shortcode");

//async request med frontend
function world_plugin_ajax() {
    // Fetch all data
    $data = get_option("world-plugin-data");

    // Get the posted data
    $newCountry = $_POST["country"];
    $continent = $data["continents"];

    //landet kan INTE kopplas ihop med kontinenten
    if (getCountryOnContinentInfo($newCountry) == false){
        http_response_code(404);
        //här ska något felmeddelande komma 
        //fram till användaren
        echo json_encode(["message" => "Submitted country is not in $continent."]);
        exit();

    } else {//landet kopplas ihop med kontinenten
        //om arrayen inte finns, skapas den.
        if(!isset($data["country"])){ 
            $data["country"] = [];
        }
        // lägger till element i array
        array_push($data["country"], $newCountry);
        // Save our changes to the DB
        update_option("world-plugin-data", $data);

    //Response with some success message
    echo json_encode(["message" => "Successfully added $newCountry!"]);
    exit();
    }
}

// "wp_ajax_{YOUR CUSTOM EVENT NAME}", "handler"
add_action("wp_ajax_world_plugin_ajax", "world_plugin_ajax");
// 'nopriv' is needed for not-logged-in requests
add_action("wp_ajax_nopriv_world_plugin_ajax", "world_plugin_ajax");

