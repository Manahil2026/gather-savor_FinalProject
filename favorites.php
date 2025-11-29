<?php
require_once __DIR__ . '/php/auth/checkSession.php'; // Include the session check to make sure user is logged in.
$favorites = require __DIR__ . '/php/recipes/loadFavorites.php'; //Load favorite recipes
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
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="page-container">
    <section class="page-header">
      <h1>Favorite Recipes</h1>
      <p>Your saved recipes will be listed here.</p>
    </section>

    <!-- Favorite Recipes will be displayed here and remove button is also included -->

    <section id="favorites-container" class="card-grid">
      <?php if (empty($favorites)): ?>
        <p class ="placeholder-text">You have no favorite recipes yet.</p>
      
      <?php else: ?>
        <?php foreach ($favorites as $fav): ?>

          <div class="favorite-card">
            <img src="<?php echo $fav['recipe_image']; ?>" alt="<?php echo htmlspecialchars($fav['recipe_title']); ?>" class="favorite-img"/>
            <h3 class="favorite-title"><?php echo htmlspecialchars($fav['recipe_title']); ?></h3>

            <form action = "php/recipes/saveFavorite.php" method ="POST" class="remove-favorite-form">
              <input type="hidden" name="recipe_id" value="<?php echo $fav['recipe_id']; ?>">
              <button type="submit" name="action" value="remove" class="btn secondary-btn">Remove</button>
            </form>

          </div>

        <?php endforeach; ?>

      <?php endif; ?>
    </section>
  </main>
</body>
</html>
