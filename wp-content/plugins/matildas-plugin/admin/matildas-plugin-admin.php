<?php

// Admin stuff

function matildas_plugin_admin_init() {
    // https://developer.wordpress.org/reference/functions/register_setting/
    register_setting(
        "matildas-plugin",          // Option group
        "matildas-plugin-data"      // Option name
    );

    // https://developer.wordpress.org/reference/functions/add_settings_section/
    add_settings_section(
        "matildas-plugin-continent-section",                // Id
        "Choose what will show on your page",              // Title
        "matildas_plugin_render_continent_section",       // Callback
        "matildas-plugin-settings"                       // Page (slug)
    );

    // https://developer.wordpress.org/reference/functions/add_settings_field/
    add_settings_field(
        "matildas-plugin-continent-checkboxes",                 // Id
        "Continents",                                         // Title
        "matildas_plugin_render_continent_checkboxes",      // Callback
        "matildas-plugin-settings",                       // Page (slug)
        "matildas-plugin-continent-section",            // Section Id
        ["label_for" => "matildas-plugin-continents"] // <label for="">
    );

    add_settings_field(
        "matildas-plugin-field-1",              // Id
        "Name",                             // Title
        "matildas_plugin_render_name_field",    // Callback
        "matildas-plugin-settings",             // Page (slug)
        "matildas-plugin-continent-section",            // Section Id
        ["label_for" => "matildas-plugin-name"] // <label for="">
    );

}

 // The 'instruction' text below the section header
function matildas_plugin_render_continent_section() {
    echo "
    <p>Down here you can choose which continents will be available to the user.</p>
    ";
}

function matildas_plugin_render_continent_checkboxes() {
     // https://developer.wordpress.org/reference/functions/get_option/
     $data = get_option("matildas-plugin-data");
     // https://developer.wordpress.org/reference/functions/esc_attr/

     // NOTE: notice the 'name' syntax for storing stuff inside an array
     //       See: https://stackoverflow.com/a/7946494

     $continentData = var_dump($data);
   
     echo "<p>These are now your chosen continents: $continentData</p>";

     //$continents = $_POST["continent"];
     //echo $continents;
     echo $data;


    echo '
    <span>Check the boxes of continents to be shown on your page.</span><br>
    <input type="checkbox" value="Africa" name="matildas-plugin-data["continent"]" id="matildas-plugin-continents">Africa<br>
    <input type="checkbox" value="Americas" name="matildas-plugin-data["continent"]" id="matildas-plugin-continents">Americas<br>
    <input type="checkbox" value="Asia" name="matildas-plugin-data["continent"]" id="matildas-plugin-continents">Asia<br>
    <input type="checkbox" value="Europe" name="matildas-plugin-data["continent"]" id="matildas-plugin-continents">Europe<br>
    <input type="checkbox" value="Oceania" name="matildas-plugin-data["continent"]" id="matildas-plugin-continents">Oceania<br>
    ';
 }

function matildas_plugin_render_section() {
    echo "
    <p>This is the section</p>
    ";
}

function matildas_plugin_render_name_field() {
    // https://developer.wordpress.org/reference/functions/get_option/
    $data = get_option("matildas-plugin-data");
    // https://developer.wordpress.org/reference/functions/esc_attr/
    $name = esc_attr($data["name"]);
    // NOTE: notice the 'name' syntax for storing stuff inside an array
    //       See: https://stackoverflow.com/a/7946494
    echo "
    <input type='text' name='matildas-plugin-data[name]' id='matildas-plugin-name' value='$name'>
    <p class='description'>This will describe the name field</p>
    ";
}

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

    // Include our <form> (rather then echo'ing it here)
    require_once __DIR__ . "/../includes/admin-view.php";

    // echo "
    //     <h1>matildas plugin</h1>
    //     <p class='my-paragraph'>Hello!</p>
    // ";
}

function matildas_plugin_setup_admin_menu() {
    // https://developer.wordpress.org/reference/functions/add_menu_page/
    add_menu_page(
        "matildas Plugin Settings",     // Page title
        "matildas Plugin",              // Menu title
        "manage_options",           // User permissions
        "matildas-plugin-settings",     // Slug (Page)
        "matildas_plugin_admin_view",   // View function
        "dashicons-album",          // Menu icon
        100                         // Menu order (last)
    );
}

// https://developer.wordpress.org/reference/functions/add_action/
add_action("admin_menu", "matildas_plugin_setup_admin_menu");
add_action("admin_init", "matildas_plugin_admin_init");