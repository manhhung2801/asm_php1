<?php
include("../../functions/myfunctions.php");
include("../../config/database.php");
include("../Model/admincode.php");

// Create account admin
if(isset($_POST["register_admin"])){ 
    $adminFullname = mysqli_real_escape_string($conn, $_POST["admin_fullname"]);
    $adminEmail = mysqli_real_escape_string($conn, $_POST["admin_email"]);
    $adminPhone = mysqli_real_escape_string($conn, $_POST["admin_phone"]);
    $adminPassword = mysqli_real_escape_string($conn, $_POST["admin_password"]);
    $rEassword = $_POST["rEpassword"];

    // Check password == cRpassword
    if($adminPassword == $rEassword){

        // data are not empty
        if(!empty($adminFullname) || !empty($adminEmail) ||  !empty($adminPhone) ||  !empty($adminPassword)) {

                $addAmin_run = addAdmin($adminFullname, $adminEmail, $adminPhone, md5($adminPassword)); // md5() mã hoá password
                if($addAmin_run) {
                    redirect("http://localhost/project_asm/admin/view/login.php", "Bạn đã đăng ký thành công login ở bên dưới");
                }else {
                    redirect("http://localhost/project_asm/admin/view/register.php", "Đăng ký thất bại !");
                }
        }else {
            redirect("http://localhost/project_asm/admin/view/register.php", "Nhập đủ tất cả các thông tin trên");
        }
    }else {
        redirect("http://localhost/project_asm/admin/view/register.php", "Password phải bằng Retype password");
    }
}
// Login account admin
else if (isset($_POST["login_admin"])){
    $adminEmail = mysqli_real_escape_string($conn, $_POST["admin_email"]);
    $adminPassword = mysqli_real_escape_string($conn, $_POST["admin_password"]);

    if(!empty($adminEmail ) || !empty($adminPassword)) {
        $loginAdmin_run = loginAdmin($adminEmail, md5($adminPassword)); // md5() mã hoá password

        
        if($loginAdmin_run) {
                $data = mysqli_fetch_array($loginAdmin_run);

                    if($data["admin_account_type"] === "admin"){
                            $_SESSION["auth"] = true;
                            $_SESSION["admin_info"] = [
                            'admin_id' => $data["admin_id"],
                            'admin_fullname' =>  $data["admin_fullname"],
                            'account_type' => $data["admin_account_type"] 
                        ];
                        redirect("http://localhost/project_asm/admin/view/index.php", "Login thành công");
                    }
                    if($data["admin_account_type"] !== "admin"){
                        redirect("http://localhost/project_asm/admin/view/login.php", "Bạn không có quyền truy cập vào trang web !");
                    }
                    
        }else {
            redirect("http://localhost/project_asm/admin/view/login.php", "Email hoặc Password sai !");
        }
    }else {
        redirect("http://localhost/project_asm/admin/view/login.php", "Nhập đủ Email và Password");
    }
}

// cấp quyền admin
if(isset($_GET["acId"])){
    $admin_id = $_GET["acId"];

    $update_account_type_run = updateAccountType($admin_id, "admin");

    if($update_account_type_run){
        redirect1("http://localhost/project_asm/admin/view/all-admin.php", "Cấp quyền thành công");
    }
}

// ngừng cấp quyền admin
if(isset($_GET["noId"])){
    $admin_id = $_GET["noId"];

    $update_account_type_run = updateAccountType($admin_id, "not have access");

    if($update_account_type_run){
        redirect1("http://localhost/project_asm/admin/view/all-admin.php", "Ngừng cấp quyền thành công");
    }
}
?>