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
            <h1>Modules</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <?php 
        $module_id = $_GET['module_id'];
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="SELECT m.module_id, m.g_level_id, m.module_name, m.description, m.quarter, m.user_id, g.grade_level
        FROM tbl_module AS m
        LEFT JOIN tbl_grade_level AS g
        ON m.g_level_id = g.g_level_id
        WHERE m.module_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $module_id);
        $qry->execute();
        $qry->bind_result($module_id, $g_level_id, $module_name, $description, $quarter, $user_id, $grade_level);
        $qry->store_result();
        $qry->fetch();
        include 'function.php';
        ?>
      <!-- Default box -->
        
      <div class="card">
          <form method="post">
          <div class="card-body">
                <div class="form-group">
                    <label for="module_name">Module Name</label>
                    <input type="text" class="form-control form-control-border" id="module_name" name="module_name" value="<?php echo $module_name;?>" required>
                    <div id="response" ></div>
                    <input type="text" name="module_id" value="<?php echo $module_id; ?>" hidden>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control form-control-border" rows="3" id="description" name="description" required><?php echo $description; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="g_level_id">Grade Level</label>
                    <select class="form-control select2" id="g_level_id" name="g_level_id" required>
                        <?php
                        echo "<option value='$g_level_id'>$grade_level</option>";
                        require_once '../database&config/config.php';
                        $cn = new mysqli (HOST, USER, PW, DB);
                        $sql="SELECT g_level_id, grade_level FROM tbl_grade_level WHERE g_level_id <> '$g_level_id'";
                        $qry=$cn->prepare($sql);
                        $qry->execute();
                        $qry->bind_result($g_level_id, $grade_level);
                        $qry->store_result();
                        while($qry->fetch()){
                            echo "<option value='$g_level_id'>$grade_level</option>";
                        }
                        ?>
                    </select>
                  </div>
               <div class="form-group">
                    <label for="quarter">Quarter</label>
                    <select class="form-control" id="quarter" name="quarter" required>
                        <?php
                        if ($quarter == 1){
                            echo "
                            <option value='1'>1st Quarter</option>
                            <option value='2'>2nd Quarter</option>
                            <option value='3'>3rd Quarter</option>
                            <option value='4'>4th Quarter</option>";
                        }
                        else if ($quarter == 2){
                            echo "
                            <option value='2'>2nd Quarter</option>
                            <option value='3'>3rd Quarter</option>
                            <option value='4'>4th Quarter</option>
                            <option value='1'>1st Quarter</option>";
                        }
                        else if ($quarter == 3){
                            echo "
                            <option value='3'>3rd Quarter</option>
                            <option value='4'>4th Quarter</option>
                            <option value='1'>1st Quarter</option>
                            <option value='2'>2nd Quarter</option>";
                        }
                        else if ($quarter == 4){
                            echo "
                            <option value='4'>4th Quarter</option>
                            <option value='1'>1st Quarter</option>
                            <option value='2'>2nd Quarter</option>
                            <option value='3'>3rd Quarter</option>";
                        }
                        ?>
                        
                   </select>
              </div>
              </div>
          <div class="card-footer justify-content-between">
              <a href="module.php">
                <button type="button" class="btn elevation-1 btn-sm btn-default " data-dismiss="modal">Close</button>
              </a>
              <input type="submit" class="btn elevation-1 btn-sm btn-primary " name="edit-module" value="Save">
            </div>
              </form>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include '../header&footer/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include '../header&footer/scripts.php';  ?>
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
