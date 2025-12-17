<?php


require_once __DIR__ . '/../db.php'; // Include db connection file
require_once __DIR__ . '/../messages.php';

try{

    $user_id = $_SESSION['user_id']; // Get user id from session

    $raw = file_get_contents("php://input");
    $data = json_decode($raw, true);

    if(!isset($data['recipe_id'])){
        error_message("missing recipe id");
        exit;
    }

    $recipe_id = $data['recipe_id'];
    $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = :user AND recipe_id = :rid LIMIT 1");
    $stmt->execute([':user' => $user_id, ':rid' => $recipe_id]);

    success_message("Successfully removed from favorites");

}
catch(PDOException $e){
    error_message($e);
}

exit;
?>