<?php
session_start();
function redirect($url, $message){
    $_SESSION["message"] = $message;
    header("Location: " . $url);
    exit(0);
}

function redirect1($url, $successfullly){
    $_SESSION["successfullly"] = $successfullly;
    header("Location: " . $url);
    exit(0);
}


?>