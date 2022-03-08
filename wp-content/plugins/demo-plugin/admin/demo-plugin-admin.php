<?php
// Admin stuff

function demo_plugin_admin_init() {
    // https://developer.wordpress.org/reference/functions/register_setting/
    register_setting(
        "demo-plugin",          // Option group
        "demo-plugin-data"      // Option name
    );

    // https://developer.wordpress.org/reference/functions/add_settings_section/
    add_settings_section(
        "demo-plugin-section-1",            // Id
        "Section 1",                        // Title
        "demo_plugin_render_section",       // Callback
        "demo-plugin-settings"              // Page (slug)
    );

    // https://developer.wordpress.org/reference/functions/add_settings_field/
    add_settings_field(
        "demo-plugin-field-1",              // Id
        "Name",                             // Title
        "demo_plugin_render_name_field",    // Callback
        "demo-plugin-settings",             // Page (slug)
        "demo-plugin-section-1",            // Section Id
        ["label_for" => "demo-plugin-name"] // <label for="">
    );

    add_settings_field(
        "demo-plugin-field-2",              
        "Email",                            
        "demo_plugin_render_email_field",   
        "demo-plugin-settings",             
        "demo-plugin-section-1",            
        ["label_for" => "demo-plugin-email"]
    );

    add_settings_field(
        "demo-plugin-field-3",              
        "Comment",                          
        "demo_plugin_render_comment_field", 
        "demo-plugin-settings",             
        "demo-plugin-section-1",            
        ["label_for" => "demo-plugin-comment"]
    );
}

// The 'instruction' text below the section header
function demo_plugin_render_section() {
    echo "
    <p>This is the section</p>
    ";
}

function demo_plugin_render_name_field() {
    // https://developer.wordpress.org/reference/functions/get_option/
    $data = get_option("demo-plugin-data");
    // https://developer.wordpress.org/reference/functions/esc_attr/
    $name = esc_attr($data["name"]);
    // NOTE: notice the 'name' syntax for storing stuff inside an array
    //       See: https://stackoverflow.com/a/7946494
    echo "
    <input type='text' name='demo-plugin-data[name]' id='demo-plugin-name' value='$name'>
    <p class='description'>This will describe the name field</p>
    ";
}

function demo_plugin_render_email_field() {
    $data = get_option("demo-plugin-data");
    // NOTE: we need to 'escape' the stored data, incase it contains HTML,
    //       otherwise people could store dangerous <script> tags etc.
    $email = esc_attr($data["email"]);

    // The class 'regular-text' and 'description' comes from inspecting WordPress
    // own CSS-classes, just so we write less CSS and try to adhere to their styling
    echo "
    <input class='regular-text' type='text' name='demo-plugin-data[email]' id='demo-plugin-email' value='$email'>
    <p class='description'>This will describe the mail field</p>
    ";
}

function demo_plugin_render_comment_field() {
    $data = get_option("demo-plugin-data");
    // https://developer.wordpress.org/reference/functions/esc_textarea/
    $comment = esc_textarea($data["comment"]);

    echo "
    <textarea name='demo-plugin-data[comment]' id='demo-plugin-comment'>$comment</textarea>
    ";
}

function demo_plugin_admin_view() {
    // https://developer.wordpress.org/reference/functions/wp_enqueue_style/
    wp_enqueue_style(
        "demo-plugin-admin-style",
        // https://developer.wordpress.org/reference/functions/plugin_dir_url/
        plugin_dir_url(__FILE__) . "css/demo-plugin-admin.css"
    );

    // https://developer.wordpress.org/reference/functions/wp_enqueue_script/
    wp_enqueue_script(
        "demo-plugin-admin-script",
        plugin_dir_url(__FILE__) . "js/demo-plugin-admin.js"
    );

    // Include our <form> (rather then echo'ing it here)
    require_once __DIR__ . "/../includes/admin-view.php";

    // echo "
    //     <h1>Demo plugin</h1>
    //     <p class='my-paragraph'>Hello!</p>
    // ";
}

function demo_plugin_setup_admin_menu() {
    // https://developer.wordpress.org/reference/functions/add_menu_page/
    add_menu_page(
        "Demo Plugin Settings",     // Page title
        "Demo Plugin",              // Menu title
        "manage_options",           // User permissions
        "demo-plugin-settings",     // Slug (Page)
        "demo_plugin_admin_view",   // View function
        "dashicons-album",          // Menu icon
        100                         // Menu order (last)
    );
}

// https://developer.wordpress.org/reference/functions/add_action/
add_action("admin_menu", "demo_plugin_setup_admin_menu");
add_action("admin_init", "demo_plugin_admin_init");