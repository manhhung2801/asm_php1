<?php
include("../../functions/myfunctions.php");
include("../../config/database.php");
include("../Model/productscode.php");


// Add Product
if(isset($_POST["add_product"])){

    // Nối chuyển đẩy lên cùng 
    $cate_id_and_prod_code_type = $_POST["cate_id_and_prod_code_type"];

    // chuyển một chuyển thành một mảng ngăn cách bằng ký tự
    $arr = explode("-", $cate_id_and_prod_code_type);

    // lấy giá trị của mảng vị trí 0 
    $prod_cate_id = $arr[0];

    $prod_title = mysqli_real_escape_string($conn, $_POST["prod_title"]);

    // lấy giá trị của mảng vị trí 1
    $prod_code_type = $arr[1];

    $prod_small_description = mysqli_real_escape_string($conn, $_POST["prod_small_description"]);
    $prod_original_price = mysqli_real_escape_string($conn, $_POST["prod_original_price"]);
    $prod_selling_price = mysqli_real_escape_string($conn, $_POST["prod_selling_price"]);
    // image
    $prod_image = $_FILES["prod_image"]["name"];

    // vị trí folder lưu trữ
    $path = "../../public/uploads";

    $image_ext = pathinfo($prod_image, PATHINFO_EXTENSION); // Nhận thông tin về đường dẩn tận vd: .png

    $filename = time().'.'.$image_ext;  // trả về thời gian hiện tại dưới dang Unix nối chuổi $image_ext .png khởi tạo một tên file mới


    $prod_quantity = mysqli_real_escape_string($conn, $_POST["prod_quantity"]);
    $prod_trending = mysqli_real_escape_string($conn, $_POST["prod_trending"]);
    $prod_status = mysqli_real_escape_string($conn, $_POST["prod_status"]);
    $prod_description = mysqli_real_escape_string($conn, $_POST["prod_description"]);

    if(empty($prod_cate_id) || empty($prod_title) || empty($prod_code_type) || empty($prod_small_description) || empty($prod_original_price) ||  empty($prod_selling_price) ||  empty($prod_image) ||  empty($prod_quantity) ||  !isset($prod_trending) ||  !isset($prod_status) ||  empty($prod_description)) {
            redirect("http://localhost/project_asm/admin/view/add-products.php", "Thêm Product thất bại");
            //var_dump($prod_cate_id, $prod_title, $prod_code_type, $prod_small_description, $prod_original_price, $prod_selling_price, $prod_image, $prod_quantity, $prod_trending, $prod_status, $prod_description);
    }else {
        $addProductNew = addProduct($prod_cate_id, $prod_title, $prod_code_type, $prod_small_description, $prod_original_price, $prod_selling_price, $filename, $prod_quantity, $prod_trending, $prod_status, $prod_description);
        if($addProductNew) {
            move_uploaded_file($_FILES["prod_image"]["tmp_name"], $path.'/'.$filename); // move_uploaded_file(chỉ định vị trí tệp tải tên, đường dẩn đến vị trí lưu / tên mới của file);
            redirect1("http://localhost/project_asm/admin/view/add-products.php", "Thêm Product thành công");
        }
    }

}

