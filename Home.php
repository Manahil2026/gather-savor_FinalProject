<?php
require_once __DIR__ . '/php/auth/checkSession.php'; // Include the session check to make sure user is logged in.
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Home</title>
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/style.css">
  <script defer src="app.js"></script>
</head>
<body>
  <header>
    <nav class="main-nav">
      <div class="logo">
        <a href="Home.php">Gather & Savor</a>
      </div>
      <ul class="nav-links">
        <li><a href="Home.php" class="active">Home</a></li>
        <li><a href="Recipes.php">Recipes</a></li>
        <li><a href="meal-planner.php">Meal Planner</a></li>
        <li><a href="favorites.php">Favorites</a></li>
        <li><a href="Shopping-list.php">Shopping List</a></li>
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="page-container">
    <section class="hero">
      <h1>Plan Smarter. Eat Better.</h1>
      <p>Search recipes, create weekly meal plan, and generate a personalized shopping list.</p>
      <a class="btn primary-btn" href="Recipes.php">Explore Recipes</a>
    </section>

    <section class="home-grid">
      <article class="home-card">
        <h2>Weekly Meal Planner</h2>
        <p>Drag and drop or assign recipes to each day of the week.</p>
        <a href="meal-planner.php" class="link">Open Meal Planner</a>
      </article>

      <article class="home-card">
        <h2>Favorites</h2>
        <p>Save your go-to recipes and access them quickly.</p>
        <a href="favorites.php" class="link">View Favorites</a>
      </article>

      <article class="home-card">
        <h2>Shopping List</h2>
        <p>Automatically build a grocery list based on your selected recipes.</p>
        <a href="Shopping-list.php" class="link">View Shopping List</a>
      </article>
    </section>
  </main>
</body>
</html>
