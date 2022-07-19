<?php
require_once '../database&config/config.php';
$cn = new mysqli (HOST, USER, PW, DB);
// Check connection
if (!$cn) {
 die("Connection failed: " . mysqli_connect_error());
}

if(isset($_POST['clinic_name'])){
    $clinic_name = mysqli_real_escape_string($cn,$_POST['clinic_name']);

    $query = "SELECT COUNT(*) AS cnt_clinic_name FROM tbl_clinic WHERE clinic_name='".$clinic_name."'";
    
    $result = mysqli_query($cn,$query);
    
    $response = "";
    echo "<script>
    document.getElementById('add-clinic_btn').disabled = false;
    document.getElementById('clinic_name').className = 'form-control form-control-border is-valid';
    </script>";
    
    if(mysqli_num_rows($result)){
        $row = mysqli_fetch_array($result);
    
        $count = $row['cnt_clinic_name'];
        
        if($count > 0){
            $response = "<span style='color: red;'>Already Exist</span>";
            echo "<script>
            document.getElementById('add-clinic_btn').disabled = true;
            document.getElementById('clinic_name').className = 'form-control form-control-border is-invalid';
            </script>";
        }
       
    }
    
    echo $response;
    die;
}