// Update Product
if(isset($_POST["update_product"])){

    // lấy prod_id để xác định đối tượng cần update 
    $prod_id = mysqli_real_escape_string($conn, $_POST["prod_id"]);

    // nếu cate_id_and_prod_code_type chưa được khai báo hay bằng null gán cate_id_and_prod_code_type = old_cate_id_and_prod_code_type
    $cate_id_and_prod_code_type = $_POST["cate_id_and_prod_code_type"];
    if(empty($Ncate_id_and_prod_code_type)){
         // Nối chuyển đẩy lên cùng 
        $cate_id_and_prod_code_type = $_POST["old_cate_id_and_prod_code_type"];
        // chuyển một chuyển thành một mảng ngăn cách bằng ký tự
        $arr = explode("-", $cate_id_and_prod_code_type);
    }else {
        $arr = explode("-", $cate_id_and_prod_code_type);
    }
    

    // lấy giá trị của mảng vị trí 0 
    $prod_cate_id = $arr[0];

    $prod_title = mysqli_real_escape_string($conn, $_POST["prod_title"]);

    // lấy giá trị của mảng vị trí 1
    $prod_code_type = $arr[1];

    $prod_small_description = mysqli_real_escape_string($conn, $_POST["prod_small_description"]);
    $prod_original_price = mysqli_real_escape_string($conn, $_POST["prod_original_price"]);
    $prod_selling_price = mysqli_real_escape_string($conn, $_POST["prod_selling_price"]);


    // vị trí folder lưu trữ
    $path = "../../public/uploads";
    
    // image
    // ảnh mới
    $prod_image = $_FILES["prod_image"]["name"];
    // ảnh củ
    $old_prod_image = $_POST["old_prod_image"];
    // kiểm tra hình ảnh có được tải mới lên không nếu không được tải mới dùng phương thức gán cho giá trị củ của ảnh
    if(empty($prod_image)){
        $filename = $old_prod_image;
    }

    if(!empty($prod_image)){
        $image_ext = pathinfo($prod_image, PATHINFO_EXTENSION); // Nhận thông tin về đường dẩn tận vd: .png

        $filename = time().'.'.$image_ext;  // trả về thời gian hiện tại dưới dang Unix nối chuổi $image_ext .png khởi tạo một tên file mới    
    }

    
    $prod_quantity = mysqli_real_escape_string($conn, $_POST["prod_quantity"]);
        
    // kiểm tra điều kiện
    $new_prod_trending = mysqli_real_escape_string($conn, $_POST["prod_trending"]);
    $old_prod_trending = mysqli_real_escape_string($conn, $_POST["old_prod_trending"]);
    $prod_trending;
    if($new_prod_trending != 0 || $new_prod_trending != 1){
        $prod_trending = $old_prod_trending;
    }

    // kiểm tra điều kiện
    $new_prod_status = mysqli_real_escape_string($conn, $_POST["prod_status"]);
    $old_prod_status = mysqli_real_escape_string($conn, $_POST["old_prod_status"]);
    $prod_status;
    if($new_prod_status != 0 || $new_prod_status != 1){
        $prod_status = $old_prod_status;
    }


    $prod_description = mysqli_real_escape_string($conn, $_POST["prod_description"]);

    // var_dump($prod_id. $prod_cate_id, $prod_title, $prod_code_type, $prod_small_description, $prod_original_price, $prod_selling_price, $filename, $prod_quantity, $prod_trending, $prod_status, $prod_description);


    if(empty($prod_id) || empty($prod_cate_id) || empty($prod_title) || empty($prod_code_type) || empty($prod_small_description) || empty($prod_original_price) ||  empty($prod_selling_price) ||  empty($filename) ||  empty($prod_quantity) ||  !isset($prod_trending) ||  !isset($prod_status) ||  empty($prod_description)) {
            redirect("http://localhost/project_asm/admin/view/update-products.php?getId=$prod_id", "Update Product thất bại");

            //var_export($prod_id, $prod_cate_id, $prod_title, $prod_code_type, $prod_small_description, $prod_original_price, $prod_selling_price, $filename, $prod_quantity, $prod_trending, $prod_status, $prod_description);
            
    }else {
        $updateProduct_run = updateProduct($prod_id, $prod_cate_id, $prod_title, $prod_code_type, $prod_small_description, $prod_original_price, $prod_selling_price, $filename, $prod_quantity, $prod_trending, $prod_status, $prod_description);
        if($updateProduct_run) {
            if(!empty($filename)){
                if(file_exists("../../public/uploads/".$old_prod_image)) {
                    unlink("../../public/uploads/".$old_prod_image);
                    move_uploaded_file($_FILES["prod_image"]["tmp_name"], $path.'/'.$filename); // move_uploaded_file(chỉ định vị trí tệp tải tên, đường dẩn đến vị trí lưu / tên mới của file);
                }
                redirect1("http://localhost/project_asm/admin/view/update-products.php?getId=$prod_id", "Update Product thành công");
            }
        }
    }

}

 // Delete Product id
if(isset($_GET["prodId"])){
    $prodId = $_GET["prodId"];
    $prodImg = $_GET["prodImg"];

    $path = "../../public/uploads/$prodImg";
    
    $deleteProd = deleteProduct($prodId);
    if($deleteProd) {
        if(file_exists($path)){
            unlink($path);      
        }
        redirect1("http://localhost/project_asm/admin/view/products.php", "Delete product thành công");
    }
}


?>