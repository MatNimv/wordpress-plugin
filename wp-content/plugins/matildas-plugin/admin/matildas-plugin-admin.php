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
        "matilda-plugin-field-1",              // Id
        "Name",                             // Title
        "matildas_plugin_render_name_field",    // Callback
        "matildas-plugin-settings",             // Page (slug)
        "matildas-plugin-continent-section",            // Section Id
        ["label_for" => "matildas-plugin-name"] // <label for="">
    );

    add_settings_field(
        "matilda-plugin-field-2",              // Id
        "Shit",                             // Title
        "matildas_plugin_render_shit_field",    // Callback
        "matildas-plugin-settings",             // Page (slug)
        "matildas-plugin-continent-section",            // Section Id
        ["label_for" => "matildas-plugin-shit"] // <label for="">
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
    $data = get_option("demo-plugin-data");
    // https://developer.wordpress.org/reference/functions/esc_attr/
    //$availableContinents = $data["continent"];

    // NOTE: notice the 'name' syntax for storing stuff inside an array
    //       See: https://stackoverflow.com/a/7946494

    $continentData = var_dump($data);
    
    echo "<p>These are now your chosen continents: $continentData</p>";
    //var_dump($data);

    $continents = $_POST["continent"];
    echo $continents;

    //foreach ($availableContinents as $continent){
    //    echo "$continent <br>";
    //}

    //echo var_dump($data);

    echo '
    <label>Check the boxes of continents to be shown on your page.</label><br>
    <input type="checkbox" value="Africa" name="matildas-plugin-data["continent"]" id="matildas-plugin-continents">Africa<br>
    <input type="checkbox" value="Americas" name="continent[]" id="matildas-plugin-continents">Americas<br>
    <input type="checkbox" value="Asia" name="continent[]" id="matildas-plugin-continents">Asia<br>
    <input type="checkbox" value="Europe" name="continent[]" id="matildas-plugin-continents">Europe<br>
    <input type="checkbox" value="Oceania" name="continent[]" id="matildas-plugin-continents">Oceania<br>
    ';
}

function matildas_plugin_render_name_field() {

    // https://developer.wordpress.org/reference/functions/get_option/
    $data = get_option("matilda-plugin-data");
    // https://developer.wordpress.org/reference/functions/esc_attr/
    $name = esc_attr($data["name"]);
    echo "<p>$name</p>";
    // NOTE: notice the 'name' syntax for storing stuff inside an array
    //       See: https://stackoverflow.com/a/7946494
    echo "
    <input type='text' name='demo-plugin-data[name]' id='demo-plugin-name' value='$name'>
    <p class='description'>This will describe the name field</p>
    ";
}

function matildas_plugin_render_shit_field() {

    // https://developer.wordpress.org/reference/functions/get_option/
    $data = get_option("matilda-plugin-data");
    var_dump(get_option("matildas-plugin-data"));
    // https://developer.wordpress.org/reference/functions/esc_attr/
    $shit = esc_attr($data["shit"]);
    echo "<p>$shit</p>";
    // NOTE: notice the 'name' syntax for storing stuff inside an array
    //       See: https://stackoverflow.com/a/7946494
    echo "
    <input type='text' name='demo-plugin-data[shit]' id='demo-plugin-shit' value='$shit'>
    <p class='description'>This will describe the shit field</p>
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
        "dashicons-category",          // Menu icon
        100                         // Menu order (last)
    );
}

// https://developer.wordpress.org/reference/functions/add_action/
add_action("admin_menu", "matildas_plugin_setup_admin_menu");
add_action("admin_init", "matildas_plugin_admin_init");