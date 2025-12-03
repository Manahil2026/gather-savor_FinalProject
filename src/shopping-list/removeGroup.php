<?php 

require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/../auth/checkSession.php";

if(!isset($_POST['recipe_id'])){
    die("Missing recipe ID");
}

$user_id = $_SESSION['user_id'];
$recipe_id = $_POST['recipe_id'];

$stmt = $conn->prepare("DELETE FROM shopping_lists WHERE user_id = ? AND recipe_id = ?");
$stmt->bind_param("is", $user_id, $recipe_id);
$stmt->execute();

echo "success";

?>