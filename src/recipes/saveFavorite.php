<?php 
//This page handles adding recipes from favorites table for a specific user
//session and the check auth is already done in the recipe-details page

function addFavorite(){
    require_once __DIR__ . '/../db.php'; // Include db connection file
    require_once __DIR__ . '/../auth/checkSession.php'; // Ensure user is logged in

    $user_id = $_SESSION['user_id']; // Get user id from session

    $recipe_id = $_POST['recipe_id'] ?? '';
    $title = $_POST['recipe_title'] ?? '';
    $image = $_POST['recipe_image'] ?? '';
    
    // First lets check for duplicates
    $stmt = $conn->prepare("SELECT id FROM favorites WHERE user_id = :user AND recipe_id = :rid LIMIT 1");
    $stmt->execute(['user' => $user_id, 'rid' => $recipe_id]);

    if ($stmt->fetch()){ //If a record is found
        header('Location: ../../favorites.php?msg=Recipe already in favorites'); // Redirect to favorites wth msg
        exit;
    }

    //Otherwise insert the recipe in favorites table
    $stmt = $conn->prepare("INSERT INTO favorites (user_id, recipe_id, recipe_title, recipe_image) VALUES (:user, :rid, :title, :img");
    $stmt->execute([':user' => $user_id, ':rid' => $recipe_id, ':title' => $title, ':img' => $image]);
    header('Location: ../../favorites.php?msg=Recipe added to favorites'); // Redirect to favorites with msg
    exit;


}

addFavorite();
exit;

?>