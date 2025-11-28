<?php
require_once __DIR__ . '/php/auth/checkSession.php'; // Include the session check to make sure user is logged in.
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gather & Savor | Recipe Details</title>
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
				<li><a href="favorites.php">Favorites</a></li>
				<li><a href="Shopping-List.php">Shopping List</a></li>
				<li><a href="Login.php">Login</a></li>
				<li><a href="Register.php">Register</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</header>

	<main class="page-container">
		<section class="page-header">
			<h1>Recipe Details</h1>
			<p>Full recipe information will appear here.</p>
		</section>

		<section id="recipe-details" class="recipe-details">
			<div class="recipe-main">
				<h2 id="recipe-title">Recipe Title</h2>
				<img id="recipe-image" src="" alt="Recipe Image" class="recipe-image"/>
				<p id="recipe-summary" class="recipe-summary">Recipe summary or description.</p>
			</div>

			<div class="recipe-columns">
				<div class="ingredients-column">
					<h3>Ingredients</h3>
					<ul id="ingredients-list">
						<li>Ingredient placeholder</li>
					</ul>
				</div>
				<div class="instructions-column">
					<h3>Instructions</h3>
					<ol id="instructions-list">
						<li>Step placeholder</li>
					</ol>
				</div>
			</div>

			<button class="btn secondary-btn" id="add-to-favorites-btn">Add to Favorites</button>
			<button class="btn secondary-btn" id="add-to-mealplan-btn">Add to Meal Plan</button>
		</section>
	</main>
</body>
</html>