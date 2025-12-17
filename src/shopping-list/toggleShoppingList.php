<?php 

require_once __DIR__ . "/../db.php"; 
require_once __DIR__ . '/../messages.php'; //error and success message for client


try{

    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);
    
    if(!isset($data['recipe_id'])){ //If either recipe id or ingredient is not set then terminate and give msg
        error_message("Missing recipe id");
        exit;
    }

    $user_id = $_SESSION['user_id']; 
    $recipe_id = trim($data['recipe_id']); 

    // Check if it is already there
    $stmt = $conn->prepare("SELECT id FROM shopping_lists WHERE user_id = :user_id AND recipe_id = :recipe_id LIMIT 1");
    $stmt->execute(['user_id' => $user_id, 'recipe_id' => $recipe_id]);
    if ($stmt->fetch()){ //If a record is found
        //Delete it
        $stmt = $conn->prepare("delete from shopping_lists where user_id = :user_id and recipe_id = :recipe_id");
        $stmt->execute([
            'user_id' => $user_id,
            'recipe_id' => $recipe_id
        ]);
        
        success_message("Removed from Shopping List");
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO  shopping_lists (user_id, recipe_id) VALUES (?,?)");
    $stmt->execute([$user_id,$recipe_id]);

    success_message("Added to Shopping List");
}
catch(PDOException $e){
    error_message($e);
}

exit;
?>