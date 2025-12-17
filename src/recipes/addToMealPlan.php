<?php 

//session and the check auth is already done in the recipe-details page
require_once __DIR__ . '/../db.php'; //Include db connection file
require_once __DIR__ . '/../messages.php'; //error and success message for client

$user_id = $_SESSION['user_id']; //Get user id from session

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

$recipe_id = $data['recipe_id']; // Get recipe id from the post request
$day = $data['day']; // Get day from the post 
$recipe_title = $data['recipe_title'];

// Make sure that the day sent in the post request is valid
$validDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
if (!in_array($day, $validDays)){
    //return back with errors
    error_message("Invalid day");
}

try {
    //Update the selected day with recipe_id
    $stmt = $conn->prepare("insert into meal_plans (user_id,recipe_id, day, recipe_title) values (?,?,?,?)");
    $stmt->execute([$user_id,$recipe_id,$day,$recipe_title]);
    success_message("Successfully added to meal plan");
 

}catch(PDOException $e){
        error_message($e);
};

exit;
?>