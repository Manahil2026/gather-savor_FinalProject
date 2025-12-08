<?php
require_once __DIR__ . '/php/auth/checkSession.php'; // Include the session check to make sure user is logged in.
$meal_plan = require __DIR__ . '/php/recipes/loadMealPlan.php'; //Load meal plan data
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/header.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/planner.css">
	<script defer src="meal-planner.js"></script>
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
			<?php 
				$days = [
					'monday' => 'Monday',
					'tuesday' => 'Tuesday',
					'wednesday' => 'Wednesday',
					'thursday' => 'Thursday',
					'friday' => 'Friday',
					'saturday' => 'Saturday',
					'sunday' => 'Sunday'
				];

				foreach($days as $key => $label): 
					$recipeId = $meal_plan[$key] ?? null;
			
			?>

			<div class = 'day-column'>
				<h2><?= $label ?></h2>

				<div class = "day-slot"
					data-day="<?= $key ?>"
					data-recipe-id="<?= $recipeId ? htmlspecialchars($recipeId) : '' ?>"
				>

					<?php if($recipeId): ?>
						<!-- Placeholder until API loads via JS -->
						<p class = "loading-text">Loading recipes...</p>
					<?php else: ?>
						<p class="placeholder-text">No recipe assigned.</p>
					<?php endif; ?>

				</div>
			</div>

			<?php endforeach; ?>


		</section>
		
	</main>
</body>
</html>
	
