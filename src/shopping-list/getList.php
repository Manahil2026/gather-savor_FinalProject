<?php 

//This file is responsible for returning ingredients grouped by recipe id

require_once __DIR__ . '/../db.php'; // include db connection file
require_once __DIR__ . '/../auth/checkSession.php'; // make sure user is logged in

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT id, recipe_id, ingredient, quantity
    FROM shopping_lists WHERE user_id = ? ORDER BY recipe_id, ingredient
");
$stmt->bind_param('i',$user_id);
$stmt->execute();
$result = $stmt->get_result();

$grouped = [];

while($row = $result->FETCH_ASSOC()){
    $grouped[$row['recipe_id']][] = $row;
}


header('Content-Type: application/json');
echo json_encode([
    "status" => "success",
    "message" => $grouped
]);

?>