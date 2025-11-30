<?php 

require_once __DIR__ . "/../db.php";
require_once __DIR__ . "/../auth/checkSession.php";

if(!isset($_POST['id'])){ //If id is missing from post request terminate with msg
    die("Missing ID");
}

$user_id = $_SESSION['user_is']; //Get user id from session
$id = $_POST['id']; //Get shopping id from post request

$stmt = $conn->prepare("DELETE FROM shopping_lists WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $id , $user_id);
$stmt->execute();

echo 'success';

?>