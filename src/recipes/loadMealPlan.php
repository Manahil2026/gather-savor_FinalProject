<?php 

// This file returns an array of meal plan values for logged in user for meal-planner.php page
require_once __DIR__ . '/../db.php'; // Include db connection file
require_once __DIR__ . '/../messages.php';


try{
    $user_id = $_SESSION['user_id']; //Get user id from session

    // Load recipe ids for each day
    $stmt = $conn->prepare("SELECT recipe_id,recipe_title,day FROM meal_plans WHERE user_id = :user "); // Select all days of the week to display meal plan for the user
    $stmt->execute([':user' => $user_id]);

    $meal_plan = $stmt->fetchAll(PDO::FETCH_ASSOC); //Fetch meal plan as an associative array

    //This requires a more dynamic page with javascript so sending back as json
    success_message($meal_plan);
}
catch(PDOException $e){
    error_message($e);
}

exit;
?>