CREATE DATABASE IF NOT EXISTS gather_savor_main;
USE gather_savor_main;

-- Users Table (Stores user information for authentication and profiles)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Auto-increment means that this value will be generated automatically for each new record
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    pssword VARCHAR(255) NOT NULL, -- password is a reserved keyword in SQL, so we use pssword instead
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Records the time when the user was created
);

-- Favorites Table (Stores user favorite recipes)
CREATE TABLE IF NOT EXISTS favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id VARCHAR(50) NOT NULL,
    recipe_title VARCHAR(255) NOT NULL,
    recipe_image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY unique_favorite (user_id, recipe_id), -- This will make sure that the same recipe is not duplicated in the user favorites
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE -- If a user is deleted, their favorites are also deleted
);

-- Meal plans tavle
CREATE TABLE IF NOT EXISTS meal_plans(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    monday VARCHAR(50),
    tuesday VARCHAR(50),
    wednesday VARCHAR(50),
    thursday VARCHAR(50),
    friday VARCHAR(50),
    saturday VARCHAR(50),
    sunday VARCHAR(50),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, -- This updates the timestamp whenever the meal plan is updated
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Shopping Lists Table
CREATE TABLE IF NOT EXISTS shopping_lists(
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    recipe_id VARCHAR(50) NOT NULL,
    ingredient VARCHAR(255) NOT NULL,
    quantity VARCHAR(100),
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
