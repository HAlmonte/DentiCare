<?php 
if(isset($_POST['add-user'])){
    $temp = explode(".", $_FILES["avatar"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["avatar"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $user_id= null;
        $username= $_POST['username'];
        $password= $_POST['password'];
        $password= md5($password);
        $first_name= $_POST['first_name'];
        $middle_name= $_POST['middle_name'];
        $last_name= $_POST['last_name'];
        $email= $_POST['email'];
        $contact= $_POST['contact'];
        $address= $_POST['address'];
        $account_status= $_POST['account_status'];
        $avatar= $newfilename;
        
        require_once '../database&config/config.php';
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="INSERT INTO tbl_user VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $qry=$cn->prepare($sql);
        $qry->bind_param("sssssssssss", $user_id, $username, $password, $first_name, $middle_name, $last_name, $email, $contact, $address, $account_status, $avatar);
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
            $activity = "<b>$user_full_name</b> added user <b>$first_name $middle_name $last_name</b>.";
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
if(isset($_POST['edit-user'])){
    $user_id= $_POST['user_id'];
    $last_name= $_POST['last_name'];
    $first_name= $_POST['first_name'];
    $middle_name= $_POST['middle_name'];
    $contact= $_POST['contact'];
    $email= $_POST['email'];
    $address= $_POST['address'];
    $username= $_POST['username'];
    $account_status= $_POST['account_status'];
    
    
    require_once '../database&config/config.php';    
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="UPDATE tbl_user SET last_name = ?, first_name = ?, middle_name = ?, contact = ?, email = ?, address = ?, username = ?, account_status = ? WHERE user_id = ?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("sssssssss", $last_name, $first_name, $middle_name, $contact, $email, $address, $username, $account_status, $user_id);
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
        <meta http-equiv='refresh' content='3;url=user.php' />
        ";
        
        //activity log
        $log_id = '';
        $activity = "<b>$user_full_name</b> edited user <b>$first_name $middle_name $last_name</b>.";
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
if(isset($_POST['delete-user'])){
    $user_id= $_POST['user_id'];
    
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
        $sql="DELETE FROM tbl_user WHERE user_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("s", $user_id);
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
if(isset($_POST['edit-avatar'])){
    $temp = explode(".", $_FILES["avatar"]["name"]); 
    $newfilename = round(microtime(true)) . '.' . end($temp);   
    
    $target_dir = "../uploads/";
    
    $target_file = $target_dir . basename($_FILES["avatar"]["name"]);
    
    if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file . $newfilename)) {
        $filename = basename($_FILES["avatar"]["name"]);
        $newfilename = $filename.$newfilename;
        
        $user_id= $_POST['user_id'];
        $avatar= $newfilename;
        $old_avatar= $_POST['old_avatar'];

        require_once '../database&config/config.php';    
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_user SET avatar = ? WHERE user_id = ?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $avatar, $user_id);
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
            
                $old_avatar = $_POST ['old_avatar'];
                if ($old_avatar != 'img-default.jpg'){
                    //delete old avatar
                    unlink("../uploads/$old_avatar");
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
    $user_id= $_POST['user_id'];
    $password= $_POST['password'];
    $password= md5($password);
    
    require_once '../database&config/config.php'; 
        $cn = new mysqli (HOST, USER, PW, DB);
        $sql="UPDATE tbl_user SET password = ? WHERE user_id=?";
        $qry=$cn->prepare($sql);
        $qry->bind_param("ss", $password, $user_id);
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