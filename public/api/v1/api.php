<?php


//The purpose of this file is to act as an intermediary between the back and front ends
//It's a routing mechanism, allowing client side js to interact with everything in src
//backend jsonified by ant
//made by ant


$srcPath = '/../../../src';
require_once __DIR__ . $srcPath . '/messages.php'; //json messages


if($_SERVER["REQUEST_METHOD"] === "GET"){
    error_message("GET is unsupported");
}

    if($_SERVER["REQUEST_METHOD"] === "POST"){

    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);
    
    if(!isset($data['action'])){
        error_message("action not set");
    exit;
    }

    $action = $data['action'];
    switch($action){

    //Login
    case "login":
        require_once __DIR__ . $srcPath . '/auth/handleLogin.php';
        break;

    case 'register':
        require_once __DIR__ . $srcPath . '/auth/handleRegister.php';
        break;

    //Favorites
    case "load-favorites":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . '/recipes/loadFavorites.php'; //Load favorite recipes
        break;

    case "delete-favorite": 
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . '/recipes/removeFavorite.php';
        break;

    case "toggle-favorite":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . "/recipes/toggleFavorite.php";
        break;

    case "checkfavorite":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . "/recipes/checkfavorite.php";
        break;

    //Meal plan
    case "get-mealplan":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . "/recipes/loadMealPlan.php";
        break;

    case "delete-recipe":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . "/recipes/removeMealPlan.php";
        break;

    case "add-mealPlan":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . "/recipes/addToMealPlan.php";
        break;

    //Shopping List
    case "toggle-shoppingList":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . "/shopping-list/toggleShoppingList.php";
        break;

    case "check-shoppingList":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . "/shopping-list/checkShoppingList.php";
        break;

    case "get-shoppingList":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . '/shopping-list/getShoppingList.php';
        break;

    case "get-shoppingIngredients":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . '/shopping-list/getIngredientsList.php';
        break;

    case "toggle-ingredient":
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . '/shopping-list/toggleIngredient.php';
        break;

    //In the future, I don't want a whole separate request to handle whether or not a strikethrough or a star should be lit up
    case "checkIngredient.php": 
        require_once __DIR__ . $srcPath . '/auth/checkSession.php'; //Protected
        require_once __DIR__ . $srcPath . '/shopping-list/checkIngredient.php';
        break;

    default:
        error_message("Action is not valid");
        break;
    }


  exit;
} 
?>