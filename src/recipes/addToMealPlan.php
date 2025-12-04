<?php 

//session and the check auth is already done in the recipe-details page
function redirect_with_msg($url, $msg_key, $msg_value){ // This function will redirect the user to a specified URL with a message stored in the session
    $_SESSION[$msg_key] = $msg_value;
    header("Location: $url");
    exit;
}


function addMealPlan(){
    require_once __DIR__ . '/../db.php'; //Include db connection file
    $user_id = $_SESSION['user_id']; //Get user id from session
    $recipe_id = $_POST['recipe_id']; // Get recipe id from the post request
    $day = $_POST['day']; // Get day from the post request

    // Make sure that the day sent in the post request is valid
    $validDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
    if (!in_array($day, $validDays)){

        //return back with errors
        redirect_with_msg('recipe-details.php', 'error', 'Server error: ' . "Invalid day");
    }

    try {
        $stmt = $conn->prepare("SELECT id FROM meal_plans_updated WHEREddd user_id = ?"); // change to prepared statement. vulnerable to SQL injection 
        $stmt->execute([$user_id]);

        //ABOUT THE SCHEMA
        /*
        Changed to this:

        MariaDB [gather_savor]> describe meal_plans_updated;
        +------------+--------------+------+-----+---------+-------+
        | Field      | Type         | Null | Key | Default | Extra |
        +------------+--------------+------+-----+---------+-------+
        | id         | int(11)      | YES  |     | NULL    |       | <--- need to make it unique auto incrememnt don't allow the same
        | user_id    | int(11)      | YES  |     | NULL    |       |
        | day        | varchar(255) | YES  |     | NULL    |       |
        | link       | varchar(255) | YES  |     | NULL    |       |
        | updated_at | timestamp    | YES  |     | NULL    |       |
        +------------+--------------+------+-----+---------+-------+
        */

        //Update the selected day with recipe_id
        $stmt = $conn->prepare("insert into meal_plans_updated (id, user_id, day, link, updated_at) values (2, ? , ?, ?, '2025-12-03 17:45:00')"); // vulnerable to sql injection
        $stmt->execute([$user_id,$day,$recipe_id]);

        //Redirect back to meal planner page
        header("Location: recipe-details.php");
        
        //add success message


        //todo: instead of just changing the page send back json responses for a true api backend.


    }catch(PDOException $e){
         redirect_with_msg('recipe-details.php', 'error', 'Server error: ' . $e->getMessage());
    };


    exit;
}

addMealPlan();
?>