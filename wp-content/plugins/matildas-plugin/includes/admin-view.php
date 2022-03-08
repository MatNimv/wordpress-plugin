


<form method="POST" action="options.php">
<h1>Matildas Plugin Settings</h1>

<?php
// https://developer.wordpress.org/reference/functions/settings_fields/
settings_fields("matildas-plugin");                 // Option group
// https://developer.wordpress.org/reference/functions/do_settings_sections/
do_settings_sections("matildas-plugin-settings");   // Page (slug)
// https://developer.wordpress.org/reference/functions/submit_button/
submit_button();
?>

<!--
<?php
// NOTE: Simple way of printing out our stored data to our admin view,
//       you'll have to 'inspect element' to see it.
var_dump(get_option("matildas-plugin-data"));
?>
-->
</form>