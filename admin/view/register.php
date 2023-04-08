<!-- Start header -->
<?php
session_start();
include_once("../includes/header.php");
?>
<!-- End header -->

<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <b>Admin</b>Shopping Online
  </div>

  <div class="card">
    <div class="card-body register-card-body">
    <?php
          if(isset($_SESSION["message"])){
            ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hey </strong><?= $_SESSION["message"]; ?>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php
                  unset($_SESSION["message"]);
          }
    ?>
      <p class="login-box-msg">Register a new membership</p>

      <form action="../Controller/authadmin.php" method="post">
        <div class="input-group mb-3">
          <input type="text" name="admin_fullname" class="form-control" placeholder="Full name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" name="admin_email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="number" name="admin_phone" class="form-control" placeholder="Phone">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="admin_password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="rEpassword" class="form-control" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="register_admin">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <a href="http://localhost/project_asm/admin/view/login.php" class="text-center">login</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- Start footer -->
<?php
include_once("../includes/footer.php");
?>
<!-- End footer -->