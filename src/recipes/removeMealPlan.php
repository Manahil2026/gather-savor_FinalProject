<?php 

//session and the check auth is already done in the recipe-details page
require_once __DIR__ . '/../db.php'; //Include db connection file
require_once __DIR__ . '/../messages.php'; //error and success message for client

$user_id = $_SESSION['user_id']; //Get user id from session
$recipe_id = $_POST['recipe_id']; // Get recipe id from the post request
$day = $_POST['day']; // Get day from the post 


try {
    //Update the selected day with recipe_id
    $stmt = $conn->prepare("delete from meal_plans where user_id = ? and recipe_id = ? and day = ?");
    $stmt->execute([
        $user_id, $recipe_id, $day
    ]);
    success_message("Successfully deleted from meal plan");
 

}catch(PDOException $e){
        error_message($e);
};

exit;
?>