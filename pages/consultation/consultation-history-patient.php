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
            <h1>Consultation History</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        if (!isset($_GET['patient_id'])){
            $patient_id = $_SESSION['user_id'];
        } else {
            $patient_id = $_GET['patient_id'];
        }
                require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT first_name, middle_name, last_name FROM tbl_patient WHERE patient_id = ?";
                $qry=$cn->prepare($sql);
                $qry->bind_param("s", $patient_id);
                $qry->execute();
                $qry->bind_result($patient_first_name, $patient_middle_name, $patient_last_name);
                $qry->store_result();
                $qry->fetch();
        ?>
      <!-- Default box -->
      <div class="card">
          <div class="card-header">Patient Name: <b><?php echo "$patient_first_name $patient_middle_name $patient_last_name";?></b>
          <div class="card-tools">
              <button class="btn btn-default" onclick="history.back()">Back</button>
          </div>
          </div>
        <div class="card-body">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Appointment No.</th>
                        <th>Diagnosis</th>
                        <th>Consultation Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php                   
                if (!isset($_GET['patient_id'])){
                    $patient_id = $_SESSION['user_id'];
                } else {
                    $patient_id = $_GET['patient_id'];
                }
                require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT consult.consultation_id, consult.appointment_id, consult.patient_id, consult.diagnosis, consult.treatment, consult.upload_prescription, consult.consultation_date, patient.first_name, patient.middle_name, patient.last_name, reserve.appointment_no
                FROM tbl_consultation AS consult
                INNER JOIN tbl_patient AS patient
                ON consult.patient_id = patient.patient_id
                INNER JOIN tbl_reservation AS reserve
                ON consult.appointment_id = reserve.appointment_id
                WHERE consult.patient_id = ?
                ORDER BY consult.consultation_id DESC";
                $qry=$cn->prepare($sql);
                $qry->bind_param("s", $patient_id);
                $qry->execute();
                $qry->bind_result($consultation_id, $appointment_id, $patient_id, $diagnosis, $treatment, $upload_prescription, $consultation_date, $patient_first_name, $patient_middle_name, $patient_last_name, $appointment_no);
                $qry->store_result();
                    while ($qry->fetch()){
                    
                    echo "<tr>
                        <td class='text-center'>
                        <a href='more-details-consultation.php?consultation_id=$consultation_id'>
                            <button class='btn btn-xs btn-success  elevation-1'>More Details</button>
                        </a>
                        </td>
                        <td>$appointment_no</td>
                        <td>$diagnosis</td>
                        <td>$consultation_date</td>
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
    $('#example1').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
