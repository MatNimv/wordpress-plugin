<?php
// Admin stuff

function test_plugin_admin_init() {
    // https://developer.wordpress.org/reference/functions/register_setting/
    register_setting(
        "test-plugin",          // Option group
        "test-plugin-data"      // Option name
    );

    // https://developer.wordpress.org/reference/functions/add_settings_section/
    add_settings_section(
        "test-plugin-section-1",            // Id
        "Section 1",                        // Title
        "test_plugin_render_section",       // Callback
        "test-plugin-settings"              // Page (slug)
    );

    // https://developer.wordpress.org/reference/functions/add_settings_field/
    add_settings_field(
        "test-plugin-field-1",              // Id
        "Name",                             // Title
        "test_plugin_render_name_field",    // Callback
        "test-plugin-settings",             // Page (slug)
        "test-plugin-section-1",            // Section Id
        ["label_for" => "test-plugin-name"] // <label for="">
    );

    add_settings_field(
        "test-plugin-field-2",              
        "Email",                            
        "test_plugin_render_email_field",   
        "test-plugin-settings",             
        "test-plugin-section-1",            
        ["label_for" => "test-plugin-email"]
    );

    add_settings_field(
        "test-plugin-field-3",              
        "Comment",                          
        "test_plugin_render_shit_field", 
        "test-plugin-settings",             
        "test-plugin-section-1",            
        ["label_for" => "test-plugin-shit"]
    );
}

// The 'instruction' text below the section header
function test_plugin_render_section() {
    echo "
    <p>This is the section</p>
    ";
}

function test_plugin_render_name_field() {
    // https://developer.wordpress.org/reference/functions/get_option/
    $data = get_option("test-plugin-data");
    // https://developer.wordpress.org/reference/functions/esc_attr/
    $name = esc_attr($data["name"]);
    // NOTE: notice the 'name' syntax for storing stuff inside an array
    //       See: https://stackoverflow.com/a/7946494
    echo "
    <input type='text' name='test-plugin-data[name]' id='test-plugin-name' value='$name'>
    <p class='description'>This will describe the name field</p>
    ";
}

function test_plugin_render_email_field() {
    $data = get_option("test-plugin-data");
    // NOTE: we need to 'escape' the stored data, incase it contains HTML,
    //       otherwise people could store dangerous <script> tags etc.
    $email = esc_attr($data["email"]);

    // The class 'regular-text' and 'description' comes from inspecting WordPress
    // own CSS-classes, just so we write less CSS and try to adhere to their styling
    echo "
    <input class='regular-text' type='text' name='test-plugin-data[email]' id='test-plugin-email' value='$email'>
    <p class='description'>This will describe the mail field</p>
    ";
}

function test_plugin_render_shit_field() {
    $data = get_option("test-plugin-data");
    // https://developer.wordpress.org/reference/functions/esc_textarea/
    $shit = esc_textarea($data["shit"]);

    echo "
    <textarea name='test-plugin-data[shit]' id='test-plugin-shit'>$shit</textarea>
    ";
}

function test_plugin_admin_view() {
    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
    wp_enqueue_style(
        "test-plugin-admin-style",
        // https://developer.wordpress.org/reference/functions/plugin_dir_url/
        plugin_dir_url(__FILE__) . "css/test-plugin-admin.css"
    );

    // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    wp_enqueue_script(
        "test-plugin-admin-script",
        plugin_dir_url(__FILE__) . "js/test-plugin-admin.js"
    );

    // Include our <form> (rather then echo'ing it here)
    require_once __DIR__ . "/../includes/admin-view.php";

    // echo "
    //     <h1>test plugin</h1>
    //     <p class='my-paragraph'>Hello!</p>
    // ";
}

function test_plugin_setup_admin_menu() {
    // https://developer.wordpress.org/reference/functions/add_menu_page/
    add_menu_page(
        "test Plugin Settings",     // Page title
        "test Plugin",              // Menu title
        "manage_options",           // User permissions
        "test-plugin-settings",     // Slug (Page)
        "test_plugin_admin_view",   // View function
        "dashicons-album",          // Menu icon
        100                         // Menu order (last)
    );
}

// https://developer.wordpress.org/reference/functions/add_action/
add_action("admin_menu", "test_plugin_setup_admin_menu");
add_action("admin_init", "test_plugin_admin_init");