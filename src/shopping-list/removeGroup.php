<?php 

//remove every ingredient identified by recipe_id;
require_once __DIR__ . "/../db.php";

try{
    if(!isset($_POST['recipe_id'])){
        error_message("Missing Recipe id");
        exit;
    }


    $user_id = $_SESSION['user_id'];
    $recipe_id = $_POST['recipe_id'];

    $stmt = $conn->prepare("DELETE FROM shopping_lists WHERE user_id = ? AND recipe_id = ?");
    $stmt->execute($user_id,$recipe_id);

    success_message("Successfully removed");


}
catch(PDOException $e){
    error_message($e);
}
exit;
?>