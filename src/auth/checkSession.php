<?php 

//This page confirms that the user is logged in
// Protects these pages:
    // Home.php
    // favorites.php
    // meal-planner.php
    // recipe-details.php
    // Recipes.php
    // Shopping-list.php
// If user is not logged in they are redirected to Login page

session_start(); // Start anew session or resume existing one

// If session does not have user id redirect to login page
if(!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

?>