<?php
function redirectT($url, $message){
    $_SESSION["message"] = $message;
    header("Location: " . $url);
    exit(0);
}


if(isset($_SESSION["auth"]) === false) {
    if(isset($_SESSION["admin_info"]["account_type"]) !== "admin") {
        redirectT("http://localhost/project_asm/admin/view/login.php", "You are not authorized to access this page");
    }
}

if(isset($_SESSION["auth"]) === true) {
    if(isset($_SESSION["admin_info"]["account_type"]) === "admin") {
        redirectT("http://localhost/project_asm/admin/view/index.php", "Login Successfully");
    }
}




?>