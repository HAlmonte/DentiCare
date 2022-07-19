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
            <h1>Edit Patient</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
        include 'function.php'; 
        
        $patient_id = $_GET['patient_id'];
        
        require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT patient_id, first_name, last_name, middle_name, birthdate, address, contact, upload_identity, username, password, status FROM tbl_patient WHERE patient_id = ?";
                $qry=$cn->prepare($sql);
                $qry->bind_param('s', $patient_id);
                $qry->execute();
                $qry->bind_result($patient_id, $first_name, $last_name, $middle_name, $birthdate, $address, $contact, $upload_identity, $username, $password, $status);
                $qry->store_result();
                $qry->fetch();
        
        include 'edit-upload_identity-modal.php';
        include 'edit-password-modal.php';
        ?>
      <!-- Default box -->
      <div class="card">
          <form method="post">
        <div class="card-body">
            <div class="text-center">                      
                      <ul class="list-group list-group-unbordered mb-3">
                          <li class="list-group-item">
                              <img class="img-circle elevation-2" style="height:200px;" src="../uploads/<?php echo $upload_identity; ?>" alt="User profile picture"><br>
                          </li>
                          <li class="list-group-item">
                              <button type="button" class='btn btn-sm elevation-1 btn-warning btn-xs' data-toggle='modal' data-target='#edit-upload_identity-<?php echo $patient_id;?>'><i class='nav-icon fas fa-pen'></i> Edit Picture</button>
                          </li>
                      </ul>
                  </div>
            <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" name="patient_id" value="<?php echo $patient_id;?>" hidden>
                    <input type="text" class="form-control form-control-border" id="first_name" name="first_name" value="<?php echo $first_name;?>" required>
                </div>
                <div class="form-group">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" class="form-control form-control-border" id="middle_name" name="middle_name" value="<?php echo $middle_name;?>" required>
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control form-control-border" id="last_name" name="last_name" value="<?php echo $last_name;?>" required>
                </div>
                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" class="form-control form-control-border" id="birthdate" name="birthdate" value="<?php echo $birthdate;?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control form-control-border" rows="3" id="address" name="address" placeholder="Address" required><?php echo $address;?></textarea>
                </div>
                <div class="form-group">
                    <label for="contact">Contact Number</label>
                    <input type="text" class="form-control form-control-border" id="contact" name="contact" value="<?php echo $contact;?>" oninput="checkNumber()" maxlength="11" required>
                    <div id="response_contact"></div>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control form-control-border" id="username" name="username" value="<?php echo $username;?>" required>
                    <div id="response"></div>
                </div>
                <div class="form-group">
                      <label>Password</label>
                      <button type="button" class='form-control btn btn-sm elevation-1 btn-default btn-sm' data-toggle='modal' data-target='#edit-password-<?php echo $patient_id;?>'>Change Password</button>
                  </div>
                <div class="form-group">
                    <label for="status">Quarter</label>
                    <select class="form-control" id="status" name="status" required>
                        <?php
                        if ($status == 1){
                            echo "<option value='1'>Active</option>
                                <option value='2'>Inactive</option>";
                        }
                        else {
                            echo "
                                <option value='2'>Inactive</option>
                                <option value='1'>Active</option>";
                        }
                        ?>
                        
                   </select>
              </div>
        </div>
        <!-- /.card-body -->
          <div class="card-footer">
                  <a href="javascript:history.back()">
                      <button type="button" class="btn btn-default btn-sm elevation-1" data-dismiss="modal">Close</button>
                  </a>
                  <input type="submit" class="btn btn-primary btn-sm elevation-1" name="edit-patient" value="Save">
            </div>
          </form>
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
