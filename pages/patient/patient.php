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
            <h1>Patients</h1>
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
          <button class="btn btn-info elevation-1 btn-sm" data-toggle="modal" data-target="#add-patient"><i class="fa fa-plus"></i> Add</button>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Patient Name</th>
                        <th>Date of Birth</th>
                        <th>Address</th>
                        <th>Contact Number</th>
                        <th>Identity</th>
                        <th>Username</th>
                        <th>Password</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT patient_id, first_name, last_name, middle_name, birthdate, address, contact, upload_identity, username, password, status FROM tbl_patient";
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($patient_id, $first_name, $last_name, $middle_name, $birthdate, $address, $contact, $upload_identity, $username, $password, $status);
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
                            <p>
                                <a href='view-qr_code.php?patient_id=$patient_id&patient_name= $first_name $last_name $middle_name'>
                                <button class='btn elevation-1 btn-sm btn-default' data-toggle='modal' data-target='#view_qr-patient-$patient_id'><i class='nav-icon fas fa-qrcode'></i> View QR</button>
                                </a>
                            </p>
                        <a href='edit-patient.php?patient_id=$patient_id'>
                            <button class='btn elevation-1 btn-sm btn-success btn-xs'><i class='nav-icon fas fa-pen'></i></button>
                        </a>
                        <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-patient-$patient_id'><i class='nav-icon fas fa-trash'></i></button>
                        </td>
                        <td>$first_name $last_name $middle_name</td>
                        <td>$birthdate</td>
                        <td>$address</td>
                        <td>$contact</td>
                        <td class='text-center'><img src='../uploads/$upload_identity' class='img' style='width:100px;' alt='Image'><br>
                            <button class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-upload_identity-$patient_id'><i class='nav-icon fas fa-pen'></i> Edit Picture</button>
                        </td>
                        <td>$username</td>
                        <td class='text-center'>
                            <button class=' btn btn-sm elevation-1 btn-default btn-sm' data-toggle='modal' data-target='#edit-password-$patient_id'>Change Password</button>
                        </td>
                        <td>$active</td>
                        </tr>";
                    
                    include 'edit-upload_identity-modal.php';
                    include 'edit-password-modal.php';
                    include 'delete-modal.php';
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
      "responsive": true, "lengthChange": true, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
