<?php
require_once __DIR__ . '/../db.php'; //Include db connection file
require_once __DIR__ . '/../messages.php'; 

//The point of this file is to tell a client if a specified recipe_id and ingredient_name is already an ingredient.

try{
    $user_id = $_SESSION['user_id']; //Get user id from session
    if(!isset($_POST['recipe_id']) ||  !(isset($_POST['ingredient_name']))){
        error_message("Invalid parameters"); 
        die;
    }

    $recipe_id = $_POST['recipe_id'];
    $ingredient_name = $_POST['ingredient_name'];

    $stmt = $conn->prepare("SELECT * FROM shopping_list_ingredients WHERE user_id = :user and recipe_id = :rid and ingredient = :ingredient_name"); //Select favorite recipes for the user and order by creation date descending which means most recent first
    $stmt->execute([':user' => $user_id, ":rid" => $recipe_id, ":ingredient_name" => $ingredient_name]);

    $result = $stmt->fetchColumn(); //Fetch all favorite recipes as an associative array
    if($result){
        success_message(true);
    }
    else{
        success_message(false);
    }
}

catch(PDOException $e){
    error_message($e);
}
exit;

?>