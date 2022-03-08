<?php

/**
 * Plugin Name: Demo Plugin
 * Description: My first plugin
 * Version: 0.1.0
 * Author: Sebbe
 */

 // Include admin stuff (menu item, settings page)
 require_once __DIR__ . "/admin/demo-plugin-admin.php";
 // Include public stuff (shortcode)
 require_once __DIR__ . "/public/demo-plugin-public.php";