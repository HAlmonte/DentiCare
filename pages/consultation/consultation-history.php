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
      <!-- Default box -->
      <div class="card">
        <div class="card-body">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Appointment No.</th>
                        <th>Patient</th>
                        <th>Diagnosis</th>
                        <th>Consultation Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($_SESSION['user_type'] == 2){//doctor
                    $doctor_id = $_SESSION['user_id'];
                    require_once '../database&config/config.php';
                    $cn = new mysqli (HOST, USER, PW, DB);
                    $sql="SELECT consult.consultation_id, consult.appointment_id, consult.patient_id, consult.diagnosis, consult.treatment, consult.upload_prescription, consult.consultation_date, patient.first_name, patient.middle_name, patient.last_name, reserve.appointment_no, dr.first_name, dr.middle_name, dr.last_name, service.service_name
                    FROM tbl_consultation AS consult
                    
                    LEFT JOIN tbl_patient AS patient
                    ON consult.patient_id = patient.patient_id
                    
                    LEFT JOIN tbl_reservation AS reserve
                    ON consult.appointment_id = reserve.appointment_id
                    
                    LEFT JOIN tbl_services AS service
                    ON reserve.service_id = service.service_id
                    
                    LEFT JOIN tbl_doctor AS dr 
                    ON service.doctor_id = dr.doctor_id
                    
                    WHERE dr.doctor_id = ?
                    ORDER BY consult.consultation_id DESC";
                    $qry=$cn->prepare($sql);
                    $qry->bind_param("s", $doctor_id);
                    $qry->execute();
                    $qry->bind_result($consultation_id, $appointment_id, $patient_id, $diagnosis, $treatment, $upload_prescription,     $consultation_date, $patient_first_name, $patient_middle_name, $patient_last_name, $appointment_no, $doctor_first_name, $doctor_middle_name, $doctor_last_name, $service_name);
                    $qry->store_result();
                    
                }  
                    
                    if ($_SESSION['user_type'] == 1){//admin
                    $doctor_id = $_SESSION['user_id'];
                    require_once '../database&config/config.php';
                    $cn = new mysqli (HOST, USER, PW, DB);
                    $sql="SELECT consult.consultation_id, consult.appointment_id, consult.patient_id, consult.diagnosis, consult.treatment, consult.upload_prescription, consult.consultation_date, patient.first_name, patient.middle_name, patient.last_name, reserve.appointment_no, dr.first_name, dr.middle_name, dr.last_name, service.service_name
                    FROM tbl_consultation AS consult
                    
                    LEFT JOIN tbl_patient AS patient
                    ON consult.patient_id = patient.patient_id
                    
                    LEFT JOIN tbl_reservation AS reserve
                    ON consult.appointment_id = reserve.appointment_id
                    
                    LEFT JOIN tbl_services AS service
                    ON reserve.service_id = service.service_id
                    
                    LEFT JOIN tbl_doctor AS dr 
                    ON service.doctor_id = dr.doctor_id
                    
                    ORDER BY consult.consultation_id DESC";
                    $qry=$cn->prepare($sql);
                    $qry->execute();
                    $qry->bind_result($consultation_id, $appointment_id, $patient_id, $diagnosis, $treatment, $upload_prescription,     $consultation_date, $patient_first_name, $patient_middle_name, $patient_last_name, $appointment_no, $doctor_first_name, $doctor_middle_name, $doctor_last_name, $service_name);
                    $qry->store_result();
                    
                }
                
                while ($qry->fetch()){
                    
                    echo "<tr>
                        <td class='text-center'>
                        <a href='more-details-consultation.php?consultation_id=$consultation_id'>
                            <button class='btn btn-xs btn-success  elevation-1'>More Details</button>
                        </a>
                        </td>
                        <td>$appointment_no</td>
                        <td>$patient_first_name $patient_middle_name $patient_last_name</td>
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
