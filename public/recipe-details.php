<?php
	require_once __DIR__ . '/../src/auth/checkSession.php'; 
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gather & Savor | Recipe Details</title>
	<link rel="stylesheet" href="assets/css/recipe-cards.css">
	<link rel="stylesheet" href="assets/css/toast.css"> 
	<link rel="stylesheet" href="assets/css/modal.css">
	<link rel="stylesheet" href="assets/css/header.css">
	
</head>
<body>

	<div id="modal" class="modal-hidden">
		<label for="day-selection"> Select a day:</label>
		<div>
			<select id="day-selection" required>
			<option value="" disabled selected>Select day</option>
			<option value="monday">Monday</option>
			<option value="tuesday">Tuesday</option>
			<option value="wednesday">Wednesday</option>
			<option value="thursday">Thursday</option>
			<option value="friday">Friday</option>
			<option value="saturday">Saturday</option>
			<option value="sunday">Sunday</option>
		</select> 

		<div class = "modal-actions">
			<button id="add-mealplan-button" class="btn primary-btn">Add to Meal Plan</button>
			<button id="close-modal" class="modal-close">Cancel</button>
			
			</div>
		</div>
		
	</div>


	<div class="toast">
		<p>Successfully added to favorites!</p>
	</div>
	

	<?php 
		//This is here to pass parameters to javascript
		$recipe_id = isset($_GET['recipe_id']) ? $_GET['recipe_id'] : ""; 
		echo '<input id="recipe_id" type="hidden" value=' . $recipe_id . ">";
	?>

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
				<li><a href="shopping-list.php">Shopping List</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</header>

	<main class="page-container">

		<section id="recipe-details" class="recipe-details">

			<!--Title, picture, details-->
			<div class="recipe-main">
				<h2 id="recipe-title"></h2>
				<img id="recipe-image" alt="" class="recipe-image"/>
			</div>


		<div class="recipe-columns">

			<!--Ingredients List-->
			<div class="ingredients-column">
				<h3>Ingredients:</h3>
				<ul id="recipe-ingredients"></ul>
			</div>

			<!--Instructions for the recipe-->
			<div class="instructions-column">
				<h3>Instructions</h3>	
				<div id="recipe-instructions"></div>
			</div>
		</div>


			<div class = "recipe-actions">

				<!--Favorites button (change w/ javascript?)-->
				<button class = "btn primary-btn" id="toggleFavorite">Add Favorite</button>

				<button class = "btn primary-btn" id="showModal">Add to meal plan</button>

				<button class = "btn primary-btn" id="toggleShoppingList">Add to Shopping List</button>

			</div>
		</section>
	</main>

	<div id="modal-backdrop" class="modal-backdrop-hidden"></div>

	<script src="assets/js/recipe-details.js"></script>
</body>
</html>