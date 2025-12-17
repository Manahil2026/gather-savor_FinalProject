<?php
  require_once __DIR__ . '/../src/auth/checkSession.php'; // Include the session check to make sure user is logged in.
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Shopping List</title>
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/style.css">
	<link rel="stylesheet" href="assets/css/shopping-list.css">
  <link rel="stylesheet" href="assets/css/toast.css">
  <script defer src="app.js"></script> <!-- app.js will be replaced with shopping-list.js which will provoide logic for rendering ingredients from api -->
</head>
<body>

  <div class="toast">
		<p>Successfully added to favorites!</p>
	</div>
  
  <header>
    <nav class="main-nav">
      <div class="logo">
        <a href="home.php">Gather & Savor</a>
      </div>
      <ul class="nav-links">
        <li><a href="home.php">Home</a></li>
        <li><a href="recipes.php">Recipes</a></li>
        <li><a href="meal-planner.php">Meal Planner</a></li>
        <li><a href="favorites.php">Favorites</a></li>
        <li><a href="shopping-list.php" class="active">Shopping List</a></li>
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
    

      <!-- JS will insert recipe groups here -->
       <div id = "shopping-list-groups"></div>

    </section>


  </main>
  <script src="assets/js/shopping.js"></script>
</body>
</html>
