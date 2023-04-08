<!-- Start header -->
<?php
include("../Controller/authcategories.php");
include("../middleware/adminMiddleware.php");
include_once("../includes/header.php");
?>
<!-- End header -->

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
<?php
include_once("../includes/navbar.php");
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://localhost/project_asm/admin/view/index.php" class="brand-link">
      <span class="brand-text font-weight-light">Admin Shopping Online</span>
    </a>
    <?php
        if(isset($_SESSION["admin_info"])){
          ?>
              <div class="brand-link">
                  <div class="alert alert-info" role="alert">
                      <span class="brand-text fw-bold">Account: </span>
                      <?= $_SESSION["admin_info"]["admin_fullname"]; ?>
                  </div>
              </div>
          <?php
        }
    ?>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <?php
          include_once("../includes/sidebar.php")
      ?>
      <!-- /.sidebar-menu -->
        <div class="d-grid gap-1 col-6 mx-auto"> 
              <a class="btn btn-danger" href="http://localhost/project_asm/admin/view/logout.php">Đăng xuất</a>
        </div>
    </div>
    <!-- /.sidebar -->
  </aside>

   <!-- Content Wrapper. Contains page content -->
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add Categories</h1>
          </div>
          <div class="col-sm-6">
            <?php
                  if(isset($_SESSION["successfullly"])){
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?= $_SESSION["successfullly"]; ?>
                        </div>
                    <?php
                        unset($_SESSION["successfullly"]);
                  }
            ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
            <div class="col-md-12">
                  <?php
                      if(isset($_GET["cateId"])){
                              $id = $_GET["cateId"];
                              $cate = getById($id);
                              if(mysqli_num_rows($cate) > 0){

                                  $data = mysqli_fetch_array($cate);
                          ?>  
                                <form action="../Controller/authcategories.php" method="POST" enctype="multipart/form-data">
                                      <div class="card card-primary">
                                          <div class="card-header">
                                            <h3 class="card-title">General</h3>

                                            <div class="card-tools">
                                              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                                <i class="fas fa-minus"></i>
                                              </button>
                                            </div>
                                          </div>
                                          <?php
                                              if(isset($_SESSION["message"])){
                                                ?>
                                                    <div class="alert alert-warning d-flex align-items-center" role="alert">
                                                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                                                        <div>
                                                        <?= $_SESSION["message"]; ?>
                                                    </div>
                                              </div>
                                                <?php
                                                    unset($_SESSION["message"]);
                                              }
                                          ?>
                                        <div class="card-body">
                                            <div class="form-group">
                                              <input type="hidden" name="cate_id" value="<?= $data["cate_id"]; ?>">
                                              <label for="inputName">Category Small Description</label>
                                              <input type="text" name="cate_small_description" value="<?= $data["cate_small_description"]; ?>"  class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <label for="inputName">Category Code Type</label>
                                              <input type="text" name="cate_code_type" value="<?= $data["cate_code_type"]; ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                                <label for="inputStatus">Category Status</label>
                                                <select id="inputStatus" class="form-select"  name="cate_status" class="form-control custom-select">
                                                    <option selected disabled>Choose</option>
                                                    <option value="0">0</option>
                                                    <option value="1">1</option>
                                                </select>
                                                <input type="hidden" name="cate_status_old" value="<?= $data["cate_status"]; ?>">
                                                <?= $data["cate_status"];?>
                                                <?php 
                                                  if($data["cate_status"] == 0){
                                                          ?>
                                                          <span class="badge bg-success">ON</span>
                                                          <?php
                                                    }else {
                                                            ?>
                                                            <span class="badge bg-secondary">OFF</span>
                                                          <?php
                                                    }
                                                ?>
                                            </div>
                                            <div class="form-group">
                                              <label for="inputName">Category Title</label>
                                              <input type="text" name="cate_title" value="<?= $data["cate_title"]; ?>" class="form-control">
                                            </div>
                                            <div class="form-group">
                                              <label for="inputDescription">Category Description</label>
                                              <textarea name="cate_description" class="form-control" rows="4"><?= $data["cate_description"]; ?></textarea>
                                            </div>
                                            <div class="form-group">
                                              <label for="inputName">Category Image</label>
                                              <input type="file" name="cate_image" class="form-control">
                                              <label for="inputName">Current Image</label>
                                              <input type="hidden" name="old_image" value="<?= $data["cate_image"]; ?>">
                                              <img src="../../public/uploads/<?= $data["cate_image"]; ?>" alt="" width="120px" height="90px">
                                            </div>
                                            
                                            <br>
                                            <input type="submit" value="Create new Categories" name="update_category" class="btn btn-success float-right">
                                        </div>
                                        <!-- /.card-body -->
                                      </div>
                                </form>
                          <?php
                            }else {
                              echo "category not found";
                            }
                      }else{
                        echo "Id missing from url";
                      }
                  ?>
                    
              <!-- /.card -->
            </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!-- Start footer -->
<?php
include_once("../includes/footer.php");
?>
<!-- End footer -->