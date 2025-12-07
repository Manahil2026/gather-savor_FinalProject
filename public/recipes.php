<?php

//by Ant
require_once __DIR__ . '/../src/auth/checkSession.php'; // Include the session check to make sure user is logged in.

//https://stackoverflow.com/questions/9802788/call-a-rest-api-in-php


	//For this project I am leaving the keys out in the open because it's not a real production server, but obviously you would use .env
	$url = "https://api.spoonacular.com/recipes/complexSearch?apiKey=79f089b8a521468eadcd3dcad358548a&number=20"; 
	$crl = curl_init($url);
	curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);

	$res = curl_exec($crl);
	//Check for errors
	if(curl_errno($crl)){
		error_message($curl_error($crl));
	}

	curl_close($crl);

	$res_parsed = json_decode($res);
	

	if($res_parsed->status === "failure"){
		$error = $res_parsed->message;
	}
	//var_dump($res_parsed->results[0]->id);
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
		<section id="recipe-results" class="card-grid" style="display: flex; gap: 20px; flex-wrap: wrap; padding: 20px">

			<?php 
				if($error){
					echo "<p>There was an error: $error</p>";
				}
				else{
					if(count($res_parsed->results) > 0){
						foreach($res_parsed->results as $object){
							echo "<div id=$object->id class='food-item'>";
							echo "<img src='" . $object->image . "'>";
							echo "<p>" . $object->title . "</p>";
							echo "</div>";
						}
				}
			
				else{
					echo "<h1>No results found</h1>";
				}
				}
				
			?>
		</section>
	</main>
	<script src="assets/js/recipes.js"></script>
</body>
</html>