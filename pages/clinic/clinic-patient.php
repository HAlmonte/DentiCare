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
            <h1>Clinics</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        
        <div class='row'>
        <?php
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="SELECT c.clinic_id, c.clinic_name, c.doctor_id, dr.first_name, dr.middle_name, dr.last_name, c.upload_permit, c.address, c.latitude, c.longitude, c.status
        FROM tbl_clinic AS c
        LEFT JOIN tbl_doctor AS dr
        ON c.doctor_id = dr.doctor_id";
        $qry=$cn->prepare($sql);
        $qry->execute();
        $qry->bind_result($clinic_id, $clinic_name, $doctor_id, $dr_first_name, $dr_middle_name, $dr_last_name, $upload_permit, $address, $latitude, $longitude, $status);
        $qry->store_result();
        
        $num=0;    
        while ($qry->fetch()){
            $clinic_id_array[$num] = $clinic_id;
            $clinic_name_array[$num] = $clinic_name;
            $doctor_id_array[$num] = $doctor_id;
            $dr_first_name_array[$num] = $dr_first_name;
            $dr_middle_name_array[$num] = $dr_middle_name;
            $dr_last_name_array[$num] = $dr_last_name;
            $upload_permit_array[$num] = $upload_permit;
            $address_array[$num] = $address;
            $latitude_array[$num] = $latitude;
            $longitude_array[$num] = $longitude;
            $status_array[$num] = $status;
            
            $num++;
        }
            
        $count = 0;
        $bg_no = 0;
        while ($num > $count){
            $clinic_id = $clinic_id_array[$count];
            $clinic_name = $clinic_name_array[$count];
            $doctor_id = $doctor_id_array[$count];
            $dr_first_name = $dr_first_name_array[$count];
            $dr_middle_name = $dr_middle_name_array[$count];
            $dr_last_name = $dr_last_name_array[$count];
            $upload_permit = $upload_permit_array[$count];
            $address = $address_array[$count];
            $latitude = $latitude_array[$count];
            $longitude = $longitude_array[$count];
            $status = $status_array[$count];
            
            require_once '../database&config/config.php';
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT COUNT(service_id) FROM tbl_services WHERE clinic_id = $clinic_id";
            $qry=$cn->prepare($sql);
            $qry->execute();
            $qry->bind_result($count_services);
            $qry->store_result();
            $qry->fetch();
            
            require_once '../database&config/config.php';
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT SUM(slots) FROM tbl_clinic_schedule WHERE clinic_id = $clinic_id";
            $qry=$cn->prepare($sql);
            $qry->execute();
            $qry->bind_result($count_schedule);
            $qry->store_result();
            $qry->fetch();
            
            if ($status == 1){
                $active = "<span class='right badge badge-success'>Active</span>";
            }
            else {
                $active = "<span class='right badge badge-warning'>Inactive</span>";
            }
            
            if ($bg_no == 0){
                $bg = 'info';
            }
            else if ($bg_no == 5){
                $bg = 'danger';
            }
            else if ($bg_no == 4){
                $bg = 'warning';
            }
            else if ($bg_no == 3){
                $bg = 'indigo';
            }
            else if ($bg_no == 2){
                $bg = 'success';
            }
            else if ($bg_no == 1){
                $bg = 'purple';
            }
            echo "<div class='col-md-4'>
            <!-- Widget: user widget style 2 -->
            <div class='card card-widget widget-user-2'>
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class='widget-user-header bg-$bg '>
                <h3 class=''>$clinic_name</h3>
                <h5 class=''>$address</h5>
              </div>
              <div class='card-footer p-0'>
                <ul class='nav flex-column'>
                  <li class='nav-item'>
                    <a href='#' class='nav-link'>
                      Services <span class='float-right badge bg-primary'>$count_services</span>
                    </a>
                  </li>
                  <li class='nav-item'>
                    <a href='#' class='nav-link'>
                      Slots <span class='float-right badge bg-primary'>$count_schedule</span>
                    </a>
                  </li>
                    <li class='nav-item '>
                    <div class='row justify-content-between'>
                    <a href='../reservation/add-reservation-patient.php?clinic_id=$clinic_id' class='nav-link'>
                      <button class='btn btn-default btn-sm elevation-1'>Add an appointment</button>
                    </a>
                    <a href='../services/view-services-patient.php?clinic_id=$clinic_id&clinic_name=$clinic_name' class='nav-link'>
                      <button class='btn btn-default btn-sm elevation-1'>View Services</button>
                    </a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
            <!-- /.widget-user -->
          </div>
          <!-- /.col -->";
            
            $bg_no++;
            if ($bg_no==5){
                $bg_no=0; 
            }
            
            $count++;
        }
        ?>
            
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
      "responsive": false, "lengthChange": false, "autoWidth": false, "scrollX":true
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
      $("#example2").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": false, "scrollX":true,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>
