<?php
require_once "../functions.php";
?>
<?php

var_dump($_GET);
//kollar först om $_GET har id.
if (isset($_GET["id"])){
    $dleteID = $_GET["id"];
    echo $_GET["id"];

    deleteCountry($dleteID);
}

header("Location: /wp-admin/admin.php?page=world-plugin-settings");
exit();

?>

