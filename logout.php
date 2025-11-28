<?php 

session_start();
$_SESSION = []; // Clear all session data
session_unset(); // unset means to free all session variables
session_destory(); // Destroy the session
header('Location: Login.php'); //redirect to Login page
exit;

?>