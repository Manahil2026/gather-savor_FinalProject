<?php
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

   
      <div class="alert error hidden"></div>


      <form class="auth-form" method="post">
       
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
 
  <script src="assets/js/login.js"></script>
</body>
</html>
