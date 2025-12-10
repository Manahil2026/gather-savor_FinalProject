<?php 

require_once __DIR__ . "/../db.php";
require_once __DIR__ . '/../messages.php'; //error and success message for client


try{
    $user_id = $_SESSION['user_id']; //Get user id from session

    if(!isset($_POST['ingredient'])){
        error_message("Missing ingredient");
        exit;
    }

    $ingredient = $_POST['ingredient'];
    $stmt = $conn->prepare("DELETE FROM shopping_lists WHERE id = ? and user_id = ?");
    $stmt->execute([$user_id,$ingredient]);
    success_mesage("successfully removed ingredient");
}
catch(PDOException $e){
    error_message($e);
}


exit;
?>