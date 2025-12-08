<?php 

require_once __DIR__ . "/../db.php"; 
require_once __DIR__ . '/../messages.php'; //error and success message for client


try{

    if(!isset($_POST['ingredient'])){ //If either recipe id or ingredient is not set then terminate and give msg
        error_message("ingredient missing");
        exit;
    }
    $user_id = $_SESSION['user_id']; //Get user id from session
    $ingredient = trim($_POST['ingredient']); //get and trim ingredient from post request
    $stmt = $conn->prepare("INSERT INTO shopping_lists (user_id, ingredient) VALUES (?,?)");
    $stmt->execute([$user_id,$ingredient]);
    success_message("Successfully added the ingredient");


}
catch(PDOException $e){
    error_message($e);
}


exit;
?>
