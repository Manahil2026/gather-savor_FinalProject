<?php 

//This file is responsible for returning ingredients grouped by recipe id

require_once __DIR__ . '/../db.php'; // include db connection file
require_once __DIR__ . '/../messages.php'; 


try{
    $user_id = $_SESSION['user_id'];
    //Need to give the ids so they're easy to remove/toggle.
    $stmt = $conn->prepare("SELECT * FROM shopping_lists WHERE user_id = ?");
    $stmt->execute([$user_id]);
    $result = $stmt->fetchAll();

    success_message($result);
}
catch(PDOException $e){
    error_message($e);
}

exit;
?>