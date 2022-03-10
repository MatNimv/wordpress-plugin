<?php

/**
 * Plugin Name: Test Plugin
 * Description: My first plugin
 * Version: 0.1.0
 * Author: Matnimv
 */

 // Include admin stuff (menu item, settings page)
 require_once __DIR__ . "/admin/test-plugin-admin.php";
 // Include public stuff (shortcode)
 require_once __DIR__ . "/public/test-plugin-public.php";