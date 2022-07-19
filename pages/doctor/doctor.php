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
            <h1>Doctors</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<?php 
        echo "<script src='../../plugins/jquery/jquery.min.js'></script>";
        include 'add-modal.php';  
        include 'function.php'; 
?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-sm elevation-1 btn-info" data-toggle="modal" data-target="#add-doctor"><i class="fa fa-plus"></i> Add</button>
            
        </div>
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Full Name</th>
                        <th>Specialization</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Upload Identity</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT doctor_id, first_name, last_name, middle_name, specialization, address, contact, upload_identity, username, password, status FROM tbl_doctor";
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($doctor_id, $first_name, $last_name, $middle_name, $specialization, $address, $contact, $upload_identity, $username, $password, $status);
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
                            <a href='edit-doctor.php?doctor_id=$doctor_id'><button class='btn btn-sm elevation-1 btn-success btn-xs'><i class='nav-icon fas fa-pen'></i></button></a> 
                        </td>
                        <td>$first_name $middle_name $last_name</td>
                        <td>$specialization</td>
                        <td>$address</td>
                        <td>$contact</td>
                        <td class='text-center'><img src='../uploads/$upload_identity' class='img' style='width:100px;' alt='Image'><br>
                            <button class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-upload_identity-$doctor_id'><i class='nav-icon fas fa-pen'></i> Edit Picture</button>
                        </td>
                        <td>$username</td>
                        <td class='text-center'>
                            <button class='btn btn-sm elevation-1 btn-default btn-sm' data-toggle='modal' data-target='#edit-password-$doctor_id'>Change Password</button>
                        </td>
                        <td>$active</td>
                        </tr>";
                    
                    include 'delete-modal.php';
                    include 'edit-upload_identity-modal.php';
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
