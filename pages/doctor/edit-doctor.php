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
            <h1>Edit User</h1>
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
          if ($_SESSION['user_type'] == 1){//administrator
              $doctor_id = $_GET['doctor_id'];
          }
          if ($_SESSION['user_type'] == 2){//doctor
              $doctor_id = $_SESSION['user_id'];
          }
          require_once '../database&config/config.php';
          $cn = new mysqli (HOST, USER, PW, DB);
          $sql="SELECT doctor_id, first_name, last_name, middle_name, specialization, address, contact, upload_identity, username, password, status FROM tbl_doctor WHERE doctor_id = ?";
          $qry=$cn->prepare($sql);
          $qry->bind_param("s", $doctor_id);
          $qry->execute();
          $qry->bind_result($doctor_id, $first_name, $last_name, $middle_name, $specialization, $address, $contact, $upload_identity, $username, $password, $status);
          $qry->store_result();
          $qry->fetch();
          ?>
          <form method="post" class="form-horizontal">
              <div class="card-body">
                  <div class="text-center">                      
                      <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                              <img class="img-circle elevation-2" style="height:200px;" src="../uploads/<?php echo $upload_identity; ?>" alt="User profile picture"><br>
                          </li>
                          <li class="list-group-item">
                              <button type="button" class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-upload_identity-<?php echo $doctor_id;?>'><i class='nav-icon fas fa-pen'></i> Edit Picture</button>
                          </li>
                      </ul>
                  </div>
                  <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control form-control-border" id="first_name" name="first_name" value="<?php echo $first_name; ?>" required>
                    <input type="text" name="doctor_id" value="<?php echo $doctor_id; ?>" hidden>
                    <input type="text" name="redirect" value="n" hidden>
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" class="form-control form-control-border" id="middle_name" name="middle_name" value="<?php echo $middle_name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control form-control-border" id="last_name" name="last_name" value="<?php echo $last_name; ?>" required>
                </div>
                  <div class="form-group">
                    <label for="specialization">Specialization</label>
                    <input type="text" class="form-control form-control-border" id="specialization" name="specialization" value="<?php echo $specialization; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required><?php echo $address; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control form-control-border" id="contact" name="contact" value="<?php echo $contact; ?>" oninput="checkNumber()" maxlength="11" required>
                    <div id="response_contact"></div>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-border" id="username" name="username" value="<?php echo $username; ?>" required>
                    <div id="response"></div>
                </div>
                  <div class="form-group">
                      <label>Password</label>
                      <button type="button" class='form-control btn btn-sm elevation-1 btn-default btn-sm' data-toggle='modal' data-target='#edit-password-<?php echo $doctor_id;?>'>Change Password</button>
                  </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class='custom-select form-control-border' name="status">
                        <?php 
                        if ($status == 1){
                            echo "
                            <option value='1'>Active</option>
                            <option value='0'>Inactive</option>
                            <option value='3'>Pending</option>";
                        }
                        if ($status == 0){
                            echo "
                            <option value='0'>Inactive</option>
                            <option value='1'>Active</option>
                            <option value='3'>Pending</option>";
                        }
                        if ($status == 3){
                            echo "
                            <option value='3'>Pending</option>
                            <option value='0'>Inactive</option>
                            <option value='1'>Active</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>
              <div class="card-footer">
                  <a href="javascript:history.back()">
                      <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Close</button>
                  </a>
                  <input type="submit" class="btn btn-primary btn-sm elevation-1" name="edit-doctor" value="Save">
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

<?php include '../header&footer/scripts.php'; include 'edit-upload_identity-modal.php'; include 'edit-password-modal.php';?>
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
            document.getElementById("add-doctor_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (contact < 09000000000) {
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("add-doctor_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else if (isNaN(contact)){
            document.getElementById("response_contact").innerHTML = "<span style='color: red;'>Invalid Phone Number</span>";
            document.getElementById("add-doctor_btn").disabled = true;
            document.getElementById('contact').className = 'form-control form-control-border is-invalid';
        }
        else {
            document.getElementById("response_contact").innerHTML = "<span style='color: green;'>Valid Phone Number</span>";
            document.getElementById("add-doctor_btn").disabled = false;
            document.getElementById('contact').className = 'form-control form-control-border is-valid';
        }
    }
</script>
</body>
</html>
