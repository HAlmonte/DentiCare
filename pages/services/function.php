<?php 
if(isset($_POST['add-service'])){
    include '../header&footer/scripts.php';
    
    $service_id= null;
    $clinic_id= $_POST['clinic_id'];
    $doctor_id= $_POST['doctor_id'];
    $service_name= $_POST['service_name'];
    $description= $_POST['description'];
    $amount= $_POST['amount'];
    
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_services VALUES (?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssssss", $service_id, $clinic_id, $doctor_id, $service_name, $description, $amount);
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
            title: '$service_name Successfully added!'
            })
            });

            });
            </script>
            <meta http-equiv='refresh' content='3;url=services.php' />
            ";
            
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> added service <b>$service_name</b>.";
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
if(isset($_POST['edit-service'])){
    include '../header&footer/scripts.php';
    
    $service_id= $_POST['service_id'];
    $clinic_id= $_POST['clinic_id'];
    $doctor_id= $_POST['doctor_id'];
    $service_name= $_POST['service_name'];
    $description= $_POST['description'];
    $amount= $_POST['amount'];
    
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_services SET clinic_id = ?, doctor_id = ?, service_name = ?, description = ?, amount = ? WHERE service_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssssss", $clinic_id, $doctor_id, $service_name, $description, $amount, $service_id);
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
        <meta http-equiv='refresh' content='3;url=services.php' />
        ";
        
         //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited service <b>$service_name</b>.";
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
if(isset($_POST['delete-service'])){
    include '../header&footer/scripts.php';
    
    $service_id= $_POST['service_id'];
    $service_name= $_POST['service_name'];
    
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
        $sql="DELETE FROM tbl_services WHERE service_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $service_id);
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
        $activity = "<b>$user_full_name</b> deleted service <b>$service_name</b>.";
        include '../activity-log/activity-log-function.php';
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
    
    
}
?>