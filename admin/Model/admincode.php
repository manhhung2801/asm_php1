<?php
include("../../config/database.php");

    // Create account admin
    function addAdmin($adminFullname, $adminEmail, $adminPhone, $adminPassword) {
        global $conn;
        $sql = "INSERT INTO admin(admin_fullname, admin_email, admin_phone, admin_password) 
                VALUES('$adminFullname', '$adminEmail', '$adminPhone', '$adminPassword')";
        return $sql_run = mysqli_query($conn, $sql);
    }

    // Login account admin
    function loginAdmin($adminEmail, $adminPassword) {
        global $conn;
         $sql = " SELECT * FROM admin WHERE admin_email='$adminEmail' AND admin_password ='$adminPassword' "; 
        return $sql_run = mysqli_query($conn, $sql);
    }

    // select admin
    function selectAdmin() {
        global $conn;
         $sql = " SELECT * FROM admin "; 
        return $sql_run = mysqli_query($conn, $sql);
    }


    // update account type
    function updateAccountType($ad_id, $action){
        global $conn;

        $sql = "UPDATE admin 
        SET 
        admin_account_type='$action'
        WHERE admin_id='$ad_id' "; 
        
        return $sql_run = mysqli_query($conn, $sql);
    }
?>