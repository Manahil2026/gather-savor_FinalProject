<?php
require_once __DIR__ . '/../src/auth/checkSession.php'; // Include the session check to make sure user is logged in.

//https://stackoverflow.com/questions/9802788/call-a-rest-api-in-php



?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gather & Savor | Recipes</title>
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
				<li><a href="shopping-List.php">Shopping List</a></li>
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
			<form id="recipe-search-form">
				<input type="text" id="search-query" name="query" placeholder="Search recipes..." required>
				<select id="search-filter" name="filter">
					<option value="">Filter (optional)</option>
					<option value="cuisine">Cuisine</option>
					<option value="diet">Diet</option>
					<option value="ingredients">Ingredients</option>
				</select>
				<button type="submit" class="btn primary-btn">Search</button>
			</form>
		</section>

		<!-- Populate-->
		<button id="loadButton">Load the Recipes</button>
		<section id="recipe-results" class="card-grid">
			<p class="placeholder-text">Search for a recipe to see results here.</p>
		</section>
	</main>
	<script src="assets/js/recipes.js"></script>
</body>
</html>