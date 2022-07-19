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
        include 'add-modal.php'; 
        include 'function.php'; 
        ?>
      <!-- Default box -->
      <div class="card col-md-8 col mx-auto">
        <div class="card-header">
          <button class="btn btn-info elevation-1 btn-sm" data-toggle="modal" data-target="#add-module"><i class="fa fa-plus"></i> Add</button>
        </div>
        <div class="card-body">
            <table id="example1" class="table table-striped">
                <thead>
                    <tr>
                        <th></th>
                        <th>Mddule Name</th>
                        <th>Description</th>
                        <th>Grade Level</th>
                        <th>Quarter</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                require_once '../database&config/config.php';
                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT m.module_id, m.g_level_id, m.module_name, m.description, m.quarter, m.user_id, g.grade_level
                FROM tbl_module AS m
                LEFT JOIN tbl_grade_level AS g
                ON m.g_level_id = g.g_level_id";
                $qry=$cn->prepare($sql);
                $qry->execute();
                $qry->bind_result($module_id, $g_level_id, $module_name, $description, $quarter, $user_id, $grade_level);
                $qry->store_result();
                while ($qry->fetch()){
                    if ($quarter == 1){
                        $quarter = "1st Quarter";
                    }
                    else if ($quarter == 2){
                        $quarter = "2nd Quarter";
                    }
                    else if ($quarter == 3){
                        $quarter = "3rd Quarter";
                    }
                    else if ($quarter == 4){
                        $quarter = "4th Quarter";
                    }
                    echo "<tr>
                        <td class='text-center'>
                        <a href='edit-module.php?module_id=$module_id'>
                            <button class='btn elevation-1 btn-sm btn-success btn-xs'><i class='nav-icon fas fa-pen'></i></button> 
                        </a>
                        <button class='btn elevation-1 btn-sm btn-danger btn-xs' data-toggle='modal' data-target='#delete-module-$module_id'><i class='nav-icon fas fa-trash'></i></button>
                        </td>
                        <td>$module_name</td>
                        <td>$description</td>
                        <td>$grade_level</td>
                        <td>$quarter</td>
                        </tr>";
                    
                    include 'delete-modal.php';
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
