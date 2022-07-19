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
<?php 
        include 'add-modal.php';  
        include 'function.php'; 
?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-sm elevation-1 btn-info" data-toggle="modal" data-target="#add-clinic"><i class="fa fa-plus"></i> Add</button>
            
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Name</th>
                        <th>Doctor</th>
                        <th>Permit</th>
                        <th>Address</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
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
                while ($qry->fetch()){
                    if ($status == 1){
                        $active = "<span class='right badge badge-success'>Active</span>";
                    }
                    else {
                        $active = "<span class='right badge badge-warning'>Inactive</span>";
                    }
                    echo "<tr>
                        <td class='text-center'>
                            <a href='edit-clinic.php?clinic_id=$clinic_id'><button class='btn btn-sm elevation-1 btn-success btn-xs'><i class='nav-icon fas fa-pen'></i></button></a> 
                        </td>
                        <td>$clinic_name</td>
                        <td>$dr_first_name $dr_middle_name $dr_last_name</td>
                        <td class='text-center'><img src='../uploads/$upload_permit' class='img' style='width:100px;' alt='Image'><br>
                            <button class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-upload_permit-$clinic_id'><i class='nav-icon fas fa-pen'></i> </button>
                            <button class='btn btn-sm elevation-1 btn-info btn-xs' data-toggle='modal' data-target='#view-upload_permit-$clinic_id'><i class='nav-icon fas fa-eye'></i> </button>
                        </td>
                        <td>$address</td>
                        <td>$latitude</td>
                        <td>$longitude</td>
                        <td>$active</td>
                        </tr>";
                    
                    include 'delete-modal.php';
                    include 'edit-upload_permit-modal.php';
                    include 'view-upload_permit-modal.php';
                    include 'edit-password-modal.php';
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
