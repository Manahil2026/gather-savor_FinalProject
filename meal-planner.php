<?php
require_once __DIR__ . '/php/auth/checkSession.php'; // Include the session check to make sure user is logged in.
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gather & Savor | Meal Planner</title>
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
				<li><a href="meal-planner.php" class="active">Meal Planner</a></li>
				<li><a href="favorites.php">Favorites</a></li>
				<li><a href="Shopping-list.php">Shopping List</a></li>
				<li><a href="Login.php">Login</a></li>
				<li><a href="Register.php">Register</a></li>
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
			<div class="day-column">
				<h2>Monday</h2>
				<div class="day-slot" id="monday-slot">
					<p class="placeholder-text">No recipe assigned.</p>
				</div>
			</div>
			<div class="day-column">
				<h2>Tuesday</h2>
				<div class="day-slot" id="tuesday-slot">
					<p class="placeholder-text">No recipe assigned.</p>
				</div>
			</div>
			<div class="day-column">
				<h2>Wednesday</h2>
				<div class="day-slot" id="wednesday-slot">
					<p class="placeholder-text">No recipe assigned.</p>
				</div>
			</div>
			<div class="day-column">
				<h2>Thursday</h2>
				<div class="day-slot" id="thursday-slot">
					<p class="placeholder-text">No recipe assigned.</p>
				</div>
			</div>
			<div class="day-column">
				<h2>Friday</h2>
				<div class="day-slot" id="friday-slot">
					<p class="placeholder-text">No recipe assigned.</p>
				</div>
			</div>
			<div class="day-column">
				<h2>Saturday</h2>
				<div class="day-slot" id="saturday-slot">
					<p class="placeholder-text">No recipe assigned.</p>
				</div>
			</div>
			<div class="day-column">
				<h2>Sunday</h2>
				<div class="day-slot" id="sunday-slot">
					<p class="placeholder-text">No recipe assigned.</p>
				</div>
			</div>
		</section>
	</main>
</body>
</html>
	
