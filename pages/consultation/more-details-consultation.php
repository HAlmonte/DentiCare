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
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <?php      
      $consultation_id = $_GET['consultation_id'];
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
                    
                    WHERE consult.consultation_id = ?
                    ORDER BY consult.consultation_id DESC";
      $qry=$cn->prepare($sql);
      $qry->bind_param("s", $consultation_id);
      $qry->execute();
      $qry->bind_result($consultation_id, $appointment_id, $patient_id, $diagnosis, $treatment, $upload_prescription, $consultation_date, $patient_first_name, $patient_middle_name, $patient_last_name, $appointment_no, $doctor_first_name, $doctor_middle_name, $doctor_last_name, $service_name);
      $qry->store_result();
      $qry->fetch();
      include 'view-upload_prescription-modal.php';
      ?>

    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="card col-md-8 mx-auto">
          <div class="card-header">
              <a href="javascript:history.back()">
                  <button class="btn btn-sm btn-default elevation-1">Back</button>
              </a>
          </div>
          <div class="card-body">
              <dl>
                  <dt>Appointment No.</dt>
                  <dd><?php echo $appointment_no;?></dd>
                  <dt>Patient</dt>
                  <dd><?php echo "$patient_first_name $patient_middle_name $patient_last_name";?></dd>
                  <dt>Diagnosis</dt>
                  <dd><?php echo $diagnosis;?></dd>
                  <dt>Treatment</dt>
                  <dd><?php echo $treatment;?></dd>
                  <dt>Prescription</dt>
                  <dd><button class="btn btn-info elevation-1 btn-xs" data-toggle="modal" data-target="#view-upload_prescription"><i class="fa fa-eye"></i> View</button>
                  </dd>
                  <dt>Doctor</dt>
                  <dd><?php echo "$doctor_first_name $doctor_middle_name $doctor_last_name";?></dd>
                  <dt>Consultation Date</dt>
                  <dd><?php echo $consultation_date;?></dd>
                </dl>
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
