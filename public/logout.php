<?php 

session_start();
$_SESSION = []; // Clear all session data
session_unset(); // unset means to free all session variables
session_destroy(); // Destroy the session
header('Location: login.php'); //redirect to Login page
exit;

?>