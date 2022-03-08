<?php
//Admin stuff
//ska tillåta admin att bocka i vilka kontinenter man kan välja emellan.
//visar listan av länder användare har skrivit in. 
//också eventuellt antalet av det landet.


//registrerar min "setting" och min data
//function matildas_plugin_admin_init(){
//    register_setting(
//        "matildas-plugin",
//        "matildas-plugin-data" //namn för var jag hämtar data från
//    );
//
//    //lägger till en settings sektion, för kontinenter
//    add_settings_section(
//        "matildas-plugin-continent-section",
//        "Continents",
//        "matildas_plugin_render_continent_section",
//        "matildas-plugin-settings"
//    );
//
//    add_settings_field(
//        "matildas-plugin-choose-continents",          // Id
//        "Choose continents",                           // Title
//        "matildas_plugin_render_continent_checkboxes", // Callback
//        "matildas-plugin-settings",                   // Page (slug)
//        "matildas-plugin-continent-section",          // Section Id
//        ["label_for" => "matildas-plugin-continents"] // <label for="">
//    );
//}


//CONTINENT SECTION
//function matildas_plugin_render_continent_section(){
//    echo "<p>Choose which continents to be available to the users:</p>";
//};

//function matildas_plugin_render_continent_checkboxes() {
//    $data = get_option("matildas-plugin-data");
//    // NOTE: we need to 'escape' the stored data, incase it contains HTML,
//    //       otherwise people could store dangerous <script> tags etc.
//    $email = esc_attr($data["email"]);
//
//    // The class 'regular-text' and 'description' comes from inspecting WordPress
//    // own CSS-classes, just so we write less CSS and try to adhere to their styling
//    echo "
//    <input class='regular-text' type='text' name='matildas-plugin-data[email]' id='matildas-plugin-email' value='$email'>
//    <p class='description'>This will describe the mail field</p>
//    ";
//}

//CONTINENT -> CONTINENT CECKBOXES
//function matildas_plugin_render_continent_checkboxes() {
//    // https://developer.wordpress.org/reference/functions/get_option/
//    $data = get_option("matildas-plugin-data");
//    // https://developer.wordpress.org/reference/functions/esc_attr/
//    $availableContinents = $data["continent"];
//    // NOTE: notice the 'name' syntax for storing stuff inside an array
//    //       See: https://stackoverflow.com/a/7946494
//    echo '<p>These are now your chosen continents:</p>';
//    foreach ($availableContinents as $continent){
//        echo "$continent <br>";
//    }
//    echo '
//    <label>What continents are you enquiring about?</label>
//    <input type="checkbox" value="Africa" name="continent">Africa<br>
//    <input type="checkbox" value="Americas" name="continent">Americas<br>
//    <input type="checkbox" value="Asia" name="continent">Asia<br>
//    <input type="checkbox" value="Europe" name="continent">Europe<br>
//    <input type="checkbox" value="Oceania" name="continent">Oceania<br>
//    ';
//}



//får in JS och CSS
//function matildas_plugin_admin_view() {
//    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
//    wp_enqueue_style(
//        "matildas-plugin-admin-style",
//        // https://developer.wordpress.org/reference/functions/plugin_dir_url/
//        plugin_dir_url(__FILE__) . "css/matildas-plugin-admin.css"
//    );
//
//    // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
//    wp_enqueue_script(
//        "matildas-plugin-admin-script",
//        plugin_dir_url(__FILE__) . "js/matildas-plugin-admin.js"
//    );
//
//    //får in kod från include-mappen
//    require_once __DIR__ . "/../includes/admin-view.php";
//}
//
//
//function matildas_plugin_setup_admin_menu() {
//    // https://developer.wordpress.org/reference/functions/add_menu_page/
//    add_menu_page(
//        "Matildas Plugin Settings",     // Page title
//        "Matildas Plugin",              // Menu title
//        "manage_options",           // User permissions
//        "matildas-plugin-settings",     // Slug
//        "matildas_plugin_admin_view",   // View function
//        "dashicons-category",          // Menu icon
//        100                         // Menu item position (order)
//    );
//}
//
//// https://developer.wordpress.org/reference/functions/add_action/
////lägger till på sidan
//add_action("admin_menu", "matildas_plugin_setup_admin_menu");
//add_action("admin_init", "matildas_plugin_admin_init");


// Admin stuff

function matildas_plugin_admin_init() {
    // https://developer.wordpress.org/reference/functions/register_setting/
    register_setting(
        "matildas-plugin",          // Option group
        "matildas-plugin-data"      // Option name
    );

    // https://developer.wordpress.org/reference/functions/add_settings_section/
    add_settings_section(
        "matildas-plugin-continent-section",            // Id
        "Continents",                        // Title
        "matildas_plugin_render_continent_section",       // Callback
        "matildas-plugin-settings"              // Page (slug)
    );

    // https://developer.wordpress.org/reference/functions/add_settings_field/
    add_settings_field(
        "matildas-plugin-continent-checkboxes",              // Id
        "Name",                                             // Title
        "matildas_plugin_render_continent_checkboxes",      // Callback
        "matildas-plugin-settings",                         // Page (slug)
        "matildas-plugin-continent-section",            // Section Id
        ["label_for" => "matildas-plugin-continents"]       // <label for="">
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
    $availableContinents = $data["continent"];
    // NOTE: notice the 'name' syntax for storing stuff inside an array
    //       See: https://stackoverflow.com/a/7946494
    echo '<p>These are now your chosen continents:</p>';
    foreach ($availableContinents as $continent){
        echo "$continent <br>";
    }

    echo '
    <label>What continents are you enquiring about?</label><br>
    <input type="checkbox" value="Africa" name="continent">Africa<br>
    <input type="checkbox" value="Americas" name="continent">Americas<br>
    <input type="checkbox" value="Asia" name="continent">Asia<br>
    <input type="checkbox" value="Europe" name="continent">Europe<br>
    <input type="checkbox" value="Oceania" name="continent">Oceania<br>
    ';
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

    //tar med <form></form> från include-filen
    require_once __DIR__ . "/../includes/admin-view.php";
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