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
            <h1>About</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <!-- Default box -->
            
          <div class="col-lg-8">
          <div class="card">
              <form method="post">
                  <div class="card-body">
                      <div class="form-group">
                          <label for="app_name">App Name</label>
                          <input type="text" class="form-control form-control-border" id="app_name" name="app_name" placeholder="Parish Name" value="<?php echo $app_name;?>" required>
                          <input type="text" name="about_id" value="<?php echo $about_id;?>" hidden>
                      </div>
                      <div class="form-group">
                        <label for="address">Address</label>
                        <textarea type="text" class="form-control form-control-border" id="address" name="address" placeholder="Address" required><?php echo $address;?></textarea>
                      </div>
                      <div class="form-group">
                          <label for="contact">Contact Number</label>
                          <input type="text" class="form-control form-control-border" id="contact" name="contact" placeholder="Contact Number" value="<?php echo $contact;?>" required>
                      </div>
                      <div class="form-group">
                        <label for="info">About</label>
                        <textarea type="text" class="form-control form-control-border" id="info" name="info" placeholder="About the Parish" required><?php echo $info;?></textarea>
                      </div>
                  </div>
                  <div class="card-footer">
                      <input type="submit" class="btn btn-primary elevation-1" id="add-donation_btn" name="update-about" value="Save">
                  </div>
              </form>
            <!-- /.card-body -->          
          </div>
          <!-- /.card -->
              
              <div class="card">
              <div class="card-body text-center">
                  <img src='../uploads/<?php echo $background_image; ?>' class='img elevation-3' style='width:500px;' alt='Background Image'><br>
              </div>
              <div class="card-footer">
                  <button class='btn elevation-1 btn-warning btn-sm' data-toggle='modal' data-target='#edit-background_image'>
                      <i class='nav-icon fas fa-pen'></i> Update Background Image</button>
              </div>
            <!-- /.card-body -->          
          </div>
          <!-- /.card -->
              
            </div>

            <!-- Default box -->
          <div class="col-lg-4">
          <div class="card">
              <div class="card-body text-center">
                  <img src='../uploads/<?php echo $logo; ?>' class='img elevation-3' style='width:200px;' alt='Logo'><br>
              </div>
              <div class="card-footer">
                  <button class='btn elevation-1 btn-warning btn-sm' data-toggle='modal' data-target='#edit-logo'>
                      <i class='nav-icon fas fa-pen'></i> Update Logo</button>
              </div>
            <!-- /.card-body -->          
          </div>
          <!-- /.card -->
        </div>
        

        </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php 
    include '../header&footer/scripts.php'; 
    include 'edit-logo-modal.php'; 
    include 'edit-background_image-modal.php'; 
    include 'function.php';
    ?>
<script>
  $(function () {
     $("#example1").DataTable({
      "responsive": false, "lengthChange": false, "autoWidth": false, "scrollX":true
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
