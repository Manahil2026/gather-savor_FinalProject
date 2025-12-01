<?php
session_start(); // Start a new session or resume existing one

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name             = trim($_POST['name'] ?? '');
    $email            = trim($_POST['email'] ?? '');
    $password         = $_POST['password'] ?? '');
    $confirm_password = $_POST['confirm_password'] ?? '');

    // Basic validation
    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required.";

    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid email is required.";

    }

    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";

    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match.";

    }

    if (empty($errors)) {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=your_db_name', 'your_db_user', 'your_db_pass');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Check if email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);

            if ($stmt->fetch()) {
                $errors[] = "Email already registered. <a href='Login.php'>Login instead?</a>";

            }
        } catch (PDOException $e) {
            $errors[] = "Database error. Please try again.";
        }

    }

    if (empty($errors)) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare(
                "INSERT INTO users (name, email, password, created_at) VALUES(?, ?, ?, NOW())");
                
                $stmt-> execute([$name, $email, $hash_password]);

                $_SESSION['success'] = "Account created successfully! Redirecting..."
                $_SESSION['user_id'] = $pdo->lastInsert();
                $_SESSION['username'] = $name;

                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'Home.php';
                        }, 1000);
                    </script>";
        } catch (PDOException $e) {
            $errors[] = "Registration failed. Please try again.";
        }
    }

    if (!empty($errors)) {
        $_SESSION['error'] = implode('<br>', $errors);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gather &amp; Savor | Register</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav class="main-nav">
                <div class="logo">
                    <a href="index_splash.html">Gather &amp; Savor</a>
                </div>
                <ul class="new-links">
                    <li><a href="index_splash.html">Home</a></li>
                    <li><a href="Recipes.php">Recipes</a></li>
                    <li><a href="meal-planner.php">Meal Planner</a></li>
                    <li><a href="favorites.php">Favorites</a></li>
                    <li><a href="Shopping-list.php">Shopping List</a></li>
                    <li><a href="Login.php">Login</a></li>
                    <li><a href="Register.php">Register</a></li>
                </ul>
            </nav>
        </header>

        <main class="page-container auth-page">
            <section class="auth-card">
                <h1>Create Your Account</h1>
                <p>Join thousands of home cooks planning smarter meals.</p>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert error">
                        <?= $_SESSION['error']; unset[$_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert success">
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form id="register-form" method="post" novalidate>
                    <div class="form-group">
                        <label for="reg-name">Full Name</label>
                        <input type="text" id="reg-name" name="name"
                            value="<?= htmlspecialchars($_POST['name'] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="reg-email">Email Address</label>
                        <input type="email" id="reg-name" name="email"
                            value="<?= htmlspecialchars($_POST['email'] ?? ''); ?>" required>
                    </div>

                    <div class="form-group">
                        <label for="reg-password">Password (min 6 chars)</label>
                        <input type="password" id="reg-password" name="password" required>
                    </div>

                    <div class="form-group">
                        <label for="reg-confirm">Confirm Password</label>
                        <input type="password" id="reg-confirm" name="confirm_password" required>
                    </div>

                    <button type="submit" class="btn primary-btn">Create Account</button>
                </form>

                <p class="auth-switch">
                    Already have an account? <a href="Login.php">Login here</a>
                </p>
            </section>
        </main>

        <script>
            document.getElementById('register-form').addEventListener('submit', function (e) {
                const password = document.getElementById('reg-password').value;
                const confirm = document.getElementById('reg-confirm').value;

                if (password !== confirm) {
                    e.preventDefault();
                    alert('Passwords do not match!');
                } else if (password.length < 6) {
                    e.preventDefault();
                    alert('Password must be at least 6 characters.');
                }

            });
        </script>
    </body>
</html>
