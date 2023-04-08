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
            <h1>Categories</h1>
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

<!-- Default box -->
<div class="card">
  <div class="card-body p-0">
    <table class="table table-striped projects">
        <thead>
            <tr>
                <th style="width: 1%">
                    ID
                </th>
                <th style="width: 17%">
                    Categories Small Description
                </th>
                <th style="width: 15%">
                    Categories Code Type
                </th>
                <th style="width: 15%">
                    Categories Image
                </th>
                <th style="width: 10%">
                    Categories Title
                </th>
                <th style="width: 22%">
                    Categories Description
                </th>
                <th style="width: 5%" class="text-center">
                    Status
                </th>
                <th style="width: 15%">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                readCate();
            ?>
        </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Start footer -->
<?php
include_once("../includes/footer.php");
?>
<!-- End footer -->
