<?php 
if(isset($_POST['add-patient'])){
    $temp = explode(".", $_FILES["upload_identity"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["upload_identity"]["name"]);
    
    if (move_uploaded_file($_FILES["upload_identity"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["upload_identity"]["name"]);
        $newfilename = $filename.$newfilename;
        
        include '../header&footer/scripts.php';

        $patient_id= null;
        $first_name= $_POST['first_name'];
        $middle_name= $_POST['middle_name'];
        $last_name= $_POST['last_name'];
        $birthdate= $_POST['birthdate'];
        $address= $_POST['address'];
        $contact= $_POST['contact'];
        $upload_identity= $newfilename;
        $username= $_POST['username'];
        $password= $_POST['password'];
        $password= md5($password);
        $status= $_POST['status'];
    
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_patient VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("sssssssssss", $patient_id, $first_name, $middle_name, $last_name, $birthdate, $address, $contact, $upload_identity, $username, $password, $status);
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
            title: '$first_name $middle_name $last_name Successfully added!'
            })
            });

            });
            </script>
            <meta http-equiv='refresh' content='3;url=patient.php' />
            ";
            
            
            //activity log
            $log_id = '';
            $activity = "<b>$user_full_name</b> added patient <b>$first_name $middle_name $last_name</b>.";
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
if(isset($_POST['edit-patient'])){
    include '../header&footer/scripts.php';
    
    $patient_id=  $_POST['patient_id'];;
    $first_name= $_POST['first_name'];
    $middle_name= $_POST['middle_name'];
    $last_name= $_POST['last_name'];
    $birthdate= $_POST['birthdate'];
    $address= $_POST['address'];
    $contact= $_POST['contact'];
    $username= $_POST['username'];
    $status= $_POST['status'];
    
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_patient SET first_name = ?, middle_name = ?, last_name = ?, birthdate = ?, address = ?, contact = ?, username = ?, status = ? WHERE patient_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssssssss", $first_name, $middle_name, $last_name, $birthdate, $address, $contact, $username, $status, $patient_id);
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
            echo "<meta http-equiv='refresh' content='3;url=patient.php' />";
        }
        if ($_SESSION['user_type'] == 3){//patient
            echo "<meta http-equiv='refresh' content='3;url=edit-patient.php?patient_id=$patient_id' />";
        }
        
         //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited patient <b>$first_name $middle_name $last_name</b>.";
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
if(isset($_POST['delete-patient'])){
    include '../header&footer/scripts.php';
    
    $patient_id= $_POST['patient_id'];
    $patient_name= $_POST['patient_name'];
    
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
        $sql="DELETE FROM tbl_patient WHERE patient_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $patient_id);
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
                <meta http-equiv='refresh' content='3;url=patient.php' />
            ";
            
            $old_upload_identity = $_POST ['old_upload_identity'];
                if ($old_upload_identity != 'img-default.jpg'){
                    //delete old upload_identity
                    unlink("../uploads/$old_upload_identity");
                }
            
            //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> deleted patient <b>$patient_name</b>.";
        include '../activity-log/activity-log-function.php';
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
    
    
}
if(isset($_POST['edit-upload_identity'])){
    include '../header&footer/scripts.php';
    $temp = explode(".", $_FILES["upload_identity"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["upload_identity"]["name"]);
    
    if (move_uploaded_file($_FILES["upload_identity"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["upload_identity"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $patient_id= $_POST['patient_id'];
        $upload_identity= $newfilename;
        $old_upload_identity= $_POST['old_upload_identity'];

        require_once '../database&config/config.php';    
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_patient SET upload_identity = ? WHERE patient_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $upload_identity, $patient_id);
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
            
            if ($_SESSION['user_type'] == 1){//admin
                echo "<meta http-equiv='refresh' content='3;url=patient.php' />";
            }
            if ($_SESSION['user_type'] == 3){//patient
                echo "<meta http-equiv='refresh' content='3;url=edit-patient.php?patient_id=$patient_id' />";
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
    include '../header&footer/scripts.php';
    
    $patient_id= $_POST['patient_id'];
    $password= $_POST['password'];
    $password= md5($password);
    
    require_once '../database&config/config.php'; 
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_patient SET password = ? WHERE patient_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $password, $patient_id);
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
            
            if ($_SESSION['user_type'] == 1){//admin
                echo "<meta http-equiv='refresh' content='3;url=patient.php' />";
            }
            if ($_SESSION['user_type'] == 3){//patient
                echo "<meta http-equiv='refresh' content='3;url=edit-patient.php?patient_id=$patient_id' />";
            }
        }
        else {
            echo "             <script>             $(function() {             var Toast = Swal.mixin({             toast: true,             position: 'top-end',             showConfirmButton: false,             timer: 3000             });              $(document).ready(function(){             Toast.fire({             icon: 'error',             title: 'There was an error!'             })             });              });             </script>                     ";
        } 
}
?>