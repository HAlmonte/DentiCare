<!DOCTYPE html>
<html lang="en">
<?php include '../header&footer/header.php'; ?>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <?php include '../sidebar&navbar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class="row">
          <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  <?php
                  require_once '../database&config/config.php';
                  $cn = new mysqli (HOST, USER, PW, DB);
                  $sql="SELECT COUNT(clinic_id) FROM tbl_clinic";
                  $qry=$cn->prepare($sql);
                  $qry->execute();
                  $qry->bind_result($no_clinic);
                  $qry->store_result();
                  $qry->fetch();
                  echo "<h3>$no_clinic</h3>";
                  ?>
                <p>Number of Clinics</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-medkit"></i>
              </div>
              <a href="../clinic/clinic.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            
            <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <?php
                  require_once '../database&config/config.php';
                  $cn = new mysqli (HOST, USER, PW, DB);
                  $sql="SELECT COUNT(doctor_id) FROM tbl_doctor";
                  $qry=$cn->prepare($sql);
                  $qry->execute();
                  $qry->bind_result($no_doctor);
                  $qry->store_result();
                  $qry->fetch();
                  echo "<h3>$no_doctor</h3>";
                  ?>
                <p>Number of Doctors</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-contact"></i>
              </div>
              <a href="../doctor/doctor.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            
            <div class="col-lg-4 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                  require_once '../database&config/config.php';
                  $cn = new mysqli (HOST, USER, PW, DB);
                  $sql="SELECT COUNT(patient_id) FROM tbl_patient";
                  $qry=$cn->prepare($sql);
                  $qry->execute();
                  $qry->bind_result($no_patient);
                  $qry->store_result();
                  $qry->fetch();
                  echo "<h3>$no_patient</h3>";
                  ?>
                <p>Number of Patients</p>
              </div>
              <div class="icon">
                <i class="ion ion-ios-body-outline"></i>
              </div>
              <a href="../patient/patient.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            
        </div>
        
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include '../header&footer/footer.php';  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include '../header&footer/scripts.php'; ?>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "searching": false, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $("#example2").DataTable({
      "responsive": true, "lengthChange": false, "searching": false, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $("#example3").DataTable({
      "responsive": true, "lengthChange": false, "searching": false, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $("#example4").DataTable({
      "responsive": true, "lengthChange": false, "searching": false, "autoWidth": true
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>