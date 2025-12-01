<?php
require_once = __DIR__ . '/php/auth/checkSession.php'); // Include the session check to make sure user is logged in.

// Database connection (adjust to your config)
try {
    $pdo = new PDO('mysql:host=localhost;dbname=your_db_name', 'your_db_user', 'your_db_pass');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $userId = $_SESSION['user_id'] ?? null;
    if (!$userId) {
        header('Location: Login.php');
        exit;
    }

    // Fetch user stats - Fixed SQL syntax for MySQL
    $stmt = $pdo->prepare("
          SELECT
                COALESCE((SELECT COUNT(*) FROM favorites WHERE user_id = ?), 0) as
          favorites_count,
                      COALESCE((SELECT COUNT(*) FROM meal_plans WHERE user_id = ? AND 
          week_start >= CURDATE() - INTERVAL 7 DAY), 0) as active_plans
            ");
            $stmt->execute([$userId, $userId]);
            $userStats = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $userStats = ['favorites_count' => 0, 'active_plans' => 0];
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gather &amp; Savor | Home</title>
    <link rel="stylesheet" href="style.css" />
    <script defer src="app.js"></script>
  </head>
  <body>
    <header>
      <nav class="main-nav">
        <div class="logo">
          <a href="Home.php">Gather &amp; Savor</a>
        </div>
        <ul class="nav-links">
          <li><a href="Home.php" class="active">Home</a></li>
          <li><a href="Recipes.php">Recipes</a></li>
          <li><a href="meal-planner.php">Meal Planner</a></li>
          <li><a href="favorites.php">Favorites</a></li>
          <li><a href="Shopping-list.php">Shopping List</a></li>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
    </header>

    <main class="page-container">
      <section class="hero">
        <h1>Welcome back, <?php echo htmlspecialchars($_SESSION['username'] ?? 'Chef'); ?>!</h1>
        <p>
          You have <?php echo $userStats['favorites_count']; ?> favorite recipes
          and <?php echo $userStats['active_plans']; ?> active meal plans.
        </p>
        <a class="btn primary-btn" href="Recipes.php">Explore Recipes</a>
      </section>

      <section class="home-grid">
        <article class="home-card">
          <h2>Weekly Meal Planner</h2>
          <p>Drag and drop or assign recipes to each day of the week.</p>
          <a href="meal-planner.php" class="link">
            Open Meal Planner (<?php echo $userStats['active_plans']; ?> active)</a>
        </article>

        <article class="home-card">
          <h2><?php echo $userStats['favorites_count']; ?> Favorites</h2>
          <p>Save your go-to recipes and a access them quickly.</p>
          <a href="favorites.php" class="link">View Favorites</a>
        </article>

        <article class="home-card">
          <h2>Shopping List</h2>
          <p>Automatically build a grocery list based on your selected recipes.</p>
          <a href="Shopping-list.php" class="link">View Shopping List</a>
        </article>
      </section>

      <section class="stats-grid">
        <article class="home-card">
          <h2><?php echo $userStats['favorites_count']; ?> Recipes Saved</h2>
          <p>Your favorite recipes collection.</p>
          <a href="favorites.php" class="link">Manage Favorites</a>
        </article>
        <article class="home-card">
          <h2>Quick Actions</h2>
          <p>Jump right into planning your next males.</p>
          <a href="meal-planner.php" class="link">Start Planning</a>
        </article>
      </section>
    </main>
  </body>
</html>
