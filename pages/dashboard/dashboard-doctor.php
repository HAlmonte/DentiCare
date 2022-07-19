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
<!--            <h1>Dashboard</h1>-->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
 
    <!-- Main content -->
    <section class="content">
        
        <div class="row">
          <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                  <?php
                  $doctor_id = $_SESSION['user_id'];
                  require_once '../database&config/config.php';
                  $cn = new mysqli (HOST, USER, PW, DB);
                  $sql="SELECT COUNT(clinic_id) FROM tbl_clinic WHERE doctor_id = $doctor_id";
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
              <a href="../clinic/my-clinic.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            
            <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <?php
                  require_once '../database&config/config.php';
                  $cn = new mysqli (HOST, USER, PW, DB);
                  $sql="SELECT COUNT(r.appointment_id)

                    FROM tbl_reservation AS r

                    LEFT JOIN tbl_services AS s
                    ON s.service_id = r.service_id
                    
                    WHERE s.doctor_id = $doctor_id";
                  $qry=$cn->prepare($sql);
                  $qry->execute();
                  $qry->bind_result($no_reservation);
                  $qry->store_result();
                  $qry->fetch();
                  echo "<h3>$no_reservation</h3>";
                  ?>
                <p>Number of Reservation</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-clipboard"></i>
              </div>
              <a href="../reservation/reservation.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            
            <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <?php
                  require_once '../database&config/config.php';
                  $cn = new mysqli (HOST, USER, PW, DB);
                  $sql="SELECT COUNT(r.patient_id)

                    FROM tbl_reservation AS r

                    LEFT JOIN tbl_services AS s
                    ON s.service_id = r.service_id
                    
                    WHERE s.doctor_id = $doctor_id";
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
              <a href="../reservation/reservation.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            
            <div class="col-lg-3 col-12">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <?php
                  require_once '../database&config/config.php';
                  $cn = new mysqli (HOST, USER, PW, DB);
                  $sql="SELECT COUNT(service_id) FROM tbl_services WHERE doctor_id = $doctor_id";
                  $qry=$cn->prepare($sql);
                  $qry->execute();
                  $qry->bind_result($no_service);
                  $qry->store_result();
                  $qry->fetch();
                  echo "<h3>$no_service</h3>";
                  ?>
                <p>Number of Services</p>
              </div>
              <div class="icon">
                <i class="ion ion-android-list"></i>
              </div>
              <a href="../services/services.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
            
        </div>
        
        <div class="card" style="height:600px;">
            <div class="card-header">
                Scan Patient's QR Code
            </div>
            <div class="card-body">
                <iframe src="../qr-code/scan-qr-code.php" title="description" style="height:100%;width:100%;"></iframe>
            </div>
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