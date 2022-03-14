<?php

/**
 * Plugin Name: World Plugin
 * Description: This plugin allows the user to submit a name of a country in relation to the chosen region.
 * Version: 1.4.2
 * Author: Matnimv
 */

 // Include admin stuff (menu item, settings page)
 require_once __DIR__ . "/admin/world-plugin-admin.php";
 // Include public stuff (shortcode)
 require_once __DIR__ . "/public/world-plugin-public.php";