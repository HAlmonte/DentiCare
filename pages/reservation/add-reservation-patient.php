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
            <h1>Add Reservation</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
        include 'add-modal.php'; 
        include 'function.php'; 
        
        $clinic_id = $_GET['clinic_id'];
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="SELECT clinic_id, clinic_name FROM tbl_clinic WHERE clinic_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $clinic_id);
        $qry->execute();
        $qry->bind_result($clinic_id, $clinic_name);
        $qry->store_result();
        $qry->fetch();
        ?>
      <!-- Default box -->
      <div class="card">
          <form method="post">
              <div class="card-body">
                  <div class="form-group">
                    <label for="clinic_id">Clinic Name</label>
                    <input type="text" id='clinic_id' name='clinic_id'  class='form-control form-control-border' value="<?php echo $clinic_name;?>" readonly>
                    <input type="text" id='clinic_id' name='clinic_id'  class='form-control form-control-border' value="<?php echo $clinic_id;?>" hidden>
                  </div>
                  <div class="form-group">
                    <label for="service_id">Services</label>
                    <select class="form-control select2" id="service_id" name="service_id" onchange='fetch_select_doctor(this.value);' required>
                        <?php
                        require_once '../database&config/config.php';
                        $cn = new mysqli (HOST, USER, PW, DB);
                        $sql="SELECT service_id, service_name FROM tbl_services WHERE clinic_id = '$clinic_id'";
                        $qry=$cn->prepare($sql);
                        $qry->execute();
                        $qry->bind_result($service_id, $service_name);
                        $qry->store_result();
                        if($qry->num_rows==0){
                            echo "<option>-- No Services --</option>";
                        }
                        else {
                            echo "<option>-- SELECT SERVICE --</option>";
                        }
                        while($qry->fetch()){
                            echo "<option value='$service_id'>$service_name</option>";
                        }
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="doctor_id">Doctor</label>
                    <select id='doctor_id' name='doctor_id'  class='form-control form-control-border' disabled>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="appointment_type">Appointment Type</label>
                    <select id='appointment_type' name='appointment_type' class='form-control form-control-border'>
                        <option>-- SELECT --</option>
                        <option value="1">Virtual</option>
                        <option value="0">Face to Face</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="date">Available Date</label>
                    <select id='date' name='date' class='form-control form-control-border' onchange='fetch_slots(this.value);'>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="remarks">Remarks</label>
                    <input type="text" id='remarks' name='remarks' class='form-control form-control-border' placeholder="Remarks" required>
                  </div> 
              </div>
              <div class="card-footer">
                  <a href="javascript:history.back()">
                      <button type="button" class="btn elevation-1 btn-sm btn-default">Cancel</button>
                  </a>
              <input type="submit" class="btn elevation-1 btn-sm btn-primary " id="add-reservation-patient_btn" name="add-reservation-patient" value="Add Reservation">
              </div>
          </form>
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
      "responsive": false, "lengthChange": true, "autoWidth": false, "scrollX": true
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
    
    function fetch_select_doctor(val) {
        $.ajax({
            type: 'post',
            url: 'get-doctor_id.php',
            data: {
                get_option:val
            },
            success: function (response) {
                document.getElementById('doctor_id').innerHTML=response; 
            }
        });   
        
         $.ajax({
            type: 'post',
            url: 'get-date.php',
            data: {
                get_option_date:val
            },
            success: function (response) {
                document.getElementById('date').innerHTML=response; 
            }
        });
    }
    
</script>
</body>
</html>
