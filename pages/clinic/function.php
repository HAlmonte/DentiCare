<?php 
if(isset($_POST['add-clinic'])){
    $temp = explode(".", $_FILES["upload_permit"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["upload_permit"]["name"]);
    
    if (move_uploaded_file($_FILES["upload_permit"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["upload_permit"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $clinic_id= null;
        $clinic_name= $_POST['clinic_name'];
        $doctor_id= $_POST['doctor_id'];
        $upload_permit= $newfilename;
        $address= $_POST['address'];
        $latitude= $_POST['latitude'];
        $longitude= $_POST['longitude'];
        $status= $_POST['status'];
        
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_clinic VALUES (?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ssssssss", $clinic_id, $clinic_name, $doctor_id, $upload_permit, $address, $latitude, $longitude, $status);
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
            title: '$clinic_name Successfully Added!'
            })
            });

            });
            </script>
            ";
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> added clinic <b>$clinic_name</b>.";
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
if(isset($_POST['edit-clinic'])){
    $clinic_id= $_POST['clinic_id'];
    $clinic_name= $_POST['clinic_name'];
    $doctor_id= $_POST['doctor_id'];
    $address= $_POST['address'];
    $latitude= $_POST['latitude'];
    $longitude= $_POST['longitude'];
    $status= $_POST['status'];
        
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_clinic SET clinic_name = ?, doctor_id = ?, address = ?, latitude = ?, longitude = ?, status = ? WHERE clinic_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssssss", $clinic_name, $doctor_id, $address, $latitude, $longitude, $status, $clinic_id);
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
        ";
        
        if ($_SESSION['user_type'] == 1){//admin
            echo "<meta http-equiv='refresh' content='3;url=clinic.php' />";
        }
        if ($_SESSION['user_type'] == 2){//doctor
            echo "<meta http-equiv='refresh' content='3;url=my-clinic.php' />";
        }
        
        //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited clinic <b>$clinic_name</b>.";
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
if(isset($_POST['delete-clinic'])){
    $clinic_id= $_POST['clinic_id'];
    
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
        $sql="DELETE FROM tbl_clinic WHERE clinic_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $clinic_id);
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
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
    
    
}
if(isset($_POST['edit-upload_permit'])){
    $temp = explode(".", $_FILES["upload_permit"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["upload_permit"]["name"]);
    
    if (move_uploaded_file($_FILES["upload_permit"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["upload_permit"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $clinic_id= $_POST['clinic_id'];
        $upload_permit= $newfilename;
        $old_upload_permit= $_POST['old_upload_permit'];

        require_once '../database&config/config.php';    
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_clinic SET upload_permit = ? WHERE clinic_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $upload_permit, $clinic_id);
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
                    title: 'Successfully Updated!'
                    })
                    });

                    });
                    </script>
                ";
            
                $old_upload_permit = $_POST ['old_upload_permit'];
                if ($old_upload_permit != 'img-default.jpg'){
                    //delete old upload_permit
                    unlink("../uploads/$old_upload_permit");
                }
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
                title: 'Unable to Delete!'
                })
                });

                });
                </script>
            ";
        }
    }
}
if(isset($_POST['edit-password'])){
    $clinic_id= $_POST['clinic_id'];
    $password= $_POST['password'];
    $password= md5($password);
    
    require_once '../database&config/config.php'; 
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_clinic SET password = ? WHERE clinic_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $password, $clinic_id);
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
                title: 'Password Successfully Updated!'
                })
                });

                });
                </script>
            ";
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
}
?>