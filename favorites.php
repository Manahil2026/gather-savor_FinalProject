<?php
// PLACEHOLDER for future PHP: fetch and display user's saved favorite recipes.
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Favorites</title>
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
        <li><a href="favorites.php" class="active">Favorites</a></li>
        <li><a href="Shopping-list.php">Shopping List</a></li>
        <li><a href="Login.php">Login</a></li>
        <li><a href="Register.php">Register</a></li>
      </ul>
    </nav>
  </header>

  <main class="page-container">
    <section class="page-header">
      <h1>Favorite Recipes</h1>
      <p>Your saved recipes will be listed here.</p>
    </section>

    <section id="favorites-container" class="card-grid">
      <p class="placeholder-text">You haven't added any favorites yet.</p>
    </section>
  </main>
</body>
</html>
