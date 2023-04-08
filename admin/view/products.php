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
            <h1>Products</h1>
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
                <th style="width: 10%">
                    Title
                </th>
                <th style="width: 7%">
                    Code Type
                </th>
                <th style="width: 9%">
                    Original Price
                </th>
                <th style="width: 8%">
                    Selling Price
                </th>
                <th style="width: 10%">
                    Image
                </th>
                <th style="width: 5%">
                    Quantity
                </th>
                <th style="width: 20%">
                    Small Description
                </th>
                <th style="width: 2%">
                    Trending
                </th>
                <th style="width: 2%" class="text-center">
                    Status
                </th>
                <th style="width: 15%">
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                // load products grom database
                $readProducts = readProducts();
                if(mysqli_num_rows($readProducts) > 0) {
                    while($row = mysqli_fetch_assoc($readProducts)){
                        ?>
                                <tr>
                                    <td>
                                        <?= $row["prod_id"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["prod_title"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["prod_code_type"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["prod_original_price"]; ?>
                                    </td>
                                    <td>
                                        <?= $row["prod_selling_price"]; ?>
                                    </td>
                                    <td class="project_progress">
                                            <img src="../../public/uploads/<?= $row["prod_image"]; ?>" width="100px" height="100px" alt="">
                                    </td>
                                    <td class="project_progress">
                                        <?= $row["prod_quantity"]; ?>
                                    </td>
                                    <td class="project_progress">
                                        <?= $row["prod_small_description"]; ?>
                                    </td>
                                    <td class="project-state">
                                        <?php   
                                            if($row["prod_trending"] == 1) {
                                                ?>
                                                    <span class="badge btn-danger"><?= $row["prod_trending"]; ?></span>
                                                <?php
                                            }else if($row["prod_trending"] == 0){
                                                ?>
                                                    <span class="badge bg-secondary"><?= $row["prod_trending"]; ?></span>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td class="project-state">
                                        <?php   
                                            if($row["prod_status"] == 0) {
                                                ?>
                                                    <span class="badge badge-success"><?= $row["prod_trending"]; ?></span>
                                                <?php
                                            }else if($row["prod_status"] == 1){
                                                ?>
                                                    <span class="badge bg-secondary"><?= $row["prod_trending"]; ?></span>
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td class="project-actions text-right">
                                        <a class="btn btn-info btn-sm" href="http://localhost/project_asm/admin/view/update-products.php?getId=<?=$row["prod_id"];?>">
                                            <i class="fas fa-pencil-alt">
                                            </i>
                                            Edit
                                        </a>
                                        <a class="btn btn-danger btn-sm" href="http://localhost/project_asm/admin/Controller/authproducts.php?prodId=<?=$row["prod_id"];?>&prodImg=<?=$row["prod_image"];?>">
                                            <i class="fas fa-trash">
                                            </i>
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                        <?php
                    }
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
