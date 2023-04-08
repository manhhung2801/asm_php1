<?php
session_start();

    if(isset($_SESSION["auth"])) {
        session_destroy();
        unset($_SESSION["auth"]);
        unset($_SESSION["admin_info"]);
        $_SESSION["message"] = "Logged Out Successfully";
    }
    header('Location: http://localhost/project_asm/admin/view/login.php');

?>