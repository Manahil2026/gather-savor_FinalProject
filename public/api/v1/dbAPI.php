<?php
    require_once __DIR__ . "/../../../src/db.php"; //defines $conn
 

    //This file sends requests to the database so that I can get things like favorites etc. and it returns json data.
    //Need the table in the request, and the id, if the id is null it will return everything


    // If session does not have user id reject
    session_start(); // Start anew session or resume existing one
    if(!isset($_SESSION['user_id'])){
        echo json_encode([
            "status" => "error",
            "message" => "unauthenticated",
            ]);
        exit;
    }
    
    $raw = file_get_contents("php://input");
    $req = json_decode($raw, true);

    function saveToDatabase($table, $values, $conn){
        //todo: for each case check to make sure that none of the values being added are null. error if null.

        $res = "";
        switch($table){
            case "favorites":
                    $stmt = $conn->prepare("insert into favorites_updated (user_id, link) values (:user_id, :link)");
                    $stmt->execute([
                        'user_id' => $_SESSION['user_id'],
                        'link' => $values['link']
            
                    ]); 
                    $res = json_encode([
                        "status" => "success",
                        "message" => "Successfully added favorite"
                    ]);
                break;

            case "meal-plan":
                $day = $values['day'];
                $link = $values['link'];  

                if($day === "" || $link === ""){
                    $res = json_encode([
                        "status" => "error",
                        "message" => "Invalid request"
                    ]);
                    break;
                }

                    $stmt = $conn->prepare("insert into meal_plans_updated (user_id, day, link) values (:user_id, :day :link)");
                    $stmt->execute([
                        'user_id' => $user_id,
                        'day' => $values['day'],
                        'link' => $values['link']
                    ]); 
                    
                    $res = json_encode([
                        "status" => "success",
                        "message" => "Successfully added to meal plan"
                    ]);
                break;

            case "shopping-list":
                //values needed

                $link = $values['link'];
                $ingredient = $values['ingredient'];
                $quantity = $values['quantity'];


                //if values not set
                if($link === "" || $ingredient === "" || $quantity === ""){
                    $res = json_encode([
                        "status" => "error",
                        "message" => "Insufficient values"
                    ]);
                    break;
                }

                //Check if the ingredient is already there
                $stmt = $conn->prepare("select * from shopping_lists where ingredient = :ingredient");
                $stmt->execute([
                    'ingredient' => $values['ingredient']
                ]);
                $row = $stmt->fetch(PDO::FETCH_ASSOC);


                //If it is add to the quantity, no need to create a new one
                if($row){
                    $oldQuantity = $row['quantity'];
                    $newQuantity = $oldQuantity + $quantity;

                    $stmt = $conn->prepare("update shopping_lists set quantity = :newQuantity");
                    $stmt->execute([
                        "newQuantity" => $newQuantity
                    ]);
                }
                else{
                    $stmt = $conn->prepare("insert into shopping_lists (link, ingredient, quantity) values (:link, :ingredient, :quantity");
                    $stmt->execute([
                        "link" => $link,
                        "ingredient" => $ingredient,
                        "quantity" => $quantity
                    ]);
                }
                $res = json_encode([
                    "status" => "success",
                    "message" => "The ingredient was added successfully"
                ]);
                break;

            default:
                $res = json_encode([
                    "status" => "error",
                    "message" => "Invalid request"
                ]);

                break;
        }

        echo $res;
    }


    function removeFromDatabase($table, $id, $conn){
        $res = "";
        if($id === ""){
            $res = json_encode([
                "status" => "error",
                "message" => "Invalid request"
            ]);
            echo $res;
            die();
        }
           

        $validTables = array("favorites_updated","shopping_lists,meal_plans_updated");
        if(!in_array($table, $validTables)){
            $res = json_encode([
                "status" => "error",
                "message" => "Invalid request"
            ]);
            echo $res;
            die();
        }

        $stmt = $conn->prepare("delete from :table where id=:id");
        $stmt->execute([
            "table" => $table,
            "id" => $id
        ]);

        $res = json_encode([
            "status" => "success",
            "message" => "successfully deleted"
        ]);

        echo $res;

    }

    function getFromDatabase($table, $id, $conn){
        $res = "";
        if($id === ""){
            $res = json_encode([
                "status" => "error",
                "message" => "Invalid request"
            ]);
            echo $res;
            die();
        }


        $validTables = array("favorites_updated","shopping_lists,meal_plans_updated");
        if(!in_array($table, $validTables)){
            $res = json_encode([
                "status" => "error",
                "message" => "Invalid request"
            ]);
            echo $res;
            die();
        }

        $stmt = $conn->prepare("select * from $table where id=:id");
        $stmt->execute(["id" => $id]);
        
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $res = json_encode([
            "status" => "success",
            "message" => json_encode($data),
        ]);

        
        echo $res;
    }

    function processRequest($req, $conn){
        if(!$req['data']){
            $res = json_encode([
                "status" => "error",
                "message" => "Invalid requests"
            ]);
            echo $res;
            die();
        }

        
        
        $id = $req['data']['id'];
        $action = $req['data']['action'];
        $table = $req['data']['table'];

        $values = $req['data']['values'];
        
        try{
            switch($action){
            case "add":
                saveToDatabase($table, $values, $conn);
            break;

            case "delete":
                removeFromDatabase($table,$id, $conn);
                break;

            case "fetch":
                getFromDatabase($table, $id, $conn);
                break;

            default:
                $res = json_encode([
                    "status" => "error",
                    "message" => "Invalid requestadsf"
                ]);
                echo $res;
                break;
            }

        }
        catch (PDOException $e){
            $res = json_encode([
                "status" => "error",
                "message" => $e
            ]);
            echo $res;
        }

        
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        processRequest($req, $conn);
    }
    else{
        $res = json_encode([
                "status" => "error",
                "message" => "Invalid request"
            ]);
            echo $res;
    }
?>