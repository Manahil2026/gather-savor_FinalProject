<?php
require_once __DIR__ . '/../db.php'; //Include db connection file
require_once __DIR__ . '/../messages.php'; 


try{
    $user_id = $_SESSION['user_id']; //Get user id from session

    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if(!isset($data['recipe_id'])){
        error_message("No Recipe ID"); 
        die;
    }

    $recipe_id = $data['recipe_id'];

    $stmt = $conn->prepare("SELECT * FROM favorites WHERE user_id = :user and recipe_id = :rid"); //Select favorite recipes for the user and order by creation date descending which means most recent first
    $stmt->execute([':user' => $user_id, ":rid" => $recipe_id]);

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