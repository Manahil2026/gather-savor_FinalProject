<?php
function error_message($msg){
    $res = json_encode([
        "status" => "error",
        "message" => $msg
    ]);
    echo $res;
}

function success_message($msg){
    $res = json_encode([
        "status" => "success",
        "message" => $msg
    ]);
    echo $res;
}
?>