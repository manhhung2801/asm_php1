<!-- Start header -->
<?php
include("../Controller/authproducts.php");
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
            <h1>Add Product</h1>
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
                    <form action="../Controller/authproducts.php" method="POST" enctype="multipart/form-data">
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
                                  <label for="inputName">Product Title</label>
                                  <input type="text" name="prod_title"  class="form-control">
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-2">
                                      <label for="inputName">Product Code Type</label><br>
                                      <select class="form-select" name="cate_id_and_prod_code_type" aria-label="Default select example">
                                            <option selected>Chooes Code Type</option>
                                            <?php
                                                  $dataCode = selectCategories();
                                                  if(mysqli_num_rows($dataCode) > 0){
                                                          while($data = mysqli_fetch_assoc($dataCode)){
                                                      ?>
                                                          <option value="<?= $data["cate_id"]; ?>-<?= $data["cate_code_type"]; ?>"><?= $data["cate_title"]; ?></option>
                                                          
                                                      <?php
                                                          }
                                                  }
                                            ?>
                                      </select>
                                    </div>
                                    <div class="col-md-10">
                                      <label for="inputName">Product Small Description</label>
                                      <input type="text" name="prod_small_description"  class="form-control">
                                    </div>
                                </div>
                                
                                <div class="form-group row">
                                      <div class="col-md-4">
                                        <label for="inputName">Product Original Price</label>
                                        <input type="number" name="prod_original_price"  class="form-control">
                                      </div>
                                      <div class="col-md-4">
                                        <label for="inputName">Product Selling Price</label>
                                        <input type="number" name="prod_selling_price"  class="form-control">
                                      </div>
                                      <div class="col-md-4">
                                  <label for="inputName">Product Image</label>
                                  <input type="file" name="prod_image" class="form-control">
                                </div>
                                </div>
                                <div class="form-group row">
                                      <div class="col-md-4">
                                        <label for="inputName">Product Quantity</label>
                                        <input type="number" name="prod_quantity"  class="form-control">
                                      </div>
                                      <div class="col-md-4">
                                          <label for="inputStatus">Product trending</label>
                                          <br>
                                          <select id="inputStatus" class="form-select" name="prod_trending" class="form-control custom-select">
                                              <option selected disabled>Choose</option>
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                          </select>
                                      </div>
                                      <div class="col-md-4">
                                          <label for="inputStatus">Product Status</label>
                                          <br>
                                          <select id="inputStatus" class="form-select" name="prod_status" class="form-control custom-select">
                                              <option selected disabled>Choose</option>
                                              <option value="0">0</option>
                                              <option value="1">1</option>
                                          </select>
                                      </div>
                                </div>
                                <div class="form-group">
                                  <label for="inputDescription">Product Description</label>
                                  <textarea name="prod_description" class="form-control" rows="4"></textarea>
                                </div>
                                <br>
                                <input type="submit" value="Create new Categories" name="add_product" class="btn btn-success float-right">
                            </div>
                            <!-- /.card-body -->
                          </div>
                    </form>
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