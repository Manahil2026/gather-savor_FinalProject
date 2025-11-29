<?php 

//This page handles adding and removing recipes from favorites table for a specific user

session_start();
require_once __DIR__ . '/../db.php'; // Include db connection file
require_once __DIR__ . '/../auth/checkSession.php'; // Ensure user is logged in

$user_id = $_SESSION['user_id']; // Get user id from session

if ($_SERVER['REQUEST_METHOD'] !== 'POST'){
    header('Location: ../../Recipes.php'); // Redirect to Recipes page if not a post request
    exit;
}

$action = $_POST['action'] ?? ''; // if action is set in post request assign it to $action else assign empty string
$recipe_id = $_POST['recipe_id'] ?? '';
$title = $_POST['recipe_title'] ?? '';
$image = $_POST['recipe_image'] ?? '';

if ($action === 'add'){ // If action is add I will insert recipe into favorites table

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

if ($action === 'remove'){ // If action is remove recipe will be delted from favorites table

    $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = :user AND recipe_id = :rid LIMIT 1");
    $stmt->execute([':user' => $user_id, ':rid' => $recipe_id]);
    header('Location: ../../favorites.php?msg=Recipe removed from favorites'); //Redirect to favprites page with msg
    exit;


}

header('Location: ../../favorites.php?msg=Invalid action'); // This is a default fallback in case action is neither add nor remove
exit;

?>