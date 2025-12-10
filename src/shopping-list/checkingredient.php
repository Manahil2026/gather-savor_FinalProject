<?php
//grab the amount of the results

require_once __DIR__ . '/../db.php'; // include db connection file
require_once __DIR__ . '/../auth/checkSession.php'; // make sure user is logged in


try{



}
catch(PDOException $e){
    error_message($e);
}

?>