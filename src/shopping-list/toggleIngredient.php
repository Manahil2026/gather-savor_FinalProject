<?php 

require_once __DIR__ . "/../db.php"; 
require_once __DIR__ . '/../messages.php'; //error and success message for client


try{
    //need the recipe id, the user id, and the ingredient name

    if(!isset($_POST['recipe_id']) || !isset($_POST['ingredient_name'])){
        error_message("Missing parameters");
        exit;
    }

    $user_id = $_SESSION['user_id']; 
    $recipe_id = $_POST['recipe_id']; 
    $ingredient_name = $_POST['ingredient_name'];


    // Check if it is already there
    $stmt = $conn->prepare("SELECT * FROM shopping_list_ingredients WHERE user_id = ? AND recipe_id = ? AND ingredient = ?");
    $stmt->execute([$user_id, $recipe_id, $ingredient_name]);
    if ($stmt->fetch()){ //If a record is found
        //Delete it
        $stmt = $conn->prepare("delete from shopping_list_ingredients where user_id = ? and recipe_id = ? and ingredient = ?");
        $stmt->execute([$user_id, $recipe_id, $ingredient_name]);
        
        success_message("removed");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO  shopping_list_ingredients (user_id, recipe_id, ingredient) VALUES (?,?,?)");
    $stmt->execute([$user_id, $recipe_id, $ingredient_name]);

    success_message("added");
}
catch(PDOException $e){
    error_message($e);
}


exit;
?>