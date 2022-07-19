<?php 
if(isset($_POST['add-reservation'])){
    include '../header&footer/scripts.php';
      
    $appointment_id= null;
    $appointment_type= $_POST['appointment_type'];
    $date= $_POST['date'];
    $patient_id= $_POST['patient_id'];
    $service_id= $_POST['service_id'];
    $remarks= $_POST['remarks'];
    $status= 0;
    
    require_once '../database&config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT appointment_id FROM `tbl_reservation` ORDER BY appointment_id DESC;";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($appointment_id_no);
    $qry->store_result();
    $qry->fetch();
    $appointment_no = str_replace(" ","", "$appointment_id_no $date");
    

    
    $clinic_id= $_POST['clinic_id'];
    
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_reservation VALUES (?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssssssss", $appointment_id, $appointment_no, $appointment_type, $date, $patient_id, $service_id, $remarks, $status);
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
            <meta http-equiv='refresh' content='3;url=reservation.php' />
            ";
            
            //get no. of slots in tbl_clinic_schedule
            require_once '../database&config/config.php';
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT slots FROM tbl_clinic_schedule WHERE clinic_id = '$clinic_id' AND date = '$date'";
            $qry=$cn->prepare($sql);
            $qry->execute();
            $qry->bind_result($current_slot);
            $qry->store_result();
            $qry->fetch();
            
            //subtract slots
            $current_slot = $current_slot - 1;
            
            //update tbl_schedule
            require_once '../database&config/config.php';    
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="UPDATE tbl_clinic_schedule SET slots = '$current_slot' WHERE clinic_id = '$clinic_id' AND date = '$date'";
            $qry=$cn->prepare($sql);
            $qry->execute();
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> added appointment <b>$appointment_no</b>.";
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
if(isset($_POST['edit-reservation'])){
    include '../header&footer/scripts.php';
    
    $appointment_id= $_POST['appointment_id'];
    $g_level_id= $_POST['g_level_id'];
    $reservation_name= $_POST['reservation_name'];
    $description= $_POST['description'];
    $quarter= $_POST['quarter'];
    
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_reservation SET g_level_id = ?, reservation_name = ?, description = ?, quarter = ? WHERE appointment_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssss", $g_level_id, $reservation_name, $description, $quarter, $appointment_id);
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
        <meta http-equiv='refresh' content='3;url=reservation.php' />
        ";
        
         //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited reservation <b>$reservation_name</b>.";
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
if(isset($_POST['delete-reservation'])){
    include '../header&footer/scripts.php';
    
    $appointment_id= $_POST['appointment_id'];
    $appointment_no= $_POST['appointment_no'];
    
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
        $sql="DELETE FROM tbl_reservation WHERE appointment_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $appointment_id);
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
        $activity = "<b>$user_full_name</b> deleted appointment <b>$appointment_no</b>.";
        include '../activity-log/activity-log-function.php';
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
    
    
}
if(isset($_POST['add-reservation-patient'])){
    include '../header&footer/scripts.php';
    
    $appointment_id= null;
    $appointment_type= $_POST['appointment_type'];
    $date= $_POST['date'];
    $patient_id= $_SESSION['user_id'];
    $service_id= $_POST['service_id'];
    $remarks= $_POST['remarks'];
    $status= 0;
    
    $clinic_id= $_POST['clinic_id'];
    
    require_once '../database&config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT appointment_id FROM `tbl_reservation` ORDER BY appointment_id DESC;";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($appointment_id_no);
    $qry->store_result();
    $qry->fetch();
    $appointment_no = str_replace(" ","", "$appointment_id_no $date");
    
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_reservation VALUES (?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssssssss", $appointment_id, $appointment_no, $appointment_type, $date, $patient_id, $service_id, $remarks, $status);
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
            <meta http-equiv='refresh' content='3;url=reservation-patient.php' />
            ";
            
            //get no. of slots in tbl_clinic_schedule
            require_once '../database&config/config.php';
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT slots FROM tbl_clinic_schedule WHERE clinic_id = '$clinic_id' AND date = '$date'";
            $qry=$cn->prepare($sql);
            $qry->execute();
            $qry->bind_result($current_slot);
            $qry->store_result();
            $qry->fetch();
            
            //subtract slots
            $current_slot = $current_slot - 1;
            
            //update tbl_schedule
            require_once '../database&config/config.php';    
            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="UPDATE tbl_clinic_schedule SET slots = '$current_slot' WHERE clinic_id = '$clinic_id' AND date = '$date'";
            $qry=$cn->prepare($sql);
            $qry->execute();
                
            //activity log
            $log_id = '';
            $activity = "Patient <b>$user_full_name</b> added appointment <b>$appointment_no</b>.";
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
if(isset($_POST['cancel-reservation'])){
    include '../header&footer/scripts.php';
    
    $appointment_id= $_POST['appointment_id'];
    $appointment_no= $_POST['appointment_no'];
    
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_reservation SET status = 2 WHERE appointment_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("s", $appointment_id);
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
        <meta http-equiv='refresh' content='3;url=reservation-patient.php' />
        ";
        
         //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> cancelled reservation <b>$appointment_no</b>.";
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
?>