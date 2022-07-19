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
            <h1>Edit Services</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
        include 'function.php'; 
        
        $service_id = $_GET['service_id'];
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="SELECT s.service_id, s.clinic_id, s.doctor_id, s.service_name, s.description, s.amount, c.clinic_name, d.first_name, d.middle_name, d.last_name
        FROM tbl_services AS s
        LEFT JOIN tbl_clinic AS c
        ON s.clinic_id = c.clinic_id
        LEFT JOIN tbl_doctor AS d
        ON s.doctor_id = d.doctor_id
        WHERE s.service_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $service_id);
        $qry->execute();
        $qry->bind_result($service_id, $clinic_id, $doctor_id, $service_name, $description, $amount, $clinic_name, $dr_first_name, $dr_middle_name, $dr_last_name);
        $qry->store_result();
        $qry->fetch();
        ?>
      <!-- Default box -->
      <div class="card">
          <form method="post">
              <div class="card-body">
                  <div class='form-group'>
                      <label for='clinic_id'>Clinic</label>
                      <input type='text' class='form-control form-control-border' value='<?php echo $clinic_name;?>' readonly>
                      <input type='text' name='clinic_id' value='<?php echo $clinic_id;?>' hidden>
                  </div>
                  <div class='form-group'>
                      <label for='clinic_id'>Doctor</label>
                      <input type='text' class='form-control form-control-border' value='<?php echo "$dr_first_name $dr_middle_name $dr_last_name";?>' readonly>
                      <input type='text' name='doctor_id' value='<?php echo $doctor_id;?>' hidden>
                  </div>
                <div class="form-group">
                    <label for="service_name">Service Name</label>
                    <input type="text" id='service_name' name='service_name'  class='form-control form-control-border' value="<?php echo $service_name;?>" required>
                    <input type="text"name='service_id' value="<?php echo $service_id;?>" hidden>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control form-control-border" rows="3" id="description" name="description" placeholder="Description" required><?php echo $description;?></textarea>
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="text" id='amount' name='amount'  class='form-control form-control-border' value="<?php echo $amount;?>" required>
                </div>
              </div>
              <div class="card-footer">
                  <a href="services.php">
                      <button type="button" class="btn elevation-1 btn-sm btn-default ">Close</button>
                  </a>
                  <input type="submit" class="btn elevation-1 btn-sm btn-primary " id="edit-service_btn" name="edit-service" value="Save">
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
    
    function fetch_select(val) {
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
         
    }
</script>
</body>
</html>
