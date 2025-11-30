<?php 

session_start();
require_once __DIR__ . '/../db.php'; //Include db connection file
require_once __DIR__ . '/../auth/checkSession.php'; // Male sure user is logged in

$user_id = $_SESSION['user_id']; //Get user id from session
$recipe_id = $_POST['recipe_id']; // Get recipe id from the post request
$day = $POST['day']; // Get day from the post request

// Make sure that the day sent in the post request is valid
$validDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday, saturday, sunday'];
if (!in_array($day, $validDays)){
    die("Invalid day");
}

// Check if user already has a meal plan row

$stmt = $conn->prepare("SELECT id FROM meal_plans WHERE user_id = ?"); // ? is a placeholder
$stmt->execute([$user_id]);

if ($stmt->rowCount() === 0){ // If any row does not exist
    //Create an empty row for the user
    $conn->prepare("INSERT INTO meal_plans (user_id) VALUES (?)")->execute([$user_id]);
}

//Update the selected day with recipe_id
$stmt = $conn->prepare("UPDATE meal_plans SET $day= ? WHERE user_id = ?");
$stmt->execute([$recipe_id, $user_id]);

//Redirect back to meal planner page
header("Location: ../../meal-planner.php");
exit;

?>