<?php
// Admin stuff

function world_plugin_admin_init() {
    // https://developer.wordpress.org/reference/functions/register_setting/
    register_setting(
        "world-plugin",          // Option group
        "world-plugin-data"      // Option name
    );

    // https://developer.wordpress.org/reference/functions/add_settings_section/
    add_settings_section(
        "world-plugin-continent",            // Id
        "Set your worldly preferences",       // Title
        "world_plugin_render_continents_section",       // Callback
        "world-plugin-settings"             // Page (slug)
    );

    add_settings_field(
        "world-plugin-field-1",              
        "Continents",                          
        "world_plugin_render_continents_field", 
        "world-plugin-settings",             
        "world-plugin-continent",            
        ["label_for" => "world-plugin-continents"]
    );

    add_settings_section(
        "world-plugin-countries",              
        "Countries",                          
        "world_plugin_render_countries_section", 
        "world-plugin-settings",              
    );

    add_settings_field(
        "world-plugin-field-2",              
        "Submitted countries",                          
        "world_plugin_render_countries_field", 
        "world-plugin-settings",             
        "world-plugin-countries",            
        ["label_for" => "world-plugin-countries"]
    );
}

// The 'instruction' text below the section header
function world_plugin_render_continents_section() {
    echo "
    <p>Down here you will choose which continent to be available to the users.</p>
    ";
}

function world_plugin_render_countries_section() {
    echo "
    <p>Countries your users have chosen will be displayed here.</p>
    ";
}

function world_plugin_render_continents_field() {
    $data = get_option("world-plugin-data");

    $continents = $data["continents"];

    echo "This is now your chosen continent: <span style='font-weight:bolder;'>$continents </span><br>";

    echo '
    <input type="radio" id="world-plugin-continents" name="world-plugin-data[continents]" value="Africa" />Africa<br />
    <input type="radio" id="world-plugin-continents" name="world-plugin-data[continents]" value="Americas" />Americas<br />
    <input type="radio" id="world-plugin-continents" name="world-plugin-data[continents]" value="Europe" />Europe<br />
    <input type="radio" id="world-plugin-continents" name="world-plugin-data[continents]" value="Oceania" />Oceania<br />
    <input type="radio" id="world-plugin-continents" name="world-plugin-data[continents]" value="Asia" />Asia
    ';
}

function world_plugin_render_countries_field() {
    $data = get_option("world-plugin-data");

    if(!isset($data["country"])){ //om det inte finns någon data i //$data["country"]
        echo '<pre>';
        echo "Nothing submitted yet.";
        echo '</pre>';
    } else {//det finns sparad data i country
        $countries = $data["country"];
        foreach($countries as $key => $country){
            $index = $key + 1;
            echo '<pre>';
            echo "$index. <span>$country</span> <button><a href='delete.php?id={$key}'>Remove country</a></button>";
            echo '</pre>';
        }
    }

}

function world_plugin_admin_view() {
    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
    wp_enqueue_style(
        "world-plugin-admin-style",
        // https://developer.wordpress.org/reference/functions/plugin_dir_url/
        plugin_dir_url(__FILE__) . "css/world-plugin-admin.css"
    );

    // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    wp_enqueue_script(
        "world-plugin-admin-script",
        plugin_dir_url(__FILE__) . "js/world-plugin-admin.js"
    );

    //vår <form></form>
    require_once __DIR__ . "/../includes/admin-view.php";

}

//vad som syns för admin
function world_plugin_setup_admin_menu() {
    add_menu_page(
        "World Plugin Settings",     // Page title
        "World Plugin",              // Menu title
        "manage_options",           // User permissions
        "world-plugin-settings",     // Slug (Page)
        "world_plugin_admin_view",   // View function
        "dashicons-admin-site",          // Menu icon
        100                         // Menu order (last)
    );
}

// https://developer.wordpress.org/reference/functions/add_action/
add_action("admin_menu", "world_plugin_setup_admin_menu");
add_action("admin_init", "world_plugin_admin_init");