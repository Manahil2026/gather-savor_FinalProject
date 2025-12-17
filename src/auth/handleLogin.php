<?php 
require_once __DIR__ . '/../messages.php'; 
//This page reads login form data
// Checks if email exists
// Verifies the password using the password_verify function
// If login is successful, store user info in session and redirects to homepage

session_start(); // Start a new session or resume existing one, session is needed here
require_once __DIR__ . '/../db.php'; // Include the database connection file as it is needed for database operations

$raw = file_get_contents("php://input");
$data = json_decode($raw, true);

$email = isset($data['email']) ? trim($data['email']) : ''; 
$password = isset($data['password']) ? trim($data['password']) : ''; 

if(empty($email) || empty($password)){ 
    error_message("Please fill in all fields"); 
}

try{
    $stmt = $conn->prepare("SELECT id, username, pssword FROM users WHERE email = :email LIMIT 1"); // Prepare SQL statment to select user by email
    $stmt->execute([':email' => $email]); //Execute the prepared statemnt with the email parameter
    $user = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch the user record as an associative array

    //password_verify is a built-in PHP function that verifies that a given password matches a hashed password
    if($user){ 
        if(password_verify($password, $user['pssword'])){
            // If login is successful, store user info in session
            $_SESSION['user_id'] = $user['id']; // Store user id in session to log the user in
            $_SESSION['username'] = $user['username']; // Store username in session

            success_message("Logged in successfully."); // Redirect to homepage with success message
        }
    }
    else{
        error_message("Username or password incorrect"); // Redirect to login page with error message
    }
} catch (PDOException $e){
    error_message($e->getMessage());
}    




?>