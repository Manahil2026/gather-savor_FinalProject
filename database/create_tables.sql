-- Replaced my(Manahil) db code with the edits that Anthony made to match his naming conventions and added fields

CREATE DATABASE IF NOT EXISTS gather_savor;
USE gather_savor;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    pssword VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Favorites table
CREATE TABLE IF NOT EXISTS favorites (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    recipe_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Meal plans table
CREATE TABLE IF NOT EXISTS meal_plans (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    recipe_id INT,
    day VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    recipe_title VARCHAR(255)
);

-- Shopping lists table
create table if not existsshopping_lists( id int primary key auto_increment, 
    user_id int, 
    recipe_id int, 
    created_at timestamp default current_timestamp);

-- Ingredients table
create table if not exists ingredients( id int primary key auto_increment, 
    user_id int, 
    recipe_id int, 
    ingredient varchar(255), 
    created_at timestamp default current_timestamp);