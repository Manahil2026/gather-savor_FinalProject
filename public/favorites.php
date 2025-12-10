<?php
require_once __DIR__ . '/../src/auth/checkSession.php'; // Include the session check to make sure user is logged in.

require_once __DIR__ . "/../src/messages.php"; //json messages


if($_SERVER["REQUEST_METHOD"] === "POST"){
  
  if(!isset($_POST['action'])){
    error_message("action not set");
    var_dump($_POST);
    exit;
  }

  $action = $_POST['action'];
  switch($action){

    case "load-favorites":
      require_once __DIR__ . '/../src/recipes/loadFavorites.php'; //Load favorite recipes
      break;

    case "delete-favorite": 
      require_once __DIR__ . '/../src/recipes/removeFavorite.php';
      break;


    default:
      error_message("Action is not valid");
      break;
  }

  exit;
} 
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gather & Savor | Favorites</title>
  <link rel="stylesheet" href="assets/css/toast.css">
  <link rel="stylesheet" href="assets/css/header.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>


  <div class="toast">
		<p>Successfully removed from favorites!</p>
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
        <li><a href="favorites.php" class="active">Favorites</a></li>
        <li><a href="shopping-list.php">Shopping List</a></li>
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
 

    </section>
  </main>
  <script src="assets/js/favorites.js"></script>
</body>
</html>



