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
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <nav class="main-nav">
      <div class="logo">
        <a href="Home.php">Gather & Savor</a>
      </div>
      <ul class="nav-links">
        <li><a href="Home.php">Home</a></li>
        <li><a href="Recipes.php">Recipes</a></li>
        <li><a href="meal-planner.php">Meal Planner</a></li>
        <li><a href="favorites.php">Favorites</a></li>
        <li><a href="Shopping-list.php">Shopping List</a></li>
        <li><a href="Login.php">Login</a></li>
        <li><a href="Register.php" class="active">Register</a></li>
      </ul>
    </nav>
  </header>

  <main class="page-container auth-page">
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


      <form id="register-form" method="post" action="Register.php">
        <div class="form-group">
          <label for="reg-name">Name</label>
          <input type="text" id="reg-name" name="name" required>
        </div>

        <div class="form-group">
          <label for="reg-email">Email</label>
          <input type="email" id="reg-email" name="email" required>
        </div>

        <div class="form-group">
          <label for="reg-password">Password</label>
          <input type="password" id="reg-password" name="password" required>
        </div>

        <div class="form-group">
          <label for="reg-confirm">Confirm Password</label>
          <input type="password" id="reg-confirm" name="confirm_password" required>
        </div>

        <button type="submit" class="btn primary-btn">Register</button>
      </form>
      <p class="auth-switch">
        Already have an account? <a href="Login.php">Log in here.</a>
      </p>
    </section>
  </main>
</body>
</html>