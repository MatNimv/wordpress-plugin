<?php
// Abort if called directly (ie. not from WordPress)
if (!defined("WP_UNINSTALL_PLUGIN")) {
    exit();
}

// https://developer.wordpress.org/reference/functions/delete_option/
delete_option("demo-plugin-data");