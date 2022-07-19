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
              <?php
              $clinic_name = $_GET['clinic_name'];
              $clinic_id = $_GET['clinic_id'];
              ?>
            <h1>Services Available at <?php echo $clinic_name;?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card">
          <div class="card-header">
              <a href="javascript:history.back()">
                  <button class="btn btn-sm btn-default  elevation-1">Back</button>
              </a>
          </div>
        <div class="card-body">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Service Name</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT s.service_id, s.clinic_id, s.doctor_id, s.service_name, s.description, s.amount, c.clinic_name, d.first_name, d.middle_name, d.last_name
                     FROM tbl_services AS s
                     LEFT JOIN tbl_clinic AS c
                     ON s.clinic_id = c.clinic_id
                     LEFT JOIN tbl_doctor AS d
                     ON s.doctor_id = d.doctor_id
                     WHERE s.clinic_id = ?";          
                $qry=$cn->prepare($sql);
                $qry->bind_param("s", $clinic_id);
                $qry->execute();
                $qry->bind_result($service_id, $clinic_id, $doctor_id, $service_name, $description, $amount, $clinic_name, $dr_first_name, $dr_middle_name, $dr_last_name);
                $qry->store_result();
                while ($qry->fetch()){
                    echo "<tr>
                        <td>$dr_first_name $dr_middle_name $dr_last_name</td>
                        <td>$service_name</td>
                        <td>$amount</td>
                        </tr>";
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
      "responsive": true, "lengthChange": true, "autoWidth": false, "paging": false,
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
