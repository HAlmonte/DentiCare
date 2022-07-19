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
            <h1>Clinic Schedule</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
        include 'add-modal.php'; 
        include 'function.php'; 
        
        $schedule_id = $_GET['schedule_id'];
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="SELECT cs.schedule_id, cs.clinic_id, cs.date, cs.slots, c.clinic_name 
        FROM tbl_clinic_schedule AS cs
        LEFT JOIN tbl_clinic AS c
        ON cs.clinic_id = c.clinic_id
        WHERE cs.schedule_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $schedule_id);
        $qry->execute();
        $qry->bind_result($schedule_id, $clinic_id, $date, $slots, $clinic_name);
        $qry->store_result();
        $qry->fetch();
        
        ?>
      <!-- Default box -->
      <div class="card">
          <form method="post">
              <div class="card-body">
                  <?php
                  if ($_SESSION['user_type'] == 1){//admin
                      echo "<div class='form-group'>
                      <label for='clinic_id'>Clinic</label>
                      <select class='form-control select2' id='clinic_id' name='clinic_id' required>
                      <option value='$clinic_id'>$clinic_name</option>";
                      require_once '../database&config/config.php';
                      $cn = new mysqli (HOST, USER, PW, DB);
                      $sql="SELECT clinic_id, clinic_name FROM tbl_clinic WHERE clinic_id <> $clinic_id";
                      $qry=$cn->prepare($sql);
                      $qry->execute();
                      $qry->bind_result($clinic_id, $clinic_name);
                      $qry->store_result();
                      while($qry->fetch()){
                          echo "<option value='$clinic_id'>$clinic_name</option>";
                      }
                      echo    "</select>
                                </div>";
                  }
                  if ($_SESSION['user_type'] == 2){//doctor
                      echo "
                      <div class='form-group'>
                      <label for='clinic_id'>Clinic</label>
                      <input type='text' class='form-control form-control-border' value='$clinic_name' readonly>
                      <input type='text' name='clinic_id' value='$clinic_id' hidden>
                      </div>";
                  }
                  ?>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control form-control-border" name="date" id="date" value="<?php echo $date;?>" required>
                </div>
                <div class="form-group">
                    <label for="slots">Slots Available</label>
                    <input type="text" name="schedule_id"  value="<?php echo $schedule_id;?>" hidden>
                    <input type="number" class="form-control form-control-border" name="slots" id="slots" value="<?php echo $slots;?>" required>
                </div>
              </div>
              <div class="card-footer">
                  <a href="clinic-schedule.php">
                      <button type="button" class="btn elevation-1 btn-sm btn-default ">Close</button>
                  </a>
                  <input type="submit" class="btn elevation-1 btn-sm btn-primary " id="edit-clinic_schedule_btn" name="edit-clinic_schedule" value="Save">
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
