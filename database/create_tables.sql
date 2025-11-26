CREATE DATABASE IF NOT EXISTS gather_savor;
USE gather_savor;

-- Users Table (Stores user information for authentication and profiles)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY, --Auto-increment means that this value will be generated automatically for each new record
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    pssword VARCHAR(255) NOT NULL, --password is a reserved keyword in SQL, so we use pssword instead
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Records the time when the user was created
);