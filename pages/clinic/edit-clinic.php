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
            <h1>Edit Clinic</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card col-md-8 mx-auto">
          <?php 
          echo "<script src='../../plugins/jquery/jquery.min.js'></script>";
          include 'function.php'; 
          
          $clinic_id = $_GET['clinic_id'];
          
          require_once '../database&config/config.php';
          $cn = new mysqli (HOST, USER, PW, DB);
          $sql="SELECT c.clinic_id, c.clinic_name, c.doctor_id, dr.first_name, dr.middle_name, dr.last_name, c.upload_permit, c.address, c.latitude, c.longitude, c.status
          FROM tbl_clinic AS c
          LEFT JOIN tbl_doctor AS dr
          ON c.doctor_id = dr.doctor_id
          WHERE c.clinic_id = ?";
          $qry=$cn->prepare($sql);
          $qry->bind_param("s", $clinic_id);
          $qry->execute();
          $qry->bind_result($clinic_id, $clinic_name, $doctor_id, $dr_first_name, $dr_middle_name, $dr_last_name, $upload_permit, $address, $latitude, $longitude, $status);
          $qry->store_result();
          $qry->fetch();
          ?>
          <form method="post" class="form-horizontal" enctype="multipart/form-data">
            <div class="card-body">     
                <div class="form-group">
                    <label for="clinic_name">Clinic Name</label>
                    <input type="text" class="form-control form-control-border" id="clinic_name" name="clinic_name" value="<?php echo $clinic_name;?>" required>
                    <input type="text"  name="clinic_id" value="<?php echo $clinic_id;?>" hidden>
                    <div id="response"></div>
                </div>
                <div class="form-group">
                    <label for="doctor_id">Doctor</label>
                    <select class='custom-select form-control-border select2' name="doctor_id">
                        <?php
                        echo " <option value='$doctor_id'>$dr_first_name $dr_middle_name $dr_last_name</option>";
                        require_once '../database&config/config.php';
                        $cn = new mysqli (HOST, USER, PW, DB);
                        $sql="SELECT doctor_id, first_name, last_name, middle_name FROM tbl_doctor WHERE doctor_id <> $doctor_id";
                        $qry=$cn->prepare($sql);
                        $qry->execute();
                        $qry->bind_result($doctor_id1, $dr_first_name1, $dr_last_name1, $dr_middle_name1);
                        $qry->store_result();
                        while ($qry->fetch()){
                            echo "
                            <option value='$doctor_id1'>$dr_first_name1 $dr_last_name1 $dr_middle_name1</option>
                            ";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required><?php echo $address;?></textarea>
                </div><div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" class="form-control form-control-border" id="longitude" name="longitude" value="<?php echo $longitude;?>" required>
                </div>
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" class="form-control form-control-border" id="latitude" name="latitude" value="<?php echo $latitude;?>" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class='custom-select form-control-border' name="status">
                        <?php
                        if ($status == 1){
                            echo "
                            <option value='1'>Verified</option>
                            <option value='0'>Rejected</option>
                            <option value='3'>Pending</option>
                            ";
                        }
                        if ($status == 0){
                            echo "
                            <option value='0'>Rejected</option>
                            <option value='3'>Pending</option>
                            <option value='1'>Verified</option>
                            ";
                        }
                        if ($status == 3){
                            echo "
                            <option value='3'>Pending</option>
                            <option value='0'>Rejected</option>
                            <option value='1'>Verified</option>
                            ";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <a href="javascript:history.back()">
                    <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Close</button>
                </a>
              <input type="submit" class="btn btn-primary btn-sm elevation-1" name="edit-clinic" id="edit-clinic_btn" value="Save">
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

<?php include '../header&footer/scripts.php';?>
<script>
$(function () {
      $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false, "scrollX":true
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      
      $("#example2").DataTable({
      "responsive": false, "lengthChange": true, "autoWidth": false, "scrollX":true,
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
  });
    
    function checkNumber() {
        var contact = document.getElementById("contact").value;
        var prev_contact = contact;
        if (contact > 09999999999) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("edit-clinic_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (contact < 09000000000) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("edit-clinic_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (isNaN(contact)){
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("edit-clinic_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else {
            document.getElementById("response_contact").innerHTML = "<span style='color: green;'>Valid Phone Number</span>";
            document.getElementById("edit-clinic_btn").disabled = false;
            document.getElementById('contact').className = 'form-control form-control-border is-valid';
        }
    }
</script>
</body>
</html>
