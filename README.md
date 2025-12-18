# Gather & Savor

Gather & Savor is a full-stack web application designed to help discover recipes, plan meals, manage favorites, and automatically generate a shopping list based on selected recipes. The platform provides an intuitive and user-friendly experience for organizing cooking and meal planning in one place.

---

## Features

- User authentication (login and registration)
- Recipe browsing using the Spoonacular API
- Save and manage favorite recipes
- Meal planning by day
- Auto-generated shopping list based on selected recipes
- Interactive shopping list with checkbox functionality
- Toast notifications for user feedback

---

## Technologies Used

### Frontend

- HTML5
- CSS3
- Javascript (Vanilla JS)

### Backend

- PHP
- MySQL
- PDO (PHP Data Objects)

### APIs
- Spoonacular Recipe API

### Tools

 - XAMPP
 - phpMyAdmin

 ## Database Schema

 The application uses a MySQL database named `gather_savor` with the following tables:

 - `users` - stores user account information
 - `favorites` - stores users' favorite recipes
 - `meal_plans` - stores planned meals by day
 - `shopping_lists` - stores recipes added to a user's shopping list
 - `ingredients` - stores individual ingredients for recipes in a user's shopping list

 Each table is designed to support user-specific data and core application functionality.

 ## Database User & Security

  A dedicated MySQL user account is created specifically for this application instead of using the root account.
  This user is granted only the necessary privileges (`SELECT`, `INSERT`, `UPDATE`, `DELETE`) on the `gather_savor` database.

  This approach follows database security best practices and ensures that the application does not rely on the root user for database access.