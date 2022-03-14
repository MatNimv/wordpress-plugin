<?php 
function deleteCountry($countryID){
    $data = get_option("world-plugin-data");

    $allCountries = $data["country"];
    $index = null;

    $found = false;
    foreach($allCountries as $key => $country){
        if ($countryID == $key){
            $found = true;
            $index = $key;
            break;
        }
    }
    if ($found){
        //om if-satsen hittade en key som var i GET.
        //tar bort hela objektet
        unset($data["country"][$index]);
        update_option("world-plugin-data", $data);

        echo json_encode(["message" => "Success!"]);
        exit();
    }

    //och byter tillbaka till profile.php
    header("Location: /wp-admin/admin.php?page=world-plugin-settings");
    exit();
}

?>