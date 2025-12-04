<?php 

// This file returns an array of meal plan values for logged in user for meal-planner.php page

session_start();
require_once __DIR__ . '/../db.php'; // Include db connection file
require_once __DIR__ . '/../auth/checkSession.php'; //Make sure user is logged in

$user_id = $_SESSION['user_id']; //Get user id from session

// Load recipe ids for each day
$stmt = $conn->prepare("SELECT day, link FROM meal_plans WHERE user_id = :user "); // Select all days of the week to display meal plan for the user
$stmt->execute([':user' => $user_id]);

$meal_plan = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch meal plan as an associative array

return $meal_plan ?: [
        'monday' => '',
        'tuesday' => '',
        'wednesday' => '',
        'thursday' => '',
        'friday' => '',
        'saturday' => '',
        'sunday' => ''
]; 

?>