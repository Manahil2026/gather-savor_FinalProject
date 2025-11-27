<?php
// This file establishes a connection to the database
// This will be included via require function in other PHP files that meed database access

$dbname = 'gather_savor';
$username = 'root'; // root is the dafault username for XAMPP
$password = ''; // I will leave this empty because XAMPP's default psswrd is empty
$dsn = "mysql:host=localhost;dbname=$dbname";

try {
    $conn = new PDO($dsn, $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // :: is used to access static class members like in this case ERRMODE and ERRMODE_EXCEPTION
    // Here I am setting the error mode to exceptiom so that it throws exceptions in case of errors
    // ATTR_ERRMODE is a constant that represents the error reporting attribute
    // ERRMODE_EXCEPTION is a constant that represents the exception error mode
}catch (PDOException $e){
    die("Database connection failed: " . $e->getMessage()) // getMessage() is a method of the PDOException class that returns the error message
    //die is used to terminate the script execution, it prints the message and exits
}


?>