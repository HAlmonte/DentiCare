<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
          <a href="#" class="navbar-brand">
              <span class="brand-text font-weight-light"><?php echo $app_name;?></span>
          </a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <img src="../uploads/<?php echo $avatar; ?>" class="img-circle elevation-2" alt="User Image" style="height:30px;">
<!--          <span class="badge badge-danger navbar-badge">3</span>-->
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="../uploads/<?php echo $avatar; ?>" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo $user_full_name; ?></h3>

                <p class="text-muted text-center"><?php echo $user_type_name; ?></p>

                <ul class="list-group list-group-unbordered mb-3">
                </ul>
                <?php
                if ($_SESSION['user_type'] == 1){//administrator
                    echo "<a href='../user/edit-profile.php?user_id=$user_id' class='btn btn-sm btn-default btn-block'><b>Edit Profile</b></a>";
                }
                if ($_SESSION['user_type'] == 2){//doctor
                    echo "<a href='../doctor/edit-doctor.php?doctor_id=$user_id' class='btn btn-sm btn-default btn-block'><b>Edit Profile</b></a>";
                }
                if ($_SESSION['user_type'] == 3){//patient
                    echo "<a href='../patient/edit-patient.php?patient_id=$user_id' class='btn btn-sm btn-default btn-block'><b>Edit Profile</b></a>";
                }
                ?>
                <a href="../login/login.php" class="btn btn-sm btn-primary btn-block"><b>Logout</b></a>
              </div>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-1">
    <!-- Brand Logo -->
    <a href="#" class="brand-link text-center">
        <img src="../uploads/<?php echo $logo;?>" style="width:150px;" class="image elevation-3" style="opacity: 1" alt="LOGO">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
        <?php
        if ($_SESSION['user_type'] == 1){// Administrator
            include 'sidebar-admin.php';
        }
        if ($_SESSION['user_type'] == 2){// doctor
            include 'sidebar-doctor.php';
        }
        if ($_SESSION['user_type'] == 3){// patient
            include 'sidebar-patient.php';
        }
        ?>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar         -->
  </aside>