<?php
require_once __DIR__ . '/../db.php'; //Include db connection file
require_once __DIR__ . '/../messages.php'; 

//The point of this file is to tell the client if the specified recipe is already in the shopping list

try{
    $user_id = $_SESSION['user_id']; //Get user id from session

    $recipe_id = $_POST['recipe_id'];

    $stmt = $conn->prepare("SELECT * FROM shopping_lists WHERE user_id = :user and recipe_id = :rid"); //Select shopping lists for the user and order by creation date descending which means most recent first
    $stmt->execute([':user' => $user_id, ":rid" => $recipe_id]);

    $result = $stmt->fetchColumn(); //Fetch all shopping lists as an associative array
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