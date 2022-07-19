<?php
if(isset($_POST['get_option_date'])){
    echo "<option>-- Select Date --</option>";
    $service_id = $_POST['get_option_date'];
    require_once '../database&config/config.php';
    $cn = new mysqli (HOST, USER, PW, DB);
    $sql="SELECT sched.schedule_id, sched.slots, sched.date 
    FROM tbl_clinic_schedule AS sched
    LEFT JOIN tbl_clinic AS clinic
    ON sched.clinic_id = clinic.clinic_id
    LEFT JOIN tbl_services AS service
    ON clinic.clinic_id = service.clinic_id
    WHERE service.service_id = '$service_id'";
    $qry=$cn->prepare($sql);
    $qry->execute();
    $qry->bind_result($schedule_id, $slots, $date);
    $qry->store_result();
    if($qry->num_rows==0){
        echo "<option>-- No Slots Available --</option>";
    }
    while ($qry->fetch()){
         echo "<option value='$date'>$slots slots avilable on $date</option>";
    }
    exit;
}
?>