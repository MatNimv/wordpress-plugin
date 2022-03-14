<?php

function getCountryOnContinentInfo($submittedCountry){ 
    $data = get_option("world-plugin-data");
    $continent = $data["continents"];

    $found = false;

    //hämtar dats från det landet 
    //användaren har skrivit.
    $api_url = "https://restcountries.com/v3.1/name/$submittedCountry";

    // Read JSON file
    $json_data = file_get_contents($api_url);

    // Decode JSON data into PHP array
    $response_data = json_decode($json_data, true);

    //OM kontinenten som användaren av pluginet har angett
    //stämmer överens med det submittade landets region.
    if ($continent == $response_data[0]["region"]){
        $found = true;
    } else { //om landet INTE stämmer överens med APIns region.
        $found = false;
    }
    return $found;
}

