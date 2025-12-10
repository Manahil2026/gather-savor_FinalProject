<?php
require_once __DIR__ . '/../src/auth/checkSession.php'; // Include the session check to make sure user is logged in.
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gather & Savor | Recipes</title>
	<link rel="stylesheet" href="assets/css/header.css">
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
	<header>
		<nav class="main-nav">
			<div class="logo">
				<a href="Home.php">Gather & Savor</a>
			</div>
			<ul class="nav-links">
				<li><a href="home.php">Home</a></li>
				<li><a href="recipes.php" class="active">Recipes</a></li>
				<li><a href="meal-planner.php">Meal Planner</a></li>
				<li><a href="favorites.php">Favorites</a></li>
				<li><a href="shopping-list.php">Shopping List</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</header>

	<main class="page-container">
		<section class="page-header">
			<h1>Recipes</h1>
			<p>Search for recipes using ingredients, cuisine type, or dietary preferences.</p>
		</section>

		<section class="search-section">
			<form>
				<input type="text" id="search-box" placeholder="Search recipes..." required>
				<button id="search-button" type="submit" class="btn primary-btn">Search</button>
			</form>
		</section>

		<!-- Populate-->
		<section id="recipe-results" class="card-grid" style="display: flex; gap: 20px; flex-wrap: wrap; padding: 20px; justify-content: center; align-items: center;">

	
		</section>
	</main>
	<script src="assets/js/recipes.js"></script>
</body>
</html>