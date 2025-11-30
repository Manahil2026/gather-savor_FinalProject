<?php 

require_once __DIR__ . "/../db.php"; 
require_once __DIR__ . "/../auth/checkSession.php";

if(!isset($_POST['recipe_id']) || !isset($_POST['ingredient'])){ //If either recipe id or ingredient is not set then terminate and give msg
    die("Missing fields");
}

$user_id = $_SESSION['user_id']; //Get user id from session
$recipe_id = $_POST['recipe_id']; //Get recipe id from post request
$ingredient = trim($_POST['ingredient']); //get and trim ingredient from post request
$quantity = isset($_POST['quantity'] ? trim($_POST['quantity']) : ''); //If quantity is set in post then assign it otherwise assign an empty string

$stmt = $conn->prepare("INSERT INTO shopping_lists (user_id, recipe_id, ingredient, quantity)
    VALUES (?,?,?,?)
");

$stmt->bind_param("isss", $user_id, $recipe_id, $ingredient, $quantity);
$stmt->execute();

echo "success";

?>