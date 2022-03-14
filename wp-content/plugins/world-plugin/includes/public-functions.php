<?php

function getCountryOnContinentInfo($submittedCountry){ 
    $data = get_option("world-plugin-data");
    $continent = $data["continents"];

    $found = false;

    //meddelande till användare
    //$message = "$submittedCountry is not in $continent. Try another country.";

    //hämtar objekt/array från det landet 
    //användaren har skrivit in.
    $api_url = "https://restcountries.com/v3.1/name/$submittedCountry";



    // Read JSON file
    $json_data = file_get_contents($api_url);

    // Decode JSON data into PHP array
    $response_data = json_decode($json_data, true);

    echo $submittedCountry;
    echo $continent;
    var_dump($response_data[0]["region"]) ;
    echo "<script>console.log($continent)</script>";

    //OM kontinenten som användaren av pluginet har angett
    //stämmer överens med det submittade landets region.
    if ($continent == $response_data[0]["region"]){
        //$message = "You have submitted $submittedCountry";
        echo $continent;
        echo $response_data[0]["region"];

        $found = true;
    } else {
        $found = false;
    }
    return $found;
}

