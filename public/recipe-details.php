<?php
	session_start();
	require_once __DIR__ . '/../src/auth/checkSession.php'; // Include the session check to make sure user is logged in.

	
		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(!isset($_POST['action'])){
				$error = "Invalid request";
			};

			$action = $_POST['action'];

			switch($action){
				case "save-favorite":
					require_once __DIR__ . "/../src/recipes/saveFavorite.php";
					break;
				
				case "remove-favorite":
					require_once __DIR__ . "/../src/recipes/removeFavorite.php";
					break;

				case "add-mealPlan":
					require_once __DIR__ . "/../src/recipes/addToMealPlan.php";
					break;

				default:
					$error = "Invalid request";
					break;
			}
		};

		if(isset($_SESSION['error'])){
			$error = $_SESSION['error'];
			unset($_SESSION['error']);
		}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--Display errors-->
	<?=$error?>
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
					<button id="add-to-shopping-list" class="btn secondary-btn">Add Ingredients to Shopping List</button>
				</div>
				<div class="instructions-column">
					<h3>Instructions</h3>
					<ol id="instructions-list">
						<li>Step placeholder</li>
					</ol>
				</div>
			</div>

			<form action="recipe-details.php" method = "POST" class=favorite-form>
				<input type="hidden" name="recipe_id" value="<?=$recipe_id ?>">
				<button type = "submit" name = "action" value = "add" class="btn secondary-btn">Add to Favorites</button>
			</form>

			<form action="recipe-details.php" method = "POST" class=favorite-form>
				
				<button type = "submit" name = "action" value = "remove" class="btn secondary-btn">Remove from Favorites</button>
			</form>

			<form action="recipe-details.php" method="POST" class="mealplan-form">
				<!--<input type="hidden" name = "recipe_id" value="<?php //$recipe_id ?>"> -->
				<input type="hidden" name="action" value="add-mealPlan">
				<input type="hidden" name="recipe_id" value="901234'33'f"> <!--In the future this will just be the link to the item on the api-->

				<label> Select a day:</label>
				<select name="day" required>
					<option value="" disabled selected>Select day</option>
					<option value="monday">Monday</option>
					<option value="tuesday">Tuesday</option>
					<option value="wednesday">Wednesday</option>
					<option value="thursday">Thursday</option>
					<option value="friday">Friday</option>
					<option value="saturday">Saturday</option>
					<option value="sunday">Sunday</option>
				</select> 
				
				<button type="submit" class="btn secondary-btn">Add to Meal Plan</button>
			</form>

		</section>
	</main>
</body>
</html>