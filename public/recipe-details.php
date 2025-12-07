<?php

	//This php was written by ant
	require_once __DIR__ . '/../src/auth/checkSession.php'; // Include the session check to make sure user is logged in.

		function makeWebRequest($url){
			$crl = curl_init($url);
			curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

			$res = curl_exec($crl);

			//Check for errors
			if(curl_errno($crl)){
				$error = $curl_error($crl);
			}

			curl_close($crl);
			$res_parsed = json_decode($res);
			return $res_parsed;
		}


		if($_SERVER['REQUEST_METHOD'] == 'POST'){
			if(!isset($_POST['action'])){
				$err = "Invalid request";
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
		}
		elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
			
			//Don't waste making requests to the api if there's no id.
			if(!isset($_GET['id'])){
				die();
			}
			
			$id = $_GET['id'];
			
			//Not sanitizing cause it's not my api. You're not hacking me you're hacking spoonacular.
			$detailsURL = "https://api.spoonacular.com/recipes/$id/information?apiKey=79f089b8a521468eadcd3dcad358548a";
			$instructionsURL = "https://api.spoonacular.com/recipes/$id/analyzedInstructions?apiKey=79f089b8a521468eadcd3dcad358548a";

			//Make the reqs.
			$recipe_details = makeWebRequest($detailsURL);
			$recipe_instructions = makeWebRequest($instructionsURL);

			//Check for errors on those two e.g. not enough credits ugh
			if($recipe_details->status === "failure" || $recipe_instructions->status === "failure"){
				$error = [
					$recipe_details->message,
					$recipe_instructions->message
				];
			}
			
			//debug
			//var_dump($recipe_instructions[0]->steps);
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
				<li><a href="home.php">Home</a></li>
				<li><a href="recipes.php">Recipes</a></li>
				<li><a href="meal-planner.php">Meal Planner</a></li>
				<li><a href="favorites.php">Favorites</a></li>
				<li><a href="shopping-List.php">Shopping List</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</header>

	<main class="page-container">

		<section id="recipe-details" class="recipe-details">
			<div class="recipe-main">
				<h2 id="recipe-title"><?php echo $recipe_details->title?></h2>
				<img id="recipe-image" src="<?php echo $recipe_details->image?>" alt="Recipe Image" class="recipe-image"/>
			</div>

			<div class="ingredient-list">
				<h3>Ingredients:</h3>
				<ul>
					<?php 
						$ingredients = $recipe_details->extendedIngredients;
						foreach ($ingredients as $ingredient){
							echo "<li>$ingredient->original</li>";
						}
					?>
				</ul>
			</div>

			<div class="recipe-instructions">
				<h3>Instructions</h3>
				<ol>
					<?php 
						foreach ($recipe_instructions[0]->steps as $step){
							echo "<li>$step->step</li>";
						}
					?>
				</ol>
				
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