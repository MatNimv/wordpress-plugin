<?php

/**
 * Plugin Name: World Plugin
 * Description: My first plugin
 * Version: 0.1.4
 * Author: Matnimv
 */

 // Include admin stuff (menu item, settings page)
 require_once __DIR__ . "/admin/world-plugin-admin.php";
 // Include public stuff (shortcode)
 require_once __DIR__ . "/public/world-plugin-public.php";