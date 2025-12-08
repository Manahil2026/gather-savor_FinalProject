<?php
require_once __DIR__ . '/php/auth/checkSession.php'; // Include the session check to make sure user is logged in.
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/recipe-card.css">
	<script defer src="js/recipes.js"></script>
</head>
<body>
	<header>
		<nav class="main-nav">
			<div class="logo">
				<a href="Home.php">Gather & Savor</a>
			</div>
			<ul class="nav-links">
				<li><a href="Home.php">Home</a></li>
				<li><a href="Recipes.php" class="active">Recipes</a></li>
				<li><a href="meal-planner.php">Meal Planner</a></li>
				<li><a href="favorites.php">Favorites</a></li>
				<li><a href="Shopping-List.php">Shopping List</a></li>
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
		<section id="recipe-results" class="card-grid">
			<p class="placeholder-text">Search for a recipe to see results here.</p>
		</section>
	</main>
</body>
</html>
