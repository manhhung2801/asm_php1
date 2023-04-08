<!-- Start header -->
<?php
session_start();
include_once("../includes/header.php");
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';
?>
<!-- End header -->

<body class="hold-transition login-page">
<?php
      if(isset($_SESSION["message"])){
            ?>
                <div class="alert alert-success d-flex align-items-center" role="alert">
                    <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                    <div>
                        <?= $_SESSION["message"]; ?>
                    </div>
                </div>
            <?php
                unset($_SESSION["message"]);
      }
?>
<div class="login-box">
  <div class="login-logo">
      <b>Admin</b>Shopping Online
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form action="../Controller/authadmin.php" method="post">
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="admin_email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="admin_password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="login_admin">Login In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
        <br>
      <p class="mb-0">
        <a href="http://localhost/project_asm/admin/view/register.php" class="text-center">Register</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- Start footer -->
<?php
include_once("../includes/footer.php");
?>
<!-- End footer -->