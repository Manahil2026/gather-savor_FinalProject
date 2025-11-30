<?php 

session_start();
require_once __DIR__ . '/../db.php'; //Include db connection file
require_once __DIR__ . '/../auth/checkSession.php'; // Male sure user is logged in

$user_id = $_SESSION['user_id']; //Get user id from session

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: ../../meal-planner.php');
    exit;
}

?>