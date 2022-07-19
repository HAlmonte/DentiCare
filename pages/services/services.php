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
            <h1>Services</h1>
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
          <button class="btn btn-info elevation-1 btn-sm" data-toggle="modal" data-target="#add-service"><i class="fa fa-plus"></i> Add</button>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Clinic Name</th>
                        <th>Doctor</th>
                        <th>Service Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                    
                if ($_SESSION['user_type'] == 1){//administrator
                     $sql="SELECT s.service_id, s.clinic_id, s.doctor_id, s.service_name, s.description, s.amount, c.clinic_name, d.first_name, d.middle_name, d.last_name
                     FROM tbl_services AS s
                     LEFT JOIN tbl_clinic AS c
                     ON s.clinic_id = c.clinic_id
                     LEFT JOIN tbl_doctor AS d
                     ON s.doctor_id = d.doctor_id";
                }
                if ($_SESSION['user_type'] == 2){//doctor
                    $doctor_id = $_SESSION['user_id'];
                     $sql="SELECT s.service_id, s.clinic_id, s.doctor_id, s.service_name, s.description, s.amount, c.clinic_name, d.first_name, d.middle_name, d.last_name
                     FROM tbl_services AS s
                     LEFT JOIN tbl_clinic AS c
                     ON s.clinic_id = c.clinic_id
                     LEFT JOIN tbl_doctor AS d
                     ON s.doctor_id = d.doctor_id
                     WHERE s.doctor_id = '$doctor_id'";
                }
                    
               
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($service_id, $clinic_id, $doctor_id, $service_name, $description, $amount, $clinic_name, $dr_first_name, $dr_middle_name, $dr_last_name);
                $qry->store_result();
                while ($qry->fetch()){
                    echo "<tr>
                        <td class='text-center'>
                        <a href='edit-service.php?service_id=$service_id'>
                            <button class='btn elevation-1 btn-sm btn-success btn-xs'><i class='nav-icon fas fa-pen'></i></button> 
                        </a>
                        <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-service-$service_id'><i class='nav-icon fas fa-trash'></i></button>
                        </td>
                        <td>$clinic_name</td>
                        <td>$dr_first_name $dr_middle_name $dr_last_name</td>
                        <td>$service_name</td>
                        <td>$amount</td>
                        </tr>";
                    
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
