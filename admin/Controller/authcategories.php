<?php
include("../../functions/myfunctions.php");
include("../../config/database.php");
include("../Model/categoriescode.php");

// Add crategory
if(isset($_POST["add_category"])){
    $cate_small_description = mysqli_real_escape_string($conn, $_POST["cate_small_description"]);
    $cate_code_type = mysqli_real_escape_string($conn, $_POST["cate_code_type"]);
    $cate_title = mysqli_real_escape_string($conn, $_POST["cate_title"]);
    $cate_description = mysqli_real_escape_string($conn, $_POST["cate_description"]);
    $image = $_FILES["cate_image"]["name"];
    $cate_status = $_POST["cate_status"];

    // Note : Enable permission on a folder to allow file upload.
    // Need to run the command chmod -Rf 777 FOLDER_PATH
    // FLODER_PATH is name = uploads

    $path = "../../public/uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    
    $filename = time().'.'.$image_ext; //Trả lại thời gian hiện tại dưới dạng dấu thời gian Unix



    // Check input ! empty
    if(empty($cate_small_description) || empty($cate_code_type) || empty($cate_title) || empty($cate_description) || empty($image)){
        redirect("http://localhost/project_asm/admin/view/add-categories.php", "Nhập đủ tất cả các thông tin trên");
    }else {
        $addCate = addCategories($cate_small_description, $cate_code_type, $cate_title, $cate_description, $filename, $cate_status);
        if($addCate) {
            move_uploaded_file($_FILES["cate_image"]["tmp_name"], $path .'/'.$filename);
            
            redirect1("http://localhost/project_asm/admin/view/add-categories.php", "Thêm Category thành công");
        }else {
            redirect("http://localhost/project_asm/admin/view/add-categories.php", "Thêm Category thất bại");
        }
    }
}

    // Read categories
    function readCate(){
        $selectCate = selectCategories();
        if($selectCate) {
            while($row = mysqli_fetch_assoc($selectCate)){
                ?>
                        <tr>
                            <td>
                                <?= $row["cate_id"] ?>
                            </td>
                            <td>
                                <?= $row["cate_small_description"] ?>
                            </td>
                            <td>
                                    <?= $row["cate_code_type"] ?>
                            </td>
                            <td>
                                <img alt="Avatar" width="100%" height="100px" src="../../public/uploads/<?= $row["cate_image"]; ?>">
                            </td>
                            <td>
                                <?= $row["cate_title"] ?>
                            </td>
                            <td>
                                <?= $row["cate_description"] ?>
                            </td>
                            <td class="project-state">
                                <?php
                                    if($row["cate_status"] == 0){
                                        ?>
                                            <span class="badge badge-success"><?= $row["cate_status"] ?></span>
                                        <?php
                                    }else {
                                        ?>
                                            <span class="badge bg-secondary"><?= $row["cate_status"] ?></span>
                                        <?php
                                    }
                                ?>
                            </td>
                                <td class="project-actions text-right">
                                            <a class="btn btn-info btn-sm" href="http://localhost/project_asm/admin/view/update-categories.php?cateId=<?= $row["cate_id"] ?>">
                                                <i class="fas fa-pencil-alt">
                                                </i>
                                                Edit
                                            </a>
                                            <a class="btn btn-danger btn-sm" href="http://localhost/project_asm/admin/Controller/authcategories.php?delete_id=<?= $row["cate_id"] ?>&img=<?= $row["cate_image"] ?>">
                                                <i class="fas fa-trash">
                                                </i>
                                                Delete
                                            </a>
                                </td>
                        </tr>
                <?php
            }
        }
    }


    // Update
    if(isset($_POST["update_category"])){
        $cate_id  = $_POST["cate_id"];
        $cate_small_description = mysqli_real_escape_string($conn, $_POST["cate_small_description"]);
        $cate_code_type = mysqli_real_escape_string($conn, $_POST["cate_code_type"]);
        $cate_title = mysqli_real_escape_string($conn, $_POST["cate_title"]);
        $cate_description = mysqli_real_escape_string($conn, $_POST["cate_description"]);

        $new_image = $_FILES["cate_image"]["name"];
        $old_image = $_POST["old_image"];

        $cate_status = $_POST["cate_status"];

        $cate_status_old = $_POST["cate_status_old"];

        $path = "../../public/uploads";

        // check status
        if(empty($cate_status)){
            $cate_status = $cate_status_old;
        }

        // check update image
        $filename = " ";

        if(!empty($new_image)) {
            $update_filename  = $new_image;
            $image_ext = pathinfo($update_filename , PATHINFO_EXTENSION); // Nhận thông tin về đường dẫn tệp VD: Các loại đuôi file ảnh phổ biến png , jpg, tiff, nef, psd
            $filename = time().'.'.$image_ext; // time() Trả về thời gian hiện tại dưới dạng dấu thời gian Unix  VD: 1680010810 nối chuỗi .png 
        }
        if(empty($new_image)){
            $filename = $old_image ;
        }

  
        
    
        
        $update_category_run = updateCategories($cate_small_description, $cate_code_type, $cate_title, $cate_description, $filename, $cate_status, $cate_id);

        if($update_category_run) {
                if(!empty($_FILES["cate_image"]["name"])){
                    move_uploaded_file($_FILES["cate_image"]["tmp_name"], $path.'/'.$filename);
                    if(file_exists("../../public/uploads/".$old_image)) {
                        unlink("../../public/uploads/".$old_image);
                    }
                }  
                redirect1("http://localhost/project_asm/admin/view/update-categories.php?cateId=$cate_id", "Update Category thành công");
        }else {
            redirect1("http://localhost/project_asm/admin/view/update-categories.php?cateId=$cate_id", "Update Category thất bại!");
        }

    }

    // Delete Categories id
    if(isset($_GET["delete_id"])){
        $cate_id = $_GET["delete_id"];
        $cate_img = $_GET["img"];
    
        $path = "../../public/uploads/$cate_img";
        
        $deleteCate = deleteCategories($cate_id);
        if($deleteCate) {
            if(file_exists($path)){
                unlink($path);      
            }
            redirect1("http://localhost/project_asm/admin/view/categories.php", "Delete Category thành công");
        }
    }

    // lay id de show data
    
    

    // Count categories
    $CountCate = mysqli_num_rows(selectCategories());
    

     // Count products
    function SelectProducts() {
        global $conn; 
        $sql = "SELECT * FROM products";
        return $sql_run = mysqli_query($conn, $sql);
    }

    $CountProd = mysqli_num_rows(SelectProducts());
  
?>