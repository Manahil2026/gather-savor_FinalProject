<?php 

require_once __DIR__ . "/../db.php"; 
require_once __DIR__ . '/../messages.php'; //error and success message for client


try{
    //need the recipe id, the user id, and the ingredient name
    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if(!isset($data['recipe_id']) || !isset($data['ingredient_name'])){
        error_message("Missing parameters");
        exit;
    }

    $user_id = $_SESSION['user_id']; 
    $recipe_id = $data['recipe_id']; 
    $ingredient_name = $data['ingredient_name'];


    // Check if it is already there
    $stmt = $conn->prepare("SELECT * FROM ingredients WHERE user_id = ? AND recipe_id = ? AND ingredient = ?");
    $stmt->execute([$user_id, $recipe_id, $ingredient_name]);
    if ($stmt->fetch()){ //If a record is found
        //Delete it
        $stmt = $conn->prepare("delete from ingredients where user_id = ? and recipe_id = ? and ingredient = ?");
        $stmt->execute([$user_id, $recipe_id, $ingredient_name]);
        
        success_message(["added" => false]);
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO  ingredients (user_id, recipe_id, ingredient) VALUES (?,?,?)");
    $stmt->execute([$user_id, $recipe_id, $ingredient_name]);

    success_message(["added" => true]);
}
catch(PDOException $e){
    error_message($e);
}


exit;
?>