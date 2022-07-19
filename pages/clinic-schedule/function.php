<?php 
if(isset($_POST['add-clinic_schedule'])){
    include '../header&footer/scripts.php';
    
    $schedule_id= null;
    $clinic_id= $_POST['clinic_id'];
    $date= $_POST['date'];
    $slots= $_POST['slots'];
    
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_clinic_schedule VALUES (?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssss", $schedule_id, $clinic_id, $date, $slots);
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
            title: 'Successfully added!'
            })
            });

            });
            </script>
            <meta http-equiv='refresh' content='3;url=clinic-schedule.php' />
            ";
            
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> added clinic schedule <b>$slots slots on $date</b>.";
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
if(isset($_POST['edit-clinic_schedule'])){
    include '../header&footer/scripts.php';
    
    $schedule_id= $_POST['schedule_id'];
    $clinic_id= $_POST['clinic_id'];
    $date= $_POST['date'];
    $slots= $_POST['slots'];
    
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_clinic_schedule SET clinic_id = ?, date = ?, slots = ? WHERE schedule_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ssss", $clinic_id, $date, $slots, $schedule_id);
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
        <meta http-equiv='refresh' content='3;url=clinic-schedule.php' />
        ";
        
         //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited clinic schedule <b>$slots slots on $date</b>.";
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
if(isset($_POST['delete-clinic_schedule'])){
    include '../header&footer/scripts.php';
    
    $schedule_id= $_POST['schedule_id'];
    
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
        $sql="DELETE FROM tbl_clinic_schedule WHERE schedule_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $schedule_id);
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
        $activity = "<b>$user_full_name</b> deleted a clinic_schedule.";
        include '../activity-log/activity-log-function.php';
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
    
    
}
?>