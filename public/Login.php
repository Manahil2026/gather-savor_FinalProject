<?php
  session_start(); // Start a new session or resume existing one
  require_once __DIR__ . "/../src/auth/handleLogin.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Login</title>
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
        <li><a href="Login.php" class="active">Login</a></li>
        <li><a href="Register.php">Register</a></li>
      </ul>
    </nav>
  </header>

  <main class="page-container auth page">
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


      <form id="login-form" method="post" action="Login.php">
        <div class="form-group">
          <label for="login-email">Email</label>
          <input type="email" id="login-email" name="email" required>
        </div>

        <div class="form-group">
          <label for="login-password">Password</label>
          <input type="password" id="login-password" name="password" required>
        </div>

        <button type="submit" class="btn primary-btn">Log In</button>
      </form>
      <p class="auth-switch">Don't have an account?<a href="Register.php">Register here.</a></p>
    </section>
  </main>
</body>
</html>