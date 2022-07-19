<?php
require_once '../database&config/config.php';
$cn = new mysqli (HOST, USER, PW, DB);
// Check connection
if (!$cn) {
 die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['username'])){
    $username = mysqli_real_escape_string($cn,$_POST['username']);

    $query = "SELECT COUNT(*) AS cnt_username FROM tbl_patient WHERE username='".$username."'";
    
    $result = mysqli_query($cn,$query);
    
    $response = "";
    echo "<script>
    document.getElementById('add-patient_btn').disabled = false;
    document.getElementById('username').className = 'form-control form-control-border is-valid';
    </script>";
    
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
    
        $count = $row['cnt_username'];
        
        if($count > 0){
            $response = "<span style='color: red;'>Already Exist</span>";
            echo "<script>
            document.getElementById('add-patient_btn').disabled = true;
            document.getElementById('username').className = 'form-control form-control-border is-invalid';
            </script>";
        }
       
    }
    
    echo $response;
    die;
}
