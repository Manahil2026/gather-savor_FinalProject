<?php
    require_once __DIR__ . "/../../../src/db.php"; 
    
    //Helper
    function error_msg($msg){
        echo [
            "status" => "error",
            "message "=> $msg
        ];
        die();
    }


    //Protect this route
    session_start();
    if(!isset($_SESSION['user_id'])){
      error_msg("unauthenticated");
    }
    

    //When a post request is sent here we get the $action and as per the $action send off to the controllers on the backend
    function processRequest(){

        //This is mainly for these two because it's easier for javascript to parse it thru here. Don't need anything complex.
        //loadFavorites
        //loadMealPlan


        //Excluding these backend features:
        //addToMealPlan <--- users makes post to recipe-details.php
        //removeFavorite <--- users makes post to recipe-details.php
        //saveFavorite <--- users make post to recipe-details.php


        switch($action){
        case "favorites":
            include __DIR__ . "/../../../src/recipes/loadFavorites.php";
            
            break;
        case "meal-plan":
            include __DIR__ . "/../../../src/recipes/loadMealPlan.php";
            
            break;

        case "ingredients":
            include __DIR__ . "/../../../src/shopping-list/getList.php";
            
            break;
        default:
            error_msg("Invalid parameters");
            break;
        }
    }

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        processRequest();
    }else{
        err_msg("Unsupported Method GET");
    }

?>