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
            <h1>Add Consultation</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php
        
        $appointment_id = $_GET['appointment_id'];
        $patient_id = $_GET['patient_id'];
        ?>
      <!-- Default box -->
      <div class="card">
          <form method="post" enctype="multipart/form-data">
              <div class="card-body">
                  <div class="form-group">
                      <label for="diagnosis">Diagnosis</label>
                      <textarea type="text" class="form-control form-control-border" id="diagnosis" name="diagnosis" placeholder="Diagnosis" required></textarea>
                      <input type="text" name="appointment_id" value="<?php echo $appointment_id;?>" hidden>
                      <input type="text" name="patient_id" value="<?php echo $patient_id;?>" hidden>
                  </div>
                  <div class="form-group">
                      <label for="treatment">Treatment</label>
                      <textarea type="text" class="form-control form-control-border" id="treatment" name="treatment" placeholder="Treatment" required></textarea>
                  </div>
                  <div class="form-group">
                      <label for="upload_prescription">Upload Prescription</label>
                      <input type="file" class="form-control form-control-border" id="upload_prescription" name="upload_prescription" placeholder="Upload Prescription" accept="image/*" required>
                  </div>
              </div>
              <div class="card-footer">
                  <a href="javascript:history.back()">
                      <button type="button" class="btn btn-sm btn-default elevation-1">Cancel</button>
                  </a>
                  <input type="submit" class="btn btn-primary btn-sm elevation-1" name="add-consultation" id="add-consultation_btn" value="Add Consultation">
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

<?php include '../header&footer/scripts.php'; include 'function.php';?>
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
    <script>
    //File Validation
var uploadField2 = document.getElementById("upload_prescription");

uploadField2.onchange = function() {
    if(this.files[0].type != 'image/jpeg' && this.files[0].type != 'image/png'){
        $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: 'File is not an Image'
                })
                });

                });
       this.value = "";
    };
    if(this.files[0].size > 2097152){
//       alert("File is too big! Please select image less than 2mb.");
        $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'error',
                title: 'Image too large! Image must not exceed 2mb.'
                })
                });

                });
       this.value = "";
    };
};
</script>
</body>
</html>
