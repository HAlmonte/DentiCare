<?php
if(isset($_POST['get_option'])){
    
    $clinic_id = $_POST['get_option'];
    require_once '../database&config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT dr.doctor_id, dr.first_name, dr.middle_name, dr.last_name 
    FROM tbl_clinic AS c 
    LEFT JOIN tbl_doctor AS dr
    ON c.doctor_id = dr.doctor_id
    WHERE c.clinic_id = '$clinic_id'";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($doctor_id, $last_name, $first_name, $middle_name);
    $qry->store_result();
    if($qry->num_rows==0){
        echo "<option>-- No Doctor --</option>";
    }
    else {
        echo "<option>-- SELECT DOCTOR --</option>";
    }
    while ($qry->fetch()){
         echo "<option value='$doctor_id'>$first_name $middle_name $last_name</option>";
    }
    exit;
}
?>