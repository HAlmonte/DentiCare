<?php 
if(isset($_POST['add-doctor'])){
    $temp = explode(".", $_FILES["upload_identity"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["upload_identity"]["name"]);
    
    if (move_uploaded_file($_FILES["upload_identity"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["upload_identity"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $doctor_id= null;
        $first_name= $_POST['first_name'];
        $middle_name= $_POST['middle_name'];
        $last_name= $_POST['last_name'];
        $specialization= $_POST['specialization'];
        $address= $_POST['address'];
        $contact= $_POST['contact'];
        $upload_identity= $newfilename;
        $username= $_POST['username'];
        $password= $_POST['password'];
        $password= md5($password);
        $status= $_POST['status'];
        
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_doctor VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("sssssssssss", $doctor_id, $first_name, $middle_name, $last_name, $specialization, $address, $contact, $upload_identity, $username, $password, $status);
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
            title: '$first_name $middle_name $last_name Successfully Added!'
            })
            });

            });
            </script>
            ";
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> added doctor <b>$first_name $middle_name $last_name</b>.";
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
if(isset($_POST['edit-doctor'])){
    $doctor_id= $_POST['doctor_id'];
    $first_name= $_POST['first_name'];
    $middle_name= $_POST['middle_name'];
    $last_name= $_POST['last_name'];
    $specialization= $_POST['specialization'];
    $address= $_POST['address'];
    $contact= $_POST['contact'];
    $username= $_POST['username'];
    $status= $_POST['status'];
        
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_doctor SET first_name = ?, middle_name = ?, last_name = ?, specialization = ?, address = ?, contact = ?, username = ?, status = ? WHERE doctor_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssssssss", $first_name, $middle_name, $last_name, $specialization, $address, $contact, $username, $status, $doctor_id);
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
        title: ' $first_name $middle_name $last_name Successfully Updated!'
        })
        });

        });
        </script>
        ";
        
        if ($_SESSION['user_type'] == 1){//administrator
          echo "<meta http-equiv='refresh' content='3;url=doctor.php' />";
        }
        
        //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited doctor <b>$first_name $middle_name $last_name</b>.";
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
if(isset($_POST['delete-doctor'])){
    $doctor_id= $_POST['doctor_id'];
    
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
        $sql="DELETE FROM tbl_doctor WHERE doctor_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $doctor_id);
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
if(isset($_POST['edit-upload_identity'])){
    $temp = explode(".", $_FILES["upload_identity"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["upload_identity"]["name"]);
    
    if (move_uploaded_file($_FILES["upload_identity"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["upload_identity"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $doctor_id= $_POST['doctor_id'];
        $upload_identity= $newfilename;
        $old_upload_identity= $_POST['old_upload_identity'];

        require_once '../database&config/config.php';    
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_doctor SET upload_identity = ? WHERE doctor_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $upload_identity, $doctor_id);
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
            
            if ($_SESSION['user_type'] == 1){//administrator
                echo "<meta http-equiv='refresh' content='3;url=doctor.php' />";
            }
            if ($_SESSION['user_type'] == 2){//doctor
                echo "<meta http-equiv='refresh' content='3;url=edit-doctor.php?doctor_id=$doctor_id' />";
            }
            
                $old_upload_identity = $_POST ['old_upload_identity'];
                if ($old_upload_identity != 'img-default.jpg'){
                    //delete old upload_identity
                    unlink("../uploads/$old_upload_identity");
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
    $doctor_id= $_POST['doctor_id'];
    $password= $_POST['password'];
    $password= md5($password);
    
    require_once '../database&config/config.php'; 
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_doctor SET password = ? WHERE doctor_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $password, $doctor_id);
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
            if ($_SESSION['user_type'] == 1){//administrator
                echo "<meta http-equiv='refresh' content='3;url=doctor.php' />";
            }
            if ($_SESSION['user_type'] == 2){//doctor
                echo "<meta http-equiv='refresh' content='3;url=edit-doctor.php?doctor_id=$doctor_id' />";
            }
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
}
?>