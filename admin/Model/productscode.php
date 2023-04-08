<?php
include("../../config/database.php");

// select categories bởi vì categories là danh mục cha product là con chứ FK cate_id == prod_cate_id and cate_code_type == prod_code_type
function selectCategories() {
    global $conn;
    $sql = "SELECT * FROM categories";
    return $sql_run = mysqli_query($conn, $sql);
}

global $prId;
// kết hợp hai bảng để 
function innerJoinCategoriesAndProducts($pId){
    global $conn;
    $sql = "SELECT categories.cate_id, categories.cate_title, products.prod_code_type
    FROM products  INNER JOIN categories  on products.prod_category_id = categories.cate_id
    WHERE products.prod_id='$pId' ";
    return $sql_run = mysqli_query($conn, $sql);
}

// Insert products

function addProduct($prod_category_id, $prod_title, $prod_code_type, $prod_small_description, $prod_original_price, $prod_selling_price, $prod_image, $prod_quantity, $prod_trending, $prod_status, $prod_description) {
    global $conn;
    $sql = "INSERT INTO products(prod_category_id, prod_title, prod_code_type, prod_small_description, prod_original_price, prod_selling_price, prod_image, prod_quantity, prod_trending, prod_status, prod_description) 
            VALUES('$prod_category_id', '$prod_title', '$prod_code_type', '$prod_small_description', '$prod_original_price', '$prod_selling_price', '$prod_image', '$prod_quantity', '$prod_trending', '$prod_status', '$prod_description')";
    return $sql_run = mysqli_query($conn, $sql);
}


// Read products
function updateProduct($prod_id, $prod_category_id, $prod_title, $prod_code_type, $prod_small_description, $prod_original_price, $prod_selling_price, $prod_image, $prod_quantity, $prod_trending, $prod_status, $prod_description){
    global $conn;
    $sql = "UPDATE products 
    SET 
    prod_category_id='$prod_category_id', 
    prod_title='$prod_title', 
    prod_code_type='$prod_code_type', 
    prod_small_description='$prod_small_description', 
    prod_original_price='$prod_original_price', 
    prod_selling_price='$prod_selling_price', 
    prod_image='$prod_image', 
    prod_quantity='$prod_quantity', 
    prod_trending='$prod_trending', 
    prod_status='$prod_status', 
    prod_description='$prod_description'
    WHERE prod_id='$prod_id' ";
    return $sql_run = mysqli_query($conn, $sql);
}

function readProducts() {
    global $conn; 
    $sql = "SELECT * FROM products";
    return $sql_run = mysqli_query($conn, $sql);
}

// update product by Id

// select product by Id 
function getProductId($id){
    global $conn; 
    $sql = "SELECT * FROM products WHERE prod_id='$id' ";
    return $sql_run = mysqli_query($conn, $sql);
}

// Delete product Id
function deleteProduct($id){
    global $conn;
    $sql = "DELETE FROM products WHERE prod_id='$id' ";
    return $sql_run = mysqli_query($conn, $sql);
}



?>