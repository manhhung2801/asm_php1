<?php
include("../../config/database.php");
    
    // Insert table Categories

    function addCategories($cate_small_description, $cate_code_type, $cate_title, $cate_description, $cate_image, $cate_status) {
        global $conn;
        $sql = "INSERT INTO categories(cate_small_description, cate_code_type, cate_title, cate_description, cate_image, cate_status) 
                VALUES('$cate_small_description', '$cate_code_type', '$cate_title', '$cate_description', '$cate_image', '$cate_status')";
        return $sql_run = mysqli_query($conn, $sql);
    }

    // Read  
    function selectCategories() {
        global $conn;
        $sql = "SELECT * FROM categories";
        return $sql_run = mysqli_query($conn, $sql);
    }

    // Update
    function updateCategories($cate_small_description, $cate_code_type, $cate_title, $cate_description, $cate_image, $cate_status, $update_id) {
        global $conn;
        $sql = "UPDATE categories SET cate_small_description='$cate_small_description', cate_code_type='$cate_code_type', cate_title='$cate_title', cate_description='$cate_description', cate_image='$cate_image', cate_status='$cate_status' WHERE cate_id='$update_id' ";
        return $sql_run = mysqli_query($conn, $sql);
    }

    // Delete
    function deleteCategories($cate_id) {
        global $conn;
        $sql = "DELETE FROM categories WHERE cate_id='$cate_id' ";
        return $sql_run = mysqli_query($conn, $sql);
    }


    // get by id search catagory
    function getById($id) {
        global $conn;
        global $id;
        $sql = "SELECT * FROM categories WHERE cate_id='$id' ";
        return $sql_run = mysqli_query($conn, $sql);
    }

?>

