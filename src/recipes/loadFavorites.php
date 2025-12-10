<?php 

// This file loads the favorite recipes for specific user for favorites.php page
require_once __DIR__ . '/../db.php'; //Include db connection file
require_once __DIR__ . '/../messages.php'; 


try{
    $user_id = $_SESSION['user_id']; //Get user id from session

    $stmt = $conn->prepare("SELECT * FROM favorites WHERE user_id = :user ORDER BY created_at DESC"); //Select favorite recipes for the user and order by creation date descending which means most recent first
    $stmt->execute([':user' => $user_id]);

    $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC); //Fetch all favorite recipes as an associative array
    success_message($favorites);

}

catch(PDOException $e){
    error_message($e);
}
exit;
?>