<?php 
//This page handles adding recipes from favorites table for a specific user
//session and the check auth is already done in the recipe-details page


require_once __DIR__ . '/../db.php'; // Include db connection file
require_once __DIR__ . '/../auth/checkSession.php'; // Ensure user is logged in

$user_id = $_SESSION['user_id']; // Get user id from session
$recipe_id = $_POST['recipe_id'] ?? '';


// Check if it is already a favorite
$stmt = $conn->prepare("SELECT id FROM favorites WHERE user_id = :user_id AND recipe_id = :recipe_id LIMIT 1");
$stmt->execute(['user_id' => $user_id, 'recipe_id' => $recipe_id]);
if ($stmt->fetch()){ //If a record is found
    //Delete it
    $stmt = $conn->prepare("delete from favorites where user_id = :user_id and recipe_id = :recipe_id");
    $stmt->execute([
        'user_id' => $user_id,
        'recipe_id' => $recipe_id
    ]);
    header('Location: recipe-details.php?message=Removed from favorites&recipe_id=' . $recipe_id);
    exit;
}

//Otherwise insert the recipe in favorites 
$stmt = $conn->prepare("INSERT INTO favorites (user_id, recipe_id) VALUES (:user, :rid)");
$stmt->execute([':user' => $user_id, ':rid' => $recipe_id]);
header('Location: recipe-details.php?msg=Added to favorites&recipe_id=' . $recipe_id); // Redirect to favorites with msg
exit;





?>