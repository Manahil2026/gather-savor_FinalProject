<?php 

//This page reads login form data
// Checks if email exists
// Verifies the password using the password_verify function
// If login is successful, store user info in session and redirects to homepage

session_start(); // Start a new session or resume existing one
require_once __DIR__ . '/../db.php'; // Include the database connection file as it is needed for database operations

function redirect_with_msg($url, $msg_key, $msg_value){ // This function will redirect the user to a specified URL with a message stored in the session
    $_SESSION[$msg_key] = $msg_value;
    header("Location: $url");
    exit;
}

if($_SERVER['REQUEST_METHOD'] !== 'POST'){ // Check if request method is not POST
    redirect_with_msg('../../Login.php', 'error', 'Invalid request method.'); // Redirect to login page if request method is not POST
}


$email = isset($_POST['email']) ? trim($_POST['email']) : ''; // If email is set in POST request trim whitespace and assign to $email, else assign empty string
$password = isset($_POST['password']) ? trim($_POST['password']) : ''; // If password is set in POST request trim whitespace and assign to $password, else assign empty string

if(empty($email) || empty($password)){ // Check if email or password is empty
    redirect_with_msg('../../Login.php', 'error', 'Please fill in all fields.'); // Redirect to login page if any field empty
}

try{
    $stmt = $conn->prepare("SELECT id, username, pssword FROM users WHERE email = :email LIMIT 1"); // Prepare SQL statment to select user by email
    $stmt->execute([':email' => $email]); //Execute the prepared statemnt with the email parameter
    $user = $stmt->fetch(PDO::FETCH_ASSOC); //Fetch the user record as an associative array

    if(!$user){ // If no user record is found
        redirect_with_msg('../../Login.php', 'error', 'Email not found.'); // Redirect to login page with error message
    }

    //password_verify is a built-in PHP function that verifies that a given password matches a hashed password
    if(!password_verify($password, $user['pssword'])){ //Verify the provided password against the hashed password stored in the database
        redirect_with_msg('../../Login.php', 'error', 'Incorrect password.'); //Redirect to login page if password is incorrect
    }

    // If login is successful, store user info in session
    $_SESSION['user_id'] = $user['id']; // Store user id in session to log the user in
    $_SESSION['username'] = $user['username']; // Store username in session

    redirect_with_msg('../../Home.php', 'success', 'Logged in successfully.'); // Redirect to homepage with success message

} catch (PDOException $e){
    redirect_with_msg('../../Login.php', 'error', 'Server error: ' . $e->getMessage()); //If a database error occurs redirect to login page with error message
}

?>