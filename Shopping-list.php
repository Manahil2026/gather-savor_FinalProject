<?php
require_once __DIR__ . 'php/auth/checkSession.php'; // Include the session check to make sure user is logged in.
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Shopping List</title>
  <link rel="stylesheet" href="style.css">
  <script defer src="app.js"></script>
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
        <li><a href="Shopping-list.php" class="active">Shopping List</a></li>
        <li><a href="Login.php">Login</a></li>
        <li><a href="Register.php">Register</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="page-container">
    <section class="page-header">
      <h1>Shopping List</h1>
      <p>Ingredients from your selected recipes will appear here.</p>
    </section>
    <section id="shopping-list" class="shopping-list">
      <ul>
        <li class="placeholder-text">Your shopping list is currently empty.</li>
      </ul>
    </section>
  </main>
</body>
</html>
