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
            <h1>Reservation</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
        include 'scan_qr-modal.php'; 
        include 'add-modal.php'; 
        include 'function.php'; 
        ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <button class="btn btn-info elevation-1 btn-sm" data-toggle="modal" data-target="#add-reservation"><i class="fa fa-plus"></i> Add</button>
            <button class="btn btn-default elevation-1 btn-sm" data-toggle="modal" data-target="#scan_qr"><i class="fa fa-qrcode"></i> Scan QR</button>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-striped" style="width:100%;">
                <thead>
                    <tr>
                        <th></th>
                        <th>Appointment No.</th>
                        <th>Appointment Type</th>
                        <th>Date</th>
                        <th>Patient</th>
                        <th>Clinic</th>
                        <th>Service</th>
                        <th>Doctor</th>
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                    
                if ($_SESSION['user_type'] == 1){//admin
                   $sql="SELECT r.appointment_id, r.appointment_no, r.appointment_type, r.date, r.patient_id, r.service_id, r.remarks, r.status, p.first_name, p.middle_name, p.last_name, c.clinic_id, c.clinic_name, s.service_name, dr.first_name, dr.middle_name, dr.last_name, s.amount, r.remarks, r.status

                    FROM tbl_reservation AS r

                    LEFT JOIN tbl_patient AS p
                    ON r.patient_id = p.patient_id

                    LEFT JOIN tbl_services AS s
                    ON s.service_id = r.service_id

                    LEFT JOIN tbl_clinic AS c
                    ON s.clinic_id = c.clinic_id

                    LEFT JOIN tbl_doctor AS dr
                    ON s.doctor_id = dr.doctor_id

                    ORDER BY r.appointment_id DESC";
                    $qry=$cn->prepare($sql); 
                } 
                if ($_SESSION['user_type'] == 2){//doctor
                    $doctor_id = $_SESSION['user_id'];
                    $sql="SELECT r.appointment_id, r.appointment_no, r.appointment_type, r.date, r.patient_id, r.service_id, r.remarks, r.status, p.first_name, p.middle_name, p.last_name, c.clinic_id, c.clinic_name, s.service_name, dr.first_name, dr.middle_name, dr.last_name, s.amount, r.remarks, r.status

                    FROM tbl_reservation AS r

                    LEFT JOIN tbl_patient AS p
                    ON r.patient_id = p.patient_id

                    LEFT JOIN tbl_services AS s
                    ON s.service_id = r.service_id

                    LEFT JOIN tbl_clinic AS c
                    ON s.clinic_id = c.clinic_id

                    LEFT JOIN tbl_doctor AS dr
                    ON s.doctor_id = dr.doctor_id
                    
                    WHERE s.doctor_id = ?
                    ORDER BY r.appointment_id DESC";
                    $qry=$cn->prepare($sql);
                    $qry->bind_param("s", $doctor_id);
                }
                
                $qry->execute();
                $qry->bind_result($appointment_id, $appointment_no, $appointment_type, $date, $patient_id, $service_id, $remarks, $status, $p_first_name, $p_middle_name, $p_last_name, $clinic_id, $clinic_name, $service_name, $dr_first_name, $dr_middle_name, $dr_last_name, $amount, $remarks, $status);
                $qry->store_result();
                while ($qry->fetch()){
                    if ($_SESSION['user_type'] == 2){//doctor
                        $consultation_btn = "<a href='../consultation/add-consultation.php?appointment_id=$appointment_id&patient_id=$patient_id'><button class='btn elevation-1 btn-success btn-xs'> Add Consultation</button></a>";
                    }
                    if ($_SESSION['user_type'] == 1){//admin
                        $consultation_btn = null;
                    }
                    if ($appointment_type == 0){
                        $appointment_name = "Face to face";
                    }
                    if ($appointment_type == 1){
                        $appointment_name = "Virtual";
                    }
                    if ($status == 0){
                        $status_name = "<span class='right badge badge-warning'>Pending</span>";
                        $cancel_btn = "<button class='btn elevation-1 btn-danger btn-xs' data-toggle='modal' data-target='#cancel-reservation-$appointment_id'> Cancel</button>";
                    }
                    if ($status == 1){
                        $status_name = "<span class='right badge badge-success'>Completed</span>";
                        $cancel_btn = "";
                        $consultation_btn = "";
                    }
                    if ($status == 2){
                        $status_name = "<span class='right badge badge-danger'>Cancelled</span>";
                        $cancel_btn = "";
                        $consultation_btn = "";
                    }
                    
                    echo "<tr>
                        <td class='text-center'>
                        $cancel_btn $consultation_btn
                        </td>
                        <td>$appointment_no</td>
                        <td>$appointment_name</td>
                        <td>$date</td>
                        <td>$p_first_name $p_middle_name $p_last_name</td>
                        <td>$clinic_name</td>
                        <td>$service_name</td>
                        <td>$dr_first_name $dr_middle_name $dr_last_name</td>
                        <td>$amount</td>
                        <td>$remarks</td>
                        <td>$status_name</td>
                        </tr>";
                    
                    include 'cancel-modal.php';
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
      "responsive": false, "lengthChange": true, "autoWidth": false, "scrollX": true, "ordering": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
