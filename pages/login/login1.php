<!DOCTYPE html>
<html lang="en">
<?php
    session_start();
    session_destroy();
    
    require_once '../database&config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT about_id, app_name, address, contact, info, logo, background_image FROM tbl_about";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($about_id, $app_name, $address, $contact, $info, $logo, $background_image);
    $qry->store_result();
    $qry->fetch();
?>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Math E-Learning</title>
    <link rel="icon" href="../uploads/<?php echo $logo;?>">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
      <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="../../plugins/toastr/toastr.min.css">
    <style>
</style>
</head>
<body class="hold-transition login-page" style="background-image: linear-gradient(to right, #c8e1fa , #e2b0ff);">
<div class="login-box">
  <div class="login-logo">
    <?php echo $app_name; ?>
  </div>
  <!-- /.login-logo -->
  <div class="card elevation-2">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post">
        <div class="input-group mb-3">
          <input type="name" class="form-control form-control-border" name="username" placeholder="Username" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control form-control-border" name="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-6">
            <input type="submit" class="btn btn-primary btn-block" name="sign-in" value="Sign In">
          </div>
          <!-- /.col -->
        </div>
      </form>

<!--
        <p class="mb-1">
            <a href="#" data-toggle="modal" data-target="#forgot-password">I forgot my password</a>
        </p>
        <p class="mb-1">
            <a href="#" data-toggle="modal" data-target="#register-user">Register a new membership</a>
        </p>
-->
    </div>
      
    <!-- /.login-card-body -->
  </div>
    
</div>
<!-- /.login-box -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
    <!-- SweetAlert2 -->
<script src='../../plugins/sweetalert2/sweetalert2.min.js'></script>
<?php
    include 'function.php';
?>
    
</body>
</html>
