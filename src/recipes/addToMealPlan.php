<?php 

//session and the check auth is already done in the recipe-details page
function redirect_with_msg($url, $msg_key, $msg_value){ // This function will redirect the user to a specified URL with a message stored in the session
    $_SESSION[$msg_key] = $msg_value;
    header("Location: $url");
    exit;
}



require_once __DIR__ . '/../db.php'; //Include db connection file
$user_id = $_SESSION['user_id']; //Get user id from session
$recipe_id = $_POST['recipe_id']; // Get recipe id from the post request
$day = $_POST['day']; // Get day from the post request

// Make sure that the day sent in the post request is valid
$validDays = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
if (!in_array($day, $validDays)){
    //return back with errors
    header("Location: http://localhost/recipe-details.php?msg=invalidday&recipe_id=$recipe_id");
}

try {
    //Update the selected day with recipe_id
    $stmt = $conn->prepare("insert into meal_plans (user_id,recipe_id, day) values (?,?,?)");
    $stmt->execute([$user_id,$recipe_id,$day]);
    header("Location: recipe-details.php?recipe_id=$recipe_id");
    //Redirect back to meal planner page
 

}catch(PDOException $e){
        header("Location: http://localhost/recipe-details.php?msg=$e&recipe_id=$recipe_id");
};



?>