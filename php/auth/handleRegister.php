<?php

//This page inserts a new user into the databse
// Only after validating the form data like checking for empty fields, valid email format, password match, and existing user
// It also hashes the password before storing it in database for security
// Creates a user session upon successful registration and then redirects to homepage

session_start(); // This line starts a new session or resumes an existing one
require_once __DIR__ . '/../db.php'; // require once includes the db.php file located one directory up only once as it contains the database connection code and is only needed once

function redirect_with_msg($url, $msg_key, $msg_value){ // This function redirects the user to a specified URL with a message stored in the session
    $_SESSION[$msg_key] = $msg_value; //Store the message in the session using the provided key
    header("Location: $url"); // Redirect to the URL
    exit;
}

if($_SERVER['REQUEST_METHOD'] !== 'POST'){ // Check if the request mehod is not POST
    redirect_with_msg('../../Register.php', 'error', 'Invalid request method.'); // If it's not POST redirect to the R page with an error message
}

// Collect and trim form data by checking if each field is set in the POST request
$name = isset($_POST['name']) ? trim($_POST['name']) : ''; // if the name field is set in the POST request, trim any whitespace and assign it to $name, otherwise assign an empty string
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$password = isset($_POST['password']) ? trim($_POST['password']) : '';
$confirm_password = isset($_POST['confirm_password']) ? trim($_POST['confirm_password']) : '';

// Lets do Basic validation to make sure that all fields are filled out

if(empty($name) || empty($email) || empty($password) || empty($confirm_password)){ // Check if any of the fileds are empty
    redirect_with_msg('../../Register.php', 'error', 'All fields are required.'); // If any field is empty redirect to the R page with an error message
}

// FILTER_VALIDATE_EMAIL is a built-in PHP filter that validates whether a given string is a valid email address format
if(!filter_var($email, FILTER_VALIDATE_EMAIL)){ // Validate the email format using PHP's filter_var function
    redirect_with_msg('/../Register.php', 'error', 'Invalid email format.'); // If the email format is invalid redirect to the R page with an error message
}

if($password !== $confirm_password){ // Check to see if psswrd and confrim psswrd match
    redirect_with_msg('../../Register.php', 'error', 'Passwords do not match.'); // Redirect to R page if they dont match
}

//Redirect to R page if password is less than 6 characters
if(strlen($password) <6){
    redirect_with_msg('../../Register.php', 'error', 'Password must be atleast 6 characters long.');
}

try{
    // Check to see if user is already registered
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = :email LIMIT 1"); // Prepare a SQL statemnt to select the user id from the users table where the email matches the provided email
    $stmt->execute([':email' => $email]); // Execute the prepared statement with the email paramater
    if ($stmt->fetch()){ // If a record is found
        redirect_with_msg('../../Register.php', 'error', 'Email is already registered.');
    }

    // Hash the password using password_hash function with default algorithm
    // Password hashing is very important for security because even if the database gets exposed the actual password is not stored in plain text
    $password_hash = password_hash($password, PASSWORD_DEFAULT); //password_hash is a built-in PHP function that hashes passwords

    // Finalllyyy after all the precautions: Insert the new user into the database
    $stmt = $conn->prepare("INSERT INTO users (username, email, pssword) VALUES (:username. :email, :pssword)"); // Prepare SQL stmt to insert new user record into users table
    $stmt->execute([':username' => $name, ':email' => $email, ':pssword' => $password_hash]); // Execute the prepared statement with the user data
    
    // Log the user in automatcally by storing session
    $user_id = $conn->LastInsertId(); // Get the last inserted user id which will be the new user's id
    $_SESSION['user_id'] = $user_id; //$_SESSION  is a superglobal array in PHP used to store session variables
    $_SESSION['username'] = $name;

    redirect_with_msg('../../Home.php', 'success', 'Registration successful. Welcome!'); // Redirect to homepage with a success message


} catch (PDOException $e){
    redirect_with_msg('../../Register.php', 'error', 'Server error:' . $e->getMessage()); // Catch any PDO exceptions (database errors) and redirect to R page with error message
}


?>