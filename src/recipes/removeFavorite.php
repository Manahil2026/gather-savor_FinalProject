<?php


require_once __DIR__ . '/../db.php'; // Include db connection file
require_once __DIR__ . '/../auth/checkSession.php'; // Ensure user is logged in

$user_id = $_SESSION['user_id']; // Get user id from session

$recipe_id = $_POST['recipe_id'] ?? '';
$stmt = $conn->prepare("DELETE FROM favorites WHERE user_id = :user AND recipe_id = :rid LIMIT 1");
$stmt->execute([':user' => $user_id, ':rid' => $recipe_id]);

header('Location: favorites.php?msg=Recipe removed from favorites'); //Redirect to favprites page with msg
exit;
?>