<!-- Start header -->
<?php
include("../Controller/authadmin.php");
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
            <h1>All account admin</h1>
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
                <th style="width: 20%" class="text-center">
                    Full Name
                </th>
                <th style="width: 20%" class="text-center">
                    Email
                </th>
                <th style="width: 10%" class="text-center">
                    phone
                </th>
                <th style="width: 10%" class="text-center">
                    Status
                </th>
                <th style="width: 19%" class="text-center">
                    Account creation date
                </th>
                <th style="width: 20%" class="text-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                $dataAdmin = selectAdmin();
                while($data = mysqli_fetch_assoc($dataAdmin)){
                    ?>
                        <tr>      
                            <td class="text-center"><?= $data["admin_id"]; ?></td>
                            <td class="text-center"><?= $data["admin_fullname"]; ?></td>
                            <td class="text-center"><?= $data["admin_email"]; ?></td>
                            <td class="text-center"><?= $data["admin_phone"]; ?></td>
                            <td class="project-state">
                                <?php
                                    if($data["admin_account_type"] == "admin"){
                                        ?>
                                            <span class="badge btn-success"><?= $data["admin_account_type"]; ?></span>
                                        <?php
                                    }else {
                                        ?>
                                            <span class="badge bg-secondary">not have access</span>
                                        <?php
                                    }
                                ?>
                            </td>
                            <td class="project-state"><?= $data["created_ad"]; ?></td>
                            <td class="project-actions text-right">
                                <a class="btn btn-success btn-sm" href="http://localhost/project_asm/admin/Controller/authadmin.php?acId=<?= $data["admin_id"]; ?>">
                                    <i class="fas fa-solid fa-check">
                                    </i>
                                    Accept
                                </a>
                                <a class="btn btn-danger btn-sm" href="http://localhost/project_asm/admin/Controller/authadmin.php?noId=<?= $data["admin_id"]; ?>">
                                    <i class="fas fa-solid fa-xmark">
                                    </i>
                                    Not accept
                                </a>
                            </td>
                        </tr>
                    <?php
                }
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
