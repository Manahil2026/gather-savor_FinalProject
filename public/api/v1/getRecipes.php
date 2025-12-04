<?php

    //Protected, allow authenticated users only
    session_start(); // Start anew session or resume existing one

    // If session does not have user id reject
    if(!isset($_SESSION['user_id'])){
        echo json_encode([
            "status" => "error",
            "message" => "unauthenticated",
            ]);
        exit;
    }


    //Yes it's not really my api endpoint, this is acting as a "man in the middle" for the real spoonacular api
    //For this project I am leaving the keys out in the open because it's not a real production server, but obviously you would use .env
    $url = "https://api.spoonacular.com/recipes/complexSearch?apiKey=79f089b8a521468eadcd3dcad358548a&number=20"; 
    $crl = curl_init($url);
    curl_setopt($crl, CURL_RETURNTRANSFER, true);

    $res = curl_exec($crl);
    //Check for errors
    if(curl_errno($crl)){
        echo json_encode([
            "status" => "error",
            "message" => $curl_error($crl)
        ]);
    }

    curl_close($crl);
    echo $res;
?>