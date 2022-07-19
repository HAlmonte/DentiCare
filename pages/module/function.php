<?php 
if(isset($_POST['add-module'])){
    include '../header&footer/scripts.php';
    
    $module_id= null;
    $g_level_id= $_POST['g_level_id'];
    $module_name= $_POST['module_name'];
    $description= $_POST['description'];
    $quarter= $_POST['quarter'];
    $user_id= $_SESSION['user_id'];
    
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_module VALUES (?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssssss", $module_id, $g_level_id, $module_name, $description, $quarter, $user_id);
        if ($qry->execute()){
            echo "
            <script>
            $(function() {
            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });

            $(document).ready(function(){
            Toast.fire({
            icon: 'success',
            title: '$module_name Successfully added!'
            })
            });

            });
            </script>
            ";
            
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> added module <b>$module_name</b>.";
            include '../activity-log/activity-log-function.php';
        }
        else {
            echo "
                <script>
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
                title: 'There was an error!'
                })
                });

                });
                </script>
                        ";
        } 
    
}
if(isset($_POST['edit-module'])){
    include '../header&footer/scripts.php';
    
    $module_id= $_POST['module_id'];
    $g_level_id= $_POST['g_level_id'];
    $module_name= $_POST['module_name'];
    $description= $_POST['description'];
    $quarter= $_POST['quarter'];
    
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_module SET g_level_id = ?, module_name = ?, description = ?, quarter = ? WHERE module_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssss", $g_level_id, $module_name, $description, $quarter, $module_id);
    if ($qry->execute()){
        echo "
        <script>
        $(function() {
        var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
        });

        $(document).ready(function(){
        Toast.fire({
        icon: 'success',
        title: ' Successfully Updated!'
        })
        });

        });
        </script>
        <meta http-equiv='refresh' content='3;url=module.php' />
        ";
        
         //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited module <b>$module_name</b>.";
        include '../activity-log/activity-log-function.php';
    }
    else {
        echo "
        <script>
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
        title: 'There was an error!'
        })
        });

        });
        </script>
        ";
    }
}
if(isset($_POST['delete-module'])){
    include '../header&footer/scripts.php';
    
    $module_id= $_POST['module_id'];
    $module_name= $_POST['module_name'];
    
//    require_once '../database&config/config.php';
//    $cn = new mysqli (HOST, USER, PW, DB);
//    $sql="SELECT COUNT(tbl_pwd_info.pwd_id) FROM tbl_pwd_info
//            INNER JOIN tbl_blood_type
//            ON tbl_pwd_info.blood_type_id=tbl_blood_type.blood_type_id
//            WHERE tbl_pwd_info.blood_type_id=?";
//    $qry=$cn->prepare($sql);
//    $qry->bind_param("s", $blood_type_id);
//    $qry->execute();
//    $qry->bind_result($no_of_pwd);
//    $qry->store_result();
//    $qry->fetch();
    
        require_once '../database&config/config.php'; 
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="DELETE FROM tbl_module WHERE module_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $module_id);
        if ($qry->execute()){
            echo "
                <script>
                $(function() {
                var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
                });

                $(document).ready(function(){
                Toast.fire({
                icon: 'success',
                title: 'Successfully Deleted!'
                })
                });

                });
                </script>
            ";
            //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> deleted module <b>$module_name</b>.";
        include '../activity-log/activity-log-function.php';
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
    
    
}
?>