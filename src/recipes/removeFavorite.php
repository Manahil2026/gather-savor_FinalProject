<?php
//session and the check auth is already done in the recipe-details page

function removeFavorite(){
    //todo: add error handling
    require_once __DIR__ . '/../db.php'; // Include db connection file
    require_once __DIR__ . '/../auth/checkSession.php'; // Ensure user is logged in

    $user_id = $_SESSION['user_id']; // Get user id from session

    $recipe_id = $_POST['recipe_id'] ?? '';
    $title = $_POST['recipe_title'] ?? '';
    $image = $_POST['recipe_image'] ?? '';
    $stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = :user AND recipe_id = :rid LIMIT 1");
    $stmt->execute([':user' => $user_id, ':rid' => $recipe_id]);
    header('Location: ../../[public/favorites.php?msg=Recipe removed from favorites'); //Redirect to favprites page with msg
    exit;
}

removeFavorite();
?>