<?php
session_start(); // Start a new session or resume existing one

require_once __DIR__ . "/../src/auth/handleRegister.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Register</title>
	<link rel="stylesheet" href="assets/css/auth.css">
</head>

<body class="auth-page">

    <section class="auth-card">
      <h1>Create an Account</h1>

      <?php if (isset($_SESSION['error'])): ?> <!-- If there is an error message in the session, display it -->
        <div class="alert error">
          <?= $_SESSION['error']; unset($_SESSION['error']); ?> <!-- Display and then clear the error message -->
        </div>
      <?php endif; ?>

      <?php if (isset($_SESSION['success'])): ?> <!-- If there is a success message in the session, display it -->
        <div class="alert success">
          <?= $_SESSION['success']; unset($_SESSION['success']); ?> <!-- Display and then clear the success message -->
        </div>
      <?php endif; ?>


      <form class="auth-form" method="post" action="register.php">
        
          <label >Name</label>
          <input type="text"  name="name" required>
        

       
          <label >Email</label>
          <input type="email" name="email" required>
       

        
          <label>Password</label>
          <input type="password"  name="password" required>
        

        
          <label>Confirm Password</label>
          <input type="password" name="confirm_password" required>
        
      <div class="auth-actions">
        <button type="submit" class="auth-btn-primary">Register</button>
      </div>

      </form>

      <p class="auth-switch">
        Already have an account? <a href="login.php">Log in here</a>
      </p>
    
    </section>
  
</body>
</html>
