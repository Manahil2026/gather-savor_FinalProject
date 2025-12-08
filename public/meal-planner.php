<?php
require_once __DIR__ . '/../src/auth/checkSession.php'; // Include the session check to make sure user is logged in.
require_once __DIR__ . '/../src/messages.php';


if($_SERVER['REQUEST_METHOD'] === "POST"){
	if(!isset($_POST['action'])){
		error_message("Action not set");
		exit;
	}


	$action = $_POST['action'];
	switch($action){
		
		case "get-mealplan":
			require_once __DIR__ . "/../src/recipes/loadMealPlan.php";
			break;
		
		case "delete-recipe":
			require_once __DIR__ . "/../src/recipes/removeMealPlan.php";
			break;
		default: 
		
		
		error_message("Action not valid");
		exit;
	}
}

$meal_plan;
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gather & Savor | Meal Planner</title>
	<link rel="stylesheet" href="assets/css/toast.css">
	<link rel="stylesheet" href="assets/css/header.css">
  	<link rel="stylesheet" href="assets/css/style.css">

</head>
<body>
	<div class="toast">
		<p>Successfully removed! </p>
	</div>
	<header>
		<nav class="main-nav">
			<div class="logo">
				<a href="Home.php">Gather & Savor</a>
			</div>
			<ul class="nav-links">
				<li><a href="home.php">Home</a></li>
				<li><a href="recipes.php">Recipes</a></li>
				<li><a href="meal-planner.php" class="active">Meal Planner</a></li>
				<li><a href="favorites.php">Favorites</a></li>
				<li><a href="shopping-list.php">Shopping List</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</nav>
	</header>

	<main class="page-container">
		<section class="page-header">
			<h1>Weekly Meal Planner</h1>
			<p>Assign recipes to each day of the week.</p>
		</section>

		<section class="meal-planner-grid">
			
			<div id="monday" class="day-column">
				<h2>Monday</h2>
				<div class="day-slot">
					<ul class="plan-list">

					</ul>
				</div>
			</div>
			

			<div id="tuesday" class="day-column">
				<h2>Tuesday</h2>
				<div class="day-slot">
					<ul class="plan-list">
						
					</ul>
				</div>
			</div>


			<div id="wednesday" class="day-column">
				<h2>Wednesday</h2>
				<div class="day-slot">
					<ul class="plan-list">

					</ul>
				</div>
			</div>

			<div id="thursday" class="day-column">
				<h2>Thursday</h2>
				<div class="day-slot">
					<ul class="plan-list">

					</ul>
				</div>
			</div>

			<div id="friday" class="day-column">
				<h2>Friday</h2>
				<div class="day-slot">
					<ul class="plan-list">

					</ul>
				</div>
			</div>
			
			<div id="saturday" class="day-column">
				<h2>Saturday</h2>
				<div class="day-slot">
					<ul class="plan-list">

					</ul>
				</div>
			</div>

			<div id="sunday" class="day-column">
				<h2>Sunday</h2>
				<div class="day-slot">
					<ul class="plan-list">

					</ul>
				</div>
			</div>


		</section>
		
	</main>
	<script src="assets/js/mealPlanner.js"></script>
</body>
</html>
	
