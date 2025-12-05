<?php 

// This file returns an array of meal plan values for logged in user for meal-planner.php page

//authentication is checked on the api
require_once __DIR__ . '/../db.php'; // Include db connection file

$user_id = $_SESSION['user_id']; //Get user id from session

// Load recipe ids for each day
$stmt = $conn->prepare("SELECT day, link FROM meal_plans WHERE user_id = :user "); // Select all days of the week to display meal plan for the user
$stmt->execute([':user' => $user_id]);

$meal_plan = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch meal plan as an associative array

echo [
        "state" => "success",
        "message" => $meal_plan    
    ];

?>