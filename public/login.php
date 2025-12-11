<?php
  session_start(); // Start a new session or resume existing one
  //if the person is already authenticated redirect.
  require_once __DIR__ . "/../src/auth/handleLogin.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Login</title>
  <link rel="stylesheet" href="assets/css/auth.css">
</head>
<body class="auth-page">

    <section class="auth-card">
      <h1>Login</h1>

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


      <form class="auth-form" method="post" action="login.php">
       
          <label>Email</label>
          <input type="email" name="email" required>
        

      
          <label>Password</label>
          <input type="password" name="password" required>
        
      <div class="auth-actions">
        <button type="submit" class="auth-btn-primary">Log In</button>
      </div>

      </form>

      <p class="auth-switch">Don't have an account? <a href="register.php">Register here</a></p>
      
    </section>
 
</body>
</html>
