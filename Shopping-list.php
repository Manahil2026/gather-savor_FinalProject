<?php
require_once __DIR__ . '/php/auth/checkSession.php'; // Include the session check to make sure user is logged in.
$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Shopping List</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/header.css">
  <link rel="stylesheet" href="css/shopping-list.css">
  <script defer src="shopping-list.js"></script>
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
        <li><a href="logout.php">Logout</a></li>
      </ul>
    </nav>
  </header>

  <main class="page-container">

    <section class="page-header">
      <h1>Shopping List</h1>
      <p>Ingredients from your selected recipes will appear here.</p>
    </section>

    <section id="shopping-list" class="shopping-list-container">
    
      <!-- JS will replace this placeholder depending on DB results -->
       <p class="placeholder-text" id = "empty-list-message">
          Loading your Shopping List...
       </p>

      <!-- JS will insert recipe groups here -->
       <div id = "shopping-list-groups"></div>

    </section>

    <!-- Pass user_id to JS if needed -->
    <script>
      const USER_ID = <?= json_encode($user_id); ?>;
    </script>

  </main>
</body>
</html>
