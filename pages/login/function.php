<?php
if(isset($_POST['sign-in'])){
    session_start();
    require_once '../database&config/config.php';
        
    $username= $_POST['username'];
    $password= $_POST['password'];
    $password = md5($password);
        
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT user_id, account_status FROM tbl_user WHERE username=? AND password=?";
    $qry=$cn->prepare($sql);
    $qry->bind_param("ss", $username, $password);
    $qry->execute();
    $qry->bind_result($user_id, $account_status);
    $qry->store_result();
    $qry->fetch();
        
    if($qry->num_rows==1){//chek if administrator
        if ($account_status==1){
            $_SESSION['user_id']=$user_id;
            $_SESSION['user_type']=1;//administrator
            
                header("location:../dashboard/dashboard.php");
            
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
            icon: 'warning',
            title: 'Sorry, your account is deactivated. Please contact your System Administrator.'
            })
            });

            });
            </script>
            ";
            }
            
        }
        else {//check if doctor
           require_once '../database&config/config.php';
        
            $username= $_POST['username'];
            $password= $_POST['password'];
            $password = md5($password);

            $cn = new mysqli (HOST, USER, PW, DB);
            $sql="SELECT doctor_id, status FROM tbl_doctor WHERE username=? AND password=?";
            $qry=$cn->prepare($sql);
            $qry->bind_param("ss", $username, $password);
            $qry->execute();
            $qry->bind_result($doctor_id, $status);
            $qry->store_result();
            $qry->fetch();

            if($qry->num_rows==1){
                if ($status==1){
                    $_SESSION['user_id']=$doctor_id;
                    $_SESSION['user_type']=2;//doctor
            
                header("location:../dashboard/dashboard-doctor.php");
            
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
                icon: 'warning',
                title: 'Sorry, your account is deactivated. Please contact your System Administrator.'
                })
                });

                });
                </script>
                ";
                }
            }
            else {//check if patient
                require_once '../database&config/config.php';
        
                $username= $_POST['username'];
                $password= $_POST['password'];
                $password = md5($password);

                $cn = new mysqli (HOST, USER, PW, DB);
                $sql="SELECT patient_id, status FROM tbl_patient WHERE username=? AND password=?";
                $qry=$cn->prepare($sql);
                $qry->bind_param("ss", $username, $password);
                $qry->execute();
                $qry->bind_result($patient_id, $status);
                $qry->store_result();
                $qry->fetch();
                
                if($qry->num_rows==1){
                    if ($status==1){
                        $_SESSION['user_id']=$patient_id;
                        $_SESSION['user_type']=3;//patient
            
                        header("location:../dashboard/dashboard-patient.php");
            
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
                        icon: 'warning',
                        title: 'Sorry, your account is deactivated. Please contact your System Administrator.'
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
                        title: 'Invalid Username or Password!'
                        })
                        });

                        });
                        </script>
                        ";
                }
            }
        
        }
}
?>