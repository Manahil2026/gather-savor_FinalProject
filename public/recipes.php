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
	<link rel="stylesheet" href="assets/css/recipe-cards.css">
	
</head>
<body>
	<header>
		<nav class="main-nav">
			<div class="logo">
				<a href="home.php">Gather & Savor</a>
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
			<form id="recipe-search-form">
				<input type="text" id="search-box" placeholder="Search recipes..." required>
				<h3>Filters: </h3>
				<div class="recipeFilters">
					<label class="recipeFilter">
						<input name="cheap" type="checkbox">
						<span>Cheap</span>
					</label>

					<label class="recipeFilter">
						<input name="dairyFree" type="checkbox">
						<span>Dairy Free</span>
					</label>

					<label class="recipeFilter">
						<input name="glutenFree "type="checkbox">
						<span>Gluten Free</span>
					</label>


					<label class="recipeFilter">
						<input name="vegan" type="checkbox">
						<span>Vegan</span>
					</label>


					<label class="recipeFilter">
						<input name="vegetarian" type="checkbox">
						<span>Vegetarian</span>
					</label>


					<label class="recipeFilter">
						<input name="veryHealthy" type="checkbox">
						<span>Very Healthy</span>
					</label>


					<label class="recipeFilter">
						<input name="veryPopular" type="checkbox">
						<span>Very Popular</span>
					</label>


					<label class="recipeFilter">
						<input name="lowFodmap" type="checkbox">
						<span>lowFodmap</span>
					</label>


					<label class="recipeFilter">
						<input name="sustainable" type="checkbox">
						<span>Sustainable</span>
					</label>
				</div>
			</form>
			
		</section>

		<!-- Populate-->
		<section id="recipe-results" class="card-grid"></section>
		
	</main>
	<script src="assets/js/recipes.js"></script>
</body>
</html>
